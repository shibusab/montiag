<?php
require_once ('./lib/ModelBase.php');
// The backup class contains the class to do backup
// Not tested
class Backup extends ModelBase
{
	private $path;
	
	private function __construct() 
	{
     }
	 
	 
	static function BackupTable($tableName)
	{
		$path = "C:\\TemporaryFolder\\";
		$backupfile = $path . $tableName . '-sql';
		
		$sql= "SELECT * INTO OUTFILE '" . $backupfile . "' FROM $tableName";
		print_r($sql);
		return parent::execute($sql);
	}
}


?>