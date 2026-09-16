<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT bah_cod_m,no_bah from bah3  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$bah_cod_m = $row['bah_cod_m'] ;
$no_bah = $row['no_bah'] ;
$query = "DELETE from bah2 WHERE bah_cod_m = ? and no_bah = ? and ok = ? ";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$no_bah,'2'));
}
alert('تمام');
?>