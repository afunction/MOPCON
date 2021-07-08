<?php

return [
    'default' => env('LOG_CHANNEL', 'stack'),
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily', 'rollbar'],
        ],
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/lumen.log'),
            'level' => 'debug',
            'days' => 14,
        ],
        'rollbar' => [
            'driver' => 'monolog',
            'handler' => \Rollbar\Monolog\Handler\RollbarHandler::class,
            'access_token' => env('ROLLBAR_ACCESS_TOKEN'),
            'level' => 'debug',
        ],
    ],
];
