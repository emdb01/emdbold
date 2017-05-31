<?php
error_reporting(0);
session_start();
// Include the DirectoryLister class
require_once('resources/DirectoryLister.php');

// Initialize the DirectoryLister object
$lister = new DirectoryLister();

// Restrict access to current directory
ini_set('open_basedir', getcwd());

// Return file hash
if (isset($_GET['hash'])) {

    // Get file hash array and JSON encode it
    $hashes = $lister->getFileHash($_GET['hash']);
    $data = json_encode($hashes);

    // Return the data
    die($data);
}

if (isset($_GET['zip'])) {

    $dirArray = $lister->zipDirectory($_GET['zip']);
} else {

    // Initialize the directory array

    $originalid = explode("/", $_GET['dir']);
   
    if (isset($_GET['dir'])) {
        
        if ($_GET['dir'] != '' && $_SESSION['user_id'] == $originalid[0]) {
            $dirArray = $lister->listDirectory($_GET['dir']);
            
//            $search= $_POST['filepath'];
//            print_r($dirArray);
//            foreach($dirArray1 as $file){
//               print_r( $file[file_path]) ;
//               $pos1 = strpos($file[file_path], $search);
//                        if ($pos1 !== false) {
//                            $dirArray=$file[file_path]; 
//                            $dirArray = $lister->listDirectory($file[file_path]);
//                        }
//            } 
           
        } else {
            ?>
            <div id="page-content" class="container">
                <div class="alert alert-danger">
                    <b>ERROR:</b> File path does not exist.
                    <a class="close" data-dismiss="alert" href="#">&times;</a>
                </div>
            </div>
        <?php
        }
    } else {
        
        $dirArray = $lister->listDirectory($_SESSION['user_id']);
        
    }


    // Define theme path
    if (!defined('THEMEPATH')) {
        define('THEMEPATH', $lister->getThemePath());
    }

    // Set path to theme index
    $themeIndex = $lister->getThemePath(true) . '/index.php';

    // Initialize the theme
    if (file_exists($themeIndex)) {//echo $themeIndex;
        include($themeIndex);
    } else {
        die('ERROR: Failed to initialize theme');
    }
}
