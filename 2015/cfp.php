<?php
include __DIR__ . '/src/init.php';

$template_name = ('en' === getLang())
    ? "cfp_en.twig"
    : "cfp.twig";
$pageid = 'cfp';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid), 
    'data' => null,
];

if (isset($_GET['api'])) {
	getJson($params);
}
render($template_name, $params);
