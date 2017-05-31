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
                    <i class="fa "></i><b>&nbsp;Hello ! </b>Welcome Back 
                </div>
            </div>
            <!--end  Welcome -->
        </div>
        <!-- end page-wrapper -->

        <div class="row">
            <?php
            $resultReq = mysql_query("SELECT member_id FROM `user` where user_Id='$mid'");
            $dataresultReq = mysql_fetch_assoc($resultReq);
            ?>
            <!--quick info section -->
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body " style="padding: 11px;background-color:#5b4caf;">
                        <a href="status.php" style="color: #fff;"> 
                            <h4> <?php
                                if ($dataresultReq['member_id'] != '') {
                                    echo "EMDB" . $dataresultReq['member_id'];
                                } else {
                                    echo "";
                                }
                                ?></h4></a>
                    </div>

                </div>

            </div><div class="col-lg-3"></div>
        </div></br>
        <div class="row"> 
 <?php
                $resultReq = mysql_query("SELECT availability FROM `user` where user_Id='$mid'");
                $dataresultReq = mysql_fetch_assoc($resultReq);
                ?>
            <div class="col-lg-4">
                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body blue" style="padding: 11px;">
                        <a href="status.php" style="color: #fff;">  
                            <h4> 
                            <?php 
                    if ($dataresultReq['availability'] == 'Available') {
                        echo "Looking For Change";
                    } else if ($dataresultReq['availability'] == 'Not Available') {
                        echo "Looking For Change";
                    } else if ($dataresultReq['availability'] == 'Looking For Change') {
                        echo "Available";
                    } ?>
                            </h4></a>
                    </div>

                </div>

            </div>

            <div class="col-lg-4">
               
                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body" style="padding: 11px;<?php 
                    if ($dataresultReq['availability'] == 'Available') {
                        echo "background-color:green;";
                    }else if ($dataresultReq['availability'] == 'Not Available') {
                        echo "background-color:#d239dc;";
                    }else if ($dataresultReq['availability'] == 'Looking For Change') {
                        echo "background-color:#009688;";
                    } ?>">
                        <a href="status.php" style="color: #fff;">   
                            <h4><?php
                                if ($dataresultReq['availability'] != '') {
                                    echo $dataresultReq['availability'];
                                } else {
                                    echo "No Status";
                                }
                                ?></h4> </a>
                       <img src="images/tik.png" height="30px"  width="30px" style="float:right;margin-top: -35px;">
                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body blue" style="padding: 11px;">
                        <a href="status.php" style="color: #fff;">  
                            <h4> 
                            <?php 
                    if ($dataresultReq['availability'] == 'Available') {
                        echo "Not Available";
                    } else if ($dataresultReq['availability'] == 'Not Available') {
                        echo "Available";
                    }else if ($dataresultReq['availability'] == 'Looking For Change') {
                        echo "Not Available";
                    } ?>
                            </h4></a>
                    </div>

                </div>

            </div>

            <!--end quick info section -->
        </div><br>
        <div class="col-lg-3">
        </div>
        <?php
        $result = mysql_query("SELECT count(*) as total FROM `voicemail_users` where user_id='$mid' and status='0' ");
        $data = mysql_fetch_assoc($result);
        ?>
        <div class="col-lg-3">
            <div class="panel panel-primary text-center no-boder">
                <div class="panel-body yellow" style="padding: 11px;">
                    <a href="vmessages.php" style="color: #fff;">   <i class="fa fa-microphone fa-3x"></i>
                        <h4><?php echo $data['total']; ?></a></h4></a>
                </div>
                <div class="panel-footer" style="    background-color: #FFFFFF;">
                    <span class="panel-eyecandy-title">Voice Messages
                    </span>
                </div>
            </div>

        </div>

        <?php
        $resultReq = mysql_query("SELECT count(*) as total FROM `textmail_users` where user_id='$mid' and status='0'");
        $dataresultReq = mysql_fetch_assoc($resultReq);
        ?>
        <div class="col-lg-3">
            <div class="panel panel-primary text-center no-boder">
                <div class="panel-body " style="padding: 11px;background-color: rgba(238, 0, 0, 0.62);">
                    <a href="messages.php" style="color: #fff;">   <i class="fa fa-envelope fa-3x"></i>
                        <h4> <?php
                            if ($dataresultReq['total'] != '') {
                                echo $dataresultReq['total'];
                            } else {
                                echo "0";
                            }
                            ?></h4></a>
                </div>
                <div class="panel-footer" style="    background-color: #FFFFFF;">
                    <span class="panel-eyecandy-title">Messages 
                    </span>
                </div>
            </div>

        </div>
    </div>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>

</div>        
