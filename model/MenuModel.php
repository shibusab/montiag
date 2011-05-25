<?php

require_once ('./lib/ModelBase.php');
require_Once ('./utility/GuidUtility.php');
require_Once ('./utility/DateTimeUtility.php');

//  Encapsulates all Pages database table access.

class MenuModel extends ModelBase {
    private static $menuModel = NULL;
    
    private function __construct() {
    }
    
    // The create function is necessary to ensure there
    //   is only one instance of PostDbAccess being used
    //   at any one time (eg. singleton)
    static function Create() 
	{
        if (NULL == self::$menuModel) {
           self::$menuModel = new MenuModel();
        }
        return self::$menuModel;
    }
    
	 public function CheckMenuIsActive($menuId) 
	{
       $sql = "SELECT isactive"
                . " FROM menu "
                . " WHERE menuid LIKE '" . $menuId . "' "
                . " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
	
	public function GetMenuID($menu) 
	{
		//debug_print_backtrace();
		if ($menu != 'static') // always there comes a query with static, want to check not overcome the issue by hardcoding it
		{
		if (!isset($_SESSION[$menu]))
			{
		   $sql = "SELECT menuid"
					. " FROM menu "
					. " WHERE tag = '" . $menu . "' "
					. " LIMIT 1";
				
			//print_r($sql);
			$result=parent::queryFirst($sql);
		
			$_SESSION[$menu] = $result['menuid']; 
		}
	
		
		return $_SESSION[$menu];		
		}
		
    }
	
	
    // Retrieves an Menu row by its menuID    
    public function SelectMenu($menuId) 
	{
       $sql = "SELECT sectionid,menuid, langid, name, tag, sortorder,  isactive, comments, createdon, lastupdatedon"
                . " FROM menu "
                . " WHERE menuid LIKE '" . $menuId . "' "
                . " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
    
    // Retrieves all menus by SectionID
	// Sections - TopMenu
	//			- LeftMenu
	//			- RightMenu
	//			- FooterMenu
    public function SelectMenuBySectionID($menuId) 
	{
	
		$cachePage="menuBySection-" . $menuId;
		global $cache;
		$data = $cache->get($cachePage);
	 
		if ($data === FALSE) {
				$sql = "SELECT sectionid,menuid, langid, name, tag,isactive, comments,createdon"
				. " FROM menu "
				. " WHERE menuid = '" . $menuId . "' "
				. " ORDER BY id " ;
			//   echo "Setting cache";
			$data= parent::query($sql);
			$cache->set($cachePage, $data);  
		}
		//print_r($data);
        return $data;
    }
	
	 // Retrieves all menus by section tag
	// Sections - Top
	//			- Left
	//			- Right
	//			- Footer
    public function SelectActiveMenusBySectionID($tag, $langid) 
	{
		$cachePage=$tag . "-" . $langid;
		global $cache;
		$data = $cache->get($cachePage);
	 
		if ($data === FALSE) {
				$sql = "SELECT menu.menuid as menuid, menu.name as menu, menu.tag as tag, menu.langid as langid  "
				. " FROM menu INNER JOIN section ON menu.sectionid = section.sectionid "
				. " WHERE section.tag = '" . $tag . "' "
				. " AND menu.isactive = 1 AND menu.langid= '" . $langid . "'" 
				. " ORDER BY menu.sortorder  " ;
					
			$data= parent::query($sql);
			$cache->set($cachePage, $data);  
		}
	   //print_r($data);
        return $data;
	}
    
	 // Retrieves all Menus 
    public function SelectAllMenus() {
        $sql = "SELECT menu.sectionid as sectionid, section.name as sectionname, "
			. " menuid as menuid, menu.name as menu, menu.tag as tag,  "
			. " menu.sortorder as sortorder, menu.isactive as isactive,"
			. " menu.comments as comments, menu.createdon, menu.langid as langid "
			. " FROM menu, section " 
			. " WHERE menu.sectionid = section.sectionid "
			. " ORDER BY menu.sectionid, menu.sortorder " ;
				        
		//$sql= "SELECT * FROM menu";
		//print_r($sql);
        return parent::query($sql);
    }
	
	 // Retrieves all Menus whose status is active
	// Short Version
    public function SelectAllActiveMenus() {
        $sql = "SELECT  menuid , langid, name , sectionid"
			. " FROM menu "
			. " WHERE isactive=1 "
			. " ORDER BY menu.sectionid, menu.sortorder" ;
				        
		//$sql= "SELECT * FROM menu";
        return parent::query($sql);
    }
	
	
	
    // Adds an page row into the menu table and
    //   returns its id
	// createddate and updated date is assumed as now.
    public function InsertMenu($sectionId, $langId, $name, $tag, $sortorder, $isActive, $comments) 
	{
        $menuId = GuidUtility::newGuid();
	   $createdOn=DateTimeUtility::now();
        $sql = "INSERT INTO menu "
			. "("
			. "sectionid, "
			. "menuId, "
			. "langId, "
			. "name, "
			. "tag, "
			. "sortorder, "
			. "createdon, "
			. "lastupdatedon, "
			. "isactive, "
			. "comments "
			. ") VALUES ("
			. "'" . $sectionId . "', "
			. "'" . $menuId . "', "
			. "'" . $langId . "', "
			. "'" . $name . "', "
			. "'" . $tag . "', "
			. "'" . $sortorder . "', "
			. "'" . $createdOn . "', "
			. "'" . $createdOn . "', "
			. "'" . $isActive . "' , "
			. "'" . $comments . "' " 
			. ");";
        
	//	echo '<pre>' . print_r($sql, true) . '</pre>';
        parent::execute($sql);
        
        return $menuId;
    }
	
	 // Update post row into the menu table
    
    public function UpdateMenu($sectionId, $menuId, $langid, $name, $tag, $sortorder, $isactive, $comments) 
	{
		$updatedOn=DateTimeUtility::now();
		$sql = "Update menu "
				. "SET "
				. " sectionid = '" . $sectionId . "',"
				. " langid = '" . $langid . "', "
				. " name = '". $name . "' ,"
				. " tag = '"	. $tag . "' ,"
				. " sortorder= '" . $sortorder . "' ,"
				. " lastupdatedon = '" . $updatedOn . "' ,"
				. " isactive = '" . $isactive . "' ,"
				. " comments = '". $comments . "' "
				. " WHERE "
				. " menuId= '" . $menuId . "'";
        
	// print_r($sql);
        parent::execute($sql);
        
       
    }
	
	// Mark the menu table as retired by making isactive = 0
	// Mark the menu table as active by making isactive = 1
	 public function UpdateIsActiveMenu($menuId)
	 {
		$result=$this->CheckMenuIsActive($menuId);
	//	if ($result['isactive'] =='1')  // for Sqlite
	
		if ($result['isactive'] =='1')
			$isActive='0';
		else
			$isActive='1';
					
        $sql = "Update menu "
				. " SET isactive = '"
				. $isActive . "'"
				. " WHERE  menuid = '"
				. $menuId . "'";
        
        return parent::execute($sql);
		// $result->isactive  for mysql queries

    }
	 // Delete an post row into the menu table and
    public function DeleteMenu($menuId)
	{
        $sql = "DELETE FROM  menu "
                . " WHERE menuid = '"
                . $menuId . "'";
				
        return parent::execute($sql);
       
    }
	
	public function DeleteAllMenus()
	{
        $sql = "DELETE FROM  menu ";
  				
        return parent::execute($sql);
       
    }
	
	/*
	 ******************************************************
	 ******************************************************
					SECTION TABLE
	 ******************************************************
	 ******************************************************
	*/
	
	 // Adds Section Item into the section table and
    //   returns its Guid
    public function InsertSection($modeId, $langId, $name, $tag, $IsActive, $comments) 
	{
		$sectionId = GuidUtility::newGuid();
		$createdOn=DateTimeUtility::now();
		
        $sql = "INSERT INTO section "
                . "("
			   . "modeid, "
			   . "sectionId, "
			   . "langid, "
                . "name , "
                . "tag, "
			   . "createdon, "
                . "isactive, "
			   . "comments "
                . ") VALUES ("
			   . "'" . $modeId . "', "
			   . "'" . $sectionId . "', "
			   . "'" . $langId . "', "
                . "'" . $name . "', "
                . "'" . $tag . "', "
			   . "'".  $createdOn . "', "
                . "'" . $IsActive . "' , "
			   . "'" . $comments . "'" 
                . ");";
        
        parent::execute($sql);
        
        return $sectionId;
    }
	
	 // Retrieves all Pages 
    public function SelectAllSections() {
      //  $sql = "SELECT id, modeid,sectionid,langid, name, tag, createdon, isactive, comments"
	    $sql = "SELECT id, modeid,sectionid, langid, name, tag, createdon, isactive, comments"
                . " FROM section" 
			   . " ORDER BY id " ;
				        
        return parent::query($sql);
    }

}	

?>