<?php
include('../login/config.php');
function mor_shahr_count($mor_cod_m)
{
 global $dbh;

$query = "SELECT count(*) FROM  list_city WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt->fetchColumn();
return $count_shahr ; 	

}
?>
<?php
function mor_abadi_count($mor_cod_m)
{
 global $dbh;

 $query = "SELECT count(*) FROM  list_abadi WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt->fetchColumn();
return $count_abadi ; 	

}
?>
<?php
function mor_bah_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
 global $dbh;

$query = "SELECT count(*) FROM  bah WHERE  mor_cod_m = '$mor_cod_m'  and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bah = $stmt->fetchColumn();
return $count_bah ; 	

}
?>
<?php
function mor_Agri_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
 global $dbh;

$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1397_1398 WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri97 = $stmt->fetchColumn();
$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1398_1399 WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri98 = $stmt->fetchColumn();
$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1399_1400 WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri99 = $stmt->fetchColumn();
$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1400_1401 WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri00 = $stmt->fetchColumn();
$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1401_1402 WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri01 = $stmt->fetchColumn();
$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1402_1403 WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri02 = $stmt->fetchColumn();

$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1403_1404 WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri03 = $stmt->fetchColumn();


$query = "SELECT COUNT(DISTINCT Vege_id) FROM  Vege_prod WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Vege = $stmt->fetchColumn();

$count_Agri =  $count_Agri97 + $count_Agri98 + $count_Agri99 + $count_Agri00 + $count_Agri01 + $count_Agri02 + $count_Agri03+ $count_Vege; 
return $count_Agri ; 	

}
?>
<?php
function mor_Garden_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
 global $dbh;

$query = "SELECT COUNT(DISTINCT Garden_id) FROM  Garden_prod WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garden = $stmt->fetchColumn();
return $count_Garden ; 	

}
?>
<?php
function mor_spoul_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
 global $dbh;

$query = "SELECT count(*) FROM  spoultry WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_spoul = $stmt->fetchColumn();
return $count_spoul ; 	

}
?>
<?php
function mor_bee_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
 global $dbh;

$query = "SELECT count(*) FROM  bee WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bee = $stmt->fetchColumn();
return $count_bee ; 	

}
?>
<?php
function mor_Greenhous_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
 global $dbh;

$query = "SELECT count(*) FROM  Greenhous_prod WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_green = $stmt->fetchColumn();
return $count_green ; 	

}
?>
<?php
function mor_Aquatic_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
 global $dbh;

$query = "SELECT count(*) FROM  Aquatic WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Aquatic = $stmt->fetchColumn();
return $count_Aquatic ; 	

}
?>

<?php
function ostan_bah_count($id_ostan,$v_date_s1,$v_date_s2)
{
 global $dbh;

 $query = "SELECT count(*) FROM bah WHERE  id_ostan = '$id_ostan' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count_bah = $stmt->fetchColumn();
return $count_bah ; 	

}
?>
<?php
function ostan_Agri_count($id_ostan,$v_date_s1,$v_date_s2)
{
 global $dbh;

$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1397_1398 WHERE   id_ostan = '$id_ostan' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri97 = $stmt->fetchColumn();

$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1398_1399 WHERE   id_ostan = '$id_ostan' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri98 = $stmt->fetchColumn();

$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1399_1400 WHERE   id_ostan = '$id_ostan' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri99 = $stmt->fetchColumn();

$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1400_1401 WHERE   id_ostan = '$id_ostan' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri01 = $stmt->fetchColumn();

$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1401_1402 WHERE   id_ostan = '$id_ostan' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri02 = $stmt->fetchColumn();

$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1402_1403 WHERE   id_ostan = '$id_ostan' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri03 = $stmt->fetchColumn();

$count_Agri =  $count_Agri98 + $count_Agri99 + $count_Agri01 + $count_Agri02 + $count_Agri03 ; 
return $count_Agri ; 	

}
?>
<?php
function ostan_Garden_count($id_ostan,$v_date_s1,$v_date_s2)
{
 global $dbh;

 $query = "SELECT COUNT(DISTINCT Garden_id) FROM  Garden_prod WHERE  id_ostan = '$id_ostan' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count_bah = $stmt->fetchColumn();
return $count_bah ; 	

}
?>
<?php
function ostan_Greenhous_count($id_ostan,$v_date_s1,$v_date_s2)
{
 global $dbh;

 $query = "SELECT count(*) FROM Greenhous WHERE  id_ostan = '$id_ostan' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count_bah = $stmt->fetchColumn();
return $count_bah ; 	

}
?>
<?php
function ostan_Aquatic_count($id_ostan,$v_date_s1,$v_date_s2)
{
 global $dbh;

 $query = "SELECT count(*) FROM Aquatic WHERE  id_ostan = '$id_ostan' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt -> execute();
$count_bah = $stmt->fetchColumn();
return $count_bah ; 	

}
?>
