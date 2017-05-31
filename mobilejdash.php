<?php

include("config/config.php");
$dataList = json_decode(file_get_contents("php://input"), true);
$mid = $dataList['user_id'];
$resultReq = mysql_query("SELECT member_id,availability FROM `user` where user_Id='$mid'");
$dataresultReq = mysql_fetch_assoc($resultReq);
 $member_id = 'EMDB'.$dataresultReq['member_id'];
 $availability = $dataresultReq['availability'];

$result = mysql_query("SELECT count(*) as total FROM `voice_mails` where user_id='$mid' and status='0' ");
$data = mysql_fetch_assoc($result);
 $totalVoice = $data['total'];

$resultReq = mysql_query("SELECT count(*) as total FROM `text_mails` where user_Id='$mid' and status='0'");
$dataresultReqs = mysql_fetch_assoc($resultReq);
 $totalMsg = $dataresultReqs['total'];
 
 $details = array('member_id'=>$member_id,'availability'=>$availability,'total voice mails'=>$totalVoice,'total messages'=>$totalMsg);
     echo json_encode(array(
               'response_code' => '200',
               'response_message' => 'Success',
               'messages' => $details));
?>
