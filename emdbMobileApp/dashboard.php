<?php
include("config.php");
if(isset($_POST['userID'])){
    $mid = $_POST['userID'];
    //$mid = 173;
    $sql = "SELECT count(*) as total FROM `voice_mails` where user_id='$mid' and status='2'";
    $result = $conn->query($sql);    
    if($result){        
        $data=array(); 
        while($row = $result->fetch_assoc()) {            
            $data["voicemails_count"] = $row['total'];
        }
        $sql2 = "SELECT count(*) as total FROM `text_mails` where user_Id='$mid' and status='0'";
        $result2 = $conn->query($sql2);
        if($result2){
            while($row2 = $result2->fetch_assoc()) {                
                $data["messages_count"] = $row2['total'];
            }
        }
        $sql3 = "SELECT * FROM `user` WHERE user_id='$mid'";
        $result3 = $conn->query($sql3);
        if($result3){
            while($row3 = $result3->fetch_assoc()) {                
                $data["availability"] = $row3['availability'];
            }
        }
        // success
        $response["success"] = 1;
        $response["dashboard"] = $data;
        echo json_encode($response);
    }else{        
        $response["success"] = 0;
        $response["message"] = "No user found";
        echo json_encode($response);
    }   
}