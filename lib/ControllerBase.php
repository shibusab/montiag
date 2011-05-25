<?php
require_once ('./model/DbConfig.php');

// ControllerBase contains all of the base functions necessary for
//   each controller class to process page logic as easily as
//   possible
abstract class ControllerBase {
    protected $viewData;    
    
    function __construct() {
	//(DEBUG=='1')? ViewHelper::LogString("Initialized ControllerBase"):"";
        $this->viewData = new ViewData();
    }
    
    // Renders a view
    protected function render($view) {
        // Render the view in the view/controller/action folder
        $viewPath = './' . 'view' . DIRECTORY_SEPARATOR . $view . '.php';
		// render as language/en-us.php  
		$currentLang = Registry::get('currentlang');
	    $langPath='./' . 'language' . DIRECTORY_SEPARATOR . $currentLang . '.php';

        // Check to make sure the view file we're attempting to render exists
        if (file_exists($viewPath) == false) {
                 trigger_error ('Template `' . $template . '` does not exist in' .$templatePath , E_USER_NOTICE);
				//redirect to another page - we are shudown
				$this->ShowError();
                return false;
        }    
	
		// Check to make sure the language file we're attempting to render exists
        if (file_exists($langPath) == false) {
                  trigger_error ('Template `' . $template . '` does not exist in' .$templatePath , E_USER_NOTICE);
				//redirect to another page - we are shudown
				$this->ShowError();
                return false;
        }   		
        
        // Transform the viewData structure into variables for use on the rendered
        //   view page
        foreach ($this->viewData as $key => $value) {
                $$key = $value;
        }
        
        // And finally, include the actual view page
	   include_once ($langPath);
        include_once ($viewPath);
    }
    
    // Gets the path to the navigation file, used for rendering
    //   a view's navigation section
    protected function getNavigationPath($view) {
        return './' . 'view' . DIRECTORY_SEPARATOR . $view . DIRECTORY_SEPARATOR . '_navigation.php';      
    }
    
    // Renders a view using the specified template
    protected function renderWithTemplate($view, $template) {
	// function renderWithTemplate($view, $template) {
		//(DEBUG=='1')? ViewHelper::LogString("In function=ControllerBase::RenderwithTemplate"):"";
		$currentTemplate=Registry::get('currenttemplate');
		$currentLang = Registry::get('currentlang');
		$langid=ViewHelper::getLanguage();
        //this should render the view in the view/controller/action folder
        $viewPath = './' . 'view' . DIRECTORY_SEPARATOR . $view . '.php';
      //  $templatePath = './' . 'view' . DIRECTORY_SEPARATOR . '_template' . DIRECTORY_SEPARATOR . $template . '.php';
          $templatePath = './' . 'static' . DIRECTORY_SEPARATOR . $currentTemplate . '/_template' . DIRECTORY_SEPARATOR . $template . '.php';
		
		// render as language/en-us.php 
		$langPath='./' . 'language' . DIRECTORY_SEPARATOR . $langid . '.php';
        // Check to make sure the view file we're attempting to render exists
        if (file_exists($viewPath) == false) {
                trigger_error ('View `' . $view . '` does not exist.', E_USER_NOTICE);
                return false;
        }
        
        // Check to make sure the template file we're attempting to render exists
        if (file_exists($templatePath) == false) {
                trigger_error ('Template `' . $template . '` does not exist in' .$templatePath , E_USER_NOTICE);
				//redirect to another page - we are shudown
				$this->ShowError();
                return false;
        }
        
		// Check to make sure the language file we're attempting to render exists
        if (file_exists($langPath) == false) {
                trigger_error ('language `file does not exist in' . $langPath , E_USER_NOTICE);
				//redirect to another page - we are shudown
				$this->ShowError();
                return false;
        }  
		
        // Transform the viewData structure into variables for use on the rendered
        //   view page
        foreach ($this->viewData as $key => $value) {
                $$key = $value;
        }
        
        // And finally, include the actual view page
	   include_once ($langPath);
        include_once ($templatePath);    
    }
	
	private function ShowError()
	{
		ob_start();
		header('Location:' . Registry::get('baseurl') .'/maintenance.html');
		ob_flush();
	}
	
	
 }
?>