<?php
//--- get all the directories
$dirname = '34';
$findme  = "mk/newOne";
$dirs    = glob($dirname.'*', GLOB_ONLYDIR);
$files   = array();
//--- search through each folder for the file
//--- append results to $files

foreach( $dirs as $d ) {
    $f = glob( $d .'/'. $findme );
    if( count( $f ) ) {
        $files = array_merge( $files, $f );
    }
}
if( count($files) ) {
    foreach( $files as $f ) {
        echo "<a href='{$dirname}/{$f}'>{$f}</a><br>";
    }
} else {
    echo "Nothing was found.";//Tell the user nothing was found.
    echo '<img src="yourimagehere.jpg"/>';//Display an image, when nothing was found.
}

function arraySearch( $array, $search ) { 
    foreach ($array as $a ) { 
        if(strstr( $a, $search)){ 
            echo $a;
        } 
    } 
return false; 
}

arraySearch(array("php","mysql","search"),"sq");
echo "<br>";

$it = new RecursiveDirectoryIterator(34);
$allowed=array("doc");
foreach(new RecursiveIteratorIterator($it) as $file) {
    if(in_array(substr($file, strrpos($file, '.') + 1),$allowed)) {
        echo $file . "<br/> \n";
    }
}
echo "<br>";
echo find_file(34,'karthik');

?>