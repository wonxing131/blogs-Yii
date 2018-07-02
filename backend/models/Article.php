<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/5/12 0012
 * Time: 14:13
 */

namespace backend\models;


use common\utils\StringUtil;
use logic\queue\PublishArticleQueue;
use yii\helpers\Markdown;

class Article extends Common
{

    public $sendTime;

    public function rules()
    {
        return [
            ['title','required','message'=>'请填写标题'],
            ['title','unique','message'=>'该文章标题已经存在','filter'=>function($query){
                if (!$this->isNewRecord){
                    $query->andWhere('not',['article_id'=>$this->articler_id]);
                }
            }],
            ['title','string','length'=>[4,15],'message'=>'标题格式为4-15个字符长度'],
            ['category_id','required','message'=>'请选择文章分类'],
            ['category_id','isEnd'],
            ['content','required','message'=>'请填写文章内容'],
            ['content','formatCont'],
            ['article_label_id','required','message'=>'请选择文章标签'],
            ['article_label_id','formatLabel'],
            ['is_del','required','message'=>'请选择是否发布'],
            ['is_del','in','range'=>[2,3,4],'message'=>'请正确选择发布状态'],
            ['sendTime','checkTime','message'=>'请正确选择发布时间'],
            ['is_del','isQueue']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title'             => '文章标题',
            'category_id'       => '所属分类',
            'intro'             => '文章简介',
            'content'           => '文章内容',
            'article_label_id'  => '文章标签',
            'is_del'            => '是否显示',
            'sendTime'          => '发布时间'
        ];
    }
    public function add($post)
    {
        if ($this->load($post) && $this->validate()){
            return (bool)$this->save(false);
        }
    }

    //验证当前所选分类是否为最终分类
    public function isEnd()
    {
        if (!$this->hasErrors() && Category::findOne(['parent_id'=>$this->category_id])){
            $this->addErrors(['category_id'=>'请选择最下级分类']);
        }
        return true;
    }

    //将markdown内容格式化之后存储到数据库 以及生成文章简介
    public function formatCont()
    {
        if (!$this->hasErrors()){
            $this->content = Markdown::process($this->content);
            $this->intro = mb_substr(StringUtil::html_tags($this->content),0,80);
        }
    }

    //格式化文章标签 以id串形式存储
    public function formatLabel()
    {
        if (!$this->hasErrors()){
            $this->article_label_id = implode(',',$this->article_label_id);
        }
    }

    //将文章信息添加入队列
    public function isQueue()
    {
        if (!$this->hasErrors() && $this->is_del == 4){
            if (!$this->sendTime){
                $this->addErrors(['is_del'=>'请填写发送时间']);
            }
        }
        return true;
    }

    //验证发送时间
    public function checkTime()
    {
        if (!$this->hasErrors() && $this->is_del == 4){
            if (empty($this->sendTime)) {
                $this->addError('sendTime', ['请填写发送时间']);
            }else{
                //验证是否为正确时间格式
                $dateTime = strtotime($this->sendTime);
                if (date('Y-m-d H:i:s',$dateTime) == $this->sendTime){
                    if ($dateTime <= time()){
                        $this->is_del = 2;
                    }
                }else{
                    $this->addError('sendTime',['请填写正确时间格式']);
                }
            }
        }
        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $publish    =  $this->sendTime;
        $article_id = \Yii::$app->db->getLastInsertID();
        $queue = new PublishArticleQueue();
        $queue->push($article_id, $publish);
    }
}