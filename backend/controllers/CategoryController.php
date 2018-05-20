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
}