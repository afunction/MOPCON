<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MopCon2018\Utils\Base;

$url = Base::getBaseUri() . '/2018/api/schedule-unconf';
$apiHelper = new MopCon2018\Utils\Api;
$apiData = json_decode($apiHelper->getScheduleUnconf(), true);
$apiData = $apiData['payload'];
$lang = \MopCon2018\Utils\Base::getLang();

$params = [
    'lang' => $lang,
    'pageid' => 'schedule_unconf',
    'og_url' => 'schedule_unconf.php',
    'schedules_day1' => $apiData[0]['items'],
    'schedules_day2' => $apiData[1]['items'],
];
Base::render('components/schedule_unconf.twig', $params);
