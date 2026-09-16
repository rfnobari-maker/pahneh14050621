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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html, body { background-color: #FFFFFF !important; font-family: Tahoma; }
        .search-box { width: 450px; margin: 30px auto; padding: 20px; border: 1px solid #2980b9; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .my-table { width: 98%; border-collapse: collapse; margin: 20px auto; font-size: 12px; }
        .my-table th, .my-table td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        .header-blue { background-color: #2980b9; color: #fff; }
        .btn-change { background-color: #e67e22; color: white; padding: 8px 12px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .swal-input-custom { width: 80%; padding: 8px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; font-family: Tahoma; text-align: center; }
        .tracking-link { display: block; text-align: center; margin-bottom: 15px; font-weight: bold; color: #d35400; text-decoration: none; }
.back-button {
    display: flex; /* تغییر به فلکس برای تراز شدن متن */
    justify-content: center;
    align-items: center;
    width: 180px;
    height: 50px;
    margin: 40px auto;
    background: linear-gradient(135deg, #2563eb, #3b82f6) !important; /* استفاده از کد رنگ مستقیم برای اطمینان */
    color: #ffffff !important; /* اجبار به رنگ سفید برای متن */
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none; /* حذف خط زیر لینک */
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
        // کوئری برای یافتن قطعات در جدول Agri

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
                    $farmer_name = bah_name2($row['bah_cod_m'], $row['num_bah']);
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $farmer_name; ?> (<?php echo $row['bah_cod_m']; ?>)</td>
                    <td><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
                    <td><?php echo $row['sh_gat']; ?></td>
                    <td><?php if ($row['no_kesh'] =='1') echo 'آبی' ; if ($row['no_kesh'] =='2') echo 'دیم' ; ?></td>
                    <td><?php echo $row['m_zamin']; ?></td>
                    <td>
            <form  action="Agridata_view1.php" method="post" onsubmit="target_Agri18(this)">
              <input type="hidden" name="id"  value="<?php echo $row['id'] ;?>" />
              <input type="hidden" name="z_sal"  value="<?php echo $row['z_sal'] ;?>" />
              <button><img src="../../files/view.png" title="نمایش اطلاعات بهره برداری"  width="33" height="26"  alt=""/></button>
            </form></td>
                    <td>
<?php 
    // اگر درخواستی با وضعیتی غیر از 3 وجود داشته باشد
    if (isset($row['reg_status']) && $row['reg_status'] !== null && $row['reg_status'] != 3) { 
    ?>
        <div style="color: #d35400; font-weight: bold; background: #fff3e0; padding: 5px; border: 1px solid #ffcc80; border-radius: 5px; font-size: 11px;">
            ⚠️ درخواست قبلی بررسی نشده
        </div>
    <?php } else { ?>
                        <button type="button" class="btn-change" 
                                onclick="openFarmerChangeModal('<?php echo $row['id']; ?>', '<?php echo $z_sal; ?>', '<?php echo $row['bah_cod_m']; ?>', '<?php echo $farmer_name; ?>')">
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

<script>
function openFarmerChangeModal(agri_id, z_sal, old_cod_m, old_name) {
    Swal.fire({
        title: 'درخواست تغییر بهره‌بردار',
        html: `
            <div dir="rtl" style="text-align:right;">
                <p style="font-size:13px;"><b>بهره‌بردار فعلی:</b> ${old_name} (${old_cod_m})</p>
                <hr>
                <label style="font-size:12px;">کد ملی یا شناسه اتباع بهره‌بردار جدید:</label>
                <input type="text" id="new_cod_m" class="swal2-input" style="width:80%; margin:10px auto; display:block;" maxlength="12" placeholder="10 یا 12 رقم">
                
                <div id="new_bah_info" style="margin-top:10px; min-height:30px; font-weight:bold; text-align:center;"></div>
                
                <label style="font-size:12px;">علت تغییر (حداکثر 150 کاراکتر):</label>
                <textarea id="change_reason" class="swal2-textarea" 
                    style="width:80%; margin:10px auto; display:block; height:70px;" 
                    maxlength="150" 
                    onkeyup="document.getElementById('char_count').innerText = this.value.length"
                    placeholder="علت تغییر بهره‌بردار..."></textarea>
                <div style="text-align:left; width:80%; margin:auto; font-size:10px; color:#666;">
                    تعداد کاراکتر: <span id="char_count">0</span> / 150
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'ثبت درخواست',
        cancelButtonText: 'انصراف',
        didOpen: () => {
            $('#new_cod_m').on('input', function() {
                let cod = $(this).val();
                if(cod.length === 10 || cod.length === 12) {
                    $('#new_bah_info').html('<span style="color:blue; font-size:11px;">در حال استعلام...</span>');
                    
                    $.post('check_new_bah.php', {cod_m: cod}, function(response) {
                        if(response.exists) {
                            if(response.count === 1) {
                                let item = response.data[0];
                                // بررسی شرط اول: اگر کد ملی و نقش یکی بود
                                if(cod === old_cod_m) {
                                    $('#new_bah_info').html('<span style="color:orange; font-size:11px;">⚠️ این کد ملی با بهره‌بردار فعلی یکسان است.</span>');
                                } else {
                                    $('#new_bah_info').html(
                                        `<div style="background:#f1f8e9; color:#2e7d32; padding:10px; border-radius:5px; border:1px solid #c5e1a5; font-size:12px;">` +
                                        `✅ یافت شد: ${item.display_name} (${item.type_text})` +
                                        `<input type="hidden" id="selected_num_bah" value="${item.num_bah}">` +
                                        `<input type="hidden" id="selected_no_bah" value="${item.no_bah}">` +
                                        `</div>`
                                    );
                                }
                            } else {
                                // تداخل (حقیقی و حقوقی)
                                let selectHtml = `<div style="background:#fff3e0; padding:10px; border-radius:5px; border:1px solid #ffe0b2;">`;
                                selectHtml += `<p style="font-size:11px; color:#e65100; margin:0 0 5px 0;">تعدد نقش! انتخاب کنید:</p>`;
                                selectHtml += `<select id="selected_num_bah" class="swal2-select" style="width:100%; margin:0; font-family:Tahoma; font-size:12px; height:40px;">`;
                                response.data.forEach(function(item) {
                                    selectHtml += `<option value="${item.num_bah}">${item.type_text}: ${item.display_name}</option>`;
                                });
                                selectHtml += `</select></div>`;
                                $('#new_bah_info').html(selectHtml);
                            }
                            Swal.resetValidationMessage();
                        } else {
                            $('#new_bah_info').html('<span style="color:red; font-size:11px;">❌ این کد ملی یافت نشد.</span>');
                        }
                    }, 'json');
                } else {
                    $('#new_bah_info').html('');
                }
            });
        },
        preConfirm: () => {
            const new_cod = $('#new_cod_m').val();
            const reason = $('#change_reason').val();
            const num_bah = $('#selected_num_bah').val();

            // چک کردن تکراری بودن کد ملی (در صورتی که تعدد نقش وجود نداشته باشد و مستقیم تایپ شده باشد)
            if (new_cod === old_cod_m && response.count === 1) {
                Swal.showValidationMessage('نمی‌توانید همان بهره‌بردار فعلی را به عنوان بهره‌بردار جدید انتخاب کنید');
                return false;
            }

            if (new_cod.length !== 10 && new_cod.length !== 12) {
                Swal.showValidationMessage('لطفاً کد ملی صحیح (10 یا 12 رقمی) وارد کنید');
                return false;
            }
            if (!num_bah) {
                Swal.showValidationMessage('ابتدا یک بهره‌بردار معتبر انتخاب کنید');
                return false;
            }
            if (!reason || reason.trim() === "") {
                Swal.showValidationMessage('وارد کردن علت تغییر الزامی است');
                return false;
            }
            if (reason.length > 150) {
                Swal.showValidationMessage('توضیحات نباید بیش از 150 کاراکتر باشد');
                return false;
            }

            return $.post('save_farmer_request.php', {
                agri_id: agri_id,
                z_sal: z_sal,
                new_cod_m: new_cod,
                num_bah: num_bah,
                reason: reason
            }).then(response => {
                if (response.status !== 'success') {
                    throw new Error(response.message || 'خطا در ثبت درخواست');
                }
                return response;
            }).catch(error => {
                Swal.showValidationMessage(`خطا: ${error.message}`);
            });
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            Swal.fire('موفقیت', result.value.message, 'success').then(() => location.reload());
        }
    });
}
    function target_Agri18(form) {
	window.open ("null", "formpopup","location=1,status=1,scrollbars=1,width=950,height=600"); 
    form.target = 'formpopup'; 
	}

</script>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 20px;">
        <tr><td height="109" background="../../files/bottom.gif"><?php include('../../footer.php')?></td></tr>
    </table>
</body>
</html>