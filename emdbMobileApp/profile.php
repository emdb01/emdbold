<?php
include("config.php");
if(isset($_POST['memberId'])){
    $mID = $_POST['memberId'];
    $sql = "select * from `user` where `member_id` ='$mID' and `verify` ='1'";
    $result = $conn->query($sql);
    $checkexist_check = $result->num_rows;
    if($checkexist_check == 1 ){
        /*while($row = $result->fetch_assoc()) {
            $first = $row['first'];
            $middle = $row['middle'];
            $last = $row['last'];
            $member_id = $row['member_id'];
            $email = $row['email'];
            $phone = $row['phone'];
            $availability = $row['availability'];
            $job = $row['job'];
            $technology = $row['technology'];
            $salary_min = $row['salary_min'];
            $salary = $row['salary'];
            $zip = $row['zip'];
        }*/
        $user = [];
        while($row = $result->fetch_assoc()) {
            $user["user_id"] = $row['user_id'];
            $user["first"] = $row['first'];
            $user["middle"] = $row['middle'];
            $user["last"] = $row['last'];
            $user["member_id"] = $row['member_id'];            
            $user["status_time"] = $row['status_time'];
            $user["notify_time"] = $row['notify_time'];
            $user["email"] = $row['email'];
            $user["phone"] = $row['phone'];
            $user["availability"] = $row['availability'];
            $user["job"] = $row['job'];
            $user["technology"] = $row['technology'];
            $user["salary_min"] = $row['salary_min'];
            $user["salary"] = $row['salary'];
            $user["zip"] = $row['zip'];
            $user["distance"] = $row['distance'];
            $user["flexible"] = $row['flexible'];
            $user["country"] = $row['country'];
            $user["role"] = $row['role'];
            $user["status"] = $row['status'];
            $user["verify"] = $row['verify'];
        }
       
        // success
        $response["success"] = 1;
        //$response["user"] = array();
        //array_push($response["user"], $user);
        $response["user"] = $user;
        echo json_encode($response);
    }else{
        // no user found
        $response["success"] = 0;
        $response["message"] = "No user found";
        // echo no users JSON
        echo json_encode($response);
    }   
}