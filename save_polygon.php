<?php
header('Content-Type: application/json');

// اطلاعات پایگاه داده
 include('./login/config.php');

    // دریافت داده‌ها
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['coordinates']) && isset($data['area'])) {
        $coordinates = json_encode($data['coordinates']);
        $area = $data['area'];

        // ذخیره در پایگاه داده
        $stmt = $dbh->prepare("INSERT INTO polygons (coordinates, area) VALUES (:coordinates, :area)");
        $stmt->execute(array('coordinates' => $coordinates, 'area' => $area));

        echo json_encode(array('success' => true));
	}
?>
