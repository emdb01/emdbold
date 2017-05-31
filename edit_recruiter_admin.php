<?php
include('header.php');
if ($_SESSION['role'] != 1 && $_SESSION['role'] != 4) {
    header("Location:index.php");
    die();
}
$fname = $_SESSION['user_id'];
$mname = $_SESSION['middle'];
$lname = $_SESSION['last'];
if ($mname == "") {
    $fulname = $fname . " " . $lname;
} else {
    $fulname = $fname . " " . $mname . " " . $lname;
}
$mid = $_GET['eid'];
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
                    $protect=$_POST['protect'];
 $updatePro = "UPDATE `user` SET    `protect` = '$protect' WHERE `user_id`='$mid'";
                    $updatePro_result = mysql_query($updatePro);
                    
                }
                 if (isset($_GET['tph'])) {
                      $protectPhone=$_GET['tph'];
 $updatePro = "UPDATE `user` SET    `protectPhone` = '$protectPhone' WHERE `user_id`='$mid'";
                    $updatePro_result = mysql_query($updatePro);
                 }else if (isset($_GET['eml'])) {
                        $protectEmail=$_GET['eml'];
 $updatePro = "UPDATE `user` SET    `protectEmail` = '$protectEmail' WHERE `user_id`='$mid'";
                    $updatePro_result = mysql_query($updatePro);
                 }
                $selectPro = "SELECT * FROM `user` WHERE user_id='$mid'";
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
			<div class="col-lg-8">
								<?php 
 $listdetails = "SELECT * FROM `recruiter` WHERE user_id='$mid'";
$listdetails_query=mysql_query($listdetails);
while($listdetails_query_fetch=mysql_fetch_array($listdetails_query))
{

$fname=$listdetails_query_fetch['first'];
@$mname=$listdetails_query_fetch['middle'];
$lname=$listdetails_query_fetch['last'];
$email=$listdetails_query_fetch['email'];
$phone=$listdetails_query_fetch['phone'];
$country=$listdetails_query_fetch['country'];
@$company=$listdetails_query_fetch['company'];

} ?>

     <?php

if(isset($_POST['fname'])){
$fname=$_POST['fname'];
$lname=$_POST['lname'];
@$mname=$_POST['mname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
@$company=$_POST['company'];
@$country=$_POST['country'];
$mid=$_POST['mid'];


$checkexist = "SELECT * FROM `recruiter` WHERE (email='$email' or phone='$phone') and user_id !='$mid'";

$checkexist_query=mysql_query($checkexist);
$checkexist_check=mysql_num_rows($checkexist_query);
if($checkexist_check >= 1 ){
while($checkexist_result1=mysql_fetch_array($checkexist_query)){
$exemail=$checkexist_result1['email'];
if($exemail==$email){
?>
<p class="notify_red">The email Address already exists. Please use different ones.</p>
<?php
} else {
?>
<p class="notify_red">The phone number already exists. Please use different ones.</p>
<?php


}  }}  else 

{
$tm=time();
 $userupdate= "UPDATE `recruiter` SET `first` = '$fname', `middle` = '$mname', `last` = '$lname', `status_time` = '$tm', `email` = '$email', `phone` = '$phone', `country` = '$country', `company` = '$company' WHERE `user_id`='$mid'"; 
$userupdate_result=mysql_query($userupdate);


?>
<p class="notify_green">The Profile has been successfully updated</p>

<?php
//header("Location:view_profile_admin.php?viewid=$id");

//header( "refresh:2; url=view_recruiter_admin.php?eid=$mid" ); 
	

}



}


?>
           
								
			 <div class="table-responsive" style="clear:both;margin-top:0px;">
			 <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit details
                         </div>
						
				<form role="form" action="edit_recruiter_admin.php?eid=<?php echo $mid; ?>" name="checkval" id="checkval"  method="post"  onsubmit="return(validate());">
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
                                             
                                            <input class="form-control" id="mname" name="mname" value="<?php echo $mname; ?>" placeholder="Middle Name" >
                                        </div></td></tr>
										 <tr>
                                             
                                            <td><label>Last Name</label></td>
											<td>
											<div class="form-group">
                                              <input class="form-control" type="hidden" name="mid" value="<?php echo $mid; ?>">
                                            <input class="form-control" id="lname" oninvalid="lastname(this);" oninput="lastname(this);"   required="required" name="lname" value="<?php echo $lname; ?>" placeholder="Last Name  (Mandatory)">
                                        </div></td></tr>
										<tr>
                                             
                                            <td><label>Email Id</label></td>
											<td>
											<div class="form-group">
                                             
                                            <input class="form-control" id="email"  style="float:left;"  oninvalid="emailid(this);"  oninput="emailid(this);"   required="required" name="email" value="<?php echo $email; ?>" placeholder="Email Id (Mandatory)" />
                                        </div>
										</td>
										<td>
										
										</td>
										
										</tr>
										
											<tr>
                                             
                                            <td><label>Phone</label></td>
											<td>
											<div class="form-group">
                                             
                                            <input class="form-control" id="phone" style="float:left;" oninvalid="phonenumber(this);" oninput="phonenumber(this);"   required="required" name="phone" value="<?php echo $phone; ?>" placeholder="Your Mobile Number(Mandatory)" /> 
                                        </div></td></tr>
										
										
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
                                             <td><label>Company Name</label></td><td><div class="form-group">
                                             
                                            <input class="form-control" type="text"  style="margin-top:-10px;" id="zip" oninvalid="zipcode(this);" oninput="zipcode(this);"   required="required" name="company" value="<?php echo $company; ?>" placeholder="Company Name"  />

                                        </div></td>
                                             
                                            
                                        </tr>
										
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
