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
            <h2>Холбоос засах</h2>
            <p class="caption"></p>
        </div>
         <?php  $form = ActiveForm::begin(['id' => 'my-form' , 'options' => ['enctype' => 'multipart/form-data'], 'action' => ['site/editlink'],  'method' => 'post']); ?>
            <div class="row">
              <div class="input-field col s6"><div hidden><input type="text" value="<?=$model->link_id?>" name="id"></div>
                <?= $form->field($model, 'link_url')->textInput(['type'=>'text', 'class'=>'validate', 'id'=>'T1', 'name'=>'content_title'])->label('Холбоос') ?>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s5">
                <div class="file-field input-field">
                      <div class="btn">
                        <span>Толгой зураг</span>
                          <?= $form->field($models, 'imageFile')->fileInput(['id'=>'imgInp'])->label(false); ?>
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate"  type="text" value="<?=$model->link_pic?>" id="img">
                      </div>
                  </div>
              </div>
              <div class="input-field col s2"></div>
              <div class="input-field col s5">
                          <img id="blah" src="<?=Yii::$app->request->baseUrl.$model->link_pic; ?>" alt="your image"  width="250" class="materialboxed"/>
              </div>
            </div>
        </div>
        <div class='divider'></div>
        </div><br><br><br><br><br> <div class="divider"></div><br>
              <?= Html::submitButton('Засах', ['class' => 'btn btn-primary z-depth-5', 'name' => 'contact-button', 'id'=>'SubmitForm']) ?>
              <?= Html::a('Устгах', ['site/linkdelete', 'id' => $model->link_id], ['class' => 'btn btn-danger z-depth-5', 'data-confirm' => Yii::t('yii', 'Устгах уу?'),]) ?>
        <?php ActiveForm::end(); ?>
         
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
       if (!document.getElementById('T1').value || !document.getElementById('img').value) {
          alert('Талбаруудыг бүрэн бөглөнө үү!');
            return(false);
            }
    });
});

JS;

$this->registerJs($javaScript,  $this::POS_LOAD)
?>
