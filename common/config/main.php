<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
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
    ],
    'timeZone'=>'Asia/Chongqing',
    'language' => 'zh-CN',
];
