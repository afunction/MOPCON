<?php
include __DIR__ . '/src/init.php';

$templates = [
    'zh' => 'index.twig',
    // 'en' => 'index_en.twig',
];
$map = [
        'lat' => 22.626417,
        'lng' => 120.285722,
        'zoom' => 16,
];

$lang = getLang();
$template = isset($templates[$lang]) ? $templates[$lang] : $templates['zh'];
$pageid = 'index';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid), 
    'map' => $map,
    'index' => getIndex(),
    'location' => getLocation(),	
    'speakers' => getAllSpeakers($order = 'random'),
    'sponsors' => getAllSponsors(),
];

if (isset($_GET['api'])) {
	getJson($params);
}

render($template, $params);
