<?php
include('header.php');
if ($_SESSION['role'] != 1 && $_SESSION['role'] != 4) {
    header("Location:index.php");
    die();
}
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
$Remail = $_SESSION['email'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
    $pname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
    $pname = $fname . " " . $mname . " " . $lname;
}
?>
<body>
    <!--  wrapper -->
    <div id="wrapper">
               <?php include('sidemenu.php'); ?>
        <!-- end navbar side -->
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
            function zipcode(textbox) {
                if ((document.checkval.zipdist.value != "") && (document.getElementById('zip').value == ''))
                {
                    textbox.setCustomValidity('Please Keyin your Zip code to define the preferred distance Range');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }

        </script>
                  <!--tooltip------>
        <?php include ("tooltip.html"); ?>
<!--tooltip------>
       
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Add User</h1>
                  <a href="userlist.php" style="float:right;"> <button type="submit" class="btn btn-info"><i class="fa fa-reply"></i> Back </button></a>
                </div>
                <!--End Page Header -->
				
            </div>

              
            

            <div class="row">
			<div class="col-lg-8">
							 <?php
        if (isset($_POST['fname'])) {
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            @$mname = $_POST['mname'];
            if ($mname == "") {
                $fulname = $fname . " " . $lname;
            } else {
                $fulname = $fname . " " . $mname . " " . $lname;
            }

            $peredit = $_POST['peredit'];
            $perdelete = $_POST['perdelete'];
            $percp = $_POST['percp'];
            $perex = $_POST['perex'];
            $perad = $_POST['perad'];
            $email = $_POST['email'];
            $vid = md5($email);
            $phone = $_POST['phone'];
            $availability = "Available";
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
            $password = substr(str_shuffle($chars), 0, 8);
            $pass = md5($password);
            $country = $_POST['country'];
            $checkexist_check = "";
            $checkexist = "select count(*)  as total from `recruiter`, `user` where recruiter.email='$email' OR user.email='$email' OR user.phone='$phone' OR recruiter.phone='$phone'";

//$checkexist = "SELECT * FROM `recruiter` WHERE email='$email' or phone='$phone'";
            $checkexist_query = mysql_query($checkexist);
            @$data = mysql_fetch_assoc($checkexist_query);
            $checkexist_check = $data['total'];


            if ($checkexist_check >= 1) {
                ?>
                <p class="notify_red">The email Address or Phone number already exists. Please use different ones.</p>
                <?php
            } else {
                $tm = time();
                $tempid = mt_rand(10, 99);
                $mid = $tempid . $tm;
//$mid='8108381437816481';
//    date_default_timezone_set('Asia/Kolkata');
                $createdDate = date('Y-m-d');
                $mid = ifidavail($mid);
                $adduser = "INSERT INTO `user` (`first`, `middle`, `last`, `member_id`, `status_time`, `email`,`pass`, `phone`, `country`, `role`, `status`, `verify`, `createdDate`) VALUES 
('$fname','$mname','$lname','$mid','$tm','$email','$pass','$phone','$country','4','1','1','$createdDate')";
                $adduser_result = mysql_query($adduser);
                if ($adduser_result) {
                    $formactive = 1;
                    $link = 'http://www.employeemasterdatabase.com/';
                    $msg = "Greetings! Your Employeemasterdatabase account has been created by <b> $pname </b> from <b> EMDB </b>.
   <div style='background-color: #eae9ee;'> 
<p>Below are your credentials:</p>

<p>Username: $email</p>
<p>Password: $password</p>
   </div> 
<p>Click on the link below to login as a user</p>
    
<p> $link </p>
";


                    $sendmessagetouser_invite = sendCredentialsToUser($email, $msg, $link, $Remail, $fname);
                    $last_id = mysql_insert_id();
                    if ($last_id > 0) {
                        $parentId = $_SESSION['user_id'];
                        $permis = $perad . ',' . $peredit . ',' . $perdelete . ',' . $percp . ',' . $perex;
                        $permissions = trim($permis, ",");
                        $permissions = str_replace(",,", ",", $permissions);
                        $permissions = str_replace(",,", ",", $permissions);
                        $addper = "INSERT INTO `permissions`(`user_id`, `parentId`,`permissions`) VALUES ('$last_id','$parentId','$permissions')";
                        $adduser_per = mysql_query($addper);
                    }
                    ?>
                    <p class="notify_green">Thank you for Creating with Employee Master Database.</p>
                    <p class="notify_text">An email has been sent to the created email Id.</p>

                    <?php
                }
            }
        }
        ?>
                    <!--tooltip------>
        <link rel="stylesheet" type="text/css" href="js/tooltipster.css" />
        <script type="text/javascript" src="//code.jquery.com/jquery-1.7.0.min.js"></script>
        <script type="text/javascript" src="js/jquery.tooltipster.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.tooltip').tooltipster();
            });
        </script>
        <!--tooltip------>
          
			 <div class="table-responsive" style="clear:both;margin-top:0px;">
			 <div class="panel panel-default">
                        <div class="panel-heading">
                            Add details
                         </div>
						
				<form role="form" action="subuser.php" name="checkval" id="checkval"  method="post"  onsubmit="return(validate());">
                                <table class="table table-hover tablebd">
                              
									   <tbody>
                                      <tr>
                                             
                                            <td  style="width:20%;"><label>First Name</label></td>
											<td style="width:60%;">
											<div class="form-group">
                                             
                                            <input class="form-control" id="fname" oninvalid="fullname(this);" oninput="fullname(this);"   required="required" name="fname" value="<?php echo @$_POST['fname']; ?>" placeholder="First Name (Mandatory)" >
                                        </div></td></tr>
                                              
                                         <tr>
                                             
                                            <td><label>Middle Name</label></td>
											<td>
											<div class="form-group">
                                             
                                            <input class="form-control" id="mname" name="mname" value="<?php echo @$_POST['mname']; ?>" placeholder="Middle Name" >
                                        </div></td></tr>
										 <tr>
                                             
                                            <td><label>Last Name</label></td>
											<td>
											<div class="form-group">
                                              <input class="form-control" type="hidden" name="mid" value="<?php echo $mid; ?>">
                                            <input class="form-control" id="lname" oninvalid="lastname(this);" oninput="lastname(this);"   required="required" name="lname" value="<?php echo @$_POST['lname']; ?>" placeholder="Last Name  (Mandatory)">
                                        </div></td></tr>
										<tr>
                                             
                                            <td><label>Email Id</label></td>
											<td>
											<div class="form-group">
                                             
                                            <input class="form-control" id="email"  style="float:left;"  oninvalid="emailid(this);"  oninput="emailid(this);"   required="required" name="email" value="<?php echo @$_POST['email']; ?>" placeholder="Email Id (Mandatory)" />
                                        </div>
										</td>
										<td>
										
										</td>
										
										</tr>
										
											<tr>
                                             
                                            <td><label>Phone</label></td>
											<td>
											<div class="form-group">
                                             
                                            <input class="form-control" id="phone" style="float:left;" oninvalid="phonenumber(this);" oninput="phonenumber(this);"   required="required" name="phone" value="<?php echo @$_POST['phone']; ?>" placeholder="Your Mobile Number(Mandatory)" />
                                        </div></td></tr>
										<tr>
                                             <td><label>Country</label></td><td><div class="form-group">
                                             
                                            <select  class="form-control" name="country" id="country" oninvalid="countryname(this);" oninput="countryname(this);"   required="required">
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

            </select>

                                        </div></td>
                                             
                                            
                                        </tr>
										<tr>
                                            <td><label>Permisions</label></td>
                                            <td>
										
                  
                  
                        <input type="checkbox" name="perad" value="1"  class="tooltip1" title="Create Users" >Create 
                    

                        <input type="checkbox" name="peredit" value="2" class="tooltip1" title="Edit Jobseekers/Recruiters">Edit 
                    
                        <input type="checkbox" name="perdelete" value="3" class="tooltip1" title="Delete Jobseekers/Recruiters">Delete 
                   
                        <input type="checkbox" name="percp"  value="4" class="tooltip1" title="Change Password Jobseekers/Recruiters">Change Password
                   
                        <input type="checkbox" name="perex" value="5" class="tooltip1" title="Export Jobseekers/Recruiters">Export 
                
											
											
											</td>
                                            
                                        </tr>
										<tr>
                                             <td><button type="submit" class="btn btn-info">Update Profile</button></td>
                                             
                                            
                                        </tr>
										 </tbody>
									 
                                    
								
								</form>
								
                            </div>
                            </div>
								</div>
     

            </div>

            


         


        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->


<div class="clear"></div>
</body>

</html>
