<?php
$servername = "localhost";
$username = "datafreaks";
$password = "sesame";
$dbname = "DATAFREAKS_DATAWAREHOUSE";

global $conn;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

?>