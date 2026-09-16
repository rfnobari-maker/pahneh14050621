<?php
//// جستجو در بانک اطلاعات عمومی بر اساس آدرس آماری آبادی 
include('../login/config.php');
//$id_abadi = substr('0321010001005029237',13,6) ;
//$query3 = "SELECT * FROM  public_abadi  where id_abadi = $id_abadi " ;
//$stmt3 = $dbh->prepare($query3);
//$stmt3->execute();
//$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
//$dbh = null;
//echo $row3['up_date'] .'<br>';
//echo $row3['id_abadi'] .'<br>';
//?>

 <?php
 
 $id_mar = '0307';
 echo $id_mar ; 
$query3 = "SELECT * FROM  users  where id_mar = '$id_mar' " ;
$stmt3 = $dbh->prepare($query3);
$stmt3->execute();
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
 foreach($stmt3 as $row3)
 {
echo $row3['Last_name'] .'<br>';
echo $row3['cod_m'] .'<br>';
}
$dbh = null;
 ?>
