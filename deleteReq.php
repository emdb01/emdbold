<?php
include('header.php');
if (!isset($_SESSION['first'])) {
    header("Location:index.php");
    die();
}
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$recruiter_id = $_SESSION['user_id'];
?>

<?php

// If the id is posted, delete that in the database.
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $query = "DELETE FROM `requirement`  where id='$id' and recruiterId='$recruiter_id'";
    $result = mysql_query($query);
    header("Location: requirements.php?suc");
}
?>

