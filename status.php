<?php 
include('header.php');
error_reporting(0);

if (!isset($_SESSION['member_id'])) {
    header("Location:index.php");
    die();
}
$resumeexist = "";
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
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
          <?php include('sidemenu.php'); ?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">My Status</h1>
                </div>
                <!--End Page Header -->
            </div>

             


            

            <div class="row">
			<div class="col-lg-12">
			<div class="panel-body">
                                <center><h4>YOUR UNIQUE EMDB ID   <b>"<span style="color:blue"><?php echo 'EMDB' . $mid; ?></span>"</b></h4></center>
                            </div>
							<div class="panel-body">
                            <div class="alert alert-info">
                                Note : Please make sure keep your unique 16-digit alphanumeric EMDB number on your resume before applying for jobs, which helps recruiters to see your job availability instantly. Whenever your job availability status changes please update the same in employeemasterdatabase.com
                            </div>
                            </div>
						<?php 
						$tmid = $_SESSION['member_id'];
                
						$selectavailability = "SELECT * FROM `user` WHERE member_id='$tmid'";
						$selectavailability_query = mysql_query($selectavailability);
						$selectavailability_query_fetch = mysql_fetch_assoc($selectavailability_query);
						 $availabilityexisting = $selectavailability_query_fetch['availability'];
                ?>
			<div class="panel panel-default">
                        <div class="panel-heading">
                            Select your current job status below
                        </div>
						<script>
						function statusChange(data,tmid){
							// alert(data);
						$.ajax({
									type: "POST",
									url: "changestatus.php", //Relative or absolute path to response.php file
									data: 'available='+data+'&tmid='+tmid,
									success: function(msg) {
									 // $("#statusChange").html(msg);
									}
									});
						}
						</script>
						
			<div class="panel-body"> 
                           <ul class="nav nav-pills" style="padding-left: 200px;">
						   <?php  if ($availabilityexisting == "Available") { ?>
                                <li class="active bluedf" ><a href="#home-pills" onclick="statusChange('Available',<?php echo $tmid; ?>)" data-toggle="tab">Available for new job</a>    </li>
						   <?php }else{ ?>
						    <li class="bluedf" ><a href="#home-pills" onclick="statusChange('Available',<?php echo $tmid; ?>)" data-toggle="tab">Available for new job</a>    </li>
						   <?php } ?>
						    <?php  if ($availabilityexisting == "Not Available") { ?>
						   
                                <li class="active bluedf"><a href="#profile-pills" onclick="statusChange('Not Available',<?php echo $tmid; ?>)" data-toggle="tab">Employed and not available</a>  </li>
								 <?php }else{ ?>
								 <li class="bluedf"><a href="#profile-pills" onclick="statusChange('Not Available',<?php echo $tmid; ?>)" data-toggle="tab">Employed and not available</a>  </li>
								 <?php } ?>
								   <?php  if ($availabilityexisting == "Looking For Change") { ?>
                                <li class="active bluedf"><a href="#messages-pills" onclick="statusChange('Looking For Change',<?php echo $tmid; ?>)" data-toggle="tab">Employed and looking for change</a></li>
                                  <?php }else{ ?>
								   <li class="bluedf"><a href="#messages-pills" onclick="statusChange('Looking For Change',<?php echo $tmid; ?>)" data-toggle="tab">Employed and looking for change</a></li>
                                  <?php } ?>
                            </ul>
                                 
                           <center>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home-pills">
                                    <h4>Available for new job</h4>
                                    <p>It is noted to our database that you are looking for employment or new job. This status is linked to your EMDB ID. All the recruiters who are part of employee master database will know that you are AVAILABLE FOR NEW JOB, when they search our database with your EMDB ID.</p>
                                </div>
                                <div class="tab-pane fade" id="profile-pills">
                                    <h4>Employed and not available</h4>
                                    <p>It is noted to our database that you are no longer looking for a job. This status is linked to your EMDB ID. All the recruiters who are part of employee master database will know that you are NOT AVAILABLE FOR A NEW JOB, when they search our database with your EMDB ID.</p>
                                </div>
                                <div class="tab-pane fade" id="messages-pills">
                                    <h4>Employed and looking for change</h4>
                                    <p>It is noted to our database that you are looking for a new job. This status is linked to your EMDB ID. All the recruiters who are part of employee master database will know that you are AVAILABLE FOR CHANGE OF JOB, when they search our database with your EMDB ID.</p>
                                </div>
                                 
                            </div>
                             </center>  
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
