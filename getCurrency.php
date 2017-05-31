<?php 
include('config/config.php');
 $country = $_GET['foldername'];
 $comp_check = mysql_fetch_assoc($comp_result = mysql_query($sqlComp = "SELECT * FROM `countries` where `countryName`='$country'"));
 echo     $company = $comp_check['countryCode'];
?>
   


