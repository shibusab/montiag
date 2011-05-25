<div class="pageContainer">
<script language="javascript" type="text/javascript">
function deleteRecord()
{
    if (confirm ('Do You Want to Change the Menu Status -ISACTIVE?'));
   
}
</script>

<?php if (! empty($pages))
{ ?>
 <form  name="form1" action="delete" method="post">
  <table id="hor-minimalist-a">
	<tr><td>
	<table>
		<tr>
			<td align="center"><a href="<?php  echo ViewHelper::createLinkUrl('menu', 'delete'); ?>/
				<?php echo $pages['menuid']; ?> "onClick="return deleteRecord();"> 
				<?php if ($pages['isactive']=="1") echo "Retire this Page"; else echo "Make this Menu Item Active";?></a></td>
			<td align="center"><a href="javascript:history.go(-1)" title="Return to previous page"> Back</a></td>
		</tr>
		<tr><td>Section:</td><td><?php echo $pages['name']; ?> </td></tr>
		<tr></tr>
		<tr><td>Name:</td><td><?php echo $pages['name']; ?> </td></tr>
		<tr><td>Tag:</td><td><?php echo $pages['tag']; ?> </td></tr>
		<tr><td>Sort Order:</td><td><?php echo $pages['sortorder']; ?> </td></tr>
		<tr><td>Comments:</td><td><?php echo $pages['comments']; ?></td></tr>	
		<tr><td>Is Active:</td><td><?php echo ViewHelper::GetYesNo($pages['isactive']); ?></td></tr>
		
		<tr><td> Language:</td><td><?php echo $pages['langid']; ?> </td></tr>
		<tr><td> Created On:</td><td><?php echo $pages['createdon']; ?> </td></tr>
		<tr><td> Last Updated On:</td><td><?php echo $pages['lastupdatedon']; ?> </td></tr>
		<tr><td> MenuID:</td><td><?php echo $pages['menuid']; ?></td></tr>
	<</table>	
	</td><tr><td>
	
		<table class="fancytable"> 
			<tr><th>IsActive</th><th> Expire Date</th><th> Created Date</th><th> Page Name</th></tr>
		<?php if (!empty($subpages))
			{
				foreach ($subpages as $subpage){ ?>      
				<tr><td> <?php echo ViewHelper::GetYesNo($subpage['status']) ?> </td><td> <?php echo $subpage['expireon'] ?> </td><td> <?php echo $subpage['createdon'] ?> </td><td><?php echo $subpage['pagename'] ?>  </td><td> <?php $subpage['siteuserid']; ?> </td> </tr> 
				<?php } }?>
		</table>
		<?php if(empty($subpages))
		{ echo "<tr><td><h2>No Posts in this menu item</h2></td></tr>";}?>		 

	</td></tr>
	</table>
			
	<?php } ?>
	 </form>
</div>
			