<div class="pageContainer">
<table class="mytable">
<tr>
<th>View</th>
<th>Edit</th>
<th>Section</th>
<th>Menu Item</th>
<th>Tag</th>
<th>Language</th>
<th>Sort Order</th>
<th> IsActive </th>
</tr>
    <?php
	if ( empty($pages))
	{ echo "<h2>No Menu Items to Display</h2>";}
	else
	{	$currentTemplate=Registry::get('currenttemplate');
		foreach ($pages as $page) 
		{       
		?>
	        	<tr>
				<td><a href="<?php  echo ViewHelper::createLinkUrl('menu', 'view');?>/<?php echo $page['menuid'];?>"><img src="<?php echo ViewHelper::createStaticUrl( $currentTemplate . '/app/b_view.png');?>" title="View Record" alt="View"/> </a> </td>
				<td><a href="<?php  echo ViewHelper::createLinkUrl('menu', 'edit'); ?>/<?php echo $page['menuid']; ?>"><img src="<?php echo ViewHelper::createStaticUrl( $currentTemplate . '/app/b_edit.png');?>" title="Edit Record" alt="Edit"/>  </a> </td>
				<td><strong> <?php echo $page['sectionname']; ?> </strong4>	</td>
				<td><strong> <?php echo $page['menu']; ?> </strong4>	</td>
				<td><?php echo $page['tag']; ?></td> 
				<td><?php echo $page['sortorder']; ?></td> 
				<td><?php echo $page['langid']; ?></td>
				<td><?php echo ViewHelper::GetStatus($page['isactive']); ?> </td></tr> </p>
					
				
	<?php } }?>
	
 
	 </table>
	 <script type="text/javascript"> 
 		$('.mytable').flexigrid(
			{
				title: 'Menus',
				width:550,
				height:300,
				colModel : [
				{display: 'View', name : 'View', width : 20, align: 'center'},
				{display: 'Edit', name : 'Edit', width : 20, align: 'center'},
				{display: 'Section', name : 'Section', width : 120, sortable : true, align: 'left'},
				{display: 'Menu Item', name : 'MenuItem', width : 120, sortable : true, align: 'left'},
				{display: 'Tag', name : 'Tag', width : 130, sortable : true, align: 'left'},
				{display: 'Language', name : 'Language', width : 40, sortable : true, align: 'left'},
				{display: 'Sort Order', name : 'SortOrder', width : 130, sortable : true, align: 'left'},
				{display: 'Is Active', name : 'IsActive', width : 40, sortable : true, align: 'left'}
				],
				usepager: true
			}
		);
	</script>
</div>
