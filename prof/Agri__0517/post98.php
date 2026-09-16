<?php
include('../../lock_p1.php');
include('../../event.php');
if(isset($_POST['s_bar_a']))
{
	$s_bar_a   = test_input($_POST['s_bar_a']) ; 
	$s_bar_b   = test_input($_POST['s_bar_b']) ; 
	$mah_tol   = test_input($_POST['mah_tol']) ; 
    $mah_kh    = test_input($_POST['mah_kh']) ; 
	$id        = test_input($_POST['id']) ; 
	$z_sal     = test_input($_POST['z_sal']) ; 
	$add_abadi = test_input($_POST['add_abadi']); 
	$bah_cod_m = test_input($_POST['bah_cod_m']) ; 
    $sh_gat    = test_input($_POST['sh_gat']) ; 
     $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 

require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../login/config.php');
$query = "update $Agri_prod_table set date_s=?,s_bar_a=?,s_bar_b=?,mah_tol=?,mah_kh=? where id=? ";
$stmt = $dbh->prepare($query);
$stmt->execute(array($date_edit,$s_bar_a,$s_bar_b,$mah_tol,$mah_kh,$id));
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,',ثبت تولید قطعی زراعی /'
.$sh_gat.'/'.$bah_cod_m,$id_ostan) ; 
}
