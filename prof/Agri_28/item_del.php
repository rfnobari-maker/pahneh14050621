<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php') ; 
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;

$id = $_POST['id'];
$z_sal = $_POST['z_sal'];

 $Agri_table      = 'Agri'.str_replace('-','_',$z_sal) ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 

// تنوع محصول 
$query = "UPDATE  $Agri_table c
INNER JOIN  $Agri_prod_table p 
ON c.id = p.Agri_id
SET c.t_mah = c.t_mah-1
where p.id = ?";
$q = $dbh->prepare($query);
$q->execute(array($id));
//

$query = "SELECT bah_cod_m,sh_gat,cod_mah,add_abadi from $Agri_prod_table where id = $id ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$bah_cod_m = $row['bah_cod_m']; 
$sh_gat    = $row['sh_gat']; 
$cod_mah   = $row['cod_mah']; 
$add_abadi = $row['add_abadi']; 

$query = "
    INSERT INTO `del_rec` (`Date`, `Table_id`, `Table_name`, `sal`, `bah_cod_m`, `mor_cod_m`, `cod_mah`, `date_s`, `num_bah`, `no_kesh`, `zer_kesht_a`, `zer_kesht_b`, `mah_tolp`, `add_abadi`, `add_city` , `Type_Op`)
    SELECT :Date, id, :Table_name, :sal, bah_cod_m, :mor_cod_m, cod_mah, date_s, num_bah, no_kesh, zer_kesht_a, zer_kesht_b, mah_tolp, add_abadi, add_city , :Type_Op
    FROM `$Agri_prod_table`
    WHERE id = :id
";
$q = $dbh->prepare($query);
$q->execute(array(
    ':Date' => $date_edit,
    ':Table_name' => $Agri_prod_table,
    ':sal' => $z_sal,
    ':mor_cod_m' => $login_session,
    ':id' => $id , 
	':Type_Op' => '1'
));

sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,',حذف محصول زراعی با کد '.$cod_mah.'/'.substr($z_sal,0,4).'/'.$sh_gat.'/'.$bah_cod_m ,$id_ostan) ; 
//
 $sql = "DELETE FROM $Agri_prod_table WHERE id = $id  ";
 $cust = $dbh->prepare($sql);
 $cust->execute(array());
 
if($cust) {
echo json_encode($cust);

 }
?>