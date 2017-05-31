<?php
include('header.php');

if (!isset($_SESSION['user_id'])) {
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
if (isset($_POST['resetfilter'])) {
    unset($_POST['q']);
}
$mid = $_SESSION['user_id'];
$mainfolder = "./" . $mid . "/";
$mainfolderlink = "";
$subfolderlink = "";
$ulink = curPageURL();
$s_1 = 0;
$extoffileis = "";
$perpage = 20;
$listnumber = 0;
$adjacents = 3;
?>
<!--tooltip------>
<?php include ("tooltip.html"); ?>
<!--tooltip------>
<body>
    <!------this script for select all checkboxes----->
    <script type="text/javascript">
        function do_this() {

            var checkboxes = document.getElementsByName('check_list[]');
            var checkbox = document.getElementById('selecctall');

            if (checkbox.value == 'select') {
                for (var i in checkboxes) {
                    checkboxes[i].checked = 'FALSE';
                }
                checkbox.value = 'deselect'
            } else {
                for (var i in checkboxes) {
                    checkboxes[i].checked = '';
                }
                checkbox.value = 'select';
            }
        }

    </script>
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
                    <h1 class="page-header">Followings</h1>

                    <div class="alert " style="background-color:#808080;color:#fff;">
                        The below mentioned is the list of users, whom you are following
                    </div>
                </div>
                <!--End Page Header -->

            </div>

            <?php
            if (isset($_POST['check_list'])) {//to run PHP script on submit
                if (!empty($_POST['check_list'])) {

// Loop to store and display values of individual checked checkbox.
                    if (isset($_POST['unfollow'])) {

                        echo "<p class=\"notify_text\">The list of Users you follow has been updated</p>";
                        echo "<p class=\"notify_green\">";

                        foreach ($_POST['check_list'] as $selected) {

                            $deletefollow = "delete from `follow` where  `member_id` = $selected  and user_id=$mid";
                            $deletefollow_query = mysql_query($deletefollow);
                        }
                        echo "</p>";
                    }
                }
            } else {
                if ($_POST['unfollow'] != '') {
                    ?>
                    <link rel="stylesheet" href="popstyles/main.css">
                    <div id="boxes">
                        <div  id="dialog" class="window"> Please Select Atleast One Entry.
                            <!--                    <a href="#" class="close" style="">X</a>-->
                        </div>
                        <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
                    </div>
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
                    <script src="popstyles/main.js"></script>

                    <?php
                }
            }
            ?>



            <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Refine Search 
                        </div>
                        <div class="panel-body">
                            <form action=""   method="POST" > 
                                <div class="form-group col-lg-12">
                                    <select name="q" id="q" class="form-control" style="float:left;width:70%">
                                        <option value="" <?php
                                        if ($selectvalue == "") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >All</option>
                                        <option value="Available"  <?php
                                        if ($selectvalue == "Available") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >Available</option>
                                        <option value="Looking For Change" <?php
                                        if ($selectvalue == "Looking For Change") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >Looking For Change</option>
                                        <option value="No Status" <?php
                                        if ($selectvalue == "No Status") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >No Status</option>
                                        <option value="Not Available" <?php
                                        if ($selectvalue == "Not Available") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >Not Available</option>

                                        <!--  <option value="Cannot Confirm" <?php
                                        if ($selectvalue == "Cannot Confirm") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >Cannot Confirm</option>-->

                                    </select>

                                    <button type="submit" class="btn btn-primary" id="refine"  value="Refine" style="float:left;width: 12%;margin-left: 5%;">Refine</button>
                                    <?php if ($_POST['q'] != '') { ?>
                                        <button   type="submit"  id="resetfilter1" name="resetfilter"  value="Reset Filter1" class="btn  btn-success" style="float: right;width: 12%;">Reset Filter</button>
                                    <?php } ?>
                                </div>
                                <?php if ($_POST['q'] != '') { ?><center> <?php
                                        $avai = $_POST['q'];
                                        if ($avai == 'Available') {
                                            echo "Search results for   &nbsp;&nbsp;<spam style='color:#32CD32;'> '$avai' </spam>Candidates";
                                        } elseif ($avai == 'Not Available') {
                                            echo "Search results for   &nbsp;&nbsp;<spam style='color:#FF0000;'> '$avai' </spam>Candidates";
                                        } elseif ($avai == 'No Status') {
                                            echo "Search results for   &nbsp;&nbsp;<spam style=''> '$avai' </spam>Candidates";
                                        } elseif ($avai == 'Cannot Confirm') {
                                            echo "Search results for   &nbsp;&nbsp;<spam style='color:#FF00FF;'> '$avai' </spam>Candidates";
                                        } elseif ($avai == 'Looking For Change') {
                                            echo "Search results for   &nbsp;&nbsp;<spam style='color:#0000FF;'> '$avai' </spam>Candidates";
                                        } elseif ($avai == '') {
                                            echo "Search results for   &nbsp;&nbsp;<spam style=''> 'No Status' </spam>Candidates";
                                        }
                                        ?>  </center> <?php } ?>
                            </form>


                        </div>

                    </div>
                </div>
                <form action=""  name="checkval" id="checkval"   method="post"  >
                    <div class="col-lg-12">

                        <div class="changep">

                            <button type="submit" class="btn btn-info" id="unfollow"   class="tooltip" title="UnFollow Job Seekers" name="unfollow" value="Un Follow"  onclick="return CheckForm();">Un Follow</button>

                        </div>
                    </div>
                    <div class="col-lg-12">





                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>S.No.	</th>
                                                <th>Name</th>
                                                <th>Email</th> 
                                                <th>Availability</th>
                                                <th>Status Changed</th>
                                                <th>Select All <input type="checkbox" id="selecctall" value="select" style="margin-left: 15%;" onClick="do_this()" /> </th>
                                        </thead>
                                        <tbody>
                                            <?php
//folder refining
                                            $listdetailstotal = "SELECT DISTINCT member_id FROM `follow` WHERE user_id='$mid'";
                                            $listdetails_querytotal = mysql_query($listdetailstotal);
                                            $total_pages = mysql_num_rows($listdetails_querytotal);
                                            /* Setup vars for query. */
                                            $targetpage = "followers.php";  //your file name  (the name of this file)
                                            $limit = 20;         //how many items to show per page
                                            @$page = $_GET['page'];
                                            if ($page)
                                                $start = ($page - 1) * $limit;    //first item to display on this page
                                            else
                                                $start = 0;        //if no page var is given, set start to 0


                                            $listdetails = "SELECT DISTINCT member_id FROM `follow` WHERE user_id='$mid' ";
                                            $listdetails_query = mysql_query($listdetails);
                                            while ($listdetails_query_fetch = mysql_fetch_array($listdetails_query)) {
                                                $membid = $listdetails_query_fetch['member_id'];
                                                if ($_POST['q'] != '') {
                                                    $ava = $_POST['q'];
                                                    $listdetails1 = "SELECT *  FROM `user` WHERE member_id='$membid' and availability='$ava' order by `modifiedDate` DESC";
                                                } else {
                                                    $listdetails1 = "SELECT *  FROM `user` WHERE member_id='$membid' order by `modifiedDate` DESC";
                                                }

                                                $listdetails_query1 = mysql_query($listdetails1);
                                                while ($listdetails_query_fetch1 = mysql_fetch_array($listdetails_query1)) {
                                                    $fname1 = $listdetails_query_fetch1['first'];
                                                    $mname1 = $listdetails_query_fetch1['middle'];
                                                    $lname1 = $listdetails_query_fetch1['last'];
                                                    $email = $listdetails_query_fetch1['email'];
                                                    $available = $listdetails_query_fetch1['availability'];
                                                    $laststatustime = $listdetails_query_fetch1['laststatustime'];
                                                    $then = new DateTime($laststatustime, new DateTimeZone("Asia/Kolkata"));
                                                    $currentDate = new dateTime();
                                                    $sinceThen = $currentDate->diff($then);
                                                    $y = $sinceThen->y;
                                                    $m = $sinceThen->m;
                                                    $d = $sinceThen->d;
                                                    $h = $sinceThen->h;
                                                    $i = $sinceThen->i;
                                                    $s = $sinceThen->s;


                                                    if ($mname1 == "") {
                                                        $fulname1 = $fname1 . " " . $lname1;
                                                    } else {
                                                        $fulname1 = $fname1 . " " . $mname1 . " " . $lname1;
                                                    }
                                                    $s_1 = $s_1 + 1;
                                                    if ($s_1 % 2) {

                                                        $bg = "#D4D4FF";
                                                    } else {

                                                        $bg = "#EAE8E1";
                                                    }
//folder refining
                                                    ?>

                                                    <tr >
                                                        <td> <?php echo $s_1; ?></td>
                                                        <td><?php echo $fulname1; ?></td>
                                                        <td><?php echo $email; ?></td>
                                                        <td><?php
                                                            if ($available == 'Available') {
                                                                echo "<p style='color:#32CD32;'>$available </p>";
                                                            } elseif ($available == 'Not Available') {
                                                                echo "<p style='color:#FF0000;'>$available </p>";
                                                            } elseif ($available == 'No Status') {
                                                                echo "<p style=''>$available </p>";
                                                            } elseif ($available == 'Cannot Confirm') {
                                                                echo "<p style='color:#FF00FF;'>$available </p>";
                                                            } elseif ($available == 'Looking For Change') {
                                                                echo "<p style='color:#0000FF;'>$available </p>";
                                                            } elseif ($available == '') {
                                                                echo "<p style=''> No Status</p>";
                                                            }
                                                            ?></td>
                                                        <td><?php
                                                            if ($y != 0) {
                                                                echo $y . "   " . "year(s) ago<br>";
                                                            } else if ($m != 0) {
                                                                echo $m . "   " . "month(s) ago<br>";
                                                            } else if ($d != 0) {
                                                                echo $d . "   " . "day(s) ago<br>";
                                                            } else if ($h != 0) {
                                                                echo $h . "   " . "hour(s) ago<br>";
                                                            } else if ($i != 0) {
                                                                echo $i . "   " . "minute(s) ago<br>";
                                                            } else if ($s != 0) {
                                                                echo $s . "   " . "second(s) ago <br>";
                                                            }
                                                            ?></td>
                                                        <td class="center"><center><input type="checkbox" id="del" name="check_list[]" value="<?php echo $membid; ?>"></center></td>
                                                </tr>
                                            <?php
                                            }
                                        }
                                        ?>


                                        </tbody>
                                    </table>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

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
