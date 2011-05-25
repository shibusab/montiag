<?php
interface IMail
{
	public function SendMail($to ,$subject, $message, $attachment = '', $attachmentFilename = '');
}

?>