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
            <h2>Түгээмэл асуугддаг асуултууд</h2>
            <p class="caption"></p>
        </div>
         <div class="col s12 m8 l9">
            <?php $form = ActiveForm::begin(['id' => 'my-form2', 'action' => ['site/editfaq'],  'method' => 'post' , 'options' => ['enctype' => 'multipart/form-data']]);?>
            <div class="row"><div hidden><input type="text" value="<?=$model->id?>" name="id"></div>
             <div class="input-field col s12">
                    <?= $form->field($model, 'question')->textInput(['type'=>'text', 'value'=>$model->question, 'class'=>'validate', 'name'=>'question'])->label('Асуулт') ?>
                  </div>
                </div>
                <div class="row">
                   <div class="input-field col s12">
                     <?= \yii\redactor\widgets\Redactor::widget([ 'name'=>'answer', 'value'=>$model->answer ,'id'=>'T4',]) ?>
                  </div>
              </div>
            <br><br><br><br><br> <div class="divider"></div><br>
              <?= Html::submitButton('Засах', ['class' => 'btn btn-primary z-depth-5', 'name' => 'contact-button']) ?>

         </div>
       
    </div>
  </div>

<?php

$javaScript = <<< JS

  
JS;
$this->registerJs($javaScript,  $this::POS_END)
?>


