<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'single'),

    /*
    |--------------------------------------------------------------------------
    | Deprecations Log Channel
    |--------------------------------------------------------------------------
    |
    | This option controls the log channel that should be used to log warnings
    | regarding deprecated PHP and library features. This allows you to get
    | your application ready for upcoming major versions of dependencies.
    |
    */

    'deprecations' => [
        'channel' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
        'trace' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
        ],

        'stack' => [
            'driver' => 'stack',
            'channels' => ['stderr'],
        ],

        // 'stack' => [
        //     'driver' => 'stack',
        //     'channels' => ['database'],
        // ],

        // 'stack' => [
        //     'driver' => 'stack',
        //     'channels' => ['vercel', 'daily'],
        // ],
        // 'stack' => [
        //     'driver' => 'stack',
        //     'channels' => ['papertrail'],
        // ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'error'),
        ],

        // 'single' => [
        //     'driver' => 'single',
        //     'path' => storage_path('logs/vercel.log'),
        //     'level' => 'debug',
        // ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'error'),
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => env('LOG_LEVEL', 'critical'),
        ],

        'stderr' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'error'),
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        // 'stderr' => [
        //     'driver' => 'monolog',
        //     'handler' => Monolog\Handler\StreamHandler::class,
        //     'with' => [
        //         'stream' => 'php://stderr',
        //     ],
        // ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'error'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'error'),
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

        'vercel' => [
            'driver' => 'monolog',
            'handler' => Vercel\Monolog\Handler\VercelHandler::class,
            'formatter' => env('LOG_CHANNEL', 'daily'),
            'formatter_with' => [
                'dateFormat' => 'Y-m-d H:i:s',
                'includeStacktraces' => true,
            ],
        ],

        // 'database' => [
        //     'driver' => 'custom',
        //     'via' => App\Logging\DatabaseLogger::class,
        //     'level' => 'debug',
        // ],
    ],   

];
