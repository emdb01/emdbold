<?php
include("config.php");
if(isset($_POST['memberId'])){
    $mID = $_POST['memberId'];
    $sql = "select * from `user` where `member_id` ='$mID' and `verify` ='1'";
    $result = $conn->query($sql);
    $checkexist_check = $result->num_rows;
    if($checkexist_check == 1 ){        
        $user = [];
        while($row = $result->fetch_assoc()) {                   
            $user["status_time"] = $row['status_time'];
            $user["notify_time"] = $row['notify_time'];
            /*$tm2=time();//get no of days count
            $user["current_time"] = $tm2;
            $user["numDays"] = abs($tm2 - $row['status_time'])/60/60/24;*/
        }       
        $response["success"] = 1;
        $response["user"] = $user;
        echo json_encode($response);
    }else{
        $response["success"] = 0;
        echo json_encode($response);
    }   
}