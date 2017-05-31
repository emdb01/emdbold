<?php
ob_start();
@session_start();
include("config/config.php");
?>
<?php
if ($_POST['email'] =='jain.nilesh_12@rediffmail.com' || $_POST['email'] =='jitendra2573@yahoo.in') {
  header("Location:index.php?err=5");
            die();   
}
if (isset($_POST['email'])) {
    date_default_timezone_set('Asia/Kolkata');
    $dateTime = date('Y-m-d H:i');
    $usr = $_POST['email'];
    $psd = $_POST['pass'];
    $psd1 = md5($psd);

    $usercheck = mysql_query("select * from `user` where `email` ='$usr' and `pass` ='$psd1' and `verify` ='1'");
    $checkexist_check = mysql_num_rows($usercheck);
    if ($checkexist_check == 1) {

        while ($sqlf1 = mysql_fetch_array($usercheck)) {
            $var = $sqlf1['first'];
            $var2 = $sqlf1['middle'];
            $var3 = $sqlf1['last'];
            $var4 = $sqlf1['member_id'];
            $var5 = $sqlf1['email'];
            $var6 = $sqlf1['role'];
            $var7 = $sqlf1['user_id'];
            $var8 = $sqlf1['visits'];
        }
        $row = mysql_num_rows($usercheck);
        if ($row == 1) {

            $_SESSION['first'] = $var;
            $_SESSION['middle'] = $var2;
            $_SESSION['last'] = $var3;
            $_SESSION['member_id'] = $var4;
            $_SESSION['email'] = $var5;
            $_SESSION['role'] = $var6;
            $_SESSION['user_id'] = $var7;
            if ($var6 == 1 || $var6 == 4) {
                header("Location:dashboard.php");
                $visits = $var8 + 1;
                $Up = mysql_query("UPDATE `user` SET visits='$visits',dateTime='$dateTime' WHERE `email`='$usr'");
                die();
            } else {

                $visits = $var8 + 1;
                $Up = mysql_query("UPDATE `user` SET visits='$visits',dateTime='$dateTime' WHERE `email`='$usr'");
                header("Location:dashboard.php");
                die();
            }
        }
    } else {


        $recruiterquery = mysql_query("select * from `recruiter` where `email` ='$usr' and `pass` ='$psd1' and `verify` ='1'");
        $recruiterquery_check = mysql_num_rows($recruiterquery);
        if ($recruiterquery_check == 1) {
            while ($recruiterquery_fetch = mysql_fetch_array($recruiterquery)) {
                $var = $recruiterquery_fetch['first'];
                $var2 = $recruiterquery_fetch['middle'];
                $var3 = $recruiterquery_fetch['last'];
                $var4 = $recruiterquery_fetch['user_id'];
                $var5 = $recruiterquery_fetch['email'];
                $var6 = $recruiterquery_fetch['role'];
                $var7 = $recruiterquery_fetch['visits'];
                $company = $recruiterquery_fetch['company'];
            }
            $rowcount = mysql_num_rows($recruiterquery);
            if ($rowcount == 1) {

                $_SESSION['first'] = $var;
                $_SESSION['middle'] = $var2;
                $_SESSION['last'] = $var3;
                $_SESSION['user_id'] = $var4;
                $_SESSION['email'] = $var5;
                $_SESSION['role'] = $var6;
                $_SESSION['company'] = $company;
                $visits = $var7 + 1;
                $Upd = mysql_query("UPDATE `recruiter` SET visits='$visits',dateTime='$dateTime' WHERE `email`='$usr'");
                header("Location:documentation.php?dir=".$_SESSION['user_id']);
                die();
            } else {


                header("Location:index.php?err=2");
                die();
            }
        } else {

            header("Location:index.php?err=3");
            die();
        }
    }
} else {

    header("Location:index.php?err=4");
    die();
}
?>
		