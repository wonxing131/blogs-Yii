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
}