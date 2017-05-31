<?php
include('header.php');
error_reporting(0);
include('class.pdf2text.php');
require("class.filetotext.php");

if (!isset($_SESSION['user_id'])) {
    header("Location:index.php");
    die();
}

if ($_POST['folder'] == 'new' || $_POST['folder'] == 'existing') {
    unset($_GET['del']);
}
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
$Remail = $_SESSION['email'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$mid = $_SESSION['user_id'];
$mainfolder = "./" . $mid . "/";
?>
<script>
    /* parentfolder alert while empty  */

    function parentfolderempty(textbox) {

        if (document.getElementById('pathspecify').value == '')
        {
            textbox.setCustomValidity('Please Select Parent Folder.');
            return false;
        } else {
            textbox.setCustomValidity('');
        }
        return true;
    }
    /* parentfolder alert while empty */

</script>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
           <?php include('sidemenu.php'); ?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Upload Resumes</h1>
                </div>
                <!--End Page Header -->
            </div>

              
            
 <?php
        $theroot = "./$mid";

        @mkdir($theroot, 0777);

        if (isset($_FILES['files'])) {
            $nopath = "";
            $subpath = "";
            $mainpath = "";
            $radioselected = $_POST['folder'];
            if ($radioselected == "existing") {
                $mainpath = $_POST['pathspecify'];

                if ($mainpath != "") {
                    $subpath = $_POST['subfolder2'];
                    if ($subpath != "") {
                        $path = $subpath;
                    } else {
                        $path = $mainpath;
                    }
                } else {
                    $path = $mainfolder;
                }
            } else {

                $mainpath = $_POST['mainfolder'];
                $pathspecify = $_POST['pathspecify'];
                $subfolder1 = $_POST['subfolder1'];
                if ($subfolder1 != "" && $pathspecify != 'Create Parent Folder' && $mainpath == '') {
                    $pathspecify = $pathspecify . "/" . $subfolder1;
                    @mkdir($pathspecify, 0777);
                    $path = $pathspecify;
                    echo "<span style='color:green;margin-left: 21px;'>Sub Folder Created Successfully.</span>";
                    echo "<br>";
                } else {
                    // $path = $pathspecify;
                }

                if ($mainpath == "" && $_POST['pathspecify'] == 'Create Parent Folder') {
                    echo "<span style='color:red;margin-left: 21px;'>Please Create Atleast MainFolder.</span>";
                    echo "<br>";
                } else if ($mainpath != "") {

                    $reqpath = "./" . $mid . "/" . $mainpath;
                    @mkdir($reqpath, 0777);


                    if ($subfolder1 != "") {

                        $reqpath = $reqpath . "/" . $subfolder1;
                        @mkdir($reqpath, 0777);
                        $path = $reqpath;
                        // echo $pathspecify;
                        if ($_POST['pathspecify'] == 'Create Parent Folder') {
                            echo "<span style='color:green;margin-left: 21px;'>Parent Folder Created Successfully.</span>";
                            echo "<br>";
                        }
                    } else {
                        $path = $reqpath;
                    }
                } else {

//                    $path = $mainfolder;
                    $path = $pathspecify;
                }
            }





            $errors = array();
            $countfail = 0;
            $countupload = 0;
            $mymails = array();
            $emdbIds = array();
            $myfpath = array();
            $myexp = array();
            $PhoneNumber = array();
            $allSkills = array();
            $myfilepath = array();
   

            foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
                $file_name = $key . $_FILES['files']['name'][$key];
                $file_name1 = $_FILES['files']['name'][$key];
                $file_size = $_FILES['files']['size'][$key];
                $file_tmp = $_FILES['files']['tmp_name'][$key];
                $file_type = $_FILES['files']['type'][$key];
                if ($file_size > 15731716) {
                    $errors[] = 'File size must be less than 15 MB';
                }

                if (empty($errors) == true) {

                    $filename = $file_name;
                    $filename1 = $file_name1;
                    $source = $file_tmp;
                    $type = $file_type;
                    $name = explode(".", $filename);
                    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/zip-compressed', 'application/octet-stream');
                    foreach ($accepted_types as $mime_type) {
                        if ($mime_type == $type) {
                            $okay = true;
                            break;
                        }
                    }
                    // $path = "./$mid";  // absolute path to the directory where zipper.php is in
                    $targetdir = $path;
                    @mkdir($targetdir, 0777);
                    $continue = strtolower($name[1]) == 'zip' ? true : false;
                    if (!$continue) {
                        //$message = "The file you are trying to upload is not a .zip file. Please try again.";
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        if ($ext == 'pdf' || $ext == 'PDF' || $ext == 'docs' || $ext == 'docx' || $ext == 'doc') {
                            $filenameup = str_replace($key, "", $filename);
                            move_uploaded_file($source, "$path/" . $filenameup);

                            $countupload = $countupload + 1;
                        } else {

                            $countfail = $countfail + 1;
                        }

//                        removefile($targetdir);
                    } else {

                        /* PHP current path */
                        // define ("FILEREPOSITORY","./$mid");

                        $filenoext = basename($filename, '.zip');  // absolute path to the directory where zipper.php is in (lowercase)
                        $filenoext = basename($filenoext, '.ZIP');  // absolute path to the directory where zipper.php is in (when uppercase)
                        $filenoext = basename($filename1, '.zip');  // absolute path to the directory where zipper.php is in (when uppercase)
                        //$targetdir = $path . $filenoext; // target directory
                        $targetzip = $filename; // target zip file
                        // target directory
                        // $targetzip = $path; // target zip file

                        /* create directory if not exists', otherwise overwrite */
                        /* target directory is same as filename without extension */

                        //if (is_dir($targetdir))  rmdir_recursive ( $targetdir);
//echo "reached here"; 
//exit();
                        /* here it is really happening */

                        if (move_uploaded_file($source, $targetzip)) {
//                            echo $targetzip;

                            $zip = new ZipArchive();
                            $x = $zip->open($targetzip);  // open the zip file to extract
                            if ($x === true) {
                                $zip->extractTo($targetdir); // place in the directory with same name  

                                $zip->close();

                                unlink($targetzip);
                                // removefile($targetdir);
                            }
                            //echo $filename;
                            $targetzip = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename1);
                            $actual_link = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
                            if ($actual_link == 'http://test.employeemasterdatabase.com/resumes.php' || $actual_link == 'http://www.employeemasterdatabase.com/resumes.php') {
                                $targetzip = "$path/" . $targetzip;
                            } else {
                                $targetzip = "$path\\" . $targetzip;
                            }
                            if (is_dir($targetzip)) {
                                $objects = new RecursiveIteratorIterator(
                                        new RecursiveDirectoryIterator($targetzip), RecursiveIteratorIterator::SELF_FIRST);
                            } else {

                                $objects = new RecursiveIteratorIterator(
                                        new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
                            }


                            $directories = array();
                            $i = 0;
                            $allfiles = array();
                            /** Recursive process of Folders */
                            foreach ($objects as $name => $object) {

                                /** Remove files as found */
                                if (is_file($name)) {
                                    array_push($allfiles, $name);
                                    /** Hold folders until end */
                                } elseif (is_dir($name)) {
                                    $directories[$i++] = $name;
                                }
                            }

                            $countupload = $countupload + 1;
                        } else {
                            $countfail = $countfail + 1;
                        }
                    }
                }

// zip parsing

                $splitext = explode(".", $filename);

                if ($splitext[1] == 'zip' || $splitext[1] == 'ZIP') {

                    $allresfiles = array();
//                    $failingpaths = array();
                    foreach ($allfiles as $allresfiles) {
                      $selected = $allresfiles;
                        // $resumepath[] = $selected;
                        $finalfilnam = explode("/", $selected);
                        $justfinalfile = end($finalfilnam);
                        $docObj = new Filetotext("$selected");
                        $return = $docObj->convertToText();
                        $mystring = $return;
                        $pos = 0;
                        $endpos = 0;
                        $findme = 'EMDB';
                        $pos = strpos($mystring, $findme);

                        $docObj1 = new Filetotext("$selected");
                        $return1 = $docObj1->convertToText1();
                        $mystring1 = $return1;
                        $findme1 = 'EMDB';
                        $pos1 = strpos($mystring1, $findme1);
                        if ($pos1 !== false) {
                            $emdbidtext = $mystring1;
                            $pos11 = strpos($emdbidtext, '@');
                            if ($pos11 === false) {
                                $emdidt = explode("EMDB", $emdbidtext);
                                $eidt = explode(" ", $emdidt[1]);
                                $memidNum = preg_replace('/\D/', '', $eidt[0]);
                                if (strlen($memidNum) == 12) {
                                    $memidNum;
                                    $upqry = "UPDATE `user` SET protect='Private' where member_id='$memidNum'";
                                    $qry = mysql_query($upqry);
                                }
                            }
                        }
                        $countupload = $countupload + 1;
                        // Note our use of ===. Simply, == would not work as expected
                        // because the position of 'a' was the 0th (first) character.

                        if (strlen($mystring) == 0) {
                            $failpaths[] = $selected;
                        } else if ($pos === false) {
                            $text = $mystring;
                            $text1 = $mystring1;
                            //experience parser
                            $pattern = "/(?:[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
                            $fileCount = preg_match_all($pattern, strtolower(nl2br($text1)), $matches);
                            if ($fileCount != 0) {

                                $replacexp = str_replace("Experience", "experience", strtolower(nl2br($text1)));
                                $myextractdata = str_replace("EXPERIENCE", "experience", $replacexp);
                                $exp = explode("experience", $myextractdata);
                                $findExp = 'experience';
                                $Exppos = strpos(strtolower(nl2br($text1)), $findExp);
                                $useme1 = 'years';
                                $mypos1 = strpos($myextractdata, $useme1);
                                if ($Exppos !== false && $mypos1 !== false) {
                                    for ($i = 0; $i <= count($exp); $i++) {
                                        $replaceyrs = str_replace("Years", "years", $exp[$i]);
                                        $myextractdata = str_replace("YEARS", "years", $replaceyrs);
                                        $useme = 'years';
                                        $mypos = strpos($myextractdata, $useme);
                                        if ($mypos !== false) {
                                            $expluseme = explode($useme, $myextractdata);
                                            $expluseme[0];
//                                $lastleter = preg_replace('/\D/', '', $expluseme[0]);
                                            $lastleter = preg_match_all('/\d+/', $expluseme[0], $numbers);
                                            // echo print_r($numbers[0]);
                                            //$lastleter = end($numbers[0]);
                                            $lastleter = end($expluseme[0]);
                                            if (strlen($lastleter) == 1) {

                                                $Oexp[] = $lastleter;
                                            } else {
                                                $spacetrim = trim($expluseme[0], " ");
                                                $spacetrim = str_replace(":", "", $spacetrim);
                                                $spacetrim = str_replace("+", "", $spacetrim);
                                                $spacetrim = trim($spacetrim, " ");
                                                $explspace = explode(" ", $spacetrim);
                                                $last = count($explspace) - 1;
                                                $spacetrim = preg_replace("/[^a-zA-Z0-9 .]/", "", $explspace[$last]);
                                                $finddot = '.';
                                                $pos = strpos($spacetrim, $finddot);
                                                if ($pos === false) {
                                                    $spacetrim = preg_replace('/\D/', '', $spacetrim);
                                                }

                                                if (strlen($spacetrim) <= 4) {
                                                    $Oexp[] = $spacetrim;
                                                } else {
                                                    $lastleter = preg_replace('/\D/', '', $explspace[$last]);
                                                    $lastleter = substr($lastleter, -1);
                                                    $Oexp[] = $lastleter;
                                                }
                                            }
                                            break;
                                        }
                                    }
                                } else {
                                    $Oexp[] = 0;
                                }
                            } else {
                                $Oexp[] = 0;
                            }
                            //experience parser
                            //Skills parser
                            $part = strtolower(nl2br($text));
                            preg_match_all('/java|.Net|Oracle|j2ee|spring|sql|web service integration|jdk|html|css|ajax|jquery|oops|javascript|python|php|ruby|c|c++|c sharp|visual basic|objective-c|perl|ios|analytics|architecture|business analytics|data analytics|hardware|it support|linux|mobile applications|networking|troubleshooting|web development|web design|cloud computing|it optimization|it security|embedded hardware|linux|mac os|wire frames/', $part, $matches);
                            if (count($matches[0])) {
                                $matches = array_unique($matches[0]);
                                foreach ($matches as $skills) {
                                    $pskills1[] = $skills;
                                }
                                array_push($allSkills, $pskills1);
                                $pskills1 = array();
                            }
                            //Skills parser
                            //Mobile parser
                            $text = str_replace('+91', '+91 ', strtolower(nl2br($text)));
                            $pattern = "/(?:[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
                            $fileCount = preg_match_all($pattern, strtolower(nl2br($text)), $matches);
                            if ($fileCount != 0) {
                                $areaCodes = array();
                                $threeDigits = array();
                                $fourDigits = array();
                                $part = nl2br(strtolower($text));
                                $part = str_replace('(', ' ', $part);
                                $part = str_replace(')', ' ', $part);
                                if (preg_match_all('/\b[0-9]{3}\s*[-]?\s*[0-9]{3}\s*[-]?\s*[0-9]{4}\b/', $part, $matches) > 0) {
                                    foreach ($matches[0] as $mnums) {
                                        $MobileNum[] = $mnums;
                                        break;
                                    }
                                } else if (preg_match_all('/(\d{3})-(\d{3})-(\d{4})/', $part, $matches) > 0 || preg_match_all('/\((\d{3})\)-(\d{3})-(\d{4})/', $part, $matches) > 0 || preg_match_all('/(\d{3}).(\d{3}).(\d{4})/', $part, $matches) > 0 || preg_match_all('/((\d{3})).(\d{3}).(\d{4})/', $part, $matches) > 0) {

                                    preg_match_all('/(\d{3})-(\d{3})-(\d{4})/', $part, $matches);


                                    if (count($matches[1]) > 0) {
                                        for ($i = 0; $i < count($matches[1]); $i++) {
                                            array_push($areaCodes, $matches[1][$i]);
                                            array_push($threeDigits, $matches[2][$i]);
                                            array_push($fourDigits, $matches[3][$i]);
                                        }
                                    }

                                    preg_match_all('/\((\d{3})\)-(\d{3})-(\d{4})/', $part, $matches);


                                    if (count($matches[1]) > 0) {
                                        for ($i = 0; $i < count($matches[1]); $i++) {
                                            array_push($areaCodes, $matches[1][$i]);
                                            array_push($threeDigits, $matches[2][$i]);
                                            array_push($fourDigits, $matches[3][$i]);
                                        }
                                    }
                                    preg_match_all('/(\d{3}).(\d{3}).(\d{4})/', $part, $matches);


                                    if (count($matches[1]) > 0) {
                                        for ($i = 0; $i < count($matches[1]); $i++) {
                                            array_push($areaCodes, $matches[1][$i]);
                                            array_push($threeDigits, $matches[2][$i]);
                                            array_push($fourDigits, $matches[3][$i]);
                                        }
                                    }

                                    preg_match_all('/((\d{3})).(\d{3}).(\d{4})/', $part, $matches);


                                    if (count($matches[1]) > 0) {
                                        for ($i = 0; $i < count($matches[1]); $i++) {
                                            array_push($areaCodes, $matches[1][$i]);
                                            array_push($threeDigits, $matches[2][$i]);
                                            array_push($fourDigits, $matches[3][$i]);
                                        }
                                    }


                                    $MobileNum[] = $areaCodes[0] . $threeDigits[0] . $fourDigits[0];
                                } else {
                                    $MobileNum[] = 0;
                                }
                            } else {
                                $MobileNum[] = 0;
                            }


                            //Mobile parser
                            //mail parser
                            //failure paths
                            if ($fileCount == 0) {
                                $failpaths[] = $selected;
                            }
                            if ($fileCount != 0) {
                                //failure paths
                                $text = str_replace("id:", "id: ", strtolower(nl2br($text)));
                                $text = str_replace('"', ' ', $text);

                                foreach (preg_split('/\s/', $text) as $token) {

                                    $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
                                    if ($email !== false) {
                                        $touchme8 = 'email id';
                                        $touchme11 = 'emailid';
                                        $touchme9 = 'mail to';
                                        $touchme3 = 'mailto';
                                        $touchme10 = 'email to';
                                        $touchme15 = 'emailto';
                                        $touchme12 = '-';
                                        $touchme13 = 'mail id';
                                        $touchme14 = 'mailid';
                                        $touchme5 = 'email';
                                        $touchme7 = 'e-mail';

                                        $post8 = strpos($email, $touchme8);
                                        if ($post8 !== false) {
                                            $email = explode("EMAIL ID", $email);
                                            $email = $email[1];
                                            $email = str_replace("EMAIL ID", "", $email);
                                        }$post9 = strpos($email, $touchme9);
                                        if ($post9 !== false) {
                                            $email = explode("mail to", $email);
                                            $email = $email[1];
                                            $email = str_replace("mail to", "", $email);
                                        }$post10 = strpos($email, $touchme10);
                                        if ($post10 !== false) {
                                            $email = explode("email to", $email);
                                            $email = $email[1];
                                            $email = str_replace("email to", "", $email);
                                        }
                                        $post11 = strpos($email, $touchme11);
                                        if ($post11 !== false) {
                                            $email = explode("emailid", $email);
                                            $email = $email[1];
                                            $email = str_replace("emailid", "", $email);
                                        }

                                        $post3 = strpos($email, $touchme3);
                                        if ($post3 !== false) {
                                            $email = explode("mailto", $email);
                                            $email = $email[1];
                                            $email = str_replace("mailto", "", $email);
                                        }

                                        $post5 = strpos($email, $touchme5);
                                        if ($post5 !== false) {
                                            $email = explode("email", $email);
                                            $email = $email[1];
                                            $email = str_replace("email", "", $email);
                                        }

                                        $post7 = strpos($email, $touchme7);
                                        if ($post7 !== false) {
                                            $email = explode("e-mail", $email);
                                            $email = $email[1];
                                            $email = str_replace("e-mail", "", $email);
                                        }

                                        $post13 = strpos($email, $touchme13);
                                        if ($post13 !== false) {
                                            $email = explode("mail id", $email);
                                            $email = $email[1];
                                            $email = str_replace("mail id", "", $email);
                                        }
                                        $post14 = strpos($email, $touchme14);
                                        if ($post14 !== false) {
                                            $email = explode("mailid", $email);
                                            $email = $email[1];
                                            $email = str_replace("mailid", "", $email);
                                        }
                                        $post15 = strpos($email, $touchme15);
                                        if ($post15 !== false) {
                                            $email = explode("emailto", $email);
                                            $email = $email[1];
                                            $email = str_replace("emailto", "", $email);
                                        }
                                        $email = ltrim($email, "-");

                                        //$email = ltrim($email, "id");
                                        $email1 = explode(".com", $email);
                                        if (count($email1) > 1) {
                                            $email = $email1[0] . ".com";
                                        } else {
                                            $email = $email1[0];
                                        }
$email = rtrim($email, "br");
                                        $emails[] = $email;
                                        $resumepath[] = $selected;
                                        break;
                                    }
                                }
                            } else {
                                $emails[] = 0;
                                $resumepath[] = 0;
                            }
                            //mail parser
                            if (!empty($emails)) {
                                $emails = array_unique($emails);
                                foreach ($emails as $selectedemail) {
                                    array_push($mymails, $selectedemail);
                                    $emails = array();
                                }
                            } else {
                                $emails[] = 0;
                                $resumepath[] = 0;
                                foreach ($emails as $selectedemail) {
                                    array_push($mymails, $selectedemail);
                                    $emails = array();
                                }
                            }
                        } else {
                            $text = $mystring;

                            $emdid = explode("EMDB", $text);
                            $eid = explode(" ", $emdid[1]);
                            $memNum = preg_replace('/\D/', '', $eid[0]);
                            if (strlen($memNum) == 12) {
                                $memNum;
                            } else {
                                $memNum = 0;
                            }
                            $emipath[] = $selected;
                            // array_push($myfpath, $selected);
                            array_push($emdbIds, $memNum);
                        }
                    }
                } else {
                    // zip parsing
                    $selected = "$path/" . $filenameup; //live
                    $finalfilnam = explode("/", $selected);
                    $justfinalfile = end($finalfilnam);
                    $docObj = new Filetotext("$selected");
                    $return = $docObj->convertToText();
                    $mystring = $return;

                    $pos = 0;
                    $endpos = 0;
                    $findme = 'EMDB';
                    $pos = strpos($mystring, $findme);

                    $docObj1 = new Filetotext("$selected");
                    $return1 = $docObj1->convertToText1();
                    $mystring1 = $return1;
                    $findme1 = 'EMDB';
                    $pos1 = strpos($mystring1, $findme1);
                    if ($pos1 !== false) {
                        $emdbidtext = $mystring1;
                        $pos11 = strpos($emdbidtext, '@');
                        if ($pos11 === false) {
                            $emdidt = explode("EMDB", $emdbidtext);
                            $eidt = explode(" ", $emdidt[1]);
                            $memidNum = preg_replace('/\D/', '', $eidt[0]);
                            if (strlen($memidNum) == 12) {
                                $memidNum;
                                $upqry = "UPDATE `user` SET protect='Private' where member_id='$memidNum'";
                                $qry = mysql_query($upqry);
                            }
                        }
                    }
                    // Note our use of ===. Simply, == would not work as expected
                    // because the position of 'a' was the 0th (first) character.
                    if (strlen($mystring) == 0) {
                        $failpaths[] = $selected;
                    } else if ($pos === false) {
                        $text = $mystring;
                        $text1 = $mystring1;

                        //experience parser
                        $pattern = "/(?:[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
                        $fileCount = preg_match_all($pattern, strtolower(nl2br($text1)), $matches);
                        if ($fileCount != 0) {

                            $replacexp = str_replace("Experience", "experience", strtolower(nl2br($text1)));
                            $myextractdata = str_replace("EXPERIENCE", "experience", $replacexp);
                            $exp = explode("experience", $myextractdata);
                            $findExp = 'experience';
                            $Exppos = strpos(strtolower(nl2br($text1)), $findExp);
                            $useme1 = 'years';
                            $mypos1 = strpos($myextractdata, $useme1);
                            if ($Exppos !== false && $mypos1 !== false) {
                                for ($i = 0; $i <= count($exp); $i++) {
                                    $replaceyrs = str_replace("Years", "years", $exp[$i]);
                                    $myextractdata = str_replace("YEARS", "years", $replaceyrs);
                                    $useme = 'years';
                                    $mypos = strpos($myextractdata, $useme);
                                    if ($mypos !== false) {
                                        $expluseme = explode($useme, $myextractdata);
                                        $expluseme[0];
//                                $lastleter = preg_replace('/\D/', '', $expluseme[0]);
                                        $lastleter = preg_match_all('/\d+/', $expluseme[0], $numbers);
                                        // echo print_r($numbers[0]);
                                        //$lastleter = end($numbers[0]);
                                        $lastleter = end($expluseme[0]);
                                        if (strlen($lastleter) == 1) {

                                            $Oexp[] = $lastleter;
                                        } else {
                                            $spacetrim = trim($expluseme[0], " ");
                                            $spacetrim = str_replace(":", "", $spacetrim);
                                            $spacetrim = str_replace("+", "", $spacetrim);
                                            $spacetrim = trim($spacetrim, " ");
                                            $explspace = explode(" ", $spacetrim);
                                            $last = count($explspace) - 1;
                                            $spacetrim = preg_replace("/[^a-zA-Z0-9 .]/", "", $explspace[$last]);
                                            $finddot = '.';
                                            $pos = strpos($spacetrim, $finddot);
                                            if ($pos === false) {
                                                $spacetrim = preg_replace('/\D/', '', $spacetrim);
                                            }

                                            if (strlen($spacetrim) <= 4) {
                                                $Oexp[] = $spacetrim;
                                            } else {
                                                $lastleter = preg_replace('/\D/', '', $explspace[$last]);
                                                $lastleter = substr($lastleter, -1);
                                                $Oexp[] = $lastleter;
                                            }
                                        }
                                        break;
                                    }
                                }
                            } else {
                                $Oexp[] = 0;
                            }
                        } else {
                            $Oexp[] = 0;
                        }
                        //experience parser
                        //Skills parser
                        $part = strtolower(nl2br($text));
                        preg_match_all('/java|.Net|Oracle|j2ee|spring|sql|web service integration|jdk|html|css|ajax|jquery|oops|javascript|python|php|ruby|c|c++|c sharp|visual basic|objective-c|perl|ios|analytics|architecture|business analytics|data analytics|hardware|it support|linux|mobile applications|networking|troubleshooting|web development|web design|cloud computing|it optimization|it security|embedded hardware|linux|mac os|wire frames/', $part, $matches);
                        if (count($matches[0])) {
                            $matches = array_unique($matches[0]);
                            foreach ($matches as $skills) {
                                $pskills1[] = $skills;
                            }
                            array_push($allSkills, $pskills1);
                            $pskills1 = array();
                        }
                        //Skills parser
                        //Mobile parser
                        $text = str_replace('+91', '+91 ', strtolower(nl2br($text)));
                        $pattern = "/(?:[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
                        $fileCount = preg_match_all($pattern, strtolower(nl2br($text)), $matches);
                        if ($fileCount != 0) {
                            $areaCodes = array();
                            $threeDigits = array();
                            $fourDigits = array();
                            $part = nl2br(strtolower($text));
                            $part = str_replace('(', ' ', $part);
                            $part = str_replace(')', ' ', $part);
                            if (preg_match_all('/\b[0-9]{3}\s*[-]?\s*[0-9]{3}\s*[-]?\s*[0-9]{4}\b/', $part, $matches) > 0) {
                                foreach ($matches[0] as $mnums) {
                                    $MobileNum[] = $mnums;
                                    break;
                                }
                            } else if (preg_match_all('/(\d{3})-(\d{3})-(\d{4})/', $part, $matches) > 0 || preg_match_all('/\((\d{3})\)-(\d{3})-(\d{4})/', $part, $matches) > 0 || preg_match_all('/(\d{3}).(\d{3}).(\d{4})/', $part, $matches) > 0 || preg_match_all('/((\d{3})).(\d{3}).(\d{4})/', $part, $matches) > 0) {

                                preg_match_all('/(\d{3})-(\d{3})-(\d{4})/', $part, $matches);


                                if (count($matches[1]) > 0) {
                                    for ($i = 0; $i < count($matches[1]); $i++) {
                                        array_push($areaCodes, $matches[1][$i]);
                                        array_push($threeDigits, $matches[2][$i]);
                                        array_push($fourDigits, $matches[3][$i]);
                                    }
                                }

                                preg_match_all('/\((\d{3})\)-(\d{3})-(\d{4})/', $part, $matches);


                                if (count($matches[1]) > 0) {
                                    for ($i = 0; $i < count($matches[1]); $i++) {
                                        array_push($areaCodes, $matches[1][$i]);
                                        array_push($threeDigits, $matches[2][$i]);
                                        array_push($fourDigits, $matches[3][$i]);
                                    }
                                }
                                preg_match_all('/(\d{3}).(\d{3}).(\d{4})/', $part, $matches);


                                if (count($matches[1]) > 0) {
                                    for ($i = 0; $i < count($matches[1]); $i++) {
                                        array_push($areaCodes, $matches[1][$i]);
                                        array_push($threeDigits, $matches[2][$i]);
                                        array_push($fourDigits, $matches[3][$i]);
                                    }
                                }

                                preg_match_all('/((\d{3})).(\d{3}).(\d{4})/', $part, $matches);


                                if (count($matches[1]) > 0) {
                                    for ($i = 0; $i < count($matches[1]); $i++) {
                                        array_push($areaCodes, $matches[1][$i]);
                                        array_push($threeDigits, $matches[2][$i]);
                                        array_push($fourDigits, $matches[3][$i]);
                                    }
                                }


                                $MobileNum[] = $areaCodes[0] . $threeDigits[0] . $fourDigits[0];
                            } else {
                                $MobileNum[] = 0;
                            }
                        } else {
                            $MobileNum[] = 0;
                        }


                        //Mobile parser
                        //mail parser
                        //failure paths
                        if ($fileCount == 0) {
                            $failpaths[] = $selected;
                        }
                        if ($fileCount != 0) {
                            //failure paths
                            $text = str_replace("id:", "id: ", strtolower(nl2br($text)));
                            $text = str_replace('"', ' ', $text);

                            foreach (preg_split('/\s/', $text) as $token) {
                                $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);

                                if ($email !== false) {

                                    $touchme8 = 'email id';
                                    $touchme11 = 'emailid';
                                    $touchme9 = 'mail to';
                                    $touchme3 = 'mailto';
                                    $touchme10 = 'email to';
                                    $touchme15 = 'emailto';
                                    $touchme12 = '-';
                                    $touchme13 = 'mail id';
                                    $touchme14 = 'mailid';
                                    $touchme5 = 'email';
                                    $touchme7 = 'e-mail';

                                    $post8 = strpos($email, $touchme8);
                                    if ($post8 !== false) {
                                        $email = explode("EMAIL ID", $email);
                                        $email = $email[1];
                                        $email = str_replace("EMAIL ID", "", $email);
                                    }$post9 = strpos($email, $touchme9);
                                    if ($post9 !== false) {
                                        $email = explode("mail to", $email);
                                        $email = $email[1];
                                        $email = str_replace("mail to", "", $email);
                                    }$post10 = strpos($email, $touchme10);
                                    if ($post10 !== false) {
                                        $email = explode("email to", $email);
                                        $email = $email[1];
                                        $email = str_replace("email to", "", $email);
                                    }
                                    $post11 = strpos($email, $touchme11);
                                    if ($post11 !== false) {
                                        $email = explode("emailid", $email);
                                        $email = $email[1];
                                        $email = str_replace("emailid", "", $email);
                                    }

                                    $post3 = strpos($email, $touchme3);
                                    if ($post3 !== false) {
                                        $email = explode("mailto", $email);
                                        $email = $email[1];
                                        $email = str_replace("mailto", "", $email);
                                    }

                                    $post5 = strpos($email, $touchme5);
                                    if ($post5 !== false) {
                                        $email = explode("email", $email);
                                        $email = $email[1];
                                        $email = str_replace("email", "", $email);
                                    }

                                    $post7 = strpos($email, $touchme7);
                                    if ($post7 !== false) {
                                        $email = explode("e-mail", $email);
                                        $email = $email[1];
                                        $email = str_replace("e-mail", "", $email);
                                    }

                                    $post13 = strpos($email, $touchme13);
                                    if ($post13 !== false) {
                                        $email = explode("mail id", $email);
                                        $email = $email[1];
                                        $email = str_replace("mail id", "", $email);
                                    }
                                    $post14 = strpos($email, $touchme14);
                                    if ($post14 !== false) {
                                        $email = explode("mailid", $email);
                                        $email = $email[1];
                                        $email = str_replace("mailid", "", $email);
                                    }
                                    $post15 = strpos($email, $touchme15);
                                    if ($post15 !== false) {
                                        $email = explode("emailto", $email);
                                        $email = $email[1];
                                        $email = str_replace("emailto", "", $email);
                                    }
//                             $post12 = strpos($email, $touchme12);
//                                if ($post12 !== false) {
//                                    $email = explode("-", $email);
//                                    $email = $email[1];
//                                    $email = str_replace("-", "", $email);
//                                }
//                                $email = str_replace("Mailto", "", $email);
//                                $email = str_replace("mailto", "", $email);
//                                $email = str_replace("EMAIL", "", $email);
//                                $email = str_replace("email", "", $email);
//                                $email = explode("Email", $email);
//                                $email = $email[1];
//                                $email = str_replace("Email", "", $email);
                                    $email = ltrim($email, "-");

                                    //$email = ltrim($email, "id");
                                    $email1 = explode(".com", $email);
                                    if (count($email1) > 1) {
                                        $email = $email1[0] . ".com";
                                    } else {
                                        $email = $email1[0];
                                    }
$email = rtrim($email, "br");
                                    $emails[] = $email;
                                    $resumepath[] = $selected;
                                    break;
                                }
                            }
                        } else {
                            $emails[] = 0;
                            $resumepath[] = 0;
                        }
                        //mail parser

                        if (!empty($emails)) {
                            $emails = array_unique($emails);
                            foreach ($emails as $selectedemail) {
                                array_push($mymails, $selectedemail);
                                $emails = array();
                            }
                        } else {
                            $emails[] = 0;
                            $resumepath[] = 0;
                            foreach ($emails as $selectedemail) {
                                array_push($mymails, $selectedemail);
                                $emails = array();
                            }
                        }
                    } else {
                        $text = $mystring;

                        $emdid = explode("EMDB", $text);
                        $eid = explode(" ", $emdid[1]);
                        $memNum = preg_replace('/\D/', '', $eid[0]);
                        if (strlen($memNum) == 12) {
                            $memNum;
                        } else {
                            $memNum = 0;
                        }
                        $emipath[] = $selected;
                        // array_push($myfpath, $selected);
                        array_push($emdbIds, $memNum);
                    }
                }
            }
            ?>
            <!-------this is for failure paths popup-----> 

            <?php
            if (count($errors) > 0) {
                ?>
                <link rel="stylesheet" href="popstyles/main.css">
                <div id="boxes" style="">
                    <div  id="dialog" style="font-size: 18px;border-radius:0px;" class="window"> <b>File Size Must be Less Than 15 MB.</b><br><br> <?php ?>

                        <!-- <a href="#" class="close" style="right:0px;top:1px;">X</a><br>-->
                    </div>
                    <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>

                </div>
                  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                <script src="popstyles/main.js"></script>
            <?php } else if (count($failpaths) > 1 && $_POST['submit'] != '') {
                ?>
                <link rel="stylesheet" href="popstyles/main.css">
                <div id="boxes" style="">
                    <div  id="dialog" style="width: 50%;font-family: 'Times New Roman', Times, serif;height:200px;text-align:justify;font-size: 18px;overflow: scroll;border-radius:0px;" class="window"> <b>Below resumes did not have Email ids Or Email ids are in headers Or Files are corrupted Or have  EMDB ID's </b><br><br> <?php
                        foreach ($failpaths as $failure) {
//            echo $failure;
                            $failur = explode("/", $failure);
                            $n = count($failur);
                            echo $failur[$n - 1];
                            echo "<br>";
                        }
                        ?>

                        <!--                        <a href="#" class="close" style="right:0px;top:1px;">X</a><br>-->
                    </div>
                    <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>

                </div>
                 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
                <script src="popstyles/main.js"></script>
            <?php } ?>
            <!-------this is for failure paths popup----->                  
            <?php
            // echo $countupload;
            if ($countupload >= 1) {
                if ($countfail >= 1) {
                    $countupload = $countupload - 1;
                    // $message = "The upload of the files and zip folder were successful. Number of successful uploads are " . $countupload . " and number of failed uploads are " . $countfail;
                    $message = "The upload of the files and zip folder were successful.";
                } else {
                    $scountupload = ($countupload - 1) - count($failpaths);
                    // $message = "The upload of the files and zip folder were successful. Number of successful uploads are " . $scountupload . " and number of failed uploads are " . count($failpaths);
                    $message = "The upload of the files and zip folder were successful.";
                }
            }
