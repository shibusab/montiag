<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';
//require_once './model/PostModel.php';
require_once './model/MenuModel.php';
require_once './utility/DateTimeUtility.php';
require_once './utility/ValidateUtility.php';

class MenuController Extends ControllerBase Implements IController
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
			default:$this->index($value);
			
		}
	}
	
    function index($actionValue) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('menus');
        
        // Get all articles and store them in the 'pages' view data structure
		// ActionValue==1 is list all the pages for home page, or list all the pages in the selected category 
		if ($actionValue==1)
			$this->viewData['pages'] = MenuModel::Create()->SelectAllMenus();
		else
			$this->viewData['pages'] = MenuModel::Create()->SelectMenu($actionValue);
       			
        // Render the action with template
        $this->renderWithTemplate('menus/index', 'AdminPageBaseTemplate');
    }  
 function view($actionValues) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('menus');
        
        // Get all articles and store them in the 'pages' view data structure
         $this->viewData['pages'] = MenuModel::Create()->SelectMenu($actionValues);
		$this->viewData['subpages']=PostModel::Create()->AdminSelectPostsByMenuID($actionValues);
       
        // Render the action with template
        $this->renderWithTemplate('menus/view', 'AdminPageBaseTemplate');
    }

  function add() 
  {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('menus');
        $this->viewData['sections'] = MenuModel::Create()->SelectAllSections();
		$this->viewData['languages'] = ConfigModel::Create()->GetLanguages();
        // Render the action with template
        $this->renderWithTemplate('menus/add', 'AdminPageBaseTemplate');
    }
	
	function addsubmit() 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('menus');
		try
		{
			// Use the add action's post form variables and the current precise time to insert an article.
			//    validate all post variables before inserting them to avoid a
			//   SQL Injection attack and ensure that we've working with clean data. 
			if (MenuModel::Create()->InsertMenu($_POST['menuid'],$_POST['langid'], $_POST['name'], $_POST['tag'],$_POST['sortorder'], $_POST['status'], $_POST['comments']))
			{    
				$this->renderWithTemplate('menus/addsubmit', 'AdminPageBaseTemplate');
			}
		}
		catch (Exception $ex)
		{
			$this->viewData['module']="Add Menu";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
		
	}
	
	function edit($actionValue) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('menus');
        $this->viewData['sections'] = MenuModel::Create()->SelectAllSections();
	   $this->viewData['languages'] = ConfigModel::Create()->GetLanguages();
		$this->viewData['editrecord']=MenuModel::Create()->SelectMenu($actionValue);
        // Render the action with template
        $this->renderWithTemplate('menus/edit', 'AdminPageBaseTemplate');
               
    }
	
	function editsubmit() 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('menus');
		try
		{
			$sectionId=$_POST['sectionid'];
			$menuId=$_POST['menuid'];
			$name=ValidateUtility::checkInput($_POST['name'],"Enter Name", "text");
			$tag=ValidateUtility::checkInput($_POST['tag'],"Enter Tag", "text");
			$sortorder=ValidateUtility::checkInput($_POST['sortorder'],"Enter the Sort Order", "number");
			$langid=$_POST['langid'];
			$isactive=$_POST['status'];
			$comments=ValidateUtility::checkInput($_POST['comments'],"", "text");
		   
			MenuModel::Create()->UpdateMenu($sectionId, $menuId, $langid, $name, $tag, $sortorder, $isactive, $comments);
			$this->renderWithTemplate('menus/editsubmit', 'AdminPageBaseTemplate');
		}
		catch (Exception $ex)
		{
			$this->viewData['module']="Edit Menu";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
		
		
	}
	
	function delete($recordID) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('menus');

        // Get the current precise time, including milliseconds
		try
		{
		   if (MenuModel::Create()->UpdateIsActiveMenu($recordID)==1)
			{      
				$this->renderWithTemplate('menus/delete', 'AdminPageBaseTemplate');
			}
			else
			{
				$this->renderWithTemplate('menus/error', 'AdminPageBaseTemplate');
			}
		}
		catch (Exception $ex)
		{
			$this->viewData['module']="Delete Menu";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
		
    }
	function listall($actionValue) 
	{
	//echo ':Home Controller: <pre>'. print_r("Home Controller ListAll" ). '</pre>';
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('menus');
        
        // Get all articles and store them in the 'pages' view data structure
			$this->viewData['pages'] = MenuModel::Create()->SelectAllMenus();
		
       			
        // Render the action with template
        $this->renderWithTemplate('menus/listall', 'AdminPageBaseTemplate');
    }  
	
	
}
?>


