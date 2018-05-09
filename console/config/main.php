<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',    //使用DB形式存储节点用户信息等
            //'class' => 'yii\rbac\PhpManager',    //使用文件形式存储节点用户信息等
            'itemTable' => '{{%auth_item}}',    //数据库添加表前缀
            'itemChildTable' => '{{%auth_item_child}}',
            'assignmentTable' => '{{%auth_assignment}}',
            'ruleTable' => '{{%auth_rule}}'
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,   //发送邮件设置为14号库
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',    //指定邮件类
            //'viewPath' => '@common/mail',   //指定邮件模版路径
            'useFileTransport' => false,    ///false：非测试状态，发送真实邮件而非存储为文件
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',    //网易邮箱发送邮件服务器
                'username' => '15590860585@163.com',    //服务器邮箱
                'password' => 'dtc597945833',    //服务器授权码
                'port' => '25',  //25|456
                'encryption' => 'tls',   //tls|ssl
            ],
        ],
        'urlManager' => [   //url管理
            'enablePrettyUrl' => true,  //开启url美化
            'showScriptName' => false,  //是否在url中显示入口脚本,url的进一步解析
            // 是否启用严格解析，如启用严格解析，要求当前请求应至少匹配1个路由规则，
            // 否则认为是无效路由。
            // 这个选项仅在 enablePrettyUrl 启用后才有效。
            'enableStrictParsing' => false,
            'suffix' => '',
            'rules' => [
                "<controller:\w+>/<id:\d+>"=>"<controller>/view",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>",
            ],
        ],
    ],
    'params' => $params,
];
