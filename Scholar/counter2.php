<?php
include ('../lock_Sc.php') ;
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
}
?>
<?php
function mor_bah_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT id FROM  bah WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bah = $stmt -> rowCount();
return $count_bah ; 	
}
?>
<?php
function mor_Agri_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT id FROM  Agri WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri = $stmt -> rowCount();
return $count_Agri ; 	
}
?>
<?php
function mor_Garden_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT id FROM  Garden WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garden = $stmt -> rowCount();
return $count_Garden ; 	
}
?>
<?php
function mor_spoul_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT id FROM  spoul WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_spoul = $stmt -> rowCount();
return $count_spoul ; 	
}
?>
<?php
function mor_bee_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT id FROM  bee WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bee = $stmt -> rowCount();
return $count_bee ; 	
}
?>
