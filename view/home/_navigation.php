<?php require_once './utility/ViewHelper.php'; ?>
   
 <?php $pages=ViewHelper::ListPages(3); ?>
	<ul>
		<?php foreach ($pages as $page) 
		  {?><li><a href="<?php ViewHelper::createLinkUrl($page['tag'], 'index'); ?>"> <?php echo $page['menu'] ?> </a></span></li><?php } ?>
	</ul>
	
