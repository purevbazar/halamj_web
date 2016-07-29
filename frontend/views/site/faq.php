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