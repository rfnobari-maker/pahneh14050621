<?php
/**
 * export_requests_xls.php - خروجی Excel از درخواست‌های محصولات زراعی
 * با تمام ستون‌های موجود در جدول - بدون نیاز به کتابخانه
 */

// ============================================================
// تنظیمات خطا برای دیباگ
// ============================================================
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ============================================================
// احراز هویت و اتصال دیتابیس
// ============================================================
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

// ============================================================
// بررسی اتصال دیتابیس
// ============================================================
if (!isset($dbh) || $dbh == null) {
    die('خطا: اتصال به دیتابیس برقرار نیست.');
}

// ============================================================
// تنظیم هدر برای دانلود فایل Excel
// ============================================================
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename="agri_requests_' . date('Y-m-d') . '.xls"');
header('Cache-Control: max-age=0');
header('Pragma: public');

// ============================================================
// دریافت پارامترها از GET
// ============================================================
$filter_id_ostan = isset($_GET['id_ostan']) ? $_GET['id_ostan'] : '';
$filter_z_sal = isset($_GET['z_sal']) ? $_GET['z_sal'] : '';
$filter_cod_qroup = isset($_GET['cod_qroup']) ? $_GET['cod_qroup'] : '';
$filter_product_cod = isset($_GET['product_cod']) ? $_GET['product_cod'] : '';
$filter_status = isset($_GET['status']) ? $_GET['status'] : '';

// ============================================================
// ساخت شرط WHERE بر اساس فیلترها
// ============================================================
$where_conditions = array();
$params = array();

if (!empty($filter_id_ostan)) {
    $where_conditions[] = "id_ostan = ?";
    $params[] = $filter_id_ostan;
}
if (!empty($filter_z_sal)) {
    $where_conditions[] = "z_sal = ?";
    $params[] = $filter_z_sal;
}
if (!empty($filter_cod_qroup)) {
    $where_conditions[] = "cod_qroup = ?";
    $params[] = $filter_cod_qroup;
}
if (!empty($filter_product_cod)) {
    $where_conditions[] = "product_cod = ?";
    $params[] = $filter_product_cod;
}
if (!empty($filter_status)) {
    $where_conditions[] = "status = ?";
    $params[] = $filter_status;
}

$where_clause = (!empty($where_conditions)) ? "WHERE " . implode(" AND ", $where_conditions) : "";

// ============================================================
// دریافت لیست درخواست‌ها (فقط از جدول Agri_ab_request)
// ============================================================
$query = "SELECT * FROM Agri_ab_request $where_clause ORDER BY created_at DESC, id DESC";

$stmt = $dbh->prepare($query);
$stmt->execute($params);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rowCount = count($requests);

// ============================================================
// شروع خروجی HTML (برای اکسل)
// ============================================================
echo '<html>';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo '<style>
    body { 
        font-family: Tahoma; 
        direction: ltr; 
        font-size: 11px;
        margin: 10px;
    }
    table { 
        border-collapse: collapse; 
        width: 100%; 
        margin-top: 5px;
    }
    th { 
        background: #006699; 
        color: #ffffff; 
        padding: 6px 4px; 
        border: 1px solid #333;
        font-size: 11px;
        text-align: center;
    }
    td { 
        padding: 4px 3px; 
        border: 1px solid #999;
        font-size: 10px;
    }
    .number { 
        text-align: center; 
        direction: ltr;
        mso-number-format: "@";
    }
    .text-left { 
        text-align: left; 
    }
    .text-right { 
        text-align: right; 
    }
    .row-odd {
        background-color: #f9f9f9;
    }
    .row-even {
        background-color: #ffffff;
    }
</style>';
echo '</head>';
echo '<body>';

// ============================================================
// جدول اصلی با نام ستون‌های انگلیسی
// ============================================================
if ($rowCount > 0) {
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>#</th>';
    echo '<th>id</th>';
    echo '<th>id_ostan</th>';
    echo '<th>z_sal</th>';
    echo '<th>cod_qroup</th>';
    echo '<th>product_cod</th>';
    echo '<th>product_name</th>';
    echo '<th>current_s_abi</th>';
    echo '<th>current_s_dem</th>';
    echo '<th>current_t_abi</th>';
    echo '<th>current_t_dem</th>';
    echo '<th>current_a_abi</th>';
    echo '<th>current_a_dem</th>';
    echo '<th>request_s_abi</th>';
    echo '<th>request_s_dem</th>';
    echo '<th>request_a_abi</th>';
    echo '<th>request_a_dem</th>';
    echo '<th>calculated_t_abi</th>';
    echo '<th>calculated_t_dem</th>';
    echo '<th>admin_s_abi</th>';
    echo '<th>admin_s_dem</th>';
    echo '<th>admin_a_abi</th>';
    echo '<th>admin_a_dem</th>';
    echo '<th>reason</th>';
    echo '<th>attachment</th>';
    echo '<th>status</th>';
    echo '<th>admin_note</th>';
    echo '<th>created_by</th>';
    echo '<th>created_at</th>';
    echo '<th>updated_at</th>';
    echo '<th>approved_at</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    $r = 1;
    foreach ($requests as $row) {
        $class = ($r % 2 == 0) ? 'row-even' : 'row-odd';
        
        echo '<tr class="' . $class . '">';
        echo '<td class="number">' . $r . '</td>';
        echo '<td class="number">' . $row['id'] . '</td>';
        // چهار فیلد زیر با mso-number-format:"@" به صورت متن نمایش داده می‌شوند
        echo '<td class="number">' . htmlspecialchars($row['id_ostan']) . '</td>';
        echo '<td class="number">' . htmlspecialchars($row['z_sal']) . '</td>';
        echo '<td class="number">' . htmlspecialchars($row['cod_qroup']) . '</td>';
        echo '<td class="number">' . htmlspecialchars($row['product_cod']) . '</td>';
        echo '<td class="text-left">' . htmlspecialchars($row['product_name']) . '</td>';
        echo '<td class="number">' . number_format($row['current_s_abi'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['current_s_dem'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['current_t_abi'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['current_t_dem'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['current_a_abi'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['current_a_dem'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['request_s_abi'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['request_s_dem'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['request_a_abi'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['request_a_dem'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['calculated_t_abi'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['calculated_t_dem'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['admin_s_abi'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['admin_s_dem'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['admin_a_abi'], 2) . '</td>';
        echo '<td class="number">' . number_format($row['admin_a_dem'], 2) . '</td>';
        echo '<td class="text-left">' . htmlspecialchars($row['reason']) . '</td>';
        echo '<td class="text-left">' . htmlspecialchars($row['attachment']) . '</td>';
        echo '<td class="number">' . htmlspecialchars($row['status']) . '</td>';
        echo '<td class="text-left">' . htmlspecialchars($row['admin_note']) . '</td>';
        echo '<td class="number">' . htmlspecialchars($row['created_by']) . '</td>';
        echo '<td class="number">' . htmlspecialchars($row['created_at']) . '</td>';
        echo '<td class="number">' . htmlspecialchars($row['updated_at']) . '</td>';
        echo '<td class="number">' . htmlspecialchars($row['approved_at']) . '</td>';
        echo '</tr>';
        
        $r++;
    }
    
    echo '</tbody>';
    echo '</table>';
    
} else {
    echo '<p style="text-align:center; color:red; font-size:14px;">No records found</p>';
}

echo '</body>';
echo '</html>';
exit;
?>