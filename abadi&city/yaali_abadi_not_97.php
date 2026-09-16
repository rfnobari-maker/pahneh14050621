<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT id_abadi from 	`public_abadi4` where 1   " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$id_abadi = $row['id_abadi'] ;

$query = "SELECT count(*) FROM  `abadi_new` WHERE  id_abadi = '$id_abadi'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_kol = $stmt->fetchColumn();

if ($count_kol == 0 )
{
//alert($id_abadi);
//alert($count_kol);

$query = "INSERT INTO `abadi_not97`( select * from `public_abadi4`  WHERE id_abadi=? )";
$q = $dbh->prepare($query);
$q->execute(array($id_abadi));

}
}
alert('تمام');
?>