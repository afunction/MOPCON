<?php
include __DIR__ . '/src/init.php';


$lang = getLang();
$pageid = 'community';
$params = [
    'pageid'    => $pageid,
    'community' => getAllCommunities(),
    'index'     => getIndex()
];
$params['og_url'] = 'community.php';
$params['main']['ogdesc'] = '一路支持MOPCON的好夥伴們！';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']) - 1;
    $params['community'] = getSingleCommunity($id);
    $params['main']['pagetitle'] = '社群 ' . $params['community']['name'];
    $params['og_url'] = 'community.php?id=' . intval($_GET['id']);
    // $params['og_image'] = $params['schedules']['pic'];
    // $params['og_url'] = 'schedule.php?speaker=' . $speaker;
    // $params['main']['ogdesc'] = $params['schedules']['title'] . " : " . $params['schedules']['summary'];

}
render((isset($_GET['id'])) ? 'communityDetail.twig' : 'community.twig', $params);
