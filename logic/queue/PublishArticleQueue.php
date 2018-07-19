<?php
/**
 * Created by PhpStorm.
 * User: L-dingtongchuan
 * Date: 2018/7/2
 * Time: 19:18
 */

namespace logic\queue;


use logic\jobs\PublishArticleJob;

class PublishArticleQueue extends AsyncQueue
{
    public function __construct()
    {
        $this->_name = 'qparticle';
        parent::__construct();
    }

    public function push($article_id, $publishTime)
    {
        $job    = new PublishArticleJob($article_id, $publishTime);
        $sendTime = strtotime($publishTime);
        if ($sendTime >= time()){
            $delay = $sendTime - time();
        }else{
            $delay = 0;
        }
        file_put_contents('/tmp/queue.log',date('y-m-d h:i:s',time()).':'.'步骤二 : '.$delay.PHP_EOL,FILE_APPEND);
        $job_id = $this->push_job($article_id, $job, $delay);
        if ($job_id > 0){
            file_put_contents('/tmp/queue.log',date('y-m-d h:i:s',time()).':'.'队列入成功任务号:'.$job_id.PHP_EOL,FILE_APPEND);
            //记录成功日志
        }else{
            file_put_contents('/tmp/queue.log',date('y-m-d h:i:s',time()).':'.'队列入失败:'.$job_id.PHP_EOL,FILE_APPEND);
            //记录失败日志
        }
    }

}