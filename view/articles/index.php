<?php 	$currentTemplate=Registry::get('currenttemplate');?>
 <h2> Article Module</h2><hr>
<br>In this module, you can <br>
<table>
 <tr height="150"><td width="200"><a href="<?php ViewHelper::createLinkUrl("article", 'add'); ?>"> <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/articleadd.png');?>"/><br>Write an Article</a></td>
 <td><a href="<?php ViewHelper::createLinkUrl("article", 'listall'); ?>">  <img src = "<?php ViewHelper::createStaticUrl($currentTemplate . '/images/articlelist.png');?>"/> View and Edit All Articles</a></span></td> </tr>
</table> 