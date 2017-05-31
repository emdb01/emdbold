<?php
include("config.php");
/**
 * Registering a user device
 * Store reg id in gcm_users table
 */
if (isset($_POST["userId"]) && isset($_POST["memberId"]) && isset($_POST["regId"])) {
    $userId = $_POST["userId"];
    $memberId = $_POST["memberId"];
    $gcm_regid = $_POST["regId"]; // GCM Registration ID
    
    $sql = "select * FROM gcm_users WHERE member_id = '$memberId' OR gcm_id = '$gcm_regid'";
    $result = $conn->query($sql);
    if ($result) {
        $checkexist_check = $result->num_rows;
        if($checkexist_check > 0){
            $sql1 = "UPDATE gcm_users SET user_id='$userId', member_id='$memberId',gcm_id='',created_at=NOW() WHERE member_id='$memberId' OR gcm_id='$gcm_regid'";
            $result1 = $conn->query($sql1);
            if($result1){
                $response["success"] = 1;
                echo json_encode($response);
            }
        }else{
            
        }
    } else {
        $response["success"] = 0;
        echo json_encode($response);
    }
}    
?>