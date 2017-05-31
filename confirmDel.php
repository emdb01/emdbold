<?php

$valid_files = array();
ob_start();
error_reporting(0);
session_start();
include("config/config.php");
$mid = $_SESSION['user_id'];
$sql = "SELECT * FROM `removefiles` where recruiterId='$mid' and status=0";
$mys = mysql_query($sql);
$num = mysql_num_rows($mys);
if ($num > 0) {
    $topath = './filesback/' . $mid;
    while ($row = mysql_fetch_assoc($mys)) {
        $fp[] = "./" . $row['filepath'];
        if (!is_dir($topath)) {
            @mkdir($topath, 0777, true);
        }
    }
    foreach ($fp as $filepaths) {

        $rootPath = $filepaths;
        $ext = pathinfo($rootPath, PATHINFO_EXTENSION);
        if (!$ext) {
            $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {

                $file = rtrim($file, ".");
                array_push($valid_files, $file);
            }
        } else {

            array_push($valid_files, $rootPath);
        }
    }

    foreach ($valid_files as $file) {

        if (is_file($file)) {

            $file = str_replace("\\", "/", $file);
            echo $delsql = "DELETE FROM `recruit_users` WHERE  recruiterId='$mid' and filepath = '$file'";
            echo "<br>";
            mysql_query($delsql);
            unlink($file);
        } else {

            rmdir($file);
        }
    }
    foreach ($valid_files as $file) {
        if (is_file($file)) {
            
        } else {
            rmdir($file);
        }
    }

//    $fp = $row['filepath'];
//    $del = "DELETE FROM `removefiles` WHERE recruiterId='$mid' and filepath='$fp' ";
//    $fd = mysql_query($del);
}
?>