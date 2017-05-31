<?php
 $modifiedDate = '2016-08-02 17:50:20';
$then = new DateTime($modifiedDate,new DateTimeZone("Asia/Kolkata" ));
$currentDate = new dateTime();
$sinceThen = $currentDate->diff($then);
  $y=$sinceThen->y;$m=$sinceThen->m; $d=$sinceThen->d ;$h=$sinceThen->h;$i=$sinceThen->i;$s=$sinceThen->s;
 if($y !=0){
	 echo $y .  "   " ."year(s) ago<br>";
 }else if($m !=0){
		 echo $m .  "   " ."month(s) ago<br>";
 }else if($d!=0){
		 echo $d .  "   " ."day(s) ago<br>";
 }else if($h !=0){
		 echo $h .  "   " ."hour(s) ago<br>";
 }else if($i !=0){
		 echo $i .  "   " ."minute(s) ago<br>";
 }else if($s !=0){
	 echo $s .  "   " ."second(s) ago <br>";
 }


 ?>
 