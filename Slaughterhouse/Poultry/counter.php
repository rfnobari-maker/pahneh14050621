<?php function mar_bee_count($id_mar,$sal)
{
include('../../login/config.php');
$query = "SELECT id FROM  `bee` WHERE `id_mar` = '$id_mar'  and sal = '$sal' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_bee = $stmt -> rowCount();
return $count_mar_bee ; 
}
?>
<?php function mar_kol_kbo($id_mar,$sal)
{
include('../../login/config.php');
$query = "SELECT SUM(tk_bo) AS kol_k_bo from bee WHERE `id_mar` = '$id_mar' and sal = '$sal' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_k_bo = $row['kol_k_bo'];
return $kol_k_bo ; 
}
?>
<?php function mar_kol_kmo($id_mar,$sal)
{
include('../../login/config.php');
$query = "SELECT SUM(tk_mo) AS kol_k_mo from bee WHERE `id_mar` = '$id_mar' and sal = '$sal' ";
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
$query = "SELECT count(*) FROM  `users` WHERE  `id_mar` = '$id_mar'  and S_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mar_mor = $stmt->fetchColumn();
return $count_mar_mor ; 
}
?>
<?php function mar_status($id_mar)
{
include('../../login/config.php');
$query = "SELECT con_center  FROM  `users`  WHERE  `id_mar` = $id_mar  and S_access = '1' and con_center='1' " ;
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
$query = "SELECT count(*)  FROM `users`  WHERE  `id_mar` = '$id_mar'  and S_access = '1' and con_center='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
 $count_finish_mor = $stmt->fetchColumn();
if ($count_finish_mor == mar_mor_count($id_mar)) $result = 1 ; else $result = 2;   
return $result ; 
}
?>
<?php function mar_status3($id_mar)
{
include('../../login/config.php');
$query = "SELECT count(*)  FROM  `users`  WHERE  `id_mar` = $id_mar  and S_access = '1' and con_center='2' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt->fetchColumn();
if ($count_finish_mor == mar_mor_count($id_mar)) $result = 1 ; else $result = 2;   
return $result ; 
}
?>

<?php function mor_bee_count($mor_cod_m)
{
include('../../login/config.php');
$query = "SELECT id FROM  `bee` WHERE `mor_cod_m` = '$mor_cod_m' and  sal = '1398' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mor_bee = $stmt -> rowCount();
return $count_mor_bee ; 
}
?>
<?php function mor_bee_status($mor_cod_m)
{
include('../../login/config.php');
$query = "SELECT end_bee,date_end_bee,con_center FROM  `users` WHERE `cod_m` = '$mor_cod_m' and S_access = '1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row['end_bee']=='' and $row['con_center']=='') 
{
return '<p style=color:red>عدم گزارش خاتمه عملیات</p>' ;
}
if ($row['end_bee']=='' and $row['con_center']=='2') 
{
return '<p style=color:blue>امکان ویرایش اطلاعات را دارد</p>' ;
}
if ($row['end_bee']=='1') 
{
return '<p style=color:green>خاتمه عملیات'.'<br>'.$row['date_end_bee'].'</p>' ; 
}
if ($row['end_bee']=='3') 
{
return '<p style=color:red>عدم گزارش خاتمه عملیات تا پایان زمان مقرر</p>' ;
}
}
?>
<?php function mor_end_bee($mor_cod_m)
{
include('../../login/config.php');
$query = "SELECT end_bee FROM  `users` WHERE `cod_m` = '$mor_cod_m' and S_access = '1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['end_bee']; 
}
?>
<?php function mor_con_center($mor_cod_m)
{
include('../../login/config.php');
$query = "SELECT con_center FROM  `users` WHERE `cod_m` = '$mor_cod_m' and S_access = '1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['con_center']; 
}
?>
