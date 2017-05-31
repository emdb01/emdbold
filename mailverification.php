<?php
error_reporting(0);
include('config/config.php');
ob_start();
$to = $_REQUEST['list'];
if ($to != '') {
    $uids = explode(",", $to);
            for ($i = 0; $i < count($uids); $i++) {
                $uidsql = mysql_query("SELECT first,email,member_id FROM `user` WHERE user_id='$uids[$i]' ");
                $uid = mysql_fetch_assoc($uidsql);
                $userid = $uids[$i];
                $first = $uid['first'];
                $email = $uid['email'];
                $vid = md5($uid['email']);
                $mid = $uid['member_id'];
                $link = 'https://www.employeemasterdatabase.com/verify.php?vid=' . $vid . '&tm=' . $mid;
                $msg = "Click the link below or copy and paste  link in browser to activate your EMDB account.";
                                $resu = mailfun($first, $email, $msg, $link);
            }
} 

?>