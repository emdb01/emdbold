<?php 
include('header.php');
$mid = $_SESSION['user_id'];
?>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        
        <!-- end navbar top -->
 <?php include('sidemenu.php'); ?>
        <!-- navbar side -->
        
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">My Account</h1>
                </div>
                <!--End Page Header -->
            </div>

             

  <link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />
            

            <div class="row">
			<div class="col-lg-12">
			<div class="changep">
			<button type="button" class="btn btn-info"><a href="passwordchange.php"><i class="fa fa-unlock-alt"></i> Change Password</a></button>
                                <button type="button" class="btn btn-danger"><a href="edit_profile_recruiter.php"><i class="fa fa-edit"></i> Edit </a></button>
								</div>
								</div>
								<?php
								$fname = $_SESSION['first'];
								$mname = $_SESSION['middle'];
								$lname = $_SESSION['last'];
								$email = $_SESSION['email'];
								$listdetails = "SELECT * FROM `recruiter` WHERE user_id='$mid'";
								$listdetails_query = mysql_query($listdetails);
								while ($listdetails_query_fetch = mysql_fetch_array($listdetails_query)) {
									$phone = $listdetails_query_fetch['phone'];
									$company = $listdetails_query_fetch['company'];
									$country = $listdetails_query_fetch['country'];
								}
?>
                <div class="col-lg-12">

<div class="panel panel-default">
                        <div class="panel-heading">
                            My Profile details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                     
                                    <tbody>
                                        <tr>
                                            <td>First Name</td>
                                            <td><?php echo $fname; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Middle Name</td>
                                            <td><?php echo @$mname; ?></td>
                                            
                                        </tr>
                                         <tr>
                                            <td>Last Name</td>
                                            <td><?php echo $lname; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Email Id</td>
                                            <td><?php echo $email; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Phone</td>
                                            <td><?php echo $phone; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Company</td>
                                            <td><?php echo $company; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Country</td>
                                            <td><?php echo $country; ?></td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--Area chart example -->
                    
                    <!--End area chart example -->
                    <!--Simple table example -->
                     
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
