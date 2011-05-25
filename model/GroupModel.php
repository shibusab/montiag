<?php

require_once ('./lib/ModelBase.php');
require_Once ('./utility/GuidUtility.php');
require_Once ('./utility/DateTimeUtility.php');

//  Encapsulates all Pages database table access.

class GroupModel extends ModelBase {
    private static $groupModel = NULL;
    
    private function __construct() {
    }
    
    // The create function is necessary to ensure there
    //   is only one instance of PostDbAccess being used
    //   at any one time (eg. singleton)
    static function Create() 
	{
        if (NULL == self::$groupModel) {
           self::$groupModel = new GroupModel();
        }
        return self::$groupModel;
    }
    
	
	 public function IsActive($groupId) 
	{
       $sql = "SELECT isactive"
                . " FROM usergroup "
                . " WHERE groupid ='" . $groupId . "' "
                . " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
	
	
    // Retrieves a group  groupid    
    public function Select($groupId) 
	{
       $sql = "SELECT groupid, ownerid, name, pagename, description, isactive, ispublic,"
				." comments, membercount, createdon, lastupdatedon "
				. " FROM usergroup" 
				. " WHERE groupid = '" . $groupId . "'"
				. " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
	
	 // Retrieves all group by ownerid 
	 // Active and Inactive
    public function SelectByOwner($ownerId) 
	{
       $sql = "SELECT groupid, ownerid, name, pagename, description, isactive, ispublic,"
				." comments, membercount, createdon, lastupdatedon "
				. " FROM usergroup" 
				. " WHERE ownerid = '" . $ownerId . "'";
			
        
        return parent::query($sql);
    }
	
       
	 // Retrieves all Active records 
    public function SelectAllActive() {
        $sql = "SELECT groupid, name, pagename, description, isactive, ispublic,"
				." comments, membercount, createdon, lastupdatedon "
				. " FROM usergroup" 
				. " WHERE isactive=1 "
				. " ORDER BY lastupdatedon " ;
				        
        return parent::query($sql);
    }
	
	
    // Adds a user row into user table and
    //   returns the userid Guid
    public function Insert($name,$ownerId, $pagename, $description, $ispublic, $comments) 
	{
		$groupId = GuidUtility::newGuid();
		$createdOn=DateTimeUtility::now();
		$isActive='0';
		$membercount='0';
        $sql = "INSERT INTO usergroup "
             . "("
			. "groupid, "
			. "ownerid, "
			. "name, "
			. "pagename, "
			. "description, "
			. "isactive, "
			. "ispublic, "
			. "comments, "
			. "membercount, "
			. "createdon, "
			. "lastupdatedon "
			. ") VALUES ("
			. "'" . $groupId . "', "	
			. "'" . $ownerId . "', "
			. "'" . $name . "', "
			. "'" . $pagename . "', "
			. "'" . $description . "', "
			. "'" . $isActive . "', "
			. "'" . $ispublic . "', "	
			. "'" . $comments . "', "
			. "'" . $membercount . "', "
			. "'" . $createdOn . "', "
			. "'" . $createdOn . "'  "	
			. ");";
        
      if ( parent::execute($sql) >0 )
	     return $groupId;
	 else
		return NULL;
    }
	
	 // Update group table
    
    public function Update($groupId, $name, $pagename, $description, $ispublic, $comments) 
	{
		$updatedOn=DateTimeUtility::now();
		$sql = "Update usergroup "
				. " SET "
				. " name = " . $name . ","
				. " pagename = '". $pagename . "' ,"
				. " description = '"	. $description . "' ,"
				. " ispublic = '" . $ispublic . "' ,"
				. " lastupdatedon = '" . $updatedOn . "' ,"
				. " comments = '". $comments
				. " WHERE "
				. " groupId= '" . $groupId . "'";
        
	
        parent::execute($sql);
        
       
    }
	
	// Toggle isactive of group table  by setting isactive 
	
	 public function UpdateIsActive($groupid)
	 {
		$result=$this->IsActive($groupid);
		
		if ($result->isactive=='1')
			$isActive='0';
		else
			$isActive='1';
			
        $sql = "Update usergroup "
				. " SET isactive =  '"
				. $isActive . "'"
				. " WHERE  groupid = '"
				. $groupid . "'";
        
        return parent::execute($sql);

    }
	
	
	
	// Delete group row  
    public function Delete($groupid)
	{
        $sql = "DELETE FROM  usergroup "
                . " WHERE groupid = '"
                . $groupid . "'";
				
        return parent::execute($sql);
       
    }
	
	//Delete All groups
	public function DeleteAll()
	{
        $sql = "DELETE FROM  usergroup ";
  				
        return parent::execute($sql);
       
    }
	
	public function CreateTable()
	{
		$sql="CREATE TABLE usergroup "
				. " ( "
				. " groupid VARCHAR(50) PRIMARY KEY, "
				. " ownerid VARCHAR(50),"
				. " name VARCHAR(100) UNIQUE, "
				. " pagename VARCHAR(50), "
				. " description VARCHAR(1000), "
				. " membercount INTEGER, "
				. " isactive INTEGER, "
				. " ispublic INTEGER, "
				. " createdon DATE, "
				. " lastupdatedon DATE, "
				. " comments TEXT ) ";
									
		return parent::execute($sql);

	}
	public function DropTable()
	{
		$sql=" DROP TABLE usergroup ";
				
									
		return parent::execute($sql);

	}
	
	//	Role'1'= "Admin"; '2' ="Manager";'3'="Editor";'4'="User";
	public function CreateTableGroupMember()
	{
		$sql="CREATE TABLE groupmember "
				. " ( "
				. " groupid VARCHAR(50), "
				. " userid VARCHAR(50),"
				. " isactive INTEGER, "
				. " role INTEGER, "
				. " createdon DATE, "
				. " lastupdatedon DATE) ";
				
									
		return parent::execute($sql);

	}
	public function DropTableGroupMember()
	{
		$sql=" DROP TABLE groupmember ";
				
									
		return parent::execute($sql);

	}
	
}
?>