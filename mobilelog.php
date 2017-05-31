<?php
ob_start();
@session_start();
include("config/config.php");
?>
<?php
 $dataList = json_decode(file_get_contents("php://input"), true);
 $email = $dataList['email'];
 $pass = $dataList['pass'];
if (isset($email)) {
    date_default_timezone_set('Asia/Kolkata');
    $dateTime = date('Y-m-d H:i');
    $usr = $email;
    $psd = $pass;
    $psd1 = md5($psd);

    $usercheck = mysql_query("select * from `user` where `email` ='$usr' and `pass` ='$psd1' and `verify` ='1'");
    $checkexist_check = mysql_num_rows($usercheck);
    if ($checkexist_check == 1) {
        while ($sqlf1 = mysql_fetch_array($usercheck)) {
            $var = $sqlf1['first'];
            $var2 = $sqlf1['middle'];
            $var3 = $sqlf1['last'];
            $var4 = $sqlf1['member_id'];
            $var5 = $sqlf1['email'];
            $var6 = $sqlf1['role'];
            $var7 = $sqlf1['user_id'];
            $var8 = $sqlf1['visits'];
            $var9 = $sqlf1['availability'];
        }
        $row = mysql_num_rows($usercheck);
        if ($row == 1) {
            if ($var6 == 1 || $var6 == 4) {
                $visits = $var8 + 1;
                $Up = mysql_query("UPDATE `user` SET visits='$visits',dateTime='$dateTime' WHERE `email`='$usr'");
               
            } else {

                $visits = $var8 + 1;
                $Up = mysql_query("UPDATE `user` SET visits='$visits',dateTime='$dateTime' WHERE `email`='$usr'");
            }
        }
        $user = array('firstName'=>$var,'middleName'=>$var2,'lastName'=>$var3,'member_id'=>$var4,'email'=>$var5,'role'=>$var6,'user_id'=>$var7,'visits'=>$var8,'availability' => $var9);
     echo json_encode(array(
               'response_code' => '200',
               'response_message' => 'Login Successfully',
               'user' => $user));
    }else{
        echo json_encode(array(
               'response_code' => '200',
               'response_message' => 'Incorrect Credentials')); 
    } 
    
} 
?>
		