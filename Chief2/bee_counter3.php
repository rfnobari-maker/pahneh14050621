<?php
 function city_status($id_city)
{
include('../login/config.php');
$query = "SELECT con_center  FROM  users  WHERE  id_city = '$id_city'  and S_access = '1' and con_city='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> rowCount();
if ($count_finish_mor ==  city_mor_count($id_city)) $result = 1 ; else $result = 2;   
return $result ; 
}
?>
<?php function city_bee_count($id_city,$id_ostan)
{
include('../login/config.php');
$query = "SELECT id FROM  bee3 WHERE  id_ostan = '$id_ostan' and  id_city = '$id_city' and sal = '1395'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bee = $stmt -> rowCount();
return $count_city_bee ; 
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
}
?>
<?php
// تعداد شاغلین در زنبورداری
function sum_city_t_sha($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT SUM(t_sha) AS sum_t_sha FROM bee3 WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_sha = $row['sum_t_sha'];
return $sum_t_sha; 
}
?>

<?php 
//شمارش زنبورداران تحت پوشش بیمه
function bem_zan_count($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT id FROM bee3 WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal' and bem_zan <> '3' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bem_zan = $stmt -> rowCount();
return $count_bem_zan ; 
}
?>
<?php
// محل تامین ملکه
function mt_mom_count($id_ostan,$id_city,$sal,$m_tam)
{
include('../login/config.php');
if ($m_tam == '1') $v_mt_mom = "mt_mom ='1'" ; 
if ($m_tam == '2') $v_mt_mom = "mt_mom <>'1'" ; 
$query = "SELECT id FROM bee3 WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal' and $v_mt_mom " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mt_mom = $stmt -> rowCount();
return $count_mt_mom ; 
}
?>
<?php
// تعداد کلنی های تحت پوشش بیمه
function bem_kand_count($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT id FROM bee3 WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal' and bem_kand = '1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bem_kand = $stmt -> rowCount();
return $count_bem_kand ; 
}
?>
<?php
function sum_tk_mo($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT SUM(tk_mo) AS sum_tk_mo FROM bee3 WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tk_mo = $row['sum_tk_mo'];
return $sum_tk_mo; 
}
?>
<?php
function sum_tk_bo($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT SUM(tk_bo) AS sum_tk_bo FROM bee3 WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tk_bo = $row['sum_tk_bo'];
return $sum_tk_bo; 
}
?>
<?php
function sum_to_mo($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT SUM(to_mo) AS sum_to_mo FROM bee3 WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_to_mo = $row['sum_to_mo'];
return round($sum_to_mo); 
}
?>
<?php
function sum_to_bo($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT SUM(to_bo) AS sum_to_bo FROM bee3 WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_to_bo = $row['sum_to_bo'];
return round($sum_to_bo); 
}
?>

<?php
function sum_t_jel($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT SUM(t_jel) AS sum_t_jel FROM bee3 WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_jel = $row['sum_t_jel'];
return round($sum_t_jel,2); 
}
?>
<?php
function sum_t_gar($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT SUM(t_gar) AS sum_t_gar FROM bee3 WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_gar = $row['sum_t_gar'];
return round($sum_t_gar,2); 
}
?>
<?php
function sum_t_mom($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT SUM(t_mom) AS sum_t_mom FROM bee3 WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_mom = $row['sum_t_mom'];
return round($sum_t_mom,2); 
}
?>
<?php
function sum_t_bar($id_ostan,$id_city,$sal)
{
include('../login/config.php');
$query = "SELECT SUM(t_bar) AS sum_t_bar FROM bee3 WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = '$sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_bar = $row['sum_t_bar'];
return round($sum_t_bar,2); 
}
?>
<?php function city_bah_mtah_count($id_ostan,$id_city,$sal,$m_tah)
{
include('../login/config.php');
//$query = "SELECT * FROM  users WHERE  id_ostan = '$id_ostan' and jens = '$jens' and S_access = '1'" ;
$query = "SELECT bah.m_tah, bah.bah_cod_m
FROM bah
INNER JOIN bee ON bah.bah_cod_m = bee.bah_cod_m
WHERE bee.sal = '$sal' and bah.id_ostan = '$id_ostan' and bee.id_city='$id_city' and bah.m_tah='$m_tah'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bah_mtah = $stmt -> rowCount();
return $count_city_bah_mtah ; 
}
?>
