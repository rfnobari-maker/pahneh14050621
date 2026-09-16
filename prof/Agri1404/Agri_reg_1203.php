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
        /* استایل اختصاصی برای فیلدهای داخل پاپ‌آپ */
        .swal-input-custom { width: 80%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 4px; font-family: Tahoma; text-align: center; }
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
                                <option value='1404-1405' <?php echo ($z_sal == '1404-1405' ? 'selected' : ''); ?>>1404-1405</option>
                          </select>
                      </td>
                  </tr>
                    <tr>
                        <td height="42" align="right">کد ملی:</td>
                      <td><input type="text" name="bah_cod_m" value="<?php echo $bah_cod_m; ?>" maxlength="10" required style="width: 195px; height: 30px;"></td>
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
    // استفاده از نام صحیح جدول Agri_prod_req طبق فایل save_request.php
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
          <th colspan="2">سطح زیر کشت<br>
          هکتار</th>
          <th rowspan="2">پیش بینی تولید<br>
            تن</th>
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
                $prod_name = mah_name($row['cod_mah']);
                $farmer_name = bah_name2($row['bah_cod_m'],$row['num_bah']);
            ?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo abadi_name($row['add_abadi']).shahr_name($row['add_city']); ?></td>
            <td><?php echo $prod_name; ?></td>
            <td><?php if ($row['no_kesh'] =='1') echo 'آبی' ; if ($row['no_kesh'] =='2') echo 'دیم' ; ?></td>
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
                } else { echo "<p align='center' style='color:red;'>اطلاعاتی یافت نشد.</p>"; }
            } catch (PDOException $e) { echo "Error: " . $e->getMessage(); }
        }
        ?>

<a href="./index.php" class="back-button">
    بازگشت
</a>
  </div>

<script>
// 1. تابع کمکی برای بستن مودال داخلی
function closeModal() {
    const modal = document.getElementById('editModal');
    if (modal) {
        modal.remove();
    }
}

