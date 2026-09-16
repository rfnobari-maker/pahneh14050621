<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');

$query = "SELECT  Agri1398_1399.bah_cod_m , Agri1398_1399.mor_cod_m , Agri1398_1399.num_bah
FROM Agri1398_1399
LEFT OUTER JOIN bah ON Agri1398_1399.bah_cod_m = bah.bah_cod_m 
WHERE bah.bah_cod_m IS NULL 
GROUP BY Agri1398_1399.bah_cod_m , Agri1398_1399.num_bah ";
$q = $dbh->prepare($query);
$q->execute();

 foreach($q as $row){
$bah_cod_m1 = $row['bah_cod_m'] ;
$num_bah = $row['num_bah'] ;

//$bah_cod_m2 = '00'.$bah_cod_m1 ; 

$query = "SELECT id FROM bah2 WHERE bah_cod_m LIKE '$bah_cod_m1' and num_bah = '$num_bah' ";
$q = $dbh->prepare($query);
$q->execute();
$row = $q->fetch(PDO::FETCH_ASSOC);
$id = $row['id'] ;
if($id !="")
{
$query = "INSERT INTO bah22(select * from bah2 where id = $id)";
$q = $dbh->prepare($query);
$q->execute();
}
}
alert('تمام');
?>