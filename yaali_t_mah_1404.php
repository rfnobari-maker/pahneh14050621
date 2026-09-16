<?php
// کد استان شهرستان مرکز و مروج بهره برداران شهر 
include ('login/config.php');
include ('event.php');

// استفاده از یک کوئری JOIN برای کاهش تعداد کوئری‌ها
$query = "SELECT a.id, a.t_mah, COUNT(p.Agri_id) as prod_count 
          FROM Agri1403_1404 a 
          LEFT JOIN Agri_prod1403_1404 p ON a.id = p.Agri_id 
          GROUP BY a.id, a.t_mah 
          HAVING a.t_mah != COUNT(p.Agri_id) OR a.t_mah IS NULL";

$stmt = $dbh->prepare($query);
$stmt->execute();

// آماده‌سازی کوئری UPDATE برای استفاده مجدد
$update_query = "UPDATE Agri1403_1404 SET t_mah = ? WHERE id = ?";
$update_stmt = $dbh->prepare($update_query);

$updated_count = 0;

foreach($stmt as $row) {
    $id = $row['id'];
    $count_id = (int)$row['prod_count']; // تبدیل به int برای اطمینان
    
    // اجرای UPDATE با استفاده از statement آماده شده
    $update_stmt->execute(array($count_id, $id));
    $updated_count++;
}

// نمایش پیام با تعداد رکوردهای به‌روز شده
alert('تعداد ' . $updated_count . ' رکورد به‌روز شد');

// بهینه‌سازی بیشتر: اگر تعداد رکوردها زیاد است، می‌توانید از تراکنش استفاده کنید
// $dbh->beginTransaction();
// ... کدهای UPDATE ...
// $dbh->commit();
?>