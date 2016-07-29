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

           <h4 class="col s12"><?php if(sizeof($albums)==0){echo 'Одоогоор зургын цомог алга байна';}else{echo "Нийт зургын цомгын тоо : ".$count;}?></h4>

              <div class="divider"></div>

              <div class="row">

                <?php foreach($albums as $album):?>

                <div class="col s12 m6 grid">

                  <figure class="effect-lily">

                    <?php $img = \app\models\AlbumImages::find()->where(['album_id'=>$album->id])->orderBy('id')->one();?>

                    <img src="<?php if(isset($img->file_name)){echo Yii::getAlias('@web').'/uploads/album/'.$img->file_name;} else{ echo "images/gallary/16.jpg";}?>" alt="img12"/  height="300px">

                    <figcaption>

                      <div>

                        <h2><span><?=$album->name?></span></h2>

                        <p><?=$album->description?></p>

                      </div>

                      <a href="index.php?r=site%2Fviewalbum&id=<?=$album->id?>">View more</a>

                    </figcaption>     

                  </figure>

                </div>

                <?php endforeach;?>

              </div>

            </div>

            <!-- Modal Structure -->

    <div id="modal1" class="modal" style="width:600px">

        <div class="modal-content">

          <h4>Зургийн цомог нэмэх</h4>

         <?php $form = ActiveForm::begin(['id' => 'my-form2', 'action' => ['site/addalbum'],  'method' => 'post' , 'options' => ['enctype' => 'multipart/form-data']]); $model = new \app\models\Menu;?>

        <div class="row">

         <div class="input-field col s12">

                <?= $form->field($model, 'name')->textInput(['type'=>'text', 'value'=>'', 'id'=>'T1', 'class'=>'validate', 'name'=>'title', 'length'=>'10', 'data-delay'=>"50" ,'data-tooltip'=>"Зургийн цомгын гарчигийг 10 аас бага тэмдэгтээр бичвэл зохимжтой", 'class'=>'tooltipped'])->label('Зургийн цомгын нэр') ?>

              </div>

            </div>

            <div class="row">

         <div class="input-field col s12">

                 <?php echo $form->field($model, 'description')->textArea(['type'=>'text', 'id'=>'T2', 'value'=>'', 'class'=>'materialize-textarea tooltipped', 'name'=>'description', 'data-delay'=>"50" ,'data-tooltip'=>"Зургын цомгын талаарх дэлгэрэнгүй тайлбарыг огноотой нь оруулвал зохимжтой"])->label('Зургийн цомгын тайлбар') ?>

            </div>

        </div>

        <div class='divider'></div>

        <div class="modal-footer">

          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Болих</a>

          <?= Html::submitButton('Оруулах', ['class' => 'modal-action waves-effect waves-ligth btn-flat', 'id'=>'SubmitForm']) ?>

        </div>

        <?php ActiveForm::end(); ?>

     

  </div>

    

    </div>

</div>

          <!-- Floating Action Button -->

            <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">

                <a class="modal-trigger btn-floating btn-large waves-effect waves-light red" href="#modal1"><i class="material-icons">add</i></a>

            </div>

            <!-- Floating Action Button -->

        </div>

        <!--end container-->



  <?php



$javaScript = <<< JS



  $(document).ready(function () {





    $('#SubmitForm').click(function(){

       if (!document.getElementById('T1').value || !document.getElementById('T2').value ){

          alert('Талбаруудыг бүрэн бөглөнө үү!');

            return(false);

            }

    });

});



JS;

$this->registerCSSFile(Yii::$app->request->baseUrl.'/css/media-hover-effects.css');

$this->registerJs($javaScript,  $this::POS_LOAD)

?>



