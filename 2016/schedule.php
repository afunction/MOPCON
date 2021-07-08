<?php
include __DIR__ . '/src/init.php';

$pageid = 'schedule';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid), 
    'schedules' => [],
];

$params['schedules'] = getScheduleMergeSpeaker();


if (isset($_GET['api'])) {
	getJson($params);
}
render('schedule.twig', $params);
