<?php
function ostan_counter($id_ostan)
{
include('../login/config.php');
$query = "SELECT count(distinct bah_cod_m ,add_abadi,add_city)   FROM Greenhousn where id_ostan= '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$ostan_counter = $stmt -> fetchColumn();
return $ostan_counter ; 	

}
?>
<?php
function city_counter($id_ostan,$id_city)
{
include('../login/config.php');
$query = "SELECT count(distinct bah_cod_m ,add_abadi,add_city)   FROM Greenhousn where id_ostan= '$id_ostan' and id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$city_counter = $stmt -> fetchColumn();
return $city_counter ; 	

}
?>
<?php
function ostan_mz($id_ostan)
{
include('../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhousn where id_ostan= '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan_mz =  $row['zamin'] ; 
return $ostan_mz ; 	

}
?>
<?php
function city_mz($id_ostan,$id_city)
{
include('../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhousn where id_ostan= '$id_ostan' and id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_mz =  $row['zamin'] ; 
return $city_mz ; 	

}
?>

<?php
function ostan_counter_noToday($id_ostan,$today)
{
include('../login/config.php');
$query = "SELECT count(distinct bah_cod_m ,add_abadi,add_city)   FROM Greenhousn where id_ostan= '$id_ostan' and date_s !='$today'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$ostan_counter_noToday = $stmt -> fetchColumn();
return $ostan_counter_noToday ; 	

}
?>
<?php
function city_counter_noToday($id_ostan,$id_city,$today)
{
include('../login/config.php');
$query = "SELECT count(distinct bah_cod_m ,add_abadi,add_city)   FROM Greenhousn where id_ostan= '$id_ostan' and id_city = '$id_city' and date_s !='$today' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$city_counter_noToday = $stmt -> fetchColumn();
return $city_counter_noToday ; 	

}
?>
<?php
function ostan_mz_noToday($id_ostan,$today)
{
include('../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhousn where id_ostan= '$id_ostan' and date_s !='$today' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan_mz_noToday =  $row['zamin'] ; 
return $ostan_mz_noToday ; 	

}
?>
<?php
function city_mz_noToday($id_ostan,$id_city,$today)
{
include('../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhousn where id_ostan= '$id_ostan' and id_city = '$id_city' and date_s !='$today' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_mz_noToday =  $row['zamin'] ; 
return $city_mz_noToday ; 	

}
?>
