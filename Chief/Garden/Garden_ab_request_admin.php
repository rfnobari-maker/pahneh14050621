<?php
session_start();
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
date_default_timezone_set('Asia/Tehran');

// ============================================================
// بازیابی فیلترها از SESSION در صورت وجود
// ============================================================
if (!isset($_POST['id_ostan']) && !isset($_POST['z_sal']) && !isset($_POST['group_cod']) && !isset($_POST['product_cod']) && !isset($_POST['status'])) {
    // اگر هیچ فیلتری ارسال نشده، از SESSION بخوان
    $filter_id_ostan = isset($_SESSION['garden_admin_filter']['id_ostan']) ? $_SESSION['garden_admin_filter']['id_ostan'] : '';
    $filter_z_sal = isset($_SESSION['garden_admin_filter']['z_sal']) ? $_SESSION['garden_admin_filter']['z_sal'] : '';
    $filter_group_cod = isset($_SESSION['garden_admin_filter']['group_cod']) ? $_SESSION['garden_admin_filter']['group_cod'] : '';
    $filter_product_cod = isset($_SESSION['garden_admin_filter']['product_cod']) ? $_SESSION['garden_admin_filter']['product_cod'] : '';
    $filter_status = isset($_SESSION['garden_admin_filter']['status']) ? $_SESSION['garden_admin_filter']['status'] : '';
} else {
    // دریافت فیلترها از متد POST
    $filter_id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
    $filter_z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    $filter_group_cod = isset($_POST['group_cod']) ? $_POST['group_cod'] : '';
    $filter_product_cod = isset($_POST['product_cod']) ? $_POST['product_cod'] : '';
    $filter_status = isset($_POST['status']) ? $_POST['status'] : '';
}

// ============================================================
// ذخیره فیلترها در SESSION
// ============================================================
$_SESSION['garden_admin_filter'] = array(
    'id_ostan' => $filter_id_ostan,
    'z_sal' => $filter_z_sal,
    'group_cod' => $filter_group_cod,
    'product_cod' => $filter_product_cod,
    'status' => $filter_status
);

