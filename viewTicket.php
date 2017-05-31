<?php
include('header.php');
error_reporting(0);

if (!isset($_SESSION['user_id'])) {
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
$id = $_GET['id'];
?>
<body>
    <!--Popup for View Resume  and Voice message------>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/portBox.slimscroll.min.js"></script>
    <link href="css/portBox.css" rel="stylesheet" />
    <!--Popup for View Resume  and Voice message------>
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
                    <h1 class="page-header">View</h1>


                </div>
                <!--End Page Header -->
            </div>






            <div class="row">

                <div class="col-lg-12">
                    <div class="changep">
                        <button class="btn btn-info"  onclick="history.go(-1);"><i class="fa fa-reply"></i> Back</button>
                        <a href="#" class="btn btn-info " data-display="mySite"> <i class="fa fa-envelope"></i> Send message </a> 
                    </div>
                </div>
                <div class="col-lg-12">
                    <?php
                    $listdetails = "SELECT * FROM  tickets where id='$id'";
                    $listdetails_query = mysql_query($listdetails);
                    $listdetails_query_fetch = mysql_fetch_assoc($listdetails_query);
                    $subject = $listdetails_query_fetch['subject'];
                    $message = $listdetails_query_fetch['message'];
                    $status = $listdetails_query_fetch['status'];
                    $recruiterId = $listdetails_query_fetch['recruiter_id'];
                    $user_id = $listdetails_query_fetch['user_id'];
                    $atach = $listdetails_query_fetch['attachement'];
                    if ($recruiterId != 0) {
                        $sqlQry = mysql_query("SELECT * FROM `recruiter` WHERE user_id='$recruiterId' ");
                    } else if ($user_id != 0) {
                        $sqlQry = mysql_query("SELECT * FROM `user` WHERE user_id='$user_id' ");
                    }
                    $reqid = mysql_fetch_assoc($sqlQry);
                    ?>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Support details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">

                                    <tbody>
                                        <tr>
                                            <td>Subject</td>
                                            <td><?php echo $subject; ?></td>

                                        </tr>
                                        <tr>
                                            <td>Message</td>
                                            <td><?php echo $message; ?></td>

                                        </tr>
                                        <tr>
                                            <td>From</td>
                                            <td><?php
                                                echo $reqid['email'];
                                                ;
                                                ?></td>

                                        </tr>
<!--                                        <tr>
                                            <td>Status</td>
                                            <td><?php echo $status; ?></td>
                                            
                                        </tr>
                                          <tr>
                                            <td>Attachement</td>
                                            <td><a href='#' data-display="mySite"> <?php if ($atach != '') { ?><i class="fa fa-paperclip fa-3x"></i><?php } ?></a></td>
                                            
                                        </tr>-->
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


</body>

</html>

<div id="mySite" class="portBox" style="width: 30%;left: 359.5px;">

    <label for="email" >Subject:</label><br />
    <input  class="form-control" id="subject"  name="subject" type="text" value="" size="30" /><br />


    <label for="message">Your message:</label><br />
    <textarea  class="form-control" id="message" name="message" rows="7" cols="30"></textarea><br />

    <input id="submit_button" class="btn btn-primary" type="submit" value="Send" onclick='myFunction()' />
    <div id="loadStatus"><img src="images/ajaxloader.gif"/> Sending...</div>
    <div class="the-return"></div>

</div>
<script>
    $("#loadStatus").hide();
    function myFunction() {
        $("#loadStatus").fadeIn("slow");

        var sub = document.getElementById("subject").value;
        var mes = document.getElementById('message').value;
        var email = '<?php echo $_SESSION['email']; ?>';
        var toemail = '<?php echo $reqid['email']; ?>';
        if (sub != '' && mes != '') {
            $.ajax({
                type: "POST",
                url: "sendsupport.php",
                data: 'sub=' + sub + '&mes=' + mes + '&email=' + email + '&toemail=' + toemail,
                cache: false,
                success: function (data) {
                    $("#loadStatus").fadeOut("slow");
                    $(".the-return").html(
                            "<b style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Mail Sent Successfully.</b>"
                            );
                }
            });


        } else {
            $("#loadStatus").hide();
            $(".the-return").html(
                    "<b style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Please Enter Subject and Message.</b>"
                    );
        }
    }
</script>
 <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>