<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a modern responsive CSS framework based on Material Design by Google. ">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/hlj.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="images/hlj.png">
    <link rel="icon" href="images/hlj.png" sizes="32x32">
    <!--  Android 5 Chrome Color-->
    <meta name="theme-color" content="#EE6E73">
    <!-- CSS-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <?= Html::csrfMetaTags() ?>
    <?php $general = \app\models\GeneralInfo::findOne(1);?>
     <?php if(sizeof($general)!=0):?>
    <title><?=$general->title;?></title>
    <?php endif?>
    <style>
    html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;

}</style>

    <?php $this->head() ?>
</head>
<body>
<?php  $count = \app\models\Complaint::find()->andWhere(['is_seen' => null])->count(); $this->beginBody() ?>
<main>
        <div class="wrap" style="left-margin:1000px !important">
        <?php if (!Yii::$app->user->isGuest):?>
            <header>
              <div class="container"><a href="#" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light circle hide-on-large-only"><i class="mdi-navigation-menu"></i></a></div>
                <ul id="nav-mobile" class="side-nav fixed">
                <li class="logo"><a id="logo-container" href="<?php echo Yii::getAlias('@web');?>" class="brand-logo" style="height:75px">
                    <img src ="<?=Yii::getAlias('@web').'/images/hlj.png'?>"  width="75px" height="75px"></a></li>
                <li class="bold active"><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Fgeneral' ?>" class="waves-effect waves-teal">Ерөнхий мэдээлэл</a></li>
                <li class="bold"><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Fbanner' ?>" class="waves-effect waves-teal">Баннер</a></li>
                <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header  waves-effect waves-teal">Мэдээ</a>
                      <div class="collapsible-body">
                        <ul>
                          <li><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Fcontent' ?>">Мэдээ удирдах</a></li>
                          <li><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Falbum' ?>">Зургийн цомог удирдах</a></li>
                          <li><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Ffaq' ?>">Түгээмэл асуулт удирдах</a></li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </li>
                <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                    <li class="bold"><a class="collapsible-header  waves-effect waves-teal">Цэс</a>
                      <div class="collapsible-body">
                        <ul>
                          <li><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Fmenu'?>">Динамик цэс</a></li>
                          <li><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Fstaticmenu' ?>">Статик цэс</a></li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                </li>
               
                <li class="bold"><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Flink'?>" class="waves-effect waves-teal">Холбоос</a></li>
                <li class="bold"><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Fcomplain'?>" class="waves-effect waves-teal">Санал хүсэлт<span class="new badge"><?=$count?></span></a></li>
                <li class="bold"><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Fchangepwd'?>" class="waves-effect waves-teal">Нууц үг солих</a></li>
                <li class="bold"><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Fusermanual'?>" class="waves-effect waves-teal">Гарын авлага</a></li>
                <li class="bold"><?= Html::a('Гарах<i class="material-icons right" style="margin-top:7px">lock_open</i>', ['site/logout'], ['class'=>'waves-effect waves-teal', 'data-method' => 'POST']) ?></li>
              </ul>
            </header>
        <?php endif?>
      
            <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
    </div>
</main>
  <!-- START FOOTER -->
    <footer class="">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <p style="text-align:center" >&copy; НХҮЕГ | Мэдээлэл технологийн төвд <img src="<?=Yii::getAlias('@web').'/images/heart-icon.png'?>" width="18px" height="18px" style="top-margin:5px !important"> -р кодлов  2016 он.</p>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
