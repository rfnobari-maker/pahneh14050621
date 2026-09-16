<?php function ostan_status($id_ostan,$id_city)
{
include_once('../login/config.php');
$query = "SELECT con_ostan  FROM  users  WHERE  id_ostan = '$id_ostan' and S_access = '1' and con_ostan ='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> rowCount();
if ($count_finish_mor > 0 ) $result = 1 ; else $result = 2;   
return $result ; 
}
?>
<?php function city_status($id_ostan,$id_city)
{
include_once('../login/config.php');
$query = "SELECT con_center  FROM  users  WHERE  id_ostan = '$id_ostan' and  id_city = '$id_city'  and S_access = '1' and con_city='1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_finish_mor = $stmt -> rowCount();
if ($count_finish_mor > 0 ) $result = 1 ; else $result = 2;   
return $result ; 
}
?>
<?php function city_bee_count($id_city,$id_ostan)
{
include_once('../login/config.php');
$query = "SELECT id FROM  bee WHERE  id_ostan = '$id_ostan' and  id_city = '$id_city' and sal = '1396'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bee = $stmt -> rowCount();
return $count_city_bee ; 
}
?>
<?php function city_mor_count($id_ostan,$id_city)
{
include_once('../login/config.php');
$query = "SELECT count(*) as count FROM  users WHERE  id_ostan = '$id_ostan'  and id_city = '$id_city'  and s_access = '1'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$count_mar_mor = $row['count'];
return $count_mar_mor ; 
}
?>
<?php
// تعداد شاغلین در زنبورداری شهرستان
function sum_city_t_sha($id_ostan,$id_city,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_sha) AS sum_t_sha FROM bee WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal" ; 
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
include_once('../login/config.php');
$query = "SELECT id FROM bee WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal and bem_zan <> '3' " ;
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
include_once('../login/config.php');
if ($m_tam == '1') $v_mt_mom = "mt_mom ='1'" ; 
if ($m_tam == '2') $v_mt_mom = "mt_mom <>'1'" ; 
$query = "SELECT id FROM bee WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal and $v_mt_mom " ;
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
include_once('../login/config.php');
$query = "SELECT id FROM bee WHERE  id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal and bem_kand = '1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bem_kand = $stmt -> rowCount();
return $count_bem_kand ; 
}
?>
<?php
function sum_tk_mo($id_ostan,$id_city,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(tk_mo) AS sum_tk_mo FROM bee WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal" ; 
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
include_once('../login/config.php');
$query = "SELECT SUM(tk_bo) AS sum_tk_bo FROM bee WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal" ; 
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
include_once('../login/config.php');
$query = "SELECT SUM(to_mo) AS sum_to_mo FROM bee WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal" ; 
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
include_once('../login/config.php');
$query = "SELECT SUM(to_bo) AS sum_to_bo FROM bee WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal" ; 
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
include_once('../login/config.php');
$query = "SELECT SUM(t_jel) AS sum_t_jel FROM bee WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal" ; 
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
include_once('../login/config.php');
$query = "SELECT SUM(t_gar) AS sum_t_gar FROM bee WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal" ; 
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
include_once('../login/config.php');
$query = "SELECT SUM(t_mom) AS sum_t_mom FROM bee WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal" ; 
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
include_once('../login/config.php');
$query = "SELECT SUM(t_bar) AS sum_t_bar FROM bee WHERE id_ostan = '$id_ostan' and id_city = '$id_city' and sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_bar = $row['sum_t_bar'];
return round($sum_t_bar,2); 
}
?>
<?php function bah_mtah_count($sal,$m_tah)
{
include_once('../login/config.php');
$query = "SELECT bah.bah_cod_m
FROM bah
INNER JOIN bee ON bah.bah_cod_m = bee.bah_cod_m
WHERE bee.sal = '$sal' and  bah.m_tah='$m_tah'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bah_mtah = $stmt -> rowCount();
return $count_bah_mtah ; 
}
?>
<?php function ostan_bah_mtah_count($id_ostan,$sal,$m_tah)
{
include_once('../login/config.php');
$query = "SELECT bah.bah_cod_m
FROM bah
INNER JOIN bee ON bah.bah_cod_m = bee.bah_cod_m
WHERE bee.sal = '$sal' and bee.id_ostan = '$id_ostan' and bah.m_tah='$m_tah'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_ostan_bah_mtah = $stmt -> rowCount();
return $count_ostan_bah_mtah ; 
}
?>
<?php function city_bah_mtah_count($id_ostan,$id_city,$sal,$m_tah)
{
include_once('../login/config.php');
$query = "SELECT bah.bah_cod_m
FROM bah
INNER JOIN bee ON bah.bah_cod_m = bee.bah_cod_m
WHERE bee.sal = '$sal' and bee.id_ostan = '$id_ostan' and bee.id_city='$id_city' and bah.m_tah='$m_tah'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bah_mtah = $stmt -> rowCount();
return $count_city_bah_mtah ; 
}
?>
<?php function bee_count($sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM  bee WHERE  sal = '$sal'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bee = $stmt -> rowCount();
return $count_bee ; 
}
?>
<?php function ostan_bee_count($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM  bee WHERE  id_ostan = '$id_ostan'  and sal = '$sal'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bee = $stmt -> rowCount();
return $count_city_bee ; 
}
?>
<?php function ostan_bee_counter($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM  bee WHERE  id_ostan = '$id_ostan'  and sal = '$sal'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bee = $stmt -> rowCount();
return $count_city_bee ; 
}
?>
<?php
// تعداد شاغلین در زنبورداری استان
function sum_ostan_t_sha($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_sha) AS sum_t_sha FROM bee WHERE id_ostan = '$id_ostan'  and sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_sha = $row['sum_t_sha'];
return $sum_t_sha; 
}
?>
<?php 
//شمارش زنبورداران تحت پوشش بیمه
function ostan_bemzan($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM bee WHERE  id_ostan = '$id_ostan' and sal = $sal and bem_zan <> '3' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bem_zan = $stmt -> rowCount();
return $count_bem_zan ; 
}
?>
<?php
// محل تامین ملکه
function ostan_mt_mom($id_ostan,$sal,$m_tam)
{
include_once('../login/config.php');
if ($m_tam == '1') $v_mt_mom = "mt_mom ='1'" ; 
if ($m_tam == '2') $v_mt_mom = "mt_mom <>'1'" ; 
$query = "SELECT id FROM bee WHERE  id_ostan = '$id_ostan' and sal = $sal and $v_mt_mom " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mt_mom = $stmt -> rowCount();
return $count_mt_mom ; 
}
?>
<?php
function ostan_tk_bo($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(tk_bo) AS sum_tk_bo FROM bee WHERE id_ostan = '$id_ostan' and sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tk_bo = $row['sum_tk_bo'];
return $sum_tk_bo; 
}
?>
<?php
function ostan_to_mo($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(to_mo) AS sum_to_mo FROM bee WHERE id_ostan = '$id_ostan'  and sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_to_mo = $row['sum_to_mo'];
return round($sum_to_mo); 
}
?>
<?php
function ostan_to_bo($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(to_bo) AS sum_to_bo FROM bee WHERE id_ostan = '$id_ostan' and sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_to_bo = $row['sum_to_bo'];
return round($sum_to_bo); 
}
?>

