<?php
include('header.php');
if (isset($_GET['vid'])) {
    $vid = $_GET['vid'];
    $checkexist = "SELECT * FROM `recruiter` WHERE user_id='$vid'";
    $checkexist_query = mysql_query($checkexist);
    $checkexist_check = mysql_num_rows($checkexist_query);
    if ($checkexist_check >= 1) {
         $recruiterquery_fetch = mysql_fetch_assoc($checkexist_query);
                $var = $recruiterquery_fetch['first'];
                $var2 = $recruiterquery_fetch['middle'];
                $var3 = $recruiterquery_fetch['last'];
                $var4 = $recruiterquery_fetch['user_id'];
                $var5 = $recruiterquery_fetch['email'];
                $var6 = $recruiterquery_fetch['role'];
                $_SESSION['first'] = $var;
                $_SESSION['middle'] = $var2;
                $_SESSION['last'] = $var3;
                $_SESSION['user_id'] = $var4;
                $_SESSION['email'] = $var5;
                $_SESSION['role'] = $var6;
                header("Location:dashboard.php");
                die();
           
    }
    }
    ?>


