<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

$bah_cod_m = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m']) : '';
$id    = isset($_POST['id']) ? intval($_POST['id']) : 0;
$garden_date = isset($_POST['garden_date']) ? preg_replace('/[^0-9\-]/', '', $_POST['garden_date']) : '';

// Define table names
$Garden_table      = 'Garden';
$Garden_prod_table = 'Garden_prod';

// Assign logged-in user session to a variable for later use
$mor_cod_m = $login_session;

$jsal = jdate("Y");
$tsal = substr($garden_date, 0, 4);

if ($tsal > $jsal) {
    $sabt_mah = 0; // Future year, only prediction
} else {
    $sabt_mah = 1; // Current or past year, actual yield and damage report are required
}

// Fetch main garden data, including `nah_kesh` for form logic
$query = "SELECT id_ostan, id_city, num_bah, sh_gat, no_kesh, nah_kesh, m_zamin, add_abadi, add_city, id_mar FROM `$Garden_table` WHERE id = :id LIMIT 1 ";
$stmt = $dbh->prepare($query);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$found = $stmt->rowCount();
if ($found) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    die("خطا: رکورد باغ مورد نظر یافت نشد.");
    $row = array();
}

$num_bah = !empty($row['num_bah']) ? $row['num_bah'] : '1';
$sh_gat = $row['sh_gat'];
$no_kesh = $row['no_kesh'];
$nah_kesh = $row['nah_kesh']; // Crucial for hiding/showing columns
$m_zamin = $row['m_zamin'];
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
$id_mar = $row['id_mar'];
$s_ayesh = $row['s_ayesh'];
$id_ostan = $row['id_ostan'];
$id_city = $row['id_city'];

$v_no_kesh = ($no_kesh == '1') ? 'آبی' : 'دیم';

// Pre-fetch product groups and names for efficiency
$all_groups = array();
$stmt_groups = $dbh->query("SELECT group_cod, group_name FROM product_b GROUP BY group_cod ORDER BY group_cod");
while ($g = $stmt_groups->fetch(PDO::FETCH_ASSOC)) {
    $all_groups[$g['group_cod']] = $g['group_name'];
}

