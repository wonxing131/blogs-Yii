<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/5/2 0002
 * Time: 21:02
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\web\ServerErrorHttpException;

class ProcessController extends Controller
{

    /**
     * 定时执行发送邮件队列
     *
     * @param $db
     * @param $key
     * @throws ServerErrorHttpException
     */
    public function actionSendEmail($db,$key)
    {
        $redis = Yii::$app->redis;
        if (empty($redis)){
            throw new ServerErrorHttpException('redis server not found');
        }
        if ($redis->select($db) && $message = $redis->lrange($key,0,-1)){
            foreach ($message as $k => $v){
                //将数据从队列中删除
                $redis->lrem($key,-1,$v);
                //获取邮件地址以及区分角色
                $value_arr = explode('^%^*',$v);
                $email = $value_arr[0];
                $send_type = $value_arr[1];
                //生成token
                $time = time();
                $token = generateFindPassToken($email,Yii::$app->params['findPassSale']['admin'],$time);
                $mailer = Yii::$app->mailer->compose(Yii::$app->params['email_layout'][$send_type],['email'=>$email,'token'=>$token,'baseUrl'=>Yii::$app->params['baseUrl'][$send_type]]);
                $mailer->setFrom('15590860585@163.com');    //发件人邮箱
                $mailer->setTo($email);    //收件人邮箱
                $mailer->setSubject('桐汌博客-找回密码');
                $mailer->send();

//                将发送日志添加到数据库中
                $sql = "INSERT INTO blog_email_log(email,send_type,token,created_at) VALUES ('".$email."',$send_type,'".$token."',$time)";
                try{
                    Yii::$app->db->createCommand($sql)->execute();
                }catch (\Exception $e){
                    //出错，记录到错误日志中
                    dd($e->getMessage());
                }
            }
        }
    }
}