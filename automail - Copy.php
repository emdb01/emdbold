<?php

error_reporting(0);
include('config/config.php');
$rid = $_REQUEST['mid'];
$to = $_REQUEST['list'];
$requirement = $_REQUEST['requirement'];
$path = 'automails/' . $rid . '/';
$sqlQry = mysql_query("SELECT * FROM `recruiter` WHERE user_id='$rid' ");
$reqid = mysql_fetch_assoc($sqlQry);
$rEmail = $reqid['email'];
$createdDate = date('Y-m-d');
if (!is_dir($path)) {
    require "tts.php";

    $tts = new TextToSpeech();
    $tts->setText("Hi there. This is " . $reqid['first'] . " " . $reqid['middle'] . " " . $reqid['last'] . "calling you from " . $reqid['company'] . ". I have " . $requirement . " and your profile is a good fit for the position. As your EMDB status shows that you are available for new job, I thought you would be interested in this opportunity. If you are, please call me back at " . $reqid['phone'] . ". Thank you!");

    mkdir($path);

    $filename = $path . 'audio.mp3';
    $tts->saveToFile($filename);
    $audio = file_get_contents($filename);
    $audiosrc = base64_encode($mp3data);
    $data = $audio;
    $uids = explode(",", $to);
    for ($i = 0; $i < count($uids); $i++) {
         $query = "INSERT INTO voice_mails (recruiterId,user_id,voice,createdDate,status)VALUES ('$rid','$uids[$i]','$filename','$createdDate','2')";
        $qry = mysql_query($query);
        $uidsql = mysql_query("SELECT * FROM `user` WHERE user_id='$uids[$i]' ");
        $uid = mysql_fetch_assoc($uidsql);
        $userid = $uid['user_id'];
        $toemail = $uid['email'];
        $rEmail = $reqid['email'];
        $subject = 'Automated Voice Mail From Employeemasterdatabse';
        $body ='
<html>
<head>
<title>Welcome To EMDB</title>
</head>
<body>
<h3>Recruiter Contact Details</h3><br>

<p>Name: ' . $reqid['first'] . $reqid['middle'] . $reqid['last'] . '</p>
<p>Phone Number: ' . $reqid['phone'] . '</p>
<p>Company: ' . $reqid['company'] . '</p>
    
<p><i>Regards<i></p>
<p>Employeemasterdatabase.com</p>
</body>
</html>
';
        $fileName = "audio.wav";
        $filetype = 'audio/mpeg';
        $from = 'support@employeemasterdatabase.com';
        $name = "info";
        $fromEmail = $rEmail;

        $randomVal = md5(time());

        $mimeBoundary = "==Multipart_Boundary_x{$randomVal}x";

        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
        $headers = "From: $from\r\nReply-to: $fromEmail"; // Who the email is from (example)
        $headers .= "\nMIME-Version: 1.0\n" .
                "Content-Type: multipart/mixed;\n" .
                " boundary=\"{$mime_boundary}\"";
        $email_message .= "This is a multi-part message in MIME format.\n\n" .
                "--{$mime_boundary}\n" .
                "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" . $body;
        $email_message .= "\n\n";
        $data = chunk_split(base64_encode($data));
        $email_message .= "--{$mime_boundary}\n" .
                "Content-Type: {$filetype};\n" .
                " name=\"{$fileName}\"\n" .
                "Content-Transfer-Encoding: base64\n\n" .
                $data . "\n\n" .
                "--{$mime_boundary}--\n";
        if (mail($toemail, $subject, $email_message, $headers)) {
            echo "success1";
        } else {
            echo "fail";
        }
    }
} else {
    $filename = $path . 'audio.mp3';
    $audio = file_get_contents($filename);
    $audiosrc = base64_encode($mp3data);
    $data = $audio;
    $uids = explode(",", $to);
    for ($i = 0; $i < count($uids); $i++) {
         $query = "INSERT INTO voice_mails (recruiterId,user_id,voice,createdDate,status)VALUES ('$rid','$uids[$i]','$filename','$createdDate','2')";
        $qry = mysql_query($query);
        $uidsql = mysql_query("SELECT * FROM `user` WHERE user_id='$uids[$i]' ");
        $uid = mysql_fetch_assoc($uidsql);
        $userid = $uid['user_id'];
        $toemail = $uid['email'];
        $rEmail = $reqid['email'];
        $subject = 'Automated Voice Mail from Recruiter';
        $body = "Automated Voice Mail From Employeemasterdatabse";
        $fileName = "audio.wav";
        $filetype = 'audio/mpeg';

        $name = "info";
        $fromEmail = $rEmail;

        $randomVal = md5(time());

        $mimeBoundary = "==Multipart_Boundary_x{$randomVal}x";

        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
        $headers = "From: $fromEmail"; // Who the email is from (example)
        $headers .= "\nMIME-Version: 1.0\n" .
                "Content-Type: multipart/mixed;\n" .
                " boundary=\"{$mime_boundary}\"";
        $email_message .= "This is a multi-part message in MIME format.\n\n" .
                "--{$mime_boundary}\n" .
                "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" . $body;
        $email_message .= "\n\n";
        $data = chunk_split(base64_encode($data));
        $email_message .= "--{$mime_boundary}\n" .
                "Content-Type: {$filetype};\n" .
                " name=\"{$fileName}\"\n" .
                "Content-Transfer-Encoding: base64\n\n" .
                $data . "\n\n" .
                "--{$mime_boundary}--\n";
        if (mail($toemail, $subject, $email_message, $headers)) {
            echo "success2";
        } else {
            echo "fail";
        }
    }
}
?>