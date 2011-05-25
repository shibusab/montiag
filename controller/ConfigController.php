<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';
require_once './utility/DateTimeUtility.php';
require_once './utility/ValidateUtility.php';

class ConfigController Extends ControllerBase Implements IController
{
	public function Redirect($action, $value)
	{
		//print_r($action . ' - ' . $value);
		switch ($action)
		{
			case 'index': $this->index($value); break;
			case 'view':$this->view($value);break;
			case 'edit':$this->edit($value);break;
			case 'editsubmit':$this->editsubmit();break;
			case 'listall':$this->listall($value);break;
			case 'delete':$this->delete($value);break;
			case 'addsubmit':$this->addsubmit();break;
			default:$this->index($value);
	
		}
	}
    function index($actionValue) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('config');
        
      
		// ActionValue==1 is list all the pages for home page, or list all the pages in the selected category 
		if ($actionValue==1)
			$this->viewData['config'] = ConfigModel::Create()->SelectAll();
		else
			$this->viewData['config'] = ConfigModel::Create()->SelectById($actionValue);
       			
        // Render the action with template
        $this->renderWithTemplate('config/index', 'AdminPageBaseTemplate');
    }  
 function view($actionValues) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('config');
        
        $this->viewData['pages'] = ConfigModel::Create()->SelectById($actionValues);

       
        // Render the action with template
        $this->renderWithTemplate('config/view', 'AdminPageBaseTemplate');
    }

  
	function edit($actionValue) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
		$this->viewData['navigationPath'] = $this->getNavigationPath('config');
		$this->viewData['editrecord']=ConfigModel::Create()->SelectById($actionValue);
        // Render the action with template
        $this->renderWithTemplate('config/edit', 'AdminPageBaseTemplate');
               
    }
	
	function editsubmit() 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('config');
		try
		{
			$configId=$_POST['configid'];
			$configname=ValidateUtility::checkInput($_POST['configname'],"Enter Name", "text");
			$configvalue=ValidateUtility::checkInput($_POST['configvalue'],"Enter Value", "text");
			$langid=$_POST['langid'];
			$isactive=$_POST['status'];
			$hyperlink=""; // later update with the link from UI
					   
			ConfigModel::Create()->Update($configId, $langid, $configname,$hyperlink, $configvalue, $isactive);
			$this->renderWithTemplate('config/editsubmit', 'AdminPageBaseTemplate');
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
				$this->renderWithTemplate('config/delete', 'AdminPageBaseTemplate');
			}
			else
			{
				$this->renderWithTemplate('config/error', 'AdminPageBaseTemplate');
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
        $this->viewData['navigationPath'] = $this->getNavigationPath('config');
        
        // Get all articles and store them in the 'pages' view data structure
			$this->viewData['pages'] = ConfigModel::Create()->SelectAll();
		
       	//print_r($this->viewData['pages']);		
        // Render the action with template
        $this->renderWithTemplate('config/listall', 'AdminPageBaseTemplate');
    }  
	
	
}
?>


