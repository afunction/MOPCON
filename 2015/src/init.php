<?php
include __DIR__ . "/../../vendor/autoload.php";
include __DIR__ . '/location.php';
include __DIR__ . '/sponsor.php';
include __DIR__ . '/speaker.php';
include __DIR__ . '/schedule.php';
include __DIR__ . '/community.php';

//////////////////////////////////////////////////////////////////////////////
function getSpeakerById($id)
{
    static $speakers = null;
    if (null === $speakers) {
        $speakers = getAllSpeakers();
    }
    return isset($speakers[$id]) ? $speakers[$id] : null;
}

/**
 * 合併議程跟講者，若不傳遞 $id 代表抓取全部
 *
 * speakerId 為空值，若 title, pic 未設定就會指定 title = "MOPCON", pic = "schedule/mopcon.png"
 * speakerId 找到講者 ID，若 title, pic, speaker 未設定就會自動帶入
 * speakerId 異常，找不到講者 ID 會強制蓋掉 title, pic, speaker 為 晚點告訴你 :P
 * 
 * @param  int      $id 議程編號，可為null
 * @param  string   $speaker 講者id，可為null
 * @return array
 */
function getScheduleMergeSpeaker($id = null, $speaker = null)
{
    $schedules = getAllSchedule();
    $cacheFlag = false;    
    for ($i = 0; $i < count($schedules); $i++) {
        if ($id !== null && $id != $schedules[$i]['id']) {
            continue;
        }
        if ($schedules[$i]["speakerId"] === '') { //無講者
            $schedules[$i]['title'] = isset($schedules[$i]['title']) ? $schedules[$i]['title'] : "MOPCON";
            $schedules[$i]['pic'] = isset($schedules[$i]['pic']) ? $schedules[$i]['pic'] : "schedule/mopcon.png";
            $schedules[$i]["speaker"] = isset($schedules[$i]["speaker"]) ? $schedules[$i]["speaker"] : "";
        } elseif (is_array($schedules[$i]["speakerId"])) { //複數講者
            $schedules[$i]["title"] = "";
            $schedules[$i]["speaker"] = "";
            $schedules[$i]["speakerLinks"] = [];
            foreach ($schedules[$i]["speakerId"] as $speakerId) {
                $speakerInfo = getSpeakerById($speakerId);
                if ($speakerInfo === null) continue;

                if ($schedules[$i]["title"] != '') {
                    $schedules[$i]["title"] .= " 與 ";
                }
                $schedules[$i]["title"] .= $speakerInfo['name'];

                $schedules[$i]["speaker"] .= "<p>" . $speakerInfo['name'] . "：<br>" . $speakerInfo['bio'];
                //由於來不及做 app，因此格式先混著寫先混著寫
                if (count($speakerInfo['links']) > 0) {
                    $schedules[$i]["speaker"] .= "<br>";
                    foreach ($speakerInfo['links'] as $line_name => $link_url) {
                        if ($link_url == '') {
                            continue;
                        }
                        $schedules[$i]["speaker"] .= "&nbsp;<a href='" . $link_url . "'>" . $line_name . "</a>&nbsp;";
                    }
                } 
                $schedules[$i]["speaker"] .= "</p>";
                
                $schedules[$i]["speakerLinks"][] = $speakerInfo['links'];
                if ($speaker !== null && $speaker == $speakerId) {
                    $cacheFlag = true;
                }
            }
            $schedules[$i]['pic'] = isset($schedules[$i]["pic"]) ? $schedules[$i]["pic"] : 'schedule/secret.jpg'; //異常處理
        } else { //單一講者
            $speakerInfo = getSpeakerById($schedules[$i]["speakerId"]);
            if ($speakerInfo === null) { //異常處理
                $schedules[$i]["speakerId"] = '';
                $schedules[$i]["title"] = '晚點告訴你 :P';
                $schedules[$i]["speaker"] = '';
                $schedules[$i]['pic'] = 'schedule/secret.jpg';
            } else {
                $schedules[$i]["title"] = isset($schedules[$i]["title"]) ? $schedules[$i]["title"] : $speakerInfo['name'];
                $schedules[$i]["speaker"] = isset($schedules[$i]["speaker"]) ? $schedules[$i]["speaker"] : $speakerInfo['bio'];
                $schedules[$i]['pic'] = isset($schedules[$i]["pic"]) ? $schedules[$i]["pic"] : $speakerInfo['pic'];
                $schedules[$i]["speakerLinks"] = $speakerInfo["links"];
                if ($speaker !== null && $speaker == $schedules[$i]['speakerId']) {
                    $cacheFlag = true;
                }
            }
        } 
        if ($id !== null || $cacheFlag == true) {
             return $schedules[$i];
        }
    }
    return $schedules;
}
/**
 * 取得最後修改時間，部分頁面會自動計算相關頁面最大值
 * @param  string $page 頁面代號，空值代表全部取最大值
 * @return time
 */
