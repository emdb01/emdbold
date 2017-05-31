<?php
ob_start();
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

// If the values are posted, insert them into the database.
if (isset($_POST['jobtitle'])) {
    $createdDate = date("Y-m-d");
    $jobTitle = $_POST['jobtitle'];
    $description = $_POST['description'];
    $Skills = $_POST['pskills'];
    $Skills = trim($Skills, ",");
    $Skills = str_replace(",,", ",", $Skills);
    $Skills = str_replace(",,", ",", $Skills);
    $Skills = str_replace("++", "plus plus", $Skills);
    $Skills1 = str_replace(",", "|", $Skills);

    $result = mt_rand(9001, 1000000);
    $positionId = $result;
    $date = strtotime("-7 day");
    $query = "INSERT INTO `requirement` (jobTitle,primarySkills,description,recruiterId,createdDate,positionId,matchId) VALUES ('$jobTitle', '$Skills','$description','$recruiter_id','$createdDate','','')";
    $result = mysql_query($query) or die('MySql Error' . mysql_error());
	
    header("Location: requirements.php");
	
}
?>
