 <?php



/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ContactForm */



use yii\helpers\Html;

use yii\bootstrap\ActiveForm;

use yii\captcha\Captcha;

?>



<!--start container-->

        <div class="container">

          <div class="section">

          <table>
          	<tr>
	          	<td> <h6>Цомгын нэр : <?=$models->name?></h6></td>
	          	<td><h6 class="right-align"><?= Html::a('<i class="material-icons">delete</i>', ['site/deletealbum', 'id' => $models->id], ['class' => 'z-depth-3', 'data-confirm' => Yii::t('yii', 'Устгах уу?'),]) ?></h6></td>
          	</tr>
          	<tr><td><h6>Тайлбар : <?=$models->description?></h6></td></tr>
         	<tr><td><h6>Огноо : <?=$models->date?></h6></td></tr>
          </table>
         	 <blockquote><p class="caption">Цомогт зураг нэмэхдээ дараах хязгаарлалтуудыг анхаарна уу! [ <i class="fa fa-exclamation fa-lg"></i> зурагнуудыг дээр нь дарж томруулан харах боломжтой] </blockquote>

            	<ul>

            		<li><i class="fa fa-check fa-lg"></i>  Эхний зураг нүүр хуудсанд гарах зургийн цомгын нүүр болох учраас өргөн өргөн, өндөр 1.5:1 харьцаатай зураг оруулах</li>

				  	<li><i class="fa fa-check fa-lg"></i> Файлын хэмжээ 50mb-ээс хэтрэхгүй байх</li>

					<li><i class="fa fa-check fa-lg"></i> Зөвхөн [.jpg, .jpeg, .png] өргөтөлтэй файл оруулах</li>

					<li><i class="fa fa-check fa-lg"></i> Нэг удаад 25-аас ихгүй файл оруулах</li>

				</ul></p><br/ >

              <div class="divider"></div><br/>

              	<div hidden><input type="text" id="album_id" value="<?=$models->id?>"><a class="waves-effect waves-light btn light-blue" id='notific' onclick="Materialize.toast('Амжилттай хуулагдлаа!', 4000)"></a></div>

               <table>

               		<tr>

               			<?php $i=0;foreach($model as $img):?>

	               			<td><?php $tr = 0;?>

	               			<img src="<?= Yii::getAlias('@web').'/uploads/album/'.$img->file_name ?>" width = "200px" height="100px" class="materialboxed"><?= Html::a('<i class="material-icons" style="margin-top:1px">delete</i>', ['site/deleteimage', 'id' => $img->id], [ 'data' => [

					            'confirm' => Yii::t('yii', 'Устгах уу?'),

					            'method' => 'post',

					        ]]) ?>

	               			</td>

	               			<?php $i++; if($i>=5){

	               				$tr = 1; echo "</tr>";

	               				}?>

	               			<?php if ($tr == 1 ) {

	               				echo "<tr>";

	               				$i=0;

	               				}?>

	               		<?php endforeach;?>

					</tr>

               </table>

			    

			    

			   

			   



             

          </div>

          <!-- Floating Action Button -->

          <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">

	        <a class="modal-trigger btn-floating btn-large waves-effect waves-light red" href="#modal1"><i class="material-icons">add</i></a>

	      </div>

            <!-- Floating Action Button -->

        </div>

        <!--end container-->



    <div id="modal1" class="modal" style="width:600px">

        <div class="modal-content">

          <h4>Зураг нэмэх</h4>

            <?=  \kato\DropZone::widget([

		       'options' => [

		            'url'=>'index.php?r=site/albumupload',

		           'maxFilesize' => '2',

		       ],

		       'clientEvents' => [

		           'complete' => "function(file){console.log(file)}",

		           'removedfile' => "function(file){alert(file.name + ' is removed')}"

		       ],

		   ]);?>

     	</div>

    </div>



  <?php



$javaScript = <<< JS



  



  



JS;



$this->registerJs($javaScript,  $this::POS_END);

?>



