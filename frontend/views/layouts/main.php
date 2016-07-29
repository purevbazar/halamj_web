<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<!-- BEGIN html -->
<html lang = "en">
    <!-- BEGIN head -->
    <head>
        <?php $general = \app\models\GeneralInfo::findOne(1); ?>
        <?php if(sizeof($general)!=0):?>
         <title><?=$general->title?></title>
        <?php endif;?>
        <link rel="icon" href="images/hlj.png" sizes="32x32">
        <!-- Meta Tags -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link type="text/css" rel="stylesheet" href="css/reset.css" />
        <link type="text/css" rel="stylesheet" href="css/main-stylesheet.css" />
        <link type="text/css" rel="stylesheet" href="css/lightbox.css" />
        <link type="text/css" rel="stylesheet" href="css/shortcode.css" />
        <link type="text/css" rel="stylesheet" href="css/fonts.css" />
        <link type="text/css" rel="stylesheet" href="css/colors.css" />
        <!--[if lte IE 8]>
        <link type="text/css" rel="stylesheet" href="css/ie-ancient.css" />
        <![endif]-->
        <link type="text/css" rel="stylesheet" href="css/responsive.css" />
        <link type="text/css" rel="stylesheet" href="css/camera.css" />
        <!-- Demo Only -->
        <link type="text/css" rel="stylesheet" href="css/demo-settings.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>

        
    </head>
