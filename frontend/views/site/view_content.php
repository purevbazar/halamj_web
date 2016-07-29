<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<style>
  .social li{
    display:inline;
}  


.fb-share-button{
    position:relative;
    top:-5px;
}
  </style>
    <div class="content">
        <!-- BEGIN .wrapper -->
        <div class="wrapper">
          <div class="main-content">
            <div class="full-width">
              <div class="article-title">
                <div class="share-block right">
                  <div>
                    <div class="share-article left">
                    <h3><strong>Сүүлд нэмэгдсэн</strong></h3>
                    <ul class="article-list">
                      <?php foreach($latestContent as $latest):  ?>
                            <li><a href="index.php?r=site%2Fviewcontent&id=<?=$latest->id?>"><?=$latest->title?></a><span class="meta-date"><?=$latest->date?></span></li>
                      <?php endforeach;?>
                    </ul>
                    <a href="index.php?r=site%2Flatest" class="more">Илүү ихийг унших</a>
                    </div>
                  </div>
                </div>

            <!-- BEGIN .main-page -->
            <div class="main-page left">

              <!-- BEGIN .single-block -->
              <div class="single-block">
                
                <!-- BEGIN .content-block -->
                <div class="content-block main left">
                  
                  <div class="block">
                    <div class="block-content">

                      <div class="shortcode-content">

                        <div class="paragraph-row">
                            <div class="column12">
                             <div style="text-align: center">
                               <p><h1 style="width:100%"><font color="black"><?php echo $content->title?></font></h1></p> <div style="margin-left: 50px; text-align: right; ">Үзсэн : <?=$view_count?> <i class="fa fa-eye fa-3" style="margin-top:5px;"></i></div>
                        <p><img src="<?php
                         if(is_null($content->title_photo)){
                          echo str_replace("frontend","backend",Yii::getAlias('@web').'/images/hlj.png');
                          }else{echo str_replace("frontend","backend",Yii::getAlias('@web').'/'.$content->title_photo);} ?>"  alt="Зураг" /></p>
                      </div>
                          <?php if (strpos($content->description, 'files') !== false) {
                              echo str_replace("/files",str_replace("frontend","backend",Yii::getAlias('@web').'/uploads/files'),$content->description);
                          }
                          else{
                            echo $content->description;
                            }?>
                          </div>
                        </div>

                      
                        <hr />
                       
                        <ul class="social">
                          <li> <strong>Мэдээг түгээх : </strong></li>
                          <li> <a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a> </li>
                          <li> <div class="fb-share-button" data-href="" data-type="button" data-href="<?= Yii::getAlias('@app').'index.php?r=site%2Fviewcontent&id='.$content->id;?>" ></div></li>
                          <li><div style="text-align: right"><a HREF="javascript:window.print();"><i class="fa fa-print fa-lg" style="font-size:1em"></i>&nbsp;&nbsp;Хэвлэх</a></div></li>
                        </ul>
                  
                       </div>

                    </div>

                  </div>

                <!-- END .content-block -->
                </div>

              <!-- END .single-block -->
              </div>

            <!-- END .main-page -->
            </div>
    
            <?php  
                  $obj = \app\models\Content::findOne($content->id);
                  $obj ->view_count = $obj ->view_count + 1  ;
                  $obj ->save(); 
                  ?>
            <div class="clear-float"></div>

          </div>
          
        <!-- END .wrapper -->
        </div>
        
      <!-- BEGIN .content -->
      </div>



<?php

$javaScript = <<< JS

  jQuery("body").append("<div class='demo-settings'></div>");
    jQuery(".demo-settings").append("<a href='#show-settings' class='demo-button'><span class='icon-text'>&#9881;</span>Тусламж</a>");
    jQuery(".demo-settings").append("<div class='demo-options'>"+
                                        "<div class='title'>Холбоо барих</div>"+
                                        "<img src='images/hal.png' class='demo-icon' alt='' /><font color='white' size='5px'>Утас : $general->contact_phone</font>"+
                                        "<br><font color='white' size='5px'>Хаяг : $general->address</font>" +   
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

    $("#link").click(function(e){
 jQuery(".demo-settings").addClass("active");
        return false;
});
(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                                fjs.parentNode.insertBefore(js, fjs);
                              }(document, 'script', 'facebook-jssdk'));    

                               !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');                            

JS;

$this->registerJs($javaScript,  $this::POS_LOAD)
?>
