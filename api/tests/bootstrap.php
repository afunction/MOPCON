<?php

require __DIR__ . '/../bootstrap/app.php';

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug' => true,
    'cacheDir' => '/tmp/l4-sample',
    'includePaths' => [__DIR__.'/../app']
]);
