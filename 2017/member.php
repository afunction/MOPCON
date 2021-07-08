<?php
include __DIR__ . '/src/init.php';


$lang = getLang();
$pageid = 'member';
$params = [
    'pageid' => $pageid,
    'member' => getAllMembers(),
];
$params['og_url'] = 'member.php';
$params['main']['ogdesc'] = 'MOPCON的志工成員介紹。';
$text = [
    'zh' => [
        'committee' => '委員',
        'member'    => '成員',
        'list'      => '名單',
    ],
    'en' => [
        'committee' => 'Committee',
        'member'    => 'Member',
        'list'      => 'List',
    ],
];
$params['text'] = isset($text[$lang]) ? $text[$lang] : $text['zh'];
render('member.twig', $params);
