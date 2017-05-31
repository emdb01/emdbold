<?php 
include('config/config.php');
ob_start();
error_reporting(0);
if($_GET["status"] ==0){
$availability="Available";
}else if($_GET["status"] ==1){
$availability="Not Available";	
}
 $user_id=$_GET["usid"];
$sql = "UPDATE user  SET availability='$availability'  WHERE  user_id='$user_id' ";
$retval = mysql_query($sql);
?>
<center>
<h3>
THANK YOU...
</h3>
</center>