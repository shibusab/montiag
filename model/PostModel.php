<?php

require_once ('./lib/ModelBase.php');
require_Once ('./utility/GuidUtility.php');
require_Once ('./utility/DateTimeUtility.php');
//  Encapsulates all Article database table access.
//   This method of encapsulation uses the singleton
//   design pattern.
class PostModel extends ModelBase {
    private static $postModel = NULL;
    
    private function __construct() 
	{
	}
    
    // The create function is necessary to ensure there
    //   is only one instance of PostDbAccess being used
    //   at any one time (eg. singleton)
    static function Create() 
	{
        if (NULL == self::$postModel) {
           self::$postModel = new PostModel();
        }
        return self::$postModel;
    }
    
	
	 public function CheckPostIsActive($postId) 
	{
       $sql = "SELECT status"
                . " FROM post "
                . " WHERE postid = '" . $postId . "' "
                . " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
	
	 // Retrieves all Posts 
    public function SelectAllPosts() 
	{
    
	$cachePage= "homepage";
	global $cache;
	$data = $cache->get($cachePage);
	 
	if ($data === FALSE) {
	$sql= "SELECT expireon, displayfull, postid, post.pagename, post.title,  body,"
		." post.lastupdatedon, user.profileimagename, user.siteuserid FROM post "
		." LEFT JOIN user ON post.authorid = user.userid "
		." WHERE CURDATE() <= expireon AND post.status ='1' AND displayhomepage='1' "
		." ORDER BY lastupdatedon desc";
		
		//echo "Setting homepage cache";
		$data= parent::query($sql);
		$cache->set($cachePage, $data);  
		}
	   //print_r($data);
        return $data;
    }
	
	 // Retrieves all Posts by PageID
    public function SelectPostsByMenuID($menuId) 
	{
	
	$cachePage= $menuId;
	global $cache;
	$data = $cache->get($cachePage);
	 
	if ($data === FALSE) {
	
       $sql = "SELECT p.expireon, p.displayfull, p.postid, p.pagename, p.title, "
			." p.body, u.siteuserid, p.lastupdatedon, u.profileimagename "
             . " FROM post p, user u "
             . " WHERE p.authorid = u.userid "
			. " AND p.menuid = '" . $menuId . "' "
			. " AND p.status = '1'"
             . " ORDER BY p.expireon desc" ;
		//echo "Setting menupage cache";
		$data= parent::query($sql);
		$cache->set($cachePage, $data);  
		}
	   //print_r($data);
        return $data;
    }
	
    // Retrieves an Post row by its PostID    
    public function SelectPostByPostID($postId) 
	{
         $sql = "SELECT p.lastupdatedon, u.siteuserid, p.body, p.pagename, p.title "
             . " FROM post p, user u "
             . " WHERE p.authorid = u.userid "
			." and postid = '" . $postId . "' "
             . " LIMIT 1";
        
        return parent::queryFirst($sql);
    }
	
	 // Retrieves an Post row by its Page Name    
    public function SelectPostByPageName($pageName) 
	{
	$cachePage= $pageName;
	global $cache;
	$data = $cache->get($cachePage);
	 
	if ($data === FALSE) {
		$sql = "SELECT p.lastupdatedon, u.siteuserid, u.profileimagename, p.body, p.pagename, p.title "
             . " FROM post p, user u "
             . " WHERE p.authorid = u.userid "
			." and pagename = '" . addslashes($pageName) . "' "
             . " LIMIT 1";
		//echo "Setting Postbypage cache";
		$data= parent::query($sql);
		$cache->set($cachePage, $data);  
		}
	   //print_r($data);
        return $data;
    }
	
	// Retrieves all Posts by UserID    
    public function SelectPostsByUser($userName) 
	{
		$sql= "SELECT expireon, displayfull, postid, title, post.pagename,  post.title, body,"
			." post.lastupdatedon, user.name FROM post "
			. " LEFT JOIN user ON post.authorid = user.userid"
			. " WHERE username = '" . $userName . "' ";
              
		//print_r($sql);
         return parent::query($sql);
    }
	
    // Retrieves an Post row by its PostID 
	// Shows detailed information for Admin Module
    public function AdminSelectPostByPostID($postId) 
	{
    		$sql="SELECT p.*,u.siteuserid as authorname,m.name menuname "
			." FROM post p "
			." LEFT OUTER JOIN user u on p.authorid= u.userid "
			." LEFT OUTER JOIN menu m on p.menuid=m.menuid "
			." WHERE postid = '" .$postId ."'"
			." LIMIT 1 ";
     //print_r($sql);
        return parent::queryFirst($sql);
    }
	
    // Retrieves all Posts by PageID
	// Even retired ones
    public function AdminSelectPostsByMenuID($menuId) {
	//echo ':PageID from PostModel: <pre>'. print_r($pageId). '</pre>';
       $sql = " SELECT p.status,p.expireon, p.createdon, p.lastupdatedon, u.siteuserid, p.body, p.title, p.pagename, u.userid "
             . " FROM post p, user u "
             . " WHERE p.authorid = u.userid "
			. " AND p.menuid = '" . $menuId . "' "
		    . " ORDER BY p.createdon DESC" ;
			
			
		//print_r($sql);
        return parent::query($sql);
    }
    
	
	// Retrieve all Page Headings	
	public function SelectAllPostHeadings() {
          $sql = "SELECT p.postid, p.lastupdatedon,u.profileimagename, u.siteuserid, p.pagename, p.title,p.status,"
			 ." p.posttype, p.expireon "
             . " FROM post p, user u "
             . " WHERE p.authorid = u.userid AND p.status =1 "
			. " ORDER BY p.lastupdatedon DESC" ;
				
	//			. " GROUP BY p.menuid, p.lastupdatedon "	;
		//print_r($sql);		        
        return parent::query($sql);
    }
	
	
	public function AdminSelectAllPostHeadings($menuid) {
	    $sql = "SELECT p.postid, p.lastupdatedon, u.siteuserid, p.pagename, p.title, p.status,"
			. " p.expireon, p.posttype "
             . " FROM post p, user u "
             . " WHERE p.authorid = u.userid "
			. " AND p.menuid = '". $menuid . "' ";
			
			if (User::IsInRole(3))
			 { $sql .= " AND p.authorid = '" . User::userid() . "' " ;}
			elseif (User::IsInRole(1))
			{$sql .= " AND 1=1 " ;}
			else
			{ $sql .= "AND 1<>1"; }
			$sql .= " ORDER BY p.lastupdatedon DESC" ;
		//	. " GROUP BY p.menuid, p.lastupdatedon "	;
		//	print_r($sql);	        
        return parent::query($sql);
    }
	// until the json is added
	public function AdminSelectAllPostHeadings_temp() {
	    $sql = "SELECT p.postid, p.lastupdatedon, u.siteuserid, p.pagename, p.title, p.status,"
			. " p.expireon, p.posttype "
             . " FROM post p, user u "
             . " WHERE p.authorid = u.userid " ;
		//	. " AND p.menuid = '". $menuid . "' ";
			
			if (User::IsInRole(3))
			 { $sql .= " AND p.authorid = '" . User::userid() . "' " ;}
			elseif (User::IsInRole(1))
			{$sql .= " AND 1=1 " ;}
			else
			{ $sql .= "AND 1<>1"; }
			$sql .= " ORDER BY p.lastupdatedon DESC" ;
		//	. " GROUP BY p.menuid, p.lastupdatedon "	;
		//	print_r($sql);	        
        return parent::query($sql);
    }
	
	
    // Adds an post row into the posts table and
    //   returns the postid Guid
    public function InsertPost($menuId, $langid, $authorId, $pageName, $title, $body, $expireDate, $status, $displayfull, $displayhomepage,$ispublic, $posttype) 
	{
		$postId = GuidUtility::newGuid();
		$ispublic='1';
		$createdOn=DateTimeUtility::now(); // commented for datamigration. change back
		$fpageName=strtolower(str_replace(' ', '-', $pageName));
		$fpageName=str_replace('/','-',$fpageName); // replace slash and spaces with hyphen
		$fpageName=strtolower($fpageName);
		$sql = "INSERT INTO post "
                . "("
                . "postid, "
			   . "menuid, "
			   . "langid, "
                . "authorid, "
			   . "pagename, "
			   . "title, "
                . "body, "
                . "createdon, "
			   . "lastupdatedon,"
			   . "expireon, "	
                . "status, "
				."displayfull, "
				."displayhomepage, "
				."ispublic, "
				."posttype "
				
                . ") VALUES ("
                . "'" . $postId . "', "
			   . "'" . $menuId . "', "
			   . "'" . $langid . "', "
                . "'" . $authorId . "', "
			   . "'" . $fpageName . "', "
			   . "'" . $title . "', "
                . "'" . $body . "', "
                . "'" . $createdOn . "', "
			   . "'" . $createdOn . "', "
			   . "'" . $expireDate . "', "
                . "'" . $status . "' , "
				. "'" . $displayfull . "' , "
				. "'" . $displayhomepage . "' , "
				. "'" . $ispublic . "' , "
				. "'" . $posttype . "'  "
			    . ");";
      //print_r($sql);
        if (parent::execute($sql) >0)
		  return $postId;
		else
		return NULL;
    }
	
	 // Update post row into the posts table
    
    public function UpdatePost($postId, $menuId, $langid, $pageName, $title, $authorId, $body,$expireDate, $status,$displayfull, $displayhomepage,$ispublic, $posttype)  
	{
		$lastUpdatedOn=DateTimeUtility::now();
		$fpageName=strtolower(str_replace(' ', '-', $pageName));
        $sql = "Update post "
             . "SET "
			. "menuid = '" . $menuId . "' , "
			. "langid = '" . $langid . "' , "
			. "authorid = '" . $authorId . "' , "
			. "pagename = '" . $fpageName . "' , "
			. "title = '"	. $title . "' , "
			. "body = '"	. $body . "' , "
			. "lastupdatedon = '"	. $lastUpdatedOn . "' , "
			. "expireon = '"	. $expireDate . "' , "
			. "status = '". $status . "' ,"
			. "displayfull = '" . $displayfull . "' , "
			. "displayhomepage = '" . $displayhomepage . "' , "
			. "posttype = '" . $posttype . "'  "
		
			. " WHERE "
			. "postId= '" . $postId . "'";
        
		//print_r($sql);
		parent::execute($sql);
        
       
    }
	
	// Mark the posts table as deleted by making status =0
	 public function UpdatePostStatus($postId)
	 {
	 
		$result=$this->CheckPostIsActive($postId);
			
		if ($result['status']=='1')
			$isActive='0';
		else
			$isActive='1';
	 
	 
        $sql = "Update post "
				. " SET status = '" . $isActive . "'"
                . " WHERE  postid = '"
				. $postId . "'";
        
        return parent::execute($sql);

    }
	 // Delete an post row into the posts table and
    //   returns the postid Guid
    public function DeletePost($postId)
	{
        $sql = "DELETE FROM  post "
                . " WHERE postid = '"
                . $postId . "'";
				
        return parent::execute($sql);
       
    }
	
	public function DeleteAllPosts()
	{
        $sql = "DELETE FROM  post ";
  				
        return parent::execute($sql);
       
    }

}
?>