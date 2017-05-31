<?php

ob_start();
$invitelogins = $_POST['invitelogins'];
require("resumeparse.php");
session_start();
error_reporting(0);
$user_id = $_SESSION['user_id'];
$path = $_GET['dir'];
$output_dir = $path . "/";

if (isset($_FILES["files"])) {
    $allowed = array('zip', 'doc', 'docx', 'pdf');
    $filename = $_FILES['files']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
        echo "error";
        exit;
    }
    $filenamesize = $_FILES['files']['size'];
    if ($filenamesize > 10485760) {
        exit;
    }


    $ret = array();

    $error = $_FILES["files"]["error"];
    {

        if (!is_array($_FILES["files"]['name'])) { //single file
            $RandomNum = time();

            $ImageName = str_replace(' ', '-', strtolower($_FILES['files']['name']));
            $ImageType = $_FILES['files']['type']; //"image/png", image/jpeg etc.

            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt = str_replace('.', '', $ImageExt);
            $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;

            $ext = pathinfo($NewImageName, PATHINFO_EXTENSION);
            if ($ext == 'zip' || $ext == 'ZIP' || $ext == 'Zip') {
                $noExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $NewImageName);
                mkdir($output_dir . $noExt, 0777, TRUE);
                $output_dir = $path . "/" . $noExt . "/";
                move_uploaded_file($_FILES["files"]["tmp_name"], $output_dir . $NewImageName);
                $ret[$fileName] = $output_dir . $NewImageName;

                $filenoext = basename($ret[$fileName], '.zip');
                $filenoext = basename($filenoext, '.ZIP');
                $targetzip = $ret[$fileName];
                $zip = new ZipArchive();
                $x = $zip->open($targetzip);  // open the zip file to extract

                if ($x == 1) {

                    $zip->extractTo($output_dir); // place in the directory with same name  

                    $zip->close();

                    unlink($targetzip);
                    // removefile($targetdir);
                }
                //echo $filename;
                $targetzip = preg_replace('/\\.[^.\\s]{3,4}$/', '', $NewImageName);
                $actual_link = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
                $goandget = strlen($pos111 = strpos($actual_link, 'https://www.employeemasterdatabase.com/'));
                if ($goandget == 1) {
                    $targetzip = $output_dir . $ImageName;
                } else {
                    $targetzip = $output_dir . $ImageName . '/';
                }
                if (is_dir($targetzip)) {
                    $objects = new RecursiveIteratorIterator(
                            new RecursiveDirectoryIterator($targetzip), RecursiveIteratorIterator::SELF_FIRST);
                } else {

                    $objects = new RecursiveIteratorIterator(
                            new RecursiveDirectoryIterator($output_dir), RecursiveIteratorIterator::SELF_FIRST);
                }


                $directories = array();
                $i = 0;
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
                foreach ($objects as $name => $object) {
//echo $object;
                    /** Remove files as found */
                    if (is_file($name)) {
                        $selected = str_replace("\\", "/", $name);
//                      echo $name;echo "<br>";
//                      $selected = $allresfiles;
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


                        /** Hold folders until end */
                    } elseif (is_dir($name)) {
                        $name = str_replace("\\", "/", $name);
                        $directories[$i++] = $name;
                    }
                }
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
                //print_r($allSkills);
                foreach ($allSkills as $skill) {
                    $myexp[$j];
                    $PhoneNumber[$k];
                    $myemails[$i];
                    $myfilepath[$l] = mysql_real_escape_string($myfilepath[$l]);
                    $skill = implode(",", $skill);

                    //creating users
                    $num == 0;
                    $mail_check = mysql_query($sqlComp = "SELECT * FROM `user` where `email`='$myemails[$i]' ") or die("Unable to connect");
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
//                    $invitelogins = $_POST['invitelogins'];
                    $currentDate = date("Y-m-d");
                    if ($invitelogins == "Logins") {
                        if ($num == 0 && $myemails[$i] != '') {

                            $adduser = "INSERT INTO `user`(`first`, `member_id`, `status_time`, `email`, `pass`, `phone`,`availability`, `role`, `status`, `verify`, `experience`, `skills`, `createdDate`) VALUES ('$name[0]','$mid','$tm','$myemails[$i]','$pass','$PhoneNumber[$k]','No Status','2','1','1','$myexp[$j]','$skill','$currentDate')";
                            $adduser_result = mysql_query($adduser);
                            $link = 'http://employeemasterdatabase.com/';

                            $msg = "Greetings! Your Employeemasterdatabase account has been created by <b> $fname </b> from <b> EMDB </b>.

        
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
                                $adduser = "INSERT INTO `recruit_users`(`user_id`, `recruiterId`,`filepath`,`createdDate`) VALUES ('$last_id','$user_id','./$myfilepath1','$currentDate')";
                                $adduser_result = mysql_query($adduser);
                            }
                        } else {
                            $mailids = mysql_fetch_assoc($mail_check);
                            $recuserId = $mailids['user_id'];
                            $mail_check1 = mysql_query($sqlComp = "SELECT * FROM `recruit_users` where `user_id` ='$recuserId' and `recruiterId`='$user_id' ");
                            $num1 = mysql_num_rows($mail_check1);
                            if ($num1 == 0 && $recuserId > 0 && $myemails[$i] != '') {
                                $myfilepath1 = str_replace("\\\\", "/", $myfilepath[$l]);
                                $adduser = "INSERT INTO `recruit_users`(`user_id`, `recruiterId`, `filepath`,`createdDate`) VALUES ('$recuserId','$user_id','./$myfilepath1','$currentDate')";
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
            } else {
                move_uploaded_file($_FILES["files"]["tmp_name"], $output_dir . $NewImageName);
                $ret[$fileName] = $output_dir . $NewImageName;
                singleFileResumeParse($ret[$fileName]);
            }

            //echo "<br> Error: ".$_FILES["files"]["error"];
        } else {
            $fileCount = count($_FILES["files"]['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                $RandomNum = time();

                $ImageName = str_replace(' ', '-', strtolower($_FILES['files']['name'][$i]));
                $ImageType = $_FILES['files']['type'][$i]; //"image/png", image/jpeg etc.

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt = str_replace('.', '', $ImageExt);
                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;

                $ret[$NewImageName] = $output_dir . $NewImageName;
                move_uploaded_file($_FILES["files"]["tmp_name"][$i], $output_dir . $NewImageName);
                multipleFileResumeParse($ret[$NewImageName]);
            }
        }
    }
    echo json_encode($ret);
}