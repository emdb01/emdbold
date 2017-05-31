<?php

include('header.php');
if (isset($_REQUEST['mailid'])) {
    $mailid = $_REQUEST['mailid'];
    $recid = $_REQUEST['recid'];
    $useid = $_REQUEST['useid'];
    $query = "UPDATE voicemail_users SET  view_status='1' where mail_id='$mailid' and recruiter_id='$recid' and user_id='$useid' ";
    $result = mysql_query($query);
} else if (isset($_REQUEST['mailids'])) {
    $mailid = $_REQUEST['mailids'];
    $recid = $_REQUEST['recids'];
    $useid = $_REQUEST['useids'];
    $query = "UPDATE textmail_users SET  view_status='1' where mail_id='$mailid' and recruiter_id='$recid' and user_id='$useid' ";
    $result = mysql_query($query);
}
?>