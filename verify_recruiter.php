<?php
include('header.php');
?>
<h2 class="inner_abh"><center>Recruiter Verification</center></h2>
<div class="content">

<?php
if (isset($_GET['vid'])) {
    date_default_timezone_set('Asia/Kolkata');
    $dateTime = date('Y-m-d H:i');
    $tm = $_GET['tm'];
    $vid = $_GET['vid'];
    $veri = 1;
    $checkexist = "SELECT * FROM `recruiter` WHERE status_time='$tm' and verify='2'";
    $checkexist_query = mysql_query($checkexist);
    $checkexist_check = mysql_num_rows($checkexist_query);
    if ($checkexist_check >= 1) {
        while ($checkexist_query_fetch = mysql_fetch_array($checkexist_query)) {
            $var8 = $checkexist_query_fetch['visits'];
            $email = $checkexist_query_fetch['email'];
            $uid = $checkexist_query_fetch['user_id'];
            $chemail = md5($email);
            if ($chemail == $vid) {
                $veri = 2;
                $visits = $var8 + 1;
                $userupdate = "UPDATE `recruiter` SET `verify`='1', `status`='1'  WHERE `status_time`='$tm' and `user_id`='$uid'";
                $userupdate_result = mysql_query($userupdate);

                $fname = $checkexist_query_fetch['first'];
                $lname = $checkexist_query_fetch['middle'];
                @$mname = $checkexist_query_fetch['last'];
                if ($mname == "") {
                    $fulname = $fname . " " . $lname;
                } else {
                    $fulname = $fname . " " . $mname . " " . $lname;
                }
            }
        }

        if ($veri == 2) {
            ?>
                <p class="notify_green">Welcome, <?php echo $fulname; ?></p>
                <p class="notify_text"> Congratulations! Your recruiter profile has been created and you are now part of global employee master database. Please click continues to enjoy benefits of employeemasterdatabase.com.</p>
                <p class="notify_text">Click here to <a href="index.php">Please continue to login>></a></p>

            <?php
            recruiterafterverify($fulname, $email);
        } else {
            ?>
                <p class="notify_red">The verification link is not valid. It might have expired or not valid.</p>


                <?php
            }
        } else {
            ?>
            <p class="notify_red">The verification link is not valid. It might have expired or not valid.</p>


            <?php
        }
    } else {
        ?>
        <p class="notify_red">The verification link is not valid. It might have expired or not valid.</p>


        <?php
    }
    ?>
</div><!-- End of content -->


    <?php
    include('footer.php');
    ?>