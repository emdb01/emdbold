<?php
include('header.php');
if (!isset($_SESSION['user_id'])) {
    header("Location:index.php");
    die();
}
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$mid = $_SESSION['user_id'];
?>
<body>
 <script type="text/javascript">


            function fullname(textbox) {
                if (document.getElementById('fname').value == '')
                {
                    textbox.setCustomValidity('Please keyin Your First Name');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            function lastname(textbox) {
                if (document.getElementById('lname').value == '')
                {
                    textbox.setCustomValidity('Please keyin Your Last Name');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            function companyname(textbox) {
                if (document.getElementById('company').value == '')
                {
                    textbox.setCustomValidity('Please Enter the Company Name');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            function emailid(textbox) {
                if (document.getElementById('email').value == '')
                {
                    textbox.setCustomValidity('Please keyin the Email');
                    return false;
                } else if (document.getElementById('email').value != '') {
                    var x = document.getElementById('email').value;

                    var atpos = x.indexOf("@");
                    var dotpos = x.lastIndexOf(".");
                    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
                        //alert("Not a valid e-mail address");
                        textbox.setCustomValidity('Not a valid e-mail address');
                        // document.checkval.email.focus();
                        return false;
                    } else {
                        textbox.setCustomValidity('');
                    }
                    return true;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            function phonenumber(textbox) {
                if (document.getElementById('phone').value == '')
                {
                    textbox.setCustomValidity('Please keyin the Phone Number');
                    return false;
                } else if (document.getElementById('phone').value.length > 10) {
                    textbox.setCustomValidity('Not a valid Phone Number');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }

            function countryname(textbox) {
                if (document.getElementById('country').value == '')
                {
                    textbox.setCustomValidity('Please select the Country');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }


        </script>
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
                    <h1 class="page-header">Edit Profile</h1>
                </div>
                <!--End Page Header -->
            </div>

              
             <?php
        $email = $_SESSION['email'];
        $listdetails = "SELECT * FROM `recruiter` WHERE user_id='$mid'";
        $listdetails_query = mysql_query($listdetails);
        while ($listdetails_query_fetch = mysql_fetch_array($listdetails_query)) {
            $phone = $listdetails_query_fetch['phone'];
            $company = $listdetails_query_fetch['company'];
            $country = $listdetails_query_fetch['country'];
        }

        if (isset($_POST['fname'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            @$mname = $_POST['mname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $company = $_POST['company'];
            $country = $_POST['country'];
            $checkexist = "SELECT * FROM `recruiter` WHERE (email='$email' or phone='$phone') and user_id !='$mid'";

            $checkexist_query = mysql_query($checkexist);
            $checkexist_check = mysql_num_rows($checkexist_query);
            if ($checkexist_check >= 1) {
                while ($checkexist_result1 = mysql_fetch_array($checkexist_query)) {
                    $exemail = $checkexist_result1['email'];
                    if ($exemail == $email) {
                        ?>
                        <p class="notify_red">The email Address already exists. Please use different ones.</p>
                        <?php
                    } else {
                        ?>
                        <p class="notify_red">The phone number already exists. Please use different ones.</p>
                        <?php
                    }
                }
            } else {
                if (preg_match("/(gmail.com|yahoo.com|outlook.com)/i", $email)) {
                    ?>
                    <p class="notify_red">Only Corporate Email Accounts are permitted</p>
                    <?php
                } else {
                    $tm = time();
                    $userupdate = "UPDATE `recruiter` SET `first` = '$fname', `middle` = '$mname', `last` = '$lname', `status_time` = '$tm', `email` = '$email', `phone` = '$phone', `country` = '$country', `company` = '$company' WHERE `user_id`='$mid'";
                    $userupdate_result = mysql_query($userupdate);
                    $_SESSION['first'] = $fname;
                    $_SESSION['middle'] = $mname;
                    $_SESSION['last'] = $lname;
                    $_SESSION['email'] = $email;
                     //Text to Speach//    
                       
                        $path = 'automails/' . $mid . '/';
                        if (!is_dir($path)) {
                            mkdir($path);
                        }
                        require "tts.php";
                        $tts = new TextToSpeech();
                        $tts->setText("Hi there. This is " . $fname . " " . $mname . " " . $lname . "calling you from " . $company . ". I have [requirement name] and your profile is a good fit for the position. As your EMDB status shows that you are available for new job, I thought you would be interested in this opportunity. If you are, please call me back at " . $phone . ". Thank you!");
                        $filename = $path . 'audio.mp3';
                        $tts->saveToFile($filename);
                        //Text to Speach//  
                    ?>
                    <p class="notify_green">Your profile has been successfully updated</p>
                    <script src="http://code.jquery.com/jquery.min.js"></script>
                    <script type="text/javascript">
                        // $(document).ready(function () {

                            // setTimeout(function () {

                                // window.location.href = "profile-recruiter.php";
                            // }, 500);


                        // });
                    </script>
                    <?php
                }
            }
        }
        ?> 

            <div class="row">
			<div class="col-lg-12">
			 <div class="table-responsive">
			 <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Details
                        </div></br>
				<form role="form" action="edit_profile_recruiter.php" name="checkval" id="checkval"  method="post">
                                <table class="table table-hover tablebd">
                                     
                                    <tbody>
                                        <tr>
                                             
                                            <td>
											
											<div class="form-group">
                                             <label>First Name</label>
                                            <input class="form-control" id="fname" oninvalid="fullname(this);" oninput="fullname(this);"   required="required" name="fname" value="<?php echo $fname; ?>" placeholder="First Name (Mandatory)">
                                        </div></td>
                                             <td>
											 <div class="form-group">
                                             <label>Middle Name</label>
                                            <input class="form-control" id="mname" name="mname" value="<?php echo @$mname; ?>" placeholder="Middle Name" >
                                        </div></td>
										  <td><div class="form-group">
                                             <label>Last Name</label>
                                            <input class="form-control" id="lname" oninvalid="lastname(this);" oninput="lastname(this);"   required="required" name="lname" value="<?php echo @$lname; ?>" placeholder="Last Name  (Mandatory)">
                                        </div></td>
                                        </tr>
                                         
										 
										<tr>
                                            <td><div class="form-group">
                                             <label>Email</label>
                                            <input class="form-control" id="email" oninvalid="emailid(this);" oninput="emailid(this);"   required="required" name="email" value="<?php echo @$email; ?>" placeholder="Email Id (Mandatory)">
                                        </div></td>
                                           
                                            <td><div class="form-group">
                                             <label>Phone No.</label>
                                            <input class="form-control" id="phone" oninvalid="phonenumber(this);" oninput="phonenumber(this);"   required="required" name="phone" value="<?php echo @$phone; ?>" placeholder="Your Mobile Number(Mandatory)">
                                        </div></td>
                                            <td><div class="form-group">
                                             <label>Company</label>
                                            <input class="form-control" id="company" oninvalid="companyname(this);" oninput="companyname(this);"   required="required" name="company" value="<?php echo @$company; ?>" placeholder="Your Company Name(Mandatory)">
                                        </div></td>
                                        </tr>
										 
										 
										<tr>
                                             <td><div class="form-group">
                                             <label>Country</label>
                                            <select class="form-control" name="country" id="country" oninvalid="countryname(this);" oninput="countryname(this);"   required="required">
                                               <?php
                    $countrylist = "SELECT * FROM `countries` order by `countryName` ASC ";
                    $countrylist_result = mysql_query($countrylist);

                    while ($countrylist_result1 = mysql_fetch_array($countrylist_result)) {
                        $countryname = $countrylist_result1['countryName'];
                        if ($countryname == $country) {
                            ?>
                            <option value="<?php echo $countryname; ?>" selected="selected"> <?php echo $countryname; ?></option>

                            <?php
                        }
                        ?>
                        <option value="<?php echo $countryname; ?>"> <?php echo $countryname; ?></option>

                    <?php } ?>
                                            </select>
                                        </div></td>
                                             
                                            
                                        </tr>
										<tr>
                                             <td><button type="submit" class="btn btn-danger" id="register"  value="Update Profile">Update Profile</button></td>
                                             
                                            
                                        </tr>
                                    </tbody>
									
                                </table>
								
								</form>
								
                            </div>
                            </div>
								</div>
     

            </div>

            


         


        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
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
