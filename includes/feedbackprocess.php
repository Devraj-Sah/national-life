<?php
if(isset($_POST['btnFeedback']))
{
	if($_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code']))
	{
		extract($_POST);
		
		if(!empty($txtname) && !empty($txtemail) && !empty($txtcomment) && !empty($security_code))
		{
			$feedbacks -> save($txtname, $txtaddress, $txtphone, $txtemail, $txtcountry, $txtcomment);
			
			//PHPMailer added code

			
//Don't run this unless we're handling a form submission
if (array_key_exists('txtemail', $_POST)) {
    date_default_timezone_set('Etc/UTC');

    require 'PHPMailer/PHPMailerAutoload.php'; 

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP - requires a local mail server
    //Faster and safer than using mail()
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    //$mail->Username = "nnli16414@gmail.com";
    $mail->Username = "feedbackatnli@gmail.com";
    //Password to use for SMTP authentication
    $mail->Password = "MyFeedBackPassword";
    //$mail->Password = "DoNotChangeMe";
    $mail->Port = 587;
    //$mail->SMTPDebug = 2;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $today = date('Y/m/d');
    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('feedbackatnli@gmail.com', 'National Life Insurnace');
    //Send the message to yourself, or whoever should receive contact for submissions
    $mail->addAddress('it@nationallife.com.np', 'National Life IT Department');
    $mail->addAddress('feedbackatnli@gmail.com', 'National Life Insurance Company LTD');
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo($_POST['txtemail'], $_POST['txtname'])) {
        $mail->Subject = 'National Life Insurance: Web Feedback';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
Sender Email: {$_POST['txtemail']}
Sender Name: {$_POST['txtname']}
Sender Address: {$_POST['txtaddress']}
Sender Contact No: {$_POST['txtphone']}
Message: {$_POST['txtcomment']}
Message Date: {$today}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but you shouldn't display errors to users - process the error, log it on your server.
            $feedbackmsg = 'Message Not sent! Please Try Again Later.';
        } else {
            $feedbackmsg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $feedbackmsg = 'Invalid email address, message ignored.';
    }
}
			//end of PHPMailer
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