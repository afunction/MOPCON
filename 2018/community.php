<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MopCon2018\Utils\Base;

$url = Base::getBaseUri() . '/2018/api/community';
$apiData = json_decode(file_get_contents($url), true);
$apiData = $apiData['payload'];
$lang = \MopCon2018\Utils\Base::getLang();

$params = [
    'pageid' => 'community',
    'og_url' => 'community.php',
    'communitys' => $apiData
];

\MopCon2018\Utils\Base::render('components/community.twig', $params);
