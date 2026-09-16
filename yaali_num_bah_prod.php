<?php
include ('login/config.php');
include ('event.php');
$query = "SELECT  bah_cod_m from Garden_prod  WHERE num_bah ='/'  "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
//$count = $stmt -> rowCount();
foreach($stmt as $row){
 $bah_cod_m = $row['bah_cod_m'] ;
//alert($mor_cod_m);
$query2 = "SELECT num_bah from bah  WHERE  bah_cod_m = '$bah_cod_m'  "; 
$stmt = $dbh->prepare($query2);
$stmt->execute();
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
//$count = $stmt -> rowCount();
 $num_bah = $row2['num_bah'] ;
//alert($id_mar);
$query = "UPDATE Garden_prod SET num_bah=?  WHERE  bah_cod_m = ? and num_bah ='/' ";
$q = $dbh->prepare($query);
$q->execute(array($num_bah,$bah_cod_m));
}
alert('تمام');
?>