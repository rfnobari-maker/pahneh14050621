<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');

$query = "SELECT Agri1398_1399.bah_cod_m , Agri1398_1399.mor_cod_m , Agri1398_1399.num_bah , Agri1398_1399.id_ostan , Agri1398_1399.id_city , Agri1398_1399.id_mar , Agri1398_1399.add_abadi , Agri1398_1399.add_city
FROM Agri1398_1399
LEFT OUTER JOIN bah ON Agri1398_1399.bah_cod_m = bah.bah_cod_m
WHERE bah.bah_cod_m IS NULL
GROUP BY Agri1398_1399.bah_cod_m , Agri1398_1399.num_bah";
$q = $dbh->prepare($query);
$q->execute();

 foreach($q as $row){
$bah_cod_m1 = $row['bah_cod_m'] ;
$num_bah = $row['num_bah'] ;
$id_ostan  = $row['id_ostan'] ;
$id_city  = $row['id_city'] ;
$id_mar  = $row['id_mar'] ;
$mor_cod_m  = $row['mor_cod_m'] ;
$add_abadi  = $row['add_abadi'] ;
$add_city  = $row['add_city'] ;

//$bah_cod_m2 = '00'.$bah_cod_m1 ; 
//alert($bah_cod_m1) ;
//alert($add_abadi) ;

$query = "UPDATE bah_2 SET id_ostan ='$id_ostan' , id_city= '$id_city' ,id_mar = '$id_mar' , 
mor_cod_m = '$mor_cod_m' , add_abadi = '$add_abadi' , add_city = '$add_city'
 WHERE bah_cod_m = '$bah_cod_m1' and num_bah = '$num_bah' and add_abadi = '' and add_city = '' ";
$q = $dbh->prepare($query);
$q->execute();
}
alert('تمام');
?>