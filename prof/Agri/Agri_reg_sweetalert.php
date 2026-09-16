<?php 
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
$z_sal     = isset($_POST['z_sal'])     ? $_POST['z_sal']     : '1404-1405';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';

$Agri_table      = 'Agri'.str_replace('-','_',$z_sal) ; 
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
<meta charset="utf-8" />
<title>گزارش زراعی و ثبت تغییرات</title>
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="../../assets/js/sweetalert2.all.min.js" type="text/javascript"></script>
<style>
html, body { background-color: #FFFFFF !important; margin: 0 !important; padding: 0 !important; font-family: Tahoma; }
table { border-collapse: collapse; margin: 0; padding: 0; border: none; }
.search-box { width: 425px; margin: 30px auto; padding: 20px; background: #fff; border: 1px solid #006699; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
.my-table { width: 98%; border-collapse: collapse; margin: 20px auto; background: #fff; font-size: 12px; }
.my-table th, .my-table td { border: 1px solid #ccc; padding: 10px; text-align: center; }
.header-blue { background-color: #006699; color: #fff; }
.btn1 { padding: 8px 15px; border: none; border-radius: 6px; color: white; cursor: pointer; text-decoration: none; font-size: 12px; margin: 2px; display: inline-block; font-weight: bold;}
.btn-green { background-color: #3498db; }
.btn-search { background-color: #006699; height: 35px; width: 100px; }
.tracking-link { display: block; text-align: center; margin-bottom: 15px; font-weight: bold; color: #d35400; text-decoration: none; }
.swal-input-custom { width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 4px; font-family: Tahoma; text-align: center; }
.swal-select { width: 100%; height: 38px; border: 1px solid #ccc; border-radius: 4px; font-family: Tahoma; }
.swal-label { font-size: 12px; text-align: right; display: block; margin: 6px 0 2px; }
.back-button {
display: flex; justify-content: center; align-items: center;
width: 180px; height: 50px; margin: 40px auto;
background: linear-gradient(135deg, #2563eb, #3b82f6) !important;
color: #ffffff !important; border: none; border-radius: 12px;
cursor: pointer; font-size: 16px; font-weight: bold;
text-decoration: none; transition: all 0.3s ease;
box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
}
.back-button:hover { transform: translateY(-3px); box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3); }
.footer { width: 100%; text-align: center; padding: 15px 0; color: #555; font-size: 12px; }
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr><td><img src="../../files/images/header.jpg" width="100%" height="149" style="display: block;" /></td></tr>
<tr><td><?php include('menu.php'); ?></td></tr>
<tr><td><?php include('top.php'); ?></td></tr>
</table>

<div style="min-height: 400px; background-color: #FFFFFF; padding-top: 10px;">
<div class="search-box">
<h3 align="center" style="color:#006699; margin-top: 0;">ثبت درخواست تغییر محصول / مساحت</h3>
<a href="tracking_requests.php" class="tracking-link">🔍 مشاهده و پیگیری درخواست‌ها</a>
<form method="post" action="">
<table width="100%" dir="rtl" style="border: none;">
<tr>
<td width="30%" height="49" align="right">سال زراعی:</td>
<td>
<select name="z_sal" required style="width: 200px; height: 35px; font-family: Tahoma;">
<option value="1404-1405" <?php echo ($z_sal == '1404-1405' ? 'selected' : ''); ?>>1404-1405</option>
</select>
</td>
</tr>
<tr>
<td height="42" align="right">کد ملی:</td>
<td><input type="text" name="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m); ?>" maxlength="10" required style="width: 195px; height: 30px;"></td>
</tr>
<tr>
<td colspan="2" align="center" style="padding-top:20px;">
<input type="submit" name="search" value="جستجو" class="btn1 btn-search">
</td>
</tr>
</table>
</form>
</div>

<?php
if (isset($_POST['search']) && !empty($bah_cod_m)) {

$sql = "SELECT p.* ,
(SELECT r.status FROM Agri_prod_req r
WHERE r.prod_id = p.id AND r.z_sal = :z_sal_sub
ORDER BY r.id DESC LIMIT 1) as status
FROM `$Agri_prod_table` p
WHERE p.bah_cod_m = :cod_m
AND p.id_mar = :id_mar
AND p.mor_cod_m = :login_session";

try {
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':cod_m', $bah_cod_m);
$stmt->bindParam(':id_mar', $id_mar);
$stmt->bindParam(':login_session', $login_session);
$stmt->bindParam(':z_sal_sub', $z_sal);
$stmt->execute();

if ($stmt->rowCount() > 0) {
?>
<table class="my-table" dir="rtl">
<tr class="header-blue">
<th rowspan="2">ردیف</th>
<th rowspan="2">آبادی /شهر</th>
<th rowspan="2">نام محصول</th>
<th rowspan="2">نوع کشت</th>
<th colspan="2">سطح زیر کشت<br>هکتار</th>
<th rowspan="2">پیش بینی تولید<br>تن</th>
<th rowspan="2">نام بهره‌بردار</th>
<th rowspan="2">عملیات</th>
</tr>
<tr class="header-blue">
<th>اول</th>
<th>دوم</th>
</tr>
<?php
$count = 1;
while ($row = $stmt->fetch()) {
$prod_name   = mah_name($row['cod_mah']);
$farmer_name = bah_name2($row['bah_cod_m'],$row['num_bah']);
?>
<tr>
<td><?php echo $count++; ?></td>
<td><?php echo abadi_name($row['add_abadi']).shahr_name($row['add_city']); ?></td>
<td><?php echo $prod_name; ?></td>
<td><?php if ($row['no_kesh'] =='1') echo 'آبی'; elseif ($row['no_kesh'] =='2') echo 'دیم'; ?></td>
<td><?php echo $row['zer_kesht_a']; ?></td>
<td><?php echo $row['zer_kesht_b']; ?></td>
<td><?php echo $row['mah_tolp']; ?></td>
<td><?php echo $farmer_name; ?></td>
<td>
<?php
    // اگر درخواستی با وضعیتی غیر از 3 وجود داشته باشد
    if (isset($row['status']) && $row['status'] !== null && !($row['status'] == 3 || $row['status'] == 33))
	{ 
    ?>
        <div style="color: #d35400; font-weight: bold; background: #fff3e0; padding: 5px; border: 1px solid #ffcc80; border-radius: 5px; font-size: 11px;">
            ⚠️ درخواست قبلی این محصول تاکنون تایید یا رد نهائی نشده است
        </div>
<?php } elseif (check_req($row['Agri_id']) > 0) { 
    ?>
        <div style="color: #d35400; font-weight: bold; background: #fff3e0; padding: 5px; border: 1px solid #ffcc80; border-radius: 5px; font-size: 11px;">
            ⚠️ درخواست یکی از محصولات این قطعه  تاکنون تایید یا رد نهائی نشده است
        </div>
    <?php } else { ?>
        <button type="button" 
                onclick="openEditModal('<?php echo $row['id']; ?>', '<?php echo $z_sal; ?>')" 
                class="btn1 btn-green">
            ثبت تغییر محصول / مساحت
        </button>
    <?php } ?>
</td>
        </tr>
        <?php } ?>
</table>
<?php
} else {
echo "<p align='center' style='color:red;'>اطلاعاتی یافت نشد.</p>";
}
} catch (PDOException $e) {
echo "<p align='center' style='color:red;'>خطا در جستجو: ".htmlspecialchars($e->getMessage())."</p>";
}
}
?>

<a href="./index.php" class="back-button">بازگشت</a>
</div>

<div class="footer">
<?php include('footer.php'); ?>
</div>

<script type="text/javascript">
function showAlert(type, title, text) {
Swal.fire({ icon: type, title: title, html: text, confirmButtonText: 'باشه' });
}

function openEditModal(id, z_sal) {
$.ajax({
url: 'check_status.php',
type: 'POST',
data: { id: id, z_sal: z_sal },
dataType: 'json',
success: function (response) {
if (response && response.status == 1) {
showAlert('info', 'اطلاع‌رسانی', 'تا کنون برای این محصول حواله‌ای صادر نشده است و تغییرات برای خود شما مقدور می‌باشد.');
} else if (response && response.status == 2) {
loadEditForm(id, z_sal);
} else {
showAlert('error', 'خطا', 'فعلاً امکان بررسی از سامانه پایش مقدور نیست.');
}
},
error: function () {
showAlert('error', 'خطا', 'ارتباط با سرور برقرار نشد.');
}
});
}

function loadEditForm(id, z_sal) {
$.ajax({
url: 'get_prod_details.php',
type: 'POST',
data: { id: id, z_sal: z_sal },
dataType: 'json',
success: function (data) {
if (!data || data.error) {
showAlert('error', 'خطا', 'اطلاعات یافت نشد.');
return;
}

var currentInfoTable =
'<table class="my-table" style="width:100%; margin-bottom:10px; border: 1px solid #ddd;" dir="rtl">' +
'<tr class="header-blue" style="background-color:#e3f2fd;color:#FFF">' +
'<th rowspan="2" bgcolor="#006699">نام محصول</th>' +
'<th colspan="2" bgcolor="#006699">سطح زیر کشت<br>(هکتار)</th>' +
'<th rowspan="2" bgcolor="#006699">پیش‌بینی تولید <br>(تن)</th>' +
'<th rowspan="2" bgcolor="#006699">کل مساحت زمین <br>(هکتار)</th>' +
'<th rowspan="2" bgcolor="#006699">سطح آیش <br>(هکتار)</th>' +
'<th rowspan="2" bgcolor="#006699">مجموع کشت اول <br>(هکتار)</th>' +
'<th rowspan="2" bgcolor="#006699">مجموع کشت دوم <br>(هکتار)</th>' +
'</tr>' +
'<tr class="header-blue" style="background-color:#e3f2fd;color:#FFF">' +
'<th bgcolor="#006699">اول</th><th bgcolor="#006699">دوم</th>' +
'</tr>' +
'<tr>' +
'<td>' + (data.prod_name || '') + '</td>' +
'<td>' + (data.zer_kesht_a || 0) + '</td>' +
'<td>' + (data.zer_kesht_b || 0) + '</td>' +
'<td>' + (data.mah_tolp || 0) + '</td>' +
'<td>' + (data.m_zamin || 0) + '</td>' +
'<td>' + (data.s_ayesh || 0) + '</td>' +
'<td>' + (data.kol_zer_a || 0) + '</td>' +
'<td>' + (data.kol_zer_b || 0) + '</td>' +
'</tr>' +
'</table>';

var groupSelect = '<select id="mah_qroup_popup" class="swal-select" name="mah_qroup">' + (data.group_list_html || '') + '</select>';
var productSelect = '<select id="mah_name_popup" class="swal-select" name="n_cod_mah">' +
'<option value="' + (data.cod_mah || '') + '" selected>' + (data.prod_name || '') + '</option>' +
'</select>';

var formHTML =
'<div dir="rtl" style="text-align:right">' +
'<input type="hidden" id="req_id" value="' + id + '">' +
'<input type="hidden" id="req_z_sal" value="' + z_sal + '">' +

'<h4 style="color:#2e7d32;margin:10px 0">درج مقادیر اصلاحی جدید:</h4>' +

'<div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;border-bottom:1px solid #c5e1a5;padding-bottom:12px;margin-bottom:12px">' +
'<div><label class="swal-label">گروه محصول:</label>' + groupSelect + '</div>' +
'<div><label class="swal-label">نام محصول:</label>' + productSelect + '</div>' +
'</div>' +

'<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:12px">' +
'<div><label class="swal-label">سطح زیر کشت اول جدید:</label><input type="number" step="0.0001" id="n_zer_a" class="swal-input-custom" value="' + (data.zer_kesht_a || 0) + '"></div>' +
'<div><label class="swal-label">سطح زیر کشت دوم جدید:</label><input type="number" step="0.0001" id="n_zer_b" class="swal-input-custom" value="' + (data.zer_kesht_b || 0) + '"></div>' +
'<div><label class="swal-label">پیش‌بینی تولید جدید (تن):</label><input type="number" step="0.1" id="n_pishbini" class="swal-input-custom" value="' + (data.mah_tolp || 0) + '" style="border:2px solid #2e7d32"></div>' +
'</div>' +

'<div style="margin-top:8px">' +
'<label class="swal-label">علت تغییر (حداکثر 150 کاراکتر):</label>' +
'<textarea id="change_reason" class="swal-input-custom" maxlength="150" placeholder="توضیحات..." style="height:80px"></textarea>' +
'<div style="text-align:left;font-size:10px;color:#666">تعداد کاراکتر: <span id="char_count">0</span> / 150</div>' +
'</div>' +
'</div>';

Swal.fire({
width: 980,
title: '<span style="color:#2e7d32">ثبت درخواست تغییر محصول ، مساحت</span>',
html: '<p style="text-align:right;font-weight:bold;color:#d35400">اطلاعات فعلی در سامانه:</p>' + currentInfoTable + formHTML,
showCancelButton: true,
confirmButtonText: 'ثبت درخواست',
cancelButtonText: 'انصراف',
focusConfirm: false,
didOpen: function () {
var $reason = $('#change_reason');
$reason.on('keyup', function () {
$('#char_count').text(($reason.val() || '').length);
});

$('#mah_qroup_popup').on('change', function () {
var grp = $(this).val();
$.ajax({
url: 'get_products_by_group.php',
type: 'POST',
data: { group_id: grp, z_sal: z_sal },
success: function (html) {
$('#mah_name_popup').html(html);
},
error: function () {
showAlert('error', 'خطا', 'عدم دریافت لیست محصولات گروه.');
}
});
});
},
preConfirm: function () {
return new Promise(function (resolve, reject) {
var reqData = {
id: $('#req_id').val(),
z_sal: $('#req_z_sal').val(),
mah_qroup: $('#mah_qroup_popup').val(),
n_cod_mah: $('#mah_name_popup').val(),
n_zer_a: $('#n_zer_a').val(),
n_zer_b: $('#n_zer_b').val(),
n_pishbini: $('#n_pishbini').val(),
reason: $('#change_reason').val()
};

if (!reqData.n_cod_mah || reqData.n_cod_mah === '') {
reject('انتخاب محصول الزامی است.');
return;
}
if (!reqData.reason || reqData.reason.replace(/\s+/g,'').length < 3) {
reject('علت تغییر را حداقل با 3 کاراکتر وارد کنید.');
return;
}

$.ajax({
url: 'save_request.php',
type: 'POST',
data: reqData,
dataType: 'json',
success: function (resp) {
if (resp && resp.success) {
resolve(resp);
} else {
reject(resp && resp.message ? resp.message : 'ثبت درخواست با خطا مواجه شد.');
}
},
error: function () {
reject('ثبت درخواست ممکن نشد.');
}
});
}).catch(function (err) {
Swal.showValidationMessage(err);
});
}
}).then(function (result) {
if (result && result.isConfirmed) {
showAlert('success', 'موفق', 'درخواست با موفقیت ثبت شد.');
}
});
},
error: function () {
showAlert('error', 'خطا', 'ارتباط با سرور برقرار نشد.');
}
});
}
</script>
</body>
</html>