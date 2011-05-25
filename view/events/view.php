<div class="pageContainer">

<?php if (! empty($event)){ ?>
 <form  name="form1" action="delete" method="post">
 
	<div class="contact_left_bg blog">
	<div class="news_top"><div class="news_top_left_picture"><img src = "<?php echo ViewHelper::getProfileImageUrl($event['profileimagename']);?>"/></div></div>
	<div class="news_top_right">
	<div class="news_title"><h2><?php  echo html_entity_decode($event['name']); ?><br></h2>
	<?php echo htmlentities(POSTED_BY); ?> :&nbsp <?php echo html_entity_decode(htmlentities($event['authorname'])); ?><br> </div><br>
	<?php if(User::IsInRole(1)){ ?>
	<a href="<?php  echo ViewHelper::createLinkUrl('events', 'delete'); ?>/<?php echo $event['eventid']; ?>" > <?php if ($event['status']=="1") echo "Retire this Page"; else echo "Make Active";?> </a><br><hr><br>
	Author:<?php echo $event['authorname']; ?> <br>
	Created On: <?php echo $event['createdon']; ?><br>
	Last Updated: <?php echo $event['lastupdatedon']; ?><br>
	Status: <?php echo ViewHelper::GetStatus($event['status']); ?><br><hr><br>	
	<?php } else { ?>
	<a href="<?php  echo ViewHelper::createLinkUrl('events', 'Attend'); ?>/<?php echo $event['eventid']; ?>" > <?php if ($event['status']=="1") echo "I will Attend this Event"; else echo "I don't want to Attend This Event";?> </a>
	<?php } ?>				
	</div>
    </div>
	<p></p>
	<table>
	<tr><td>Time: </td><td><?php echo DateTimeUtility::GetEventDate($event['eventstartdate'], $event['eventenddate']); ?></br></td></tr>
	<tr><td>Location:</td><td><p><?php echo $event['location']; ?><br></p> </td></tr>
	<tr><td valign="top">Details:</td><td><?php echo $event['tagline']; ?></td></tr>
	<tr><td>Host:</td><td><?php echo $event['host']; ?><br></td></tr>
	</table>
	</form>
	 
	 <?php } else echo "Record Not Found"; ?>
</div>