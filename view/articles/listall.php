<div class="pageContainer">
<h2> List Articles</h2>

<?php if(!isset($_POST['test'])) {  ?>
	<form method="post" action="<?php ViewHelper::createLinkUrl('article','listall'); ?>"> 
	<select name="menuid"> 
		<?php $pages=ViewHelper::ListPages(23); ?>
		<?php $i=1; foreach ($pages as $page) {?>
			<option value="<?php echo $page['menuid']; ?>" <?php  if(isset($_POST['menuid'])){echo($page['menuid']==$_POST['menuid'])? "SELECTED":''; }?>  > <?php  echo $page['menu'] ?></option>
		<?php } ?>
	</select> <input type="submit" name="Select"/> </form>
	<?php }
	if ( empty($posts))
	{ echo "<tr><td colspan=8><h2>No Posts to Display</h2></td></tr>";}
	else
	{ 	$currentTemplate=Registry::get('currenttemplate'); ?>
	<table class="mytable">
<tr>
<th>View </th>
<th>Edit </th>
<?php if( User::IsInRole(1)){ echo "<th>Retire </th>";} ?>
<th>Post Heading</th>
<th>Posted Date</th>
<th> Author</th>
<th> ExpireDate </th>
<th> Status </th>
</tr>
	<?php foreach ($posts as $article){	?>
	        <tr> 
			<td><a href="<?php  echo ViewHelper::createLinkUrl('article', 'view');?>/<?php echo $article['postid'];?>"> <img src="<?php echo ViewHelper::createStaticUrl($currentTemplate .'/app/b_view.png');?>" title="View this Article" alt="View"/> </a> </td>
			<?php if($article['posttype']=='1')?>
			<td> <a href ="<?php if ($article['posttype']=='1'){echo ViewHelper::createLinkUrl('article', 'edit');}else {echo ViewHelper::createLinkUrl('article', 'editmedia');}?>/<?php echo $article['postid'];?>"> <img src="<?php echo ViewHelper::createStaticUrl($currentTemplate . '/app/b_edit.png');?>" title= "Edit this Article" alt ="Edit" /></a></td> 
			<?php if( User::IsInRole(1)) {?>
			<td><a href ="<?php  echo ViewHelper::createLinkUrl('article', 'delete'); ?>/<?php echo $article['postid'];?>"> <img src="<?php echo ViewHelper::createStaticUrl($currentTemplate . '/app/b_drop.png');?>" title ="Retire/Activate this article" alt ="retire" /> </a> </td>
			<?php }?>
			<td><strong><?php echo $article['pagename']; ?> </strong4> </td>
			<td><span><small><?php echo DateTimeUtility::FormatDate($article['lastupdatedon']); ?></small></span></td> 
			<td><?php echo $article['siteuserid']; ?></td>
			<td><?php echo $article['expireon']; ?> </td>
			<td><?php echo ViewHelper::GetStatus($article['status']); ?> </td></tr>
	<?php } }?>
	
	 </table>
	 
	  <script type="text/javascript"> 
 		$('.mytable').flexigrid(
			{
				title: 'Articles',
				width:570,
				height:350,
				
				usepager: true
			}
		);
	</script>
</div>
