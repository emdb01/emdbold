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
                    <h1 class="page-header">Requirement View</h1>
                </div>
                <!--End Page Header -->
            </div>






            <div class="row">
                <div class="col-lg-12">
                    <div class="changep">
                        <button class="btn btn-info"  onclick="history.go(-1);"><i class="fa fa-reply"></i> Back</button>
                  
                       <a href="editReq.php?id=<?php echo $_GET['id']; ?>">  <button type="button" class="btn btn-success"><i class="fa fa-edit"></i> Edit </button></a>

                    </div>
                </div>

                <?php
                $id = $_GET['id'];
                $listdetails = "SELECT * FROM `requirement` WHERE id='$id'";
                $listdetails_query = mysql_query($listdetails);
                $res = mysql_fetch_assoc($listdetails_query);
                ?>
                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Requirement  details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">

                                    <tbody>
                                        <tr>
                                            <td>Job Title</td>
                                            <td><?php echo $res['jobTitle']; ?></td>

                                        </tr>
                                        <tr>
                                            <td>Primary Skills</td>
                                            <td><?php echo $primarySkills = str_replace("|", ",", $res['primarySkills']); ?></td>

                                        </tr>
                                        
                                       
                                        <tr>
                                            <td>Job Description</td>
                                            <td><?php echo $res['description']; ?></td>

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
