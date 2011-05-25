<?php

require_once ('./lib/ModelBase.php');
require_Once ('./utility/GuidUtility.php');
require_Once ('./utility/DateTimeUtility.php');

//  Encapsulates all Config database table access.

class ConfigModel extends ModelBase {
    private static $configModel = NULL;
    
    private function __construct() {
    }
    
    // The create function is necessary to ensure there
    //   is only one instance of PostDbAccess being used
    //   at any one time (eg. singleton)
    static function Create() 
	{
        if (NULL == self::$configModel) {
           self::$configModel = new ConfigModel();
        }
        return self::$configModel;
    }
    
	 public function IsActive($configid) 
	{
       $sql = "SELECT isactive"
                . " FROM config "
                . " WHERE configid = '" . $configid . "' " 
                . " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
	
	// Retrieves an config row by its key and language id    
    public function SelectHomePageElements($language)
	{
	$homepage="homepage-" . $language;
	global $cache;
	
	$data = $cache->get($homepage);
	 
	if ($data === FALSE) {
       $sql = "SELECT configname, configvalue, hyperlink "
                . " FROM config "
                . " WHERE langid= '" . $language . "'"
			   . " ORDER BY configid ";
          //   echo "Setting cache";
		$data= parent::query($sql);
		$cache->set($homepage, $data);  
	}
	   //print_r($data);
        return $data;
		
    }
	
	// Retrieves all items of the table config 
    public function SelectAll()
	{
	    $sql = "SELECT configid, configname, configvalue, hyperlink, langid, isactive "
			. " FROM config "
			. " ORDER BY configid ";
             
		return  parent::query($sql);
	  
    }
	// Retrieves an config row by its key and language id    
    public function SelectKey($configName,$language)
	{
       $sql = "SELECT configvalue "
                . " FROM config "
                . " WHERE configname LIKE '" . $configName . "' AND langid= '" . $language . "' "
                . " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
	
		
    // Retrieves an config row by its key and language id    
    public function Select($configName,$language)
	{
       $sql = "SELECT configid, langid,configname,configvalue, hyperlink,isactive"
                . " FROM config "
                . " WHERE configname LIKE '" . $configName . "' AND langid= '" . $language . "' "
                . " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
	
	// Retrieves an config row by its key     
    public function SelectById($configid)
	{
       $sql = "SELECT configid, langid,configname,configvalue,hyperlink,isactive, createdon, lastupdatedon"
                . " FROM config "
                . " WHERE configid = '" . $configid . "' "
                . " LIMIT 1";
        //print_r($sql);
        return parent::queryFirst($sql);
    }
    
	
    // Adds a row into the config table and
    //   returns its id
	// createddate and updated date is assumed as now.
    public function Insert($langid, $configname, $configvalue, $hyperlink,$isactive) 
	{
	   $createdOn=DateTimeUtility::now();
        $sql = "INSERT INTO config "
			. "("
			. "configname, "
			. "configvalue, "
			. "hyperlink, "
			. "isactive, "
			. "createdon, "
			. "lastupdatedon "
			. ") VALUES ("
			. "'" . $configname . "', "
			. "'" . $configvalue . "', "
			. "'" . $hyperlink . "', "
			. "'" . $isactive . "', "
			. "'" . $createdOn . "', "
			. "'" . $createdOn . "' "
			. ");";
        
	//	echo '<pre>' . print_r($sql, true) . '</pre>';
        parent::execute($sql);
        
        return $menuId;
    }
	
	// Update a row into the config table
	// update the hyperlink once getting values from UI
     public function Update($configid, $langid, $configname, $hyperlink, $configvalue, $isactive) 
	{
		$updatedOn=DateTimeUtility::now();
		$sql = "Update config "
				. "SET "
				. " langid = '" . $langid . "',"
				. " configname = '". $configname . "' ,"
				. " configvalue = '"	. $configvalue . "' ,"
			//	. " hyperlink = '"	. $hyperlink . "' ,"
				. " lastupdatedon = '" . $updatedOn . "' ,"
				. " isactive = '" . $isactive . "' "
				. " WHERE "
				. " configid= '" . $configid . "'";
        
	 print_r($sql);
        parent::execute($sql);
    }
	
	// Mark the config table as retired by making isactive = 0
	// Mark the config table as active by making isactive = 1
	 public function UpdateIsActive($menuId)
	 {
		$result=$this->IsActive($configId);
	
		if ($result['isactive'] =='1')
			$isActive='0';
		else
			$isActive='1';
					
        $sql = "Update config "
				. " SET isactive = '"
				. $isActive . "'"
				. " WHERE  configid = '"
				. $configid . "'";
        
        return parent::execute($sql);
		// $result->isactive  for mysql queries

    }


	// Delete a row from config table 
    public function Delete($configid)
	{
        $sql = "DELETE FROM  config "
                . " WHERE configid = '"
                . $configid . "'";
				
        return parent::execute($sql);
       
    }
	
	/* 
		Languages
	*/
	
	public function GetLanguages()
	{
		$cachePage="languages";
		global $cache;
	
		$data = $cache->get($cachePage);
	 
		if ($data === FALSE) {
			$sql = "SELECT langid, name "
                . " FROM language ";
                       
			$data= parent::query($sql);
			$cache->set($cachePage, $data);  
		}
	   //print_r($data);
        return $data;
	}
}
?>