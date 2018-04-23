<?php
namespace backend\controllers;

use backend\models\Admin;
use Yii;


/**
 * Site controller
 */
class SiteController extends BaseController
{
    protected $access_except = ['login'];
    protected $must_login = ['logout','index'];
    protected $method = ['logout' => ['get']];

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Admin();
        $post = Yii::$app->request->post();
        if ($model->login($post)) {
            return $this->goBack();
        } else {
            $model->admin_pass = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout(false);

        return $this->goHome();    //返回主页
//        return $this->goBack(Yii::$app->request->referrer);   返回跳转页面
    }
}
