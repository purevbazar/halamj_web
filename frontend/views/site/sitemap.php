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
                

    

         
             
                  <div class="block">
                    <div class="block-content">

                      <div class="shortcode-content">

                        <div class="paragraph-row">
                        <div class="column1">
                        </div>
                            <div class="column11">
                             <div align="left">
                              <ul>
                                  <li ><a href=''>Нүүр хуудас</a></li>   
                                  <?php $menus = \app\models\Menu::find()->where(['parent_id'=>'0'])->all();?>
                                  <?php foreach($menus as $menu):?>
                                    <li><a href="index.php?r=site%2Fviewmenu&id=<?=$menu->menu_id?>"><?=$menu->menu_name?><i class="fa fa-sort-down" style='margin-top:4px; margin-left:2px'></i></a>
                                        <?php $sub_menu = \app\models\Menu::find()->where(['parent_id'=>$menu->menu_id])->all();?>
                                        <ul>
                                        <?php foreach($sub_menu as $sub):?>
                                            <?php if(!is_null(\app\models\Menu::find()->where(['parent_id'=>$sub->menu_id])->all())){
                                                $first_arrow = "<span>";
                                                $second_arrow = "</span>";
                                            }
                                            else{
                                                $first_arrow = "";
                                                $second_arrow = "";   
                                            }
                                            ?>
                                             <li><a href="index.php?r=site%2Fviewmenu&id=<?=$sub->menu_id?>"><?=$first_arrow?><?=$sub->menu_name?><?=$second_arrow?></a>
                                            <?php $third_menu = \app\models\Menu::find()->where(['parent_id'=>$sub->menu_id])->all();?>
                                                <ul>
                                                <?php foreach($third_menu as $third):?>
                                                   <li><a href="index.php?r=site%2Fviewmenu&id=<?=$third->menu_id?>"><?=$third->menu_name?></a> 
                                                <?php endforeach;?>
                                                </ul>
                                             </li> 

                                        <?php endforeach;?>
                                        </ul>  
                                    </li>                
                            <?php endforeach;?>
                             
                              </ul>         
                          </div>
                        </div>

                      </div>
                        <hr />
                       
                        <ul class="social">
      
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
    
    
         
            <div class="clear-float"></div>

   
          
        <!-- END .wrapper -->
        </div>
        
      <!-- BEGIN .content -->
      </div>



<?php

$javaScript = <<< JS

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
