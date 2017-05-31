<?php include("config/config.php");error_reporting(0); ?>
<!DOCTYPE html>
<html> 
    <head> 
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-75985599-1', 'auto');
            ga('send', 'pageview');

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
                                            <form action="index.php" name="checkavail" id="checkavail"  method="post"  >
                                            <input type="text" class="form-control input-sm" maxlength="64"  oninvalid="searchid(this);" oninput="searchid(this);"   required="required" name="search" Value="<?php echo @$_POST['search']; ?>" placeholder="EMDB" />
                                            <button type="submit" class="btn btnh btn-primary btn-sm">Check</button>
                                            </form>
 <p>
                                <?php
                                if (isset($_POST['search'])) {
                                    $mid = $_POST['search'];
                                    $mid = str_replace("EMDB", "", $mid);
                                    $availcheck = "SELECT * FROM `user` where `member_id`='$mid'";
                                    $availcheck_result = mysql_query($availcheck);
                                    $availcheck_check = mysql_num_rows($availcheck_result);
                                    if ($availcheck_check != 1) {
                                        ?>
                                    <b style="color:red;">Invalid Entry</b>
                                    <?php
                                } else {
                                    while ($availcheck_result1 = mysql_fetch_array($availcheck_result)) {
                                        $available = $availcheck_result1['availability'];
                                        ?>
                                        <b style="color:blue;"><?php echo $available; ?></b>

        <?php }
    }
} ?>

                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"  style="margin-top: 24px;">
                                        <div class="loginm"><a href="jobseeker.php" style="color:#fff"><button type="button" class="btn btn-primary  col-lg-4 col-md-4 col-sm-3 col-xs-3">Job Seeker</button></a>
                                            <a href="recruiter.php" style="color:#fff"> <button type="button" class="btn btn-primary  col-lg-4 col-md-4 col-sm-4 col-xs-4">Recruiter</button></a>
                                            <div class="reg  col-lg-3 col-md-3 col-sm-3 col-xs-3"><nav><ul class="nav navbar-nav">
  
  <li class="dropdown">
  <a class="dropdown-toggle one" data-toggle="dropdown" href="#.html" style="color:">REGISTER<span class="caret"></span></a>
      <ul class="dropdown-menu">
          <li><a href="jobseekerregister.html"><i class="fa fa-caret-right"></i> Job Seeker</a></li>
          <li><a href="recruiterregister.html"><i class="fa fa-caret-right"></i> Recruiter</a></li> 
        </ul>
      </li>
      
         
    </ul></nav></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </header>



                    <div class="container" style="    margin-bottom: 40px;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                            <h2 class="h2title" style="color:#FFFFFF">Employee Master Database</h2>	



                            <form class="form-signin"  action="logindet.php" name="checkval" id="checkval"  method="post" >              
                                <h2 class="form-signin-heading" style="color: #015498;
                                    font-size: 25px;
                                    text-align: center;"> Login</h2>
                                <input type="text" class="form-control" name="email" placeholder="Email Address" required="" autofocus="" /></br>
                                <input type="password" class="form-control" name="pass" placeholder="Password" required=""/>      
                                <label class="checkbox">
                                    <a href="forgot.php?fp=0">FORGOT PASSWORD</a>
                                </label>
                                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button> 
                                <?php
                                if($_GET['err']==3){
                                 echo '<b style="color:red;"> Incorrect Credentials</b>';   
                                }
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