<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';
require_once './model/PostModel.php';
require_once './model/MenuModel.php';
require_once './model/ConfigModel.php';
require_once './utility/DateTimeUtility.php';
require_once './utility/ValidateUtility.php';
require_once './interface/IController.php';

class HomeController Extends ControllerBase Implements IController 
{

	public function Redirect($action, $value)
	{
		//print_r($action . ' - ' . $value);
		switch ($action)
		{
			case 'index': $this->index($value); break;
			case 'view':$this->view($value);echo 1; break;
			case 'listall':$this->listall($value);break;
			case 'event':$this->event($value);break;
			case 'listposts':$this->listposts($value);break;
			case 'mobi': $this->mobindex($value);break;
			default:$this->index($value);
			
		}
		
	}
	
    function index($actionValue) 
	{
	try{
	
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('home');
        
        // Get all articles and store them in the 'posts' view data structure
		// ActionValue==1 is list all the posts for home page, or list all the posts in the selected category 
		
		global $homepage;
		if (empty($homepage))
			{$homepage=MenuModel::Create()->GetMenuID("home");}
			
	
		if ($actionValue==$homepage)
		{
			$this->viewData['posts'] = PostModel::Create()->SelectAllPosts();
			$this->viewData['events'] = EventModel::Create()->SelectAllEventHeadings();
			$this->viewData['pagetitle']= "Home"; 
			$this->renderWithTemplate('home/listall', 'HomePageBaseTemplate');
		}
		else
		{
			$this->viewData['posts'] = PostModel::Create()->SelectPostsByMenuID($actionValue);
			$this->viewData['pagetitle']= $actionValue; 
			$this->renderWithTemplate('home/index', 'SubPageBaseTemplate');
		}
       					
	}
	catch (Exception $ex)
	{
		$this->viewData['error']= $ex->getMessage();
		$this->viewData['module']= "Home";
		$this->renderWithTemplate('common/error', 'FrontPageBaseTemplate');
	}
    }  
	 function mobindex($actionValue) 
	{ 
	try{
	
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('home');
        
        // Get all articles and store them in the 'posts' view data structure
		// ActionValue==1 is list all the posts for home page, or list all the posts in the selected category 
		
		global $homepage;
		if (empty($homepage))
			{$homepage=MenuModel::Create()->GetMenuID("home");}
			
	
		/*if ($actionValue==$homepage)
		{*/
			$this->viewData['posts'] = PostModel::Create()->SelectAllPosts();
			$this->viewData['events'] = EventModel::Create()->SelectAllEventHeadings();
			$this->viewData['pagetitle']= "Home"; 
			$this->renderWithTemplate('home/listall', 'HomePageBaseTemplateHand1');
		/*}
		else
		{
			$this->viewData['posts'] = PostModel::Create()->SelectPostsByMenuID($actionValue);
			$this->viewData['pagetitle']= $actionValue; 
			$this->renderWithTemplate('home/index', 'SubPageBaseTemplate');
		}*/
       					
	}
	catch (Exception $ex)
	{
		$this->viewData['error']= $ex->getMessage();
		$this->viewData['module']= "Home";
		$this->renderWithTemplate('common/error', 'FrontPageBaseTemplate');
	}
    }  
 function view($actionValues) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('home');
       
        // Get all articles and store them in the 'post' view data structure
        $this->viewData['post'] = PostModel::Create()->SelectPostByPageName($actionValues);
     $this->viewData['pagetitle']= $actionValues; 
        // Render the action with template
        $this->renderWithTemplate('home/view', 'SubPageBaseTemplate');
    }
	
	
	function event($actionValues) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('home');
     
        // Get all articles and store them in the 'post' view data structure
        $this->viewData['event'] = EventModel::Create()->SelectEventByEventID($actionValues);
     
        // Render the action with template
        $this->renderWithTemplate('events/view', 'SubPageBaseTemplate');
    }

  	
	function listall($actionValue) 
	{
	//echo ':Home Controller: <pre>'. print_r("Home Controller ListAll" ). '</pre>';
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('home');
        
        // Get all articles and store them in the 'posts' view data structure
			$this->viewData['posts'] = PostModel::Create()->SelectAllPostHeadings();
		$this->viewData['pagetitle']= $actionValue; 
       			
        // Render the action with template
        $this->renderWithTemplate('home/listall', 'SubPageBaseTemplate');
    } 

// lists all posts from the userid
	function listposts($actionValue) 
	{
	   $this->viewData['navigationPath'] = $this->getNavigationPath('home');
       
        // Get all articles and store them in the 'pages' view data structure
			$this->viewData['posts'] = PostModel::Create()->SelectPostsByUser($actionValue);
		    		
        // Render the action with template
        $this->renderWithTemplate('home/listposts', 'SubPageBaseTemplate');
    }  
	
}
?>


