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
    while ($row = mysql_fetch_assoc($mys)) {
         $files[] = $row['filepath'];
    }

    foreach ($files as $path) {
        $rootPath = $path;
        $ext = pathinfo($rootPath, PATHINFO_EXTENSION);
        if (!$ext) {
            $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {

                array_push($valid_files, $file);
            }
        } else {
            array_push($valid_files, $rootPath);
        }
    }

    $zip = new ZipArchive();
    $destination = "resumes.zip";
    $overwrite = false;
    $response = $zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE);
    if ($response == 1) {
        foreach ($valid_files as $file) {
            if (is_file($file)) {

                $zip->addFile($file, $file);
            }
        }

        $zip->close();
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=resumes.zip");
        header("Content-length: " . filesize('resumes.zip'));
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile("resumes.zip");
        unlink('resumes.zip');
    }
}
?>