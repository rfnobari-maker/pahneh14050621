<?php function kol_bah_count($id_ostan)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  bah WHERE id_ostan = '$id_ostan' " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
$dbh = null;
}
?>
<?php function city_bah_count($id_ostan,$id_city)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  bah WHERE id_ostan = '$id_ostan' and id_city = '$id_city' " ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
$dbh = null;
}
?>
<?php
function city_Agri_count($id_ostan,$id_city,$sal)
{
$sal1 = $sal-1 ;
$z_sal = $sal1.'_'.$sal ;
$Agri_table = 'Agri'.$z_sal ; 
include('../login/config.php');
$query = "SELECT count(*) FROM $Agri_table where id_ostan= '$id_ostan' and id_city = '$id_city'  "  ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
$dbh = null;
}
?>
<?php
function ostan_Agri_count($id_ostan,$sal)
{
$sal1 = $sal-1 ;
$z_sal = $sal1.'_'.$sal ;
$Agri_table = 'Agri'.$z_sal ; 
include('../login/config.php');
$query = "SELECT count(*) FROM $Agri_table where id_ostan= '$id_ostan' "  ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
$dbh = null;
}
?>
<?php
function city_Garden_count($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT count(*) FROM Garden where id_ostan= '$id_ostan' and id_city = '$id_city' and z_sal = '$sal' "  ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
$dbh = null;
}
?>

<?php
function ostan_Garden_count($id_ostan,$sal)
{
include('../login/config.php');
$query = "SELECT count(*) FROM Garden where id_ostan= '$id_ostan' and z_sal = '$sal' "  ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
$dbh = null;
}
?>
<?php
function city_Greenhous_count($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT count(*) FROM Greenhous where id_ostan= '$id_ostan' and id_city = '$id_city' and sal = '$sal' "  ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
$dbh = null;
}
?>
<?php
function ostan_Greenhous_count($id_ostan,$sal)
{
include('../login/config.php');
$query = "SELECT count(*) FROM Greenhous where id_ostan= '$id_ostan' and sal = '$sal' "  ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
$dbh = null;
}
?>
<?php
function city_Aquatic_count($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT count(*) FROM Aquatic where id_ostan= '$id_ostan' and id_city = '$id_city' and sal = '$sal' "  ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
$dbh = null;
}
?>
<?php
function ostan_Aquatic_count($id_ostan,$sal)
{
include('../login/config.php');
$query = "SELECT count(*) FROM Aquatic where id_ostan= '$id_ostan' and sal = '$sal' "  ;
$result = $dbh->prepare($query); 
$result->execute(); 
$number_of_rows = $result->fetchColumn(); 
return $number_of_rows ; 
$dbh = null;
}
?>
