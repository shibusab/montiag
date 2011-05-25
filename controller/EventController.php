<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';
require_once './model/EventModel.php';
require_once './utility/DateTimeUtility.php';
require_once './utility/ValidateUtility.php';

class EventController Extends ControllerBase Implements IController
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
        $this->viewData['navigationPath'] = $this->getNavigationPath('events');
       
		try{
			// Get all articles and store them in the 'posts' view data structure
			// ActionValue==1 is list all the posts for home page, or list all the posts in the selected category 
			//if ($actionValue==1)
				$this->viewData['events'] = EventModel::Create()->SelectAllEvents();
			//else
			//	$this->viewData['event'] = EventModel::Create()->SelectEventsByMenuID(mysql_real_escape_string($actionValue));
					
			// Render the action with template
			$this->renderWithTemplate('events/index', 'AdminPageBaseTemplate');
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="List Events";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }  
 function view($actionValues) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('events');
        
		try
		{
        // Get all data and store them in the 'event' view data structure
        $this->viewData['event'] = EventModel::Create()->SelectEventByEventID($actionValues);
       
        // Render the action with template
		if (User::IsInRole(4))
		{$this->renderWithTemplate('events/view', 'SubPageBaseTemplate');}
		else
		{$this->renderWithTemplate('events/view', 'AdminPageBaseTemplate');}
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="List Event";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }

  function add() 
  {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('events');
        $this->viewData['languages'] = ConfigModel::Create()->GetLanguages();
        // Render the action with template
        $this->renderWithTemplate('events/add', 'AdminPageBaseTemplate');
    }
	
	
	function addsubmit() 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
		try
		{
			$this->viewData['navigationPath'] = $this->getNavigationPath('events');

        // Get the current precise time, including milliseconds
			
			$name= addslashes($_POST['eventname']);
			$langid= addslashes($_POST['langid']);
			$tagline= addslashes($_POST['tagline']);
			$smallpicurl="1";
			$bigpicurl="1";
			$host= addslashes($_POST['host']);
			$eventtype= addslashes($_POST['eventtype']);
			$eventstartdate = DateTimeUtility::FormatAsInsertDate($_POST['startdate']);
			$eventenddate= DateTimeUtility::FormatAsInsertDate($_POST['enddate']);
			$createdby =$_SESSION['userid'];
			$location= addslashes($_POST['location']);
			$lastupdatedby=$_SESSION['userid'];
			$status= addslashes($_POST['status']);
								
			$result=EventModel::Create()->Insert($name,$langid, $tagline,$smallpicurl,$bigpicurl,$host,$eventtype,$eventstartdate,$eventenddate,$createdby,$location,$lastupdatedby,$status); 
			if ($result == NULL)
			{ throw new exception("Error-Failed to All the Event");}
			else
       		{$this->renderWithTemplate('events/addsubmit', 'AdminPageBaseTemplate');}
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="Add New Event";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }
	
	function editsubmit() 
	{
	
	try{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('events');

        // Get the current precise time, including milliseconds
			$eventId=addslashes($_POST['eventid']);
			$name= addslashes($_POST['eventname']);
			$langid= addslashes($_POST['langid']);
			$tagline= addslashes($_POST['tagline']);
			$smallpicurl="1";
			$bigpicurl="1";
			$host= addslashes($_POST['host']);
			$eventtype= addslashes($_POST['eventtype']);
			$eventstartdate = DateTimeUtility::FormatAsInsertDate($_POST['startdate']);
			$eventenddate= DateTimeUtility::FormatAsInsertDate($_POST['enddate']);
			$location= addslashes($_POST['location']);
			$lastupdatedby=$_SESSION['userid'];
			$status= addslashes($_POST['status']);
		
		
	    $result=EventModel::Create()->Update($eventId,$name,$langid, $tagline,$smallpicurl,$bigpicurl,$host,$eventtype,$eventstartdate,$eventenddate,$location,$lastupdatedby,$status); 
      	//print_r($result);
		$this->renderWithTemplate('events/editsubmit', 'AdminPageBaseTemplate');
		
		}catch (Exception $ex)
		{ 
			$this->viewData['module']="Edit Event";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
		
		
    }
	
	function delete($eventID) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('events');

		
        try
		{
		$result=EventModel::Create()->UpdateStatus($eventID);
		//print_r($result);
	    if($result > 0)
		{  $this->renderWithTemplate('events/delete', 'AdminPageBaseTemplate');}
		else
        {$this->renderWithTemplate('events/error', 'AdminPageBaseTemplate');}
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="Delete  Event";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }
	
	function listall($actionValue) 
	{
	    // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('events');
        
		try
		{
			$this->viewData['events'] = EventModel::Create()->AdminSelectAllEventHeadings();
			  
			// Render the action with template
			$this->renderWithTemplate('events/listall', 'AdminPageBaseTemplate');
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="List All Events";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    } 

	function edit($actionValue) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('events');
		
		try
		{
		$this->viewData['editrecord']=EventModel::Create()->AdminSelectEventByEventID($actionValue);
		$this->viewData['languages'] = ConfigModel::Create()->GetLanguages();
         // Render the action with template
         $this->renderWithTemplate('events/edit', 'AdminPageBaseTemplate');
		}
		catch (Exception $ex)
		{ 
			$this->viewData['module']="Edit  Event";
			$this->viewData['error']= $ex->getMessage(); 
			$this->renderWithTemplate('common/error', 'AdminPageBaseTemplate');
		}
    }	
}
?>


