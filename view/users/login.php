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
    <form  name="form1" action="loginme" method="post">
	<fieldset class="fieldset">
	<legend class="legend"><h2>User Login</h2></legend>
      
    <p><div>Email:</div><div><input type="text" name="email" /></div></p>
	<p><div>Password:</div><div><input type="text" name="password" /></div></p>
	<p><input type="checkbox" name="rememberme" value="rememberme"/> Remember Me</div></p>
	<div><input type="submit" value="Login" onClick="return checkForm();" /></div>
	
	</fieldset>
    </form>
</div></p>

</div>