<?php 
$filename="anilravula@gmail.com.doc";

   
    if ( file_exists($filename) ) {        

    if ( ($fh = fopen($filename, 'r')) !== false ) {

    $headers = fread($fh, 0xA00);

    $n1 = ( ord($headers[0x21C]) - 1 );

    $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );

    $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );

    $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );


    $textLength = ($n1 + $n2 + $n3 + $n4);

    $extracted_plaintext = fread($fh, $textLength);

    echo $text1=nl2br($extracted_plaintext);
	 $text = str_replace('+91', '+91 ', strtolower(nl2br($text1)));
        $pattern = "/(?:[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
        $fileCount = preg_match_all($pattern, strtolower(nl2br($text)), $matches);
        echo $fileCount;exit;

    print_r(extract_emails_from($extracted_plaintext));    

         }

        }

    function extract_emails_from($string) {
             preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
             return $matches[0];
    }
?>