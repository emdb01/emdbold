<?php

require 'Mailer/PHPMailerAutoload.php';

// recruiter after signup
function mailfunrecruiter($nam, $emd, $mg, $link) {
//        smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 

    $from = 'support@employeemasterdatabase.com';
    $to = $emd;
    $subject = 'Verification Mail From Employeemasterdatabase.com';
    $link = $link;
    $body = '
<html>
<head>
<title>Verification Mail From Employeemasterdatabase.com</title>
</head>
<body>

 Dear ' . "$nam" . ',
<p>Thank you for registering with EMDB</p>
<p>' . "$mg" . '</p>
<p>' . "$link" . '</p>
<p>For any further assistance, you can drop a mail at <b>support@employeemasterdatabase.com</b></p>

<p><i>Thanks<i></p>
<p><i>EMDB<i></p>

<p><i>Regards<i></p>
<p>Employeemasterdatabase.com</p>
</body>
</html>
';
// Always set content-type when sending HTML email
    // $headers = "MIME-Version: 1.0" . "\r\n";
    // $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    // $headers .= 'From: ' . "$email \r\n";
    // $success = mail($to, $subject, $message, $headers);
    $mail->setFrom($from);
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
//    $mail->AltBody = $body;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
//        echo 'Message has been sent successfully.';
    }
}

// recruiter after signup
function mailfun($nam, $emd, $mg, $link) {
    //    smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 

    $from = 'support@employeemasterdatabase.com';
    $to = $emd;
    $subject = 'Verification Mail From Employeemasterdatabase.com';
    $link = $link;
    $body = '
<html>
<head>
<title>Verification Mail From Employeemasterdatabase.com</title>
</head>
<body>

 Dear ' . "$nam" . ',
<p>Thank you for registering with EMDB</p>
<p>' . "$mg" . '</p>
<p>' . "$link" . '</p>
<p>Once your account is activated, you will be directed to your account where you can access your EMDB ID</p>
<p><b>Copy the EMDB ID on to your Resume and</b></p>
<p><b>Select your Availability status as per your current job seeking status</b></p>
<p>For any further assistance, you can drop a mail at <b>support@employeemasterdatabase.com</b></p>

<p><i>Thanks<i></p>
<p><i>EMDB<i></p>

<p><i>Regards<i></p>
<p>Employeemasterdatabase.com</p>
</body>
</html>
';
// Always set content-type when sending HTML email
    // $headers = "MIME-Version: 1.0" . "\r\n";
    // $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    // $headers .= 'From: ' . "$email \r\n";
    // $success = mail($to, $subject, $message, $headers);
    $mail->setFrom($from);
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
//    $mail->AltBody = $body;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
//        echo 'Message has been sent successfully.';
    }
}



function ifidavail($mid) {
    $cmid = $mid;
    $es = 1;
    while ($es == '1') {
        $ifidexist = "SELECT * FROM `user` WHERE member_id='$cmid'";
        $ifidexist_query = mysql_query($ifidexist);
        $ifidexist_check = mysql_num_rows($ifidexist_query);
        if ($ifidexist_check >= 1) {
            $tm = time();
            $tempid = mt_rand(10, 99);
            $cmid = $tempid . $tm;
            $es = 1;
        } else {
            $es = 2;
            return $cmid;
        }
    }
}

//function rmdir_recursive($dir) {
//    foreach (scandir($dir) as $file) {
//        if ('.' === $file || '..' === $file)
//            continue;
//        if (is_dir("$dir/$file"))
//            rmdir_recursive("$dir/$file");
//        else
//            unlink("$dir/$file");
//    }
//
//    rmdir($dir);
//}
//function removefile($dir) {
//    if ($handle = opendir("$dir")) {
//
//        while (false !== ($entry = readdir($handle))) {
//
//
//            if ($entry != "." && $entry != "..") {
//
//                $path = $entry;
//                $ext = pathinfo($path, PATHINFO_EXTENSION);
//                if ($ext == 'pdf' || $ext == 'PDF' || $ext == 'docs' || $ext == 'docx' || $ext == 'doc') {
//                    
//                } else {
//                    $filepathunlink = "./$dir/" . $entry;
//                    @unlink($filepathunlink);
//                }
//            }
//        }
//
//        closedir($handle);
//    }
//}

