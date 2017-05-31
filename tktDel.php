<?php
error_reporting(0);
include('header.php');
if (!isset($_SESSION['first'])) {
    header("Location:index.php");
    die();
}


?>

<?php

// If the id is posted, delete that in the database.
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $query = "DELETE FROM `tickets` WHERE id='$id' ";
    $result = mysql_query($query);
    header("Location: tickets.php");
      
}
?>

