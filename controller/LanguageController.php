<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';

class LanguageController Extends ControllerBase implements IController
{
	public function Redirect($action, $value)
	{
		//print_r($action . ' - ' . $value);
		switch ($action)
		{
			case 'set': $this->set($value);break;
			default: $this->set($value);
		}
	}
	
    function set($actionValue) 
	{
		$this->viewData['navigationPath'] = $this->getNavigationPath('home');
		
    	try
		{
			$langs=array('en-us','es-hn');
			if(in_array($actionValue,$langs))
			{
				Registry::set('currentLang',$actionValue);	
				$_SESSION['langid']=$actionValue;
				//setcookie("langid",$actionValue,time()+60*60*24*30);
				//print_r($currentLang);
			}
			// Render the action with template
			$this->viewData['posts'] = PostModel::Create()->SelectAllPosts();
			$this->viewData['events'] = EventModel::Create()->SelectAllEventHeadings();
			$this->viewData['pagetitle']= "Home"; 
			$this->renderWithTemplate('home/listall', 'HomePageBaseTemplate');
			$this->renderWithTemplate('home/index', 'HomePageBaseTemplate');
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="Language";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }  
  
	
}
?>


