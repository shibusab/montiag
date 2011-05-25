<?php   

if(User::IsLoggedIn()){
 echo 'Welcome ' . User::email() ;}
else { 
echo "<h2>" .htmlentities( WELCOME_USER) . "</h2>"; ?>
<br><br><a href = "<?php echo ViewHelper::createLinkUrl('admin', 'login'); ?>"> <?php echo htmlentities(LOGIN_USER); ?></a>
<?php } ?>
		