<?php
class myCalendar
{
	
	function DrawYear($year, $events)
	{
		for($m=1; $m<=12; $m++)
		echo $this->DrawMonth($m, $year, $events);
	
	
	}
	
	function DrawMonth($month, $year, $events)
	{
		$day = date('j');
		
		$s="";
		$s.= "<div class=\"calendar\">";
		$s.= "<div class=\"calendar-header\">" ;
		$s.=  date("F",mktime(0,0,0,$month,1,$year)); 
		$s.= " </div>";
		$s.= "<div class=\"calendar-content\">";
		$s.= "<table>";
		$s.= "<thead><tr><th>Sun</th><th>Mon</th><th>Tues</th><th>Wed</th><th>Thurs</th><th>Fri</th><th>Sat</th></tr></thead>";
		$s."<tbody> ";
		
		$first_Day = date("w", mktime(0,0,0,$month,1,$year));
		$totaldays = date("t",mktime(0,0,0,$month,1,$year));
		$temp = $first_Day + $totaldays;
		$weeksInMonth = ceil($temp/7);
		$counter = 1;
		$flag = true;
		if($month!=date("n"))
		$flag=false;
		for($i=0;$i<$weeksInMonth;$i++)
		{
			$s .= "<tr>";
			for($j=0;$j<7;$j++)
			{
				if(( $counter<=$temp) && ( ($counter + $totaldays) - $temp >0) )
				{
				   
					$s .= "<td><span class='hover-bg'></span><p";
					if ($j=='5' || $j=='0') // for fridays
					{ $s .= " class='holiday-bg'";}
					if(( $counter - $first_Day )==$day && $flag==true)
					{$s .= " class='current-bg'";}
					$printDate=( $counter - $first_Day );
					$s .= ">".$printDate . "</br></br>";
					
					$x=$this->returnDates($printDate, $events);
					
					if( !empty($x) )
					{
						$s.=$x;				
					}
				}
				else
				{	
					$s.= "<td>";
				}
			
				$s.= "</td>";
				$counter++;
			}
			$s.= "</tr>";
		}
		
		$s.= "</tbody> </table> </div> </div>";
		
		return $s;
	}
	
	function array_search_r($needle, $haystack)
	{ 
	$match='';
        foreach($haystack as $value){ 
            if(is_array($value)) 
                $match=$this->array_search_r($needle, $value); 
            if($value==$needle) 
                $match=1; 
            if($match) 
                return 1; 
        } 
        return 0; 
    } 
	
	function returnDates($value, $events)
	{
		$i=0;
		$s='';
		foreach($events as $event)
		{
			if ($event['day']==$value)
			{
				$s.= "<a href = " . $event['link'];
				$s.= " > " . $event['link'] . "</a>";
			}
			$i+=1;
		}
		
		//print_r($key);
		return $s;
	}

}

?>
