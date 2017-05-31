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
                    <h1 class="page-header">Matched Requirements</h1>
                </div>
                <!--End Page Header -->
            </div>

             


            

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
  
?>

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
                                            <td>EMDB ID</td>
                                            <td><?php echo "EMDB" . $listdetails_query_fetch['member_id']; ?>
											
											
											</td>
                                            
                                        </tr>
										 <?php
                                                    if ($listdetails_query_fetch['protect'] == 'Private') {
                                                        ?>
										<tr>
                                            <td>Availability</td>
                                            <td><?php echo $listdetails_query_fetch['availability']; ?></td>
                                            
                                        </tr>
										 <?php } ?>
										 <?php if ($listdetails_query_fetch['protect'] == 'Public' || $listdetails_query_fetch['protect'] == '' || $listdetails_query_fetch['protect'] == 'Email And Phone') { ?>
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
										 <?php }
             ?>
                                    </tbody>
                                </table>
								
                            </div>
							
							
                        </div>
                    </div>
<div class="panel panel-default">
                           <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Job Title</th>
                                            <th>Job Type</th> 
                                            <th>Technology</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
									
								
                                    <tbody>
									 <?php
									 
        $sqlQry = mysql_query("SELECT * FROM `user` WHERE user_id='$id' ");
        $reqid = mysql_fetch_assoc($sqlQry);
        $pskills = $reqid['skills'];
        $Skills = str_replace(",", "|", $pskills);
        $query_pag_data = "SELECT * from requirement where recruiterId='$recruiter_id' and primarySkills REGEXP '(^|,)($Skills)(,|$)' ";
        $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
        $msg = "";
        while ($res = mysql_fetch_array($result_pag_data)) {
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $res['createdDate']; ?></td>
                                            <td><?php echo $res['jobTitle']; ?></td>
                                            <td><?php echo $res['jobType']; ?></td>
                                            <td><?php echo $res['technology']; ?></td>
                                            <td class="center"><a href="viewReq.php?id=<?php echo $res['id']; ?>"><img src="images/view_16x16.gif" title="View"></a> </td>
                                        </tr>
                                        
                                    <?php  }
        ?> 
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
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
  

</body>

</html>
