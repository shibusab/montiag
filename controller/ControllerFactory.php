<?php
require_once './controller/HomeController.php';
require_once './controller/ArticleController.php';
require_once './controller/MenuController.php';
require_once './controller/UserController.php';
require_once './controller/ContactController.php';
require_once './controller/LanguageController.php';
require_once './controller/MemberController.php';
require_once './controller/AdminController.php';
require_once './controller/AccountController.php';
require_once './controller/FileController.php';
require_once './controller/EventController.php';
require_once './controller/ConfigController.php';
//require_once './controller/GroupController.php';
//require_once './controller/PhotoController.php';

class ControllerFactory
{
	// Instantiates controller
	// Default redirects to homecontroller for users without login
	// redirects to admincontroller for controllers with login 
	static function CreateController($controllerName)
	{
		try
		{
			$controllers=array('home','account','language','contact'); //controllers without login
			$secureControllers=array('menu','config','language','event','contactus','admin','article','file','user');
			if (in_array($controllerName, $controllers))
			{$controller = ucfirst($controllerName) . 'Controller' ;}
			elseif (in_array($controllerName, $secureControllers))
			{
				if(User::IsAllowed($controllerName)) 
				{$controller = ucfirst($controllerName) . 'Controller' ;}
				else
				{$controller='AdminController';}
			}
			else
			{$controller='HomeController';}
			
			//print_r($controllerName);
			//debug_print_backtrace();
			return new $controller;
		}
		catch (Exception $ex)
		{
			trigger_error ('Error Loading Controller', E_USER_NOTICE);
			return new HomeController;
			//throw new AppException( $ex->getMessage());
			//debug_print_backtrace();
		}
		
	}

}

?>