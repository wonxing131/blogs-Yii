<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/21 0021
 * Time: 16:18
 */

namespace backend\controllers;


use backend\models\Admin;
use Yii;

class AdminController extends BaseController
{
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
}