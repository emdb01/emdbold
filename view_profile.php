<?php 
include('header.php');
if(!isset($_SESSION['user_id'])){
header("Location:index.php");
die();	
}
$mid=$_GET['viewid'];
$listdetails = "SELECT * FROM `user` WHERE member_id='$mid'";
$listdetails_query=mysql_query($listdetails);
while($listdetails_query_fetch=mysql_fetch_array($listdetails_query))
{
$fname=$listdetails_query_fetch['first'];
@$mname=$listdetails_query_fetch['middle'];
$lname=$listdetails_query_fetch['last'];
$email=$listdetails_query_fetch['email'];
$phone=$listdetails_query_fetch['phone'];
$notify=$listdetails_query_fetch['notify_time'];
$phone=$listdetails_query_fetch['phone'];
$availability=$listdetails_query_fetch['availability'];
@$job=$listdetails_query_fetch['job'];
@$salary=$listdetails_query_fetch['salary'];
@$zip=$listdetails_query_fetch['zip'];
$country=$listdetails_query_fetch['country'];
@$distance=$listdetails_query_fetch['distance'];
@$technology=$listdetails_query_fetch['technology'];
@$flexible=$listdetails_query_fetch['flexible'];
}

if($mname==""){
$fulname=$fname." ".$lname;

} else {
$fulname=$fname." ".$mname." ".$lname;
}
$availabilityexisting =$availability; 
?>
<div class="wrapper_2">
<h2 class="inner_abh"><center>View Profile</center></h2>
<div class="content">




<?php
$target = "Resumes/".$mid."/";
$filesinthearray = glob("$target*.{pdf,PDF,doc,docs,docx}", GLOB_BRACE);
foreach( $filesinthearray as $key => $resume){
$resumeexist=$resume;
}

 //if($resumeexist!="") { Replace this if the resume needs to be downloaded
 
 $resumeexist="";
  if($resumeexist!="") { ?>

<p class="editpro"><a href="http://employeemasterdatabase.com/<?php echo $resumeexist; ?>" target="_blank" >Download Resume</a></p> 

<?php }?>


<p class="notify_text">Employeemasterdatabase.com has assigned below unique EMDB ID to your profile</p>
<p class="emdb"><?php echo 'EMDB'.$mid; ?></p>



<?php 
if($availabilityexisting=="Available"){
$availabilitymessage="AVAILABLE FOR NEW JOB";
  } elseif($availabilityexisting=="Not Available"){ 
$availabilitymessage="NOT AVAILABLE FOR A NEW JOB"; } 
 elseif($availabilityexisting=="Looking For Change"){ 
$availabilitymessage="AVAILABLE FOR CHANGE OF JOB"; }
?>
<div class="availmessage2"><p><?php echo $availabilitymessage; ?></p></div>


<p class="notify_text">The details of the Candidate</p>




<p class="pro_label">Availability</p> <p class="pro_values"><img src="images/bluearrow.png" style="border:none; padding-right:5px;" ><?php echo $availability; ?></p>
<p class="pro_label">Country</p> <p class="pro_values"><img src="images/bluearrow.png" style="border:none; padding-right:5px;" ><?php echo $country; ?></p>
<?php if($notify!="" ){ ?>
<p class="pro_label">Notification Gap</p> <p class="pro_values"><img src="images/bluearrow.png" style="border:none; padding-right:5px;" ><?php echo @$notify; ?> Days</p>
<?php } if($job!="" ){ ?>
<p class="pro_label">Job Type</p> <p class="pro_values"><img src="images/bluearrow.png" style="border:none; padding-right:5px;" ><?php echo @$job; ?></p>
<?php } if($technology!="" ){ ?>
<p class="pro_label">Technology</p> <p class="pro_values"><img src="images/bluearrow.png" style="border:none; padding-right:5px;" ><?php echo $technology; ?></p>
<?php } if($zip!="" ){ ?>
<p class="pro_label">Zip Code</p> <p class="pro_values"><img src="images/bluearrow.png" style="border:none; padding-right:5px;" ><?php echo @$zip; ?></p>
<?php } if($distance!="" ){ ?>
<p class="pro_label">Distance Range</p> <p class="pro_values"><img src="images/bluearrow.png" style="border:none; padding-right:5px;" ><?php echo @$distance; ?></p>
<?php } if($flexible!="" ){ ?>
<p class="pro_label">Relocation</p> <p class="pro_values"><img src="images/bluearrow.png" style="border:none; padding-right:5px;" ><?php echo @$flexible; ?></p>
<?php } if($salary!="" ){ ?>
<p class="pro_label">Salary Expectation</p> <p class="pro_values"><img src="images/bluearrow.png" style="border:none; padding-right:5px;" ><?php echo @$salary; ?></p>
<?php } ?>
</br>

</div><!-- End of content -->
</div><!-- End of wrapper -->

<?php 
include('footer.php');
?>