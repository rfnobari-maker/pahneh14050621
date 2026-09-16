<?php
session_start();
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../side_menu1.php');
date_default_timezone_set('Asia/Tehran');

// ============================================================
// دریافت فیلترها از متد POST یا SESSION
// ============================================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ذخیره فیلترها در Session
    $_SESSION['admin_filter_id_ostan'] = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
    $_SESSION['admin_filter_z_sal'] = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    $_SESSION['admin_filter_cod_qroup'] = isset($_POST['cod_qroup']) ? $_POST['cod_qroup'] : '';
    $_SESSION['admin_filter_product_cod'] = isset($_POST['product_cod']) ? $_POST['product_cod'] : '';
    $_SESSION['admin_filter_status'] = isset($_POST['status']) ? $_POST['status'] : '';
}

// خواندن فیلترها از Session (اگر POST وجود نداشت)
$filter_id_ostan = isset($_SESSION['admin_filter_id_ostan']) ? $_SESSION['admin_filter_id_ostan'] : '';
$filter_z_sal = isset($_SESSION['admin_filter_z_sal']) ? $_SESSION['admin_filter_z_sal'] : '';
$filter_cod_qroup = isset($_SESSION['admin_filter_cod_qroup']) ? $_SESSION['admin_filter_cod_qroup'] : '';
$filter_product_cod = isset($_SESSION['admin_filter_product_cod']) ? $_SESSION['admin_filter_product_cod'] : '';
$filter_status = isset($_SESSION['admin_filter_status']) ? $_SESSION['admin_filter_status'] : '';

// ============================================================
// صفحه‌بندی
// ============================================================
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 20;
$start = ($page - 1) * $limit;

// ============================================================
// ساخت شرط WHERE بر اساس فیلترها
// ============================================================
$where_conditions = array();
$params = array();

if (!empty($filter_id_ostan)) {
    $where_conditions[] = "r.id_ostan = ?";
    $params[] = $filter_id_ostan;
}
if (!empty($filter_z_sal)) {
    $where_conditions[] = "r.z_sal = ?";
    $params[] = $filter_z_sal;
}
if (!empty($filter_cod_qroup)) {
    $where_conditions[] = "r.cod_qroup = ?";
    $params[] = $filter_cod_qroup;
}
if (!empty($filter_product_cod)) {
    $where_conditions[] = "r.product_cod = ?";
    $params[] = $filter_product_cod;
}
if (!empty($filter_status)) {
    $where_conditions[] = "r.status = ?";
    $params[] = $filter_status;
}

$where_clause = (!empty($where_conditions)) ? "WHERE " . implode(" AND ", $where_conditions) : "";

// ============================================================
// کوئری شمارش
// ============================================================
$query_count = "SELECT COUNT(DISTINCT r.id) FROM Agri_ab_request r
                LEFT JOIN ostanname o ON r.id_ostan = o.id_ostan
                LEFT JOIN product_z p ON r.cod_qroup = p.group_cod
                $where_clause";
$stmt_count = $dbh->prepare($query_count);
$stmt_count->execute($params);
$total_rows = $stmt_count->fetchColumn();
$total_pages = ceil($total_rows / $limit);

// ============================================================
// دریافت لیست درخواست‌ها با JOIN و LIMIT
// ============================================================
$query = "SELECT DISTINCT r.*, o.ostan, p.group_name 
          FROM Agri_ab_request r
          LEFT JOIN ostanname o ON r.id_ostan = o.id_ostan
          LEFT JOIN product_z p ON r.cod_qroup = p.group_cod
          $where_clause
          ORDER BY r.created_at DESC, r.id DESC
          LIMIT " . (int)$start . ", " . (int)$limit;

$stmt = $dbh->prepare($query);
$stmt->execute($params);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// دریافت لیست استان‌ها
// ============================================================
$query_ostan = "SELECT id_ostan, ostan FROM ostanname ORDER BY ostan ASC";
$stmt_ostan = $dbh->prepare($query_ostan);
$stmt_ostan->execute();


