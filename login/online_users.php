<?php 
function online()
{
include('../Jalali.php');
$date = jdate("Y/m/d") ;
$time = date('H:i:s') ;
$h = substr($time,0,2);
$i = substr($time,3,2);
$s = substr($time,6,2);
if ($i<10)  {  $old_i =(60-$i) ; $old_h = ($h - 1); }   else  {  $old_i = ($i - 10); $old_h = ($h) ; } 
if (strlen($old_h) == 1) $old_h = '0'.$old_h;
if (strlen($old_i) == 1) $old_i = '0'.$old_i;
$p_time = $old_h.':'.$old_i.':'.$s ;
include("config.php");
$query = "SELECT * from Last_user where date = '$date' and  time >= '$p_time' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_online = $stmt -> rowCount() ;
return $no_online ; 
}
?>