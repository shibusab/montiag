<div class="pageContainer">
    <?php
	if ( empty($contacts))
	{ echo "<h2>No requests to Display</h2>";}
	else
	{
		foreach ($contacts as $contact) 
		{        
		?>
	        	<h2><a href="<?php  echo ViewHelper::createLinkUrl('post', 'view'); ?>/
				<?php  echo $article['pagename']; ?> "> 
				<?php  echo $article['title']; ?></a></h2>
			
        		<?php echo "Posted By " . $article['name'] ." on " . DateTimeUtility::FormatDate($article['lastupdatedon']); ?> 
				<p>
				<?php if ($article['displayfull']=='1' || strlen($article['body']) < 1000)
					   { echo $article['body'];}
					  else
					    { echo substr($article['body'],0, 1000); ?> <a href="<?php  echo ViewHelper::createLinkUrl('post', 'view'); ?>/
						  <?php  echo $article['postid']; ?> ">...</a> 
					  
	<?php  }} }?>
</div>
