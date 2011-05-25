<?php 	$currentTemplate=Registry::get('currenttemplate');?>
<h2> Menu Module</h2><hr><br>
In this module, you can <br>
<table>
<tr height="150">
<td width="200"><a href="<?php ViewHelper::createLinkUrl("menu", 'add'); ?>"> <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/menuadd.png');?>" /> <br>Add a Menu Item </a></td>
<td><a href="<?php ViewHelper::createLinkUrl("menu", 'listall'); ?>"> <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/menulist.png');?>"/> List Menus</a></td>
</tr>
</table>

