<?php require_once './utility/ViewHelper.php'; ?>
<script language="javascript" type="text/javascript">

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
    <h4>Edit Menu</h4>
	<?php if (! empty($editrecord)){  ?>
    <form  name="form1"  action="<?php ViewHelper::createLinkUrl('menu','editsubmit');?>"  method="post">
    <p><div>Menu</div> 
	<input type="hidden" name = "menuid" id="menuid" value ="<?php echo $editrecord['menuid'];?>"/>
	
	<select name="sectionid" id="sectionid"> 
		<?php  foreach ($sections as $section) 
		{   if($section['sectionid'] == $editrecord['sectionid'])
				 { $var= $section['sectionid'] . " " . 'SELECTED=YES' ;} 
				 else{ $var=$section['sectionid'];}?>
		<option value=<?php echo $var ?>> <?php echo $section['name']; ?></option> 
		<?php } ?>
		
	</select> </p>
	
    <p><div>Name:</div><div><input type="text" name="name" value ="<?php echo $editrecord['name'];?>"/></div></p>
    <p><div>Tag:</div><div><input type="text" name="tag" value ="<?php echo $editrecord['tag'];?>"/></div></p>
	<p><div>Sort Order:</div><div><input type="text" name="sortorder" value ="<?php echo $editrecord['sortorder'];?>"/></div></p>
	<p><div>Language:</div><div><select name="langid" id=langid" > 
		<?php  foreach ($languages as $language) 
		{   if($section['langid'] == $editrecord['langid'])
				 { $var= $language['langid'] . " " . 'SELECTED=YES' ;} 
				 else{ $var=$language['langid'];}?>
		<option value=<?php echo $var ?>> <?php echo $language['name']; ?></option> 
		<?php } ?>
		</select> </div></p>
	 <p><div>Comments:</div><div><input type="text" name="comments" value ="<?php echo $editrecord['comments'];?>"/></div></p>
   <p><div>Status:</div><div><select name="status" id=status" > 
				<option value="1" <?php if ($editrecord['isactive']== '1') echo " SELECTED='YES' " ?>> Active</option>
				<option value="2" <?php if ($editrecord['isactive']== '2') echo " SELECTED='YES' " ?>> Draft</option>
				<option value="0" <?php if ($editrecord['isactive']== '0') echo " SELECTED='YES' " ?>> Retired</option>
				
			</select> </div></p>
    <div><input type="submit" value="Save" onClick="return checkForm();" /></div>
    </form>
	<?php } else {echo "Record Not Found to Edit";}?>
</div></p>

</div>