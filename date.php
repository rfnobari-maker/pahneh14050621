<?php 
include ('login/config.php');
include ('event.php');
require_once('Jalali.php');
$date_check =  jdate('Y/m/d',time()-(2*86400)) ;
$query = "UPDATE date SET date = '$date_check'  ";
$q = $dbh->prepare($query);
$q->execute(array($mor_cod_m,$add_abadi));
// clos conntection 
$dbh = null;
?>
