<!DOCTYPE html>
<html> 
    <head> 
        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />   
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <title>Employee Master Database</title>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">  
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
            <!-- Start header -->			<div id="tope" style="background: url(images/banner33.jpg) no-repeat center;
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
                                                <li><a href="jobseekerregister.php" class="one">REGISTER  </a>

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

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <center><h1>Job Seeker</h1></center>
                    <p style="font-size: 16px;
                       line-height: 29px;
                       text-align: justify;"> 
                        Ever wondered why you are not getting a response from recruiters despite having a good profile? The reason could be the job market which is being more competitive than ever. Recruiters get access to numerous profiles through various sources including job portals. When screening thousands of profiles for different openings, there is every possibility that recruiter might skip your profile. Using EMDB helps you avoid such situations. </p>

                </div> 


                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 how">
                    <center><h2 style="font-size:30px;padding:0px 30px 0px;line-height:70px">How it works</h2></center>




                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h2 class="titlesa">Step 1</h2>
                        <img src="images/img3.png" class="imgd" width="100%">
                        <p>Register & get unique ID</p> 

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h2 class="titlesa">Step 2 </h2>
                        <img src="images/img2.jpg" class="imgd" width="100%">
                        <p>Mention EMDB ID on your resume & upload it to job portal </p>

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h2 class="titlesa">Step 3  </h2>
                        <img src="images/im.png" class="imgd" width="100%">
                        <p>Confirm your availability status to the recuiters</p>

                    </div>
                </div>
            </div>
        </div>

        <div class="content bene"> 
            <div class="container">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <center><h2 style="font-size:30px;padding:30px;line-height:70px">Benefits</h2></center>



                    <center><img class="benj" src="images/ben2.png"></center>













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