// 2. تابع بررسی وضعیت حواله (جایگزین openEditModal)
function openEditModal(id, z_sal) {
    // بررسی وضعیت حواله از طریق سرور با استفاده از fetch
    fetch('check_status.php', {
        method: 'POST',
        body: new URLSearchParams({ id: id, z_sal: z_sal }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .then(response => response.json())
    .then(response => {
        if (response.status === 1) {
            // وضعیت 1: حواله صادر نشده
            alert('اطلاع‌رسانی: تا کنون برای این محصول حواله‌ای صادر نشده است و تغییرات برای خود شما مقدور می‌باشد.');
        } else if (response.status === 2) {
            // وضعیت 2: حواله صادر شده، ادامه فرآیند
            loadEditForm(id, z_sal);
        } else {
            // سایر وضعیت‌ها
            alert('خطا: فعلاً امکان بررسی از سامانه پایش مقدور نیست.');
        }
    })
    .catch(error => {
        alert('خطا: ارتباط با سرور برقرار نشد.');
        console.error('Error:', error);
    });
}

// 3. تابع بارگذاری فرم ویرایش (جایگزین loadEditForm)
function loadEditForm(id, z_sal) {
    fetch('get_prod_details.php', {
        method: 'POST',
        body: new URLSearchParams({ id: id, z_sal: z_sal }),
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert('خطا: اطلاعات یافت نشد.');
            return;
        }

        // ساختار مودال داخلی HTML (جایگزین ساختار SweetAlert)
        const modalHTML = `
            <div id="editModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; display: flex; justify-content: center; align-items: center; overflow-y: auto;">
                <div style="background: #fff; padding: 20px; border-radius: 10px; width: 85%; max-width: 900px; margin: 20px 0; box-shadow: 0 4px 15px rgba(0,0,0,0.4);">
                    <h3  style="color: #2e7d32; text-align: center; margin-top:5;">ثبت درخواست تغییر محصول ، مساحت </h3>
                    <p style="text-align: right; font-weight: bold; color: #d35400;">اطلاعات فعلی در سامانه:</p>
                    <!-- جدول نمایش اطلاعات فعلی (باید مشابه کد PHP باشد) -->
                    <table class="my-table" style="width:100%; margin-bottom:20px; border: 1px solid #ddd;" dir="rtl" >
                        <tr class="header-blue" style="background-color: #e3f2fd; color:#FFF">
                            <th rowspan="2" bgcolor="#006699">نام محصول</th>
                            <th colspan="2" bgcolor="#006699">سطح زیر کشت<br>(هکتار)</th>
                            <th rowspan="2" bgcolor="#006699">پیش‌بینی تولید <br>(تن)</th>
                            <th rowspan="2" bgcolor="#006699">کل مساحت زمین <br>(هکتار)</th>
                            <th rowspan="2" bgcolor="#006699">سطح آیش <br>(هکتار)</th>
                            <th rowspan="2" bgcolor="#006699">مجموع کشت اول <br>(هکتار)</th>
                            <th rowspan="2" bgcolor="#006699">مجموع کشت دوم <br>(هکتار)</th>
                        </tr>
                        <tr class="header-blue" style="background-color: #e3f2fd; color:#FFF">
                            <th bgcolor="#006699">اول</th><th bgcolor="#006699">دوم</th>
                        </tr>
                        <tr>
                            <td>${data.prod_name}</td>
                            <td>${data.zer_kesht_a}</td>
                            <td>${data.zer_kesht_b}</td>
                            <td>${data.mah_tolp || 0}</td>
                            <td>${data.m_zamin}</td>
                            <td>${data.s_ayesh}</td>
                            <td>${data.kol_zer_a}</td>
                            <td>${data.kol_zer_b}</td>
                        </tr>
                    </table>
                    
                    <form id="editForm">
                        <input type="hidden" name="id" value="${id}">
                        <input type="hidden" name="z_sal" value="${z_sal}">
                        <h4 dir="rtl" style="color:#2e7d32; margin-top:15px; text-align:right;">درج مقادیر اصلاحی جدید:</h4>

                        
                        <div dir="rtl" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; text-align:right; margin-bottom:15px; padding-bottom:15px; border-bottom: 1px solid #c5e1a5;">
                            <div>گروه محصول:<br>
                                <select name="mah_qroup" id="mah_qroup_popup" style="width:100%; height: 38px; border: 1px solid #ccc; border-radius: 4px;">
                                    ${data.group_list_html}
                                </select>
                            </div>
                            <div>نام محصول:<br>
                                <select name="n_cod_mah" id="mah_name_popup" style="width:100%; height: 38px; border: 1px solid #ccc; border-radius: 4px;">
                                    <option value="${data.cod_mah}" selected>${data.prod_name}</option>
                                </select>
                            </div>
                        </div>
                        
                        <div dir="rtl" style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; text-align:right; margin-bottom:15px;">
                            <div>سطح زیر کشت اول جدید:<br><input type="number" name="n_zer_a" step="0.0001" value="${data.zer_kesht_a}" style="width:100%; height: 38px; border: 1px solid #ccc; border-radius: 4px;"></div>
                            <div>سطح زیر کشت دوم جدید:<br><input type="number" name="n_zer_b" step="0.0001" value="${data.zer_kesht_b}" style="width:100%; height: 38px; border: 1px solid #ccc; border-radius: 4px;"></div>
                            <div>پیش‌بینی تولید جدید (تن):<br><input type="number" name="n_pishbini" step="0.1" value="${data.mah_tolp || 0}" style="width:100%; height: 38px; border: 2px solid #2e7d32; border-radius: 4px;"></div>
                        </div>
                        
                        <div dir="rtl" style="margin-top:15px; text-align:right;">
                            <label style="font-size:12px;">علت تغییر (حداکثر 150 کاراکتر):</label>
                            <textarea id="change_reason" name="reason"
                                style="width:98%; margin:5px auto; display:block; height: 80px; border: 1px solid #ccc; border-radius: 4px;"
                                maxlength="150"
                                onkeyup="document.getElementById('char_count').innerText = this.value.length"
                                placeholder="توضیحات..."></textarea>
                            <div style="text-align:left; font-size:10px; color:#666;">
                                تعداد کاراکتر: <span id="char_count">0</span> / 150
                            </div>
                        </div>
                        
                        <div dir="rtl" style="text-align: center; margin-top: 25px;">
                            <button type="submit" style="background: #006699; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-size: 14px;">ثبت درخواست </button>
                            <button type="button" onclick="closeModal()" style="background: #ccc; color: black; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; margin-left: 10px;margin-Right: 10px; font-size: 14px;">انصراف</button>
                        </div>
                    </form>
                </div>
            </div>
        `;

        // نمایش مودال
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        document.getElementById('editModal').style.display = 'flex';

        // 3.1. منطق بارگذاری مجدد لیست محصولات بر اساس گروه انتخابی (Native JS)
        const loadProducts = (groupId, selectedProdCod = null) => {
            fetch('ajax_city.php', {
                method: 'POST',
                body: new URLSearchParams({ group_cod: groupId }),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('mah_name_popup').innerHTML = html;
                if (selectedProdCod) {
                    document.getElementById('mah_name_popup').value = selectedProdCod;
                }
            });
        };

        // تنظیم شنونده برای تغییر گروه محصول
        document.getElementById('mah_qroup_popup').onchange = function() {
            loadProducts(this.value);
        };
        
        // بارگذاری اولیه محصولات
        const currentGroupId = document.getElementById('mah_qroup_popup').value;
        if (currentGroupId) {
            loadProducts(currentGroupId, data.cod_mah);
        }

        // 3.2. مدیریت ارسال فرم (جایگزین preConfirm در SweetAlert)
        document.getElementById('editForm').onsubmit = function(e) {
            e.preventDefault();
            
            // خواندن مقادیر از عناصر فرم Native JS
            const reason = document.getElementById('change_reason').value.trim();
            const new_zer_a = parseFloat(document.getElementsByName('n_zer_a')[0].value) || 0;
            const new_zer_b = parseFloat(document.getElementsByName('n_zer_b')[0].value) || 0;
            const new_pishbini = parseFloat(document.getElementsByName('n_pishbini')[0].value) || 0;
            const new_product_element = document.getElementById('mah_name_popup');
            const new_product_cod = new_product_element.value; // خواندن مقدار با .value

            // مقادیر ثابت
            const kol_zamin = parseFloat(data.m_zamin) || 0;
            const kol_ayesh = parseFloat(data.s_ayesh) || 0;
            const kol_zer_a = parseFloat(data.kol_zer_a) || 0;
            const kol_zer_b = parseFloat(data.kol_zer_b) || 0;
            const current_zer_a = parseFloat(data.zer_kesht_a) || 0;
            const current_zer_b = parseFloat(data.zer_kesht_b) || 0;
            const current_pishbini = parseFloat(data.mah_tolp) || 0;
            const no_kesh_js = data.no_kesh || "1";

            // 1. بررسی عدم تغییر
            if (new_zer_a === current_zer_a && new_zer_b === current_zer_b && new_pishbini === current_pishbini && new_product_cod === data.cod_mah) {
                alert('هیچ تغییری در مقادیر داده نشده است.');
                return;
            }

            // 2. بررسی محدودیت مساحت زمین
            const traz_a = kol_zamin - kol_ayesh - (kol_zer_a - current_zer_a + new_zer_a);
            const traz_b = kol_zamin - kol_ayesh - (kol_zer_b - current_zer_b + new_zer_b);
            
            if (new_zer_a > current_zer_a && traz_a < 0 ) {
                alert(`خطا! مجموع سطح زیر کشت اول ، بزرگتر از مساحت کل زمین - سطح آیش هست`);
                return;
            }
            if (new_zer_b > current_zer_b && traz_b < 0) {
                alert(`خطا! مجموع سطح زیر کشت دوم ، بزرگتر از مساحت کل زمین - سطح آیش هست`);
               return;
            }

            // 3. بررسی اجباری بودن علت تغییر
            if (!reason || reason.trim() === "") {
                alert('وارد کردن علت تغییر الزامی است.');
                return;
            }
            
            // 4. اعتبارسنجی پیش‌بینی تولید (فراخوانی aj.php)
            fetch('aj.php', {
                method: 'POST',
                body: new URLSearchParams({
                    op: "check_mah_tol",
                    mcod: new_product_cod, 
                    sba: new_zer_a,
                    sbb: new_zer_b,
                    mtol: new_pishbini,
                    no_kesh: no_kesh_js
                }),
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            })
            .then(response => response.text())
            .then(textResponse => {
                if (textResponse.trim() !== 'true') {
                    alert('میزان پیش‌بینی وارد شده از محدوده مجاز بیشتر است / یا میزان سطح زیر کشت را بررسی کنید.');
                    return;
                }
                
                // 5. ذخیره نهایی درخواست
                const formData = new FormData(this);

                fetch('save_request.php', {
                    method: 'POST',
                    body: formData
                })
                .then(saveResponse => saveResponse.json())
                .then(saveResponse => {
                    if (saveResponse.status === 'success') {
                        alert('موفقیت: درخواست اصلاح با موفقیت ثبت شد.');
                        closeModal();
                        location.reload(); // بارگذاری مجدد صفحه اصلی
                    } else if (saveResponse.status === 'error') {
                        alert('خطا در ثبت: ' + (saveResponse.message || 'مشکل در اعتبارسنجی الگوی کشت.'));
                    } else {
                        alert('خطا در ثبت درخواست.');
                    }
                })
                .catch(error => {
                    alert('خطا در ارسال درخواست به سرور.');
                    console.error('Save Error:', error);
                });
            })
            .catch(error => {
                alert('خطا در بررسی پیش‌بینی تولید.');
                console.error('Check Error:', error);
            });
        }; // پایان onsubmit
    })
    .catch(error => {
        alert('خطا در دریافت جزئیات محصول.');
        console.error('Fetch Details Error:', error);
    });
}
</script>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 20px;">
        <tr><td height="109" background="../../files/bottom.gif"><?php include('../../footer.php')?></td></tr>
    </table>
<?php 
function check_req($Agri_id)
{
	include('../../login/config.php');
  $query = "SELECT count(*) from Agri_prod_req where Agri_id = $Agri_id and reg_status not in ('3','33')  ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->fetchColumn();
return $result ; 
// clos conntection 

}
?>
</body>
</html>