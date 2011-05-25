<?php 	$currentTemplate=Registry::get('currenttemplate');?>
<h2> Config Module</h2><hr><br>
In this module, you can <br>
<table>
<tr height="150">

<td><a href="<?php ViewHelper::createLinkUrl("config", 'listall'); ?>"> <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/menulist.png');?>"/> Manage Site Setup</a></td>
</tr>
</table>

