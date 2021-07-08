<?php
include __DIR__ . '/src/init.php';

$pageid = 'schedule_unconf';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid), 
    'schedules' => [],
];

$params['schedules'] = getScheduleUnconf();


if (isset($_GET['api'])) {
	getJson($params);
}
render('schedule_unconf.twig', $params);
