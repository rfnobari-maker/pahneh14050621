<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT bah_cod_m,no_bah from bah3  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$bah_cod_m = $row['bah_cod_m'] ;
$no_bah = $row['no_bah'] ;
$query = "INSERT INTO bah_del(select * from bah  WHERE bah_cod_m = ? and no_bah = ?) ";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$no_bah));
}
alert('تمام');
?>