<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
date_default_timezone_set('Asia/Tehran');

// ============================================================
// بررسی درخواست Ajax برای دریافت محصولات
// ============================================================
if (isset($_GET['ajax']) && $_GET['ajax'] == 'get_products' && isset($_GET['group'])) {
    header('Content-Type: application/json');
    $group = $_GET['group'];
    if (!empty($group)) {
        $stmt_prod = $dbh->prepare("SELECT product_cod, product_name FROM product_z WHERE group_cod = ? ORDER BY product_name ASC");
        $stmt_prod->execute(array($group));
        $products = $stmt_prod->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
    } else {
        echo json_encode(array());
    }
    exit;
}

// ============================================================
// دریافت پارامترهای فیلتر
// ============================================================
$filter_ostan = isset($_GET['ostan']) ? $_GET['ostan'] : '';
$filter_group = isset($_GET['group']) ? $_GET['group'] : '';
$filter_product = isset($_GET['product']) ? $_GET['product'] : '';
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'all';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 20;
$start = ($page - 1) * $limit;

// ============================================================
// گرفتن لیست استان‌ها برای فیلتر
// ============================================================
$stmt_ostans = $dbh->query("SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC");
$ostans = $stmt_ostans->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// گرفتن لیست گروه‌های محصولات برای فیلتر
// ============================================================
$stmt_groups = $dbh->query("SELECT DISTINCT group_cod, group_name FROM product_z ORDER BY group_cod ASC");
$groups = $stmt_groups->fetchAll(PDO::FETCH_ASSOC);

// ============================================================
// گرفتن لیست محصولات برای فیلتر (بر اساس گروه انتخاب شده)
// ============================================================
$products = array();
if (!empty($filter_group)) {
    $stmt_prod = $dbh->prepare("SELECT product_cod, product_name FROM product_z WHERE group_cod = ? ORDER BY product_name ASC");
    $stmt_prod->execute(array($filter_group));
    $products = $stmt_prod->fetchAll(PDO::FETCH_ASSOC);
} else if (!empty($filter_product)) {
    // اگر گروه انتخاب نشده ولی محصول انتخاب شده، محصول را پیدا کن
    $stmt_prod = $dbh->prepare("SELECT product_cod, product_name FROM product_z WHERE product_cod = ?");
    $stmt_prod->execute(array($filter_product));
    $products = $stmt_prod->fetchAll(PDO::FETCH_ASSOC);
}

// ============================================================
// ساخت شرط‌های WHERE
// ============================================================
$where_conditions = array();
$params = array();

if (!empty($filter_ostan)) {
    $where_conditions[] = "r.id_ostan = ?";
    $params[] = $filter_ostan;
}
if (!empty($filter_group)) {
    $where_conditions[] = "r.group_cod = ?";
    $params[] = $filter_group;
}
if (!empty($filter_product)) {
    $where_conditions[] = "r.product_cod = ?";
    $params[] = $filter_product;
}
if ($filter_status != 'all' && $filter_status != '') {
    $where_conditions[] = "r.status = ?";
    $params[] = $filter_status;
}

$where_clause = '';
if (count($where_conditions) > 0) {
    $where_clause = 'WHERE ' . implode(' AND ', $where_conditions);
}

// ============================================================
// کوئری شمارش
// ============================================================
$query_count = "SELECT COUNT(*) FROM Agri_ab_request r $where_clause";
$stmt_count = $dbh->prepare($query_count);
$stmt_count->execute($params);
$total_rows = $stmt_count->fetchColumn();
$total_pages = ceil($total_rows / $limit);

// ============================================================
// کوئری اصلی با JOIN برای دریافت نام استان
// ============================================================
$query = "SELECT r.*, o.ostan 
          FROM Agri_ab_request r
          LEFT JOIN ostanname o ON r.id_ostan = o.id_ostan
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
    'approved' => 'تأیید شده',
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

