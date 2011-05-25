<div class="pageContainer">
<script language="javascript" type="text/javascript">
function deleteRecord()
{
    if (confirm ('Do You Want to change the Active status of this User?'));
   
}
</script>

<?php if (! empty($users))
{ ?>
 <form  name="form1" action="delete" method="post">
 
 <table id="rounded-corner">
	<tr>
		<td align="center"><a href="<?php  echo ViewHelper::createLinkUrl('user', 'delete'); ?>/
			<?php echo $users['userid']; ?> " > 
			<?php if ($users['isactive']=="1") echo "Retire this User"; else echo "Make Active";?></a></td>
		<td align="center"><a href="javascript:history.go(-1)" title="Return to previous page"> Back</a></td>
	</tr>
	<tr><td> User Name</td><td> <?php echo $users['siteuserid']; ?> <td></tr>
 	<tr><td> Full Name</td><td> <?php echo $users['firstname'] . ' ' . $users['middlename'] . ' ' .$users['lastname']; ?> <td></tr>
	<tr><td> Role</td><td> <?php echo ViewHelper::GetRole($users['role']); ?><td></tr>
    <tr><td> Email</td><td><?php echo $users['email']; ?> <td></tr>
	<tr><td> Res Phone</td><td><?php echo $users['phoneres']; ?> <td></tr>
	<tr><td> Cell Phone</td><td><?php echo $users['phonecell']; ?> <td></tr>
	<tr><td> Created On</td><td><?php echo $users['createdon']; ?> <td></tr>
	<tr><td> UserID</td><td><?php echo $users['userid']; ?><td></tr>
	
    <tr><td>Comments</td><td><?php echo $users['comments']; ?><td></tr>
	<tr><td>Is Active</td><td><?php echo ViewHelper::GetYesNo($users['isactive']); ?><td></tr>
	</table>
	
	<?php } ?>
	 </form>
</div>