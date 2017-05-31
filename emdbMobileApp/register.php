<?php
include("config.php");
    if (isset($_POST['fname'])) {
        $fname=$_POST['fname'];
        $mname=$_POST['mname'];
        $lname=$_POST['lname'];
        
        if($mname==""){
            $fulname=$fname." ".$lname;
        } else {
            $fulname=$fname." ".$mname." ".$lname;
        }
        $email = $_POST['email'];
        $vid = md5($email);
        $phone = $_POST['phone'];
        $availability = "Available";
        $pass = $_POST['pass'];
        $pass = md5($pass);
        $country = $_POST['country'];
        
        $sql = "select count(*)  as total from `recruiter`, `user` where recruiter.email='$email' OR user.email='$email' OR user.phone='$phone' OR recruiter.phone='$phone'";
        $result = $conn->query($sql);
        $data = mysqli_fetch_assoc($result);
        $checkexist_check=$data['total'];
        
                
        if($checkexist_check >= 1 ){
            $response["success"] = 0;
            echo json_encode($response);
        }else{
            $tm=time();
            $tempid=mt_rand (10,99);
            $mid=$tempid.$tm;
            $mid= ifidavail($mid);
            //$adduser= "INSERT INTO `user` VALUES ('','$fname','$mname','$lname','$mid','$tm','','$email','$pass','$phone','$availability','','','','','','','','$country','2','2','2')";
            $adduser = "INSERT INTO user (first,middle,last,member_id,status_time,email,pass,phone,availability,country,role,status,verify) VALUES('$fname','$mname','$lname','$mid','$tm','$email','$pass','$phone','$availability','$country','2','2','2')";
            $result2=$conn->query($adduser);
            if($result2){
                $formactive=1;
                $link='http://employeemasterdatabase.com/verify.php?vid='.$vid.'&tm='.$mid;
                $msg="Please click on the below link to activate your account";
                $resu=mailfun($fulname,$email,$msg,$link);
                $response["success"] = 1;
                $response["sentmail"] = $resu;
                echo json_encode($response);
            }else{
                $response["success"] = 2;
                echo json_encode($response);
            }            
        }        
    }
    
    
    