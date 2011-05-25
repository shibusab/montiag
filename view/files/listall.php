<div class="pageContainer">
<ul>
    <?php
	if ( empty($files))
	{ echo "<h2>No files to Display</h2>";}
	else
	{
		
		foreach ($files as $file) 
		{  //$fullpath= $baseUrl . "\\thumbnails" . "\\" . $file;
			$fullpath1 = $fullpath ."\\". $file;
			?>
			<img src="<?php echo $fullpath1 ; ?>" alt ="<?php echo $fullpath1;?>" Title = "<?php echo $fullpath1;?>" width="50" height="50">	
				
	<?php } }?>
	
	 <?php echo "<p><a href=\"javascript:history.go(-1)\" title=\"Return to previous page\">&laquo;Back</a></p>"; ?>
	 </ul>
</div>
