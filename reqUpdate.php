<?php
error_reporting(0);
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

// If the values are posted, Update them into the database.
if (isset($_POST['jobtitle'])) {
    $id=$_POST['id'];
    $jobTitle = $_POST['jobtitle'];
    $description = $_POST['description'];
    $Skills = $_POST['pskills'];
    $Skills = trim($Skills, ",");
    $Skills = str_replace(",,", ",", $Skills);
    $Skills = str_replace(",,", ",", $Skills);
    $Skills = str_replace("++", "plus plus", $Skills);
   // $Skills1 = str_replace(",", "|", $Skills);

    $result = mt_rand(9001, 1000000);
    $positionId = $result;
    $date = strtotime("-7 day");
    $query = "UPDATE requirement SET jobTitle='$jobTitle',description='$description',primarySkills='$Skills' where id='$id' and recruiterId='$recruiter_id'";
    $result = mysql_query($query);
    header("Location: editReq.php?id=$id&suc");
}
?>

