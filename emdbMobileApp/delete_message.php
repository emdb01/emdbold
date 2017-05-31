<?php
include("config.php");
if(isset($_POST['messageID'])){
    $messageID = $_POST['messageID'];
    $sql = "UPDATE `text_mails` SET  status='1' where `id` ='$messageID'";
    $result = $conn->query($sql);    
    if($result){   
        // success
        $response["success"] = 1;
        echo json_encode($response);
    }else{
        // no messages found
        $response["success"] = 0;
        $response["message"] = "Message Not Found";
        echo json_encode($response);
    }   
}