<div class="col-lg-12" style="padding-left: 0px;
    padding-right: 0px;
    margin: 10px 0px;">
<?php

$folder = $_GET['foldername'];
$mainfolder = $folder . "/";
?>
<select class="form-control" name="subfolder2" id="subfolder">
    <option value="">Select a Sub Folder else leave as it is</option>
<?php

function listFolderFiles($dir) {

    foreach (new DirectoryIterator($dir) as $fileInfo) {
        if (!$fileInfo->isDot()) {
            global $mainfolder;
            if ($fileInfo->isDir()) {
                $dirnam = $fileInfo->getPathname();
                $dirnamlist = str_replace($mainfolder, "", $dirnam);
                echo "<option value=\"$dirnam\">$dirnamlist</option>";

                //listFolderFiles($fileInfo->getPathname());
            }
        }
    }
}

listFolderFiles("$folder");

exit;
?></div>