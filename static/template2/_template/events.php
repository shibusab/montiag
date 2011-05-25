<?php 
if ( empty($events))
{ echo "<h2>No Events </h2></td></tr>";}
else
{ 	$currentTemplate=Registry::get('currenttemplate');

	foreach ($events as $event){	?>
		<div class="news">
			<a href="<?php echo ViewHelper::createLinkUrl('view', 'event');?>/<?php echo $event['eventid'];?>"> <img src="<?php echo ViewHelper::createStaticUrl($currentTemplate .'/app/b_view.png');?>"/><?php echo $event['name']; ?> 
			<div class="red_hr"></div>
			<?php echo $event['location']; ?> <br>
			<?php echo DateTimeUtility::GetEventDate($event['eventstartdate'], $event['eventenddate']); ?> </a>
			
        </div>	
	<?php } }?>
