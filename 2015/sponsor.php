<?php
include __DIR__ . '/src/init.php';

$pageid = 'sponsor';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid),
    'sponsors' => getSponsors(),
];

if (isset($_GET['api'])) {
    getJson($params);
}
render('sponsor.twig', $params);
