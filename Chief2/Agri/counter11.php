<?php function kol_Agri_count($id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT id FROM  Agri  where id_ostan='$id_ostan' and z_sal = '$z_sal'" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri = $stmt -> rowCount();
return $count_Agri ; 
}
?>
<?php
function kol_no_Agri_gat($no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT id FROM  Agri WHERE no_kesh = '$no_kesh' and id_ostan='$id_ostan' and z_sal = '$z_sal'  " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_gat = $stmt -> rowCount();
return $count_gat ; 
}
?>


<?php function Agri_count($id_ostan,$id_city,$z_sal)
{
include('../../login/config.php');
$query = "SELECT id FROM  Agri WHERE  id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_Agri = $stmt -> rowCount();
return $count_Agri ; 
}
?>
<?php
function no_Agri_gat($id_ostan,$id_city,$z_sal,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT id FROM  Agri WHERE  id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' and no_kesh = '$no_kesh' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_gat = $stmt -> rowCount();
return $count_gat ; 
}
?>

<?php
function kol_sum_zer_kesht_a($no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_a) AS sum_kesht_a FROM Agri_prod WHERE  no_kesh = '$no_kesh' and id_ostan='$id_ostan' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht_a = $row['sum_kesht_a'];
return $sum_zerkesht_a ; 
}
?>
<?php
function kol_sum_zer_kesht_b($no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_b) AS sum_kesht_b FROM Agri_prod WHERE  no_kesh = '$no_kesh' and id_ostan='$id_ostan' and z_sal = '$z_sal' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht_b = $row['sum_kesht_b'];
return $sum_zerkesht_b ; 
}
?>


<?php
function sum_zer_kesht_a($id_ostan,$id_city,$z_sal,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_a) AS sum_kesht_a FROM Agri_prod WHERE  id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' and no_kesh = '$no_kesh' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht_a = $row['sum_kesht_a'];
return $sum_zerkesht_a ; 
}
?>
<?php
function sum_zer_kesht_b($id_ostan,$id_city,$z_sal,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_b) AS sum_kesht_b FROM Agri_prod WHERE  id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' and no_kesh = '$no_kesh' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht_b = $row['sum_kesht_b'];
return $sum_zerkesht_b ; 
}
?>
<?php
function kol_sum_s_bar_a($no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_a) AS sum_s_bar_a FROM Agri_prod WHERE  no_kesh = '$no_kesh' and id_ostan='$id_ostan' and z_sal = '$z_sal' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar_a = $row['sum_s_bar_a'];
return $sum_sbar_a ; 
}
?>
<?php
function kol_sum_s_bar_b($no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_b) AS sum_s_bar_b FROM Agri_prod  WHERE  no_kesh = '$no_kesh' and id_ostan='$id_ostan' and z_sal = '$z_sal' " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar_b = $row['sum_s_bar_b'];
return $sum_sbar_b ; 
}
?>
<?php
function sum_s_bar_a($id_ostan,$id_city,$z_sal,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_a) AS sum_s_bar_a FROM Agri_prod WHERE  id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar_a = $row['sum_s_bar_a'];
return $sum_sbar_a ; 
}
?>
<?php
function sum_s_bar_b($id_ostan,$id_city,$z_sal,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_b) AS sum_s_bar_b FROM Agri_prod WHERE  id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar_b = $row['sum_s_bar_b'];
return $sum_sbar_b ; 
}
?>
<?php
function kol_sum_s_ayesh($no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(s_ayesh) AS sum_s_ayesh FROM Agri WHERE no_kesh = '$no_kesh' and id_ostan='$id_ostan' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sayesh = $row['sum_s_ayesh'];
return $sum_sayesh ; 
}
?>
<?php
function kol_sum_mah_tol($no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_mah_tol FROM Agri_prod WHERE  no_kesh = '$no_kesh' and id_ostan='$id_ostan' and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mahtol = $row['sum_mah_tol'];
return $sum_mahtol; 
}
?>
<?php
function sum_s_ayesh($id_ostan,$id_city,$z_sal,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(s_ayesh) AS sum_s_ayesh FROM Agri WHERE  id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sayesh = $row['sum_s_ayesh'];
return $sum_sayesh ; 
}
?>
<?php
function sum_mah_tol($id_ostan,$id_city,$z_sal,$no_kesh)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_mah_tol FROM Agri_prod WHERE id_ostan='$id_ostan' and id_city = '$id_city' and z_sal = '$z_sal' and no_kesh = '$no_kesh'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mahtol = $row['sum_mah_tol'];
return $sum_mahtol; 
}
?>
<?php
function sum_mah_zer_kesht_a($cod_mah,$no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_a) AS sum_mah_kesht_a FROM Agri_prod WHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh' and id_ostan='$id_ostan'  and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mah_zerkesht_a = $row['sum_mah_kesht_a'];
return $sum_mah_zerkesht_a ; 
}
?>
<?php
function sum_mah_zer_kesht_b($cod_mah,$no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_b) AS sum_mah_kesht_b FROM Agri_prod WHERE  cod_mah = $cod_mah and no_kesh = '$no_kesh'  and id_ostan='$id_ostan'  and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mah_zerkesht_b = $row['sum_mah_kesht_b'];
return $sum_mah_zerkesht_b ; 
}
?>
<?php
function sum_mah_s_bar_a($cod_mah,$no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_a) AS sum_mah_s_bar_a FROM Agri_prod WHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh'  and id_ostan='$id_ostan'  and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mah_s_bar_a = $row['sum_mah_s_bar_a'];
return $sum_mah_s_bar_a ; 
}
?>
<?php
function sum_mah_s_bar_b($cod_mah,$no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(s_bar_b) AS sum_mah_s_bar_b FROM Agri_prodWHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh'  and id_ostan='$id_ostan'  and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mah_s_bar_b = $row['sum_mah_s_bar_b'];
return $sum_mah_s_bar_b ; 
}
?>
<?php
function sum_per_mah_tol($cod_mah,$no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_per_mah_tol FROM Agri_prod WHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh'  and id_ostan='$id_ostan'  and z_sal = '$z_sal'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_per_mahtol = $row['sum_per_mah_tol'];
return $sum_per_mahtol; 
}
?>
<?php
function sum_per_mah_tol_bem($cod_mah,$no_kesh,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_per_mah_tol_bem FROM Agri_prod WHERE  cod_mah = '$cod_mah' and no_kesh = '$no_kesh'  and id_ostan='$id_ostan'  and z_sal = '$z_sal' and mah_bem = '1'" ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_per_mahtol_bem = $row['sum_per_mah_tol_bem'];
return $sum_per_mahtol_bem; 
}
?>
<?php
function sum_m_zamin_m_ab($m_ab,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(m_zamin) AS sum_m_zamin FROM Agri WHERE  no_kesh = '1'  and  m_ab = $m_ab " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mzamin = $row['sum_m_zamin'];
return $sum_mzamin ; 
}
?>
<?php
function sum_m_zamin_no_ab($no_ab,$id_ostan,$z_sal)
{
include('../../login/config.php');
$query = "SELECT SUM(m_zamin) AS sum_m_zamin FROM Agri WHERE  no_kesh = '1'  and no_ab = $no_ab " ; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mzamin = $row['sum_m_zamin'];
return $sum_mzamin ; 
}
?>