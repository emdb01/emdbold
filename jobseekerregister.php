<?php
session_start();
include('config/config.php');
$ido = $_SESSION['idolize'];
?>
<!DOCTYPE html>
<html> 
    <head> 
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />   
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <title>Employee Master Database</title>  

        <link rel="icon"  type="image/ico" href="images/favicon.ico">

        <link rel='stylesheet' id='bootstrap.min-css'  href='css/ui/bootstrap.min.css' type='text/css' media='all' />
        <link rel='stylesheet' href='css/font-awesome.css' type='text/css' media='all' />  
        <link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' media='all' />  
        <link rel="stylesheet" type="text/css" href="css/ui/style.css" />   
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <style>
            @media (max-width:700px){
                .loginm button{  
                    margin-left:0px !important
                }
                .loginm button{  
                    margin-right:0px !important
                }
                .reg {
                    margin: 0px !important
                }
            }
        </style>
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
            function password(textbox) {
                if (document.getElementById('pass').value == '')
                {
                    textbox.setCustomValidity('Please keyin the Password!');
                    return false;
                } else if (document.getElementById('pass').value.length <= 7) {
                    textbox.setCustomValidity('Please provide a password of min length 8');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            function cpassword(textbox) {
                if (document.getElementById('passc').value == '')
                {
                    textbox.setCustomValidity('Please keyin the Password!');
                    return false;
                } else if (document.getElementById('pass').value != document.getElementById('passc').value) {
                    textbox.setCustomValidity('Please keyin the Re Type Password correctly!');
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
    </head>
    <body>
        <style>
            .rightlogin{
                position:fixed;top:290px;right:0px
            }
            .rightlogin a{
                color: #fff;
                padding-right: 0px;
            }  
        </style>
        <div class="rightlogin"><a href="https://www.employeemasterdatabase.com/"   class="col-lg-4 col-md-4 col-sm-3 col-xs-3"><img src="images/login.png"></a>
        </div>
        <div id="wrapper">
            <!-- Start header -->			<div id="tope" style="background: url(images/banner11.jpg) no-repeat center;
                                         background-size: cover;">            
                <!-- Start header -->			<div style="background: rgba(14, 14, 14, 0.38);height:356px">            
                    <header>               
                        <div class="main-header navbar navbar-inverse" data-spy="affix" data-offset-top="107">
                            <div class="container">                                                                                                                                                                                                                                                                                                        
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                    <div class="logo col-lg-3 col-md-3 col-sm-12 col-xs-12"> 
                                        <a href="index.php"><img src="images/logo.png" style="border:none;" ></a>

                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">  </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">  
                                        <div class="search" style="margin-top: 31px;">
                                            <form action="index.php" name="checkavail" id="checkavail"  method="post"  >
                                                <input type="text" class="form-control input-sm" maxlength="64"  oninvalid="searchid(this);" oninput="searchid(this);"   required="required" name="search" Value="" placeholder="EMDB" />
                                                <button type="submit" class="btn btnh btn-primary btn-sm">Check</button>
                                            </form>
                                            <p>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"  style="margin-top: px;">
                                        <div class="loginm"><a href="jobseeker.php" style="color:#fff"  class="col-lg-4 col-md-4 col-sm-3 col-xs-3"><button type="button" class="btn btn-primary">Job Seeker</button></a>
                                            <a href="recruiter.php" style="color:#fff"  class="col-lg-4 col-md-4 col-sm-3 col-xs-3"> <button type="button" class="btn btn-primary">Recruiter</button></a>



                                            <ul id="drop-nav" class="reg col-lg-4 col-md-4 col-sm-3 col-xs-3" style="margin-top: 21px;">
                                                <li><a href="#" class="one">REGISTER <span class="caret"></span></a>
                                                    <ul>
                                                        <li><a href="jobseekerregister.php"><i class="fa fa-caret-right"></i> Job Seeker</a></li>
                                                        <li><a href="recruiterregister.php"><i class="fa fa-caret-right"></i> Recruiter</a></li> 

                                                    </ul>
                                                </li>
                                            </ul>



                                        </div>

                                    </div>
                                </div>
                            </div>
                    </header>




                </div>

            </div>	
        </div>	



        <div class="content about"> 
            <div class="container">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 30px 0px 30px; ">
                    <center><h1>Job Seeker Registration</h1></center>



                </div> 


                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 how">
                    <?php
                    $formactive = 0;
                    if (isset($_POST['fname'])) {
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        @$mname = $_POST['mname'];
                        @$availability = $_POST['availability'];
                        if ($mname == "") {
                            $fulname = $fname . " " . $lname;
                        } else {
                            $fulname = $fname . " " . $mname . " " . $lname;
                        }

                        $email = $_POST['email'];
                        $vid = md5($email);
                        $phone = $_POST['phone'];
                        //$availability = "Available";
                        $pass = $_POST['pass'];
                        $pass = md5($pass);
                        $country = $_POST['country'];
                        $checkexist_check = "";
                        $checkexist = "select count(*)  as total from `recruiter`, `user` where recruiter.email='$email' OR user.email='$email' OR user.phone='$phone' OR recruiter.phone='$phone'";

//$checkexist = "SELECT * FROM `recruiter` WHERE email='$email' or phone='$phone'";
                        $checkexist_query = mysql_query($checkexist);
                        @$data = mysql_fetch_assoc($checkexist_query);
                        $checkexist_check = $data['total'];

                        //email validation script
                        require("email_validation.php");
                        $validator = new email_validation_class;
                        if (!function_exists("GetMXRR")) {
                            $_NAMESERVERS = array();
                            include("getmxrr.php");
                        }
                        $validator->timeout = 10;
                        $validator->data_timeout = 0;
                        $validator->localuser = "info";
                        $validator->localhost = "phpclasses.org";
                        $validator->debug = 1;
                        $validator->html_debug = 1;
                        $mymal = $email;
                        $mymails = trim($mymal);
                        if (strlen($error = $validator->ValidateAddress($mymails, $valid))) {
                            $mymails = 0;
                        } elseif (!$valid) {
                            $mymails = 0;
                            if (count($validator->suggestions)) {
                                $suggestion = $validator->suggestions[0];
                                $link = '?email=' . UrlEncode($suggestion);
                                $mymails = 0;
                            }
                        } elseif (($result = $validator->ValidateEmailBox($mymails)) < 0) {
                            $mymails = 0;
                        } else if ($result == 0) {
                            $mymails = 0;
                        } else if ($result == 1) {
                            $mymails = 1;
                        }
//email validation script

                        if ($mymails == 0) {
                            ?>
                            <p class="notify_red">The email Address is not a valid.</p> 
                            <?php
                        } else if ($checkexist_check >= 1) {
                            ?>
                            <p class="notify_red">The email Address or Phone number already exists. Please use different ones.</p>
                            <?php
                        } else {
                            $tm = time();
                            $tempid = mt_rand(10, 99);
                            $mid = $tempid . $tm;
                            $currentDate = date("Y-m-d");
                            $mid = ifidavail($mid);
                            if (isset($ido)) {
                                $adduser = "INSERT INTO `user` (`first`, `middle`, `last`, `member_id`, `status_time`, `email`,`pass`, `phone`, `availability` , `country`, `role`, `status`, `verify`, `createdDate`, `idolize`) VALUES 
('$fname','$mname','$lname','$mid','$tm','$email','$pass','$phone','$availability','$country','2','2','2','$currentDate','1')";
                            } else {
                                $adduser = "INSERT INTO `user` (`first`, `middle`, `last`, `member_id`, `status_time`, `email`,`pass`, `phone`, `availability` , `country`, `role`, `status`, `verify`, `createdDate`) VALUES 
('$fname','$mname','$lname','$mid','$tm','$email','$pass','$phone','$availability','$country','2','2','2','$currentDate')";
                            }
                            $adduser_result = mysql_query($adduser);
                            if ($adduser_result) {
                                $formactive = 1;
                                $link = 'https://www.employeemasterdatabase.com/verify.php?vid=' . $vid . '&tm=' . $mid;
                                $msg = "Click the link below or copy and paste  link in browser to activate your EMDB account.";
                                $resu = mailfun($fulname, $email, $msg, $link);
                                ?>
                                <div style="border: 1px solid #428bca;">
                                    <p class="notify_green">Thank you for Registering with Employee Master Database.</p>
                                    <p class="notify_text">An email has been sent to the registered email Id.Please verify your email to activate your account</p>
                                    <p class="notify_text">If you are unable to locate the email in the inbox, please check the spam folder.</p>
                                </div>
                                <?php
                            }
                        }
                    }

                    if ($formactive != 1) {
                        ?>

                        <form action="jobseekerregister.php" name="checkval" id="checkval"  method="post"  >
                            <input class="texth" type="text" id="fname" oninvalid="fullname(this);" oninput="fullname(this);"   required="required" name="fname" value="<?php echo @$_POST['fname']; ?>" placeholder="First Name (Mandatory)" />
                            <input class="texth" type="text" id="mname" name="mname" value="" placeholder="Middle Name" />
                            <input class="texth" type="text" id="lname" oninvalid="lastname(this);" oninput="lastname(this);"   required="required" name="lname" value="<?php echo @$_POST['lname']; ?>" placeholder="Last Name  (Mandatory)" />
                            <input class="texth" type="text" id="email" oninvalid="emailid(this);" oninput="emailid(this);"   required="required" name="email" value="<?php echo @$_POST['email']; ?>" placeholder="Contact Email Id (Mandatory)" />
                            <input class="texth" type="password" id="pass" oninvalid="password(this);" oninput="password(this);"   required="required" name="pass" name="pass" value="<?php echo @$_POST['phone']; ?>" placeholder="Enter a password  minimum length 8 " /> 
                            <input class="texth" type="password" id="passc" oninvalid="cpassword(this);" oninput="cpassword(this);"   required="required" name="passc" value="" placeholder="Re Enter the password" /> 
                            <select name="availability" id="availability"    required="required">
                                <option value="" disabled selected>Select Availability</option>
                                <option value="Available">Available</option>
                                <option value="Looking For Change">Looking For Change</option>
                                <option value="Not Available">Not Available</option>
                            </select>                           
                            <input class="texth" type="text" id="phone" oninvalid="phonenumber(this);" oninput="phonenumber(this);"   required="required" name="phone" value="" placeholder="Your Mobile Number(Mandatory)" /> 

                            <select name="country" id="country" oninvalid="countryname(this);" oninput="countryname(this);"   required="required">
                                <?php if (isset($_POST['country'])) {
                                    ?>
                                    <option value="<?php echo $_POST['country']; ?>"><?php echo $_POST['country']; ?></option>
                                <?php } else { ?>
                                    <option value="">Country</option>
                                    <?php
                                }
                                $countrylist = "SELECT * FROM `countries` order by `countryName` ASC ";
                                $countrylist_result = mysql_query($countrylist);

                                while ($countrylist_result1 = mysql_fetch_array($countrylist_result)) {
                                    $country = $countrylist_result1['countryName'];
                                    ?>
                                    <option value="<?php echo $country; ?>"> <?php echo $country; ?></option>

                                <?php } ?>

                            </select></br>

                            <input type="checkbox" name="chk1" id="chk1" oninvalid="understood(this);" oninput="understood(this);"   required="required"style="    margin-left: 20px;"> I understood the process</br>

                            <input type="checkbox" name="chk" id="chk" oninvalid="conditions(this);" oninput="conditions(this);"   required="required"style="    margin-left: 20px;"> I accept (Terms and Conditions: <a href="terms.php" target="_blank">Click here</a>)</br></br>

                            <button style="margin-left: 20px;color:#fff" type="submit" class="btn btn-info  ">Register</button>
                        </form>
                        <?php
                    }
                    ?>
                    </br>



                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="terms">
                        <h4>Instructions to Register</h4>

                        <ul>
                            <li>Fill in the form provided and click on register</li>
                            <li>A verification mail will be sent to the e-mail ID you have provided</li>
                            <li>To activate your account, click on the verification link  in the mail </li>
                            <li>You will be redirected to your EMDB account page which bears your unique EMDB ID</li>
                            <li>For further details on how EMDB works please click <a  href="jobseeker.php">here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="footer1"> 
            <div class="content" style="margin: 0px 0px 0px; "> 
                <div class="container"> 		
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">		</div>
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">			
                        <ul class="menu2">
                            <li>
                                <a href="about.php" class="active">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="terms.php">
                                    Terms and Conditions
                                </a>
                            </li>
                            <li>
                                <a href="privacy.php">
                                    Privacy
                                </a>
                            </li>
                            <li>
                                <a href="contact.php">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>


                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">		</div>	
                </div>
            </div> 
            <div class="container">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                    <p style="text-align:center !important;">&copy; Employee Master Database 2016.</p>




                </div>
            </div> 
        </div>	
    </div>	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>