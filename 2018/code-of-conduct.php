<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MopCon2018\Utils\Base;

$config = Base::getConfig();

$spreadSheetKey = $config['2018']['sheetKey'];
$columnMapping = [
    'title' => 'title',
    'content' => 'content',
    'en_title' => 'en-title',
    'en_content' => 'en-content',
];

$apiData = new \MopCon2018\Utils\GoogleDocsSpreadsheet($spreadSheetKey, $columnMapping);

// var_dump($apiData->toArray()[0]);
$lang = \MopCon2018\Utils\Base::getLang();

$params = [
    'pageid' => 'code_of_conduct',
    'og_url' => 'code-of-conduct.php',
    'body' => [
        'code_of_conduct' => $lang == 'zh'
        ? $apiData->toArray()[0]['content']
        : $apiData->toArray()[0][$lang . '_content'],
    ],
];
\MopCon2018\Utils\Base::render('components/code-of-conduct.twig', $params);
