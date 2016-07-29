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

                <ul class="collapsible collapsible-accordion" data-collapsible="accordion">
                 <?php foreach($models as $model):?>
                    <li>
                      <div class="collapsible-header "><i class="fa fa-question-circle"></i> <?=$model->question?></div>
                      <div class="collapsible-body">
                            <p><?=$model->answer?></p>

                            <?= Html::a('<i class="fa fa-edit">Засах</i>', ['site/viewfaq', 'id'=>$model->id], ['class' => '', 'style'=>'margin-left:50px; margin-bottom:200px; color: black']) ?>
                            <?= Html::a('<i class="fa fa-remove">Устгах</i>', ['site/deletefaq', 'id'=>$model->id], ['class' => '', 'style'=>'margin-left:50px; margin-bottom:200px; color: black']) ?>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>

              </div>
       
    </div>
  </div>

  <div id="modal1" class="modal" style="width:800px">
        <div class="modal-content">
          <h4>Асуулт нэмэх</h4>
         <?php $form = ActiveForm::begin(['id' => 'my-form2', 'action' => ['site/addfaq'],  'method' => 'post' , 'options' => ['enctype' => 'multipart/form-data']]);?>
        <div class="row">
         <div class="input-field col s12">
                <?= $form->field($model, 'question')->textInput(['type'=>'text', 'value'=>'', 'class'=>'validate', 'name'=>'question'])->label('Асуулт') ?>
              </div>
            </div>
            <div class="row">
               <div class="input-field col s12">
                 <?= \yii\redactor\widgets\Redactor::widget([ 'name'=>'answer', 'id'=>'T4',]) ?>
              </div>
          </div>
            
      
        <div class='divider'></div>
        <div class="modal-footer">
          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Болих</a>
          <?= Html::submitButton('Оруулах', ['class' => 'modal-action waves-effect waves-ligth btn-flat']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
  </div>
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
      <a class="modal-trigger btn-floating btn-large waves-effect waves-light red" href="#modal1"><i class="material-icons">add</i></a>
  </div>
<?php

$javaScript = <<< JS

  
JS;
$this->registerJs($javaScript,  $this::POS_END)
?>


