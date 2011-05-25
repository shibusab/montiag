
<?php
 require_once './utility/ViewHelper.php'; 
// The authenticate class requires the classes to authenticate the user
class Authenticate 
{
	
	 function __construct() 
	{ }
     
	static function isAuthenticated()
	{
		return User::IsAuthenticated();
			
	}
   
  
}
?>