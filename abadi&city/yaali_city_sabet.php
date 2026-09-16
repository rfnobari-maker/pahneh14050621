<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT add_city from 	`public_city` where 1   " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$add_city = $row['add_city'] ;

$query = "SELECT count(*) FROM  `city_new` WHERE  add_city = '$add_city'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_kol = $stmt->fetchColumn();

if ($count_kol == 1 )
{
//alert($add_city);
//alert($count_kol);

$query = "INSERT INTO `city_sabet`( select * from `city_new`  WHERE add_city=? )";
$q = $dbh->prepare($query);
$q->execute(array($add_city));
//alert($query);
}
}
alert('تمام');
?>