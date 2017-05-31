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
                    <h1 class="page-header">Help Desk</h1>
					  <a href="sendtickets.php" style='float:right;' class="btn btn-info" > <i class="fa fa-ticket"></i>  Create Support Ticket </a>
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
 	
				

				
				<div class="panel panel-default">
                           <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Subject</th>
                                            <th>From</th>
                                             
										<!-- 	<?php $role = $_SESSION['role'];
											if($role !=2 && $role !=3){
											?>
                                           <th>Status</th> 
                                            <th>Update</th>
											<?php }else{	?>
											    <th>Status</th> 
											<?php }	?>											-->
                                            <th>Actions</th>
                                            <th> Select All <input type="checkbox" id="selecctall" value="select" style="margin-left: 15%;" onClick="do_this()" /> </th>
                                        </tr>
                                    </thead>
									
								
                                    <tbody>
									 <?php
									 $role = $_SESSION['role'];
                
									 if($role==3){
									 $query_pag_data= "SELECT * from tickets where user_id IN (select user_id from recruit_users where recruiterId='$e_id') OR recruiter_id='$e_id' order by id desc";
									 }else if($role==2){
									         $query_pag_data = "SELECT * from tickets where user_Id='$e_id'  order by id desc  ";	 
									 }else{
										 $row = mysql_fetch_assoc(mysql_query($sqlComp = "SELECT * FROM `permissions` where `user_id`='$e_id' "));
               $findme = '3';
                $pos = strpos($row['permissions'], $findme);
									         $query_pag_data = "SELECT * from tickets  ORDER BY id DESC  ";	 
									 }

        $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
        $msg = "";
		
        while ($res = mysql_fetch_array($result_pag_data)) {
            $recruiterId = $res['recruiter_id'];
            $user_id = $res['user_id'];
            $subject = $res['subject'];
            $createdDate = $res['createdDate'];
            if($recruiterId !=0){
              $sqlQry = mysql_query("SELECT * FROM `recruiter` WHERE user_id='$recruiterId' ");   
            }else if($user_id !=0){
             $sqlQry = mysql_query("SELECT * FROM `user` WHERE user_id='$user_id' ");    
            }
    $reqid = mysql_fetch_assoc($sqlQry);
     
									?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $res['createdDate']; ?></td>
                                            <td><?php echo $res['subject']; ?></td>
                                            <td><?php echo $reqid['email']; ?></td>
                                            
                                            
								<!--			<?php $role = $_SESSION['role'];
											if($role !=2 && $role !=3){
											?>
                                            <td><select name='status' id=<?php echo "status".$res['id']; ?>  class="form-control">
											<?php if($res['status'] =='Pending') { ?>
											<option value="<?php echo $res['status']; ?>" selected><?php echo $res['status']; ?></option>
											<?php }else{ ?>
											<option value="Pending">Pending</option>
											<?php }?>
												<?php if($res['status'] =='Solved') { ?>
											<option value="<?php echo $res['status']; ?>" selected><?php echo $res['status']; ?></option>
											<?php }else{ ?>
											<option value="Solved">Solved</option>
											<?php }?>
											
											</select></td>
											
											  <td>
											  
											  <button type="button" value="<?php echo $res['id']; ?>" id="tktId" name="tktId" class="btn btn-info" onclick="statusUpdate('<?php echo $res['id']; ?>','<?php echo "status".$res['id'];  ?>');">Upadte</button>
											  
											  </td>
											<?php }else{ ?>
											<td><?php echo $res['status']; ?></td>
											<?php } ?>-->
                                            <td class="center"><a href="viewTicket.php?id=<?php echo $res['id']; ?>"><img src="images/view_16x16.gif" title="View"></a> <?php  if ($pos !== false && $role==4) { ?><a href="tktDel.php?id=<?php echo $res['id']; ?>"><img src="images/del.png" title="Delete"></a><?php  }else if($role==1){ ?><a href="tktDel.php?id=<?php echo $res['id']; ?>"><img src="images/del.png" title="Delete"></a> <?php } else if($role==3 || $role==2){ ?><a href="tktDel.php?id=<?php echo $res['id']; ?>"><img src="images/del.png" title="Delete"></a> <?php } ?></td>
                                     <?php   echo '<td class="center"><center><input   name="check_list[]"  value="' . $res['user_id'] . '" id="' . $d . '" type="checkbox"></center></td>'; ?>
                                        
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
