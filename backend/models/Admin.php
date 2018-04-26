<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/21 0021
 * Time: 13:11
 */

namespace backend\models;

use yii\web\IdentityInterface;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;

class Admin extends Common implements IdentityInterface
{

    public $rememberMe;
    public $loginName;
    public $surePass;

    public function rules()
    {
        return [
            ['loginName','required','message'=>'登录帐号不能为空','on'=>'login'],
            ['admin_name','required','message'=>'管理员帐号不能为空','on'=>['add']],
            ['admin_name','match','pattern'=>'/^[A-Za-z]+$/','message'=>'管理员帐号为纯字母','on'=>['add']],
            ['admin_name','unique','message'=>'管理员帐号已经存在','on'=>['add']],
            ['admin_pass','required','message'=>'管理员密码不能为空','on'=>['add','login']],
            ['admin_pass','validatePass','on'=>['login']],
            ['surePass','required','message'=>'确认密码不能为空','on'=>['add']],
            ['surePass','compare','compareAttribute'=>'admin_pass','message'=>'两次密码输入不一致','on'=>['add']],
            ['admin_email','email','message'=>'邮箱格式不正确','on'=>['add']],
            ['admin_email','unique','message'=>'邮箱已经被注册','on'=>['add']],
            ['admin_mobile','match','pattern'=>'/^\d{11}$/','message'=>'手机号格式错误','on'=>['add']],
            ['admin_mobile','unique','message'=>'手机号已被注册','on'=>['add']],
            ['admin_pass','mkPass','on'=>['add']],
            ['rememberMe','boolean','on'=>'login'],
            [['admin_mobile','admin_name','admin_qq'],'safe'],
        ];
    }

    /**
     * 注册管理员设置登录密码
     * @throws \yii\base\Exception
     */
    public function mkPass()
    {
        $this->original_pass = $this->admin_pass;
        $this->admin_pass = Yii::$app->getSecurity()->generatePasswordHash($this->admin_pass);
    }

    public function validatePass()
    {
        if (!$this->hasErrors()){
            if (preg_match("/^\d{11}$/", $this->loginName)) {
                //手机号登录
                $loginName = 'admin_mobile';
            } elseif (preg_match("/([a-zA-Z0-9])+@+([a-zA-Z0-9])+.+([a-zA-Z0-9])/", $this->loginName)) {
                //邮箱登录
                $loginName = 'admin_email';
            } else {
                $loginName = 'admin_name';
            }
            $password = self::find()->select('admin_pass')->where($loginName.' = :loginName',[':loginName'=>$this->loginName])->one();
            if (is_null($password)){
                $this->addError('loginName','用户名不存在');
                return false;
            }
            if (!Yii::$app->getSecurity()->validatePassword($this->admin_pass,$password->admin_pass)){
                $this->addError('admin_pass','用户名或密码错误');
            }
        }
    }

    /**
     * 设置label内容
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'admin_name' => '管理员帐号',
            'admin_pass' => '管理员密码',
            'surePass' => '确认密码',
            'admin_mobile' => '管理员手机号',
            'admin_email' => '管理员邮箱',
            'rememberMe' => '记住我'
        ];
    }

    /**
     * 依靠用户id查找用户实例
     * 使用SESSION维持登录状态使用该方法
     * @param int|string $id
     * @return null|IdentityInterface|static
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * 依靠access_token查找用户实例
     * 一般应用在无状态的RESTFUL应用中
     * @param mixed $token
     * @param null $type
     * @return null|IdentityInterface|static
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
//        return static::findOne(['access_token' => $token]);
        return null;    //当前应用非restful应用,不实现该方法
    }

    /**
     * 获取用户认证实例id
     * @return int|mixed|string
     */
    public function getId()
    {
        return $this->admin_id;
    }

    /**
     * 获取基于COOKIE时认证密钥
     * @return mixed|string
     */
    public function getAuthKey()
    {
//        return $this->getAuthKey();
        return '';  //当前项目登录凭据在SESSION中存储 返回 '';
    }

    /**
     * 验证COOKIE登录密钥内容
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
//        return $this->authKey === $authKey;
        return true;    //当前项目登录凭据在SESSION中存储 无需验证cookie密钥 返回true;
    }

    /**
     * 获取用户实例
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getUser()
    {
        return self::find()->where('admin_name = :name or admin_email = :name or admin_mobile = :name',[':name'=>$this->loginName])->one();
    }

    /**
     * 管理员登录
     * @param $data
     * @return bool
     */
    public function login($data)
    {
        $this->scenario = 'login';
        if ($this->load($data) && $this->validate()){
            //登录成功
            return Yii::$app->user->login($this->getUser(),$this->rememberMe ? 24 * 3600 : 0);
        }
        return false;
    }

    /**
     * 添加管理员
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $this->scenario = 'add';
        if ($this->load($data) && $this->validate()){
            return (bool)$this->save(false);
        }
        return false;
    }

    public function getList($params = '')
    {
        $pageSize = isset(Yii::$app->params['pageSize']['admin']) ? Yii::$app->params['pageSize']['admin'] : Yii::$app->params['pageSize']['public'];

        $query = self::find()->select('admin_id,admin_name,admin_mobile,admin_qq,admin_real,login_time,admin_email,created_at')->orderBy('login_time');

        $data = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => $pageSize]
        ]);
        $data->setSort([
            'attributes' => [
                /*=============*/
                'admin_mobile' => [
                    'asc' => ['admin_mobile' => SORT_ASC],
                    'desc' => ['admin_mobile' => SORT_DESC],
                ],
                'login_time' => [
                    'asc' => ['login_time' => SORT_ASC],
                    'desc' => ['login_time' => SORT_DESC],
                ],
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC]
                ]
                /*=============*/
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $data;
        }

        $query->andFilterWhere([
            'admin_qq' => $this->admin_qq,
        ]);
        $query->andFilterWhere(['like', 'admin_name', $this->admin_name]);
        $query->andFilterWhere(['like', 'admin_mobile', $this->admin_mobile]);

        return $data;
    }
}