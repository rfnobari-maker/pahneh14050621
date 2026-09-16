<?php
include ('../lock_oce.php') ;
include('../login/config.php');
$query = "SELECT pic,fname FROM users WHERE username='".$_SESSION['login_user']."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row['pic']=='' or $row['fname']=='')
{
 header("Location: profile.php");
}
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
// clos conntection 
$dbh = null;
}
?>
<?php
function mar_abadi_count($id_mar)
{
include('../login/config.php');
$query = "SELECT id FROM  list_abadi where id_mar = '$id_mar'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_abadi = $stmt -> rowCount();
return $count_mar_abadi ; 	
// clos conntection 
$dbh = null;
}
?>
<?php function mar_mor_count($id_mar)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_mar = '$id_mar'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt -> rowCount();
return $count_mar_mor ; 
// clos conntection 
$dbh = null;
}
?>
<?php function city_mor_count($id_city)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_city = '$id_city'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt -> rowCount();
return $count_mar_mor ; 
// clos conntection 
$dbh = null;
}
?>
<?php function mar_mor_jens_count($id_mar,$n_jens)
{
include('../login/config.php');
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT id FROM  users WHERE  id_mar = '$id_mar' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
//return $jens ; 
// clos conntection 
$dbh = null;
}
//echo mar_mor_jens_count('0307',1)
?>
<?php function city_mor_jens_count($id_city,$n_jens)
{
include('../login/config.php');
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT id FROM  users WHERE  id_city = '$id_city' and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
//return $jens ; 
// clos conntection 
$dbh = null;
}
//echo mar_mor_jens_count('0307',1)
?>
<?php function mar_mor_mtah_count($id_mar,$m_tah)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_mar = '$id_mar' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_jens_mor = $stmt -> rowCount();
return $count_mar_jens_mor ; 
// clos conntection 
$dbh = null;
}
?>
<?php function city_mor_mtah_count($id_city,$m_tah)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE id_city = '$id_city' and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_jens_mor = $stmt -> rowCount();
return $count_city_jens_mor ; 
// clos conntection 
$dbh = null;
}
?>
<?php function mar_request_count($id_mar,$status)
{
include('../login/config.php');
$query = "SELECT id FROM  change_mor WHERE id_mar = '$id_mar'  and status = '$status'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_request = $stmt -> rowCount();
return $count_mar_request ; 
// clos conntection 
$dbh = null;
}
?>
<?php
function city_abadi_count($id_city)
{
include('../login/config.php');
$query = "SELECT id FROM  list_abadi where id_city = '$id_city'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_abadi = $stmt -> rowCount();
return $count_city_abadi ; 	
// clos conntection 
$dbh = null;
}
?>
<?php
function city_shahr_count($id_city)
{
include('../login/config.php');
$query = "SELECT id FROM  list_city where id_city = '$id_city'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_shahr = $stmt -> rowCount();
return $count_city_shahr ; 	
// clos conntection 
$dbh = null;
}
?>
<?php
function city_mar_count($id_city)
{
include('../login/config.php');
$query = "SELECT  DISTINCT id_mar FROM list_abadi WHERE  id_city = '$id_city' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_mar = $stmt -> rowCount();
return $count_city_mar ; 	
// clos conntection 
$dbh = null;
}
?>
<?php
function city_count($id_ostan)
{
include('../login/config.php');
$query = "SELECT  DISTINCT id_city FROM list_abadi WHERE  id_ostan = '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city = $stmt -> rowCount();
return $count_city ; 	
// clos conntection 
$dbh = null;
}
?>
<?php
function shahr_count($id_ostan)
{
include('../login/config.php');
$query = "SELECT  DISTINCT add_city FROM list_city WHERE  id_ostan = '$id_ostan'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt -> rowCount();
return $count_shahr ; 	
// clos conntection 
$dbh = null;
}
?>
<?php
function ostan_abadi_count($id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  list_abadi where id_ostan = '$id_ostan' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_abadi = $stmt -> rowCount();
return $count_ostan_abadi ; 	
// clos conntection 
$dbh = null;
}
?>
<?php function ostan_mor_jens_count($id_ostan,$n_jens)
{
include('../login/config.php');
if ($n_jens == 1) $jens ='مرد' ;
if ($n_jens == 2) $jens ='زن' ;
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan'  and jens = '$jens' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_jens_mor = $stmt -> rowCount();
return $count_ostan_jens_mor ; 
// clos conntection 
$dbh = null;
}
?>
<?php function ostan_mor_mtah_count($id_ostan,$m_tah)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan'  and m_tah = '$m_tah' and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_jens_mor = $stmt -> rowCount();
return $count_ostan_jens_mor ; 
// clos conntection 
$dbh = null;
}
?>
<?php function ostan_mor_count($id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan'   and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_mor = $stmt -> rowCount();
return $count_ostan_mor ; 
// clos conntection 
$dbh = null;
}
?>
<?php function ostan_expar_count($id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan'   and S_access = '5'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_expar = $stmt -> rowCount();
return $count_ostan_expar ; 
// clos conntection 
$dbh = null;
}
?>
<?php function ostan_chief_count($id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan'   and S_access = '4' and username <>'9141120034'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_chief = $stmt -> rowCount();
return $count_chief ; 
// clos conntection 
$dbh = null;
}
?>


