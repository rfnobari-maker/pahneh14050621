<?php
include('login/config.php');
include('event.php');

try {
    $dbh->beginTransaction();
    
    // لیست کدها
    $codList = array('170', '172', '174');
    $placeholders = implode(',', array_fill(0, count($codList), '?'));
    
    // مرحله 1: حذف از Agri_prod1403_1404 با شرط
    $sql = "DELETE ap FROM Agri_prod1403_1404 ap 
            WHERE ap.cod_mah IN ($placeholders)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($codList);
    $deletedCount = $stmt->rowCount();
    
    // مرحله 2: به‌روزرسانی و حذف در Agri1403_1404 با JOIN
    // ابتدا رکوردهای t_mah=1 را حذف می‌کنیم
    $sql = "DELETE a FROM Agri1403_1404 a
            INNER JOIN Agri_prod1403_1404 ap ON a.id = ap.Agri_id
            WHERE ap.cod_mah IN ($placeholders) AND a.t_mah = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($codList);
    $deletedFromSecond = $stmt->rowCount();
    
    // سپس t_mah>1 را به‌روزرسانی می‌کنیم
    $sql = "UPDATE Agri1403_1404 a
            INNER JOIN Agri_prod1403_1404 ap ON a.id = ap.Agri_id
            SET a.t_mah = a.t_mah - 1
            WHERE ap.cod_mah IN ($placeholders) AND a.t_mah > 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($codList);
    $updatedCount = $stmt->rowCount();
    
    $dbh->commit();
    
    alert("عملیات با موفقیت انجام شد: 
           حذف از جدول اول: $deletedCount
           حذف از جدول دوم: $deletedFromSecond
           به‌روزرسانی: $updatedCount");
           
} catch (PDOException $e) {
    $dbh->rollBack();
    alert("خطا: " . $e->getMessage());
    error_log("Error: " . $e->getMessage());
}
?>