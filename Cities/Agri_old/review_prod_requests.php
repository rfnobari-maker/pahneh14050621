<?php 
include('../../lock_p3.php'); 
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');

//$id_mar = $_SESSION['id_mar']; 

// ۱. مقادیر فیلتر را دریافت می‌کنیم
$z_sal     = isset($_POST['z_sal']) ? $_POST['z_sal'] : '1404-1405';
$bah_cod_m = isset($_POST['f_bah_cod']) ? $_POST['f_bah_cod'] : '';
$mor_cod_m = isset($_POST['f_mor_cod']) ? $_POST['f_mor_cod'] : '';
$f_status  = isset($_POST['f_status']) ? $_POST['f_status'] : '1'; // پیش‌فرض: بررسی نشده

// ۲. ساخت پرس‌وجو
$sql = "SELECT r.*, b.name, b.last_name 
        FROM Agri_prod_req r
        LEFT JOIN bah b ON r.bah_cod_m = b.bah_cod_m
        WHERE r.id_ostan = :id_ostan AND r.id_city = :id_city AND r.z_sal = :z_sal";

if($f_status !== '') { 
    $sql .= " AND r.status = :f_status"; 
}

if(!empty($bah_cod_m)) { $sql .= " AND r.bah_cod_m = :bah_cod"; }
if(!empty($mor_cod_m)) { $sql .= " AND r.mor_cod_m = :mor_cod"; }

$sql .= " ORDER BY r.id DESC";

$stmt = $dbh->prepare($sql);
$params = array(':id_ostan' => $id_ostan,':id_city' => $id_city, ':z_sal' => $z_sal);
if($f_status !== '') $params[':f_status'] = $f_status;
if(!empty($bah_cod_m)) $params[':bah_cod'] = $bah_cod_m;
if(!empty($mor_cod_m)) $params[':mor_cod'] = $mor_cod_m;

