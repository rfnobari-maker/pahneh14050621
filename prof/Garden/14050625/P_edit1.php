<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

$bah_cod_m  = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m']) : '';
$from_page = isset($_POST['from_page']) ? $_POST['from_page'] : 'liste';
$back_list_pages = array(
    'liste' => 'liste_Garden.php',
    'liste1' => 'liste_Garden1.php',
    'manager' => 'manager_Garden.php'
);
if (!isset($back_list_pages[$from_page])) {
    $from_page = 'liste';
}
$back_list_action = $back_list_pages[$from_page];
$show_bah_error = false;
$bah_error_text = '';

// بررسی وضعیت بهره‌بردار
if ($bah_cod_m != '') {
    $bah_status = check_bah_cod_m($bah_cod_m);
    
    if ($bah_status == 2) {
        $show_bah_error = true;
        $bah_error_text = 'بهره بردار در قید حیات نمیباشد !! امکان ثبت اطلاعات مقدور نیست.';
    } elseif ($bah_status == 4) {
        $show_bah_error = true;
        $bah_error_text = 'اطلاعات بهره بردار از طرف ثبت احوال تایید نشد !! امکان ثبت اطلاعات مقدور نمیباشد.';
    } elseif ($bah_status == 0) {
        $show_bah_error = true;
        $bah_error_text = 'بهره بردار یافت نشد.';
    }
}
// پایان بررسی وضعیت حیات
$id          = isset($_POST['id']) ? intval($_POST['id']) : 0;
$z_sal = isset($_POST['z_sal']) ? preg_replace('/[^0-9\-]/', '', $_POST['z_sal']) : '';

// Define table names
$Garden_table      = 'Garden';
$Garden_prod_table = 'Garden_prod';

// Assign logged-in user session to a variable for later use
$mor_cod_m = $login_session;

$jsal = jdate("Y");
$tsal = substr($z_sal, 0, 4);

if ($tsal > $jsal) {
    $sabt_mah = 0; // Future year, only prediction
} else {
    $sabt_mah = 1; // Current or past year, actual yield and damage report are required
}

// Fetch main garden data, including `nah_kesh` for form logic
$query = "SELECT id_ostan, id_city, num_bah, sh_gat, no_kesh, nah_kesh, m_zamin, add_abadi, add_city, id_mar,z_sal FROM `$Garden_table` WHERE id = :id LIMIT 1 ";
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
$z_sal = $row['z_sal'];
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

$v_no_kesh = '';
if ($no_kesh=='1')  $v_no_kesh='آبی';
if ($no_kesh=='2')  $v_no_kesh='دیم';
$v_nah_kesh = '';
if ($nah_kesh=='1') $v_nah_kesh='ساده' ;	 
if ($nah_kesh=='2') $v_nah_kesh='مخلوط' ;	 
if ($nah_kesh=='3') $v_nah_kesh='درختان پراکنده' ;	 





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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/tailwindcss.css" rel="stylesheet" type="text/css" />    
    <style>
input.m_tol,
input.m_tolp {
        font-size: 12px !important;
    }
        /* Custom styles for the modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            text-align: center;
        }

        .modal-buttons {
            margin-top: 20px;
        }

        .modal-buttons button {
            padding: 8px 16px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-buttons .confirm-btn {
            background-color: #069;
            color: white;
        }

        .modal-buttons .cancel-btn {
            background-color: #ccc;
            color: #333;
        }
       .hidden {
           display: none;
           }
        html {
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
        }
        /* Base styles for the page */
        body {
            font-family: 'myfont', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
            direction: rtl; /* Ensure RTL direction for the whole page */
        }

        /* Styles for input and select elements to ensure consistent height and modern look */
        .input_text {
            height: 40px;
            padding: 8px 12px;
            border: 1px solid #d1d5db; /* Light gray border */
            border-radius: 0.375rem; /* rounded-md */
            box-sizing: border-box;
            width: 100%; /* Make inputs take full width of their container */
            background-color: #ffffff; /* White background */
            font-size: 0.875rem; /* text-sm */
            color: #374151; /* Gray-700 */
            text-align: right; /* Explicitly right-align text in general inputs */
        }

        select.input_text {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="%236b7280" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
            background-repeat: no-repeat;
            background-position: left 0.5rem center; /* Position arrow on the left for RTL */
            padding-right: 2.5rem; /* Make space for the arrow */
        }

        /* Ensure table inputs and selects also have consistent styling */
        #crud_table1 input[type="text"],
        #crud_table1 select {
            height: 38px; /* Slightly larger height for table inputs for better touch */
            padding: 6px 10px;
            border-radius: 0.375rem; /* rounded-md */
            box-sizing: border-box;
            border: 1px solid #d1d5db;
            font-size: 0.875rem; /* text-sm */
            width: 100%; /* Ensure they fill the cell */
            text-align: right; /* Explicitly right-align text in table inputs/selects */
        }

        /* Styles for larger + and - buttons */
        #add1,
        .remove {
            font-size: 24px;
            width: 45px; /* Slightly larger buttons */
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            line-height: 1;
            padding: 0;
            border: none; /* Remove default border */
            border-radius: 0.375rem; /* rounded-md */
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease-in-out;
        }

        #add1 {
            background-color: #10B981; /* Green-500 */
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        #add1:hover {
            background-color: #059669; /* Green-600 */
            transform: translateY(-1px);
        }

        .remove {
            background-color: #EF4444; /* Red-500 */
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .remove:hover {
            background-color: #DC2626; /* Red-600 */
            transform: translateY(-1px);
        }

        /* Smaller font size for product group and name selects */
        .cod_q,
        .cod_m {
            font-size: 0.875rem; /* text-sm */
            width: 100%; /* Ensure they fill the cell */
        }

        /* Modern table styling */
        #crud_table1 {
            width: 100%;
            border-collapse: collapse; /* Remove double borders */
            border-radius: 0.5rem; /* rounded-lg */
            overflow: hidden; /* Ensures rounded corners apply to children */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* shadow-md */
            background-color: #ffffff;
        }

        #crud_table1 thead th {
            background-color: #E5E7EB; /* Gray-200 */
            color: #374151; /* Gray-700 */
            padding: 12px 10px;
            font-weight: 600; /* font-semibold */
            text-align: center; /* Keep headers centered for better visual balance */
            border-bottom: 2px solid #D1D5DB; /* border-gray-300 */
            border-right: 1px solid #D1D5DB; /* Vertical separator */
        }

        #crud_table1 thead th:last-child {
            border-right: none; /* No right border for the last column */
        }

        #crud_table1 tbody td {
            padding: 10px;
            border-bottom: 1px solid #E5E7EB; /* Light gray border for rows */
            border-right: 1px solid #F3F4F6; /* Very light border for cells */
            text-align: right; /* Changed to right-align for table body cells */
            vertical-align: middle;
            font-size: 0.875rem; /* text-sm */
            color: #4B5563; /* Gray-600 */
        }
        #crud_table1 tbody td:last-child {
            border-right: none;
        }

        #crud_table1 tbody tr:last-child td {
            border-bottom: none; /* No bottom border for the last row */
        }

        /* Row highlighting for editing - Changed from light green to light red */
        #crud_table1 tbody tr.editing-row {
            background-color: #FFCCCC; /* Light Red */
        }

        /* Button for "ثبت محصول / محصولات جدید" */
        .btn-33 {
            background-color: #2563EB; /* Blue-600 */
            color: white;
            padding: 10px 20px;
            border-radius: 0.375rem; /* rounded-md */
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-33:hover {
            background-color: #1D4ED8; /* Blue-700 */
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .btn-33:disabled {
            background-color: #9CA3AF; /* Gray-400 */
            cursor: not-allowed;
            box-shadow: none;
        }

        .last-year-scroll {
            max-height: calc(2.25rem + (5 * 2.75rem));
            overflow-y: auto;
            overflow-x: auto;
            border: 1px solid #E5E7EB;
            border-radius: 0.375rem;
            background-color: #ffffff;
            -webkit-overflow-scrolling: touch;
        }
        #last_year_table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #ffffff;
        }
        #last_year_table th {
            position: sticky;
            top: 0;
            z-index: 2;
            background-color: #E5E7EB;
            color: #374151;
            padding: 8px;
            font-size: 0.8rem;
            text-align: center;
            box-shadow: inset 0 -1px 0 #D1D5DB;
        }
        #last_year_table td {
            padding: 6px 8px;
            border-bottom: 1px solid #E5E7EB;
            font-size: 0.8rem;
            text-align: right;
            vertical-align: middle;
        }
        #last_year_table .btn-33 {
            padding: 4px 10px;
            font-size: 0.8rem;
        }
        .ly-ok { color: #059669; font-weight: 600; }
        .ly-no { color: #DC2626; }

        /* Close window button */
        input[type="submit"][name="action"] {
            background-color: #6B7280; /* Gray-500 */
            color: white;
            padding: 10px 20px;
            border-radius: 0.375rem;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
            border: none;
        }
        input[type="submit"][name="action"]:hover {
            background-color: #4B5563; /* Gray-600 */
        }

        .item_edit, .item_del {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 44px;
            min-height: 44px;
            padding: 8px;
            box-sizing: border-box;
        }
        .item_edit img, .item_del img {
            transition: transform 0.1s ease-in-out;
        }
        .item_edit:hover img, .item_del:hover img {
            transform: scale(1.1);
        }

        .table-h-hint {
            display: none;
            margin: 0 0 8px;
            font-size: 0.875rem;
            color: #4B5563;
            text-align: right;
        }

        /* Responsive adjustments */
        @media (max-width: 1100px) {
            .table-h-hint {
                display: block;
            }
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            #crud_table1 {
                min-width: 1100px;
            }
            #crud_table1 thead th {
                white-space: nowrap;
            }
            #last_year_table {
                min-width: 720px;
            }
        }
        @media (max-width: 768px) {
            .last-year-scroll {
                max-height: none;
                overflow-x: auto;
                overflow-y: auto;
            }
            #last_year_table .btn-33 {
                min-height: 44px;
                padding: 10px 14px;
                font-size: 1rem;
            }
            #last_year_actions .btn-33,
            #save1,
            #btn_close_form {
                width: 100%;
                min-height: 44px;
            }
            #crud_table1 input[type="text"],
            #crud_table1 select {
                font-size: 16px;
                min-height: 44px;
                height: 44px;
            }
            input.m_tol,
            input.m_tolp {
                font-size: 16px !important;
            }
        }
    </style>
