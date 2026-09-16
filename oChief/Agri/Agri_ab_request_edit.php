<?php 
include('../../lock_oce.php');
include('../../event.php');
require_once('../../Jalali.php');
require_once('validate_city.php');
date_default_timezone_set('Asia/Tehran');

// ============================================================
// دریافت ID از POST به جای GET
// ============================================================
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id == 0) {
    header('Location: Agri_ab_request_list.php');
    exit;
}

// دریافت اطلاعات درخواست
$query = "SELECT * FROM Agri_ab_request WHERE id = ? AND id_ostan = ?";
$stmt = $dbh->prepare($query);
$stmt->execute(array($id, $id_ostan));
$request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$request) {
    header('Location: Agri_ab_request_list.php');
    exit;
}

// بررسی وضعیت درخواست (فقط pending و reviewing قابل ویرایش هستند)
if ($request['status'] != 'pending' && $request['status'] != 'reviewing') {
    echo '<script>alert("این درخواست قبلاً تأیید یا رد شده است و قابل ویرایش نیست."); window.location.href="Agri_ab_request_list.php";</script>';
    exit;
}

// دریافت نام استان برای نمایش
$query_ostan = "SELECT ostan FROM ostanname WHERE id_ostan = ?";
$stmt_ostan = $dbh->prepare($query_ostan);
$stmt_ostan->execute(array($id_ostan));
$ostan_name = $stmt_ostan->fetchColumn();

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
        
        .edit-box {
            width: 90%;
            margin: 20px auto;
            padding: 25px;
            border: 2px solid #09C;
            border-radius: 15px;
            background: #f9f9f9;
        }
        
        .edit-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            border-bottom: 2px solid #006699;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .edit-header .title {
            font-size: 20px;
            font-weight: bold;
            color: #003366;
        }
        .edit-header .status-badge {
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
        
        .request-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Tahoma, Arial, sans-serif;
            font-size: 14px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
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
        .request-table .current-val {
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
        
        .reason-box {
            margin-top: 20px;
        }
        .reason-box textarea {
            width: 95%;
            padding: 8px;
            font-family: Tahoma;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .reason-box .char-count {
            font-size: 11px;
            color: #999;
            text-align: left;
            margin-top: 2px;
        }
        .reason-box .char-count.warning {
            color: #c62828;
            font-weight: bold;
        }
        
        .attachment-box {
            margin-top: 15px;
        }
        .attachment-box .file-hint {
            font-size: 11px;
            color: #999;
            display: block;
            margin-top: 3px;
        }
        .attachment-box .current-file {
            background: #e3f2fd;
            padding: 8px 12px;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        .attachment-box .current-file a {
            color: #006699;
            font-weight: bold;
            text-decoration: none;
        }
        .attachment-box .current-file a:hover {
            text-decoration: underline;
        }
        
        .required-star { color: #c62828; font-weight: bold; }
        
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
        
        .btn-cancel {
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
        .btn-cancel:hover {
            background: #777;
        }
        
        .btn-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
            justify-content: center;
        }
        
        .validation-error {
            color: #c62828;
            font-size: 12px;
            display: none;
            margin-top: 5px;
        }
        
        #form-message {
            display: none;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 4px;
            text-align: center;
        }
        
        @media (max-width: 900px) {
            .request-table { font-size: 12px; }
            .request-table th, .request-table td { padding: 6px 4px; }
            .request-table .request-input { width: 80px; height: 26px; font-size: 12px; }
            .edit-box { padding: 15px; }
            .edit-header .title { font-size: 16px; }
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
                            <span class="style8">ویرایش درخواست تغییر الگوی کشت</span><br />
                            
                            <div class="edit-box">
                                
                                <!-- هدر -->
                                <div class="edit-header">
                                    <div class="title">
                                        ✏️ ویرایش درخواست #<?php echo $request['id']; ?>
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
                                            <td width="20%"><span class="label">استان:</span></td>
                                            <td width="30%"><span class="value"><?php echo htmlspecialchars($ostan_name); ?></span></td>
                                            <td width="20%"><span class="label">تاریخ ثبت:</span></td>
                                            <td width="30%"><span class="value"><?php echo $request['created_at']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="label">سال زراعی:</span></td>
                                            <td><span class="value"><?php echo $request['z_sal']; ?></span></td>
                                            <td><span class="label">نام محصول:</span></td>
                                            <td><span class="value"><?php echo htmlspecialchars($request['product_name']); ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                                
                                <!-- فرم ویرایش -->
                                <form method="post" enctype="multipart/form-data" id="edit-form" action="Agri_ab_request_update.php">
                                    <input type="hidden" name="id" value="<?php echo $request['id']; ?>" />
                                    <input type="hidden" name="action" value="edit" />
                                    
                                    <!-- اضافه شدن cod_qroup -->
                                    <input type="hidden" name="cod_qroup" value="<?php echo htmlspecialchars($request['cod_qroup']); ?>" />
                                    
                                    <!-- مقادیر فعلی (ابلاغی) - برای کنترل تغییرات -->
                                    <input type="hidden" name="current_s_abi" value="<?php echo $request['current_s_abi']; ?>" />
                                    <input type="hidden" name="current_s_dem" value="<?php echo $request['current_s_dem']; ?>" />
                                    <input type="hidden" name="current_a_abi" value="<?php echo $request['current_a_abi']; ?>" />
                                    <input type="hidden" name="current_a_dem" value="<?php echo $request['current_a_dem']; ?>" />
                                    <input type="hidden" name="current_t_abi" value="<?php echo $request['current_t_abi']; ?>" />
                                    <input type="hidden" name="current_t_dem" value="<?php echo $request['current_t_dem']; ?>" />
                                    
                                    <table class="request-table">
                                        <thead>
                                            <tr>
                                                <th width="15%">فیلد</th>
                                                <th width="20%">مقدار ابلاغی فعلی</th>
                                                <th width="20%">مقدار درخواستی جدید</th>
                                                <th width="15%">وضعیت</th>
                                                <th width="15%">تولید محاسبه‌شده</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- سطح آبی -->
                                            <tr>
                                                <td><strong>سطح آبی</strong></td>
                                                <td class="current-val"><?php echo number_format($request['current_s_abi']); ?></td>
                                                <td>
                                                    <input type="text" name="request_s_abi" class="request-input" id="request_s_abi" 
                                                           value="<?php echo number_format($request['request_s_abi']); ?>" 
                                                           oninput="checkChange(this, 's_abi')" />
                                                </td>
                                                <td id="status_s_abi" class="no-change">➖ بدون تغییر</td>
                                                <td>-</td>
                                            </tr>
                                            <!-- سطح دیم -->
                                            <tr>
                                                <td><strong>سطح دیم</strong></td>
                                                <td class="current-val"><?php echo number_format($request['current_s_dem']); ?></td>
                                                <td>
                                                    <input type="text" name="request_s_dem" class="request-input" id="request_s_dem" 
                                                           value="<?php echo number_format($request['request_s_dem']); ?>" 
                                                           oninput="checkChange(this, 's_dem')" />
                                                </td>
                                                <td id="status_s_dem" class="no-change">➖ بدون تغییر</td>
                                                <td>-</td>
                                            </tr>
                                            <!-- عملکرد آبی -->
                                            <tr>
                                                <td><strong>عملکرد آبی</strong></td>
                                                <td class="current-val"><?php echo number_format($request['current_a_abi']); ?></td>
                                                <td>
                                                    <input type="text" name="request_a_abi" class="request-input" id="request_a_abi" 
                                                           value="<?php echo number_format($request['request_a_abi']); ?>" 
                                                           oninput="checkChange(this, 'a_abi')" />
                                                </td>
                                                <td id="status_a_abi" class="no-change">➖ بدون تغییر</td>
                                                <td id="calculated_t_abi_display" class="calculated-value">
                                                    <?php echo number_format(($request['request_a_abi'] * $request['request_s_abi']) / 1000, 1); ?>
                                                </td>
                                            </tr>
                                            <!-- عملکرد دیم -->
                                            <tr>
                                                <td><strong>عملکرد دیم</strong></td>
                                                <td class="current-val"><?php echo number_format($request['current_a_dem']); ?></td>
                                                <td>
                                                    <input type="text" name="request_a_dem" class="request-input" id="request_a_dem" 
                                                           value="<?php echo number_format($request['request_a_dem']); ?>" 
                                                           oninput="checkChange(this, 'a_dem')" />
                                                </td>
                                                <td id="status_a_dem" class="no-change">➖ بدون تغییر</td>
                                                <td id="calculated_t_dem_display" class="calculated-value">
                                                    <?php echo number_format(($request['request_a_dem'] * $request['request_s_dem']) / 1000, 1); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <!-- علت درخواست -->
                                    <div class="reason-box">
                                        <span class="style8"><span class="required-star">*</span> علت درخواست:</span>
                                        <textarea name="reason" id="reason" rows="3" maxlength="250" required><?php echo htmlspecialchars($request['reason']); ?></textarea>
                                        <div class="char-count" id="charCount"><?php echo mb_strlen($request['reason']); ?> / ۲۵۰ کاراکتر</div>
                                        <div class="validation-error" id="reason-error">⚠️ لطفاً علت درخواست را وارد کنید.</div>
                                    </div>
                                    
                                    <!-- فایل پیوست -->
                                    <div class="attachment-box">
                                        <span class="style8">فایل پیوست:</span>
                                        
                                        <?php if (!empty($request['attachment'])): ?>
                                        <div class="current-file">
                                            📎 فایل فعلی: <a href="../../<?php echo $request['attachment']; ?>" target="_blank"><?php echo basename($request['attachment']); ?></a>
                                            <label style="margin-right:15px; cursor:pointer;">
                                                <input type="checkbox" name="remove_attachment" value="1" /> حذف فایل
                                            </label>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <input type="file" name="attachment" id="attachment" accept=".doc,.docx,.xls,.xlsx,.pdf,.jpg,.jpeg,.png,.gif" style="padding:5px;" />
                                        <span class="file-hint">📎 حداکثر حجم فایل: ۱ مگابایت | فرمت‌های مجاز: doc, docx, xls, xlsx, pdf, jpg, jpeg, png, gif</span>
                                        <?php if (!empty($request['attachment'])): ?>
                                        <span style="font-size:11px; color:#666; display:block; margin-top:3px;">💡 در صورت انتخاب فایل جدید، فایل قبلی جایگزین می‌شود.</span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- پیام -->
                                    <div id="form-message"></div>
                                    
                                    <!-- دکمه‌ها -->
                                    <div class="btn-actions">
                                        <button type="submit" class="btn-save" id="submit-btn">💾 ذخیره تغییرات</button>
                                        <!-- تغییر لینک انصراف به فرم POST -->
                                        <form method="post" action="Agri_ab_request_detail.php" style="display:inline;">
                                            <input type="hidden" name="id" value="<?php echo $request['id']; ?>">
                                            <button type="submit" class="btn-cancel">🔙 انصراف</button>
                                        </form>
                                    </div>
                                </form>
                                
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
    // شمارنده کاراکتر
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
    // محاسبه تولید
    // ============================================================
    function calculateProduction() {
        var s_abi = parseFloat(unformatNumber(document.getElementById('request_s_abi').value)) || 0;
        var s_dem = parseFloat(unformatNumber(document.getElementById('request_s_dem').value)) || 0;
        var a_abi = parseFloat(unformatNumber(document.getElementById('request_a_abi').value)) || 0;
        var a_dem = parseFloat(unformatNumber(document.getElementById('request_a_dem').value)) || 0;
        
        var t_abi = (a_abi * s_abi) / 1000;
        var t_dem = (a_dem * s_dem) / 1000;
        
        document.getElementById('calculated_t_abi_display').innerHTML = formatNumber(t_abi.toFixed(1));
        document.getElementById('calculated_t_dem_display').innerHTML = formatNumber(t_dem.toFixed(1));
    }
    
    // ============================================================
    // بررسی تغییرات
    // ============================================================
    function checkChange(input, field) {
        var value = parseFloat(unformatNumber(input.value)) || 0;
        var current = parseFloat(document.querySelector('input[name="current_' + field + '"]').value) || 0;
        var statusEl = document.getElementById('status_' + field);
        
        if (value > current) {
            statusEl.innerHTML = '⬆️ افزایش (' + formatNumber(value - current) + ')';
            statusEl.style.color = '#2e7d32';
            statusEl.style.fontWeight = 'bold';
        } else if (value < current) {
            statusEl.innerHTML = '⬇️ کاهش (' + formatNumber(current - value) + ')';
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
    // بررسی حداقل یک تغییر
    // ============================================================
    function checkHasChange() {
        var fields = ['s_abi', 's_dem', 'a_abi', 'a_dem'];
        var hasChange = false;
        
        for (var i = 0; i < fields.length; i++) {
            var field = fields[i];
            var input = document.querySelector('input[name="request_' + field + '"]');
            if (!input) continue;
            var current = parseFloat(document.querySelector('input[name="current_' + field + '"]').value) || 0;
            var value = parseFloat(unformatNumber(input.value)) || 0;
            
            if (value != current) {
                hasChange = true;
                break;
            }
        }
        
        document.getElementById('submit-btn').disabled = !hasChange;
    }
    
    // ============================================================
    // اعتبارسنجی و ارسال فرم
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
        
        $('#edit-form').on('submit', function(e) {
            e.preventDefault();
            
            $('#form-message').hide();
            
            // بررسی علت درخواست
            var reason = document.getElementById('reason').value.trim();
            if (reason == '') {
                document.getElementById('reason-error').style.display = 'block';
                return false;
            } else {
                document.getElementById('reason-error').style.display = 'none';
            }
            
            if (reason.length > 250) {
                alert('⚠️ متن علت درخواست نباید بیشتر از ۲۵۰ کاراکتر باشد.');
                return false;
            }
            
            // بررسی حجم فایل
            var fileInput = document.getElementById('attachment');
            if (fileInput.files.length > 0) {
                var fileSize = fileInput.files[0].size;
                var maxSize = 1 * 1024 * 1024;
                if (fileSize > maxSize) {
                    $('#form-message')
                        .html('❌ حجم فایل انتخابی بیشتر از ۱ مگابایت است.')
                        .css({
                            'display': 'block',
                            'background': '#ffebee',
                            'color': '#c62828',
                            'border': '1px solid #c62828'
                        });
                    return false;
                }
            }
            
            // بررسی حداقل یک تغییر
            var fields = ['s_abi', 's_dem', 'a_abi', 'a_dem'];
            var hasChange = false;
            for (var i = 0; i < fields.length; i++) {
                var field = fields[i];
                var input = document.querySelector('input[name="request_' + field + '"]');
                if (!input) continue;
                var current = parseFloat(document.querySelector('input[name="current_' + field + '"]').value) || 0;
                var value = parseFloat(unformatNumber(input.value)) || 0;
                if (value != current) {
                    hasChange = true;
                    break;
                }
            }
            
            if (!hasChange) {
                alert('⚠️ حداقل یک فیلد (سطح یا عملکرد) باید تغییر کند.');
                return false;
            }
            
            // ارسال فرم
            $('#submit-btn').prop('disabled', true).text('⏳ در حال ذخیره...');
            
            var formData = new FormData(this);
            
            // محاسبه تولید
            var s_abi = parseFloat(unformatNumber(document.getElementById('request_s_abi').value)) || 0;
            var s_dem = parseFloat(unformatNumber(document.getElementById('request_s_dem').value)) || 0;
            var a_abi = parseFloat(unformatNumber(document.getElementById('request_a_abi').value)) || 0;
            var a_dem = parseFloat(unformatNumber(document.getElementById('request_a_dem').value)) || 0;
            
            formData.append('calculated_t_abi', (a_abi * s_abi) / 1000);
            formData.append('calculated_t_dem', (a_dem * s_dem) / 1000);
            
            $.ajax({
                url: 'Agri_ab_request_update.php',
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
                            // تغییر به فرم POST
                            var form = document.createElement('form');
                            form.method = 'post';
                            form.action = 'Agri_ab_request_detail.php';
                            var input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'id';
                            input.value = '<?php echo $request['id']; ?>';
                            form.appendChild(input);
                            document.body.appendChild(form);
                            form.submit();
                        }, 2000);
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
    </script>
</body>
</html>