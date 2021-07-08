<?php
require_once __DIR__ . '/vendor/autoload.php';

use MopCon\BaseComponent;

$jsonText = file_get_contents(__DIR__ . "/locales/album/photodata.json");
$params = [
    'pageid' => 'album',
    'pagetitle' => '歷年相簿',
    'album' => json_decode($jsonText, true)
];

(new BaseComponent())->render('album.twig', $params);
