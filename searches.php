<div id="wrapper">
    <!-- navbar top -->
    <?php include('sprsidemenu.php'); ?>
    <!-- end navbar side -->
    <!--  page-wrapper -->
    <div id="page-wrapper">

        <div class="row">
            <!-- Page Header -->
            <div class="col-lg-12">
                <h1 class="page-header">Search List</h1>
            </div>
            <!--End Page Header -->
        </div>

        <?php
        $result = mysql_query("SELECT * FROM `search` where recruiterId=0");
        $data = mysql_num_rows($result);
        ?>

        <div class="row">
            <!--quick info section -->
            <div class="col-lg-3">
                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body yellow" style="padding: 11px;">
                        <a href="anonymous.php" style="color: #fff;">  <i class="fa fa-group fa-3x"></i>
                            <h4> <?php
                                if ($data != '0') {
                                    echo $data;
                                } else {
                                    echo "0";
                                }
                                ?></h4></a>
                    </div>
                    <div class="panel-footer" style="    background-color: #FFFFFF;">
                        <span class="panel-eyecandy-title">Anonymous Users
                        </span>
                    </div>
                </div>

            </div>
            <?php
            $resultReq = mysql_query("SELECT count(*) as total FROM `search` where recruiterId !=0");
            $dataresultReq = mysql_fetch_assoc($resultReq);
            ?>
            <div class="col-lg-3">
                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body blue" style="padding: 11px;">
                        <a href="recruitersearch.php" style="color: #fff;">   <i class="fa fa-search fa-3x"></i>
                            <h4> <?php
                                if ($dataresultReq['total'] != '') {
                                    echo $dataresultReq['total'];
                                } else {
                                    echo "0";
                                }
                                ?></h4></a>
                    </div>
                    <div class="panel-footer" style="    background-color: #FFFFFF;">
                        <span class="panel-eyecandy-title">Recruiters Search
                        </span>
                    </div>
                </div>

            </div>
            <?php
            $follow = mysql_query("SELECT DISTINCT emdbid  FROM `search` where recruiterId !=0 ");
            $followdata = mysql_num_rows($follow);
            ?>
            <div class="col-lg-3">

                <div class="panel panel-primary text-center no-boder">
                    <div class="panel-body red" style="padding: 11px;">
                        <a href="uniquerecruiters.php" style="color: #fff;"> <i class="fa fa-user fa-3x"></i>
                            <h4> <?php
                                if ($followdata != '0') {
                                    echo $followdata;
                                } else {
                                    echo "0";
                                }
                                ?></h4></a>
                    </div>
                    <div class="panel-footer" style="    background-color: #FFFFFF;">
                        <span class="panel-eyecandy-title">Unique Recruiters
                        </span>
                    </div>
                </div>

            </div>
          

            <!--end quick info section -->
        </div>
       


    </div>
    <!-- end page-wrapper -->

</div>



