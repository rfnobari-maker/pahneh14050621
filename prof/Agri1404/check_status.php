<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');

$id = isset($_POST['id']) ? $_POST['id'] : 0;
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$year = substr($z_sal, 0, 4);

// فراخوانی تابع مد نظر شما
$status = check_payesh($id, 0, $year);

echo json_encode(array('status' => $status));
?>