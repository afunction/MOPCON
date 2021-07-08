<?php
include __DIR__ . '/src/init.php';

$templates = [
    'zh' => 'cfp.twig',
    // 'en' => 'cfp_en.twig',
];

$lang = getLang();
if($lang!=='zh') {
	header("Location:./");
}
$template = isset($templates[$lang]) ? $templates[$lang] : $templates['zh'];

$pageid = 'cfp';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid), 
    'data' => null,
];

if (isset($_GET['api'])) {
	getJson($params);
}
render($template, $params);
