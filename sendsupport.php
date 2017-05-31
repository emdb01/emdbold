<?php 
include('config/config.php');

$mesg=$_POST['mes'];
$subject=$_POST['sub'];
$email=$_POST['email'];
$toemail=$_POST['toemail'];
sendReplyTicket($toemail,$mesg,$subject,$email);
function sendReplyTicket($emailtosend,$mesg,$subject,$email){
    //        smtp config settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.mailgun.org';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@employeemasterdatabase.com';
    $mail->Password = 'techno123';
//    smtp config settings 

$from='support@employeemasterdatabase.com'; 		
$to = $emailtosend;
$subject = $subject;

$body = '
<html>
<head>
<title>Support From Employeemasterdatabase.com</title>
</head>
<body>

Hello ,

<p>'."$mesg".'</p>
<p><i>Regards<i></p>

<p>Employeemasterdatabase.com</p>
</body>
</html>
';




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

?>