<?php

include("config/config.php");
$dataList = json_decode(file_get_contents("php://input"), true);
$e_id = $dataList['user_id'];
?>

<?php

if (isset($dataList['subject'])) {
    $createdDate = date("Y-m-d");
    $subject = $dataList['subject'];
    $message = $dataList['message'];



    $to = 'support@employeemasterdatabase.com';
    $sqlQry = mysql_query("SELECT * FROM `user` WHERE user_id='$e_id' ");

    $reqid = mysql_fetch_assoc($sqlQry);
    $femail = $reqid['email'];
    $fname = $reqid['first'];
    $lname = $reqid['last'];
    $fulname = $fname . " " . $lname;



    $query = "INSERT INTO `tickets` (subject, message,attachement,user_id,recruiter_id,createdDate, status) VALUES ('$subject', '$message', '','$e_id','','$createdDate', 'Pending')";
    sendTicket($to, $message, $subject, $femail, $fulname);

    $result = mysql_query($query) or die('MySql Error' . mysql_error());
     echo json_encode(array(
               'response_code' => '200',
               'response_message' => 'Ticket Created Successfully'));
}
?>

