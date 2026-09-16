<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

$id = $_POST['id'];
$z_sal = $_POST['z_sal'];
$sabt_mah = $_POST['sabt_mah'];

// جداول باغی
$Garden_prod_table = 'Garden_prod';

// --- بخش اول: پیش‌خوانی گروه‌ها و محصولات از product_b ---
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
// --- پایان پیش‌خوانی ---

// واکشی محصولات باغی
$query = "SELECT id, cod_qroup, cod_mah,s_kesht_b,s_kesht_gb,tree_b,tree_gb, mah_tolp, mah_tol, mah_bem, mah_kh FROM $Garden_prod_table WHERE Garden_id = :id ORDER BY id";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id' => $id));
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// شروع تولید ردیف‌های جدول
$row_index = 1;
foreach($products as $row):
    $group_cod = $row['cod_qroup'];
    $cod_mah = $row['cod_mah'];
    $s_barvar = $row['s_kesht_b'];
    $s_gheir_barvar = $row['s_kesht_gb'];
    $t_barvar = $row['tree_b'];
    $t_gheir_barvar = $row['tree_gb'];
    $mah_tolp = $row['mah_tolp'];
    $mah_tol = $row['mah_tol'];
    $mah_bem = $row['mah_bem'];
    $mah_kh = $row['mah_kh'];
    $prod_id = $row['id'];
?>
    <tr class="delete_mem<?php echo $row["id"]?>">
        <td class="f_cod_qroup">
            <select class="cod_q" id="cod_qroup<?php echo $row_index; ?>" style="width:100%; height:38px; font-size:12px" dir="rtl">
                <option value="">انتخاب گروه</option>
                <?php foreach ($all_groups as $g_cod => $g_name): ?>
                    <option value="<?php echo $g_cod; ?>" <?php if ($g_cod == $group_cod) echo 'selected'; ?>> <?php echo $g_name; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td class="f_cod_mah">
            <select class="cod_m" id="cod_mah<?php echo $row_index; ?>" style="width:100%; height:38px; font-size:12px" dir="rtl">
                <option value="">انتخاب محصول</option>
                <?php if (isset($products_by_group_map[$group_cod])): ?>
                    <?php foreach ($products_by_group_map[$group_cod] as $p_cod => $p_name): ?>
                        <option value="<?php echo $p_cod; ?>" <?php if ($p_cod == $cod_mah) echo 'selected'; ?>> <?php echo $p_name; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </td>
        <td class="cultivation-area-col">
            <input type="text" class="s_barvar" id="s_barvar<?php echo $row_index; ?>" style="width:100%; height:38px;" dir="rtl" value="<?php echo $s_barvar * 1; ?>" />
        </td>
        <td class="cultivation-area-col">
            <input type="text" class="s_gheir_barvar" id="s_gheir_barvar<?php echo $row_index; ?>" style="width:100%; height:38px;" dir="rtl" value="<?php echo $s_gheir_barvar * 1; ?>" />
        </td>
        <td>
            <input type="text" class="t_barvar" id="t_barvar<?php echo $row_index; ?>" style="width:100%; height:38px;" dir="rtl" value="<?php echo $t_barvar * 1; ?>" />
        </td>
        <td>
            <input type="text" class="t_gheir_barvar" id="t_gheir_barvar<?php echo $row_index; ?>" style="width:100%; height:38px;" dir="rtl" value="<?php echo $t_gheir_barvar * 1; ?>" />
        </td>
        <td>
            <input type="text" class="mah_tolp" id="mah_tolp<?php echo $row_index; ?>" style="width:100%; height:38px;" dir="rtl" value="<?php echo round($mah_tolp, 3); ?>" />
        </td>
        <?php if($sabt_mah == 1): ?>
        <td>
            <input type="text" class="mah_tol" id="mah_tol<?php echo $row_index; ?>" style="width:100%; height:38px;" dir="rtl" value="<?php echo round($mah_tol, 3); ?>" />
        </td>
        <td>
            <select id="mah_kh<?php echo $row_index; ?>" style="width:100%; height:38px;" dir="rtl">
                <option value="">انتخاب</option>
                <option value="1" <?php if ($mah_kh == '1') echo 'selected'; ?>>بلی</option>
                <option value="2" <?php if ($mah_kh == '2') echo 'selected'; ?>>خیر</option>
            </select>
        </td>
        <?php else: ?>
        <td>
            <input type="text" class="mah_tol" id="mah_tol<?php echo $row_index; ?>" style="width:100%; height:38px;" dir="rtl" value="0" readonly />
        </td>
        <td>
            <select id="mah_kh<?php echo $row_index; ?>" disabled style="width:100%; height:38px;" dir="rtl">
                <option value="2" selected>خیر</option>
            </select>
        </td>
        <?php endif; ?>
        <td>
            <select id="mah_bem<?php echo $row_index; ?>" style="width:100%; height:38px;" dir="rtl">
                <option value="">انتخاب</option>
                <option value="1" <?php if ($mah_bem == '1') echo 'selected'; ?>>بلی</option>
                <option value="2" <?php if ($mah_bem == '2') echo 'selected'; ?>>خیر</option>
            </select>
        </td>
        <td class="w-16">
            <a href="#" style="display:none" id="btn_edit<?php echo $row_index; ?>" class="item_edit" data-index="<?php echo $row_index; ?>" data-id="<?php echo $prod_id; ?>">
                <img src="../../files/desk.png" title="ذخیره تغییرات" width="25" />
            </a>
        </td>
        <td class="w-16">
            <a href="#" class="item_del" data-id="<?php echo $prod_id; ?>" data-z_sal="<?php echo $z_sal; ?>" data-check="<?php echo check_payesh($prod_id, 1, substr($z_sal, 0, 4)); ?>">
                <img src="../../files/del.png" title="حذف محصول" width="33" />
            </a>
        </td>
    </tr>
<?php
$row_index++;
endforeach;
?>