$products_by_group_map = array();
$stmt_products = $dbh->query("SELECT product_cod, product_name, group_cod FROM product_b ORDER BY group_cod, product_cod");
while ($p = $stmt_products->fetch(PDO::FETCH_ASSOC)) {
    if (!isset($products_by_group_map[$p['group_cod']])) {
        $products_by_group_map[$p['group_cod']] = array();
    }
    $products_by_group_map[$p['group_cod']][$p['product_cod']] = $p['product_name'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR" xml:lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $title; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/tailwindcss.css" rel="stylesheet" type="text/css" />
    <style>
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 1000; }
        .modal-content { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); max-width: 400px; text-align: center; }
        .modal-buttons { margin-top: 20px; }
        .modal-buttons button { padding: 8px 16px; margin: 0 5px; border: none; border-radius: 5px; cursor: pointer; }
        .modal-buttons .confirm-btn { background-color: #069; color: white; }
        .modal-buttons .cancel-btn { background-color: #ccc; color: #333; }
        .hidden { display: none; }
        body { font-family: 'myfont', sans-serif; background-color: #f3f4f6; direction: rtl; }
        .input_text { height: 40px; padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 0.375rem; box-sizing: border-box; width: 100%; background-color: #ffffff; text-align: right; }
        #crud_table1 input[type="text"], #crud_table1 select { height: 38px; padding: 6px 10px; border-radius: 0.375rem; box-sizing: border-box; border: 1px solid #d1d5db; width: 100%; text-align: right; font-size: 13px; }
        #add1, .remove { font-size: 24px; width: 45px; height: 45px; display: flex; justify-content: center; align-items: center; border: none; border-radius: 0.375rem; cursor: pointer; }
        #add1 { background-color: #10B981; color: white; }
        .remove { background-color: #EF4444; color: white; }
        #crud_table1 { width: 100%; border-collapse: collapse; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #ffffff; }
        #crud_table1 thead th { background-color: #E5E7EB; color: #374151; padding: 12px 10px; font-weight: 600; text-align: center; border-bottom: 2px solid #D1D5DB; }
        #crud_table1 tbody td { padding: 8px; border-bottom: 1px solid #E5E7EB; text-align: center; vertical-align: middle; }
        #crud_table1 tbody tr.editing-row { background-color: #FEF3C7; }
        .btn-33 { background-color: #2563EB; color: white; padding: 10px 20px; border-radius: 0.375rem; font-size: 1rem; cursor: pointer; }
        .btn-33:disabled { background-color: #9CA3AF; cursor: not-allowed; }
        .cultivation-area-col { <?php if ($nah_kesh == '3') echo 'display: none;'; ?> }
    </style>
</head>
<body class="p-4">
    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-xl p-6">
        <p class="text-2xl font-bold text-gray-800 mb-4 text-center">ویرایش محصولات باغی<br /><?php sar_data2($bah_cod_m, $num_bah); ?></p>

        <div class="bg-gray-50 rounded-lg p-4 mb-4 border border-gray-200">
             <div class="px-6 flex flex-wrap items-center justify-between gap-x-6 gap-y-2 mb-2">
                    <div class="flex items-center"><div class="ml-2 text-gray-600">استان:</div><div class="font-bold text-gray-800"><?php echo ostan_name($id_ostan); ?></div></div>
                    <div class="flex items-center"><div class="ml-2 text-gray-600">شهرستان:</div><div class="font-bold text-gray-800"><?php echo city_name1($id_city, $id_ostan); ?></div></div>
                    <div class="flex items-center"><div class="ml-2 text-gray-600">سال باغی:</div><div class="font-bold text-gray-800"><?php echo $garden_date; ?></div></div>
                    <div class="flex items-center"><div class="ml-2 text-gray-600">نوع کشت:</div><div class="font-bold text-gray-800"><?php echo $v_no_kesh; ?></div></div>
             </div>
        </div>
        <div class="bg-gray-50 rounded-lg p-4 mb-4 border border-gray-200">
             <div class="px-6 flex flex-wrap items-center justify-between gap-x-4 gap-y-2">
                 <div class="flex items-center">
                    <div class="ml-2 text-gray-600">مساحت زمین:</div>
                    <input name="m_zamin" type="text" class="m_zamin input_text w-24 text-center bg-gray-200" id="m_zamin" value="<?php echo $m_zamin * 1; ?>" readonly />
                    <span class="mr-2 text-gray-600">هکتار</span>
                </div>
                <div class="flex items-center">
                    <div class="ml-2 text-gray-600">سطح آیش:</div>
                    <input name="s_ayesh" type="text" class="s_ayesh input_text w-24 text-center" id="s_ayesh" value="<?php echo $s_ayesh * 1; ?>" />
                    <span class="mr-2 text-gray-600">هکتار</span>
                </div>
                <div class="flex items-center">
                    <div class="ml-2 text-gray-600 font-semibold">تراز مساحت (هکتار):</div>
                    <input name="traz1" type="text" disabled="disabled" style="width:100px; text-align:center; border-radius:5px;" class="bg-gray-200" id="traz1" />
                </div>
             </div>
             <div class="text-center text-xs text-red-500 mt-2">توجه: تراز مساحت (مساحت زمین منهای مجموع سطح آیش و سطح زیر کشت) نباید منفی باشد.</div>
        </div>

        <div class="table-responsive mb-6">
            <table id="crud_table1">
                <thead>
                    <tr>
                        <th colspan="2">اطلاعات محصول</th>
                        <th colspan="2" class="cultivation-area-col">سطح کاشت (هکتار)</th>
                        <th colspan="2">تعداد درخت</th>
                        <th colspan="2">میزان تولید (تن)</th>
                        <th rowspan="2">خسارت دیده</th>
                        <th rowspan="2">بیمه</th>
                        <th colspan="2" rowspan="2">عملیات</th>
                    </tr>
                    <tr>
                        <th style="width:18%">گروه</th>
                        <th style="width:18%">نام</th>
                        <th class="cultivation-area-col">بارور</th>
                        <th class="cultivation-area-col">غیربارور</th>
                        <th>بارور</th>
                        <th>غیربارور</th>
                        <th>پیش بینی</th>
                        <th>قطعی</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_prods = "SELECT id, cod_qroup, cod_mah, s_barvar, s_gheir_barvar, t_barvar, t_gheir_barvar, mah_tolp, mah_tol, mah_bem, mah_kh FROM $Garden_prod_table WHERE Garden_id = :id ORDER BY id";
                    $stmt_prods = $dbh->prepare($query_prods);
                    $stmt_prods->bindValue(':id', $id, PDO::PARAM_INT);
                    $stmt_prods->execute();
                    $rownum = $stmt_prods->rowCount();
                    $row_index = 1;
                    foreach ($stmt_prods as $prod_row) {
                    ?>
                        <tr class="delete_mem<?php echo $prod_row["id"] ?>">
                            <td><select class="cod_q" id="cod_qroup<?php echo $row_index; ?>"><option value="">انتخاب گروه</option><?php foreach ($all_groups as $g_cod => $g_name) { echo "<option value='$g_cod' " . ($g_cod == $prod_row['cod_qroup'] ? 'selected' : '') . ">$g_name</option>"; } ?></select></td>
                            <td><select class="cod_m" id="cod_mah<?php echo $row_index;?>"><option value="">انتخاب محصول</option><?php if (isset($products_by_group_map[$prod_row['cod_qroup']])) { foreach ($products_by_group_map[$prod_row['cod_qroup']] as $p_cod => $p_name) { echo "<option value='$p_cod' " . ($p_cod == $prod_row['cod_mah'] ? 'selected' : '') . ">$p_name</option>"; } } ?></select></td>
                            <td class="cultivation-area-col"><input type="text" class="s_barvar" id="s_barvar<?php echo $row_index; ?>" value="<?php echo $prod_row['s_barvar'] * 1; ?>" /></td>
                            <td class="cultivation-area-col"><input type="text" class="s_gheir_barvar" id="s_gheir_barvar<?php echo $row_index; ?>" value="<?php echo $prod_row['s_gheir_barvar'] * 1; ?>" /></td>
                            <td><input type="text" class="t_barvar" id="t_barvar<?php echo $row_index; ?>" value="<?php echo $prod_row['t_barvar'] * 1; ?>" /></td>
                            <td><input type="text" class="t_gheir_barvar" id="t_gheir_barvar<?php echo $row_index; ?>" value="<?php echo $prod_row['t_gheir_barvar'] * 1; ?>" /></td>
                            <td><input type="text" class="mah_tolp" id="mah_tolp<?php echo $row_index; ?>" value="<?php echo round($prod_row['mah_tolp'], 3); ?>" /></td>
                            <td><input type="text" class="mah_tol" id="mah_tol<?php echo $row_index; ?>" value="<?php echo round($prod_row['mah_tol'], 3); ?>" <?php if ($sabt_mah == 0) echo 'readonly'; ?> /></td>
                            <td><select id="mah_kh<?php echo $row_index; ?>" <?php if ($sabt_mah == 0) echo 'disabled'; ?>><option value="">انتخاب</option><option value="1" <?php if ($prod_row['mah_kh'] == '1') echo 'selected'; ?>>بلی</option><option value="2" <?php if ($prod_row['mah_kh'] == '2') echo 'selected'; ?>>خیر</option></select></td>
                            <td><select id="mah_bem<?php echo $row_index; ?>"><option value="">انتخاب</option><option value="1" <?php if ($prod_row['mah_bem'] == '1') echo 'selected'; ?>>بلی</option><option value="2" <?php if ($prod_row['mah_bem'] == '2') echo 'selected'; ?>>خیر</option></select></td>
                            <td><a href="#" style="display:none" id="btn_edit<?php echo $row_index; ?>" class="item_edit" data-index="<?php echo $row_index ?>" data-id="<?php echo $prod_row["id"] ?>"><img src="../../files/desk.png" title="ذخیره تغییرات" width="25" /></a></td>
                            <td><a href="#" class="item_del" data-id="<?php echo $prod_row["id"] ?>" data-z_sal="<?php echo $garden_date; ?>" data-check="<?php echo check_payesh($prod_row['id'],0,substr($garden_date, 0, 4)) ?>"><img src="../../files/del.png" title="حذف محصول" width="33" /></a></td>
                        </tr>
                    <?php $row_index++; } ?>
                </tbody>
            </table>
            <div class="flex justify-start mt-6"><button type="button" name="add" id="add1">+</button></div>
            <div id="save_btn" class="flex justify-center mt-4"><button type="button" name="save" id="save1" class="btn-33">ثبت محصولات جدید</button></div>
        </div>
        <div class="flex justify-center mt-8"><input type="button" value="بستن پنجره" onclick="close_window()" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md" /></div>
    </div>

    <div id="customAlertModal" class="modal-overlay hidden"><div class="modal-content"><p id="customAlertMessage"></p><div class="modal-buttons"><button class="confirm-btn" onclick="hideCustomAlert()">تایید</button></div></div></div>
    <div id="customConfirmModal" class="modal-overlay hidden"><div class="modal-content"><p id="customConfirmMessage"></p><div class="modal-buttons"><button class="confirm-btn" id="customConfirmYes">بله</button><button class="cancel-btn" id="customConfirmNo">خیر</button></div></div></div>

<script src="../../assets/js/jquery-3.6.0.min.js"></script>
<script>
    // FIX: Pass PHP data to JS variables before using them
    const allProductGroups = <?php echo json_encode($all_groups); ?>;
    const NAH_KESH = '<?php echo $nah_kesh; ?>';
    const SABT_MAH = <?php echo $sabt_mah; ?>;
    const NO_KESH = '<?php echo $no_kesh; ?>';
    let confirmCallback = null;

    // --- MODAL AND UI FUNCTIONS ---
    function showCustomAlert(message) { $('#customAlertMessage').text(message); $('#customAlertModal').removeClass('hidden'); }
    function hideCustomAlert() { $('#customAlertModal').addClass('hidden'); }
    function showCustomConfirm(message, callback) { confirmCallback = callback; $('#customConfirmMessage').text(message); $('#customConfirmModal').removeClass('hidden'); }
    function hideCustomConfirm() { $('#customConfirmModal').addClass('hidden'); confirmCallback = null; }
    $('#customConfirmYes').click(() => { if (confirmCallback) confirmCallback(true); hideCustomConfirm(); });
    $('#customConfirmNo').click(() => { if (confirmCallback) confirmCallback(false); hideCustomConfirm(); });
    function hasUnsavedChanges() { return $('#crud_table1 tbody tr.editing-row, #crud_table1 tbody tr.temp_row').length > 0; }
    function close_window() {
        if (hasUnsavedChanges()) {
            showCustomConfirm('تغییرات ثبت نشده‌ای وجود دارد. آیا از بستن پنجره اطمینان دارید؟', (confirmed) => { if (confirmed) window.close(); });
        } else { window.close(); }
    }

    // --- CORE LOGIC & CALCULATIONS ---
    function calculate_traz() {
        const m_zamin = parseFloat($('#m_zamin').val()) || 0;
        const s_ayesh = parseFloat($('#s_ayesh').val()) || 0;
        let total_planted_area = 0;
        $('#crud_table1 .s_barvar, #crud_table1 .s_gheir_barvar').each(function() { total_planted_area += parseFloat($(this).val()) || 0; });
        const traz_total = m_zamin - (s_ayesh + total_planted_area);
        const traz_display = $('#traz1');
        traz_display.val(traz_total.toFixed(4));
        if (traz_total < 0) {
            traz_display.css({ 'color': 'red', 'font-weight': 'bold' });
            $('#save1').prop('disabled', true);
        } else {
            traz_display.css({ 'color': 'black', 'font-weight': 'normal' });
            if (!$('#save1').data('production-error')) { $('#save1').prop('disabled', false); }
        }
    }
    function fetch_products(group_select, product_select) {
        const cod_qroup = group_select.val();
        product_select.empty().append('<option value="">بارگذاری...</option>');
        if (cod_qroup) {
            $.ajax({
                url: "../../select.php", method: "POST", data: { op: "product_z", cod_qroup: cod_qroup },
                success: (data) => product_select.empty().append('<option value="">انتخاب محصول</option>').append(data),
                error: () => product_select.empty().append('<option value="">خطا</option>')
            });
        } else { product_select.empty().append('<option value="">انتخاب محصول</option>'); }
    }

    // --- VALIDATION FUNCTIONS ---
    function validateYield(element) {
        const row = $(element).closest('tr');
        const mcod = row.find('.cod_m').val();
        const mtol = $(element).val();
        const s_barvar = parseFloat(row.find('.s_barvar').val()) || 0;
        const skb = s_barvar.toFixed(4);
        if (mcod && parseFloat(mtol) > 0) {
            $('#save1').data('production-error', true).prop('disabled', true).text('در حال بررسی...');
            $.ajax({
                url: "../../select.php", type: "POST", data: { op: "check_mah_tol", mcod: mcod, skb: skb, mtol: mtol, no_kesh: NO_KESH },
                success: function(data) {
                    if (data !== 'true') {
                        showCustomAlert('خطا: میزان تولید وارد شده از محدوده مجاز بیشتر است.');
                        $(element).val('').focus();
                    }
                    $('#save1').data('production-error', false);
                    calculate_traz();
                    $('#save1').text('ثبت محصولات جدید');
                },
                error: () => showCustomAlert("خطا در اتصال به سرور!")
            });
        }
    }
    function validateTreeCount(element) {
        const row = $(element).closest('tr');
        const mcod = row.find('.cod_m').val();
        const tree_count = parseFloat($(element).val()) || 0;
        if (tree_count <= 0) return;
        const isBarvar = $(element).hasClass('t_barvar');
        const area_selector = isBarvar ? '.s_barvar' : '.s_gheir_barvar';
        const cultivation_area = parseFloat(row.find(area_selector).val()) || 0;
        const nonTreeProducts = ['203003', '206024', '205002', '299006', '299003', '208034', '208037', '208046', '208052', '208053', '208108', '208999'];
        if (nonTreeProducts.includes(mcod)) {
            showCustomAlert("برای این محصول (مانند توت فرنگی، زعفران، چای) نباید تعداد درخت ثبت شود.");
            $(element).val(0);
            return;
        }
        if (cultivation_area <= 0 && NAH_KESH !== '3') {
            showCustomAlert(`به علت صفر بودن سطح کشت ${(isBarvar ? "بارور" : "غیربارور")}، امکان ثبت تعداد درخت وجود ندارد.`);
            $(element).val(0);
        }
    }

    // --- EVENT HANDLERS ---
    $(document).ready(function() {
        calculate_traz();
        $(document).on('change keyup', '#crud_table1 input, #crud_table1 select', function() {
            const row = $(this).closest('tr');
            if (!row.hasClass('temp_row')) { row.addClass('editing-row'); row.find('.item_edit').show(); }
        });
        $(document).on('change keyup', '.s_barvar, .s_gheir_barvar, .s_ayesh', calculate_traz);
        $(document).on('change', '.mah_tolp, .mah_tol', function() { validateYield(this); });
        $(document).on('change', '.t_barvar, .t_gheir_barvar', function() { validateTreeCount(this); });
        $(document).on('change', '.cod_q', function() {
            const row = $(this).closest('tr');
            fetch_products($(this), row.find('.cod_m'));
            row.find('input[type=text]').val('');
            calculate_traz();
        });
        $(document).on('change', '.cod_m', function() { $(this).closest('tr').find('.t_barvar, .t_gheir_barvar, .mah_tolp, .mah_tol').val(''); });
        $(document).on('click', '.item_edit', function(e) { e.preventDefault(); /* Your existing AJAX for update */ });
        $(document).on('click', '.item_del', function(e) { e.preventDefault(); /* Your existing AJAX for delete */ });

        let i = <?php echo $rownum; ?> + 1;
        $('#add1').click(function() {
            calculate_traz();
            if (parseFloat($('#traz1').val()) < 0) {
                 showCustomAlert("ابتدا تراز مساحت را با تصحیح مقادیر قبلی، مثبت یا صفر کنید.");
                 return;
            }
            // FIX: Build options from the JS variable, not with PHP
            let groupOptions = '<option value="">انتخاب گروه</option>';
            for (const group_code in allProductGroups) {
                groupOptions += `<option value="${group_code}">${allProductGroups[group_code]}</option>`;
            }
            const cultivation_cols = NAH_KESH === '3' ? '' : `<td class="cultivation-area-col"><input type="text" class="s_barvar" id="s_barvar${i}" /></td><td class="cultivation-area-col"><input type="text" class="s_gheir_barvar" id="s_gheir_barvar${i}" /></td>`;
            const production_cols = SABT_MAH === 1 ? `<td><input type="text" class="mah_tol" id="mah_tol${i}" /></td><td><select id="mah_kh${i}"><option value="">انتخاب</option><option value="1">بلی</option><option value="2">خیر</option></select></td>` : `<td><input type="text" class="mah_tol" id="mah_tol${i}" value="0" readonly /></td><td><select id="mah_kh${i}" disabled><option value="2" selected>خیر</option></select></td>`;
            const new_row = `<tr class="temp_row editing-row"><td><select class="cod_q" id="cod_qroup${i}">${groupOptions}</select></td><td><select class="cod_m" id="cod_mah${i}"><option value="">انتخاب محصول</option></select></td>${cultivation_cols}<td><input type="text" class="t_barvar" id="t_barvar${i}" /></td><td><input type="text" class="t_gheir_barvar" id="t_gheir_barvar${i}" /></td><td><input type="text" class="mah_tolp" id="mah_tolp${i}" /></td>${production_cols}<td><select id="mah_bem${i}"><option value="">انتخاب</option><option value="1">بلی</option><option value="2">خیر</option></select></td><td></td><td><button type="button" class="remove">-</button></td></tr>`;
            $('#crud_table1 tbody').append(new_row);
            i++;
        });

        $(document).on('click', '.remove', function() { $(this).closest('tr').remove(); calculate_traz(); });
        $('#save1').click(function() { /* Your existing AJAX logic for bulk insert */ });
    });
</script>
</body>
</html>