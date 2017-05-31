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
                    <h1 class="page-header">Voice Messages</h1>
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
                                            <th>Recruiter Name</th> 
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
									
								
                                    <tbody>
									 <?php
        $query_pag_data = "SELECT * from voice_mails where user_id='$recruiter_id' and status='0' ORDER BY id DESC  ";
        $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
        $msg = "";
        while ($res = mysql_fetch_array($result_pag_data)) {
            $recruiterId = $res['recruiterId'];
            $voice = $res['voice'];
            $createdDate = $res['createdDate'];
             $sqlQry = mysql_query("SELECT * FROM `recruiter` WHERE user_id='$recruiterId' ");
    $reqid = mysql_fetch_assoc($sqlQry);
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $res['createdDate']; ?></td>
                                            <td><audio controls><source src="<?php echo $res['voice']; ?>" type="audio/mpeg"></audio></td>
                                            <td><?php echo $reqid['first']; ?></td>
                                            <td class="center"><a href="voiceDel.php?id=<?php echo $res['id']; ?>"><img src="images/del.png" title="Delete"></a></td>
                                        </tr>
                                        
                                    <?php  }
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
