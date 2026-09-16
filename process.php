<?php

// اتصال به دیتابیس
include('./login/config.php'); // فایل تنظیمات دیتابیس شما

// بررسی ارسال داده‌ها از فرم
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $partIDCode = $_POST['partIDCode'];
    $sal = $_POST['sal'];

    // ثبت داده‌ها
    if (isset($_POST['action']) && $_POST['action'] == 'save') {
        // دریافت اطلاعات از فرم
	        $species = $_POST['species'];
        $breed = $_POST['breed'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $activity = $_POST['activity'];
        $quantity = $_POST['quantity'];

        // استفاده از PDO برای درج داده‌ها
        try {
            $dbh->beginTransaction();
            
            // بررسی صحت اطلاعات ارسال شده
           // var_dump($species, $breed, $gender, $age, $activity, $quantity);

            for ($i = 0; $i < count($species); $i++) {
                $stmt = $dbh->prepare("INSERT INTO animals (partIDCode, sal, species, breed, gender, age, activity, quantity) 
                                       VALUES (:partIDCode, :sal, :species, :breed, :gender, :age, :activity, :quantity)");
                $stmt->execute(array(
                    ':partIDCode' => $partIDCode,
                    ':sal' => $sal,
                    ':species' => $species[$i],
                    ':breed' => $breed[$i],
                    ':gender' => $gender[$i],
                    ':age' => $age[$i],
                    ':activity' => $activity[$i],
                    ':quantity' => $quantity[$i]
                ));
            }
            $dbh->commit();
            echo "داده‌ها با موفقیت ثبت شدند.";
        } catch (Exception $e) {
            $dbh->rollBack();
            echo "خطا در ثبت داده‌ها: " . $e->getMessage();
        }
    }

    // حذف داده‌ها
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $id = $_POST['id']; // ID رکورد برای حذف

        try {
            // بررسی داده‌های ورودی
            var_dump($id, $partIDCode, $sal);

            $stmt = $dbh->prepare("DELETE FROM animals WHERE id = :id AND partIDCode = :partIDCode AND sal = :sal");
            $stmt->execute(array(
                ':id' => $id,
                ':partIDCode' => $partIDCode,
                ':sal' => $sal
            ));
            echo "رکورد با موفقیت حذف شد.";
        } catch (Exception $e) {
            echo "خطا در حذف رکورد: " . $e->getMessage();
        }
    }

    // ویرایش داده‌ها
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $id = $_POST['id']; // ID رکورد برای ویرایش
        $species = $_POST['species'];
        $breed = $_POST['breed'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $activity = $_POST['activity'];
        $quantity = $_POST['quantity'];

        try {
            // بررسی داده‌های ورودی
            var_dump($id, $species, $breed, $gender, $age, $activity, $quantity);

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
            echo "رکورد با موفقیت ویرایش شد.";
        } catch (Exception $e) {
            echo "خطا در ویرایش رکورد: " . $e->getMessage();
        }
    }
}
?>
