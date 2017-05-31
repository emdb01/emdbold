<?php
include("config.php");
    if (isset($_POST['member_id'])) {        
        $fname = $_POST['fname']; //[fname] => karthik909004
        $mname = $_POST['mname']; //[mname] => 
        $lname = $_POST['lname']; //[lname] => 123456
        $email = $_POST['email']; //[email] => karthik909004@gmail.com
        $phone = $_POST['phone']; //[phone] => 9666247315
        $availability = $_POST['availability']; //[availability] => Looking For Change
        $notify = $_POST['notificdur']; //[notificdur] => 
        $typeofjob = $_POST['typeofjob']; //[typeofjob] => 
        $technologies = $_POST['technologies']; //[technologies] => 
        $country = "";
        if(isset($_POST['country'])){
            $country = $_POST['country'];
        }
        $zip = $_POST['zip']; //[zip] => 
        $zipdist = $_POST['zipdist']; //[zipdist] => 
        $flexible = $_POST['flexible'];//[flexible] => 
        $toSal = $_POST['toSal']; //[toSal] => 
        $fromSal = $_POST['fromSal']; //[fromSal] =>
        $salary = $fromSal.'-'.$toSal;        
        $mid = $_POST['member_id']; //[member_id] => 241460181007
        
        $sql = "SELECT * FROM `user` WHERE email='$email' and member_id !='$mid'";
        $query = $conn->query($sql);
        $checkexist_check = $query->num_rows;
        if($checkexist_check >= 1 ){            
            $response["mail_exist"] = 1;
            echo json_encode($response);
        }else{
            $sql = "SELECT * FROM `user` WHERE phone='$phone' and member_id !='$mid'";
            $query = $conn->query($sql);
            $checkexist_check = $query->num_rows;
            if($checkexist_check >= 1 ){
                $response["phone_exist"] = 1;
                echo json_encode($response);
            }else{
                $tm=time();            
                $userupdate= "UPDATE `user` SET `first` = '$fname', `middle` = '$mname', `last` = '$lname', `status_time` = '$tm',`notify_time` = '$notify', `email` = '$email', `phone` = '$phone', `availability` = '$availability', `job` = '$typeofjob', `technology` = '$technologies', `salary` = '$salary', `zip` = '$zip', `distance` = '$zipdist', `flexible` = '$flexible', `country` = '$country' WHERE `member_id`='$mid'"; 
                $result = $conn->query($userupdate);
                if($result){
                    // success
                    $response["success"] = 1;
                    echo json_encode($response);
                }else{
                    $response["success"] = 0;
                    echo json_encode($response);
                }
            }
        }
    }