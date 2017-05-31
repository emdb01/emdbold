<?php

error_reporting(0);
include('config/config.php');
//print_r($_REQUEST);
//print_r($_POST);
$rid = $_REQUEST['rid'];
$to = $_REQUEST['list'];
$vtitle = $_REQUEST['vtitle'];
if (isset($_FILES['file'])) {
    
    $audio = file_get_contents($_FILES['file']['tmp_name']);
    $audiosrc = base64_encode($audio);
    $data = $audio;
    $time = time();
    $path = 'audiofiles/' . $rid . '/';
    if (!is_dir($path)) {
        mkdir($path);
    }
    $filename = $path . $time . '.wav';
    $auname = 'voice'.$time . '.wav';
    $filedata = file_put_contents($filename, $data);
    $createdDate = date('Y-m-d');
    $uids = explode(",", $to);
     $query = "INSERT INTO voice_mails (recruiterId,voice,createdDate,title)VALUES ('$rid','$filename','$createdDate','$vtitle')";
        $qry = mysql_query($query);
        $maid=mysql_insert_id();
    for ($i = 0; $i < count($uids); $i++) {
        $uids[$i];
        $query = "INSERT INTO voicemail_users (mail_id,recruiter_id,user_id,createdDate)VALUES ('$maid','$rid','$uids[$i]','$createdDate')";
        $qry = mysql_query($query);
        $uidsql = mysql_query("SELECT * FROM `user` WHERE user_id='$uids[$i]' ");
        $uid = mysql_fetch_assoc($uidsql);
        $userid = $uid['user_id'];
        $toemail = $uid['email'];
        $status = $uid['availability'];
        $sqlQry = mysql_query("SELECT * FROM `recruiter` WHERE user_id='$rid' ");
        $reqid = mysql_fetch_assoc($sqlQry);
        $rEmail = $reqid['email'];
        $subject = 'Voice Mail From Employeemasterdatabse';

        $body = '
            <img alt="" src="https://www.employeemasterdatabase.com/newversion/voiceread.php?mailid='.$maid.'&recid='.$rid.'&useid='.$uids[$i].'" width="0" height="0"  border="0" style="display:none;"/>
<html>
<head>
<title>Welcome To EMDB</title>
</head>
<body>
<h3>Hi </h3>
<p>
You have a new EMDB  voice message. The message is sent by <b> ' . $reqid['first'] .'</b> <b>from  ' . $reqid['company'] . '</b>.
</p>
<p>Please find your voice message attached to this email.</p>
<h3>Recruiter Contact Details</h3><br>

<p>Name: ' . $reqid['first'] . $reqid['middle'] . $reqid['last'] . '</p>
<p>Phone Number: ' . $reqid['phone'] . '</p>
<p>Company: ' . $reqid['company'] . '</p>
    
<p><i>Regards<i></p>
<p>Employeemasterdatabase.com</p>
</body>
</html>
';
         if ($status == 'Available' || $status == 'Looking For Change') {
            if (voiceMailFromRecruiter($toemail, $subject, $body, $filename,$auname, $rEmail)) {
                $query1 = "UPDATE `voice_mails` SET  status='2'  WHERE user_id='$userid' and  recruiterId='$rid'";
                $result = mysql_query($query1);
            } else {
                echo "";
            }
        }
        
//        $fileName = "audio.wav";
//        $filetype = 'audio/mpeg';
//        $from = 'support@employeemasterdatabase.com';
//        $name = "info";
//        $fromEmail = $rEmail;
//
//        $randomVal = md5(time());
//
//        $mimeBoundary = "==Multipart_Boundary_x{$randomVal}x";
//
//        $semi_rand = md5(time());
//        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
//        $headers = "From: $from\r\nReply-to: $fromEmail"; 
//        $headers .= "\nMIME-Version: 1.0\n" .
//                "Content-Type: multipart/mixed;\n" .
//                " boundary=\"{$mime_boundary}\"";
//        $email_message .= "This is a multi-part message in MIME format.\n\n" .
//                "--{$mime_boundary}\n" .
//                "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
//                "Content-Transfer-Encoding: 7bit\n\n" . $body;
//        $email_message .= "\n\n";
//        $data = chunk_split(base64_encode($data));
//        $email_message .= "--{$mime_boundary}\n" .
//                "Content-Type: {$filetype};\n" .
//                " name=\"{$fileName}\"\n" .
//                "Content-Transfer-Encoding: base64\n\n" .
//                $data . "\n\n" .
//                "--{$mime_boundary}--\n";
//        if ($status == 'Available' || $status == 'Looking For Change') {
//            if (mail($toemail, $subject, $email_message, $headers)) {
//                $query1 = "UPDATE `voice_mails` SET  status='2'  WHERE user_id='$userid' and  recruiterId='$rid'";
//                $result = mysql_query($query1);
//            } else {
//                echo "";
//            }
//        }
        
    }
}
?>
