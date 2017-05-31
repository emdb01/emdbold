<?php

//error_reporting(E_ALL);
include('config/config.php');
//$mid = 34;
$mid =  $_POST['data'];
//$result = mysql_query("SELECT user_id  FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid')");
$result = mysql_query("SELECT u.email FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$mid'");
$myl = mysql_num_rows($result);

$resultReq = mysql_query("SELECT count(*) as total FROM `requirement` where recruiterId='$mid'");
$dataresultReq = mysql_fetch_assoc($resultReq);
if ($dataresultReq['total'] != '') {
    $rqs = $dataresultReq['total'];
} else {
    $rqs = 0;
}
$createdDate = date("Y-m-d");
//$status = mysql_query("SELECT user_id FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid') and todaystatus='1' and modifiedDate LIKE '%$createdDate%' ");
$status = mysql_query("SELECT u.email FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$mid' and u.todaystatus='1' and u.modifiedDate LIKE '%$createdDate%' ");
$avaup = mysql_num_rows($status);


 $follow = mysql_query("SELECT count(*) as total FROM `follow` where user_id ='$mid'");
                    $followdata = mysql_fetch_assoc($follow);
 if ($followdata['total'] != '') {
                                            $fco= $followdata['total'];
                                        } else {
                                            $fco=0;
                                        }
                                        

echo $datadash = $myl . ',' . $rqs . ',' . $avaup.','.$fco;
?>

