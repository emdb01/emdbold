<?php
error_reporting(0);
include('header.php');

if ($_SESSION['role'] != 1 && $_SESSION['role'] != 4) {
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
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
    <script language="javascript">

        $(document).ready(function ()
        {

//                $('#resetfilter1').hide();
            $('#folderspecify').change(function ()
            {
                var foldername = $(this).val();

                $('#resetfilter2').hide();
                $.ajax({data: {foldername: foldername}, url: "refinefolder.php", success: function (result) {
                        $("#folderspecifyres").html(result);
                        $('#refinefolder').hide();



                    }});

            });
            $('#q').change(function ()
            {
//                     $('#resetfilter1').show();    
            });


        });

        /* Search Term */
        function SearchTermCheck(textbox) {
            if (document.searchtermform.serterm.value == "")
            {
                textbox.setCustomValidity('Please keyin a search term');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;

        }
        /* Search Term */

        function nameis() {
            if (document.nameoffile.newname.value == "")
            {
                alert("Please keyin a new name");
                document.nameoffile.newname.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>


        /* alert for search with EMDB  id*/

        function SearchEmdbId(textbox) {

            if (document.checkavail.searchemdb.value.length !== 16)
            {
                textbox.setCustomValidity('Please key in a valid EMDB');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }

        /* alert for search with EMDB  id*/


        /* alert for refinesubfolder */

        function folders(textbox) {
            if (document.getElementById('folderspecify').value == '')
            {
                textbox.setCustomValidity('Please select parent folder');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }

        function refinesubfol(textbox) {
            if (document.getElementById('refinesubfolder').value == '')
            {
                textbox.setCustomValidity('Please select parent folder');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }



    </script>
    <!-----this script for select all checkboxes----->
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
                    <h1 class="page-header">Job Seekers</h1>
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
                                <form action="adminpanel.php" name="checkavail" id="checkavail"  method="post"  >
                                    <button   type="submit"  id="resetfilter1" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float: right;width: 25%;margin-right: 3px;margin-top: 10px;">Reset Filter</button>

                                </form>
                            <?php } ?> 
                        </div>

                    </div>
                </div>



                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Refine Search 


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
                              <form action="adminpanel.php?Refine=0&serterm=<?php echo $_GET['serterm']; ?>&q=<?php echo $_GET['q']; ?>"  method="post">
 <?php if ($_GET['q'] != '' || $_GET['serterm'] != '') { ?>
                                    <input type="submit" size="11"  id="resetfilter2" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float:right;width: 23%; margin-right: 15px;">
                                <?php } else if ($_GET['Refine'] == '0') { ?>
                                    <input type="submit" size="11"  id="resetfilter2" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float:right;width: 23%; margin-right: 15px;">
                                <?php } ?>
								  </form>
                        </div>

                    </div>
                </div>
                <?php if ($_GET['q'] != '' || $_GET['serterm'] != '' ) { ?>
                    <div class="col-lg-12">
                        <div class="alert alert-info">
                            <center><b>
                                  
                                    <?php if ($_GET['q'] != '' && $_GET['serterm'] != '' ) { ?>
                                        <b> Candidate Is</b> <?php echo $_GET['q']; ?> &  <b>  Name Or (Email) Is</b> <?php echo $_GET['serterm']; ?> 
                                    <?php } else if ($_GET['q'] != '' ) { ?>
                                        <b> Candidate Is</b> <?php echo $_GET['q']; ?> 
                                    <?php } else if ( $_GET['serterm'] != '') { ?>
                                         <b>  Name Or (Email) Is</b> <?php echo $_GET['serterm']; ?> 
                                    <?php } 
                                    ?>  


                                </b></center>
                        </div>
                    </div>
                <?php } ?>
               
                <form action="excel.php"  name="checkval" id="checkval"   method="post"  >
               <!--<input type="submit" size="11" id="unfollow"    name="unfollow" value="Delete"  onclick="return CheckForm();"/>-->
                    <div class="col-lg-12">



                        <div class="changep">
                            <?php if ($_SESSION['role'] == 1) { ?>
                               <button type="submit" class="btn btn-info" name="exportall" ><i class="fa fa-download"></i>  Export All </button>
                                <?php
                            } else if ($_SESSION['role'] == 4) {

                                $userid = $_SESSION['user_id'];
                                $row = mysql_fetch_assoc(mysql_query($sqlComp = "SELECT * FROM `permissions` where `user_id`='$userid' "));
                                $findme = '5';
                                $pos = strpos($row['permissions'], $findme);
                                if ($pos !== false) {
                                    ?>
                                   <button type="submit" class="btn btn-info" name="exportall" ><i class="fa fa-download"></i>  Export All </button>
                                    <?php
                                } ?>

                            <?php } ?>   
                        </div></div>
                <div class="col-lg-12">
                    <?php
//                       echo $_POST['q'];
                    if ($_POST['searchemdb'] != '') {
                        $searchemdbId = $_POST['searchemdb'];
                    } else {
                        $searchemdbId = "0";
                    }
                    if ($_GET['q'] != '') {
                        if ($_GET['serterm'] != '') {
                            $nameSearch = $_GET['serterm'];
                        }
                        $refineSearch = $_GET['q'];
                    } else {
                        $refineSearch = "0";
                    }

                    if ($_GET['serterm'] != '') {
                        $nameSearch = $_GET['serterm'];
                    } else {
                        $nameSearch = "0";
                    }
                    ?>


                 

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Availability</th>
                                                <th>Visits</th> 
                                                <th>Last Login</th> 
                                                <th>View</th>
                                                <th>Select All <input type="checkbox" id="selecctall" value="select" style="margin-left: 15%;" onClick="do_this()" /> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
										
                                            $refineSearch = $_GET['q'];
                                            $pos = strpos($nameSearch, '@');
                                            if ($pos !== false) {
                                                $semail = 1;
                                            } else {
                                                $semail = 0;
                                            }
                                            if (strlen($searchemdbId) > 1) {
                                                $searchemdbId = str_replace("EMDB", "", $searchemdbId);
                                                $query_pag_data = "SELECT * from `user` where role!=1 and role !=4  and `member_id`='$searchemdbId' order by user_id desc";
                                            } else if (strlen($refineSearch) > 1 && strlen($subfolderlink) > 1 && strlen($nameSearch) > 1) {
                                                if ($semail == 0) {
                                                    $query_pag_data = "SELECT * from `user` where role!=1 and role !=4  and `availability`='$refineSearch' and first LIKE '%{$nameSearch}%'  order by user_id desc";
                                                } else if ($semail == 1) {
                                                    $query_pag_data = "SELECT * from `user` where role!=1 and role !=4  and `availability`='$refineSearch' and  `email` LIKE  '%{$nameSearch}%'  order by user_id desc";
                                                }
                                            } else if (strlen($refineSearch) > 1 && strlen($sublink) > 1 && strlen($nameSearch) > 1) {
                                                if ($semail == 0) {
                                                    $query_pag_data = "SELECT * from `user` where role!=1 and role !=4  and `availability`='$refineSearch' and first LIKE '%{$nameSearch}%'  order by user_id desc";
                                                } else if ($semail == 1) {
                                                    $query_pag_data = "SELECT * from `user` where role!=1 and role !=4  and `availability`='$refineSearch' and  `email` LIKE  '%{$nameSearch}%'  order by user_id desc ";
                                                }
                                            } else if (strlen($refineSearch) > 1 && strlen($nameSearch) > 1) {
                                                if ($semail == 0) {
                                                    $query_pag_data = "SELECT * from `user` where role!=1 and role !=4  and `availability`='$refineSearch' and `first` LIKE  '%{$nameSearch}%'  order by user_id desc";
                                                } else if ($semail == 1) {
                                                    $query_pag_data = "SELECT * from `user` where role!=1 and role !=4  and `availability`='$refineSearch' and `email` LIKE  '%{$nameSearch}%'  order by user_id desc";
                                                }
                                            } else if (strlen($subfolderlink) > 1 && strlen($subfolderlink) >= 0) {
                                                $query_pag_data = "SELECT * from `user` where role!=1 and role !=4  order by user_id desc";
                                            } else if (strlen($mainfolderlink) > 1) {
                                                $query_pag_data = "SELECT * from `user` where role!=1 and role !=4 order by user_id desc";
                                            } else if (strlen($refineSearch) > 1) {
                                                $query_pag_data = "SELECT * from `user` where role!=1 and role !=4 and `availability`='$refineSearch' order by user_id desc";
                                            } else if (strlen($nameSearch) > 1) {
                                                if ($semail == 0) {
                                                    $query_pag_data = "SELECT * from `user` where role!=1 and role !=4 and `first` LIKE  '%{$nameSearch}%' order by user_id desc";
                                                } else if ($semail == 1) {
                                                    $query_pag_data = "SELECT * from `user` where role!=1 and role !=4 and  `email` LIKE  '%{$nameSearch}%' order by user_id desc";
                                                }
                                            } else {
                                                $query_pag_data = "SELECT * FROM `user` where role!=1 and role !=4 order by user_id desc";
                                            }
                                            $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
                                            $msg = "";
                                            $d = 1;
                                            while ($res = mysql_fetch_array($result_pag_data)) {
                                                $available = $res['availability'];
												 $visitcount = $res['visits'];
												  $dateTime = $res['dateTime'];
												   $id = $res['user_id'];
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
                                                    <td><?php echo $visitcount; ?>
                                            </td>
										<?php 	 echo "<td>";
                        if ($dateTime == '') {
                            echo "<p style='padding-left:20px;'> Not loged in</p>";
                        }else{
                         echo $dateTime;   
                        }
                        echo "</td>"; ?>
                                            <?php
                                            echo '<input  name="userId[]" value="' . $res['user_id'] . '" id="userId' . $d . '" type="hidden">';
                                            echo '<td><a href="view_profile_admin.php?id=' . $res['user_id'] . '"><i class="fa fa-eye"></i></a>  </td>';
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
