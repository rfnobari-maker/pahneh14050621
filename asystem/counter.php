<?php
include ('../lock_admin.php') ;
include('../login/config.php');
$query = "SELECT count(*) FROM  users WHERE  city = '$city' and S_access='2' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_m = $stmt -> fetchColumn();

$query = "SELECT count(id) FROM  bah  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bah = $stmt -> fetchColumn();

//$query = "SELECT * from list_abadi where mor_cod_m'".$user_check."'";
$query = "SELECT count(*) FROM  list_abadi WHERE  id_city = '$id_city' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count = $stmt -> fetchColumn();
///
$query = "SELECT count(*) FROM  users WHERE  id_mar = '$id_mar'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mor = $stmt -> fetchColumn();

$query = "SELECT count(*) FROM  users WHERE  S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_kol = $stmt -> fetchColumn();


?>
<?php
function mor_abadi_count($mor_cod_m)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  list_abadi WHERE  mor_cod_m = '$mor_cod_m' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_abadi = $stmt -> fetchColumn();
return $count_abadi ; 	
$dbh = null;
}
?>
<?php function mar_request_count($id_mar,$status)
{
include('../login/config.php');
$query = "SELECT count(*) FROM  change_mor WHERE id_mar = '$id_mar'  and status = '$status'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_request = $stmt -> fetchColumn();
return $count_mar_request ; 
$dbh = null;
}
?>