<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/21 0021
 * Time: 15:40
 */

namespace backend\controllers;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class BaseController extends Controller
{

    protected $access_only = ['*'];
    protected $access_except = [];
    protected $must_login = [];
    protected $method = [];
    /**
     * 行为 基本本类的方法执行前进行一次验证
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [   //访问控制
                'class' => AccessControl::className(),  //指定验证实例
                //'user' => 'admin',  //指定组件名称
                'only' => $this->access_only,   //对控制器中哪些方法做验证 针对哪些方法有效
                'except' => $this->access_except,   //对控制器除了哪些方法生效
                'rules' => [    //验证规则
                    [
                        'allow' => false,
                        'actions' => $this->must_login,
                        'roles' => ['?'],   //哪些角色 例如 ? guest 未登录 @ 登陆后
                    ],
                    [
                        'allow' => true,
                        'actions' => $this->must_login,
                        'roles' => ['@'],   //哪些角色 例如 ? guest 未登录 @ 登陆后
                    ],
                ],
            ],
            'verbs' => [    //请求方法控制
                'class' => VerbFilter::className(),
                'actions' => $this->method   //控制请求方法  ['reset-pass'=>['get','post']];
            ],
        ];
    }
}