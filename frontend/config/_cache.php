<?php
/**
 * @author Eugene Terentev <eugene@terentev.net>
 */

$cache = [
    //'class' => 'yii\caching\FileCache',
    //'cachePath' => '@frontend/runtime/cache'
    'class' => 'yii\redis\Cache',
            'redis' => [
                'hostname' => env('REDIS_HOSTNAME'),
                'port' => env('REDIS_PORT'),
                'database' => env('REDIS_DATABASE'),
                'password' => env('REDIS_PASSWORD')
            ],
];

if (YII_ENV_DEV) {
    /*$cache = [
        'class' => 'yii\redis\Cache',
        'redis' => [
            'hostname' => env('REDIS_HOSTNAME'),
            'port' => env('REDIS_PORT'),
            'database' => env('REDIS_DATABASE'),
            'password' => env('REDIS_PASSWORD')
        ],
    ];*/
}

return $cache;
