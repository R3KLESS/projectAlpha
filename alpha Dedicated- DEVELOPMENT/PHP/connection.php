<?php
	
$servername = 'localhost'; 
$username = 'u775822918_user';  
$password = 'Lexilexi1';
$dbname = 'u775822918_test';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo(json_encode(array('status'=>"Connection failed: " . $conn->connect_error)));
	die;
} 



?>
