<?php

include_once "connection.php"; 

$mydata = json_decode(file_get_contents('php://input'));

$accountname = $mydata -> accountname; 
$accountpassword = $mydata -> accountpassword; 
$accountemail = $mydata -> accountemail;
$accountuniqueID = $mydata -> accountuniqueID;
$accountsecurityquestion = $mydata -> accountsecurityquestion;
$accountsecurityanswer = $mydata -> accountsecurityanswer;
$accountisregistered = "Not Registered";  

if ($stmt = $conn->prepare("SELECT * FROM users WHERE email = ? ")) //check if the email has already been used to register
{
    $stmt->bind_param("s", $accountemail);  // "s" means the database expects a string

    $stmt->execute();

    if ($stmt->fetch())  echo  json_encode(array('status'=>'This email adress has already been used to register an account'));
 
        else
        {
            if ($stmt = $conn->prepare("SELECT * FROM users WHERE username = ? ")) //check if the account name is already taken
            {
                $stmt->bind_param("s", $accountname);  // "s" means the database expects a string

                $stmt->execute();

                if ($stmt->fetch())  echo  json_encode(array('status'=>'This account name is unavailable')); 
  
                        else 
                            {  //create this new account

                            $hash = password_hash($accountpassword, PASSWORD_DEFAULT); //using cool new PHP 5.5 encryption

                            $stmt = $conn->prepare("INSERT INTO users VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
    
                            $stmt->bind_param("sssssss", $accountname, $accountemail, $accountsecurityquestion, $accountsecurityanswer, $accountisregistered, $accountuniqueID, $hash );
   
                            $stmt->execute();
   
                            $stmt->close();
							
							$to      = "$accountemail";
							$subject = 'Account Activation';
							$message = 'Thankyou for registering for the MOBA kit' ."\r\n" .'please enter this unique account ID' ."  " ."$accountuniqueID". "\r\n". 'to activate your account';
							$headers = 'From: testEmail@MOBAKIT.com' . "\r\n" .
							'Reply-To: dj-teknike@outlook.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();

							if (mail($to, $subject, $message, $headers))
							{
							echo json_encode(array('status'=>'OK' ));
							}
							else
					
							echo json_encode(array('status'=>'Error' ));

                            }
            }
       }
}


?>