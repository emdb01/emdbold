<?php        
    if(isset($_GET["email"])){
        $email=$_GET["email"];
    }
    if(isset($_GET["subscriber_id"])){
        $subscriber_id=$_GET["subscriber_id"];
    }

    verifyEmail($email,$subscriber_id);
    function verifyEmail($email,$subscriber_id){
        require_once 'email_validation.php';
        $validator = new email_validation_class;
        $validator->timeout = 10;
        $validator->data_timeout = 0;
        $validator->localuser = "info";
        $validator->localhost = "phpclasses.org";
        $validator->debug = 0;
        $validator->html_debug = 0;
        $result=$validator->ValidateEmailBox($email);
        $d = array('subscriber_id' => $subscriber_id, 'result' => $result);
        echo json_encode($d);
    }
        
        
                
	//echo "$subscriberid_".$subscriber_id;	
	//echo "$result_".$result;
        //$subscriberid = $subscriber_id;
        //$result = $result;
        
        
	
