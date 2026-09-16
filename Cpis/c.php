<?php
include ('../lock_cp.php') ;
include_once('../login/config.php');
$query = "SELECT id_mar  FROM  markers " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$mar_map = $stmt -> rowCount();
$query = "SELECT username FROM  users WHERE  id_city = '$id_city' and S_access='2' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_m = $stmt -> rowCount();
//$query = "SELECT * from list_abadi where mor_cod_m'".$user_check."'";
$query = "SELECT city FROM  list_abadi WHERE  id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> rowCount();
///
$query = "SELECT id FROM  users WHERE  S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_kol = $stmt -> rowCount();
////
?>
<?php
function mor_abadi_count($mor_cod_m)
{
include_once('../login/config.php');
$query = "SELECT id FROM  list_abadi WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt -> rowCount();
return $count_abadi ; 	
}
?>
<?php
function mar_abadi_count($id_mar)
{
include_once('../login/config.php');
$query = "SELECT id FROM  list_abadi where id_mar = '$id_mar'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_abadi = $stmt -> rowCount();
return $count_mar_abadi ; 	
}
?>
<?php function mar_mor_count($id_mar)
{
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_mar = '$id_mar'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt -> rowCount();
return $count_mar_mor ; 
}
?>
<?php function city_mor_count($id_city)
{
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_city = '$id_city'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt -> rowCount();
return $count_mar_mor ; 
}
?>
<?php function mar_mor_jens_count($id_mar,$n_jens)
{
include_once('../login/config.php');
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT * FROM  users WHERE  id_mar = '$id_mar' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
//return $jens ; 
}
//echo mar_mor_jens_count('0307',1)
?>
<?php function city_mor_jens_count($id_city,$n_jens)
{
include_once('../login/config.php');
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT * FROM  users WHERE  id_city = '$id_city' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
//return $jens ; 
}
//echo mar_mor_jens_count('0307',1)
?>
<?php function mar_mor_mtah_count($id_mar,$m_tah)
{
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_mar = '$id_mar' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
}
?>
<?php function city_mor_mtah_count($id_city,$m_tah)
{
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE id_city = '$id_city' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_jens_mor = $stmt -> rowCount();
return $count_city_jens_mor ; 
}
?>
<?php function mar_request_count($id_mar,$status)
{
include_once('../login/config.php');
$query = "SELECT id FROM  change_mor WHERE id_mar = '$id_mar'  and status = '$status'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_request = $stmt -> rowCount();
return $count_mar_request ; 
}
?>
<?php
function city_abadi_count($id_city)
{
include_once('../login/config.php');
$query = "SELECT id FROM  list_abadi where id_city = '$id_city'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_abadi = $stmt -> rowCount();
return $count_city_abadi ; 	
}
?>
<?php
function city_shahr_count($id_city)
{
include_once('../login/config.php');
$query = "SELECT id FROM  list_city where id_city = '$id_city'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_shahr = $stmt -> rowCount();
return $count_city_shahr ; 	
}
?>
<?php
function city_mar_count($id_city)
{
include_once('../login/config.php');
$query = "SELECT  DISTINCT id_mar FROM list_abadi WHERE  id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_mar = $stmt -> rowCount();
return $count_city_mar ; 	
}
?>
<?php
function city_count($id_ostan)
{
include_once('../login/config.php');
$query = "SELECT  DISTINCT id_city FROM list_abadi WHERE  id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city = $stmt -> rowCount();
return $count_city ; 	
}
?>
<?php
function shahr_count($id_ostan)
{
include_once('../login/config.php');
$query = "SELECT  DISTINCT add_city FROM list_city WHERE  id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt -> rowCount();
return $count_shahr ; 	
}
?>
<?php
function ostan_abadi_count($id_ostan)
{
include_once('../login/config.php');
$query = "SELECT id FROM  list_abadi where id_ostan = '$id_ostan'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_abadi = $stmt -> rowCount();
return $count_ostan_abadi ; 	
}
?>
<?php function ostan_mor_jens_count($id_ostan,$n_jens)
{
include_once('../login/config.php');
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_jens_mor = $stmt -> rowCount();
return $count_ostan_jens_mor ; 
}
?>
<?php function ostan_mor_mtah_count($id_ostan,$m_tah)
{
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_jens_mor = $stmt -> rowCount();
return $count_ostan_jens_mor ; 
}
?>
<?php function ostan_mor_count($id_ostan)
{
include_once('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_mor = $stmt -> rowCount();
return $count_ostan_mor ; 
}
?>
<?php function city_request_count($city)
{
include_once('../login/config.php');
$query = "SELECT id FROM  change_mor WHERE city = '$city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_request = $stmt -> rowCount();
return $count_city_request ; 
}
?>
<?php function abadi_update_per($id_city)
{
include_once('../login/config.php');
$query = "select public_abadi.add_abadi , public_abadi.up_date,public_abadi.id_city ,list_abadi.add_abadi  FROM list_abadi
LEFT JOIN public_abadi ON public_abadi.add_abadi = list_abadi.add_abadi
WHERE public_abadi.id_city = '$id_city'  and public_abadi.up_date <> '' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 $count_update = $stmt -> rowCount();
 $count_kol = city_abadi_count($id_city) ;
$per_update = round((($count_update*100)/$count_kol),1) ;
return $per_update ; 
}
echo abadi_update_per('20') ;
?>
