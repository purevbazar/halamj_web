<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use yii\helpers\BaseStringHelper;
use yii\widgets\LinkPager;
?>

<style>

.pagination li {
		display: inline;
	}</style>
			<div class="content">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<div class="main-content">

						<!-- BEGIN .main-page -->
						<div class="main-page left">

							<!-- BEGIN .single-block -->
							<div class="single-block">
								
								<!-- BEGIN .content-block -->
								<div class="content-block main left">
									<div class="block-content">
										<div class="block">
											<div class="block-title">
												<a href="<?php echo Yii::getAlias('@web');?>" class="right">Нүүр хуудасруу буцах</a>
												<h2>Сүүлд нэмэгдсэн мэдээ</h2>
											</div>
											<div class="block-content">
												<?php foreach($contents as $content): ?>
												<div class="article-big">											
														<div class="article-photo" >
															<a href="index.php?r=site%2Fviewcontent&id=<?=$content->id?>" class="hover-effect"><img src="<?php
								                       		if(is_null($content->title_photo)){
								                         	 echo str_replace("frontend","backend",Yii::getAlias('@web')).'/images/hlj.png';
								                          	}else{echo str_replace("frontend","backend",Yii::getAlias('@web')).$content->title_photo;} ?>" width="200"  alt="" /></a>
														</div>
														<div class="article-content">
															<h2><a href="index.php?r=site%2Fviewcontent&id=<?=$content->id?>"><?php echo $content->title?></a></h2>
															<span class="meta">
															<a href="blog.html"><span class="icon-text">&#128340;</span><?php echo $content->date; ?></a>
															</span>

															<p><?php if (strpos($content->description, 'files') !== false) {
									                            echo BaseStringHelper::truncateWords ((str_replace("/files",str_replace("frontend","backend",Yii::getAlias('@web').'/uploads/files'),$content->description)),  3, $suffix = '...', $asHtml = false );
									                          }
									                          else{
									                           	echo  BaseStringHelper::truncateWords ($content->description, 30, $suffix = '...', $asHtml = false );
									                            }
																
															 ?></p>
															<span class="meta">
																<a href="index.php?r=site%2Fviewcontent&id=<?=$content->id?>" class="more">Цааш нь унших<span class="icon-text">&#9656;</span></a>
															</span>
														</div>
												</div>
												<?php endforeach;?>
												<div class="pagination">
												<?=  LinkPager::widget([
												    'pagination' => $pagination,

												]);?>
												</div>
										</div>	
									</div>
									</div>
								<!-- END .content-block -->
								</div>

							<!-- END .single-block -->
							</div>

						<!-- END .main-page -->
						</div>
						
						<!-- BEGIN .main-sidebar -->
						<div class="main-sidebar right">
							
							<!-- BEGIN .widget -->
								<div class="banner" width="300" height="250">
								
							<img src="">
							</div>
							<?php if(strlen($general->facebook_url)!=0):?>
							<!-- BEGIN .widget -->
								<div class="widget">
									<div class="widget-articles">
	                                   <div class="fb-like-box" data-href="<?=$general->facebook_url?>" data-width="300" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
	                                </div>
								<!-- END .widget -->
								</div>
							<?php endif;?>
						<!-- END .main-sidebar -->
						</div>

						<div class="clear-float"></div>

					</div>
					
				<!-- END .wrapper -->
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

JS;
$this->registerJs($javaScript,  $this::POS_END)
?>


