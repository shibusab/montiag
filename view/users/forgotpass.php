<?php require_once './utility/ViewHelper.php'; ?>

<div class="pageContainer">
    <form  name="form1" action="<?php ViewHelper::createLinkUrl('account','forgotpassemail'); ?>" method="post">
	<fieldset class="fieldset">
	<legend class="legend"><h2>Forgot Password</h2></legend>
	<div class="forget_pass"> 
	<?php echo '<br><br>'; echo (isset($message)>0)? $message:"";  ?>
	<br><br>Email:
	<input type="text" name="email" value ="<?php echo (isset($_POST['email']))? $_POST['email']:NULL;?>"  />
	<input type="submit" value=" Reset my Password " /></div> <br><br>
		
	</fieldset>
    </form>
</div>