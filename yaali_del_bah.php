<?php
include('event.php');
include('login/config.php');

// دریافت مقادیر bah_cod_m از جدول bah11
$query = "SELECT bah_cod_m FROM bah11 WHERE 1";
$stmt = $dbh->prepare($query);
$stmt->execute();

// لیست جداول
$tables = array(
    "bah", "bah20", "Agri1397_1398", "Agri1398_1399", "Agri1399_1400", 
    "Agri1400_1401", "Agri1401_1402", "Agri1402_1403", "Agri1403_1404",
    "Agri_prod1397_1398", "Agri_prod1398_1399", "Agri_prod1399_1400", 
    "Agri_prod1400_1401", "Agri_prod1401_1402", "Agri_prod1402_1403", 
    "Agri_prod1403_1404", "Garden", "Garden_prod", "Greenhous", 
    "Greenhous_prod", "Greenprod_annual", "Aquatic", "bee", 
    "unknown_bee", "Vege", "Vege_prod", "Mushroom", "Mushroom_prod"
);

// حلقه برای هر bah_cod_m
foreach ($stmt as $row) {
    $bah_cod_m_11 = $row['bah_cod_m'];

    // حلقه برای حذف رکورد از هر جدول
    foreach ($tables as $table) {
        $query = "DELETE FROM $table WHERE bah_cod_m = ?";
        $q = $dbh->prepare($query);
        $q->execute(array($bah_cod_m_11));
    }
}

$dbh = null;

// نمایش پیغام پایان
echo "<script>alert('تمام عملیات با موفقیت انجام شد.');</script>";
?>
