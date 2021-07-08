<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MopCon2018\Utils\Base;

$url = Base::getBaseUri() . '/2018/api/volunteer';
$apiData = json_decode(file_get_contents($url), true);
$apiData = $apiData['payload'];
$lang = \MopCon2018\Utils\Base::getLang();

$params = [
    'pageid' => 'volunteer',
    'og_url' => 'volunteer.php',
    'volunteers' => $apiData
];

\MopCon2018\Utils\Base::render('components/volunteer.twig', $params);
