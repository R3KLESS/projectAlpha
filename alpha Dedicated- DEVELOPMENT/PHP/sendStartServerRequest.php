<?php

include_once "connection.php"; 



$sql = "UPDATE lobbyRequest SET requestType = 'lobby'";

if ($conn->query($sql) === TRUE) {
echo "lobby request updated successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}$conn->close();


?>