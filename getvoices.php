<?php

include('config/config.php');
ob_start();
error_reporting(0);
$vid = $_POST["v_id"];
$Qry = mysql_query("SELECT voice FROM `voice_mails` WHERE id='$vid' and status !=2");
$msid = mysql_fetch_assoc($Qry);
$message = $msid['voice'];
echo "<audio controls src='$message' id='paudio'></audio>";
?>