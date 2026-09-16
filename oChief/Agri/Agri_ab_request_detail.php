<?php 
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

// ============================================================
// دریافت ID از POST به جای GET
// ============================================================
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id == 0) {
    header('Location: Agri_ab_request_list.php');
    exit;
}

// ============================================================
// دریافت اطلاعات درخواست با JOIN برای دریافت نام گروه
// ============================================================
$query = "SELECT r.*, o.ostan, p.group_name 
          FROM Agri_ab_request r
          LEFT JOIN ostanname o ON r.id_ostan = o.id_ostan
          LEFT JOIN product_z p ON r.cod_qroup = p.group_cod
          WHERE r.id = ?";
$stmt = $dbh->prepare($query);
$stmt->execute(array($id));
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$request) {
    header('Location: Agri_ab_request_list.php');
    exit;
}

// وضعیت‌ها
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

// محاسبه تولید از سطح و عملکرد
$calculated_t_abi = ($request['request_a_abi'] * $request['request_s_abi']) / 1000;
$calculated_t_dem = ($request['request_a_dem'] * $request['request_s_dem']) / 1000;
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
        
        .detail-box {
            width: 90%;
            margin: 20px auto;
            padding: 25px;
            border: 2px solid #09C;
            border-radius: 15px;
            background: #f9f9f9;
        }
        
        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            border-bottom: 2px solid #006699;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .detail-header .title {
            font-size: 20px;
            font-weight: bold;
            color: #003366;
        }
        .detail-header .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
        }
        
        .detail-section {
            margin-bottom: 25px;
        }
        .detail-section .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #003366;
            border-right: 4px solid #006699;
            padding-right: 10px;
            margin-bottom: 15px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 10px 20px;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }
        .info-grid .item {

            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px dashed #eee;
        }
        .info-grid .item:last-child {
            border-bottom: none;
        }

        .info-grid .item .label {
            color: #666;
            font-weight: bold;
        }
        .info-grid .item .value {
            color: #003366;
            font-weight: bold;
        }
        
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }
        .comparison-table th {
            background: #006699;
            color: #fff;
            padding: 10px 8px;
            text-align: center;
            font-size: 14px;
        }
        .comparison-table td {
            padding: 10px 8px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }
        .comparison-table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .comparison-table tr:hover {
            background: #e6f2ff;
        }
        .comparison-table .current-val {
            color: #003366;
            font-weight: bold;
        }
        .comparison-table .request-val {
            color: #1565c0;
            font-weight: bold;
        }
        .comparison-table .admin-val {
            color: #2e7d32;
            font-weight: bold;
        }
        .comparison-table .arrow-up {
            color: #2e7d32;
            font-weight: bold;
        }
        .comparison-table .arrow-down {
            color: #c62828;
            font-weight: bold;
        }
        .comparison-table .arrow-equal {
            color: #999;
        }
        
        .reason-box {
            background: #fff3e0;
            border: 1px solid #ffcc80;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }
        .reason-box .reason-label {
            font-weight: bold;
            color: #e65100;
        }
        .reason-box .reason-text {
            margin-top: 5px;
            padding: 10px;
            background: #fff;
            border-radius: 4px;
            line-height: 1.8;
        }
        
        .attachment-box {
            background: #e3f2fd;
            border: 1px solid #006699;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }
        .attachment-box a {
            color: #006699;
            font-weight: bold;
            text-decoration: none;
        }
        .attachment-box a:hover {
            text-decoration: underline;
        }
        
        .admin-note-box {
            background: #e8f5e9;
            border: 1px solid #2e7d32;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }
        .admin-note-box .admin-label {
            font-weight: bold;
            color: #2e7d32;
        }
        .admin-note-box .admin-text {
            margin-top: 5px;
            padding: 10px;
            background: #fff;
            border-radius: 4px;
            line-height: 1.8;
        }
        
        .btn-back {
            padding: 8px 25px;
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
        .btn-back:hover {
            background: #004d80;
        }
        
        .btn-edit {
            padding: 8px 25px;
            background: #f57c00;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-edit:hover {
            background: #e65100;
        }
        
        .btn-delete {
            padding: 8px 25px;
            background: #c62828;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: Tahoma;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-delete:hover {
            background: #b71c1c;
        }
        
        .btn-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        
        .btn-actions form {
            display: inline;
        }
        
        @media (max-width: 900px) {
            .info-grid { grid-template-columns: 1fr; }
            .comparison-table { font-size: 12px; }
            .comparison-table th, .comparison-table td { padding: 6px 4px; }
            .detail-box { padding: 15px; }
            .detail-header .title { font-size: 16px; }
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
                            <span class="style8">جزئیات درخواست تغییر الگوی کشت</span><br />
                            
                            <div class="detail-box">
                                
                                <!-- هدر -->
                                <div class="detail-header">
                                    <div class="title">
                                        📋 درخواست #<?php echo $request['id']; ?>
                                        <span style="font-size:14px; font-weight:normal; color:#666; margin-right:10px;">
                                            <?php echo htmlspecialchars($request['product_name']); ?>
                                            (<?php echo $request['z_sal']; ?>)
                                        </span>
                                    </div>
                                    <div>
                                        <span class="status-badge" style="background:<?php echo $status_colors[$request['status']]; ?>;">
                                            <?php echo $status_icons[$request['status']] . ' ' . $status_labels[$request['status']]; ?>
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- اطلاعات کلی -->
                                <div class="detail-section">
                                    <div class="section-title">📊 اطلاعات کلی</div>
                                    <div class="info-grid">
                                        <div class="item">
                                            <span class="label">استان:</span>
                                            <span class="value"><?php echo htmlspecialchars($request['ostan']); ?></span>
                                        </div>
                                        <div class="item">
                                            <span class="label">تاریخ ثبت:</span>
                                            <span class="value"><?php echo $request['created_at']; ?></span>
                                        </div>
                                        <div class="item">
                                            <span class="label">سال زراعی:</span>
                                            <span class="value"><?php echo $request['z_sal']; ?></span>
                                        </div>
                                        <div class="item">
                                            <span class="label">نام محصول:</span>
                                            <span class="value"><?php echo htmlspecialchars($request['product_name']); ?></span>
                                        </div>
                                        <div class="item">
                                            <span class="label">گروه محصول:</span>
                                            <span class="value"><?php echo htmlspecialchars($request['group_name']); ?></span>
                                        </div>
                                        <div class="item">
                                            <span class="label">وضعیت:</span>
                                            <span class="value" style="color:<?php echo $status_colors[$request['status']]; ?>;">
                                                <?php echo $status_icons[$request['status']] . ' ' . $status_labels[$request['status']]; ?>
                                            </span>
                                        </div>
                                        <?php if ($request['updated_at']): ?>
                                        <div class="item">
                                            <span class="label">آخرین ویرایش:</span>
                                            <span class="value"><?php echo $request['updated_at']; ?></span>
                                        </div>
                                        <?php endif; ?>
                                        <?php if ($request['approved_at']): ?>
                                        <div class="item">
                                            <span class="label">تاریخ تأیید/رد:</span>
                                            <span class="value"><?php echo $request['approved_at']; ?></span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <!-- جدول مقایسه -->
                                <div class="detail-section">
                                    <div class="section-title">📊 مقایسه مقادیر</div>
                                    <table class="comparison-table">
                                        <thead>
                                            <tr>
                                                <th width="20%">فیلد</th>
                                                <th width="25%">مقدار ابلاغی فعلی</th>
                                                <th width="25%">مقدار درخواستی</th>
                                                <?php if ($request['status'] == 'approved'): ?>
                                                <th width="25%">مقدار تأیید شده</th>
                                                <?php endif; ?>
                                                <th width="5%">تغییر</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $fields = array(
                                                'سطح آبی' => array('current' => $request['current_s_abi'], 'request' => $request['request_s_abi'], 'admin' => $request['admin_s_abi']),
                                                'سطح دیم' => array('current' => $request['current_s_dem'], 'request' => $request['request_s_dem'], 'admin' => $request['admin_s_dem']),
                                                'عملکرد آبی' => array('current' => $request['current_a_abi'], 'request' => $request['request_a_abi'], 'admin' => $request['admin_a_abi']),
                                                'عملکرد دیم' => array('current' => $request['current_a_dem'], 'request' => $request['request_a_dem'], 'admin' => $request['admin_a_dem']),
                                                'تولید آبی (محاسبه‌شده)' => array('current' => $request['current_t_abi'], 'request' => $calculated_t_abi, 'admin' => $request['calculated_t_abi']),
                                                'تولید دیم (محاسبه‌شده)' => array('current' => $request['current_t_dem'], 'request' => $calculated_t_dem, 'admin' => $request['calculated_t_dem'])
                                            );
                                            
                                            foreach($fields as $label => $values):
                                                $current = floatval($values['current']);
                                                $request_val = floatval($values['request']);
                                                $admin_val = isset($values['admin']) ? floatval($values['admin']) : null;
                                                
                                                $diff = $request_val - $current;
                                                if ($diff > 0) {
                                                    $arrow = '⬆️';
                                                    $arrow_class = 'arrow-up';
                                                    $change_text = '+' . number_format($diff, 1);
                                                } elseif ($diff < 0) {
                                                    $arrow = '⬇️';
                                                    $arrow_class = 'arrow-down';
                                                    $change_text = '-' . number_format(abs($diff), 1);
                                                } else {
                                                    $arrow = '➖';
                                                    $arrow_class = 'arrow-equal';
                                                    $change_text = 'بدون تغییر';
                                                }
                                            ?>
                                            <tr>
                                                <td><strong><?php echo $label; ?></strong></td>
                                                <td class="current-val"><?php echo number_format($current, 1); ?></td>
                                                <td class="request-val"><?php echo number_format($request_val, 1); ?></td>
                                                <?php if ($request['status'] == 'approved'): ?>
                                                <td class="admin-val"><?php echo $admin_val !== null ? number_format($admin_val, 1) : '-'; ?></td>
                                                <?php endif; ?>
                                                <td class="<?php echo $arrow_class; ?>">
                                                    <?php echo $arrow . ' ' . $change_text; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- علت درخواست -->
                                <div class="detail-section">
                                    <div class="section-title">📝 علت درخواست</div>
                                    <div class="reason-box">
                                        <div class="reason-label">📌 شرح درخواست:</div>
                                        <div class="reason-text">
                                            <?php echo nl2br(htmlspecialchars($request['reason'])); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- فایل پیوست -->
                                <?php if (!empty($request['attachment'])): ?>
                                <div class="detail-section">
                                    <div class="section-title">📎 فایل پیوست</div>
                                    <div class="attachment-box">
                                        <a href="../../<?php echo $request['attachment']; ?>" target="_blank">
                                            📄 دانلود فایل پیوست
                                        </a>
                                        <span style="font-size:12px; color:#666; margin-right:10px;">
                                            (<?php echo basename($request['attachment']); ?>)
                                        </span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <!-- یادداشت مدیر -->
                                <?php if (!empty($request['admin_note'])): ?>
                                <div class="detail-section">
                                    <div class="section-title">📌 یادداشت مدیر</div>
                                    <div class="admin-note-box">
                                        <div class="admin-label">👤 یادداشت مدیر:</div>
                                        <div class="admin-text">
                                            <?php echo nl2br(htmlspecialchars($request['admin_note'])); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <!-- دکمه‌های عملیات با POST -->
                                <div class="btn-actions">
                                    <a href="Agri_ab_request_list.php" class="btn-back">🔙 بازگشت به لیست</a>
                                    
                                    <?php if ($request['status'] == 'pending' || $request['status'] == 'reviewing'): ?>
                                    <!-- فرم ویرایش با POST -->
                                    <form method="post" action="Agri_ab_request_edit.php">
                                        <input type="hidden" name="id" value="<?php echo $request['id']; ?>">
                                        <button type="submit" class="btn-edit">✏️ ویرایش درخواست</button>
                                    </form>
                                    
                                    <!-- فرم حذف با POST -->
                                    <form method="post" action="Agri_ab_request_delete.php" onsubmit="return confirm('آیا از حذف این درخواست مطمئن هستید؟');">
                                        <input type="hidden" name="id" value="<?php echo $request['id']; ?>">
                                        <button type="submit" class="btn-delete">🗑️ حذف درخواست</button>
                                    </form>
                                    <?php endif; ?>
                                </div>
                                
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
    
    <script>
    // حذف تابع deleteRequest چون با فرم POST جایگزین شده است
    </script>
</body>
</html>