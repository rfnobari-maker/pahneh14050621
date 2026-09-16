<?php
include('./login/config.php'); // اتصال به دیتابیس

// بررسی ارسال داده‌ها
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // جستجو برای رکورد
    if (isset($_POST['action']) && $_POST['action'] == 'search') {
        $partIDCode = $_POST['partIDCode']; // شناسه یکتا
        $sal = $_POST['sal'];

        try {
            // جستجو رکورد در دیتابیس
            $stmt = $dbh->prepare("SELECT * FROM animals WHERE partIDCode = :partIDCode AND sal = :sal");
            $stmt->execute(array(':partIDCode' => $partIDCode, ':sal' => $sal));
            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            // اگر رکورد پیدا شد
            if ($record) {
                // نمایش فرم ویرایش یا حذف
                echo "<h3>رکورد پیدا شد!</h3>";
                echo "<form method='POST' action='process.php'>
                        <input type='hidden' name='action' value='edit'>
                        <input type='hidden' name='partIDCode' value='" . $record['partIDCode'] . "'>
                        <input type='hidden' name='sal' value='" . $record['sal'] . "'>
                        <label>گونه:</label><input type='text' name='species' value='" . $record['species'] . "'><br>
                        <label>نژاد:</label><input type='text' name='breed' value='" . $record['breed'] . "'><br>
                        <label>جنسیت:</label><input type='text' name='gender' value='" . $record['gender'] . "'><br>
                        <label>سن:</label><input type='text' name='age' value='" . $record['age'] . "'><br>
                        <label>فعالیت:</label><input type='text' name='activity' value='" . $record['activity'] . "'><br>
                        <label>تعداد:</label><input type='text' name='quantity' value='" . $record['quantity'] . "'><br>
                        <input type='submit' value='ویرایش'>
                      </form>";

                echo "<form method='POST' action='process.php'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='partIDCode' value='" . $record['partIDCode'] . "'>
                        <input type='hidden' name='sal' value='" . $record['sal'] . "'>
                        <input type='submit' value='حذف'>
                      </form>";
            } else {
                echo "رکوردی با این شناسه یکتا و سال پیدا نشد.";
            }
        } catch (Exception $e) {
            echo "خطا در جستجو: " . $e->getMessage();
        }
    }

    // ویرایش رکورد
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        $partIDCode = $_POST['partIDCode'];
        $sal = $_POST['sal'];
        $species = $_POST['species'];
        $breed = $_POST['breed'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $activity = $_POST['activity'];
        $quantity = $_POST['quantity'];

        try {
            // ویرایش رکورد در دیتابیس
            $stmt = $dbh->prepare("UPDATE animals SET species = :species, breed = :breed, gender = :gender, age = :age, 
                                   activity = :activity, quantity = :quantity WHERE partIDCode = :partIDCode AND sal = :sal");
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
            echo "رکورد با موفقیت ویرایش شد.";
        } catch (Exception $e) {
            echo "خطا در ویرایش رکورد: " . $e->getMessage();
        }
    }

    // حذف رکورد
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $partIDCode = $_POST['partIDCode'];
        $sal = $_POST['sal'];

        try {
            // حذف رکورد از دیتابیس
            $stmt = $dbh->prepare("DELETE FROM animals WHERE partIDCode = :partIDCode AND sal = :sal");
            $stmt->execute(array(':partIDCode' => $partIDCode, ':sal' => $sal));
            echo "رکورد با موفقیت حذف شد.";
        } catch (Exception $e) {
            echo "خطا در حذف رکورد: " . $e->getMessage();
        }
    }
}
?>
