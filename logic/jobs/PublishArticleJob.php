<?php
/**
 * Created by PhpStorm.
 * User: L-dingtongchuan
 * Date: 2018/7/2
 * Time: 19:04
 */

namespace logic\jobs;


use backend\models\Article;
use yii\base\BaseObject;
use yii\queue\RetryableJobInterface;

class PublishArticleJob extends BaseObject implements RetryableJobInterface
{
    public $article_id;
    public $publishTime;
    public $ttr = 30;
    public $max_retries = 3;

    public function __construct($article_id, $publishTime)
    {
        parent::__construct();
        $this->article_id = $article_id;
        $this->publishTime = $publishTime;
    }


    public function execute($queue)
    {
        file_put_contents('/tmp/queue.log',date('y-m-d h:i:s',time()).':'.'到这就算出来了:'.PHP_EOL,FILE_APPEND);
        $cond = ['article_id' => $this->article_id];
        $article = Article::find()->where($cond)->one();
        if (empty($article)){
            //记录错误
            return 0;
        }
        if ($article->is_del != 4){
            //记录错误
            return 0;
        }

        $article->is_del = 2;
        $result = $article->save(false);
        if (!$result){
            //文章发布失败
        }
        return 0;

    }

    public function getTtr()
    {
        return $this->ttr;
    }

    public function canRetry($attempt, $error)
    {
        $retry  = ($attempt < $this->max_retries) && ($error instanceof \Exception);

        $ctx    = [
            "attempt" => $attempt,

            "message" => $error->getMessage()
        ];

        return $retry;
    }
}