<?php 
$folder = $_GET['foldername'];
$mainfolder=$folder."/";
$incrementvalue=0;
function listFolderFilescheck($dir)
{
if($dir == ''){ exit; }
    foreach (new DirectoryIterator($dir) as $fileInfo) {
        if (!$fileInfo->isDot()) {
        global $mainfolder;
            if ($fileInfo->isDir()) {
			   $dirnam=$fileInfo->getPathname();
			  $dirnamlist=str_replace($mainfolder,"",$dirnam);
			   $incrementvalue=1;

                //listFolderFiles($fileInfo->getPathname());
            }
            
        }
    }
	if(@$incrementvalue==1) {
	return ($incrementvalue); } else {
	
	
	
	}
}
$incrementval=listFolderFilescheck("$folder");
if($incrementval==1){

  ?>
<br><br><br>
<select name="refinesubfolder" class="form-control" style="float:left;width:70%" id="refinesubfolder">
  <option value="">Select a Sub Folder else leave as it is</option>
<?php 


function listFolderFiles22($dir)
{

    foreach (new DirectoryIterator($dir) as $fileInfo) {
        if (!$fileInfo->isDot()) {
        global $mainfolder;
            if ($fileInfo->isDir()) {
			   $dirnam=$fileInfo->getPathname();
			  $dirnamlist=str_replace($mainfolder,"",$dirnam);
			   echo "<option value=\"$dirnam\">$dirnamlist</option>";

                //listFolderFiles($fileInfo->getPathname());
            }
            
        }
    }
	
}

listFolderFiles22("$folder"); } else {}?>
   
    <input type='submit' class="btn btn-primary" name='refinefolder'  value='Refine Folder' style="float:right"><br><br>
   <input type="submit" class="btn  btn-success" size="11"  name="resetfilter"  value="Reset Filter " style="float:right;width: 25%;"/>
    <?php
  
exit;
?>

