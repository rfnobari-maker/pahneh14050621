<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query="SELECT 	id_abadi from `abadi_del` where 1 ";
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$id_abadi = $row['id_abadi'] ;
$query="DELETE FROM `public_abadi4` WHERE `id_abadi` = '$id_abadi'  ";
$q = $dbh->prepare($query);
$q->execute();
}
alert('تمام');
?>