<?php require_once './utility/ViewHelper.php'; ?>
 <script language="javascript" type="text/javascript" src="<?php ViewHelper::createStaticUrl('js/tiny_mce.js');?>"></script>
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

$("#form1").validate({
		rules: 
		{
			pagename: {required:true, maxlength:75},
			title:{required:true,maxlength:100},
			body:{required: true,minlength:10},
			postdate:{required: true, date:true},
			createddate:{required: true, date:true}
		},
		messages: 
		{
			pagename: " Please enter your Page Name which appear as page name in posts. Follow-YEAR -month-title",
			title: " Please enter title to appear at the post",
			body: " Please enter your Article"
		}
	});
})
</script>
<link rel="stylesheet" href="<?php ViewHelper::createStaticUrl('css/calendar.css');?>" /> 

<div class="pageContainer">
    <h3>Edit Article</h3>
	
	<?php if (! empty($editrecord)){ ?>
    <form  name="form1"   action="<?php ViewHelper::createLinkUrl('article','editsubmit'); ?>" method="post" >
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
    <tr><td>Page Name:</td><td><input type="text" name="pagename" size="65" value ="<?php echo $editrecord['pagename'];?>"/></td> </tr>
    <tr><td>Title:</td><td><input type="text" name="title" size="65" value ="<?php echo $editrecord['title'];?>"/></td> </tr>
	<tr><td>Expire Date:</td><td><input type="text" name="postdate" id="postdate" value ="<?php echo DateTimeUtility::FormatForEdit($editrecord['expireon']);?>"/></td></tr>
    <tr><td colspan=2>Body:<br><textarea cols="65" rows="20" name="body"><?php echo $editrecord['body'];?></textarea></div></p>
	<tr><td>Display the article in full:</td><td></div><div><select name="displayfull" id=displayfull" READONLY > 
				<option value="1" <?php echo ($editrecord['displayfull']=='1')? "SELECTED=YES":''; ?> >  Yes</option>
				<option value="0"<?php echo ($editrecord['displayfull']=='0')? "SELECTED=YES":''; ?> > No</option>
				</select> </td></tr>
	<tr><td>Display at Home Page:</td><td></div><div><select name="displayhomepage" id=displayhomepage" > 
				<option value="1" <?php echo($editrecord['displayhomepage']=='1')? "SELECTED=YES":''; ?>> Yes</option>
				<option value="0" <?php echo($editrecord['displayhomepage']=='0')? "SELECTED=YES":''; ?>> No</option>
				</select> </td></tr>
	<input type ="hidden" name="ispublic" value="1"/>
	<input type ="hidden" name="posttype" value="0"/>
	<input type="hidden" value="<?php echo $editrecord['status'];?>" name="status" />
	<input type="hidden" value="<?php echo $editrecord['postid'];?>" name="postid" />
    <tr><td colspan=2 align=center><input type="submit" value="Save"</td></tr>
	
	</table>
    </form>
	<?php } else {echo "Record Not Found to Edit";}?>
</div>