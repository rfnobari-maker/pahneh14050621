<?php
include ('../lock_p3.php') ;
?>
<?php
function mor_shahr_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  list_city WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt->fetchColumn();
return $count_shahr ; 
$dbh = null;	
}
?>
<?php
function mor_abadi_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  list_abadi WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt->fetchColumn();
return $count_abadi ; 	
$dbh = null;	
}
?>
<?php
function mor_bah_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  bah WHERE  mor_cod_m = '$mor_cod_m'  and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bah = $stmt->fetchColumn();
return $count_bah ; 	
$dbh = null;	
}
?>
<?php
function mor_Agri_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  Agri1397_1398 WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri97 = $stmt->fetchColumn();
$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1398_1399 WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri98 = $stmt->fetchColumn();
$query = "SELECT COUNT(DISTINCT Agri_id) FROM  Agri_prod1398_1399 WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
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

$query = "SELECT COUNT(DISTINCT Vege_id) FROM  Vege_prod WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Vege = $stmt->fetchColumn();

$count_Agri =  $count_Agri97 + $count_Agri98 + $count_Agri99 + $count_Agri00 + $count_Agri01 + $count_Agri02+ $count_Vege; 
return $count_Agri ; 	
$dbh = null;	
}
?>
<?php
function mor_Garden_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT COUNT(DISTINCT Garden_id) FROM  Garden_prod WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garden = $stmt->fetchColumn();
return $count_Garden ; 	
$dbh = null;	
}
?>
<?php
function mor_spoul_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  spoultry WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_spoul = $stmt->fetchColumn();
return $count_spoul ; 	
$dbh = null;	
}
?>
<?php
function mor_bee_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  bee WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bee = $stmt->fetchColumn();
return $count_bee ; 	
$dbh = null;	
}
?>
<?php
function mor_Greenhous_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  Greenhous WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_green = $stmt->fetchColumn();
return $count_green ; 	
$dbh = null;	
}
?>
<?php
function mor_Aquatic_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  Aquatic WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Aquatic = $stmt->fetchColumn();
return $count_Aquatic ; 	
$dbh = null;	
}
?>