<?php function ostan_expar_sh_count($id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan'   and S_access = '6'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_expar_sh = $stmt -> rowCount();
return $count_ostan_expar_sh ; 
// clos conntection 
$dbh = null;
}
?>
<?php function ostan_scholar_count($id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  users WHERE  id_ostan = '$id_ostan'   and S_access = '7'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_scholar = $stmt -> rowCount();
return $count_scholar ; 
// clos conntection 
$dbh = null;
}
?>


<?php function city_request_count($city)
{
include('../login/config.php');
$query = "SELECT id FROM  change_mor WHERE city = '$city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_request = $stmt -> rowCount();
return $count_city_request ; 
// clos conntection 
$dbh = null;
}
?>
<?php function city_bah_count($id_city)
{
include('../login/config.php');
$query = "SELECT id FROM  bah WHERE id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bah = $stmt -> rowCount();
return $count_city_bah ; 
// clos conntection 
$dbh = null;
}
?>
<?php function city_bee_count($id_city,$id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  bee WHERE   id_city = '$id_city' and sal = '1395'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bee = $stmt -> rowCount();
return $count_city_bee ; 
// clos conntection 
$dbh = null;
}
?>
<?php function abadi_update_per($id_city)
{
include('../login/config.php');
$query = "select public_abadi.add_abadi , public_abadi.up_date,public_abadi.id_city ,list_abadi.add_abadi  FROM list_abadi
LEFT JOIN public_abadi ON public_abadi.add_abadi = list_abadi.add_abadi
WHERE public_abadi.id_city = '$id_city'  and public_abadi.up_date <> '' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 $count_update = $stmt -> rowCount();
 $count_kol = city_abadi_count($id_city) ;
$per_update = round((($count_update*100)/$count_kol),1) ;
return $per_update ; 
// clos conntection 
$dbh = null;
}
?>



<?php function city_status($id_city)
{
include('../login/config.php');
$query = "SELECT con_center  FROM  users  WHERE  id_city = '$id_city'  and S_access = '1' and con_city='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> rowCount();
if ($count_finish_mor ==  city_mor_count($id_city)) $result = 1 ; else $result = 2;   
return $result ; 
// clos conntection 
$dbh = null;
}
?>
<?php
function mor_shahr_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT id FROM  list_city WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_shahr = $stmt -> rowCount();
return $count_shahr ; 	
// clos conntection 
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
// clos conntection 
$dbh = null;
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
// clos conntection 
$dbh = null;
}
?>
<?php
function shahr_bah_count($add_city)
{
include('../login/config.php');
$query = "SELECT id FROM  bah WHERE  add_city = '$add_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bah = $stmt -> rowCount();
return $count_city_bah ; 	
// clos conntection 
$dbh = null;
}
?>
<?php
function totl_mar_count()
{
include('../login/config.php');
$query = "SELECT id FROM mar  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$totl_count_mar = $stmt -> rowCount();
return $totl_count_mar ; 	
// clos conntection 
$dbh = null;
}
?>
<?php
function hamyar_count($id_city)
{
include('../login/config.php');
$query = "SELECT id FROM public_abadi where id_city = '$id_city' and hamyar = '1'  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$totl_count_hamyar = $stmt -> rowCount();
return $totl_count_hamyar ; 	
// clos conntection 
$dbh = null;
}
?>

