
<?php if (! empty($post)){ 	$currentTemplate=Registry::get('currenttemplate'); ?>
	<div class="contact_left_top"></div>
	<div class="contact_left_bg blog">
	<div class="news_top"><div class="news_top_left_picture"><img src = "<?php echo ViewHelper::getProfileImageUrl($post[0]['profileimagename']);?>" /></div></div>
		<div class="news_top_right">
		<div class="news_title"><h3><?php  echo html_entity_decode($post[0]['title']); ?><br>
		 <?php echo DateTimeUtility::FormatDate($post[0]['lastupdatedon']); ?></h3>
		 <p><?php echo htmlentities(POSTED_BY); ?> &nbsp <?php echo html_entity_decode(htmlentities($post[0]['siteuserid'])); ?><a href="#"></a></p>
		 </div>
		</div>
    </div>
	<br><br><br><br>
	<p><?php echo html_entity_decode(htmlentities(stripslashes( $post[0]['body'])));?> </p>
	<div style="clear: both"></div>
	<div class="bor"></div>
	<div class="tegs_box">
		<div class="prnt"><p><input type="image"  src="<?php ViewHelper::createStaticUrl($currentTemplate . '/app/b_print.png'); ?>" value="Print Page!" onclick="window.print()" /> </div>
        <div class="back"><a> <?php echo "<p><a href=\"javascript:history.go(-1)\" title=\"Return to previous page\"> Back</a></p>";?></a></div>
		<div class="like"><p><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like show_faces="true" width="450"></fb:like></div>
		
	</div>
        
    <div style="clear: both"></div>
	</div>
	<div class="contact_left_bot"></div>
	<div class="contact_left_top pad_top"></div>
	<?php }
else echo htmlentities(PAGE_NOT_FOUND);	 ?>

