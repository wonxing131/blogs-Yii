<?php
namespace backend\controllers;

use backend\models\Admin;
use Yii;


/**
 * Site controller
 */
class SiteController extends BaseController
{
    protected $access_except = ['login','find-pass'];
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

    /**
     * 找回密码
     *
     * @return string
     */
    public function actionFindPass()
    {
        $this->layout = 'main-login.php';
        $model = new Admin();
        if (Yii::$app->request->isPost){
            $email = Yii::$app->request->post('Admin')['admin_email'];
            $pattern = '/^[a-zA-z0-9]+\@[a-zA-Z0-9]+\.[a-zA-Z0-9]+/';
            if (preg_match($pattern,$email)){
                if ($model::find()->where('admin_email = :m',[':m'=>$email])->exists()){
                    //验证完毕：发送邮件信息入队列 右进左出
                    if (Yii::$app->redis->rpush('email',$email.'^%^*2')){
                        echo '发送成功';
                    }else{
                        echo '发送失败';
                    }
                }else{
                    echo '邮箱尚未注册';
                }
            }else{
                echo '邮箱格式不正确';
            }


        }
        return $this->render('findPass',[
            'model' => $model
        ]);
    }
}
