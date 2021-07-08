<?php
include __DIR__ . '/src/init.php';

$pageid = 'community';
$params = [
    'pageid' => $pageid,
    'filemtime' => getLastUpdateTime($pageid),
    'community' => [],
];
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  // header("Location:schedule.php?community=" . $id);
  // exit;
  $params['community'] = getCommunityById($id);
  $params['og_image'] = "community/".$params['community']['image'];
  $params['og_url'] = 'community.php?id=' . $id;
  $params['main']['ogdesc'] = $params['community']['name'] . "\n" . preg_replace('/<br( )?\/?>/i','\n',$params['community']['info']); //. "\n" . $params['community'][$id]['title']

  $templates = [
    'zh' => 'community_single.twig',
    // 'en' => 'speaker_en.twig',
	];

} else {
	$params['og_url'] = 'community.php';
	$params['community'] = getAllCommunities();	

	$templates = [
    'zh' => 'community.twig',
    // 'en' => 'speaker_en.twig',
	];

}

if (count($params['community']) === 0 || current($params['community']) === null) {
    header('Location: /2016/community.php');
    exit;
}

if (isset($_GET['api'])) {
    getJson($params);
}


$lang = getLang();
if($lang!=='zh') {
    header("Location:./");
}
$template = isset($templates[$lang]) ? $templates[$lang] : $templates['zh'];
render($template, $params);
