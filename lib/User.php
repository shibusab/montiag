<?php
// The user class 
class User 
{
	
	function __construct() 
	{ }
	
	static function setpassword($pass)
	{
		$_SESSION['password']=$pass;
	}
	static function userid ()
	{return (isset($_SESSION['userid'])) ? $_SESSION['userid'] : 'anonymous';}
	
	static function email()
	{return (isset($_SESSION['email'])) ? $_SESSION['email'] : '';}
	
	static function password()
	{return (isset($_SESSION['password'])) ? $_SESSION['password'] : '';}
	
	static function roles()
	{return (isset($_SESSION['roles'])) ? $_SESSION['roles'] : '';}
	
			
  // 1 Admin 
   // 3 Editor
   // 4 User
   static function IsAllowed($menu)
   {
    $retVal=FALSE;
	
	if(User::IsAuthenticated()) //else return false
	{
		switch ($menu)
		{
			case 'menu':(User::IsInRole(1))? $retVal=TRUE:$retVal=FALSE;break;
			case 'user':(User::IsInRole(1))? $retVal=TRUE:$retVal=FALSE;break;
			case 'config':(User::IsInRole(1))? $retVal=TRUE:$retVal=FALSE;break;
			
			case 'article':(User::IsInRole(3) || User::IsInRole(1))? $retVal=TRUE:$retVal=FALSE;break;
			case 'event':(User::IsInRole(3) || User::IsInRole(1))? $retVal=TRUE:$retVal=FALSE;break;
			case 'file':(User::IsInRole(3) ||User::IsInRole(1))? $retVal=TRUE:$retVal=FALSE;break;
			
			case 'member':  (User::IsInRole(4))? $retVal=TRUE:$retVal=FALSE;break;
			case 'group':(User::IsInRole(4))? $retVal=TRUE:$retVal=FALSE;break;
					
		}
	}
	
	return $retVal;
    	
   }
   
	static function IsInRole($role)
	{
		$retVal=false;
		if (isset($_SESSION['roles']))
		{
			if (in_array($role, $_SESSION['roles']))
			{$retVal=true;}
			else
			{$retVal= false;}
		}
	return $retVal;	
	}
	
	static function IsAuthenticated()
	{
		$retValIsAuth=FALSE;
		if ( isset($_SESSION['email']) && isset($_SESSION['password'])) 
		{
			//ViewHelper::Log($_SESSION['email'],"session email");
			
			$retValIsAuth=UserModel::ValidateUser($_SESSION['email'], $_SESSION['password']);
			if ($retValIsAuth=='0')
				$retValIsAuth='0';
			else
				$retValIsAuth='1';
			 
		}
		
		return $retValIsAuth;
	
	}
	static function IsLoggedIn()
	{
		$retValIsAuth=FALSE;
		if ( isset($_SESSION['email']) && isset($_SESSION['password'])) 
		{$retValIsAuth='1';}
		else
		{$retValIsAuth='0';}
			 
		return $retValIsAuth;
	
	}
	
	static function Login($email, $password)
	{
		$result=UserModel::ValidateUser($email, $password);
	
		$retVal= false;
		if( $result=='0')  // returns 0 if not validated
		{
			$retVal=false;
		}
		else
		{
			$_SESSION['email']=$email;
			$_SESSION['password']= $password;
			
			$_SESSION['userid'] = $result['userid'];
			$_SESSION['roles']=Array($result['role']);
			$retVal=true;
		}
		
	return $retVal;	
	}
	
	static function Logout()
	{
		unset($_SESSION['email']);
		unset($_SESSION['password']);
       	unset($_SESSION['userid']);	
		unset ($_SESSION['roles']);		
	}
	
	
}	
?>