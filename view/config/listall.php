<div class="pageContainer">
<table class="mytable">

    <?php
	if ( empty($pages))
	{ echo "<h2>No Items to Display</h2>";}
	else
	{$currentTemplate=Registry::get('currenttemplate');
		foreach ($pages as $page) 
		{       
		?>
	        	<tr>
				<td><a href="<?php  echo ViewHelper::createLinkUrl('config', 'view');?>/<?php echo $page['configid'];?>"><img src="<?php echo ViewHelper::createStaticUrl( $currentTemplate . '/app/b_view.png');?>" title="View Item" alt="View"/> </a> </td>
				<td><a href="<?php  echo ViewHelper::createLinkUrl('config', 'edit'); ?>/<?php echo $page['configid']; ?>"><img src="<?php echo ViewHelper::createStaticUrl( $currentTemplate . '/app/b_edit.png');?>" title="Edit Item" alt="Edit"/>  </a> </td>
				<td><?php echo $page['langid']; ?></td>
				<td><strong> <?php echo $page['configname']; ?> </strong4>	</td>
				<td><strong> <?php echo $page['configvalue']; ?> </strong4>	</td>
				
				<td><?php echo ViewHelper::GetStatus($page['isactive']); ?> </td></tr> </p>
					
				
	<?php } }?>
	
 
	 </table>
	 <script type="text/javascript"> 
 		$('.mytable').flexigrid(
			{
				title: 'Menus',
				width:550,
				height:500,
				colModel : [
				{display: 'View', name : 'View', width : 20, align: 'center'},
				{display: 'Edit', name : 'Edit', width : 20, align: 'center'},
				{display: 'Language', name : 'Language', width : 40, sortable : true, align: 'left'},
				{display: 'Name', name : 'Section', width : 120, sortable : true, align: 'left'},
				{display: 'Value Item', name : 'MenuItem', width : 220, sortable : true, align: 'left'},
				
				{display: 'Is Active', name : 'IsActive', width : 40, sortable : true, align: 'left'}
				],
				usepager: true
			}
		);
	</script>
</div>
