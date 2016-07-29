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

            <h2>Холбоос удирдах</h2>

        </div>

	</div>



		<table class="highlight">

			<?php $obj = \app\models\Link::find()->all();?>

		    <thead>

		        <tr>

		            <th>#</th>

		            <th>Зураг</th>

		            <th>Хаяг</th>

		            <th>Үйлдэл</th>

		        </tr>

		    </thead>

		    <tbody class="searchable">

		    	<?php $i=1; foreach($obj as $ob):?>

			        <tr>

			        	<td><?=$i; $i++?></td>	

			            <td><img id="blah" src="<?=Yii::$app->request->baseUrl.'/uploads/banner/Ñ‹Ð±Ó©Ñ‹Ð±.jpg'?>" alt="your image" name="T8" height="80"  width="300" class="materialboxed"/></td>

			            <td><?=$ob->link_url;?></td>

			            <td><a class=" btn-floating waves-effect waves-light" href="index.php?r=site%2Fviewlink&id=<?=$ob->link_id?>"> <i class="material-icons">input</i></a></td>

			        </tr>

			    <?php endforeach;?>

		    </tbody>

		</table>

		<!-- Modal Structure -->

		<div id="modal1" class="modal" style="width:700px">

		    <div class="modal-content">

		      <h4>Холбоос нэмэх</h4>

		     <?php $form = ActiveForm::begin(['id' => 'my-form2', 'action' => ['site/addlink'],  'method' => 'post' , 'options' => ['enctype' => 'multipart/form-data']]); $model = new \app\models\Link;?>

			    <div class="row">

			     <div class="input-field col s12">

	                <?= $form->field($model, 'link_url')->textInput(['type'=>'text', 'value'=>'', 'class'=>'validate', 'id'=>'T1' ,'name'=>'T1'])->label('Хаяг') ?>

	              </div>

	            </div>

			    <div class="row">

	              <div class="input-field col s6">

	               	<div class="file-field input-field">

	      			      <div class="btn">

	      			        <span>Файл</span>

	      			          <?= $form->field($models, 'imageFile')->fileInput(['id'=>'imgInp'])->label(false); ?>

	      			      </div>

	      			      <div class="file-path-wrapper">

	      			        <input class="file-path validate"  type="text" id="img">

	      			      </div>

	      			    </div>

	              </div>

	          </div>

		    </div>

		    <div class='divider'></div>

		    <div class="modal-footer">

		      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Болих</a>

		      <?= Html::submitButton('Оруулах', ['class' => 'modal-action waves-effect waves-ligth btn-flat',  'id'=>'SubmitForm',]) ?>

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

 $('#SubmitForm').click(function(){

       if (!document.getElementById('T1').value || !document.getElementById('img').value){

          alert('Талбаруудыг бүрэн бөглөнө үү!');

            return(false);

            }

    });

});



JS;



$this->registerJs($javaScript,  $this::POS_LOAD)

?>





