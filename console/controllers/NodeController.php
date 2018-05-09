<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/23 0023
 * Time: 22:22
 */

namespace console\controllers;


use Yii;
use yii\console\Controller;
use yii\db\Exception;

class NodeController extends Controller
{
    public function actionInit()
    {
        $path = dirname(dirname(dirname(__FILE__))).'/backend/controllers';    //获取需要的控制器目录
        $controllers_file = glob($path.'/*');   //获取目录下所有文件路径
        $permission = [];
        $transaction = Yii::$app->db->beginTransaction();
        try{
            foreach ($controllers_file as $controllers){
                $controller = file_get_contents($controllers);  //获取文件内容
                preg_match('/class ([a-zA-Z]+)Controller/',$controller,$match);
                $controller_name = $match[1];   //以正则表达式获得Controller名称信息
                $permissions[] = strtolower($controller_name. '/*');    //拼装当前控制器所有节点代表
                preg_match_all('/public function action([a-zA-Z_]+)/',$controller,$matchs);    //使用正则表达式获取所有的方法名
                foreach ($matchs[1] as $m){
                    if ($m != 's'){
                        $permission[] = $controller_name .'/'.$m;   //遍历方法名 判断不是actions这个特殊方法 与控制器名进行拼接
                    }
                }
            }
            $auth = Yii::$app->authManager;    //实例化权限组件
            foreach ($permission as $item){    //循环节点列表
                if (!$auth->getPermission($item)){    //当前节点未添加
                    $perm = $auth->createPermission($item);    //创建节点对象
                    $perm->description = $item;    //添加节点描述
                    $auth->add($perm);    //添加节点
                }
            }
            $transaction->commit();
            echo 'import success ';
        }catch (Exception $e){
            $transaction->rollBack();
            echo 'import error ';
        }
    }
}