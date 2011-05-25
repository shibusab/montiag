<?php

require_once ('./lib/ModelBase.php');
require_Once ('./utility/GuidUtility.php');
//  Encapsulates all File access.

class FileModel extends ModelBase {
    private static $fileModel = NULL;
    
    private function __construct() {
    }
    
    // The create function is necessary to ensure there
    //   is only one instance of PostDbAccess being used
    //   at any one time (eg. singleton)
    static function Create() 
	{
        if (NULL == self::$fileModel) {
           self::$fileModel = new FileModel();
        }
        return self::$fileModel;
    }
    
   	function getDirectoryList ($directory) 
	{
		// create an array to hold directory list
		$results = array();

		// create a handler for the directory
		$handler = opendir($directory);
		$picFileExtn= Array("jpg", "gif","png");
		
		// open directory and walk through the filenames
		while ($file = readdir($handler)) 
		{
			// if file isn't this directory or its parent, add it to the results
			if ($file != "." && $file != "..") 
			{
				// gets the last three chars from the file name 
				// assuming  as file extension
				$fileExtn= strtolower(substr($file, -3,3));
		
				// check in the array for matching extension and add to array
				if (in_array($fileExtn, $picFileExtn))
				{	$results[] = $file;}
			}

		}

		// tidy up: close the handler
		closedir($handler);

		// done!
		return $results;

  }


	
    // Retrieves All Files
    public function SelectFile($fileName) 
	{
       
	}
	
	 // Retrieves All Files
    public function SelectFiles($extension) 
	{
       
	}
	
}
?>