<div class="pageContainer">

<?php if (! empty($post)){ ?>
 <form  name="form1" action="delete" method="post">
 <a href="<?php  echo ViewHelper::createLinkUrl('article', 'delete'); ?>/
				<?php echo $post['postid']; ?>" > <?php if ($post['status']=="1") echo "Retire this Page"; else echo "Make Active";?> </a>

    <p>Author:<?php echo $post['authorname']; ?> <br>
	 Created On: <?php echo $post['createdon']; ?><br>
	 Last Updated: <?php echo $post['lastupdatedon']; ?><br>
	 Expire On: <?php echo $post['expireon']; ?><br>
	 Status: <?php echo ViewHelper::GetStatus($post['status']); ?><br>
	 Post Type :<?php echo ($post['posttype']=='1')? 'Regular': 'Media-Photo/Video'; ?><br>
	 Display At Home Page:<?php echo ViewHelper::GetYesNo($post['displayhomepage']); ?><br>
	 Display Full Article at all pages:<?php echo ViewHelper::GetYesNo($post['displayfull']); ?><br>
	 Menu: <?php echo $post['menuname']; ?><br>
	 Page Name: <?php echo $post['pagename']; ?><br>
	 <h2>Title:<?php echo $post['title']; ?></h2>
	 <h3> Contents </h3>
	 <br>
    <p>	<?php echo $post['body']; ?></p>
	</form>
	 
	 <?php } else echo "Record Not Found"; ?>
</div>