//            else {
//                $message = "There was a problem with the upload. Please try again.";
//            }
        }
        ?>

        
        <?php
        //delete folder code

//        if ($_POST['folderdelete'] != '' && $_POST['submit'] == '') {
//            if ($_POST['subfolder'] != '') {
//                $path = $_POST['subfolder'];
//                $dirname = $path;
//                if ($dirname == 'All') {
//                    $Delfpath = str_replace("\\", "/", $_POST['folderdelete']);
//                    $delsql = "DELETE FROM `recruit_users` WHERE  recruiterId='$mid' and filepath LIKE '%$Delfpath%'";
//                    mysql_query($delsql);
//                } else {
//                    $Delfpath = str_replace("\\", "/", $dirname);
//                    $delsql = "DELETE FROM `recruit_users` WHERE  recruiterId='$mid' and filepath LIKE '%$Delfpath%'";
//                    mysql_query($delsql);
//                }
//
//                function delete_directory($dirname, $path) {
//                    if (is_dir($dirname))
//                        $dir_handle = opendir($dirname);
//                    if (!$dir_handle)
//                        return false;
//                    while ($file = readdir($dir_handle)) {
//                        if ($file != "." && $file != "..") {
//                            if (!is_dir($dirname . "/" . $file))
//                                unlink($dirname . "/" . $file);
//                            else
//                                delete_directory($dirname . '/' . $file, '');
//                        }
//                    }
//                    if ($dirname != $path) {
//                        rmdir($dirname);
//                        return true;
//                    }
//                }
//
//                delete_directory($dirname, $path);
//
//                $ary = explode("\\", $path);
//                $cnt = count($ary);
//            } else {
//                $path = $_POST['folderdelete'];
//                $ary = explode("\\", $path);
//                $cnt = count($ary);
//                if ($_POST['subfolder'] == '' && $_POST['folderdelete'] != '') {
//                    $Delfpath = str_replace("\\", "/", $_POST['folderdelete']);
//                    $delsql = "DELETE FROM `recruit_users` WHERE  recruiterId='$mid' and filepath LIKE '%$Delfpath%'";
//                    mysql_query($delsql);
//
//                }
//            }
//
//
//            if (file_exists($path)) {
//
//                $objects = new RecursiveIteratorIterator(
//                        new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
//                $directories = array();
//                $i = 0;
//              
//                foreach ($objects as $name => $object) {
//
//                   
//                    if (is_file($name)) {
//                        unlink($name);
//
//                      
//                    } elseif (is_dir($name)) {
//                        $directories[$i++] = $name;
//                    }
//                }
//
//               
//                foreach ($directories as $name) {
//                
//                    rmdir($path);
//                }
//
//
//            }
//            if ($_POST['subfolder'] == 'All') {
//
//                $dirname11 = $_POST['folderdelete'];
//                $dirnamea = $dirname11;
//
//                function delete_directory1All($dirnamea, $dirname11) {
//                    if (is_dir($dirnamea))
//                        $dir_handle = opendir($dirnamea);
//                    if (!$dir_handle)
//                        return false;
//                    while ($file = readdir($dir_handle)) {
//                        if ($file != "." && $file != "..") {
//                            if (!is_dir($dirnamea . "/" . $file))
//                                unlink($dirnamea . "/" . $file);
//                            else
//                                delete_directory($dirnamea . '/' . $file, '');
//                        }
//                    }
//                    if ($dirnamea != $dirname11) {
//                        rmdir($dirnamea);
//                        return true;
//                    }
//                }
//
//                delete_directory1All($dirnamea, $dirname11);
//            }
//        }

