<?php
include("../../lock_expar.php");
include("../../Jalali.php");
include('../../login/config.php');

// دریافت پارامترها
$id_ostan = $_POST['id_ostan'];
$z_sal = $_POST['z_sal'];

// تنظیم هدر برای فایل اکسل
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=report_garden_".$id_ostan."_".$z_sal.".xls");
header("Pragma: no-cache");
header("Expires: 0");

// کوئری اصلی با JOIN (همان کوئری صفحه اصلی)
$main_query = "
SELECT 
    c.city,
    SUM(gp.mah_tol) as kol_mah,
    SUM(CASE WHEN g.no_kesh = '2' THEN gp.mah_tol ELSE 0 END) as mah_dim,
    SUM(CASE WHEN g.no_kesh = '1' THEN gp.mah_tol ELSE 0 END) as mah_abi,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '3' THEN g.id END) as nah_parakande,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '2' THEN g.id END) as nah_makhloot,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '1' THEN g.id END) as nah_sade,
    SUM(gp.tree_b + gp.tree_gb) / 1000 as kol_darakt,
    SUM(gp.tree_gb) / 1000 as darakt_ghbar,
    SUM(gp.tree_b) / 1000 as darakt_bar,
    SUM(gp.s_kesht_b + gp.s_kesht_gb) as kol_kesht,
    SUM(gp.s_kesht_gb) as kesht_ghbar,
    SUM(gp.s_kesht_b) as kesht_bar,
    COUNT(DISTINCT g.id) as kol_garden,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '2' THEN g.id END) as garden_dim,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '1' THEN g.id END) as garden_abi
FROM 
    cityname c
LEFT JOIN 
    Garden g ON c.id_city = g.id_city AND g.id_ostan = :id_ostan AND g.z_sal = :z_sal
LEFT JOIN 
    Garden_prod gp ON g.id = gp.garden_id
WHERE 
    c.id_ostan = :id_ostan
GROUP BY 
    c.id_city, c.city
ORDER BY 
    c.id_city";

$stmt = $dbh->prepare($main_query);
$stmt->execute(array(':id_ostan' => $id_ostan, ':z_sal' => $z_sal));
$city_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// کوئری برای جمع کل استان
$total_query = "
SELECT 
    SUM(gp.mah_tol) as kol_mah,
    SUM(CASE WHEN g.no_kesh = '2' THEN gp.mah_tol ELSE 0 END) as mah_dim,
    SUM(CASE WHEN g.no_kesh = '1' THEN gp.mah_tol ELSE 0 END) as mah_abi,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '3' THEN g.id END) as nah_parakande,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '2' THEN g.id END) as nah_makhloot,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '1' THEN g.id END) as nah_sade,
    SUM(gp.tree_b + gp.tree_gb) / 1000 as kol_darakt,
    SUM(gp.tree_gb) / 1000 as darakt_ghbar,
    SUM(gp.tree_b) / 1000 as darakt_bar,
    SUM(gp.s_kesht_b + gp.s_kesht_gb) as kol_kesht,
    SUM(gp.s_kesht_gb) as kesht_ghbar,
    SUM(gp.s_kesht_b) as kesht_bar,
    COUNT(DISTINCT g.id) as kol_garden,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '2' THEN g.id END) as garden_dim,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '1' THEN g.id END) as garden_abi
FROM 
    Garden g
JOIN 
    Garden_prod gp ON g.id = gp.garden_id
WHERE 
    g.id_ostan = :id_ostan AND g.z_sal = :z_sal";

$stmt = $dbh->prepare($total_query);
$stmt->execute(array(':id_ostan' => $id_ostan, ':z_sal' => $z_sal));
$total_data = $stmt->fetch(PDO::FETCH_ASSOC);

// شروع خروجی HTML که اکسل آن را می‌فهمد
echo '<html dir="rtl">';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
echo '<table border="1">';
echo '<tr><th colspan="18" style="background-color:#999999;color:white">گزارش اطلاعات باغی استان به تفکیک شهرستان</th></tr>';

// سرستون‌ها
echo '<tr style="background-color:#0099CC;color:white">';
echo '<th rowspan="2">شهرستان</th>';
echo '<th colspan="3">میزان تولید (تن)</th>';
echo '<th colspan="3">نحوه کاشت</th>';
echo '<th colspan="3">تعداد درخت (هزار اصله)</th>';
echo '<th colspan="3">سطح زیر کشت (هکتار)</th>';
echo '<th colspan="3">تعداد قطعات باغی (قطعه)</th>';
echo '</tr>';

echo '<tr style="background-color:#0099CC;color:white">';
echo '<th>کل</th><th>دیم</th><th>آبی</th>';
echo '<th>پراکنده</th><th>مخلوط</th><th>ساده</th>';
echo '<th>کل</th><th>غیربارور</th><th>بارور</th>';
echo '<th>کل</th><th>غیربارور</th><th>بارور</th>';
echo '<th>کل</th><th>دیم</th><th>آبی</th>';
echo '</tr>';

// داده‌های شهرستان‌ها
foreach ($city_data as $row) {
    echo '<tr>';
    echo '<td>'.$row['city'].'</td>';
    echo '<td>'.round($row['kol_mah']*1, 1).'</td>';
    echo '<td>'.round($row['mah_dim']*1, 1).'</td>';
    echo '<td>'.round($row['mah_abi']*1, 1).'</td>';
    echo '<td>'.$row['nah_parakande'].'</td>';
    echo '<td>'.$row['nah_makhloot'].'</td>';
    echo '<td>'.$row['nah_sade'].'</td>';
    echo '<td>'.round($row['kol_darakt'], 1).'</td>';
    echo '<td>'.round($row['darakt_ghbar'], 1).'</td>';
    echo '<td>'.round($row['darakt_bar'], 1).'</td>';
    echo '<td>'.round($row['kol_kesht'], 1).'</td>';
    echo '<td>'.round($row['kesht_ghbar'], 1).'</td>';
    echo '<td>'.round($row['kesht_bar'], 1).'</td>';
    echo '<td>'.$row['kol_garden'].'</td>';
    echo '<td>'.$row['garden_dim'].'</td>';
    echo '<td>'.$row['garden_abi'].'</td>';
    echo '</tr>';
}

// جمع کل استان
echo '<tr style="background-color:#FFFFCC;font-weight:bold">';
echo '<td>کل استان</td>';
echo '<td>'.round($total_data['kol_mah']*1, 1).'</td>';
echo '<td>'.round($total_data['mah_dim']*1, 1).'</td>';
echo '<td>'.round($total_data['mah_abi']*1, 1).'</td>';
echo '<td>'.$total_data['nah_parakande'].'</td>';
echo '<td>'.$total_data['nah_makhloot'].'</td>';
echo '<td>'.$total_data['nah_sade'].'</td>';
echo '<td>'.round($total_data['kol_darakt'], 1).'</td>';
echo '<td>'.round($total_data['darakt_ghbar'], 1).'</td>';
echo '<td>'.round($total_data['darakt_bar'], 1).'</td>';
echo '<td>'.round($total_data['kol_kesht'], 1).'</td>';
echo '<td>'.round($total_data['kesht_ghbar'], 1).'</td>';
echo '<td>'.round($total_data['kesht_bar'], 1).'</td>';
echo '<td>'.$total_data['kol_garden'].'</td>';
echo '<td>'.$total_data['garden_dim'].'</td>';
echo '<td>'.$total_data['garden_abi'].'</td>';
echo '</tr>';

echo '</table>';
echo '</html>';
?>