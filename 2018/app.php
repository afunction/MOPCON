<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MopCon2018\Utils\Base;

// var_dump($apiData->toArray()[0]);
$lang = \MopCon2018\Utils\Base::getLang();

$params = [
    'pageid' => 'apps',
    'og_url' => 'apps.php'
];

\MopCon2018\Utils\Base::render('components/apps.twig', $params);
