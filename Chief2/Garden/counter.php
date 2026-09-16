<?php function kol_Garnd_count($id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT id FROM Garden WHERE  id_ostan='$id_ostan' and z_sal = '$z_sal' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garnd = $stmt -> rowCount();
return $count_Garnd ; 
}
?>
<?php
function kol_no_Garden_gat($no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT id FROM  Garden WHERE no_kesh = '$no_kesh' and id_ostan='$id_ostan' and z_sal = '$z_sal' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_gat = $stmt -> rowCount();
return $count_gat ; 
}
?>


<?php function Garden_count($id_ostan,$id_city,$z_sal)
{
include('../../login/config.php');
$query = "SELECT id FROM  Garden WHERE  id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Garden = $stmt -> rowCount();
return $count_Garden ; 
}
?>
<?php
function no_Garden_gat($id_ostan,$id_city,$z_sal,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT id FROM  Garden WHERE  id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' and no_kesh = '$no_kesh' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_gat = $stmt -> rowCount();
return $count_gat ; 
}
?>
<?php
function kol_sum_s_kesht_b($id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(s_kesht_b) AS sum_kesht_b FROM Garden_prod WHERE  id_ostan='$id_ostan' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht_b = $row['sum_kesht_b'];
return $sum_zerkesht_b ; 
}
?>
<?php
function kol_sum_s_kesht_gb($id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(s_kesht_gb) AS sum_kesht_gb FROM Garden_prod WHERE  id_ostan='$id_ostan' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht_gb = $row['sum_kesht_gb'];
return $sum_zerkesht_gb ; 
}
?>
<?php
function kol_sum_zer_kesht_b($no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_b) AS sum_kesht_b FROM Agri_prod WHERE  no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht_b = $row['sum_kesht_b'];
return $sum_zerkesht_b ; 
}
?>


