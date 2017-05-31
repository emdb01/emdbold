<?php
include('header.php');
?>
<h2 class="inner_abh"><center>Job Seeker Verification</center></h2>
<div class="content">

<?php
if (isset($_GET['vid'])) {
    date_default_timezone_set('Asia/Kolkata');
    $dateTime = date('Y-m-d H:i');
    $tm = $_GET['tm'];
    $vid = $_GET['vid'];
    $veri = 1;
    $checkexist = "SELECT * FROM `user` WHERE member_id='$tm' and verify='2'";
    $checkexist_query = mysql_query($checkexist);
    $checkexist_check = mysql_num_rows($checkexist_query);
    if ($checkexist_check == 1) {
        
        while ($checkexist_query_fetch = mysql_fetch_array($checkexist_query)) {
            $var8 = $checkexist_query_fetch['visits'];
            $email = $checkexist_query_fetch['email'];
            $chemail = md5($email);
            if ($chemail == $vid) {
                $veri = 2;
                $visits = $var8 + 1;
                $userupdate = "UPDATE `user` SET `verify`='1', `status`='1',visits='$visits',dateTime='$dateTime' WHERE `member_id`='$tm'";
                $userupdate_result = mysql_query($userupdate);

                $fname = $checkexist_query_fetch['first'];
                $lname = $checkexist_query_fetch['middle'];
                @$mname = $checkexist_query_fetch['last'];
                $var4 = $checkexist_query_fetch['member_id'];
                $var5 = $checkexist_query_fetch['email'];
                $var6 = $checkexist_query_fetch['role'];
                $var7 = $checkexist_query_fetch['user_id'];
                
                $_SESSION['first'] = $fname;
                @$_SESSION['middle'] = $mname;
                $_SESSION['last'] = $lname;
                $_SESSION['member_id'] = $var4;
                $_SESSION['email'] = $var5;
                $_SESSION['role'] = $var6;
                 $_SESSION['user_id'] = $var7;
                if ($mname == "") {
                    $fulname = $fname . " " . $lname;
                } else {
                    $fulname = $fname . " " . $mname . " " . $lname;
                }
                header("Location:status.php");
                die();
            }
        }
 }else{
    echo '<center><p class="notify_red">The verification link is not valid. It might have expired or not valid.</p></center>';
    echo '<center><p class="notify_red"><a href="https://www.employeemasterdatabase.com/"> Please Login </a></p></center>';
 }
        }
?>
</div><!-- End of content -->
