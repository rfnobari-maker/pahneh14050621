<?php
include ('../lock_ad.php') ;
include('../login/config.php');
$query = "SELECT pic,fname FROM users WHERE username='".$_SESSION['login_user']."'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row['pic']=='' or $row['fname']=='')
{
 header("Location: profile.php?a");
}
$query = "SELECT count(*) FROM  users WHERE  city = '$city' and S_access='2' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_m = $stmt->fetchColumn();

//$query = "SELECT count(id) FROM  bah  " ;
//$stmt = $dbh->prepare($query);
//$stmt->execute();
//$count_bah = $stmt->fetchColumn();
$count_bah = 5869147; 
$query = "SELECT count(*) FROM  list_abadi WHERE  id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt->fetchColumn();


$query = "SELECT count(*) FROM  users WHERE  S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_kol = $stmt->fetchColumn();

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
}
?>
<?php function mar_request_count($id_mar,$status)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  change_mor WHERE id_mar = '$id_mar'  and status = '$status'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_request = $stmt->fetchColumn();
return $count_mar_request ; 
}
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
}
?>