<?php

include("config/config.php");
$dataList = json_decode(file_get_contents("php://input"), true);
?>

<?php

if (isset($dataList['fname'])) {
    $fname = $dataList['fname'];
    $lname = $dataList['lname'];
    @$mname = $dataList['mname'];
    @$availability = $dataList['availability'];
    if ($mname == "") {
        $fulname = $fname . " " . $lname;
    } else {
        $fulname = $fname . " " . $mname . " " . $lname;
    }

    $email = $dataList['email'];
    $vid = md5($email);
    $phone = $dataList['phone'];
    //$availability = "Available";
    $pass = $dataList['pass'];
    $pass = md5($pass);
    $country = $dataList['country'];
    $checkexist_check = "";
    $checkexist = "select count(*)  as total from `recruiter`, `user` where recruiter.email='$email' OR user.email='$email' OR user.phone='$phone' OR recruiter.phone='$phone'";

//$checkexist = "SELECT * FROM `recruiter` WHERE email='$email' or phone='$phone'";
    $checkexist_query = mysql_query($checkexist);
    @$data = mysql_fetch_assoc($checkexist_query);
    $checkexist_check = $data['total'];

    //email validation script
    require("email_validation.php");
    $validator = new email_validation_class;
    if (!function_exists("GetMXRR")) {
        $_NAMESERVERS = array();
        include("getmxrr.php");
    }
    $validator->timeout = 10;
    $validator->data_timeout = 0;
    $validator->localuser = "info";
    $validator->localhost = "phpclasses.org";
    $validator->debug = 1;
    $validator->html_debug = 1;
    $mymal = $email;
    $mymails = trim($mymal);
    if (strlen($error = $validator->ValidateAddress($mymails, $valid))) {
        $mymails = 0;
    } elseif (!$valid) {
        $mymails = 0;
        if (count($validator->suggestions)) {
            $suggestion = $validator->suggestions[0];
            $link = '?email=' . UrlEncode($suggestion);
            $mymails = 0;
        }
    } elseif (($result = $validator->ValidateEmailBox($mymails)) < 0) {
        $mymails = 0;
    } else if ($result == 0) {
        $mymails = 0;
    } else if ($result == 1) {
        $mymails = 1;
    }
//email validation script

    if ($mymails == 0) {
        echo json_encode(array(
            'response_code' => '200',
            'response_message' => 'The email Address is not a valid'));
        ?>


        <?php

    } else if ($checkexist_check >= 1) {
        echo json_encode(array(
            'response_code' => '200',
            'response_message' => 'The email Address or Phone number already exists. Please use different ones'));
        ?>

        <?php

    } else {
        $tm = time();
        $tempid = mt_rand(10, 99);
        $mid = $tempid . $tm;
        $currentDate = date("Y-m-d");
        $mid = ifidavail($mid);

        $adduser = "INSERT INTO `user` (`first`, `middle`, `last`, `member_id`, `status_time`, `email`,`pass`, `phone`, `availability` , `country`, `role`, `status`, `verify`, `createdDate`) VALUES 
('$fname','$mname','$lname','$mid','$tm','$email','$pass','$phone','$availability','$country','2','2','2','$currentDate')";


        $adduser_result = mysql_query($adduser);
        if ($adduser_result) {
            $formactive = 1;
            $link = 'https://www.employeemasterdatabase.com/verify.php?vid=' . $vid . '&tm=' . $mid;
            $msg = "Click the link below or copy and paste  link in browser to activate your EMDB account.";
            $resu = mailfun($fulname, $email, $msg, $link);
            echo json_encode(array(
                'response_code' => '200',
                'response_message' => 'Thank you for Registering with Employee Master Database.An email has been sent to the registered email Id.Please verify your email to activate your account.If you are unable to locate the email in the inbox, please check the spam folder'));
            ?>

            <?php

        }
    }
}
?>

