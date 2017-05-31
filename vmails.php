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
    <!--Popup for View Resume  and Voice message------>
<!--<script src="js/jquery-1.10.2.min.js"></script>---->
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/vmpopup.js"></script>
    <link href="css/portBox.css" rel="stylesheet" />
    <!--Popup for View Resume  and Voice message------>
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
            <div class="col-lg-6">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Title Search 

                    </div>
                    <div class="panel-body">


                        <form action=""   method="GET" name="searchtermform"  id="searchtermform"  >
                            <input class="form-control" type="text" oninvalid="SearchTermCheck(this);"  oninput="SearchTermCheck(this);"   required="required" placeholder="Search by title" id="serterm"  name="subser" value="" style="float:left;margin-right:20px;width:70%">

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
                 <div class="changep">
                    <a href="newvoice.php"><button type="button" class="btn btn-info"> New Voice </button></a>
                    <a href="extvoice.php"><button type="button" class="btn btn-info"> Existing Voice </button></a>
                    <a href="autvoice.php"><button type="button" class="btn btn-info"> Automated Voice </button></a>

                </div>
                <p style="margin-left:87%;">
<!--                    <button type="submit" class="btn btn-info" data-display="mySite" style="background-color: green;border-color: green;"><i class="fa fa-microphone"></i> Voice message</button>-->
                </p>  </div>

            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Voice Message</th>
                                        <th>Title</th> 
                                        <th>Actions</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    if (isset($_GET['subser'])) {

                                        $query_pag_data = "SELECT * from voice_mails where recruiterId='$recruiter_id' and title LIKE '%" . $_GET['subser'] . "%' and status = '0' or status = '2' ORDER BY id DESC  ";
                                    } else {
                                        $query_pag_data = "SELECT * from voice_mails where recruiterId='$recruiter_id' and (status = '0' or status = '2') ORDER BY id DESC  ";
                                    }
                                    $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
                                    $msg = "";
                                    while ($res = mysql_fetch_array($result_pag_data)) {
                                        $user_id = $res['user_id'];
                                        $voice = $res['voice'];
                                        $createdDate = $res['createdDate'];
                                        $sqlQry = mysql_query("SELECT * FROM `user` WHERE user_id='$user_id' ");
                                        $reqid = mysql_fetch_assoc($sqlQry);
                                        $stren = base64_encode($res['voice']);
                                        ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $res['createdDate']; ?></td>
                                            <td><audio controls><source src="<?php echo $res['voice']; ?>" type="audio/mpeg"></audio></td>
                                            <td><?php echo $res['title']; ?></td>
                                            <td class="center"><a href="voicerecievers.php?id=<?php echo $res['id']; ?>&vcm=<?php echo $stren; ?>"><img src="images/view_16x16.gif" title="View"></a> <a href="voiceDel.php?id=<?php echo $res['id']; ?>"><img src="images/del.png" title="Delete"></a></td>
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
<div id="mySite" class="portBox" style="width: 38%;left: 359.5px;">
<!--    <b id="falseOpen" style=""><center>Please Select Atleast One Entry.</center></b>-->
    <div id="trueOpen">
        <div id="loadStatus"><img src="images/ajaxloader.gif"/> Sending...</div>
        <div id="autosuccessmail"></div>
        <div id="presuccessmail"></div>
        <div id="predelsuccessmail"></div>
        <div id="alrtCreateAuto"></div>

        <b style="color:red;">Note:</b> <spam style="font-family: Times New Roman, Times, serif;">You can send voice mails only to the candidates with status 'Available' or 'Looking for change'</spam>
        <br>
        <b style="color:red;">Note:</b> <spam style="font-family: Times New Roman, Times, serif;">To successfully send your voice mail, please make sure that the recording does not exceed 45

            seconds.</spam>
        <br><br>
        <spam id="TimeAlert" style="font-family: Times New Roman, Times, serif;color:red;">You have reached 45 seconds.</spam>
        <spam id="nMS" style="font-family: Times New Roman, Times, serif;">   <input type="checkbox" id="nvoicemails" style="margin-left:0px;" value="NewVoiceMail" name="nvoicemail"> New Message</spam><br>
        <spam id="pMS" style="font-family: Times New Roman, Times, serif;">  <input type="checkbox" id="pvoicemails" style="margin-left:0px;" value="PreviousVoiceMail" name="pvoicemail"> Send Existing  Message</spam><br>
        <spam id="autoMS" style="font-family: Times New Roman, Times, serif;"><input type="checkbox" id="automails" style="margin-left:0px;" value="Automated" name="automail"> Send Automated  Message</spam>


        <?php
        include("vrecord.php");
        ?>  



        <?php
        $latestVoice = mysql_query("select * from  voice_mails  where recruiterId='$recruiterId' and status ='0' ORDER BY `id` DESC");
        ?>
        <div id="pvmailsAudio">
            <select name="req" id="req" required class="form-control">
                <option value=""></option>
                <?php
                while ($prelist = mysql_fetch_array($latestVoice)) {
                    ?>
                    <option value="<?php echo $prelist['id'] ?>" ><?php echo $prelist['title'] ?></option>
                <?php } ?>
            </select><br> 
            <p id="vmget"></p>

            <a class="button" id="preVoiceSend">Send</a>
            <a class="button" id="preVoiceDelete">Delete</a>
        </div>

        <div id="requir">  
            <select name="req" id="reqa" required class="form-control">
                <option value=""></option>
                <?php
                $reqquery = mysql_query("SELECT * from requirement where recruiterId='$mid'");
                while ($reqlist = mysql_fetch_array($reqquery)) {
                    ?>

                    <option value="<?php echo $reqlist['jobTitle'] ?>" ><?php echo $reqlist['jobTitle'] ?></option>
                <?php } ?>
            </select> &nbsp; or <input type="text" class="form-control" required name="req" id="reqr"><br>
            <spam id="alertMsg" style="color: red;"> Please Enter Requirement</spam>
        </div>
        <p id="getAutoVoice"></p>
        <a class="button disabled two" id="autoSend">Create</a>
        <a class="button disabled two" id="autoSending">Send</a>


    </div>
</div>