</head>
<body class="p-4">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-xl p-6 md:p-8">
        <p class="text-2xl font-bold text-gray-800 mb-4 text-center">ویرایش محصولات باغی
            <br />
            <?php sar_data2($bah_cod_m, $num_bah); ?>
        </p>
<div class="bg-gray-50 rounded-lg p-4 mb-4 border border-gray-200">
    <h2 class="text-lg font-semibold text-gray-700 mb-2 pb-2 border-b border-gray-300 text-right">موقعیت بهره برداری</h2>
    
    <div class="px-6"> <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-2 mb-2">
            <div class="flex items-center">
                <div class="ml-4 text-gray-600">استان :</div>
                <div class="input_text w-full md:w-auto text-right"><?php echo ostan_name($id_ostan); ?></div>
            </div>

            <div class="flex items-center">
                <div class="ml-4 text-gray-600">شهرستان :</div>
                <div class="input_text w-full md:w-auto text-right"><?php echo city_name1($id_city, $id_ostan); ?></div>
            </div>

            <div class="flex items-center">
                <div class="ml-4 text-gray-600"> مرکز جهاد کشاورزی :</div>
                <div class="input_text w-full md:w-auto text-right"><?php echo mar_name($id_mar); ?></div>
            </div>
        </div>

        <div class="flex items-center justify-end md:justify-start">
            <div class="ml-4 text-gray-600"> آبادی / شهر :</div>
            <div class="input_text w-full md:w-auto text-right"><?php echo abadi_name($add_abadi); ?></div>
        </div>
    </div>
</div>
<div class="bg-gray-50 rounded-lg p-4 mb-4 border border-gray-200">
    <h2 class="text-lg font-semibold text-gray-700 mb-2 pb-2 border-b border-gray-300 text-right">اطلاعات زمین</h2>
    
    <div class="px-6"> <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-2 mb-2">
<?php if ($nah_kesh != '3'): ?>
            <div class="flex items-center">

                <div class="ml-4 text-gray-600">نوع کشت :</div>
                <div class="input_text w-full md:w-auto text-right"><?php echo $v_no_kesh; ?></div>
            </div>

            <div class="flex items-center">
                <div class="ml-4 text-gray-600"> مساحت زمین :</div>
                <input name="m_zamin" type="text" class="m_zamin input_text number required w-24 text-right" id="m_zamin" tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin * 1; ?>" maxlength="15" readonly xml:lang="fa" />
                <span class="mr-4 text-gray-600">هکتار</span>
            </div>
<?php endif; ?>
            <div class="flex items-center">
                <div class="ml-4 text-gray-600">نحوه کشت :</div>
            <div class="input_text w-full md:w-auto text-right"><?php echo $v_nah_kesh; ?></div>
            </div>
        </div>

        <div class="flex items-center justify-end md:justify-start">
            <div class="ml-4 text-gray-600"> سال :</div>
            <div class="input_text w-full md:w-auto text-right"><?php echo $z_sal; ?></div>
        </div>
    </div>
</div>

<div id="last_year_block" class="bg-gray-50 rounded-lg p-4 mb-4 border border-gray-200 hidden">
    <h2 class="text-lg font-semibold text-gray-700 mb-2 pb-2 border-b border-gray-300 text-right">محصولات سال قبل</h2>
    <p class="text-sm text-gray-600 mb-3 text-right">ردیف‌های مجاز با یک کلیک منتقل می‌شوند. تولید و خسارت کپی نمی‌شود.</p>
    <p class="table-h-hint">برای مشاهده همه ستون‌ها جدول را افقی بکشید.</p>
    <div class="table-responsive last-year-scroll" tabindex="0" aria-label="فهرست محصولات سال قبل">
        <table id="last_year_table">
            <thead>
                <tr>
                    <th>گروه</th>
                    <th>محصول</th>
                    <?php if ($nah_kesh != '3'): ?>
                    <th>سطح بارور</th>
                    <th>سطح غیربارور</th>
                    <?php endif; ?>
                    <th>درخت بارور</th>
                    <th>درخت غیربارور</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div id="last_year_actions" class="flex justify-center mt-3 hidden">
        <button type="button" id="btn_transfer_all_allowed" class="btn-33">انتقال همه موارد مجاز</button>
    </div>
</div>

        <p class="table-h-hint">برای مشاهده همه ستون‌ها جدول را افقی بکشید.</p>
        <div class="table-responsive mb-6">
