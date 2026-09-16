<?php
//require_once 'functions.php';
include('../../event.php');
switch ($_POST['op']) {
	case 'check_mah_tol':
		$mcod=$_POST['mcod'];
		$skb=$_POST['skb'];
		$mtol=$_POST['mtol'];
		$no_kesh=$_POST['no_kesh'];
		$mt = mht_b($mcod,$skb,$no_kesh);
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