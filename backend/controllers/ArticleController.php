<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/5/12 0012
 * Time: 14:10
 */

namespace backend\controllers;


use backend\models\Article;
use backend\models\ArticleLabel;
use backend\models\Category;
use common\utils\ArrayUtil;
use Yii;

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

        //获取分类信息
        $category_model = new Category();
        $category_list = $category_model->getLevelList();
        return $this->render('add',[
            'model'         => $model,
            'category_list' => $category_list
        ]);
    }

    /**
     * 文章标签列表
     *
     * @return string
     */
    public function actionLabel()
    {
        return $this->render('labelList');
    }

}