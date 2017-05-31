<?php
$online=true;
//$offline=true;
if(isset($online))
{
$servername='localhost';     // Your MySql Server Name or IP address here
$dbusername='root';                // Login user id here
$dbpassword='oNxwlyLMfOTebxLi';                // Login password here
}elseif(isset($offline))
{
$servername='ec2-23-23-228-115.compute-1.amazonaws.com';     // Your MySql Server Name or IP address here
$dbusername='igejpvqxokuywq';                // Login user id here
$dbpassword='a44221ce114876d34f5d5f02630f5ff069211987a1a80ca89c865b8edb3dec8a';                // Login password here	
	}
$dbname='d6ig0dt8ce3mnf';     // Your database name here

connecttodb($servername,$dbname,$dbusername,$dbpassword);
function connecttodb($servername,$dbname,$dbuser,$dbpassword)
{
global $link;
$link=mysql_connect ("$servername","$dbuser","$dbpassword");
if(!$link){die("Could not connect to MySQL");}
mysql_select_db("$dbname",$link) or die ("could not open db".mysql_error());
}

include('functionsall.php');

?>