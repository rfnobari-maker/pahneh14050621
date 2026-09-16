<?php
header('Content-Type: application/json');
include('./login/config.php');

$data = json_decode(file_get_contents('php://input'), true);

// بررسی داده‌های ورودی
if (!isset($data['coordinates'], $data['area'])) {
    echo json_encode(array('success' => false, 'error' => 'داده‌های ارسال شده ناقص است.'));
    exit;
}

$id = isset($data['id']) ? intval($data['id']) : null; // بررسی ID
$coordinates = $data['coordinates']; // دریافت مختصات به عنوان آرایه
$area = floatval($data['area']);

// تابع بررسی نقطه در پلیگون (Ray-Casting Algorithm)
function isPointInPolygon($point, $polygon) {
    $x = $point[0];
    $y = $point[1];
    $inside = false;
    $n = count($polygon);

    for ($i = 0, $j = $n - 1; $i < $n; $j = $i++) {
        $xi = $polygon[$i][0];
        $yi = $polygon[$i][1];
        $xj = $polygon[$j][0];
        $yj = $polygon[$j][1];

        $intersect = (($yi > $y) != ($yj > $y)) && 
                     ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
        if ($intersect) $inside = !$inside;
    }
    return $inside;
}

try {
    // دریافت تمام پلیگون‌های موجود به جز پلیگون در حال ویرایش (در صورت وجود ID)
    $stmt = $dbh->prepare("SELECT id, coordinates FROM polygons WHERE id != :id OR :id IS NULL");
    $stmt->execute(array(':id' => $id));
    $polygons = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // بررسی همپوشانی
    foreach ($polygons as $row) {
        $existingPolygon = json_decode($row['coordinates'], true);

        // بررسی اینکه آیا هر نقطه از پلیگون جدید در پلیگون موجود قرار دارد
        foreach ($coordinates as $point) {
            if (isPointInPolygon($point, $existingPolygon)) {
                echo json_encode(array('success' => false, 'error' => 'پلیگون جدید با یک پلیگون موجود همپوشانی دارد.', 'removePolygon' => true));
                exit;
            }
        }
    }

    // ذخیره‌سازی یا بروزرسانی در صورت عدم وجود همپوشانی
    $coordinatesJson = json_encode($coordinates);

    if ($id) {
        // بروزرسانی رکورد موجود
        $stmt = $dbh->prepare("UPDATE polygons SET coordinates = :coordinates, area = :area WHERE id = :id");
        $stmt->execute(array(':coordinates' => $coordinatesJson, ':area' => $area, ':id' => $id));
    } else {
        // درج پلیگون جدید
        $stmt = $dbh->prepare("INSERT INTO polygons (coordinates, area) VALUES (:coordinates, :area)");
        $stmt->execute(array(':coordinates' => $coordinatesJson, ':area' => $area));
        $id = $dbh->lastInsertId(); // گرفتن ID رکورد جدید
    }

    echo json_encode(array('success' => true, 'id' => $id));
} catch (Exception $e) {
    echo json_encode(array('success' => false, 'error' => $e->getMessage()));
}
?>
