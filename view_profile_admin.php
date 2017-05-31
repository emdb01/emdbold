<?php
ob_start();
include('header.php');
if ($_SESSION['role'] != 1 && $_SESSION['role'] != 4) {
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
$recruiter_id = $_SESSION['user_id'];
?>
<!--tooltip------>
        <?php include ("tooltip.html"); ?>
<!--tooltip------>
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
                    <h1 class="page-header">View</h1>
                </div>
                <!--End Page Header -->
            </div>

         <?php
		
if (isset($_GET['did'])) {
    $deleteid = $_GET['did'];
    $deleteuser = "DELETE FROM `user` WHERE user_id='$deleteid'";
    $deleteuser_query = mysql_query($deleteuser);
    if(@$role ==4){ 
    $deleteuser = "DELETE FROM `permissions` WHERE user_id='$deleteid'";
    $deleteuser_query = mysql_query($deleteuser);
    }
    
    ?>
           <p class="notify_green">The Profile has been deleted</p>
  

    <?php
} else {?>    


            

            <div class="row">
			<div class="col-lg-12">
			<div class="changep">
	
								</div>
								</div>
								
								<?php
			$id = $_GET['id'];
			$listdetails = "SELECT * FROM `user` WHERE user_id='$id'";
			$listdetails_query = mysql_query($listdetails);
			$listdetails_query_fetch = mysql_fetch_assoc($listdetails_query);
			$role=$listdetails_query_fetch['role'];
  
?>
<div class="col-lg-12">
			
			
			<div class="changep">
<!--                            <a href="userlist.php"> <button type="submit" class="btn btn-info"><i class="fa fa-reply"></i> Back </button></a>-->
			   <?php if ($_SESSION['role'] == 1) { ?>
			   <a href="edit_profile_admin.php?eid=<?php echo $id; ?>"> <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Edit </button></a>
			   <a href="view_profile_admin.php?viewid=<?php echo $id; ?>&did=<?php echo $id; ?>""> <button type="submit" class="btn btn-info"><i class="fa fa-times"></i> Delete </button></a>
			<a href="passwordchange_user.php?eid=<?php echo $id; ?>"><button type="button" class="btn btn-info"><i class="fa fa-unlock-alt"></i> Change Password</button></a>
                   <?php
            } else if ($_SESSION['role'] == 4) {
                $userid = $_SESSION['user_id'];
                $row = mysql_fetch_assoc(mysql_query($sqlComp = "SELECT * FROM `permissions` where `user_id`='$userid' "));
                $findme = '2';
                $pos = strpos($row['permissions'], $findme);
                if ($pos !== false) {
                    ?>
                  <a href="edit_profile_admin.php?eid=<?php echo $id; ?>"> <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Edit </button></a>
                <?php
                }
                $findme = '3';
                $pos = strpos($row['permissions'], $findme);
                if ($pos !== false) {
                    ?>
                   <a href="view_profile_admin.php?viewid=<?php echo $id; ?>&did=<?php echo $id; ?>""> <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Delete </button></a>
                <?php
                }
                $findme = '4';
                $pos = strpos($row['permissions'], $findme);
                if ($pos !== false) {
                    ?>
                  <a href="passwordchange_user.php?eid=<?php echo $id; ?>"><button type="button" class="btn btn-info"><i class="fa fa-unlock-alt"></i> Change Password</button></a>
                <?php } ?>
                  


    <?php } ?>        
								</div>
								</div>
                <div class="col-lg-12">

<div class="panel panel-default">
                        <div class="panel-heading">
                            User Details
				
                        </div>
                        <?php if($role ==4){ 
						?>
						<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                     
                                    <tbody>
                                        
									
                                        <tr>
                                            <td>First Name</td>
                                            <td><?php echo $listdetails_query_fetch['first']; ?></td>
                                            
                                        </tr>
                                         <tr>
                                            <td>Middle Name</td>
                                            <td><?php echo $listdetails_query_fetch['middle']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Last Name</td>
                                            <td><?php echo $listdetails_query_fetch['last']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Email Id</td>
                                            <td><?php echo $listdetails_query_fetch['email']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Phone</td>
                                            <td><?php echo $listdetails_query_fetch['phone']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Permisions</td>
                                            <td>
											<?php
                    $row = mysql_fetch_assoc(mysql_query($sqlComp = "SELECT * FROM `permissions` where `user_id`='$id' "));
                    $findme1 = '1';
                    $findme2 = '2';
                    $findme3 = '3';
                    $findme4 = '4';
                    $findme5 = '5';
                    $pos1 = strpos($row['permissions'], $findme1);
                    $pos2 = strpos($row['permissions'], $findme2);
                    $pos3 = strpos($row['permissions'], $findme3);
                    $pos4 = strpos($row['permissions'], $findme4);
                    $pos5 = strpos($row['permissions'], $findme5);
                    ?>
                    <?php if ($pos1 !== false) { ?>
                        <input type="checkbox" name="perad" checked value="1"   class="tooltip1" title="Create Users (sub admins)">Create 
                    <?php } else { ?>
                        <input type="checkbox" name="perad" value="1"  class="tooltip1" title="Create Users" >Create 
                    <?php } ?>

                    <?php if ($pos2 !== false) { ?>
                      <input type="checkbox" name="peredit" checked value="2"   class="tooltip1" title="Edit Jobseekers/Recruiters">Edit 
                    <?php } else { ?>
                        <input type="checkbox" name="peredit" value="2" class="tooltip1" title="Edit Jobseekers/Recruiters">Edit 
                    <?php } ?>
                    <?php if ($pos3 !== false) { ?>
                        <input type="checkbox" name="perdelete" checked value="3" class="tooltip1" title="Delete Jobseekers/Recruiters">Delete 
                    <?php } else { ?>
                        <input type="checkbox" name="perdelete" value="3" class="tooltip1" title="Delete Jobseekers/Recruiters">Delete 
                    <?php } ?>
                    <?php if ($pos4 !== false) { ?>
                        <input type="checkbox" name="percp" checked  value="4" class="tooltip1" title="Change Password Jobseekers/Recruiters">Change Password
                    <?php } else { ?>
                        <input type="checkbox" name="percp"  value="4" class="tooltip1" title="Change Password Jobseekers/Recruiters">Change Password
                    <?php } ?>

                    <?php if ($pos5 !== false) { ?>
                        <input type="checkbox" name="perex" checked value="5" class="tooltip1" title="Export Jobseekers/Recruiters">Export 
                    <?php } else { ?>
                        <input type="checkbox" name="perex" value="5" class="tooltip1" title="Export Jobseekers/Recruiters">Export 
                    <?php } ?>
											
											
											</td>
                                            
                                        </tr>
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php }else{ ?>
						
						<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                     
                                    <tbody>
                                        <tr>
                                            <td>EMDB ID</td>
                                            <td><b style="color:blue;"><?php echo "EMDB" . $listdetails_query_fetch['member_id']; ?></b>
											
											
											</td>
                                            
                                        </tr>
									
										
                                        <tr>
                                            <td>First Name</td>
                                            <td><?php echo $listdetails_query_fetch['first']; ?></td>
                                            
                                        </tr>
                                         <tr>
                                            <td>Middle Name</td>
                                            <td><?php echo $listdetails_query_fetch['middle']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Last Name</td>
                                            <td><?php echo $listdetails_query_fetch['last']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Email Id</td>
                                            <td><?php echo $listdetails_query_fetch['email']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Phone</td>
                                            <td><?php echo $listdetails_query_fetch['phone']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Availability</td>
                                            <td><?php echo $listdetails_query_fetch['availability']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Job</td>
                                            <td><?php echo $listdetails_query_fetch['job']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Technology</td>
                                            <td><?php echo $listdetails_query_fetch['technology']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Salary</td>
                                            <td><?php echo $listdetails_query_fetch['salary']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Skills</td>
                                            <td><?php echo $listdetails_query_fetch['skills']; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Experience</td>
                                            <td><?php echo $listdetails_query_fetch['experience']; ?></td>
                                            
                                        </tr>
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
						      <?php } ?>
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

            

<?php } ?>
         


        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
 <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
  

</body>

</html>
