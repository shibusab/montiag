<?php
$time_start = microtime(1);
require_once './lib/AppException.php';
require_once './lib/router.php';
require_once './lib/Cache.php';
require_once './lib/Registry.php';

define ("DEBUG" ,"1" );

ini_set('display_errors', 0); 
ini_set('log_errors', 1); 
ini_set('error_log', Registry::get('ROOTDIR') . '/error_log.txt'); 
error_reporting(E_ALL);

Registry::set('ROOTDIR' ,'c:\wamp\www\montiag');
Registry::set('cachePath','c:\log');
Registry::set('frommail','Pastor Jose Romero');
Registry::set('fromname','pastor@montiag.com');
Registry::set('replyto','pastor@montiag.com');
Registry::set('baseurl','http://localhost/montiag');
Registry::set('currenttemplate','template2');
if(isset($_SESSION['langid']))
{	Registry::set('currentlang', $_SESSION['langid']);}
else
{	Registry::set('currentlang','es-hn');}

//$baseUrl = 'http://localhost/montiag';
//$currentTemplate='template2';

date_default_timezone_set('America/New_York');
//echo ini_get('date.timezone');

if(!isset($_SESSION))
{session_start();}

$cache= new Cache(Registry::get('cachePath'));
$homepage="";

if (!empty($_GET['route'])){ 
	$actionValue = explode('/',strtolower($_GET['route']));
}
else{
	$actionValue=array('home','index','');
}


$router = new Router($actionValue);
$router->RouteUrl();	
$time_end = microtime(1); 
$time_elapsed = $time_end - $time_start; 
if (DEBUG)
{
	echo printf("<div align=\"center\">page generated in %f seconds </div>", $time_elapsed); 
	echo printf("<div align=\"center\">Memory Usage %f bytes </div>", memory_get_peak_usage()); 

}

?>