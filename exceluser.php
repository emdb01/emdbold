<?php

ob_start();
include('config/config.php');
$stringuser = $_GET['exid'];
$outstr = NULL;
$outstr = 'First Name' . "\t" . 'Middle Name' . "\t" . 'Last Name' . "\t" . 'Email' . "\t" . "\n";

$bigstring = $stringuser;
$arayofuser = explode(",", $bigstring);
$numb = count($arayofuser);
while ($numb != 0) {
    $val = $numb - 1;
    $userid = $arayofuser[$val];
    $listdetails = "SELECT * FROM `user` where user_id=$userid ";
    $listdetails_query = mysql_query($listdetails);
    while ($listdetails_query_fetch = mysql_fetch_array($listdetails_query)) {
        $fname1 = $listdetails_query_fetch['first'];
        $mname1 = $listdetails_query_fetch['middle'];
        $lname1 = $listdetails_query_fetch['last'];
        $email = $listdetails_query_fetch['email'];
        $availability = $listdetails_query_fetch['availability'];
        $id = $listdetails_query_fetch['user_id'];
        $memid = $listdetails_query_fetch['member_id'];
    }
    $emdb = "EMDB" . $memid;

    $numb = $numb - 1;
    $outstr = $outstr . $fname1 . "\t" . $mname1 . "\t" . $lname1 . "\t" . $email . "\t" . "\n";
}
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=User_list.xls");
echo $outstr;

