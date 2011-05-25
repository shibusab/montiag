<?php
require_once './utility/ViewHelper.php';
require_once './lib/User.php'; 
require_once './lib/Authenticate.php';
require_once './model/DbConfig.php';
require_once './interface/IMail.php';
require_once './interface/IController.php';
require_once './controller/ControllerFactory.php';

// The Router class 
// handles all routing logic
class Router 
{
	//private $url = '';
	//private $controller='home';
	private $controllerName = '';
	private $actionName = ''; 
	private $actionVal = '';
	private $secureControllers=array('menu','config','language','event','contactus','admin','article','file','user');
	
    function __construct($actionValue) 
	{  
		$this->ParseUrl($actionValue);
    }
  
 // Parses values to 
	//	controllerName
	//	actionName and
	//	actionVal
   private function ParseUrl($url)
   {
	   $arrLength=count($url);
	   $this->controllerName = strtolower($url[0]) ;
	  // $this->controller=$url[0];
	   
	   if (!empty($url[0]))
	   {$this->controllerName=strtolower($url[0]) ;}
	   if(!empty($url[1]))
	   {$this->actionName=strtolower($url[1]);}
	   if(!empty($url[2]))
	   {$this->actionVal=strtolower($url[2]);}
	  // echo ':From Router <pre>'. print_r('controller:'. $this->controllerName ). '</pre>';
	  // echo ':From Router <pre>'. print_r('action:'.$this->actionName ). '</pre>';
	}
	
    // routes the url based on controller and action
    public function RouteUrl()    
    {
		$controller=ControllerFactory::CreateController($this->controllerName);
		// Retreive page id for the pages
		if($this->actionName==='index' && !in_array($this->controllerName, $this->secureControllers))
		{ $this->actionVal=ViewHelper::GetPageId($this->controllerName);}
		
		$controller->Redirect($this->actionName,$this->actionVal);
	
	}
	
	
    
 
   
   
  
   
   
}
?>