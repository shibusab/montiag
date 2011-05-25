<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';
require_once './model/UserModel.php';
require_once './model/GroupModel.php';
require_once './utility/DateTimeUtility.php';
require_once './utility/ValidateUtility.php';

class MemberController Extends ControllerBase {
	
    function index($actionValue) 
	{
		
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('member');
		if (isset($_SESSION['userid'])){
        		$this->viewData['user'] = UserModel::Create()->SelectUser($_SESSION['userid']);
		}
		else{
			throw new AppException("User Not Logged In");
		}
       			
        
        $this->renderWithTemplate('member/index', 'MemberPageBaseTemplate');
    }  
 function view($actionValues) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');
        
        // Get all articles and store them in the 'pages' view data structure
        $this->viewData['users'] = UserModel::Create()->SelectUser($actionValues);
       
        // Render the action with template
        $this->renderWithTemplate('users/view', 'MemberPageBaseTemplate');
    }

  function add() 
  {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');
        
        // Render the action with template
        $this->renderWithTemplate('users/add', 'MemberPageBaseTemplate');
    }
	
	function addsubmit() 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');

      
        // Use the add action's post form variables and the current precise time to insert an article.
        //    validate all post variables before inserting them to avoid a
        //   SQL Injection attack and ensure that we've working with clean data. 
        $result= UserModel::Create()->InsertUser($_POST['email'], $_POST['password'], $_POST['name'],$_POST['role'], $_POST['phoneres'], $_POST['phonecell'], $_POST['status'], $_POST['comments']);
		print_r($result);
		if(empty($result))
		{
			$this->renderWithTemplate('users/error', 'MemberPageBaseTemplate');
		}
	    else       
        {
			$this->renderWithTemplate('users/addsubmit', 'MemberPageBaseTemplate');
		}
	}
	
	function delete($recordID) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');

            
	    if(UserModel::Create()->UpdateIsActive($recordID)==1)
		{$this->renderWithTemplate('users/delete', 'MemberPageBaseTemplate');}
		else
		{$this->renderWithTemplate('users/error', 'MemberPageBaseTemplate');}
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
        $this->renderWithTemplate('users/listall', 'MemberPageBaseTemplate');
    }  
	
	function listgroups($actionValue) 
	{
	//echo ':Home Controller: <pre>'. print_r("Home Controller ListAll" ). '</pre>';
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('member');
        
	
		
       if (isset($_SESSION['userid'])){
        		$this->viewData['groups'] = GroupModel::Create()->SelectByOwner($_SESSION['userid']);
		}
		else{
			throw new AppException("User Not Logged In");
		}
       		
	      			
        // Render the action with template
        $this->renderWithTemplate('member/listgroups', 'MemberPageBaseTemplate');
    }  

	
	
}
?>


