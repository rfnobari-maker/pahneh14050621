<?php 
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
require_once('validate_city.php');
date_default_timezone_set('Asia/Tehran');

$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

$id_ostan1 = $id_ostan;
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '1405';
$product_cod = isset($_POST['product_cod']) ? $_POST['product_cod'] : '';
$group_cod = isset($_POST['group_cod']) ? $_POST['group_cod'] : '';
$product_name = '';
$current_s_nobar_abi = 0;
$current_s_nobar_dem = 0;
$current_s_bar_abi = 0;
$current_s_bar_dem = 0;
$current_t_abi = 0;
$current_t_dem = 0;
$current_a_abi = 0;
$current_a_dem = 0;

// اگر محصول انتخاب شده، اطلاعات ابلاغی را دریافت کن
if (!empty($product_cod) && !empty($z_sal)) {
    $query = "SELECT product_name, s_nobar_abi, s_nobar_dem, s_bar_abi, s_bar_dem, t_abi, t_dem, a_abi, a_dem 
              FROM Garden_ab_ostan 
              WHERE id_ostan = ? AND z_sal = ? AND product_cod = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array($id_ostan1, $z_sal, $product_cod));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $product_name = $row['product_name'];
        $current_s_nobar_abi = floatval($row['s_nobar_abi']);
        $current_s_nobar_dem = floatval($row['s_nobar_dem']);
        $current_s_bar_abi = floatval($row['s_bar_abi']);
        $current_s_bar_dem = floatval($row['s_bar_dem']);
        $current_t_abi = floatval($row['t_abi']);
        $current_t_dem = floatval($row['t_dem']);
        $current_a_abi = floatval($row['a_abi']);
        $current_a_dem = floatval($row['a_dem']);
    }
}

// بررسی وجود درخواست تایید/رد نشده برای این محصول
$has_pending_request = false;
if (!empty($product_cod) && !empty($z_sal)) {
    $query_check = "SELECT COUNT(*) FROM Garden_ab_request 
                    WHERE id_ostan = ? AND z_sal = ? AND product_cod = ? 
                    AND status IN ('pending', 'reviewing')";
    $stmt_check = $dbh->prepare($query_check);
    $stmt_check->execute(array($id_ostan1, $z_sal, $product_cod));
    $has_pending_request = ($stmt_check->fetchColumn() > 0);
}

// گرفتن لیست گروه‌ها
$query_groups = "SELECT DISTINCT group_cod, group_name FROM product_b_new ORDER BY group_cod ASC";
$stmt_groups = $dbh->prepare($query_groups);
$stmt_groups->execute();
$groups = $stmt_groups->fetchAll(PDO::FETCH_ASSOC);

// دریافت لیست محصولات برای گروه انتخاب شده
$products = array();
if (!empty($group_cod)) {
    $query_prod = "SELECT product_cod, product_name FROM product_b_new WHERE group_cod = ? ORDER BY product_name ASC";
    $stmt_prod = $dbh->prepare($query_prod);
    $stmt_prod->execute(array($group_cod));
    $products = $stmt_prod->fetchAll(PDO::FETCH_ASSOC);
}

