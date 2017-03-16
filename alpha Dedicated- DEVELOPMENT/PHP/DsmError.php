<?php

include_once "connection.php"; 



$sql = "UPDATE handleError SET handleErrorMessage = 'DsmError'";

if ($conn->query($sql) === TRUE) {
echo "handleError updated successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}$conn->close();


?>