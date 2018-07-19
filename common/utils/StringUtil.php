<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/6/25 0025
 * Time: 22:48
 */

namespace common\utils;


class StringUtil
{
    /**
     *
     * 剔除html中的标签已经空格,多用于截取文章简介
     *
     * @param $string
     * @return null|string|string[]
     */
    public static function html_tags(String $string)
    {
        $html = strip_tags($string);
        $pattern = '/\s/';
        return preg_replace($pattern,'',$html);
    }

}