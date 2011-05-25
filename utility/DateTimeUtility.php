<?php
class DateTimeUtility {
    // Gets the precise date and time, including milliseconds
    static function getPreciseTime()
    {   
        $m = explode(' ',microtime());
        return array($m[1], (int)round($m[0]*1000,3));
    }
	
	static function now()
	{
		list($s, $ms) = DateTimeUtility::getPreciseTime();
		return date("Y-m-d H:i:s", $s);
	}
	
	static function FormatAsSqliteDate($string)
	{
		if(empty($string))
		{	return 0;	}
		else
		{
			return date('Y-m-d H:i:s', strtotime($string));
		}
	}
	
	static function FormatAsInsertDate($string)
	{
		if(empty($string))
		{	return 0;	}
		else
		{
			return date('Y-m-d H:i:s', strtotime($string));
		}
	}
	
	
	function FormatDate($date) 
	{  
		 
		return  $date;
	} 
	// use this function to display dates during edit	
	static function FormatForEdit($date)
	{
		return date('m/d/Y', strtotime($date)); 
	}

	
	static function GetEventDate($from, $to){
		$date="";
		If (!empty($from)){
			$date =  self::LongDateFormat($from); 
 		}
		if (!empty($to)){
			if (self::CompareDates($from,$to))
			{$date=$date . '  to  ' . date("h:i A", strtotime($to));	}
			else
			{$date =$date .'  to  ' .  self::LongDateFormat($to);}
		}
		
		return $date;
	}
	
	// return the date in Sun, Jan 01 2011 08:45 pm
	static function LongDateFormat($date){
	
		return date("D,  M dS, Y, h:i A", strtotime($date));
	}
	
	// checks and returns true if both dates are same
	static function CompareDates($date1, $date2)
	{
		if( date("D-M-YYYY", strtotime($date1))== date("D-M-YYYY",strtotime($date2)))
		{	return TRUE;
		}
		else
		{	return FALSE; }
	
	}
	/**
     * Formatted time difference between two dates
     *
     * ...
     */

	public static function StringTimeDifference($date1, $date2) {
        $i = array();
        list($d, $h, $m, $s) = (array) self::TimeDifference($date1, $date2);
        
        if ($d > 0)
            $i[] = sprintf('%d Days', $d);
        if ($h > 0)
            $i[] = sprintf('%d Hours', $h);
        if (($d == 0) && ($m > 0))
            $i[] = sprintf('%d Minutes', $m);
        if (($h == 0) && ($s > 0))
            $i[] = sprintf('%d Seconds', $s);
        
        return count($i) ? implode(' ', $i) : 'Just Now';
    }

	function nicetime($date)
	{   
		if(empty($date)) 
		{ return "No date provided";}
		
		$periods= array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths= array("60","60","24","7","4.35","12","10");
		$now= time();
		$unix_date= strtotime($date);
		
		// check validity of date
		if(empty($unix_date)) {    
		return "Bad date";
		}
		// is it future date or past date
		if($now > $unix_date) {   
			$difference = $now - $unix_date;
			$tense = "ago";
		} 
		else {
			$difference = $unix_date - $now;
			$tense= "from now";
		}   
		
		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		     $difference /= $lengths[$j];
		}

		$difference = round($difference);

		if($difference != 1) {
		     $periods[$j].= "s";
		}
		return "$difference $periods[$j] {$tense}";
	}
	
}

?>