$ostan_list = $stmt_ostan->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// دریافت لیست گروه‌ها
// ============================================================
$query_groups = "SELECT DISTINCT group_cod, group_name FROM product_z ORDER BY group_name ASC";
$stmt_groups = $dbh->prepare($query_groups);
$stmt_groups->execute();
$groups_list = $stmt_groups->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// دریافت لیست محصولات بر اساس گروه انتخاب شده
// ============================================================
$products_list = array();
if (!empty($filter_cod_qroup)) {
    $query_prod = "SELECT product_cod, product_name FROM product_z WHERE group_cod = ? ORDER BY product_name ASC";
    $stmt_prod = $dbh->prepare($query_prod);
    $stmt_prod->execute(array($filter_cod_qroup));
    $products_list = $stmt_prod->fetchAll(PDO::FETCH_ASSOC);
}

// ============================================================
// وضعیت‌ها
// ============================================================
$status_labels = array(
    'pending' => 'در انتظار تأیید',
    'reviewing' => 'در حال بررسی',
    'approved' => 'تأیید/تعدیل شده',
    'rejected' => 'رد شده'
);

$status_colors = array(
    'pending' => '#f57c00',
    'reviewing' => '#1976d2',
    'approved' => '#2e7d32',
    'rejected' => '#c62828'
);

