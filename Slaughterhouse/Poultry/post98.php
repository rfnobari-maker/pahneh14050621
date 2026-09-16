<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
include('../../lock_expar.php');
include('../../event.php');
if(isset($_POST['m_joj']))
{
	$m_joj    = $_POST['m_joj'] ; 
	$date_joj = $_POST['date_joj'] ; 
	$sh_yek   = $_POST['sh_yek'] ; 
	
include('../../login/config.php');
$query = "update samasat_slau_temp set m_joj=? where sh_yek=? and date_joj=? ";
$stmt = $dbh->prepare($query);
$stmt->execute(array($m_joj,$sh_yek,$date_joj));
}
