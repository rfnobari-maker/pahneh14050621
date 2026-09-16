<?php
function age_day($date){
require_once('Jalali.php');
$time2 = date("Y/m/d");
$arr_parts = explode('/', $date);
 $jYear  = $arr_parts[0];
 $jMonth = $arr_parts[1];
 $jDay   = $arr_parts[2];
 $time1   = jalali_to_gregorian($jYear, $jMonth, $jDay);
 $time3 = $time1[0].'-'.$time1[1].'-'.$time1[2] ; 
      $diff = strtotime($time2) - strtotime($time3);
        return round($diff / 86400,0,1);
}

echo  age_day('1400/01/25'); 
?>
