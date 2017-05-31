<?php
error_reporting(0);
include('header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location:index.php");
    die();
}
if (isset($_POST['resetfilter'])) {
    unset($_GET['q']);
    unset($_GET['Refine']);
    unset($_GET['serterm']);
}
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$mid = $_SESSION['user_id'];
?>
<head>
    <script src="js/jquery.min.js"></script>
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
  
    <!-----this script for select all checkboxes----->
    <!--Popup for View Resume  and Voice message------>
<!--<script src="js/jquery-1.10.2.min.js"></script>---->
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/portBox.slimscroll.min.js"></script>
    <link href="css/portBox.css" rel="stylesheet" />
    <!--Popup for View Resume  and Voice message------>
</head>
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
                    <h1 class="page-header">Not Verified Job Seekers</h1>
                </div>
                <!--End Page Header -->
            </div>




            <div class="row">

                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Quick Search 

                        </div>
                        <div class="panel-body">


                            <form action="<?php echo $searchaction; ?>"   method="GET" name="searchtermform"  id="searchtermform"  >
                                <input class="form-control" type="text" oninvalid="SearchTermCheck(this);"  oninput="SearchTermCheck(this);"   required="required" placeholder="Search by file name Or email" id="serterm"  name="serterm" value="<?php echo @$searchvalue; ?>" style="float:left;margin-right:20px;width:70%">
                                <?php
                                if (isset($_GET['q'])) {
                                    $selectvalue = $_GET['q'];
                                    ?>
                                    <input type="hidden" id="q"  name="q" value="<?php echo $selectvalue; ?>">

                                <?php } ?>
                                <?php if ($_POST['refinesubfolder'] != '') { ?>
                                    <input type="hidden" name="sublink" value="<?php echo $_POST['refinesubfolder']; ?>"> 
                                <?php } else if ($_GET['sublink'] != '') { ?>
                                    <input type="hidden" name="sublink" value="<?php echo $_GET['sublink']; ?>">
                                <?php } ?>
                                <button type="submit" id="searchterm"  value="Search" style="width: 25%;" class="btn btn-primary">Search</button>
                            </form>
                            </br>
                            <?php if ($_GET['id'] == '1') { ?>
                                <form action="notverifyjobseeker.php" name="checkavail" id="checkavail"  method="post"  >
                                    <button   type="submit"  id="resetfilter1" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float: right;width: 25%;margin-right: 3px;margin-top: 10px;">Reset Filter</button>

                                </form>
                            <?php } ?> 
                        </div>

                    </div>
                </div>



                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Advanced Search 
                        </div>
                        <div class="panel-body">
                            <form action="<?php echo $refineaction; ?>"   method="GET" > 

                                <div class="form-group col-lg-12">
                                    <?php if ($_POST['refinesubfolder'] != '') { ?>
                                        <input type="hidden" name="sublink" value="<?php echo $_POST['refinesubfolder']; ?>"> 
                                    <?php } else if ($_GET['sublink'] != '') { ?>
                                        <input type="hidden" name="sublink" value="<?php echo $_GET['sublink']; ?>">
                                    <?php } else if ($_POST['folderspecify'] != '') { ?>
                                        <input type="hidden" name="sublink" value="<?php echo $_POST['folderspecify']; ?>">
                                    <?php } ?>







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
                                        <option value="Not Available" <?php
                                        if ($selectvalue == "Not Available") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >Not Available</option>
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
                                        <option value="Cannot Confirm" <?php
                                        if ($selectvalue == "Cannot Confirm") {
                                            echo "selected=\"selected\"";
                                        }
                                        ?> >Cannot Confirm</option>

                                    </select>
                                    <?php
                                    if (isset($_GET['serterm'])) {
                                        $searchvalue = $_GET['serterm'];
                                        ?>
                                        <input type="hidden" id="serterm"  name="serterm" value="<?php echo $searchvalue; ?>">

                                    <?php }
                                    ?>


                                    <button type="submit" class="btn btn-primary" id="refine"  value="Refine" style="float:right;width: 25%;">Refine</button>

                                </div>

                            </form>
                            <form action="notverifyjobseeker.php?Refine=0&serterm=<?php echo $_GET['serterm']; ?>&q=<?php echo $_GET['q']; ?>"  method="post">
                                <?php if ($_GET['q'] != '' || $_GET['serterm'] != '') { ?>
                                    <input type="submit" size="11"  id="resetfilter2" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float:right;width: 23%; margin-right: 15px;">
                                <?php } else if ($_GET['Refine'] == '0') { ?>
                                    <input type="submit" size="11"  id="resetfilter2" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float:right;width: 23%; margin-right: 15px;">
                                <?php } ?>
                            </form>
                        </div>

                    </div>
                </div>

                <?php if ($_GET['q'] != '' || $_GET['serterm'] != '') { ?>
                    <div class="col-lg-12">
                        <div class="alert " style="background-color:#808080;color:#fff;">
                            <center><b>
                                   
                                    <?php if ($_GET['q'] != '' && $_GET['serterm'] != '') { ?>
                                        Search results for    &nbsp;&nbsp;<b> "<?php echo $_GET['q']; ?>"</b>  & <b> "<?php echo $_GET['serterm']; ?>" </b>
                                    <?php }  else if ($_GET['q'] != '') { ?>
                                        Search results for    &nbsp;&nbsp;<b> "<?php echo $_GET['q']; ?>"</b> 
                                        <?php
                                    } else if ($_GET['serterm'] != '') {
                                        $nameSearch = $_GET['serterm'];
                                        $pos = strpos($nameSearch, '@');
                                        if ($pos !== false) {
                                            $semail = 1;
                                        } else {
                                            $semail = 0;
                                        }
                                        ?>
                                        Search results for    &nbsp;&nbsp;<b> "<?php echo $_GET['serterm']; ?>"</b>
                                    <?php } ?>
                                  
                                  

                                </b></center>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-lg-12">
                

                  
                    <form action=""  name="checkval" id="checkval"   method="post"  >		


                        <div class="" style="" id='contact-form'>
                            <p style="margin-left:85.5%;">
                                <button type="submit" class="btn btn-info" data-display="mymessage"  ><i class="fa fa-envelope"></i> Send Verification</button>

                            </p>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th> Name	</th>
                                                <th>Email</th>
                                                <th>Availability</th> 
                                                <th>Created Date</th> 
                                                <th>View</th>
                                                <th> Select All <input type="checkbox" id="selecctall" value="select" style="margin-left: 15%;" onClick="do_this()" /> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $nameSearch = $_GET['serterm'];
                                            $refineSearch = $_GET['q'];
                                            $pos = strpos($nameSearch, '@');
                                            if ($pos !== false) {
                                                $semail = 1;
                                            } else {
                                                $semail = 0;
                                            }
                                            if (strlen($refineSearch) > 1 && strlen($nameSearch) > 1) {
                                                if ($semail == 0) {
                                                    if ($refineSearch == 'No Status') {
                                                        $query_pag_data = "SELECT * FROM `user` where (availability =  '$refineSearch' OR availability =  '')   and first LIKE  '%{$nameSearch}%' and role=2 and verify=2 and status=2";
                                                    } else {
                                                        $query_pag_data = "SELECT * FROM `user` where availability =  '$refineSearch'    and first LIKE  '%{$nameSearch}%' and role=2 and verify=2 and status=2";
                                                    }
                                                } else if ($semail == 1) {
                                                    if ($refineSearch == 'No Status') {
                                                        $query_pag_data = "SELECT * FROM `user` where (availability =  '$refineSearch' OR availability =  '') and email =  '$nameSearch' and role=2 and verify=2 and status=2";
                                                    } else {
                                                        $query_pag_data = "SELECT * FROM `user` where availability =  '$refineSearch' and email =  '$nameSearch' and role=2 and verify=2 and status=2";
                                                    }
                                                }
                                            } else if (strlen($refineSearch) > 1) {
                                                if ($refineSearch == 'No Status') {
                                                    $query_pag_data = "SELECT * FROM `user` where (availability =  '$refineSearch' OR availability =  '') and role=2 and verify=2 and status=2";
                                                } else {
                                                    $query_pag_data = "SELECT * FROM `user` where availability =  '$refineSearch' and role=2 and verify=2 and status=2";
                                                }
                                            } else if (strlen($nameSearch) > 1) {
                                                if ($semail == 0) {
                                                    $query_pag_data = "SELECT * FROM `user` where first LIKE  '%{$nameSearch}%' and role=2 and verify=2 and status=2";
                                                } else if ($semail == 1) {
                                                    $query_pag_data = "SELECT * FROM `user` where email LIKE  '%{$nameSearch}%' and role=2 and verify=2 and status=2";
                                                }
                                            } else {
                                                $query_pag_data = "SELECT * FROM `user` where role=2 and verify=2 and status=2 order by user_id DESC" ;
                                            }
                                            $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
                                            $msg = "";
                                            $d = 1;
                                            while ($res = mysql_fetch_array($result_pag_data)) {
                                                $available = $res['availability'];
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $res['first']; ?></td>
                                                    <td><?php echo $res['email']; ?></td>
                                                    
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
                                                    <td><?php echo $res['createdDate']; ?></td>
                                                  
                                                    <?php
                                                    echo '<input  name="userId[]" value="' . $res['user_id'] . '" id="userId' . $d . '" type="hidden">';
                                                    echo '<td><a target="_blank" href="viewUser.php?id=' . $res['user_id'] . '&machedId=' . $machedId . '"><i class="fa fa-eye"></i></a>  </td>';
                                                    echo '<td class="center"><center><input   name="check_list[]"  value="' . $res['user_id'] . '" id="' . $d . '" type="checkbox"></center></td>';
                                                    ?>



                                                </tr>

    <?php
    $d++;
}
?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

    </div>
      <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.simplemodal.js'></script>
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/message.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>

</body>


<div id="mymessage" class="portBox" style="width: 38%;left: 359.5px;top: 167px!important;">
    <b id="notvalidOpen" style=""><center>Please Select Atleast One Record.</center></b>
    <div id="loadStatus1"><img src="images/ajaxloader.gif"/> Sending...</div>
    <div id="succMsg" style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Verification mail has been sent successfully.</div>
    <div id="validOpen">
        <p><b>Are you sure you want to send verification mail.</b></p>
        <button type="submit"  id="sendButton" class="btn btn-info" onclick="sendVerification();"> Send </button>


    </div>
</div>
