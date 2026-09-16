<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT * from `city_tagher` WHERE 1 " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){

$add_city = $row['add_city'] ;
$add_city_old = $row['add_city_old'] ;
$id_city = $row['id_city'] ;
$city = $row['city'] ;
$bakh = $row['bakh'] ;
$shahr = $row['shahr'] ;
$add_bakh = substr($add_city,0,6) ; 


//alert($add_city) ; 
//alert($city) ; 
//alert($bakh) ; 
//alert($shahr) ; 


$query="UPDATE `list_city` SET city=?,bakh=?,shahr=?,id_city=?,add_bakh=?,add_city=? WHERE add_city = ?";
$q=$dbh->prepare($query);
$q->execute(array($city,$bakh,$shahr,$id_city,$add_bakh,$add_city,$add_city_old));


}
alert('تمام');
?>