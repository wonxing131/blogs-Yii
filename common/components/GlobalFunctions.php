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