function getLastUpdateTime($page = '')
{
    $list = [
        "index"         => filemtime(__DIR__  . '/../index.php'),
        "location"      => filemtime(__DIR__  . '/../location.php'),
        "cfp"           => filemtime(__DIR__  . '/../cfp.php'),
        "schedule"      => filemtime(__DIR__  . '/../schedule.php'),
        "speaker"       => filemtime(__DIR__  . '/../speaker.php'),
        "sponsor"       => filemtime(__DIR__  . '/../sponsor.php'),
        "community"     => filemtime(__DIR__  . '/../community.php'),
        "src.schedule"  => filemtime(__DIR__  . '/schedule.php'),
        "src.speaker"   => filemtime(__DIR__  . '/speaker.php'),
        "src.sponsor"   => filemtime(__DIR__  . '/sponsor.php'),
        "src.community" => filemtime(__DIR__  . '/community.php'),
        "src.init"      => filemtime(__DIR__  . '/init.php'),
        "api.index"     => filemtime(__DIR__  . '/../api/index.php'),
        "css.all"       => filemtime(__DIR__  . '/../stylesheets/all.css'),
        "css.web-fonts" => filemtime(__DIR__  . '/../stylesheets/web-fonts.css'),
        "js.all"        => filemtime(__DIR__  . '/../javascripts/all/all.js'),
    ];
    if ($page == '') {
        return max($list);
    } elseif (! isset($list[$page])) {
        return time(); //當異常就回傳當下時間
    } elseif ($page == "schedule") {
        return max(
            $list['schedule'], 
            $list['src.schedule'], 
            $list['src.init'], 
            $list['src.speaker']
        );
    } elseif (isset($list["src." . $page])) {
        return max(
            $list[$page], 
            $list["src." . $page]
        );
    } else {
        return $list[$page];
    }
    
}
/**
 * 取得api對應的資料
 * @param  string $page 頁面代號
 * @return array  無資料會回傳 null
 */
function apiMappingData($page)
{
    switch ($page) {
        case 'schedule':
            return getScheduleMergeSpeaker();
        case 'sponsor':
            return getSponsors();
        case 'speaker':
            return getAllSpeakers();
        case 'location':
            return getLocation();
        case 'community':
            return getAllCommunities();
        default:
            return null;
    }
}
/**
 * 印出 json，自動 exit
 * @param array $params 
 * @return void
 */
function getJson($params)
{
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($params);
    exit;
}
//////////////////////////////////////////////////////////////////////////////
function getLang()
{
    static $lang = null;
    if ($lang) {
        return $lang;
    }

    $supported_langs = [
        'zh',
        'en'
    ];

    if (isset($_GET['lang']) && in_array($_GET['lang'], $supported_langs)) {
        $lang = $_GET['lang'];
    } elseif(isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
            $browser_lang = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
        } else {
            $browser_lang = 'zh';
        }
        $lang = in_array($browser_lang, $supported_langs) ? $browser_lang : 'en';
    }
    setcookie('lang', $lang);

    return $lang;
}

function getI18n($msg_data)
{
    if (!is_array($msg_data) || 0 === count($msg_data)) {
        return [];
    }

    $lang = getLang();

    if (isset($msg_data[$lang])) {
        return $msg_data[$lang];
    }
    if (isset($msg_data['en'])) {
        return $msg_data['en'];
    }
    return reset($msg_data); // return first group
}
function getWebList($notSelf = true)
{
    $nowDir = trim(pathinfo($_SERVER['PHP_SELF'],PATHINFO_DIRNAME),"/");
    $webList = [];
    //檢查
    for ($i = date("Y"); $i >= 2012; $i--) {
        if ($notSelf && $i == $nowDir ) continue;
        if ( file_exists ( __DIR__.'/../../'.$i)) {
            $webList[] = $i;    
        }
    }
    return $webList;
}
function render($template_name, $params)
{
    $main_msg = [
        'zh' => [
            'sitetitle' => '行動科技年會 | MOPCON 2015 | Mobile / Open / Platform Conference',
            'ogtitle' => '行動科技年會 | MOPCON 2015 | Mobile / Open / Platform Conference',
            'ogsitename' => '行動科技年會 | MOPCON 2015 | Mobile / Open / Platform Conference',
            'ogdesc' => '濁水溪以南最強大行動科技研討會，2015強勢回歸',
            'nav' => [
                'community' => '社群',
                'location' => '地圖',
                'cfp' => '徵稿',
                'previous' => '歷年',
                'speaker' => '講者',
                'schedule' => '議程',
                'sponsor' => '贊助',
                'hackpad' => '2015 hackpad',
                'chatroom' => '聊天室',
                'chatroom_gitter' => '網頁版（Gitter）',
                'chatroom_irc' => 'IRC: #mopcon @ freenode',

            ],
        ],
        'en' => [
            'sitetitle' => 'MOPCON 2015 | Mobile / Open / Platform Conference',
            'ogtitle' => 'MOPCON 2015 | Mobile / Open / Platform Conference',
            'ogsitename' => 'MOPCON 2015 | Mobile / Open / Platform Conference',
            'ogdesc' => 'Your favoeite conference for mobile technology in southern Taiwan is now back in 2015',
            'nav' => [
                'community' => 'Community',
                'location' => 'Location',
                'cfp' => 'Call for paper',
                'previous' => 'Previous Events',
                'speaker' => 'Speakers',
                'schedule' => 'Session',
                'sponsor' => 'Sponsors',
                'hackpad' => '2015 hackpad',
                'chatroom' => 'Chat Room',
                'chatroom_gitter' => 'Gitter',
                'chatroom_irc' => 'IRC: #mopcon @ freenode',
            ],
        ],
    ];
    $main = getI18n($main_msg);
    $main['pagetitle'] = $main['nav'][$params['pageid']];
    $params = array_replace_recursive(
        [
            'main' => $main,
            'lang' => getLang(),
            'webList'=>getWebList(),
            'og_image' => 'snapshot-mid.png',
            'og_url' => '',
            'version' => [
                'allCss' => getLastUpdateTime('css.all'),
                'allJs' => getLastUpdateTime('js.all'),
                'webFontsCss' => getLastUpdateTime('css.web-fonts'),
            ],
        ],
        $params
    );
    $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../twig');
    $twig = new \Twig_Environment($loader);
    $twig->addExtension(new Jralph\Twig\Markdown\Extension(new Jralph\Twig\Markdown\Parsedown\ParsedownExtraMarkdown));
    echo $twig->render($template_name, $params);
}
