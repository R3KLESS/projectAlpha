<?php

$uniqueID =1;

$to      = 'dj-teknike@outlook.com';
$subject = 'Account Activation';
$message = 'Thankyou for registering for the MOBA kit' ."\r\n" .'please enter this unique account ID' ."  " ."$uniqueID". "\r\n". 'to activate your account';
$headers = 'From: testEmail@MOBAKIT.com' . "\r\n" .
    'Reply-To: dj-teknike@outlook.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers))
{
echo "mail sent";
}



else
{
echo"error mail not sent";
}
?>
