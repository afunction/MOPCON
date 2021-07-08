<?php
include __DIR__ . '/src/init.php';

$map = [
        'lat' => 22.626417,
        'lng' => 120.285722,
        'zoom' => 16,
];
$pageid = 'location';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid),
    'map' => $map,
    'location' => getLocation(),
];

if (isset($_GET['api'])) {
    getJson($params);
}
render('location.twig', $params);
