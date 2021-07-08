<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MopCon2018\Utils\Base;

$lang = \MopCon2018\Utils\Base::getLang();

$params = [
    'pageid' => 'warm-up',
    'og_url' => 'warm-up.php',
];
Base::render('components/warm_up.twig', $params);
