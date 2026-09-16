<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include('../../lock_ce.php');
include('../../event.php');
if(isset($_POST['z_sal']))
{
	$id_ostan     = $_POST['id_ostan'] ; 
	$z_sal        = $_POST['z_sal'] ; 
    $cod_mah      = $_POST['cod_mah'] ; 

	$p_p_t        = $_POST['p_p_t'] ; 
	$p_s_zk       = $_POST['p_s_zk'] ; 

	$t_p_t        = $_POST['t_p_t'] ; 
	$t_s_zk       = $_POST['t_s_zk'] ; 

	$b_p_t        = $_POST['b_p_t'] ; 
	$b_s_zk       = $_POST['b_s_zk'] ; 

	$z_p_t        = $_POST['z_p_t'] ; 
    $z_s_zk       = $_POST['z_s_zk'] ; 

	$p_t        = $_POST['p_t'] ; 
    $s_zk       = $_POST['s_zk'] ; 

require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include_once('../../login/config.php');

$sql = "DELETE FROM Vege_e_ostan WHERE id_ostan = '$id_ostan' and cod_mah = '$cod_mah' and z_sal = '$z_sal'";
$stmt =  $dbh->prepare($sql);
$stmt->execute();

$query = "INSERT INTO Vege_e_ostan 
(id_ostan,z_sal,cod_mah,b_p_t,b_s_zk,t_p_t,t_s_zk,p_p_t,p_s_zk,z_p_t,z_s_zk,p_t,s_zk) 
VALUES 
(:id_ostan,:z_sal,:cod_mah,:b_p_t,:b_s_zk,:t_p_t,:t_s_zk,:p_p_t,:p_s_zk,:z_p_t,:z_s_zk,:p_t,:s_zk)";
$q = $dbh->prepare($query);
$q->execute(array(':id_ostan'=>$id_ostan,':z_sal'=>$z_sal,':cod_mah'=>$cod_mah,':b_p_t'=>$b_p_t,':b_s_zk'=>$b_s_zk
,':t_p_t'=>$t_p_t,':t_s_zk'=>$t_s_zk,':p_p_t'=>$p_p_t,':p_s_zk'=>$p_s_zk,':z_p_t'=>$z_p_t,':z_s_zk'=>$z_s_zk
,':p_t'=>$p_t,':s_zk'=>$s_zk));

//sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,',ثبت تولید قطعی زراعی /'
//.$sh_gat.'/'.$bah_cod_m,$id_ostan) ; 
}
