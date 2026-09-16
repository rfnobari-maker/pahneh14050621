<?php
session_start();
require_once("../../lock_cp.php");
require_once("../../event.php");
require_once('../../Jalali.php');
require_once('../side_menu1.php');
date_default_timezone_set('Asia/Tehran');

// ============================================================
// دریافت پارامترها از URL برای بازگشت
// ============================================================
$return_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$return_id_ostan = isset($_GET['id_ostan']) ? $_GET['id_ostan'] : '';
$return_z_sal = isset($_GET['z_sal']) ? $_GET['z_sal'] : '';
$return_group_cod = isset($_GET['group_cod']) ? $_GET['group_cod'] : '';
$return_product_cod = isset($_GET['product_cod']) ? $_GET['product_cod'] : '';
$return_status = isset($_GET['status']) ? $_GET['status'] : '';

// ============================================================
// ذخیره در Session برای بازگشت به مدیریت
// ============================================================
$_SESSION['garden_return_page'] = $return_page;
$_SESSION['garden_return_id_ostan'] = $return_id_ostan;
$_SESSION['garden_return_z_sal'] = $return_z_sal;
$_SESSION['garden_return_group_cod'] = $return_group_cod;
$_SESSION['garden_return_product_cod'] = $return_product_cod;
$_SESSION['garden_return_status'] = $return_status;

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id == 0) {
    header('Location: Garden_ab_request_admin.php');
    exit;
}

// ============================================================
// دریافت اطلاعات درخواست
// ============================================================
$query = "SELECT r.*, o.ostan, p.group_name 
          FROM Garden_ab_request r
          LEFT JOIN ostanname o ON r.id_ostan = o.id_ostan
          LEFT JOIN product_b_new p ON r.group_cod = p.group_cod
          WHERE r.id = ?";
$stmt = $dbh->prepare($query);
$stmt->execute(array($id));
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$request) {
    header('Location: Garden_ab_request_admin.php');
    exit;
}

// ============================================================
// بررسی قفل بودن درخواست (تأیید یا رد شده)
// ============================================================
$is_locked = ($request['status'] == 'approved' || $request['status'] == 'rejected');

// ============================================================
// تعیین مقادیر نمایشی برای فیلدهای مدیریت
// ============================================================
// اگر admin مقدار 0 یا null داشته باشد، از مقدار درخواستی استفاده کن
$admin_s_nobar_abi_val = ($request['admin_s_nobar_abi'] !== null && $request['admin_s_nobar_abi'] != 0) 
    ? $request['admin_s_nobar_abi'] 
    : $request['request_s_nobar_abi'];

$admin_s_nobar_dem_val = ($request['admin_s_nobar_dem'] !== null && $request['admin_s_nobar_dem'] != 0) 
    ? $request['admin_s_nobar_dem'] 
    : $request['request_s_nobar_dem'];

$admin_s_bar_abi_val = ($request['admin_s_bar_abi'] !== null && $request['admin_s_bar_abi'] != 0) 
    ? $request['admin_s_bar_abi'] 
    : $request['request_s_bar_abi'];

$admin_s_bar_dem_val = ($request['admin_s_bar_dem'] !== null && $request['admin_s_bar_dem'] != 0) 
    ? $request['admin_s_bar_dem'] 
    : $request['request_s_bar_dem'];

$admin_a_abi_val = ($request['admin_a_abi'] !== null && $request['admin_a_abi'] != 0) 
    ? $request['admin_a_abi'] 
    : $request['request_a_abi'];

$admin_a_dem_val = ($request['admin_a_dem'] !== null && $request['admin_a_dem'] != 0) 
    ? $request['admin_a_dem'] 
    : $request['request_a_dem'];

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

// محاسبه تولید از سطح بارور و عملکرد (درخواستی)
$calculated_t_abi = ($request['request_s_bar_abi'] * $request['request_a_abi']) / 1000;
$calculated_t_dem = ($request['request_s_bar_dem'] * $request['request_a_dem']) / 1000;

