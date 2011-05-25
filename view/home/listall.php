<div class="pageContainer">
<ul class="ls">
    <?php
	if ( empty($posts))
	{ echo "<h2>" . htmlentities(NO_POSTS) . "</h2>";}
	else
	{
		foreach ($posts as $article) 
		{       
		?>
	        	<strong> <li><a href="<?php  echo ViewHelper::createLinkUrl('post', 'view'); ?>/
				<?php echo htmlentities($article['pagename']); ?> "> 
				<?php echo htmlentities($article['title']); ?> </strong4> <span><small>[ <?php echo htmlentities(POSTED_ON); ?>
        		<?php echo DateTimeUtility::nicetime($article['lastupdatedon']); ?>]</small></span>
				 </a> </li></p>
					
				
	<?php } }?>
	
	 </ul>
</div>
