<?php

include('header.php');
$tmavi = time();
$tmid = $_POST['tmid'];
if (isset($_POST['available'])) {
    date_default_timezone_set('Asia/Kolkata');
    $dateTime = date('Y-m-d H:i:s');
    $newavail = $_POST['available'];

    $updateavailability = "UPDATE `user` SET  `status_time` = '$tmavi',  `availability` = '$newavail',`todaystatus` = '1',laststatustime='$dateTime'  WHERE `member_id`='$tmid'";
    $updateavailability_result = mysql_query($updateavailability);

//$sendnotification=mailnote($tmid);
    $Selectdistinctuser = "SELECT DISTINCT user_id FROM `follow` WHERE member_id='$tmid'";
    $Selectdistinctuser_query = mysql_query($Selectdistinctuser);
    while ($Selectdistinctuser_query_fetch = mysql_fetch_array($Selectdistinctuser_query)) {

        $distuserid = $Selectdistinctuser_query_fetch['user_id'];
        $Selectdistinctuserrec = "SELECT * FROM `recruiter` WHERE user_id='$distuserid'";
        $Selectdistinctuserrec_query = mysql_query($Selectdistinctuserrec);
        $adminemail = 'support@employeemasterdatabase.com';
        $thename = "Employeemasterdatabase.com";
        $mesg = "The candidate (" . $fulname . ") with EMDB ID EMDB" . $mid . " has changed his status to" . $newavail;
        while ($Selectdistinctuserrec_query_fetch = mysql_fetch_array($Selectdistinctuserrec_query)) {

            $theemail = $Selectdistinctuserrec_query_fetch['email'];
            $thefirst = $Selectdistinctuserrec_query_fetch['first'];
            @$themiddle = $Selectdistinctuserrec_query_fetch['middle'];
            $thelast = $Selectdistinctuserrec_query_fetch['last'];
            if ($themiddle == "") {
                $rfulname = $thefirst . " " . $thelast;
            } else {
                $rfulname = $thefirst . " " . $themiddle . " " . $thelast;
            }


            sendmessagetouser($rfulname, $theemail, $mesg, $thename, $adminemail);
        }
    }
}
?>