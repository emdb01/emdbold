<?php

require 'Mailer/PHPMailerAutoload.php';

function sendInvitationToUsers() {
//    smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 
    
    $to = 'mmurali.technodrive@gmail.com';
    $from = 'info@employeemasterdatabase.com';
    $name = 'EMDB Test Mail';
    $subject = 'Request from Your Recruiter';
    $body = '<!DOCTYPE html>
        
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <meta content="primary - responsive and retina ready template" name="description"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport"/>
<title>Use EMDB and speed up your recruitment process</title>
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
<td><center><img src="https://www.employeemasterdatabase.com/tempimages/55.jpg" width=" 580px"></center>
</td>
</tr>
    
<tr>
<td>

<p style="text-align:justify">The dynamic job market is in need of a balance between number of job seekers and open positions.</p>
<p style="text-align:justify">EMDB is an innovative portal that effectively bridges the gap in the following way :</p>
 <ul style="font-size: 14px;line-height:25px;width:">
<li>Candidates update availability status to "Available" / "Unavailable" against a unique EMDB ID</li>
<li>Recruiters can  easily short list and contact available candidates</li>
<li>"Available" profiles will get preference</li>
<li> "Unavailable" profiles can avoid unnecessary calls</li>
</ul>
   </td> 
</tr>
 
<tr style="padding:0px 10px 0px;">
<td ><center><a href="" style="    clear: both;
    background: #e8870d;
    padding: 10px 35px;
    border-radius: 5px;
    text-decoration: none;
    color: white;">Register with EMDB</a></center>
<p>Or  copy paste the below link in browser.  </p>
<p>https://www.employeemasterdatabase.com/jobseekerregister.php </p>
<p style="font-size: 12px;">For any further assistance, please contact us at 678-899-6845 or drop a mail at  <a href="mailto:support@employeemasterdatabase.com" style="    color: #e23803;
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
    $mail->ConfirmReadingTo = "mmurali.technodrive@gmail.com";
//    $mail->AltBody = $body;
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent successfully.';
    }
}

sendInvitationToUsers();
?>