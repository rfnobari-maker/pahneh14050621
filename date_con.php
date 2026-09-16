<?php
function date_con($date)
 {
if (strlen($date)==10)
{
 $yy = (substr($date,0,4)*1);
 $mm = (substr($date,5,2)*1) ;
 $dd = (substr($date,8,2)*1) ;
$new_date = $yy.'-'.$mm.'-'.$dd ;
}
if (strlen($date)==9)
{
 $yy = substr($date,0,4);
if ((substr($date,5,2)*1)>10)
{
 $mm = substr($date,5,2) ;
 $dd = '0'.substr($date,8,1) ;
}
else 
{
 $mm = '0'.substr($date,5,1) ;
 $dd = substr($date,7,2) ;
 }
$new_date = $yy.'-'.$mm.'-'.$dd ;
}

if (strlen($date)==8)
{
 $yy = substr($date,0,4);
 $mm = '0'.substr($date,5,1) ;
 $dd = '0'.substr($date,7,1) ;
$new_date = $yy.'-'.$mm.'-'.$dd ;
}
if (strlen($new_date)==10)
{
    return $new_date;
}
else
{
$yy = substr($new_date,0,4);
$mm = substr($new_date,5,2)*1 ; 
if ($mm<10)
{
$mm = '0'.$mm ;
$new_date = $yy.'-'.$mm.'-'.$dd ;
}
//echo $mm ; 
 $dd = substr($new_date,8,2)*1 ;
if ($dd<10)
{
$dd = '0'.$dd ;
$new_date = $yy.'-'.$mm.'-'.$dd ;
}
    return $new_date;

}
}
//echo date_con('1393/02/03') ;
?>
