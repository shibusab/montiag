<?php
	/* Registry Class to store Registry variables. 
	 * 
	 * Author	: 
	 * Date		:  
	 * Comments	:  
	 * Website	: 
	 * Version	: 1.0
	 *
	 * Usage: 
	 *		Registry::set('email','shibuv@hotmail.com'); 
	 *		echo Registry::get('email'); 
	 */
	
class Registry  
{       
	static private $data = array();
    private function __construct() {}

    static public function get($key)
    {
        return self::$data[$key];
    }

    static public function set($key,$value)
    {
        self::$data[$key] = $value;
    }

}

?>