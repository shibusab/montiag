<?php require_once './utility/ViewHelper.php'; ?>
<div>
    <div><h4>User Menu</h4></div>
    <ul id="categories">

	  <li><a href="<?php ViewHelper::createLinkUrl('user', 'changepassword'); ?>">Change My Password</a></li>
        <li><a href="<?php ViewHelper::createLinkUrl('user', 'listall'); ?>">List Users</a></li>
        <li><a href="<?php ViewHelper::createLinkUrl('user', 'add'); ?>">Invite User</a></li>        
    </ul>    
</div>