<?php
$servername = "localhost";
$username = "root";
$password = "oNxwlyLMfOTebxLi";
$dbname = "zadmin_emdb";

//$username = "root";
//$password = "root";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

include("functionsall.php");
