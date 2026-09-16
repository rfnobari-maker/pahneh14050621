<?php 
include ('login/config.php');
include ('event.php');
require_once('Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_check =  jdate('Y/m/d',time()-(1*86400)) ;
$query = "UPDATE date SET date = '$date_check'  ";
$q = $dbh->prepare($query);
$q->execute();
// clos conntection 
$dbh = null;
?>
