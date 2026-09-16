<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT * from `city_tagher` where 1" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$id_shahr = $row['id_shahr'] ;
$id_ostan = $row['id_ostan'] ;
$add_city = $row['add_city'] ;
$id_city = $row['id_city'] ;
$id_bakh = $row['id_bakh'] ;
$shahr = $row['shahr'] ;
$ostan = $row['ostan'] ;
$city = $row['city'] ;
$bakh = $row['bakh'] ;

$query="UPDATE `public_city` SET id_city=?,id_bakh=?,shahr=?, 
city=?,bakh=?,add_city=? WHERE id_shahr=?";
$q=$dbh->prepare($query);
$q->execute(array($id_city,$id_bakh,$shahr,$city,$bakh,$add_city,$id_shahr));

}
alert('تمام');
?>