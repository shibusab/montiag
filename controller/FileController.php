<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';
require_once './model/FileModel.php';
require_once './utility/ValidateUtility.php';

class FileController Extends ControllerBase Implements IController
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
			case 'addsubmit':$this->addsubmit();break;
			case 'delete':$this->delete($value);break;
			default:$this->index($value);
			
		}
	}
	
    function index($actionValue) 
	{
	
	ViewHelper::Log($actionValue, "InFilecontroller");	
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('files');
        
        // Get all articles and store them in the 'pages' view data structure
		// ActionValue==1 is list all the pages for home page, or list all the pages in the selected category 
		if ($actionValue==1)
			$this->viewData['files'] = FileModel::Create()->SelectAllFiles();
		else
			$this->viewData['files'] = FileModel::Create()->SelectFiles($actionValue);
       			
        // Render the action with template
        $this->renderWithTemplate('files/index', 'AdminPageBaseTemplate');
    }  
 function view($actionValues) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('files');
        
        // Get all articles and store them in the 'pages' view data structure
        $this->viewData['files'] = FileModel::Create()->SelectFile($actionValues);
       
        // Render the action with template
        $this->renderWithTemplate('files/view', 'AdminPageBaseTemplate');
    }

  function add() 
  {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('files');
        
        // Render the action with template
        $this->renderWithTemplate('files/add', 'AdminPageBaseTemplate');
    }
	
	function addsubmit() 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('files');

		$file= $_FILES['image']['name'];
		$temp= $_FILES['image']['tmp_name'];
		$size= $_FILES['image']['size'];
		$type= $_FILES['image']['type'];
		$maxsize="200000"; // 2 mb limit
		$baseUrl=Registry::get('baseurl');
		
		if($type ="image/jpeg" || $type=="image/png" && $size <= $maxsize)
		{
			$destination = ConfigModel::create()->SelectKey("imagefolder", ViewHelper::getLanguage()); 
			if (isset($destination))
			{
				$destination= $destination[0] ."/".  strtolower($file);
				
			}
			else
			{ //set the default path as root
				$destination= $baseUrl . "/" . strlower($file);
			}
			print_r($destination);				
			if (@move_uploaded_file($temp,$destination)){
				$this->renderWithTemplate('files/addsubmit', 'AdminPageBaseTemplate');
				
				$message="File Uploaded";
			}else{
				$message="Upload Failed";
			}
			
		}else{
			$message="Incompatible Type or Big File";
		}
	    	    
       if(!empty($message))
	   {$this->renderWithTemplate('files/add', 'AdminPageBaseTemplate');}
        
	}
	
	function delete($recordID) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('users');

        // Get the current precise time, including milliseconds
    
	    UserModel::Create()->RetirePage($recordID);

        // Normally we might render the addsubmit action and indicate success or failure.
        //   For now, we're just going to redirect to the home/index action.
        //header('Location: ../home/index');
        
        // See previous comment.
        $this->renderWithTemplate('users/delete', 'AdminPageBaseTemplate');
    }
	function listall($actionValue) 
	{
	//echo ':Home Controller: <pre>'. print_r("Home Controller ListAll" ). '</pre>';
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('files');
        
		$baseUrl=Registry::get('baseurl');
		$dir = ConfigModel::create()->SelectKey("imagefolder", ViewHelper::getLanguage()); 
			if (isset($dir))
			{
				$destination= $dir[0];
				$this->viewData['fullpath'] = $baseUrl . "\\". $destination;
				
			}
			else
			{ //set the default path as root
				$destination= $baseUrl;
				$this->viewData['fullpath'] = $destination;
			}
				
		
		if(is_dir($destination)){
			$this->viewData['files'] = FileModel::Create()->getDirectoryList($destination);
		}
		else{
			echo "Sorry Folder does not Exist";
		}
		
		
       			
        // Render the action with template
        $this->renderWithTemplate('files/listall', 'AdminPageBaseTemplate');
    }
	
	
}
?>


