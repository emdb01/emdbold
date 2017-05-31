<?php
include("config/config.php");
error_reporting(0);
?>
<!DOCTYPE html>
<html> 
    <head> 

        <script type="text/javascript">


            function validate()
            {


                if (document.checkval.email.value == "")
                {
                    alert("Please keyin the Email");
                    document.checkval.email.focus();
                    return false;
                }
                if (document.checkval.email.value != "") {
                    var x = document.checkval.email.value;
                    var atpos = x.indexOf("@");
                    var dotpos = x.lastIndexOf(".");
                    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
                        alert("Not a valid e-mail address");
                        document.checkval.email.focus();
                        return false;
                    }
                }

                return(true);
            }

        </script>
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />   
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <title>Employee Master Database</title>  
        <link rel="stylesheet" type="text/css" href="css/ui/style.css" />
        <link rel="icon"  type="image/ico" href="images/favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">  
        <link rel='stylesheet' id='bootstrap.min-css'  href='css/ui/bootstrap.min.css' type='text/css' media='all' />
        <link rel='stylesheet' href='css/font-awesome.css' type='text/css' media='all' />  
        <link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' media='all' />   
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
                .btn { 
                    padding: 6px 2px;
                }

                .menu li { 
                    margin: 10px 10px 0px; 
                }
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <!-- Start header -->			<div id="tope">            
                <!-- Start header -->			<div class="bg1" style="    background-image: url(images/hh.jpg);">  

                    <div id="">
                    </div>			
                </div>			
                <!-- Start header -->			<div class="imgbg">            
                    <header>               
                        <div class="main-header1">
                            <div class="container">                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                    <div class="logo col-lg-3 col-md-3 col-sm-12 col-xs-12"> 
                                        <a href="index.php"><img src="images/logo.png" style="border:none;" ></a>

                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">  </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">  
                                        <div class="search">
                                            <input type="text" class="form-control input-sm" maxlength="64" placeholder="Search with EMDB ID" />
                                            <button type="submit" class="btn btnh btn-primary btn-sm">Check</button>


                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"  style="margin-top: 24px;">
                                        <div class="loginm"><a href="jobseeker.php" style="color:#fff"><button type="button" class="btn btn-primary  col-lg-4 col-md-4 col-sm-3 col-xs-3">Job Seeker</button></a>
                                            <a href="recruiter.php" style="color:#fff"> <button type="button" class="btn btn-primary  col-lg-4 col-md-4 col-sm-4 col-xs-4">Recruiter</button></a>
                                            <div class="reg  col-lg-3 col-md-3 col-sm-3 col-xs-3"><ul class="nav navbar-nav">

                                                    <li class="dropdown">
                                                        <a class="dropdown-toggle one" data-toggle="dropdown" href="recruiter.php" style="color:">REGISTER<span class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="jobseekerregister.php"><i class="fa fa-caret-right"></i> Job Seeker</a></li>
                                                            <li><a href="recruiterregister.php"><i class="fa fa-caret-right"></i> Recruiter</a></li> 
                                                        </ul>
                                                    </li>


                                                </ul></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </header>



                    <div class="container" style="    margin-bottom: 40px;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                            <h2 class="h2title" style="color:#FFFFFF">Employee Master Database</h2>	

                            <?php
                            $formactive = 0;
                            if (isset($_POST['email'])) {

                                $email = $_POST['email'];
                                $vid = md5($email);
                                $checkexist_check = "";
                                $checkexist = "SELECT * FROM `user` WHERE email='$email'";
                                $checkexist_query = mysql_query($checkexist);
                                $checkexist_check = mysql_num_rows($checkexist_query);


                                if ($checkexist_check < 1) {
                                    $checkexist = "SELECT * FROM `recruiter` WHERE email='$email'";
                                    $checkexist_query = mysql_query($checkexist);
                                    $checkexist_check = mysql_num_rows($checkexist_query);
                                    if ($checkexist_check < 1) {
                                        ?>

                                        <?php
                                    } else {
                                        while ($listdetails_query_fetch = mysql_fetch_array($checkexist_query)) {
                                            $fname = $listdetails_query_fetch['first'];
                                            $mname = $listdetails_query_fetch['middle'];
                                            $lname = $listdetails_query_fetch['last'];
                                        }
                                        if ($mname == "") {
                                            $fulname = $fname . " " . $lname;
                                        } else {
                                            $fulname = $fname . " " . $mname . " " . $lname;
                                        }
                                        $formactive = 1;
                                        $link = 'http://employeemasterdatabase.com/forgotpassword.php?fp=0&vid=' . $vid;
                                        $msg = "Please click on the below link to reset your password";
                                        $resu = mailfun($fulname, $email, $msg, $link);
                                        ?>



                                        <?php
                                    }
                                } else {


                                    while ($listdetails_query_fetch = mysql_fetch_array($checkexist_query)) {
                                        $fname = $listdetails_query_fetch['first'];
                                        $mname = $listdetails_query_fetch['middle'];
                                        $lname = $listdetails_query_fetch['last'];
                                    }
                                    if ($mname == "") {
                                        $fulname = $fname . " " . $lname;
                                    } else {
                                        $fulname = $fname . " " . $mname . " " . $lname;
                                    }
                                    $formactive = 1;
//$link='http://employeeavailability.com/forgotpassword.php?vid='.$vid;
                                    $link = 'https://www.employeemasterdatabase.com/forgotpassword.php?fp=0&vid=' . $vid;
                                    $msg = "Please click on the below link to reset your password";
                                    $resu = mailfun($fulname, $email, $msg, $link);
                                    ?>

                                    <?php
                                }
                            }
                            ?>

                            <form class="form-signin"  action="forgot.php?fp=1" name="checkval" id="checkval"  method="post"  onsubmit="return(validate());">     
                                <?php
                                if ($_GET['fp'] == 1) {
                                    if ($checkexist_check < 1) {
                                        echo "<b style='color:red;'>The email Address is not registered with us. Try a different one.</b>";
                                        echo '<label class="checkbox">
                                    <a href="index.php">Back</a>
                                </label>';
                                    } else if ($resu) {
                                        echo "<b style='color:green;'>An email has been sent to the registered email Id. Please verify your email to reset your password.</b>";
                                        echo '<label class="checkbox">
                                    <a href="index.php">Back</a>
                                </label>';
                                    } else {
                                        echo "<b style='color:green;'>An email has been sent to the registered email Id. Please verify your email to reset your password.</b>";
                                        echo '<label class="checkbox">
                                    <a href="index.php">Back</a>
                                </label>';
                                    }
                                }
                                ?>		

                                <?php if ($formactive != 1 && $_GET['fp'] == 0) {
                                    ?>				
                                    <h2 class="form-signin-heading" style="color: #015498;
                                        font-size: 25px;
                                        text-align: center;"> Forgot Password</h2>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo @$_POST['email']; ?>" placeholder="Email Address" required="" autofocus="" /></br>

                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>   
                                <?php }
                                ?>				
                            </form>




                        </div>
                    </div>
                    <section>
                        <div class="container foot">
                            <div class="row2 container">
                                <div class="foot1">
                                    <div class="fg">
                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" id="nav">			
                                            <ul class="menu">
                                                <li>
                                                    <a href="about.php">
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
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">


                                            <div class="emdb"> &copy; Employee Master Database 2016.
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>	





    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>