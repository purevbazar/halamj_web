<style>
	#SubmitForm:active:after{
  content: " ";
  position: absolute;
  top: -4px;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>

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
            <h2>Мэдээ удирдах</h2>
            <p class="caption"></p>
        </div>
    </div>

    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Мэдээний гарчиг</th>
                <th>Мэдээний төрөл</th>
                <th>Огноо</th>
                <th>Үйлдэл</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Мэдээний гарчиг</th>
                <th>Мэдээний төрөл</th>
                <th>Огноо</th>
                <th>Үйлдэл</th>
            </tr>
        </tfoot>
        <tbody>
        <?php $i=1; foreach($content as $m):?>
            <tr>
                <td><?=$i; $i++;?></td>
                <td><?=$m->title;?></td>
                <td><?=$m->media_type;?></td>
                <td><?=$m->date;?></td>
                <td><a class=" btn-floating waves-effect waves-light" href="index.php?r=site%2Fviewcontent&id=<?=$m->id?>"> <i class="material-icons">input</i></a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

<br /><br /><br /><br /><br /><br />

    <!-- Modal Structure -->
    <div id="modal1" class="modal" style="width:1200px">
        <div class="modal-content">
          <h4>Мэдээ нэмэх</h4>
         <?php  $form = ActiveForm::begin(['id' => 'my-form' , 'options' => ['enctype' => 'multipart/form-data'], 'action' => ['site/addcontent'],  'method' => 'post']); ?>
            <div class="row">
              <div class="input-field col s6">
                <?= $form->field($model, 'title')->textInput(['type'=>'text', 'class'=>'validate', 'id'=>'T1', 'name'=>'content_title'])->label('Мэдээний гарчиг') ?>
              </div>
              <div class="input-field col s6">
                <div class="file-field input-field">
                      <div class="btn">
                        <span>Толгой зураг</span>
                          <?= $form->field($models, 'imageFile')->fileInput(['id'=>'imgInp'])->label(false); ?>
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate"  type="text" id="p1" name="p1">
                      </div>
                    </div>
              </div>
            </div>
            <div class="row">
                <div class="input-field col s6"><?php $static = array("0"=>"Холбогдох цэс");?>
                  <?= $form->field($model, 'date')->textInput(['type'=>'date', 'class'=>'datepicker', 'id'=>'T3', 'name'=>'content_date'])->label('Огноо') ?><br>
                  <?= $form->field($model, 'menu_id')->dropDownList($static+ArrayHelper::map(\app\models\Menu::find()->orderBy('menu_name')->all(), 'menu_id', 'menu_name'), ['name'=>'content_menu' ,'id'=>'T4','options'=>['0'=>['disabled'=>true]]])->label(false); ?><br>
                  <?= $form->field($model, 'media_type')->dropDownList(['0' => 'Мэдээний төрөл' , '1' => 'Онцлох /нүүр хуудсан дээр гарна', '2' => 'Энгийн'],  ['name'=>'content_type', 'id'=>'T5', 'class' =>'selectFirst', 'options'=>['0'=>['disabled'=>true], '2'=>['Selected'=>'selected']]])->label(false); ?>
                </div>
                <div class="input-field col s6">
                    <img id="blah" src="<?=Yii::$app->request->baseUrl?>/images/hlj.png" alt="your image" name="T8"  width="250" />
                </div>
            </div>
            <div class="row">
              <table>
                <tr>
                  <td width="30%">Шуурхай мэдэх эсэх?</td>
                  <td width="30%"><input type="checkbox" class="filled-in" id="filled-in-box" name="breaking" value="1"/>
                      <label for="filled-in-box">Тийм</label></td>
                      <td width="40%"></td>
                </tr>
              </table>
            </div>
            <div class="row">
                  <div class="status-form">
                    <?= \yii\redactor\widgets\Redactor::widget([ 'name'=>'content', 'id'=>'T6', 
                        'clientOptions' => [
                                'plugins' => ['imagemanager', 'fontcolor', 'fullscreen', 'table'],
                                'buttonSource' => true, // <-- show source button
                            ]
                        ]) ?> 
                </div>
            </div>
        </div>
        <div class='divider'></div>
        <div class="modal-footer">
          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Болих</a>
          <?= Html::submitButton('Оруулах', ['class' => 'modal-action waves-effect waves-ligth btn-flat', 'id'=>'SubmitForm','name' => 'contact-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
       <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="modal-trigger btn-floating btn-large waves-effect waves-light red" href="#modal1"><i class="material-icons">add</i></a>
      </div>
    </div>
</div>


<?php

$javaScript = <<< JS

  $(document).ready(function () {

     $('#example').DataTable( {
        "pagingType": "full_numbers",
        "pageLength": 50
    } );
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
        if(!document.getElementById('p1').value){
          alert('Нүүр хуудсанд мэдээ хийхэд заавал зураг сонгох шаардлагатай!');
          return(false);
        }
    }
       if (!document.getElementById('T1').value || !document.getElementById('T3').value || !document.getElementById('T4').value || !document.getElementById('T5').value || !document.getElementById('T6').value){
          alert('Талбаруудыг бүрэн бөглөнө үү!');
            return(false);
            }
    });
});

JS;

$this->registerCSSFile(Yii::$app->request->baseUrl.'/css/jquery.dataTables.min.css',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJSFile(Yii::$app->request->baseUrl.'/js/jquery.dataTables.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJs($javaScript,  $this::POS_LOAD)
?>


