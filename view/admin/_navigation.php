<?php require_once './utility/ViewHelper.php'; ?>
<div>
   
    <ul>
	<?php if (User::IsAuthenticated()) {?>
		<div><h2>Admin Home</h2></div>
		<li><a href="<?php ViewHelper::createLinkUrl('admin', 'logout'); ?>">Logout</a></li>
	<?php } else { ?>
	<li><a href="<?php ViewHelper::createLinkUrl('admin', 'login'); ?>">Login</a></li><?php } ?>
		
	
	
	
       
    </ul>    
</div>