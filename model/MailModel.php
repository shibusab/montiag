<?php
require_once './lib/MailBase.php';
class MailModel extends MailBase
{

	static function SendPrayerRequestMail($membershipNo, $name, $email, $phone, $prayerGroupName,$subject, $body)
	{
		 $message = " Prayer Request from " . $name . " . \r\n" ;
		 if(!empty($membershipNo))
			{$message .= "Membership no " . $membershipNo . "\r\n";}
		 if(!empty($email))
			{$message .= " Email : " . $email . " \r\n" ;}
		 if(!empty($phone))
			{$message .= " Phone No : " .  $phone . "\r\n";}
		$message .= " Prayer Group :" . $prayerGroupName . "\r\n" ;
		$message .= " Subject : "  . $subject . "\r\n" ;
		$message .= $body . "\r\n" ; 
		
		parent::SendMail("shibusab@hotmail.com",$subject, $message);
	}
	
	static function SendInvitation($email, $name, $userid)
	{
		$baseUrl=Registry::get('baseurl');
		//$emailname= ConfigModel::SelectKey("email","en-us");
		 $message = " Dear " . $name . " . \r\n" ;
		 $message .= "Welcome to montiag.com. \r\n";
		 $message .= "You are invited to join the church website of Mahanaim Pentecostal Church, Monticello, New York, 12701. \r\n" ;
		 $message .= "<a href =\"$baseUrl/account/activate/$userid\"> Click this email to confirm your request</a> \r\n"; 
		 $subject="Invitation to MONTIAG.COM - Mahanaim Pentecostal Church Website";
		
		parent::SendMail($email,$subject, $message);
		//echo $message;
	}
	
	static function SendResetPassword($email, $hash)
	{
		$baseUrl=Registry::get('baseurl');
		//$emailname= ConfigModel::SelectKey("email","en-us");
	
		 $message = "We had received a request to reset your password with montiag.com. \r\n";
		 $message .= "If you have requested so, click on the link below to reset your password with montiag.com \r\n" ;
		 $message .= "<a href =\"$baseUrl/account/resetpass/$hash\"> Click this email to confirm your request</a> \r\n"; 
		 $subject="Request to Reset Password  with  MONTIAG.COM - Mahanaim Pentecostal Church Website";
		
		parent::SendMail($email,$subject, $message);
		//echo $message;
	}


	

}

?>