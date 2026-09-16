<?php
//require_once 'functions.php';
include('../../event.php');
switch ($_POST['op']) {
	case 'check_mah_tol':

		$mcod=$_POST['mcod'];
		$s_kesh=$_POST['s_kesh'];
		$mtol=$_POST['mtol'];
		$mt = mht_G($mcod,$s_kesh);
		if ($mtol>$mt)
			echo $mt;
		else
			echo 'true';
		break;

	default:
		# code...
		break;
}
?>