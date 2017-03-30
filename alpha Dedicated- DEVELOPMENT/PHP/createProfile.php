<?php

include_once "connection.php"; 

$mydata = json_decode(file_get_contents('php://input'));

$userid = $mydata ->userid;
$key = $mydata ->sessionkey;

$profileName;


$stmt = $conn->prepare("SELECT session_key FROM active_logins WHERE user_id = ? ");

$stmt->bind_param("i", $userid);  // "i" means the database expects an integer

$stmt->execute();

$stmt->bind_result($row_sessionkey);

if (!$stmt->fetch()) echo  json_encode(array('status'=>'You are not logged in.'));

else 
{
	 
	if ($key == $row_sessionkey)  
	{ //  if the user owns the current active session
	
		$stmt->close();
		
		$stmt = $conn->prepare("SELECT username FROM users WHERE id = $userid ");
		
		$stmt->bind_param("s", $profileName); 

		$stmt->execute();
		
		if ($stmt->fetch())  echo  json_encode(array('status'=>'username found'));
		
		$stmt->close();
		
			// create the new peofile
			$stmt = $conn->prepare("INSERT INTO profiles VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
			
			if ($stmt == false)
					printf("Errormessage: %s\n", $conn->error);
			
			$profileName; $currentGold =0; $tributePoints = 0; $characterMastery = 0; 
			$playerLevel =1; $experience = 0; $clan = "none";
					
			$stmt->bind_param("sssssssss", $userid, $profileName, $currentGold, $tributePoints, $characterMastery, $playerLevel, $experience, $exp, $clan); 
		
			$stmt->execute();
					
			$stmt->close();
					
			
			echo json_encode(array('status'=>"OK" ));
		
		

	}
	
	else
	{ echo  json_encode(array('status'=>'You are not logged in.'));
	}
}

?>
