<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include('../../lock_p3.php');
include('../../event.php');
if(isset($_POST['s_date']))
{
	$s_date      = $_POST['s_date'] ; 
	$id_ostan    = $_POST['id_ostan'] ; 
	$id_city     = $_POST['id_city'] ; 
    $p_cod       = $_POST['p_cod'] ; 
	$p_price     = $_POST['p_price'] ; 
$year = substr($s_date,0,4) ; 
$mont = substr($s_date,5,2) ; 

if($p_price>0)
{
include('../../login/config.php');

$sql = "DELETE FROM price_record WHERE id_ostan = '$id_ostan'  and id_city = '$id_city'  and p_cod = '$p_cod' and s_date = '$s_date'";
$stmt =  $dbh->prepare($sql);
$stmt->execute();

$query = "INSERT INTO price_record (s_date,year,mont,id_ostan,id_city,p_cod,p_price) VALUES 
(:s_date,:year,:mont,:id_ostan,:id_city,:p_cod,:p_price)";
$q = $dbh->prepare($query);
$q->execute(array(':s_date'=>$s_date,':year'=>$year,':mont'=>$mont,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':p_cod'=>$p_cod,':p_price'=>$p_price));

//sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,',ثبت تولید قطعی زراعی /'
//.$sh_gat.'/'.$bah_cod_m,$id_ostan) ; 
}
}