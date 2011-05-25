<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';
require_once './model/PostModel.php';
require_once './utility/DateTimeUtility.php';
require_once './utility/ValidateUtility.php';

class ArticleController Extends ControllerBase Implements IController
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
			case 'addmedia':$this->addmedia();break;
			case 'editmedia':$this->editmedia($value);break;
			case 'addsubmit':$this->addsubmit();break;
			case 'editsubmit':$this->editsubmit($value);break;
			case 'delete':$this->delete($value);break;
			default:$this->index($value);
			
		}
	}
    function index($actionValue) 
	{
	    // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('articles');
        
		try{
			// Get all articles and store them in the 'posts' view data structure
			// ActionValue==1 is list all the posts for home page, or list all the posts in the selected category 
			if ($actionValue==1)
				$this->viewData['posts'] = PostModel::Create()->SelectAllPosts();
			else
				$this->viewData['posts'] = PostModel::Create()->SelectPostsByMenuID(mysql_real_escape_string($actionValue));
					
			// Render the action with template
			$this->renderWithTemplate('articles/index', 'AdminPageBaseTemplate');
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="List Articles";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }  
 function view($actionValues) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('articles');
        
		try
		{
        // Get all articles and store them in the 'post' view data structure
        $this->viewData['post'] = PostModel::Create()->AdminSelectPostByPostID($actionValues);
       
        // Render the action with template
        $this->renderWithTemplate('articles/view', 'AdminPageBaseTemplate');
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="List Article";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }
	
	function listall($actionValue) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('articles');
        //print_r($_POST['menuid']);
		try
		{
			// Get all articles and store them in the 'posts' view data structure
			if (isset($_POST['menuid']))
			{$menuid=$_POST['menuid'];}
			else
			{$menuid=1;}
			
			//$this->viewData['posts'] = PostModel::Create()->AdminSelectAllPostHeadings($menuid);
		       $this->viewData['posts'] = PostModel::Create()->AdminSelectAllPostHeadings_temp();
			  
			// Render the action with template
			$this->renderWithTemplate('articles/listall', 'AdminPageBaseTemplate');
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="List All Articles";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    } 

  function add() 
  {
	//debug_print_backtrace();
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('articles');
        $this->viewData['languages'] = ConfigModel::Create()->GetLanguages();
        // Render the action with template
        $this->renderWithTemplate('articles/add', 'AdminPageBaseTemplate');
    }
	
	function addmedia() 
  {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('articles');
        
        // Render the action with template
        $this->renderWithTemplate('articles/addmedia', 'AdminPageBaseTemplate');
    }
	
	function addsubmit() 
	{
		//debug_print_backtrace();
	   // Specify the navigation column's path so we can include it based
        // on the action being rendered
		try
		{
			$this->viewData['navigationPath'] = $this->getNavigationPath('articles');

			// Get the current precise time, including milliseconds
			list($s, $ms) = DateTimeUtility::getPreciseTime();
			$s=DateTimeUtility::FormatAsSqliteDate($_POST['postdate']);
			$menuid =$_POST['menuid'];
			$langid= $_POST['langid'];
			$authorid=$_SESSION['userid'];
			$pageName= addslashes($_POST['pagename']);
			$title=addslashes($_POST['title']);
			$body=addslashes($_POST['body']);
			$status=$_POST['status'];
			$displayfull=$_POST['displayfull'];
			$displayhomepage=$_POST['displayhomepage'];
			$ispublic=$_POST['ispublic'];
			$posttype=$_POST['posttype'];
					
			$result=PostModel::Create()->InsertPost($menuid, $langid,  $authorid, $pageName, $title, $body, $s , $status, $displayfull, $displayhomepage,$ispublic, $posttype); 
			
			if ($result == NULL)
			{ throw new exception("Error-Failed to All the Article");}
			else
       		{$this->renderWithTemplate('articles/addsubmit', 'AdminPageBaseTemplate');}
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="Add New Article";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('articles/add', 'AdminPageBaseTemplate');
		}
    }
	
	function editsubmit() 
	{
	
	try{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('articles');

        // Get the current precise time, including milliseconds
         list($s, $ms) = DateTimeUtility::getPreciseTime();
		$s=DateTimeUtility::FormatAsSqliteDate($_POST['postdate']);
		$menuid =$_POST['menuid'];
		$langid= $_POST['langid'];
		$authorid=$_SESSION['userid'];
		$pageName= addslashes($_POST['pagename']);
		$title=addslashes($_POST['title']);
		$title= $_POST['title'];
		$body=addslashes($_POST['body']);
		$status=$_POST['status'];
		$displayfull=$_POST['displayfull'];
		$displayhomepage=$_POST['displayhomepage'];
		$ispublic=$_POST['ispublic'];
		$posttype=$_POST['posttype'];
		
		
	    $result=PostModel::Create()->UpdatePost($_POST['postid'], $menuid,$langid, $pageName,  $title, $authorid, $body, $s , $_POST['status'], $displayfull, $displayhomepage,$ispublic, $posttype); 
      	//print_r($result);
		$this->renderWithTemplate('articles/editsubmit', 'AdminPageBaseTemplate');
		
		}catch (Exception $ex)
		{ 
			$this->viewData['module']="Edit Article";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
		
		
    }
	
	function delete($recordID) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('articles');

		
        try
		{
		$result=PostModel::Create()->UpdatePostStatus($recordID);
		print_r($result);
	    if($result > 0)
		{  $this->renderWithTemplate('articles/delete', 'AdminPageBaseTemplate');}
		else
        {$this->renderWithTemplate('articles/error', 'AdminPageBaseTemplate');}
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="Delete  Article";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }


	function edit($actionValue) 
	{
	
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('articles');
		
		try
		{
		$this->viewData['editrecord']=PostModel::Create()->AdminSelectPostByPostID($actionValue);
		$this->viewData['languages'] = ConfigModel::Create()->GetLanguages();
         // Render the action with template
         $this->renderWithTemplate('articles/edit', 'AdminPageBaseTemplate');
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="Edit  Article";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }	
	
	function editmedia($actionValue) 
	{
	
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('articles');
		
		try
		{
		$this->viewData['editrecord']=PostModel::Create()->AdminSelectPostByPostID($actionValue);
         // Render the action with template
         $this->renderWithTemplate('articles/editmedia', 'AdminPageBaseTemplate');
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="Edit  Article";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }	
	
}
?>


