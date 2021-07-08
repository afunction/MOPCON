<?php
include __DIR__ . '/src/init.php';

$templates = [
    'zh' => 'index.twig',
    'en' => 'index_en.twig',
];

$lang = getLang();
$template = isset($templates[$lang]) ? $templates[$lang] : $templates['zh'];
$pageid = 'index';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid), 
    'data' => getSponsors(),
];

if (isset($_GET['api'])) {
	getJson($params);
}

render($template, $params);
