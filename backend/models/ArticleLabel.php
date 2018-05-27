<?php
/**
 * Created by PhpStorm.
 * User: L-dingtongchuan
 * Date: 2018/5/25
 * Time: 18:10
 */

namespace backend\models;


class ArticleLabel extends Common
{
    public function rules()
    {
        return [
            ['article_label_id','number','message'=>'数据类型错误'],
            ['name','required','message'=>'标签名字不能为空','on' => ['add','update']],
            ['name','unique','message'=>'该标签已经存在','filter'=>function($query){
                if (!$this->isNewRecord){
                    $query->andWhere(['not',['article_label_id'=>$this->article_label_id]]);
                }
            },'on' => ['add','update']],
            ['name','string','length'=>[2,5],'message'=>'标签长度为2-5个字符'],
            ['class','required','message'=>'请选择标签颜色','on' => ['add','update']],
            ['class','safe'],
            ['is_del','in','range'=>[2,3],'message'=>'显示信息数据错误','on' => ['add','update']]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '标签名称',
            'class' => '标签颜色',
            'is_del' => '是否显示'
        ];
    }


    public function add($data,$model)
    {
        if ($model->load($data) && $model->validate()){
            return (bool)$model->save(false);
        }
        return false;
    }
}