<?php
ob_start(); 
session_start();
error_reporting(0);
include("config/config.php");
$mid = $_SESSION['user_id'];
$filepath=urldecode($_POST['data']);
$sql="SELECT * FROM `removefiles` where recruiterId='$mid' and filepath='$filepath'";
$mys = mysql_query($sql);
$num = mysql_num_rows($mys);
$row=mysql_fetch_assoc($mys);


if($num ==0){
 $sql1="INSERT INTO `removefiles`(`recruiterId`, `filepath`, `status`) VALUES ('$mid','$filepath',0)";
$mys1 = mysql_query($sql1);	
}else{
if($row['status'] == 0){
		$sql1="UPDATE `removefiles` SET  `status`=1  WHERE recruiterId='$mid' and filepath='$filepath' ";
$mys1 = mysql_query($sql1);
}else if($row['status'] == 1){
		$sql1="UPDATE `removefiles` SET  `status`=0  WHERE recruiterId='$mid' and filepath='$filepath' ";
$mys1 = mysql_query($sql1);
}
}
$sqlq="SELECT * FROM `removefiles` where recruiterId='$mid' and status=0";
$mysq= mysql_query($sqlq);
$numq = mysql_num_rows($mysq);
if($numq ==1){
	$rows=mysql_fetch_assoc($mysq);
	echo $numq=$rows['filepath'];
}else if($numq >0){
	echo $numq;
}else{
echo $numq;	
}
  // $_SESSION['data']['0']=array($_POST['data']);
 // array_push($_SESSION['data'],$_POST['data']);
 // // print_r(array_unique($_SESSION['data']));
  // foreach ($_SESSION['data'] as $name){
	// //  echo $name ;
	
	 // $name = strstr($name, $_POST['data']);  
	// // unset($name);
	// // echo $name;
  // }


?>