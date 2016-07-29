<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
?>
<!--  Outer row  -->
  <div class="row">
    <div class="col s12 m9 l10">
      <!--  Material Design -->
          <div id="materialdesign" class="section scrollspy">
            <h2>Байгууллагын ерөнхий мэдээлэл</h2>
            <p class="caption"></p>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'my-form', 'action' => ['site/generalsubmit'], 'options' => ['enctype' => 'multipart/form-data'], 'method' => 'post']); ?>
        <form class="col s12">
            <div class="row">
              <div class="input-field col s6">
                <?= $form->field($model, 'title')->textInput(['type'=>'text', 'id'=>'T1', 'data-position'=>"bottom" ,'data-delay'=>"50" ,'data-tooltip'=>"Цахим хуудасны гарчигыг оруулна уу, Жишээ нь : Сүхбаатар аймаг | НХҮХ", 'class'=>'tooltipped', 'name'=>'title'])->label('Цахим хуудасны гарчиг') ?>
              </div>
              <div class="input-field col s6">
                    <?= $form->field($model, 'facebook_url')->textInput(['type'=>'text', 'data-delay'=>"50" ,'data-tooltip'=>"Facebook page-ийн хаяг, Жишээ нь : https://www.facebook.com/pages/%D0%9D%D0%B8%D0%B9%D0%B", 'class'=>'tooltipped', 'name'=>'facebook'])->label('Facebook хаяг') ?>
              </div>
            </div>
            <div class="row">
                <div class="input-field col s3">
                    <?= $form->field($model, 'youtube_url', ['template'=>'<i class="material-icons prefix">play_arrow</i>{input}{label}'])->textInput(['type'=>'text',  'data-position'=>"bottom" ,'data-delay'=>"50" ,'data-tooltip'=>"Youtube дээрх embed кодыг оруулна. Жишээ нь https://www.youtube.com/embed/450p7goxZqg", 'class'=>'tooltipped', 'name'=>'youtube'])->label('Youtube хаяг') ?>
                </div>
                <div class="input-field col s2">
                    <?= $form->field($model, 'google_gps', ['template'=>'<i class="material-icons prefix">language</i>{input}{label}'])->textInput(['type'=>'text', 'id'=>'T2', 'data-delay'=>"50" ,'data-tooltip'=>"Google maps дээрх хэлтсийн байршлын уртраг өргөргийн солбицолыг олж дараах форматаар авч хооронд нь оруулахдаа зай авалгүй таслал оруулна , Жишээ нь : 47.919151,106.924547", 'class'=>'tooltipped',  'name'=>'google'])->label('Солбицол') ?>
                </div>
                <div class="input-field col 2">
                    <?= $form->field($model, 'fax', ['template'=>'<i class="material-icons prefix">print</i>{input}{label}'])->textInput(['type'=>'text', 'id'=>'T9', 'data-tooltip'=>"Байгуулагын факс", 'class'=>'tooltipped','name'=>'fax'])->label('Факс') ?>
                </div>
                 <div class="input-field col s2">
                    <?= $form->field($model, 'contact_phone', ['template'=>'<i class="material-icons prefix">phone</i>{input}{label}'])->textInput(['type'=>'text', 'id'=>'T3', 'data-tooltip'=>"Байгуулагатай холбоо барих утас", 'class'=>'tooltipped','name'=>'phone'])->label('Утасны дугаар') ?>
                </div>
                <div class="input-field col s2">
                    <?= $form->field($model, 'email', ['template'=>'<i class="material-icons prefix">email</i>{input}{label}'])->textInput(['type'=>'text', 'id'=>'T3', 'data-tooltip'=>"Байгуулагын цахим хаяг", 'class'=>'tooltipped','name'=>'email'])->label('Цахим хаяг') ?>
                </div>
            </div>
            <div class="row">
                <div class="status-form">
                    <?= \yii\redactor\widgets\Redactor::widget([ 'name'=>'greeting', 'value'=>$model->greeting,  'id'=>'T4',]) ?>
                </div>
            </div>
            <div class="row">
              <div class="input-field col s8">
                <div class="file-field input-field">
                  <div class="btn tooltipped" data-delay="50" data-tooltip='Нүүр хуудсан дээрх том лого. Зөвхөн дараах өргөтгөлтэй файлууд оруулж боломжтойг анхаарна уу! [ .jpg, .jpeg, .png, .gif ]'>
                    <span>Бэлгэ тэмдэг</span>
                        <?= $form->field($models, 'imageFile')->fileInput(['id'=>'imgInp'])->label(false); ?>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate"  type="text"  id='T5' value='<?php if(strlen($model->header_photo)==0){echo Yii::getAlias('@web').'/images/hlj.png'; }else{echo Yii::getAlias('@web').$model->header_photo;}?>'>
                  </div>
                </div>
              </div>
              <div class="input-field col s4">
                    <img id="blah" alt="your image" width="300px" height="100px" src="<?php if(strlen($model->header_photo)==0){echo Yii::getAlias('@web').'/images/hlj.png'; }else{echo Yii::getAlias('@web').$model->header_photo;}?>" width="250" class="materialboxed"/>
              </div>
            </div>
         <!--    <div class="row">
              <div class="input-field col s8">
                <div class="file-field input-field">
                  <div class="btn tooltipped" data-delay="50" data-tooltip='Интернет хөтчийн tab дээр гарах жижиг лого. Зөвхөн [ .ico, .jpg, .jpeg, .png ] өргөтгөлтэй файл оруулах боломжтойг анхаарна уу! '>
                    <span>Жижиг Бэлгэ тэмдэг</span>
                      <?= $form->field($models, 'favicon')->fileInput(['id'=>'imgInp2', 'value'=>Yii::getAlias('@web').'/images/hlj.png'])->label(false); ?>
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate"  type="text" id='T6' value='<?php if(strlen($model->favicon)==0){echo Yii::getAlias('@web').'/images/hlj.png'; }else{echo Yii::getAlias('@web').$model->favicon;}?>'>
                  </div>
                </div>
              </div>
              <div class="input-field col s4">
                    <img id="blah2" alt="your image" width="50px" height="50px" src="<?php if(strlen($model->favicon)==0){echo Yii::getAlias('@web').'/images/hlj.png'; }else{echo Yii::getAlias('@web').$model->favicon;}?>" width="250" class="materialboxed"/>
              </div>
            </div> -->
             <div class="row">
              <div class="input-field col s10">
                   <?= $form->field($model, 'address')->textArea([ 'class'=>'materialize-textarea', 'name'=>'address'])->label('Байгууллагын хаяг') ?>
              </div>
             </div>
            <div class="form-group" hidden>
                    <?= Html::submitButton('Оруулах', ['class' => 'btn btn-primary', 'id'=>'SubmitForm', 'name' => 'contact-button']) ?>
                </div><?php ActiveForm::end(); ?>
                <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large waves-effect waves-light red" href="#" onclick="document.getElementById('SubmitForm').click()"><i class="material-icons">add</i></a>
      </div>
        </form>
    </div>
  </div

  <?php

$javaScript = <<< JS

  $(document).ready(function () {

 function readURL(input) {
      
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL2(input) {
      
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah2').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });

$("#imgInp2").change(function(){
        readURL2(this);
    });

    $('#SubmitForm').click(function(){
       if (!document.getElementById('T1').value || !document.getElementById('T2').value || !document.getElementById('T3').value || !document.getElementById('T4').value || !document.getElementById('T5').value){
          alert('Талбаруудыг бүрэн бөглөнө үү!');
            return(false);
            }
    });
});

JS;


$this->registerJs($javaScript,  $this::POS_LOAD)
?>

