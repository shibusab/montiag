<?php require_once './utility/ViewHelper.php'; 	$currentTemplate=Registry::get('currenttemplate');    $baseUrl=Registry::get('baseurl');?>
 <script language="javascript" type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/js/tiny_mce.js');?>"></script>
 <script language="iavaScript" type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/js/tigra/calendar_us.js');?>"></script>
<script language="javascript" type="text/javascript">

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	theme_advanced_toolbar_align : "center",
	theme_advanced_toolbar_location : "top",
	theme_advanced_buttons3_add : "preview",
	document_base_url : "<?php echo $baseUrl . '/uploadedimages/' ?>",
    relative_urls : false,
  
});
</script> 

		
<style type="text/css"> 
#form1 { width: 600px; }
#form1 label.error {
	margin-left: 10px;
	width: auto;
	display: inline;
}
</style>

<script>$(function() {
		$( "#startdate" ).datetimepicker({ampm: true});
		});
		</script>
<script>$(function() {
		$( "#enddate" ).datetimepicker({ampm: true});
		});
		</script>
<script type="text/javascript">
$().ready(function() {

$("#articleForm").validate({
		rules: 
		{
			pagename: {required:true, maxlength:75},
			title:{required:true,maxlength:100},
			body:{required: true,minlength:10},
			postdate:{required: true, date:true},
			createddate:{required: false, date:true}
		},
		messages: 
		{
			pagename: " Please enter your Page Name which appear as page name in posts. Follow-YEAR-month-title",
			title: " Please enter title to appear at the post",
			body: " Please enter your Article"
		}
	});
})
</script>

<link rel="stylesheet" href="<?php ViewHelper::createStaticUrl($currentTemplate .'/css/calendar.css');?>" /> 

<div class="pageContainer">
    <h3>Edit Event </h3>
	<hr><br><br>
	<?php if (! empty($editrecord)){ ?>
    <form id="eventForm"  name="form1"  action="<?php ViewHelper::createLinkUrl('event','editsubmit'); ?>" method="post">
	<table>
    <tr><td>Language:</td><td><select name="langid" id=langid" > 
		<?php  foreach ($languages as $language) 
		{  if($language['langid'] == $editrecord['langid'])
			{$var=$language['langid'] . " " . 'SELECTED=YES';}
			else {$var=$language['langid'];}?>
		  <option value=<?php echo $var ?>> <?php echo $language['name']; ?></option> 
		<?php } ?>
		</select> </td></tr>
	<tr><td><label for="eventname">Event Name:</label></td><td><input type="text" name="eventname" size="50" maxlength="150" value = "<?php echo $editrecord['name'];?>"/></td></tr>
    <tr><td colspan=2><label for="tagline">Description:</label><br><textarea name="tagline" cols ="50" rows = "15"/> <?php echo $editrecord['tagline']; ?> </textarea></td></tr>
	<tr><td><label for="host">Host:</label></td><td><input type="text" name="host" size="40" maxlength="40" value = "<?php echo $editrecord['host'];?>"/></td></tr>
	<tr><td><label for="location">Location:</label></td><td><input type="text" name="location" size="50" maxlength="150" value = "<?php echo $editrecord['location'];?>" /></td></tr>
	<tr><td><label for="eventtype">Event Type:</label></td><td><input type="text" name="eventtype" size="11" maxlength="11" value = "<?php echo $editrecord['eventtype'];?>" /></td></tr>
	<tr><td><label for="startdate">Start Date:</label></td><td><input type="text" name="startdate" id="startdate" value = "<?php echo $editrecord['eventstartdate'];?>"/> </td></tr>
	<tr><td><label for="enddate">End Date:</label></td><td><input type="text" name="enddate" id="enddate" value = "<?php echo $editrecord['eventenddate'];?>" /></td></tr>
    
	<tr><td><label for="status">Status:</label></td><td></div><div><select name="status" id=status" > 
				<option value="1"> Published</option>
				<option value="2"> Draft</option>
				<option value="3"> Expired</option>
				<option value="4"> Ready To Publish</option>
			</select> </td></tr>
	<input type="hidden" value="<?php echo $editrecord['eventid'];?>" name="eventid" />
    <tr><td></td><td><input type="submit" value="Save" /></td></tr>
	</table>
		
		
    </form>
	<?php } else {echo "Record Not Found to Edit";}?>
</div>