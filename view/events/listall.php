<div class="pageContainer">
<h2> List Events</h2>
<?php 
if ( empty($events))
{ echo "<tr><td colspan=8><h2>No Events to Display</h2></td></tr>";}
else
{ 	$currentTemplate=Registry::get('currenttemplate'); ?>

<table class="mytable">
<tr>
<th>View </th>
<th>Edit </th>
<?php if( User::IsInRole(1)){ echo "<th>Retire </th>";} ?>
<th>Event Name</th>
<th>Event Date</th>
<th> Location</th>
<th> Status </th>
</tr>
	<?php foreach ($events as $event){	?>
	        <tr> 
			<td><a href="<?php echo ViewHelper::createLinkUrl('event', 'view');?>/<?php echo $event['eventid'];?>"> <img src="<?php echo ViewHelper::createStaticUrl($currentTemplate .'/app/b_view.png');?>" title="View this Event" alt="View"/> </a> </td>
			<td><a href="<?php echo ViewHelper::createLinkUrl('event', 'edit');?>/<?php echo $event['eventid'];?>"> <img src="<?php echo ViewHelper::createStaticUrl($currentTemplate .'/app/b_edit.png');?>" title= "Edit this Event" alt ="Edit" /></a></td> 
			<?php if( User::IsInRole(1)) {?>
			<td><a href ="<?php  echo ViewHelper::createLinkUrl('event', 'delete'); ?>/<?php echo $event['eventid'];?>"> <img src="<?php echo ViewHelper::createStaticUrl($currentTemplate . '/app/b_drop.png');?>" title ="Retire/Activate this Event" alt ="Delete" /> </a> </td>
			<?php }?>
			<td><strong><?php echo $event['name']; ?> </strong4> </td>
			<td><span><small><?php echo DateTimeUtility::FormatDate($event['eventstartdate']); ?></small></span></td> 
			<td><?php echo $event['location']; ?></td>
			<td><?php echo ViewHelper::GetStatus($event['status']); ?> </td></tr>
	<?php } }?>
	
	 </table>
	 
	  <script type="text/javascript"> 
 		$('.mytable').flexigrid(
			{
				title: 'Events',
				width:570,
				height:350,
				
				usepager: true
			}
		);
	</script>
</div>
