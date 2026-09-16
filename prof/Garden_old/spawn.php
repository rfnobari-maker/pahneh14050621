<?php
//require_once 'functions.php';
include_once('../../login/config.php') ;
include('../../event.php');
switch ($_POST['op']) {
	case 'check_mah_tol':
		$unit_id=$_POST['unit_id'];
		$y_prod=$_POST['y_prod'];
        $query = "SELECT count(*) FROM  `Mushroom_spawn` where unit_id =? and y_prod=? " ;
        $stmt = $dbh->prepare($query);
		$stmt->execute(array($unit_id,$y_prod));
//        $count_spawn = $stmt->fetchColumn();
	      $count_spawn = 0 ; 
		if ($count_spawn < 1)
			echo $count_spawn;
		else
			echo 'Zrue';
		break;

	default:
		# code...
		break;
}
?>