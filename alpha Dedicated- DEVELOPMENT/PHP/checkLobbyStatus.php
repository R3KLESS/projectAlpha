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


$result = mysqli_query ($link,$query);

// create a new array
$rows = [];

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	$rows[] = $row;
}
	
	
		echo json_encode($rows);	
	
/* free result set */
mysqli_free_result($result);


mysqli_close($link);
		
		
?>