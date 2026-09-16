<?php
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');
require_once('../Jalali.php');
require_once('validate_city.php');
date_default_timezone_set('Asia/Tehran');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id == 0) {
    header('Location: Agri_ab_request_manage.php');
    exit;
}

// دریافت اطلاعات درخواست
$query = "SELECT r.*, o.ostan 
          FROM Agri_ab_request r
          LEFT JOIN ostanname o ON r.id_ostan = o.id_ostan
          WHERE r.id = ?";
$stmt = $dbh->prepare($query);
$stmt->execute(array($id));
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$request) {
    header('Location: Agri_ab_request_manage.php');
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

// محاسبه تولید
$calculated_t_abi = ($request['request_a_abi'] * $request['request_s_abi']) / 1000;
$calculated_t_dem = ($request['request_a_dem'] * $request['request_s_dem']) / 1000;

// ============================================================
// پردازش تأیید/رد
// ============================================================
$message = '';
$message_type = '';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $admin_note = isset($_POST['admin_note']) ? trim($_POST['admin_note']) : '';
    
    if ($action == 'approve') {
        // دریافت مقادیر تأییدی از فرم
        $admin_s_abi = isset($_POST['admin_s_abi']) ? floatval(str_replace(',', '', $_POST['admin_s_abi'])) : null;
        $admin_s_dem = isset($_POST['admin_s_dem']) ? floatval(str_replace(',', '', $_POST['admin_s_dem'])) : null;
        $admin_a_abi = isset($_POST['admin_a_abi']) ? floatval(str_replace(',', '', $_POST['admin_a_abi'])) : null;
        $admin_a_dem = isset($_POST['admin_a_dem']) ? floatval(str_replace(',', '', $_POST['admin_a_dem'])) : null;
        
        // محاسبه تولید بر اساس مقادیر تأییدی
        $admin_t_abi = ($admin_a_abi * $admin_s_abi) / 1000;
        $admin_t_dem = ($admin_a_dem * $admin_s_dem) / 1000;
        
        $update_query = "UPDATE Agri_ab_request SET
            admin_s_abi = ?,
            admin_s_dem = ?,
            admin_a_abi = ?,
            admin_a_dem = ?,
            admin_t_abi = ?,
            admin_t_dem = ?,
            status = 'approved',
            admin_note = ?,
            approved_at = ?
        WHERE id = ?";
        
        $stmt = $dbh->prepare($update_query);
        $result = $stmt->execute(array(
            $admin_s_abi,
            $admin_s_dem,
            $admin_a_abi,
            $admin_a_dem,
            $admin_t_abi,
            $admin_t_dem,
            $admin_note,
            jdate("Y/m/d"),
            $id
        ));
        
        if ($result) {
            // ثبت رویداد
            if (function_exists('sabt_event')) {
                $status_text = 'تأیید درخواست تغییر الگوی کشت - محصول: ' . $request['product_name'];
                sabt_event($login_session, getUserIP_1(), jdate("Y/m/d"), date('H:i:s'), '', $status_text, $request['id_ostan']);
            }
            $message = '✅ درخواست با موفقیت تأیید شد.';
            $message_type = 'success';
        } else {
            $message = '⚠️ خطا در تأیید درخواست.';
            $message_type = 'error';
        }
        
    } elseif ($action == 'reject') {
        $update_query = "UPDATE Agri_ab_request SET
            status = 'rejected',
            admin_note = ?,
            approved_at = ?
        WHERE id = ?";
        
        $stmt = $dbh->prepare($update_query);
        $result = $stmt->execute(array(
            $admin_note,
            jdate("Y/m/d"),
            $id
        ));
        
        if ($result) {
            // ثبت رویداد
            if (function_exists('sabt_event')) {
                $status_text = 'رد درخواست تغییر الگوی کشت - محصول: ' . $request['product_name'];
                sabt_event($login_session, getUserIP_1(), jdate("Y/m/d"), date('H:i:s'), '', $status_text, $request['id_ostan']);
            }
            $message = '❌ درخواست با موفقیت رد شد.';
            $message_type = 'error';
        } else {
            $message = '⚠️ خطا در رد درخواست.';
            $message_type = 'error';
        }
    }
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
    
    <style>
        body { text-align: right; font-family: Tahoma; }
        .style1 { color: #003366; font-family: Tahoma; font-size: 18px; }
        .style8 { font-family: Tahoma; font-size: 14px; }
        
        .review-box {
            width: 90%;
            margin: 20px auto;
            padding: 25px;
            border: 2px solid #09C;
            border-radius: 15px;
            background: #f9f9f9;
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            border-bottom: 2px solid #006699;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .review-header .title {
            font-size: 20px;
            font-weight: bold;
            color: #003366;
        }
        .review-header .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
        }
        
        .info-box {
            background: #e3f2fd;
            border: 2px solid #006699;
            border-radius: 8px;
            padding: 12px 20px;
            margin: 15px auto;
            text-align: right;
            font-family: Tahoma;
            font-size: 14px;
            line-height: 2;
        }
        .info-box .label { font-weight: bold; color: #003366; }
        .info-box .value { color: #006699; font-weight: bold; }
        
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
        .comparison-table .admin-input {
            width: 120px;
            height: 30px;
            text-align: center;
            font-family: Tahoma;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .comparison-table .admin-input:focus {
            border-color: #006699;
            box-shadow: 0 0 5px rgba(0,102,153,0.3);
        }
        .comparison-table .admin-value {
            color: #2e7d32;
            font-weight: bold;
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
        
        .action-box {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .action-box .action-label {
            font-weight: bold;
            color: #003366;
            font-size: 16px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .action-box .admin-note {
            width: 95%;
            padding: 8px;
            font-family: Tahoma;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        .btn-approve {
            padding: 10px 30px;
            background: #2e7d32;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-family: Tahoma;
        }
        .btn-approve:hover {
            background: #1b5e20;
        }
        
        .btn-reject {
            padding: 10px 30px;
            background: #c62828;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-family: Tahoma;
        }
        .btn-reject:hover {
            background: #b71c1c;
        }
        
        .btn-back {
            padding: 10px 30px;
            background: #999;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-family: Tahoma;
            text-decoration: none;
            display: inline-block;
        }
        .btn-back:hover {
            background: #777;
        }
        
        .btn-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        
        #form-message {
            display: none;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 4px;
            text-align: center;
        }
        #form-message.success {
            display: block;
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #2e7d32;
        }
        #form-message.error {
            display: block;
            background: #ffebee;
            color: #c62828;
            border: 1px solid #c62828;
        }
        
        button {
            border-color: #FFF;
        }
        
        @media (max-width: 900px) {
            .comparison-table { font-size: 12px; }
            .comparison-table th, .comparison-table td { padding: 6px 4px; }
            .comparison-table .admin-input { width: 80px; height: 26px; font-size: 12px; }
            .review-box { padding: 15px; }
            .review-header .title { font-size: 16px; }
        }
    </style>
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
                            <span class="style8">بررسی درخواست تغییر الگوی کشت</span><br />
                            
                            <!-- پیام -->
                            <?php if (!empty($message)): ?>
                            <div id="form-message" class="<?php echo $message_type; ?>">
                                <?php echo $message; ?>
                            </div>
                            <?php endif; ?>
                            
                            <div class="review-box">
                                
                                <!-- هدر -->
                                <div class="review-header">
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
                                <div class="info-box">
                                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td width="15%"><span class="label">استان:</span></td>
                                            <td width="35%"><span class="value"><?php echo htmlspecialchars($request['ostan']); ?></span></td>
                                            <td width="15%"><span class="label">تاریخ ثبت:</span></td>
                                            <td width="35%"><span class="value"><?php echo $request['created_at']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="label">سال زراعی:</span></td>
                                            <td><span class="value"><?php echo $request['z_sal']; ?></span></td>
                                            <td><span class="label">نام محصول:</span></td>
                                            <td><span class="value"><?php echo htmlspecialchars($request['product_name']); ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <!-- جدول مقایسه -->
                                <div class="info-box" style="background:#fff; border-color:#ccc;">
                                    <div style="font-size:16px; font-weight:bold; color:#003366; border-bottom:1px solid #006699; padding-bottom:5px; margin-bottom:8px;">
                                        📊 مقایسه مقادیر
                                    </div>
                                    
                                    <form method="post" action="Agri_ab_request_review.php?id=<?php echo $id; ?>" id="review-form">
                                    
                                    <table class="comparison-table">
                                        <thead>
                                            <tr>
                                                <th width="20%">فیلد</th>
                                                <th width="20%">مقدار ابلاغی فعلی</th>
                                                <th width="20%">مقدار درخواستی</th>
                                                <th width="25%">مقدار تأییدی (مدیر)</th>
                                                <th width="15%">وضعیت</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $fields = array(
                                                's_abi' => array('label' => 'سطح آبی', 'current' => $request['current_s_abi'], 'request' => $request['request_s_abi'], 'admin' => $request['admin_s_abi']),
                                                's_dem' => array('label' => 'سطح دیم', 'current' => $request['current_s_dem'], 'request' => $request['request_s_dem'], 'admin' => $request['admin_s_dem']),
                                                'a_abi' => array('label' => 'عملکرد آبی', 'current' => $request['current_a_abi'], 'request' => $request['request_a_abi'], 'admin' => $request['admin_a_abi']),
                                                'a_dem' => array('label' => 'عملکرد دیم', 'current' => $request['current_a_dem'], 'request' => $request['request_a_dem'], 'admin' => $request['admin_a_dem']),
                                                't_abi' => array('label' => 'تولید آبی (محاسبه‌شده)', 'current' => $request['current_t_abi'], 'request' => $calculated_t_abi, 'admin' => $request['admin_t_abi']),
                                                't_dem' => array('label' => 'تولید دیم (محاسبه‌شده)', 'current' => $request['current_t_dem'], 'request' => $calculated_t_dem, 'admin' => $request['admin_t_dem'])
                                            );
                                            
                                            foreach($fields as $key => $values):
                                                $current = floatval($values['current']);
                                                $request_val = floatval($values['request']);
                                                $admin_val = $values['admin'];
                                                
                                                $diff = $request_val - $current;
                                                if ($diff > 0) {
                                                    $arrow = '⬆️';
                                                    $change_class = 'arrow-up';
                                                    $change_text = '+' . number_format($diff, 1);
                                                } elseif ($diff < 0) {
                                                    $arrow = '⬇️';
                                                    $change_class = 'arrow-down';
                                                    $change_text = '-' . number_format(abs($diff), 1);
                                                } else {
                                                    $arrow = '➖';
                                                    $change_class = 'arrow-equal';
                                                    $change_text = 'بدون تغییر';
                                                }
                                                
                                                // اگر درخواست قبلاً تأیید شده، فیلدها غیرفعال هستند
                                                $disabled = ($request['status'] == 'approved' || $request['status'] == 'rejected') ? 'disabled="disabled"' : '';
                                            ?>
                                            <tr>
                                                <td><strong><?php echo $values['label']; ?></strong></td>
                                                <td class="current-val"><?php echo number_format($current, 1); ?></td>
                                                <td class="request-val"><?php echo number_format($request_val, 1); ?></td>
                                                <td>
                                                    <?php if ($key == 't_abi' || $key == 't_dem'): ?>
                                                        <?php if (!empty($admin_val) && $admin_val !== null): ?>
                                                            <span class="admin-value"><?php echo number_format($admin_val, 1); ?></span>
                                                        <?php else: ?>
                                                            <span style="color:#999;">(محاسبه می‌شود)</span>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <input type="text" name="admin_<?php echo $key; ?>" class="admin-input" 
                                                               value="<?php echo $admin_val !== null ? number_format($admin_val, 1) : number_format($request_val, 1); ?>" 
                                                               <?php echo $disabled; ?> />
                                                    <?php endif; ?>
                                                </td>
                                                <td class="<?php echo $change_class; ?>">
                                                    <?php echo $arrow . ' ' . $change_text; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    
                                    <!-- علت درخواست -->
                                    <div style="margin-top:20px;">
                                        <div style="font-weight:bold; color:#003366;">📝 علت درخواست:</div>
                                        <div class="reason-box">
                                            <div class="reason-text">
                                                <?php echo nl2br(htmlspecialchars($request['reason'])); ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- فایل پیوست -->
                                    <?php if (!empty($request['attachment'])): ?>
                                    <div style="margin-top:15px;">
                                        <div style="font-weight:bold; color:#003366;">📎 فایل پیوست:</div>
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
                                    
                                    <!-- بخش اقدام مدیر -->
                                    <?php if ($request['status'] == 'pending' || $request['status'] == 'reviewing'): ?>
                                    <div class="action-box">
                                        <div class="action-label">⚙️ اقدام مدیر</div>
                                        
                                        <div style="margin-bottom:15px;">
                                            <label style="font-weight:bold; color:#003366;">یادداشت مدیر:</label><br />
                                            <textarea name="admin_note" class="admin-note" rows="3" placeholder="دلیل تأیید یا رد را وارد کنید..."></textarea>
                                        </div>
                                        
                                        <div class="btn-actions">
                                            <button type="submit" name="action" value="approve" class="btn-approve">✅ تأیید درخواست</button>
                                            <button type="submit" name="action" value="reject" class="btn-reject">❌ رد درخواست</button>
                                            <a href="Agri_ab_request_manage.php" class="btn-back">🔙 بازگشت</a>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="action-box" style="background:#f5f5f5;">
                                        <div class="action-label" style="color:#999;">⚙️ این درخواست قبلاً تعیین تکلیف شده است</div>
                                        <div class="btn-actions">
                                            <a href="Agri_ab_request_manage.php" class="btn-back">🔙 بازگشت به لیست</a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    
                                    </form>
                                </div>
                                
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