<?php

$servername = 'localhost'; 
$username = 'u775822918_user';  
$password = 'Lexilexi1';
$dbname = 'u775822918_test';

// Create connection
$mysqli = new mysqli ($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) 
{
    echo(json_encode(array('status'=>"Connection failed: " . $mysqli->connect_error)));
	die;
} 

// select server names & server status from the statusCheck database 
$query = "SELECT ServerName, ServerStatus FROM statusCheck ORDER by ID";  


if ($stmt = $mysqli_->pre ($query))
{
	//execute statement
	$stmt->execute();
	
	//bind result variables;
	$stmt->bind_result($serverName,$ServerStatus);
	
	//Fetch values
	while ($stmt->fetch())
	{
		echo $serverName;
		echo $serverStatus;
	}
	
	$stmt->close();
	
}

$mysqli->close();
		
		
?>