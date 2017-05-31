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
                    <h1 class="page-header">View</h1>
                </div>
                <!--End Page Header -->
            </div>






            <div class="row">
                <div class="col-lg-12">
                    <div class="changep">
<!--                        <button type="button" class="btn btn-info" onclick="goBack()"><i class="fa fa-reply"></i> Back </button>-->
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
                            Resume Details
                                                <!--	<?php if ($listdetails_query_fetch['protect'] == 'Public' || $listdetails_query_fetch['protect'] == '') { ?><a href="#" data-display="mySite" style="float:right;" class="tooltip1" title="Show Candidate Resume">View Resume</a><?php } ?>-->
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
                                                <td>Email ID</td>
                                                <td><?php echo $listdetails_query_fetch['email']; ?></td>

                                            </tr>
                                            <tr>
                                                <td>Phone No.</td>
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



</body>

</html>
