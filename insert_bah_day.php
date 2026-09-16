<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT bah_cod_m,no_bah from bah_day where 1 "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$bah_cod_m = $row['bah_cod_m'] ;
$no_bah = $row['no_bah'] ;
//alert($bah_cod_m) ; 
//alert($bah_cod_m) ; 
$query = "DELETE from bah20 WHERE bah_cod_m = ? and no_bah = ? ";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$no_bah));
}
$query = "INSERT INTO bah20 (select * from bah_day where 1) ";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from bah_day WHERE 1 ";
$q = $dbh->prepare($query);
$q->execute(array($bah_cod_m,$no_bah));

alert('تمام');

?>