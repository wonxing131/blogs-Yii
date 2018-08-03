<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => ['queue','debug','log'],
    'modules'   => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['*.*.*.*','127.0.0.1','::1']
        ],
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [    //格式化gridView中时间显示设置
            'dateFormat' => 'YYY.MM.dd',
            'datetimeFormat' => 'Y-M-d H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'EUR',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,   //发送邮件设置为14号库
        ],
        'queue' => [
            'class' => 'yii\queue\redis\Queue',
            'as log' => 'yii\queue\LogBehavior',
            'redis' => 'redis',
            'channel' => 'queue'
        ],
        'log'   => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ]
    ],
    'timeZone'=>'Asia/Chongqing',
    'language' => 'zh-CN',
];
