<?php
include('config.php');

// کل
$query = "SELECT cod_p FROM dar_ani
	  union All 
	  SELECT cod_p FROM dar_fish
	  union All 
	  SELECT cod_p FROM dar_vil
	  union All 
	  SELECT cod_p FROM dar_pol  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$total = $stmt -> rowCount();
// تصویب
$query = "SELECT cod_p FROM dar_ani
    where  (status='6' or status='7')
	  union All 
	  SELECT cod_p FROM dar_fish
    where  (status='6' or status='7')
	  union All 
	  SELECT cod_p FROM dar_vil
    where  (status='6' or status='7')
	  union All 
	  SELECT cod_p FROM dar_pol
    where  (status='6' or status='7') ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$ok = $stmt -> rowCount();
//
$dbh = null;
//
//echo 'تصویب'.$ok.'<br>' ; 
//echo $total ; 
 ?>