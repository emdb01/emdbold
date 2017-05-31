<?php

ob_start();
error_reporting(0);
session_start();
include("config/config.php");
$mid = $_SESSION['user_id'];
$topath = $_POST['data'];
$mainfolder = $_POST['mainfolder'];
$subfolder = $_POST['subfolder'];
if (isset($topath)) {
    if (isset($mainfolder)) {
        $topath = $mainfolder;
    }

    $sql = "SELECT * FROM `removefiles` where recruiterId='$mid' and status=0";
    $mys = mysql_query($sql);
    $num = mysql_num_rows($mys);
    if ($num > 0) {
        while ($row = mysql_fetch_assoc($mys)) {
            $from = "./" . $row['filepath'];
            $ext = pathinfo($from, PATHINFO_EXTENSION);
            if ($ext) {
                $finalfilnam = explode("/", $from);
                $justfinalfile = end($finalfilnam);
                $topa = $topath . "/" . $justfinalfile;
                $to = str_replace("\\", "/", $topa);
                if (copy($from, $to)) {
                    echo "files moved success";
                    $sql1 = "UPDATE `recruit_users` SET  `filepath`='$to'  WHERE recruiterId='$mid' and filepath='$from'";
                    $mys1 = mysql_query($sql1);
                    unlink($from);
                }
            } else {

                $finalfilnam = explode("/", $from);
                $justfinalfile = end($finalfilnam);

                $topa = $topath . "/" . $justfinalfile;

                $to = str_replace("\\", "/", $topa);

                function rcopy($src, $dst) {
                    if (file_exists($dst))
                        rrmdir($src);
                    if (is_dir($src)) {

                        mkdir($dst);
                        $files = scandir($src);
                        foreach ($files as $file)
                            if ($file != "." && $file != "..")
                                rcopy("$src/$file", "$dst/$file");
                    } else if (file_exists($src)) {
                        copy($src, $dst);
                    }
                    $sqlr = "SELECT * FROM `recruit_users` where recruiterId='$mid' and filepath LIKE '%$src%'";
                    $mysr = mysql_query($sqlr);
                    while ($row = mysql_fetch_assoc($mysr)) {
                        $frompath = $row['filepath'];
                        $top = str_replace($src, $dst, $frompath);
                        $sql1 = "UPDATE `recruit_users` SET  `filepath`='$top'  WHERE recruiterId='$mid' and filepath LIKE '%$src%'";
                        $mys1 = mysql_query($sql1);
                    }
                }

                function recursiveRemoveDirectory($directory) {
                    foreach (glob("{$directory}/*") as $file) {
                        if (is_dir($file)) {
                            recursiveRemoveDirectory($file);
                        } else {
                            unlink($file);
                        }
                    }
                    rmdir($directory);
                }

                rcopy($from, $to);
                recursiveRemoveDirectory($from);
            }
        }
    }
} else {
    if ($mainfolder != '' && $subfolder != '') {
        $findme1 = "./" . $mid;
        $pos = strpos($mainfolder, $findme1);
        if ($pos !== false) {
            $newfol = str_replace("\\", "/", $mainfolder);
        } else {
            $theroot = "./" . $mid . "/";
            $newfol = $theroot . $mainfolder;
            if (!is_dir($newfol)) {
                @mkdir($newfol, 0777, true);
            }
        }


        $subfol = $newfol . '/' . $subfolder;
        if (!is_dir($subfol)) {
            @mkdir($subfol, 0777, true);
        }
        $topath = $subfol;
        $sql = "SELECT * FROM `removefiles` where recruiterId='$mid' and status=0";
        $mys = mysql_query($sql);
        $num = mysql_num_rows($mys);
        if ($num > 0) {
            while ($row = mysql_fetch_assoc($mys)) {
                $from = "./" . $row['filepath'];
                $ext = pathinfo($from, PATHINFO_EXTENSION);
                if ($ext) {
                    $finalfilnam = explode("/", $from);
                    $justfinalfile = end($finalfilnam);
                    $topa = $topath . "/" . $justfinalfile;
                    $to = str_replace("\\", "/", $topa);
                    if (copy($from, $to)) {
                        echo "files moved success";
                        $sql1 = "UPDATE `recruit_users` SET  `filepath`='$to'  WHERE recruiterId='$mid' and filepath='$from'";
                        $mys1 = mysql_query($sql1);
                        unlink($from);
                    }
                } else {

                    $finalfilnam = explode("/", $from);
                    $justfinalfile = end($finalfilnam);

                    $topa = $topath . "/" . $justfinalfile;

                    $to = str_replace("\\", "/", $topa);

                    function rcopy($src, $dst) {
                        if (file_exists($dst))
                            rrmdir($src);
                        if (is_dir($src)) {

                            mkdir($dst);
                            $files = scandir($src);
                            foreach ($files as $file)
                                if ($file != "." && $file != "..")
                                    rcopy("$src/$file", "$dst/$file");
                        } else if (file_exists($src)) {
                            copy($src, $dst);
                        }
                        $sqlr = "SELECT * FROM `recruit_users` where recruiterId='$mid' and filepath LIKE '%$src%'";
                        $mysr = mysql_query($sqlr);
                        while ($row = mysql_fetch_assoc($mysr)) {
                            $frompath = $row['filepath'];
                            $top = str_replace($src, $dst, $frompath);
                            $sql1 = "UPDATE `recruit_users` SET  `filepath`='$top'  WHERE recruiterId='$mid' and filepath LIKE '%$src%'";
                            $mys1 = mysql_query($sql1);
                        }
                    }

                    function recursiveRemoveDirectory($directory) {
                        foreach (glob("{$directory}/*") as $file) {
                            if (is_dir($file)) {
                                recursiveRemoveDirectory($file);
                            } else {
                                unlink($file);
                            }
                        }
                        rmdir($directory);
                    }

                    rcopy($from, $to);
                    recursiveRemoveDirectory($from);
                }
            }
        }
    }
}
?>