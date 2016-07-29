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

            <h2>Тусламж </h2>
              <div class="row">
                <div class="col s12 m5">
                  <div class="card-panel teal">
                      <p class="white-text">Програмын танилцуулга : <a href="https://docs.google.com/presentation/d/1zn-TJprVHgsGQnjckAGgh69KVsoSV446SF5Xkh1Y2GE/edit?usp=sharing" target="_blank" class="white-text"><b>Энд</b></a></p>
                      <p class="white-text">Програмын гарын авлага : <a href="http://202.131.238.116/XXCAH/web.pdf" class="white-text" target="_blank"><b>Энд</b></a></p>
                      <p class="white-text">Google material design -ий тухай  : <a href="https://www.youtube.com/watch?v=rrT6v5sOwJg" class="white-text" target="_blank"><b>Энд</b></a></p>
                  </div>
                </div>
              </div>
                
         
           
           


        </div>

   

    </div>

  </div>



<?php



$javaScript = <<< JS







JS;

$this->registerJs($javaScript,  $this::POS_END)

?>





