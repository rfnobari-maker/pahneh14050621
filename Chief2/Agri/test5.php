<?php 
$id_ostan = '31' ; 
$z_sal = '1398-1399' ; 
$cod_mah = '174' ; 
$b_time = '1' ; 
include ('../../login/config.php') ;
  $query = "SELECT * from Vege_e_ostan WHERE id_ostan = '$id_ostan' and z_sal = '$z_sal' and cod_mah = '$cod_mah' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($b_time == '1') $V_szk_e = $row['z_s_zk'] ; 
if($b_time == '2') $V_szk_e = $row['b_s_zk'] ; 
if($b_time == '3') $V_szk_e = $row['t_s_zk'] ; 
if($b_time == '4') $V_szk_e = $row['p_s_zk'] ; 
if($b_time == '')  $V_szk_e = $row['s_zk'] ; 
echo $V_szk_e  ;  
?>
