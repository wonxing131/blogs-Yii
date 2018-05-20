<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/5/19 0019
 * Time: 11:54
 */

namespace backend\controllers;

use Yii;
use backend\models\Category;
use yii\web\Response;

class CategoryController extends BaseController
{

    protected $method = ['edit' => ['post'],'del'=>['post'],'add'=>['post']];

    public function actionList()
    {
        return $this->render('list');
    }

    public function actionData(){
        $model = new Category();
        $data = $model->getCate();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionAdd()
    {
        $post = Yii::$app->request->post();
        $model = new Category();
        $result = $model->add($post);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function actionEdit()
    {
        $post = Yii::$app->request->post();
        $model = new Category();
        $result = $model->edit($post);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function actionDel()
    {
        $post = Yii::$app->request->post();
        $model = new Category();
        $result = $model->del($post);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }
}