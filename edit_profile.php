<?php
include('header.php');
if (!isset($_SESSION['member_id'])) {
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
$mid = $_SESSION['member_id'];
?>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <?php include('sidemenu.php'); ?>
        <!-- end navbar side -->
        <script type="text/javascript">

            function fullname(textbox) {
                if (document.getElementById('fname').value == '')
                {
                    textbox.setCustomValidity('Please keyin Your First Name');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            function lastname(textbox) {
                if (document.getElementById('lname').value == '')
                {
                    textbox.setCustomValidity('Please keyin Your Last Name');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            function emailid(textbox) {
                if (document.getElementById('email').value == '')
                {
                    textbox.setCustomValidity('Please keyin the Email');
                    return false;
                } else if (document.getElementById('email').value != '') {
                    var x = document.getElementById('email').value;

                    var atpos = x.indexOf("@");
                    var dotpos = x.lastIndexOf(".");
                    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
                        //alert("Not a valid e-mail address");
                        textbox.setCustomValidity('Not a valid e-mail address');
                        // document.checkval.email.focus();
                        return false;
                    } else {
                        textbox.setCustomValidity('');
                    }
                    return true;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            function phonenumber(textbox) {
                if (document.getElementById('phone').value == '')
                {
                    textbox.setCustomValidity('Please keyin the Phone Number');
                    return false;
                } else if (document.getElementById('phone').value.length > 10) {
                    textbox.setCustomValidity('Not a valid Phone Number');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }
            function zipcode(textbox) {
                if ((document.checkval.zipdist.value != "") && (document.getElementById('zip').value == ''))
                {
                    textbox.setCustomValidity('Please Keyin your Zip code to define the preferred distance Range');
                    return false;
                } else {
                    textbox.setCustomValidity('');
                }
                return true;
            }

        </script>
        <!--tooltip------>
        <?php include ("tooltip.html"); ?>
        <!--tooltip------>
        <?php
        if (isset($_POST['protect'])) {
            $protect = $_POST['protect'];
            $updatePro = "UPDATE `user` SET    `protect` = '$protect' WHERE `member_id`='$mid'";
            $updatePro_result = mysql_query($updatePro);
        }
        if (isset($_GET['tph'])) {
            $protectPhone = $_GET['tph'];
            $updatePro = "UPDATE `user` SET    `protectPhone` = '$protectPhone' WHERE `member_id`='$mid'";
            $updatePro_result = mysql_query($updatePro);
        } else if (isset($_GET['eml'])) {
            $protectEmail = $_GET['eml'];
            $updatePro = "UPDATE `user` SET    `protectEmail` = '$protectEmail' WHERE `member_id`='$mid'";
            $updatePro_result = mysql_query($updatePro);
        }
        $selectPro = "SELECT * FROM `user` WHERE member_id='$mid'";
        $selectPro_query = mysql_query($selectPro);
        while ($selectPro_query_query_fetch = mysql_fetch_array($selectPro_query)) {

            $protectexisting = $selectPro_query_query_fetch['protect'];
            $protectexistingEmail = $selectPro_query_query_fetch['protectEmail'];
            $protectexistingPhone = $selectPro_query_query_fetch['protectPhone'];
        }
        ?>
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Profile</h1>
                </div>
                <!--End Page Header -->

            </div>




            <div class="row">
                <div class="col-lg-8"><div style="clear:both;margin-top:0px;float:right">
                        <form action="" method="POST" >
                            <button type="submit" class="btn btn-info active tooltip1" name="protect"  <?php if ($_POST['protect'] == 'Public' || $protectexisting == 'Public') { ?> title="You selected public then the information will be disclosed to recruiters" style="background-color: ActiveCaption;" disabled <?php } else { ?> title="If you select public then the information will be disclosed to recruiters"<?php } ?>value="Public"  ><i class="fa fa-unlock-alt"></i> Public</button>
                            <button type="submit"  class="btn btn-info tooltip1" name="protect"  <?php if ($_POST['protect'] == 'Private' || $protectexisting == 'Private') { ?> title="You selected private then  provide only  EMDB ID and Availability to recruiters"  style="background-color: ActiveCaption;" disabled <?php } else { ?> title="If you  select private then  provide only  EMDB ID and Availability to recruiters"<?php } ?> value="Private" ><i class="fa fa-lock"></i> Private </button>
                        </form>
                    </div>
<?php

$email = $_SESSION['email'];
$listdetails = "SELECT * FROM `user` WHERE member_id='$mid'";
$listdetails_query = mysql_query($listdetails);
while ($listdetails_query_fetch = mysql_fetch_array($listdetails_query)) {
    $phone = $listdetails_query_fetch['phone'];
    $availability = $listdetails_query_fetch['availability'];
    $availability1 = $listdetails_query_fetch['availability'];
    @$job = $listdetails_query_fetch['job'];
    @$salary = $listdetails_query_fetch['salary'];
    @$zip = $listdetails_query_fetch['zip'];
    $country = $listdetails_query_fetch['country'];
    @$distance = $listdetails_query_fetch['distance'];
    @$technology = $listdetails_query_fetch['technology'];
    @$flexible = $listdetails_query_fetch['flexible'];
    


}

if (isset($_POST['fname'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    @$mname = $_POST['mname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $notify = $_POST['notificdur'];
    $availability = $_POST['availability'];
    @$typeofjob = $_POST['typeofjob'];
    @$technologies = $_POST['technologies'];
    @$country = $_POST['country'];
    @$zip = $_POST['zip'];
    @$zipdist = $_POST['zipdist'];
    @$salary = $_POST['fromSal'] . '-' . $_POST['toSal'];
    @$flexible = $_POST['flexible'];
    $checkexist = "SELECT * FROM `user` WHERE (email='$email' or phone='$phone') and member_id !='$mid'";

    $checkexist_query = mysql_query($checkexist);
    $checkexist_check = mysql_num_rows($checkexist_query);
    if ($checkexist_check >= 1) {
        while ($checkexist_result1 = mysql_fetch_array($checkexist_query)) {
            $exemail = $checkexist_result1['email'];
            if ($exemail == $email) {
                ?>
                                    <p class="notify_red">The email Address already exists. Please use different ones.</p>
                                    <?php
                                } else {
                                    ?>
                                    <p class="notify_red">The phone number already exists. Please use different ones.</p>
                                    <?php
                                    break;
                                }
                            }
                        } else {
                            $tm = time();
                            $userupdate = "UPDATE `user` SET `first` = '$fname', `middle` = '$mname', `last` = '$lname', `status_time` = '$tm',`notify_time` = '$notify',`email` = '$email', `phone` = '$phone', `availability` = '$availability', `job` = '$typeofjob', `technology` = '$technologies', `salary` = '$salary', `zip` = '$zip', `distance` = '$zipdist', `flexible` = '$flexible', `country` = '$country' WHERE `member_id`='$mid'";
                            $userupdate_result = mysql_query($userupdate);
//                          echo  $availability1.$availability;
                            if ($availability1 != $availability) {
                                date_default_timezone_set('Asia/Kolkata');
                                $dateTime = date('Y-m-d H:i:s');
                                $userstatus = "UPDATE `user` SET  `todaystatus` = '1',laststatustime='$dateTime' WHERE `member_id`='$mid'";
                                $userstatus_result = mysql_query($userstatus);
                            }
                            $_SESSION['first'] = $fname;
                            $_SESSION['middle'] = $mname;
                            $_SESSION['last'] = $lname;
                            $_SESSION['email'] = $email;
                            header("Location:profile.php?succ=1&#stop");
                            ?>
                            <p class="notify_green">Your profile has been successfully updated</p>
            <!--                <script src="http://code.jquery.com/jquery.min.js"></script>
                            <script type="text/javascript">
                                $(document).ready(function () {
            
                                    setTimeout(function () {
            
                                        window.location.href = "profile.php";
                                    }, 5000);
            
            
                                });
                            </script>-->
        <?php
    }
}
?>


                    <div class="table-responsive" style="clear:both;margin-top:0px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Edit details
                            </div>

                            <form role="form" action="edit_profile.php" name="checkval" id="checkval"  method="post"  onsubmit="return(validate());">
                                <table class="table table-hover tablebd">

                                    <tbody>
                                        <tr>

                                            <td  style="width:20%;"><label>First Name</label></td>
                                            <td style="width:60%;">
                                                <div class="form-group">

                                                    <input class="form-control" id="fname" oninvalid="fullname(this);" oninput="fullname(this);"   required="required" name="fname" value="<?php echo $fname; ?>" placeholder="First Name (Mandatory)" >
                                                </div></td></tr>

                                        <tr>

                                            <td><label>Middle Name</label></td>
                                            <td>
                                                <div class="form-group">

                                                    <input class="form-control" id="mname" name="mname" value="<?php echo @$mname; ?>" placeholder="Middle Name" >
                                                </div></td></tr>
                                        <tr>

                                            <td><label>Last Name</label></td>
                                            <td>
                                                <div class="form-group">

                                                    <input class="form-control" id="lname" oninvalid="lastname(this);" oninput="lastname(this);"   required="required" name="lname" value="<?php echo @$lname; ?>" placeholder="Last Name  (Mandatory)">
                                                </div></td></tr>
                                        <tr>

                                            <td><label>Email Id</label></td>
                                            <td>
                                                <div class="form-group">

                                                    <input class="form-control" id="email"  style="float:left;"  oninvalid="emailid(this);"  oninput="emailid(this);"   required="required" name="email" value="<?php echo @$email; ?>" placeholder="Email Id (Mandatory)" />
<?php if ($protectexisting == 'Public') {
    if ($_GET['eml'] == '1' || $protectexistingEmail == '1' || $protectexistingEmail == '') { ?><a href="edit_profile.php?eml=0&#follow"  class="tooltip" style="opacity:1;margin-left: 400px;" title="Your email is not disclosed if click show will be disclosed to recruiters">show</a><?php } else if ($_GET['eml'] == '0' || $protectexistingEmail == '0' || $protectexistingEmail == '') { ?><a href="edit_profile.php?eml=1&#follow"  class="tooltip" style="opacity:1;margin-left: 400px;" title="Your email is disclosed if click Hide will not disclosed to recruiters">Hide</a><?php }
} ?>  
                                                </div>
                                            </td>
                                            <td>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td><label>Phone</label></td>
                                            <td>
                                                <div class="form-group">

                                                    <input class="form-control" id="phone" style="float:left;" oninvalid="phonenumber(this);" oninput="phonenumber(this);"   required="required" name="phone" value="<?php echo @$phone; ?>" placeholder="Your Mobile Number(Mandatory)" /> <?php if ($protectexisting == 'Public') {
                                                        if ($_GET['tph'] == '1' || $protectexistingPhone == '1' || $protectexistingPhone == '') { ?><a href="edit_profile.php?tph=0&#follow"  class="tooltip"  style="opacity:1;margin-left: 400px;" title="Your phone is not disclosed if click show will be disclosed to recruiters" > show </a><?php } else if ($_GET['tph'] == '0' || $protectexistingPhone == '0' || $protectexistingPhone == '') { ?><a href="edit_profile.php?tph=1&#follow" class="tooltip" style="opacity:1;margin-left: 400px;" title="Your Phone is disclosed if click Hide will not disclosed to recruiters">   Hide </a><?php }
                                                    } ?>
                                                </div></td></tr>

                                        <tr>

                                            <td><label>Availability</label></td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="availability" value="Available" <?php if ($availability == "Available") { ?> checked="checked" <?php } ?>>Available
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio"  name="availability" value="Not Available" <?php if ($availability == "Not Available") { ?> checked="checked" <?php } ?>>Not Available
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="availability" value="Looking For Change"<?php if ($availability == "Looking For Change") { ?> checked="checked" <?php } ?>>Looking For Change
                                                        </label>
                                                    </div>
                                                </div></td></tr>
                                        <tr>
                                            <td><label>Notification Duration</label></td><td><div class="form-group">

                                                    <select class="form-control tooltip" name="notificdur"  style="opacity: 1;width: 392px;" title="Amount of time between we contact you to remind about update of status,if any" id="notificdur">
                                                        <?php if (@$notify == "") { ?>
                                                            <option value=""> Select Notification Duration</option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo @$notify; ?>"> <?php echo @$notify; ?> Days</option>
<?php } ?>
                                                        <option value="30">30 Days</option>
                                                        <option value="60">60 Days</option>
                                                        <option value="90">90 Days</option>
                                                        <option value="90">180 Days</option>

                                                    </select>
                                                </div></td>


                                        </tr>
                                        <tr>
                                            <td><label>Job Type</label></td><td><div class="form-group">

                                                    <select class="form-control" name="typeofjob" id="typeofjob">
                                                        <?php if (@$job == "") { ?>
                                                            <option value=""> Select the type of Job</option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo @$job; ?>"> <?php echo @$job; ?></option>
<?php } ?>
                                                        <option value="Permanent"> Permanent</option>
                                                        <option value="Temporary"> Temporary</option>
                                                        <option value="Part Time"> Part Time</option>
                                                        <option value="Full Time"> Full Time</option>

                                                    </select>
                                                </div></td>


                                        </tr>
                                        <tr>
                                            <td><label>Technology</label></td><td><div class="form-group">
                                                    <?php if (@$technologies != "") { ?>
                                                        <input type="text"  class="form-control"   required="required" name="technologies" value="<?php echo @$technologies; ?>" placeholder="technologies" />
                                                    <?php } else { ?>
                                                        <input type="text"  class="form-control"  required="required" name="technologies" value="<?php echo @$technology; ?>" placeholder="technologies" />
<?php } ?>


                                                </div></td>


                                        </tr>
                                                                                <!--            <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>-->
                                    <script language="javascript">

                                        $(document).ready(function ()
                                        {

                                            $('#country').change(function ()
                                            {
                                                var foldername = $(this).val();
                                                $.ajax({data: {foldername: foldername}, url: "getCurrency.php", success: function (result) {
                                                        $("#cur_code").val(result);

                                                    }});

                                            });


                                        });
                                    </script>
                                    <tr>
                                        <td><label>Country</label></td><td><div class="form-group">

                                                <select class="form-control" style="margin-top:-10px;" name="country" id="country">
                                                    <?php
                                                    $countrylist = "SELECT * FROM `countries` order by `countryName` ASC ";
                                                    $countrylist_result = mysql_query($countrylist);

                                                    while ($countrylist_result1 = mysql_fetch_array($countrylist_result)) {
                                                        $countryname = $countrylist_result1['countryName'];
                                                        if ($countryname == $country) {
                                                            ?>
                                                            <option value="<?php echo $countryname; ?>" selected="selected"> <?php echo $countryname; ?></option>

                                                            <?php
                                                        }
                                                        ?>
                                                        <option value="<?php echo $countryname; ?>"> <?php echo $countryname; ?></option>

<?php } ?>


                                                </select>

                                            </div></td>


                                    </tr><tr>
                                        <td><label>Zip Code</label></td><td><div class="form-group">

                                                <input class="form-control" type="text"  style="margin-top:-10px;" id="zip" oninvalid="zipcode(this);" oninput="zipcode(this);"   required="required" name="zip" value="<?php echo @$zip; ?>" placeholder="Input Zip code if looking for a Local Job"  />

                                            </div></td>


                                    </tr>
                                    <tr>
                                        <td><label>Distance Range</label></td><td><div class="form-group">

                                                <select class="form-control" name="zipdist" id="zipdist" >
                                                    <?php if (@$distance == "") { ?>
                                                        <option value=""> Select your desired workplace distance range</option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo @$distance; ?>"> <?php echo @$distance; ?></option>
<?php } ?>
                                                    <option value=" 0-5 Miles"> 0-5 Miles</option>
                                                    <option value=" Up to 7 Miles"> Up to 7 Miles</option>
                                                    <option value=" Up to 10 Miles"> Up to 10 Miles</option>

                                                </select>
                                            </div></td>


                                    </tr>
                                    <tr>
                                        <td><label>Relocation</label></td><td><div class="form-group">

                                                <select class="form-control" name="flexible" id="flexible" >
                                                    <?php if (@$flexible == "") { ?>
                                                        <option value=""> Select your thoughts about relocation</option>
                                                    <?php } else { ?>
                                                        <option value="<?php echo @$flexible; ?>"> <?php echo @$flexible; ?></option>
<?php } ?>
                                                    <option value="Flexible">Flexible</option>
                                                    <option value="Strictly No">Strictly No</option>
                                                    <option value="Cannot rule out">Cannot rule out</option>




                                                </select>
                                            </div></td>


                                    </tr>
                                    <tr>

                                        <td><label>Salary Expectation</label></td>
                                        <td>
                                            <div class="form-group">
                                                <?php
                                                if (@$salary != "") {
                                                    $salary = explode("-", $salary);

                                                    if (count($salary) == 1) {
                                                        $salary[0];
                                                        $salFrom = preg_replace('/[^0-9\-]/', '', $salary[0]);
                                                        ?>
                                                        <input type="number" class="form-control" name="fromSal" placeholder="From" value="<?php echo $salFrom; ?>" style="width: 80px;float:left;margin-top:-10px;">&nbsp;&nbsp;
                                                        <input type="number" class="form-control" name="toSal" placeholder="To"  style="width: 80px;float:left;margin-top:-10px;">&nbsp;&nbsp;
                                                    <?php
                                                    } else if (count($salary) > 1) {
                                                        $salary[0];
                                                        $salary[1];
                                                        $salFrom = preg_replace('/[^0-9\-]/', '', $salary[0]);
                                                        $salTo = preg_replace('/[^0-9\-]/', '', $salary[1]);
                                                        ?>
                                                        <input type="number" class="form-control" name="fromSal" placeholder="From" value="<?php echo $salFrom; ?>" style="width: 80px;float:left;margin-top:-10px;">&nbsp;&nbsp;
                                                        <input type="number" class="form-control" name="toSal" placeholder="To" value="<?php echo $salTo; ?>" style="width: 80px;float:left;margin-top:-10px;">&nbsp;&nbsp;
                                                    <?php }
                                                } else { ?>
                                                    <input type="number" class="form-control" name="fromSal" placeholder="From"  style="width: 80px;float:left;margin-top:-10px;">&nbsp;&nbsp;
                                                    <input type="number" class="form-control" name="toSal" placeholder="To"  style="width: 80px;float:left;margin-top:-10px;">&nbsp;&nbsp;
                                                <?php } ?>


                                                <?php
                                                $comp_check = mysql_fetch_assoc($comp_result = mysql_query($sqlComp = "SELECT * FROM `countries` where `countryName`='$country'"));
                                                $currency = $comp_check['countryCode'];
                                                ?>
                                                <input type="text" class="form-control" name="cur_code" id="cur_code" disabled style="width: 80px;float:left;margin-top:-10px;" value="<?php echo $currency; ?>">

                                            </div></td></tr>
                                    <tr>
                                        <td><button type="submit" class="btn btn-info">Update Profile</button></td>


                                    </tr>
                                    </tbody>

                                </table>

                            </form>

                        </div>
                    </div>
                </div>


            </div>





            <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->


    <div class="clear"></div>
</body>

</html>
