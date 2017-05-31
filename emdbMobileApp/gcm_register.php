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
    $sql = "select * FROM gcm_users WHERE gcm_id = '$gcm_regid'";
    $result = $conn->query($sql);
    if ($result) {
        $checkexist_check = $result->num_rows;
        if($checkexist_check == 0){
            $sql = "select * FROM gcm_users WHERE user_id = '$userId'";
            $result = $conn->query($sql);
            $checkexist_check = $result->num_rows;
            if($checkexist_check == 0){
                $sql2 = "INSERT INTO gcm_users(user_id, member_id, gcm_id, created_at) VALUES('$userId', '$memberId', '$gcm_regid', NOW())";
                $result2 = $conn->query($sql2);
                if($result2){
                    $response["success"] = 1;
                    $response["messsage"] = "Inserted USER successfully";
                    echo json_encode($response);
                }
            }elseif($checkexist_check == 1){
                $sql2 = "UPDATE gcm_users SET member_id='$memberId', gcm_id='$gcm_regid', created_at=NOW() WHERE user_id='$userId'";
                $result2 = $conn->query($sql2);
                if($result2){
                    $response["success"] = 1;
                    $response["messsage"] = "UPDATED USER successfully";
                    echo json_encode($response);
                }
            }elseif($checkexist_check > 1) {
                $sql2 = "DELETE FROM gcm_users WHERE user_id='$userId'";
                $result2 = $conn->query($sql2);
                if($result2){
                    $sql3 = "INSERT INTO gcm_users(user_id, member_id, gcm_id, created_at) VALUES('$userId', '$memberId', '$gcm_regid', NOW())";
                    $result3 = $conn->query($sql3);
                    if($result3){
                        $response["success"] = 1;
                        $response["messsage"] = "Deleted And Inserted USER successfully";
                        echo json_encode($response);
                    }
                }
            }    
        }elseif($checkexist_check == 1){
            $sql2 = "UPDATE gcm_users SET user_id='$userId', member_id='$memberId', created_at=NOW() WHERE gcm_id='$gcm_regid'";
            $result2 = $conn->query($sql2);
            if($result2){
                $response["success"] = 1;
                $response["messsage"] = "Updated successfully";
                echo json_encode($response);
            }
        }elseif($checkexist_check > 1) {
            $sql2 = "DELETE FROM gcm_users WHERE gcm_id='$gcm_regid'";
            $result2 = $conn->query($sql2);
            if($result2){
                $sql3 = "INSERT INTO gcm_users(user_id, member_id, gcm_id, created_at) VALUES('$userId', '$memberId', '$gcm_regid', NOW())";
                $result3 = $conn->query($sql3);
                if($result3){
                    $response["success"] = 1;
                    $response["messsage"] = "Deleted And Inserted successfully";
                    echo json_encode($response);
                }
            }
        }
    }
}