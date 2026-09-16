<?php
function Patient_event($id_user,$ip,$date,$time,$id_mar,$verb,$id_Patient) {
include('../../login/config.php');
$query = "INSERT INTO Patient_log (id_user,ip,date,time,id_mar,verb,id_Patient) VALUES (:id_user,:ip,:date,:time,:id_mar,:verb,:id_Patient)";
$q = $dbh->prepare($query);
$q->execute(array(':id_user'=>$id_user,':ip'=>$ip,':date'=>$date,':time'=>$time,':id_mar'=>$id_mar,':verb'=>$verb,
':id_Patient'=>$id_Patient));
// clos conntection 
$dbh = null;
}

 // Patient_event(1,2,3,4,5,6,7) ;
//  $time = date('H:i:s') ;
//require_once('../../Jalali.php');
//date_default_timezone_set('Asia/Tehran') ;
//$date_edit = jdate("Y/m/d");
//$time = date('H:i:s') ;

?>
