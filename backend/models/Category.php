<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/5/19 0019
 * Time: 15:18
 */

namespace backend\models;
use Yii;

class Category extends Common
{

    public $is_show = [ 2 => 'fa fa-eye' , 3 => 'fa fa-eye-slash' ];

    public function rules()
    {
        return [
            ['category_name','required','message'=>'请填写分类名称'],
            ['category_name','unique','message'=>'分类名称已经存在','filter' => function($query){
                if (!$this->isNewRecord){
                    $query->andWhere(['not',['category_id'=>$this->category_id]]);
                }
            } ],
            ['parent_id','number','message'=>'上级错误'],
        ];
    }

    public function getCate()
    {
        $tree = Yii::$app->cache->get('category');
        if (!$tree){
            $data = self::find()->select('category_id,category_name,parent_id,is_show')->asArray()->all();
            $tree = self::getTree($data);
            Yii::$app->cache->set('category',$tree);
        }
        return $tree;
    }

    private function getTree($data,$parent_id = 0)
    {
        $result = [];
        foreach ($data as $k => $v){
            if ($v['parent_id'] == $parent_id){
                $result[] = [
                    'id' => $v['category_id'],
                    'text' => $v['category_name'],
                    'children' => $this->getTree($data,$v['category_id']),
                    'is_show' => $v['is_show'],
                    'icon' => $this->is_show[$v['is_show']]
                ];
            }
        }
        return $result;
    }

    public function add($data)
    {
        if (!empty($data)){
            $this->setAttributes($data);
            if ($this->save()){
                Yii::$app->cache->delete('category');
                return ['state' => 1 , 'message' => '添加成功,默认状态为显示'];
            }else{
                return ['state' => 0 , 'message' => $this->firstError($this)];
            }
        }
        return ['state' => 0 , 'message' => '数据错误'];
    }

    public function edit($data)
    {
        if (!empty($data)){
            $model = self::findOne($data['category_id']);
            $model->category_name = $data['category_name'];
            if ($model->save()){
                Yii::$app->cache->delete('category');
                return ['state' => 1 , 'message' => '修改成功'];
            }else{
                return ['state' => 0, 'message' => $this->firstError($model)];
            }
        }
        return ['state' => 0 , 'message' => '数据错误'];
    }

    public function del($data)
    {
        if (!empty($data)){
            $data['is_show'] == 2 ? $is_show = 3 : $is_show = 2;
            if (self::updateAll(['is_show'=>$is_show],['in','category_id',$data['ids']])){
                Yii::$app->cache->delete('category');
                return ['state' => 1 , 'message' => '修改完毕'];
            }
        }
        return ['state' => 0 , 'message' => '数据错误'];
    }

}