<?php
include("config.php");
if(isset($_POST['userID'])){
    $uID = $_POST['userID'];
    //$uID = 173;
    $sql = "select * from `voice_mails` where `user_id` ='$uID' and status='2' ORDER BY id DESC";
    $result = $conn->query($sql);
    $checkexist_check = $result->num_rows;
    if($checkexist_check > 0 ){        
        $response['voicemails']=array(); 
        while($row = $result->fetch_assoc()) {
            $message["id"] = $row['id'];
            $message["recruiter_Id"] = $row['recruiterId'];
            $recruiter_Id = $row['recruiterId'];
            $message["user_id"] = $row['user_id'];
            $message["voice"] = $row['voice'];
            $message["createdDate"] = $row['createdDate'];
            $message["status"] = $row['status'];
            
            $sqlQry = "SELECT * FROM `recruiter` WHERE user_id='$recruiter_Id'";
            $result2 = $conn->query($sqlQry);
            $row2 = $result2->fetch_assoc();
            $message["recruiter_name"] = $row2['first'];
            
            array_push($response['voicemails'], $message);
        }       
        // success
        $response["success"] = 1;
        echo json_encode($response);
    }else{
        // no messages found
        $response["success"] = 0;
        $response["message"] = "No Voicemails found";
        echo json_encode($response);
    }   
}