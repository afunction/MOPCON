<?php
include __DIR__ . '/src/init.php';

$pageid = 'sponsor';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid),
    'sponsors' => [],
];

$params['og_url'] = 'sponsor.php';
$params['sponsors'] = getAllSponsors();	

$templates = [
  'zh' => 'sponsor.twig',
  // 'en' => 'sponsor.twig',
];


if (isset($_GET['api'])) {
    getJson($params);
}

$lang = getLang();
if($lang!=='zh') {
    header("Location:./");
}

$template = isset($templates[$lang]) ? $templates[$lang] : $templates['zh'];
render($template, $params);
