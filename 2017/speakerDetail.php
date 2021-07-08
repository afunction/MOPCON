<?php
include __DIR__ . '/src/init.php';

$lang = getLang();
$pageid = 'speakerDetail';
$speaker = isset($_GET['speaker']) ? $_GET['speaker'] : '1';
$params = [
    'pageid'        => $pageid,
    'filemtime'     => getLastUpdateTime($pageid),
    'speakerDetail' => getSpeakers($speaker),
    'index'         => getIndex(),
];

if (isset($_GET['speaker'])) {
    $params['main']['ogdesc'] = $params['speakerDetail']['schedule_topic']
        . ' - ' . $params['speakerDetail']['schedule_info'];
    $params['main']['pagetitle'] = '講者 ' . $params['speakerDetail']['name'];
    $params['og_image'] = 'speaker/' . $params['speakerDetail']['picture'];
    $params['og_url'] = 'speakerDetail.php?speaker=' . $speaker;
}
if (isset($_GET['api'])) {
    getJson($params);
}

render('speakerDetail.twig', $params);
