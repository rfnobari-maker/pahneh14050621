<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT * from 	`city_sabet` WHERE 1 " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$add_city = $row['add_city'] ;
$city = $row['city'] ;
$bakh = $row['bakh'] ;
$shahr = $row['shahr'] ;

//alert($add_city) ; 
//alert($city) ; 
//alert($bakh) ; 
//alert($shahr) ; 

$query="UPDATE `public_city` SET city=?,bakh=?,shahr=? WHERE add_city = ?";
$q=$dbh->prepare($query);
$q->execute(array($city,$bakh,$shahr,$add_city));

$query="UPDATE `list_city` SET city=?,bakh=?,shahr=? WHERE add_city = ?";
$q=$dbh->prepare($query);
$q->execute(array($city,$bakh,$shahr,$add_city));


}
alert('تمام');
?>