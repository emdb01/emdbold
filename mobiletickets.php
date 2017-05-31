<?php

include("config/config.php");
$dataList = json_decode(file_get_contents("php://input"), true);
$uid = $dataList['user_id'];
?>

<?php

$query_pag_data = "SELECT * from tickets where user_id='$uid'  ORDER BY id DESC ";
$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
while ($res = mysql_fetch_array($result_pag_data)) {
    $recruiterId = $res['recruiter_id'];
            $user_id = $res['user_id'];
            $id = $res['id'];
            $subject = $res['subject'];
            $createdDate = $res['createdDate'];
            if($recruiterId !=0){
              $sqlQry = mysql_query("SELECT * FROM `recruiter` WHERE user_id='$recruiterId' ");   
            }else if($user_id !=0){
             $sqlQry = mysql_query("SELECT * FROM `user` WHERE user_id='$user_id' ");    
            }
             $reqid = mysql_fetch_assoc($sqlQry);
            $from= $reqid['email'];
    $tickets = array('From'=>$from,'createdDate'=>$createdDate,'subject'=>$subject,'id'=>$id);
    echo json_encode(array(
               'response_code' => '200',
               'response_message' => 'Success',
               'tickets' => $tickets));
}

?> 