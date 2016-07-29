<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use frontend\models\Complaint;
?>
<style>
    .box { 
  padding: 6px 13px !important;
}
</style>
<div class="main-content">
                        <!-- BEGIN .main-page -->
                        <div class="main-page left">

                            <!-- BEGIN .double-block -->
                            <div class="double-block">
                                
                                <!-- BEGIN .content-block -->
                                <div class="content-block main right">
                                    <div class="block">
                                        <div class="block-content">
                                          <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
                                             <?php foreach ($specialContent as $content):?>
                                                <div data-thumb="<?= str_replace("frontend","backend",Yii::getAlias('@web')).'/uploads/content_title/thumbnail/'.$content->title_photo_th?>" data-src="<?= str_replace("frontend","backend",Yii::getAlias('@web')).$content->title_photo?>">
                                                    <div class="camera_caption fadeFromBottom">
                                                        <a href="index.php?r=site%2Fviewcontent&id=<?=$content->id?>" target="_blank"><font color="white"><?php echo strip_tags($content->title);?></font></a>                                                                          
                                                    </div>
                                                </div>
                                             <?php endforeach;?>
                                        </div><!-- #camera_wrap_1 -->
                                     </div>
                                    </div>

                                    <?php if((sizeof($general)!=0 && strlen($general->greeting)!=0)):?>
                                        <div class="block">
                                            <div class="block-title">
                                                <h2>Мэндчилгээ</h2>

                                            </div>
                                            <div class="block-content">
                                            <p><?=$general->greeting?></p>
                                            </div>
                                        </div>
                                    <?php endif;?>
                                    <div class="block">
                                        <div class="block-title">
                                            <h2>Онцлох мэдээ</h2>
                                        </div>
                                        <div class="block-content">
                                            <ul class="article-block-big">
                                                <?php foreach($bottomContent as $content):?>
                                                    <li>
                                                        <div class="article-photo">
                                                            <a href="index.php?r=site%2Fviewcontent&id=<?=$content->id?>" class="hover-effect"><img src="<?= str_replace("frontend","backend",Yii::getAlias('@web')).$content->title_photo?>" alt="" height="100px" width="200px"/></a>
                                                        </div>
                                                        <div class="article-content">
                                                            <h4><a href="index.php?r=site%2Fviewcontent&id=<?=$content->id?>"><?=$content->title?></a></h4>
                                                            <span class="meta">
                                                                <span class="icon-text">&#128340;</span><?=$content->date?>
                                                            </span>
                                                        </div>
                                                    </li>
                                                <?php endforeach;?>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <!-- BEGIN .widget -->
                          <!-- BEGIN .widget -->
                          <?php 
                                $album = \app\models\Album::find()->orderBy(['date' => SORT_DESC])->one(); 
                                if(!is_null($album)){
                                $albums = \app\models\AlbumImages::find()->where(['album_id'=>$album->id])->orderBy(['id' => SORT_DESC])->limit(2)->all();   
                                $count = \app\models\AlbumImages::find()->where(['album_id'=>$album->id])->count(); }
                                else{
                                    $albums = null;
                                }
                                if(!is_null($albums)):?>
                                    <div class="widget">
                                        <h3>Зургын цомог</h3>
                                        <div class="latest-galleries">
                                            <div class="gallery-widget">
                                                <div class="gallery-photo" rel="hover-parent">
                                                   <ul>
                                                        <?php foreach($albums as $image):?>
                                                            <li><a href="index.php?r=site%2Fviewalbum&id=<?=$album->id?>" ><img src="<?= str_replace("frontend","backend",Yii::getAlias('@web')).'/uploads/album/'.$image->file_name;?>" alt="" width="100px" height="190px"/></a></li>
                                                        <?php endforeach;?>
                                                    </ul>
                                                </div>
                                                <div class="gallery-content">
                                                    <h4><a href="index.php?r=site%2Fviewalbum&id=<?=$album->id?>"><?=$album->name?></a></h4>
                                                    <span class="meta">
                                                        <span class="right"><?=$count?> зураг</span>
                                                        <a href="index.php?r=site%2Falbum"><i class="fa fa-image fa-2x"></i> Бүх зургыг үзэх</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- END .widget -->
                                    </div> <?php endif?>
                                </div>
                                
                                <!-- BEGIN .content-block -->
                                <div class="content-block left">
                                    <?php if((sizeof($general)!=0 && strlen($general->greeting)!=0)):?>
                                    <div class="block">
                                        <div class="featured-block">
                                       
                                            
                                            <div class="article-photo">
                                                <div class="block-title">
                                                    <h2>Видео мэдээ</h2>
                                                </div>
                                           <iframe width="250" height="250" src="<?= str_replace("watch?v=","embed/",$general->youtube_url).'?autoplay=0'; ?>" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                    <div class="block">
                                        <h2 class="list-title" style="color: #2277c6;border-bottom: 2px solid #2277c6;">Сүүлд нэмэгдсэн</h2>
                                        <ul class="article-list">
                                            <?php foreach($latestContent as $latest):  ?>
                                            <li><a href="index.php?r=site%2Fviewcontent&id=<?=$latest->id?>"><?=$latest->title?></a><span class="meta-date"><?=$latest->date?></span></li>
                                            <?php endforeach;?>
                                        </ul>
                                        <a href="index.php?r=site%2Flatest" class="more">Цааш нь үзэх</a>
                                    </div>
                                    
                                    <div class="block">
                                        <h2 class="list-title" style="color: #c42b20;border-bottom: 2px solid #c42b20;">Олон уншсан</h2>
                                        <ul class="article-list">
                                            <?php foreach($mostView as $view): ?>
                                                <li><a href="index.php?r=site%2Fviewcontent&id=<?=$view->id?>"><?=$view->title?></a><span class="meta-date"><?=$view->date?></span></li>
                                            <?php endforeach;?>
                                        </ul>
                                        <a href="index.php?r=site%2Fmostvisit" class="more">Цааш нь үзэх</a>
                                    </div>
                                    <?php if(sizeof($faq)!=0):?>
                                        <div class="block">
                                            <h2 class="list-title" style="color: #2277c6;border-bottom: 2px solid #2277c6;">Түгээмэл асуултууд</h2>
                                                 <div class="accordion">
                                                        <?php foreach($faq as $f): ?>
                                                            <div>
                                                                <a href="#"><?=$f->question?></a>
                                                                <div>
                                                                    <?=$f->answer?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach;?>
                                                    </div>
                                            <a href="index.php?r=site%2Ffaq" class="more">Бүх асуултыг үзэх</a>
                                        </div>
                                    <?php endif;?>
                                    <?php if(sizeof($counter)!=0):?>
                                         <div class="block">
                                            <div class="featured-block">
                                           <div class="article-photo">
                                                   <h2 class="list-title" style="color: #2277c6;border-bottom: 2px solid #2277c6;">Вэб хандалтын тоон үзүүлэлт </h2>
                                                   <table>
                                                    <tr>
                                                        <td width="80%">Өнөөдөр</td>
                                                        <td><?=$counter->day_value?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Энэ долоо хоног</td>
                                                        <td><?=$counter->week_value?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Энэ сар</td>
                                                        <td><?=$counter->month_value?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Нийт</td>
                                                        <td><?=$counter->all_value?></td>
                                                    </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif;?>
                                    <div class="block">
                                        <h2 class="list-title" style="color: #2277c6;border-bottom: 2px solid #2277c6;">Бидний хаяг</h2>
                                      
                                            <div style="border : solid 1px #fff; background : #fff; color : #000; padding : 0px; overflow : auto; ">
                                                <?php include('contact.php');?>
                                            </div>
                                            <a href="index.php?r=site%2Fcontact" class="more">Дэлгэрэнгүй харах</a>
                                       
                                    </div>
                                    <div hidden>
                                        <?php include 'counter.php';?>
                                    </div>
                                    
                                <!-- END .content-block -->
                                </div>

                            <!-- END .double-block -->
                            </div>

                        <!-- END .main-page -->
                        </div>
                        
                        <!-- BEGIN .main-sidebar -->
                        <div class="main-sidebar right">
                            <?php if(sizeof($banner)!=0):?>
                                <!-- BEGIN .widget -->  
                                <div class="widget">
                                  <img src="<?= str_replace("frontend","backend",Yii::getAlias('@web')).'/'.$banner->banner_name; ?>" alt="" width="300"/>
                                 <!-- END .widget -->
                                </div>
                            <?php endif?>
                            
                            <?php if(sizeof($general)!=0):?>
                            <!-- BEGIN .widget -->
                            <div class="widget">
                                <h3>Бидэнтэй нэгдэх</h3>
                                <div class="widget-articles">
                                   <div class="fb-like-box" data-href="<?=$general->facebook_url?>" data-width="300" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
                                </div>
                            <!-- END .widget -->
                            </div>
                            <?php endif;?>
                            <!-- BEGIN .widget -->
                            <div class="widget">
                                <h3>Тендерийн урилга</h3>
                                <div class="widget-articles">
                                    <ul>
                                        <?php foreach($tenderContent as $tender):?>
                                            <li>
                                                <div class="article-photo">
                                                    <a href="index.php?r=site%2Fviewcontent&id=<?=$tender->id?>" class="hover-effect"><img src="images/photos/jin.jpg" alt="" /></a>
                                                </div>
                                                <div class="article-content">
                                                    <h4><a href="index.php?r=site%2Fviewcontent&id=<?=$content->id?>"><?=$tender->title?></a></h4>
                                                    <span class="meta">
                                                        <span class="icon-text">&#128340;</span><?=$tender->date?>
                                                    </span>
                                                </div>
                                            </li> 
                                        <?php endforeach;?> 
                                    </ul>
                                </div>
                            <!-- END .widget -->
                            </div>

                            <!-- BEGIN .widget -->
                            <div class="widget">
                                <h3>Тендерийн шалгаруулалт</h3>
                                <div class="widget-articles">
                                    <ul>
                                        <?php foreach($tenderResult as $result):?>
                                            <li>
                                                <div class="article-photo">
                                                    <a href="index.php?r=site%2Fviewcontent&id=<?=$result->id?>" class="hover-effect"><img src="images/photos/jin.jpg" alt="" /></a>
                                                </div>
                                                <div class="article-content">
                                                    <h4><a href="index.php?r=site%2Fviewcontent&id=<?=$result->id?>"><?=$result->title?></a></h4>
                                                    <span class="meta">
                                                       <span class="icon-text">&#128340;</span><?=$result->date?>
                                                    </span>
                                                </div>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                </div>
                            <!-- END .widget -->
                            </div>
                            
                            <!-- BEGIN .widget -->
                            <?php if(sizeof($links)!=0):?>                        
                            <div class="widget">
                                <h3>Холбоос</h3>
                                <?php foreach($links as $link):?>
                                <a href="<?php echo $link->link_url;?>" target="_blank"><img src="<?= str_replace("frontend","backend",Yii::getAlias('@web')).$link->link_pic; ?>"  width="300"></a>
                                <?php endforeach;?>
                              <!-- END .widget -->
                            </div>
                            <?php endif;?>
                            
                            <!-- BEGIN .widget 
                            <div class="widget">
                                <h3>Tag Cloud</h3>
                                <div class="tag-cloud">
                                    <a href="category.html">Duo illum</a><a href="category.html">Veritus ullamcorper</a><a href="category.html">Molestiae</a><a href="category.html">Mea fugit appareat</a><a href="category.html">Delectus pericula id sea</a><a href="category.html">Option veritus</a><a href="category.html">Fugit appareat</a>
                                </div>
                            </div>
                            <!-- END .widget -->
                            
                            <!-- BEGIN .widget -->
                            <div class="widget">
                                <h3>Санал хүсэлт илгээх</h3>
                                <div class="mailing-list">
                                 <?php if(Yii::$app->session->hasFlash('success') or Yii::$app->session->hasFlash('error')): ?><div id="div1">
                                    </div><?php endif?>
                                    <p>НХҮЕГ -ийн албан хаагчдын ёс зүйн зөрчилтэй холбоотой санал хүсэлтээ <b>9050-1220</b> утсанд хандаж ирүүлнэ үү.</p>
                                    <p> Нийгмийн халамжийн үйлчилгээтэй холбоотой санал хүсэлт өргөдөл <b>8050-1220</b> утсанд хандаж ирүүлнэ үү.</p>
                                    <hr />
                                    <?php if(Yii::$app->session->hasFlash('success')): ?>
                                            <div class="info-message success">
                                                <span class="icon-text">&#128077;</span>
                                                <b>Таний саналыг хүлээн авлаа баярлалаа!</b>
                                            </div>
                                    <?php endif;?>
                                    <?php if(Yii::$app->session->hasFlash('error')):?>
                                        <div class="info-message fail">
                                                
                                                <b><i class="fa fa-exclamation-triangle fa-lg"></i> Та зурган кодыг зөв оруулна уу!</b>
                                        </div> 
                                    <?php endif?>
                                   <!--   <div class="info-message success" hidden>
                                        <span class="icon-text">&#128077;</span>
                                        <b>Gear Success !</b>
                                        <p>Everything went well, You are now subscribed !</p>
                                    </div> -->
                                     <?php $form = ActiveForm::begin(['id' => 'myForm', 'action' => ['site/complainsubmit'], 'method' => 'post']); ?>
                                        <p><?= $form->field($complain, 'last_name')->textInput(['type'=>'text', 'id'=>'T0', 'class'=>'box', 'name'=>'T0', 'placeholder'=>'Овог', 'required' => true])->label(false) ?>
                                        <p><?= $form->field($complain, 'name')->textInput(['type'=>'text', 'id'=>'T1', 'class'=>'box', 'name'=>'T1', 'placeholder'=>'Нэр', 'required' => true])->label(false) ?>
                                        <p><?= $form->field($complain, 'email')->textInput(['type'=>'text', 'id'=>'T2', 'class'=>'box', 'name'=>'T2', 'placeholder'=>'Имэйл хаяг', 'required' => true])->label(false) ?>
                                        <p><?= $form->field($complain, 'phone')->textInput(['type'=>'text', 'id'=>'T3', 'class'=>'box', 'name'=>'T3', 'placeholder'=>'Утас', 'required' => true])->label(false) ?>
                                        <p><?= $form->field($complain, 'complain_type')->radioList([1 => 'Ёс зүйн зөрчил', 0 => 'Халамж үйлчилгээтэй холбоотой'], ['name' =>'T4', 'id'=>'T4', 'required' => true]) ->label(false);?>
                                        <p><?= $form->field($complain, 'complain')->textArea(['type'=>'text', 'rows'=>"6" , 'id'=>'T5','cols'=>"26", 'class'=>'box', 'name'=>'T5', 'placeholder'=>'Санал хүсэлт', 'required' => true])->label(false) ?>
                                         <?= $form->field($captcha, 'captcha')->widget(Captcha::className(['required'=>true]))->label('Доорх текстийг оруулна уу') ?>
                                        <p><input type="submit" value="Илгээх" class="button"/></p>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            <!-- END .widget -->
                            </div>
                            

                        <!-- END .main-sidebar -->
                        </div>

                        <div class="clear-float"></div>
                    </div>

