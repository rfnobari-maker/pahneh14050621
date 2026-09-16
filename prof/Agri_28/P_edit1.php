<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

$bah_cod_m = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m']) : '';
$id    = isset($_POST['id']) ? intval($_POST['id']) : 0;
$z_sal = isset($_POST['z_sal']) ? preg_replace('/[^0-9\-]/', '', $_POST['z_sal']) : '';

$Agri_table      = 'Agri' . preg_replace('/[^0-9_]/', '', str_replace('-', '_', $z_sal));
$Agri_prod_table = 'Agri_prod' . preg_replace('/[^0-9_]/', '', str_replace('-', '_', $z_sal));

$jsal = jdate("Y");
$tsal = substr($z_sal, 5, 10);

if ($tsal > $jsal) {
    $sabt_mah = 0;
} else {
    $sabt_mah = 1;
}

$query = "SELECT id_ostan,id_city,num_bah, sh_gat, no_kesh, m_zamin, add_abadi, add_city, id_mar, s_ayesh, m_vaz_sok FROM `$Agri_table` WHERE id = :id LIMIT 1 ";
$stmt = $dbh->prepare($query);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$found = $stmt->rowCount();
if ($found) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $row = array(); // handle not found case
}

$num_bah = $row['num_bah'];
if ($num_bah == '') {
    $num_bah = '1';
}

$sh_gat = $row['sh_gat'];
$no_kesh = $row['no_kesh'];
$m_zamin = $row['m_zamin'];
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
$id_mar = $row['id_mar'];
$s_ayesh = $row['s_ayesh'];
$m_vaz_sok = $row['m_vaz_sok'];
$id_ostan = $row['id_ostan'];
$id_city = $row['id_city'];
$Agri_id = $row['Agri_id'];

$v_no_kesh = '';
if ($no_kesh == '1') {
    $v_no_kesh = 'آبی';
} elseif ($no_kesh == '2') {
    $v_no_kesh = 'دیم';
}

// --- Start: Pre-fetching product_z data to avoid N+1 queries ---
$all_groups = array();
$stmt_groups = $dbh->query("SELECT group_cod, group_name FROM product_z GROUP BY group_cod");
while ($g = $stmt_groups->fetch(PDO::FETCH_ASSOC)) {
    $all_groups[$g['group_cod']] = $g['group_name'];
}

$products_by_group_map = array();
$stmt_products = $dbh->query("SELECT product_cod, product_name, group_cod FROM product_z ORDER BY group_cod, product_cod");
while ($p = $stmt_products->fetch(PDO::FETCH_ASSOC)) {
    if (!isset($products_by_group_map[$p['group_cod']])) {
        $products_by_group_map[$p['group_cod']] = array();
    }
    $products_by_group_map[$p['group_cod']][$p['product_cod']] = $p['product_name'];
}
// --- End: Pre-fetching product_z data ---
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

        /* Image buttons (edit/delete) */
        .item_edit img, .item_del img {
            transition: transform 0.1s ease-in-out;
        }
        .item_edit:hover img, .item_del:hover img {
            transform: scale(1.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto; /* Allow horizontal scrolling for tables on small screens */
            }
            #crud_table1 {
                min-width: 800px; /* Ensure table doesn't shrink too much */
            }
        }
    </style>
</head>

<body class="p-4">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-xl p-6 md:p-8">
        <p class="text-2xl font-bold text-gray-800 mb-4 text-center">ویرایش محصولات زراعی
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
            <div class="flex items-center">
                <div class="ml-4 text-gray-600">نوع کشت :</div>
                <div class="input_text w-full md:w-auto text-right"><?php echo $v_no_kesh; ?></div>
            </div>

            <div class="flex items-center">
                <div class="ml-4 text-gray-600"> مساحت زمین :</div>
                <input name="m_zamin" type="text" class="m_zamin input_text number required w-24 text-right" id="m_zamin" tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin * 1; ?>" maxlength="15" readonly xml:lang="fa" />
                <span class="mr-4 text-gray-600">هکتار</span>
            </div>

            <div class="flex items-center">
                <div class="ml-4 text-gray-600">سطح آیش :</div>
                <input name="s_ayesh" type="text" class="s_ayesh mashat mashat_b input_text required number w-24 text-right" id="s_ayesh" tabindex="32" dir="rtl" lang="fa" value="<?php echo $s_ayesh * 1; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
                <span class="mr-4 text-gray-600">هکتار</span>
            </div>
        </div>

        <div class="flex items-center justify-end md:justify-start">
            <div class="ml-4 text-gray-600"> سال زراعی :</div>
            <div class="input_text w-full md:w-auto text-right"><?php echo $z_sal; ?></div>
        </div>
    </div>
</div>
    <div class="table-responsive mb-6">
            <?php
            $output = '';
            $query = "SELECT * FROM $Agri_prod_table  where Agri_id = $id ORDER BY id ";
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            $rownum = $stmt->rowCount();
            ?>