// ============================================================
// صفحه‌بندی
// ============================================================
$limit = 20;
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
if ($page < 1) $page = 1;
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
if (!empty($filter_group_cod)) {
    $where_conditions[] = "r.group_cod = ?";
    $params[] = $filter_group_cod;
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
// دریافت تعداد کل رکوردها
// ============================================================
$query_count = "SELECT COUNT(DISTINCT r.id) FROM Garden_ab_request r
                LEFT JOIN ostanname o ON r.id_ostan = o.id_ostan
                LEFT JOIN product_b p ON r.group_cod = p.group_cod
                $where_clause";
$stmt_count = $dbh->prepare($query_count);
$stmt_count->execute($params);
$total_rows = $stmt_count->fetchColumn();
$total_pages = ceil($total_rows / $limit);

// ============================================================
// دریافت لیست استان‌ها
// ============================================================
$query_ostan = "SELECT id_ostan, ostan FROM ostanname ORDER BY ostan ASC";
$stmt_ostan = $dbh->prepare($query_ostan);
$stmt_ostan->execute();
$ostan_list = $stmt_ostan->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// دریافت لیست گروه‌ها (از جدول product_b)
// ============================================================
$query_groups = "SELECT DISTINCT group_cod, group_name FROM product_b ORDER BY group_name ASC";
$stmt_groups = $dbh->prepare($query_groups);
$stmt_groups->execute();
$groups_list = $stmt_groups->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// دریافت لیست محصولات بر اساس گروه انتخاب شده
// ============================================================
$products_list = array();
if (!empty($filter_group_cod)) {
    $query_prod = "SELECT product_cod, product_name FROM product_b WHERE group_cod = ? ORDER BY product_name ASC";
    $stmt_prod = $dbh->prepare($query_prod);
    $stmt_prod->execute(array($filter_group_cod));
    $products_list = $stmt_prod->fetchAll(PDO::FETCH_ASSOC);
}

// ============================================================
// دریافت لیست درخواست‌ها با JOIN و LIMIT
// ============================================================
$query = "SELECT DISTINCT r.*, o.ostan, p.group_name 
          FROM Garden_ab_request r
          LEFT JOIN ostanname o ON r.id_ostan = o.id_ostan
          LEFT JOIN product_b p ON r.group_cod = p.group_cod
          $where_clause
          ORDER BY r.created_at DESC, r.id DESC
          LIMIT " . (int)$start . ", " . (int)$limit;

$stmt = $dbh->prepare($query);
$stmt->execute($params);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

// ============================================================
// تابع ساخت فرم صفحه‌بندی (اصلاح شده)
// ============================================================
function buildPaginationLink($page, $text, $class = '') {
    // دریافت فیلترها از POST یا SESSION
    $id_ostan = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
    if (empty($id_ostan) && isset($_SESSION['garden_admin_filter']['id_ostan'])) {
        $id_ostan = $_SESSION['garden_admin_filter']['id_ostan'];
    }
    
    $z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
    if (empty($z_sal) && isset($_SESSION['garden_admin_filter']['z_sal'])) {
        $z_sal = $_SESSION['garden_admin_filter']['z_sal'];
    }
    
    $group_cod = isset($_POST['group_cod']) ? $_POST['group_cod'] : '';
    if (empty($group_cod) && isset($_SESSION['garden_admin_filter']['group_cod'])) {
        $group_cod = $_SESSION['garden_admin_filter']['group_cod'];
    }
    
    $product_cod = isset($_POST['product_cod']) ? $_POST['product_cod'] : '';
    if (empty($product_cod) && isset($_SESSION['garden_admin_filter']['product_cod'])) {
        $product_cod = $_SESSION['garden_admin_filter']['product_cod'];
    }
    
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    if (empty($status) && isset($_SESSION['garden_admin_filter']['status'])) {
        $status = $_SESSION['garden_admin_filter']['status'];
    }
    
    echo '<form method="post" style="display:inline;">';
    echo '<input type="hidden" name="id_ostan" value="' . htmlspecialchars($id_ostan) . '">';
    echo '<input type="hidden" name="z_sal" value="' . htmlspecialchars($z_sal) . '">';
    echo '<input type="hidden" name="group_cod" value="' . htmlspecialchars($group_cod) . '">';
    echo '<input type="hidden" name="product_cod" value="' . htmlspecialchars($product_cod) . '">';
    echo '<input type="hidden" name="status" value="' . htmlspecialchars($status) . '">';
    echo '<input type="hidden" name="page" value="' . intval($page) . '">';
    echo '<button type="submit" class="' . htmlspecialchars($class) . '">' . htmlspecialchars($text) . '</button>';
    echo '</form>';
}
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
        }
        .filter-box .reset-btn:hover {
            background: #777;
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
        
        .pagination {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 20px;
        }
        .pagination form {
            display: inline;
        }
        .pagination button {
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #fff;
            text-decoration: none;
            color: #333;
            font-size: 13px;
            cursor: pointer;
            font-family: Tahoma;
        }
        .pagination button:hover {
            background: #e6f2ff;
        }
        .pagination .active {
            background: #006699;
            color: #fff;
            border-color: #006699;
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
        
        @media (max-width: 900px) {
            .request-table { font-size: 11px; }
            .request-table th, .request-table td { padding: 6px 4px; }
            .filter-box table td { display: block; width: 100%; }
            .admin-box { padding: 10px; }
        }
    </style>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    <script>
    $(document).ready(function() {
        // بارگذاری محصولات هنگام تغییر گروه
        $('#group_cod').on('change', function() {
            var group_cod = $(this).val();
            if (group_cod) {
                $.ajax({
                    url: 'get_garden_products_ajax.php',
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
                        <div class="admin-title">🌳 مدیریت درخواست‌های تغییر الگوی کشت باغی</div>
                        
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
                                        <td width="12%"><span class="filter-label">سال:</span></td>
                                        <td width="20%">
                                            <select name="z_sal" class="filter-select" id="z_sal">
                                                <option value="">همه سال‌ها</option>
                                                <option value="1405" <?php if($filter_z_sal == '1405') echo 'selected="selected"'; ?>>1405</option>
                                                <option value="1404" <?php if($filter_z_sal == '1404') echo 'selected="selected"'; ?>>1404</option>
                                                <option value="1403" <?php if($filter_z_sal == '1403') echo 'selected="selected"'; ?>>1403</option>
                                                <option value="1402" <?php if($filter_z_sal == '1402') echo 'selected="selected"'; ?>>1402</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="filter-label">گروه محصول:</span></td>
                                        <td>
                                            <select name="group_cod" class="filter-select" id="group_cod">
                                                <option value="">همه گروه‌ها</option>
                                                <?php foreach($groups_list as $group): ?>
                                                <option value="<?php echo $group['group_cod']; ?>" <?php if($filter_group_cod == $group['group_cod']) echo 'selected="selected"'; ?>>
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
                                            <button type="submit" class="filter-btn" name="page" value="1">🔍 اعمال فیلتر</button>
                                            <a href="Garden_ab_request_admin.php" class="reset-btn">🔄 حذف فیلتر</a>
                                            <a href="export_garden_requests_csv.php?<?php echo http_build_query(array(
    'id_ostan' => $filter_id_ostan,
    'z_sal' => $filter_z_sal,
    'group_cod' => $filter_group_cod,
    'product_cod' => $filter_product_cod,
    'status' => $filter_status
)); ?>" class="filter-btn" style="background:#2e7d32;">
    📥 خروجی CSV
</a>
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
                            | صفحه <?php echo $page; ?> از <?php echo $total_pages; ?>
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
                                    <th width="8%">سال</th>
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
                                        <a href="Garden_ab_request_admin_detail.php?id=<?php echo $row['id']; ?>" class="manage-link">
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
                                <?php buildPaginationLink($page - 1, '‹ قبلی'); ?>
                            <?php endif; ?>
                            
                            <?php
                            $start_page = max(1, $page - 3);
                            $end_page = min($total_pages, $page + 3);
                            
                            if ($start_page > 1): ?>
                                <?php buildPaginationLink(1, '1'); ?>
                                <?php if ($start_page > 2): ?>
                                    <span style="padding:6px 12px;">...</span>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <?php if ($i == $page): ?>
                                    <span class="active" style="padding:6px 12px; border:1px solid #006699; border-radius:4px; background:#006699; color:#fff;"><?php echo $i; ?></span>
                                <?php else: ?>
                                    <?php buildPaginationLink($i, $i); ?>
                                <?php endif; ?>
                            <?php endfor; ?>
                            
                            <?php if ($end_page < $total_pages): ?>
                                <?php if ($end_page < $total_pages - 1): ?>
                                    <span style="padding:6px 12px;">...</span>
                                <?php endif; ?>
                                <?php buildPaginationLink($total_pages, $total_pages); ?>
                            <?php endif; ?>
                            
                            <?php if ($page < $total_pages): ?>
                                <?php buildPaginationLink($page + 1, 'بعدی ›'); ?>
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