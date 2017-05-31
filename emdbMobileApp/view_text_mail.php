<?php
include("config.php");
if(isset($_POST['messageID'])){
    $messageID = $_POST['messageID'];
    $sql = "select * from `text_mails` where `id` ='$messageID'";
    $result = $conn->query($sql);
    $checkexist_check = $result->num_rows;
    if($checkexist_check == 1 ){        
        $message=[]; 
        while($row = $result->fetch_assoc()) {
            $message["id"] = $row['id'];
            $message["user_Id"] = $row['user_Id'];
            $message["recruiter_Id"] = $row['recruiter_Id'];
            $recruiter_Id = $row['recruiter_Id'];
            $message["subject"] = $row['subject'];
            $message["message"] = $row['message'];
            $message["createdDate"] = $row['createdDate'];
            $message["status"] = $row['status'];
            
            $sqlQry = "SELECT * FROM `recruiter` WHERE user_id='$recruiter_Id'";
            $result2 = $conn->query($sqlQry);
            $row2 = $result2->fetch_assoc();
            $message["recruiter_name"] = $row2['first'];
        }       
        // success
        $response["success"] = 1;
        $response["message"] = $message;
        echo json_encode($response);
    }else{
        // no messages found
        $response["success"] = 0;
        $response["message"] = "Message Not Found";
        echo json_encode($response);
    }   
}