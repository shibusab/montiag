<div class="pageContainer">
    <?php 
	if ( empty($posts))
	{ echo "<h2>" . htmlentities(NO_POST) ."</h2>";}
	else
	{
		foreach ($posts as $article) 
		{     

			?>
	        	<h2><a href="<?php  echo ViewHelper::createLinkUrl('post', 'view'); ?>/
				<?php  echo htmlentities($article['pagename']); ?> "> 
				
				<?php  echo htmlentities($article['title']); ?></a></h2>
			
        		<?php echo  " [" htmlentities(POSTED_BY) . htmlentities( $article['siteuserid']) . htmlentities(POSTED_ON) . DateTimeUtility::FormatDate($article['lastupdatedon']); ?>] 
				<div><img src = "<?php echo ViewHelper::getProfileImageUrl($article['profileimagename']);?>" /></div>
				<p>
				
					  
	<?php  }}?>
</div>
