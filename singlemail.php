
<?php
require("email_validation.php");
$validator = new email_validation_class();
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

$myemails = array();

foreach ($mymails as $key => $mymails1) {


    if ($mymails1 != '') {

        $mymails1 = trim($mymails1);
        if (strlen($error = $validator->ValidateAddress($mymails1, $valid))) {

            $myemails[$key] = 0;
        } elseif (!$valid) {

            $myemails[$key] = 0;
            if (count($validator->suggestions)) {
                $suggestion = $validator->suggestions[0];
                $link = '?email=' . UrlEncode($suggestion);

                $myemails[$key] = 0;
            }
        } elseif (($result = $validator->ValidateEmailBox($mymails1)) < 0) {

            $myemails[$key] = 0;
        } else if ($result == 0) {

            $myemails[$key] = 0;
        } else if ($result == 1) {

            $myemails[$key] = $mymails1;
        }
    } else {

        $myemails[$key] = 0;
    }
}
?>