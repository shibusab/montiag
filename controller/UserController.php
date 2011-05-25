<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';
require_once './model/UserModel.php';
require_once './lib/User.php';
require_once './model/MailModel.php';
require_once './utility/DateTimeUtility.php';
require_once './utility/ValidateUtility.php';


class UserController Extends ControllerBase Implements IController
{
	public function Redirect($action, $value)
	{
		//print_r($action . ' - ' . $value);
		switch ($action)
		{
			case 'index': $this->index($value); break;
			case 'view':$this->view($value);break;
			case 'listall':$this->listall($value);break;
			case 'add':$this->add();break;
			case 'edit':$this->edit($value);break;
			case 'addsubmit':$this->addsubmit();break;
			case 'editsubmit':$this->editsubmit($value);break;
			case 'delete':$this->delete($value);break;
			/*case 'changepassword':$this->changepassword();break;
			case 'submitpassword':$this->submitpassword();break;
			case 'activate':$this->activate($this->actionVal);break;
			case 'forgotpass':$this->forgotPassword();break;
			case 'forgotpassemail':$this->forgotPassEmail($this->actionVal);break;
			case 'resetpass':$this->resetPassword($this->actionVal);break;
		*/
			default:$this->index($value);
			
		}
	}
	
	 function submitpassword() 
	{
		
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');
		if ($_POST['pass1']=== $_POST['pass2'])
		{
			UserModel::Create()->ChangePassword($_POST['hash'], $_POST['pass1']);
			if (User::IsLoggedIn())
			{
				User::setpassword($_POST['pass1']);
				$this->renderWithTemplate('admin/index', 'AdminPageBaseTemplate');
			}
			else
			{$this->renderWithTemplate('admin/login', 'AdminPageBaseTemplate');}
		}
		else
		{	
			$this->viewData['message'] ="Passwords Don't Match. Try Again";
			$this->renderWithTemplate('users/changepassword', 'AdminPageBaseTemplate');
		}
    }  
	 function changepassword() 
	{
		
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');
         $this->viewData['hash'] =User::userid();
        // Render the action with template
        $this->renderWithTemplate('users/changepassword', 'AdminPageBaseTemplate');
    } 
	
    function index($actionValue) 
	{
		
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');
        
        // Get all articles and store them in the 'pages' view data structure
		// ActionValue==1 is list all the pages for home page, or list all the pages in the selected category 
		if ($actionValue==1)
			$this->viewData['users'] = UserModel::Create()->SelectAllUsers();
		else
			$this->viewData['users'] = UserModel::Create()->SelectUser($actionValue);
       			
        // Render the action with template
        $this->renderWithTemplate('users/index', 'AdminPageBaseTemplate');
    }  
 function view($actionValues) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');
        
        // Get all articles and store them in the 'pages' view data structure
        $this->viewData['users'] = UserModel::Create()->SelectUser($actionValues);
       
