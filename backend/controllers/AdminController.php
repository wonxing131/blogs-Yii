<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/21 0021
 * Time: 16:18
 */

namespace backend\controllers;


use backend\models\Admin;
use backend\models\EmailLog;
use Yii;
use yii\db\Exception;


class AdminController extends BaseController
{

    protected $access_except = ['reset-pass'];
    protected $method = ['reset-pass'=>['get','post']];

    /**
     * 管理员添加
     * @return string
     */
    public function actionAdd()
    {
        $model = new Admin();
        if (Yii::$app->request->isPost){
            if ($model->add(Yii::$app->request->post())){
                Yii::$app->session->setFlash('info','添加成功');
            }
        }
        return $this->render('add',[
            'model' => $model
        ]);
    }

    /**
     * 管理员列表
     * @return string
     */
    public function actionList()
    {
        $get = Yii::$app->request->get();
        $searchModel = new Admin();
        $data = $searchModel->getList($get);
        return $this->render('list',[
            'data' => $data,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * 个人信息
     * @return string
     */
    public function actionMy()
    {
        $model = new Admin();
        $model = $model::findOne(Yii::$app->user->id);
        $model->scenario = 'editMy';
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->editMy($post,$model)){
                Yii::$app->session->setFlash('info','修改成功,请点击刷新按钮');
            }
        }
        return $this->render('my',[
            'model' => $model
        ]);
    }

    /**
     * 管理员修改密码
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionPass()
    {
        $model = new Admin();
        $model = $model::findOne(Yii::$app->user->id);
        $model->scenario = 'editPass';
        if (Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            if ($model->editPass($post,$model)){
                return $this->redirect('/site/logout');
            }
        }
        return $this->render('pass',[
            'model' => $model
        ]);
    }

    public function actionResetPass()
    {
        $this->layout = 'main-login.php';
        $admin_model = new Admin();
        $param = Yii::$app->request->get();
        if (Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            if ($admin_model->resetPass($data)){
                return $this->goHome();
            }else{
                return $this->render('resetPass',['token'=>$data['token'],'email'=>$data['email'],'model'=>$admin_model]);
            }
        }
        if (isset($param['email']) && isset($param['token'])){
            $email_log = new EmailLog;
            $token = $email_log::find()
                ->where([
                    'and',
                    ['email'=>$param['email']],
                    ['token'=>$param['token']],
                    ['>','created_at',time()-300],
                    ['status'=>2],
                    ['send_type'=>2]
                ])
                ->exists();
            if (!$token){
                echo '无效的链接！';
            }else{
                return $this->render('resetPass',['token'=>$param['token'],'email'=>$param['email'],'model'=>$admin_model]);
            }
        }else{
            throw new Exception('无法访问');
        }
    }

    public function actionRedis()
    {
//        return Yii::$app->redis->set('name1','老二');
        return Yii::$app->redis->get('name1');
    }
}