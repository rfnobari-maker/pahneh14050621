<?php
include ('../../login/config.php');
$query = "SELECT date_joj FROM samasat2 WHERE 1 group by date_joj  " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$date_joj = $row['date_joj'] ; 
$age_day = age_day($date_joj) ; 
$query = "UPDATE samasat2 SET age_day = '$age_day'  where date_joj = '$date_joj' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
}
?>
