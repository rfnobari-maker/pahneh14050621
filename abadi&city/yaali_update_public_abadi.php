<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT * from `abadi_new` where 1   " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$id_abadi = $row['id_abadi'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_bakh = $row['id_bakh'] ;
$id_deh = $row['id_deh'] ;
$abadi = $row['abadi'] ;
$ostan = $row['ostan'] ;
$city = $row['city'] ;
$bakh = $row['bakh'] ;
$deh = $row['deh'] ;

$query="UPDATE `public_abadi5` SET id_ostan=?,id_city=?,id_bakh=?,id_deh=?,abadi=?, 
ostan=?,city=?,bakh=?,deh=? WHERE id_abadi=?";
$q=$dbh->prepare($query);
$q->execute(array($id_ostan,$id_city,$id_bakh,$id_deh,$abadi,$ostan,$city,$bakh,$deh,$id_abadi));

//$query = "UPDATE `public_abadi5` SET add_abadi2= concat(id_ostan,id_city,id_bakh,id_deh,id_hozeh,id_abadi) ";
//$q = $dbh->prepare($query);
//$q->execute();

}
alert('تمام');
?>