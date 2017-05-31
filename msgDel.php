<?php

error_reporting(0);
include('header.php');
if (!isset($_SESSION['first'])) {
    header("Location:index.php");
    die();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "UPDATE `text_mails` SET  status='1'  WHERE id='$id' ";
    $result = mysql_query($query);
    if ($_SESSION['role'] == 3) {
        header("Location: rmessages.php");
    } else if ($_SESSION['role'] == 2) {
        header("Location: messages.php");
    }
}else{
   $id = $_GET['uid'];
    $query = "UPDATE `textmail_users` SET  status='1'  WHERE id='$id' ";
    $result = mysql_query($query);
    if ($_SESSION['role'] == 3) {
        header("Location: rmessages.php");
    } else if ($_SESSION['role'] == 2) {
        header("Location: messages.php");
    }  
}
?>

