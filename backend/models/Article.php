<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/5/12 0012
 * Time: 14:13
 */

namespace backend\models;


class Article extends Common
{

    public function attributeLabels()
    {
        return [
            'title'             => '文章标题',
            'category_id'       => '所属分类',
            'intro'             => '文章简介',
            'content'           => '文章内容',
            'article_label_id'  => '文章标签',
            'is_del'            => '是否显示'
        ];
    }
}