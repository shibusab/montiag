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
			<td align="center"><a href="<?php  echo ViewHelper::createLinkUrl('config', 'delete'); ?>/
				<?php echo $pages['configid']; ?> "onClick="return deleteRecord();"> 
				<?php if ($pages['isactive']=="1") echo "Retire this Item"; else echo "Make this Item Active";?></a></td>
			<td align="center"><a href="javascript:history.go(-1)" title="Return to previous page"> Back</a></td>
		</tr>
		
		<tr><td>Name:</td><td><?php echo $pages['configname']; ?> </td></tr>
		<tr><td>Value:</td><td><?php echo $pages['configvalue']; ?> </td></tr>
		<tr><td>Language:</td><td><?php echo $pages['langid']; ?></td></tr>	
		<tr><td>Is Active:</td><td><?php echo ViewHelper::GetYesNo($pages['isactive']); ?></td></tr>
		
		<tr><td> Language:</td><td><?php echo $pages['langid']; ?> </td></tr>
		<tr><td> Created On:</td><td><?php echo $pages['createdon']; ?> </td></tr>
		<tr><td> Last Updated On:</td><td><?php echo $pages['lastupdatedon']; ?> </td></tr>
		
	<</table>	
	</td>
	</table>
			
	<?php } ?>
	 </form>
</div>
			