        // Render the action with template
        $this->renderWithTemplate('users/view', 'AdminPageBaseTemplate');
    }

  function add() 
  {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');
        
        // Render the action with template
        $this->renderWithTemplate('users/add', 'AdminPageBaseTemplate');
    }
	
	function addsubmit() 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');

      
        // Use the add action's post form variables and the current precise time to insert an article.
        //    validate all post variables before inserting them to avoid a
        //   SQL Injection attack and ensure that we've working with clean data. 
		$email=$_POST['email'];
		$password=$_POST['password'];
		try
		{
		 if (!empty($_POST['username'])&& !empty($_POST['firstname'])&& !empty( $_POST['role']) && !empty($_POST['email']) && !empty($_POST['password']))
		 { 
			$result= UserModel::Create()->InsertUser($_POST['username'],$_POST['email'], $password, $_POST['firstname'],$_POST['middlename'],$_POST['lastname'],$_POST['role'], $_POST['phoneres'], $_POST['phonecell'], $_POST['status'], $_POST['comments']);
			
			if(empty($result))
			{
				$this->viewData['module']="Add User";
				$this->viewData['error']= "Failed to Add the user";
				$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
			}
			else   // invite the user by sending email    
			{
				MailModel::SendInvitation($_POST['email'], $_POST['firstname'],$result);
				$this->renderWithTemplate('users/addsubmit', 'AdminPageBaseTemplate');
			}
		  }
		}
		catch (Exception $ex)
		{
			//echo $ex->getMessage();
			$this->viewData['module']="Add User";
			$this->viewData['error']= $ex->getMessage();
			$this->renderWithTemplate('users/add', 'AdminPageBaseTemplate');
		
		}
		
		
	}
	
	function edit($actionValue) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');
        $this->viewData['editrecord']=UserModel::Create()->SelectUser($actionValue);
        // Render the action with template
        $this->renderWithTemplate('users/edit', 'AdminPageBaseTemplate');
    }
	
	function editsubmit() 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');
		try
		{
		
			if (!empty($_POST['username'])&& !empty($_POST['firstname']) && !empty( $_POST['role']) && !empty($_POST['email']))
			{
				$userId=$_POST['userid'];
				$userName=$_POST['username'];
				$email=$_POST['email'];
			
				$firstname=$_POST['firstname'];
				$middlename=$_POST['middlename'];
				$lastname=$_POST['lastname'];
				$role=$_POST['role'];
				$phoneres=$_POST['phoneres'];
				$phonecell=$_POST['phonecell'];
				$isActive=$_POST['status'];
				$isLocked=$_POST['locked'];
				$comments=$_POST['comments'];
				
			  
				UserModel::Create()->UpdateUser( $userId, $userName,$email, $firstname, $middlename, $lastname, $role, $phoneres, $phonecell, $isActive, $isLocked, $comments);
				
				$this->renderWithTemplate('users/editsubmit', 'AdminPageBaseTemplate');
			}
			else
			{
				$this->viewData['module']="Edit User";
				$this->viewData['error']= "Please Enter all the Required Fields and submit"; 
				$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
			}
		}
		catch (Exception $ex)
		{
			$this->viewData['module']="Edit User";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('users/error', 'AdminPageBaseTemplate');
		}
			
			
	}
	
	function delete($recordID) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');

            
	    if(UserModel::Create()->UpdateIsActive($recordID)==1)
		{$this->renderWithTemplate('users/delete', 'AdminPageBaseTemplate');}
		else
		{$this->renderWithTemplate('users/error', 'AdminPageBaseTemplate');}
    }
	function listall($actionValue) 
	{
	//echo ':Home Controller: <pre>'. print_r("Home Controller ListAll" ). '</pre>';
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');
        
        // Get all articles and store them in the 'pages' view data structure
			$this->viewData['users'] = UserModel::Create()->SelectAllUsers();
		
       			
        // Render the action with template
        $this->renderWithTemplate('users/listall', 'AdminPageBaseTemplate');
    }  
	
	function login() 
	{
	//echo ':Home Controller: <pre>'. print_r("Home Controller ListAll" ). '</pre>';
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        
        
         // check for cookies and if set validate and redirect to corresponding page
		$this->viewData['navigationPath'] = $this->getNavigationPath('users');
		$this->renderWithTemplate('users/login', 'MemberPageBaseTemplate');
		
    }  
	
	function loginme() 
	{
	 // Specify the navigation column's path so we can include it based
     //   on the action being rendered
        
		$email=$_POST['email'];
		$password=$_POST['password'];
		$rememberme=(isset($_POST['rememberme']))?$_POST['rememberme']:"no";
		
		//$email=ValidateUtility::checkInput($_POST['email'],"Enter a Valid Email","email");
		//$password=ValidateUtility::checkInput($_POST['password'],"Enter a Valid Password","text");
			ViewHelper::LogString("Login Me - Test");
				
			$this->autoLogin($email, $password, $rememberme);
				
									
	}
	
	function logout() 
	{
	//echo ':Home Controller: <pre>'. print_r("Home Controller ListAll" ). '</pre>';
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('admin');
      
		User::Logout();
        // Render the action with template
        $this->renderWithTemplate('users/login', 'MemberPageBaseTemplate');
    }  
	
	function autoLogin($email, $password, $rememberme)
	{
		
			if( User::Login ($email, $password)===true)
			{
				if ($rememberme ="rememberme")
				{	 setcookie("email",$email,time()+60*60*24*30);
					 setcookie("password",$password,time()+60*60*24*30);
					
				}
				$this->viewData['navigationPath'] = $this->getNavigationPath('member');
				$this->renderWithTemplate('member/index', 'MemberPageBaseTemplate');
			}
			else
			{ 
				$this->viewData['navigationPath'] = $this->getNavigationPath('home');
				$this->renderWithTemplate('home/index', 'FrontPageBaseTemplate');
			}
	
	
	}
	
	function activate($userid){
		 $this->viewData['navigationPath'] = $this->getNavigationPath('home');
		 User::Logout();
		 if (UserModel::Create()->ActivateAccount($userid)>0){
			$this->viewData['welcome'] = "Welcome to the Site";
			$this->renderWithTemplate('home/welcome','SubPageBaseTemplate');
			//$this->render('home/welcome');
		 }
		 
	}
	
	function forgotPassword() 
	{
	     $this->viewData['navigationPath'] = $this->getNavigationPath('admin');
 	
        // Render the action with template
		 $this->viewData['message'] ="If you forget the password, enter the Email address you have opened your account.<br> We will send you the instructions to reset your password in your inbox.";
        $this->renderWithTemplate('users/forgotpass', 'AdminPageBaseTemplate');
    }  
	
	function forgotPassEmail($actionValue) 
	{
	     $this->viewData['navigationPath'] = $this->getNavigationPath('admin');
		
		 if (isset($_POST['email']) && strlen($_POST['email']) > 2)
		{	//print_r($_POST['email']);
			$hash= UserModel::ForgotPassword($_POST['email']);
			if ($hash =='1')
			{ $this->viewData['message'] ="Email Does Not Exist";}
			else
			{ 
				MailModel::SendResetPassword($_POST['email'], $hash);
				$this->viewData['message'] ="Email Succesfully Send. Please Check your inbox";}
				// Render the action with template
				$this->renderWithTemplate('users/forgotpass', 'AdminPageBaseTemplate');
		}
		else
		{
			   $this->viewData['message'] ="Some Error Happened. Please Enter the Email Again. <br>We will send instructions to reset the password in your inbox";
		        $this->renderWithTemplate('users/forgotpass', 'AdminPageBaseTemplate');
		}

        
    }  
	
	function resetPassword($actionValue) 
	{
	     $this->viewData['navigationPath'] = $this->getNavigationPath('admin');
		
		if (isset($actionValue) && !empty($actionValue))
		{	//print_r($actionValue);
			 $this->viewData['hash'] =$actionValue;
			 $this->renderWithTemplate('users/changepassword', 'AdminPageBaseTemplate');
		}
		else
		{ 	$this->viewData['message'] ="Something unexpected happened. Try Again.If Problem Persist contact admininstrator";
			// Render the action with template
			$this->renderWithTemplate('users/changepassword', 'AdminPageBaseTemplate');
		}
       
    }  
	
	
}
?>