// ============================================================
// ساخت URL بازگشت به مدیریت با حفظ فیلترها
// ============================================================
$return_url = 'Garden_ab_request_admin.php';
$params = array();
if ($return_page > 1) $params[] = 'page=' . $return_page;
if (!empty($return_id_ostan)) $params[] = 'id_ostan=' . urlencode($return_id_ostan);
if (!empty($return_z_sal)) $params[] = 'z_sal=' . urlencode($return_z_sal);
if (!empty($return_group_cod)) $params[] = 'group_cod=' . urlencode($return_group_cod);
if (!empty($return_product_cod)) $params[] = 'product_cod=' . urlencode($return_product_cod);
if (!empty($return_status)) $params[] = 'status=' . urlencode($return_status);

if (!empty($params)) {
    $return_url .= '?' . implode('&', $params);
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
        body { text-align: right; font-family: Tahoma; direction:rtl }
        
        .admin-detail-box {
            width: 95%;
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
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 10px 20px;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            margin-bottom: 20px;
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
            font-size: 13px;
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
            width: 110px;
            height: 30px;
            text-align: center;
            font-family: Tahoma;
            font-size: 13px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .comparison-table .admin-input:focus {
            border-color: #006699;
            box-shadow: 0 0 5px rgba(0,102,153,0.3);
        }
        .comparison-table .admin-input:disabled {
            background: #f0f0f0;
            color: #666;
        }
        .comparison-table .admin-val {
            color: #2e7d32;
            font-weight: bold;
        }
        .comparison-table .status-change {
            font-weight: bold;
        }
        .comparison-table .status-change.increase {
            color: #2e7d32;
        }
        .comparison-table .status-change.decrease {
            color: #c62828;
        }
        .comparison-table .status-change.deleted {
            color: #c62828;
        }
        .comparison-table .status-change.nochange {
            color: #999;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #003366;
            border-right: 4px solid #006699;
            padding-right: 10px;
            margin: 20px 0 15px 0;
        }
        
        .reason-box {
            background: #fff3e0;
            border: 1px solid #ffcc80;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
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
            margin-bottom: 15px;
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
        
        .admin-edit-area {
            background: #fff;
            border: 2px solid #006699;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .admin-edit-area .edit-label {
            font-weight: bold;
            color: #003366;
            display: block;
            margin-bottom: 5px;
        }
        .admin-edit-area textarea {
            width: 95%;
            padding: 8px;
            font-family: Tahoma;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .admin-edit-area textarea:disabled {
            background: #f0f0f0;
            color: #666;
        }
        .admin-edit-area .status-select {
            width: 200px;
            height: 35px;
            font-family: Tahoma;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 5px;
        }
        .admin-edit-area .status-select:disabled {
            background: #f0f0f0;
            color: #666;
        }
        
        .btn-save {
            padding: 10px 30px;
            background: #2e7d32;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-family: Tahoma;
        }
        .btn-save:hover {
            background: #1b5e20;
        }
        .btn-save:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
            justify-content: center;
        }
        
        #form-message {
            display: none;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 4px;
            text-align: center;
        }
        
        .lock-banner {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 12px 20px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
            color: #856404;
            font-size: 15px;
        }
        
        @media (max-width: 900px) {
            .comparison-table { font-size: 12px; }
            .comparison-table th, .comparison-table td { padding: 6px 4px; }
            .comparison-table .admin-input { width: 80px; height: 26px; font-size: 12px; }
            .admin-detail-box { padding: 15px; }
            .detail-header .title { font-size: 16px; }
            .info-grid { grid-template-columns: 1fr; }
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
                    
                    <div class="admin-detail-box">
                        
                        <!-- ============================================================ -->
                        <!-- هدر -->
                        <!-- ============================================================ -->
                        <div class="detail-header">
                            <div class="title">
                                🌳 مدیریت درخواست #<?php echo $request['id']; ?>
                                <span style="font-size:14px; font-weight:normal; color:#666; margin-right:10px;">
                                    <?php echo htmlspecialchars($request['product_name']); ?>
                                    (سال <?php echo $request['z_sal']; ?>)
                                </span>
                            </div>
                            <div>
                                <span class="status-badge" style="background:<?php echo $status_colors[$request['status']]; ?>;">
                                    <?php echo $status_icons[$request['status']] . ' ' . $status_labels[$request['status']]; ?>
                                </span>
                            </div>
                        </div>
                        
                        <!-- ============================================================ -->
                        <!-- بنر قفل (در صورت تأیید یا رد شدن) -->
                        <!-- ============================================================ -->
                        <?php if ($is_locked): ?>
                        <div class="lock-banner">
                            🔒 این درخواست قبلاً <?php echo ($request['status'] == 'approved') ? 'تأیید' : 'رد'; ?> شده است و قابل ویرایش نیست.
                        </div>
                        <?php endif; ?>
                        
                        <!-- ============================================================ -->
                        <!-- اطلاعات کلی -->
                        <!-- ============================================================ -->
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
                                <span class="label">سال:</span>
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
                        
                        <!-- ============================================================ -->
                        <!-- علت درخواست -->
                        <!-- ============================================================ -->
                        <div class="section-title">📝 علت درخواست</div>
                        <div class="reason-box">
                            <div class="reason-label">📌 شرح درخواست:</div>
                            <div class="reason-text">
                                <?php echo nl2br(htmlspecialchars($request['reason'])); ?>
                            </div>
                        </div>
                        
                        <!-- ============================================================ -->
                        <!-- فایل پیوست -->
                        <!-- ============================================================ -->
                        <?php if (!empty($request['attachment'])): ?>
                        <div class="section-title">📎 فایل پیوست</div>
                        <div class="attachment-box">
                            <a href="../../<?php echo $request['attachment']; ?>" target="_blank">
                                📄 دانلود فایل پیوست
                            </a>
                            <span style="font-size:12px; color:#666; margin-right:10px;">
                                (<?php echo basename($request['attachment']); ?>)
                            </span>
                        </div>
                        <?php endif; ?>
                        
                        <!-- ============================================================ -->
                        <!-- فرم مدیریت -->
                        <!-- ============================================================ -->
                        <form id="admin-form" method="post" action="Garden_ab_request_admin_update.php">
                            <input type="hidden" name="id" value="<?php echo $request['id']; ?>" />
                            <input type="hidden" name="action" value="admin_update" />
                            
                            <div class="section-title">📊 مقایسه و ویرایش مقادیر</div>
                            <table class="comparison-table">
                                <thead>
                                    <tr>
                                        <th width="15%">فیلد</th>
                                        <th width="20%">مقدار ابلاغی فعلی</th>
                                        <th width="20%">مقدار درخواستی</th>
                                        <th width="25%">مقدار تأیید مدیر</th>
                                        <th width="20%">وضعیت تغییر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- سطح غیر بارور آبی -->
                                    <tr>
                                        <td><strong>سطح غیر بارور آبی</strong><br><span style="font-size:11px;color:#999;">(نهال)</span></td>
                                        <td class="current-val" id="current_s_nobar_abi"><?php echo number_format($request['current_s_nobar_abi'], 1); ?></td>
                                        <td class="request-val"><?php echo number_format($request['request_s_nobar_abi'], 1); ?></td>
                                        <td>
                                            <input type="text" name="admin_s_nobar_abi" class="admin-input" id="admin_s_nobar_abi"
                                                   value="<?php echo number_format($admin_s_nobar_abi_val, 1); ?>"
                                                   data-current="<?php echo $request['current_s_nobar_abi']; ?>"
                                                   <?php echo $is_locked ? 'disabled="disabled"' : ''; ?> />
                                        </td>
                                        <td id="status_s_nobar_abi" class="status-change nochange">➖ بدون تغییر</td>
                                    </tr>
                                    <!-- سطح غیر بارور دیم -->
                                    <tr>
                                        <td><strong>سطح غیر بارور دیم</strong><br><span style="font-size:11px;color:#999;">(نهال)</span></td>
                                        <td class="current-val" id="current_s_nobar_dem"><?php echo number_format($request['current_s_nobar_dem'], 1); ?></td>
                                        <td class="request-val"><?php echo number_format($request['request_s_nobar_dem'], 1); ?></td>
                                        <td>
                                            <input type="text" name="admin_s_nobar_dem" class="admin-input" id="admin_s_nobar_dem"
                                                   value="<?php echo number_format($admin_s_nobar_dem_val, 1); ?>"
                                                   data-current="<?php echo $request['current_s_nobar_dem']; ?>"
                                                   <?php echo $is_locked ? 'disabled="disabled"' : ''; ?> />
                                        </td>
                                        <td id="status_s_nobar_dem" class="status-change nochange">➖ بدون تغییر</td>
                                    </tr>
                                    <!-- سطح بارور آبی -->
                                    <tr>
                                        <td><strong>سطح بارور آبی</strong></td>
                                        <td class="current-val" id="current_s_bar_abi"><?php echo number_format($request['current_s_bar_abi'], 1); ?></td>
                                        <td class="request-val"><?php echo number_format($request['request_s_bar_abi'], 1); ?></td>
                                        <td>
                                            <input type="text" name="admin_s_bar_abi" class="admin-input" id="admin_s_bar_abi"
                                                   value="<?php echo number_format($admin_s_bar_abi_val, 1); ?>"
                                                   data-current="<?php echo $request['current_s_bar_abi']; ?>"
                                                   <?php echo $is_locked ? 'disabled="disabled"' : ''; ?> />
                                        </td>
                                        <td id="status_s_bar_abi" class="status-change nochange">➖ بدون تغییر</td>
                                    </tr>
                                    <!-- سطح بارور دیم -->
                                    <tr>
                                        <td><strong>سطح بارور دیم</strong></td>
                                        <td class="current-val" id="current_s_bar_dem"><?php echo number_format($request['current_s_bar_dem'], 1); ?></td>
                                        <td class="request-val"><?php echo number_format($request['request_s_bar_dem'], 1); ?></td>
                                        <td>
                                            <input type="text" name="admin_s_bar_dem" class="admin-input" id="admin_s_bar_dem"
                                                   value="<?php echo number_format($admin_s_bar_dem_val, 1); ?>"
                                                   data-current="<?php echo $request['current_s_bar_dem']; ?>"
                                                   <?php echo $is_locked ? 'disabled="disabled"' : ''; ?> />
                                        </td>
                                        <td id="status_s_bar_dem" class="status-change nochange">➖ بدون تغییر</td>
                                    </tr>
                                    <!-- عملکرد آبی -->
                                    <tr>
                                        <td><strong>عملکرد آبی</strong></td>
                                        <td class="current-val" id="current_a_abi"><?php echo number_format($request['current_a_abi'], 2); ?></td>
                                        <td class="request-val"><?php echo number_format($request['request_a_abi'], 2); ?></td>
                                        <td>
                                            <input type="text" name="admin_a_abi" class="admin-input" id="admin_a_abi"
                                                   value="<?php echo number_format($admin_a_abi_val, 2); ?>"
                                                   data-current="<?php echo $request['current_a_abi']; ?>"
                                                   <?php echo $is_locked ? 'disabled="disabled"' : ''; ?> />
                                        </td>
                                        <td id="status_a_abi" class="status-change nochange">➖ بدون تغییر</td>
                                    </tr>
                                    <!-- عملکرد دیم -->
                                    <tr>
                                        <td><strong>عملکرد دیم</strong></td>
                                        <td class="current-val" id="current_a_dem"><?php echo number_format($request['current_a_dem'], 2); ?></td>
                                        <td class="request-val"><?php echo number_format($request['request_a_dem'], 2); ?></td>
                                        <td>
                                            <input type="text" name="admin_a_dem" class="admin-input" id="admin_a_dem"
                                                   value="<?php echo number_format($admin_a_dem_val, 2); ?>"
                                                   data-current="<?php echo $request['current_a_dem']; ?>"
                                                   <?php echo $is_locked ? 'disabled="disabled"' : ''; ?> />
                                        </td>
                                        <td id="status_a_dem" class="status-change nochange">➖ بدون تغییر</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <!-- ============================================================ -->
                            <!-- بخش مدیریت -->
                            <!-- ============================================================ -->
                            <div class="admin-edit-area">
                                <div class="section-title" style="margin-top:0;">📌 مدیریت درخواست</div>
                                
                                <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                    <tr>
                                        <td width="15%"><span class="edit-label">وضعیت جدید:</span></td>
                                        <td width="35%">
                                            <select name="status" class="status-select" id="status" <?php echo $is_locked ? 'disabled="disabled"' : ''; ?>>
                                                <option value="pending" <?php if($request['status'] == 'pending') echo 'selected="selected"'; ?>>🕒 در انتظار تأیید</option>
                                                <option value="reviewing" <?php if($request['status'] == 'reviewing') echo 'selected="selected"'; ?>>🔄 در حال بررسی</option>
                                                <option value="approved" <?php if($request['status'] == 'approved') echo 'selected="selected"'; ?>>✅ تأیید شده</option>
                                                <option value="rejected" <?php if($request['status'] == 'rejected') echo 'selected="selected"'; ?>>❌ رد شده</option>
                                            </select>
                                        </td>
                                        <td width="50%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><span class="edit-label">یادداشت مدیر:</span></td>
                                        <td colspan="2">
                                            <textarea name="admin_note" rows="4" maxlength="500" placeholder="یادداشت خود را وارد کنید..." <?php echo $is_locked ? 'disabled="disabled"' : ''; ?>><?php echo htmlspecialchars($request['admin_note']); ?></textarea>
                                            <div style="font-size:11px; color:#999; text-align:left;">حداکثر ۵۰۰ کاراکتر</div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                            <!-- ============================================================ -->
                            <!-- پیغام -->
                            <!-- ============================================================ -->
                            <div id="form-message"></div>
                            
                            <!-- ============================================================ -->
                            <!-- دکمه‌ها -->
                            <!-- ============================================================ -->
                            <div class="btn-actions">
                                <?php if ($is_locked): ?>
                                <button type="button" class="btn-save" style="background:#999; cursor:not-allowed;" disabled>🔒 غیرقابل ویرایش</button>
                                <?php else: ?>
                                <button type="submit" class="btn-save" id="submit-btn">💾 ذخیره تغییرات</button>
                                <?php endif; ?>
                                <a href="<?php echo $return_url; ?>" class="btn-back">🔙 بازگشت به لیست مدیریت</a>
                            </div>
                        </form>
                        
                        <!-- ============================================================ -->
                        <!-- یادداشت قبلی مدیر (در صورت وجود) -->
                        <!-- ============================================================ -->
                        <?php if (!empty($request['admin_note'])): ?>
                        <div class="admin-note-box" style="margin-top:20px;">
                            <div class="admin-label">👤 یادداشت قبلی مدیر:</div>
                            <div class="admin-text">
                                <?php echo nl2br(htmlspecialchars($request['admin_note'])); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                    
                    <br />

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

<script>
// ============================================================
// فرمت عدد با جداکننده
// ============================================================
function formatNumber(num) {
    if (!num && num !== 0) return "";
    var parts = num.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "٬");
    return parts.join(".");
}

function unformatNumber(str) {
    if (!str) return "0";
    return str.replace(/[٬,]/g, "");
}

<?php if (!$is_locked): ?>
// ============================================================
// محاسبه وضعیت تغییر بر اساس مقدار admin نسبت به current
// ============================================================
function getStatusText(value, current) {
    if (value === '' || value === null || isNaN(value)) {
        return { text: '➖ بدون تغییر', class: 'nochange' };
    }
    
    var numValue = parseFloat(value);
    var numCurrent = parseFloat(current);
    
    if (numValue > numCurrent) {
        return { text: '⬆️ افزایش (' + formatNumber((numValue - numCurrent).toFixed(1)) + ')', class: 'increase' };
    } else if (numValue < numCurrent && numValue > 0) {
        return { text: '⬇️ کاهش (' + formatNumber((numCurrent - numValue).toFixed(1)) + ')', class: 'decrease' };
    } else if (numValue == 0) {
        return { text: '❌ حذف شده', class: 'deleted' };
    } else {
        return { text: '➖ بدون تغییر', class: 'nochange' };
    }
}

// ============================================================
// به‌روزرسانی وضعیت تغییر برای یک فیلد
// ============================================================
function updateStatus(field) {
    var input = document.getElementById('admin_' + field);
    var statusEl = document.getElementById('status_' + field);
    
    if (!input || !statusEl) return;
    
    var value = input.value.trim();
    var current = input.getAttribute('data-current') || 0;
    
    var status = getStatusText(value, current);
    statusEl.innerHTML = status.text;
    statusEl.className = 'status-change ' + status.class;
}

// ============================================================
// به‌روزرسانی همه وضعیت‌ها در بارگذاری صفحه
// ============================================================
function updateAllStatuses() {
    var fields = ['s_nobar_abi', 's_nobar_dem', 's_bar_abi', 's_bar_dem', 'a_abi', 'a_dem'];
    for (var i = 0; i < fields.length; i++) {
        updateStatus(fields[i]);
    }
}

// ============================================================
// اعتبارسنجی و ارسال فرم
// ============================================================
$(document).ready(function() {
    // به‌روزرسانی وضعیت‌ها در بارگذاری صفحه
    updateAllStatuses();
    
    $('.admin-input:not(:disabled)').on('input', function() {
        var value = $(this).val().replace(/[^\d.]/g, '');
        var parts = value.split('.');
        if (parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
        $(this).val(value ? formatNumber(value) : '');
        
        // تشخیص فیلد و به‌روزرسانی وضعیت
        var name = $(this).attr('name');
        var field = name.replace('admin_', '');
        updateStatus(field);
    });
    
    $('#admin-form').on('submit', function(e) {
        e.preventDefault();
        
        $('#form-message').hide();
        $('#submit-btn').prop('disabled', true).text('⏳ در حال ذخیره...');
        
        var formData = new FormData(this);
        
        $.ajax({
            url: 'Garden_ab_request_admin_update.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.valid) {
                    $('#form-message')
                        .html('✅ ' + response.message)
                        .css({
                            'display': 'block',
                            'background': '#e8f5e9',
                            'color': '#2e7d32',
                            'border': '1px solid #2e7d32'
                        });
                    setTimeout(function() {
                        window.location.href = '<?php echo $return_url; ?>';
                    }, 1500);
                } else {
                    $('#form-message')
                        .html('❌ ' + response.message)
                        .css({
                            'display': 'block',
                            'background': '#ffebee',
                            'color': '#c62828',
                            'border': '1px solid #c62828'
                        });
                    $('#submit-btn').prop('disabled', false).text('💾 ذخیره تغییرات');
                }
            },
            error: function(xhr, status, error) {
                $('#form-message')
                    .html('⚠️ خطا در ارتباط با سرور: ' + error)
                    .css({
                        'display': 'block',
                        'background': '#ffebee',
                        'color': '#c62828',
                        'border': '1px solid #c62828'
                    });
                $('#submit-btn').prop('disabled', false).text('💾 ذخیره تغییرات');
            }
        });
    });
});
<?php endif; ?>
</script>
</body>
</html>