$status_icons = array(
    'pending' => '🕒',
    'reviewing' => '🔄',
    'approved' => '✅',
    'rejected' => '❌'
);
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR" xml:lang="fa">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <style type="text/css">
        body { text-align: right; font-family: Tahoma; direction:rtl }
        
        .admin-box {
            width: 95%;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #09C;
            border-radius: 15px;
            background: #f9f9f9;
        }
        
        .admin-title {
            font-size: 20px;
            font-weight: bold;
            color: #003366;
            border-bottom: 2px solid #006699;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .filter-box {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            margin-bottom: 20px;
        }
        .filter-box table {
            width: 100%;
        }
        .filter-box td {
            padding: 5px 8px;
        }
        .filter-box .filter-label {
            font-weight: bold;
            color: #003366;
            font-size: 13px;
        }
        .filter-box .filter-select {
            width: 100%;
            height: 35px;
            padding: 5px;
            font-family: Tahoma;
            font-size: 13px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .filter-box .filter-btn {
            padding: 8px 25px;
            background: #006699;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 14px;
        }
        .filter-box .filter-btn:hover {
            background: #004d80;
        }
        .filter-box .reset-btn {
            padding: 8px 25px;
            background: #999;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .filter-box .reset-btn:hover {
            background: #777;
        }
        .filter-box .excel-btn {
            padding: 8px 25px;
            background: #1e7e34;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .filter-box .excel-btn:hover {
            background: #16632a;
        }
        .filter-box .btn-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
        }
        
        .request-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Tahoma, Arial, sans-serif;
            font-size: 13px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .request-table th {
            background: #006699;
            color: #fff;
            padding: 10px 8px;
            text-align: center;
            font-size: 13px;
        }
        .request-table td {
            padding: 10px 8px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }
        .request-table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .request-table tr:hover {
            background: #e6f2ff;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            color: #fff;
        }
        
        .manage-link {
            color: #006699;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 12px;
            border: 1px solid #006699;
            border-radius: 4px;
        }
        .manage-link:hover {
            background: #006699;
            color: #fff;
        }
        
        .empty-row {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 16px;
        }
        
        .result-count {
            font-size: 13px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .btn-back {
            padding: 8px 20px;
            background: #006699;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back:hover {
            background: #004d80;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 20px;
        }
        .pagination a, .pagination span {
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
            font-size: 13px;
        }
        .pagination a:hover {
            background: #e6f2ff;
        }
        .pagination .active {
            background: #006699;
            color: #fff;
            border-color: #006699;
        }
        
        @media (max-width: 900px) {
            .request-table { font-size: 11px; }
            .request-table th, .request-table td { padding: 6px 4px; }
            .filter-box table td { display: block; width: 100%; }
            .admin-box { padding: 10px; }
            .filter-box .btn-group { flex-direction: column; align-items: stretch; }
            .filter-box .btn-group button,
            .filter-box .btn-group a { text-align: center; }
        }
    </style>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script>
    $(document).ready(function() {
        // بارگذاری محصولات هنگام تغییر گروه

        $('#cod_qroup').on('change', function() {
            var group_cod = $(this).val();
            if (group_cod) {
                $.ajax({
                    url: 'get_products_ajax.php',
                    type: 'POST',
                    data: {group_cod: group_cod},
                    dataType: 'json',
                    success: function(data) {
                        var $productSelect = $('#product_cod');
                        $productSelect.empty();
                        $productSelect.append('<option value="">همه محصولات</option>');
                        $.each(data, function(key, value) {
                            $productSelect.append('<option value="' + value.product_cod + '">' + value.product_name + '</option>');
                        });
                    }
                });
            } else {
                $('#product_cod').empty().append('<option value="">همه محصولات</option>');
            }
        });
    });
    
    function exportExcel() {
        // دریافت مقادیر فیلترها از فرم
        var id_ostan = document.getElementById('id_ostan').value;
        var z_sal = document.getElementById('z_sal').value;
        var cod_qroup = document.getElementById('cod_qroup').value;
        var product_cod = document.getElementById('product_cod').value;
        var status = document.getElementById('status').value;
        
        // ساخت URL با پارامترها
        var url = 'export_requests_xls.php?';
        url += 'id_ostan=' + encodeURIComponent(id_ostan);
        url += '&z_sal=' + encodeURIComponent(z_sal);
        url += '&cod_qroup=' + encodeURIComponent(cod_qroup);
        url += '&product_cod=' + encodeURIComponent(product_cod);
        url += '&status=' + encodeURIComponent(status);
        
        // باز کردن در تب جدید
        window.open(url, '_blank');
    }
    </script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("../header.php"); ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" valign="middle">
        <!-- ============================================================ -->
        <!-- محتوای اصلی -->
        <!-- ============================================================ -->
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
                <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                <td width="840">
                   
                    <div class="admin-box">
                        <div class="admin-title">📋 مدیریت درخواست‌های تغییر الگوی کشت</div>
                        
                        <!-- ============================================================ -->
                        <!-- فیلترها با متد POST -->
                        <!-- ============================================================ -->
                        <form method="post" action="">
                            <div class="filter-box">
                                <table border="0" cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td width="12%"><span class="filter-label">استان:</span></td>
                                        <td width="20%">
                                            <select name="id_ostan" class="filter-select" id="id_ostan">
                                                <option value="">همه استان‌ها</option>
                                                <?php foreach($ostan_list as $ostan): ?>
                                                <option value="<?php echo $ostan['id_ostan']; ?>" <?php if($filter_id_ostan == $ostan['id_ostan']) echo 'selected="selected"'; ?>>
                                                    <?php echo htmlspecialchars($ostan['ostan']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td width="12%"><span class="filter-label">سال زراعی:</span></td>
                                        <td width="20%">
                                            <select name="z_sal" class="filter-select" id="z_sal">
                                                <option value="">همه سال‌ها</option>
                                                <option value="1405-1406" <?php if($filter_z_sal == '1405-1406') echo 'selected="selected"'; ?>>1405-1406</option>
                                                <option value="1404-1405" <?php if($filter_z_sal == '1404-1405') echo 'selected="selected"'; ?>>1404-1405</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="filter-label">گروه محصول:</span></td>
                                        <td>
                                            <select name="cod_qroup" class="filter-select" id="cod_qroup">
                                                <option value="">همه گروه‌ها</option>
                                                <?php foreach($groups_list as $group): ?>
                                                <option value="<?php echo $group['group_cod']; ?>" <?php if($filter_cod_qroup == $group['group_cod']) echo 'selected="selected"'; ?>>
                                                    <?php echo htmlspecialchars($group['group_name']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td><span class="filter-label">محصول:</span></td>
                                        <td>
                                            <select name="product_cod" class="filter-select" id="product_cod">
                                                <option value="">همه محصولات</option>
                                                <?php foreach($products_list as $product): ?>
                                                <option value="<?php echo $product['product_cod']; ?>" <?php if($filter_product_cod == $product['product_cod']) echo 'selected="selected"'; ?>>
                                                    <?php echo htmlspecialchars($product['product_name']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="filter-label">وضعیت:</span></td>
                                        <td>
                                            <select name="status" class="filter-select" id="status">
                                                <option value="">همه وضعیت‌ها</option>
                                                <option value="pending" <?php if($filter_status == 'pending') echo 'selected="selected"'; ?>>در انتظار تأیید</option>
                                                <option value="reviewing" <?php if($filter_status == 'reviewing') echo 'selected="selected"'; ?>>در حال بررسی</option>
                                                <option value="approved" <?php if($filter_status == 'approved') echo 'selected="selected"'; ?>>تأیید/تعدیل شده</option>
                                                <option value="rejected" <?php if($filter_status == 'rejected') echo 'selected="selected"'; ?>>رد شده</option>
                                            </select>
                                        </td>
                                        <td colspan="2">
                                            <div class="btn-group">
                                                <button type="submit" class="filter-btn">🔍 اعمال فیلتر</button>
                                                <a href="Agri_ab_request_admin.php?reset=1" class="reset-btn">🔄 حذف فیلتر</a>
                                                
                                                <!-- دکمه خروجی اکسل -->
                                                <button type="button" class="excel-btn" onclick="exportExcel()">
                                                    📊 خروجی اکسل
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                        
                        <!-- ============================================================ -->
                        <!-- تعداد نتایج -->
                        <!-- ============================================================ -->
                        <div class="result-count">
                            تعداد کل درخواست‌ها: <strong><?php echo number_format($total_rows); ?></strong>
                            <?php if ($total_pages > 1): ?>
                            <span style="margin-right:15px;">صفحه <?php echo $page; ?> از <?php echo $total_pages; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- ============================================================ -->
                        <!-- جدول درخواست‌ها -->
                        <!-- ============================================================ -->
                        <?php if (count($requests) > 0): ?>
                        <table class="request-table">
                            <thead>
                                <tr>
                                    <th width="4%">#</th>
                                    <th width="10%">استان</th>
                                    <th width="10%">تاریخ ثبت</th>
                                    <th width="15%">محصول</th>
                                    <th width="12%">گروه</th>
                                    <th width="10%">سال</th>
                                    <th width="12%">وضعیت</th>
                                    <th width="12%">مدیریت</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter = $start + 1; foreach($requests as $row): ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo htmlspecialchars($row['ostan']); ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['group_name']); ?></td>
                                    <td><?php echo $row['z_sal']; ?></td>
                                    <td>
                                        <span class="status-badge" style="background:<?php echo $status_colors[$row['status']]; ?>;">
                                            <?php echo $status_icons[$row['status']] . ' ' . $status_labels[$row['status']]; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="Agri_ab_request_admin_detail.php?id=<?php echo $row['id']; ?>&page=<?php echo $page; ?>&id_ostan=<?php echo urlencode($filter_id_ostan); ?>&z_sal=<?php echo urlencode($filter_z_sal); ?>&cod_qroup=<?php echo urlencode($filter_cod_qroup); ?>&product_cod=<?php echo urlencode($filter_product_cod); ?>&status=<?php echo urlencode($filter_status); ?>" class="manage-link">
                                            ⚙️ مدیریت
                                        </a>
                                    </td>
                                </tr>
                                <?php $counter++; endforeach; ?>
                            </tbody>
                        </table>
                        
                        <!-- ============================================================ -->
                        <!-- صفحه‌بندی -->
                        <!-- ============================================================ -->
                        <?php if ($total_pages > 1): ?>
                        <div class="pagination">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?>">‹ قبلی</a>
                            <?php endif; ?>
                            
                            <?php
                            $start_page = max(1, $page - 3);
                            $end_page = min($total_pages, $page + 3);
                            
                            if ($start_page > 1): ?>
                                <a href="?page=1">1</a>
                                <?php if ($start_page > 2): ?>
                                    <span>...</span>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <?php if ($i == $page): ?>
                                    <span class="active"><?php echo $i; ?></span>
                                <?php else: ?>
                                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                <?php endif; ?>
                            <?php endfor; ?>
                            
                            <?php if ($end_page < $total_pages): ?>
                                <?php if ($end_page < $total_pages - 1): ?>
                                    <span>...</span>
                                <?php endif; ?>
                                <a href="?page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a>
                            <?php endif; ?>
                            
                            <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?>">بعدی ›</a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php else: ?>
                        <div class="empty-row">
                            <div style="font-size:48px; margin-bottom:10px;">📭</div>
                            <div>هیچ درخواستی با این فیلترها یافت نشد.</div>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                    
                </td>
            </tr>
        </table>
        <!-- ============================================================ -->
        <!-- پایان محتوای اصلی -->
        <!-- ============================================================ -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
      <?php include('../../footer.php'); ?>
    </td>
  </tr>
</table>
</body>
</html>