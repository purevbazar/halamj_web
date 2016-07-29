<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<!--  Outer row  -->
  <div class="row">
    <div class="col s12 m9 l10">
      <!--  Material Design -->
        <div id="materialdesign" class="section scrollspy">
            <h2>Мэдээ засах</h2>
            <p class="caption"></p>
        </div>
         <?php  $form = ActiveForm::begin(['id' => 'my-form' , 'options' => ['enctype' => 'multipart/form-data'], 'action' => ['site/editcontent'],  'method' => 'post']); ?>
            <div class="row">
              <div class="input-field col s6">
                <?= $form->field($model, 'title')->textInput(['type'=>'text', 'class'=>'validate', 'id'=>'T1', 'name'=>'T1'])->label('Мэдээний гарчиг') ?>
              </div>
              <div class="input-field col s6">
                <div class="file-field input-field">
                      <div class="btn">
                        <span>Толгой зураг</span>
                          <?= $form->field($models, 'imageFile')->fileInput(['id'=>'imgInp'])->label(false); ?>
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate"  type="text"  id='T2' name="T2">
                      </div>
                    </div>
              </div>
            </div>
            <div class="row">
                <div class="input-field col s6"><?php $static = array("0"=>"Холбогдох цэс");?>
                  <?= $form->field($model, 'date')->textInput(['type'=>'date', 'class'=>'datepicker', 'id'=>'T3', 'name'=>'T3'])->label('Огноо') ?><br>
                  <?= $form->field($model, 'menu_id')->dropDownList($static+ArrayHelper::map(\app\models\Menu::find()->orderBy('menu_name')->all(), 'menu_id', 'menu_name'), ['name'=>'T4' ,'id'=>'T4', 'options'=>['0'=>['disabled'=>true], $model->menu_id=>['Selected'=>'selected']]])->label(false); ?><br>
                  <?= $form->field($model, 'media_type')->dropDownList(['0' => 'Мэдээний төрөл' , '1' => 'Онцлох /нүүр хуудсан дээр гарна', '2' => 'Энгийн'],  ['name'=>'T5', 'id'=>'T5', 'options'=>['0'=>['disabled'=>true], $model->media_type=>['Selected'=>'selected'] ]])->label(false); ?>
                </div>
                <div class="input-field col s6">
                     <img id="blah" src="<?php if(strlen($model->title_photo)==0){echo Yii::getAlias('@web').'/images/hlj.png'; }else{echo Yii::getAlias('@web').'/'.$model->title_photo;}?>" alt="your image" width="250" class="materialboxed"/>
                </div>
            </div
            <div class="row">
                  <div class="status-form">
                    <?= \yii\redactor\widgets\Redactor::widget([ 'name'=>'T6', 'id'=>'T6', 'value'=>str_replace("/files",str_replace("frontend","backend",Yii::getAlias('@web').'/uploads/files'),$model->description)]) ?>
                </div>
            </div>
        </div>
            <div hidden><input type="text" value="<?=$model->id;?>" name="T0">
              <?= Html::submitButton('Засах', ['class' => 'btn btn-primary z-depth-5', 'id'=>'SubmitForm', 'name' => 'contact-button']) ?>
              <?= Html::a('Устгах', ['site/contentdelete', 'id' => $model->id], ['id'=>'delete','class' => 'btn btn-danger z-depth-5', 'data-confirm' => Yii::t('yii', 'Устгах уу?'),]) ?>
              </div>
        <?php ActiveForm::end(); ?>
           <!-- Floating Action Button -->
                    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
                        <a class="btn-floating btn-large waves-effect waves-light blue" href="#" id='T99' onclick="document.getElementById('SubmitForm').click()">
                         <i class="material-icons">edit</i>
                        </a>
                        <ul>
                          <li><a href="#" onclick="document.getElementById('delete').click()" class="btn-floating red"><i class="material-icons">delete</i></a></li>
                        </ul>
                    </div>
    </div>
  </div>


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
    
    $("#imgInp").change(function(){
        readURL(this);
    });

  $('#SubmitForm').click(function(){
    if($( "#T5" ).val()=='1'){
      if(!document.getElementById('T2').value){
        alert('Нүүр хуудсанд мэдээ хийхэд заавал зураг сонгох шаардлагатай!');
        return(false);
      }
    }
         if (!document.getElementById('T1').value ||  !document.getElementById('T3').value || !document.getElementById('T6').value){
            alert('Талбаруудыг бүрэн бөглөнө үү!');
              return(false);
              }
      });
});

JS;

$this->registerJs($javaScript,  $this::POS_LOAD)
?>
