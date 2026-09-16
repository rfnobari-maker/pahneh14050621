<?php
date_default_timezone_set('Asia/Tehran');
function timeDiff($time2,$time1){
    $diff = strtotime($time2) - strtotime($time1);
    if($diff < 60){
        return $diff.' ثانیه قبل';
    }
    elseif($diff < 3600){
        return round($diff / 60,0,1).' دقیقه ';
    }
    elseif($diff >= 3660 && $diff < 86400){
        return round($diff / 3600,0,1).' ساعت ';
    }
    elseif($diff > 86400){
        return round($diff / 86400,0,1).' روز ';
    }
}
 
//$time2 = '2016-07-28 13:00:00';
$time2 = date('Y-m-d H:i:s');
//$time1 = jalali_to_gregorian(1398,09,30,'-');
$time1 = '2020-03-04 24:00:00';

