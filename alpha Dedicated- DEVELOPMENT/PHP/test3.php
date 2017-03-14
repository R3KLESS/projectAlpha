<?php

$servername = 'localhost'; 
$username = 'u775822918_user';  
$password = 'Lexilexi1';
$dbname = 'u775822918_test';

// Create connection
$link = new mysqli ($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) 
{
    echo(json_encode(array('status'=>"Connection failed: " . $mysqli->connect_error)));
	die;
} 

// select server names & server status from the statusCheck database 
$query = "SELECT ServerName, ServerStatus FROM statusCheck ORDER by ID";  


if ($stmt = mysqli_prepare($link,$query))
{
	//execute statment
	
	mysqli_stmt_execute($stmt);
	
	//bind variables
	
	mysqli_stmt_bind_result($stmt, $ServerName, $ServerStatus);
	
	//fetch values
	
	while (mysqli_stmt_fetch($stmt))
		
		{
			echo json_encode(array('ServerName'=> $servername, 'ServerStatus'=> $serverStatus);
		}
}
		
  /* close statement */
    mysqli_stmt_close($stmt);
}

/* close connection */
mysqli_close($link);
		
?>