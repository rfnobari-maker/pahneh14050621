<?php 
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');

$z_sal     = isset($_POST['z_sal'])     ? $_POST['z_sal']     : '1404-1405';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';

// نام جدول اصلی بر اساس سال زراعی
$Agri_table = 'Agri'.str_replace('-','_',$z_sal); 
?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <meta charset="utf-8" />
    <title>درخواست تغییر بهره‌بردار</title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
    <style>
        html, body { background-color: #FFFFFF !important; font-family: Tahoma; }
        .search-box { width: 450px; margin: 30px auto; padding: 20px; border: 1px solid #2980b9; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .my-table { width: 98%; border-collapse: collapse; margin: 20px auto; font-size: 12px; }
        .my-table th, .my-table td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        .header-blue { background-color: #2980b9; color: #fff; }
        .btn-change { background-color: #e67e22; color: white; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .btn-change:disabled { background-color: #95a5a6; cursor: not-allowed; opacity: 0.6; }
        .swal-input-custom { width: 80%; padding: 8px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; font-family: Tahoma; text-align: center; }
        .tracking-link { display: block; text-align: center; margin-bottom: 15px; font-weight: bold; color: #d35400; text-decoration: none; }
.back-button {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 180px;
    height: 50px;
    margin: 40px auto;
    background: linear-gradient(135deg, #2563eb, #3b82f6) !important;
    color: #ffffff !important;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
}
        .back-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
            background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
        }
    </style>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr><td><img src="../../files/images/header.jpg" width="100%" height="149" alt="Header" style="display: block;" /></td></tr>
        <tr><td><?php include('menu.php'); ?></td></tr>
        <tr><td><?php include('top.php'); ?></td></tr>
    </table>

    <div class="search-box" dir="rtl">
        <h3 align="center" style="color:#2980b9;">درخواست تغییر بهره‌بردار<br></h3>
      <a href="tracking_farmer_requests" class="tracking-link">🔍 مشاهده و پیگیری درخواست‌ها</a>
        <form method="post" action="">
            <table width="100%" style="border: none;">
                <tr>
                    <td>سال زراعی:</td>
                    <td>
                        <select name="z_sal" required style="width: 200px; height: 35px; font-family: Tahoma;">
                            <option value='1404-1405' <?php echo ($z_sal == '1404-1405' ? 'selected' : ''); ?>>1404-1405</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>کد ملی فعلی:</td>
                    <td><input type="text" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" maxlength="10" required style="width: 195px; height: 30px;"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center" style="padding-top:20px;">
                        <input type="submit" name="search" value="جستجوی قطعات" style="background:#2980b9; color:white; border:none; padding:10px 30px; border-radius:5px; cursor:pointer;">
                    </td>
                </tr>
           </table>
      </form>
    </div>

    <?php
    if (isset($_POST['search']) && !empty($bah_cod_m)) {
        $sql = "SELECT p.*, 
            (SELECT r.reg_status FROM Agri_req_bah r 
             WHERE r.Agri_id = p.id AND r.z_sal = :z_sal_sub 
             ORDER BY r.id DESC LIMIT 1) as reg_status 
            FROM `$Agri_table` p 
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
                    <th>ردیف</th>
                    <th>نام بهره‌بردار</th>
                    <th>نام آبادی / شهر</th>
                    <th>شماره قطعه</th>
                    <th>نوع کشت</th>
                    <th>مساحت زمین (هکتار)</th>
                    <th>مشاهده اطلاعات زمین</th>
                    <th>عملیات</th>
                </tr>
                <?php 
                $count = 1;
                while ($row = $stmt->fetch()) {
					$id =$row['id'] ; 
                    $farmer_name = bah_name2($row['bah_cod_m'], $row['num_bah']);
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $farmer_name; ?> (<?php echo $row['bah_cod_m']; ?>)</td>
                    <td><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
                    <td><?php echo $row['sh_gat']; ?></td>
                    <td><?php if ($row['no_kesh'] =='1') echo 'آبی' ; if ($row['no_kesh'] =='2') echo 'دیم' ; ?></td>
                    <td><?php echo $row['m_zamin']; ?> </td>
                    <td>
            <form action="Agridata_view1.php" method="post" onsubmit="target_Agri18(this)">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="z_sal"  value="<?php echo $row['z_sal'] ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form>
                    </td>
                    <td>
<?php 
    if (isset($row['reg_status']) && $row['reg_status'] !== null && !($row['reg_status'] == 3 || $row['reg_status'] == 33)) {
?>
        <div style="color: #d35400; font-weight: bold; background: #fff3e0; padding: 5px; border: 1px solid #ffcc80; border-radius: 5px; font-size: 11px;">
            ⚠️ درخواست قبلی بررسی نشده
        </div>
    <?php } else { ?>
                        <button type="button" class="btn-change" id="changeBtn_<?php echo $row['id']; ?>"
                                onclick="openFarmerChangeModal('<?php echo $row['id']; ?>', '<?php echo $z_sal; ?>', '<?php echo $row['bah_cod_m']; ?>', '<?php echo $farmer_name; ?>', this)">
                            ثبت تغییر بهره‌بردار
                        </button>
    <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
    <?php 
            } else { echo "<p align='center' style='color:red;'>قطعه‌ای برای این کد ملی یافت نشد.</p>"; }
        } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
    }
    ?>

<a href="./index.php" class="back-button">
    بازگشت
</a>

<!-- مودال ساده -->
<div id="changeFarmerModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000;">
    <div style="background:white; margin:10% auto; width:80%; max-width:600px; border-radius:10px; box-shadow:0 4px 15px rgba(0,0,0,0.3); padding:20px; font-family:Tahoma;">
        <h3 style="text-align:center; margin-bottom:15px; color:#900;"> ثبت درخواست تغییر بهره‌بردار</h3>
        <div dir="rtl" style="text-align:right; font-size:13px; margin-bottom:15px;">
            <p><b>بهره‌بردار فعلی:</b> <span id="old_name"></span> (<span id="old_cod_m"></span>)</p>
            <hr>
        </div>
<div align="right" dir="rtl">
        <label dir="rtl" style="font-size:12px; text-align:right">کد ملی یا شناسه اتباع بهره‌بردار جدید:</label>
        <input dir="rtl" type="text" id="new_cod_m" style="width:80%; margin:10px auto; display:block; padding:8px;" maxlength="12" placeholder="10 یا 12 رقم">
        <div dir="rtl" id="new_bah_info" style="margin-top:10px; min-height:30px; font-weight:bold; text-align:center;"></div>

        <label dir="rtl" style="font-size:12px;">علت تغییر (حداکثر 150 کاراکتر):</label>
        <textarea dir="rtl" id="change_reason" style="width:80%; margin:10px auto; display:block; height:70px; padding:8px;" maxlength="150" onkeyup="document.getElementById('char_count').innerText = this.value.length;" placeholder="علت تغییر بهره‌بردار..."></textarea>
        <div style="text-align:left; width:80%; margin:auto; font-size:10px; color:#666;">
            تعداد کاراکتر: <span id="char_count">0</span> / 150
        </div>

        <div style="text-align:center; margin-top:20px;">
            <button id="submitRequestBtn" onclick="submitRequest()" style="padding:10px 20px; background:#4CAF50; color:white; border:none; border-radius:5px; cursor:pointer;">ثبت درخواست</button>
            <button onclick="closeModal()" style="padding:10px 20px; margin:0 10px; background:#ccc; border:none; border-radius:5px; cursor:pointer;">انصراف</button>
        </div>
        </div>
    </div>
</div>

<script>
// متغیرهای گلوبال برای دسترسی در تمام توابع
let global_agri_id = null;
let global_z_sal = null;
let global_clicked_btn = null; // ذخیره دکمه کلیک شده
let isSubmitting = false; // متغیر برای جلوگیری از ثبت مکرر

function openFarmerChangeModal(agri_id, z_sal, old_cod_m, old_name, clickedButton) {
    global_agri_id = agri_id;
    global_z_sal = z_sal;
    global_clicked_btn = clickedButton;
    
    document.getElementById('changeFarmerModal').style.display = 'block';
    document.getElementById('old_name').textContent = old_name;
    document.getElementById('old_cod_m').textContent = old_cod_m;
    document.getElementById('new_cod_m').value = '';
    document.getElementById('change_reason').value = '';
    document.getElementById('char_count').innerText = '0';
    document.getElementById('new_bah_info').innerHTML = '';

    document.getElementById('new_cod_m').oninput = function() {
        let cod = this.value;
        if (cod.length === 10 || cod.length === 12) {
            document.getElementById('new_bah_info').innerHTML = '<span style="color:blue; font-size:11px;">در حال استعلام...</span>';

            fetch('check_new_bah.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'cod_m=' + encodeURIComponent(cod)
            }).then(res => res.json())
            .then(response => {
                if (response.exists) {
                    if (response.count === 1) {
                        let item = response.data[0];
                        if (cod === old_cod_m) {
                            document.getElementById('new_bah_info').innerHTML = '<span style="color:orange; font-size:11px;">⚠️ این کد ملی با بهره‌بردار فعلی یکسان است.</span>';
                        } else {
                            document.getElementById('new_bah_info').innerHTML = `
                                <div style="background:#f1f8e9; color:#2e7d32; padding:10px; border-radius:5px; border:1px solid #c5e1a5; font-size:12px;">
                                    ✅ یافت شد: ${item.display_name} (${item.type_text})
                                    <input type="hidden" id="selected_num_bah" value="${item.num_bah}">
                                    <input type="hidden" id="selected_no_bah" value="${item.no_bah}">
                                </div>`;
                        }
                    } else {
                        let selectHtml = `<div style="background:#fff3e0; padding:10px; border-radius:5px; border:1px solid #ffe0b2;">
                            <p style="font-size:11px; color:#e65100; margin:0 0 5px 0;">تعدد نقش! انتخاب کنید:</p>
                            <select id="selected_num_bah" style="width:100%; margin:0; font-family:Tahoma; font-size:12px; height:40px;">`;
                        response.data.forEach(item => {
                            selectHtml += `<option value="${item.num_bah}">${item.type_text}: ${item.display_name}</option>`;
                        });
                        selectHtml += `</select></div>`;
                        document.getElementById('new_bah_info').innerHTML = selectHtml;
                    }
                } else {
                    document.getElementById('new_bah_info').innerHTML = '<span style="color:red; font-size:11px;">❌ این کد ملی یافت نشد.</span>';
                }
            });
        } else {
            document.getElementById('new_bah_info').innerHTML = '';
        }
    };
}

function closeModal() {
    document.getElementById('changeFarmerModal').style.display = 'none';
    // فعال کردن مجدد دکمه در صورت بسته شدن مودال
    if (global_clicked_btn) {
        global_clicked_btn.disabled = false;
        global_clicked_btn.innerHTML = 'ثبت تغییر بهره‌بردار';
    }
    isSubmitting = false;
}

function submitRequest() {
    // جلوگیری از ثبت مکرر
    if (isSubmitting) {
        alert('لطفاً صبر کنید! درخواست قبلی در حال ثبت است...');
        return;
    }
    
    let new_cod = document.getElementById('new_cod_m').value;
    let reason = document.getElementById('change_reason').value;
    let num_bah = document.getElementById('selected_num_bah')?.value;
    let submitBtn = document.getElementById('submitRequestBtn');
    
    // غیرفعال کردن دکمه ثبت در مودال
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '⏳ در حال ثبت...';
    submitBtn.style.opacity = '0.6';
    isSubmitting = true;
    
    // غیرفعال کردن دکمه اصلی در جدول
    if (global_clicked_btn) {
        global_clicked_btn.disabled = true;
        global_clicked_btn.innerHTML = '⏳ در حال ثبت...';
    }

    // اعتبارسنجی
    if (new_cod !== '' && (new_cod.length !== 10 && new_cod.length !== 12)) {
        alert('کد ملی باید 10 یا 12 رقمی باشد.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
        submitBtn.style.opacity = '1';
        if (global_clicked_btn) {
            global_clicked_btn.disabled = false;
            global_clicked_btn.innerHTML = 'ثبت تغییر بهره‌بردار';
        }
        isSubmitting = false;
        return;
    }

    if (!num_bah) {
        alert('لطفاً یک بهره‌بردار معتبر انتخاب کنید.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
        submitBtn.style.opacity = '1';
        if (global_clicked_btn) {
            global_clicked_btn.disabled = false;
            global_clicked_btn.innerHTML = 'ثبت تغییر بهره‌بردار';
        }
        isSubmitting = false;
        return;
    }

    if (!reason || reason.trim() === '') {
        alert('علت تغییر الزامی است.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
        submitBtn.style.opacity = '1';
        if (global_clicked_btn) {
            global_clicked_btn.disabled = false;
            global_clicked_btn.innerHTML = 'ثبت تغییر بهره‌بردار';
        }
        isSubmitting = false;
        return;
    }

    if (reason.length > 150) {
        alert('توضیحات نباید بیش از 150 کاراکتر باشد.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
        submitBtn.style.opacity = '1';
        if (global_clicked_btn) {
            global_clicked_btn.disabled = false;
            global_clicked_btn.innerHTML = 'ثبت تغییر بهره‌بردار';
        }
        isSubmitting = false;
        return;
    }

    if (!global_agri_id) {
        alert('خطا: شناسه بهره‌بردار در دسترس نیست.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
        submitBtn.style.opacity = '1';
        if (global_clicked_btn) {
            global_clicked_btn.disabled = false;
            global_clicked_btn.innerHTML = 'ثبت تغییر بهره‌بردار';
        }
        isSubmitting = false;
        return;
    }

    fetch('save_farmer_request.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `agri_id=${global_agri_id}&z_sal=${global_z_sal}&new_cod_m=${encodeURIComponent(new_cod)}&num_bah=${num_bah}&reason=${encodeURIComponent(reason)}`
    }).then(res => res.json())
    .then(response => {
        if (response.status === 'success') {
            alert(response.message);
            closeModal();
            location.reload();
        } else {
            alert('خطا در ثبت درخواست: ' + (response.message || 'ناامکان انجام عملیات'));
            // فعال کردن مجدد دکمه‌ها در صورت خطا
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnText;
            submitBtn.style.opacity = '1';
            if (global_clicked_btn) {
                global_clicked_btn.disabled = false;
                global_clicked_btn.innerHTML = 'ثبت تغییر بهره‌بردار';
            }
            isSubmitting = false;
        }
    }).catch(err => {
        alert('خطا در ارتباط با سرور');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
        submitBtn.style.opacity = '1';
        if (global_clicked_btn) {
            global_clicked_btn.disabled = false;
            global_clicked_btn.innerHTML = 'ثبت تغییر بهره‌بردار';
        }
        isSubmitting = false;
    });
}
</script>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 20px;">
        <tr><td height="109" background="../../files/bottom.gif"><?php include('../../footer.php')?></td></tr>
    </table>
</body>
</html>