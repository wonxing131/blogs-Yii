<?php
/**
 * Created by PhpStorm.
 * User: dingt
 * Date: 2018/5/12 0012
 * Time: 16:08
 */

namespace backend\controllers;

use Yii;
class DumpController extends BaseController
{
    public function actionBackup()
    {
        //循环查出所有的表结构
        $dump_sql = '';
        $query = Yii::$app->db;
        $table_show_sql = "show tables";
        $table_show = $query->createCommand($table_show_sql)->queryAll();   //查询所有数据表的名称
        foreach ($table_show as $k => $v){
            //遍历查询所有表的创建语句
            $table_create_sql = "show create table ".$v['Tables_in_blog'];
            $table_create = $query->createCommand($table_create_sql)->queryAll();
            //将查询表数据拼接成字符串
            $dump_sql .= $table_create[0]['Create Table'];
            //查询表中所有数据
            $data_sql = "select * from ".$v['Tables_in_blog'];
            $data = $query->createCommand($data_sql)->queryAll();
            //循环所有数据 拼接成添加语句
            foreach ($data as $k1 => $v1){

            }
        }
    }

    public function actionExport()
    {

    }
}