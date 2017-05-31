<?php
include('header.php');
$value = 'employeemasterdatabase.com';
//setcookie("referer", $value);
//setcookie("referer", $value, time()+3600);  /* expire in 1 hour */
//$_COOKIE["referer"];
$_SESSION['referer'] = $value;
if (!isset($_SESSION['user_id'])) {
    header("Location:index.php");
    die();
}
?>
<body>
    <?php
    if ($_SESSION['role'] == 3) {
        $mid = $_SESSION['user_id'];
        ?> 
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
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!--End Page Header -->
                </div>
                <script src="js/jquery.min.js"></script>
                <script>
                    mydashcount();
                    function mydashcount() {
 $('#page-wrapper').addClass('whirl standard');
                        var recid = <?php echo $mid; ?>;
                        $.ajax({
                            url: 'getdashdata.php',
                            data: ({data: recid}),
                            type: 'post',
                            cache: false,
                            dataType: 'html',
                            success: function (value) {
                                
                                var data = value.split(",");
                                $('#mylist').html(data[0]);
                                $('#reqlist').html(data[1]);
                                $('#reqp').html(data[2]);
                                $('#foco').html(data[3]);
                            }

                        });
                    }
                </script>
                <div class="row" >
                    <!-- Welcome -->
                    <div class="col-lg-12">
                        <div class="alert" style="background-color:#808080;color:#fff;">
                            <i class="fa "></i>&nbsp;Hello <b><?php echo $_SESSION['first']; ?> </b>Welcome!
                        </div>
                    </div>
                    <!--end  Welcome -->
                </div>
                <?php
//                $result = mysql_query("SELECT count(*) as total FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid')");
//                $data = mysql_fetch_assoc($result);
                ?>

                <div class="row">
                    <!--quick info section -->
                    <div class="col-lg-3">
                        <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body yellow" style="padding: 11px;">
                                <a href="list_resumes.php" style="color: #fff;">  <i class="fa fa-group fa-3x"></i>
                                    <h4 id="mylist"> </h4></a>
                            </div>
                            <div class="panel-footer" style="    background-color: #FFFFFF;">
                                <span class="panel-eyecandy-title">My List
                                </span>
                            </div>
                        </div>

                    </div>
                    <?php
//                    $resultReq = mysql_query("SELECT count(*) as total FROM `requirement` where recruiterId='$mid'");
//                    $dataresultReq = mysql_fetch_assoc($resultReq);
                    ?>
                    <div class="col-lg-3">
                        <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body blue" style="padding: 11px;">
                                <a href="requirements.php" style="color: #fff;">   <i class="fa fa-table fa-3x"></i>
                                    <h4 id="reqlist"> </h4></a>
                            </div>
                            <div class="panel-footer" style="    background-color: #FFFFFF;">
                                <span class="panel-eyecandy-title">Job Requirements 
                                </span>
                            </div>
                        </div>

                    </div>
                    <?php
//                    $createdDate = date("Y-m-d");
//                    $status = mysql_query("SELECT count(*) as total FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid') and todaystatus='1' and modifiedDate LIKE '%$createdDate%' ");
//                    $totalCo = mysql_fetch_assoc($status);
                    ?>
                    <div class="col-lg-3">
                        <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body green" style="padding: 11px;">
                                <a href="statuschange.php" style="color: #fff;">  <i class="fa fa-pencil-square fa-3x"></i>
                                    <h4 id="reqp"></h4></a>
                            </div>
                            <div class="panel-footer" style="    background-color: #FFFFFF;">
                                <span class="panel-eyecandy-title">Availability Updates
                                </span>
                            </div>
                        </div>

                    </div>
                    <?php 
                    $follow = mysql_query("SELECT count(*) as total FROM `follow` where user_id ='$mid'");
                    $followdata = mysql_fetch_assoc($follow);
                    ?>
                    <div class="col-lg-3">

                        <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body red" style="padding: 11px;">
                                <a href="followers.php" style="color: #fff;"> <i class="fa fa-thumbs-up fa-3x"></i>
                                    <h4 id="foco"></h4></a>
                            </div>
                            <div class="panel-footer" style="    background-color: #FFFFFF;">
                                <span class="panel-eyecandy-title">Following
                                </span>
                            </div>
                        </div>

                    </div>
                    <!--end quick info section -->
                </div>
                <input type ="hidden" id="name" name="n" value="35">

                <div class="row" style="margin-top:30px;">
                    <div class="col-lg-5">

                        <div class="panel panel-default" style="height: 354px;">
                            <div class="panel-heading">
                                Availability Status
                            </div>
                            <?php 
                            $status1 = mysql_query("SELECT u.email  FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$mid' and u.availability='Available'");
                            $status2 = mysql_query("SELECT u.email FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$mid' and u.availability='Not Available'");
                            $status3 = mysql_query("SELECT u.email FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$mid' and u.availability='Looking for change'");
                            $status4 = mysql_query("SELECT u.email FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$mid' and u.availability='No Status'");
                            $todaystatus_data1 = mysql_num_rows($status1);
                            $todaystatus_data2 = mysql_num_rows($status2);
                            $todaystatus_data3 = mysql_num_rows($status3);
                            $todaystatus_data4 = mysql_num_rows($status4);
                            ?>
                            <?php include("chart.php");  ?>
                        </div>
                    </div>
                    <div class="col-lg-3">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Quick Search
                            </div>
                            <div class="panel-body" style="height:310px;">

                                <form action="list_resumes.php?id=1" name="checkavail" id="checkavail"  method="POST"  >
                                    <input type="text" name="searchemdb" id="searchemdb"   oninvalid="SearchEmdbId(this);" required="required"  oninput="SearchEmdbId(this);"  Value="<?php echo @$_POST['searchemdb']; ?>" placeholder="EMDB ID" class="form-control "  style="margin-right:20px;margin-top:45px">
                                    </br><button type="submit"  id="searchemdbb" style="" value="Check Status" class="btn btn-primary">Search</button>
                                </form> </br>
                                <form action="list_resumes.php" name="checkavail" id="checkavail"  method="GET"  >
                                    <input type="text" name="serterm" id="searchemdb"   oninvalid="SearchEmdbId(this);" required="required"  oninput="SearchEmdbId(this);"  Value="<?php echo @$_POST['searchemdb']; ?>" placeholder="Name or Email" class="form-control "  style="margin-right:20px;">
                                    </br><button type="submit"  id="searchemdbb" style="" value="Check Status" class="btn btn-primary">Search</button>
                                </form>
                                </br>



                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Notifications of status change
                            </div>

                            <div class="panel-body" style="height:310px;overflow-y: scroll;">
                                <div class="list-group" >
                                    <?php
                                    $createdDate = date("Y-m-d");
                                    
                                    $statusUp = mysql_query("SELECT u.first,u.availability FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$mid' and u.todaystatus='1' and u.modifiedDate LIKE '%$createdDate%' LIMIT 5");
                                    if ($cont = mysql_num_rows($statusUp) == 0) {
                                        echo "<center>No Notifications</center>";
                                    }
                                    while ($todaystatusupdate = mysql_fetch_assoc($statusUp)) {
                                        ?>

                                        <a href="statuschange.php" class="list-group-item">
                                            <?php echo $todaystatusupdate['first']; ?> has

                                            changed  status to  <?php
                                            $available = $todaystatusupdate['availability'];

                                            if ($available == 'Available') {
                                                echo "<p style='color:#32CD32;'>$available </p>";
                                            } elseif ($available == 'Not Available') {
                                                echo "<p style='color:#FF0000;'>$available </p>";
                                            } elseif ($available == 'No Status' || $available == '') {
                                                echo "<p style=''>$available </p>";
                                            } elseif ($available == 'Cannot Confirm') {
                                                echo "<p style='color:#FF00FF;'>$available </p>";
                                            } elseif ($available == 'Looking For Change') {
                                                echo "<p style='color:#0000FF;'>$available </p>";
                                            }
                                            ?>
                                        </a><br>
                                    <?php }
                                    ?>

                                </div>
                                <!-- /.list-group -->

                            </div>

                        </div>
                    </div>
                </div>







            </div>
            <!-- end page-wrapper -->

        </div>
        <!-- end wrapper -->
        <?php
    } else if ($_SESSION['role'] == 2) {
        $mid = $_SESSION['user_id'];
        include("jdashboard.php");
        ?>
        <script src="assets/plugins/jquery-1.10.2.js"></script>
        <?php
    } else if ($_SESSION['role'] == 4) {
        $mid = $_SESSION['user_id'];
        include("sprdashboard.php");
        ?>

        <?php
    } else if ($_SESSION['role'] == 1) {
        $mid = $_SESSION['user_id'];
        include("sprdashboard.php");
        ?>

    <?php } ?>

    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>
<!--    <script src="assets/plugins/jquery-1.10.2.js"></script>-->
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>


</body>

</html>
