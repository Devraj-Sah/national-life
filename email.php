<?php
$to      = 'hadamadhu@hotmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: it@nationallife.com.np' . "\r\n" .
    'Reply-To: it@nationallife.com.np' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>