function curPageURL() {
    $pageURL = 'http';
    if (@$_SERVER["HTTPS"] == "on") {
        @$pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

//Invitation sent to User
function sendInvitationToUser($emailtosend, $mesg, $link, $recruiteremail) {
//    smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 

    $email = $recruiteremail;
    $to = $emailtosend;
    $subject = 'Request from Your Recruiter';
    $remove = 'https://employeemasterdatabase.com/unsubscribe.php?em=' . "$to" . '';
    $message = '
<html>
<head>
<title>Invitation Mail From Employeemasterdatabase.com</title>
</head>
<body>

Hello there,

<p>' . "$mesg" . '</p><br>
<p><a href="' . "$remove" . '" style="color:red;">Remove/Unsubscribe</a></p>
<p><i>Regards<i></p>

<p>Employeemasterdatabase.com</p>
</body>
</html>
';

    $mail->setFrom($email);
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
//        echo 'Message has been sent successfully.';
    }
}

//Invitation sent to User
//Login Credentials sent to User
function sendCredentialsToUser($emailtosend, $mesg, $link, $recruiteremail, $name) {
//    smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 

    $email = $recruiteremail;
    $from = 'support@employeemasterdatabase.com';
    $to = $emailtosend;
    $subject = 'Welcome To EMDB';

    $message = '
<html>
<head>
<title>Login Credetial Mail From Employeemasterdatabase.com</title>
</head>
<body>

Hello ' . "$name" . ',

<p>' . "$mesg" . '</p>
<p><i>Regards<i></p>

<p>Employeemasterdatabase.com</p>
</body>
</html>
';


    $mail->setFrom($from);
    $mail->addAddress($to);
    $mail->addReplyTo($email);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
//        echo 'Message has been sent successfully.';
    }
}

//Login Credentials sent to User
//Ticket send
function sendTicket($emailtosend, $mesg, $subject, $recruiteremail, $name) {
    //    smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 

    $email = $recruiteremail;
    $from = 'support@employeemasterdatabase.com';
    $to = $emailtosend;
    $subject = $subject;

    $body = '
<html>
<head>
<title>Support From Employeemasterdatabase.com</title>
</head>
<body>

Hello ,

<p>' . "$mesg" . '</p>
<p><i>Regards<i></p>

<p>Employeemasterdatabase.com</p>
</body>
</html>
';



    $mail->setFrom($from);
    $mail->addAddress($to);
    $mail->addReplyTo($email);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
//        echo 'Message has been sent successfully.';
    }
}

//ticket send
function recruiterafterverify($fulname, $email) {
//    smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 

    $to = $email;
    $from = 'support@employeemasterdatabase.com';
    $name = $fulname;
    $subject = 'Thank you for registering with EMDB';
    $body = '<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <meta content="primary - responsive and retina ready template" name="description"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>
<title>Welcome to EMDB</title>
<style>


</style>
</head>
<body style="
	font-family: arial,sans-serif;">
<div class="wrapper" style="
        
    margin: auto;
    width: 600px;
    background-size: cover;
}">

<table cellpadding="0px" cellspacing="0px" style="height: auto;
    padding: 10px 10px 10px;
    max-width: 700px;
    width: 600px;
    margin: auto;font-size: 14px;background-color:rgba(33, 150, 243, 0.09);line-height:25px;">
<tr cellpadding="20px" style="height:100px;width:600px;
    background: rgb(11, 195, 236)">
<td><center><img src="https://www.employeemasterdatabase.com/tempimages/logo.png" width="200px"></center>
</td>
</tr>
<tr style="">
<td><center><img src="https://www.employeemasterdatabase.com/tempimages/banner2.jpg" width=" 580px"></center>
</td>
</tr>
<tr>
<td>

	 <h3 style="color:"><i><center>Thank you for registering with EMDB</center></i></h3>
 
