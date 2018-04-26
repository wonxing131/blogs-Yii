<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/26 0026
 * Time: 18:54
 */

namespace backend\models;


use yii\behaviors\TimestampBehavior;

class AdminLoginLog extends Common
{

    protected $before_in = ['created_at'];

    public function add($admin_id)
    {
        $this->admin_id = $admin_id;
        $this->ip = ip2long(\Yii::$app->request->getUserIP());   //$_SERVER['REMOTE_ADDR']
        return (bool)$this->save();
    }
}