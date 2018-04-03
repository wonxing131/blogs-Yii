<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/2 0002
 * Time: 21:01
 */

namespace backend\controllers;


use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }
}