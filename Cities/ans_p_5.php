<?php 
include('../lock_p3.php');
include ('../login/config.php') ; 
include('../event.php');
require_once('../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
$cod_m1 = $_POST['cod_m1'] ;
$id_mar = $_POST['id_mar'] ; 
$mar = $_POST['mar'] ; 
$query = "SELECT * from users where cod_m = $cod_m1 and S_access = '1'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mor = $stmt -> rowCount();
if ($count_mor <> 0) 
{ 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_m =  $row['city'] ; 
echo $id_city_m = $row['id_city'] ;
echo '<br>';
$markaz_m = $row['markaz'] ;
echo $id_mar_m =  $row['id_mar'] ; 
echo '<br>';
echo $id_city ;
echo '<br>';
echo $id_mar ;
if (($id_city_m == $id_city) and ($id_mar_m==$id_mar)){echo 'مروج در حال حاضر در همان مرکز مشغول فعالیت می باشد';}
if (($id_city_m == $id_city) and ($id_mar_m<>$id_mar)){echo 'مایل به تغییر محل فعالیت مروج هستید ؟';}
if ($id_city_m <> $id_city){echo 'محل فعالیت مروج شهرستان دیگری ثبت شده با مدیر سامانه تماس حاصل فرمایید';}
}
else 
{
	echo 'اطلاعات مروج مورد نظر تابحال ثبت نشده مایل به ثبت نام مروج هستید ؟ ';
	
	}

?>