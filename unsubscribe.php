<?php
error_reporting(0);
ob_start();
include('config/config.php');
$to=$_GET['em'];
$userupdate = "UPDATE `invites` SET `mailStatus`='1' WHERE `email`='$to'";
$userupdate_result = mysql_query($userupdate);

 ?>
<center>
<h3>
THANK YOU...
</h3>
    <p>
     You were successfully removed from the EMDB.</p>
<p>Hopefully you will come back one day.</p>

<p>Having doubts?</p>
<p>Please <a href="https://employeemasterdatabase.com/subscribe.php?em=<?php echo $to; ?>">click</a> here in order to subscribe again to the list.   
        
    </p>
</center>