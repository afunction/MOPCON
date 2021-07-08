<?php
include __DIR__ . '/src/init.php';

$main = [
    'zh' => [
        'pagetitle' => '主辦社群',
        'community_list' => '社群列表',
    ],
    'en' => [
        'pagetitle' => 'Organizing Communities',
        'community_list' => 'Community List',
    ],
];



$main = getI18n($main);
$pageid = 'community';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid),
    'main' => $main,
    'communities' => getAllCommunities(),

];
if (isset($_GET['api'])) {
    getJson($params);
}
render('community.twig', $params);
