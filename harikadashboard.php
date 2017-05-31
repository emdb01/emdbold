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

                <div class="row">
                    <!-- Welcome -->
                    <div class="col-lg-12">
                        <div class="alert alert-info">
                              <i class="fa "></i>&nbsp;Hello <b><?php echo $_SESSION['first']; ?> </b>Welcome.
                        </div>
                    </div>
                    <!--end  Welcome -->
                </div>
                <?php
                $result = mysql_query("SELECT count(*) as total FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid')");
                $data = mysql_fetch_assoc($result);
                ?>

                <div class="row">
                    <!--quick info section -->
                    <div class="col-lg-3">
                        <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body yellow" style="padding: 11px;">
                              <a href="list_resumes.php" style="color: #fff;">  <i class="fa fa-group fa-3x"></i>
                                <h4> <?php if($data['total'] !=''){echo $data['total'];}else{ echo "0"; } ?></h4></a>
                            </div>
                            <div class="panel-footer" style="    background-color: #FFFFFF;">
                                <span class="panel-eyecandy-title">Resumes
                                </span>
                            </div>
                        </div>

                    </div>
                    <?php
                    $resultReq = mysql_query("SELECT count(*) as total FROM `requirement` where recruiterId='$mid'");
                    $dataresultReq = mysql_fetch_assoc($resultReq);
                    ?>
                    <div class="col-lg-3">
                        <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body blue" style="padding: 11px;">
                             <a href="requirements.php" style="color: #fff;">   <i class="fa fa-table fa-3x"></i>
                                <h4> <?php if($dataresultReq['total'] !=''){echo $dataresultReq['total'];}else{ echo "0"; } ?></h4></a>
                            </div>
                            <div class="panel-footer" style="    background-color: #FFFFFF;">
                                <span class="panel-eyecandy-title">Requirements 
                                </span>
                            </div>
                        </div>

                    </div>
                    <?php
                    $createdDate = date("Y-m-d");
                    $status = mysql_query("SELECT count(*) as total FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid') and todaystatus='1' and modifiedDate LIKE '%$createdDate%' ");
                    $todaystatus_data = mysql_fetch_assoc($status);
                    ?>
                    <div class="col-lg-3">
                        <div class="panel panel-primary text-center no-boder">
                            <div class="panel-body green" style="padding: 11px;">
                                <a href="statuschange.php" style="color: #fff;">  <i class="fa fa-pencil-square fa-3x"></i>
                                <h4><?php if($todaystatus_data['total'] !=''){echo $todaystatus_data['total'];}else{ echo "0"; } ?></h4></a>
                            </div>
                            <div class="panel-footer" style="    background-color: #FFFFFF;">
                                <span class="panel-eyecandy-title">Status Update
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
                                <h4> <?php if($followdata['total'] !=''){echo $followdata['total'];}else{ echo "0"; } ?></h4></a>
                            </div>
                            <div class="panel-footer" style="    background-color: #FFFFFF;">
                                <span class="panel-eyecandy-title">Following list
                                </span>
                            </div>
                        </div>

                    </div>
                    <!--end quick info section -->
                </div>
                <input type ="hidden" id="name" name="n" value="35">

                <div class="row">
                    <div class="col-lg-5">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Availabilty Status
                            </div>
                            <?php
                          
                    $status1 = mysql_query("SELECT count(*) as total FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid') and availability='Available'");
                    $status2 = mysql_query("SELECT count(*) as total FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid') and availability='Not Available'");
                    $status3 = mysql_query("SELECT count(*) as total FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid') and availability='Looking for change'");
                    $status4 = mysql_query("SELECT count(*) as total FROM `user` where user_id IN (select user_id from recruit_users where recruiterId='$mid') and availability='No Status'");
                    $todaystatus_data1 = mysql_fetch_assoc($status1);
                    $todaystatus_data2 = mysql_fetch_assoc($status2);
                    $todaystatus_data3 = mysql_fetch_assoc($status3);
                    $todaystatus_data4 = mysql_fetch_assoc($status4);
                    
                    ?>
                                     <?php include("chart.php"); ?>
                        </div>
                    </div>
                   <!--<div class="col-lg-4">
                         <?php
                    $status = mysql_query("SELECT count(*) as total FROM `tickets` where user_id IN (select user_id from recruit_users where recruiterId='$mid') OR recruiter_id='$mid'");
                    $todaystatus_data = mysql_fetch_assoc($status);
                    ?>
                    <div class="panel panel-primary text-center no-boder">
                        <div class="alert alert-warning text-center">
                           <a href="tickets.php" style="color: #fff;">   <i class="fa fa-exclamation-triangle fa-3x"></i>
                               <h3><?php if($todaystatus_data['total'] !=''){echo $todaystatus_data['total'];}else{ echo "0"; } ?></h3></a>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Tickets
                            </span>
                        </div>
                    </div>
                  
                </div>-->

					<div class="col-lg-4">
					<div class="panel panel-default">
                            <div class="panel-heading">
                            Requirements List
                        </div>

                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i>New Comment
                                    <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i>3 New Followers
                                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-envelope fa-fw"></i>Message Sent
                                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-tasks fa-fw"></i>New Task
                                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-upload fa-fw"></i>Server Rebooted
                                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                                </a>
                                

                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                        </div>

                    </div>
                    </div>
					<div class="col-lg-3">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Quick Search
                            </div>
                            <div class="panel-body">

                            <form action="list_resumes.php?id=1" name="checkavail" id="checkavail"  method="post"  >
                                <input type="text" name="searchemdb" id="searchemdb"   oninvalid="SearchEmdbId(this);" required="required"  oninput="SearchEmdbId(this);"  Value="<?php echo @$_POST['searchemdb']; ?>" placeholder="EMDB" class="form-control "  style="margin-right:20px;">
                                </br><button type="submit"  name="searchemdbb" id="searchemdbb" style="" value="Check Status" class="btn btn-primary">Check Status</button>
                            </form>

                            </br>

                            
                            
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
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
    <script src="assets/plugins/flot/jquery.flot.js"></script>
    <script src="assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="assets/plugins/flot/jquery.flot.resize.js"></script>
    <script src="assets/plugins/flot/jquery.flot.pie.js"></script>
    <script src="assets/scripts/flot-demo.js"></script>
    <!-- Page-Level Plugin Scripts-->


</body>

</html>
 