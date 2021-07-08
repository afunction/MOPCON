<?php
include __DIR__ . '/src/init.php';

$pageid = 'speaker';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid),
    'speakers' => [],
];
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  // header(
  // "Location:schedule.php?speaker=" . $id);
  // exit;
  $params['speakers'] = getSpeakerById($id);
  $params['og_image'] = "speaker/".$params['speakers']['image'];
  $params['og_url'] = 'speaker.php?id=' . $id;
  $params['main']['ogdesc'] = $params['speakers']['name'] . "\n" . preg_replace('/<br( )?\/?>/i','\n',$params['speakers']['info']); //. "\n" . $params['speakers'][$id]['title']

  $templates = [
    'zh' => 'speaker_single.twig',
    // 'en' => 'speaker_en.twig',
	];

} else {

	$params['og_url'] = 'speaker.php';
	$params['speakers'] = getAllSpeakers();
	$params['main']['ogdesc'] = '濁水溪以南最強大行動科技研討會，星光閃閃講師盡在這邊！'; 	

	$templates = [
	    'zh' => 'speaker.twig',
	    // 'en' => 'speaker_en.twig',
	];

}

if (count($params['speakers']) === 0 || current($params['speakers']) === null) {
    header('Location: /2016/speaker.php');
    exit;
}

// print_r(getAllSpeakers());exit;
// if (count($params['speakers']) === 0 ) {
//     header('Location: /2016/speaker.php');
//     exit;
// }
if (isset($_GET['api'])) {
    getJson($params);
}

$lang = getLang();
if($lang!=='zh') {
    header("Location:./");
}
$template = isset($templates[$lang]) ? $templates[$lang] : $templates['zh'];

render($template, $params);