<?php
if(sizeof($general)!=0){
    $c_phone = $general->contact_phone;
    $c_address = $general->address;
}
else{
    $c_phone = '';
    $c_address = '';
}

$javaScript = <<< JS


jQuery(function(){

                jQuery('#camera_wrap_2').camera({
                height: '400px',
                loader: 'bar',
                pagination: false,
                thumbnails: true
            });
            
            jQuery('#camera_wrap_1').camera({
                thumbnails: true
            });

        
        });
   


$(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
        scrollTop: $('#div1').offset().top
    }, 'slow');
});

function validateForm() {
    var x = document.forms["myForm"]["T0"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
}
           

           jQuery("body").append("<div class='demo-settings'></div>");
    jQuery(".demo-settings").append("<a href='#show-settings' class='demo-button'><span class='icon-text'>&#9881;</span>Тусламж</a>");
    jQuery(".demo-settings").append("<div class='demo-options'>"+
                                        "<div class='title'>Холбоо барих</div>"+
                                        "<img src='images/hal.png' class='demo-icon' alt='' /><font color='white' size='5px'>Утас : $c_phone</font>"+
                                        "<br><font color='white' size='5px'>Хаяг : $c_address</font>" +   
                                  "</div>");
    


    
    jQuery(".demo-settings").mouseleave(function(){
        var thiselem = jQuery(this);
        thiselem.removeClass("active");
        return false;
    });
    
    jQuery(".demo-settings .demo-button").click(function(){
        jQuery(".demo-settings").addClass("active");
        return false;
    });    
    
    $("#link").click(function(e){
 jQuery(".demo-settings").addClass("active");
        return false;
});

JS;
$this->registerJs($javaScript,  $this::POS_END);
?>



