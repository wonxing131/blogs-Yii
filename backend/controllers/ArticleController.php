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
use Yii;
use yii\data\ActiveDataProvider;

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
        $searchModel = new ArticleLabel();
        $pageSize = $searchModel->getPageSize('articleLabel');
        $query = $searchModel::find();
        $data = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => $pageSize]
        ]);

        $param = Yii::$app->request->get();     //接收过滤参数
        $data->setSort([                        //排序功能
            'attributes'    =>    [
                'name'          => [
                    'asc'  => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC]
                ],
                'created_at'    => [
                    'asc'  => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC]
                ],
                'updated_at'    => [
                    'asc'  => ['updated_at' => SORT_ASC],
                    'desc' => ['updated_at' => SORT_DESC]
                ]
            ],
        ]);
        if ($searchModel->load($param) && $searchModel->validate()){
            $query->andFilterWhere(['like','name',$searchModel->name]);
            $query->andFilterWhere(['class'=>array_search($searchModel->class,Yii::$app->params['colorClass'])]);
        }

        return $this->render('labelList',[
            'data'          => $data,
            'searchModel'   => $searchModel
        ]);
    }

    /**
     *
     * 文章标签添加
     *
     * @return string
     */
    public function actionLabelAdd()
    {
        $model = new ArticleLabel();
        $model->scenario = 'add';
        if (Yii::$app->request->isPost){
            if ($model->add(Yii::$app->request->post(),$model)){
                Yii::$app->session->setFlash('info','添加成功');
            }else{
                Yii::$app->session->setFlash('error','添加失败');
            }
        }
        return $this->render('labelAdd',[
            'model' => $model
        ]);
    }

    public function actionLabelEdit()
    {

    }

    public function actionLabelDel()
    {
        $data = Yii::$app->request->get();
        if (isset($data['id']) && isset($data['status'])){
            $model = new ArticleLabel();
            if (($data['status'] == 2 || $data['status'] == 3 ) && $model = $model::findOne($data['id'])){
                if ($data['status'] == 2){
                    $model->is_del = 3;
                }elseif ($data['status'] == 3){
                    $model->is_del = 2;
                }
                if (!$model->save(false)){
                    Yii::$app->session->setFlash('error',$model->firstError($model));
                }
            }
        }else{
            Yii::$app->session->setFlash('error','修改失败,数据不合法');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

}