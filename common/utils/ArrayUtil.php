<?php
/**
 * Created by PhpStorm.
 * User: L-dingtongchuan
 * Date: 2018/5/23
 * Time: 15:00
 */

namespace common\utils;


class ArrayUtil
{

    /**
     *
     * 将数组转化为树形结构数组(递归形式转化)
     *
     * @param array $array  需要被转化的数组
     * @param array $value  结构中需要展示的值 例：name:xx,age:xx,children:[]
     * @param int $parent_id  上级id
     * @param array $arr 数组内部相关参数 ['id字段名','父id字段名','子节点键值']
     * @return array 树形结构数组
     */
    public static function array_to_tree($array,$value,$parent_id,$arr = ['category_id','parent_id','children'])
    {
        $tree = [];
        foreach ($array as $k => $v){
            if ($v[$arr[1]] == $parent_id){
                $param = [];
                foreach ($value as $k1 => $v1){
                    $param[$k1] = $v[$v1];
                }
                $param[$arr[2]] = self::array_to_tree($array,$value,$v[$arr[0]]);
                $tree[] = $param;
            }
        }
        return $tree;
    }

    /**
     *
     * 将树形结构数组转化为普通二位数组(递归形式转化)
     *
     * @param array $tree
     * @param string $children
     * @return array
     */
    public static function tree_to_array(array $tree,$children = 'children')
    {
        $array      = [];
        foreach ($tree as $k => $v)
        {
            $return_arr = [];
            if (!empty($v[$children])){
                $temp = $v[$children];
                $return_arr = self::tree_to_array($temp,$children);
            }
            unset($v[$children]);
            $array[] = $v;
            $array   = array_merge($array,$return_arr);
        }
        return $array;
    }

    public static function array_format($array,$format)
    {
        
    }

}