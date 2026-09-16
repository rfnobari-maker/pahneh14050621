<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT bah_cod_m  FROM bah_nook  order by id "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array($mor_cod_m));
foreach($stmt as $row){
$bah_cod_m = $row['bah_cod_m'] ;
//alert($bah_cod_m) ; 
$query = "SELECT count(*) FROM  Garden WHERE  bah_cod_m = $bah_cod_m " ;
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count_city = $stmt->fetchColumn();
if ($count_city > 0 ) 
{
//alert($bah_cod_m) ; 
//alert($count_city) ; 
$sql = "DELETE FROM bah_nook WHERE bah_cod_m =  :bah_cod_m";
$stmt =  $dbh->prepare($sql);
$stmt->bindParam(':bah_cod_m', $bah_cod_m, PDO::PARAM_INT);   
$stmt->execute();
}
}
alert('تمام');
?>