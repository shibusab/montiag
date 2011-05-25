<?php
require_once './lib/ViewData.php';
require_once './lib/ControllerBase.php';
require_once './model/ContactModel.php';
require_once './model/MailModel.php';
require_once './utility/DateTimeUtility.php';
require_once './utility/ValidateUtility.php';
require_once './utility/IPUtility.php';

class ContactController Extends ControllerBase Implements IController
{
	
	public function Redirect($action, $value)
	{
		//print_r($action . ' - ' . $value);
		switch ($action)
		{
			case 'index': $this->index($value); break;
			case 'view':$this->view($value);break;
			case 'listall':$this->listall($value);break;
			case 'addsubmit':$this->addsubmit();break;
			default:$this->index($value);
			
		}
	}
    function index($actionValue) 
	{
		$this->prayerrequest();
	 /*	try
		{
			$this->viewData['navigationPath'] = $this->getNavigationPath('contactus');
			$this->viewData['contact'] = ContactModel::Create()->SelectAll();
			$this->renderWithTemplate('contactus/index', 'SubPageBaseTemplate');
		}
	catch (Exception $ex)
	{
		$this->viewData['error']= $ex->getMessage();
		$this->viewData['module']= "Contact";
		$this->renderWithTemplate('common/error', 'SubPageBaseTemplate');
	} */
    }  
 function view($actionValues) 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('contactus');
        
        $this->viewData['contact'] = ContactModel::Create()->SelectPostByPageName($actionValues);
      
        // Render the action with template
        $this->renderWithTemplate('contactus/view', 'SubPageBaseTemplate');
    }

  function prayerrequest() 
  {
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('home');
        
        // Render the action with template
        $this->renderWithTemplate('contactus/prayerrequest', 'SubPageBaseTemplate');
    }
	
	function addsubmit() 
	{
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('contactus');
		try{	
			$requestType= addslashes($_POST['requesttype']);
			$membershipNo=addslashes($_POST['membershipno']);
			$name=addslashes($_POST['name']);
			$email=addslashes($_POST['email']);
			$phone=addslashes($_POST['phone']);
			$prayerGroupName=addslashes($_POST['prayergroupname']);
			$subject=addslashes($_POST['subject']);
			$body=addslashes($_POST['body']);
			$visitorIP=IPUtility::VisitorIP();
			$langid= "en-us";
			
			 if (!empty($name) && !empty($prayerGroupName) && !empty($subject) && !empty($body))
			 { $result=ContactModel::Create()->Insert($langid, $requestType,$membershipNo, $prayerGroupName, $email, $phone, $subject, $body, $visitorIP);
			
				if ($result >0)
				{	
					//MailModel::SendPrayerRequestMail($membershipNo, $name, $email, $phone, $prayerGroupName,$subject, $body);
					$this->renderWithTemplate('contactus/addsubmit', 'SubPageBaseTemplate');
				}
				else
				{throw new Exception("Record Failed to Insert"); }
				}
				else
				{throw new Exception ("Please Enter the Prayer Request Fields.We cannot process partial/empty Form");}
		}
		catch (Exception $ex)
		{
			$this->viewData['error']= $ex->getMessage();
			$this->viewData['module']= "Contact";
			$this->renderWithTemplate('common/error', 'SubPageBaseTemplate');
		}
    }
	
	function listall($actionValue) 
	{
	//echo ':Home Controller: <pre>'. print_r("Home Controller ListAll" ). '</pre>';
        // Specify the navigation column's path so we can include it based
        //   on the action being rendered
        $this->viewData['navigationPath'] = $this->getNavigationPath('prayer');
        
        // Get all articles and store them in the 'posts' view data structure
			$this->viewData['contact'] = ContactModel::Create()->SelectAll();
		
       			
        // Render the action with template
        $this->renderWithTemplate('contactus/listall', 'SubPageBaseTemplate');
    }  
}
?>


