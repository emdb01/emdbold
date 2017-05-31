<?php
include("config.php");
    if (isset($_POST['member_id'])) {
        $mid = $_POST['member_id'];
        $oldone=$_POST['passo'];
        $pass=$_POST['pass'];
        $insertpass=md5($pass);
        $oldmd5=md5($oldone);
        
        $checkexist = "SELECT * FROM `user` WHERE member_id='$mid' and pass='$oldmd5'";
        $result = $conn->query($checkexist);
        $checkexist_check = $result->num_rows;
        if($checkexist_check == 1 ){
            $userupdate= "UPDATE `user` SET `pass` = '$insertpass' where member_id='$mid'";
            $result2 = $conn->query($userupdate);
            if($result2){
                // success
                $response["success"] = 1;
                echo json_encode($response);
            }else{
                $response["success"] = 0;
                echo json_encode($response);
            }
        }else {
            $response["success"] = 2;
            echo json_encode($response);
        }
    }