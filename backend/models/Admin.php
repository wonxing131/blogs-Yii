<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/3 0003
 * Time: 10:28
 */

namespace backend\models;


use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;
class Admin extends ActiveRecord implements IdentityInterface
{

    public $rememberMe;

    /**
     * 实现接口方法
     * 以用户id获取当前用户对象
     * @param int|string $id
     * @return null|IdentityInterface|static
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * 实现接口方法
     * 以token获取当前用户对象:一般应用于restful-api应用形式
     * @param mixed $token
     * @param null $type
     * @return null|IdentityInterface
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * 实现接口方法
     * 获取当前用户id
     * @return int
     */
    public function getId()
    {
        return $this->admin_id;
    }

    /**
     * 实现接口方法
     * 获取安全登录凭据
     * @return string
     */
    public function getAuthKey()
    {
        return '';
    }

    /**
     * 实现接口方法
     * 验证authKey 一般用于cookie登录信息
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }

    public function login($data)
    {
        if ($this->load($data) && $this->validate()){
            return (bool)Yii::$app->user->login($this->getUser(),$this->rememberMe ? $this->rememberMe : 0);
        }
        return false;
    }

    public function getUser()
    {
        return self::find()->where('admin_name = :name or admin_email = :name',[':name'=>$this->login_name])->one();
    }


}