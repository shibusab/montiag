<div class="pageContainer">
<?php if (! empty($post))
{ ?>
    <h2><?php echo $post['title']; ?></h2>
    <p>By 
	<?php echo $post['name']; ?> at 
	<?php echo $post['lastupdatedon']; ?>.
	
    <p>
	<?php echo $post['body']; ?></p>
	<input type="image"  src="<?php ViewHelper::createStaticUrl('app/print.gif'); ?>"value="Print Page!" onclick="window.print()" /> 

	 <?php echo "<p><a href=\"javascript:history.go(-1)\" title=\"Return to previous page\">&laquo; Back</a></p>"; 
	 }
else echo "Oops !!!! Page Not Found"	 ?>
</div>