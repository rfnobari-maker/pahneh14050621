<?php
include ('../login/config_utf8.php');

// تعریف تابع برای انتخاب تصادفی یک رکورد از جدول sokh
function getRandomQuote($dbh) {
    // انتخاب رکورد به صورت تصادفی
    $query = "SELECT * FROM sokh ORDER BY RAND() LIMIT 1";
    $stmt = $dbh->prepare($query);
    $stmt->execute();

    // بازگشت نتایج به صورت یک آرایه
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// فراخوانی تابع و دریافت رکورد تصادفی
$Sokh = getRandomQuote($dbh);

// نمایش نتایج
echo $Sokh['sokh'] . '<br>';
echo $Sokh['name'];
?>
