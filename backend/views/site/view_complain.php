<?php



/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;

use yii\helpers\Html;

use yii\helpers\ArrayHelper;

?>

<?php $model = \app\models\Complaint::findOne($model->id); $model->is_seen = 1; $model->save(); ?>

<div class="card">

    <div class="card-image waves-effect waves-block waves-light">

      <img class="activator" src="images/ub.jpg" height="400px">

    </div>

    <div class="card-content">

      <span class="card-title activator grey-text text-darken-4">

       <div class="row">

			 <table>

	     		<tr>

	     			<td>Овог:</td>

	     			<td><?= filter_var($model->last_name, FILTER_SANITIZE_STRING)?></td>

	     		</tr>

	     		<tr>

	     			<td>Нэр:</td>

	     			<td><?= filter_var($model->name, FILTER_SANITIZE_STRING)?></td>

	     		</tr>

	     		<tr>

	     			<td>Утас:</td>

	     			<td><?= filter_var($model->phone, FILTER_SANITIZE_STRING)?></td>

	     		</tr>

	     		<tr>

	     			<td>Цахим хаяг:</td>

	     			<td><?= filter_var($model->email, FILTER_SANITIZE_EMAIL)?></td>

	     		</tr>

	     		<tr>

	     			<td>Огноо:</td>

	     			<td><?= filter_var($model->submitted_date, FILTER_SANITIZE_STRING)?></td>

	     		</tr>

	     	</table>

    	</div>

    	<h5 class="center-align"><b>Санал хүсэлт :</b></h5>

      <?=$model->complain?>

      <i class="material-icons right">more_vert</i></span>

        <blockquote>

	      Шийдвэр оруулахын тулд зурган дээр дарна уу!

	    </blockquote>

	    <br><br>

    </div>

    <div class="card-reveal">

      <span class="card-title grey-text text-darken-4">

	  <i class="material-icons right">close</i></span>
	  	 <p><b>Таний оруулж буй шийдвэр санал хүсэлт явуулсан иргэний имэйлд шууд очих учраас хариултаа товч тодорхой байлгахыг анхаарна уу!</p></b><br />
      	<div class="input-field col s6">


      		<?php $form = ActiveForm::begin(['id' => 'my-form2', 'action' => ['site/solvecomplain'],  'method' => 'post' , 'options' => ['enctype' => 'multipart/form-data']]); 

      			$initial = \app\models\ComplainSolved::find()->where(['complain_id'=>$model->id])->one();



      			 if(sizeof($initial)==0){

      				$models = new \app\models\ComplainSolved;
      			}

				else{

						$models = $initial;

      			}

      		?>

         		 <div hidden>
         		 	<input type="text" value="<?=$model->id?>" name="T0">
         		 	<input type="text" value="<?=$model->name?>" name="T3">
         		 	<input type="text" value="<?=$model->complain?>" name="T4">
         		 	<input type="text" value="<?=$model->submitted_date?>" name="T5">
         		 	<input type="text" value="<?=$model->email?>" name="T6">
         		 </div>

         		
         		 <?= $form->field($models, 'solution')->textArea([ 'class'=>'materialize-textarea', 'name'=>'T1'])->label('Шийдвэрлэсэн байдал') ?>

      			<!--  <?php echo $form->field($models, 'is_solved')->dropDownList([ '1' => 'Шийдвэрлэсэн', '2' => 'Шийдвэрлээгүй'],  ['name'=>'content_type', 'name'=>'T2', 'class' =>'selectFirst', 'options'=>[$models->is_solved=>['Selected'=>'selected']]])->label(false); ?> -->

      		 <?= Html::submitButton('Илгээх', ['class' => 'btn btn-primary z-depth-5', 'name' => 'contact-button']) ?>

		 </div>

		    <?php ActiveForm::end(); ?>

      </div>

    </div>

  </div>

 

