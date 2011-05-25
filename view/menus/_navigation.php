<?php require_once './utility/ViewHelper.php'; ?>
<div>
    <div><h4>Menu's Menu</h4></div>
    <ul id="categories">
        <li><a href="<?php ViewHelper::createLinkUrl('menu', 'listall'); ?>">List Menu</a></li>
        <li><a href="<?php ViewHelper::createLinkUrl('menu', 'add'); ?>">Add Menu</a></li>        
    </ul>    
</div>