// دریافت نام گروه برای نمایش
$group_name_display = '';
foreach($groups as $g) {
    if ($g['group_cod'] == $group_cod) {
        $group_name_display = $g['group_name'];
        break;
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
    
    <style type="text/css">
        body { text-align: right; font-family: Tahoma; }
        .style1 { color: #003366; font-family: Tahoma; font-size: 18px; }
        .style8 { font-family: Tahoma; font-size: 14px; }
        
        .request-box {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #09C;
            border-radius: 15px;
            background: #f9f9f9;
        }
        .request-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Tahoma, Arial, sans-serif;
            font-size: 14px;
        }
        .request-table th {
            background: #006699;
            color: #fff;
            padding: 10px 8px;
            text-align: center;
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
        .request-table .current-value {
            color: #003366;
            font-weight: bold;
        }
        .request-table .request-input {
            width: 120px;
            height: 30px;
            text-align: center;
            font-family: Tahoma;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .request-table .request-input:focus {
            border-color: #006699;
            box-shadow: 0 0 5px rgba(0,102,153,0.3);
        }
        .request-table .request-input:disabled {
            background: #f0f0f0;
            color: #999;
        }
        .request-table .no-change {
            color: #999;
            font-style: italic;
        }
        .request-table .calculated-value {
            color: #006699;
            font-weight: bold;
            background: #e3f2fd;
            padding: 3px 8px;
            border-radius: 4px;
        }
        
        .info-box {
            background: #e3f2fd;
            border: 2px solid #006699;
            border-radius: 8px;
            padding: 12px 20px;
            margin: 15px auto;
            width: 90%;
            text-align: right;
            font-family: Tahoma;
            font-size: 14px;
            line-height: 2;
        }
        .info-box .label { font-weight: bold; color: #003366; }
        .info-box .value { color: #006699; font-weight: bold; }
        .info-box .warning { color: #e65100; font-weight: bold; }
        .info-box .sub-label { font-size: 12px; color: #666; }
        
        .required-star { color: #c62828; font-weight: bold; }
        
        .submit-btn {
            padding: 10px 30px;
            background: #006699;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-family: Tahoma;
        }
        .submit-btn:hover {
            background: #004d80;
        }
        .submit-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .cancel-btn {
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
        .cancel-btn:hover {
            background: #777;
        }
        
        .select-style {
            width: 220px;
            height: 40px;
            font-family: Tahoma;
            font-size: 14px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        .validation-error {
            color: #c62828;
            font-size: 12px;
            display: none;
            margin-top: 5px;
        }
        
        .file-hint {
            font-size: 11px;
            color: #999;
            display: block;
            margin-top: 3px;
        }
        
        .char-count {
            font-size: 11px;
            color: #999;
            text-align: left;
            margin-top: 2px;
        }
        .char-count.warning {
            color: #c62828;
            font-weight: bold;
        }
        
        .section-title {
            font-size: 15px;
            font-weight: bold;
            color: #003366;
            border-right: 4px solid #006699;
            padding-right: 10px;
            margin: 15px 0 10px 0;
        }
        
        @media (max-width: 900px) {
            .request-table { font-size: 12px; }
            .request-table .request-input { width: 80px; height: 26px; font-size: 12px; }
            .request-box { padding: 10px; }
            .select-style { width: 150px; }
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
                            <span class="style8">درخواست تغییر الگوی کشت باغی</span><br />
                            
                            <?php if (!empty($product_cod) && $has_pending_request): ?>
                            <div class="info-box" style="background:#ffebee; border-color:#c62828;">
                                <span style="color:#c62828; font-weight:bold;">⚠️ درخواست قبلی برای این محصول در انتظار تأیید است.</span><br />
                                تا زمانی که درخواست قبلی تأیید یا رد نشود، امکان ثبت درخواست جدید وجود ندارد.
                                <a href="Garden_ab_request_list.php" style="color:#006699;">مشاهده درخواست‌های من</a>
                            </div>
                            <?php endif; ?>
                            
                            <div class="request-box">
                                <!-- فرم انتخاب گروه و محصول -->
                                <form id="request-form" method="post" action="">
                                    <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
                                    
                                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                        <tr>
                                            <td width="15%"><span class="style8">سال:</span></td>
                                            <td width="35%">
                                                <select name="z_sal" class="select-style" id="z_sal" onchange="this.form.submit()">
                                                    <option value="1405" <?php if ($z_sal == '1405') echo 'selected="selected"'; ?>>1405</option>
                                                    <option value="1404" <?php if ($z_sal == '1404') echo 'selected="selected"'; ?>>1404</option>
                                                    <option value="1403" <?php if ($z_sal == '1403') echo 'selected="selected"'; ?>>1403</option>
                                                    <option value="1402" <?php if ($z_sal == '1402') echo 'selected="selected"'; ?>>1402</option>
                                                </select>
                                            </td>
                                            <td width="15%"><span class="style8">گروه محصول:</span></td>
                                            <td width="35%">
                                                <select name="group_cod" class="select-style" id="group_cod" onchange="this.form.submit()">
                                                    <option value="">انتخاب گروه</option>
                                                    <?php foreach($groups as $g): ?>
                                                    <option value="<?php echo $g['group_cod']; ?>" <?php if ($group_cod == $g['group_cod']) echo 'selected="selected"'; ?>>
                                                        <?php echo htmlspecialchars($g['group_name']); ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="style8">نام محصول:</span></td>
                                            <td>
                                                <select name="product_cod" class="select-style" id="product_cod" onchange="this.form.submit()">
                                                    <option value="">انتخاب محصول</option>
                                                    <?php foreach($products as $p): ?>
                                                    <option value="<?php echo $p['product_cod']; ?>" <?php if ($product_cod == $p['product_cod']) echo 'selected="selected"'; ?>>
                                                        <?php echo htmlspecialchars($p['product_name']); ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                </form>
                                
                                <?php if (!empty($product_cod) && !empty($product_name) && !$has_pending_request): ?>
                                
                                <hr style="border: 1px solid #09C; margin: 20px 0;" />
                                
                                <div class="info-box">
                                    <div style="font-size:16px; font-weight:bold; color:#003366; border-bottom:1px solid #006699; padding-bottom:5px; margin-bottom:8px;">
                                        🌳 اطلاعات ابلاغی فعلی - <?php echo htmlspecialchars($product_name); ?>
                                    </div>
                                    <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                        <tr>
                                            <td width="20%"><span class="label">گروه محصول:</span></td>
                                            <td width="30%"><span class="value"><?php echo htmlspecialchars($group_name_display); ?></span></td>
                                            <td width="20%"><span class="label">سال:</span></td>
                                            <td width="30%"><span class="value"><?php echo $z_sal; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="font-weight:bold; color:#003366; border-bottom:1px solid #ccc; padding-bottom:3px; padding-top:8px;">📊 سطوح</td>
                                        </tr>
                                        <tr>
                                            <td><span class="label">سطح غیر بارور آبی:</span></td>
                                            <td><span class="value"><?php echo number_format($current_s_nobar_abi, 1); ?></span></td>
                                            <td><span class="label">سطح غیر بارور دیم:</span></td>
                                            <td><span class="value"><?php echo number_format($current_s_nobar_dem, 1); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="label">سطح بارور آبی:</span></td>
                                            <td><span class="value"><?php echo number_format($current_s_bar_abi, 1); ?></span></td>
                                            <td><span class="label">سطح بارور دیم:</span></td>
                                            <td><span class="value"><?php echo number_format($current_s_bar_dem, 1); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="font-weight:bold; color:#003366; border-bottom:1px solid #ccc; padding-bottom:3px; padding-top:8px;">📈 تولید و عملکرد</td>
                                        </tr>
                                        <tr>
                                            <td><span class="label">عملکرد آبی:</span></td>
                                            <td><span class="value"><?php echo number_format($current_a_abi, 2); ?></span></td>
                                            <td><span class="label">عملکرد دیم:</span></td>
                                            <td><span class="value"><?php echo number_format($current_a_dem, 2); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="label">تولید آبی (بارور):</span></td>
                                            <td><span class="value"><?php echo number_format($current_t_abi, 1); ?></span></td>
                                            <td><span class="label">تولید دیم (بارور):</span></td>
                                            <td><span class="value"><?php echo number_format($current_t_dem, 1); ?></span></td>
                                        </tr>
                                    </table>
                                    <div style="font-size:12px; color:#666; margin-top:5px; border-top:1px solid #ccc; padding-top:5px;">
                                        💡 شما می‌توانید <strong>سطح</strong> و <strong>عملکرد</strong> را تغییر دهید. 
                                        <strong>تولید</strong> به‌صورت خودکار از سطح بارور محاسبه می‌شود.
                                        <span style="color:#e65100;">⚠️ سطح غیر بارور تولید ندارد.</span>
                                    </div>
                                </div>
                                
                                <!-- فرم اصلی ثبت درخواست -->
                                <form method="post" enctype="multipart/form-data" id="main-form">
                                    <input type="hidden" name="id_ostan" value="<?php echo htmlspecialchars($id_ostan1); ?>" />
                                    <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal); ?>" />
                                    <input type="hidden" name="product_cod" value="<?php echo htmlspecialchars($product_cod); ?>" />
                                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>" />
                                    <input type="hidden" name="action" value="save" />
                                    <input type="hidden" name="group_cod" value="<?php echo htmlspecialchars($group_cod); ?>" />
                                    
                                    <!-- مقادیر فعلی (ابلاغی) -->
                                    <input type="hidden" name="current_s_nobar_abi" value="<?php echo $current_s_nobar_abi; ?>" />
                                    <input type="hidden" name="current_s_nobar_dem" value="<?php echo $current_s_nobar_dem; ?>" />
                                    <input type="hidden" name="current_s_bar_abi" value="<?php echo $current_s_bar_abi; ?>" />
                                    <input type="hidden" name="current_s_bar_dem" value="<?php echo $current_s_bar_dem; ?>" />
                                    <input type="hidden" name="current_t_abi" value="<?php echo $current_t_abi; ?>" />
                                    <input type="hidden" name="current_t_dem" value="<?php echo $current_t_dem; ?>" />
                                    <input type="hidden" name="current_a_abi" value="<?php echo $current_a_abi; ?>" />
                                    <input type="hidden" name="current_a_dem" value="<?php echo $current_a_dem; ?>" />
                                    
                                    <table class="request-table">
                                        <thead>
                                            <tr>
                                                <th width="15%">فیلد</th>
                                                <th width="15%">مقدار ابلاغی فعلی</th>
                                                <th width="20%">مقدار درخواستی جدید</th>
                                                <th width="15%">وضعیت</th>
                                                <th width="20%">تولید محاسبه‌شده</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- سطح غیر بارور آبی -->
                                            <tr>
                                                <td><strong>سطح غیر بارور آبی</strong><br><span style="font-size:11px;color:#999;">(نهال)</span></td>
                                                <td class="current-value"><?php echo number_format($current_s_nobar_abi, 1); ?></td>
                                                <td>
                                                    <input type="text" name="request_s_nobar_abi" class="request-input" id="request_s_nobar_abi" 
                                                           value="<?php echo number_format($current_s_nobar_abi, 1); ?>" 
                                                           oninput="checkChange(this, 's_nobar_abi')" />
                                                </td>
                                                <td id="status_s_nobar_abi" class="no-change">➖ بدون تغییر</td>
                                                <td>-</td>
                                            </tr>
                                            <!-- سطح غیر بارور دیم -->
                                            <tr>
                                                <td><strong>سطح غیر بارور دیم</strong><br><span style="font-size:11px;color:#999;">(نهال)</span></td>
                                                <td class="current-value"><?php echo number_format($current_s_nobar_dem, 1); ?></td>
                                                <td>
                                                    <input type="text" name="request_s_nobar_dem" class="request-input" id="request_s_nobar_dem" 
                                                           value="<?php echo number_format($current_s_nobar_dem, 1); ?>" 
                                                           oninput="checkChange(this, 's_nobar_dem')" />
                                                </td>
                                                <td id="status_s_nobar_dem" class="no-change">➖ بدون تغییر</td>
                                                <td>-</td>
                                            </tr>
                                            <!-- سطح بارور آبی -->
                                            <tr>
                                                <td><strong>سطح بارور آبی</strong></td>
                                                <td class="current-value"><?php echo number_format($current_s_bar_abi, 1); ?></td>
                                                <td>
                                                    <input type="text" name="request_s_bar_abi" class="request-input" id="request_s_bar_abi" 
                                                           value="<?php echo number_format($current_s_bar_abi, 1); ?>" 
                                                           oninput="checkChange(this, 's_bar_abi')" />
                                                </td>
                                                <td id="status_s_bar_abi" class="no-change">➖ بدون تغییر</td>
                                                <td id="calculated_t_abi_display" class="calculated-value">
                                                    <?php echo number_format(($current_s_bar_abi * $current_a_abi) / 1000, 1); ?>
                                                </td>
                                            </tr>
                                            <!-- سطح بارور دیم -->
                                            <tr>
                                                <td><strong>سطح بارور دیم</strong></td>
                                                <td class="current-value"><?php echo number_format($current_s_bar_dem, 1); ?></td>
                                                <td>
                                                    <input type="text" name="request_s_bar_dem" class="request-input" id="request_s_bar_dem" 
                                                           value="<?php echo number_format($current_s_bar_dem, 1); ?>" 
                                                           oninput="checkChange(this, 's_bar_dem')" />
                                                </td>
                                                <td id="status_s_bar_dem" class="no-change">➖ بدون تغییر</td>
                                                <td id="calculated_t_dem_display" class="calculated-value">
                                                    <?php echo number_format(($current_s_bar_dem * $current_a_dem) / 1000, 1); ?>
                                                </td>
                                            </tr>
                                            <!-- عملکرد آبی -->
                                            <tr>
                                                <td><strong>عملکرد آبی</strong></td>
                                                <td class="current-value"><?php echo number_format($current_a_abi, 2); ?></td>
                                                <td>
                                                    <input type="text" name="request_a_abi" class="request-input" id="request_a_abi" 
                                                           value="<?php echo number_format($current_a_abi, 2); ?>" 
                                                           oninput="checkChange(this, 'a_abi')" />
                                                </td>
                                                <td id="status_a_abi" class="no-change">➖ بدون تغییر</td>
                                                <td>-</td>
                                            </tr>
                                            <!-- عملکرد دیم -->
                                            <tr>
                                                <td><strong>عملکرد دیم</strong></td>
                                                <td class="current-value"><?php echo number_format($current_a_dem, 2); ?></td>
                                                <td>
                                                    <input type="text" name="request_a_dem" class="request-input" id="request_a_dem" 
                                                           value="<?php echo number_format($current_a_dem, 2); ?>" 
                                                           oninput="checkChange(this, 'a_dem')" />
                                                </td>
                                                <td id="status_a_dem" class="no-change">➖ بدون تغییر</td>
                                                <td>-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <div style="margin-top: 20px;">
                                        <table width="100%" border="0" cellpadding="5">
                                            <tr>
                                                <td width="15%"><span class="style8"><span class="required-star">*</span> علت درخواست:</span></td>
                                                <td>
                                                    <textarea name="reason" id="reason" rows="3" maxlength="250" style="width:95%; padding:8px; font-family:Tahoma; font-size:14px; border:1px solid #ccc; border-radius:4px;" required></textarea>
                                                    <div class="char-count" id="charCount">۰ / ۲۵۰ کاراکتر</div>
                                                    <div class="validation-error" id="reason-error">⚠️ لطفاً علت درخواست را وارد کنید.</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="style8">فایل پیوست:</span></td>
                                                <td>
                                                    <input type="file" name="attachment" id="attachment" accept=".doc,.docx,.xls,.xlsx,.pdf,.jpg,.jpeg,.png,.gif" style="padding:5px;" />
                                                    <span class="file-hint">📎 حداکثر حجم فایل: ۱ مگابایت | فرمت‌های مجاز: doc, docx, xls, xlsx, pdf, jpg, jpeg, png, gif</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align:center; padding-top:20px;">
                                                    <div id="form-message" style="display:none; margin-bottom:10px; padding:10px; border-radius:4px;"></div>
                                                    <button type="submit" class="submit-btn" id="submit-btn">📝 ثبت درخواست</button>
                                                    <a href="Garden_ab_request_list.php" class="cancel-btn">🔙 بازگشت به لیست درخواست‌ها</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </form>
                                
                                <?php elseif (!empty($product_cod) && $has_pending_request): ?>
                                <div style="text-align:center; padding:30px;">
                                    <a href="Garden_ab_request_list.php" class="submit-btn" style="text-decoration:none; display:inline-block;">🔙 مشاهده درخواست‌های من</a>
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
    
    // ============================================================
    // شمارنده کاراکتر علت درخواست
    // ============================================================
    $(document).ready(function() {
        $('#reason').on('input', function() {
            var count = $(this).val().length;
            $('#charCount').text(formatNumber(count) + ' / ۲۵۰ کاراکتر');
            if (count > 250) {
                $('#charCount').addClass('warning');
            } else {
                $('#charCount').removeClass('warning');
            }
        });
    });
    
    // ============================================================
    // محاسبه تولید از عملکرد و سطح بارور
    // ============================================================
    function calculateProduction() {
        var s_bar_abi = parseFloat(unformatNumber(document.getElementById('request_s_bar_abi').value)) || 0;
        var s_bar_dem = parseFloat(unformatNumber(document.getElementById('request_s_bar_dem').value)) || 0;
        var a_abi = parseFloat(unformatNumber(document.getElementById('request_a_abi').value)) || 0;
        var a_dem = parseFloat(unformatNumber(document.getElementById('request_a_dem').value)) || 0;
        
        var t_abi = (s_bar_abi * a_abi) / 1000;
        var t_dem = (s_bar_dem * a_dem) / 1000;
        
        document.getElementById('calculated_t_abi_display').innerHTML = formatNumber(t_abi.toFixed(1));
        document.getElementById('calculated_t_dem_display').innerHTML = formatNumber(t_dem.toFixed(1));
    }
    
    // ============================================================
    // بررسی تغییرات و نمایش وضعیت
    // ============================================================
    function checkChange(input, field) {
        var value = parseFloat(unformatNumber(input.value)) || 0;
        var current = parseFloat(document.querySelector('input[name="current_' + field + '"]').value) || 0;
        var statusEl = document.getElementById('status_' + field);
        
        if (value > current) {
            statusEl.innerHTML = '⬆️ افزایش (' + formatNumber((value - current).toFixed(1)) + ')';
            statusEl.style.color = '#2e7d32';
            statusEl.style.fontWeight = 'bold';
        } else if (value < current) {
            statusEl.innerHTML = '⬇️ کاهش (' + formatNumber((current - value).toFixed(1)) + ')';
            statusEl.style.color = '#c62828';
            statusEl.style.fontWeight = 'bold';
        } else {
            statusEl.innerHTML = '➖ بدون تغییر';
            statusEl.style.color = '#999';
            statusEl.style.fontWeight = 'normal';
        }
        
        calculateProduction();
        checkHasChange();
    }
    
    // ============================================================
    // بررسی اینکه حداقل یک فیلد تغییر کرده باشد
    // ============================================================
    function checkHasChange() {
        var fields = ['s_nobar_abi', 's_nobar_dem', 's_bar_abi', 's_bar_dem', 'a_abi', 'a_dem'];
        var hasChange = false;
        
        for (var i = 0; i < fields.length; i++) {
            var field = fields[i];
            var input = document.querySelector('input[name="request_' + field + '"]');
            if (!input) continue;
            var current = parseFloat(document.querySelector('input[name="current_' + field + '"]').value) || 0;
            var value = parseFloat(unformatNumber(input.value)) || 0;
            
            if (Math.abs(value - current) > 0.01) {
                hasChange = true;
                break;
            }
        }
        
        document.getElementById('submit-btn').disabled = !hasChange;
    }
    
    // ============================================================
    // اعتبارسنجی فرم
    // ============================================================
    function validateForm() {
        var isValid = true;
        
        var reason = document.getElementById('reason').value.trim();
        if (reason == '') {
            document.getElementById('reason-error').style.display = 'block';
            isValid = false;
        } else {
            document.getElementById('reason-error').style.display = 'none';
        }
        
        if (reason.length > 250) {
            alert('⚠️ متن علت درخواست نباید بیشتر از ۲۵۰ کاراکتر باشد.');
            isValid = false;
        }
        
        var fields = ['s_nobar_abi', 's_nobar_dem', 's_bar_abi', 's_bar_dem', 'a_abi', 'a_dem'];
        var hasChange = false;
        
        for (var i = 0; i < fields.length; i++) {
            var field = fields[i];
            var input = document.querySelector('input[name="request_' + field + '"]');
            if (!input) continue;
            var current = parseFloat(document.querySelector('input[name="current_' + field + '"]').value) || 0;
            var value = parseFloat(unformatNumber(input.value)) || 0;
            
            if (Math.abs(value - current) > 0.01) {
                hasChange = true;
                break;
            }
        }
        
        if (!hasChange) {
            alert('⚠️ حداقل یک فیلد (سطح یا عملکرد) باید تغییر کند.');
            isValid = false;
        }
        
        return isValid;
    }
    
    // ============================================================
    // ثبت درخواست با AJAX
    // ============================================================
    $(document).ready(function() {
        $('.request-input').on('input', function() {
            var value = $(this).val().replace(/[^\d.]/g, '');
            var parts = value.split('.');
            if (parts.length > 2) value = parts[0] + '.' + parts.slice(1).join('');
            $(this).val(value ? formatNumber(value) : '');
        });
        
        calculateProduction();
        checkHasChange();
        
        $('#main-form').on('submit', function(e) {
            e.preventDefault();
            
            $('#form-message').hide();
            
            // بررسی حجم فایل قبل از ارسال
            var fileInput = document.getElementById('attachment');
            if (fileInput.files.length > 0) {
                var fileSize = fileInput.files[0].size;
                var maxSize = 1 * 1024 * 1024;
                
                if (fileSize > maxSize) {
                    $('#form-message')
                        .html('❌ حجم فایل انتخابی بیشتر از ۱ مگابایت است. لطفاً فایل کوچک‌تری انتخاب کنید.')
                        .css({
                            'display': 'block',
                            'background': '#ffebee',
                            'color': '#c62828',
                            'border': '1px solid #c62828'
                        });
                    return false;
                }
            }
            
            if (!validateForm()) {
                return false;
            }
            
            $('#submit-btn').prop('disabled', true).text('⏳ در حال ثبت...');
            
            var formData = new FormData(this);
            
            // دریافت و فرمت کردن اعداد
            var s_nobar_abi = parseFloat(unformatNumber(document.getElementById('request_s_nobar_abi').value)) || 0;
            var s_nobar_dem = parseFloat(unformatNumber(document.getElementById('request_s_nobar_dem').value)) || 0;
            var s_bar_abi = parseFloat(unformatNumber(document.getElementById('request_s_bar_abi').value)) || 0;
            var s_bar_dem = parseFloat(unformatNumber(document.getElementById('request_s_bar_dem').value)) || 0;
            var a_abi = parseFloat(unformatNumber(document.getElementById('request_a_abi').value)) || 0;
            var a_dem = parseFloat(unformatNumber(document.getElementById('request_a_dem').value)) || 0;
            
            // سطوح با ۱ رقم اعشار، عملکرد با ۲ رقم اعشار
            formData.append('request_s_nobar_abi', s_nobar_abi.toFixed(1));
            formData.append('request_s_nobar_dem', s_nobar_dem.toFixed(1));
            formData.append('request_s_bar_abi', s_bar_abi.toFixed(1));
            formData.append('request_s_bar_dem', s_bar_dem.toFixed(1));
            formData.append('request_a_abi', a_abi.toFixed(2));
            formData.append('request_a_dem', a_dem.toFixed(2));
            
            // محاسبه تولید از سطح بارور
            var calculated_t_abi = (s_bar_abi * a_abi) / 1000;
            var calculated_t_dem = (s_bar_dem * a_dem) / 1000;
            
            formData.append('calculated_t_abi', calculated_t_abi.toFixed(1));
            formData.append('calculated_t_dem', calculated_t_dem.toFixed(1));
            
            $.ajax({
                url: 'Garden_ab_request_save.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.valid) {
                        var changeList = '';
                        if (response.changes && response.changes.length > 0) {
                            changeList = '📋 تغییرات اعمال‌شده:\n' + response.changes.join('\n') + '\n';
                        }
                        
                        $('#form-message')
                            .html('✅ ' + response.message + '<br><br>' + changeList.replace(/\n/g, '<br>') + '🔢 شماره پیگیری: ' + response.request_id)
                            .css({
                                'display': 'block',
                                'background': '#e8f5e9',
                                'color': '#2e7d32',
                                'border': '1px solid #2e7d32'
                            });
                        
                        setTimeout(function() {
                            window.location.href = 'Garden_ab_request_list.php';
                        }, 3000);
                    } else {
                        $('#form-message')
                            .html('❌ ' + response.message)
                            .css({
                                'display': 'block',
                                'background': '#ffebee',
                                'color': '#c62828',
                                'border': '1px solid #c62828'
                            });
                        $('#submit-btn').prop('disabled', false).text('📝 ثبت درخواست');
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
                    $('#submit-btn').prop('disabled', false).text('📝 ثبت درخواست');
                }
            });
            
            return false;
        });
    });
    </script>
</body>
</html>