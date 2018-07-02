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
        $job_id = $this->push_job($article_id, $job, $delay);
        if ($job_id > 0){
            //记录成功日志
        }else{
            //记录失败日志
        }
    }
}