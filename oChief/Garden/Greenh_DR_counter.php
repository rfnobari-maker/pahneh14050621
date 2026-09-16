<?php
function kol_counter()
{
include('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhousn where no_mtol !='211400'   "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol_counter = $stmt -> fetchColumn();
return $kol_counter ; 	
$dbh = null;
}
?>

<?php
function ostan_counter($id_ostan)
{
include('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhousn where no_mtol !='211400'  and  id_ostan= '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$ostan_counter = $stmt -> fetchColumn();
return $ostan_counter ; 	
$dbh = null;
}
?>
<?php
function city_counter($id_ostan,$id_city)
{
include('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhousn where no_mtol !='211400'  and  id_ostan= '$id_ostan' and id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$city_counter = $stmt -> fetchColumn();
return $city_counter ; 	
$dbh = null;
}
?>
<?php
function kol_mz()
{
include('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhousn where no_mtol !='211400'  and  1  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_mz =  $row['zamin'] ; 
return $kol_mz ; 	
$dbh = null;
}
?>

<?php
function ostan_mz($id_ostan)
{
include('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhousn where no_mtol !='211400'  and  id_ostan= '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan_mz =  $row['zamin'] ; 
return $ostan_mz ; 	
$dbh = null;
}
?>
<?php
function city_mz($id_ostan,$id_city)
{
include('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhousn where no_mtol !='211400'  and  id_ostan= '$id_ostan' and id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_mz =  $row['zamin'] ; 
return $city_mz ; 	
$dbh = null;
}
?>

<?php
function kol_counter_noToday($today)
{
include('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhousn where no_mtol !='211400'  and  date_s !='$today'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$kol_counter_noToday = $stmt -> fetchColumn();
return $kol_counter_noToday ; 	
$dbh = null;
}
?>

<?php
function ostan_counter_noToday($id_ostan,$today)
{
include('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhousn where no_mtol !='211400'  and  id_ostan= '$id_ostan' and date_s !='$today'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$ostan_counter_noToday = $stmt -> fetchColumn();
return $ostan_counter_noToday ; 	
$dbh = null;
}
?>
<?php
function city_counter_noToday($id_ostan,$id_city,$today)
{
include('../../login/config.php');
$query = "SELECT count(*)   FROM Greenhousn where no_mtol !='211400'  and  id_ostan= '$id_ostan' and id_city = '$id_city' and date_s !='$today' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$city_counter_noToday = $stmt -> fetchColumn();
return $city_counter_noToday ; 	
$dbh = null;
}
?>
<?php
function kol_mz_noToday($today)
{
include('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhousn where no_mtol !='211400'  and   date_s !='$today' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_mz_noToday =  $row['zamin'] ; 
return $kol_mz_noToday ; 	
$dbh = null;
}
?>

<?php
function ostan_mz_noToday($id_ostan,$today)
{
include('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhousn where no_mtol !='211400'  and  id_ostan= '$id_ostan' and date_s !='$today' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan_mz_noToday =  $row['zamin'] ; 
return $ostan_mz_noToday ; 	
$dbh = null;
}
?>
<?php
function city_mz_noToday($id_ostan,$id_city,$today)
{
include('../../login/config.php');
$query = "SELECT sum(m_zamin_gol) as zamin  FROM Greenhousn where no_mtol !='211400'  and  id_ostan= '$id_ostan' and id_city = '$id_city' and date_s !='$today' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_mz_noToday =  $row['zamin'] ; 
return $city_mz_noToday ; 	
$dbh = null;
}
?>
