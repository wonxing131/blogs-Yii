<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "blog_admin".
 *
 * @property int $admin_id 管理员id
 * @property string $admin_name 管理员帐号
 * @property string $admin_pass 管理员密码
 * @property string $original_pass 不加密密码
 * @property string $admin_email 管理员邮箱
 * @property string $admin_real 真实姓名
 * @property string $admin_mobile 管理员手机号
 * @property string $admin_qq 管理员QQ号
 * @property string $login_time 上次登录时间
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login_time'], 'safe'],
            [['created_at', 'updated_at'], 'integer'],
            [['admin_name'], 'string', 'max' => 32],
            [['admin_pass'], 'string', 'max' => 64],
            [['original_pass', 'admin_email'], 'string', 'max' => 128],
            [['admin_real'], 'string', 'max' => 62],
            [['admin_mobile'], 'string', 'max' => 11],
            [['admin_qq'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'admin_name' => 'Admin Name',
            'admin_pass' => 'Admin Pass',
            'original_pass' => 'Original Pass',
            'admin_email' => 'Admin Email',
            'admin_real' => 'Admin Real',
            'admin_mobile' => 'Admin Mobile',
            'admin_qq' => 'Admin Qq',
            'login_time' => 'Login Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
