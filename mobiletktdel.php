<?php

include("config/config.php");
$dataList = json_decode(file_get_contents("php://input"), true);
$uid = $dataList['id'];
?>

<?php

// If the id is posted, delete that in the database.
if (isset($dataList['id'])) {
    $id=$dataList['id'];
    $query = "DELETE FROM `tickets` WHERE id='$uid' ";
    $result = mysql_query($query);
    echo json_encode(array(
               'response_code' => '200',
               'response_message' => 'Deleted Successfully'));
      
}
?>

