<?php require_once './utility/ViewHelper.php'; ?>
<div>
    <div><h4>File Menu</h4></div>
    <ul id="categories">
        <li><a href="<?php ViewHelper::createLinkUrl('file', 'listall'); ?>">List Files</a></li>
        <li><a href="<?php ViewHelper::createLinkUrl('file', 'add'); ?>">Upload File</a></li>        
    </ul>    
</div>