function buildUrl($params) {
    $url = '?';
    $parts = array();
    if (!empty($params['ostan'])) $parts[] = 'ostan=' . urlencode($params['ostan']);
    if (!empty($params['group'])) $parts[] = 'group=' . urlencode($params['group']);
    if (!empty($params['product'])) $parts[] = 'product=' . urlencode($params['product']);
    if (!empty($params['status']) && $params['status'] != 'all') $parts[] = 'status=' . urlencode($params['status']);
    if (!empty($params['page']) && $params['page'] > 1) $parts[] = 'page=' . $params['page'];
    return $url . implode('&', $parts);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR" xml:lang="fa">
<head>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    
    <style>
        body { text-align: right; font-family: Tahoma; }
        .style1 { color: #003366; font-family: Tahoma; font-size: 18px; }
        .style8 { font-family: Tahoma; font-size: 14px; }
        
        .manage-box {
            width: 95%;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #09C;
            border-radius: 15px;
            background: #f9f9f9;
        }
        
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            align-items: center;
        }
        .filter-bar .filter-group {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .filter-bar label {
            font-weight: bold;
            color: #003366;
            font-size: 13px;
        }
        .filter-bar select, .filter-bar input {
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            height: 35px;
            font-family: Tahoma;
            font-size: 13px;
        }
        .filter-bar .filter-btn {
            padding: 6px 20px;
            border: none;
            border-radius: 4px;
            background: #006699;
            color: #fff;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
            height: 35px;
            line-height: 23px;
        }
        .filter-bar .filter-btn:hover {
            background: #004d80;
        }
        .filter-bar .filter-btn.reset {
            background: #999;
        }
        .filter-bar .filter-btn.reset:hover {
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
            font-size: 14px;
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
        
        .review-link {
            color: #006699;
            text-decoration: none;
            font-weight: bold;
        }
        .review-link:hover {
            text-decoration: underline;
        }
        
        .empty-row {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 16px;
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
        
        .summary-count {
            font-size: 12px;
            color: #999;
            margin-right: 10px;
        }
        
        button {
            border-color: #FFF;
        }
        
        .loading-products {
            display: none;
            font-size: 12px;
            color: #006699;
            margin-right: 5px;
        }
        
        @media (max-width: 900px) {
            .request-table { font-size: 11px; }
            .request-table th, .request-table td { padding: 6px 4px; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .filter-bar .filter-group { flex-wrap: wrap; }
            .filter-bar select, .filter-bar input { width: 100%; }
        }
    </style>
    
    <script type="text/javascript">
        $(document).ready(function() {
            // اگر مقدار گروه انتخاب شده باشد، محصولات آن را بارگذاری کن
            var selectedGroup = $('#filter_group').val();
            if (selectedGroup) {
                loadProducts(selectedGroup, false);
            }
        });
        
        function loadProducts(groupCod, submitForm = true) {
            if (!groupCod) {
                // اگر گروه خالی بود، لیست محصولات را خالی کن
                $('#filter_product').html('<option value="">همه محصولات</option>');
                if (submitForm) {
                    $('#filter-form').submit();
                }
                return;
            }
            
            // نمایش لودینگ
            $('#product-loading').show();
            
            // دریافت محصولات از طریق Ajax از همین فایل
            $.ajax({
                url: window.location.pathname + '?ajax=get_products&group=' + encodeURIComponent(groupCod),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#product-loading').hide();
                    
                    var options = '<option value="">همه محصولات</option>';
                    if (data.length > 0) {
                        $.each(data, function(index, product) {
                            var selected = (product.product_cod == '<?php echo $filter_product; ?>') ? 'selected="selected"' : '';
                            options += '<option value="' + product.product_cod + '" ' + selected + '>' + 
                                      product.product_name + '</option>';
                        });
                    }
                    $('#filter_product').html(options);
                    
                    // ارسال خودکار فرم بعد از بارگذاری محصولات
                    if (submitForm) {
                        $('#filter-form').submit();
                    }
                },
                error: function(xhr, status, error) {
                    $('#product-loading').hide();
                    alert('خطا در دریافت لیست محصولات. لطفاً دوباره تلاش کنید.');
                    console.log('Error:', error);
                    console.log('Status:', status);
                    console.log('Response:', xhr.responseText);
                }
            });
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
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" dir="rtl">
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <td width="840">
                            <span class="style8">مدیریت درخواست‌های تغییر الگوی کشت</span><br />
                            
                            <div class="manage-box">
                                
                                <!-- فیلترها -->
                                <form method="get" action="Agri_ab_request_manage.php" id="filter-form">
                                    <div class="filter-bar">
                                        <div class="filter-group">
                                            <label>استان:</label>
                                            <select name="ostan" id="filter_ostan" onchange="this.form.submit()">
                                                <option value="">همه استان‌ها</option>
                                                <?php foreach($ostans as $o): ?>
                                                <option value="<?php echo $o['id_ostan']; ?>" <?php if ($filter_ostan == $o['id_ostan']) echo 'selected="selected"'; ?>>
                                                    <?php echo htmlspecialchars($o['ostan']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                                        <div class="filter-group">
                                            <label>گروه محصول:</label>
                                            <select name="group" id="filter_group" onchange="loadProducts(this.value, true)">
                                                <option value="">همه گروه‌ها</option>
                                                <?php foreach($groups as $g): ?>
                                                <option value="<?php echo $g['group_cod']; ?>" <?php if ($filter_group == $g['group_cod']) echo 'selected="selected"'; ?>>
                                                    <?php echo htmlspecialchars($g['group_name']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        
                                        <div class="filter-group">
                                            <label>نام محصول:</label>
                                            <select name="product" id="filter_product" onchange="this.form.submit()">
                                                <option value="">همه محصولات</option>
                                                <?php foreach($products as $p): ?>
                                                <option value="<?php echo $p['product_cod']; ?>" <?php if ($filter_product == $p['product_cod']) echo 'selected="selected"'; ?>>
                                                    <?php echo htmlspecialchars($p['product_name']); ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span id="product-loading" class="loading-products">⏳ در حال بارگذاری...</span>
                                        </div>
                                        
                                        <div class="filter-group">
                                            <label>وضعیت:</label>
                                            <select name="status" id="filter_status" onchange="this.form.submit()">
                                                <option value="all" <?php if ($filter_status == 'all') echo 'selected="selected"'; ?>>همه</option>
                                                <option value="pending" <?php if ($filter_status == 'pending') echo 'selected="selected"'; ?>>🕒 در انتظار</option>
                                                <option value="reviewing" <?php if ($filter_status == 'reviewing') echo 'selected="selected"'; ?>>🔄 در حال بررسی</option>
                                                <option value="approved" <?php if ($filter_status == 'approved') echo 'selected="selected"'; ?>>✅ تأیید شده</option>
                                                <option value="rejected" <?php if ($filter_status == 'rejected') echo 'selected="selected"'; ?>>❌ رد شده</option>
                                            </select>
                                        </div>
                                        
                                        <a href="Agri_ab_request_manage.php" class="filter-btn reset">✖ پاک کردن</a>
                                    </div>
                                </form>
                                
                                <!-- تعداد کل -->
                                <div style="margin-bottom:15px; text-align:left;">
                                    <span class="summary-count">تعداد کل درخواست‌ها: <?php echo number_format($total_rows); ?></span>
                                </div>
                                
                                <?php if (count($requests) > 0): ?>
                                
                                <!-- جدول درخواست‌ها -->
                                <table class="request-table" >
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="10%">تاریخ ثبت</th>
                                            <th width="12%">استان</th>
                                            <th width="15%">نام محصول</th>
                                            <th width="10%">وضعیت</th>
                                            <th width="20%">تغییرات</th>
                                            <th width="10%">فایل</th>
                                            <th width="10%">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $counter = $start + 1;
                                        foreach($requests as $row): 
                                            $changes_summary = array();
                                            if ($row['request_s_abi'] != $row['current_s_abi']) {
                                                $changes_summary[] = 'سطح آبی: ' . number_format($row['current_s_abi']) . ' → ' . number_format($row['request_s_abi']);
                                            }
                                            if ($row['request_s_dem'] != $row['current_s_dem']) {
                                                $changes_summary[] = 'سطح دیم: ' . number_format($row['current_s_dem']) . ' → ' . number_format($row['request_s_dem']);
                                            }
                                            if ($row['request_a_abi'] != $row['current_a_abi']) {
                                                $changes_summary[] = 'عملکرد آبی: ' . number_format($row['current_a_abi']) . ' → ' . number_format($row['request_a_abi']);
                                            }
                                            if ($row['request_a_dem'] != $row['current_a_dem']) {
                                                $changes_summary[] = 'عملکرد دیم: ' . number_format($row['current_a_dem']) . ' → ' . number_format($row['request_a_dem']);
                                            }
                                            
                                            $changes_display = implode('<br>', array_slice($changes_summary, 0, 2));
                                            if (count($changes_summary) > 2) {
                                                $changes_display .= '<br><span style="color:#999;font-size:11px;">+ ' . (count($changes_summary) - 2) . ' تغییر دیگر</span>';
                                            }
                                        ?>
                                        <tr>
                                            <td><?php echo $counter; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td><?php echo htmlspecialchars($row['ostan']); ?></td>
                                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                            <td>
                                                <span class="status-badge" style="background:<?php echo $status_colors[$row['status']]; ?>;">
                                                    <?php echo $status_icons[$row['status']] . ' ' . $status_labels[$row['status']]; ?>
                                                </span>
                                            </td>
                                            <td style="font-size:12px;"><?php echo $changes_display; ?></td>
                                            <td>
                                                <?php if (!empty($row['attachment'])): ?>
                                                    <a href="../../<?php echo $row['attachment']; ?>" target="_blank" style="color:#1565c0; text-decoration:none;">📎</a>
                                                <?php else: ?>
                                                    <span style="color:#ccc;">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="Agri_ab_request_review.php?id=<?php echo $row['id']; ?>" class="review-link">🔍 بررسی</a>
                                            </td>
                                        </tr>
                                        <?php 
                                        $counter++;
                                        endforeach; 
                                        ?>
                                    </tbody>
                                </table>
                                
                                <!-- صفحه‌بندی -->
                                <?php if ($total_pages > 1): ?>
                                <div class="pagination">
                                    <?php if ($page > 1): ?>
                                        <a href="<?php echo buildUrl(array('ostan' => $filter_ostan, 'group' => $filter_group, 'product' => $filter_product, 'status' => $filter_status, 'page' => $page - 1)); ?>">‹ قبلی</a>
                                    <?php endif; ?>
                                    
                                    <?php
                                    $start_page = max(1, $page - 3);
                                    $end_page = min($total_pages, $page + 3);
                                    
                                    if ($start_page > 1): ?>
                                        <a href="<?php echo buildUrl(array('ostan' => $filter_ostan, 'group' => $filter_group, 'product' => $filter_product, 'status' => $filter_status, 'page' => 1)); ?>">1</a>
                                        <?php if ($start_page > 2): ?>
                                            <span>...</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                        <?php if ($i == $page): ?>
                                            <span class="active"><?php echo $i; ?></span>
                                        <?php else: ?>
                                            <a href="<?php echo buildUrl(array('ostan' => $filter_ostan, 'group' => $filter_group, 'product' => $filter_product, 'status' => $filter_status, 'page' => $i)); ?>"><?php echo $i; ?></a>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    
                                    <?php if ($end_page < $total_pages): ?>
                                        <?php if ($end_page < $total_pages - 1): ?>
                                            <span>...</span>
                                        <?php endif; ?>
                                        <a href="<?php echo buildUrl(array('ostan' => $filter_ostan, 'group' => $filter_group, 'product' => $filter_product, 'status' => $filter_status, 'page' => $total_pages)); ?>"><?php echo $total_pages; ?></a>
                                    <?php endif; ?>
                                    
                                    <?php if ($page < $total_pages): ?>
                                        <a href="<?php echo buildUrl(array('ostan' => $filter_ostan, 'group' => $filter_group, 'product' => $filter_product, 'status' => $filter_status, 'page' => $page + 1)); ?>">بعدی ›</a>
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
                            
                            <p><a href="Pattern.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt=""/></a></p>
                        </td>
                    </tr>
                </table>
                
            </td>
        </tr>
        <tr>
            <td height="100" colspan="3" valign="middle">
                <!-- فاصله -->
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