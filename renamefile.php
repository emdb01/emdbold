<?php
ob_start(); 
session_start();
error_reporting(0);
include("config/config.php");
$mid = $_SESSION['user_id'];
$totalfilepath=urldecode($_POST['data']);
$ext = pathinfo($totalfilepath, PATHINFO_EXTENSION);
$rename=urldecode($_POST['rename']);
if($ext){
$rext = pathinfo($rename, PATHINFO_EXTENSION);
if($rext){
	$rename;
}else{
	$rename=$rename.'.'.$ext;
}
$str = substr(strrchr($totalfilepath, '/'), 1);
$renamed=str_replace($str,$rename,$totalfilepath);
$sql="SELECT * FROM `removefiles` where recruiterId='$mid' and filepath='$totalfilepath'";
$mys = mysql_query($sql);
$num = mysql_num_rows($mys);
if($num >0){
 rename($totalfilepath,$renamed);
 $sql="UPDATE `removefiles` SET  `filepath`='$renamed'  WHERE recruiterId='$mid' and filepath='$totalfilepath' ";
 $mys = mysql_query($sql);
 $totalfilepath='./'.$totalfilepath;
 $renamed='./'.$renamed;
 $sql="UPDATE `recruit_users` SET  `filepath`='$renamed'  WHERE recruiterId='$mid' and filepath='$totalfilepath' ";
 $mys = mysql_query($sql);
}
}else{
 $str = substr(strrchr($totalfilepath, '/'), 1);
$renamed=str_replace($str,$rename,$totalfilepath);
$sql="SELECT * FROM `removefiles` where recruiterId='$mid' and filepath='$totalfilepath'";
$mys = mysql_query($sql);
$num = mysql_num_rows($mys);
if($num >0){
 rename($totalfilepath,$renamed);
 $sql="UPDATE `removefiles` SET  `filepath`='$renamed'  WHERE recruiterId='$mid' and filepath='$totalfilepath' ";
 $mys = mysql_query($sql);
 $totalfilepath='./'.$totalfilepath;
 $renamed='./'.$renamed;
 $sql="UPDATE `recruit_users` SET  `filepath`='$renamed'  WHERE recruiterId='$mid' and filepath LIKE '%$totalfilepath%' ";
 $mys = mysql_query($sql);
}
}
?>
