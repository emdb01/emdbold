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
  $e_id = $_SESSION['user_id'];
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
                    <h1 class="page-header">How To Use</h1>
					
                </div>
                <!--End Page Header -->
            </div>

              <br>
            

            <div class="row">
			
                <div class="col-lg-12">
				
				<script>
function statusUpdate(id,status) {
 var status=document.getElementById(status).value;
 $.ajax({
    type: "POST",
    url: 'tktUp.php',
    data: {status: status, id: id},
    success: function(data){
        // alert(data);
    }
});
 
}
</script>
<?php
// if (isset($_POST['update'])) {
// $tktId=$_POST['tktId'];
    // $status=$_POST['status'];
	// echo $query = "UPDATE `tickets` SET  status='$status'  WHERE id='$tktId' ";exit;
    // $result = mysql_query($query);
      
// }
?>
 	
				
<video width="900"  controls>
  <source src="emdb2.mp4" type="video/mp4">
</video>
				
				
				
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
   <!-- <script src="assets/scripts/siminta.js"></script>
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
