<?php
error_reporting(0);
ob_start();
include('config/config.php');
$to=$_GET['em'];
$userupdate = "UPDATE `invites` SET `mailStatus`='0' WHERE `email`='$to'";
$userupdate_result = mysql_query($userupdate);

 ?>
<center>
<h3>
THANK YOU...
</h3>

<p>Please <a href="https://www.employeemasterdatabase.com/jobseekerregister.php">click here </a> to sign up as a job seeker. </p>
</center>