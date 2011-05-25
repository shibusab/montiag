<?php

require_once ('./lib/ModelBase.php');
require_Once ('./utility/GuidUtility.php');
require_Once ('./utility/DateTimeUtility.php');
//  Encapsulates all Event database table access.
//   This method of encapsulation uses the singleton
//   design pattern.
class EventModel extends ModelBase {
    private static $eventModel = NULL;
    
    private function __construct() 
	{
    }
    
    // The create function is necessary to ensure there
    //   is only one instance of PostDbAccess being used
    //   at any one time (eg. singleton)
    static function Create() 
	{
        if (NULL == self::$eventModel) {
           self::$eventModel = new EventModel();
        }
        return self::$eventModel;
    }
    
	
	 public function CheckIsActive($eventId) 
	{
       $sql = "SELECT status"
                . " FROM event "
                . " WHERE eventid = '" . $eventId . "' "
                . " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
	//****** For Frontend users
	 // Retrieves all Events 
    public function SelectAllEvents() 
	{
    
		$events="events1-";
		global $cache;
		$data = $cache->get($events);
	 
		if ($data === FALSE) {
			$sql= "SELECT expireon, displayfull, postid, post.pagename, post.title,  body,"
			." post.lastupdatedon, user.profileimagename, user.siteuserid FROM post "
			." LEFT JOIN user ON post.authorid = user.userid "
			." WHERE CURDATE() <= expireon AND post.status ='1' AND displayhomepage='1' "
			." ORDER BY lastupdatedon desc";
		
		//print_r($sql);
		//echo "Setting cache";
		$data= parent::query($sql);
		$cache->set($events, $data);
		}
		
        return $data;
    }
	
	
   
	
	// Retrieve Event Headings for active events	
	public function SelectAllEventHeadings() 
	{
		$events="events-";
		global $cache;
		$data = $cache->get($events);
	 
		if ($data === FALSE) {
			$sql = "SELECT e.eventid,e.name, e.lastupdatedon,e.location, e.status,"
				." e.eventtype, e.eventstartdate ,e.eventenddate  "
				. " FROM event e, user u "
				. " WHERE e.createdby = u.userid AND e.status =1 "
				. " ORDER BY e.lastupdatedon DESC" ;
	
		
		//print_r($sql);
		// echo "Setting cache";
			$data= parent::query($sql);
			$cache->set($events, $data);
			}
		
        return $data;
    }
	
	// Retrieve Event Headings used with admin module to 
	// use in admin module
	public function AdminSelectAllEventHeadings() {
	     $sql = "SELECT e.eventid,e.name, e.lastupdatedon,e.location, e.status,"
			. " e.eventtype, e.eventstartdate  "
			. " FROM event e, user u "
			. " WHERE e.createdby = u.userid " ;
				
			if (User::IsInRole(3))
			 { $sql .= " AND e.authorid = '" . User::userid() . "' " ;}
			elseif (User::IsInRole(1))
			{$sql .= " AND 1=1 " ;}
			else
			{ $sql .= "AND 1<>1"; }
			$sql .= " ORDER BY e.lastupdatedon DESC" ;
	
			//print_r($sql);	        
        return parent::query($sql);
    }
	
	// list the details of event
	public 	function SelectEventByEventId($eventId){
	
	$sql="SELECT e.*,u.siteuserid as authorname , u.profileimagename "
			." FROM event e "
			." LEFT OUTER JOIN user u on e.createdby= u.userid "
			." WHERE eventid = '" .$eventId ."'"
			." LIMIT 1 ";
      //print_r($sql);
        return parent::queryFirst($sql);
	}
	// list the details of event
	public 	function AdminSelectEventByEventId($eventId){
	
	$sql="SELECT e.*,u.siteuserid as createdby "
			." FROM event e "
			." LEFT OUTER JOIN user u on e.createdby= u.userid "
			." WHERE eventid = '" .$eventId ."'"
			." LIMIT 1 ";
      //print_r($sql);
        return parent::queryFirst($sql);
	}
	
    // Adds an post row into the Event table and
    //   returns the eventid Guid
    public function Insert($name,$langid, $tagline,$smallpicurl,$bigpicurl,$host,$eventtype,$eventstartdate,$eventenddate,$createdby,$location,$lastupdatedby,$status) 
	{
		$eventId = GuidUtility::newGuid();
		$createdOn=DateTimeUtility::now(); 
		$sql = "INSERT INTO event "
                . "( eventid,name,langid,tagline,smallpicurl,bigpicurl,host,eventtype,eventstartdate,eventenddate,createdby,createdon,location,lastupdatedon,lastupdatedby,status "
                . ") VALUES ("
                . "'" . $eventId . "', "
				. "'" . $name . "', "
				. "'" . $langid . "', "
                . "'" . $tagline . "', "
				. "'" . $smallpicurl . "', "
				. "'" . $bigpicurl . "', "
                . "'" . $host . "', "
                . "'" . $eventtype . "', "
				. "'" . $eventstartdate . "', "
				. "'" . $eventenddate . "', "
                . "'" . $createdby . "' , "
				. "'" . $createdOn . "' , "
				. "'" . $location . "' , "
				. "'" . $createdOn . "' , "
				. "'" . $lastupdatedby . "' , "
				. "'" . $status . "'  "
			    . ");";
      //print_r($sql);
        if (parent::execute($sql) >0)
		  return $eventId;
		else
		return NULL;
    }
	
	 // Update the Event table
    
    public function Update($eventid,$name,$langid, $tagline,$smallpicurl,$bigpicurl,$host,$eventtype,$eventstartdate,$eventenddate,$location,$lastupdatedby,$status)  
	{
		$lastupdatedon=DateTimeUtility::now();
			
        $sql = "Update event "
             . "SET "
			. "langid = '" . $langid . "' , "
			. "name = '" . $name . "' , "
			. "tagline = '" . $tagline . "' , "
			. "smallpicurl = '"	. $smallpicurl . "' , "
			. "bigpicurl = '"	. $bigpicurl . "' , "
			. "host = '"	. $host . "' , "
			. "location = '" . $location . "' ,"
			. "eventtype = '"	. $eventtype . "' , "
			. "eventstartdate = '". $eventstartdate . "' ,"
			. "eventenddate = '" . $eventenddate . "' , "
			. "lastupdatedon = '" . $lastupdatedon . "' , "
			. "lastupdatedby = '" . $lastupdatedby . "' , "
			. "status = '" . $status . "'  "
		
			. " WHERE "
			. "eventId= '" . $eventid . "'";
        
		//print_r($sql);
		parent::execute($sql);
        
       
    }
	
	// Mark the posts table as deleted by making status =0
	 public function UpdateStatus($eventId)
	 {
	 
		$result=$this->CheckIsActive($eventId);
			
		if ($result['status']=='1')
			$isActive='0';
		else
			$isActive='1';
	 
	 
        $sql = "Update event "
				. " SET status = '" . $isActive . "'"
                . " WHERE  eventid = '"
				. $eventId . "'";
        
        return parent::execute($sql);

    }
	 // Delete an row from posts table 
    public function Delete($eventId)
	{
        $sql = "DELETE FROM  event "
                . " WHERE eventid = '"
                . $eventId . "'";
				
        return parent::execute($sql);
       
    }
	
	public function DeleteAll()
	{
        $sql = "DELETE FROM  event ";
  				
        return parent::execute($sql);
       
    }

}
?>