<body>
<?php $this->beginBody() ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="wrap">
        <!-- BEGIN .boxed -->
        <div class="boxed">
            
            <!-- BEGIN .header -->
            <div class="header">
                
                <!-- BEGIN .wrapper -->
                <div class="wrapper">
                    
                    <div class="header-logo">
                         <?php if(sizeof($general)!=0):?>
                            <!-- <h1><a href="index.html">Allegro</a></h1> -->
                            <img src="<?=str_replace("frontend","backend",Yii::getAlias('@web')).$general->header_photo; ?>" alt=""     width=300px height=100px/>
                         <?php endif?>
                    </div>
                    <div class="header-addons"><a href="/" style="  color: white;">Эхлэл |</a><a href="index.php?r=site%2Fsitemap" style="  color: white;"> Сайтын бүтэц |</a><a href="#" id="link" style="  color: white;"> Холбоо барих</a>

                        <div class="header-search"><br/>
                            <?php $form = ActiveForm::begin(['id' => 'myForm', 'action' => ['site/search'], 'method' => 'post']); ?>
                                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                                <input type="text" placeholder="Хайх үгээ бичнэ үү.." value="" class="search-input" name="string"/>
                                <input type="submit" value="Search" class="search-button" />
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                    
                <!-- END .wrapper -->
                </div>

                <div class="main-menu sticky">
                    
                    <!-- BEGIN .wrapper -->
                    <div class="wrapper">
                        <ul class="the-menu">
                         <li><a href="/">Нүүр хуудас</a></li>
                            <?php $menus = \app\models\Menu::find()->where(['parent_id'=>'0'])->all();?>
                            <?php foreach($menus as $menu):?>
                                    <?php if(strcmp($menu->is_static,'1')==0){
                                                $url = $menu->url;
                                                $print = "_blank";
                                                }else{$url = "index.php?r=site%2Fviewmenu&id=".$menu->menu_id; $print=""; }?>
                                    <li><a href="<?= $url?>" target="<?=$print?>"><?=$menu->menu_name?><i class="fa fa-sort-down" style='margin-top:4px; margin-left:2px'></i></a>
                                        <?php $sub_menu = \app\models\Menu::find()->where(['parent_id'=>$menu->menu_id])->orderBy(['menu_name' => SORT_ASC])->all();?>
                                        <ul>
                                        <?php foreach($sub_menu as $sub):?>
                                            <?php if(sizeof(\app\models\Menu::find()->where(['parent_id'=>$sub->menu_id])->orderBy(['menu_name' => SORT_ASC])->all())!=0){

                                                $first_arrow = "<span>";
                                                $second_arrow = "</span>";
                                            }
                                            else{
                                              
                                                $first_arrow = "";
                                                $second_arrow = "";   
                                            }
                                            ?><?php if(strcmp($sub->is_static,'1')==0){
                                                $url = "http://".$sub->url;
                                                $print = "_blank";
                                                }else{$url = "index.php?r=site%2Fviewmenu&id=".$sub->menu_id; $print=""; }?>
                                             <li><a href="<?= $url?>" target="<?=$print?>"><?=$first_arrow?><?=$sub->menu_name?><?=$second_arrow?></a>
                                            <?php $third_menu = \app\models\Menu::find()->where(['parent_id'=>$sub->menu_id])->orderBy(['menu_name' => SORT_ASC])->all();?>
                                                <ul>
                                                <?php foreach($third_menu as $third):?>
                                                    <?php if(strcmp($third->is_static,'1')==0){
                                                        $url = $sub->url;
                                                        $print = "_blank";
                                                        }else{$url = "index.php?r=site%2Fviewmenu&id=".$third->menu_id; $print=""; }?>
                                                   <li><a href="<?= $url?>" target="<?=$print?>"><?=$third->menu_name?></a> 
                                                <?php endforeach;?>
                                                </ul>
                                             </li> 

                                        <?php endforeach;?>
                                        </ul>  
                                    </li>                
                            <?php endforeach;?>


                        </ul>
                    <!-- END .wrapper -->
                    </div>

                </div>
                
            <!-- END .header -->
            </div>
            
            <!-- BEGIN .content -->
    <div class="content">
        <div class="container">
            <!-- BEGIN .wrapper -->
                    <div class="wrapper">
                        <br>
                        <div class="breaking-news">
                            <span class="the-title">Шуурхай мэдээ</span>
                            <ul><?php $model = \app\models\Content::find()->where(['is_breaking'=>1])->orderBy(['date' => SORT_DESC])->limit(3)->all(); foreach($model as $breaking):?>
                                <li><a href="index.php?r=site%2Fviewcontent&id=<?=$breaking->id?>"><?=$breaking->title?></a></li>
                            <?php endforeach;?>
                            </ul>
                        </div>

                    <?= $content ?>

                    <!-- END .wrapper -->
                    </div>
                <!-- BEGIN .content -->
        </div>
    </div>
    <div class="footer">
                 <?php if(sizeof($general)!=0):?>
                <!-- BEGIN .wrapper -->
                <div class="wrapper">
                        <div class="paragraph-row">
                            <div class="column5">
                                    <h4 style="color: #2277c6;">Холбоо барих</h4>
                                    <ol class=""  style="color: black;">
                                        <li>
                                             <div class="paragraph-row">
                                                <div class="column1">
                                                    <i class="fa fa-map-marker fa-2x"></i>
                                                </div>
                                                <div class="column10">
                                                   <?=$general->address?>
                                                </div>
                                            </div> 
                                        </li>
                                        <br>
                                        <li>
                                             <div class="paragraph-row">
                                                <div class="column1">
                                                    <i class="fa fa-phone  fa-2x"></i>
                                                </div>
                                                <div class="column10">
                                                   <?=$general->contact_phone?>
                                                </div>
                                            </div> 
                                        </li>
                                        <br>
                                        <li>
                                             <div class="paragraph-row">
                                                <div class="column1">
                                                    <i class="fa fa-fax  fa-2x"></i>
                                                </div>
                                                <div class="column10">
                                                   <?=$general->fax?>
                                                </div>
                                            </div> 
                                        </li>
                                        <br>
                                         <li>
                                             <div class="paragraph-row">
                                                <div class="column1">
                                                    <i class="fa fa-send  fa-2x"></i>
                                                </div>
                                                <div class="column10">
                                                   <?=$general->email?>
                                                </div>
                                            </div> 
                                        </li>                                                                  
                                    </ol>                     
                            </div>
                        <?php endif;?>
                            <h4 style="color: #2277c6;">Салбар хэлтсүүд</h4>
                            <div class="column2">
                                <ol> 
                                    <a href='http://www.arkhangai.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Архангай</li></a>
                                    <a href='http://www.bayan-olgii.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Баян-Өлгий</li></a>
                                    <a href='http://www.bulgan.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Булган</li></a>
                                    <a href='http://www.govi-altai.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Говь-Алтай</li></a>
                                    <a href='http://dundgovi.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Дундговь</li></a>
                                    <a href='http://dornod.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Дорнод</li></a>
                                    <a href='http://dornogovi.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Дорноговь</li></a>
                                    <a href='http://zavkhan.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Завхан</li></a>
                                    <a href='http://ovorkhangai.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Завхан</li></a>
                                </ol>                   
                            </div>
                            <div class="column2">
                                <ol>
                                    <a href='http://omnogovi.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Өмнөговь</li></a>
                                    <a href='http://uvs.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Увс</li></a>
                                    <a href='http://khovd.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Ховд</li></a>
                                    <a href='http://khovsgol.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Хөсгөл</li></a>
                                    <a href='http://khentii.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Хэнтий</li></a>
                                    <a href='http://darkhan-uul.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Дархан</li></a>
                                    <a href='http://orkhon.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Орхон</li></a>
                                    <a href='http://govisumber.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Говьсүмбэр</li></a>                                    
                                </ol>                   
                            </div>
                            <div class="column2">
                                <ol>
                                    <a href='http://ub.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Нийслэл</li></a>
                                    <a href='http://han-uul.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Хан-Уул</li></a>
                                    <a href='http://baganuur.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Багануур</li></a>
                                    <a href='http://bayanzurh.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Баянзүрх</li></a>
                                    <a href='http://nalaih.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Налайх</li></a>
                                    <a href='http://bgd.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Баянгол</li></a>
                                    <a href='http://sbd.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Сүхбаатар</li></a>
                                    <a href='http://chingeltei.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Чингэлтэй</li></a>
                                    <a href='http://bagahangai.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Баганхангай</li></a>
                                    <a href='http://songinohairhan.halamj.gov.mn' target="_blank"><li><i class="fa fa-dot-circle-o fa-1x" style='margin-top:5px'></i> Сонгинохайрхан</li></a>                                      
                                </ol>                   
                            </div>
                         </div>
                <!-- END .wrapper -->
                </div>
                          <footer class="site-footer" style="text-align:center">
  НХҮЕГ | Мэдээлэл технологийн төв 2016 он.
</footer>
    </div>
</div>


            <!-- END .footer -->
            </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

