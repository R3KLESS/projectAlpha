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

 
$query = "SELECT requestType FROM lobbyRequest"; 

if ($stmt = mysqli_prepare($link,$query))
{
	//execute statment
	
	mysqli_stmt_execute($stmt);
	
	//bind variables
	
	mysqli_stmt_bind_result($stmt, $RequestType);
	
	//fetch values
	while(mysqli_stmt_fetch($stmt));
	{
	
	echo $RequestType;
	}
}
	
?>