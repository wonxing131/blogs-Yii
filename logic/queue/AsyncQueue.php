<?php
/**
 * Created by PhpStorm.
 * User: L-dingtongchuan
 * Date: 2018/6/28
 * Time: 16:46
 */

namespace logic\queue;
use Yii;

class AsyncQueue
{
    //定义工作状态映射
    static public $jobStatusMap = [
        'Waiting'       => 0,       //等待
        'Received'      => 0,       //接收
        'Timeout'       => 1,       //延迟
        'NoExist'       => 2,       //不存在
        'Done'          => 3,       //做
    ];

    protected $_queue   = null;     //队列
    protected $_name   = null;      //队列名称
    protected $_timeout = 300;      // max timeout of items in hashset
    private $_redis;

    public function __construct()
    {
        $this->_redis = Yii::$app->redis;
        $this->_redis->database = 0;
        if (empty($this->_queue)){
            $this->_queue = Yii::$app->queue;
        }
    }

    protected function push_job($key, $job_obj, $delay = 0)
    {
        if ($this->check_key($key) == 0){
            return 0;
        }
        if ($delay > 0){
            $job_id = $this->_queue->delay($delay)->push($job_obj);
        }else{
            $job_id = $this->_queue->push($job_obj);
        }
        if ( ! $this->_queue->isDone($job_id)){

            $data = json_encode(['ts' => time(),'job' => $job_id, 'count' => 0]);
            $this->_redis->hset($this->_name, $key, $data);
            $this->_redis->expire($this->_name, 600);
        }

    }

    protected function check_key($key)
    {
        $data   = $this->_redis->hget($this->_name, $key);    //获取内容
        if (empty($data)){
            return self::$jobStatusMap['NoExist'];
        }
        $data       = json_decode($data,true);
        $job_id     = $data['job'];
        $job_ts     = $data['ts'];
        $job_cnt    = $data['count'];

        $curr = time();
        if ($curr - $job_ts < 0 || $curr - $job_ts > $this->_timeout){
            if (!$this->_queue->isDone($job_id)){
                //记录日志
                $job_cnt += 1;

                $data['job']    = $job_id;
                $data['ts']     = time();
                $data['count']  = $job_cnt;

                $this->_redis->hset($this->_name,$key,json_encode($data));
                $this->_redis->expire($this->_name, 600);

                return 0;
            }

            $this->_redis->hdel($this->_name, $key);

            return self::$jobStatusMap['Timeout'];
        }

        if ($this->_queue->isDone($job_id)) {

            $this->_redis->hdel($this->_name, $key);

            return self::$jobStatusMap['Done'];
        }

        $job_status = $this->_queue->status($job_id);
        return 0;

    }



}