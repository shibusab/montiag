<?php require_once './utility/ViewHelper.php'; ?>
<script language="javascript" type="text/javascript">
function checkForm()
{
 var cname, cemail, cpassword;
   with(window.document.form1)
   {
      cname    = name;
      cemail   = email;
	  cpassword= password;
      
   }
	
	if(trim(cname.value) == '')
   {
      alert('Please enter  Name');
      cname.focus();
      return false;
   }
   else if( trim(cemail.value) == '')
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
	  cname.value = trim(cname.value);
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
		 alert(e.value);
	//return returnval;
	return true;
}
</script> 

<div class="pageContainer">
    <h4></h4>
    <form  name="form1" action="<?php ViewHelper::createLinkUrl('account','submitpassword'); ?>" method="post">
	
	<fieldset class="fieldset">
	<legend class="legend"><h2>Change Password</h2></legend>
	<br><h1>Enter New Password</h1>
	<input type="hidden" name="hash" id="hash" value = "<?php echo $hash;?>"/>
    <p><div>Password<div><div><input type="text" name="pass1" /></div></p>
    <p><div>ReEnter Password</div><div><input type="text" name="pass2" /></div></p>
	<div><input type="submit" value="Change" onClick="return checkForm();" /></div>
	</fieldset>
    </form>
</div></p>

</div>