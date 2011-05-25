<?php
require_once './lib/router.php';

// The ViewHelper encloses any helper methods used to render or manipulate the view.
//   This is mostly empty for now, but there are a number of functions useful to working
//   with a view that could go in here.
class ViewHelper {   
    function __construct($router) 
	{
    }
    
    // Creates a hyperlink url based on a controller and action
    static function createLinkUrl($controller, $action) 
	{
       $baseUrl=Registry::get('baseurl');
        
        echo $baseUrl . '/' . $controller . '/' . $action;        
    }
    
    // Creates a hyperlink url based on a static file url
    static function createStaticUrl($url) 
	{
            $baseUrl=Registry::get('baseurl');
        
        echo $baseUrl . '/static/' . $url;
    }
	
	static function RedirectToErrorPage()
	{
		
	}
	
	// this function strips all the spaces
	// from a given string- left, right  and middle
	static function StripAllSpaces($string)
	{
		$sPattern = '/\s*/m'; 
		$sReplace = ''; 
		return preg_replace( $sPattern, $sReplace, $string );
	}
	
	static function Encrypt($email, $password)
	{
		$salt= substr($email,1,2);
		$salt .=substr($password,-1,2);
		//return md5($password.$salt);
		return md5($password);
	}
	
	static function GetStatus($status)
	{
		$retVal='';
		switch ($status)
		{
			case '0': $retVal="Retired";break;
			case '1': $retVal="Active";break;
			case '2' : $retVal="Draft";break;
			default: $retVal="Unknown";
		}
		
		return $retVal;
	}
	static function GetHyperlinkType($status)
	{
		$retVal='';
		switch ($status)
		{
			case '1': $retVal="System";break;
			case '2' : $retVal="Static";break;
			case '3': $retVal="External";break;
			default: $retVal="Unknown";
		}
		
		return $retVal;
	}
	
	static function GetYesNo($status)
	{
		$retVal='';
		
		switch ($status)
		{
			case 1: $retVal="Yes";break;
			case 2 : $retVal="No";break;
			default: $retVal="No";
		}
		
		return $retVal;
	}
		
	static function GetRole($status)
	{
		$retVal='';
		switch ($status)
		{
			case '1': $retVal="Admin";break;
			case '2' : $retVal="Manager";break;
			case '3': $retVal="Editor";break;
			case '4': $retVal="User";break;
			default: $retVal="Unknown";
		}
		
		return $retVal;
	}


	static function ListLanguages()
	{
		return ConfigModel::create()->GetLanguages();
	}
	// List All the Pages
	// Parameter Value
	//	=1 - List All Menu Pages
	//	=2 - List Top Menu Pages
	//	=3 - List Side Menu Pages


     static function ListPages($val) 
	{
		
		$langid = self::getLanguage();
		//print_r($langid);
		if ($val=='1')	
		{ $pages=MenuModel::Create()->SelectAllActiveMenus($langid);}
		else if ($val=='2')
		{ $pages=MenuModel::Create()->SelectActiveMenusBySectionID("top", $langid);}
		else if ($val=='3')
		{  $pages=MenuModel::Create()->SelectActiveMenusBySectionID("sidemenu",$langid);}
		else if ($val=='4')
		{$pages=MenuModel::Create()->SelectActiveMenusBySectionID("admin",$langid);}
		else if ($val=='5') // for member related menus
		{$pages=MenuModel::Create()->SelectActiveMenusBySectionID("user",$langid);}
		elseif ($val=='23') // to list Top and Left sections used in add items page
		{
			$pages=MenuModel::Create()->SelectAllMenus();
			// Trim Home from the pages to list to display at edit and add pages
			if ($pages[0]['menu']=='Home')
			{unset($pages[0]);}
		 }
		
        return $pages;
    }
	
	//returns the pageid 
	// parameter - PageName to return the corresponding pageid
	static function GetPageId($pageName)
	{
	//print_r($pageName);
		return MenuModel::Create()->GetMenuID(strtolower($pageName));
	}
	
	static function Log( $variable, $message, $file='', $class='', $function = '')
	{
		$errorString = "Error From " 
			. $variable . " "
			. $message . " "
			. " File [" . $file
			. "] Class  [" . $class
			. "] Function [" . $function  . "]";
			
		//$trace = debug_backtrace(); 
		//echo "Function name is " . $trace[0]["function"]; 
		
		$cachePath=Registry::get('cachepath');
		$logFile= $cachePath . "/log.txt";	
		
		error_log("$errorString \n",3, "$logFile"); 
	
	}
	
	static function LogString($message)
	{
		$date= date("F j, Y, g:i a");
		$ip=IPUtility::GetRealIPAddress();
		$cachePath=Registry::get('cachepath');
		$logFile= $cachePath . '/log.txt';
		
		//print_r( $logFile);
		error_log( "$ip - $date - $message\n",3, $logFile); 
	
	}
	
/* Functions to display items in home page */
	static function GetHomePageElements()
	{
		
		$langid = self::getLanguage();
		//print_r($langid);
		return ConfigModel::Create()->SelectHomePageElements($langid);
		
		/*$results= ConfigModel::Create()->SelectHomePageElements($langid);
		print_r($results);
		return $results; */
	}
	
	
	
	function removeItemFromArray($list, $item) 
	{  
		return  array_diff($list, (array)$item);
	}
	
	static function getLanguage(){
	$langid=(isset($_COOKIE['langid']))? $_COOKIE['langid']:"";
	
		if (!isset($_SESSION['langid'])) { 
			$langid="en-us";}
		else{
			$langid=$_SESSION['langid'];
		}

	return $langid;
	}
	
	static function getProfileImageUrl($imagepath)
	{
		$baseUrl=Registry::get('baseurl');
		return (empty($imagepath))? $baseUrl ."/static/userimages/defaultimage.jpg": $baseUrl . '/static/userimages/'. $imagepath;
	}
}
?>