<?php

if (isset($_POST['submit0'])) {
    if ($_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'])) {
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $comment = $_REQUEST['comments'];
        $mailmsg = ' 
          <table border="0" cellspacing="3" cellpadding="8">
                    <tr><td style="border: 1px solid #9B9191; color: #686060;" colspan="2"> <div align="center">GENERAL / CAR QUERY INFORMATION</div></td>
                  </tr>
                  <tr>
                    <td style="border: 1px solid #9B9191; color: #686060;">Name:</td>
                    <td style="border: 1px solid #9B9191; color: #686060;">' . $name . '</td>
                  </tr>                
                  <tr>
                    <td style="border: 1px solid #9B9191; color: #686060;">Email:</td>
                    <td style="border: 1px solid #9B9191; color: #686060;">' . $email . '</td>
                  </tr>  
                   <tr>
                    <td style="border: 1px solid #9B9191; color: #686060;">Comments:</td>
                    <td style="border: 1px solid #9B9191; color: #686060;">' . $comment . '</td>
                  </tr>    
                </table>';

        $to = SITE_EMAIL;
        $subject = "inquiry details";

        $headers = "";
        $headers = "From: Toyota nepal<info@toyotanepal/>";
        $headers .= "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
        $headers .= "X-Priority: 1\r\n";


        if (sendEmail($to, $subject, $mailmsg, "$headers", $email)) {

            $msg = "successfully posted";
        } else {

            $msg = "mail sending fail please try again";
        }
    } else {
        $msg = "Please enter valid Security Code";
    }
}
?>