<?php

include('config/config.php');
ob_start();
error_reporting(0);
$msgid = $_POST["sub_id"];
$Qry = mysql_query("SELECT subject,message FROM `text_mails` WHERE id='$msgid' ");
$msid = mysql_fetch_assoc($Qry);
echo $message = $msid['message'];
?>