</td>
</tr>     
<tr>
<td>

<h4 style="padding:0px 10px 0px;color:#015498">Being a registered user of EMDB, you can make use of the following benefits:</h4>
<ul style="font-size: 14px;line-height:25px;width:">
<li>Confirm availability status of huge number for job seekers</li>
<li>Contact only available candidates and save time excluding unavailable profiles</li>
<li>Create a single point access to all profiles – save them from system or upload from local database</li>
<li>Find out the availability status of the candidates automatically upon uploading the profiles</li>
<li>Sort out all the profiles into several sub-folders</li>
<li>Use inbuilt messaging app to connect to job seekers with private contact details</li>
<li>Create an account for prospective employee from your end</li>
<li>Follow your desired candidates to get e-mail alerts as and when their status is changed</li>
</ul></td>
 
</tr>
<tr style="">
<td >
<center><a href="" style="    clear: both;
    background: #e8870d;
    padding: 10px 35px;
    border-radius: 5px;
    text-decoration: none;
    color: white;">Login into EMDB </a></center>
<p>Or copy paste the below link in browser.  </p>
<p>https://www.employeemasterdatabase.com </p>
<p style="font-size: 12px;">For any further assistance, please drop a mail at <a href="mailto:support@employeemasterdatabase.com" style="    color: #e23803;
    font-weight: bold;">support@employeemasterdatabase.com</a>.</p>
</td>
</tr>
<tr cellpadding="20px" style="height:50px;
    background: rgb(11, 195, 236);color:#fff">
<td><center>&copy; Employee Master Database 2016.All rights reserved.
</center>
</td>
</tr>
</table>


</div> 
</body>
</html>';
    $mail->setFrom($from, $name);
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
//    $mail->AltBody = $body;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
//        echo 'Message has been sent successfully.';
    }
}
function sendMessageFromRecruiter($rEmail, $to, $subject, $mg, $userid) {
    //        smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 

    $body = '
       
<html>
<head>
<title>Recruiter Mail From Employeemasterdatabase.com</title>
</head>
<body>

Hello ,

<p>' . "$mg" . '</p>
    <div class="wrapper" style="margin:30px auto;
	 max-width:500px;
	 border:1px solid #ccc;
	 padding:30px;">
	<div id="main" style="margin:0 auto;"><h3 style="text-align:center;
	 color: #0C52AD;
	 padding:0px 0px 10px 0px">Let us know your job status : </h3>
	<center><a href="http://employeemasterdatabase.com/status.php?status=0&usid=' . "$userid" . '" class="button" style="-webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
    color: initial;
	background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;">Available</a>
	<a href="http://employeemasterdatabase.com/status.php?status=1&usid=' . "$userid" . '" class="button" style="-webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
    color: initial;
	background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;">Not Available</a></center>
	</div>
       </div>
  
    
<p><i>Regards<i></p>
<p>Employeemasterdatabase.com</p>
</body>
</html>
';
// Always set content-type when sending HTML email
//    $headers = "MIME-Version: 1.0" . "\r\n";
//    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
// More headers
//    $headers .= 'From: ' . "$rEmail \r\n";
//    @mail($to, $subject, $message, $headers) or
//            die("Unfortunately, a server issue prevented delivery of your message.");
    
    $mail->setFrom($rEmail);
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
//    $mail->AltBody = $body;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
//        echo 'Message has been sent successfully.';
    }
}
//Invitation sent to User
function sendAutoremindersToUser($to, $subject, $mg) {
//    smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 

    $email = 'support@employeemasterdatabase.com';
    $message = $mg;

    $mail->setFrom($email);
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
//        echo 'Message has been sent successfully.';
    }
}
function voiceMailFromRecruiter($to, $subject, $body, $filename,$auname,$rEmail) {
//    smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 

    $email = 'support@employeemasterdatabase.com';
    $mail->setFrom($email);
    $mail->AddReplyTo($rEmail);
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
     $mail->AddAttachment($filename,$auname);
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
//        echo 'Message has been sent successfully.';
    }
}

?>