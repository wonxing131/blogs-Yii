<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'vendor/font-awesome/css/font-awesome.min.css',
        'vendor/nprogress/nprogress.css',
        'vendor/animate.css/animate.min.css',
        'css/custom.min.css'
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    /**
     * 在最后添加CSS文件
     * @param object $view view文件
     * @param resource $cssFile css文件
     * @return mixed
     */
    public static function addCss($view,$cssFile)
    {
        return $view->registerCssFile($cssFile,[AppAsset::className(),'depends'=>'backend\assets\AppAsset']);
    }

    /**
     * 在最后添加JS文件
     * @param object $view view 文件
     * @param resource $jsFile js文件
     * @return mixed
     */
    public static function addScript($view,$jsFile)
    {
        return $view->registerJsFile($jsFile,[AppAsset::className(),'depends'=>'backend\assets\AppAsset']);
    }
}
