<?php 
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

$id_ostan1 = $id_ostan;

// ============================================================
// دریافت پارامترها از POST به جای GET
// ============================================================
$status_filter = isset($_POST['status']) ? $_POST['status'] : 'all';
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$limit = 20;
$start = ($page - 1) * $limit;

// ============================================================
// ساخت شرط‌های WHERE
// ============================================================
$where_conditions = array();
$params = array();

// شرط استان
$where_conditions[] = "r.id_ostan = ?";
$params[] = $id_ostan1;

// شرط وضعیت
if ($status_filter != 'all' && $status_filter != '') {
    $where_conditions[] = "r.status = ?";
    $params[] = $status_filter;
}

$where_clause = implode(' AND ', $where_conditions);

// ============================================================
// کوئری شمارش
// ============================================================
$query_count = "SELECT COUNT(*) FROM Agri_ab_request r WHERE $where_clause";
$stmt_count = $dbh->prepare($query_count);
$stmt_count->execute($params);
$total_rows = $stmt_count->fetchColumn();
$total_pages = ceil($total_rows / $limit);

// ============================================================
// کوئری اصلی با JOIN برای دریافت نام گروه
// ============================================================
$query = "SELECT DISTINCT r.*, p.group_name 
          FROM Agri_ab_request r
          INNER JOIN product_z p ON r.cod_qroup = p.group_cod
          WHERE $where_clause 
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

// ============================================================
// تابع ساخت فرم برای صفحه‌بندی
// ============================================================
function buildPaginationForm($status, $page) {
    echo '<form method="post" style="display:inline;">';
    echo '<input type="hidden" name="status" value="' . htmlspecialchars($status) . '">';
    echo '<input type="hidden" name="page" value="' . intval($page) . '">';
    echo '<button type="submit" class="pagination-btn">' . intval($page) . '</button>';
    echo '</form>';
}

