<?php
include('header.php');
error_reporting(0);
ob_start();
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$mid = $_SESSION['user_id'];
$theroot = "./excel/$mid";
@mkdir($theroot, 0777);
?>
<body>
    <script>
        function validate()
        {


            if (document.checkval.emailtosend.value == "")
            {
                alert("Please keyin the Email");
                document.checkval.emailtosend.focus();
                return false;
            }
            if (document.checkval.emailtosend.value != "") {
                var x = document.checkval.emailtosend.value;
                var atpos = x.indexOf("@");
                var dotpos = x.lastIndexOf(".");
                if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
                    alert("Not a valid e-mail address");
                    document.checkval.emailtosend.focus();
                    return false;
                }
            }


            return(true);
        }

    </script>
    <!--  wrapper -->
    <div id="wrapper">
        <?php include('sidemenu.php'); ?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Invitations</h1>
                </div>
                <!--End Page Header -->
            </div>




            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-5">


                        <?php
                        $comp_check = mysql_fetch_assoc($comp_result = mysql_query($sqlComp = "SELECT * FROM `recruiter` where `user_id`='$mid'"));
                        $company = $comp_check['company'];
                        if($company){
                            $company='from  <b>'.$company.'</b>';
                        }
                        $recruiteremail = $_SESSION['email'];
                        $uploadedStatus = 0;
                        if (isset($_POST["sendin"])) {

                            $invitethis = $_POST["emailtosend"];
                            $invitethis = str_replace(",,", ",", $invitethis);
                            $invitethis = str_replace(",,", ",", $invitethis);
                            $invitethis = str_replace("  ", " ", $invitethis);
                            $invitethis = str_replace("  ", " ", $invitethis);
                            $ary = explode(" ", $invitethis);
                            if (count($ary) > 1) {
                                $ary;
                            } else {
                                $ary = explode(",", $invitethis);
                            }
                            //  echo "<h6>We have sent Invitation mails to </h6>";
                            $mymails = array_unique($ary);
                            require("singlemail.php");
                            $i = 0;
                            foreach ($ary as $selected) {

                                $iviteemails = 1;
                                $recid = $_SESSION['user_id'];
                                $currentDate = date("Y-m-d");
                                $con1 = mysql_num_rows(mysql_query($sql = "SELECT * FROM `invites` where `email`='$myemails[$i]' and `recruiter_id`='$recid'"));
                                $con2 = mysql_num_rows(mysql_query($sql = "SELECT * FROM `invites` where `email`='$myemails[$i]' and `mailStatus`='0'"));

                                if ($con1 == 0 && strlen($myemails[$i]) > 1) {
                                    $mail_check1 = mysql_query($sqlComp = "INSERT INTO `invites`(`email`, `recruiter_id`,`createdDate`) VALUES ('$myemails[$i]','$recid','$currentDate')");
                                }
                                $link = 'https://www.employeemasterdatabase.com/jobseekerregister.php';

                                $msg = "This is <b>$fname  $mname  $lname</b> $company. I am sending this email to request you to sign up at Employee Master Database and get your unique ID. With the help of EMDB ID I would be able to monitor your availability status in real time. So that I can give you call sooner, depending on your status as soon I have any position for you.

<p>Click on the link below to sign up as a job seeker</p>
     <p> $link </p>
<p>Once you get your unique ID, add it to your resume before applying to any further jobs</p>

<p> If you have already submitted for a specific position, I will start processing your profile once I get your EMDB ID.</p>";


                                if ($con1 == 0 && strlen($myemails[$i]) > 1) {
                                    $email[] = $myemails[$i];
                                    $sendmessagetouser_invite = sendInvitationToUser($myemails[$i], $msg, $link, $recruiteremail); //email invite  
                                } else if ($con2 > 0 && strlen($myemails[$i]) > 1) {
                                     $email[] = $myemails[$i];
                                    $sendmessagetouser_invite = sendInvitationToUser($myemails[$i], $msg, $link, $recruiteremail); //email invite  
                                }

                                $i++;
                            }
                        }

                        if (isset($_POST["theresume"])) {

                            if (isset($_FILES["file"])) {
                                $flag = 1;
//if there was an error uploading the file
                                if ($_FILES["file"]["error"] > 0) {
                                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                                } else {
                                    if (file_exists($_FILES["file"]["name"])) {

                                        unlink($_FILES["file"]["name"]);
                                    }
                                    $storagename = "$theroot/discussdesk.xlsx";
                                    move_uploaded_file($_FILES["file"]["tmp_name"], $storagename);
                                    $uploadedStatus = 1;
                                }
                            } else {
                                echo "No file selected <br />";
                            }
                        }

                        if ($uploadedStatus == 1) {


                            set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
                            include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
                            $inputFileName = "$theroot/discussdesk.xlsx";

                            try {

                                $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
                            } catch (Exception $e) {
                                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                            }


                            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                         
                            $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
                            for ($i = 1; $i <= $arrayCount; $i++) {
                                 $theemail = trim($allDataInSheet[$i]["A"]);
                               $mymails[] = $theemail;
                                if ($flag == 1) {
                                    $flag = 2;
                                }
                            }

                            $mymails = array_unique($mymails);
                            require("singlemail.php");
                            
                            foreach ($myemails as $selected) {
                                $ivitecsv = 1;
                                $recid = $_SESSION['user_id'];
                                $currentDate = date("Y-m-d");
                                $con1 = mysql_num_rows(mysql_query($sql = "SELECT * FROM `invites` where `email`='$selected' and `recruiter_id`='$recid'"));
                                $con2 = mysql_num_rows(mysql_query($sql = "SELECT * FROM `invites` where `email`='$selected' and `mailStatus`='0'"));
                                
                              if ($con1 == 0 && strlen($selected) > 1) {
                                    $mail_check1 = mysql_query($sqlComp = "INSERT INTO `invites`(`email`, `recruiter_id`,`createdDate`) VALUES ('$selected','$recid','$currentDate')");
                                }
                                $link = 'https://www.employeemasterdatabase.com/jobseekerregister.php';

                                $msg = "This is <b>$fname  $mname  $lname</b> $company. I am sending this email to request you to sign up at Employee Master Database and get your unique ID. With the help of EMDB ID I would be able to monitor your availability status in real time. So that I can give you call sooner, depending on your status as soon I have any position for you.

<p>Click on the link below to sign up as a job seeker</p>
     <p> $link </p>
<p>Once you get your unique ID, add it to your resume before applying to any further jobs</p>

<p> If you have already submitted for a specific position, I will start processing your profile once I get your EMDB ID.</p>";

                               if ($con1 == 0 && strlen($selected) > 1) {
                                    $emails[] = $selected;
                                    $sendmessagetouser_invite = sendInvitationToUser($selected, $msg, $link, $recruiteremail); //email invite
                                } else if ($con2 > 0 && strlen($selected) > 1) {
                                     $emails[] = $selected;
                                    $sendmessagetouser_invite = sendInvitationToUser($selected, $msg, $link, $recruiteremail); //email invite   
                                }
                  
                            }
                        }
                        ?>

                        <?php if (@$message) echo "<p class=\"notify_green\">$message</p>"; ?>	
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Use excel sheet 


                            </div>
                            <div class="panel-body">
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

                                    <p><i class="fa fa-arrow-right"></i> Upload the excel sheet </br></br></p><center><input  type="file" name="file" id="file" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" 
                                                                                                                              placeholder="Upload The Resumes">
                                        </br>
                                        <button type="submit" class="btn btn-primary" name="theresume"  id="theresume"  value="Upload" >Invite</button>
                                        </br></br></center>

                                    <p> <b><i>For a sample excel sheet , <a href="http://employeemasterdatabase.com/sampleemaillisttemplate.xlsx">click here  </a>.</i></b></p>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-1 " >
                        <div class="timeline-badge" style="
                             z-index: 100;
                             position: absolute;
                             top: 16px;
                             left: 50%;
                             width: 50px;
                             height: 50px;
                             margin-left: -25px;
                             border-radius: 50% 50% 50% 50%;
                             text-align: center;
                             font-size: 1.4em;
                             line-height: 50px;
                             color: #fff;
                             background-color: #999999;
                             ">
                            <i class="">Or</i>
                        </div>
                    </div>
                    <div class="col-lg-5">





                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Input email ID's 


                            </div><br>
                            <div class="panel-body">
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" name="checkval" id="checkval"  method="post"  onsubmit="return(validate());">

                                    <div class="form-group">
                                        <input class="form-control" required="required" name="emailtosend"  id="emailtosend"  placeholder="Email Address" >
                                    </div>

                                    <center><button  type="submit" name="sendin"  id="sendin" class="btn btn-primary" value="Invite" style="margin:10px">Invite</button></center></br>
                                    <p><b><i>Note : Separate multiple email ID's with (,) or (space)</b></i></p>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


            </div>








        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->


    <!-- Page-Level Plugin Scripts-->
