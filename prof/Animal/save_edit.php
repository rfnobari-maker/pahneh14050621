<?php
// اتصال به دیتابیس
include('../../login/config.php');
// بررسی ارسال داده‌ها از فرم
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $partIDCode = $_POST['partIDCode'];
    $sal = $_POST['sal'];

    // ثبت داده‌ها
    if (isset($_POST['action']) && $_POST['action'] == 'save') {
        // دریافت اطلاعات از فرم
        $species = isset($_POST['species']) ? reset($_POST['species']) : '';
        $breed = isset($_POST['breed']) ? reset($_POST['breed']) : '';
        $gender = isset($_POST['gender']) ? reset($_POST['gender']) : '';
        $age = isset($_POST['age']) ? reset($_POST['age']) : '';
        $activity = isset($_POST['activity']) ? reset($_POST['activity']) : '';
        $quantity = isset($_POST['quantity']) ? reset($_POST['quantity']) : '';

        // بررسی اینکه هیچ فیلدی خالی نباشد
     if (empty($species) || empty($breed) || empty($gender) || empty($age) || empty($activity) || empty($quantity) || $quantity < 1) {
      echo json_encode(array('success' => false,'message' => "همه فیلدها را تکمیل کنید ، تعداد دام نمی‌تواند کمتر از 1 باشد."));
            exit; // متوقف کردن ادامه عملیات
        }

        // استفاده از PDO برای درج داده‌ها
        try {
            $stmt = $dbh->prepare("INSERT INTO animals (partIDCode, sal, species, breed, gender, age, activity, quantity) 
                                   VALUES (:partIDCode, :sal, :species, :breed, :gender, :age, :activity, :quantity)");
            $stmt->execute(array(
                ':partIDCode' => $partIDCode,
                ':sal' => $sal,
                ':species' => $species,
                ':breed' => $breed,
                ':gender' => $gender,
                ':age' => $age,
                ':activity' => $activity,
                ':quantity' => $quantity
            ));
            $rowID = $dbh->lastInsertId(); // دریافت ID ثبت‌شده
            echo json_encode(array('success' => true, 'message' => "اطلاعات با موفقیت ثبت شد.", 'rowID' => $rowID));
        } catch (Exception $e) {
            echo json_encode(array('success' => false, 'message' => "خطا در ثبت داده‌ها: " . $e->getMessage()));
        }
    }
    // ویرایش داده‌ها
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $id = $_POST['rowID']; // ID رکورد برای ویرایش
        $species = isset($_POST['species']) ? reset($_POST['species']) : '';
        $breed = isset($_POST['breed']) ? reset($_POST['breed']) : '';
        $gender = isset($_POST['gender']) ? reset($_POST['gender']) : '';
        $age = isset($_POST['age']) ? reset($_POST['age']) : '';
        $activity = isset($_POST['activity']) ? reset($_POST['activity']) : '';
        $quantity = isset($_POST['quantity']) ? reset($_POST['quantity']) : '';

        // بررسی اینکه هیچ فیلدی خالی نباشد
if (empty($species) || empty($breed) || empty($gender) || empty($age) || empty($activity) || empty($quantity) || $quantity < 1) {
 echo json_encode(array('success' => false,'message' => "همه فیلدها را تکمیل کنید ، تعداد دام نمی‌تواند کمتر از 1 باشد."));
//    echo "لطفاً همه فیلدها را تکمیل کنید و تعداد دام نمی‌تواند کمتر از 1 باشد.";
    exit; // متوقف کردن ادامه عملیات
}

        try {
            // بررسی داده‌های ورودی
            $stmt = $dbh->prepare("UPDATE animals SET species = :species, breed = :breed, gender = :gender, age = :age, 
                                   activity = :activity, quantity = :quantity 
                                   WHERE id = :id AND partIDCode = :partIDCode AND sal = :sal");
            $stmt->execute(array(
                ':id' => $id,
                ':partIDCode' => $partIDCode,
                ':sal' => $sal,
                ':species' => $species,
                ':breed' => $breed,
                ':gender' => $gender,
                ':age' => $age,
                ':activity' => $activity,
                ':quantity' => $quantity
            ));
            echo json_encode(array('success' => true, 'message' => "رکورد با موفقیت ویرایش شد.",'rowID' => $id));
       
	   } catch (Exception $e) {
    // ارسال خطا به صورت JSON
    echo json_encode(array(
        'success' => false,
        'message' => "خطا در ویرایش رکورد: " . $e->getMessage()
    ));
}
}
}
?>
