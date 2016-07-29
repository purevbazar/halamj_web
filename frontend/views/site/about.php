<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Json;

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $old =  \app\models\OldContent::find()->all();
		foreach($old as $olds){
    	$decode = json_decode($olds->old_content_pic);
    	if($olds->ishomepage==0){
				$type='2';
			}
			else{
				$type='1';
			}
		$new = new \app\models\Content;
		$new ->title = $olds->old_content_title;
		$new ->date = $olds->old_content_date;
		$new ->description = $olds->old_content_body;
		$new ->media_type = $type; 
		$new ->menu_id = $olds->menu_id;
		if( is_null($decode) ){
		    $photo=''; 
		    $thumbnail='';
		}else{
		    $photo =  substr($decode[0]->name,2);
		    $thumbnail =  substr($decode[0]->name,2);
		}
		$new ->title_photo = str_replace("/images/","/uploads/content_title/",$photo);
		$new->title_photo_th = str_replace("/images/","/uploads/content_title/thumbnail/",$thumbnail);
		$new ->save();
    	}
    ?>


    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>
