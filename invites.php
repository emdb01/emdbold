<?php
error_reporting(0);
include('header.php');

if ($_SESSION['role'] != 1 && $_SESSION['role'] != 4) {
    header("Location:index.php");
    die();
}
if (isset($_POST['resetfilter'])) {
    unset($_GET['datefrom']);
    unset($_GET['dateto']);
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
                    <h1 class="page-header">Invites</h1>
                </div>
                <!--End Page Header -->
            </div>
            <?php
            $nameSearch = $_GET['datefrom'];
            $refineSearch = $_GET['dateto'];
            ?>



            <div class="row">

                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Date Wise Mails

                        </div>
                        <div class="panel-body">


                            <form action=""   method="GET" name="searchtermform"  id="searchtermform"  >
                                <div class="col-lg-2" >
                                    <input type="text" id="datepicker" name="datefrom" required placeholder="From Date" class="form-control">
                                </div> 
                                <div class="col-lg-2">
                                    <input type="text" id="datepickerto" name="dateto" required placeholder="To Date" class="form-control">
                                </div>



                                <div class="col-lg-2" style="">
                                    <button type="submit" class="btn btn-primary" id="refine" style="float: right;margin-right: -40px;" value="Refine" style="">Generate</button>
                                </div>


                            </form>
                            <div class="col-lg-2" style="">
                                <form action="invites.php"  method="post">
                                    <?php if ($_GET['datefrom'] != '' || $_GET['dateto'] != '') { ?>
                                        <input type="submit" size="11"  id="resetfilter2" style="float: right;" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float: right;margin-right: 100px;">
                                    <?php } ?>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>




                <?php if ($_GET['serterm'] != '') { ?>
                    <div class="col-lg-12">
                        <div class="alert" style="background-color:#808080;color:#fff;">
                            <center><b>

                                    <?php if ($_GET['serterm'] != '') { ?>
                                        Search results for    &nbsp;&nbsp; <b>"<?php echo $_GET['serterm']; ?>"</b>
                                    <?php }
                                    ?>  


                                </b></center>
                        </div>
                    </div>
                <?php } ?>
                <?php
                ?>

                <form action="invitesexcelsheet.php"  name="checkval" id="checkval"   method="post"  >
                    <input type="hidden"    name="nameSearch" value="<?php echo $nameSearch; ?>"/>
                    <input type="hidden"    name="refineSearch" value="<?php echo $refineSearch; ?>"/>
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
                                <?php }
                                ?>

                            <?php } ?>   
                        </div></div>
                    <div class="col-lg-12">
                        
                        <!--  below script is used for datatables-->
                        <script type="text/javascript" language="javascript" >
                            $(document).ready(function () {
                                var nameSearch = "<?php echo $nameSearch; ?>";
                                var refineSearch = "<?php echo $refineSearch; ?>";
                                var dataTable = $('#employee-grid').DataTable({
                                    "processing": true,
                                    "serverSide": true,
                                    "ajax": {
                                        url: "invites-grid-data.php", // json datasource
                                        type: "post", // method  , by default get
                                        data: ({nameSearch: nameSearch,refineSearch:refineSearch}),
                                        error: function () {  // error handling
                                            $(".employee-grid-error").html("");
                                            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                                            $("#employee-grid_processing").css("display", "none");

                                        }
                                    }
                                });

                            });
                        </script>

                        <!--  below script is used for datatables-->

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="employee-grid"  class="table table-striped table-bordered table-hover" id="dataTables-example"  >
                                        <thead>
                                            <tr>

                                                <th>Email</th>
                                                <th>Created Date</th>
                                                <th>View</th>
                                                <th> Select All <input type="checkbox" id="selecctall" value="select" style="margin-left: 15%;" onClick="do_this()" /> </th>
                                            </tr>
                                        </thead>
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
    <!-- <script src="assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script>
                                                    $(document).ready(function () {
                                                        $('#dataTables-example').dataTable();
                                                    });
    </script>
    <link rel="stylesheet" href="css/datepicr.css">
<!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <script src="js/datepicr.js"></script>
    <script>
                                                        $(function () {
                                                            $("#datepicker").datepicker({
                                                                changeMonth: true,
                                                                changeYear: true
                                                            });
                                                            $("#datepickerto").datepicker({
                                                                changeMonth: true,
                                                                changeYear: true
                                                            });
                                                        });
    </script>

</body>
