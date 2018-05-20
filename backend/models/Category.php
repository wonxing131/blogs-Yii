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

    public function getCate()
    {
        $tree = Yii::$app->cache->get('category');
        if (!$tree){
            $data = self::find()->where('is_show = 2')->asArray()->all();
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
                    'children' => $this->getTree($data,$v['category_id'])
                ];
            }
        }
        return $result;
    }

}