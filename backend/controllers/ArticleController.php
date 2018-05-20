<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/5/12 0012
 * Time: 14:10
 */

namespace backend\controllers;


use backend\models\Article;

class ArticleController extends BaseController
{

    /**
     * 文章列表
     *
     * @return string
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     *发布文章
     *
     * @return string
     */
    public function actionAdd()
    {
        $model = new Article();

        return $this->render('add',[
            'model' => $model
        ]);
    }
}