<?php require_once './utility/ViewHelper.php'; ?>
<style type="text/css"> 

#field { margin-left: .5em; float: left; }
  	#field, label { float: left; font-family: Arial, Helvetica, sans-serif; font-size: small; }
	br { clear: both; }
	input { border: 1px solid black; margin-bottom: .5em;  }
	input.error { border: 1px solid red; }
	label.error {
		background: url('http://dev.jquery.com/view/trunk/plugins/validate/demo/images/unchecked.gif') no-repeat;
		padding-left: 16px;
		margin-left: .3em;
	}
	label.valid {
		background: url('http://dev.jquery.com/view/trunk/plugins/validate/demo/images/checked.gif') no-repeat;
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
			firstname: {required:true, maxlength:75},
			email:{required:true,email:true},
			password:{required: true,maxlength:15},
			phoneres:{required: true, number:true},
			phonecell:{required: true, number:true},
			comments:{required: false, maxlength:75},
		},
		messages: 
		{
			username:"Please enter username",
			firstname: " Please enter your  Name",
			email: " Please enter email",
			comments: " Please enter some comments",
		}
	});
})
</script>

<div class="pageContainer">
    <table>
    <form  id="form1" name="form1" action="addsubmit" method="post">
	
	<h2>User Registration</h2><br><hr> <br>
	<?php if (!empty($error)) { ?> <div class="errorbox"><?php if (!empty($error)) echo $error; ?> </div> <?php }?>
    <tr><td>Role</td><td> 
	<select name="role" id="role"> 
		<option value='1'>Admin </option> 
		<option value='2'>Manager </option> 
		<option value='3'>Editor </option> 
		<option value='4' SELECTED=YES>User </option> 
	</select> </td></tr>
	<tr><td>User Name:</td><td><input type="text" name="username" value="<?php echo (!empty($_POST['username']))?  $_POST['username']:''; ?>"/></td></tr>
    <tr><td>First Name:</td><td><input type="text" name="firstname" value="<?php echo (!empty($_POST['firstname']))?  $_POST['firstname']:''; ?>"/></td></tr>
	<tr><td>Middle Name:</td><td><input type="text" name="middlename" value="<?php echo (!empty($_POST['middlename']))?  $_POST['middlename']:''; ?>" /></td></tr>
	<tr><td>Last Name:</td><td><input type="text" name="lastname" value="<?php echo (!empty($_POST['lastname']))?  $_POST['lastname']:''; ?>" /></td></tr>
    <tr><td>Email:</td><td><input type="text" name="email" value="<?php echo (!empty($_POST['email']))?  $_POST['email']:''; ?>" /></td></tr>
	<tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
	
	<tr><td>Phone Residence:</td><td><input type="text" name="phoneres" value="<?php echo (!empty($_POST['phoneres']))?  $_POST['phoneres']:''; ?>"/></td></tr>
	<tr><td>Phone Cell:</td><td><input type="text" name="phonecell" value="<?php echo (!empty($_POST['phonecell']))?  $_POST['phonecell']:''; ?>"/></td></tr>
	<tr><td>Status:</td><td><select name="status" id=status" > 
				<option value="1"> Active</option>
				<option value="0"> Retired</option>
				
			</select> </td></tr>
	<tr><td>Comments:</td><td><input type="text" name="comments" value="<?php echo (!empty($_POST['comments']))?  $_POST['comments']:''; ?>"/></td></tr>
		
	<tr><td colspan=2 align="center"><br><input type="submit" value=" Invite User " /><br></td></tr>
	
    </form>
	</table>
</div></p>
