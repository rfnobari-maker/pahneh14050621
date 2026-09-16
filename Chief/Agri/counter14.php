<?php
require_once('../../login/config.php');
function Agri_gat($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal)
{
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 
global $dbh; 
$query="SELECT id FROM $Agri_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_gat = $stmt -> rowCount();
return $count_gat ; 
}
?>
<?php
function m_zamin($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal)
{
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 
global $dbh; 
$query = "SELECT SUM(m_zamin) AS sum_zamin FROM $Agri_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zamin = $row['sum_zamin'];
return $sum_zamin ; 
}
?>
<?php
function s_ayesh($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal)
{
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 
global $dbh; 
$query = "SELECT SUM(s_ayesh) AS sum_s_ayesh FROM $Agri_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar and $f_add_abadi and $f_no_kesh" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_ayesh = $row['sum_s_ayesh'];
return $sum_ayesh ; 
}
?>
<?php
function zer_kesht($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal)
{
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
global $dbh; 
$query = "SELECT SUM(zer_kesht_a+zer_kesht_b) AS sum_zer_kesht FROM $Agri_prod_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht = $row['sum_zer_kesht'];
return $sum_zerkesht ; 
}
?>
<?php
function s_bar($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal)
{
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
global $dbh; 
$query = "SELECT SUM(s_bar_a+s_bar_b) AS sum_s_bar FROM $Agri_prod_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar = $row['sum_s_bar'];
return $sum_sbar ; 
}
?>
<?php
function mah_tolp($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal)
{
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
global $dbh; 
$query = "SELECT SUM(mah_tolp) AS sum_mah_tolp FROM $Agri_prod_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mahtolp = $row['sum_mah_tolp'];
return $sum_mahtolp ; 
}
?>
<?php
function mah_tol($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal)
{
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
global $dbh; 
$query = "SELECT SUM(mah_tol) AS sum_mah_tol FROM $Agri_prod_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mahtol = $row['sum_mah_tol'];
return $sum_mahtol ; 
}
?>