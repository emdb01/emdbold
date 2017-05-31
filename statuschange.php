<?php
error_reporting(0);
include('header.php');
include('class.pdf2text.php');
require("class.filetotext.php");

if (!isset($_SESSION['user_id'])) {
    header("Location:index.php");
    die();
}
if (isset($_POST['resetfilter'])) {
    unset($_POST['searchemdb']);
    unset($_GET['q']);
    unset($_GET['Refine']);
    unset($_SESSION['subfolderlink']);
    unset($_SESSION['mainfolderlink']);
    unset($_GET['serterm']);
}
$fname = $_SESSION['first'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$mid = $_SESSION['user_id'];
$mainfolder = "./" . $mid . "/";
$mainfolderlink = "";
$subfolderlink = "";
if (isset($_SESSION['subfolderlink'])) {
    $finalpathfoldersite = $subfolderlink;
}
@$mainfolderlink = $_SESSION['mainfolderlink'];
@$subfolderlink = $_SESSION['subfolderlink'];

$ulink = curPageURL();
$s_1 = 0;
$extoffileis = "";
$finalpathfoldersite = "";
$finalpathfoldersite = "./$mid";
if (isset($_POST['refinefolder'])) {

    @$mainfolderlink = $_POST['folderspecify'];
    @$subfolderlink = $_POST['refinesubfolder'];
    if (@$subfolderlink != "") {
        $finalpathfoldersite = $subfolderlink;
        $_SESSION['subfolderlink'] = $subfolderlink;
        $_SESSION['mainfolderlink'] = $mainfolderlink;
    } else {

        unset($_SESSION['subfolderlink']);
        if (@$mainfolderlink != "") {

            $_SESSION['mainfolderlink'] = $mainfolderlink;
            $finalpathfoldersite = $mainfolderlink;
        } else {
            $finalpathfoldersite = "./$mid";
        }
    }
    unset($_SESSION['subfolderlink']);
    unset($_SESSION['mainfolderlink']);
} else {
    $finalpathfoldersite = "./$mid";
}
if (isset($_SESSION['mainfolderlink'])) {
    $finalpathfoldersite = $mainfolderlink;
}
if (isset($_SESSION['subfolderlink'])) {
    $finalpathfoldersite = $subfolderlink;
}

$recruiterId = $_SESSION['user_id'];
?>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
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
    <script language="javascript">

        $(document).ready(function ()
        {

//                $('#resetfilter1').hide();
            $('#folderspecify').change(function ()
            {
                var foldername = $(this).val();

                $('#resetfilter2').hide();
                $.ajax({data: {foldername: foldername}, url: "refinefolder.php", success: function (result) {
                        $("#folderspecifyres").html(result);
                        $('#refinefolder').hide();



                    }});

            });
            $('#q').change(function ()
            {
//                     $('#resetfilter1').show();    
            });


        });

        /* Search Term */
        function SearchTermCheck(textbox) {
            if (document.searchtermform.serterm.value == "")
            {
                textbox.setCustomValidity('Please keyin a search term');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;

        }
        /* Search Term */

        function nameis() {
            if (document.nameoffile.newname.value == "")
            {
                alert("Please keyin a new name");
                document.nameoffile.newname.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>


        /* alert for search with EMDB  id*/

        function SearchEmdbId(textbox) {

            if (document.checkavail.searchemdb.value.length !== 16)
            {
                textbox.setCustomValidity('Please key in a valid EMDB');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }

        /* alert for search with EMDB  id*/


        /* alert for refinesubfolder */

        function folders(textbox) {
            if (document.getElementById('folderspecify').value == '')
            {
                textbox.setCustomValidity('Please select parent folder');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }

        function refinesubfol(textbox) {
            if (document.getElementById('refinesubfolder').value == '')
            {
                textbox.setCustomValidity('Please select parent folder');
                return false;
            } else {
                textbox.setCustomValidity('');
            }
            return true;
        }



    </script>
    <!-----this script for select all checkboxes----->
    <!--Popup for View Resume  and Voice message------>
<!--<script src="js/jquery-1.10.2.min.js"></script>---->
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/portBox.slimscroll.min.js"></script>
    <link href="css/portBox.css" rel="stylesheet" />
    <!--Popup for View Resume  and Voice message------>
</head>
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
                    <?php  
                    $visits = $_GET['vsts'];
                    $new = $_GET['new'];
                    if($visits =='visits'){?>
                    <h1 class="page-header">Today Job Seeker Visits </h1>
                    <?php }else if($new =='new'){ ?>
                     <h1 class="page-header">Today New Job Seeker Registers </h1>
                    <?php }else { ?>
                       <h1 class="page-header">Today Status Changes List </h1>
                    <?php }?>
                </div>
                <!--End Page Header -->
            </div>




            <div class="row">

                


                    <form action=""  name="checkval" id="checkval"   method="post"  >		

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Availability</th>
                                                <th>Visits</th> 
                                                <th>Last Login</th>
                                                <th>View</th>
                                                <th> Select All <input type="checkbox" id="selecctall" value="select" style="margin-left: 15%;" onClick="do_this()" /> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          $currentDate = date('Y-m-d');
                                          $roleid = $_SESSION['role'];
                                         
                                          if($roleid == 3){
                                              if($visits == 'visits' ){
                                           $query_pag_data = "SELECT * FROM `user` AS u INNER JOIN recruit_users AS r ON u.user_id=r.user_id and r.recruiterId='$recruiterId' and  u.modifiedDate LIKE '%$currentDate%' and u.role=2 and u.visits !=0 ";     
                                          }else if($new == 'new' ){
                                           $query_pag_data = "SELECT * FROM `user` AS u INNER JOIN recruit_users AS r ON u.user_id=r.user_id and r.recruiterId='$recruiterId' and  u.createdDate ='$currentDate' and u.role=2 ";     
                                          }else{ 
   $query_pag_data = "SELECT * FROM `user` AS u INNER JOIN recruit_users AS r ON u.user_id=r.user_id and r.recruiterId='$recruiterId' and u.todaystatus='1' and u.modifiedDate LIKE '%$currentDate%' ";
                                          }
                                          }else if($roleid == 4 || $roleid == 1){
                                              if($visits == 'visits' ){
                                           $query_pag_data = "SELECT * FROM `user` where  modifiedDate LIKE '%$currentDate%' and createdDate !='$currentDate' and role=2 and visits !=0 order by user_id desc";     
                                          }else if($new == 'new' ){
                                           $query_pag_data = "SELECT * FROM `user` where  createdDate ='$currentDate' and role=2 order by user_id desc";     
                                          }else{
                                           $query_pag_data = "SELECT * FROM `user` where  todaystatus='1' and modifiedDate LIKE '%$currentDate%' and createdDate !='$currentDate' order by user_id desc";  
                                          }
                                          } 
                                           
                                            $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
                                            $msg = "";
                                            $d = 1;
                                            while ($res = mysql_fetch_array($result_pag_data)) {
                                                $skls = explode(",", $res['skills']);
                                                $skillsCount1 = count(explode(",", $res['skills']));
                                                $Skills = str_replace(",", "|", $res['skills']);
                                                 $visitcount = $res['visits'];
                                                 $dateTime = $res['dateTime'];

                                                //this below code is maximum matched skills code 
                                                $sqlQry = mysql_query("SELECT * FROM `requirement` WHERE recruiterId='$recruiterId' ");
                                                while ($reqid = mysql_fetch_assoc($sqlQry)) {
                                                    $pskills = $reqid['primarySkills'];
                                                    $skls1 = explode(",", $pskills);
                                                    $skillsCount = count(explode(",", $pskills));
                                                }


                                                $countAry = array();
                                                for ($i = 0; $i <= $skillsCount; $i++) {
                                                    if ($skls[$i] != '') {
                                                        $sql11 = mysql_query("SELECT * FROM `requirement` WHERE primarySkills LIKE '%$skls[$i]%'");
                                                        $sql1 = mysql_num_rows($sql11);
                                                    }
                                                    if ($sql1 > 0 && $skls[$i] != '') {
                                                        if (array_key_exists($id, $countAry))
                                                            $countAry[$id] ++;
                                                        else {
                                                            $countAry[$id] = 1;
                                                        }
                                                    } else {
                                                        
                                                    }
                                                }
//            foreach ($countAry as $key => $value) {
//                if ($value >= $skillsCount / 2) {
//                    //echo $key.">>>>".$value; echo "<br>";
//                }
//            }
                                                //this Above code is  maximum matched skills code   
                                                $sql1 = mysql_query("SELECT * FROM `requirement` WHERE recruiterId='$recruiterId' and primarySkills REGEXP '(^|,)($Skills)(,|$)' ");
                                                $matchcount = mysql_num_rows($sql1);
                                                $available = $res['availability'];
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $res['first']; ?></td>
                                                    <td><?php
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
                                                    <td><?php echo $visitcount; ?>
                                            </td>
										<?php 	 echo "<td>";
                        if ($dateTime == '') {
                            echo "<p style='padding-left:20px;'> Not loged in</p>";
                        }else{
                         echo $dateTime;   
                        }
                        echo "</td>"; ?>
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

                       
                    </form>
                </div>
            </div>





        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- preload the images -->
    <div style='display:none'>
        <img src='images/loading.gif' alt='' />
    </div>

    <!-- Load JavaScript files -->
    <script type='text/javascript' src='js/jquery.js'></script>
    <script type='text/javascript' src='js/jquery.simplemodal.js'></script>
    <script>
        jQuery(function ($) {

            var contact = {
                message: null,
                init: function () {

                    $('#contact-form input.contact, #contact-form a.contact').click(function (e) {
                        e.preventDefault();
                        // load the contact form using ajax
                        $.get("mailForm.php", function (data) {


                            // create a modal dialog with the data
                            $(data).modal({
                                closeHTML: "<a href='#' title='Close' class='modal-close'>x</a>",
                                position: ["15%", ],
                                overlayId: 'contact-overlay',
                                containerId: 'contact-container',
                                onOpen: contact.open,
                                onShow: contact.show,
                                onClose: contact.close
                            });
                        });
                    });
                },
                open: function (dialog) {
                    //selected mails written by murali
                    var maillist = new Array();
                    for (var m = 1; m <= 20; m++) {

                        var check_maillist = document.getElementById(m);

                        if (check_maillist != null) {
                            if (check_maillist.checked == true) {
                                maillist.push(check_maillist.value);
                            }
                        }
                    }
                    var formData = {"check_maillist": maillist};
                    var emails = formData.check_maillist;
                    if (emails == '') {


                        $('#contact-container .contact-title').html('Please Select Atleast One Entry.');
                        dialog.overlay.fadeIn(200, function () {
                            dialog.container.fadeIn(200, function () {
                                dialog.data.fadeIn(200, function () {

                                });
                            });
                        });
                    } else {


//selected mails written by murali
                        // dynamically determine height
                        var h = 280;
                        if ($('#contact-subject').length) {
                            h += 26;
                        }
                        if ($('#contact-cc').length) {
                            h += 22;
                        }

                        var title = $('#contact-container .contact-title').html();
                        $('#contact-container .contact-title').html('Loading...');
                        dialog.overlay.fadeIn(200, function () {
                            dialog.container.fadeIn(200, function () {
                                dialog.data.fadeIn(200, function () {
                                    $('#contact-container .contact-content').animate({
                                        height: h
                                    }, function () {
                                        $('#contact-container .contact-title').html(title);
                                        $('#contact-container form').fadeIn(200, function () {
                                            $('#contact-container #contact-name').focus();

                                            $('#contact-container .contact-cc').click(function () {
                                                var cc = $('#contact-container #contact-cc');
                                                cc.is(':checked') ? cc.attr('checked', '') : cc.attr('checked', 'checked');
                                            });
                                        });
                                    });
                                });
                            });
                        });

                    }
                },
                show: function (dialog) {
                    $('#contact-container .contact-send').click(function (e) {

                        e.preventDefault();
                        // validate form
                        if (contact.validate()) {
                            var msg = $('#contact-container .contact-message');

                            msg.fadeOut(function () {
                                msg.removeClass('contact-error').empty();
                            });
                            $('#contact-container .contact-title').html('Sending...');
                            $('#contact-container form').fadeOut(200);
                            $('#contact-container .contact-content').animate({
                                height: '80px'
                            }, function () {
                                $('#contact-container .contact-loading').fadeIn(200, function () {

//                                             var checkedid = new Array();
//                                             for (var v = 1; v <= 20; v++) {
//                                                 var val="userId"+v;
//                                            var checkid = document.getElementById(val).value;
//                                              if (checkid != null) {
//                                                  if (checkid.checked == true) {
////                                                        console.log(checkid);
//                                                        checkedid.push(checkid);
//                                                    }
//                                              }
//                                        }

                                    var maillist = new Array();
                                    for (var m = 1; m <= 20; m++) {
                                        var check_maillist = document.getElementById(m);

                                        if (check_maillist != null) {
                                            if (check_maillist.checked == true) {
//                                                        console.log(check_maillist);
                                                maillist.push(check_maillist.value);
                                            }
                                        }
                                    }

//                                            for (var i = 0; i < check_maillist.length; i++) {
//                                                maillist.push(check_maillist[i].value);
//                                               
//                                            }
                                    var formData = {"check_maillist": maillist};
                                    var emails = formData.check_maillist;
                                    console.log(emails);





                                    $.ajax({
                                        url: 'mailForm.php',
                                        data: $('#contact-container form').serialize() + '&action=send' + '&rid=<?php echo $mid; ?>' + '&list=' + emails,
                                        // data: ({page: page, id: id}),
                                        type: 'post',
                                        cache: false,
                                        dataType: 'html',
                                        success: function (data) {
                                            $('#contact-container .contact-loading').fadeOut(200, function () {
                                                $('#contact-container .contact-title').html('Thank you!');
                                                msg.html(data).fadeIn(200);
                                            });
                                        },
                                        error: contact.error
                                    });
                                });
                            });
                        }
                        else {
                            if ($('#contact-container .contact-message:visible').length > 0) {
                                var msg = $('#contact-container .contact-message div');
                                msg.fadeOut(200, function () {
                                    msg.empty();
                                    contact.showError();
                                    msg.fadeIn(200);
                                });
                            }
                            else {
                                $('#contact-container .contact-message').animate({
                                    height: '30px'
                                }, contact.showError);
                            }

                        }
                    });
                },
                close: function (dialog) {
                    $('#contact-container .contact-message').fadeOut();
                    $('#contact-container .contact-title').html('');
                    $('#contact-container form').fadeOut(200);
                    $('#contact-container .contact-content').animate({
                        height: 40
                    }, function () {
                        dialog.data.fadeOut(200, function () {
                            dialog.container.fadeOut(200, function () {
                                dialog.overlay.fadeOut(200, function () {
                                    $.modal.close();
                                });
                            });
                        });
                    });
                },
                error: function (xhr) {
                    alert(xhr.statusText);
                },
                validate: function () {
                    contact.message = '';

                    if (!$('#contact-container #contact-subject').val()) {
                        contact.message += 'Subject is required.';
                    }
                    if (!$('#contact-container #contact-message').val()) {
                        contact.message += 'Message is required.';
                    }

                    if (contact.message.length > 0) {
                        return false;
                    }
                    else {
                        return true;
                    }
                },
                showError: function () {
                    $('#contact-container .contact-message')
                            .html($('<div class="contact-error"></div>').append(contact.message))
                            .fadeIn(200);
                }
            };

            contact.init();

        });
    </script>
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

<div id="mySite" class="portBox" style="width: 38%;left: 359.5px;">
    <b id="falseOpen" style=""><center>Please Select Atleast One Entry.</center></b>
    <div id="trueOpen">
        <div id="loadStatus"><img src="images/ajaxloader.gif"/> Sending...</div>

        <b style="color:red;">Note:</b> <spam style="font-family: Times New Roman, Times, serif;">You can record your voice 45 seconds only.Otherwise voice mail will not be sent</spam>
        <br>
        <b style="color:red;">Note:</b> <spam style="font-family: Times New Roman, Times, serif;">Voice mails are send to only those candidates who are AVAILABLE or LOOKING FOR CHANGE.Other candidates will not receive voice mails.</spam>
        <br><br>
        <div class="project-pics"> 
            <?php
            include("recordAud.php");
            ?>  
        </div> 

        <div class=""  style="float:left;font-family: Times New Roman, Times, serif;">

            <br>
            <input type="checkbox" id="automails" style="margin-left:0px;" value="Automated" name="automail">Automated Voice Mail
            <br><br>

            <div id="requir">  
                <select name="req" id="req" required class="form-control">
                    <option value=""></option>
                    <?php
                    $reqquery = mysql_query("SELECT * from requirement where recruiterId='$mid'");
                    while ($reqlist = mysql_fetch_array($reqquery)) {
                        ?>

                        <option value="<?php echo $reqlist['jobTitle'] ?>" ><?php echo $reqlist['jobTitle'] ?></option>
                    <?php } ?>
                </select> &nbsp; or <input type="text" class="form-control" required name="req" id="reqr"><br>
                <spam id="alertMsg" style="color: red;"> Please Enter Requirement</spam>
            </div><br>

            <a class="button disabled two" id="autoSend">Send</a>
        </div>

    </div>
</div>

<?php
if (isset($_POST['messagemail'])) {

    /* mobile app code */
    include_once './emdbMobileApp/GCM.php';
    $gcm = new GCM();
    /* mobile app code */

    $listsend = "";
    $flagset = 0;
    $mesg = $_POST['messagemail'];
    $inviteflag = 0;
    $userliststring = "";
//send message
    foreach ($_POST['emailstobesent'] as $selected) {
        $finalfilnam = explode("/", $selected);
        $justfinalfile = end($finalfilnam);
        $docObj = new Filetotext("$selected");
//$docObj = new Filetotext("test.pdf");
        $return = $docObj->convertToText();

//var_dump( $return );

        $mystring = $return;

//echo "</br></br>";

        $pos = 0;
        $endpos = 0;
        $findme = 'EMDB';
        $pos = strpos($mystring, $findme);

        // Note our use of ===. Simply, == would not work as expected
        // because the position of 'a' was the 0th (first) character.
        if ($pos === false) {
            $emaillist = extract_email_address($mystring); // finding emails to send invites and if it is there in the database
            if (!empty($emaillist)) {
                foreach ($emaillist as $selectedemail) {
                    if ($inviteflag == 0) {
                        ?>  
                        <hr>
                        <p>Would you like to invite these users who does not have an account with Us.</p>
                        <form action="" method="POST">

                            <input type="submit" size="11" id="invite"    name="invite" value="Invite"  />

                            <?php
                            $inviteflag = 1;
                        }
                    }
                    $checkifemail = $selectedemail;
                    echo "<input type=\"checkbox\" id=\"checkforinvite\" name=\"check_invite[]\" value=\"$checkifemail\">";
                    echo $checkifemail;
                    echo "</br>";
                }
            } else {

                // echo "$pos";
                $endpos = 20;
                $caidval = substr($mystring, $pos, $endpos);
                $tid = str_replace("EMDB", "", $caidval);
                $tid = preg_replace('/\s+/', '', $tid);
                $tid = substr($tid, '0', '12');


                //echo $tid;
//echo "SELECT * FROM `user` where `member_id`='$tid'"; 

                $availcheck = "SELECT * FROM `user` where `member_id`='$tid'";
                $availcheck_result = mysql_query($availcheck);
                $availcheck_check = mysql_num_rows($availcheck_result);
                if ($availcheck_check != 1) {
                    
                } else {
                    $flagset = 1;
                    $listsend = $listsend + 1;
                    while ($availcheck_result1 = mysql_fetch_array($availcheck_result)) {
                        $emailtosend = $availcheck_result1['email'];
                        $ufname = $availcheck_result1['first'];
                        @$umname = $availcheck_result1['middle'];
                        $ulname = $availcheck_result1['last'];
                    }
                    $recruiteremail = $_SESSION['email'];


                    if ($umname == "") {
                        $ufulname = $ufname . " " . $ulname;
                    } else {
                        $ufulname = $ufname . " " . $umname . " " . $ulname;
                    }
                    $sendmessagetouser_op = sendmessagetouser($ufulname, $emailtosend, $mesg, $fulname, $recruiteremail);
                    if ($flagset == 1) {

                        $userliststring = $userliststring . "," . $ufulname;
//echo "<p class=\"list_name_user\">$ufulname</p>";
                    }
                }

                /* mobile app code */
                $availcheck2 = "SELECT * FROM `gcm_users` where `member_id`='$tid'";
                $availcheck_result2 = mysql_query($availcheck2);
                $availcheck_check2 = mysql_num_rows($availcheck_result2);
                if ($availcheck_check2 > 0) {
                    while ($row = mysql_fetch_array($availcheck_result2)) {
                        $registatoin_ids = array($row["gcm_id"]);
                        $message = array
                            (
                            'email' => $recruiteremail,
                            'message' => $mesg,
                            'title' => 'EMDB',
                            'sound' => 1,
                        );
                        $result = $gcm->send_notification($registatoin_ids, $message);
                        //print_r(json_decode($result));
                    }
                } else {
                    
                }
                /* mobile app code */
            }



//send message
        }
        $userliststringsingle = explode(",", $userliststring);
        $titleonce = 1;
        foreach ($userliststringsingle as $selecteduserlist) {
            if ($titleonce == 1) {
                echo "<hr>";
                echo "<h6>The message was sent to </h6>";
                $titleonce = 2;
            }
            echo "<p class=\"list_name_user\">$selecteduserlist</p>";
        }
    }

//Change Folder
    if (isset($_POST['folder'])) {
        $nopath = "";
        $subpath = "";
        $mainpath = "";
        $radioselected = $_POST['folder'];
        if ($radioselected == "existing") {
            $mainpath = $_POST['pathspecify'];
            if ($mainpath != "") {
                $subpath = $_POST['subfolder2'];

                if ($subpath != "") {
                    $path = $subpath;
                } else {
                    $path = $mainpath;
                }
            } else {
                $path = $mainfolder;
            }
        } else {
            $mainpath = $_POST['mainfolder'];
            $subfolder1 = $_POST['subfolder1'];
            if ($mainpath != "") {

                $reqpath = "./" . $mid . "/" . $mainpath;
                @mkdir($reqpath, 0777);


                if ($subfolder1 != "") {

                    $reqpath = $reqpath . "/" . $subfolder1;
                    @mkdir($reqpath, 0777);
                    $path = $reqpath;
                } else {
                    $path = $reqpath;
                }
            } else {

                $path = $mainfolder;
            }
        }



        $pathshow = str_replace("./$mid/", "", $path);
        echo "<p class=\"notify_text\">The below entries were moved to <b>$pathshow</b></p>";
        echo "<p class=\"notify_green\">";
        foreach ($_POST['filestobemoved'] as $selected) {
            //echo $selected;
            echo "<br>";
            $targetdir = $path;
            @mkdir($targetdir, 0777);
            @chmod($selected, 0777);

            $mail_check = mysql_query($sqlComp = "SELECT * FROM `recruit_users` where `user_id`='$selected' and recruiterId='$mid'");
            $num = mysql_fetch_assoc($mail_check);
            $mainpath1 = str_replace("./", "", $num['filepath']);
            $finalfilnam = explode("/", $mainpath1);
            echo $justfinalfile = end($finalfilnam);
            echo "<br>";
            $path = str_replace("./", "", $targetdir);
            $cntfolders = count($targetfile = explode("\\", $justfinalfile));

            $somevar = "$path/" . $targetfile[$cntfolders - 1];
            //$from = str_replace("./", "", $targetfile[$cntfolders - 1]);echo "<br>";
            $to = "$path/" . $justfinalfile;

            if (copy($mainpath1, $to)) {
                //$to = "$path\\" . $targetfile[$cntfolders - 1];
                $to = mysql_real_escape_string($to);
                $mpath = "./" . $to;
                $sql = "UPDATE recruit_users SET filepath='$mpath' WHERE `user_id`='$selected' and recruiterId='$mid'";
                $uppath = mysql_query($sql);
            }

            if ($to != $mainpath1) {
                $newselected = $mainpath1;
                unlink("$newselected");
            }
        }

        echo "</p>";
    }
//Change Folder
    if (isset($_POST['delete']) || isset($_POST['mail']) || isset($_POST['follow']) || isset($_POST['download']) || isset($_POST['messageuser']) || isset($_POST['movefolder'])) {

        $count = count($_POST['check_list']);
        if ($count == 0) {
            ?>
            <link rel="stylesheet" href="popstyles/main.css">
            <div id="boxes">
                <div  id="dialog" class="window"> Please Select Atleast One Entry.
                    <a href="#" class="close" style="">X</a>
                </div>
                <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
            </div>
        <!--                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> -->
            <script src="popstyles/main.js"></script>
            <?php
        } else {
            if (isset($_POST['check_list'])) {//to run PHP script on submit
                if (!empty($_POST['check_list'])) {
                    if (isset($_POST['inviteall'])) {
                        $listsend = "";
                        $flagset = 0;
                        $inviteflag = 0;
                        echo "<div style='height: 500px;overflow: scroll;'>";
                        foreach ($_POST['check_list'] as $selected) {
                            $finalfilnam = explode("/", $selected);
                            $justfinalfile = end($finalfilnam);
                            $docObj = new Filetotext("$selected");
                            $return = $docObj->convertToText();
                            $mystring = $return;
                            $pos = 0;
                            $endpos = 0;
                            $findme = 'EMDB';
                            $pos = strpos($mystring, $findme);

                            // Note our use of ===. Simply, == would not work as expected
                            // because the position of 'a' was the 0th (first) character.

                            if ($pos === false) {
                                $text = $mystring;
                                foreach (preg_split('/\s/', $text) as $token) {
                                    $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
                                    if ($email !== false) {
                                        $email = str_replace("mailto", "", $email);
                                        $emails[] = $email;
                                        break;
                                    }
                                }
                                // echo  print_r($rt=  array_unique($emails));
                                if (!empty($emails)) {
                                    $emails = array_unique($emails);

                                    foreach ($emails as $selectedemail) {
                                        if ($inviteflag == 0) {
                                            ?>  
                                            <hr>
                                            <p>Would you like to invite these users who does not have an account with Us.</p>
                                            <p><input type="checkbox" id="check_invite" value="select" onClick="do_invite()" />Select All</p>
                                            <form action="" method="POST">
                                                <input type="submit" size="11" id="invite"    name="invite" value="Invite"  />
                                                <?php
                                                $inviteflag = 1;
                                            }

                                            echo "<input type=\"checkbox\" id=\"checkforinvite\" name=\"check_invite[]\" value=\"$selectedemail\">";
                                            echo $selectedemail;
                                            echo "<br>";

                                            $emails = array();
                                        }
                                    }
                                }
                            }
                            echo "</div>";
                        }

// Loop to store and display values of individual checked checkbox.
                        elseif (isset($_POST['delete'])) {

//                                            echo "<p class=\"notify_text\">The selected entries were removed</p>";
                            echo "<p class=\"notify_green\">";

                            foreach ($_POST['check_list'] as $selected) {
                                // echo $selected;echo "<br>";echo $mid;
                                $finalfilnam = explode("/", $selected);
                                $delEmails = end($finalfilnam);
                                // echo $sqlComp = "SELECT * FROM `user` where `email`='$delEmails'";
                                $delmail_check = mysql_fetch_assoc(mysql_query($sqlComp = "SELECT * FROM `recruit_users` where `user_id`='$selected' and recruiterId='$mid'"));
                                $delpath = $delmail_check['filepath'];
                                unlink("$delpath");
                                $delsql = "DELETE FROM `recruit_users` WHERE  `user_id`='$selected' and recruiterId='$mid'";
                                mysql_query($delsql);
                            }
                            foreach ($_POST['userId'] as $userId) {

                                //echo "mmk". $userId;echo "<br>";
                            }
                            echo "</p>";
                            ?>

                            <script src="http://code.jquery.com/jquery.min.js"></script>
                            <script type="text/javascript">
                            $(document).ready(function () {

                                setTimeout(function () {

                                    window.location.href = "list_resumes.php";
                                }, 10);


                            });
                            </script>

                            <?php
                        } elseif (isset($_POST['movefolder'])) {
                            ?>
                            <!--- start of movefile to folder-->
                            <form enctype="multipart/form-data" method="post" action="">
                                <p>
                                <p>
                                    <input type="radio" name="folder" value="new">New Folder
                                    <input type="radio" name="folder" CHECKED value="existing">Existing Folder
                                </p>
                                <select name="pathspecify" id="pathspecify" style="float:left">
                                    <option value="">Select Parent Folder</option>
                                    <?php

                                    function listFolderFiles($dir) {

                                        foreach (new DirectoryIterator($dir) as $fileInfo) {
                                            if (!$fileInfo->isDot()) {
                                                global $mainfolder;
                                                if ($fileInfo->isDir()) {
                                                    $dirnam = $fileInfo->getPathname();
                                                    $dirnamlist = str_replace($mainfolder, "", $dirnam);
                                                    echo "<option value=\"$dirnam\">$dirnamlist</option>";

                                                    //listFolderFiles($fileInfo->getPathname());
                                                }
                                            }
                                        }
                                    }

                                    listFolderFiles("./$mid");
                                    foreach ($_POST['check_list'] as $selected) {
                                        echo "<input type=\"hidden\" name=\"filestobemoved[]\" value=\"$selected\">";
                                    }
                                    ?>
                                </select> <div id="div1" style="float:left"></div> 
                                <div  style="float:left;">
                                    <input style="display:none;" type="text" id="mainfolder" name="mainfolder" placeholder="Main Folder " >
                                    <input style="display:none;" type="text" id="subfolder1" name="subfolder1" placeholder="Sub Folder " > 
                                </div> 


                                <p class="notify_text"><input type="submit" name="submit"  id="theresume"  value="Move" /></p>
                            </form>


                            <script>
                                $(document).ready(function ()
                                {



                                    $('#pathspecify').change(function ()
                                    {
                                        var foldername = $(this).val();
                                        var folder = $('input:radio[name=folder]:checked').val();
                                        if (foldername == 'Create Parent Folder')
                                        {
                                            $('#mainfolder').show();
                                            $('#subfolder1').show();
                                            $('#div1').hide();
                                        }
                                        else
                                        {
                                            $('#mainfolder').hide();
                                            $('#subfolder1').hide();
                                            $('#div1').show();
                                        }
                                        if (folder == 'existing')
                                        {
                                            $.ajax({data: {foldername: foldername}, url: "ajaxfolder.php", success: function (result) {
                                                    $("#div1").html(result);
                                                }});
                                        }
                                        else
                                        {
                                            $('#subfolder1').show();
                                            $('#subfolder').hide();
                                        }
                                    });





                                    $("input[name='folder']").click(function () {
                                        if ($('input:radio[name=folder]:checked').val() == "new")
                                        {
                                            $('#div1').hide();
                                            $("#pathspecify").append(new Option("Create Parent Folder", "Create Parent Folder"));

                                        }
                                        else {
                                            $('#div1').show();
                                            $("#pathspecify option[value='Create Parent Folder']").remove();
                                            $('#mainfolder').hide();
                                            $('#subfolder1').hide();

                                        }
                                    });
                                });
                            </script>
                            <!--- end of movefile to folder-->
                            <?php
                        }
                        //Message User
                        elseif (isset($_POST['messageuser'])) {
                            ?>
                            <form  method="post" action="">
                                <HR COLOR="#258EC8"  SIZE="6" >
                                <p class="notify_text"><textarea name="messagemail" >Please enter the message to be send...</textarea>

                                    <?php
                                    foreach ($_POST['check_list'] as $selected) {
                                        echo "<input type=\"hidden\" name=\"emailstobesent[]\" value=\"$selected\">";
                                    }
                                    ?> 
                                    <input type="submit" name="submit"  id="reachuser"  value="Send" /></p>

                                <HR COLOR="#258EC8"  SIZE="6" >

                            </form>
                            </br>
                            <?php
                        }
                        //Message User
//follow User
                        elseif (isset($_POST['follow'])) {
                            ?>
                            <p class="notify_text"><!-- You are following >>>-->
                                <?php
                                $listup = "";
                                $flagset = 0;

                                foreach ($_POST['check_list'] as $selected) {

//                                                    echo "SELECT * FROM `recruit_users` where `user_id` ='$selected' and `recruiterId`='$mid'";exit;
                                    $getpath = mysql_query($sqlComp = "SELECT * FROM `recruit_users` where `user_id` ='$selected' and `recruiterId`='$mid' ");
                                    $takepath = mysql_fetch_assoc($getpath);
                                    $fPath = $takepath['filepath'];
                                    $finalfilnam = explode("/", $fPath);
                                    $justfinalfile = end($finalfilnam);
                                    $justfinalfile = str_replace("\\", "/", $justfinalfile);
                                    $docObj = new Filetotext("$fPath");
                                    $return = $docObj->convertToText();
                                    $mystring = $return;
                                    $pos = 0;
                                    $endpos = 0;
                                    $findme = 'EMDB';
                                    $pos = strpos($mystring, $findme);

                                    // Note our use of ===. Simply, == would not work as expected
                                    // because the position of 'a' was the 0th (first) character.
                                    if ($pos === false) {
                                        
                                    } else {

                                        // echo "$pos";
                                        $endpos = 20;
                                        $caidval = substr($mystring, $pos, $endpos);
                                        $tid = str_replace("EMDB", "", $caidval);
                                        $tid = preg_replace('/\s+/', '', $tid);
                                        $tid = substr($tid, '0', '12');


                                        //echo $tid;
//echo "SELECT * FROM `user` where `member_id`='$tid'"; 

                                        $availcheck = "SELECT * FROM `user` where `member_id`='$tid'";
                                        $availcheck_result = mysql_query($availcheck);
                                        $availcheck_check = mysql_num_rows($availcheck_result);
                                        if ($availcheck_check != 1) {
                                            
                                        } else {
                                            $flagset = 1;
                                            $listup = $listup + 1;
                                            while ($availcheck_result1 = mysql_fetch_array($availcheck_result)) {
                                                $memberid = $availcheck_result1['member_id'];
                                                $ufname = $availcheck_result1['first'];
                                                @$umname = $availcheck_result1['middle'];
                                                $ulname = $availcheck_result1['last'];
                                            }



                                            if ($umname == "") {
                                                $ufulname = $ufname . " " . $ulname;
                                            } else {
                                                $ufulname = $ufname . " " . $umname . " " . $ulname;
                                            }
                                            $followcheck = "SELECT * FROM `follow` where `member_id`='$tid' and user_id='$mid'";
                                            $follow_result = mysql_query($followcheck);
                                            $follow_check = mysql_num_rows($follow_result);
                                            if ($follow_check == 0) {
                                                $followuserquery = "INSERT INTO `follow` (member_id,user_id,status) VALUES 
('$memberid','$mid','1')";
                                                $followuserquery_result = mysql_query($followuserquery);
                                            }

                                            if ($followuserquery_result) {
                                                echo $ufulname;
                                                echo "</br>";
                                            }
                                        }
                                    }
                                }
                                if ($listup == "") {
                                    echo "No user cannot follow as the users doesnt have an EMDB ID in their documents";
//                                                    echo "None, as no user could be found from the list of selected document";
                                    // echo "None, as no user cannot follow as the users doesnt have an EMDB ID in their resumes";
                                }
                                ?>
                            </p>
                            <?php
                        }
//follow User
                        else {
                            $files = [];
                            foreach ($_POST['check_list'] as $selected) {
//                                                echo $selected;echo "<br>";
                                $checkemail = mysql_query("SELECT * FROM `recruit_users` where `user_id`='$selected' and `recruiterId`='$mid'");
                                $pathresult = mysql_fetch_assoc($checkemail);
                                $pathss = str_replace("\\", "/", $pathresult['filepath']);
                                $files[] = $pathresult['filepath'];
                            }



                            # create new zip opbject
                            $zip = new ZipArchive();

                            # create a temp file & open it
                            $tmp_file = tempnam('.', '');
                            $zip->open($tmp_file, ZipArchive::CREATE);

                            # loop through each file
                            foreach ($files as $file) {

                                # download file
                                $download_file = file_get_contents($file);

                                #add it to the zip
                                $zip->addFromString(basename($file), $download_file);
                            }

                            # close zip
                            $zip->close();

                            # send the file to the browser as a download
                            header('Content-disposition: attachment; filename=Resumes.zip');
                            header('Content-type: application/zip');
                            readfile($tmp_file);
                            unlink($tmp_file);
                        }
                    }
                }
            }
        }
        ?>
<?php if ($_POST['delete'] != '') { ?>
    <link rel="stylesheet" href="popstyles/main.css">
    <div id="boxes" style="">
        <div  id="dialog" style="font-size: 18px;border-radius:0px;" class="window"> <b>The selected entries were removed.</b><br><br> <?php ?>

            <!-- <a href="#" class="close" style="right:0px;top:1px;">X</a><br>-->
        </div>
        <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>

    </div>
    <script src="popstyles/main.js"></script>
<?php }
?>