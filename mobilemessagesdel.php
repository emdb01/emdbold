<?php
include("config/config.php");
$dataList = json_decode(file_get_contents("php://input"), true);
?>
<?php

// If the id is posted, delete that in the database.
if (isset($dataList['id'])) {
    $id = $dataList['id'];
    $query = "UPDATE `text_mails` SET  status='1'  WHERE id='$id' ";
    $result = mysql_query($query);
     echo json_encode(array(
               'response_code' => '200',
               'response_message' => 'Message Deleted Successfully'));
} 
?>

