<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');
$query = "SELECT bah_cod_m,m_forosh from GTC97_bah WHERE 1  " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
$bah_cod_m = $row['bah_cod_m'] ;
$m_forosh = $row['m_forosh'] ;


//alert($bah_cod_m);
//alert($post_cod);


$query = "UPDATE GTC97_bah_ok_1 SET m_forosh=?  WHERE bah_cod_m =? ";
$q = $dbh->prepare($query);
$q->execute(array($m_forosh,$bah_cod_m));

}


alert('تمام');
?>