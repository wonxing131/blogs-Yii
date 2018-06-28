<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => ['queue'],
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
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,   //发送邮件设置为14号库
        ],
        'queue' => [
            'class' => 'yii\queue\redis\Queue::class',
            'as log' => 'yii\queue\LogBehavior::class',
            'redis' => 'redis',
            'channel' => 'queue'
        ],
    ],
    'timeZone'=>'Asia/Chongqing',
    'language' => 'zh-CN',
];
