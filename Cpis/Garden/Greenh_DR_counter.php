<?php
function kol_counter()
{
include_once('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhous where no_kesht = '1'   "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol_counter = $stmt -> fetchColumn();
return $kol_counter ; 	

}
?>

<?php
function ostan_counter($id_ostan)
{
include_once('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhous where no_kesht = '1'  and  id_ostan= '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$ostan_counter = $stmt -> fetchColumn();
return $ostan_counter ; 	

}
?>
<?php
function city_counter($id_ostan,$id_city)
{
include_once('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhous where no_kesht = '1'  and  id_ostan= '$id_ostan' and id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$city_counter = $stmt -> fetchColumn();
return $city_counter ; 	

}
?>
<?php
function kol_mz()
{
include_once('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhous where no_kesht = '1'  and  1  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_mz =  $row['zamin'] ; 
return $kol_mz ; 	

}
?>

<?php
function ostan_mz($id_ostan)
{
include_once('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhous where no_kesht = '1'  and  id_ostan= '$id_ostan'  "  ;
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
include_once('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhous where no_kesht = '1'  and  id_ostan= '$id_ostan' and id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_mz =  $row['zamin'] ; 
return $city_mz ; 	

}
?>

<?php
function kol_counter_noToday($today)
{
include_once('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhous where no_kesht = '1'  and  date_s !='$today'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol_counter_noToday = $stmt -> fetchColumn();
return $kol_counter_noToday ; 	

}
?>

<?php
function ostan_counter_noToday($id_ostan,$today)
{
include_once('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhous where no_kesht = '1'  and  id_ostan= '$id_ostan' and date_s !='$today'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$ostan_counter_noToday = $stmt -> fetchColumn();
return $ostan_counter_noToday ; 	

}
?>
<?php
function city_counter_noToday($id_ostan,$id_city,$today)
{
include_once('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhous where no_kesht = '1'  and  id_ostan= '$id_ostan' and id_city = '$id_city' and date_s !='$today' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$city_counter_noToday = $stmt -> fetchColumn();
return $city_counter_noToday ; 	

}
?>
<?php
function kol_mz_noToday($today)
{
include_once('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhous where no_kesht = '1'  and   date_s !='$today' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_mz_noToday =  $row['zamin'] ; 
return $kol_mz_noToday ; 	

}
?>

<?php
function ostan_mz_noToday($id_ostan,$today)
{
include_once('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhous where no_kesht = '1'  and  id_ostan= '$id_ostan' and date_s !='$today' "  ;
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
include_once('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhous where no_kesht = '1'  and  id_ostan= '$id_ostan' and id_city = '$id_city' and date_s !='$today' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_mz_noToday =  $row['zamin'] ; 
return $city_mz_noToday ; 	

}
?>
