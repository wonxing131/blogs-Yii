<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/23 0023
 * Time: 16:49
 */

namespace backend\controllers;
use backend\models\Permission;
use Yii;
use yii\base\ErrorException;
use yii\data\ActiveDataProvider;
use yii\db\Query;

class PermissionController extends BaseController
{
    /**
     * 创建权限角色
     * @return string
     * @throws \Exception
     */
    public function actionRoleCreate()
    {
        if (Yii::$app->request->isPost){
            $auth = Yii::$app->authManager;    //获取权限类信息
            $role = $auth->createRole(null);    //生成角色对象    type => 1 其余为null
            $post = Yii::$app->request->post();
            if (empty($post['description']) || empty($post['name'])){
                throw new \Exception('参数错误');   //验证不存在描述或标识 抛出错误
            }
            $role->description = $post['description'];
            $role->name = $post['name'];
            $role->ruleName = empty($post['rule_name']) ? null : $post['rule_name'];
            $role->data = empty($post['data']) ? null : $post['data'];
            if ($auth->add($role)){    //为角色对象赋值后添加
                Yii::$app->getSession()->setFlash('info','添加成功');
            }
        }
        return $this->render('roleCreate');
    }

    /**
     * 角色列表
     * @return string
     */
    public function actionRoles()
    {
        $auth = Yii::$app->authManager;
        $data = new ActiveDataProvider([
            'query' => (new Query())->from($auth->itemTable)->where('type = 1')->orderBy('created_at desc'),
            'pagination' => ['pageSize'=>5]
        ]);
        return $this->render('roles',['data' => $data]);
    }

    /**
     * 向用户添加子角色以及子权限
     * @return string
     * @throws ErrorException
     * @throws \yii\base\Exception
     * @throws \yii\db\Exception
     */
    public function actionAssignItem()
    {
        $name = Yii::$app->request->get('name');
        if (empty($name)){
            throw new ErrorException('参数错误,无管理员信息');
        }
        $auth = Yii::$app->authManager;    //获取权限组件
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post('children');
            if (Permission::addChild(Yii::$app->request->post('children'),$name)){
                Yii::$app->session->setFlash('info','添加成功');
            }
        }
        $role = $auth->getRole($name);    //获取点击的角色对象
        $roles = Permission::getOptions($auth->getRoles(),$role);   //获取所有角色并且拼装成 [name => description] 形式
        $permissions = Permission::getOptions($auth->getPermissions(),$role);   //获取所有节点并且拼装成 [name => description] 形式
        $children = Permission::getChildrenByName($name);
        return $this->render('assignItem',[
            'roles'=>$roles,
            'permissions'=>$permissions,
            'parent' => $role->description,
            'children' => $children
        ]);
    }
}