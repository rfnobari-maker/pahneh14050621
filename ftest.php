<?php

// ارتباط با دیتابیس MySQL با استفاده از PDO
$servername = "localhost";
$username = "eagri_upahneh";
$password = "Reza9147857121";
$dbname = "farsi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->exec('set names utf8');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // دریافت اطلاعات از جدول users
    $stmt = $conn->prepare("SELECT * FROM test WHERE id=1");
    $stmt->execute();

    // نمایش اطلاعات در فرم PHP
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
        echo 'نام: ' . $row["name"]. '<br>';
        echo "ایمیل: " . $row["email"]. "<br>";

    }
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

    $stmt = $conn->prepare("INSERT INTO test (name, email, message) VALUES (:value1, :value2, :value3)");
    $stmt->bindParam(':value1', $value1);
    $stmt->bindParam(':value2', $value2);
    $stmt->bindParam(':value3', $value3);

    // ورودی‌ها را تعیین کنید
    $value1 = "غلامرضا";
    $value2 = "test@test.com";
    $value3 = "من دارم فارسی  ذخیره میکنم";

    // اجرای prepared statement
    $stmt->execute();

    echo "رکورد با موفقیت درج شد.";





$conn = null;
?>