$stmt->execute($params);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// تابع کمکی برای استایل وضعیت‌ها
function getStatusLabel($status) {
    switch ($status) {
case '0':  return '<span style="background:#f39c12; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">بررسی نشده مرکز</span>'; // زرد: در انتظار بررسی
case '1':  return '<span style="background:#2ecc71; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">تایید شده مرکز</span>'; // سبز: تایید شده
case '11': return '<span style="background:#e74c3c; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">رد شده مرکز</span>'; // قرمز: رد شده
case '2':  return '<span style="background:#2ecc71; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">تایید شده - شهرستان</span>'; // سبز: تایید شده
case '22': return '<span style="background:#e67e22; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">رد شده - شهرستان</span>'; // نارنجی: در انتظار تایید
case '3':  return '<span style="background:#2980b9; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">تایید نهایی - استان</span>'; // آبی: تایید نهایی
case '33': return '<span style="background:#c0392b; color:white; padding:2px 6px; border-radius:5px; font-size:11px;">رد نهایی - استان</span>'; // قرمز تیره: رد نهایی
        default:   return '<span style="color:#95a5a6;">نامشخص</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8" />
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <title>مدیریت درخواست‌ها</title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<style>
    :root {
        --primary-color: #3498db;
        --hover-color: #2980b9;
    }

    body { font-family: myfont,Tahoma, sans-serif; background-color: #f4f7f6; margin: 0; }
    .filter-container { display: flex; justify-content: center; margin: 30px 0; }
    .filter-box { background: #ffffff; width: 100%; max-width: 500px; border: 1px solid #e0e0e0; padding: 25px; border-radius: 15px; direction: rtl; box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
    .filter-title { margin-bottom: 20px; color: #2c3e50; font-size: 18px; text-align: center; border-bottom: 2px solid #3498db; padding-bottom: 10px; font-weight: bold; }
    .filter-row { display: flex; align-items: center; margin-bottom: 15px; }
    .filter-row label { flex: 0 0 120px; font-weight: 600; font-size: 13px; color: #546e7a; }
    .filter-row input, .filter-row select { flex: 1; padding: 10px; border: 1px solid #cfd8dc; border-radius: 8px; font-family: Tahoma; font-size: 13px; outline: none; }
    .list-table { width: 95%; margin: 0 auto; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    .list-table th { background-color: #34495e; color: white; padding: 15px; font-size: 13px; }
    .list-table td { padding: 12px; border-bottom: 1px solid #eee; text-align: center; font-size: 12px; }
    .btn-group { display: flex; flex-direction: column; gap: 10px; margin-top: 20px; }
    .btn-search { background: linear-gradient(135deg, #3498db, #2980b9); color: white; border: none; padding: 12px; cursor: pointer; border-radius: 8px; font-family: Tahoma; font-weight: bold; }
    .btn-clear { font-size: 11px; color: #95a5a6; text-decoration: none; text-align: center; }
    .btn-approve { background: #2ecc71; color: white; border: none; padding: 7px 15px; cursor: pointer; border-radius: 5px; margin-bottom: 5px; }
    .btn-reject { background: #e74c3c; color: white; border: none; padding: 7px 15px; cursor: pointer; border-radius: 5px; }
    .style3 { color: #FF0000; font-size: 10px; }
    .back-button {
        display: block;
        width: 150px;
        height: 45px;
        margin: 20px auto;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: Tahoma, Arial, sans-serif;
    }

    .back-button:hover {
        background: var(--hover-color);
        transform: translateY(-2px);
    }
</style>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr><td><img src="../../files/images/header.jpg" width="100%" height="149" alt="Header" style="display: block;" /></td></tr>
        <tr><td><?php include('menu.php'); ?></td></tr>
        <tr><td><?php include('top.php'); ?></td></tr>
        <tr>
            <td>
                <div style="padding: 20px; min-height: 450px;">
                  <div class="filter-container">
                        <div class="filter-box">
                            <form method="post" action="review_prod_requests.php">
                                <div class="filter-title">🔍 درخواست های تغییر نوع محصول / مساحت</div>
                                <div class="filter-row">
                                    <label>سال زراعی:</label>
                                    <select name="z_sal">
                                        <option value="1404-1405" <?php if($z_sal == '1404-1405') echo 'selected'; ?>>1404-1405</option>
                                        <option value="1403-1404" <?php if($z_sal == '1403-1404') echo 'selected'; ?>>1403-1404</option>
                                    </select>
                                </div>
                                <div class="filter-row">
                                    <label>کد ملی بهره‌بردار:</label>
                                    <input type="text" name="f_bah_cod" value="<?php echo $bah_cod_m; ?>" maxlength="10" />
                                </div>
                                <div class="filter-row">
                                    <label>کد ملی کارشناس:</label>
                                    <input type="text" name="f_mor_cod" value="<?php echo $mor_cod_m; ?>" maxlength="10" />
                                </div>
                              <div class="filter-row">
                                    <label>وضعیت درخواست:</label>
                                    <select name="f_status">
                                        <option value="" <?php if($f_status === '') echo 'selected'; ?>>همه درخواست ها</option>
                                        <option value="0" <?php if($f_status === '0') echo 'selected'; ?>>بررسی نشده مرکز</option>
                                        <option value="1" <?php if($f_status === '1') echo 'selected'; ?>>تایید شده مرکز</option>
                                        <option value="11" <?php if($f_status === '11') echo 'selected'; ?>>رد شده مرکز</option>
                                        <option value="2" <?php if($f_status === '2') echo 'selected'; ?>>تایید شده در شهرستان</option>
                                        <option value="22" <?php if($f_status === '22') echo 'selected'; ?>>رد شده در شهرستان</option>
                                        <option value="3" <?php if($f_status === '3') echo 'selected'; ?>>تایید شده نهایی در استان</option>
                                        <option value="33" <?php if($f_status === '33') echo 'selected'; ?>>رد شده نهائی در استان</option>
                                    </select>
                                </div>
                                <div class="btn-group">
                                    <button type="submit" class="btn-search">اعمال فیلتر </button>
                                    <a href="review_prod_requests.php" class="btn-clear">❌ حذف فیلترها</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table width="92%" class="list-table" dir="rtl">
                        <thead>
                            <tr>
                                <th width="5%">ردیف</th>
                                <th width="9%">تاریخ درخواست</th>
                                <th width="8%">نام آبادی / شهر</th>
                                <th width="10%">مشخصات بهره‌بردار</th>
                                <th width="6%">نوع کشت</th>
                                <th width="12%">محصول فعلی<br><span class="style3">نام/سطح زیر کشت-هکتار</span></th>
                                <th width="12%">محصول پیشنهادی <br><span class="style3">نام/سطح زیر کشت-هکتار</span></th>
                                <th width="9%">کارشناس</th>
                                <th colspan="2">مشاهده اطلاعات </th>
                                <th width="15%">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach($requests as $row) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['date_req']; ?></td>
                                <td><?php echo abadi_name($row['add_abadi']).shahr_name($row['add_city']); ?></td>
                                <td><strong><?php echo $row['name'].' '.$row['last_name']; ?></strong><br><code><?php echo $row['bah_cod_m']; ?></code></td>
                                <td style="background-color: #fff9f9;"><?php if ($row['no_kesh'] =='1') echo 'آبی' ; if ($row['no_kesh'] =='2') echo 'دیم' ; ?></td>
                                <td style="background-color: #fff9f9;"><?php echo mah_name($row['cod_mah']).' ('.$row['zer_kesht_a'].')'; ?></td>
                                <td style="background-color: #f9fff9; font-weight: bold; color: #27ae60;"><?php echo mah_name($row['new_cod_mah']).' ('.$row['new_zer_kesht_a'].')'; ?></td>
                                <td>
                                    <p><img id="img1" src="../../files/users/<?php echo user_pic($row['mor_cod_m']) ?>" width="37" height="43" alt=""/><br />
                                    <?php echo user_name($row['mor_cod_m'])?><br/>
                                    <?php echo $row['mor_cod_m']?><br />
                                    <?php echo user_tel($row['mor_cod_m'])?></p>
                                </td>
                                <td width="7%"><form action="Agridata_view1.php" method="post" onSubmit="target_Agri18(this)">
                                  <input type="hidden" name="id" value="<?php echo $row['Agri_id']; ?>" />
                                  <input type="hidden" name="z_sal" value="<?php echo $row['z_sal']; ?>" />
                                  <button type="submit"><img src="../../files/view.png" width="33" height="26" title="مشاهده اطلاعات بهره برداری" /></button>
                                </form></td>
                                <td width="7%"><form action="review_prod_comment.php" method="post" onsubmit="target_Agri19(this)">
                                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                  <button type="submit"><img src="../../files/con_info.png" width="33" height="26" title="مشاهده علت درخواست و نظرات کارشناسی " /></button>
                                </form></td>
                                <td>
                                    <?php if($row['status'] == 1) { ?>
                                        <button class="btn-approve" onclick="processReq(<?php echo $row['id']; ?>, 1)">✅ تایید</button>
                                        <button class="btn-reject" onclick="processReq(<?php echo $row['id']; ?>, 2)">❌ رد</button>
                                    <?php } else { 
                                        echo getStatusLabel($row['status']);
                                    } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                          <a href="./index.php">
                <input type="submit" value="بازگشت" class="back-button">
            </a>

            </td>
        </tr>
        <tr><td height="109" background="../../files/bottom.gif"><?php include('../../footer.php'); ?></td></tr>
    </table>

<script>
function processReq(id, action) {
    // نمایش پیام در حال بررسی
    const loadingDiv = document.createElement('div');
    loadingDiv.id = 'loadingOverlay';
    loadingDiv.style.cssText = `
        position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 9999; display: flex; justify-content: center; align-items: center;
    `;
    loadingDiv.innerHTML = '<div style="color: white; font-size: 16px; padding: 20px; background: #2c3e50; border-radius: 10px; text-align: center;">در حال بررسی الگوی کشت...</div>';
    document.body.appendChild(loadingDiv);

    // اگر action = 2 (رد درخواست)، باید ابتدا چک کنیم
    if (action === 2) {
        document.body.removeChild(loadingDiv);
        openCommentModal(id, action);
        return;
    }

    // ارسال درخواست برای چک فقط (action = 1)
    const formData = new FormData();
    formData.append('req_id', id);
    formData.append('action', action);
    formData.append('check_only', 1);

    fetch('process_review_prod.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.body.removeChild(loadingDiv);
        if (data.status === 'success') {
            openCommentModal(id, action);
        } else {
            alert('خطای الگوی کشت: ' + data.message);
        }
    })
    .catch(() => {
        document.body.removeChild(loadingDiv);
        alert('ارتباط با سرور برقرار نشد.');
    });
}

function openCommentModal(id, action) {
    // حذف پنجره قبلی اگر وجود داشت
    const existingModal = document.getElementById('commentModal');
    if (existingModal) existingModal.remove();

    // ایجاد پنجره جدید
    const modal = document.createElement('div');
    modal.id = 'commentModal';
    modal.style.cssText = `
        position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90%; max-width: 600px; background: white; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); z-index: 10000; padding: 20px; font-family: Tahoma;
        direction: rtl; text-align: right;
    `;
    modal.innerHTML = `
        <div style="text-align: right; margin-bottom: 15px; font-weight: bold; font-size: 18px; color: ${action === 1 ? '#2ecc71' : '#e74c3c'};">
            ${action === 1 ? 'تایید درخواست' : 'رد درخواست'}
        </div>
        <label style="font-size: 13px; font-weight: bold;">توضیحات تکمیلی (حداکثر ۱۵۰ کاراکتر):</label>
        <textarea id="swal_comment" style="width: 90%; margin: 10px auto; display: block; height: 80px; font-family: Tahoma; direction: rtl;" maxlength="150" 
            onkeyup="document.getElementById('comment_char_count').innerText = this.value.length" 
            placeholder="توضیحات خود را اینجا بنویسید..."></textarea>
        <div style="text-align: left; width: 90%; margin: auto; font-size: 10px; color: #666;">
            تعداد کاراکتر: <span id="comment_char_count">0</span> / 150
        </div>
        <div style="margin-top: 20px; text-align: center;">
            <button id="btnCancel" style="padding: 10px 20px; margin: 0 10px; background: #ccc; border: none; border-radius: 5px; cursor: pointer;">انصراف</button>
            <button id="btnConfirm" style="padding: 10px 20px; margin: 0 10px; background: ${action === 1 ? '#2ecc71' : '#e74c3c'}; color: white; border: none; border-radius: 5px; cursor: pointer;">ثبت نهایی</button>
        </div>
    `;

    // اضافه کردن به صفحه
    document.body.appendChild(modal);

    // رویدادهای دکمه‌ها
    document.getElementById('btnCancel').onclick = () => {
        modal.remove();
    };

    document.getElementById('btnConfirm').onclick = () => {
        const comment = document.getElementById('swal_comment').value.trim();
        if (action === 2 && !comment) {
            alert('وارد کردن علت برای رد درخواست الزامی است');
            return;
        }

        const formData = new FormData();
        formData.append('req_id', id);
        formData.append('action', action);
        formData.append('comment', comment);
        formData.append('submit_review', 1);

        fetch('process_review_prod.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                alert('خطا: ' + data.message);
            } else {
                alert(data.message);
                modal.remove();
                location.reload();
            }
        })
        .catch(() => {
            alert('خطا در ارسال اطلاعات.');
        });
    };
}

function target_Agri19(form) {
    window.open("null", "formpopup", "location=1,status=1,scrollbars=1,width=350,height=400");
    form.target = "formpopup";
}

function target_Agri18(form) {
    window.open("null", "formpopup", "location=1,status=1,scrollbars=1,width=950,height=600");
    form.target = "formpopup";
}
</script>
</body>
</html>