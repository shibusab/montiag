<?php require_once './utility/ViewHelper.php'; 	$currentTemplate=Registry::get('currenttemplate');    $baseUrl=Registry::get('baseurl'); ?>
 <script language="javascript" type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate . '/js/tiny_mce.js');?>"></script>
 <script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	theme_advanced_toolbar_align : "center",
	theme_advanced_toolbar_location : "top",
	theme_advanced_buttons3_add : "preview",
	document_base_url : " <?php echo $baseUrl . '/uploadedimages/' ?>",
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
<script>$(function() {
		$( "#postdate" ).datetimepicker();
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
			createddate:{required: true, date:true},
		},
		messages: 
		{
			pagename: " Please enter your Page Name which appear as page name in posts. Follow-YEAR-month-title",
			title: " Please enter title to appear at the post",
			body: " Please enter your Article",
		}
	});
})
</script>


<link rel="stylesheet" href="<?php ViewHelper::createStaticUrl($currentTemplate . '/css/calendar.css');?>" /> 

<div class="pageContainer">
    <h4>Add Article</h4>
    <form id="articleForm" name="form1" action="<?php ViewHelper::createLinkUrl('article','addsubmit'); ?>" method="post">
	
	<?php if(isset ($error)) {?> <div class="errorbox"><?php  echo $error;}?></div> 
 	<table>
	
	<tr><td>Menu</td><td> <select name="menuid""> 
			<?php $pages=ViewHelper::ListPages(23); ?>
	       	<?php $i=1; foreach ($pages as $page) { ?>
			<option value="<?php echo $page['menuid'];?>"> <?php echo $page['menu'] ?></option>
			<?php } ?></select></td></tr>
	<tr><td>Language:</td><td><select name="langid" id=langid" > 
		<?php $languages=ViewHelper::ListLanguages(); foreach ($languages as $language ) 
		{  $var=$language['langid'];?>
		  <option value=<?php echo $var ?>> <?php echo $language['name']; ?></option> 
		<?php } ?>
		</select> </td></tr>
		
	<tr><td><label for="pagename">Page Name:</label></td><td><input type="text" name="pagename" size="65" maxlength=75  value= "<?php echo (isset($_POST['pagename']))? $_POST['pagename']:'';?>"/></td></tr>
    <tr><td><label for="title">Title:</label></td><td><input type="text" name="title" size="65" maxlength=150 value= "<?php echo (isset($_POST['title']))? $_POST['title']:'';?>"/></td></tr>
	<tr><td><label for="postdate">Expire Date:</label></td><td><input type="text" name="postdate" id="postdate"value= "<?php echo (isset($_POST['postdate']))? $_POST['postdate']:'';?>"/></td></tr>
    <tr><td colspan=2><label for="body">Body:</label></td> </tr>
	<tr><td colspan=2> <textarea cols="65" rows="20" name="body"><?php echo (isset($_POST['body']))? $_POST['body']:'';?></textarea></td></tr>
	<tr><td><label for="status">Status:</label></td><td></div><div><select name="status" id=status" > 
				<option value="1"> Published</option>
				<option value="2"> Draft</option>
				<option value="3"> Expired</option>
				<option value="4"> Ready To Publish</option>
			</select> </td></tr>
	<tr><td>Display the article in full:</td><td></div><div><select name="displayfull" id=displayfull" > 
				<option value="1"> Yes</option>
				<option value="0" SELECTED="YES"> No</option>
				</select> </td></tr>
	<tr><td>Display at Home Page:</td><td></div><div><select name="displayhomepage" id=displayhomepage" > 
				<option value="1"> Yes</option>
				<option value="0"> No</option>
				</select> </td></tr>
	<input type ="hidden" name="ispublic" value="1"/>
	<input type ="hidden" name="posttype" value="1"/>
	
    <tr><td></td><td><input type="submit" value="Save" /></td></tr>
	</table>
    </form>
	
</div>