//delete folder code
        ?>


        <?php //if ($_GET['del'] == '0' && $_POST['subfolder'] ==''){ echo "<p class=\"notify_red\">If you want to delete main folder first should be delete all sub folders.</p>";}  ?>
        <?php //if ($_GET['del'] == '1'){ echo "<p class=\"notify_green\">Files Deleted Successfully.</p>";}  ?>
        <?php if (@$message) echo "<p class=\"notify_green\">$message</p>"; ?>

        <?php
        if (count($emdbIds) > 0) {
            // echo "<b>Below entries have EMDB id's</b>";
            foreach ($emipath as $mfpaths) {
                array_push($myfpath, $mfpaths);
            }
            $m = 0;
            foreach ($emdbIds as $emids) {
                $mid_check = mysql_query($sqlComp = "SELECT * FROM `user` where `member_id`='$emids' ");
                if (mysql_num_rows($mid_check) > 0) {
                    $membids = mysql_fetch_assoc($mid_check);
                    $useId = $membids['user_id'];
                    $recid = $_SESSION['user_id'];
                    $mfpaths1 = str_replace("\\", "/", $myfpath[$m]);
                    $mbid_check1 = mysql_query($sqlComp = "SELECT * FROM `recruit_users` where `user_id` ='$useId' and `recruiterId`='$recid' ");
                    if (mysql_num_rows($mbid_check1) == 0) {
                        $mail_check1 = mysql_query($sqlComp = "INSERT INTO `recruit_users`(`user_id`, `recruiterId`,`filepath`) VALUES ('$useId','$recid','$mfpaths1')");
                    }
                }
                $m++;
            }
        }
        ?>
        <br> 
        <!--tooltip------>
        <?php include ("tooltip.html"); ?>
        <!--tooltip------>
        <!--Popup for View Resume------>
