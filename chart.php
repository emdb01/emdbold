<?php
include("lib/inc/chartphp_dist.php");
$p = new chartphp();
$ava = intval($todaystatus_data1);
$nava = intval($todaystatus_data2);
$lfc = intval($todaystatus_data3);
$ns = intval($todaystatus_data4);
$p->data = array(array(array('Available', $ava), array('Looking for change', $lfc), array('Not Available', $nava), array('No Status', $ns)));
$p->chart_type = "pie";
$out = $p->render('c1');
?> 
<script src="lib/js/jquery.min.js"></script> 
<script src="lib/js/chartphp.js"></script> 
<link rel="stylesheet" href="lib/js/chartphp.css"> 
<div> 
    <?php
    echo $out;
    ?> 
</div> 

