<?php 
error_reporting(0);
ob_start();
include('config/config.php');

 $listdetailsuserexport = "SELECT * FROM `recruiter`  where role!=1";
                            $listdetailsuser_queryexport = mysql_query($listdetailsuserexport);
                            while ($listdetailsuser_query_fetch_export = mysql_fetch_array($listdetailsuser_queryexport)) {
                                $expid = $listdetailsuser_query_fetch_export['user_id'];
                                if ($thestringuser != "") {

                                    $thestringuser = $thestringuser . ',' . $expid;
                                } else {
                                    $thestringuser = $expid;
                                }
                            }
$outstr = NULL;
$outstr='First Name'. "\t" .'Middle Name'. "\t" .'Last Name'. "\t" .'Email'. "\t" . "\r\n";

$bigstring=$thestringuser;
$arayofuser=explode(",",$bigstring);
$numb = count($arayofuser);
while ($numb!=0){
$val=$numb-1;
$userid=$arayofuser[$val];
$listdetails = "SELECT * FROM `recruiter` where user_id=$userid ";
$listdetails_query=mysql_query($listdetails);
while($listdetails_query_fetch=mysql_fetch_array($listdetails_query))

{
$fname1=$listdetails_query_fetch['first'];
$mname1=$listdetails_query_fetch['middle'];
$lname1=$listdetails_query_fetch['last'];
$email=$listdetails_query_fetch['email'];
$id=$listdetails_query_fetch['user_id'];


}


$numb=$numb-1;
$outstr=$outstr.$fname1. "\t" .$mname1. "\t" .$lname1. "\t" .$email. "\t" . "\r\n";
}
header("Content-Type: application/vnd.ms-excel");
header("Content-disposition: attachment; filename=Recruiter_list.xls");
echo $outstr;

