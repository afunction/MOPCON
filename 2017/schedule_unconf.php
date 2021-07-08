<?php
include __DIR__ . '/src/init.php';

$pageid = 'schedule_unconf';
$lang = getLang();
$params = [
    'pageid'    => $pageid,
    'schedules' => [],
];
$text = [
    'zh' => [
        'description' => '交流場次的位置位於 3F左側',
        'time' => '時段',
        'topic' => '主題',
        'speaker' => '講者'
    ],
    'en' => [
        'description' => 'Unconference space is on the left side of 3F .',
        'time' => 'Time',
        'topic' => 'Topic',
        'speaker' => 'Speaker'
    ],
];
$params['schedules'] = getScheduleUnconf();
$params['og_url'] = 'schedule_unconf.php';
$params['main']['ogdesc'] = 'Unconference 是 MOPCON 於正式議程外，提供給參與會眾一個發表平台！每個場次 30 分鐘主題不限。';


if (isset($_GET['api'])) {
    getJson($params);
}
$params['text'] = isset($text[$lang]) ? $text[$lang] : $text['zh'];
render('schedule_unconf.twig', $params);
