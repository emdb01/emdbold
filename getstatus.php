<?php 
include('config/config.php');
if(isset($_GET['id'])){
$email=$_GET['id'];
$sql="select availability from user where email='$email' ";
 $result_pag_data = mysql_query($sql) or die('MySql Error' . mysql_error());
 $valid=mysql_num_rows($result_pag_data);
 if($valid !=0){
 $res = mysql_fetch_array($result_pag_data);
 echo $res['availability']; 
}else{
 echo "Not Valid";
}

}else{
$emdbId=$_GET['eid'];
$emdbId1 = str_replace('EMDB', '', $emdbId);
$sql="select availability from user where member_id='$emdbId1' ";
$result_pag_data = mysql_query($sql) or die('MySql Error' . mysql_error());
$res = mysql_fetch_array($result_pag_data);
echo $res['availability']; 
}
?>
