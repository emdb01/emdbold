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
$mid = $_SESSION['member_id'];
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

            

            <div class="row">
			<div class="col-lg-12">
			<div class="changep">
	
								</div>
								</div>
							<?php
$email = $_SESSION['email'];
$id= $_SESSION['user_id'];
$listdetails = "SELECT * FROM `user` WHERE member_id='$mid'";
$listdetails_query = mysql_query($listdetails);
$listdetails_query_fetch = mysql_fetch_assoc($listdetails_query);
    $phone = $listdetails_query_fetch['phone'];
    @$job = $listdetails_query_fetch['job'];
    @$salary = $listdetails_query_fetch['salary'];
    @$zip = $listdetails_query_fetch['zip'];
    @$notify = $listdetails_query_fetch['notify_time'];
    $country = $listdetails_query_fetch['country'];
    @$distance = $listdetails_query_fetch['distance'];
    @$technology = $listdetails_query_fetch['technology'];
    @$flexible = $listdetails_query_fetch['flexible'];

?>
<div class="col-lg-12">
			
			
			<div class="changep">
			 
			   <a href="editprofile.php?eid=<?php echo $id; ?>"> <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Edit </button></a>
			
			<a href="passchange.php?eid=<?php echo $id; ?>"><button type="button" class="btn btn-info"><i class="fa fa-unlock-alt"></i> Change Password</button></a>
                
								</div>
								</div>
                <div class="col-lg-12">

<div class="panel panel-default">
                        <div class="panel-heading">
                            User Details
				
                        </div>
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
                                            <td>Country</td>
                                            <td><?php echo $listdetails_query_fetch['country']; ?></td>
                                            
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

            


         
 <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

  

</body>

</html>
