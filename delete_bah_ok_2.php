<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT bah_cod_m,num_bah from bah where ok = '2'  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
foreach($stmt as $row)
{
 $bah_cod_m = $row['bah_cod_m'] ; 
 $num_bah = $row['num_bah'] ; 
//alert($bah_cod_m) ; 
//alert($num_bah) ; 

$query = "DELETE from Garden WHERE bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and z_sal = '1402'";
$q = $dbh->prepare($query);
$q->execute();

$query = "DELETE from Garden_prod WHERE bah_cod_m = '$bah_cod_m' and num_bah = '$num_bah' and z_sal = '1402'";
$q = $dbh->prepare($query);
$q->execute();

}
//$dbh = null;
//alert('تمام');
?>