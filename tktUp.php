<?php
error_reporting(0);
include('config/config.php');

if (isset($_POST['id'])) {
     $id=$_POST['id'];
     $status=$_POST['status'];
	 $query = "UPDATE `tickets` SET  status='$status'  WHERE id='$id' ";
    $result = mysql_query($query);
	echo "success";
}
?>

