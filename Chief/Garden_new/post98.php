<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include('../../lock_p1.php');
include('../../event.php');
if(isset($_POST['mah_kh']))
 {
	$tree_b      = $_POST['tree_b'] ; 
	$tree_gb     = $_POST['tree_gb'] ; 
	$mah_tol     = $_POST['mah_tol'] ; 
	$mah_tolp    = $_POST['mah_tolp'] ; 	
    $mah_bem      = $_POST['mah_bem'] ; 
    $mah_kh      = $_POST['mah_kh'] ; 
	//$id          = $_POST['id'] ; 
	$id          = intval($_POST['id']);
	$Garden_id   = intval($_POST['Garden_id']) ; 	
	$z_sal       = $_POST['z_sal'] ; 
	$bah_cod_m   = $_POST['bah_cod_m'] ; 
    $sh_gat      = $_POST['sh_gat'] ; 
    $add_abadi   = $_POST['add_abadi'] ; 

require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include_once('../../login/config.php');
$query = "update Garden_prod set date_s=?,tree_gb=?,tree_b=?,mah_tol=?,mah_tolp=?,mah_bem=?,mah_kh=? where id=? ";
$stmt = $dbh->prepare($query);
$stmt->execute(array($date_edit,$tree_gb,$tree_b,$mah_tol,$mah_tolp,$mah_bem,$mah_kh,$id));

$query = "update Garden set date_s=? where id=? ";
$stmt = $dbh->prepare($query);
$stmt->execute(array($date_edit,$Garden_id));

sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,',ثبت تولید قطعی باغی /'
.$sh_gat.'/'.$bah_cod_m,$id_ostan) ; 
}
