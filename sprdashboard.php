<div id="wrapper">
    <!-- navbar top -->
    <?php include('sprsidemenu.php'); ?>
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
                    <i class="fa "></i><b>&nbsp;Hello </b>Welcome 
                </div>
            </div>
            <!--end  Welcome -->
        </div>
        <?php
        $result = mysql_query("SELECT email FROM `user` where  role=2");
        $data = mysql_num_rows($result);
        ?>

        <div class="row">
            <!--quick info section -->
            <div class="col-lg-3">
                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body yellow" style="padding: 11px;">
                        <a href="adminpanel.php" style="color: #fff;">  <i class="fa fa-group fa-3x"></i>
                            <h4> <?php
                                if ($data != '0') {
                                    echo $data;
                                } else {
                                    echo "0";
                                }
                                ?></h4></a>
                    </div>
                    <div class="panel-footer" style="    background-color: #FFFFFF;">
                        <span class="panel-eyecandy-title">Job Seekers
                        </span>
                    </div>
                </div>

            </div>
            <?php
            $resultReq = mysql_query("SELECT count(*) as total FROM `recruiter`");
            $dataresultReq = mysql_fetch_assoc($resultReq);
            ?>
            <div class="col-lg-3">
                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body blue" style="padding: 11px;">
                        <a href="recruiterlist.php" style="color: #fff;">   <i class="fa fa-search fa-3x"></i>
                            <h4> <?php
                                if ($dataresultReq['total'] != '') {
                                    echo $dataresultReq['total'];
                                } else {
                                    echo "0";
                                }
                                ?></h4></a>
                    </div>
                    <div class="panel-footer" style="    background-color: #FFFFFF;">
                        <span class="panel-eyecandy-title">Recruiters 
                        </span>
                    </div>
                </div>

            </div>
            <?php
            $follow = mysql_query("SELECT email FROM `user` where role=4");
            $followdata = mysql_num_rows($follow);
            ?>
            <div class="col-lg-3">

                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body red" style="padding: 11px;">
                        <a href="userlist.php" style="color: #fff;"> <i class="fa fa-user fa-3x"></i>
                            <h4> <?php
                                if ($followdata != '0') {
                                    echo $followdata;
                                } else {
                                    echo "0";
                                }
                                ?></h4></a>
                    </div>
                    <div class="panel-footer" style="    background-color: #FFFFFF;">
                        <span class="panel-eyecandy-title">Users
                        </span>
                    </div>
                </div>

            </div>
            <?php
            $createdDate = date("Y-m-d");
            $status = mysql_query("SELECT email FROM `user` where  todaystatus='1' and modifiedDate LIKE '%$createdDate%' and createdDate !='$createdDate' and role=2");
            $todaystatus_data = mysql_num_rows($status);
            ?>
            <div class="col-lg-3">
                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body green" style="padding: 11px;">
                        <a href="statuschange.php" style="color: #fff;">  <i class="fa fa-pencil-square fa-3x"></i>
                            <h4><?php
                                if ($todaystatus_data != '0') {
                                    echo $todaystatus_data;
                                } else {
                                    echo "0";
                                }
                                ?></h4></a>
                    </div>
                    <div class="panel-footer" style="    background-color: #FFFFFF;">
                        <span class="panel-eyecandy-title">Today's Status Updates
                        </span>
                    </div>
                </div>

            </div>

            <!--end quick info section -->
        </div>
        <input type ="hidden" id="name" name="n" value="35">

        <div class="row" style="margin-top:30px;">
            <div class="col-lg-5" >

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Availability Status
                    </div>
                    <?php
                    $status1 = mysql_query("SELECT email FROM `user` where role=2 and availability='Available'");
                    $status2 = mysql_query("SELECT email FROM `user` where role=2 and availability='Not Available'");
                    $status3 = mysql_query("SELECT email FROM `user` where role=2 and availability='Looking for change'");
                    $status4 = mysql_query("SELECT email FROM `user` where (availability='No Status' or availability='') and role=2 ");
                    $todaystatus_data1 = mysql_num_rows($status1);
                    $todaystatus_data2 = mysql_num_rows($status2);
                    $todaystatus_data3 = mysql_num_rows($status3);
                    $todaystatus_data4 = mysql_num_rows($status4);
                    ?>
                    <?php include("chart.php"); ?>
                </div>
            </div>
            <div class="col-lg-3">
                <?php
                $status = mysql_query("SELECT email FROM `user` where modifiedDate LIKE '%$createdDate%' and role=2 and createdDate !='$createdDate' and visits !=0");
                $todaystatus_data = mysql_num_rows($status);
                ?>
                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body yellow">
                        <a href="statuschange.php?vsts=visits" style="color: #fff;">   <i class="fa fa-bar-chart-o fa-3x"></i>
                            <h3><?php
                                if ($todaystatus_data != '') {
                                    echo $todaystatus_data;
                                } else {
                                    echo "0";
                                }
                                ?></h3></a>
                    </div>
                    <div class="panel-footer">
                        <span class="panel-eyecandy-title">Daily Job Seeker Visits
                        </span>
                    </div>
                </div>

                <div class="panel panel-primary text-center no-boder">
                    <?php
                    $status = mysql_query("SELECT email FROM `user` where createdDate ='$createdDate' and role=2 ");
                    $todaystatus_data = mysql_num_rows($status);
                    ?>
                    <div class="alert alert-warning text-center">
                        <a href="statuschange.php?new=new" style="color: #fff;">     <i class="fa fa-user-plus fa-3x"></i>
                            <h3><?php
                                if ($todaystatus_data != '0') {
                                    echo $todaystatus_data;
                                } else {
                                    echo "0";
                                }
                                ?></h3></a>
                    </div>
                    <div class="panel-footer">
                        <span class="panel-eyecandy-title">New Job Seeker Registered
                        </span>
                    </div>
                </div>

            </div>
