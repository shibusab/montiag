<?php require_once './utility/ViewHelper.php'; 	$currentTemplate=Registry::get('currenttemplate');     $baseUrl=Registry::get('baseurl');?>
<script language="javascript" type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/js/tiny_mce.js');?>"></script>
<style type="text/css"> 
#form1 { width: 600px; }
#form1 label.error {
	margin-left: 10px;
	width: auto;
	display: inline;
}
</style>

<script type="text/javascript">
$().ready(function() {

$("#configForm").validate({
		rules: 
		{
			configvalue: {required:true, maxlength:200, minlength=1},
		},
		messages: 
		{
			configvalue: " Please enter the value - 1 char minimum, and 200 chars maximum",
		}
	});
})
</script>

<div class="pageContainer">
    <h3>Edit Item </h3>
	
	<?php if (! empty($editrecord)){ ?>
    <form id="configForm"  name="form1"  action="<?php ViewHelper::createLinkUrl('config','editsubmit'); ?>" method="post">
	<table>
    			
	<tr><td><label for="langid">Language:</td><td> <input type="text" name="langid" readonly="true" size="15" value ="<?php echo $editrecord['langid'];?>"/></td> </tr>
    <tr><td><label for="configname">Name:</label></td><td><input type="text" name="configname" readonly="true" size="51" value ="<?php echo $editrecord['configname'];?>"/></td> </tr>
    <tr><td><label for="configvalue">Value:</label></td><td> <textarea cols=40 rows=4 name ="configvalue"><?php echo $editrecord['configvalue'];?></textarea></td> </tr>
	<input type="hidden" value="<?php echo $editrecord['configid'];?>" name="configid" />
	<input type="hidden" value="<?php echo $editrecord['isactive'];?>" name="status" />
    <tr><td></td><td><input type="submit" value="Save"</td> </tr>
	</table>

    </form>
	<?php } else {echo "Record Not Found to Edit";}?>
</div>