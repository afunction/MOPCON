<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiTrait;
use App\Service\SpeakerService;
use App\Service\SessionService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class BaseBoardController extends Controller
{
    use ApiTrait;

    protected $function = 'session';
    private $session_keys = [
        'speaker_id',
        'name',
        'name_e',
        'company',
        'company_e',
        'job_title',
        'job_title_e',
        'img',
        'topic',
        'topic_e',
        'started_at',
        'ended_at',
        'tags',
        'is_keynote',
        'recordable',
        'level',
        'room',
        'floor',
        'sponsor_id',
        'summary',
        'summary_e',
    ];
    private $locations = [
        'R1' => '3F',
        'R2' => '4F',
        'R3' => '4F',
    ];

    private $map_path;
    private $sessions;
    private $sponsors;
    private $sessionSpeakerMapping = [];
    private $speakerService;

    private const MOPCON_FIRST_DAY = 1603468800;
    private const MOPCON_LAST_SESSION_END = 1603616400;

    private const BEFORE_START = 3*60;
    private const START_AFTER = 10*60;

    private const BEFORE_START_TXT = '議程即將開始';
    private const START_AFTER_TXT = '議程進行中';
    private const PREVIEW_TXT = '議程預告';
    private const LIVE_TXT = '．本廳同步轉播中';

    private const TAG_PROHIBITED_RECORD_TXT = '禁止錄影';
    private const TAG_BROADCAST_TXT = '同步轉播';
    private const TAG_LIVE_TXT = '議程現場';

    private const BEFORE_START_CLASS = 'text-yellow-500';
    private const START_AFTER_CLASS = 'text-yellow-500';
    private const PREVIEW_CLASS = 'text-purple-400';

    private const TAG_CLASS_PRIMARY = 'tag-badge-outline-primary';
    private const TAG_CLASS_SECONDARY = 'tag-badge-outline-secondary';
    private const TAG_CLASS_THIRD = 'tag-badge-outline-third';

    private const OUTROOM_PLAY_TIME_SESSION = 60;
    private const OUTROOM_PLAY_TIME_AD = 5;
    private const OUTROOM_PLAY_TIME_MAP = 5;
    private const OUTROOM_PLAY_TIME_TOTAL = 180;
    private const OUTROOM_SPONSOR_AD_NUM_A_TIME = 5;
    private const OUTROOM_PLAY_LIST_LENGTH_MAXIMUM = 14;

    private const INROOM_PLAY_TIME_SESSION = 30;
    private const INROOM_PLAY_TIME_AD = 10;
    private const INROOM_PLAY_TIME_MAP = 5;
    private const INROOM_PLAY_TIME_TOTAL = 180;
    private const INROOM_SPONSOR_AD_NUM_A_TIME = 10;
    private const INROOM_PLAY_LIST_LENGTH_MAXIMUM = 14;

    private $board;
    private $sponsor_ads;

    public function __construct()
    {
        parent::__construct();

        if (env('APP_ENV') === 'production') {
            $speaker_resource_path = $this->path . 'speaker.json';
            $tag_group_resource_path = $this->path . 'tag-group.json';
        } else {
            $speaker_resource_path = $this->path . 'speaker-dev.json';
            $tag_group_resource_path = $this->path . 'tag-group-dev.json';
        }

        $this->map_path = 'api/' . $this-> year . '/board/images/field/map';

        $speakers = json_decode(file_get_contents($speaker_resource_path), true);
        $tagGroupSetting = json_decode(file_get_contents($tag_group_resource_path), true);

        $this->speakerService = new SpeakerService($this->jsonAry, $tagGroupSetting);
        $this->sessionSpeakerMapping = $this->speakerService->getSessionSpeakerMapping();
        $this->sessions = $this->transSpeakerToSession($speakers);
        $this->board = $this->arrangeSessions($this->jsonAry);
    }

    /**
     * 取得輪播清單
     *
     * @param string $room
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index($room, Request $request)
    {
        $now = $request->input('now', 0);
        $type = $request->input('type', 'outroom');

        $json_path = $type === 'inroom' ? 'slide' : 'board';

        if (env('APP_ENV') === 'production') {
            $board_resource_path = $this->path . $json_path . '.json';
        } else {
            $board_resource_path = $this->path . $json_path . '-dev.json';
        }

        $board_ads = [];
        if (file_exists($board_resource_path)) {
            $board_ads = json_decode(file_get_contents($board_resource_path), true);
        }

        $this->sponsor_ads = [];
        foreach ($board_ads as $ad) {
            $this->sponsor_ads[] = [
                'sponsor_ad_img' => url($ad['board_path']),
            ];
        }

        if ($type !== 'inroom' && $type !== 'outroom') {
            return $this->returnError('Bad request');
        }

        $this->outputBoard = $this->getOutputSession($this->board, $now);
        $outputSessoion = $this->formatSession($this->outputBoard, $room);

        $content = $this->sortCarouselList($outputSessoion, $type);

        global $app;
        $request = Request::create('/api/' . $this->year . '/news', 'GET');
        $response = json_decode($app->dispatch($request)->getContent(), true);
        $news = [];
        if (!is_null($response) && is_array($response['data'])) {
            foreach ($response['data'] as $value) {
                $news[] = [
                    'title' => $value['title'],
                    'description' => $value['description'],
                ];
            }
        }

        $output = [
            'news' => $news,
            'content' => $content,
        ];

        return $this->returnSuccess('success', $output);
    }
    /**
     * 排列輪播清單
     *
     * @param array $outputSessoion
     * @param string $type
     * @return array
     */
    private function sortCarouselList(array $outputSessoion, string $type)
    {
        $is_inroom = $type === 'inroom';

        $sessionPlayTime = 0;
        $adPlayTime = 0;
        $mapPlayTime = 0;
        $totalPlayTime = 0;
        $sponsorAdNumberPerTime = 0;
        $maxPlayListLength = 0;
        if ($is_inroom) {
            $sessionPlayTime        = BaseBoardController::INROOM_PLAY_TIME_SESSION;
            $adPlayTime             = BaseBoardController::INROOM_PLAY_TIME_AD;
            $mapPlayTime            = BaseBoardController::INROOM_PLAY_TIME_MAP;
            $totalPlayTime          = BaseBoardController::INROOM_PLAY_TIME_TOTAL;
            $sponsorAdNumberPerTime = BaseBoardController::INROOM_SPONSOR_AD_NUM_A_TIME;
            $maxPlayListLength      = BaseBoardController::INROOM_PLAY_LIST_LENGTH_MAXIMUM;
        } else {
            $sessionPlayTime        = BaseBoardController::OUTROOM_PLAY_TIME_SESSION;
            $adPlayTime             = BaseBoardController::OUTROOM_PLAY_TIME_AD;
            $mapPlayTime            = BaseBoardController::OUTROOM_PLAY_TIME_MAP;
            $totalPlayTime          = BaseBoardController::OUTROOM_PLAY_TIME_TOTAL;
            $sponsorAdNumberPerTime = BaseBoardController::OUTROOM_SPONSOR_AD_NUM_A_TIME;
            $maxPlayListLength      = BaseBoardController::OUTROOM_PLAY_LIST_LENGTH_MAXIMUM;
        }

        $list = [];

        $map = [
            'title' => '休息一下！後續還有精彩議程！',
            'subtitle' => '會場地圖',
            'map' => url($this->map_path)
        ];
        $ad_num = count($this->sponsor_ads);
        $ad_index = rand(1, $ad_num) - 1;
        $total_time = 0;
        while ($total_time < $totalPlayTime) {
            $list[] = [
                'type' => 'map',
                'play_time' => $mapPlayTime,
                'data' => $map,
            ];
            $total_time += $mapPlayTime;

            if (!empty($outputSessoion)) {
                $list[] = [
                    'type' => 'session',
                    'play_time' => $sessionPlayTime,
                    'data' => $outputSessoion,
                ];
                $total_time += $sessionPlayTime;
            }

            if (!empty($this->sponsor_ads)) {
                for ($i = 0; $i < $sponsorAdNumberPerTime; $i++) {
                    $list[] = [
                        'type' => 'ad',
                        'play_time' => $adPlayTime,
                        'data' => $this->sponsor_ads[$ad_index++],
                    ];

                    if ($ad_index === $ad_num) {
                        $ad_index = 0;
                    }
                    $total_time += $adPlayTime;
                }
            }
            $total_num = count($list);
            if ($total_num > $maxPlayListLength) {
                $slice_num = $total_num - $maxPlayListLength;
                for ($i = 1; $i <= $slice_num; $i++) {
                    unset($list[$total_num - $i]);
                }
                break;
            }
        }
        return $list;
    }

    /**
     * 由講者資訊取得議程資訊
     *
     * @param array $speakers
     * @return array
     */
    private function transSpeakerToSession(array $speakers)
    {
        $sessions = [];
        foreach ($speakers as $speaker) {
            $output = $this->speakerService->parse($speaker, 'session');
            $session = array_filter($output, function ($key) {
                return in_array($key, $this->session_keys);
            }, ARRAY_FILTER_USE_KEY);
            if (isset($this->sponsors[$speaker['sponsor_id']])) {
                $session['sponsor_info'] = $this->sponsors[$speaker['sponsor_id']];
            }
            $session_id = $this->sessionSpeakerMapping[$speaker['speaker_id']] ?? 0;
            $session['session_id'] = $session_id;
            $this->convertToMultipleSpeaker($sessions, $session, $session_id);
        }

        return $sessions;
    }

    /**
     * @param array $sessions
     * @param array $session
     * @param int   $session_id
     */
    private function convertToMultipleSpeaker(array &$sessions, array &$session, int $session_id): void
    {
        if (!isset($sessions[$session_id])) {
            $session['speakers'] = [];
            $session['speakers'][] = SessionService::transportMultipleSpeaker($session);
            $sessions[$session_id] = $session;
        } else {
            $sessions[$session_id]['speakers'][] = SessionService::transportMultipleSpeaker($session);
        }
    }
    /**
     * 整理輪播議程資訊
     *
     * @param array $sessionAry
     * @return array
     */
    private function arrangeSessions(array $sessionAry)
    {
        $output = [];
        foreach ($sessionAry as $schedule) {
            $output[$schedule['date']] = [];
            foreach ($schedule['period'] as $period) {
                if (empty($period['room'])) {
                    continue;
                }

                foreach ($period['room'] as &$room) {
                    $room = $this->sessions[$room['session_id']];
                    $room['tags'] = [];
                    if (!$room['recordable']) {
                        $room['tags'][] = [
                            'class_name' => BaseBoardController::TAG_CLASS_THIRD,
                            'name' => BaseBoardController::TAG_PROHIBITED_RECORD_TXT,
                        ];
                    }
                    unset($room['is_keynote'], $room['sponsor_id'], $room['recordable'], $room['session_id']);
                }
                $output[$schedule['date']][] = [
                    'started_at' => $period['started_at'],
                    'ended_at' => $period['ended_at'],
                    'isBroadCast' => $period['isBroadCast'],
                    'room' => $period['room'],
                ];
            }
        }
        return $output;
    }

    /**
     * 取得要輪播的議程
     *
     * @param array $boardAry
     * @param integer $now
     * @return array
     */
    private function getOutputSession(array $boardAry, int $now = 0)
    {
        $now = $now === 0 ? strtotime('now') : $now;
        $now = $now < BaseBoardController::MOPCON_FIRST_DAY ? BaseBoardController::MOPCON_FIRST_DAY : $now;
        $day = strtotime(date('Ymd', $now));
        $result = [];
        if (!isset($boardAry[$day]) || $now > BaseBoardController::MOPCON_LAST_SESSION_END) {
            return $result;
        }
        foreach ($boardAry[$day] as $key => $sessionSet) {
            $before_start = $sessionSet['started_at'] - BaseBoardController::BEFORE_START;
            $start_after = $sessionSet['started_at'] + BaseBoardController::START_AFTER;
            $next_before_start = isset($boardAry[$day][$key+1]) ? $boardAry[$day][$key+1]['started_at'] - BaseBoardController::BEFORE_START : 0;
            if ($before_start <= $now && $now < $sessionSet['started_at']) {
                $result['playing'] = false;
                $result['title'] = BaseBoardController::BEFORE_START_TXT;
                $result['title_class'] = BaseBoardController::BEFORE_START_CLASS;
            } elseif ($sessionSet['started_at'] <= $now && $now < $start_after) {
                $result['playing'] = true;
                $result['title'] = BaseBoardController::START_AFTER_TXT;
                $result['title_class'] = BaseBoardController::START_AFTER_CLASS;
            } elseif ($start_after <= $now && $next_before_start !== 0) {
                continue;
            } elseif ($now < $next_before_start || $before_start > $now) {
                $result['playing'] = false;
                $result['title'] = BaseBoardController::PREVIEW_TXT;
                $result['title_class'] = BaseBoardController::PREVIEW_CLASS;
            }

            if (!empty($result)) {
                return array_merge($result, $sessionSet);
            }
        }
        return $result;
    }
    /**
     * 格式化輪播議程資訊
     *
     * @param array $sessions
     * @param string $room
     * @return array
     */
    private function formatSession(array $sessions, string $room)
    {
        if (empty($sessions)) {
            return $sessions;
        }
        $main_room = $sidecar_room = [];
        if ($sessions['isBroadCast']) {
            $session = end($sessions['room']);
            if ($session['room'] === $room) {
                $main_room = $session;
                $main_room['tags'][] = [
                    'class_name' => BaseBoardController::TAG_CLASS_PRIMARY,
                    'name' => BaseBoardController::TAG_LIVE_TXT,
                ];
            } else {
                if ($sessions['playing']) {
                    $sessions['title'] = BaseBoardController::LIVE_TXT;
                    $sessions['title_class'] = BaseBoardController::PREVIEW_CLASS;
                }
                $main_room = $session;
                $main_room['room'] = $room;
                $main_room['floor'] = $this->locations[$room];

                $main_room['tags'][] = [
                    'class_name' => BaseBoardController::TAG_CLASS_SECONDARY,
                    'name' => BaseBoardController::TAG_BROADCAST_TXT,
                ];
            }
        } else {
            foreach ($sessions['room'] as $session) {
                if ($session['room'] === $room) {
                    $session['floor'] = '本廳';
                    $main_room = $session;
                    continue;
                }
                $sidecar_room[] = $session;
            }
        }
        unset($sessions['room'], $sessions['playing']);
        $sessions['room']['main'] = $main_room;
        $sessions['room']['sidecar'] = $sidecar_room;

        return $sessions;
    }

    public function imagesView($type, $name)
    {
        $dir = $this->imgPath . 'board/' . $type . '/' . $name . '.*';
        $path = glob($dir);
        $path = end($path);
        $type = mime_content_type($path);
        return (new Response(file_get_contents($path), 200))->header('Content-Type', $type);
    }
}
