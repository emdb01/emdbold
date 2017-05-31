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
$id=$_GET['viewid'];
$listdetails = "SELECT * FROM `recruiter` WHERE user_id='$id'";
$listdetails_query=mysql_query($listdetails);
$ifexistuser=mysql_num_rows($listdetails_query);
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
    $deleteuser = "DELETE FROM `recruiter` WHERE user_id='$deleteid'";
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
while($listdetails_query_fetch=mysql_fetch_array($listdetails_query))
{

$fname=$listdetails_query_fetch['first'];
@$mname=$listdetails_query_fetch['middle'];
$lname=$listdetails_query_fetch['last'];
$email=$listdetails_query_fetch['email'];
$phone=$listdetails_query_fetch['phone'];
$company=$listdetails_query_fetch['company'];
$country=$listdetails_query_fetch['country'];
$role=$listdetails_query_fetch['role'];
}

if($mname==""){
$fulname=$fname." ".$lname;

} else {
$fulname=$fname." ".$mname." ".$lname;
}

?>
				
<div class="col-lg-12">
			
			
			<div class="changep">
                            <a href="recruiterlist.php" > <button type="submit" class="btn btn-info"><i class="fa fa-reply"></i> Back </button></a>
			   <?php if ($_SESSION['role'] == 1) { ?>
			   <a href="edit_recruiter_admin.php?eid=<?php echo $id; ?>"> <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Edit </button></a>
			   <a href="view_recruiter_admin.php?viewid=<?php echo $id; ?>&did=<?php echo $id; ?>""> <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Delete </button></a>
			<a href="passwordchange_user.php?eid=<?php echo $id; ?>"><button type="button" class="btn btn-info"><i class="fa fa-unlock-alt"></i> Change Password</button></a>
                   <?php
            } else if ($_SESSION['role'] == 4) {
                $userid = $_SESSION['user_id'];
                $row = mysql_fetch_assoc(mysql_query($sqlComp = "SELECT * FROM `permissions` where `user_id`='$userid' "));
                $findme = '2';
                $pos = strpos($row['permissions'], $findme);
                if ($pos !== false) {
                    ?>
                  <a href="edit_recruiter_admin.php?eid=<?php echo $id; ?>"> <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Edit </button></a>
                <?php
                }
                $findme = '3';
                $pos = strpos($row['permissions'], $findme);
                if ($pos !== false) {
                    ?>
                   <a href="view_recruiter_admin.php?viewid=<?php echo $id; ?>&did=<?php echo $id; ?>""> <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Delete </button></a>
                <?php
                }
                $findme = '4';
                $pos = strpos($row['permissions'], $findme);
                if ($pos !== false) {
                    ?>
                  <a href="passwordchange_recruiter.php?eid=<?php echo $id; ?>"><button type="button" class="btn btn-info"><i class="fa fa-unlock-alt"></i> Change Password</button></a>
                <?php } ?>


    <?php } ?>        
								</div>
								</div>
                <div class="col-lg-12">

<div class="panel panel-default">
                        <div class="panel-heading">
                            Recruiter Details
				
                        </div>
                       
						<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                     
                                    <tbody>
                                        
									
                                        <tr>
                                            <td>Full Name</td>
                                            <td><?php echo $fulname; ?></td>
                                            
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
                                            <td>Country</td>
                                            <td><?php echo $country; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Company</td>
                                            <td><?php echo $company; ?></td>
                                            
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

            

<?php } ?>
         


        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

   <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>

</body>

</html>
