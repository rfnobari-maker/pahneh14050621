<?php
include ('../lock_Sc.php') ;
include('../login/config.php');
$query = "SELECT pic,fname FROM users WHERE username='".$_SESSION['login_user']."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row['pic']=='' or $row['fname']=='')
{
 header("Location: profile.php?a");
}
// پیام جدید 
$query = "SELECT ru_read FROM pm WHERE r_user = '$login_session' and  ru_read = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_pm = $stmt -> rowCount();
if ($count_pm > 0) {
header("Location:rec_msg_notseen.php?unread");
}
//
$query = "SELECT id_mar  FROM  mar where id_ostan = '$id_ostan' and  id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$mar_map = $stmt -> rowCount();
include('../login/config.php');
$query = "SELECT id FROM  mar WHERE id_ostan = '$id_ostan' and id_city = '$id_city'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_m = $stmt -> rowCount();
//$query = "SELECT * from list_abadi where mor_cod_m'".$user_check."'";
$query = "SELECT city FROM  list_abadi WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> rowCount();
///

$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and  S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_kol = $stmt -> rowCount();
?>
<?php
function mor_abadi_count($mor_cod_m)
{
include('../login/config.php');
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
include ('../lock_p3.php') ;
include('../login/config.php');
$query = "SELECT id FROM  list_abadi where id_ostan = '$id_ostan' and id_mar = '$id_mar' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_abadi = $stmt -> rowCount();
return $count_mar_abadi ; 	
}
?>
<?php function mar_mor_count($id_mar,$id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and id_mar = '$id_mar'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt -> rowCount();
return $count_mar_mor ; 
}
?>
<?php function city_mor_count($id_city,$id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and  id_city = '$id_city'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt -> rowCount();
return $count_mar_mor ; 
}
?>
<?php function mar_mor_jens_count($id_mar,$n_jens,$id_ostan)
{
include('../login/config.php');
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and id_mar = '$id_mar'  and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
//return $jens ; 
}
//echo mar_mor_jens_count('0307',1)
?>
<?php function city_mor_jens_count($id_city,$n_jens,$id_ostan)
{
include('../login/config.php');
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
//return $jens ; 
}
//echo mar_mor_jens_count('0307',1)
?>
<?php function mar_mor_mtah_count($id_mar,$m_tah,$id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and  id_mar = '$id_mar'  and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
}
?>
<?php function city_mor_mtah_count($id_city,$m_tah,$id_ostan)
{
include('../login/config.php');
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan' and  id_city = '$id_city' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_jens_mor = $stmt -> rowCount();
return $count_city_jens_mor ; 
}
?>
<?php function mar_request_count($id_mar,$status)
{
include('../login/config.php');
$query = "SELECT id FROM  change_mor WHERE  id_mar = '$id_mar'   and status = '$status'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_request = $stmt -> rowCount();
return $count_mar_request ; 
}
?>
<?php
function city_shahr_count($id_city,$id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  list_city where id_ostan = '$id_ostan' and  id_city = '$id_city'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_shahr = $stmt -> rowCount();
return $count_city_shahr ; 	
}
?>
<?php
function mor_shahr_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT id FROM  list_city WHERE  id_ostan = '$id_ostan' and  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt -> rowCount();
return $count_shahr ; 	
}
?>

<?php
function mor_bah_count($id_ostan,$mor_cod_m)
{
include('../login/config.php');
$query = "SELECT id FROM  bah WHERE  id_ostan = '$id_ostan' and  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bah = $stmt -> rowCount();
return $count_bah ; 	
}
?>
<?php
function abadi_bah_count($add_abadi)
{
include('../login/config.php');
$query = "SELECT id FROM  bah WHERE  add_abadi = '$add_abadi' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi_bah = $stmt -> rowCount();
return $count_abadi_bah ; 	
}
?>

<?php
function shahr_bah_count($add_city,$id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  bah WHERE   id_ostan = '$id_ostan' and  add_city = '$add_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bah = $stmt -> rowCount();
return $count_city_bah ; 	
}
?>
<?php function city_bah_count($id_ostan,$id_city)
{
include('../login/config.php');
$query="SELECT id FROM  bah WHERE id_ostan = '$id_ostan' and id_city = '$id_city'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bah = $stmt -> rowCount();
return $count_city_bah ; 
}
?>