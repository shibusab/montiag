<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';
require_once './lib/User.php';
require_once './model/UserModel.php';
require_once './utility/DateTimeUtility.php';
require_once './utility/ValidateUtility.php';

class AdminController Extends ControllerBase  Implements IController
{
	public function Redirect($action, $value)
	{
		//print_r($action . ' - ' . $value);
		switch ($action)
		{
			case 'index': $this->index(); break;
			case 'login':$this->login();break;
			case 'loginme':$this->loginme();break;
			case 'logout':$this->logout();break;
			default:$this->logout();
	
		}
	}
	
	function index() 
	{
		$this->viewData['navigationPath'] = $this->getNavigationPath('admin');
		if (User::IsLoggedIn()==1)
		{$this->renderWithTemplate('admin/index', 'AdminPageBaseTemplate');}
		else
		 {$this->renderWithTemplate('admin/login', 'AdminPageBaseTemplate');}
		
    }  
   	function login() 
	{
	    // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('admin');
        
              			
        // Render the action with template
        $this->renderWithTemplate('admin/login', 'AdminPageBaseTemplate');
    }  
	
	function loginme() 
	{
	 // Specify the navigation column's path so we can include it based
     //   on the action being rendered
        
		$email=$_POST['email'];
		$password=$_POST['password'];
		//$email=ValidateUtility::checkInput($_POST['email'],"Enter a Valid Email","email");
		//$password=ValidateUtility::checkInput($_POST['password'],"Enter a Valid Password","text");
			ViewHelper::LogString("Login Me - Test");
		
				
		//	 1 Admin 2 Manager 3 Editor 4 User
			if( User::Login ($email, $password)===true)
			{
		
				if (User::IsInRole("1"))
				{ $this->viewData['navigationPath'] = $this->getNavigationPath('admin');
				  $this->renderWithTemplate('admin/index', 'AdminPageBaseTemplate');
				}
				else if (User::IsInRole("moderator"))
				{ $this->viewData['navigationPath'] = $this->getNavigationPath('articles');
				  $this->renderWithTemplate('articles/index', 'AdminPageBaseTemplate');
				}
				else if (User::IsInRole("2"))
				{ $this->viewData['navigationPath'] = $this->getNavigationPath('articles');
				  $this->renderWithTemplate('articles/index', 'AdminPageBaseTemplate');
				}
				else if (User::IsInRole("3"))
				{ $this->viewData['navigationPath'] = $this->getNavigationPath('articles');
				  $this->renderWithTemplate('articles/index', 'AdminPageBaseTemplate');
				}
				else if (User::IsInRole("4"))
				{ $this->viewData['navigationPath'] = $this->getNavigationPath('home');
				  $this->renderWithTemplate('home/welcome', 'SubPageBaseTemplate');
				}
				else
				{ $this->viewData['navigationPath'] = $this->getNavigationPath('home');
				  $this->renderWithTemplate('home/index', 'FrontPageBaseTemplate');
				}
			}
			else
			{ 	$this->viewData['navigationPath'] = $this->getNavigationPath('admin');
				$this->viewData['message'] ="Incorrect Password or Wrong User Name!";
				$this->renderWithTemplate('admin/login', 'AdminPageBaseTemplate');
			}
						
	}
	
	function logout() 
	{
	     $this->viewData['navigationPath'] = $this->getNavigationPath('admin');
      
		User::Logout();
        // Render the action with template
        $this->renderWithTemplate('admin/login', 'AdminPageBaseTemplate');
    }  

}
?>


