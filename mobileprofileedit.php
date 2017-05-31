<?php
include("config/config.php");
$dataList = json_decode(file_get_contents("php://input"), true);
$fname = $dataList['fname'];
$mid = $dataList['member_id'];

if (isset($fname)) {
    $mid = $dataList['member_id'];
    $lname = $dataList['lname'];
    @$mname = $dataList['mname'];
    $email = $dataList['email'];
    $phone = $dataList['phone'];
    $notify = $dataList['notificdur'];
    $availability = $dataList['availability'];
    @$typeofjob = $dataList['typeofjob'];
    @$technologies = $dataList['technologies'];
    @$country = $dataList['country'];
    @$zip = $dataList['zip'];
    @$zipdist = $dataList['zipdist'];
    @$salary = $dataList['fromSal'] . '-' . $dataList['toSal'];
    @$flexible = $dataList['flexible'];
    $checkexist = "SELECT * FROM `user` WHERE (email='$email' or phone='$phone') and member_id !='$mid'";

    $checkexist_query = mysql_query($checkexist);
    $checkexist_check = mysql_num_rows($checkexist_query);
    if ($checkexist_check >= 1) {
        while ($checkexist_result1 = mysql_fetch_array($checkexist_query)) {
            $exemail = $checkexist_result1['email'];
            if ($exemail == $email) {
                echo json_encode(array(
                    'response_code' => '200',
                    'response_message' => 'The email Address already exists. Please use different ones'));
                ?>
              
                <?php
            } else {
                echo json_encode(array(
                    'response_code' => '200',
                    'response_message' => 'The phone number already exists. Please use different ones'));
                ?>
            
                <?php
                break;
            }
        }
    } else {
        $tm = time();
        $userupdate = "UPDATE `user` SET `first` = '$fname', `middle` = '$mname', `last` = '$lname', `status_time` = '$tm',`notify_time` = '$notify',`email` = '$email', `phone` = '$phone', `availability` = '$availability', `job` = '$typeofjob', `technology` = '$technologies', `salary` = '$salary', `zip` = '$zip', `distance` = '$zipdist', `flexible` = '$flexible', `country` = '$country' WHERE `member_id`='$mid'";
        $userupdate_result = mysql_query($userupdate);
        if ($availability1 != $availability) {
            date_default_timezone_set('Asia/Kolkata');
            $dateTime = date('Y-m-d H:i:s');
            $userstatus = "UPDATE `user` SET  `todaystatus` = '1',laststatustime='$dateTime' WHERE `member_id`='$mid'";
            $userstatus_result = mysql_query($userstatus);
        }
        echo json_encode(array(
            'response_code' => '200',
            'response_message' => 'Profile updated successfully'));
    }
}
?>