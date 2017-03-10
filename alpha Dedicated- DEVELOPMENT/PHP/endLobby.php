<?php

include_once "connection.php"; 



$query = "DELETE requestType FROM LobbyRequest";

$result = $conn->query($query);
$row =$result->fetch_assoc();

echo $row["requestType"];

?>