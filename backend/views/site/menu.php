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
            <h2>Динамик цэс удирдах</h2>
            <p class="caption"></p>
        </div>
        	<div class="input-field col s12">
        	 	<i class="material-icons prefix">search</i>
	          	<input id="filter" type="text" class="form-control">
	          	<label for="icon_prefix">Шүүлтүүр</label>
			</div>
		</div>

		<table class="highlight">
			<?php $obj = \app\models\Menu::find()->all();?>
		    <thead>
		        <tr>
		            <th>#</th>
		            <th>Цэсний нэр</th>
		            <th>Дараалал</th>
		            <th>Хамаарах цэс</th>
		            <th>Үйлдэл</th>
		        </tr>
		    </thead>
		    <tbody class="searchable">
		    	<?php $i=1; foreach($obj as $ob):?>
			        <tr>
			        	<td><?=$i; $i++?></td>
			            <td><?=$ob->menu_name?></td>
			            <td><?=$ob->sort?></td>
			            <td><?=$ob->parent_id?></td>
			            <td><a class=" btn-floating waves-effect waves-light" href="index.php?r=site%2Fviewmenu&id=<?=$ob->menu_id?>"> <i class="material-icons">input</i></a></td>
			        </tr>
			    <?php endforeach;?>
		    </tbody>
		</table>
		<!-- Modal Structure -->
		<div id="modal1" class="modal" style="width:500px">
		    <div class="modal-content">
		      <h4>Цэс нэмэх</h4>
		     <?php $form = ActiveForm::begin(['id' => 'my-form2', 'action' => ['site/addmenu'],  'method' => 'post' , 'options' => ['enctype' => 'multipart/form-data']]); $model = new \app\models\Menu;?>
		    <div class="row">
		     <div class="input-field col s12">
                <?= $form->field($model, 'menu_name')->textInput(['type'=>'text', 'value'=>'', 'id'=>'T1', 'class'=>'validate', 'name'=>'title_name'])->label('Цэсний нэр') ?>
              </div>
            </div>
            <div class="row">
		     <div class="input-field col s12">
                <?php echo $form->field($model, 'sort')->dropDownList(['0' => 'Эхний түвшин', '1' => 'Хоёрдугаар түвшин', '2' => 'Гуравдугаар түвшин'], ['name'=>'root_level','onchange'=>'
                $.post("index.php?r=site%2Flists&id="+$(this).val(), function(data){
                	$("select#title").html(data); 
                })'])->label(false); ?>
              </div>
            </div>
            <div class="row">
		     <div class="input-field col s12">
                 <?php echo $form->field($model, 'parent_id')->dropDownList(['0' => 'Дагалдах цэс'], ['options'=>['0'=>['disabled'=>true]], 'name'=>'parent_level' ,'id'=>'title', 'class'=>'browser-default'])->label(false); ?></div>
            </div>
		    </div>
		    <div class='divider'></div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Болих</a>
		      <?= Html::submitButton('Оруулах', ['class' => 'modal-action waves-effect waves-ligth btn-flat', 'id'=>'SubmitForm']) ?>
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

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

  $('#SubmitForm').click(function(){
       if (!document.getElementById('T1').value){
          alert('Талбаруудыг бүрэн бөглөнө үү!');
            return(false);
            }
    });

});

JS;
$this->registerJs($javaScript,  $this::POS_END)
?>


