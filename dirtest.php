<?php 
error_reporting(0);
// Function to Copy folders and files    
$src='34/murali/testzip/abcd';   
mkdir ('34/murali/abcd');
$dst='34/murali/abcd';  
    function rcopy($src, $dst) {
        if (file_exists ($dst)){
            rmdir ($dst);
		}
        if (is_dir ($src)) {
            mkdir ($dst);
            $files = scandir ($src);
            foreach ($files as $file){
                if ($file != "." && $file != ".."){
                    rcopy ( "$src/$file", "$dst/$file" );
				}
			}
        } else if (file_exists ($src))
		{
            copy ($src, $dst);
		}
    }
	rcopy($src , $dst);
function recursiveRemoveDirectory($directory)
{
    foreach(glob("{$directory}/*") as $file)
    {
        if(is_dir($file)) { 
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    }
    rmdir($directory);
}
	recursiveRemoveDirectory($src)	;		 
	?>