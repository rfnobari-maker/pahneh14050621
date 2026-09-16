<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
//$nationalCode = $_GET['nationalCode']; // دریافت کد ملی از پارامتر درخواست GET

// تنظیمات اتصال به دیتابیس
include ('./login/config.php');
    // ساخت پرس و جو با استفاده از prepared statement
    $sql = "SELECT name,username FROM users WHERE username = :nationalCode";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nationalCode', '1380066174');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     echo $row['name'] ; 

    // دریافت نتیجه به صورت آرایه
  // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // برگرداندن نتیجه به صورت JSON
//    header('Content-Type: application/json');
//    echo json_encode($result);
?>
</body>
</html>