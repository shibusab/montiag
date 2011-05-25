<?php
class IPUtility 
{
   function VisitorIP()
    { 
		if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
		else $TheIp=$_SERVER['REMOTE_ADDR'];
 
		return trim($TheIp);
    }
	
	static function GetRealIPAddress()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //to check ip is pass from proxy
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			$ip= $ip . 'Via (' . $_SERVER['REMOTE_ADDR'] . ')';
		}
		else
		{
			$ip=$_SERVER['REMOTE_ADDR'];
		}

		return $ip;
}

}
?>