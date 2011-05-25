<?php
$ROOTDIR ='c:\wamp\www\montiag';
require_once($ROOTDIR . '/simpletest/autorun.php');
require_once($ROOTDIR . '/model/UserModel.php');
require_once($ROOTDIR . '/utility/ViewHelper.php');

class TestModels extends TestSuite
{
	function __construct() 
	{
        parent::__construct();
		global $ROOTDIR;
        $this->addFile($ROOTDIR .'/test/UserModelTests.php');
        //$this->addFile('./test/PostModelTests.php');
    }


/*

assertTrue($x) Fail if $x is false 
assertFalse($x) Fail if $x is true 
assertNull($x) Fail if $x is set 
assertNotNull($x) Fail if $x not set 
assertIsA($x, $t) Fail if $x is not the class or type $t 
assertNotA($x, $t) Fail if $x is of the class or type $t 
assertEqual($x, $y) Fail if $x == $y is false 
assertNotEqual($x, $y) Fail if $x == $y is true 
assertWithinMargin($x, $y, $m) Fail if abs($x - $y) < $m is false 
assertOutsideMargin($x, $y, $m) Fail if abs($x - $y) < $m is true 
assertIdentical($x, $y) Fail if $x == $y is false or a type mismatch 
assertNotIdentical($x, $y) Fail if $x == $y is true and types match 
assertReference($x, $y) Fail unless $x and $y are the same variable 
assertClone($x, $y) Fail unless $x and $y are identical copies 
assertPattern($p, $x) Fail unless the regex $p matches $x 
assertNoPattern($p, $x) Fail if the regex $p matches $x 
expectError($x) Fail if matching error does not occour 
expectException($x) Fail if matching exception is not thrown 
ignoreException($x) Swallows any upcoming matching exception 
assert($e) Fail on failed expectation object $e 

*/

	
}





?>