<!--            <div class="col-lg-4">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Idolize  Availability Status
                    </div>
                    <?php
                    $status11 = mysql_query("SELECT  email FROM `user` where role=2 and availability='Available' and idolize=1");
                    $status22 = mysql_query("SELECT  email FROM `user` where role=2 and availability='Not Available' and idolize=1");
                    $status33 = mysql_query("SELECT  email FROM `user` where role=2 and availability='Looking for change' and idolize=1");
                    $status44 = mysql_query("SELECT  email FROM `user` where (availability='No Status' or availability='') and role=2  and idolize=1");
                    $todaystatus_data1 = mysql_num_rows($status11);
                    $todaystatus_data2 = mysql_num_rows($status22);
                    $todaystatus_data3 = mysql_num_rows($status33);
                    $todaystatus_data4 = mysql_num_rows($status44);
                     $results = mysql_query("SELECT email FROM `user` where  role=2  and idolize=1");
        $datas = mysql_num_rows($results);
                    ?>
                    <center>Total Profiles <?php echo $datas; ?></center> 
                    <script>
                        $(function () {
                            Morris.Donut({
                                element: 'morris-donut-chart',
                                data: [{
                                        label: "Available",
                                        value: <?php echo intval($todaystatus_data1); ?>
                                    }, {
                                        label: "Not Available",
                                        value: <?php echo intval($todaystatus_data2); ?>
                                    }, {
                                        label: "Looking for change",
                                        value: <?php echo intval($todaystatus_data3); ?>
                                    }, {
                                        label: "No Status",
                                        value: <?php echo intval($todaystatus_data4); ?>
                                    }],
                                resize: true
                            });
                        });
                    </script>
                    <div id="morris-donut-chart"></div>  
                </div>
            </div>-->

        </div>

        <!--<div class="row">
                           <div class="col-lg-4">
        <?php
        $status = mysql_query("SELECT count(*) as total FROM `tickets`");
        $todaystatus_data = mysql_fetch_assoc($status);
        ?>
                           <div class="panel panel-primary text-center no-boder">
                               <div class="panel-body" style="background-color: red;">
                                  <a href="tickets.php" style="color: #fff;">   <i class="fa fa-exclamation-triangle fa-3x"></i>
                                      <h3><?php
        if ($todaystatus_data['total'] != '') {
            echo $todaystatus_data['total'];
        } else {
            echo "0";
        }
        ?></h3></a>
                               </div>
                               <div class="panel-footer">
                                   <span class="panel-eyecandy-title">Tickets
                                   </span>
                               </div>
                           </div>
                         
                       </div>
       
                       </div>-->


    </div>
    <!-- end page-wrapper -->

</div>



