<?php
include('header.php');
if (!isset($_SESSION['first'])) {
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
                <h1 class="page-header">EMDB Voice Mailer</h1>
            </div>
            <!--End Page Header -->
        </div>




        <div class="row">

            <div class="col-lg-12">





                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Voice Message</th>
                                        <th>Jobseeker Name</th> 
                                        <th>Mail Status</th> 
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $rvid = $_GET['id'];
                                    $vcm = $_GET['vcm'];
                                    $strde = base64_decode($vcm);
                                    $query_pag_data = "SELECT * from voicemail_users where recruiter_id='$recruiter_id' and mail_id='$rvid' and status = '0' or status = '2' ORDER BY id DESC  ";
                                    $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
                                    $msg = "";
                                    while ($res = mysql_fetch_array($result_pag_data)) {
                                        $user_id = $res['user_id'];
                                        $createdDate = $res['createdDate'];
                                        $sqlQry = mysql_query("SELECT * FROM `user` WHERE user_id='$user_id' ");
                                        $reqid = mysql_fetch_assoc($sqlQry);
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $res['createdDate']; ?></td>
                                            <td><audio controls><source src="<?php echo $strde; ?>" type="audio/mpeg"></audio></td>
                                            <td><?php echo $reqid['first']; ?></td>
                                            <td><?php  if($res['view_status'] ==1){ echo "<spam style='color:green;'>OPENED</spam>";}else{echo "NOT OPENED";} ?></td>
                                            <td class="center"><a href="viewUser.php?id=<?php echo $res['user_id']; ?>"><img src="images/view_16x16.gif" title="View"></a> <a href="voiceDel.php?useid=<?php echo $res['user_id']; ?>&vmid=<?php echo $res['id']; ?>"><img src="images/del.png" title="Delete"></a></td>
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
