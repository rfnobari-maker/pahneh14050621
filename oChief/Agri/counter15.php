<?php
function Agri_gat($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_cod_mah,$v_mor_cod_m)
{
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
include('../../login/config.php');
//if ($mor_cod_m <> '') {	 $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;  }  else  {   $v_cod_mah = 1 ;  }
 $query = "SELECT DISTINCT sh_gat,mor_cod_m,z_sal FROM  $Agri_prod_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar and $f_add_abadi and $f_no_kesh and $v_cod_mah and $v_mor_cod_m " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$count_gat = $stmt -> rowCount();
return $count_gat ; 
$dbh = null ;
 }
?><?php
function m_zamin($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_mor_cod_m)
{
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 
include('../../login/config.php');
$query = "SELECT SUM(m_zamin) AS sum_zamin FROM $Agri_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh and $v_mor_cod_m " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zamin = $row['sum_zamin'];
return $sum_zamin ; 
$dbh = null ; }
?><?php
function s_ayesh($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_mor_cod_m)
{
$Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 
include('../../login/config.php');
$query = "SELECT SUM(s_ayesh) AS sum_s_ayesh FROM $Agri_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh and $v_mor_cod_m " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_ayesh = $row['sum_s_ayesh'];
return $sum_ayesh ; 
$dbh = null ; }
?><?php
function zer_kesht($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_cod_mah,$v_mor_cod_m)
{
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
include('../../login/config.php');
$query = "SELECT SUM(zer_kesht_a+zer_kesht_b) AS sum_zer_kesht FROM $Agri_prod_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh and $v_cod_mah and $v_mor_cod_m " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_zerkesht = $row['sum_zer_kesht'];
return $sum_zerkesht ; 
$dbh = null ;
 }
?><?php
function s_bar($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_cod_mah,$v_mor_cod_m)
{
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
include('../../login/config.php');
$query = "SELECT SUM(s_bar_a+s_bar_b) AS sum_s_bar FROM $Agri_prod_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh and $v_cod_mah and $v_mor_cod_m " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_sbar = $row['sum_s_bar'];
return $sum_sbar ; 
$dbh = null ; }
?><?php
function mah_tolp($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_cod_mah,$v_mor_cod_m)
{
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
include('../../login/config.php');
 $query = "SELECT SUM(mah_tolp) AS sum_mah_tolp FROM $Agri_prod_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh and $v_cod_mah and $v_mor_cod_m " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mahtolp = round($row['sum_mah_tolp'],2);
return $sum_mahtolp ; 
$dbh = null ; }
?><?php
function mah_tol($bah_cod_m,$v_id_ostan,$v_id_city,$v_id_mar,$f_add_abadi,$f_no_kesh,$z_sal,$v_cod_mah,$v_mor_cod_m)
{
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
include('../../login/config.php');
$query = "SELECT SUM(mah_tol) AS sum_mah_tol FROM $Agri_prod_table WHERE bah_cod_m='$bah_cod_m' and $v_id_ostan and $v_id_city and $v_id_mar  and $f_add_abadi and $f_no_kesh  and $v_cod_mah and $v_mor_cod_m " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sum_mahtol = round($row['sum_mah_tol'],2);
return $sum_mahtol ; 
$dbh = null ; }
?>