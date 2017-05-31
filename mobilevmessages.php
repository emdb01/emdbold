<?php

include("config/config.php");
$dataList = json_decode(file_get_contents("php://input"), true);
$uid = $dataList['user_id'];
?>

<?php

$query_pag_data = "SELECT * from voice_mails where user_id='$uid' and status='0'  ORDER BY id DESC ";
$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
while ($res = mysql_fetch_array($result_pag_data)) {
    $recruiterId = $res['recruiterId'];
    $voice = $res['voice'];
    $createdDate = $res['createdDate'];
    $vid = $res['id'];
    $sqlQry = mysql_query("SELECT * FROM `recruiter` WHERE user_id='$recruiterId' ");
    $reqid = mysql_fetch_assoc($sqlQry);
    $recName = $reqid['first'];
    $vdetails = array('RecruiterName'=>$recName,'createdDate'=>$createdDate,'voicePath'=>$voice,'id'=>$vid);
    echo json_encode(array(
               'response_code' => '200',
               'response_message' => 'Success',
               'voices' => $vdetails));
}

?> 