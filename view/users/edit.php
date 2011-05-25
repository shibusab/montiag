<?php require_once './utility/ViewHelper.php'; ?>
<style type="text/css"> 
#form1 { width: 600px; }
#form1 label.error {
	margin-left: 10px;
	width: auto;
	display: inline;
}
#field { margin-left: .5em; float: left; }
  	#field, label { float: left; font-family: Arial, Helvetica, sans-serif; font-size: small; }
	br { clear: both; }
	input { border: 1px solid black; margin-bottom: .5em;  }
	input.error { border: 1px solid red; }
	label.error {
		background: url('/kwtmtc/static/app/unchecked.gif') no-repeat;
		padding-left: 16px;
		margin-left: .3em;
	}
	label.valid {
		background: url('/kwtmtc/static/app/checked.gif') no-repeat;
		display: block;
		width: 16px;
		height: 16px;
	}
</style>


<script type="text/javascript">
$().ready(function() {

$("#form1").validate({
		rules: 
		{
			username: {required:true, maxlength:50},
			name: {required:true, maxlength:75},
			email:{required:true,email:true},
			phoneres:{required: true, number:true},
			phonecell:{required: true, number:true},
			comments:{required: false, maxlength:75},
		},
		messages: 
		{
			name: " Please enter your  Name",
			email: " Please enter email",
			comments: " Please enter some comments",
		}
	});
})
</script>

<div class="pageContainer">
    <table>
    <form id="form1" name="form1" action="<?php ViewHelper::createLinkUrl('user','editsubmit'); ?>" method="post">
	<?php if (! empty($editrecord)){ ?>
	<fieldset class="fieldset">
	<legend class="legend"><h2>Edit User</h2></legend>
	<input type="hidden" name="userid" id="userid" value = "<?php echo $editrecord['userid'];?>"/>
    <tr><td>Role</td><td> 
	<select name="role" id="role"> 
		<option value='1'<?php if($editrecord['role']=='1') echo " SELECTED = 'YES' "?> >Admin </option> 
		<option value='2'<?php if($editrecord['role']=='2') echo " SELECTED = 'YES' "?>>Manager </option> 
		<option value='3'<?php if($editrecord['role']=='3') echo " SELECTED = 'YES' "?>>Editor </option> 
		<option value='4'<?php if($editrecord['role']=='4') echo " SELECTED = 'YES' "?>>User </option> 
	</select> </td></tr>
	<tr><td>User Name:</td><td><input type="text" name="username" value ="<?php echo $editrecord['siteuserid']?>"/></td></tr>
    <tr><td>First Name:</td><td><input type="text" name="firstname" value ="<?php echo $editrecord['firstname']?>"/></td></tr>
	<tr><td>Middle Name:</td><td><input type="text" name="middlename" value ="<?php echo $editrecord['middlename']?>"/></td></tr>
	<tr><td>Last Name:</td><td><input type="text" name="lastname" value ="<?php echo $editrecord['lastname']?>"/></td></tr>
    <tr><td>Email:</td><td><input type="text" name="email" value ="<?php echo $editrecord['email']?>"/></td></tr>
	<tr><td>Phone Residence:</td><td><input type="text" name="phoneres" value ="<?php echo $editrecord['phoneres']?>"/></td></tr>
	<tr><td>Phone Cell:</td><td><input type="text" name="phonecell" value ="<?php echo $editrecord['phonecell']?>"/></td></tr>
	<tr><td>Status:</td><td><select name="status" id=status" > 
				<option value="1"<?php if($editrecord['isactive']=='1') echo " SELECTED = 'YES' "?>> Active</option>
				<option value="0"<?php if($editrecord['isactive']=='0') echo " SELECTED = 'YES' "?>> Retired</option>
				
			</select> </td></tr>
	<tr><td>Status:</td><td><select name="locked" id=locked" > 
				<option value="1"<?php if($editrecord['islocked']=='1') echo " SELECTED = 'YES' "?>> Locked</option>
				<option value="0"<?php if($editrecord['islocked']=='0') echo " SELECTED = 'YES' "?>> Not Locked</option>
				
			</select> </td></tr>
	<tr><td>Comments:</td><td><input type="text" name="comments" value ="<?php echo $editrecord['comments']?>"/></td></tr>
		
	<tr><td colspan=2><input type="submit" value="Save"  /></td></tr>
	</fieldset>
    </form>
	</table>
	<?php } else {echo "Record Not Found to Edit";}?>
</div></p>

</div>