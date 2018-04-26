<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/21 0021
 * Time: 18:31
 */

namespace backend\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Common extends ActiveRecord
{
    protected $before_in = ['created_at','updated_at'];
    protected $before_up = ['updated_at'];
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    # 创建之前
                    ActiveRecord::EVENT_BEFORE_INSERT => $this->before_in,
                    # 修改之前
                    ActiveRecord::EVENT_BEFORE_UPDATE => $this->before_up
                ],
                #设置默认值
                'value' => time()
            ]
        ];
    }
}