<?php require_once './utility/ViewHelper.php'; ?>
<div>
    <div><h4>Articles Menu</h4></div>
    <ul id="categories">
        <li><a href="<?php ViewHelper::createLinkUrl('event', 'listall'); ?>">List Events</a></li>
        <li><a href="<?php ViewHelper::createLinkUrl('event', 'add'); ?>">Add Events</a></li>        
		
    </ul>    
</div>