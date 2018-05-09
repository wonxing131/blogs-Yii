<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/4/21 0021
 * Time: 17:41
 */

/**
 * 打印内容 用于调试
 *
 * @param string|array|object|int|float $param
 *
 */
function dd($param)
{
    echo '<pre>';
    var_dump($param);
    echo '</pre>';
}

/**
 * 生成找回密码token
 *
 * @param string $email 用户邮件
 * @param string $salt 加密字符串
 * @param int $time 对应时间戳
 * @return string 返回加密字符串
 */
function generateFindPassToken($email,$salt,$time)
{
    return sha1(md5($email.md5($email.$time).md5(sha1($salt.$time))));
}