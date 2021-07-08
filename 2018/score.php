<?php
require_once __DIR__ . '/../vendor/autoload.php';
function getResult($id = 1)
{
    $jsonText = file_get_contents(__DIR__ . "/locales/score/result.json");
    $jsonArr = json_decode($jsonText, true);
    $returnArr = $jsonArr[($id-0)];
    
    return $returnArr;
}


// $apiData = new \MopCon2018\Utils\GoogleDocsSpreadsheet($spreadSheetKey, $columnMapping);

// var_dump($apiData->toArray()[0]);
$lang = \MopCon2018\Utils\Base::getLang();
$result = isset($_GET['result']) ? $_GET['result'] : '1';

$params = [
    'pageid' => 'score',
    'score' => getResult($result)
    
    
];
$params['og_image'] = "facebook/" . $params['score']['og_image'];
$params['og_title'] = $params['score']['og_title'];
$params['og_description'] = $params['score']['og_description'];
$params['og_url'] = 'score.php?result=' . $result;
\MopCon2018\Utils\Base::render('components/score.twig', $params);
