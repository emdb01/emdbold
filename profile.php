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
                    <h1 class="page-header">My Profile</h1>
                </div>
                <!--End Page Header -->
            </div>

             


            

            <div class="row">
			<div class="col-lg-12">
			
			
			<div class="changep">
			<a href="passwordchange.php"><button type="button" class="btn btn-info"><i class="fa fa-unlock-alt"></i> Change Password</button></a>
                               <a href="edit_profile.php"> <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Edit </button></a>
								</div>
								</div>
                <div class="col-lg-12">
   <?php
        $email = $_SESSION['email'];
        $listdetails = "SELECT * FROM `user` WHERE member_id='$mid'";
        $listdetails_query = mysql_query($listdetails);
        while ($listdetails_query_fetch = mysql_fetch_array($listdetails_query)) {
            $phone = $listdetails_query_fetch['phone'];
            $availability = $listdetails_query_fetch['availability'];
            @$job = $listdetails_query_fetch['job'];
            @$salary = $listdetails_query_fetch['salary'];
            @$zip = $listdetails_query_fetch['zip'];
            @$notify = $listdetails_query_fetch['notify_time'];
            $country = $listdetails_query_fetch['country'];
            @$distance = $listdetails_query_fetch['distance'];
            @$technology = $listdetails_query_fetch['technology'];
            @$flexible = $listdetails_query_fetch['flexible'];
        }
        ?>
   
<?php $currencyCode = mysql_fetch_assoc(mysql_query("SELECT * FROM `countries` where countryName='$country' ")); ?>
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
                                            <td>Availability</td>
                                            <td><?php echo $availability; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Country</td>
                                            <td><?php echo $country; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Notification Gap</td>
                                            <td><?php if($notify !=''){ echo @$notify.'Days'; }?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Job Type</td>
                                            <td><?php echo @$job; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Technology</td>
                                            <td><?php echo $technology; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Zip Code</td>
                                            <td><?php echo @$zip; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Distance Range</td>
                                            <td><?php echo @$distance; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Relocation</td>
                                            <td><?php echo @$flexible; ?></td>
                                            
                                        </tr>
										<tr>
                                            <td>Salary Expectation</td>
                                            <td><?php echo trim(@$salary, "-"); ?>  <?php if ($country != '' && $salary != '') {
                echo $currencyCode['countryCode'];
            } ?></td>
                                            
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
<?php
if ($_GET['visits'] != '' && $_GET['dateTime'] != '' && $_GET['mmid'] != '') {
    $visits = $_GET['visits'];
    $dateTime = $_GET['dateTime'];
    $mmid = $_GET['mmid'];

    $userupdate = "UPDATE `user` SET  visits='$visits',dateTime='$dateTime' WHERE  `member_id`='$mmid'";
    $userupdate_result = mysql_query($userupdate);
}
?>