<table id="crud_table1" class="border-collapse w-full">
    <thead>
        <tr>
            <th colspan="2" class="border border-gray-300 px-2 py-1">اطلاعات محصول</th>
            <th colspan="2" class="border border-gray-300 px-2 py-1">سطح زیر کشت<br /><span class="style2 text-xs">هکتار</span></th>
            <?php if ($sabt_mah == 1) { ?>
                <th colspan="2" class="border border-gray-300 px-2 py-1">سطح برداشت<br /><span class="style2 text-xs">هکتار</span></th>
                <th colspan="2" class="border border-gray-300 px-2 py-1">میزان تولید<br /><span class="style2 text-xs">تن </span></th>
                <th width="82" rowspan="2" class="border border-gray-300 px-2 py-1">خسارت دیده</th>
            <?php } ?>
            <?php if ($sabt_mah == 0) { ?>
                <th colspan="1" class="border border-gray-300 px-2 py-1">میزان تولید<br /><span class="style2 text-xs">تن </span></th>
            <?php } ?>
            <th width="82" rowspan="2" class="border border-gray-300 px-2 py-1"> بیمه هست</th>
            <th colspan="2" rowspan="2" class="border border-gray-300 px-2 py-1">عملیات</th>
        </tr>
        <tr>
            <th width="130" class="border border-gray-300 px-2 py-1">گروه محصولات</th>
            <th width="127" class="border border-gray-300 px-2 py-1">نام محصول </th>
            <th width="95" class="border border-gray-300 px-2 py-1">اول</th>
            <th width="85" class="border border-gray-300 px-2 py-1">دوم</th>
            <?php if ($sabt_mah == 1) { ?>
                <th width="93" class="border border-gray-300 px-2 py-1">اول</th>
                <th width="83" class="border border-gray-300 px-2 py-1">دوم</th>
            <?php } ?>
            <th width="78" class="border border-gray-300 px-2 py-1">پیش بینی</th>
            <?php if ($sabt_mah == 1) { ?>
                <th width="78" class="border border-gray-300 px-2 py-1">قطعی</th>
            <?php } ?>
        </tr>
    </thead>
                <tbody>
                    <?php
                    $row_index = 1;
                    foreach ($stmt as $row) {
                        $group_cod = $row['cod_qroup'];
                        $cod_mah = $row['cod_mah'];
                        $zer_kesht_a = $row['zer_kesht_a'];
                        $zer_kesht_b = $row['zer_kesht_b'];
                        $s_bar_a = $row['s_bar_a'];
                        $s_bar_b = $row['s_bar_b'];
                        $mah_tol = $row['mah_tol'];
                        $mah_tolp = $row['mah_tolp'];
                        $mah_bem = $row['mah_bem'];
                        $mah_kh = $row['mah_kh'];
						$prod_id = $row['id'];
                    ?>
                        <tr class="delete_mem<?php echo $row["id"] ?>">
                            <td class="f_cod_qroup">
                                <select name="mah_qroup<?php echo $row_index; ?>" style=" font-size:12px" class="cod_q mah_qroup<?php echo $row_index; ?> required input_text country<?php echo $row_index; ?>" id="cod_qroup<?php echo $row_index; ?>" dir="rtl">
                                   <option value=""> انتخاب گروه</option>
                                    <?php
                                    // Modified: Use pre-fetched data instead of querying inside loop
                                    foreach ($all_groups as $g_cod => $g_name) {
                                    ?>
                                        <option value="<?php echo $g_cod; ?>" <?php if ($g_cod == $group_cod) echo 'selected=selected' ?>> <?php echo $g_name; ?></option>
                                    <?php } ?>                                </select>
                            </td>
<td class="f_cod_mah">
            <div align="center">
                <select name="mah_name<?php echo $row_index;?>" class="cod_m target<?php echo $row_index;?> required input_text mar<?php echo $row_index;?>" id="cod_mah<?php echo $row_index;?>" style="width:120px; height:40px ; font-size:12px" dir="rtl">
                    <option value="" selected="selected">انتخاب محصول</option>
                    <?php
                    // Modified: Use pre-fetched data instead of querying inside loop
                    if (isset($products_by_group_map[$group_cod])) {
                        foreach ($products_by_group_map[$group_cod] as $p_cod => $p_name) {
                    ?>
                            <option value="<?php echo $p_cod; ?>" <?php if ($p_cod == $cod_mah) echo 'selected=selected' ?>> <?php echo $p_name; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </td>
                               <td class="f_zer_kesht_a">
                                <input name="zer_kesht_a<?php echo $row_index; ?>" type="text" class="zk_1 mashat zer_kesht_a<?php echo $row_index; ?> required number input_text text-right" id="zer_kesht_a<?php echo $row_index; ?>" dir="rtl" lang="fa" value="<?php echo $zer_kesht_a * 1; ?>" onpaste="return false" maxlength="11" xml:lang="fa" />
                            </td>
                            <td class="f_zer_kesht_b">
                                <input name="zer_kesht_b<?php echo $row_index; ?>" type="text" class="zk_2 mashat_b zer_kesht_b<?php echo $row_index; ?> required number input_text text-right" id="zer_kesht_b<?php echo $row_index; ?>" onpaste="return false" dir="rtl" lang="fa" value="<?php echo $zer_kesht_b * 1; ?>" maxlength="11" xml:lang="fa" />
                            </td>
                            <?php if ($sabt_mah == 1) { ?>
                                <td class="f_s_bar_a">
                                    <input name="s_bar_a<?php echo $row_index; ?>" type="text" onpaste="return false" class="sb_1 s_bar_a<?php echo $row_index; ?> required number input_text text-right" id="s_bar_a<?php echo $row_index; ?>" dir="rtl" lang="fa" value="<?php echo $s_bar_a * 1; ?>" maxlength="11" xml:lang="fa" />
                                </td>
                                <td class="f_s_bar_b">
                                    <input name="s_bar_b<?php echo $row_index; ?>" type="text" onpaste="return false" class="sb_2 s_bar_b<?php echo $row_index; ?> required number input_text text-right" id="s_bar_b<?php echo $row_index; ?>" dir="rtl" lang="fa" value="<?php echo $s_bar_b * 1; ?>" maxlength="11" xml:lang="fa" />
                                </td>
                            <?php } ?>
                            <td class="f_mah_tolp">
                                <input name="mah_tolp<?php echo $row_index; ?>" type="text" onpaste="return false" class="m_tolp mah_tolp<?php echo $row_index; ?> required number input_text text-right" id="mah_tolp<?php echo $row_index; ?>" dir="rtl" lang="fa" value="<?php echo round($mah_tolp, 3); ?>" maxlength="10" xml:lang="fa" />
                            </td>
                            <?php if ($sabt_mah == 1) { ?>
                                <td class="f_mah_tol">
                                    <input name="mah_tol<?php echo $row_index; ?>" type="text" onpaste="return false" class="m_tol mah_tol<?php echo $row_index; ?> required number input_text text-right" id="mah_tol<?php echo $row_index; ?>" dir="rtl" lang="fa" value="<?php echo round($mah_tol, 3); ?>" maxlength="10" xml:lang="fa" />
                                </td>
                                <td class="f_mah_kh">
                                    <select name="mah_kh<?php echo $row_index; ?>" class="mah_kh required input_text required" id="mah_kh<?php echo $row_index; ?>" dir="rtl">
                                        <option value="">انتخاب</option>
                                        <option value="1" <?php if ($mah_kh == '1') {
                                                                echo 'selected="selected"';
                                                            } ?>>بلی</option>
                                        <option value="2" <?php if ($mah_kh == '2') {
                                                                echo 'selected="selected"';
                                                            } ?>>خیر</option>
                                    </select>
                            </td>
                            <?php } ?>
                            <td class="f_mah_bem">
                                <select name="mah_bem<?php echo $row_index; ?>" class="mah_bem required input_text required" id="mah_bem<?php echo $row_index; ?>" dir="rtl">
                                    <option value="">انتخاب</option>
                                    <option value="1" <?php if ($mah_bem == '1') {
                                                            echo 'selected="selected"';
                                                        } ?>>بلی</option>
                                    <option value="2" <?php if ($mah_bem == '2') {
                                                                echo 'selected="selected"';
                                                            } ?>>خیر</option>
                                </select>
                            </td>
                            <td class="w-16">
                                <a href="#" style="display:none" id="btn_edit<?php echo $row_index; ?>" class="item_edit" data-bs-toggle="tooltip" data-bs-placement="bottom" data-index="<?php echo $row_index ?>" data-id="<?php echo $row["id"] ?>">
                                    <img src="../../files/desk.png" title="ذخیره تغییرات" width="25" height="24" />
                                </a>
                            </td>
                            <td class="w-16">
                                <a href="#" class="item_del" data-bs-toggle="tooltip" data-bs-placement="bottom" data-id="<?php echo $row["id"] ?>" data-z_sal="<?php echo $row["z_sal"] ?>" data-check="<?php echo check_payesh($prod_id,0,substr($z_sal, 0, 4)) ?>">
                                    <img src="../../files/del.png" title="حذف محصول" width="33" height="26" />
                                </a>
                            </td>
                        </tr>
                    <?php
                        $row_index++;
                    }
                    ?>
                </tbody>
            </table>
<div style="display: none;">
    <label for="honeypot-field">لطفا این فیلد را خالی بگذارید:</label>
    <input type="text" name="honeypot-field" id="honeypot-field" autocomplete="off">
</div>
            
<div class="flex justify-start mt-6">
    <button type="button" name="add" id="add1" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition-colors duration-200 shadow-md">+</button>
</div>
            <div id="save_btn" class="flex justify-center mt-4"> <button type="button" name="save" id="save1" class="btn-33">ثبت محصول / محصولات جدید</button>
            </div>
        </div>

<div class="bg-gray-50 rounded-lg p-3 mt-4 border border-gray-200">
    <div class="flex flex-wrap items-center justify-center gap-x-16 gap-y-1 mb-2">
        <div class="flex items-center">
            <div class="ml-2 text-gray-600">تراز مساحت کشت اول :</div>
            <input name="traz1" type="text" disabled="disabled" style="height:40px ; width:100px ; text-align:center ; border-radius:5px; direction:ltr;" class="text1 w-24 " id="traz1" tabindex="29" dir="rtl" lang="fa" maxlength="11" xml:lang="fa" />
        <span class="mr-2 text-gray-600 text-xs">هکتار</span>
        </div>
        <div class="flex items-center">
            <div class="ml-2 text-gray-600">تراز مساحت کشت دوم :</div>
            <input name="traz2" type="text" disabled="disabled" style="height:40px ; width:100px ; text-align:center ; border-radius:5px ; direction:ltr;" class="text1 w-24 " id="traz2" tabindex="29" dir="rtl" lang="fa" maxlength="11" xml:lang="fa" />
        <span class="mr-2 text-gray-600 text-xs">هکتار</span>
        </div>
    </div>

    <div class="flex justify-center items-center px-4">
        <div class="text-gray-700 text-sm text-center">تراز مساحت = مساحت زمین - ( سطح آیش + مجموع سطح زیر کشت )</div>
    </div>
    <div class="flex justify-center items-center px-4">
        <div class="text-gray-700 text-sm text-red-500">توجه : تراز مساحت نباید منفی باشد</div>
    </div>
</div>

  <div class="flex justify-right mt-8"><a title="راهنمای صفحه" href="../../login/help/Agri_edit.pdf" target="_blank" class="LinkRedTitle" >✅ راهنمای استفاده </a> </div>
        <div class="flex justify-center mt-8">
            <input type="submit" name="action" style="width:200px" value="بستن پنجره" onclick="close_window()" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-200" />
        </div>
    </div>

    <div id="customAlertModal" class="modal-overlay hidden">
        <div class="modal-content">
            <p id="customAlertMessage" class="text-lg text-gray-800 mb-4"></p>
            <div class="modal-buttons">
                <button class="confirm-btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors duration-200" onclick="hideCustomAlert()">تایید</button>
            </div>
        </div>
    </div>

    <div id="customConfirmModal"   class="modal-overlay hidden">
        <div class="modal-content">
            <p id="customConfirmMessage" class="text-lg text-gray-800 mb-4"></p>
            <div class="modal-buttons">
                <button class="confirm-btn bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors duration-200" id="customConfirmYes">بله</button>
                <button class="cancel-btn bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded-md transition-colors duration-200" id="customConfirmNo">خیر</button>
            </div>
        </div>
    </div>

    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/tailwindcss.js"></script>
	<script>
        console.log('JavaScript loaded and running.');
        // Custom Alert/Confirm functions
        let confirmCallback = null;
        // Removed hasUnsavedChanges flag. We will derive its state directly from the UI.

        function showCustomAlert(message) {
            $('#customAlertMessage').text(message);
            $('#customAlertModal').removeClass('hidden');
        }

        function hideCustomAlert() {
            $('#customAlertModal').addClass('hidden');
        }

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
            close();
        }

        // Function to determine if any existing row has unsaved changes (visible edit button)
        function anyExistingRowHasUnsavedChanges() {
            return $('tr:not([id^="row"]) .item_edit:visible').length > 0;
        }

        // Function to enable/disable inputs and buttons based on any unsaved changes flag
        function toggleInputStates() {
            const currentUnsavedState = anyExistingRowHasUnsavedChanges();
            if (currentUnsavedState) {
                // Disable all inputs/selects in other existing rows and the add button
                $('tr:not([id^="row"]):not(.editing-row) input, tr:not([id^="row"]):not(.editing-row) select').prop('disabled', true);
                $('#add1').prop('disabled', true).hide(); // Hide the '+' button
                $('#save1').prop('disabled', true); // Disable save button for new rows if an existing one is being edited
            } else {
                // Enable all inputs/selects in existing rows and the add button
                $('tr:not([id^="row"]) input, tr:not([id^="row"]) select').prop('disabled', false);
                $('#add1').prop('disabled', false).show(); // Show the '+' button
                // The save button for new rows is controlled by updateAllBalancesAndButton()
            }
        }

        // تابع ریفرش جدول محصولات
        function refreshProductTable() {
            console.log('Refreshing product table...');
            $.ajax({
                url: 'get_products_table.php', // این فایل باید محتوای <tbody> جدول را برگرداند
                method: 'POST',
                data: {
                    id: <?php echo $id; ?>,
                    z_sal: <?php echo json_encode($z_sal); ?>,
                    sabt_mah: <?php echo json_encode($sabt_mah); ?>
                },
                success: function(data) {
                    console.log('Table refresh successful');
                    // جایگزینی محتوای جدول
                    $('#crud_table1 tbody').html(data);

                    // محاسبه مجدد ترازها و بررسی دکمه ثبت
                    updateAllBalancesAndButton();

                    // نمایش مجدد علامت + و پنهان کردن دکمه ثبت
                    $('#add1').show();
                    // $('#save_btn').hide(); // Removed: #save_btn should now always be visible if new rows exist

                    // بازگرداندن متن دکمه به حالت عادی
                    $('#save1').prop('disabled', false);
                    $('#save1').text('ثبت محصول / محصولات جدید');

                    // راه‌اندازی مجدد سیستم ردیابی تغییرات و event handlerها
                    setupChangeTracking(); // Re-initialize original values
                    toggleInputStates(); // Re-enable or disable inputs based on the current state of unsaved changes

                    console.log('Table refreshed, event listeners and change tracking re-initialized');
                },
                error: function(xhr, status, error) {
                    console.error('Table refresh error:', error);
                    showCustomAlert('خطا در بارگذاری جدول محصولات');
                }
            });
        }


        // تابع راه‌اندازی event listeners (با استفاده از Event Delegation)
        function initializeEventListeners() {
            console.log('Initializing delegated event listeners...');

            // Event listeners برای ردیف‌های موجود و جدید
            // ... (سایر event listener ها بدون تغییر باقی می‌مانند) ...
            // تغییر گروه محصول
            $(document).on('change', '.cod_q', function() {
                var $select = $(this);
                var row = $select.closest('tr');
                if (row.hasClass('new-row')) { // Only apply to new rows
                    var id = $select.val();
                    var dataString = 'group_cod=' + id;

                    // پاک کردن مقادیر محصول و تولید
                    row.find('input[class*="mah_tolp"]').val('');
                    row.find('input[class*="mah_tol"]').val('');

                    $.ajax({
                        type: "POST",
                        url: "ajax_non_vege.php",
                        data: dataString,
                        cache: false,
                        success: function(html) {
                            row.find('.cod_m').html(html);
                        },
                        error: function() {
                            showCustomAlert("مشکلی در اتصال به سرور به وجود آمد!");
                        }
                    });
                } else { // Existing row
                    var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                    var id = $select.val();
                    var dataString = 'group_cod=' + id;

                    // پاک کردن مقادیر محصول و تولید
                    row.find('input[class*="mah_tolp"]').val('');
                    row.find('input[class*="mah_tol"]').val('');

                    $.ajax({
                        type: "POST",
                        url: "ajax_non_vege.php",
                        data: dataString,
                        cache: false,
                        success: function(html) {
                            row.find('.cod_m').html(html);
                            checkRowChanges(row, rowIndex); // بررسی تغییرات پس از به‌روزرسانی نام محصول
                        },
                        error: function() {
                            showCustomAlert("مشکلی در اتصال به سرور به وجود آمد!");
                        }
                    });
                }
            });

            // تغییر نام محصول
            $(document).on('change', '.cod_m', function() {
                var $select = $(this);
                var row = $select.closest('tr');
                if (row.hasClass('new-row')) { // Only apply to new rows
                    var mcod = $select.val();
                    var zsal = '<?php echo $z_sal; ?>';
                    var id_ostan = '<?php echo $id_ostan; ?>';

                    // پاک کردن مقادیر تولید
                    row.find('input[class*="mah_tolp"]').val('');
                    row.find('input[class*="mah_tol"]').val('');

                    <?php if ($id_ostan == '45') : ?>
                        if (zsal == '1403-1404' && (mcod == '102' || mcod == '103' || mcod == '246')) {
                            showCustomAlert("بنابه درخواست معاونت تولیدات گیاهی استان، امکان ثبت محصول گندم و کلزا مقدور نمیباشد !");
                            $select.val(''); // بازگرداندن انتخاب به حالت اول
                        }
                    <?php endif; ?>
                } else { // Existing row
                    var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                    var mcod = $select.val();
                    var zsal = '<?php echo $z_sal; ?>';
                    var id_ostan = '<?php echo $id_ostan; ?>';

                    // پاک کردن مقادیر تولید
                    row.find('input[class*="mah_tolp"]').val('');
                    row.find('input[class*="mah_tol"]').val('');

                    <?php if ($id_ostan == '45') : ?>
                        if (zsal == '1403-1404' && (mcod == '102' || mcod == '103' || mcod == '246')) {
                            showCustomAlert("بنابه درخواست معاونت تولیدات گیاهی استان، امکان ثبت محصول گندم و کلزا مقدور نمیباشد !");
                            $select.val(''); // بازگرداندن انتخاب به حالت اول
                        }
                    <?php endif; ?>
                    checkRowChanges(row, rowIndex);
                }
            });

            // Keyup برای سطح زیر کشت اول
            $(document).on('keyup', '.zk_1', function() {
                var $input = $(this);
                var row = $input.closest('tr');
                if (row.hasClass('new-row')) { // Only apply to new rows
                    var zka = parseFloat($input.val()) || 0;
                    var zkb = parseFloat(row.find('.zk_2').val()) || 0;

                    row.find('input[class*="mah_tolp"]').val('');
                    row.find('input[class*="mah_tol"]').val('');
                    row.find('input[class*="s_bar_a"]').val('');
                    row.find('input[class*="s_bar_b"]').val('');

                    if (zkb > 0 && zka > 0) {
                        showCustomAlert("امکان ثبت همزمان کشت اول و دوم وجود ندارد ");
                        $input.val(0);
                        $input.focus();
                    }
                    updateAllBalancesAndButton();
                } else { // Existing row
                    var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                    var zka = parseFloat($input.val()) || 0;
                    var zkb = parseFloat(row.find('.zk_2').val()) || 0;

                    row.find('input[class*="mah_tolp"]').val('');
                    row.find('input[class*="mah_tol"]').val('');
                    row.find('input[class*="s_bar_a"]').val('');
                    row.find('input[class*="s_bar_b"]').val('');

                    if (zkb > 0 && zka > 0) {
                        showCustomAlert("امکان ثبت همزمان کشت اول و دوم وجود ندارد ");
                        $input.val(0);
                        $input.focus();
                    }
                    updateAllBalancesAndButton();
                    checkRowChanges(row, rowIndex);
                }
            });

            // Keyup برای سطح زیر کشت دوم
            $(document).on('keyup', '.zk_2', function() {
                var $input = $(this);
                var row = $input.closest('tr');
                if (row.hasClass('new-row')) { // Only apply to new rows
                    var zka = parseFloat(row.find('.zk_1').val()) || 0;
                    var zkb = parseFloat($input.val()) || 0;

                    row.find('input[class*="mah_tolp"]').val('');
                    row.find('input[class*="mah_tol"]').val('');
                    row.find('input[class*="s_bar_a"]').val('');
                    row.find('input[class*="s_bar_b"]').val('');

                    if (zkb > 0 && zka > 0) {
                        showCustomAlert("امکان ثبت همزمان کشت اول و دوم وجود ندارد ");
                        $input.val(0);
                        $input.focus();
                    }
                    updateAllBalancesAndButton();
                } else { // Existing row
                    var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                    var zka = parseFloat(row.find('.zk_1').val()) || 0;
                    var zkb = parseFloat($input.val()) || 0;

                    row.find('input[class*="mah_tolp"]').val('');
                    row.find('input[class*="mah_tol"]').val('');
                    row.find('input[class*="s_bar_a"]').val('');
                    row.find('input[class*="s_bar_b"]').val('');

                    if (zkb > 0 && zka > 0) {
                        showCustomAlert("امکان ثبت همزمان کشت اول و دوم وجود ندارد ");
                        $input.val(0);
                        $input.focus();
                    }
                    updateAllBalancesAndButton();
                    checkRowChanges(row, rowIndex);
                }
            });

            // Keyup برای سطح برداشت اول
            $(document).on('keyup', '.sb_1', function() {
                var $input = $(this);
                var row = $input.closest('tr');
                if (row.hasClass('new-row')) { // Only apply to new rows
                    var zka = parseFloat(row.find('.zk_1').val()) || 0;
                    var sba = parseFloat($input.val()) || 0;

                    row.find('input[class*="mah_tol"]').val('');

                    if (zka < sba) {
                        showCustomAlert("سطح برداشت اول از سطح زیر کشت اول بزرگتر است");
                        $input.val('');
                        $input.focus();
                    }
                } else { // Existing row
                    var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                    var zka = parseFloat(row.find('.zk_1').val()) || 0;
                    var sba = parseFloat($input.val()) || 0;

                    row.find('input[class*="mah_tol"]').val('');

                    if (zka < sba) {
                        showCustomAlert("سطح برداشت اول از سطح زیر کشت اول بزرگتر است");
                        $input.val('');
                        $input.focus();
                    }
                    checkRowChanges(row, rowIndex);
                }
            });

            // Keyup برای سطح برداشت دوم
            $(document).on('keyup', '.sb_2', function() {
                var $input = $(this);
                var row = $input.closest('tr');
                if (row.hasClass('new-row')) { // Only apply to new rows
                    var zkb = parseFloat(row.find('.zk_2').val()) || 0;
                    var sbb = parseFloat($input.val()) || 0;

                    row.find('input[class*="mah_tol"]').val('');

                    if (zkb < sbb) {
                        showCustomAlert("سطح برداشت دوم از سطح زیر کشت دوم بزرگتر است");
                        $input.val('');
                        $input.focus();
                    }
                } else { // Existing row
                    var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                    var zkb = parseFloat(row.find('.zk_2').val()) || 0;
                    var sbb = parseFloat($input.val()) || 0;

                    row.find('input[class*="mah_tol"]').val('');

                    if (zkb < sbb) {
                        showCustomAlert("سطح برداشت دوم از سطح زیر کشت دوم بزرگتر است");
                        $input.val('');
                        $input.focus();
                    }
                    checkRowChanges(row, rowIndex);
                }
            });

            // Keyup برای میزان تولید پیش‌بینی
// Keyup برای میزان تولید پیش‌بینی - فقط تغییر آیتم بیمه
$(document).on('keyup', '.m_tolp', function() {
    var $input = $(this);
    var row = $input.closest('tr');
    
    // تنها این خط برای تغییر مقدار بیمه به حالت پیش‌فرض (انتخاب نشده) اضافه شده است.
    row.find('.mah_bem').val('');
});

            $(document).on("blur", '.m_tolp', function() {
                var $input = $(this);
                var row = $input.closest('tr');
                var mcod = row.find('.cod_m').val();
                var zka = parseFloat(row.find('.zk_1').val()) || 0; // Cultivated area 1
                var zkb = parseFloat(row.find('.zk_2').val()) || 0; // Cultivated area 2
                var mtolp = parseFloat($input.val()); // Use mtolp for predicted
                var no_kesh_js = <?php echo json_encode($no_kesh); ?>;
                // New validation: If cultivated area > 0 and predicted production is 0 or blank
                if ((zka > 0 || zkb > 0) && ($input.val() !== '' && (isNaN(mtolp) || mtolp === 0))) {
                    showCustomAlert('با توجه به سطح زیر کشت ، میزان پیش بینی تولید باید بزرگتر از صفر باشد');
                    // Removed $input.val(''); and $input.focus();
                        $input.val('');
                        $input.focus();

                    if (!row.hasClass('new-row')) {
                        var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                        checkRowChanges(row, rowIndex);
                    }
                    return; // Stop further processing if this validation fails
                }

                $.ajax({
                    url: "aj.php",
                    type: "POST",
                    data: {
                        op: "check_mah_tol",
                        mcod: mcod,
                        sba: zka, // Corrected: Use cultivated area for predicted production check
                        sbb: zkb, // Corrected: Use cultivated area for predicted production check
                        mtol: mtolp,
                        no_kesh: no_kesh_js
                    },
                    success: function(data, status) {
                        if (data != 'true') {
                            showCustomAlert(' خطا  \n \n  میزان پیش بینی وارد شده از محدوده مجاز ، بیشتر هست / میزان سطح زیر کشت را بررسی کنید ');
                        $input.val('');
                        $input.focus();
                    if (!row.hasClass('new-row')) {
                        var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                        checkRowChanges(row, rowIndex);
                    }
                    return; // Stop further processing if this validation fails


                        }
                    },
                    error: function() {
                        showCustomAlert("مشکلی در اتصال به سرور به وجود آمد!")
                    }
                });
                if (!row.hasClass('new-row')) {
                    var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                    checkRowChanges(row, rowIndex);
                }
            });

            // Keyup برای میزان تولید قطعی
			$(document).on('keyup', '.m_tol', function() {
    var $input = $(this);
    var row = $input.closest('tr');
    
    // تنها این خط برای تغییر مقدار بیمه به حالت پیش‌فرض (انتخاب نشده) اضافه شده است.
    row.find('.mah_bem').val('');
});
			
            $(document).on("blur", '.m_tol', function() {
                var $input = $(this);
                var row = $input.closest('tr');
                var mcod = row.find('.cod_m').val();
                var sba = parseFloat(row.find('.sb_1').val()) || 0; // Harvest area
                var sbb = parseFloat(row.find('.sb_2').val()) || 0; // Harvest area
                var mtol = parseFloat($input.val()); // Use mtol for final production
                var no_kesh_js = <?php echo json_encode($no_kesh); ?>;

                // New validation: If harvest area > 0 and final production is 0 or blank
                if ((sba > 0 || sbb > 0) && ($input.val() !== '' && (isNaN(mtol) || mtol === 0))) {
                    showCustomAlert('با توجه به سطح برداشت ، میزان تولید قطعی باید بزرگتر از صفر باشد');
                    // Removed $input.val(''); and $input.focus();
                        $input.val('');
                        $input.focus();

                    if (!row.hasClass('new-row')) {
                        var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                        checkRowChanges(row, rowIndex);
                    }
                    return; // Stop further processing if this validation fails
                }

                $.ajax({
                    url: "aj.php",
                    type: "POST",
                    data: {
                        op: "check_mah_tol",
                        mcod: mcod,
                        sba: sba,
                        sbb: sbb,
                        mtol: mtol,
                        no_kesh: no_kesh_js
                    },
                    success: function(data, status) {
                        if (data != 'true') {
                            showCustomAlert(' خطا  \n \n  میزان تولید وارد شده از محدوده مجاز ، بیشتر هست / میزان سطح برداشت  را بررسی کنید ');
                        $input.val('');
                        $input.focus();
                   if (!row.hasClass('new-row')) {
                        var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                        checkRowChanges(row, rowIndex);
                    }
                    return; // Stop further processing if this validation fails

                        }
                    },
                    error: function() {
                        showCustomAlert("مشکلی در اتصال به سرور به وجود آمد!")
                    }
                });
                if (!row.hasClass('new-row')) {
                    var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                    checkRowChanges(row, rowIndex);
                }
            });

            // Change برای select های بیمه و خسارت
            $(document).on('change', '.mah_bem, .mah_kh', function() {
                var row = $(this).closest('tr');
                if (!row.hasClass('new-row')) {
                    var rowIndex = row.find('.item_edit').data('index') || row.attr('id').replace('row', '');
                    checkRowChanges(row, rowIndex);
                }
            });

            // Event listener برای دکمه ویرایش (موجود)
            $(document).on('click', '.item_edit', function(e) {
                e.preventDefault(); // Prevent default link behavior
                console.log('Edit button clicked');
                var id = $(this).data('id');
                var row = $(this).closest('tr');
                var rowIndex = row.find('.item_edit').data('index') ? row.find('.item_edit').data('index') - 1 : row.attr('id').replace('row', '') - 1;

                // Get original values from row data
                var originalValues = row.data('originalValues');

                var z_sal = <?php echo json_encode($z_sal); ?>;
                var f_cod_qroup = row.find('.cod_q').val();
                var f_cod_mah = row.find('.cod_m').val();
                var f_zer_kesht_a = row.find('.zk_1').val();
                var f_zer_kesht_b = row.find('.zk_2').val();
                <?php if ($sabt_mah == 1) { ?>
                    var f_s_bar_a = row.find('.sb_1').val();
                    var f_s_bar_b = row.find('.sb_2').val();
                    var f_mah_tol = row.find('.m_tol').val();
                    var f_mah_kh = row.find('.mah_kh').val();
                <?php } else { ?>
                    var f_s_bar_a = 0;
                    var f_s_bar_b = 0;
                    var f_mah_tol = 0;
                    var f_mah_kh = '-';
                <?php } ?>
                var bah_cod_m  = <?php echo json_encode($bah_cod_m); ?>;
                var sh_gat     = <?php echo json_encode($sh_gat); ?>;
                var add_abadi  = <?php echo json_encode($add_abadi); ?>;
                var add_city   = <?php echo json_encode($add_city); ?>;
                var Agri_id    = <?php echo json_encode($id); ?>;
                var no_kesh    = <?php echo json_encode($no_kesh); ?>;
                var f_mah_tolp = row.find('.m_tolp').val();
                var f_mah_bem  = row.find('.mah_bem').val();

                console.log('Sending edit request for ID:', id);

                $.ajax({
                    url: "edit_item.php",
                    method: "POST",
                    data: {
                        f_cod_qroup: f_cod_qroup,
                        f_cod_mah: f_cod_mah,
                        f_zer_kesht_a: f_zer_kesht_a,
                        f_zer_kesht_b: f_zer_kesht_b,
                        f_s_bar_a: f_s_bar_a,
                        f_s_bar_b: f_s_bar_b,
                        f_mah_tolp: f_mah_tolp,
                        f_mah_tol: f_mah_tol,
                        f_mah_bem: f_mah_bem,
                        f_mah_kh: f_mah_kh,
                        z_sal: z_sal,
                        no_kesh: no_kesh , 
					    bah_cod_m: bah_cod_m,
                        sh_gat: sh_gat,
                        add_abadi: add_abadi,
                        add_city: add_city,						
                        id: id,
                        Agri_id: Agri_id,
                        // Add original values for comparison
                        f_cod_qroup_old: originalValues.cod_qroup,
                        f_cod_mah_old: originalValues.cod_mah,
                        f_zer_kesht_a_old: originalValues.zer_kesht_a,
                        f_zer_kesht_b_old: originalValues.zer_kesht_b,
                        f_s_bar_a_old: originalValues.s_bar_a,
                        f_s_bar_b_old: originalValues.s_bar_b,
                        f_mah_tolp_old: originalValues.mah_tolp,
                        f_mah_tol_old: originalValues.mah_tol,
                        f_mah_bem_old: originalValues.mah_bem,
                        f_mah_kh_old: originalValues.mah_kh
                    },
                    success: function(data) {
                        console.log('Edit response:', data);
                        showCustomAlert(data);
                        refreshProductTable();
                    },
                    error: function(xhr, status, error) {
                        console.error('Edit error:', error);
                        showCustomAlert('خطا در ویرایش محصول');
                    }
                });
            });

            // Event listener برای دکمه حذف
            $(document).on('click', '.item_del', function(e) {
                e.preventDefault(); // Prevent default link behavior
                console.log('Delete button clicked');
                if (anyExistingRowHasUnsavedChanges()) { // Use the new function here
                    showCustomAlert('لطفا ابتدا تغییرات ردیف فعال را ذخیره کنید.');
                    return;
                }
                var id = $(this).data('id');
                var z_sal = $(this).data('z_sal');
                var check = $(this).data('check');

    			if (check != 2 && check != 0) {
                    showCustomConfirm("از حذف این محصول مطمئن هستید ؟", function(result) {
                        if (result) {
                            $.ajax({
                                type: "POST",
                                url: "item_del.php",
                                data: {
                                    id: id,
                                    z_sal: z_sal
                                },
                                cache: false,
                                success: function(html) {
                                    console.log('Delete response:', html);
                                    $(".delete_mem" + id).fadeOut('slow', function() {
                                        $(this).remove();
                                        refreshProductTable();
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.error('Delete error:', error);
                                    showCustomAlert('خطا در حذف محصول');
                                }
                            });
                        }
                    });
                } else {
					        // Display an alert message if deletion is not allowed
        let check_message;
        if (check === 2) {
            check_message = 'خطا! برای این محصول از طریق سامانه پایش نهاده اختصاص داده شده، حذف مقدور نیست.';
        } else if (check === 0) {
            check_message = 'ارتباط با وب سرویس سامانه پایش برقرار نشد، بعدا بررسی کنید.';
        }
        showCustomAlert(check_message);
                    showCustomAlert('خطا!  برای این محصول از طریق سامانه پایش نهاده اختصاص داده شده ، حذف مقدور نیست ')
                }
            });
            console.log('Delegated event listeners initialized');
        }

        // تابع راه‌اندازی سیستم ردیابی تغییرات
        function setupChangeTracking() {
            $('tr:not([id^="row"])').each(function() {
                var row = $(this);
                var rowIndex = row.find('.item_edit').data('index');
                if (rowIndex) {
                    var originalValues = {
                        cod_qroup: row.find('.cod_q').val() || '',
                        cod_mah: row.find('.cod_m').val() || '',
                        zer_kesht_a: row.find('.zk_1').val() || '',
                        zer_kesht_b: row.find('.zk_2').val() || '',
                        s_bar_a: row.find('.sb_1').val() || '',
                        s_bar_b: row.find('.sb_2').val() || '',
                        mah_tolp: row.find('.m_tolp').val() || '',
                        mah_tol: row.find('.m_tol').val() || '',
                        mah_bem: row.find('.mah_bem').val() || '',
                        mah_kh: row.find('.mah_kh').val() || ''
                    };
                    row.data('originalValues', originalValues);
                }
            });

            $(document).on('input change', 'tr:not([id^="row"]) input, tr:not([id^="row"]) select', function() {
                var row = $(this).closest('tr');
                var rowIndex = row.find('.item_edit').data('index');
                if (rowIndex) {
                    // Close any unsaved new rows automatically when an existing row is being edited
                    if ($('tr[id^="row"]').length > 0 && !row.hasClass('editing-row')) { // Check if new rows exist and current row is not already being edited
                        $('tr[id^="row"]').remove(); // Remove all new rows
                        // $('#save_btn').hide(); // Removed: #save_btn should now always be visible if new rows exist
                        updateAllBalancesAndButton(); // Recalculate balances after removing new rows
                        //showCustomAlert("ردیف‌های جدید ذخیره نشده، به طور خودکار بسته شدند."); // Inform the user
                    }
                    checkRowChanges(row, rowIndex);
                }
            });
        }

        // Function to check if a row is fully filled with valid data
// Function to check if a row is fully filled with valid data
function isRowFullyFilled(row) {
    var sabt_mah_js = <?php echo json_encode($sabt_mah); ?>;

    // Check product group and name selects
    if (row.find('.cod_q').val() === "" || row.find('.cod_m').val() === "") {
        return false;
    }

    // Check cultivated area (at least one of zk_1 or zk_2 must be > 0)
    var zk1 = parseFloat(row.find('.zk_1').val()) || 0;
    var zk2 = parseFloat(row.find('.zk_2').val()) || 0;
    if (zk1 <= 0 && zk2 <= 0) {
        return false;
    }
    // If both cultivated areas are filled, it's an invalid state (as per existing validation)
    if (zk1 > 0 && zk2 > 0) {
        return false;
    }

    // Check predicted production
    var mtolp = parseFloat(row.find('.m_tolp').val()) || 0;
    if (mtolp <= 0) { // Must be positive
        return false;
    }

    // Check mah_bem (insurance)
    if (row.find('.mah_bem').val() === "") {
        return false;
    }

    // Conditional checks based on $sabt_mah
    if (sabt_mah_js === 1) {
        var sb1 = parseFloat(row.find('.sb_1').val()) || 0;
        var sb2 = parseFloat(row.find('.sb_2').val()) || 0;
        var mtol = parseFloat(row.find('.m_tol').val()) || 0;

        // If both harvest areas are filled, it's an invalid state (this condition remains)
        if (sb1 > 0 && sb2 > 0) {
            return false;
        }

        // اگر سطح برداشت (sb1 یا sb2) وجود داشته باشد، آنگاه تولید نهایی (mtol) باید مثبت باشد.
        // اگر سطح برداشت صفر باشد (sb1 <=0 و sb2 <=0)، آنگاه mtol می‌تواند صفر یا منفی باشد و خطا نخواهد داد.
        if ((sb1 > 0 || sb2 > 0) && mtol <= 0) {
            return false;
        }

        // Check mah_kh (loss/damage) - remains unchanged
        if (row.find('.mah_kh').val() === "") {
            return false;
        }
    }

    return true; // All required fields are filled according to logic
}
        // تابع بررسی تغییرات در ردیف
        function checkRowChanges(row, rowIndex) {
            var originalValues = row.data('originalValues');
            if (!originalValues) return;

            var currentValues = {
                cod_qroup: row.find('.cod_q').val() || '',
                cod_mah: row.find('.cod_m').val() || '',
                zer_kesht_a: row.find('.zk_1').val() || '',
                zer_kesht_b: row.find('.zk_2').val() || '',
                s_bar_a: row.find('.sb_1').val() || '',
                s_bar_b: row.find('.sb_2').val() || '',
                mah_tolp: row.find('.m_tolp').val() || '',
                mah_tol: row.find('.m_tol').val() || '',
                mah_bem: row.find('.mah_bem').val() || '',
                mah_kh: row.find('.mah_kh').val() || ''
            };

            var changesDetectedInThisRow = false;
            for (var key in originalValues) {
                if (originalValues.hasOwnProperty(key)) { // Ensure it's own property
                    if (String(originalValues[key]) !== String(currentValues[key])) { // Compare as strings to handle 0 vs '0' consistently
                        changesDetectedInThisRow = true;
                        break;
                    }
                }
            }

            var traz1 = parseFloat($('#traz1').val()) || 0;
            var traz2 = parseFloat($('#traz2').val()) || 0;
            var balancesOk = (traz1 >= 0 && traz2 >= 0);

            var allRequiredFieldsFilled = isRowFullyFilled(row); // New check

            var editButton = $('#btn_edit' + rowIndex);
            if (changesDetectedInThisRow && balancesOk && allRequiredFieldsFilled) { // Add new condition
                editButton.show();
                row.addClass('editing-row');
            } else {
                editButton.hide();
                row.removeClass('editing-row');
            }
            toggleInputStates();
        }

        // تابع به‌روزرسانی مقادیر اولیه پس از ذخیره موفقیت‌آمیز
        function updateOriginalValues(rowIndex) {
            var row = $('tr').filter(function() {
                return ($(this).find('.item_edit').data('index') == rowIndex);
            });

            if (row.length > 0) {
                var currentValues = {
                    cod_qroup: row.find('.cod_q').val() || '',
                    cod_mah: row.find('.cod_m').val() || '',
                    zer_kesht_a: row.find('.zk_1').val() || '',
                    zer_kesht_b: row.find('.zk_2').val() || '',
                    s_bar_a: row.find('.sb_1').val() || '',
                    s_bar_b: row.find('.sb_2').val() || '',
                    mah_tolp: row.find('.m_tolp').val() || '',
                    mah_tol: row.find('.m_tol').val() || '',
                    mah_bem: row.find('.mah_bem').val() || '',
                    mah_kh: row.find('.mah_kh').val() || ''
                };
                row.data('originalValues', currentValues);
                $('#btn_edit' + rowIndex).hide();
                row.removeClass('editing-row');
                toggleInputStates(); // Re-enable other inputs after save
            }
        }

        // تابع بررسی تمام دکمه‌های ویرایش پس از تغییر ترازها
        function checkAllEditButtons() {
            $('tr:not([id^="row"])').each(function() {
                var row = $(this);
                var rowIndex = row.find('.item_edit').data('index');
                if (rowIndex) {
                    checkRowChanges(row, rowIndex);
                }
            });
        }

        // *** START: MODIFIED FUNCTION ***
        // تابع یکپارچه برای محاسبه ترازها و کنترل دکمه ثبت
        function updateAllBalancesAndButton() {
            var kol = parseFloat($("#m_zamin").val()) || 0;

            // محاسبه تراز کشت اول
            var sum1 = 0;
            $('.mashat').each(function() {
                sum1 += Number($(this).val());
            });
            var def1 = kol - sum1;
            $('#traz1').val(def1.toFixed(4));
            $('#traz1').css('backgroundColor', (def1 < 0 || isNaN(def1)) ? 'red' : 'green');

            // محاسبه تراز کشت دوم
            var sum2 = 0;
            $('.mashat_b').each(function() {
                sum2 += Number($(this).val());
            });
            var def2 = kol - sum2;
            $('#traz2').val(def2.toFixed(4));
            $('#traz2').css('backgroundColor', (def2 < 0 || isNaN(def2)) ? 'red' : 'green');

            // کنترل نمایش و فعالسازی دکمه ثبت محصولات جدید
            var newRowsExist = $('tr.new-row').length > 0;
            var balancesAreValid = (def1 >= 0 && def2 >= 0);
            var existingRowNotBeingEdited = !anyExistingRowHasUnsavedChanges();

            // شرط جدید: بررسی اینکه آیا در هیچ ردیف جدیدی هر دو سطح کشت صفر هستند یا خیر
            var cultivationAreaIsValid = true; // فرض اولیه بر معتبر بودن
            if (newRowsExist) {
                $('tr.new-row').each(function() {
                    var zk1 = parseFloat($(this).find('.zk_1').val()) || 0;
                    var zk2 = parseFloat($(this).find('.zk_2').val()) || 0;
                    if (zk1 === 0 && zk2 === 0) {
                        cultivationAreaIsValid = false; // اگر هر دو صفر باشند، نامعتبر است
                        return false; // خروج از حلقه
                    }
                });
            }


            if (newRowsExist) {
                $('#save_btn').show(); 
                // دکمه ثبت غیرفعال می‌شود اگر تراز منفی باشد، یا ردیف دیگری در حال ویرایش باشد، یا شرط جدید سطح کشت برقرار نباشد
                $('#save1').prop('disabled', !(balancesAreValid && existingRowNotBeingEdited && cultivationAreaIsValid));
            } else {
                $('#save_btn').hide(); 
            }

            // بررسی دکمه‌های ویرایش برای ردیف‌های موجود
            checkAllEditButtons();
        }
        // *** END: MODIFIED FUNCTION ***


        $(document).ready(function() {
            console.log('Document ready, setting up initial state and event listeners...');

            initializeEventListeners();
            setupChangeTracking();
            toggleInputStates(); // Initial state check

            var count = <?php echo $rownum; ?>; // Start count from existing rows

            // Removed the problematic redundant event listener here.

            $('#add1').click(function() {
                if (anyExistingRowHasUnsavedChanges()) { // Use the new function here
                    showCustomAlert('لطفا ابتدا تغییرات ردیف فعال را ذخیره کنید.');
                    return;
                }
                count += 1;
                var html_code = "<tr id='row" + count + "' class='new-row'>";
                html_code += "<td class='f_cod_qroup1'>";
                html_code += "<select name='mah_qroup_add" + count + "' class='cod_q cod_q_add required input_text' id='cod_qroup_add" + count + "' dir='rtl'>";
                html_code += "<option value=''>انتخاب گروه</option>";
                html_code += "<?php $query_group = 'SELECT group_cod,group_name FROM `product_z` group by group_cod '; $stmt_group = $dbh->prepare($query_group); $stmt_group->execute(); foreach ($stmt_group as $row_group) { echo "<option value=\'" . $row_group['group_cod'] . "\'>" . $row_group['group_name'] . "</option>"; } ?>";
                html_code += "</select></td>";
                html_code += "<td class='f_cod_mah1'>";
                html_code += "<select name='mah_name_add" + count + "' class='cod_m target_add required input_text' id='cod_mah_add" + count + "' dir='rtl'>";
                html_code += "<option value='' selected='selected'>انتخاب محصول</option>";
                html_code += "</select></td>";
                html_code += "<td class=f_zer_kesht_a1><input name='zer_kesht_a_add" + count + "' type='text' class='zk_1 mashat zer_kesht_a_add required number input_text text-right' dir='rtl' value='' onpaste='return false' maxlength='11' /></td>";
                html_code += "<td class=f_zer_kesht_b1><input name='zer_kesht_b_add" + count + "' type='text' class='zk_2 mashat_b zer_kesht_b_add required number input_text text-right' dir='rtl' value='' onpaste='return false' maxlength='11' /></td>";
                <?php if ($sabt_mah == 1) { ?>
                    html_code += "<td class=f_s_bar_a1><input name='s_bar_a_add" + count + "' type='text' class='sb_1 s_bar_a_add required number input_text text-right' dir='rtl' value='' onpaste='return false' maxlength='11' /></td>";
                    html_code += "<td class=f_s_bar_b1><input name='s_bar_b_add" + count + "' type='text' class='sb_2 s_bar_b_add required number input_text text-right' dir='rtl' value='' onpaste='return false' maxlength='11' /></td>";
                <?php } ?>
                html_code += "<td class=f_mah_tolp1><input name='mah_tolp_add" + count + "' type='text' class='m_tolp mah_tolp_add required number input_text text-right' dir='rtl' value='' onpaste='return false' maxlength='11' /></td>";
                <?php if ($sabt_mah == 1) { ?>
                    html_code += "<td class=f_mah_tol1><input name='mah_tol_add" + count + "' type='text' class='m_tol mah_tol_add required number input_text text-right' dir='rtl' value='' onpaste='return false' maxlength='11' /></td>";
                    html_code += "<td class=f_mah_kh1><select name='mah_kh_add" + count + "' class='mah_kh mah_kh_add required input_text' dir='rtl'><option value=''>انتخاب</option><option value='1'>بلی</option><option value='2'>خیر</option></select></td>";
                <?php } ?>
                html_code += "<td class=f_mah_bem1><select name='mah_bem_add" + count + "' class='mah_bem mah_bem_add required input_text' dir='rtl'><option value=''>انتخاب</option><option value='1'>بلی</option><option value='2'>خیر</option></select></td>";
                html_code += "<td colspan=2><button type='button' name='remove' data-row='row" + count + "' class='remove bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-200 shadow-md'>-</button></td>";
                html_code += "</tr>";
                $('#crud_table1 tbody').append(html_code);

                updateAllBalancesAndButton();
            });


            $(document).on('click', '.remove', function() {
                var delete_row = $(this).data("row");
                $('#' + delete_row).remove();
                updateAllBalancesAndButton();
            });

$('#save1').click(function() {
    var f_cod_qroup = [],
        f_cod_mah = [],
        f_zer_kesht_a = [],
        f_zer_kesht_b = [],
        f_s_bar_a = [],
        f_s_bar_b = [],
        f_mah_tol = [],
        f_mah_kh = [],
        f_mah_tolp = [],
        f_mah_bem = [];
    var Agri_id = <?php echo json_encode($id); ?>,
        mor_cod_m = <?php echo json_encode($login_session); ?>,
        id_ostan = <?php echo json_encode($id_ostan); ?>,
        id_city = <?php echo json_encode($id_city); ?>,
        id_mar = <?php echo json_encode($id_mar); ?>,
        num_bah = <?php echo json_encode($num_bah); ?>,
        sh_gat = <?php echo json_encode($sh_gat); ?>,
        z_sal = <?php echo json_encode($z_sal); ?>,
        add_abadi = <?php echo json_encode($add_abadi); ?>,
        add_city = <?php echo json_encode($add_city); ?>,
        no_kesh = <?php echo json_encode($no_kesh); ?>,
        bah_cod_m = <?php echo json_encode($bah_cod_m); ?>;

    $('#crud_table1 tbody tr.new-row').each(function() {
        var row = $(this);
        f_cod_qroup.push(row.find('.cod_q').val());
        f_cod_mah.push(row.find('.cod_m').val());
        f_zer_kesht_a.push(row.find('.zk_1').val());
        f_zer_kesht_b.push(row.find('.zk_2').val());
        f_s_bar_a.push(row.find('.sb_1').val() || 0);
        f_s_bar_b.push(row.find('.sb_2').val() || 0);
        f_mah_tolp.push(row.find('.m_tolp').val());
        <?php if ($sabt_mah == 1) { ?>
            f_mah_tol.push(row.find('.m_tol').val());
            f_mah_kh.push(row.find('.mah_kh').val());
        <?php } else { ?>
            f_mah_tol.push(0);
            f_mah_kh.push('-');
        <?php } ?>
        f_mah_bem.push(row.find('.mah_bem').val());
    });

    var saveButton = $('#save1');
    saveButton.prop('disabled', true).text('لطفا تامل فرمایید');

    $.ajax({
        url: "insert_item.php",
        method: "POST",
        data: {
            f_cod_qroup: f_cod_qroup,
            f_cod_mah: f_cod_mah,
            f_zer_kesht_a: f_zer_kesht_a,
            f_zer_kesht_b: f_zer_kesht_b,
            f_s_bar_a: f_s_bar_a,
            f_s_bar_b: f_s_bar_b,
            f_mah_tolp: f_mah_tolp,
            f_mah_tol: f_mah_tol,
            f_mah_bem: f_mah_bem,
            f_mah_kh: f_mah_kh,
            id_mar: id_mar,
            Agri_id: Agri_id,
            mor_cod_m: mor_cod_m,
            no_kesh: no_kesh,
            id_ostan: id_ostan,
            id_city: id_city,
            num_bah: num_bah,
            sh_gat: sh_gat,
            z_sal: z_sal,
            add_abadi: add_abadi,
            add_city: add_city,
            bah_cod_m: bah_cod_m,
            'honeypot-field': $('#honeypot-field').val()
        },
        success: function(data) {
            showCustomAlert(data);
            refreshProductTable();
        },
        error: function(xhr, status, error) {
            console.error('Save error:', error);
            showCustomAlert('خطا در ثبت محصولات');
            saveButton.prop('disabled', false).text('ثبت محصول / محصولات جدید');
        }
    });
});
            // محاسبه اولیه در زمان بارگذاری صفحه
            updateAllBalancesAndButton();
        });
    </script>
    </body>

</html>