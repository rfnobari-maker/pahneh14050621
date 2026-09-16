<?php function mar_bee_count($id_mar)
{
include('../../login/config.php');
$query = "SELECT id FROM  bee WHERE id_mar = '$id_mar'  and sal = '1403' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_bee = $stmt -> rowCount();
return $count_mar_bee ; 
}
?>
<?php function mar_kol_kbo($id_mar)
{
include('../../login/config.php');
$query = "SELECT SUM(tk_bo) AS kol_k_bo from bee WHERE id_mar = '$id_mar'  and sal = '1403' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_k_bo = $row['kol_k_bo'];
return $kol_k_bo ; 
}
?>
<?php function mar_kol_kmo($id_mar)
{
include('../../login/config.php');
$query = "SELECT SUM(tk_mo) AS kol_k_mo from bee WHERE id_mar = '$id_mar'  and sal = '1403' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_k_mo = $row['kol_k_mo'];
return $kol_k_mo ; 
}
?>
<?php function mar_mor_count($id_mar)
{
include('../../login/config.php');
$query = "SELECT * FROM  users WHERE  id_mar = '$id_mar'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt -> rowCount();
return $count_mar_mor ; 
}
?>
<?php function mar_status($id_mar)
{
include('../../login/config.php');
$query = "SELECT con_center  FROM  users  WHERE  id_mar = '$id_mar'  and S_access = '1' and con_center='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> rowCount();
if ($count_finish_mor == mar_mor_count($id_mar)) $result = 1 ; else $result = 2;   
return $result ; 
}
?>
<?php function mar_status2($id_mar)
{
include('../../login/config.php');
$query = "SELECT con_city  FROM  users  WHERE  id_mar = '$id_mar'  and S_access = '1' and con_city='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> rowCount();
if ($count_finish_mor == mar_mor_count($id_mar)) $result = 1 ; else $result = 2;   
return $result ; 
}
?>
<?php function mar_status3($id_mar)
{
include('../../login/config.php');
$query = "SELECT con_city  FROM  users  WHERE  id_mar = '$id_mar'  and S_access = '1' and con_city='2' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> rowCount();
if ($count_finish_mor == mar_mor_count($id_mar)) $result = 1 ; else $result = 2;   
return $result ; 
}
?>