<?php
function sum_zer_kesht_a($id_city,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_a) AS sum_kesht_a FROM Agri_prod WHERE  id_city = '$id_city' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht_a = $row['sum_kesht_a'];
return $sum_zerkesht_a ; 
}
?>
<?php
function sum_zer_kesht_b($id_city,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_b) AS sum_kesht_b FROM Agri_prod WHERE  id_city = '$id_city' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht_b = $row['sum_kesht_b'];
return $sum_zerkesht_b ; 
}
?>
<?php
function kol_sum_s_bar_a($no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_a) AS sum_s_bar_a FROM Agri_prod WHERE  no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar_a = $row['sum_s_bar_a'];
return $sum_sbar_a ; 
}
?>
<?php
function kol_sum_s_bar_b($no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_b) AS sum_s_bar_b FROM Agri_prod WHERE  no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar_b = $row['sum_s_bar_b'];
return $sum_sbar_b ; 
}
?>
<?php
function sum_s_bar_a($id_city,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_a) AS sum_s_bar_a FROM Agri_prod WHERE  id_city = '$id_city' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar_a = $row['sum_s_bar_a'];
return $sum_sbar_a ; 
}
?>
<?php
function sum_s_bar_b($id_city,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_b) AS sum_s_bar_b FROM Agri_prod WHERE  id_city = '$id_city' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar_b = $row['sum_s_bar_b'];
return $sum_sbar_b ; 
}
?>
<?php
function kol_sum_s_ayesh($no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(s_ayesh) AS sum_s_ayesh FROM Agri WHERE no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sayesh = $row['sum_s_ayesh'];
return $sum_sayesh ; 
}
?>
<?php
function sum_mah_tol($id_city,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_mah_tol FROM Agri_prod WHERE id_city = '$id_city' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mahtol = $row['sum_mah_tol'];
return $sum_mahtol; 
}
?>
<?php
function sum_mah_zer_kesht_a($cod_mah,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_a) AS sum_mah_kesht_a FROM Agri_prod WHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mah_zerkesht_a = $row['sum_mah_kesht_a'];
return $sum_mah_zerkesht_a ; 
}
?>
<?php
function sum_mah_zer_kesht_b($cod_mah,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_b) AS sum_mah_kesht_b FROM Agri_prod WHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mah_zerkesht_b = $row['sum_mah_kesht_b'];
return $sum_mah_zerkesht_b ; 
}
?>
<?php
function sum_mah_s_bar_a($cod_mah,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_a) AS sum_mah_s_bar_a FROM Agri_prod WHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mah_s_bar_a = $row['sum_mah_s_bar_a'];
return $sum_mah_s_bar_a ; 
}
?>
<?php
function sum_mah_s_bar_b($cod_mah,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_b) AS sum_mah_s_bar_b FROM Agri_prod WHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mah_s_bar_b = $row['sum_mah_s_bar_b'];
return $sum_mah_s_bar_b ; 
}
?>
<?php
function sum_per_mah_tol($cod_mah,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_per_mah_tol FROM Agri_prod WHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_per_mahtol = $row['sum_per_mah_tol'];
return $sum_per_mahtol; 
}
?>
<?php
function sum_per_mah_tol_bem($cod_mah,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_per_mah_tol_bem FROM Agri_prod WHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh' and mah_bem = '1'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_per_mahtol_bem = $row['sum_per_mah_tol_bem'];
return $sum_per_mahtol_bem; 
}
?>
<?php
function sum_m_zamin_m_ab($id_ostan,$z_sal,$m_ab)
{
include('../../login/config.php');
$query="SELECT SUM(m_zamin) AS sum_m_zamin FROM Garden WHERE id_ostan='$id_ostan' and z_sal = '$z_sal' and  no_kesh = '1'  and  m_ab = '$m_ab' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mzamin = $row['sum_m_zamin'];
return $sum_mzamin ; 
}
?>
<?php
function sum_m_zamin_no_ab($id_ostan,$z_sal,$no_ab)
{
include('../../login/config.php');
$query = "SELECT SUM(m_zamin) AS sum_m_zamin FROM Garden WHERE id_ostan='$id_ostan' and z_sal = '$z_sal' and   no_kesh = '1'  and no_ab = '$no_ab' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mzamin = $row['sum_m_zamin'];
return $sum_mzamin ; 
}
?>
<?php
function kol_sum_tree_b($id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(tree_b) AS sum_tree_b FROM Garden_prod WHERE  id_ostan='$id_ostan' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tree_b = $row['sum_tree_b'];
return $sum_tree_b ; 
}
?>
<?php
function kol_sum_tree_gb($id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(tree_gb) AS sum_tree_gb FROM Garden_prod WHERE  id_ostan='$id_ostan' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tree_gb = $row['sum_tree_gb'];
return $sum_tree_gb ; 
}
?>
<?php
function sum_s_kesht_b($id_ostan,$id_city,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(s_kesht_b) AS sum_kesht_b FROM Garden_prod WHERE  id_ostan='$id_ostan' and  id_city='$id_city' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_skeshtb_city = $row['sum_kesht_b'];
return $sum_skeshtb_city ; 
}
?>
<?php
function sum_s_kesht_gb($id_ostan,$id_city,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(s_kesht_gb) AS sum_kesht_gb FROM Garden_prod WHERE  id_ostan='$id_ostan' and  id_city='$id_city' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_skeshtgb_city = $row['sum_kesht_gb'];
return $sum_skeshtgb_city ; 
}
?>
<?php
function sum_s_kesht($id_ostan,$id_city,$z_sal)
{
include('../../login/config.php');
$query = "SELECT   (SUM(s_kesht_gb)+SUM(s_kesht_b)) AS sum_kesht FROM Garden_prod WHERE  id_ostan='$id_ostan' and  id_city='$id_city' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_skesht_city = $row['sum_kesht'];
return $sum_skesht_city ; 
}
?>
<?php
function kol_sum_s_kesht($id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT   (SUM(s_kesht_gb)+SUM(s_kesht_b)) AS sum_kesht FROM Garden_prod WHERE  id_ostan='$id_ostan'  and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_skesht_city = $row['sum_kesht'];
return $sum_skesht_city ; 
}
?>
<?php
function city_sum_tree_b($id_ostan,$id_city,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(tree_b) AS sum_tree_b FROM Garden_prod WHERE  id_ostan='$id_ostan' and  id_city='$id_city' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tree_b = $row['sum_tree_b'];
return $sum_tree_b ; 
}
?>
<?php
function city_sum_tree_gb($id_ostan,$id_city,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(tree_gb) AS sum_tree_gb FROM Garden_prod WHERE  id_ostan='$id_ostan' and  id_city='$id_city' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tree_gb = $row['sum_tree_gb'];
return $sum_tree_gb ; 
}
?>
<?php
function city_sum_tree($id_ostan,$id_city,$z_sal)
{
include('../../login/config.php');
$query = "SELECT (SUM(tree_gb)+SUM(tree_b)) AS sum_tree FROM Garden_prod WHERE  id_ostan='$id_ostan' and  id_city='$id_city' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_tree = $row['sum_tree'];
return $sum_tree ; 
}
?>
<?php
function city_nah_kesh($id_ostan,$id_city,$z_sal,$nah_kesh)
{
include('../../login/config.php');
$query = "SELECT id FROM  Garden WHERE  id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' and nah_kesh = '$nah_kesh' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_nah_kesh = $stmt -> rowCount();
return $count_nah_kesh ; 
}
?>
<?php
function ostan_nah_kesh($id_ostan,$z_sal,$nah_kesh)
{
include('../../login/config.php');
$query = "SELECT id FROM  Garden WHERE  id_ostan='$id_ostan' and z_sal = '$z_sal' and nah_kesh = '$nah_kesh' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$ostan_nah_kesh = $stmt -> rowCount();
return $ostan_nah_kesh ; 
}
?>
<?php
function city_sum_mah_tol($id_ostan,$id_city,$z_sal,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_mah_tol FROM Garden_prod WHERE id_ostan='$id_ostan' and id_city='$id_city' and z_sal = '$z_sal' and  no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mahtol = $row['sum_mah_tol'];
return $sum_mahtol; 
}
?>
<?php
function city_kol_mah($id_ostan,$id_city,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS city_mah_tol FROM Garden_prod WHERE id_ostan='$id_ostan' and id_city='$id_city' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$city_mahtol = $row['city_mah_tol'];
return $city_mahtol; 
}
?>
<?php
function ostan_sum_mah_tol($id_ostan,$z_sal,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_mah_tol FROM Garden_prod WHERE id_ostan='$id_ostan'  and z_sal = '$z_sal' and  no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mahtol = $row['sum_mah_tol'];
return $sum_mahtol; 
}
?>
<?php
function ostan_kol_mah($id_ostan
,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS city_mah_tol FROM Garden_prod WHERE id_ostan='$id_ostan'  and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan_mahtol = $row['city_mah_tol'];
return $ostan_mahtol; 
}
?>
<?php
function kol_sum_tree($id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT (SUM(tree_gb)+SUM(tree_b)) AS kol_sum_tree FROM Garden_prod WHERE  id_ostan='$id_ostan' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$kol_sum_tree = $row['kol_sum_tree'];
return $kol_sum_tree ; 
}
?>
