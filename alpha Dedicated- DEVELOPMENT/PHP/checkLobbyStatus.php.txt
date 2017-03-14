<?php

include_once "connection.php"; 



$query = "SELECT requestType FROM LobbyRequest";

$result = $conn->query($query);
$row =$result->fetch_assoc();

echo $row["requestType"];

?>