<table id="crud_table1">
    <thead>
        <tr>
            <th colspan="2">اطلاعات محصول</th>
            <?php if ($nah_kesh != '3'): ?>
                <th colspan="2" class="cultivation-area-col">سطح کاشت (هکتار)</th>
            <?php else: ?>
                <th colspan="2" class="cultivation-area-col" style="display:none;">&nbsp;</th>
            <?php endif; ?>
            <th colspan="2">تعداد درخت</th>
            <th colspan="2">میزان تولید (تن)</th>
            <th width="7%" rowspan="2">خسارت دیده</th>
            <th width="7%" rowspan="2">بیمه</th>
            <th colspan="2" rowspan="2">عملیات</th>
        </tr>
        <tr>
            <th width="17%">گروه</th>
            <th width="17%">نام</th>
            <?php if ($nah_kesh != '3'): ?>
                <th class="cultivation-area-col">بارور</th>
                <th class="cultivation-area-col">غیربارور</th>
            <?php else: ?>
                <th class="cultivation-area-col" style="display:none;">&nbsp;</th>
                <th class="cultivation-area-col" style="display:none;">&nbsp;</th>
            <?php endif; ?>
            <th>بارور</th>
            <th>غیربارور</th>
            <th>پیش بینی</th>
            <th>قطعی</th>
        </tr>
    </thead>
    <tbody>
               <?php
                    $query_prods = "SELECT id, cod_qroup, cod_mah, s_kesht_b,s_kesht_gb,tree_b,tree_gb, mah_tolp, mah_tol, mah_bem, mah_kh FROM $Garden_prod_table WHERE Garden_id = :id ORDER BY id";
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
                          <?php if ($nah_kesh != '3'): ?>
                               <td class="cultivation-area-col"><input type="text" class="s_barvar" id="s_barvar<?php echo $row_index; ?>" value="<?php echo $prod_row['s_kesht_b'] * 1; ?>" /></td>
                               <td class="cultivation-area-col"><input type="text" class="s_gheir_barvar" id="s_gheir_barvar<?php echo $row_index; ?>" value="<?php echo $prod_row['s_kesht_gb'] * 1; ?>" /></td>
                          <?php else: ?>
                               <td style="display:none;"><input type="hidden" class="s_barvar" value="0" /></td>
                               <td style="display:none;"><input type="hidden" class="s_gheir_barvar" value="0" /></td>
                          <?php endif; ?>
                            <td><input type="text" class="t_barvar" id="t_barvar<?php echo $row_index; ?>" value="<?php echo $prod_row['tree_b'] * 1; ?>" /></td>
                            <td><input type="text" class="t_gheir_barvar" id="t_gheir_barvar<?php echo $row_index; ?>" value="<?php echo $prod_row['tree_gb'] * 1; ?>" /></td>
                            <td><input type="text" class="mah_tolp" id="mah_tolp<?php echo $row_index; ?>" value="<?php echo round($prod_row['mah_tolp'], 3); ?>" /></td>
                            <td><input type="text" class="mah_tol" id="mah_tol<?php echo $row_index; ?>" value="<?php echo round($prod_row['mah_tol'], 3); ?>" <?php if ($sabt_mah == 0) echo 'readonly'; ?> /></td>
                            <td><select class="mah_kh" id="mah_kh<?php echo $row_index; ?>" <?php if ($sabt_mah == 0) echo 'disabled'; ?>><option value="">انتخاب</option><option value="1" <?php if ($prod_row['mah_kh'] == '1') echo 'selected'; ?>>بلی</option><option value="2" <?php if ($prod_row['mah_kh'] == '2') echo 'selected'; ?>>خیر</option></select></td>
                            <td><select class="mah_bem" id="mah_bem<?php echo $row_index; ?>"><option value="">انتخاب</option><option value="1" <?php if ($prod_row['mah_bem'] == '1') echo 'selected'; ?>>بلی</option><option value="2" <?php if ($prod_row['mah_bem'] == '2') echo 'selected'; ?>>خیر</option></select></td>
                            <td class="w-16"><a href="#" style="display:none" id="btn_edit<?php echo $row_index; ?>" class="item_edit" data-index="<?php echo $row_index ?>" data-id="<?php echo $prod_row["id"] ?>"><img src="../../files/desk.png" title="ذخیره تغییرات" width="25" height="24" /></a></td>
                            <td class="w-16"><a href="#" class="item_del" data-id="<?php echo $prod_row["id"] ?>" data-z_sal="<?php echo $z_sal; ?>" data-check="<?php echo check_payesh($prod_row['id'],1,substr($z_sal, 0, 4)) ?>"><img src="../../files/del.png" title="حذف محصول" width="33" height="26" /></a></td>
                        </tr>
                    <?php $row_index++; } ?>
                </tbody>
            </table>
            <div class="flex justify-start mt-6"><button type="button" name="add" id="add1">+</button></div>
<?php if ($nah_kesh != '3'): ?>
<div class="flex justify-center items-center mt-4 mb-2">
    <div class="flex items-center bg-gray-100 rounded-lg px-4 py-2">
        <span class="ml-2 text-gray-700 font-bold">تراز مساحت باقیمانده :</span>
        <input type="text" class="w-28 text-center text-lg font-bold border-0 bg-gray-100" id="traz_display" readonly value="0" style="color:#059669;" />
        <span class="mr-2 text-gray-600">هکتار</span>
    </div>
</div>
<?php endif; ?>
            <div id="save_btn" class="flex justify-center mt-4"><button type="button" name="save" id="save1" class="btn-33">ثبت محصولات جدید</button></div>
        </div>
        <div class="flex justify-center mt-8">
            <form id="back_to_list_form" method="post" action="<?php echo htmlspecialchars($back_list_action, ENT_QUOTES, 'UTF-8'); ?>" class="hidden" aria-hidden="true">
<?php if ($from_page === 'manager') { ?>
                <input type="hidden" name="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m, ENT_QUOTES, 'UTF-8'); ?>" />
                <input type="hidden" name="z_sal" value="<?php echo htmlspecialchars($z_sal, ENT_QUOTES, 'UTF-8'); ?>" />
<?php } else { ?>
                <input type="hidden" name="back_p" value="1" />
                <input type="hidden" name="action_lise" value="1" />
<?php } ?>
            </form>
            <input type="button" id="btn_close_form" value="بستن پنجره" onclick="close_window()" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md" />
        </div>
    </div>

    <div id="customAlertModal" class="modal-overlay hidden"><div class="modal-content"><p id="customAlertMessage"></p><div class="modal-buttons"><button class="confirm-btn" onclick="hideCustomAlert()">تایید</button></div></div></div>
    <div id="customConfirmModal" class="modal-overlay hidden"><div class="modal-content"><p id="customConfirmMessage"></p><div class="modal-buttons"><button class="confirm-btn" id="customConfirmYes">بله</button><button class="cancel-btn" id="customConfirmNo">خیر</button></div></div></div>

    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/tailwindcss.js"></script>
