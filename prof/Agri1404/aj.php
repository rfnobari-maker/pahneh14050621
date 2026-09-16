<?php
//require_once 'functions.php';
include('../../event.php');
switch ($_POST['op']) {
	case 'check_mah_tol':
		$mcod=$_POST['mcod'];
		$sba=$_POST['sba'];
		$sbb=$_POST['sbb'];
		$mtol=$_POST['mtol'];
		$no_kesh=$_POST['no_kesh'];
        $sb = $sba + $sbb ;
		$mt = mht_z($mcod,$sb,$no_kesh);
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