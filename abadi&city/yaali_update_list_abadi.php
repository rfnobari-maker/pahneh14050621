<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT * from `public_abadi4` where 1   " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$add_abadi = $row['add_abadi'] ;
$add_abadi1 = $row['add_abadi1'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$abadi = $row['abadi'] ;
$ostan = $row['ostan'] ;
$city = $row['city'] ;
$bakh = $row['bakh'] ;
$deh = $row['deh'] ;
$add_bakh = substr($add_abadi,0,6) ;
$add_deh = substr($add_abadi,0,10) ; 
//alert($add_bakh) ; 
//alert($add_deh) ; 


$query="UPDATE `list_abadi97` SET add_abadi=?,id_ostan=?,id_city=?,abadi=?, 
ostan=?,city=?,bakh=?,deh=?,add_deh=?,add_bakh=? WHERE add_abadi=?";
$q=$dbh->prepare($query);
$q->execute(array($add_abadi,$id_ostan,$id_city,$abadi,$ostan,$city,$bakh,$deh,$add_deh,$add_bakh,$add_abadi1));


}
alert('تمام');
?>