<script>
    // Custom Alert/Confirm functions
    let confirmCallback = null;

    function showCustomConfirm(message, callback) {
        confirmCallback = callback;
        $('#customConfirmMessage').text(message);
        $('#customConfirmModal').removeClass('hidden');
    }

    function hideCustomConfirm() {
        $('#customConfirmModal').addClass('hidden');
        confirmCallback = null;
    }

    $('#customConfirmYes').on('click', function() {
        if (confirmCallback) {
            confirmCallback(true);
        }
        hideCustomConfirm();
    });

    $('#customConfirmNo').on('click', function() {
        if (confirmCallback) {
            confirmCallback(false);
        }
        hideCustomConfirm();
    });

    function close_window() {
        if (window.matchMedia && window.matchMedia('(max-width: 768px)').matches) {
            var backForm = document.getElementById('back_to_list_form');
            if (backForm) {
                backForm.submit();
                return;
            }
        }
        close();
    }

    function responseLooksLikeLogin(text) {
        if (!text || typeof text !== 'string') return false;
        var t = text.toLowerCase();
        return t.indexOf('login.php') !== -1 || t.indexOf('message=timeout') !== -1;
    }

    var sessionIdleTimer = null;
    var SESSION_IDLE_MS = 7200 * 1000;

    function notifySessionExpired() {
        if (window.sessionExpiredNotified) return;
        window.sessionExpiredNotified = true;
        if (sessionIdleTimer) clearTimeout(sessionIdleTimer);
        $('#save1, #add1, #btn_transfer_all_allowed').prop('disabled', true);
        showCustomAlert('نشست شما به پایان رسیده است. لطفاً صفحه را ببندید و دوباره وارد سامانه شوید.');
    }

    function resetSessionIdleTimer() {
        if (window.sessionExpiredNotified) return;
        if (sessionIdleTimer) clearTimeout(sessionIdleTimer);
        sessionIdleTimer = setTimeout(notifySessionExpired, SESSION_IDLE_MS);
    }

    function showCustomAlert(message) {
        if (window.sessionExpiredNotified && String(message).indexOf('نشست شما به پایان رسیده است') === -1) {
            return;
        }
        $('#customAlertMessage').text(message);
        $('#customAlertModal').removeClass('hidden');
    }

    // Variables from PHP
    const NAH_KESH = '<?php echo $nah_kesh; ?>';
    const SABT_MAH = <?php echo $sabt_mah; ?>;
    const NO_KESH = '<?php echo $no_kesh; ?>';

    $.ajaxSetup({
        dataFilter: function(data, type) {
            if (responseLooksLikeLogin(data)) {
                notifySessionExpired();
                if (type === 'json') {
                    return '{"ok":false,"session_expired":true,"has_old":false,"items":[]}';
                }
                return '';
            }
            resetSessionIdleTimer();
            return data;
        }
    });
    resetSessionIdleTimer();

    // تابع به‌روزرسانی تراز مساحت
function calculate_traz() {
    if (NAH_KESH === '3') {
        $('#traz_display').val('0.00');
        return;
    }
    const m_zamin = parseFloat($('#m_zamin').val()) || 0;
    let total_planted_area = 0;
	let errorField = null;
        $('#crud_table1 .s_barvar, #crud_table1 .s_gheir_barvar').each(function() {
        var val = parseFloat($(this).val());
        if (!isNaN(val) && val > 0) {
            total_planted_area += val;
        }
    });
    
    const traz_total = m_zamin - total_planted_area;
    
    // نمایش تراز مساحت
    $('#traz_display').val(traz_total.toFixed(4));
    
    // فقط تغییر رنگ و فعال/غیرفعال کردن دکمه ثبت و افزودن
    if (traz_total < 0) {
        $('#traz_display').css({ 'color': 'red', 'background-color': '#ffe0e0' });
        $('#save1').prop('disabled', true);
        $('#add1').prop('disabled', true);
        
        // پیدا کردن فیلدی که آخرین بار تغییر کرده
        if (document.activeElement && ($(document.activeElement).hasClass('s_barvar') || $(document.activeElement).hasClass('s_gheir_barvar'))) {
            errorField = document.activeElement;
            window.pendingResetField = errorField;
        }
        
        showCustomAlertWithReset('خطا: مجموع سطح کشت (' + total_planted_area.toFixed(4) + 
                       ' هکتار) از مساحت کل زمین (' + m_zamin + ' هکتار) بیشتر است!');
    } else {
        $('#traz_display').css({ 'color': 'green', 'background-color': '#e0ffe0' });
        $('#add1').prop('disabled', false);
        if (!anyExistingRowHasUnsavedChanges()) {
            $('#save1').prop('disabled', false);
        }
    }
}

// تابع جدید برای نمایش اخطار با قابلیت بازنشانی
function showCustomAlertWithReset(message) {
    $('#customAlertMessage').text(message);
    $('#customAlertModal').removeClass('hidden');
}

// اصلاح تابع hideCustomAlert موجود
function hideCustomAlert() {
    $('#customAlertModal').addClass('hidden');
    
    // اگر فیلد خطا وجود دارد، مقدار آن را به 0 تنظیم کن
    if (window.pendingResetField && $(window.pendingResetField).length) {
        $(window.pendingResetField).val(0);
        window.pendingResetField = null;
        // محاسبه مجدد تراز
        calculate_traz();
    }
}
    // تابع بررسی تغییرات در ردیف‌های موجود (مشابه فایل زراعی)
    function anyExistingRowHasUnsavedChanges() {
        return $('tr:not(.temp_row) .item_edit:visible').length > 0;
    }

    function toggleInputStates() {
        const currentUnsavedState = anyExistingRowHasUnsavedChanges();
        if (currentUnsavedState) {
            $('tr:not(.temp_row):not(.editing-row) input, tr:not(.temp_row):not(.editing-row) select').prop('disabled', true);
            $('#add1').prop('disabled', true).hide();
            $('#save1').prop('disabled', true);
        } else {
            $('tr:not(.temp_row) input, tr:not(.temp_row) select').prop('disabled', false);
            $('#add1').prop('disabled', false).show();
        }
    }

    function checkRowChanges(row, rowIndex) {
        var originalValues = row.data('originalValues');
        if (!originalValues) return;

        var currentValues = {
            cod_qroup: row.find('.cod_q').val() || '',
            cod_mah: row.find('.cod_m').val() || '',
            s_barvar: row.find('.s_barvar').val() || '',
            s_gheir_barvar: row.find('.s_gheir_barvar').val() || '',
            t_barvar: row.find('.t_barvar').val() || '',
            t_gheir_barvar: row.find('.t_gheir_barvar').val() || '',
            mah_tolp: row.find('.mah_tolp').val() || '',
            mah_tol: row.find('.mah_tol').val() || '',
            mah_bem: row.find('.mah_bem').val() || '',
            mah_kh: row.find('.mah_kh').val() || ''
        };

        var changesDetected = false;
        for (var key in originalValues) {
            if (originalValues.hasOwnProperty(key) && String(originalValues[key]) !== String(currentValues[key])) {
                changesDetected = true;
                break;
            }
        }

        var editButton = $('#btn_edit' + rowIndex);
        if (changesDetected) {
            editButton.show();
            row.addClass('editing-row');
        } else {
            editButton.hide();
            row.removeClass('editing-row');
        }
        toggleInputStates();
    }

    function setupChangeTracking() {
        $('tr:not(.temp_row)').each(function() {
            var row = $(this);
            var rowIndex = row.find('.item_edit').data('index');
            if (rowIndex) {
                var originalValues = {
                    cod_qroup: row.find('.cod_q').val() || '',
                    cod_mah: row.find('.cod_m').val() || '',
                    s_barvar: row.find('.s_barvar').val() || '',
                    s_gheir_barvar: row.find('.s_gheir_barvar').val() || '',
                    t_barvar: row.find('.t_barvar').val() || '',
                    t_gheir_barvar: row.find('.t_gheir_barvar').val() || '',
                    mah_tolp: row.find('.mah_tolp').val() || '',
                    mah_tol: row.find('.mah_tol').val() || '',
                    mah_bem: row.find('.mah_bem').val() || '',
                    mah_kh: row.find('.mah_kh').val() || ''
                };
                row.data('originalValues', originalValues);
            }
        });

        $(document).on('input change', 'tr:not(.temp_row) input, tr:not(.temp_row) select', function() {
            var row = $(this).closest('tr');
            var rowIndex = row.find('.item_edit').data('index');
            if (rowIndex) {
                if ($('tr.temp_row').length > 0 && !row.hasClass('editing-row')) {
                    $('tr.temp_row').remove();
                    calculate_traz();
                }
                checkRowChanges(row, rowIndex);
            }
        });
    }

