<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
ob_start();
include("config/config.php");
$_SESSION['idolize'] = $_GET['idolize'];
if (isset($_SESSION['user_id'])) {
 header("Location:documentation.php");
}
?>
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
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-8228787275588354",
    enable_page_level_ads: true
  });
</script>
        <title>EMDB | Employee Master Database | employeemasterdatabase </title>
        <meta name="description" content="EMDB(Employee master database)  is an innovative portal that aims at addressing the needs of recruitment processes. This portal leverages technology to help the right recruiter connect to right job seeker." />
        <meta name="keywords" content="EMDB, employeemasterdatabase, employee master database" />
        <meta name="google-site-verification" content="qIwt5V7-A0L4gOQ8Xxo-cjQWChZ3S1Q0wH5MQE_u7kE" /> 
        <meta name="Referrer" content="origin">
        <link rel="stylesheet" type="text/css" href="css/ui/style.css" />
        <link rel="icon"  type="image/ico" href="images/favicon.ico">

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
                                        <div class="search" style="margin-top: 31px;">
                                            <form action="index.php" name="checkavail" id="checkavail"  method="post"  >
                                                <input type="text" class="form-control input-sm" maxlength="64"  oninvalid="searchid(this);" oninput="searchid(this);"   required="required" name="search" Value="<?php echo @$_POST['search']; ?>" placeholder="EMDB ID" />
                                                <button type="submit" class="btn btnh btn-primary btn-sm">Check</button>
                                            </form>
                                            
                                        </div>
                                        <p style="margin-left:15px;">
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
														$availchecks = "SELECT * FROM `search` where `emdbid`='$mid'";
                                                        $availcheck_results = mysql_query($availchecks);
                                                        $availcheck_checks = mysql_num_rows($availcheck_results);
                                                        if ($availcheck_checks == 0) {
                                                            $date = date("Y-m-d");
                                                            $sql = "INSERT INTO search (emdbid,searchPerson, createdDate) VALUES ('$mid', 'No name', '$date')";
                                                            $insertqeury = mysql_query($sql);
                                                        }
                                                        while ($availcheck_result1 = mysql_fetch_array($availcheck_result)) {
                                                            $available = $availcheck_result1['availability'];
                                                            ?>
                                                            <b style="color:blue;"><?php echo $available; ?></b>

                                                        <?php
                                                        }
                                                    }
                                                }
                                                ?>

                                            </p>
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
                                if ($_GET['err'] == 3) {
                                    echo '<b style="color:red;"> Incorrect Credentials</b>';
                                }else if ($_GET['err'] == 5) {
                                    echo '<b style="color:red;"> Please signup with corporate email id</b>';
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

 
</body>
</html>