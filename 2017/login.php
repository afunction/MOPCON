<?php
include __DIR__ . '/src/init.php';

$pageid = 'login';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid), 
    'heatmapRooms' => [],
];

$params['logins'] = getScheduleMergeSpeaker();


if (isset($_GET['api'])) {
	getJson($params);
}
render('login.twig', $params);
