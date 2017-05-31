<?php

error_reporting(0);
include('header.php');
if (!isset($_SESSION['first'])) {
    header("Location:index.php");
    die();
}
?>
<?php

// If the id is posted, delete that in the database.
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "UPDATE `voice_mails` SET  status='1'  WHERE id='$id' ";
    $result = mysql_query($query);
    if ($_SESSION['role'] == 3) {
        header("Location: vmails.php");
    } else if ($_SESSION['role'] == 2) {
        header("Location: vmessages.php");
    }
} else if (isset($_GET['useid'])) {
    $uid = $_GET['useid'];
    $vmid = $_GET['vmid'];
    $query = "UPDATE `voicemail_users` SET  status='1'  WHERE id='$vmid' and user_id='$uid' ";
    $result = mysql_query($query);
      header("Location: vmails.php");
} else if (isset($_REQUEST['mid'])) {
    $rid = $_REQUEST['mid'];
    $voicid = $_REQUEST['voicid'];
    $query = "UPDATE `voice_mails` SET  status='1'  WHERE id='$voicid' and recruiterId='$rid' ";
    $result = mysql_query($query);
}
?>

