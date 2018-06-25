<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
//    'modules' => [
//        'admin' => [
//            'class' => 'mdm\admin\Module',
//            'layout' => 'left-menu',//yii2-admin的导航菜单
//        ]
//    ],
//    "aliases" => [
//        "@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
//    ],
//    'as access' => [
//        'class' => 'mdm\admin\components\AccessControl',
//        'allowActions' => [
//            //这里是允许访问的action
//            //controller/action
//            '*'
//        ]
//    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            //设置用户组件实例
            'identityClass' => 'backend\models\Admin',  //指定组件
            'enableAutoLogin' => true,  //保持自动登录
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],    //cookie设置  只能通过http进行传输
//            'idParam' => '__admin',   设置SESSION中存储内容下标
//            'loginUrl' => ['/Member/auth']    设置登录地址
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',    //使用DB形式存储节点用户信息等
            //'class' => 'yii\rbac\PhpManager',    //使用文件形式存储节点用户信息等
            'itemTable' => '{{%auth_item}}',    //数据库添加表前缀
            'itemChildTable' => '{{%auth_item_child}}',
            'assignmentTable' => '{{%auth_assignment}}',
            'ruleTable' => '{{%auth_rule}}',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [   //url管理
            'enablePrettyUrl' => false,  //开启url美化
            'showScriptName' => false,  //是否在url中显示入口脚本,url的进一步解析
            // 是否启用严格解析，如启用严格解析，要求当前请求应至少匹配1个路由规则，
            // 否则认为是无效路由。
            // 这个选项仅在 enablePrettyUrl 启用后才有效。
            'enableStrictParsing' => false,
            'suffix' => '',
            'rules' => [
                "<controller:\w+>/<id:\d+>"=>"<controller>/view",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>",
                '' => 'site/index'
            ],
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
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 14,   //发送邮件设置为14号库
        ],
    ],
    'controllerMap' => [
        'attachment' => [
            'class' => 'yiichina\mdeditor\controllers\AttachmentController',
        ],
    ],
    'params' => $params,
];
