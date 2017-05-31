<?php

echo $mid=$_POST['mid'];
echo $_FILES['files[]']['name'];
exit;

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

                        removefile($targetdir);
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
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
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
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
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