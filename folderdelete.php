<div class="col-lg-12" style="float: left;
    margin-left: -16px;
    width: 181%;">
<?php
include ("tooltip.html");
$folder = $_GET['foldername'];
$mainfolder = $folder . "/";

?>

<input  type="hidden"  name="folderdelete" value="<?php echo $folder; ?>">

<?php


function is_dir_empty($dir) {
  if (!is_readable($dir)) return NULL; 
  return (count(scandir($dir)) == 2);
}
function listFolderFiles($dir) {
    if (!is_dir_empty($dir)) {
    ?>
	<br>
	
 <select class="form-control" name="subfolder" id="subfolder" class="tooltip" style="opacity: 1;" title="Select a sub folder otherwise all files will be deleted">
                        <option value="">Select a Sub Folder</option>
<?php
    foreach (new DirectoryIterator($dir) as $fileInfo) {
        if (!$fileInfo->isDot()) {
            global $mainfolder;
            if ($fileInfo->isDir()) {
                $dirnam = $fileInfo->getPathname();
                $dirnamlist = str_replace($mainfolder, "", $dirnam);
                if ($dirnamlist != '') {
                   
                       
                         echo "<option value=\"$dirnam\">$dirnamlist</option>";
                    
                    }
                }
            }
        }?>
                        <option value="All">All Sub Folders Or Files</option> 
                        </select>
           
           
            <?php
        
    }
}
    listFolderFiles("$folder");
    ?>
<br>

    <input  type="submit" id="deletefolder" class="btn btn-primary" name="deletefolder" value="Delete">
    <?php
    exit;
    ?></div>
 

