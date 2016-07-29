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
            <h2>Цэс засах</h2>
            <p class="caption"></p>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'my-form', 'action' => ['site/menuedit'],  'method' => 'post' , 'options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="row"><div hidden><input type="text" name="id" value="<?=$model->menu_id?>"></div>
              <div class="input-field col s6">
                <?= $form->field($model, 'menu_name')->textInput(['type'=>'text',  'class'=>'validate', 'name'=>'title'])->label('Цэсний нэр') ?>
              </div>
              <div class="input-field col s6">
                    <?php echo $form->field($model, 'sort')->dropDownList(['1' => 'Эхний түвшин', '2' => 'Хоёрдугаар түвшин', '3' => 'Гуравдугаар түвшин'], ['name'=>'root_level', 'options'=>[$model->sort=>['Selected'=>'selected']]])->label(false); ?>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s6">
               <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(\app\models\Menu::find()->all(), 'menu_id', 'menu_name'), ['options'=>[$model->parent_id=>['Selected'=>'selected']], 'name'=>'parent_level' ,'id'=>'title'])->label(false); ?></div>
              </div>
            </div>
            </div> <div hidden>
              <?= Html::submitButton('Засах', ['class' => 'btn btn-primary z-depth-5', 'id'=>'SubmitForm' ,'name' => 'contact-button']) ?>
              <?= Html::a('Устгах', ['site/menudelete', 'id' => $model->menu_id], ['class' => 'btn btn-danger z-depth-5', 'id'=>'delete','data-confirm' => Yii::t('yii', 'Энэ цэсэнд агуулагдаж байгаа дэд цэсүүд болон холбогдох мэдээллүүд мэдээллийн сангаас устах болно, Та энэ үйлдлийг хийхдээ итгэлтэй байна уу?'),]) ?>
          </div>
        <?php ActiveForm::end(); ?>
          <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
                        <a class="btn-floating btn-large waves-effect waves-light blue" href="#" onclick="document.getElementById('SubmitForm').click()">
                         <i class="material-icons">edit</i>
                        </a>
                        <ul>
                          <li><a href="#" onclick="document.getElementById('delete').click()" class="btn-floating red"><i class="material-icons">delete</i></a></li>
                        </ul>
                    </div>
    </div>
  </div>



