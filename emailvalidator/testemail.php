<?php 
$email="mmurali.technodrive@gmail.com";

/*
 * PHP PCRE - How to check if a email address is valid using regular expressions
 */

//A valid email address
$email = "mmurali.technodrive@gmail.com";
//the pattern is "any letter or number followed by @ followed by any letter or number 
//followed by . followed by 2-4 letters and maybe another . (for tlds like co.uk)
$okay = preg_match(
        '/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/', $email
);
if ($okay) {
    echo $email." is valid<br />";
} else {
    echo $email." is invalid<br />";
}

//An invalid email address
$email = "email[at]example[dot]com";
//the pattern is "any letter or number followed by @ followed by any letter or number 
//followed by . followed by 2-4 letters and maybe another . (for tlds like co.uk)
$okay = preg_match(
        '/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$/', $email
);
if ($okay) {
    echo $email." is valid<br />";
} else {
    echo $email." is invalid<br />";
}
?>