<!--    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>-->
    <script src="assets/scripts/dashboard-demo.js"></script>

</body>

</html>

<?php if ($ivitecsv == 1) { ?>
    <link rel="stylesheet" href="popstyles/main.css">
    <div id="boxes">
        <div  id="dialog" style="width: 50%;font-family: 'Times New Roman', Times, serif;height:200px;text-align:justify;font-size: 18px;overflow: scroll;border-radius:0px;" class="window"> <b> Invitation email(s) successfully sent to</b><br>
            <?php
            foreach ($emails as $selectedemail) {
                echo $selectedemail;
                echo "<br>";
            }
            ?>

        </div>
        <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="popstyles/main.js"></script>
<?php } else if ($iviteemails == 1) { ?>
    <link rel="stylesheet" href="popstyles/main.css">
    <div id="boxes">
        <div  id="dialog" style="width: 50%;font-family: 'Times New Roman', Times, serif;height:200px;text-align:justify;font-size: 18px;overflow-y: scroll;border-radius:0px;" class="window"> <b> Invitation email(s) successfully sent to </b><br>
            <?php
            foreach ($email as $selectedemail) {
                echo $selectedemail;
                echo "<br>";
            }
            ?>

        </div>
        <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="popstyles/main.js"></script>
<?php }
?>