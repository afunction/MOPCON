<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MopCon2018\Utils\Base;

$url = Base::getBaseUri() . '/2018/api/speaker';
$apiHelper = new MopCon2018\Utils\Api;
$apiData = json_decode($apiHelper->getSpeaker(), true);
$apiData = $apiData['payload'];
$id = isset($_GET['id']) ? $_GET['id'] : '';

// var_dump($apiData->toArray()[0]);
$lang = \MopCon2018\Utils\Base::getLang();

$params = [
    'pageid' => 'speaker',
    'og_url' => 'speaker.php',
    'speakers' => $apiData,
    'id' => $id
];
if (isset($_GET['id'])) {
    // $params['main']['ogdesc'] = $params['speakerDetail']['schedule_topic']
    //     . ' - ' . $params['speakerDetail']['schedule_info'];
    // $params['main']['pagetitle'] = '講者 ' . $params['speakerDetail']['name'];
    // $params['og_image'] = 'speaker/' . $params['speakerDetail']['picture'];
    // $params['og_url'] = 'speakerDetail.php?speaker=' . $speaker;
    foreach($apiData as $key => $element){
        if($element['speaker_id'] == $id){
            $params['og_image'] = $element['picture'];
            $params['og_title'] = '講者 '.$element['name'].'('.$element['job'].')';
            $params['og_description'] = $element['info'];
            $params['og_url'] = 'speaker.php?id=' . $id;
           }
        }
}
\MopCon2018\Utils\Base::render('components/speaker.twig', $params);
