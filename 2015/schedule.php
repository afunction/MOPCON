<?php
include __DIR__ . '/src/init.php';
$pageid = 'schedule';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid), 
    'schedules' => [],
];
if (isset($_GET['speaker'])) {
    $speaker = $_GET['speaker'];
    $params['schedules'] = getScheduleMergeSpeaker(null, $speaker);
    $params['og_image'] = $params['schedules']['pic'];
    $params['og_url'] = 'schedule.php?speaker=' . $speaker;
    $params['main']['ogdesc'] = $params['schedules']['title'] . " : " . $params['schedules']['summary'];

} elseif (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $params['schedules'] = getScheduleMergeSpeaker($id, null);
    $params['og_image'] = $params['schedules']['pic'];
    $params['og_url'] = 'schedule.php?id=' . $id;
    $params['main']['ogdesc'] = $params['schedules']['title'] . " : " . $params['schedules']['summary'];

} else {
    $params['schedules'] = getScheduleMergeSpeaker();
}

if (count($params['schedules']) === 0 || current($params['schedules']) === null) {
    header('Location: /2015/schedule.php');
    exit;
}

if (isset($_GET['api'])) {
	getJson($params);
}
render((isset($_GET['id']) || isset($_GET['speaker'])) ? 'scheduleSingle.twig' : 'schedule.twig', $params);
