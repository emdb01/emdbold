
        <?php
        require("email_validation.php");
        $validator = new email_validation_class;
        if (!function_exists("GetMXRR")) {
            $_NAMESERVERS = array();
            include("getmxrr.php");
        }
        $validator->timeout = 10;
        $validator->data_timeout = 0;
        $validator->localuser = "info";
        $validator->localhost = "phpclasses.org";
        $validator->debug = 1;
        $validator->html_debug = 1;
   
            $mymails = trim("rajamohffan.technodrive@gmail.com");
            if (strlen($error = $validator->ValidateAddress($mymails, $valid))) {
                $mymails=0;
            } elseif (!$valid) {
                $mymails=0;
                if (count($validator->suggestions)) {
                    $suggestion = $validator->suggestions[0];
                    $link = '?email=' . UrlEncode($suggestion);
                   $mymails=0;
                }
            } elseif (($result = $validator->ValidateEmailBox($mymails)) < 0){
                $mymails=0;
			}
            else if($result ==0){
				  $mymails=0;
	  }else if($result ==1){
		   $mymails=1;
	
                                
	  }
	  echo $mymails;
        ?>