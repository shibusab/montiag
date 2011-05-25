<div class="pageContainer">
<ul>
    <?php
	if ( empty($posts))
	{ echo "<h2>No Posts to Display</h2>";}
	else
	{
		foreach ($posts as $article) 
		{       
		?>
	        	<strong> <li><a href="<?php  echo ViewHelper::createLinkUrl('post', 'view'); ?>/
				<?php echo $article['pagename']; ?> "> 
				<?php echo $article['title'] . $article['pagename']; ?> </strong4> <span><small>Posted On 
        		<?php echo DateTimeUtility::FormatDate($article['lastupdatedon']); ?></small></span>
				 </a> </li></p>
					
				
	<?php } }?>
	
	 <?php echo "<p><a href=\"javascript:history.go(-1)\" title=\"Return to previous page\">&laquo;Back</a></p>"; ?>
	 </ul>
</div>
