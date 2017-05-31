<?php

error_reporting(0);
include('config/config.php');
//$mid = $_POST['data'];
$mid = 34;
//$result = mysql_query("SELECT count(*) as total FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid')");
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
$status = mysql_query("SELECT u.email FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$mid' and u.todaystatus='1' and u.modifiedDate = '%$createdDate%' ");
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

