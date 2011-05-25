<?php 	$currentTemplate=Registry::get('currenttemplate');?>
<h2> Users Module</h2><hr><br>
In this module, you can <br>
<table>
<tr height="150">
<td width="200"><a href="<?php ViewHelper::createLinkUrl("user", 'add'); ?>"><img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/useradd.png');?>"/> <br>Invite Users</a></td>
<td><a href="<?php ViewHelper::createLinkUrl("user", 'listall'); ?>">  <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/userlist.png');?>"/> List Users</a></td>
</tr> 
</table>


