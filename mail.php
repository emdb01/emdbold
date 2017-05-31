<?php
// echo $today = date("F j, Y, g:i a"); 
$msg = "First line of text\nSecond line of text";

echo "The time is " . date("h:i:sa");echo "<br>";
$msg = wordwrap($msg,70);

// send email
$succes=mail("mallelamurali89@yahoo.com","My subject",$msg);

 if($succes !=''){
	echo $succes;
}

echo "The time is " . date("h:i:sa");
?>
 <div style='background-color: #eae9ee;'>
        <p>This is your Global ID: <b style='color:#0c52ad;'>EMDB$mid</b></p>

        <p>Below are your credentials:</p>
        
        <p style='color:#0c52ad;'>Username: $mymails[$i]</p>
            
        <p style='color:#0c52ad;'>Password: $password</p>
            
        </div>