<?php
// ModelBase contains all of the base functions necessary for
//   each model class to execute queries as easily as
//   possible
class ModelBase 
{    
    private function __construct() {
    }    

    // Executes a SQL query and returns the result
    protected function query($sql) 
	{
        // Retrieve the database configuration values from the dbconfig.php file
        global $dbconfig_host;
        global $dbconfig_database;
        global $dbconfig_username;
        global $dbconfig_password;
		$results=array();
		
		if (!mysql_connect($dbconfig_host, $dbconfig_username, $dbconfig_password))
		{ 	
			$exceptionString = $this->getError();
			trigger_error ('DB Error' . $exceptionString . '.', E_USER_NOTICE);
			throw new exception($exceptionString);
		}
		
		if(!mysql_select_db($dbconfig_database)) 
		{
				$exceptionString = $this->getError();
				trigger_error ('DB Error' . $exceptionString . '.', E_USER_NOTICE);
				throw new exception($exceptionString);
		}
		
		if(!$result=mysql_query($sql))
		{
			$exceptionString = $this->getError();
			trigger_error ('DB Error' . $exceptionString . '.', E_USER_NOTICE);
			throw new exception($exceptionString);
		}
		else
		{
			$i=0;
			
			ViewHelper::LogString("1" . $sql);
			if (!empty($result))
			{
				while($row=mysql_fetch_array($result)){
					$results[$i]=$row;
					$i++;
				}
			}
			
		}
     	
        return $results;
    }
    
    // Executes a SQL query and returns only the first row
    protected function queryFirst($sql) {
        $result = $this->query($sql);
        
		
		 if($result!=NULL)
			return $result[0];
    }
    
    // Executes a non-query SQL statement
    protected function execute($sql) {
        // Retrieve the database configuration values from the dbconfig.php file
       global $dbconfig_host;
        global $dbconfig_database;
        global $dbconfig_username;
        global $dbconfig_password;
    
	
		$conn= mysql_connect($dbconfig_host, $dbconfig_username, $dbconfig_password) or die("Unable to connect to DB Server");
		if (!mysql_select_db($dbconfig_database))
		{
			$exceptionString = mysql_errno() . ": " . mysql_error();
			trigger_error ('DB Error' . $exceptionString . '.', E_USER_NOTICE);
			throw new exception($exceptionString);
		}
		else
		{
			if(mysql_query($sql))
			{ 	
				$count=mysql_affected_rows();
				ViewHelper::LogString("1" . $sql);
			}
			else
			{
				$exceptionString = mysql_errno() . ": " . mysql_error();
				trigger_error ('DB Error' . $exceptionString . '.', E_USER_NOTICE);
				throw new exception($exceptionString);
			}
		}
		
	
        return $count;
    }
		
	private function getError()
	{
		return mysql_errno(  ) . " : " . mysql_error();
	}
//mysql_errno(  ) . " : " . mysql_error(  ));

}
?>