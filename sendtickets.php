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
 $role = $_SESSION['role']; 
?>
<!--tooltip------>
        <?php include ("tooltip.html"); ?>
<!--tooltip------>
<body>
<script type="text/javascript">

            function experie(textbox) {
                if (document.getElementById('experience').value == '')
                {
                    textbox.setCustomValidity('Please Enter Subject');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
          
            
            function priskills(textbox) {
                if (document.getElementById('pskills').value == '')
                {
                    textbox.setCustomValidity('Please Enter Message');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            

        </script>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
          <?php  include('sidemenu.php'); ?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Ticket</h1>
						<button class="btn btn-info" style="float:right;" onclick="history.go(-1);"><i class="fa fa-reply"></i> Back</button>
                </div>
                <!--End Page Header -->
            </div>

              
            

            <div class="row">
			
                <div class="col-lg-6">


				<?php
				if (isset($_POST['subject'])) {
					 $createdDate = date("Y-m-d");
					 $subject = $_POST['subject'];
					 $message = $_POST['message'];
					  
				
				  
            $to='support@employeemasterdatabase.com';		
 		    $femail = $_SESSION['email']; 
			
				
				 if($role ==3){
						 $query = "INSERT INTO `tickets` (subject, message,attachement,user_id,recruiter_id,createdDate, status) VALUES ('$subject', '$message', '','','$e_id','$createdDate', 'Pending')"; 
						 sendTicket($to,$message, $subject, $femail, $fulname);
				 }else{
					 $query = "INSERT INTO `tickets` (subject, message,attachement,user_id,recruiter_id,createdDate, status) VALUES ('$subject', '$message', '','$e_id','','$createdDate', 'Pending')";	 
					 sendTicket($to,$message, $subject, $femail, $fulname);	
				 }
				$result = mysql_query($query) or die('MySql Error' . mysql_error());  
                                 echo "Ticket Created Successfully.";
	
   }
?>
				
			
				
				
				
				<div class="panel panel-default">
                        
				<form action="" method="POST" enctype="multipart/form-data" role="form" style="padding:20px;" width="100% ">
<table cellspacing="10px" style="  border-spacing: 10px; 
    border-collapse: separate;" width="100% ">


            <tr>
<td><input class="form-control" type="text" id="experience" oninvalid="experie(this);" oninput="experie(this);"   required="required" name="subject" value="" placeholder="Enter Subject" /></td>
          </tr>

          
            
          <tr><td colspan="2" >  <textarea class="form-control"   oninvalid="priskills(this);" oninput="priskills(this);" name="message" id="pskills" required="required"  style="margin: 0px;
    width: 98%;
    height: 184px;" placeholder="Enter Message"></textarea></td></tr>
            
 								
											
<!--          <tr><td colspan="2"><input type="file" name="image" /></td></tr>-->
		  
          <tr><td colspan="2"><button type="submit" id="register"  value="Submit" class="btn btn-primary">Submit</button></td></tr>
		  </table>
        </form>

			
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				

                    <!--Area chart example -->
                    
                    <!--End area chart example -->
                    <!--Simple table example -->
                     
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
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>

</body>

</html>
