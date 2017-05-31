<?php
include('header.php');
if (!isset($_SESSION['first'])) {
    header("Location:index.php");
    die();
}
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if (isset($_POST['resetfilter'])) {
    unset($_GET['serterm']);
}
if (isset($_POST['resetfilter'])) {
    unset($_GET['subser']);
}
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$recruiter_id = $_SESSION['user_id'];
?>
<body>
    <!--tooltip------>
    <?php include ("tooltip.html"); ?>
    <!--tooltip------>
<head>

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
</head>
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
                <h1 class="page-header">EMDB  Mailer</h1>
            </div>

            <!--End Page Header -->
        </div>




        <div class="row">
            <div class="col-lg-6">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Subject Search 

                    </div>
                    <div class="panel-body">


                        <form action=""   method="GET" name="searchtermform"  id="searchtermform"  >
                            <input class="form-control" type="text" oninvalid="SearchTermCheck(this);"  oninput="SearchTermCheck(this);"   required="required" placeholder="Search by subject" id="serterm"  name="subser" value="" style="float:left;margin-right:20px;width:70%">

                            <button type="submit" id="searchterm"  value="Search" style="width: 25%;" class="btn btn-primary">Search</button>
                        </form>
                        </br>
                        <?php if (isset($_GET['subser'])) { ?>
                            <form action="" name="checkavail" id="checkavail"  method="post"  >
                                <button   type="submit"  id="resetfilter1" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float: right;width: 25%;margin-right: 3px;margin-top: 10px;">Reset Filter</button>

                            </form>
                        <?php } ?> 
                    </div>

                </div>
            </div>



            <!--            <div class="col-lg-6">
            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Resume Search 
                                </div>
                                <div class="panel-body">
                                    <form action=""   method="GET"   >
                                        <input class="form-control" type="text"    required="required" placeholder="Search by resume or email" id="serterm"  name="serterm" value="<?php echo @$searchvalue; ?>" style="float:left;margin-right:20px;width:70%">
            
                                        <button type="submit" id="searchterm"  value="Search" style="width: 25%;" class="btn btn-primary">Search</button>
                                    </form> </br>
                                    <form action=""  method="post">
            <?php if (isset($_GET['serterm'])) { ?>
                                                    <button   type="submit"  id="resetfilter1" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float: right;width: 25%;margin-right: 3px;margin-top: 10px;">Reset Filter</button>
            <?php } ?>
            
                                    </form>
                                </div>
            
                            </div>
                        </div>-->
 <?php if ($_GET['subser'] != '') { ?> 
              <div class="col-lg-12">
                        <div class="alert " style="background-color:#808080;color:#fff;">
                            <center>
                                Search results for   &nbsp;&nbsp;<b>"<?php echo $_GET['subser']; ?>"
                                    </b></center>
                        </div>
                    </div>
            <?php } ?>
            <div class="col-lg-12">





                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Subject</th>
<!--                                        <th>Candidate Name</th> -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    if (isset($_GET['subser'])) {

                                        $query_pag_data = "SELECT * from text_mails where id IN (select mail_id from textmail_users where recruiter_id='$recruiter_id')  and status='0' and subject LIKE '%" . $_GET['subser'] . "%' ORDER BY id DESC  ";
                                    } else {
                                        $query_pag_data = "SELECT * from text_mails where recruiter_Id='$recruiter_id' and status='0' ORDER BY id DESC  ";
//                                        $query_pag_data = "SELECT * FROM `text_mails` where id IN (select mail_id from textmail_users where recruiter_id='$recruiter_id') and status='0' ORDER BY id DESC  ";
                                    }

                                    $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
                                    $msg = "";

                                    while ($res = mysql_fetch_array($result_pag_data)) {
                                        $id = $res['id'];
                                        $subject = $res['subject'];
                                        $createdDate = $res['createdDate'];
                                        $sqlQrys = mysql_query("SELECT * FROM `textmail_users` WHERE mail_id='$id'  ");
                                        $reqids = mysql_fetch_assoc($sqlQrys);
                                        $usId = $reqids['user_id'];
                                        $sqlQry = mysql_query("SELECT * FROM `user` WHERE user_id='$usId'  ");
                                        $reqid = mysql_fetch_assoc($sqlQry);
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $res['createdDate']; ?></td>
                                            <td><?php echo $res['subject']; ?></td>
<!--                                            <td><?php echo $reqid['first']; ?></td>-->
                                            <!--<td class="center"><a href="rviewmsg.php?id=<?php echo $res['id']; ?>&ui=<?php echo $usId; ?>"><img src="images/view_16x16.gif" title="View"></a> <a href="msgDel.php?id=<?php echo $res['id']; ?>"><img src="images/del.png" title="Delete"></a></td>-->
                                            <td class="center"><a href="messageslist.php?id=<?php echo $res['id']; ?>&ui=<?php echo $usId; ?>"><img src="images/view_16x16.gif" title="View"></a> <a href="msgDel.php?id=<?php echo $res['id']; ?>"><img src="images/del.png" title="Delete"></a></td>
                                        </tr>

                                    <?php }
                                    ?> 
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
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
<script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
</script>

</body>

</html>
