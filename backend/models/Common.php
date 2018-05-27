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

    /**
     * 返回验证失败第一条错误信息
     *
     * @param object $model 当前model实例
     * @return int|string
     */
    public function firstError($model)
    {
        $errors = $model->getErrors();
        if (!is_array($errors)){
            return '';
        }else{
            $error = array_shift($errors);
            return array_shift($error);
        }
    }

    /**
     *
     * 获取设置的pageSize,若未设置返回默认设置
     *
     * @param string $key 数组键值
     * @return int  pageSize
     */
    public function getPageSize($key = 'public')
    {
        return isset(\Yii::$app->params['pageSize'][$key]) ? \Yii::$app->params['pageSize'][$key] : \Yii::$app->params['pageSize']['public'];
    }
}