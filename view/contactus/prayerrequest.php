<?php require_once './utility/ViewHelper.php'; 	$currentTemplate=Registry::get('currenttemplate');?>
<script type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/lib/jquery-1.3.2.min.js');?>"></script>
<script language="javascript" type="text/javascript" src="<?php ViewHelper::createStaticUrl($currentTemplate .'/js/jquery/jquery.validate.min.js');?>"></script>

<style type="text/css"> 
#prayerForm { width: 500px; }
#prayerForm label.error {
	margin-left: 10px;
	width: auto;
	display: inline;
}
</style>



<script type="text/javascript">
$().ready(function() {

$("#prayerForm").validate({
		rules: 
		{
			name: {required:true, maxlength:50},
			phone:{required:true,number:true},
			prayergroupname: {required:true, maxlength:50},
			subject:{required:true, maxlength:60},
			body:{required: true,maxlength: 500},
			email:{required: true,email: true},
		},
		messages: 
		{
			name: "Please enter your full name/max 50 chars",
			prayergroupname: "Please enter Area and Prayer Group. If you does not belong to a prayer group, enter your location and place",
			subject: "Please enter subject",
			body: "Please enter your Prayer Topic",
			phone: {required: "Please enter phone no",number: "Please enter a valid phone no"},
			email: "Please enter a valid email address"
		}
	});
})
</script>
<div id= "contactform" class="pageContainer">
    <h1><?php echo htmlentities(CONTACT_US) ; ?></h1>
	<br><br>
    <form  id="prayerForm" name="prayerForm1" action="addsubmit" method="post">
   
	<tr><td><label for="subject"> <?php echo htmlentities(CON_SUBJECT); ?> </label></td><td><input id="con_name" type="text" name="subject" size="60" maxlength=65 /></td></tr>
	<tr valign=top><td><label for="body"><?php echo htmlentities(CON_PRAYER_REQUEST); ?> :</label></td><td><textarea id="con_mess" cols="47" rows="12" name="body"></textarea></td></tr>
	<tr><td><label for="membershipno"><?php echo htmlentities(CON_MEMBERID); ?>:</label></td><td><input id="con_name" type="text" name="membershipno" size="15" maxlength=55 /></td></tr>
    <tr><td><label for="name"><?php echo htmlentities(CON_NAME); ?>:</label></td><td><input id="con_name" type="text" name="name" size="60" maxlength=150 /></td></tr>
	<tr><td><label for="email"><?php echo htmlentities(CON_EMAIL); ?>:</label></td><td><input id="con_email" type="text" name="email" size="60" maxlength=150 /></td></tr>
	<tr><td><label for="phone"><?php echo htmlentities(CON_PHONE); ?>:</label></td><td><input id="con_name" type="text" name="phone" size="15" maxlength=15 /></td></tr>
	<tr><td><label for="prayergroupname">P<?php echo htmlentities(CON_PLACE); ?>:</label></td><td><input id="con_name" type="prayergroupname" name="prayergroupname" size="45" maxlength=50 /></td></tr>
		<input type ="hidden" name="requesttype" value="1"/>
	
    <tr><td></td><td><input id="contact-submit" type="submit" value="<?php htmlentities(CON_SEND); ?>" /></td></tr>
	
    </form>
	<br><br><br>
</div>