<?php
if(isset($_POST['btnFeedback']))
{
	if($_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code']))
	{
		extract($_POST);
		
		if(!empty($txtname) && !empty($txtemail) && !empty($txtcomment) && !empty($security_code))
		{
			$feedbacks -> save($txtname, $txtaddress, $txtphone, $txtemail, $txtcountry, $txtcomment);
			
			$feedbackmsg = "Feed Back Posted Successfully";
			exit();
		}	
		else
			$feedbackmsg = "Please enter all required fields";
	}
	else
	{
		extract($_POST);
		$feedbackmsg = "Please enter correct security code";
	}
}
?>