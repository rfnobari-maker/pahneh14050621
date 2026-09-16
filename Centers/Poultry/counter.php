<?php function mor_bee_count($mor_cod_m)
{
include('../../login/config.php');
$query = "SELECT id FROM  bee WHERE mor_cod_m = '$mor_cod_m' and  sal = '1404' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mor_bee = $stmt -> rowCount();
return $count_mor_bee ; 
}
?>
<?php function mor_bee_status($mor_cod_m)
{
include('../../login/config.php');
$query = "SELECT end_bee,date_end_bee,con_center FROM  users WHERE cod_m = '$mor_cod_m' and S_access = '1' " ;
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
$query = "SELECT end_bee FROM  users WHERE cod_m = '$mor_cod_m' and S_access = '1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['end_bee']; 
}
?>
<?php function mor_con_center($mor_cod_m)
{
include('../../login/config.php');
$query = "SELECT con_center FROM  users WHERE cod_m = '$mor_cod_m' and S_access = '1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
return $row['con_center']; 
}
?>
