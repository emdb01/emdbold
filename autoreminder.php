<?php
echo "<META http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
ob_start();
error_reporting(0);
include("config/config.php");
$sql = "SELECT DISTINCT email FROM `invites` where  email NOT IN (select email from user) and `mailStatus`='0' ";
$mys = mysql_query($sql);
$num = mysql_num_rows($mys);
if ($num > 0) {
    while ($row = mysql_fetch_assoc($mys)) {
        $toEmail = $row['email'];
        $name = explode("@", $toEmail);
        $name = explode(".", $name[0]);
        $name = explode("-", $name[0]);
        $name = explode("_", $name[0]);

        include("remindertemplates.php");

        sendAutoremindersToUser($toEmail, $subject, $msg);
    }
}
?>