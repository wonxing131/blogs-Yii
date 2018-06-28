<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

class AdminController extends ActiveController
{
    public $modelClass = 'api\models\Admin';

    public function actionIndex()
    {
        return $this->render('index');
    }

}
