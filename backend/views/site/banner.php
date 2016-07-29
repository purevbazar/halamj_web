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

            <h2>Баннер зураг оруулах</h2>

            <p class="caption"></p>

        </div>

        <?php $form = ActiveForm::begin(['id' => 'my-form', 'action' => ['site/upload'],  'method' => 'post' , 'options' => ['enctype' => 'multipart/form-data']]); ?>

        <form class="col s12">

        	<div class="row">

              <div class="input-field col s6">

               	<div class="file-field input-field">

      			      <div class="btn">

      			        <span>Файл</span>

      			          <?= $form->field($model, 'imageFile')->fileInput(['id'=>'imgInp'])->label(false); ?>

      			      </div>

      			      <div class="file-path-wrapper">

      			        <input class="file-path validate"  type="text">

      			      </div>

      			    </div>

              </div>

          </div>

            <div class="row">

            	<div class="input-field col s6">
                    <?php if(sizeof($models)!=0): ?>
                    <img id="blah" src="<?php if(strlen($models->banner_name)==0){echo Yii::getAlias('@web').'/images/hlj.png'; }else{echo Yii::getAlias('@web').'/'.$models->banner_name;}?>" alt="your image" width="250" class="materialboxed"/>
                  <?php endif;?>
                    <blockquote>

  				      	   <?= Yii::$app->session->getFlash('success'); ?>

  				          </blockquote>

              </div>

            </div><div class="divider"></div><br />

              <?= Html::submitButton('Оруулах', ['class' => 'btn btn-primary z-depth-5', 'name' => 'contact-button']) ?>
                <div hidden><input type="text" id="album_id" value="<?=$models->id?>"><a class="waves-effect waves-light btn light-blue" id='notific' onclick="Materialize.toast('Амжилттай хуулагдлаа!', 4000)"></a></div>
        </form>

        <?php ActiveForm::end(); ?>

    </div>

  </div>



<?php


    if(Yii::$app->session->hasFlash('success')){
      $print = 'Амжилттай хуулагдлаа';
    }
    if (Yii::$app->session->hasFlash('error')){
      $print ='Алдаа гарлаа. Оруулсан зураг тань [.jpg, .jpeg, .png, .gif] өргөтгөлтэй байхаас гадна латин нэртэй байна гэдгийг анхаарна уу';
    }

$javaScript = <<< JS



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



JS;

$this->registerJs($javaScript,  $this::POS_END)

?>





