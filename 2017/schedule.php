<?php
include __DIR__ . '/src/init.php';

$lang = getLang();
$pageid = 'schedule';
$params = [
    'pageid'    => $pageid,
    'schedules' => getSchedules(),
];
$params['og_url'] = 'schedule.php';
$text = [
    'zh' => [
        'description' => '點擊議程標題可觀看詳細介紹',

    ],
    'en' => [
        'description' => 'Click schedule title to see more detail.',

    ],
];
if (isset($_GET['api'])) {
    getJson($params);
}
$params['text'] = isset($text[$lang]) ? $text[$lang] : $text['zh'];
render('schedule.twig', $params);
