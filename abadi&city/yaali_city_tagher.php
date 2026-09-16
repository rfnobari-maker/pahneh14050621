<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT id_shahr , add_city from 	`public_city` where 1   " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$add_city = $row['add_city'] ;
$id_shahr = $row['id_shahr'] ;

$query = "SELECT count(*) FROM  `city_new` WHERE  id_shahr = $id_shahr and add_city != '$add_city'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_kol = $stmt->fetchColumn();

if ($count_kol == 1 )
{
//alert($add_city);
//alert($count_kol);

$query = "INSERT INTO `city_tagher`( select * from `city_new`  WHERE id_shahr=? )";
$q = $dbh->prepare($query);
$q->execute(array($id_shahr));
//alert($query);
}
}
alert('تمام');
?>