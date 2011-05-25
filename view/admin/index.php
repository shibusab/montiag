<?php 	$currentTemplate=Registry::get('currenttemplate');?>
    <h1><?php if(User::IsLoggedIn()){ echo 'Welcome ' . $_SESSION['email'];}?><br></h1>
	<br><br>
	 <h2>What would you like to do? </h2>
	<table>
	 <tr height="150">
		<td width="200"><a href="<?php ViewHelper::createLinkUrl("article", 'add'); ?>"> <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/articleadd.png');?>"/><br>Write an Article</a></td>
		<td width="200"><a href="<?php ViewHelper::createLinkUrl("event", 'add'); ?>"> <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/eventadd.png');?>"/><br>Add an Event</a></td>
		<td width="200"><a href="<?php ViewHelper::createLinkUrl("user", 'add'); ?>"><img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/useradd.png');?>"/><br>Invite Users</a></td>
		<td width="200"><a href="<?php ViewHelper::createLinkUrl("menu", 'add'); ?>"> <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/menuadd.png');?>" /><br>Add a Menu Item </a></td>
	</tr>
	 
	<tr>
		<td><a href="<?php ViewHelper::createLinkUrl("article", 'listall'); ?>">  <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/articlelist.png');?>"/><br> List Articles</a></span></td>
		<td><a href="<?php ViewHelper::createLinkUrl("event", 'listall'); ?>">  <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/eventlist.png');?>"/><br> List Events</a></span></td>
		<td><a href="<?php ViewHelper::createLinkUrl("user", 'listall'); ?>">  <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/userlist.png');?>"/><br> List Users</a></td>
		<td><a href="<?php ViewHelper::createLinkUrl("menu", 'listall'); ?>"> <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/menulist.png');?>"/><br> List Menus</a></td>
	</tr>
	</table>

