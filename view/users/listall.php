<table class="mytable">
<?php
	if ( empty($users))
	{ echo "<h2>No Pages to Display</h2>";}
	else
	{ 	$currentTemplate=Registry::get('currenttemplate');
		foreach ($users as $user) 
		{       
		?>
	        	<tr> 
				<td><a href="<?php  echo ViewHelper::createLinkUrl('user', 'view');?>/<?php echo $user['userid'];?>"> <img src="<?php echo ViewHelper::createStaticUrl($currentTemplate . '/app/b_view.png');?>" title="View Record" alt="View"/> </a> </td>
				<td><a href="<?php  echo ViewHelper::createLinkUrl('user', 'edit');?>/<?php echo $user['userid'];?>"> <img src="<?php echo ViewHelper::createStaticUrl($currentTemplate . '/app/b_edit.png');?>" title="Edit Record" alt="Edit"/>  </a> </td>
				<td><strong> <?php echo $user['siteuserid']; ?> </strong4>	</td>
				<td><strong> <?php echo $user['name']; ?> </strong4>	</td>
				<td><?php echo $user['email']; ?></td> 
				<td><?php echo ViewHelper::GetRole($user['role']); ?></td>
				<td><?php echo $user['phoneres'];  ?></br>
				    <?php echo $user['phonecell'];  ?></td>
				
				<td><?php echo ViewHelper::GetYesNo($user['isactive']); ?> </td> </p>
				<td><?php echo ViewHelper::GetYesNo($user['islocked']); ?> </td></tr></p>	
				
	<?php } }?>
	
 
	 </table>
	 
	  <script type="text/javascript"> 
 		$('.mytable').flexigrid(
			{
				title: 'Users',
				width:560,
				height:300,
				colModel : [
				{display: 'View', name : 'View', width : 20, align: 'center'},
				{display: 'Edit', name : 'Edit', width : 20, align: 'center'},
				{display: 'User Name', name : 'UserName', width : 120, sortable : true, align: 'left'},
				{display: 'Full Name', name : 'FullName', width : 120, sortable : true, align: 'left'},
				{display: 'Email', name : 'Email', width : 130, sortable : true, align: 'left'},
				{display: 'Role', name : 'Role', width : 40, sortable : true, align: 'left'},
				{display: 'Phone', name : 'Phone', width : 130, sortable : true, align: 'left'},
				{display: 'Is Active', name : 'IsActive', width : 40, sortable : true, align: 'left'},
				{display: 'Is Locked', name : 'Is Locked', width : 40, sortable : true, align: 'left'}				
				],
				usepager: true

			}
		);
	</script>
