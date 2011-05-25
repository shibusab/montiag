<?php

class ContactModel extends ModelBase {
    private static $contactModel = NULL;
    
    private function __construct() {
    }
    
    // The create function is necessary to ensure there
    //   is only one instance of PostDbAccess being used
    //   at any one time (eg. singleton)
    static function Create() 
	{
        if (NULL == self::$contactModel) {
           self::$contactModel = new ContactModel();
        }
        return self::$contactModel;
    }

	
	static function SelectAll()
	{
		// if user is normal, list only his information
		// else list all
		
		$sql ="SELECT requestid,requesttype, memberid, name,email, phone, prayergroup, subject, body from contacts ";
		
			if (User::IsInRole(1))
			{ $sql .=  " WHERE 1=1";}
			elseif(User::IsInRole(4))
			{$sql.= " WHERE memberid = '" . User.userid() . "'"; }	
			else
			{$sql .=" WHERE  memberid = 0"; } //assume there will never be such an id
		return parent::execute($sql);
	}
	
	static function SelectByEmail($email)
	{
		$sql ="SELECT prayerrequestid,name,email, phone, prayergroupname, prayerfor, prayer from prayerrequest"
				. " WHERE email = '" . $email . "'";
	
		return parent::execute($sql);
	}

	static function SelectByPhone($phone)
	{
		$sql ="SELECT prayerrequestid,name,email, phone, prayergroupname, prayerfor, prayer from prayerrequest"
				. " WHERE phone = '" . $phone . "'";
	
		return parent::execute($sql);
	}
	
	static function Select($prayerrequestid)
	{
		$sql ="SELECT prayerrequestid,name,email, phone, prayergroupname, prayerfor, prayer from prayerrequest"
				. " WHERE prayerrequestid = '" . $prayerrequestid . "'";
	
		return parent::execute($sql);
	}
	
	// requestType = 1 - Prayer, 2 - Secretary, 3-Vicar
	static function Insert($langid, $requestType, $memberId, $group, $email, $phone, $subject, $body, $visitorIP)
	{
		$requestId =guidUtility::newGuid();
		$createdon=DateTimeUtility::now();
		
		$sql = "INSERT INTO contactus ("
			. " langid, requestid, requesttype, memberid, groupid, emailid, phone, subject, body, visitorip, createdon, lastupdatedon "
			. " ) VALUES  ("
			. " '" . $langid . "' , " 
			. " '" . $requestId . "' , " 
			. " '" . $requestType . "' , " 
			. " '" . $memberId . "' , " 
			. " '" . $group . "' , " 
			. " '" . $email . "' , " 
			. " '" . $phone . "' , " 
			. " '" . $subject . "' , " 
			. " '" . $body . "' ,  " 
			. " '" . $visitorIP . "' ,"
			. " '" . $createdon . "' ,  " 
			. " '" . $createdon . "'  " 
			. " ) ";
			
		//print_r($sql);
		return parent::execute($sql);
	}
	
	static function Update($requestId,$requestType,$memberId, $name, $email, $phone, $prayerGroupName,$subject, $body)
	{
		$lastupdated=DateTimeUtility::now();
			
		$sql= "UPDATE contacts SET"
		. " requestType = '" . $requestType . "' , "
		. " name = '" . $name . "' , "
		. " memberId = '" . $memberId . "' , "
		. " name = '" . $name . "' , "
		. " email = '" . $email . "' , "
		. " phone = '" . $phone . "' , "
		. " prayergroup = '" . $prayerGroupName . "' , "
		. " subject = '" . $subject . "' , "
		. " body = '" . $body . "' , "
		. " lastupdateddate = '" . $lastupdated . "' "
		. " WHERE requestid = '" .$requestId . "'";
	
		return parent::execute($sql);
	}
	
	static function Delete($prayerRequestId)
	{
		$sql= "DELETE FROM prayerrequests WHERE prayerrequestid = '" . $prayerRequestId . "'";
		
		return parent::execute($sql);
	}
	
	static function DeleteAll()
	{
		$sql= "DELETE FROM prayerrequests"; 
		
		return parent::execute($sql);
	}
	
	
	
	
}














?>