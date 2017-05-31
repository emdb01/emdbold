<?php
include("config.php");
    if (isset($_POST['memberId'], $_POST['status_msg'])) {
        $tmavi=time();
        $tmid = $_POST['memberId'];
        $newavail = $_POST['status_msg'];
        $sql = "UPDATE `user` SET  `status_time` = '$tmavi',  `availability` = '$newavail' WHERE `member_id`='$tmid'";
        $result = $conn->query($sql);
        if($result){
            // success
            $response["success"] = 1;
            echo json_encode($response);
        }else{
            $response["success"] = 0;
            echo json_encode($response);
        }
    }
    