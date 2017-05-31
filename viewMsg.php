<?php 
include('header.php');
error_reporting(0);

if (!isset($_SESSION['member_id'])) {
    header("Location:index.php");
    die();
}
$resumeexist = "";
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$mid = $_SESSION['member_id'];
$id=$_GET['id'];
?>
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
                    <h1 class="page-header">Message</h1>
                </div>
                <!--End Page Header -->
            </div>

             


            

            <div class="row">
		
                <div class="col-lg-12">
   <?php
        $listdetails = "SELECT * FROM  textmail_users where id='$id'";
        $listdetails_query = mysql_query($listdetails);
     $listdetails_query_fetch = mysql_fetch_assoc($listdetails_query);
            $mail_id = $listdetails_query_fetch['mail_id'];
            $recruiter_id = $listdetails_query_fetch['recruiter_id'];
            $sqlQrys = mysql_query("SELECT * FROM `text_mails` WHERE id='$mail_id'  ");
                                        $reqids = mysql_fetch_assoc($sqlQrys);
                                        $subject = $reqids['subject'];
                                        $message = $reqids['message'];
             $sqlQry = mysql_query("SELECT * FROM `recruiter` WHERE user_id='$recruiter_id' ");
    $reqid = mysql_fetch_assoc($sqlQry);
     
        ?>
   

<div class="panel panel-default">
                        <div class="panel-heading">
                            Message details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                     
                                    <tbody>
									 <tr>
                                            <td>Recruiter Name</td>
                                            <td><?php echo $reqid['first']; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Subject</td>
                                            <td><?php echo $subject; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Message</td>
                                            <td><?php echo $message;?></td>
                                            
                                        </tr>
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--Area chart example -->
                    
                    <!--End area chart example -->
                    <!--Simple table example -->
                     
                </div>
<div class="col-lg-4">
                    <!-- Donut Example-->
                     
                    <!--End Donut Example-->
                </div>

            </div>

            


         


        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

  
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>

</body>

</html>
