<style>
    html,
body {
    height: 100%;
}
html {
    display: table;
    margin: auto;
}
body {
    display: table-cell;
    vertical-align: middle;
}
</style>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<body class="cyan">
<div id="login-page" class="row">
     <div class="col s12 z-depth-4 card-panel">
            <?php $form = ActiveForm::begin(['id' => 'login-form','options' => ['method' => 'post']]); ?>
            <div class="row">
          <div class="input-field col s12 center">
            <img src="images/hlj.png" alt="" class="responsive-img valign profile-image-login" width="100px" height="100px">
            <p class="center login-form-text">Нийгмийн халамжийн хэлтсийн цахим хуудсыг удирдах</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <?= $form->field($model, 'username', ['template'=>'<i class="material-icons prefix">perm_identity</i>{input}{label}'])->textInput(['type'=>'text'])->label('Нэвтрэх нэр') ?>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <?= $form->field($model, 'password', ['template'=>'<i class="material-icons prefix">lock</i>{input}{label}'])->passwordInput(['type'=>'password'])->label('Нууц үг') ?>
          </div>
        </div>
        <div class="row" align="center">          
          <div class="input-field col s12 m12 l12  login-text">
             <?= $form->field($model, 'captcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className(),
                    ['siteKey' => '6LcgfxgTAAAAAHwp8I9GfNEF2kuM4kT0bupkKJ1y']
            )->label(false) ?>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
             <?= Html::submitButton('Login', ['class' => 'btn waves-effect waves-light col s12', 'name' => 'login-button']) ?>
          </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
  </div>
</body>

