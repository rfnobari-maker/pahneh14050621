<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');

$query = "SELECT  Agri1400_1401.bah_cod_m , Agri1400_1401.mor_cod_m , Agri1400_1401.num_bah
FROM Agri1400_1401
LEFT OUTER JOIN bah ON Agri1400_1401.bah_cod_m = bah.bah_cod_m 
WHERE bah.bah_cod_m IS NULL  and  length(Agri1400_1401.bah_cod_m ) < 10 
GROUP BY Agri1400_1401.bah_cod_m , Agri1400_1401.num_bah ";
$q = $dbh->prepare($query);
$q->execute();

 foreach($q as $row){
$bah_cod_m1 = $row['bah_cod_m'] ;
$num_bah = $row['num_bah'] ;

//$bah_cod_m2 = '00'.$bah_cod_m1 ; 

$query = "SELECT bah_cod_m FROM bah WHERE bah_cod_m LIKE '%$bah_cod_m1%' and num_bah = '$num_bah' ";
$q = $dbh->prepare($query);
$q->execute();
$row = $q->fetch(PDO::FETCH_ASSOC);
$bah_cod_m2 = $row['bah_cod_m'] ;
if($bah_cod_m2 !="")
{


$query = "UPDATE bee SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah'  WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE unknown_bee  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1395_1396  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1396_1397  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1397_1398  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1398_1399  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1399_1400  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri1400_1401  SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();


$query = "UPDATE Garden SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();
$query = "UPDATE Garden_prod SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1395_1396 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1395_1396 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1396_1397 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1397_1398 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1398_1399 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1399_1400 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Agri_prod1400_1401 SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();


$query = "UPDATE Aquatic SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Greenhousn SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Greenhous_prod SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Vege SET bah_cod_m ='$bah_cod_m2' , no_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Vege_prod SET bah_cod_m ='$bah_cod_m2' , no_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Mushroom SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE Mushroom_prod SET bah_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE bah_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

$query = "UPDATE malek SET m_cod_m ='$bah_cod_m2' , num_bah= '$num_bah' WHERE m_cod_m = $bah_cod_m1";
$q = $dbh->prepare($query);
$q->execute();

alert('تمام');
}
}
?>