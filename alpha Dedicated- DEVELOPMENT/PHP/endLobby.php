<?php

include_once "connection.php"; 


$sql = "UPDATE lobbyRequest SET requestType = 'waitingForRequest'";

if ($conn->query($sql) === TRUE) {
    echo "lobby request updated successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}



?>