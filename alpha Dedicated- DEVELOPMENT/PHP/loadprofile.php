<?php

include_once "connection.php"; 

$mydata = json_decode(file_get_contents('php://input'));

$userid = $mydata ->userid;
$key = $mydata ->sessionkey;

$stmt = $conn->prepare("SELECT session_key FROM active_logins WHERE user_id = ? ");

$stmt->bind_param("s", $userid);  // "s" means the database expects a string

$stmt->execute();

$stmt->bind_result($row_sessionkey);

if (!$stmt->fetch()) echo  json_encode(array('status'=>'You are not logged in.'));

else {
 
	if ($key == $row_sessionkey)  { //  if the user owns the current active session
		
		$chararray = array();
		
		$stmt->close();
		
		$stmt = $conn->prepare("SELECT id, username, playerlevel, currentgold, tributepoints, charactermastery  FROM characters WHERE user_id = ? ");
		
		$stmt->bind_param("s", $userid);
		
		$stmt->execute();
				
		$stmt->bind_result($row_id, $row_usename, $row_playerlevel, $row_currentgold, $row_tributepoints, $row_charactermastery );
					
		while ($stmt->fetch()) 
		{
			//add to array of characters:	
			$chararray[] = array('id' => $row_id, 'username'=>$row_usernname, 'playerlevel'=>$row_playerlevel, 'currentgold'=>$row_currentgold, 'tributepoints'=>$row_tributepoints, 'charactermastery'=>$row_charactermastery );
		}

		echo json_encode(array('status'=>'OK', 'characters'=>$chararray));

	} 

}


?>
