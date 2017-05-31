<?php

ob_start();
error_reporting(0);
include('config/config.php');

$fromDate = explode("/", $_POST['nameSearch']);
$source = $fromDate[2] . '-' . $fromDate[0] . '-' . $fromDate[1];
$toDate = explode("/", $_POST['refineSearch']);
$destination = $toDate[2] . '-' . $toDate[0] . '-' . $toDate[1];

if ($_REQUEST['idocheck'] != '') {
    $idocheck = 1;
} else {
    $idocheck = 0;
}
$q = $_REQUEST['q'];
$outstr = NULL;
$outstr = 'First Name' . "\t" . 'Middle Name' . "\t" . 'Last Name' . "\t" . 'Email' . "\t" . 'Availability Status' . "\t" . 'EMDB ID' . "\t" . "\n";

foreach ($_POST['check_list'] as $userid) {
    $listcount = mysql_num_rows(mysql_query("SELECT * FROM `user`  where user_id=$userid and role=2 and verify=1 and status=1"));
    if ($listcount > 0) {
        if ($q == 'No Status') {
            $listdetails = "SELECT DISTINCT first,middle,last,email,user_id,availability,member_id  FROM `user` where user_id=$userid and (availability='$q' OR availability='') and role=2 and verify=1 and status=1 and idolize=$idocheck and createdDate between '$source' and '$destination'";
        } else {
            $listdetails = "SELECT DISTINCT first,middle,last,email,user_id,availability,member_id  FROM `user` where user_id=$userid and availability='$q' and role=2 and verify=1 and status=1 and idolize=$idocheck and createdDate between '$source' and '$destination'";
        }
        $listdetails_query = mysql_query($listdetails);
        while ($listdetails_query_fetch = mysql_fetch_assoc($listdetails_query)) {
            $fname1 = $listdetails_query_fetch['first'];
            $mname1 = $listdetails_query_fetch['middle'];
            $lname1 = $listdetails_query_fetch['last'];
            $email = $listdetails_query_fetch['email'];
            $availability = $listdetails_query_fetch['availability'];
            $id = $listdetails_query_fetch['user_id'];
            $memid = $listdetails_query_fetch['member_id'];
        }
        $emdb = "EMDB" . $memid;
        if (isset($memid)) {
            $outstr = $outstr . $fname1 . "\t" . $mname1 . "\t" . $lname1 . "\t" . $email . "\t" . $availability . "\t" . $emdb . "\t" . "\n";
        }
    }
}
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=User_list.xls");
echo $outstr;

