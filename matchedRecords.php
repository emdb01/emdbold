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
if (isset($_POST['resetfilter'])) {
    unset($_POST['q']);
    unset($_POST['serterm']);
}
$recruiter_id = $_SESSION['user_id'];
?>
<!--tooltip------>
<?php include ("tooltip.html"); ?>
<!--tooltip------>
<body>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/portBox.slimscroll.min.js"></script>
    <link href="css/portBox.css" rel="stylesheet" />
    <div style='display:none'>
        <img src='images/loading.gif' alt='' />
    </div>

    <!-- Load JavaScript files -->
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.simplemodal.js'></script>

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
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->

        <!-- end navbar top -->
        <?php include('sidemenu.php'); ?>
        <!-- navbar side -->

        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Matched Resumes</h1>
                </div>
                <!--End Page Header -->
            </div>






            <div class="row">
                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Quick Search 

                        </div>
                        <div class="panel-body">


                            <form action=""   method="POST" name="searchtermform"  id="searchtermform"  >
                                <input class="form-control" type="text" oninvalid="SearchTermCheck(this);"  oninput="SearchTermCheck(this);"   required="required" placeholder="Search by file name or email" id="serterm"  name="serterm" value="<?php echo @$searchvalue; ?>" style="float:left;margin-right:20px;width:70%">

                                <button type="submit" id="searchterm"  value="Search" style="width: 25%;" class="btn btn-primary">Search</button>
                            </form>

                            <?php if (isset($_POST['serterm'])) { ?>
                                <form action="" name="checkavail" id="checkavail"  method="post"  >
                                    <button   type="submit"  id="resetfilter1" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float: right;width: 25%;margin-right: 3px;margin-top: 10px;">Reset Filter</button>

                                </form>
                            <?php } ?> 
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Refine Search 
                        </div>
                        <div class="panel-body">
                            <form action=""   method="POST" > 

                                <select name="q" id="q" class="form-control" style="float:left;margin-right:20px;width:70%">
                                    <option value="" <?php
                                    if ($selectvalue == "") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> >All</option>
                                    <option value="Available"  <?php
                                    if ($selectvalue == "Available") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> >Available</option>
                                    <option value="Looking For Change" <?php
                                    if ($selectvalue == "Looking For Change") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> >Looking For Change</option>
                                    <option value="No Status" <?php
                                    if ($selectvalue == "No Status") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> >No Status</option>
                                    <option value="Not Available" <?php
                                    if ($selectvalue == "Not Available") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> >Not Available</option>

                                    <!--  <option value="Cannot Confirm" <?php
                                    if ($selectvalue == "Cannot Confirm") {
                                        echo "selected=\"selected\"";
                                    }
                                    ?> >Cannot Confirm</option>-->

                                </select>


                                <button type="submit" class="btn btn-primary" id="refine"  value="Refine" style="float:right;width: 25%;">Refine</button>

                            </form>
                            <form action=""  method="post"> 



                                <?php if ($_POST['q'] != '') { ?>
                                       <button   type="submit"  id="resetfilter1" name="resetfilter"  value="Reset Filter" class="btn  btn-success" style="float: right;width: 25%;margin-right: -2px;margin-top: 10px;">Reset Filter</button>
                                    <?php } ?>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12">
                      <?php if (isset($_POST['serterm'])) { ?>
                                <form action="" name="checkavail" id="checkavail"  method="post"  >
                                    <center style="float: left;margin-top: 30px;"> <?php
                                        echo "List of searched candidate  <b>'" . $_POST['serterm'] . "'</b>";
                                        ?>  </center>       

                                </form>
                            <?php } ?>
                    <form action=""  method="post"> 
                                <?php if ($_POST['q'] != '') { ?>
                                    <center style="float: left;margin-top: 30px;"> <?php
                                        $avai = $_POST['q'];
                                        if ($avai == 'Available') {
                                            echo "Your   <spam style='color:#32CD32;'>'$avai'</spam> Candidates";
                                        } elseif ($avai == 'Not Available') {
                                            echo "Your   <spam style='color:#FF0000;'>'$avai' </spam> Candidates";
                                        } elseif ($avai == 'No Status') {
                                            echo "Your   <spam style=''>'$avai' </spam> Candidates";
                                        } elseif ($avai == 'Cannot Confirm') {
                                            echo "Your   <spam style='color:#FF00FF;'>'$avai' </spam> Candidates";
                                        } elseif ($avai == 'Looking For Change') {
                                            echo "Your   <spam style='color:#0000FF;'> '$avai' </spam> Candidates";
                                        } elseif ($avai == '') {
                                            echo "Your   <spam style=''> 'No Status'</spam> Candidates";
                                        }
                                        ?>  </center>     
                                    <?php } ?>
                            </form>
                    <div class="changep">
                        <button type="submit" class="btn btn-info" data-display="mymessage"><i class="fa fa-envelope"></i> Send Message</button>

                        <button type="submit" class="btn btn-info" data-display="mySite" style="background-color: green;border-color: green; "><i class="fa fa-microphone"></i> Voice Message</button>
                        <button type="button" class="btn btn-info" onclick="goBack()"><i class="fa fa-reply"></i> Back </button>
                    </div>

                </div>

                <?php
                $id = $_GET['machedId'];
                $listdetails = "SELECT * FROM `requirement` WHERE id='$id'";
                $listdetails_query = mysql_query($listdetails);
                $res = mysql_fetch_assoc($listdetails_query);
                ?>
                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> S.No.	</th>
                                            <th> Requirement </th>
                                            <th> Resume Name </th>
                                            <th>Availability</th>
                                            <th>Action</th>
                                            <th>Select All <input type="checkbox" id="selecctall" value="select" style="margin-left: 15%;" onClick="do_this()" /></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlQry = mysql_query("SELECT * FROM `requirement` WHERE id='$id' ");
                                        $reqid = mysql_fetch_assoc($sqlQry);
                                        $pskills = $reqid['primarySkills'];
                                        $jobTitle = $reqid['jobTitle'];
                                        $Skills = str_replace(",", "|", $pskills);
                                        if (isset($_POST['serterm'])) {
                                            $query_pag_data = "SELECT *  FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$recruiter_id' and u.skills REGEXP '(^|,)($Skills)(,|$)' and u.first LIKE '%" . $_POST['serterm'] . "%' order by `availability` ASC";
                                        } else if ($_POST['q'] != '') {
                                            $query_pag_data = "SELECT *  FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$recruiter_id' and u.skills REGEXP '(^|,)($Skills)(,|$)' and u.availability='" . $_POST['q'] . "' order by `availability` ASC";
                                        } else {
//                                            $query_pag_data = "SELECT * from user where user_id IN (select user_id from recruit_users where recruiterId='$recruiter_id') and skills REGEXP '(^|,)($Skills)(,|$)' order by `availability` ASC";
                                      $query_pag_data = "SELECT *  FROM `user` AS u INNER JOIN `recruit_users` AS r ON u.user_id = r.user_id and r.recruiterId='$recruiter_id' and u.skills REGEXP '(^|,)($Skills)(,|$)' order by 'availability' ASC";  
                                            
                                        }
                                        $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
                                        $msg = "";
                                        $d = 1;
                                        while ($res = mysql_fetch_array($result_pag_data)) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $d; ?></td>
                                                <td><?php echo $jobTitle; ?></td>
                                                <td><?php echo $res['first']; ?></td>
                                                <td><?php
                                                    $available = $res['availability'];
                                                    if ($available == 'Available') {
                                                        echo "<p style='color:#32CD32;'>$available </p>";
                                                    } elseif ($available == 'Not Available') {
                                                        echo "<p style='color:#FF0000;'>$available </p>";
                                                    } elseif ($available == 'No Status') {
                                                        echo "<p style=''>$available </p>";
                                                    } elseif ($available == 'Cannot Confirm') {
                                                        echo "<p style='color:#FF00FF;'>$available </p>";
                                                    } elseif ($available == 'Looking For Change') {
                                                        echo "<p style='color:#0000FF;'>$available </p>";
                                                    } elseif ($available == '') {
                                                        echo "<p style=''> No Status</p>";
                                                    }
                                                    ?></td>

                                                <?php
                                                echo '<input  name="userId[]" value="' . $res['user_id'] . '" id="userId' . $d . '" type="hidden">';
                                                echo '<td><a href="viewUser.php?id=' . $res['user_id'] . '&machedId=' . $machedId . '"><i class="fa fa-eye"></i></a>  </td>';
                                                echo '<td class="center"><center><input   name="check_list[]"  value="' . $res['user_id'] . '" id="' . $d . '" type="checkbox"></center></td>';
                                                ?>



                                            </tr>

                                            <?php
                                            $d++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />


                    <!--Area chart example -->

                    <!--End area chart example -->
                    <!--Simple table example -->

                </div>

                <div id="mySite" class="portBox" style="width: 38%;left: 359.5px;">
                    <b id="falseOpen" style=""><center>Please Select Atleast One Record.</center></b>
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
                        include("recordAud.php");
                        ?>  



                        <?php
                        $latestVoice = mysql_query("select * from  voice_mails  where recruiterId='$recruiter_id' and status ='0' ORDER BY `id` DESC");
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
                <div id="mymessage" class="portBox" style="width: 38%;left: 359.5px;top: 167px!important;">
                    <b id="notvalidOpen" style=""><center>Please Select Atleast One Record.</center></b>
                    <div id="loadStatus1"><img src="images/ajaxloader.gif"/> Sending...</div>
                    <div id="succMsg" style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Message has been sent successfully.</div>
                    <div id="delsuccMsg" style='color:green;margin-left: 0px;font-family: Times New Roman, Times, serif;'>Message has been deleted successfully.</div>
                    <div id="validOpen">


                        <spam id="newmg"><input type="checkbox" id="ntemps" style="margin-left:0px;" value="NewTemp" name="ntemp">New Message</spam><br>
                        <spam id="premg"> <input type="checkbox" id="ptemps" style="margin-left:0px;" value="PreviousTemp" name="ptemp">Previous Messages</spam>
                        <div id="openPreMsg" ><br>
                            <input type="hidden" name="ownerid" id="getid"  value="<?php echo $mid; ?>">
                            <select name="req" id="reqid" required class="form-control" >
                                <option value=""></option>
                                <?php
                                $reqquery = mysql_query("SELECT subject,message,id from text_mails where  recruiter_id='$mid' and status = 0");
                                while ($reqlist = mysql_fetch_array($reqquery)) {
                                    ?>

                                    <option  value="<?php echo $reqlist['id']; ?>" ><?php echo $reqlist['subject']; ?></option>
                                <?php } ?>
                            </select> <br>
                            <div id="mesgget"> </div>

                            <button type="submit" class="btn btn-info" onclick="sendPremessage();"> Send </button>
                            <button type="submit" class="btn btn-info" onclick="deletePremessage();"> Delete </button>
                        </div> 
                        <div id="openNewMsg" ><br>

                            <input type="hidden" name="ownerid" id="getid"  value="<?php echo $mid; ?>">
                            <form id="reset">
                                <input type="text" name="subject" id="getsubject" required class="form-control" placeholder="Subject"> <br>
                                <textarea name="message" id="getmessage" required class="form-control" style='height: 150px !important;' placeholder="Message">  </textarea> 
                                <br>
                            </form>
                            <button type="submit" onclick="sendNewmessage();" class="btn btn-info" > Send </button>
                            <button type="submit" onclick="reset()" class="btn btn-info" > Reset </button>

                        </div> 

                    </div>
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


    <script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
     <script src="js/message.js"></script>
    <script>
                $(document).ready(function () {
                    $('#dataTables-example').dataTable();
                });
    </script>
</body>

</html>
