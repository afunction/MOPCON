<?php
include __DIR__ . '/src/init.php';

$pageid = 'sponsor';
$params = [
    'pageid'    => $pageid,
    'sponsors'  => getSponsorsByOrder(),
    'index'     => getIndex()
];

$params['og_url'] = 'sponsor.php';



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $params['sponsors'] =  getSponsors($id);
}
$lang = getLang();
$template = (isset($_GET['id']) ? 'sponsorDetail.twig' : 'sponsor.twig');
render($template, $params);
