<?php 
session_start();
include("config.php");

if(isset($_POST['email'])){
    $usr=$_POST['email'];
    $psd=$_POST['pass'];
    $psd1=md5($psd);
	
    $sql = "select * from `user` where `email` ='$usr' and `pass` ='$psd1' and `verify` ='1'";
    $result = $conn->query($sql);
    $checkexist_check = $result->num_rows;
        
    if($checkexist_check == 1 ){
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $user_id = $row['user_id'];
            $first = $row['first'];
            $middle = $row['middle'];
            $last = $row['last'];
            $member_id = $row['member_id'];
            $email = $row['email'];
            $availability = $row['availability'];
            $role = $row['role'];
        }
        $_SESSION['user_id']=$user_id;
        $_SESSION['first']=$first;
        $_SESSION['middle']=$middle;
        $_SESSION['last']=$last;
        $_SESSION['member_id']=$member_id;
        $_SESSION['email']=$email;
        $_SESSION['availability']=$availability;
        $_SESSION['role']=$role;
        
        $response["success"] = 1;
        //$response["user"] = array();
        //array_push($response["user"], $_SESSION);
        $response["user"] = $_SESSION;
        echo json_encode($response);
            
    }/*else{
        $sql2 = "select * from `recruiter` where `email` ='$usr' and `pass` ='$psd1' and `verify` ='1'";
        $result2 = $conn->query($sql2);
        $checkexist_check2 = $result->num_rows;
        if($checkexist_check2 == 1 ){
            // output data of each row
            while($row = $result2->fetch_assoc()) {
                $first = $row['first'];
                $middle = $row['middle'];
                $last = $row['last'];
                $member_id = $row['member_id'];
                $email = $row['email'];
                $role = $row['role'];
            }
            $_SESSION['first']=$first;
            $_SESSION['middle']=$middle;
            $_SESSION['last']=$last;
            $_SESSION['member_id']=$member_id;
            $_SESSION['email']=$email;
            $_SESSION['role']=$role;
            
            $response["success"] = 1;
            //$response["user"] = array();
            //array_push($response["user"], $_SESSION);
            $response["user"] = $_SESSION;
            echo json_encode($response);
            
        }else{
            // no user found
            $response["success"] = 0;
            $response["message"] = "No user found";
            // echo no users JSON
            echo json_encode($response);
        }
    }*/else{
        // no user found
        $response["success"] = 0;
        $response["message"] = "No user found";
        // echo no users JSON
        echo json_encode($response);
    }   
}
$conn->close();
?>
		