<?php
include __DIR__ . '/src/init.php';

$pageid = 'speaker';
$params = [
    'pageid'    => $pageid,
    'speakers'  => [],
    'index'     => getIndex(),
];
$params['og_url'] = 'speaker.php';

$params['speakers'] = getSpeakers();
$params['main']['ogdesc'] = '濁水溪以南最強大行動科技研討會，星光閃閃講師盡在這邊！';

if (count($params['speakers']) === 0 || current($params['speakers']) === null) {
    header('Location: /2017/speaker.php');
    exit;
}


$lang = getLang();

render('speaker.twig', $params);
