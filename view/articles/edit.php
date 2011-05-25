<?php require_once './utility/ViewHelper.php'; 	$currentTemplate=Registry::get('currenttemplate');     $baseUrl=Registry::get('baseurl');?>
<script language="javascript" type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/js/tiny_mce.js');?>"></script>
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
		$( "#postdate" ).datetimepicker({ampm: true});
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
    <h3>Edit Article</h3>
	
	<?php if (! empty($editrecord)){ ?>
    <form id="articleForm"  name="form1"  action="<?php ViewHelper::createLinkUrl('article','editsubmit'); ?>" method="post">
	<table>
    <tr><td>Page</td><td><select name="menuid" id="menuid" > 
		<?php $pages=ViewHelper::ListPages(23); ?>
           	<?php $i=1; foreach ($pages as $page) {  
				 if($page['menuid'] == $editrecord['menuid'])
				 { $var= $page['menuid'] . " " . 'SELECTED=YES' ;} 
				 else{ $var=$page['menuid'];}?>
			<option value=<?php  echo $var;?> > <?php echo $page['menu'] ?></option>
				<?php } ?>
			</select> </td> </tr>
			
	<tr><td>Language:</td><td><select name="langid" id=langid" > 
		<?php  foreach ($languages as $language) 
		{  if($language['langid'] == $editrecord['langid'])
			{$var=$language['langid'] . " " . 'SELECTED=YES';}
			else {$var=$language['langid'];}?>
		  <option value=<?php echo $var ?>> <?php echo $language['name']; ?></option> 
		<?php } ?>
		</select> </td></tr>
		
    <tr><td><label for="pagename">Page Name:</label></td><td><input type="text" name="pagename" size="65" value ="<?php echo $editrecord['pagename'];?>"/></td> </tr>
    <tr><td><label for="title">Title:</label></td><td><input type="text" name="title" size="65" value ="<?php echo $editrecord['title'];?>"/></td> </tr>
	<tr><td><label for="postdate">Expire Date:</label></td><td><input type="text" name="postdate" id="postdate" value ="<?php echo DateTimeUtility::FormatForEdit($editrecord['expireon']);?>"/></td></tr>
    <tr valign="top"><td><label for="body">Body:</label></td><td><textarea cols="55" rows="20" name="body"><?php echo html_entity_decode(htmlentities(stripslashes($editrecord['body'])));?></textarea></td> </tr>
	
	<tr><td>Display the article in full:</td><td></div><div><select name="displayfull" id=displayfull" > 
				<option value="1" <?php echo ($editrecord['displayfull']=='1')? "SELECTED=YES":''; ?> >  Yes</option>
				<option value="0"<?php echo ($editrecord['displayfull']=='0')? "SELECTED=YES":''; ?> > No</option>
				</select> </td></tr>
	<tr><td>Display at Home Page:</td><td></div><div><select name="displayhomepage" id=displayhomepage" > 
				<option value="1" <?php echo($editrecord['displayhomepage']=='1')? "SELECTED=YES":''; ?>> Yes</option>
				<option value="0" <?php echo($editrecord['displayhomepage']=='0')? "SELECTED=YES":''; ?>> No</option>
				</select> </td></tr>
	<input type ="hidden" name="ispublic" value="1"/>
	<input type ="hidden" name="posttype" value="1"/>
	<input type="hidden" value="<?php echo $editrecord['status'];?>" name="status" />
	<input type="hidden" value="<?php echo $editrecord['postid'];?>" name="postid" />
    <tr><td></td><td><input type="submit" value="Save"</td> </tr>
	</table>

    </form>
	<?php } else {echo "Record Not Found to Edit";}?>
</div>