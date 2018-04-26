<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/24 0024
 * Time: 18:15
 */

namespace backend\models;
use Yii;
use yii\db\Exception;

class Permission extends Common
{
    /**
     * 拼装数据 返回[name=>description]
     * @param object $data 所有的角色信息或者节点信息
     * @param object $parent 当前传递的角色信息
     * @return array
     */
    public static function getOptions($data, $parent)
    {
        $return = [];
        foreach ($data as $obj){
            //如果当前角色存在 并且不等于循环总的数据 并且可以为当前角色的子节点或子角色 返回
            if (!empty($parent) && $obj->name != $parent->name && Yii::$app->authManager->canAddChild($parent,$obj)){
                $return[$obj->name] = $obj->description;
            }
            if (is_null($parent)){
                //如果当前角色不存在 返回全部拼装角色
                $return[$obj->name] = $obj->description;
            }
        }
        return $return;
    }

    /**
     * 为当前角色添加子角色以及子节点
     * @param array $children 子节点
     * @param string $name 当前角色标志
     * @return bool
     * @throws Exception
     * @throws \yii\base\Exception
     */
    public static function addChild($children,$name)
    {
        $auth = Yii::$app->authManager;
        $itemObj = $auth->getRole($name);
        if (empty($itemObj)){
            return false;    //若当前角色对象不存在 返回false
        }
        //先删除所有下级节点 角色 然后循环添加所有角色 节点
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $auth->removeChildren($itemObj);
            foreach ($children as $child){
                $obj = empty($auth->getRole($child)) ? $auth->getPermission($child) : $auth->getRole($child);    //如果为子角色则添加子角色否则为权限
                $auth->addChild($itemObj,$obj);
            }
            $transaction->commit();
            return true;
        }catch (Exception $e){
            $transaction->rollBack();
        }

        return false;
    }

    /**
     * 通过当前角色名称来获取所有下级
     * @param string $name
     * @return array
     */
    public static function getChildrenByName($name)
    {
        $arr = [];
        $arr['roles'] = [];
        $arr['permissions'] = [];
        if (empty($name)){
            return $arr;
        }
        $auth = Yii::$app->authManager;
        $children = $auth->getChildren($name);
        if (empty($children)){
            return $arr;
        }
        foreach ($children as $obj){
            if ($obj->type == 1){
                $arr['roles'][] = $obj->name;
            }else{
                $arr['permissions'][] = $obj->name;
            }
        }
        return $arr;
    }
}