function buildPaginationLink($status, $page, $text, $class = '') {
    echo '<form method="post" style="display:inline;">';
    echo '<input type="hidden" name="status" value="' . htmlspecialchars($status) . '">';
    echo '<input type="hidden" name="page" value="' . intval($page) . '">';
    echo '<button type="submit" class="' . htmlspecialchars($class) . '">' . htmlspecialchars($text) . '</button>';
    echo '</form>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR" xml:lang="fa">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title ;?></title>
    <script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript" charset="utf-8"></script>
    
    <style type="text/css">
        body { text-align: right; font-family: Tahoma; }
        .style1 { color: #003366; font-family: Tahoma; font-size: 18px; }
        .style8 { font-family: Tahoma; font-size: 14px; }
        
        .list-box {
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
            padding: 10px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            align-items: center;
        }
        .filter-bar .filter-label {
            font-weight: bold;
            color: #003366;
            font-size: 14px;
        }
        .filter-bar .filter-btn {
            padding: 6px 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #fff;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 13px;
            text-decoration: none;
            color: #333;
        }
        .filter-bar .filter-btn:hover {
            background: #e6f2ff;
        }
        .filter-bar .filter-btn.active {
            background: #006699;
            color: #fff;
            border-color: #006699;
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
        
        .detail-link {
            color: #006699;
            text-decoration: none;
            font-weight: bold;
        }
        .detail-link:hover {
            text-decoration: underline;
        }
        
        .attachment-link {
            color: #1565c0;
            text-decoration: none;
        }
        .attachment-link:hover {
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
        
        .new-request-btn {
            padding: 8px 20px;
            background: #2e7d32;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .new-request-btn:hover {
            background: #1b5e20;
        }
        
        .btn-export {
            padding: 8px 20px;
            background: #006699;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-export:hover {
            background: #004d80;
        }
        
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        @media (max-width: 900px) {
            .request-table { font-size: 11px; }
            .request-table th, .request-table td { padding: 6px 4px; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .filter-bar .filter-btn { text-align: center; }
            .action-buttons { flex-direction: column; align-items: stretch; }
        }
    </style>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
        </tr>
        <tr>
            <td dir="ltr"><?php include('menu.php'); ?></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <td width="840">
                            <?php include('top.php'); ?>
                            <span class="style8">لیست درخواست‌های تغییر الگوی کشت</span><br />
                            
                            <div class="list-box">
                                
                                <!-- دکمه‌های عملیات -->
                                <div class="action-buttons">
                                    <div>
                                        <a href="Agri_ab_request.php" class="new-request-btn">➕ ثبت درخواست جدید</a>
                                    </div>
                                    <div>
                                        <span style="font-size:12px; color:#999; margin-left:15px;">تعداد کل درخواست‌ها: <?php echo number_format($total_rows); ?></span>
                                        
                                        <!-- فرم خروجی اکسل با POST -->
                                        <form method="post" action="export_requests_csv.php" target="_blank" style="display:inline;">
                                            <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1; ?>">
                                            <input type="hidden" name="status" value="<?php echo $status_filter; ?>">
                                            <button type="submit" class="btn-export">📥 خروجی اکسل</button>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- فیلتر وضعیت با POST -->
                                <form method="post" id="filter-form">
                                    <div class="filter-bar">
                                        <span class="filter-label">🔍 فیلتر وضعیت:</span>
                                        <button type="submit" name="status" value="all" class="filter-btn <?php echo ($status_filter == 'all') ? 'active' : ''; ?>">همه</button>
                                        <button type="submit" name="status" value="pending" class="filter-btn <?php echo ($status_filter == 'pending') ? 'active' : ''; ?>"><?php echo $status_icons['pending']; ?> در انتظار</button>
                                        <button type="submit" name="status" value="reviewing" class="filter-btn <?php echo ($status_filter == 'reviewing') ? 'active' : ''; ?>"><?php echo $status_icons['reviewing']; ?> در حال بررسی</button>
                                        <button type="submit" name="status" value="approved" class="filter-btn <?php echo ($status_filter == 'approved') ? 'active' : ''; ?>"><?php echo $status_icons['approved']; ?> تأیید شده</button>
                                        <button type="submit" name="status" value="rejected" class="filter-btn <?php echo ($status_filter == 'rejected') ? 'active' : ''; ?>"><?php echo $status_icons['rejected']; ?> رد شده</button>
                                        <input type="hidden" name="page" value="1">
                                    </div>
                                </form>
                                
                                <?php if (count($requests) > 0): ?>
                                
                                <!-- جدول درخواست‌ها -->
                                <table class="request-table">
                                    <thead>
                                        <tr>
                                            <th width="4%">#</th>
                                            <th width="10%">تاریخ ثبت</th>
                                            <th width="15%">نام محصول</th>
                                            <th width="12%">گروه</th>
                                            <th width="10%">وضعیت</th>
                                            <th width="18%">تغییرات</th>
                                            <th width="8%">فایل</th>
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
                                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['group_name']); ?></td>
                                            <td>
                                                <span class="status-badge" style="background:<?php echo $status_colors[$row['status']]; ?>;">
                                                    <?php echo $status_icons[$row['status']] . ' ' . $status_labels[$row['status']]; ?>
                                                </span>
                                            </td>
                                            <td style="font-size:12px;"><?php echo $changes_display; ?></td>
                                            <td>
                                                <?php if (!empty($row['attachment'])): ?>
                                                    <a href="../../<?php echo $row['attachment']; ?>" target="_blank" class="attachment-link">📎 دانلود</a>
                                                <?php else: ?>
                                                    <span style="color:#ccc;">ندارد</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <!-- تغییر لینک به فرم POST -->
                                                <form method="post" action="Agri_ab_request_detail.php" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <button type="submit" class="detail-link" style="background:none; border:none; cursor:pointer; font-family:Tahoma; font-size:13px; color:#006699; font-weight:bold;">🔍 مشاهده</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php 
                                        $counter++;
                                        endforeach; 
                                        ?>
                                    </tbody>
                                </table>
                                
                                <!-- صفحه‌بندی با POST -->
                                <?php if ($total_pages > 1): ?>
                                <div class="pagination">
                                    <?php if ($page > 1): ?>
                                        <?php buildPaginationLink($status_filter, $page - 1, '‹ قبلی'); ?>
                                    <?php endif; ?>
                                    
                                    <?php
                                    $start_page = max(1, $page - 3);
                                    $end_page = min($total_pages, $page + 3);
                                    
                                    if ($start_page > 1): ?>
                                        <?php buildPaginationLink($status_filter, 1, '1'); ?>
                                        <?php if ($start_page > 2): ?>
                                            <span style="padding:6px 12px;">...</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                        <?php if ($i == $page): ?>
                                            <span class="active" style="padding:6px 12px; border:1px solid #006699; border-radius:4px; background:#006699; color:#fff;"><?php echo $i; ?></span>
                                        <?php else: ?>
                                            <?php buildPaginationLink($status_filter, $i, $i); ?>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    
                                    <?php if ($end_page < $total_pages): ?>
                                        <?php if ($end_page < $total_pages - 1): ?>
                                            <span style="padding:6px 12px;">...</span>
                                        <?php endif; ?>
                                        <?php buildPaginationLink($status_filter, $total_pages, $total_pages); ?>
                                    <?php endif; ?>
                                    
                                    <?php if ($page < $total_pages): ?>
                                        <?php buildPaginationLink($status_filter, $page + 1, 'بعدی ›'); ?>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                
                                <?php else: ?>
                                
                                <!-- پیام خالی -->
                                <div class="empty-row">
                                    <div style="font-size:48px; margin-bottom:10px;">📭</div>
                                    <div>هیچ درخواستی با این وضعیت یافت نشد.</div>
                                    <div style="font-size:14px; color:#999; margin-top:5px;">
                                        <a href="Agri_ab_request.php" style="color:#006699;">ثبت درخواست جدید</a>
                                    </div>
                                </div>
                                
                                <?php endif; ?>
                                
                            </div>
                            
                            <p><a href="Pattern.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47" alt=""/></a></p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
                            <?php include('../../footer.php'); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>