<?php require_once './utility/ViewHelper.php'; ?>
<div>
    <div><h4>Articles Menu</h4></div>
    <ul id="categories">
        <li><a href="<?php ViewHelper::createLinkUrl('article', 'listall'); ?>">List Articles</a></li>
        <li><a href="<?php ViewHelper::createLinkUrl('article', 'add'); ?>">Add Article</a></li>        
		<li><a href="<?php ViewHelper::createLinkUrl('article', 'addmedia'); ?>">Add Media Embeded Articles</a></li>        
		<li><a href="<?php ViewHelper::createLinkUrl('file', 'add'); ?>">Upload File</a></li>        
    </ul>    
</div>