<!--<script src="js/jquery-1.10.2.min.js"></script>-->
        <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="js/portBox.slimscroll.min.js"></script>
        <link href="css/portBox.css" rel="stylesheet" />
        <!--Popup for View Resume------>
            <div class="row">
			<div class="col-lg-12">
			 
								</div>
								
								<div class="col-lg-5">
					 <form enctype="multipart/form-data" method="post" action="">			<div class="panel panel-default">
                        
                        <div class="panel-body" style="width:auto;">
								
                    <!-- Donut Example-->   
				   
                 <div class="form-group">
                                             <p>
                                            <label class="radio-inline">
                                                <input type="radio" name="folder" value="new">New Folder
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="folder" CHECKED value="existing">Existing Folder 
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="folder"  value="delete" class="tooltip" style="opacity: 1;" title="If you want to delete main folder first should be delete all sub folders">Delete Folder
                                            </label>
											 </p>
                                        </div> 
										<div class="col-lg-12">
									
                                      <select class="form-control" name="pathspecify" id="pathspecify" oninvalid="parentfolderempty(this);" required="required"  oninput="parentfolderempty(this);" >
                <option value="">Select Parent Folder</option>
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

                listFolderFiles("./$mid");
                ?>
            </select>
			 <div id="div1" style="float:left;width:100%"></div> <div id="div2" style="float:left"></div> 
            <div  class="col-lg-12" style="padding-left: 0px;
    padding-right: 0px;
    margin: 10px 0px;">
                <input style="display:none;"  class="form-control" type="text" id="mainfolder" name="mainfolder" placeholder="Main Folder "  ><br>
                <input style="display:none;" class="form-control"  type="text" id="subfolder1"  name="subfolder1" placeholder="Sub Folder "  > 
            </div> 
            </br>
                                        </div> </br></br></br>
										<div class="form-group" style="margin-left: 16px;"></br>
                                            <input  type="file" name="files[]" multiple="" placeholder="Upload The Resumes" id="file">
											 <center></br>
                <div id="mySite" class="portBox" style="width: 140%;padding-right: 10px;top: 10px !important; left: 10.5px;margin-right: 0px;">
                    <div class="project">
                        <div class="project-pics" style="width: auto;font-family: 'Times New Roman', Times, serif;"> 
                            <b>If you click on send logins option then credentials will be sent to jobseekers, otherwise if you click on invite option then invitation mail will be sent to jobseekers.  </b>
                            <br><br>
                            <b style="color:red;">Note:</b><b>This is applicable for only to new jobseekers</b>
                            <br> 
                            <input type="radio" name="invitelogins" value="Logins" checked id="invitelogins">Send Logins
                            <input type="radio" name="invitelogins" value="Invite" id="invitelogins">Invite<br>
                            <input type="submit" name="submit"  id="follow" class="form-control" style="background-color: #258EC8;width: 13%;"value="Submit" />
                        </div>
                    </div> </div>  </center>
					 <p class="notify_text" >
                <input type="submit" name="submit"  id="download" data-display="mySite" class="btn btn-primary" value="Upload" style="margin-top:4px;float:left;margin-left:0px;"/>
                    <button  name="submit"  id="theresume"  value="Upload" class="btn btn-primary">Upload</button>

            </p>
                                  </div>

										</div>
									  </form>	
									<!--   <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>-->
        <script>
    $(document).ready(function ()
    {
	
        $('#download').hide();

        $('#pathspecify').change(function ()
        {

            var foldername = $(this).val();

            var folder = $('input:radio[name=folder]:checked').val();
            $.ajax({data: {foldername: foldername}, url: "folderdelete.php", success: function (result) {
                    $("#div2").html(result);
                }});

            if (foldername == 'Create Parent Folder')
            {
                $('#mainfolder').show();
                $('#subfolder1').show();
                $('#div1').hide();
            }
            else
            {

                $('#mainfolder').hide();
                $('#subfolder1').hide();
                //$('#div1').show();
            }
            if (folder == 'existing')
            {
                $('#div2').hide();
                $.ajax({data: {foldername: foldername}, url: "ajaxfolder.php", success: function (result) {
                        $("#div1").html(result);
                    }});

            }
            else if (folder == 'delete')
            {
                $.ajax({data: {foldername: foldername}, url: "folderdelete.php", success: function (result) {

                        $("#div2").html(result);
                    }});

            }
            else
            {
                $('#subfolder1').show();
                $('#subfolder').hide();
            }
        });


        $("input[name='folder']").click(function () {

            if ($('input:radio[name=folder]:checked').val() == "new")
            {

                $('#subfolder1').show();
                $('#div1').hide();
                $('#div2').hide();
                $("#pathspecify").append(new Option("Create Parent Folder", "Create Parent Folder"));
                $('#theresume').show();
                $('#file').show();

            }
            else if ($('input:radio[name=folder]:checked').val() == "delete") {
			
                $('#div2').show();
                $('#div1').hide();
                $("#pathspecify option[value='Create Parent Folder']").remove();
                $('#mainfolder').hide();
                $('#subfolder1').hide();
                $('#theresume').hide();
                $('#file').hide();
                $('#download').hide();

            } else {
                document.location.href = 'resumes.php';
                $('#div1').show();
                $('#div2').hide();
                $("#pathspecify option[value='Create Parent Folder']").remove();
                $('#mainfolder').hide();
                $('#subfolder1').hide();
                $('#download').hide();

            }
        });
        $("input[name='files[]']").click(function () {
            $('#file').change(function () {
 // alert($(this).val()); 
                $('#download').show();
                $('#theresume').hide();
            });
        });

    });
        </script>
										
										</div>
                    <!--End Donut Example-->
                </div>
				
				
                <div class="col-lg-10">

 	
				
				
				
				<div class="panel panel-default">
                        <div class="panel-heading">
                            Please ensure the below mentioned points are taken into consideration while uploading your resume database
                        </div>
                        <div class="panel-body">
                            <p><i class="fa fa-arrow-right"></i> Upload a compressed zip folder with all your resumes</p>
                            <p><i class="fa fa-arrow-right"></i> Only the extensions .pdf, .docx and .doc are allowed</p>
                            <p><i class="fa fa-arrow-right"></i> Resumes with same name will be overwritten</p>
                            <p><i class="fa fa-arrow-right"></i> Do not zip a folder, the zip should contain only the files not any folder</p>
                        </div>
                        
                    </div>
                </div>


            </div>

            


         
		 


        </div>
        <!-- end page-wrapper -->

    </div>
	
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <!--<script src="assets/plugins/jquery-1.10.2.js"></script>-->
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>
	



