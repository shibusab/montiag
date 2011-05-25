   <?php 
	if ( empty($posts))
	{ echo "<h2>" .htmlentities( NO_POSTS) . "</h2>";}
	else
	{foreach ($posts as $article){?>
	   <div class="news_top">
        <div class="news_top_left_picture"><img src = "<?php echo ViewHelper::getProfileImageUrl($article['profileimagename']);?>" /></div>
        <div class="news_top_right">
        <div class="news_title"><h5><a href = "<?php echo ViewHelper::createLinkUrl('home', 'view'); ?>/<?php echo htmlentities($article['pagename']); ?>"><?php echo html_entity_decode($article['title']); ?> </a></h5></div>
		 <div class="publ"> <?php echo htmlentities(POSTED_BY); ?> <a href="#">&nbsp <?php echo html_entity_decode($article['siteuserid']); ?> </a> <?php echo htmlentities(POSTED_ON); ?> <a href="#"><?php echo DateTimeUtility::nicetime($article['lastupdatedon']); ?></a></div>
		</div>
        </div>
        
		<div class="news_text">
       	<p> <?php if ($article['displayfull']=='1' || strlen($article['body']) < 1000)
		{ echo html_entity_decode(htmlentities(stripslashes($article['body'])));}
		 else
		{ echo html_entity_decode(htmlentities( stripslashes(substr($article['body'],0, 1000)))); ?> <a href="<?php  echo ViewHelper::createLinkUrl('post', 'view'); ?>/<?php  echo $article['pagename']; ?> ">...</a>	<?php  }?></p>
		 <div class="read"><a href="<?php echo ViewHelper::createLinkUrl('home', 'view'); ?>/<?php echo htmlentities($article['pagename']); ?>"> <?php echo htmlentities(READ_MORE) ?></a></div>
        <div class="tegs_hr"></div>
        
		<div class="tegs_box"><br>
        <div class="com"><a href="#"></a></div>
        </div><div style="clear: both"></div>
		</div>
                        
		<?php  }}?>

		