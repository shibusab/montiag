<?php require_once './utility/ViewHelper.php'; ?>
<script language="javascript" type="text/javascript">
function checkForm()
{
 var cname, cemail, cpassword;
   with(window.document.form1)
   {
      cemail   = email;
	  cpassword= password;
      
   }
	
   if( trim(cemail.value) == '')
   {
	  alert('Please enter  Email');
      cemail.focus();
      return false;
   }
   else if( trim(cpassword.value) == '')
   {
	  alert('Please enter  Password');
      cpassword.focus();
      return false;
   }
    else if(checkmail(cemail.value) == false)
   {
	
     alert('Please enter a Valid Email');
      cemail.focus();
      return false;
   }
   else
   {
	  cemail.value   = trim(cemail.value);
	  cpassword.value=trim(cpassword.value);
      
   }

}

function trim(str)
{
   return str.replace(/^\s+|\s+$/g,'');
}



function checkmail(e)
{
   var emailfilter=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
	var returnval=emailfilter.test(e.value);
		
	//return returnval;
	return true;
}
</script> 

<div class="pageContainer">
    <h4></h4>
    <form  name="form1" action="<?php ViewHelper::createLinkUrl('admin','loginme'); ?>" method="post">
	<fieldset class="fieldset">
	<legend class="legend"><h2>User Login</h2></legend>
   
    <div class="forget_pass"> 
	 <?php if (!empty($message)) echo $message; ?>
	 <p><div>&nbsp&nbsp Email:</div><div>&nbsp&nbsp<input type="text" name="email" /></div></p>
	<p><div>&nbsp&nbsp Password:</div><div>&nbsp&nbsp<input type="password" name="password" /></div></p> 
	<br><br> 
	<input type="submit" value="SignIn" onClick="return checkForm();" /></div> 
	<div class="forget_pass"><br><br><a href="<?php ViewHelper::createLinkUrl('account', 'forgotpass'); ?>"> Forgot Your Password? </a><br><br></div>
	
	</fieldset>
    </form>
</div>