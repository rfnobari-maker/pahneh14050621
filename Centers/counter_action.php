<?php
include ('../lock_p2.php') ;
?>
<?php
function mor_shahr_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT * FROM  list_city WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt -> rowCount();
return $count_shahr ; 	
$dbh = null;
}
?>
<?php
function mor_abadi_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT * FROM  list_abadi WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt -> rowCount();
return $count_abadi ; 	
$dbh = null;
}
?>
<?php
function mor_bah_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT id FROM  bah WHERE  mor_cod_m = '$mor_cod_m'  and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bah = $stmt -> rowCount();
return $count_bah ; 	
$dbh = null;
}
?>
<?php
function mor_Agri_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT id FROM  Agri WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri = $stmt -> rowCount();
return $count_Agri ; 	
$dbh = null;
}
?>
<?php
function mor_Garden_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT id FROM  Garden WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garden = $stmt -> rowCount();
return $count_Garden ; 	
$dbh = null;
}
?>
<?php
function mor_spoul_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT id FROM  spoultry WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_spoul = $stmt -> rowCount();
return $count_spoul ; 	
$dbh = null;
}
?>
<?php
function mor_bee_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT id FROM  bee WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bee = $stmt -> rowCount();
return $count_bee ; 	
$dbh = null;
}
?>