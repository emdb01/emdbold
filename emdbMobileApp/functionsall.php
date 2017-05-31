<?php
    function mailfun($nam,$emd,$mg,$link){
        $email='support@employeemasterdatabase.com'; 		
        $to = $emd;
        $subject = 'Verification Mail From Employeemasterdatabase.com';
        $link=$link;
        $message = '
        <html>
        <head>
        <title>Verification Mail From Employeemasterdatabase.com</title>
        </head>
        <body>
        Hello '."$nam".',
        <p>'."$mg".'</p>
        <p>'."$link".'</p>
        <p>Note: Follow the directions in your account page after logging in</p>
        <p><i>Regards<i></p>
        <p>Employeemasterdatabase.com</p>
        </body>
        </html>
        ';
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        // More headers
        $headers .= 'From: '."$email \r\n";
        $success=mail($to,$subject,$message,$headers);  
    }
    //Message sent to User
    function sendmessagetouser($ufulname,$emailtosend,$mesg,$fulname,$recruiteremail){
        $email=$recruiteremail; 		
        $to = $emailtosend;
        $subject = 'Notification Mail From Employeemasterdatabase.com';
        $message = '
        <html>
        <head>
        <title>Notification Mail From Employeemasterdatabase.com</title>
        </head>
        <body>
        Hello '."$ufulname".',
        <p>'."$mesg".'</p>
        <p><i>Regards<i></p>
        <p>'."$fulname".'</p>
        <p>Employeemasterdatabase.com</p>
        </body>
        </html>
        ';
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        // More headers
        $headers .= 'From: '."$email \r\n";
        $success=mail($to,$subject,$message,$headers);  
    }
    //Message sent to User

    function ifidavail($mid){
        global $conn;
        $cmid=$mid;
        $es=1;
        while ($es=='1'){
                $ifidexist = "SELECT * FROM `user` WHERE member_id='$cmid'";
                //$ifidexist_query=mysqli_query($ifidexist);
                //$ifidexist_check=mysqli_num_rows($ifidexist_query);
                $ifidexist_query = $conn->query($ifidexist);
                $ifidexist_check = $ifidexist_query->num_rows;
                if($ifidexist_check >= 1 ){
                $tm=time();
                $tempid=mt_rand (10,99);
                $cmid=$tempid.$tm;
                $es=1;
            } 
            else {
                $es=2;
                return $cmid;
            }
        } 
    }

    function rmdir_recursive($dir) {
        foreach(scandir($dir) as $file) {
           if ('.' === $file || '..' === $file) continue;
           if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
           else unlink("$dir/$file");
       }
       rmdir($dir);
    }

    function removefile($dir) {
        if ($handle = opendir("$dir")) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $path = $entry;
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    if( $ext == 'pdf' || $ext == 'PDF' || $ext == 'docs'|| $ext == 'docx'|| $ext == 'doc'  ){
                    } else {
                        $filepathunlink="./$dir/".$entry;
                        @unlink($filepathunlink);
                    }
                }
            }
            closedir($handle);
        } 
    }

    function curPageURL() {
        $pageURL = 'http';
        if (@$_SERVER["HTTPS"] == "on") {@$pageURL .= "s";}
            $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    function extract_email_address ($string) {
        global $conn;
        foreach(preg_split('/\s/', $string) as $token) {
            $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
            if ($email !== false) {
            $checkexist_check="";
            $checkexist = "select count(*)  as total from `recruiter`, `user` where recruiter.email='$email' OR user.email='$email'";
            //$checkexist_query=mysqli_query($checkexist);
            //@$data=mysql_fetch_assoc($checkexist_query);$result->fetch_assoc()
            $checkexist_query = $conn->query($checkexist);
            $data = $checkexist_query->fetch_assoc();
            $checkexist_check = $data['total'];
            if($checkexist_check == 0 ){
                    $emails[] = $email;
                }
            }
        } 
        return @$emails;
    }

    //Invite sent to user
    function sendmessageinvite($email){
        global $conn;
        $to = $email;
        $email="info@employeemasterdatabase.com"; 		
        $subject = 'Request from Your Recruiter';
        $ricid=$_SESSION['user_id'];
        $company="";
        $checkexist = "SELECT * FROM `recruiter` WHERE user_id='$ricid'";
        //$checkexist_query=mysqli_query($checkexist);
        //$checkexist_check=mysqli_num_rows($checkexist_query);
        $checkexist_query = $conn->query($checkexist);
        $$checkexist_check = $checkexist_query->num_rows;
        //while($checkexist_query_fetch=mysqli_fetch_array($checkexist_query)){
        while($checkexist_query_fetch=$checkexist_query->fetch_array()){
            $fname=$checkexist_query_fetch['first'];
            $lname=$checkexist_query_fetch['middle'];
            $mname=$checkexist_query_fetch['last'];
            $company=$checkexist_query_fetch['company'];
            if($company==""){
                $company="Employee Master Database";
            }
        }
        if($mname==""){
            $fulname=$fname." ".$lname;
        } else {
            $fulname=$fname." ".$mname." ".$lname;
        }
        $message = '
        <html>
        <head>
        <title>Request from Your Recruiter</title>
        </head>
        <body>
        <p>Hello there,</p>
        <p>This is '."$fulname".' from '."$company".'. I am sending this email to request you to sign up at Employee Master Database and get your unique ID. With the help of EMDB ID I would be able to monitor your availability status in real time. So that I can give you call sooner, depending on your status as soon I have any position for you.</p>
        <p>Click on the link below to sign up as a job seeker </br>
                                <a href="http://employeemasterdatabase.com/register.php">http://employeemasterdatabase.com/register.php</a> </br>
        Once you get your unique ID, add it to your resume before applying to any further jobs</p>
        <p>With the help of EMDB ID I would be able to monitor your availability status in real time. So that I can give you call depending on your status as soon I have any position for you.</p>
        <p><i>Regards<i></p>
        <p>Support Team</p>
        <p>Employeemasterdatabase.com</p>
        </body>
        </html>';
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        // More headers
        $headers .= 'From: '."$email \r\n";
        $success=mail($to,$subject,$message,$headers);  
    }
//Invite sent to user
