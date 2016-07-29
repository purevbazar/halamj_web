<?php



/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;

use yii\helpers\Html;

use yii\helpers\ArrayHelper;

?>

<!--  Outer row  -->

<div class="row">

    <div class="col s12 m9 l12">

      <!--  Material Design -->

          <div id="materialdesign" class="section scrollspy">

            <h2>Санал хүсэлт удирдах</h2>

            <p class="caption"></p>

        </div>

        	<div class="input-field col s12">

        	 	<i class="material-icons prefix">search</i>

	          	<input id="filter" type="text" class="form-control">

	          	<label for="icon_prefix">Шүүлтүүр</label>

			</div>

		</div>



		<table class="highlight">

			<?php $obj = \app\models\Complaint::find()->orderBy(['submitted_date' => SORT_DESC])->all();?>

		    <thead>

		        <tr>

		            <th>#</th>

		            <th>Нэр</th>

		            <th style="width:300px">Санал хүсэлт</th>

		            <th>Утас</th>

		            <th>Цахим хаяг</th>

		            <th>Огноо</th>

		            <th>Шийдвэрлэсэн эсэх</th>

		            <th>Шийдвэрлэх</th>

		        </tr>

		    </thead>

		    <tbody class="searchable">

		    	<?php $i=1; foreach($obj as $ob):?>

			        <tr<?php if($ob->is_seen!=1){echo " bgcolor='#b2dfdb'";}?>>

			        	<td><?=$i; $i++?></td>

						<td><?= filter_var($ob->name, FILTER_SANITIZE_STRING)?></td>

			            <td><?= filter_var($ob->complain, FILTER_SANITIZE_STRING)?></td>

			            <td><?= filter_var($ob->phone, FILTER_SANITIZE_STRING)?></td>

			            <td><?= filter_var($ob->email, FILTER_SANITIZE_EMAIL)?></td>

			            <td><?= filter_var($ob->submitted_date, FILTER_SANITIZE_STRING)?></td>

						<td><?php $id = $ob->id; if(sizeof(\app\models\ComplainSolved::find()->where(['complain_id'=>$id])->one())==0){

							$print = "hidden";

							} else {$print = "";}  ?>

							<div <?=$print?>><i class="material-icons">done</i></div>

						</td>

			            <td><a class=" btn-floating waves-effect waves-light" href="index.php?r=site%2Fviewcomplain&id=<?=$ob->id?>"> <i class="material-icons">input</i></a></td>

			        </tr>

			    <?php endforeach;?>

		    </tbody>

		</table>

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



});



JS;

$this->registerJs($javaScript,  $this::POS_END)

?>

