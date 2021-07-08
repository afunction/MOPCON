<?php
include __DIR__ . '/src/init.php';

$lang_zh = json_decode(file_get_contents("locales/app-zh_TW.json"), true);
$lang_en = json_decode(file_get_contents("locales/app-en.json"), true);
$main = [
    'zh' => $lang_zh,
    'en' => $lang_en,
];
$params = [
    'pageid' => 'apps'
];
$params['og_url'] = 'apps.php';
$params['main']['ogdesc'] = 'MOPCON APP下載頁。';
$params['lang'] = getI18n($main);
$lang = getLang();

render('apps.twig', $params);
