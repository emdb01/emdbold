<?php
include('header.php');
error_reporting(0);

if (!isset($_SESSION['user_id'])) {
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
$mid = $_SESSION['user_id'];
$id = $_GET['id'];
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
                    <h1 class="page-header">Message</h1>
                    <div class="changep">
                        <button type="button" class="btn btn-info" onclick="goBack()"><i class="fa fa-reply"></i> Back </button>
                    </div>
                </div>
                <!--End Page Header -->
            </div>






            <div class="row">

                <div class="col-lg-12">
                    <?php
                    $listdetails = "SELECT * FROM  text_mails where id='$id'";
                    $listdetails_query = mysql_query($listdetails);
                    $listdetails_query_fetch = mysql_fetch_assoc($listdetails_query);
                    $subject = $listdetails_query_fetch['subject'];
                    $message = $listdetails_query_fetch['message'];
                    $user_Id = $_GET['ui'];
                    $sqlQry = mysql_query("SELECT * FROM `user` WHERE user_id='$user_Id' ");
                    $reqid = mysql_fetch_assoc($sqlQry);
                    ?>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Message details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">

                                    <tbody>
                                        <tr>
                                            <td>Resume Name</td>
                                            <td><?php echo $reqid['first']; ?></td>

                                        </tr>
                                        <tr>
                                            <td>Subject</td>
                                            <td><?php echo $subject; ?></td>

                                        </tr>
                                        <tr>
                                            <td>Message</td>
                                            <td><?php echo $message; ?></td>

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
