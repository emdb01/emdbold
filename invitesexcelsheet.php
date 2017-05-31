<?php

error_reporting(0);
ob_start();
include('config/config.php');
if (isset($_POST['exportall'])) {
    foreach ($_POST['check_list'] as $selected) {
        if ($stringuser != "") {

            $stringuser = $stringuser . ',' . $selected;
        } else {
            $stringuser = $selected;
        }
    }
}

$outstr = NULL;
$outstr = 'Email' . "\n";

$bigstring = $stringuser;
$arayofuser = explode(",", $bigstring);
$numb = count($arayofuser);
while ($numb != 0) {
    $val = $numb - 1;
    $userid = $arayofuser[$val];
    $listdetails = "SELECT * FROM `invites` where id=$userid ";
    $listdetails_query = mysql_query($listdetails);
    while ($listdetails_query_fetch = mysql_fetch_array($listdetails_query)) {
        $email = $listdetails_query_fetch['email'];
    }
    $emdb = "EMDB" . $memid;

    $numb = $numb - 1;
    $outstr = $outstr . $email . "\n";
}
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=User_list.xls");
echo $outstr;

