<?php

include_once "connection.php"; 

$mydata = json_decode(file_get_contents('php://input'));

$accountuniqueID = $mydata ->accountUniqueID;

$stmt = $conn->prepare("SELECT isAccountRegistered FROM users WHERE uniqueID = ? "); //check if the unique ID entered matches an account
$stmt->bind_param("s", $accountuniqueID);  // "s" means the database expects a string
$stmt->execute();

if ($stmt->fetch())
{
 echo json_encode(array('status'=>'account found'));
 $stmt->close();

$stmt = $conn->prepare("UPDATE users SET isAccountRegistered = 'registered' WHERE uniqueID = '$accountuniqueID'");
			$stmt->execute();
			
			//echo json_encode(array('status'=>'activation successfull'));



}

else echo  json_encode(array('status'=>'The unique account ID you entered was incorrect please try again'));                  
?>