<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

$id = $_POST['id'];
$z_sal = $_POST['z_sal'];
$sabt_mah = $_POST['sabt_mah'];

$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal);

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

// واکشی محصولات
$query = "SELECT * FROM $Agri_prod_table WHERE Agri_id = :id ORDER BY id";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$id));
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// شروع تولید ردیف‌های جدول (بدون تگ های <table> و <thead>)
$row_index = 1;
foreach($products as $row):
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
    <tr class="delete_mem<?php echo $row["id"]?>">
        <td height="50" class="f_cod_qroup">
            <select name="mah_qroup<?php echo $row_index;?>"  class="cod_q mah_qroup<?php echo $row_index;?> required input_text country<?php echo $row_index;?>" id="cod_qroup" style="width:100px; height:40px ; font-size:12px" dir="rtl">
                <option value=""> انتخاب گروه</option>
                <?php
                // Modified: Use pre-fetched data instead of querying inside loop
                foreach ($all_groups as $g_cod => $g_name) {
                ?>
                    <option value="<?php echo $g_cod; ?>" <?php if ($g_cod == $group_cod) echo 'selected=selected' ?>> <?php echo $g_name; ?></option>
                <?php } ?>          </select>
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
            <div align="center">
                <input name="zer_kesht_a<?php echo $row_index;?>" type="text" class="zk_1 mashat zer_kesht_a<?php echo $row_index;?> required number input_text" id="zer_kesht_a<?php echo $row_index;?>" style="width:60px; height:30px;" dir="rtl" lang="fa" value="<?php echo $zer_kesht_a*1;?>" onpaste="return false" maxlength="11" align="baseline" xml:lang="fa" />
            </div>
        </td>
        <td class="f_zer_kesht_b">
            <div align="center">
                <input name="zer_kesht_b<?php echo $row_index;?>" type="text" class="zk_2 mashat_b zer_kesht_b<?php echo $row_index;?> required number input_text" id="zer_kesht_b<?php echo $row_index;?>" onpaste="return false" style="width:60px; height:30px;" dir="rtl" lang="fa" value="<?php echo $zer_kesht_b*1;?>" maxlength="11" align="baseline" xml:lang="fa" />
            </div>
        </td>
        <?php if($sabt_mah==1): ?>
        <td class="f_s_bar_a">
            <div align="center">
                <input name="s_bar_a<?php echo $row_index;?>" type="text" onpaste="return false" class="sb_1 s_bar_a<?php echo $row_index;?> required number input_text" id="s_bar_a<?php echo $row_index;?>" style="width:60px; height:30px;" dir="rtl" lang="fa" value="<?php echo $s_bar_a*1;?>" maxlength="11" align="baseline" xml:lang="fa" />
            </div>
        </td>
        <td class="f_s_bar_b">
            <div align="center">
                <input name="s_bar_b<?php echo $row_index;?>" type="text" onpaste="return false" class="sb_2 s_bar_b<?php echo $row_index;?> required number input_text" id="s_bar_b<?php echo $row_index;?>" style="width:60px; height:30px;" dir="rtl" lang="fa" value="<?php echo $s_bar_b*1;?>" maxlength="11" align="baseline" xml:lang="fa" />
            </div>
        </td>
        <?php endif; ?>
        <td class="f_mah_tolp">
            <div align="center">
                <input name="mah_tolp<?php echo $row_index;?>" type="text" onpaste="return false" class="m_tolp mah_tolp<?php echo $row_index;?> required number input_text" id="mah_tolp<?php echo $row_index;?>" style="width:60px; height:30px;" dir="rtl" lang="fa" value="<?php echo round($mah_tolp,3);?>" maxlength="10" align="baseline" xml:lang="fa" />
            </div>
        </td>
        <?php if($sabt_mah==1): ?>
        <td class="f_mah_tol">
            <div align="center">
                <input name="mah_tol<?php echo $row_index;?>" type="text" onpaste="return false" class="m_tol mah_tol<?php echo $row_index;?> required number input_text" id="mah_tol<?php echo $row_index;?>" style="width:60px; height:30px;" dir="rtl" lang="fa" value="<?php echo round($mah_tol,3);?>" maxlength="10" align="baseline" xml:lang="fa" />
            </div>
        </td>
        <td class="f_mah_kh">
            <div align="center">
                <select name="mah_kh<?php echo $row_index;?>" class="mah_kh required input_text required" id="mah_kh<?php echo $row_index;?>" style="height:40px; width:60px; direction:rtl">
                    <option value="">انتخاب</option>
                    <option value="1" <?php if ($mah_kh=='1') { echo 'selected="selected"'; } ?>>بلی</option>
                    <option value="2" <?php if ($mah_kh=='2') { echo 'selected="selected"'; } ?>>خیر</option>
                </select>
            </div>
        </td>
        <?php endif; ?>
        <td class="f_mah_bem">
            <div align="center">
                <select name="mah_bem<?php echo $row_index;?>" class="mah_bem required input_text required" id="mah_bem<?php echo $row_index;?>" style="height:40px; width:60px; direction:rtl">
                    <option value="">انتخاب</option>
                    <option value="1" <?php if ($mah_bem=='1') { echo 'selected="selected"'; } ?>>بلی</option>
                    <option value="2" <?php if ($mah_bem=='2') { echo 'selected="selected"'; } ?>>خیر</option>
                </select>
            </div>
        </td>
        <td width="53">
            <a href="#" style="display:none" id="btn_edit<?php echo $row_index;?>" class="item_edit" data-bs-toggle="tooltip" data-bs-placement="bottom" data-index="<?php echo $row_index?>" data-id="<?php echo $row["id"]?>">
                <img src="../../files/desk.png" title="ذخیره تغییرات" width="25" height="24" />
            </a>
        </td>
        <td width="52">
            <a href="#" class="item_del" data-bs-toggle="tooltip" data-bs-placement="bottom" data-id="<?php echo $row["id"]?>" data-z_sal="<?php echo $row["z_sal"]?>" data-check="<?php echo check_payesh($prod_id,0,substr($z_sal, 0, 4)) ?>">
                <img src="../../files/del.png" title="حذف محصول" width="33" height="26" />
            </a>
        </td>
    </tr>
<?php
$row_index ++;
endforeach;
?>