<?php
date_default_timezone_set('Asia/Tehran');
require_once('../../Jalali.php');
function timeDiff($time2,$time1){
    $diff = strtotime($time2) - strtotime($time1);
    if($diff < 86400){
        return 'امروز';
    }
    elseif($diff >= 86400){
        return round($diff / 86400,0,1).' روز قبل';
    }
}
$time5 = jalali_to_gregorian(1396,06,27,'/');
$time5 = join("/",$time5);
$time4 = date('Y-m-d');
echo timeDiff($time4,$time5); // 6 روز قبل
echo '<p>';
//echo jdate('Y/m/d',date()-3);
echo jdate('Y/m/d',time()-(3*86400)) ;
echo '<p>';
echo jdate('Y/m/d',time()) ;