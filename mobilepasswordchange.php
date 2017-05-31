<?php

include("config/config.php");
$dataList = json_decode(file_get_contents("php://input"), true);
$mid = $dataList['member_id'];
$userrole = $dataList['role'];
if (isset($dataList['passo'])) {
    $oldone = $dataList['passo'];
    $pass = $dataList['pass'];
    $insertpass = md5($pass);
    $oldmd5 = md5($oldone);


    if ($userrole == '2') {

        $checkexist = "SELECT * FROM `user` WHERE member_id='$mid' and pass='$oldmd5'";
    }
    $checkexist_query = mysql_query($checkexist);
    $checkexist_check = mysql_num_rows($checkexist_query);

    if ($checkexist_check == '1') {
        if ($userrole == '2') {
            $userupdate = "UPDATE `user` SET `pass` = '$insertpass' where member_id='$mid'";
        }
        $userupdate_result = mysql_query($userupdate);
        echo json_encode(array(
            'response_code' => '200',
            'response_message' => 'Password Updated Successfully'));
    } else {
        echo json_encode(array(
            'response_code' => '200',
            'response_message' => 'The old password does not match with yours'));
    }
}
?>
				
