function initializeEventListeners() {
    // تغییر گروه محصول - استفاده از ajax_garden.php
    $(document).on('change', '.cod_q', function() {
        var $select = $(this);
        var row = $select.closest('tr');
        var group_cod = $select.val();
        
        var selectId = $select.attr('id');
        var rowNum = selectId ? selectId.replace('cod_qroup', '') : '';
        
        if (rowNum) {
            $('#s_barvar' + rowNum).val('');
            $('#s_gheir_barvar' + rowNum).val('');
            $('#t_barvar' + rowNum).val('');
            $('#t_gheir_barvar' + rowNum).val('');
            $('#mah_tolp' + rowNum).val('');
            $('#mah_tol' + rowNum).val('');
        } else {
            row.find('.s_barvar, .s_gheir_barvar, .t_barvar, .t_gheir_barvar, .mah_tolp, .mah_tol').val('');
        }
        
        row.find('.cod_m').html('<option value="">بارگذاری...</option>');
        
        if (group_cod) {
            $.ajax({
                type: "POST", url: "ajax_garden.php", data: { group_cod: group_cod }, cache: false,
                success: function(html) {
                    if (window.sessionExpiredNotified) return;
                    row.find('.cod_m').html(html);
                },
                error: function() { showCustomAlert("مشکلی در اتصال به سرور به وجود آمد!"); row.find('.cod_m').html('<option value="">خطا در بارگذاری</option>'); }
            });
        } else {
            row.find('.cod_m').html('<option value="">انتخاب محصول</option>');
        }
        
        if (!row.hasClass('temp_row')) {
            var rowIndex = row.find('.item_edit').data('index');
            if (rowIndex) checkRowChanges(row, rowIndex);
        }
    });

    // تغییر نام محصول
    $(document).on('change', '.cod_m', function() {
        var $select = $(this);
        var row = $select.closest('tr');
        var selectId = $select.attr('id');
        var rowNum = selectId ? selectId.replace('cod_mah', '') : '';
        
        if (rowNum) {
            $('#s_barvar' + rowNum).val('');
            $('#s_gheir_barvar' + rowNum).val('');
            $('#t_barvar' + rowNum).val('');
            $('#t_gheir_barvar' + rowNum).val('');
            $('#mah_tolp' + rowNum).val('');
            $('#mah_tol' + rowNum).val('');
        } else {
            row.find('.s_barvar, .s_gheir_barvar, .t_barvar, .t_gheir_barvar, .mah_tolp, .mah_tol').val('');
        }
        
        if (!row.hasClass('temp_row')) {
            var rowIndex = row.find('.item_edit').data('index');
            if (rowIndex) checkRowChanges(row, rowIndex);
        }
    });

    // بررسی تعداد درخت بارور
    $(document).on('keyup change', '.t_barvar', function() {
        var $input = $(this);
        var row = $input.closest('tr');
        var s_barvar = parseFloat(row.find('.s_barvar').val()) || 0;
        var t_barvar = parseFloat($input.val()) || 0;
        if (NAH_KESH === '3') return;
        if (s_barvar <= 0 && t_barvar > 0) {
            showCustomAlert('امکان ثبت تعداد درخت بارور بدون ثبت سطح کشت بارور وجود ندارد.');
            $input.val(0);
            $input.focus();
        }
    });

    // بررسی تعداد درخت غیربارور
    $(document).on('keyup change', '.t_gheir_barvar', function() {
        var $input = $(this);
        var row = $input.closest('tr');
        var s_gheir_barvar = parseFloat(row.find('.s_gheir_barvar').val()) || 0;
        var t_gheir_barvar = parseFloat($input.val()) || 0;
        if (NAH_KESH === '3') return;
        if (s_gheir_barvar <= 0 && t_gheir_barvar > 0) {
            showCustomAlert('امکان ثبت تعداد درخت غیربارور بدون ثبت سطح کشت غیربارور وجود ندارد.');
            $input.val(0);
            $input.focus();
        }
    });

    // وقتی سطح کشت بارور تغییر کرد
    $(document).on('keyup change', '.s_barvar', function() {
        var row = $(this).closest('tr');
        if (NAH_KESH === '3') return;
        row.find('.t_barvar').val(0);
        row.find('.mah_tolp').val('');
        row.find('.mah_tol').val('');
        row.find('.mah_bem').val('');
    });

    // وقتی سطح کشت غیربارور تغییر کرد
    $(document).on('keyup change', '.s_gheir_barvar', function() {
        var row = $(this).closest('tr');
        if (NAH_KESH === '3') return;
        row.find('.t_gheir_barvar').val(0);
    });

    // تغییر در فیلدهای سطح کشت و تعداد درخت
    $(document).on('keyup change', '.s_barvar, .s_gheir_barvar, .t_barvar, .t_gheir_barvar', function() {
        calculate_traz();
        var row = $(this).closest('tr');
        if (!row.hasClass('temp_row')) {
            var rowIndex = row.find('.item_edit').data('index');
            if (rowIndex) checkRowChanges(row, rowIndex);
        }
    });

// میزان تولید پیش‌بینی
$(document).on('keyup change', '.mah_tolp', function() {
    var $input = $(this);
    var row = $input.closest('tr');
    var mcod = row.find('.cod_m').val();
    var s_barvar = parseFloat(row.find('.s_barvar').val()) || 0;
    var mtol = parseFloat($input.val()) || 0;
    
    row.find('.mah_bem').val('');
    
    // اگر نحوه کشت پراکنده است، فقط تغییرات را بررسی کن (بدون اعتبارسنجی تولید)
    if (NAH_KESH === '3') {
        if (!row.hasClass('temp_row')) {
            var rowIndex = row.find('.item_edit').data('index');
            if (rowIndex && $input.val()) checkRowChanges(row, rowIndex);
        }
        return;
    }
    
    if (s_barvar <= 0 && mtol > 0) {
        showCustomAlert('امکان ثبت تولید بدون ثبت سطح کشت بارور وجود ندارد.');
        $input.val(0);
        return;
    }
    
    if (mtol <= 0) {
        if (!row.hasClass('temp_row')) {
            var rowIndex = row.find('.item_edit').data('index');
            if (rowIndex && $input.val()) checkRowChanges(row, rowIndex);
        }
        return;
    }
    
    $.ajax({
        type: "POST", url: "aj.php", data: { op: "check_mah_tol_garden", mcod: mcod, skb: s_barvar, mtol: mtol, no_kesh: NO_KESH },
        success: function(data) {
            if (data != 'true') {
                showCustomAlert('میزان تولید پیش‌بینی وارد شده از حداکثر مجاز (' + data + ') بیشتر است.');
                $input.val('');
                $input.focus();
            } else {
                if (!row.hasClass('temp_row')) {
                    var rowIndex = row.find('.item_edit').data('index');
                    if (rowIndex && $input.val()) checkRowChanges(row, rowIndex);
                }
            }
        },
        error: function() { showCustomAlert('مشکلی در اتصال به سرور به وجود آمد!'); }
    });
});
// میزان تولید قطعی
$(document).on('keyup change', '.mah_tol', function() {
    var $input = $(this);
    var row = $input.closest('tr');
    var mcod = row.find('.cod_m').val();
    var s_barvar = parseFloat(row.find('.s_barvar').val()) || 0;
    var mtol = parseFloat($input.val()) || 0;
    
    row.find('.mah_bem').val('');
    
    // اگر نحوه کشت پراکنده است، فقط تغییرات را بررسی کن (بدون اعتبارسنجی تولید)
    if (NAH_KESH === '3') {
        if (!row.hasClass('temp_row')) {
            var rowIndex = row.find('.item_edit').data('index');
            if (rowIndex && $input.val()) checkRowChanges(row, rowIndex);
        }
        return;
    }
    
    if (s_barvar <= 0 && mtol > 0) {
        showCustomAlert('امکان ثبت تولید بدون ثبت سطح کشت بارور وجود ندارد.');
        $input.val(0);
        return;
    }
    
    if (mtol <= 0) {
        if (!row.hasClass('temp_row')) {
            var rowIndex = row.find('.item_edit').data('index');
            if (rowIndex && $input.val()) checkRowChanges(row, rowIndex);
        }
        return;
    }
    
    $.ajax({
        type: "POST", url: "aj.php", data: { op: "check_mah_tol_garden", mcod: mcod, skb: s_barvar, mtol: mtol, no_kesh: NO_KESH },
        success: function(data) {
            if (data != 'true') {
                showCustomAlert('میزان تولید قطعی وارد شده از حداکثر مجاز (' + data + ') بیشتر است.');
                $input.val('');
                $input.focus();
            } else {
                if (!row.hasClass('temp_row')) {
                    var rowIndex = row.find('.item_edit').data('index');
                    if (rowIndex && $input.val()) checkRowChanges(row, rowIndex);
                }
            }
        },
        error: function() { showCustomAlert('مشکلی در اتصال به سرور به وجود آمد!'); }
    });
});

    // بیمه و خسارت
    $(document).on('change', '.mah_bem, .mah_kh', function() {
        var row = $(this).closest('tr');
        if (!row.hasClass('temp_row')) {
            var rowIndex = row.find('.item_edit').data('index');
            if (rowIndex) checkRowChanges(row, rowIndex);
        }
    });

    // دکمه ویرایش
    $(document).on('click', '.item_edit', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var row = $btn.closest('tr');
        var rowId = $btn.data('id');
        var rowIndex = $btn.data('index');
        
        if (!rowId) { showCustomAlert('شناسه محصول نامعتبر است.'); return; }
        
        var updatedData = {
            id: rowId, cod_qroup: row.find('.cod_q').val() || '', cod_mah: row.find('.cod_m').val() || '',
            s_kesht_b: row.find('.s_barvar').val() || '0', s_kesht_gb: row.find('.s_gheir_barvar').val() || '0',
            tree_b: row.find('.t_barvar').val() || '0', tree_gb: row.find('.t_gheir_barvar').val() || '0',
            mah_tolp: row.find('.mah_tolp').val() || '0', mah_tol: row.find('.mah_tol').val() || '0',
            mah_bem: row.find('.mah_bem').val() || '2', mah_kh: row.find('.mah_kh').val() || '2'
        };
        
        if (!updatedData.cod_qroup || !updatedData.cod_mah) { showCustomAlert('گروه و نام محصول نمی‌تواند خالی باشد.'); return; }

        var productAlreadyOnGarden = false;
        $('#crud_table1 tbody tr:not(.temp_row)').each(function() {
            if ($(this).is(row)) return;
            if ($(this).find('.cod_m').val() === updatedData.cod_mah) {
                productAlreadyOnGarden = true;
                return false;
            }
        });
        if (productAlreadyOnGarden) {
            showCustomAlert('این محصول در این قطعه فقط یک‌بار قابل ثبت است.');
            return;
        }

        if (NAH_KESH === '3') {
            if ((parseFloat(updatedData.tree_b) || 0) === 0 && (parseFloat(updatedData.tree_gb) || 0) === 0) {
                showCustomAlert('در نحوه کشت درختان پراکنده ثبت محصول بدون تعداد درخت مجاز نیست.');
                return;
            }
        } else {
            if ((parseFloat(updatedData.tree_b) || 0) > 0 && (parseFloat(updatedData.s_kesht_b) || 0) <= 0) {
                showCustomAlert('امکان ثبت تعداد درخت بارور بدون ثبت سطح کشت بارور وجود ندارد.');
                return;
            }
            if ((parseFloat(updatedData.tree_gb) || 0) > 0 && (parseFloat(updatedData.s_kesht_gb) || 0) <= 0) {
                showCustomAlert('امکان ثبت تعداد درخت غیربارور بدون ثبت سطح کشت غیربارور وجود ندارد.');
                return;
            }
        }
        
        $btn.hide();
        var originalHtml = $btn.html();
        $btn.html('<img src="../../files/loading.gif" width="20" />');
        
        $.ajax({
            type: "POST", url: "edit_item.php", data: {
                id: rowId, f_cod_qroup: updatedData.cod_qroup, f_cod_mah: updatedData.cod_mah,
                f_s_kesht_b: updatedData.s_kesht_b, f_s_kesht_gb: updatedData.s_kesht_gb,
                f_tree_b: updatedData.tree_b, f_tree_gb: updatedData.tree_gb,
                f_mah_tolp: updatedData.mah_tolp, f_mah_tol: updatedData.mah_tol,
                f_mah_bem: updatedData.mah_bem, f_mah_kh: updatedData.mah_kh,
                Garden_id: <?php echo $id; ?>, mor_cod_m: '<?php echo $mor_cod_m; ?>',
                id_ostan: '<?php echo $id_ostan; ?>', id_city: '<?php echo $id_city; ?>', id_mar: '<?php echo $id_mar; ?>',
                no_kesh: '<?php echo $no_kesh; ?>', nah_kesh: '<?php echo $nah_kesh; ?>',
                num_bah: '<?php echo $num_bah; ?>', sh_gat: '<?php echo $sh_gat; ?>', z_sal: '<?php echo $z_sal; ?>',
                add_abadi: '<?php echo $add_abadi; ?>', add_city: '<?php echo $add_city; ?>', bah_cod_m: '<?php echo $bah_cod_m; ?>'
            },
            dataType: 'text',
            success: function(response) {
                if (response.indexOf('با موفقیت ویرایش شد') !== -1) refreshProductTable();
                else { $btn.show(); $btn.html(originalHtml); showCustomAlert(response); }
            },
            error: function() { showCustomAlert('خطا در ارتباط با سرور'); $btn.show(); $btn.html(originalHtml); }
        });
    });

    // دکمه حذف
    $(document).on('click', '.item_del', function(e) {
        e.preventDefault();
        if (anyExistingRowHasUnsavedChanges()) {
            showCustomAlert('لطفا ابتدا تغییرات ردیف فعال را ذخیره کنید.');
            return;
        }
        var $btn = $(this);
        var rowId = $btn.data('id');
        var z_sal = $btn.data('z_sal');
        var check = $btn.data('check');
        if (check == 2) { showCustomAlert('خطا! برای این محصول از طریق سامانه پایش، نهاده اختصاص داده شده و حذف مقدور نیست.'); return; }
        if (check == 0) { showCustomAlert('ارتباط با وب سرویس سامانه پایش برقرار نشد، بعداً بررسی کنید.'); return; }
        showCustomConfirm('آیا از حذف این محصول اطمینان دارید؟', function(confirmed) {
            if (!confirmed) return;
            $btn.hide();
            $.ajax({
                type: "POST", url: "item_del.php", data: { id: rowId, z_sal: z_sal }, dataType: 'text',
                success: function(response) {
                    if (response == 'success') { showCustomAlert('محصول با موفقیت حذف شد.'); refreshProductTable(); }
                    else { showCustomAlert('خطا: ' + response); $btn.show(); }
                },
                error: function() { showCustomAlert('خطا در ارتباط با سرور'); $btn.show(); }
            });
        });
    });
}

    function loadLastYearProducts() {
        $.ajax({
            url: 'last_year_products.php',
            method: 'POST',
            dataType: 'json',
            data: { op: 'list', garden_id: <?php echo (int)$id; ?> },
            success: function(data) {
                if (window.sessionExpiredNotified) return;
                if (!data || !data.has_old || !data.items || data.items.length === 0) {
                    $('#last_year_block').addClass('hidden');
                    return;
                }
                var allowedCount = 0;
                var $tb = $('#last_year_table tbody');
                $tb.empty();
                for (var j = 0; j < data.items.length; j++) {
                    var rowItem = data.items[j];
                    var canRow = parseInt(rowItem.can_transfer, 10) === 1;
                    if (canRow) allowedCount++;
                    var $tr = $('<tr></tr>');
                    $tr.append($('<td></td>').text(rowItem.group_name || ''));
                    $tr.append($('<td></td>').text(rowItem.product_name || ''));
                    <?php if ($nah_kesh != '3'): ?>
                    $tr.append($('<td></td>').text(rowItem.s_kesht_b));
                    $tr.append($('<td></td>').text(rowItem.s_kesht_gb));
                    <?php endif; ?>
                    $tr.append($('<td></td>').text(rowItem.tree_b));
                    $tr.append($('<td></td>').text(rowItem.tree_gb));
                    $tr.append($('<td></td>').addClass(canRow ? 'ly-ok' : 'ly-no').text(rowItem.status || ''));
                    var $act = $('<td></td>');
                    if (canRow) {
                        var $btn = $('<button type="button" class="btn-33 btn-transfer-one">انتقال</button>');
                        $btn.attr('data-id', rowItem.id);
                        $act.append($btn);
                    }
                    $tr.append($act);
                    $tb.append($tr);
                }
                $('#last_year_block').removeClass('hidden');
                if (allowedCount > 0) {
                    $('#last_year_actions').removeClass('hidden');
                } else {
                    $('#last_year_actions').addClass('hidden');
                }
            },
            error: function() {
                $('#last_year_block').addClass('hidden');
            }
        });
    }

    function transferLastYearProducts(ids) {
        if (!ids || ids.length === 0) {
            showCustomAlert('محصول قابل انتقالی انتخاب نشده است.');
            return;
        }
        if (anyExistingRowHasUnsavedChanges()) {
            showCustomAlert('لطفا ابتدا تغییرات ردیف فعال را ذخیره کنید.');
            return;
        }
        var postData = { op: 'transfer', garden_id: <?php echo (int)$id; ?> };
        for (var i = 0; i < ids.length; i++) {
            postData['prod_ids[' + i + ']'] = ids[i];
        }
        $('#btn_transfer_all_allowed, .btn-transfer-one').prop('disabled', true);
        $.ajax({
            url: 'last_year_products.php',
            method: 'POST',
            dataType: 'json',
            data: postData,
            success: function(data) {
                if (window.sessionExpiredNotified) return;
                showCustomAlert(data && data.message ? data.message : 'پاسخ نامعتبر از سرور');
                if (data && data.ok) {
                    refreshProductTable();
                } else {
                    loadLastYearProducts();
                    $('#btn_transfer_all_allowed, .btn-transfer-one').prop('disabled', false);
                }
            },
            error: function() {
                showCustomAlert('خطا در ارتباط با سرور');
                $('#btn_transfer_all_allowed, .btn-transfer-one').prop('disabled', false);
            }
        });
    }

    // تابع ریفرش جدول
    function refreshProductTable() {
        $.ajax({
            url: 'get_products_table.php',
            method: 'POST',
            data: {
                id: <?php echo $id; ?>,
                z_sal: '<?php echo $z_sal; ?>',
                sabt_mah: SABT_MAH
            },
            success: function(data) {
                if (window.sessionExpiredNotified) return;
                $('#crud_table1 tbody').html(data);
                calculate_traz();
                $('#add1').show();
                $('#save1').prop('disabled', false);
                setupChangeTracking();
                toggleInputStates();
                loadLastYearProducts();
            },
            error: function() {
                showCustomAlert('خطا در بارگذاری جدول محصولات');
            }
        });
    }

    // آماده شدن صفحه
    $(document).ready(function() {
        initializeEventListeners();
        setupChangeTracking();
        calculate_traz();
        toggleInputStates();
        loadLastYearProducts();
        if (window.matchMedia && window.matchMedia('(max-width: 768px)').matches) {
            $('#btn_close_form').val('بازگشت');
        }

        $(document).on('click', '.btn-transfer-one', function() {
            transferLastYearProducts([$(this).attr('data-id')]);
        });
        $('#btn_transfer_all_allowed').on('click', function() {
            var ids = [];
            $('#last_year_table .btn-transfer-one').each(function() {
                ids.push($(this).attr('data-id'));
            });
            transferLastYearProducts(ids);
        });

        let rowCounter = <?php echo $rownum; ?> + 1;

        // دکمه افزودن ردیف جدید
        $('#add1').click(function() {
            if (anyExistingRowHasUnsavedChanges()) {
                showCustomAlert('لطفا ابتدا تغییرات ردیف فعال را ذخیره کنید.');
                return;
            }

            var cultivation_cols = NAH_KESH === '3' ? '' : 
                `<td class="cultivation-area-col"><input type="text" class="s_barvar" id="s_barvar${rowCounter}" /></td>
                 <td class="cultivation-area-col"><input type="text" class="s_gheir_barvar" id="s_gheir_barvar${rowCounter}" /></td>`;


var production_cols = SABT_MAH === 1 ? 
    `<td><input type="text" class="mah_tol" id="mah_tol${rowCounter}" /></td>
     <td><select class="mah_kh" id="mah_kh${rowCounter}"><option value="">انتخاب</option><option value="1">بلی</option><option value="2">خیر</option></select></td>` : 
    `<td><input type="text" class="mah_tol" id="mah_tol${rowCounter}" value="0" readonly /></td>
     <td><select class="mah_kh" id="mah_kh${rowCounter}" disabled><option value="2" selected>خیر</option></select></td>`;




            var new_row = `<tr class="temp_row editing-row">
                <td><select class="cod_q" id="cod_qroup${rowCounter}">
                    <option value="">انتخاب گروه</option>
                    <?php foreach ($all_groups as $g_cod => $g_name) { echo "<option value='$g_cod'>$g_name</option>"; } ?>
                </select></td>
                <td><select class="cod_m" id="cod_mah${rowCounter}"><option value="">انتخاب محصول</option></select></td>
                ${cultivation_cols}
                <td><input type="text" class="t_barvar" id="t_barvar${rowCounter}" /></td>
                <td><input type="text" class="t_gheir_barvar" id="t_gheir_barvar${rowCounter}" /></td>
                <td><input type="text" class="mah_tolp" id="mah_tolp${rowCounter}" /></td>
                ${production_cols}
                <td><select class="mah_bem" id="mah_bem${rowCounter}"><option value="">انتخاب</option><option value="1">بلی</option><option value="2">خیر</option></select></td>
                <td></td>
                <td><button type="button" class="remove">-</button></td>
            </tr>`;
            
            $('#crud_table1 tbody').append(new_row);
            rowCounter++;
            calculate_traz();
        });

        // حذف ردیف
        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
            calculate_traz();
        });

        // دکمه ثبت
