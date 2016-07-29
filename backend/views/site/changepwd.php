<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<!--  Outer row  -->
  <div class="row">
    <div class="col s12 m9 l10">
      <!--  Material Design -->
          <div id="materialdesign" class="section scrollspy">
            <h2>Нууц үгээ солих</h2>
            <p class="caption"></p>
              <div class="row">
                <div class="input-field col s6">
                <?php $form = ActiveForm::begin(['id' => 'my-form', 'action' => ['site/chngpwd'], 'options' => ['enctype' => 'multipart/form-data'], 'method' => 'post']); ?>
                  <?= $form->field($modeluser, 'username')->textInput(['type'=>'text', 'id'=>'T0', 'data-position'=>"bottom" ,'data-delay'=>"50" ,'data-tooltip'=>'Одоогийн ууц үг', 'name'=>'current_pwd'])->label('Одоогийн нууц үг') ?>
                  <p style="color:red"><?=$errorMessage;?></p>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                      <?= $form->field($modeluser, 'password_hash')->textInput(['type'=>'text', 'data-delay'=>"50" , 'id'=>'T1','name'=>'new_pwd'])->label('Шинэ нууц үг') ?>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s6">
                      <?= $form->field($modeluser, 'password_hash')->textInput(['type'=>'text', 'data-delay'=>"50" ,'id'=>'T2', 'name'=>''])->label('Шинэ нууц үг давт') ?>
                </div>
              </div>
          </div>
          <br><br><br><br><br> <div class="divider"></div><br>
              <?= Html::submitButton('Солих', ['class' => 'btn btn-primary z-depth-5', 'id'=>'SubmitForm', 'name' => 'contact-button']) ?>
                <?php ActiveForm::end(); ?>
    </div>
  </div>

<?php

$javaScript = <<< JS

     $('#SubmitForm').click(function(){
       if (!document.getElementById('T1').value || !document.getElementById('T2').value || !document.getElementById('T0').value ){
          alert('Талбаруудыг бүрэн бөглөнө үү!');
          return(false);
            }
            else if (document.getElementById('T1').value!=document.getElementById('T2').value)
              {
                alert("Шинэ нууц үгүүд ижил биш байна!");
                return(false);
              }
    });

JS;
$this->registerJs($javaScript,  $this::POS_END)
?>


