<?php
class ValidateUtility
{
static function SanitizeInput($data)
	{
	
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = htmlentities($data);
		
		return $data;
	}
	
	static function checkInput($data, $problem='', $type)
	{
		if (!isset($data))
		{ throw new AppException ("Data is not Validated - $data"); return null;}
		
		$data = trim($data);
		$data = stripslashes($data);

		$data = htmlspecialchars($data);
		
		if ($problem && strlen($data) == 0)
		{
			
			throw new Exception ("Error:Data Validation:Empty $data\n$problem");
		}
		else if($type=='date')
		{
			self::ValidateDate($data);
		
		}
		else if($type=='email') 
		{
			self::ValidateEmail($data);
		}
		return $data;
	}
	
	
	static function ValidateDate($data)
	{
		return true;
	}
	
	
	static function ValidateEmail($data)
	{
		return true;
	}
	
	function show_error($myError)
	{
	?>
		<html>
		<body>

		<b>Please correct the following error:</b><br />
		<?php echo $myError; ?>

		</body>
		</html>
	<?php
exit();
}

}

?>
