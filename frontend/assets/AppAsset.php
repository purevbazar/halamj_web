<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/reset.css',
        'css/main-stylesheet.css',
        'css/lightbox.css', 
        "css/shortcode.css",
        "css/fonts.css", 
        "css/colors.css", 
        "css/ie-ancient.css", 
        "css/responsive.css",
        "css/camera.css", 
        "css/demo-settings.css",
        "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css",
        'http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic',
        'https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic-ext'
    ];
    public $js = [
        'js/jquery-latest.min.js',
        'js/theme-scripts.js',
        'js/lightbox.js',
     //   'js/demo-settings.js',
        'js/jquery.mobile.customized.min.js',
        'js/jquery.easing.1.3.js',
        'js/camera.js',
    ];
}