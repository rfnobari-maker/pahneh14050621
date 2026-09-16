<?php
include ('../login/config.php');

// تعریف تابع برای انتخاب تصادفی یک رکورد از جدول sokh
function getRandomQuote($dbh) {
    // انتخاب رکورد به صورت تصادفی
$total = 26708; // چون تعداد ثابت هست، مستقیم می‌نویسیمش
$randomOffset = rand(0, $total - 1); // تولید عدد تصادفی بین 0 و 26707
$query = "SELECT * FROM sokh LIMIT 1 OFFSET :offset";
$stmt = $dbh->prepare($query);
$stmt->bindValue(':offset', $randomOffset, PDO::PARAM_INT);
$stmt->execute();

    // بازگشت نتایج به صورت یک آرایه
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// فراخوانی تابع و دریافت رکورد تصادفی
$Sokh = getRandomQuote($dbh);

// نمایش نتایج
//echo $Sokh['sokh'] . '<br>';
//echo $Sokh['name'];
?>
