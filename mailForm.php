<?php
error_reporting(0);
include('config/config.php');
ob_start();

$rid = isset($_POST["rid"]) ? $_POST["rid"] : "";
$to = $_REQUEST['list'];

if ($_POST["action"] == 'sendNew') {
    $subject = isset($_POST["subject"]) ? $_POST["subject"] : $subject;
    $message = isset($_POST["message"]) ? $_POST["message"] : "";
    $subject = mysql_real_escape_string($subject);
    $message = mysql_real_escape_string($message);

    $sqlQry = mysql_query("SELECT email FROM `recruiter` WHERE user_id='$rid' ");
    $reqid = mysql_fetch_assoc($sqlQry);
    $rEmail = $reqid['email'];
    $createdDate = date('Y-m-d');
    if ($to != '') {

        if ($subject != '') {
            
            $query = "INSERT INTO text_mails (recruiter_id,subject,message,createdDate)VALUES ('$rid','$subject','$message','$createdDate')";
            $qry = mysql_query($query);
            $mail_id=mysql_insert_id();
            
            $uids = explode(",", $to);
            for ($i = 0; $i < count($uids); $i++) {
                $query = "INSERT INTO textmail_users (mail_id,recruiter_id,user_id,createdDate)VALUES ('$mail_id','$rid','$uids[$i]','$createdDate')";
                $qry = mysql_query($query);
                $uidsql = mysql_query("SELECT email FROM `user` WHERE user_id='$uids[$i]' ");
                $uid = mysql_fetch_assoc($uidsql);
                $userid = $uids[$i];
                $toemail = $uid['email'];
                $message= '<img alt="" src="https://www.employeemasterdatabase.com/newversion/voiceread.php?mailids='.$mail_id.'&recids='.$rid.'&useids='.$uids[$i].'" width="0" height="0"  border="0" style="display:none;"/>'.$message;
                sendMessageFromRecruiter($rEmail, $toemail, $subject, $message, $userid);
            }
            echo "Your message was successfully sent.";
        } else {
            echo "Unfortunately, your message could not be sent.";
        }
    } else {
        echo "Please select atleast one entry.";
    }
} else if ($_POST["action"] == 'sendPre') {
    $msgid = $_POST["msgid"];
    $Qry = mysql_query("SELECT subject,message FROM `text_mails` WHERE id='$msgid' ");
    $msid = mysql_fetch_assoc($Qry);

    $subject = $msid['subject'];
    $message = $msid['message'];


    $sqlQry = mysql_query("SELECT email FROM `recruiter` WHERE user_id='$rid' ");
    $reqid = mysql_fetch_assoc($sqlQry);
    $rEmail = $reqid['email'];
    $createdDate = date('Y-m-d');
    if ($to != '') {

        if ($subject != '') {

            $uids = explode(",", $to);
            for ($i = 0; $i < count($uids); $i++) {
                $query = "INSERT INTO textmail_users (mail_id,recruiter_id,user_id,createdDate)VALUES ('$msgid','$rid','$uids[$i]','$createdDate')";
                $qry = mysql_query($query);
                $uidsql = mysql_query("SELECT email FROM `user` WHERE user_id='$uids[$i]' ");
                $uid = mysql_fetch_assoc($uidsql);
                $userid = $uids[$i];
                $toemail = $uid['email'];
                sendMessageFromRecruiter($rEmail, $toemail, $subject, $message, $userid);
            }
        } else {
            
        }
    } else {
        
    }
}else if ($_POST["action"] == 'deletePre') {
    $msgid = $_POST["msgid"];
    $query = "UPDATE `text_mails` SET  status='1'  WHERE id='$msgid' ";
    $result = mysql_query($query);
}

?>