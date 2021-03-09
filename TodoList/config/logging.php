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

    'default' => env('LOG_CHANNEL', 'stack'),

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
        'channels' => ['single', 'syslog', /*'slack'*/],
            'ignore_exceptions' => false, 
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/TEST.log'), //파일명을 변경하면 파일을 새로만들어서 찍어준다
            'level' => env('LOG_LEVEL', 'info'),
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
        ],
          
        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'laravel-log-test-1',
            'emoji' => ':boom:',// 이미지 
            'level' => env('LOG_LEVEL', 'critical'),
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],
    ],

];



/*  http://wiki.pchero21.com/wiki/Syslog  RFC 5424 스펙
LOG_EMERG	시스템을 사용할 수 없습니다. 공황 상태. 일반적으로 모든 사용자에게 브로드 캐스트됩니다.
LOG_ALERT	즉시 조치를 취해야합니다. 손상된 시스템 데이터베이스와 같이 즉시 수정해야하는 조건입니다.
LOG_CRIT	중요한 조건. 심각한 상태 (예 : 하드 장치 오류).
LOG_ERR	오류 조건.
LOG_WARNING	경고 조건.
LOG_NOTICE	정상이지만 심각한 상태입니다. 오류 조건은 아니지만 특별히 처리해야하는 조건입니다.
LOG_INFO	정보 메시지.
LOG_DEBUG	디버그 수준 메시지. 프로그램을 디버깅 할 때만 일반적으로 사용되는 정보가 포함 된 메시지입니다.
*/