<?php function spoultry_count($id_city)
{
include('../login/config.php');
$query = "SELECT id FROM  spoultry WHERE  id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_spoultry = $stmt -> rowCount();
return $count_spoultry ; 
// clos conntection 
$dbh = null;
}
?>
<?php function Agri_count($id_city)
{
include('../login/config.php');
$query = "SELECT id FROM  Agri WHERE  id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri = $stmt -> rowCount();
return $count_Agri ; 
// clos conntection 
$dbh = null;
}
?>

<?php function Garden_count($id_city)
{
include('../login/config.php');
$query = "SELECT id FROM  Garden WHERE  id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garden = $stmt -> rowCount();
return $count_Garden ; 
// clos conntection 
$dbh = null;
}
?>
<?php
function no_Agri_gat($id_city,$no_kesh)
{
include('../login/config.php');
$query = "SELECT id FROM  Agri WHERE  id_city = '$id_city' and no_kesh = $no_kesh " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_gat = $stmt -> rowCount();
return $count_gat ; 
// clos conntection 
$dbh = null;
}
?>
<?php
function sum_zer_kesht_a($id_city,$no_kesh)
{
include('../login/config.php');
$query = "SELECT SUM(zer_kesht_a) AS sum_kesht_a FROM Agri_prod WHERE  id_city = '$id_city' and no_kesh = $no_kesh" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht_a = $row['sum_kesht_a'];
return $sum_zerkesht_a ; 
// clos conntection 
$dbh = null;
}
?>
<?php
function sum_s_bar_a($id_city,$no_kesh)
{
include('../login/config.php');
$query = "SELECT SUM(s_bar_a) AS sum_s_bar_a FROM Agri_prod WHERE  id_city = '$id_city' and no_kesh = $no_kesh" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar_a = $row['sum_s_bar_a'];
return $sum_sbar_a ; 
// clos conntection 
$dbh = null;
}
?>
<?php
function sum_s_ayesh($id_city,$no_kesh)
{
include('../login/config.php');
$query = "SELECT SUM(s_ayesh) AS sum_s_ayesh FROM Agri WHERE  id_city = '$id_city' and no_kesh = $no_kesh" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sayesh = $row['sum_s_ayesh'];
return $sum_sayesh ; 
// clos conntection 
$dbh = null;
}
?>
<?php
function sum_mah_tol($id_city,$no_kesh)
{
include('../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_mah_tol FROM Agri_prod WHERE id_city = '$id_city' and no_kesh = $no_kesh" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mahtol = $row['sum_mah_tol'];
return $sum_mahtol; 
// clos conntection 
$dbh = null;
}
?>
<?php
function markaz_namer($id_mar)
{
include('../login/config.php');
$query = "SELECT mar FROM mar WHERE id_mar = '$id_mar'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mar_name = $row['mar'];
return $mar_name; 
// clos conntection 
$dbh = null;
}
?>
<?php
function mor_Agri_count($mor_cod_m,$v_date_s1,$v_date_s2)
{
include('../login/config.php');
$query = "SELECT id FROM  Agri WHERE  mor_cod_m = '$mor_cod_m' and $v_date_s1 and $v_date_s2 " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri = $stmt -> rowCount();
return $count_Agri ; 	
// clos conntection 
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
// clos conntection 
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
// clos conntection 
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
// clos conntection 
$dbh = null;
}
?>
<?php 
function mor_hamyar_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT list_abadi.mor_cod_m,public_abadi.hamyar
FROM list_abadi
INNER JOIN public_abadi ON list_abadi.add_abadi = public_abadi.add_abadi
WHERE list_abadi.mor_cod_m = '$mor_cod_m' and public_abadi.hamyar='1'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$mor_hamyar = $stmt -> rowCount();
return $mor_hamyar ;
// clos conntection 
$dbh = null;
}