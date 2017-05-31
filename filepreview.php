<?php 

ob_start();
error_reporting(0);
session_start();
include("config/config.php");
$mid = $_SESSION['user_id'];
$pre = "SELECT * FROM `removefiles` where recruiterId='$mid' and status=0";
$pmys = mysql_query($pre);
$row = mysql_fetch_assoc($pmys);
echo $path = $row['filepath'];

?>