<?php
function ostan_t_jel($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_jel) AS sum_t_jel FROM bee WHERE id_ostan = '$id_ostan' and sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_jel = $row['sum_t_jel'];
return round($sum_t_jel,2); 
}
?>
<?php
function ostan_t_gar($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_gar) AS sum_t_gar FROM bee WHERE id_ostan = '$id_ostan'  and sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_gar = $row['sum_t_gar'];
return round($sum_t_gar,2); 
}
?>
<?php
function ostan_t_mom($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_mom) AS sum_t_mom FROM bee WHERE id_ostan = '$id_ostan'  and sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_mom = $row['sum_t_mom'];
return round($sum_t_mom,2); 
}
?>
<?php
function ostan_t_bar($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_bar) AS sum_t_bar FROM bee WHERE id_ostan = '$id_ostan' and sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_bar = $row['sum_t_bar'];
return round($sum_t_bar,2); 
}
?>

<?php
// تعداد کلنی های تحت پوشش بیمه
function ostan_bem_kand($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM bee WHERE  id_ostan = '$id_ostan' and sal = $sal and bem_kand = '1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bem_kand = $stmt -> rowCount();
return $count_bem_kand ; 
}
?>
<?php
function ostan_tk_mo($id_ostan,$sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(tk_mo) AS sum_tk_mo FROM bee WHERE id_ostan = '$id_ostan' and sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tk_mo = $row['sum_tk_mo'];
return $sum_tk_mo; 
}
?>
<?php
function t_bar($sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_bar) AS sum_t_bar FROM bee WHERE  sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_bar = $row['sum_t_bar'];
return round($sum_t_bar,2); 
}
?>
<?php
function t_mom($sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_mom) AS kol_t_mom FROM bee WHERE sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_t_mom = $row['kol_t_mom'];
return round($kol_t_mom,2); 
}
?>
<?php
function t_gar($sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_gar) AS sum_t_gar FROM bee WHERE  sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_gar = $row['sum_t_gar'];
return round($sum_t_gar,2); 
}
?>
<?php
function t_jel($sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_jel) AS sum_t_jel FROM bee WHERE  sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_jel = $row['sum_t_jel'];
return round($sum_t_jel,2); 
}
?>
<?php
function to_mo($sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(to_mo) AS sum_to_mo FROM bee WHERE  sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_to_mo = $row['sum_to_mo'];
return round($sum_to_mo); 
}
?>
<?php
function to_bo($sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(to_bo) AS sum_to_bo FROM bee WHERE  sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_to_bo = $row['sum_to_bo'];
return round($sum_to_bo); 
}
?>
<?php
function bem_kand($sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM bee WHERE  sal = $sal and bem_kand = '1' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bem_kand = $stmt -> rowCount();
return $count_bem_kand ; 
}
?>
<?php
function tk_mo($sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(tk_mo) AS sum_tk_mo FROM bee WHERE  sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tk_mo = $row['sum_tk_mo'];
return $sum_tk_mo; 
}
?>
<?php
function tk_bo($sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(tk_bo) AS sum_tk_bo FROM bee WHERE  sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tk_bo = $row['sum_tk_bo'];
return $sum_tk_bo; 
}
?>
<?php
// محل تامین ملکه
function mt_mom($sal,$m_tam)
{
include_once('../login/config.php');
if ($m_tam == '1') $v_mt_mom = "mt_mom ='1'" ; 
if ($m_tam == '2') $v_mt_mom = "mt_mom <>'1'" ; 
$query = "SELECT id FROM bee WHERE  sal = $sal and $v_mt_mom " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_mt_mom = $stmt -> rowCount();
return $count_mt_mom ; 
}
?>
<?php 
//شمارش زنبورداران تحت پوشش بیمه
function bemzan($sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM bee WHERE  sal = $sal and bem_zan <> '3' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_bem_zan = $stmt -> rowCount();
return $count_bem_zan ; 
}
?>
<?php
// تعداد شاغلین در زنبورداری استان
function sum_t_sha($sal)
{
include_once('../login/config.php');
$query = "SELECT SUM(t_sha) AS sum_t_sha FROM bee WHERE  sal = $sal" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_t_sha = $row['sum_t_sha'];
return $sum_t_sha; 
}
?>
<?php function bee_counter($sal)
{
include_once('../login/config.php');
$query = "SELECT id FROM  bee WHERE  sal = '$sal'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_city_bee = $stmt -> rowCount();
return $count_city_bee ; 
}
?>
