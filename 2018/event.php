<?php
require_once __DIR__ . '/../vendor/autoload.php';

$columnMapping = [
    'title' => 'title',
    'content' => 'content',
    'en_title' => 'en-title',
    'en_content' => 'en-content',
];

// $apiData = new \MopCon2018\Utils\GoogleDocsSpreadsheet($spreadSheetKey, $columnMapping);

// var_dump($apiData->toArray()[0]);
$lang = \MopCon2018\Utils\Base::getLang();

$params = [
    'pageid' => 'event',
    
];
\MopCon2018\Utils\Base::render('components/event.twig', $params);
