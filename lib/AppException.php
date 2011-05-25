<?php

class AppException extends Exception{
	public function __toString() {
		return "exception '".__CLASS__ ."' with message '".$this->getMessage()."' in ".$this->getFile().":".$this->getLine()."\nStack trace:\n".$this->getTraceAsString();
	}

	 public function __construct($message) {
	 
	 $this->Log($message);
    }
	 function Log( $message)
	{
		$today=date("F j, Y, g:i a");                 
		$errorString = "Date: $today \n";
		$errorString .=	"exception '".__CLASS__ ."' with message '".$this->getMessage()."' in ".$this->getFile().":".$this->getLine()."\nStack trace:\n".$this->getTraceAsString();
		$errorString .= "\nCustom Error Message is :" .$message;
			
		//$trace = debug_backtrace(); 
		//echo "Function name is " . $trace[0]["function"]; 
			
		error_log("$errorString \n",3, "c:\log\my-errors.log"); 
		
		
	
	}
}

?>