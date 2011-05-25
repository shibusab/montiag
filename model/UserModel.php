<?php

require_once ('./lib/ModelBase.php');
require_Once ('./utility/GuidUtility.php');
require_Once ('./utility/DateTimeUtility.php');

//  Encapsulates all Pages database table access.

class UserModel extends ModelBase {
    private static $userModel = NULL;
    
    private function __construct() {
    }
    
    // The create function is necessary to ensure there
    //   is only one instance of PostDbAccess being used
    //   at any one time (eg. singleton)
    static function Create() 
	{
        if (NULL == self::$userModel) {
           self::$userModel = new UserModel();
        }
        return self::$userModel;
    }
    
	
	 public function CheckUserIsActive($userId) 
	{
       $sql = "SELECT isactive"
                . " FROM user "
                . " WHERE userid ='" . $userId . "' "
                . " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
	
	// validate user
	// returns the userid and role of the user in an array
	
	 public function ValidateUser($email, $password)
	 {
		$encPassword=ViewHelper::Encrypt($email,$password);
		$sql = "SELECT userid,role FROM user "
				. " WHERE password = '" . $encPassword . "'"
				. " AND  email = '"   . $email . "'"
				. " AND islocked='0'"
				. " AND isactive='1'";
				//print_r($sql);
        
		try
		{
			$result= parent::query($sql);
			//returns a multidimensional array 
			//so take the count from first position
			//	if ($result[0]['count']>0) // for Sqlite
			//print_r($result[0]->userid);
			if (empty($result))
			{ $retVal='0';}			
			else if (strlen($result[0]['userid']) >0){
				$retVal['userid']= $result[0]['userid'];
				$retVal['role']=$result[0]['role'];
			}
			else{
				$retVal= '0';
			}
		}catch(AppException $e)
		{
			$retVal='0';
			echo $e->getMessage();
		}
				
		return $retVal;

    }
	
	
    // Retrieves a User row by userID    
    public function SelectUser($userId) 
	{
       $sql = "SELECT userid, siteuserid, email, firstname, middlename, lastname, role, phoneres, phonecell, isactive, islocked, comments,createdon"
                . " FROM user "
                . " WHERE userid LIKE '" . $userId . "' "
                . " LIMIT 1";
        
		//print_r($sql);
        return parent::queryFirst($sql);
    }
	
	// Retrieves a userid  by email    
    public function GetUserID($emailId) 
	{
       $sql = "SELECT userid"
                . " FROM user "
                . " WHERE email = '" . $emailId . "' "
                . " LIMIT 1";
        
		 $result=parent::query($sql);
			
		//print_r($result);
		if (empty($result))
		{return '0';}
		else
		{return $result[0]['userid'];}
    }
	
	    
    // Retrieves users by role
    public function SelectUsersByRole($role) {
	//echo ':PageID from PostModel: <pre>'. print_r($pageId). '</pre>';
      $sql = "SELECT userid, siteuserid, email, name, role, phoneres, phonecell, status, comments,createdon"
                . " FROM user "
				. " WHERE role = '" . $role . "' "
				. " ORDER BY createdOn " ;
        
        return parent::query($sql);
    }
    
	 // Retrieves all Users 
    public function SelectAllUsers() {
        $sql = "SELECT  userid, siteuserid , email, concat(firstname,  ' ' , middlename, ' ', lastname) as name, role, phoneres, phonecell, isactive,islocked, comments,createdon"
                . " FROM user" 
			   . " ORDER BY createdOn " ;
				        
		//print_r($sql);
        return parent::query($sql);
    }
	
	
    // Adds a user row into user table and
    //   returns the userid Guid
    public function InsertUser($siteuserid, $email, $password, $firstname,$middlename,$lastname, $role, $phoneres, $phonecell, $isActive, $comments) 
	{
		$userId = GuidUtility::newGuid();
		$createdOn=DateTimeUtility::now();
		$isLocked='0';
		$encPassword=ViewHelper::Encrypt($email,$password);
        $sql = "INSERT INTO user "
             . "("
			. "userid, "
			. "siteuserid, "
			. "email, "
			. "password, "
			. "firstname, "
			. "middlename, " 
			. "lastname, "
			. "role, "
			. "phoneres, "
			. "phonecell, "
			. "createdon, "
			. "lastupdatedon, "
			. "islocked, "
			. "isactive, "
			. "comments "
			. ") VALUES ("
			. "'" . $userId . "', "
			. "'" . $siteuserid . "', "
			. "'" . $email . "', "
			. "'" . $encPassword . "', "
			. "'" . $firstname . "', "	
			. "'" . $middlename . "', "	
			. "'" . $lastname . "', "	
			. "'" . $role . "', "
			. "'" . $phoneres . "', "
			. "'" . $phonecell . "', "
			. "'" . $createdOn . "', "
			. "'" . $createdOn . "' , "	
			. "'" . $isLocked . "' , "
			. "'" . $isActive . "' , "
			. "'" . $comments . "'" 
			. ");";
        //print_r($sql);
      if ( parent::execute($sql) >0 )
	     return $userId;
	 else
		return NULL;
    }
	
	 // Update user row into the user table
    
    public function UpdateUser($userId, $siteuserid,$email, $firstname,$middlename, $lastname, $role, $phoneres, $phonecell, $isActive, $isLocked, $comments) 
	{
		$updatedOn=DateTimeUtility::now();
        $sql = "Update user "
				. " SET "
				. " email = '" . $email . "',"
				. " siteuserid = '" . $siteuserid . "', "
				. " firstname = '" . $firstname . "',"
				. " middlename = '" . $middlename . "',"
				. " lastname = '" . $lastname . "',"
				. " role = '". $role . "' ,"
				. " phoneres = '"	. $phoneres . "' ,"
				. " phonecell = '" . $phonecell . "' ,"
				. " isactive = '" . $isActive . "' ,"
				. " islocked = '" . $isLocked . "' ,"
				. " lastupdatedon = '" . $updatedOn . "' ,"
				. " comments = '". $comments . "' "
				. " WHERE "
				. " userId= '" . $userId . "'";
        
	//print_r($sql);
        parent::execute($sql);
        
       
    }
	
	// Mark the user table as deleted by setting isactive 
	
	 public function UpdateIsActive($userid)
	 {
	 $result=$this->CheckUserIsActive($userid);
	
		if ($result['isactive']=='1')
			$isActive='0';
		else
			$isActive='1';
			
        $sql = "Update user "
				. " SET isactive =  '"
				. $isActive . "'"
				. " WHERE  userid = '"
				. $userid . "'";
       // print_r($sql);
        return parent::execute($sql);

    }
	
	// Activate Account by setting isactive 
	
	 public function ActivateAccount($userid)
	 {
	 		
        $sql = "Update user "
				. " SET isactive = 1"
				. " WHERE  userid = '"
				. $userid . "'";
       // print_r($sql);
        return parent::execute($sql);

    }
	
	// check for user
	// Lock the user
	// return the userid
	
	//return 1 - email not found
	//return 0 - email blank
	//normal return userid
	public function ForgotPassword($email)
	{
		$hash=null;
		if (strlen($email) >2)
		{
			$hash= self::GetUserID($email);
			//print_r($hash);
			if ($hash=='0')
			{$hash=1; }
			else
			{ self::LockUser($email); }
	   	}
		else
		{$hash=0;}
		
		return $hash;
	}
	
	// change password
	 public function ChangePassword($userid, $password)
	 {
		$encPassword=ViewHelper::Encrypt($userid,$password);
		
		$sql = "Update user "
				. " SET password = '" . $encPassword . "' ,"
				. " isactive = '1' "
				. " WHERE  userid = '"
				. $userid . "'";
      //print_r($sql);
        return parent::execute($sql);

    }
	
	
	// Mark the user  as locked by making islocked = 0
	 public function LockUser($email)
	 {
        $sql = "Update user "
				. " SET islocked =  '0'"
				. " WHERE  email = '"
				. $email . "'";
        
        return parent::execute($sql);

    }
	
/*	// Delete user row into the user table 
    public function DeleteUser($userid)
	{
        $sql = "DELETE FROM  user "
                . " WHERE userid = '"
                . $userid . "'";
				
        return parent::execute($sql);
       
    }
	
	//Delete All users
	public function DeleteAllUsers()
	{
        $sql = "DELETE FROM  user ";
  				
        return parent::execute($sql);
       
    }
*/
	
	
}
?>