<?php
include('header.php');
if (!isset($_SESSION['first'])) {
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
?>
<body>
  <script type="text/javascript">



                 function opassword(textbox) {
                    if (document.getElementById('passo').value == '')
                    {
                        textbox.setCustomValidity('Please keyin the Current Password!');
                        return false;
                    } else {
                        textbox.setCustomValidity('');
                    }
                    return true;
                }
                function password(textbox) {
                    if (document.getElementById('pass').value == '')
                    {
                        textbox.setCustomValidity('Please keyin the New Password!');
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
                        textbox.setCustomValidity('Please keyin the Confirm Password!');
                        return false;
                    } else if (document.getElementById('pass').value != document.getElementById('passc').value) {
                        textbox.setCustomValidity('Please keyin the Re Type Password correctly!');
                        return false;
                    } else {
                        textbox.setCustomValidity('');
                    }
                    return true;
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
                    <h1 class="page-header">Change Password</h1>
                </div>
                <!--End Page Header -->
            </div>

              
            

            <div class="row">
			<div class="col-lg-12">
			 
								</div>
                <div class="col-lg-5">


				
				
				
				
				
				
				<div class="panel panel-default">
                        <div class="panel-heading">
                            Password Verification
                        </div>
						<?php 
						$formactive = 0;
$userrole = $_SESSION['role'];
if (isset($_POST['passo'])) {


    $oldone = $_POST['passo'];
    $pass = $_POST['pass'];
    $insertpass = md5($pass);
    $oldmd5 = md5($oldone);


    if ($userrole == '2') {
        $mid = $_SESSION['member_id'];
        $checkexist = "SELECT * FROM `user` WHERE member_id='$mid' and pass='$oldmd5'";
    } else {
        $uid = $_SESSION['user_id'];
        $checkexist = "SELECT * FROM `recruiter` WHERE user_id='$uid' and pass='$oldmd5'";
    }
    $checkexist_query = mysql_query($checkexist);
    $checkexist_check = mysql_num_rows($checkexist_query);

    if ($checkexist_check == '1') {
        if ($userrole == '2') {
            $userupdate = "UPDATE `user` SET `pass` = '$insertpass' where member_id='$mid'";
        } else {
            $userupdate = "UPDATE `recruiter` SET `pass` = '$insertpass' where user_id='$uid'";
        }

        $userupdate_result = mysql_query($userupdate);
        $formactive = 1;
        ?>

                <p class="notify_text">The password has been successfully changed.</p>

                <?php
            } else {
                ?>

                <p class="notify_text">The old password does not match with yours</p>

                <?php
                $formactive = 0;
            }
        }
  if ($formactive != 1) {
						?>
				<form role="form" style="padding:20px;" action="" name="checkval" id="checkval"  method="post" >
                                         
                                        <div class="form-group">
                                           
                                            <input type="password"  class="form-control" id="passo" oninvalid="opassword(this);" oninput="opassword(this);"   required="required" name="passo" value="" placeholder="Enter your current password" >
                                        </div>
                                         <div class="form-group">
                                           
                                            <input type="password"  class="form-control" id="pass" oninvalid="password(this);" oninput="password(this);"   required="required" name="pass" value="" placeholder="Enter a new password  minimum length 8 ">
                                        </div>
                                        <div class="form-group">
                                         
                                            <input type="password" class="form-control" id="passc" oninvalid="cpassword(this);" oninput="cpassword(this);"   required="required" name="passc" value="" placeholder="Re type the password">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary" id="register">Submit</button>
                                       <!-- <button type="reset" class="btn btn-success">Reset</button>-->
                                    </form>
				
				
  <?php 	} ?>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				

                    <!--Area chart example -->
                    
                    <!--End area chart example -->
                    <!--Simple table example -->
                     
                </div>
                </div>
<div class="col-lg-4">
                    <!-- Donut Example-->
                     
                    <!--End Donut Example-->
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
