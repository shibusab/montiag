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
<script language="javascript" type="text/javascript">
function checkForm()
{
 var cname, ctag;
   with(window.document.form1)
   {
      cname    = name;
      ctag   = tag;
      
   }
	
	if(trim(cname.value) == '')
   {
      alert('Please enter  Name');
      cauthor.focus();
      return false;
   }
   else if(trim(ctag.value) == '')
   {
	 alert('Please enter Tag');
      ctag.focus();
      return false;
   }
   else
   {
	  cname.value = trim(cname.value);
      ctag.value   = trim(tag);
      
   }

}

function trim(str)
{
   return str.replace(/^\s+|\s+$/g,'');
}
</script> 

<div class="pageContainer">
    <h4>Add a Menu Item</h4>
	<table>
    <form  name="form1" action="addsubmit" method="post">
    <tr><td>Menu</td><td> 
	<select name="menuid" id="menuid"> 
	<?php  foreach ($sections as $section) 
		{  ?>
		<option value=<?php echo $section['sectionid']; ?>> <?php echo $section['name']; ?></option> 
		<?php } ?>
		
	</select> </td></tr>
	
    <tr><td>Name:</td><td><input type="text" name="name" /></td></p>
    <tr><td>Tag:</td><td><input type="text" name="tag" /></td></tr>
	<tr><td>Sort Order:</td><td><input type="text" name="sortorder" /></td></tr>
	<tr><td>Language:</td><td><select name="langid" id=langid" > 
		<?php  foreach ($languages as $language) 
		{   $var=$language['langid'];?>
		<option value=<?php echo $var ?>> <?php echo $language['name']; ?></option> 
		<?php } ?>
		</select> </td></tr>
	<tr><td>Comments:</td><td><input type="text" name="comments" /></td></tr>
    <tr><td>Status:</td><td><select name="status" id=status" > 
				<option value="1"> Active</option>
				<option value="2"> Draft</option>
				<option value="0"> Retired</option>
				
			</select> </td></tr>
    <tr><td><input type="submit" value="Save" onClick="return checkForm();" /></td></tr>
    </form>
	</table>
</div></p>