$('#save1').click(function() {
    if (anyExistingRowHasUnsavedChanges()) {
        showCustomAlert('لطفا ابتدا تغییرات ردیف فعال را ذخیره کنید.');
        return;
    }

    var newRows = [];
    var hasError = false;
    
    $('#crud_table1 tbody tr.temp_row').each(function(index) {
        var row = $(this);
        
        var cod_qroup = row.find('.cod_q').val() || '';
        var cod_mah = row.find('.cod_m').val() || '';
        var s_barvar = row.find('.s_barvar').val() || '0';
        var s_gheir_barvar = row.find('.s_gheir_barvar').val() || '0';
        var t_barvar = row.find('.t_barvar').val() || '0';
        var t_gheir_barvar = row.find('.t_gheir_barvar').val() || '0';
        var mah_tolp = row.find('.mah_tolp').val() || '0';
        var mah_tol = row.find('.mah_tol').val() || '0';
        var mah_bem = row.find('.mah_bem').val() || '';
        var mah_kh = row.find('.mah_kh').val() || '';
        
        if (!cod_qroup || !cod_mah) {
            showCustomAlert('لطفاً گروه و نام محصول را برای تمام ردیف‌ها انتخاب کنید.');
            hasError = true;
            return false;
        }

        var usedCodes = {};
        $('#crud_table1 tbody tr:not(.temp_row) .cod_m').each(function() {
            var v = $(this).val();
            if (v) usedCodes[v] = true;
        });
        for (var ri = 0; ri < newRows.length; ri++) {
            usedCodes[newRows[ri].cod_mah] = true;
        }
        if (usedCodes[cod_mah]) {
            showCustomAlert('این محصول در این قطعه فقط یک‌بار قابل ثبت است.');
            hasError = true;
            return false;
        }
        
        if (NAH_KESH === '3' && (parseFloat(s_barvar) > 0 || parseFloat(s_gheir_barvar) > 0)) {
            showCustomAlert('در نحوه کشت "درختان پراکنده" ثبت سطح کشت در ردیف ' + (index + 1) + ' مجاز نیست.');
            hasError = true;
            return false;
        }

        if (NAH_KESH === '3') {
            if ((parseFloat(t_barvar) || 0) === 0 && (parseFloat(t_gheir_barvar) || 0) === 0) {
                showCustomAlert('در نحوه کشت درختان پراکنده ثبت محصول بدون تعداد درخت در ردیف ' + (index + 1) + ' مجاز نیست.');
                hasError = true;
                return false;
            }
        } else {
            if ((parseFloat(t_barvar) || 0) > 0 && (parseFloat(s_barvar) || 0) <= 0) {
                showCustomAlert('امکان ثبت تعداد درخت بارور بدون ثبت سطح کشت بارور وجود ندارد.');
                hasError = true;
                return false;
            }
            if ((parseFloat(t_gheir_barvar) || 0) > 0 && (parseFloat(s_gheir_barvar) || 0) <= 0) {
                showCustomAlert('امکان ثبت تعداد درخت غیربارور بدون ثبت سطح کشت غیربارور وجود ندارد.');
                hasError = true;
                return false;
            }
            if ((parseFloat(s_barvar) || 0) === 0 && (parseFloat(s_gheir_barvar) || 0) === 0
                && (parseFloat(t_barvar) || 0) === 0 && (parseFloat(t_gheir_barvar) || 0) === 0) {
                showCustomAlert('ثبت محصول بدون سطح کشت و تعداد درخت در ردیف ' + (index + 1) + ' مجاز نیست.');
                hasError = true;
                return false;
            }
        }
        
        newRows.push({
            cod_qroup: cod_qroup,
            cod_mah: cod_mah,
            s_kesht_b: s_barvar,
            s_kesht_gb: s_gheir_barvar,
            tree_b: t_barvar,
            tree_gb: t_gheir_barvar,
            mah_tolp: mah_tolp,
            mah_tol: mah_tol,
            mah_bem: mah_bem,
            mah_kh: mah_kh
        });
    });
    
    if (hasError) return;
    
    if (newRows.length === 0) {
        showCustomAlert('هیچ ردیف جدیدی برای ثبت وجود ندارد.');
        return;
    }
    
    $('#save1').prop('disabled', true).text('در حال ثبت...');
    
    // ساخت داده‌های ارسالی به صورت جداگانه برای هر ردیف
    var postData = {
        Garden_id: <?php echo $id; ?>,
        mor_cod_m: '<?php echo $mor_cod_m; ?>',
        id_ostan: '<?php echo $id_ostan; ?>',
        id_city: '<?php echo $id_city; ?>',
        id_mar: '<?php echo $id_mar; ?>',
        num_bah: '<?php echo $num_bah; ?>',
        sh_gat: '<?php echo $sh_gat; ?>',
        no_kesh: '<?php echo $no_kesh; ?>',
        nah_kesh: '<?php echo $nah_kesh; ?>',
        z_sal: '<?php echo $z_sal; ?>',
        add_abadi: '<?php echo $add_abadi; ?>',
        add_city: '<?php echo $add_city; ?>',
        bah_cod_m: '<?php echo $bah_cod_m; ?>',
        m_zamin: '<?php echo $m_zamin; ?>'
    };
    
    // آرایه‌ها با ایندکس صریح تا همه ردیف‌ها به PHP برسند
    for (var i = 0; i < newRows.length; i++) {
        postData['f_cod_qroup[' + i + ']'] = newRows[i].cod_qroup;
        postData['f_cod_mah[' + i + ']'] = newRows[i].cod_mah;
        postData['f_s_kesht_b[' + i + ']'] = newRows[i].s_kesht_b;
        postData['f_s_kesht_gb[' + i + ']'] = newRows[i].s_kesht_gb;
        postData['f_tree_b[' + i + ']'] = newRows[i].tree_b;
        postData['f_tree_gb[' + i + ']'] = newRows[i].tree_gb;
        postData['f_mah_tolp[' + i + ']'] = newRows[i].mah_tolp;
        postData['f_mah_tol[' + i + ']'] = newRows[i].mah_tol;
        postData['f_mah_bem[' + i + ']'] = newRows[i].mah_bem;
        postData['f_mah_kh[' + i + ']'] = newRows[i].mah_kh;
    }

    $.ajax({
        type: "POST",
        url: "insert_item.php",
        data: postData,
        dataType: 'text',
        success: function(response) {
            console.log(response);
            showCustomAlert(response);
            if (response.indexOf('با موفقیت ثبت شدند') !== -1) {
                refreshProductTable();
            }
        },
        error: function(xhr, status, error) {
            console.log('Error:', xhr.responseText);
            showCustomAlert('خطا در ارتباط با سرور: ' + xhr.status);
        },
        complete: function() {
            $('#save1').prop('disabled', false).text('ثبت محصولات جدید');
        }
    });
});


    });
// نمایش پیام وضعیت بهره بردار فوتی / عدم تایید 
	<?php if ($show_bah_error): ?>
    setTimeout(function() {
        alert('<?php echo $bah_error_text; ?>');
        window.close();
    }, 100);
<?php endif; ?>
//
</script>
</body>
</html>