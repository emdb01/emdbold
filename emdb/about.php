<?php
ob_start();
@session_start();
include('../config/config.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title> EMDB | Employee Master Database | Innovative Portal </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Employee master database (EMDB) is an innovative portal that aims at addressing the needs of recruitment processes. This portal leverages technology to help the right recruiter connect to right job seeker." />
<meta name="keywords" content="EMDB, employeemasterdatabase, employee master database" />
<meta name="google-site-verification" content="qIwt5V7-A0L4gOQ8Xxo-cjQWChZ3S1Q0wH5MQE_u7kE" />
<meta name="distribution" content="Global" />
<meta name="rating" content="General" />
<meta name="robots" content="index, follow" />
<meta name="revisit-after" content="02 days" />
<meta name="expires" content="never" />
<meta name="allow-search" content="yes" />
<meta name="document-type" content="Public" />
<meta http-equiv="content-language" content="English" />
<meta name="doc-type" content="Web Page" />
<meta name="doc-rights" content="Copywritten Work" />
<meta name="publisher" content="employeemasterdatabase (employeemasterdatabase.com) " />
<link rel="stylesheet" href="../CSS/slider.css">

<link rel="stylesheet" type="text/css" href="../CSS/style.css" />
<link rel="icon"  type="image/ico" href="../images/favicon.ico">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head><body>
<div class="header_wrap">
<div class="header_content">

<div class="header">
<div class="logo">
<a href="../index.php"><img src="../images/logo.png" style="border:none;" ></a>
</div>
<div class="social_icons">
<!-- <p><i class="fa fa-facebook"></i>
<i class="fa fa-twitter"></i>
<i class="fa fa-linkedin"></i></p> -->

<?php if(!isset($_SESSION['first'])){ ?>
<!-- <p class="register_para">REGISTER AS</p> -->

<p class="reg_form" style="line-height: 45px;"> REGISTER AS 
	<a href="../register.php">JOB SEEKER</a>  <a href="../register_recruiter.php">RECRUITER</a>  </p>
<?php } else {

$fname=$_SESSION['first'];
$mname=$_SESSION['middle'];
$lname=$_SESSION['last'];
if($mname==""){
$fulname=$fname;

} else {
$fulname=$fname;
}


 ?>
<p class="reg_form"> Welcome, <?php echo $fulname; ?>   <?php if($_SESSION['role']=='3'){ echo "<a href=\"../profile-recruiter.php\">My Profile</a>";  echo " <a href=\"../resumes.php\">Upload Resumes</a>";  echo " <a href=\"../list_resumes.php\">My List</a>"; } else { echo "<a href=\"../profile.php\">My Profile</a>"; } ?>  <a href="../logout.php">Logout</a>  </p>
<?php } ?>
</div>


<!-- End of logo -->
</div><!-- End of header -->
<?php if(isset($_SESSION['member_id'])){ ?>
<div class="floatstatus">
<?php
$tmavi=time();
$tmid=$_SESSION['member_id']; 
if(isset($_POST['changestatusavailability'])){ 
$newavail=$_POST['changestatusavailability'];
$updateavailability= "UPDATE `user` SET  `status_time` = '$tmavi',  `availability` = '$newavail' WHERE `member_id`='$tmid'"; 
$updateavailability_result=mysql_query($updateavailability);

 }

$selectavailability = "SELECT * FROM `user` WHERE member_id='$tmid'";
$selectavailability_query=mysql_query($selectavailability);
while($selectavailability_query_fetch=mysql_fetch_array($selectavailability_query))
{

$availabilityexisting=$selectavailability_query_fetch['availability'];
}
// echo "<p> You are Currently <b>$availabilityexisting<b></p>";


?>
<!-- <form action="" name="changestatus" id="changestatus"  method="post">
<select name="changestatusavailability" id="changestatusavailability"  onchange='document.changestatus.submit();' >

	   <option value="Available" <?php if($availabilityexisting=="Available"){ echo "selected";} ?>>Available</option>
	   <option value="Not Available"  <?php if($availabilityexisting=="Not Available"){ echo "selected";} ?>  >Not Available</option>
	   <option value="Looking For Change"  <?php if($availabilityexisting=="Looking For Change"){ echo "selected";} ?>  >Looking For Change</option>
</select>
</form> -->

</div>
<?php } ?>
</div><!-- End of header_content -->

</div><!-- End of header_wrap -->
<div style="clear:both"></div>
<div class="wrapper_1">
<h2 class="inner_abh"><center>Why EMDB</center></h2>
<div class="section_2">
           <div class="sec2"  style="line-height: 28px;
    margin:  0px 0px 20px;text-align: justify;">
  
<p>Employeemasterdatabase.com is a repository of employee profiles. It effectively bridges the gap between the recruiters and job seekers by providing them a common platform. Through EMDB system, job seekers can indicate their availability/non-availability for job openings on need basis. This significantly increases the chance of recruiter connecting with the suitable candidate and thus makes the whole recruitment process simpler.




</p>

<p>In addition to confirming the availability status of the job seekers, EMDB helps the recruiters to reuse their existing resume database for every new job requirement. As registering with EMDB avoids the need to purchase resume database each time there is a new job requirement, it proves to be a cost-efficient process.
</p>

<p>EMDB helps job seekers to improve their chances of getting calls from the recruiter. Job seekers need to update their availability status as and when it changes. When job seekers change their status to ‘Available’, it shows up in recruiter search and is most likely to be preferred by the recruiter. On the other hand the when job seekers are not looking for a change, they can avoid calls from recruiters by updating the status to ‘Not Available’ in EMDB website. This process saves the valuable time of both recruiters and job seekers.  
</p>
<span  class="why">
		   <a href="../benefits.php"><img src="../images/benefits.png"></a>
		   <a href="../howitworks.php"><img src="../images/how1.png"></a></span>

 
<h3 style="color: #015498;">Features</h3>
<p>
<ul class="benefits">


<li>Acts as a common platform for recruiters and job seekers</li>

<li> Has an interactive and user-friendly interface </li>

<li> A centralized repository of job seeker profiles </li>

<li> Assigns a unique EMDB ID for each job seeker profile</li>

<li> Updates the availability status in the embed code of the resume as and when it is changed in the 

website </li>

<li> Enables the recruiters to perform profile search with EMDB ID to confirm job seeker’s 

availability status </li>

<li> Has in-built messaging option</li>

 
</ul>
</p>



</div><!-- End of wrapper -->
</div><!-- End of wrapper -->
</div><!-- End of wrapper -->


<?php 
include('../footer.php');
?>