<?php
include ('login/config.php');
include ('event.php');
echo $query = "SELECT bah_cod_m,num_bah  FROM Agri_prod1398_1399 where 1 group by bah_cod_m,num_bah   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$bah_cod_m = $row['bah_cod_m'] ;
$num_bah = $row['num_bah'] ;
//alert($bah_cod_m) ; 
//alert($num_bah) ; 
$query = "UPDATE bah2 SET ok = '1399' where bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah'"; 
$stmt = $dbh->prepare($query);
$stmt->execute();

}
alert('تمام');
?>