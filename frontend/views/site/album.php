<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>


<div class="block-content">

									
									
									<div class="overflow-fix">
										<div class="photo-gallery-grid js-masonry" data-masonry-options='{ "itemSelector": ".photo-gallery-block" }'>
											<?php foreach($albums as $album):?>
												<?php $image = \app\models\AlbumImages::find()->where(['album_id'=>$album->id])->orderBy(['id' => SORT_DESC])->one();?>
													<?php if(!is_null($image)):?>
														<div class="photo-gallery-block">
															<div class="gallery-photo">
																<a href="photo-gallery-single.html" class="hover-effect"><img src="<?= str_replace("frontend","backend",Yii::getAlias('@web')).'/uploads/album/'.$image->file_name;?>" alt="" height="200px", width="250px"/></a>
															</div>
															<div class="gallery-content">
																<h3><a href="photo-gallery-single.html"><?=$album->name?></p>
																<a href="index.php?r=site%2Fviewalbum&id=<?=$album->id?>" class="more">Зургуудыг үзэх&nbsp;&nbsp;<span class="icon-text">&#9656;</span></a>
															</div>
														</div>
													<?php endif;?>
											<?php endforeach;?>
										</div>
									</div>

								</div>