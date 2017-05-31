<center>
<form action="" method="POST">
Enter EMDB Id : <input type="text" name="emdbId" required>
<input type="submit">
</form>
</center>



<?php 
error_reporting(0);
 if(isset($_POST['emdbId'])){
	 $emdbId = $_POST['emdbId'];
// EMDB status api
            $url = "https://www.employeemasterdatabase.com/getstatus.php?eid=$emdbId";
//  Initiate curl
            $ch = curl_init();
// Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
            curl_setopt($ch, CURLOPT_URL, $url);
// Execute
            $emdbStatus = curl_exec($ch);
            if ($emdbStatus != '') {
                
            } else {
                $emdbStatus = 'No Status';
            }
// Closing
            curl_close($ch);

            // EMDB status api
 }
 echo "<center>";
 echo $emdbStatus;
 echo "</center>";
			?>