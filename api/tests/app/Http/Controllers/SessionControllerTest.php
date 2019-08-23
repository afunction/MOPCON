<?php

namespace Tests\App\Http\Controllers;

use TestCase;

class SessionController extends TestCase
{
    private $dataset;
    private $speakers;
    private $sessions;
    protected $session_keys = [
        'speaker_id',
        'name',
        'name_e',
        'company',
        'company_e',
        'job_title',
        'job_title_e',
        'photo_for_session_web',
        'photo_for_session_mobile',
        'topic',
        'topic_e',
        'started_at',
        'ended_at',
        'tags',
        'is_keynote',
        'recordable',
        'level',
    ];
    protected $tags_design = [
        'UI/UX',
    ];
    protected $tags_other = [
        'Startup',
    ];
    protected $locations = [
        'R1' => '3F一廳',
        'R2' => '4F二廳',
        'R3' => '4F三廳',
    ];

    public function setUp() :void
    {
        parent::setUp();
        putenv('APP_ENV=develop');

        $path = __DIR__ . '/../../../../resource/assets/json';
        if (env('APP_ENV') === 'production') {
            $this->dataset = json_decode(file_get_contents($path . '/session.json'), true);
            $this->speakers = json_decode(file_get_contents($path . '/speaker.json'), true);
        } else {
            $this->dataset = json_decode(file_get_contents($path . '/session-dev.json'), true);
            $this->speakers = json_decode(file_get_contents($path . '/speaker-dev.json'), true);
        }

        $this->sessions = $this->transSpeakerToSession($this->speakers);
    }

    public function testGetSessionSchedule()
    {
        $response = $this->get('/api/2019/session/');
        $compared = $this->dataset;
        foreach ($compared as &$schedule) {
            foreach ($schedule['period'] as &$period) {
                if (empty($period['room'])) {
                    continue;
                }
                foreach ($period['room'] as $room => &$session_id) {
                    $session_id = $this->sessions[$session_id];
                }
            }
        }

        $this->assertEquals(200, $this->response->status());

        $response->seeJsonEquals([
            'success' => true,
            'message' => 'success',
            'data'    => $compared,
        ]);
    }

    public function testGetSessionList()
    {
        $id = rand(1, count($this->sessions));
        $response = $this->get('/api/2019/session/list');
        $compared = array_values($this->sessions);

        $this->assertEquals(200, $this->response->status());

        $response->seeJsonEquals([
            'success' => true,
            'message' => 'success',
            'data' => $compared,
        ]);
    }

    public function testGetSession()
    {
        $id = rand(1, count($this->sessions));
        $response = $this->get('/api/2019/session/' . $id);
        $compared = $this->sessions[$id];

        $this->assertEquals(200, $this->response->status());

        $response->seeJsonEquals([
            'success' => true,
            'message' => 'success',
            'data' => $compared,
        ]);
    }

    public function testGetSessionWithNoExistId()
    {
        $id = count($this->sessions) + 1;
        $response = $this->get('/api/2019/session/' . $id);

        $this->assertEquals(404, $this->response->status());

        $response->seeJsonEquals([
            'success' => false,
            'message' => 'Not found',
            'data' => [],
        ]);
    }

    public function testGetSessionWithWrongIdType()
    {
        $id = "test";
        $response = $this->get('/api/2019/session/' . $id);

        $this->assertEquals(400, $this->response->status());

        $response->seeJsonEquals([
            'success' => false,
            'message' => 'Bad request',
            'data' => [],
        ]);
    }

    private function transSpeakerToSession(array $speakers)
    {
        $index = 1;
        $sessions = [];
        foreach ($speakers as $speaker) {
            $session = [];
            $session['session_id'] = $index;
            $session['room'] = $speaker['room'];
            $session['location'] = $this->locations[$speaker['room']];
            foreach ($this->session_keys as $key) {
                if ($key === 'tags') {
                    $session['tags_design'] = $session['tags_other'] = $session['tags_tech'] = [];
                    continue;
                }
                $session[$key] = $speaker[$key];
            }
            foreach ($speaker['tags'] as $tag) {
                if (in_array($tag, $this->tags_design)) {
                    $session['tags_design'][] = $tag;
                    continue;
                }
                if (in_array($tag, $this->tags_other)) {
                    $session['tags_other'][] = $tag;
                    continue;
                }
                $session['tags_tech'][] = $tag;
            }
    
            $session['is_sponsor_session'] = (bool)$speaker['sponsor_id'];
            $sessions[$index++] = $session;
        }
        return $sessions;
    }
}