</body>

</html>
<?php
foreach ($resumepath as $filepath) {

    array_push($myfilepath, $filepath);
}

//push experience
foreach ($Oexp as $Exp) {
    array_push($myexp, $Exp);
}

//push experience
//push mobile number
foreach ($MobileNum as $PhoneNum) {
    array_push($PhoneNumber, $PhoneNum);
}

$myfilepath = array_unique($myfilepath);
$mymails = array_unique($mymails);

require("singlemail.php");

$user_id = $_SESSION['user_id'];

$i = 0;
$j = 0;
$k = 0;
$l = 0;
foreach ($allSkills as $skill) {
    $myexp[$j];
    $PhoneNumber[$k];
    $myemails[$i];

    $myfilepath[$l] = mysql_real_escape_string($myfilepath[$l]);
    $skill = implode(",", $skill);

    //creating users
    $num == 0;
    $mail_check = mysql_query($sqlComp = "SELECT * FROM `user` where `email`='$myemails[$i]' ");
    $num = mysql_num_rows($mail_check);
    $name = explode("@", $myemails[$i]);
    $name = explode(".", $name[0]);
    $name = explode("-", $name[0]);
    $name = explode("_", $name[0]);
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
    $password = substr(str_shuffle($chars), 0, 8);
    $pass = md5($password);

    $tm = time();
    $tempid = mt_rand(10, 99);
    $mid = $tempid . $tm;
    $mid = ifidavail($mid);
    $invitelogins = $_POST['invitelogins'];
$currentDate = date("Y-m-d");
    if ($invitelogins == "Logins") {
        if ($num == 0 && $myemails[$i] != '') {

            $adduser = "INSERT INTO `user`(`first`, `member_id`, `status_time`, `email`, `pass`, `phone`,`availability`, `role`, `status`, `verify`, `experience`, `skills`, `createdDate`) VALUES ('$name[0]','$mid','$tm','$myemails[$i]','$pass','$PhoneNumber[$k]','No Status','2','1','1','$myexp[$j]','$skill','$currentDate')";
            $adduser_result = mysql_query($adduser);
            $link = 'https://www.employeemasterdatabase.com/';

            $msg = "Greetings! Your Employeemasterdatabase account has been created by <b> $fname </b> .

        
        <div style='background-color: #eae9ee;'>
        <p>This is your Global ID: <b style='color:#0c52ad;'>EMDB$mid</b></p>

        <p>Below are your credentials:</p>
        
        <p style='color:#0c52ad;'>Username: $myemails[$i]</p>
            
        <p style='color:#0c52ad;'>Password: $password</p>
            
        </div>

       

        <p>Click on the link below to login as a job seeker</p>

        <p> $link </p>

        <p>Employee Masterdatabase is a Jobseeker availability database which notifies   recruiter about your current job search status, provided recruiter has your resume with EMDB ID on it. You can change your availability status by logging in to account any time. All you have to do is copy the global ID to your resume and apply to jobs.</p>

        <p>We wish you good luck with everything.</p>";

          $sendmessagetouser_invite = sendCredentialsToUser($myemails[$i], $msg, $link, $Remail, $name[0]); //send logins
            $last_id = mysql_insert_id();
            if ($last_id > 0) {
                $myfilepath1 = str_replace("\\\\", "/", $myfilepath[$l]);
                $adduser = "INSERT INTO `recruit_users`(`user_id`, `recruiterId`,`filepath`,`createdDate`) VALUES ('$last_id','$user_id','$myfilepath1','$currentDate')";
                $adduser_result = mysql_query($adduser);
            }
        } else {
            $mailids = mysql_fetch_assoc($mail_check);
            $recuserId = $mailids['user_id'];
            $mail_check1 = mysql_query($sqlComp = "SELECT * FROM `recruit_users` where `user_id` ='$recuserId' and `recruiterId`='$user_id' ");
            $num1 = mysql_num_rows($mail_check1);
            if ($num1 == 0 && $recuserId > 0 && $myemails[$i] != '') {
                $myfilepath1 = str_replace("\\\\", "/", $myfilepath[$l]);
                $adduser = "INSERT INTO `recruit_users`(`user_id`, `recruiterId`, `filepath`,`createdDate`) VALUES ('$recuserId','$user_id','$myfilepath1','$currentDate')";
                $adduser_result = mysql_query($adduser);
            }
        }
    } else if ($invitelogins == "Invite") {
         $dupmail = mysql_query($sqlComp = "SELECT * FROM `invites` where `email` ='$myemails[$i]' and recruiter_id='$user_id'");
            $dupnum = mysql_num_rows($dupmail);
        if ($num == 0 && $myemails[$i] != '' && $dupnum == 0) {
            $mail_check1 = mysql_query($sqlComp = "INSERT INTO `invites`(`email`, `recruiter_id`,`createdDate`) VALUES ('$myemails[$i]','$user_id','$currentDate')");
            $getRecmail = mysql_query($sqlComp = "SELECT email,first,middle,last,company FROM `recruiter` where `user_id` ='$user_id'");
            $rowDet = mysql_fetch_assoc($getRecmail);
            $recruiteremail = $rowDet['email'];
            $fname = $rowDet['first'];
            $mname = $rowDet['middle'];
            $lname = $rowDet['last'];
            $company = $rowDet['company'];
            $link = 'https://www.employeemasterdatabase.com/jobseekerregister.php';

            $msg = "This is <b>$fname  $mname  $lname</b> from <b>$company</b>. I am sending this email to request you to sign up at Employee Master Database and get your unique ID. With the help of EMDB ID I would be able to monitor your availability status in real time. So that I can give you call sooner, depending on your status as soon I have any position for you.

<p>Click on the link below to sign up as a job seeker</p>
     <p> $link </p>
<p>Once you get your unique ID, add it to your resume before applying to any further jobs</p>

<p> If you have already submitted for a specific position, I will start processing your profile once I get your EMDB ID.</p>";
           $sendmessagetouser_invite = sendInvitationToUser($myemails[$i], $msg, $link, $recruiteremail); // invite
        }
    }

    $i++;
    $j++;
    $k++;
    $l++;

    //creating users
}

//insert Data from resume to  database
//parsing
?>
