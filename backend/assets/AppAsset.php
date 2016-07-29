<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

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
        'css/prism.css',
        'css/ghpages-materialize.css',
        'http://fonts.googleapis.com/css?family=Inconsolata',
        'http://fonts.googleapis.com/icon?family=Material+Icons',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',

    ];
    public $js = [
        'js/jquery-2.1.4.min.js',
        'js/jquery.timeago.min.js',
        'js/prism.js',
        'js/jade/lunr.min.js',
        'js/jade/lunr.min.js',
        'js/jade/search.js',
        'js/bin/materialize.js',
        'js/init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}