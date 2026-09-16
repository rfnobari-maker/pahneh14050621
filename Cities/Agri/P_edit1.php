<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../login/config.php');  
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : '';

$Agri_table      = 'Agri'.str_replace('-','_',$z_sal);
$Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal);
$jsal = jdate("Y");
$tsal = substr($z_sal,5,10);
$sabt_mah = ($tsal > $jsal) ? 0 : 1;

$query = "SELECT * from `$Agri_table` where id = :id limit 1 ";
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) die('اطلاعات یافت نشد');
$num_bah = ($row['num_bah'] == '') ? '1' : $row['num_bah'];
$sh_gat = $row['sh_gat'];
$no_kesh = $row['no_kesh'];
$m_zamin = $row['m_zamin'];
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
$id_mar = $row['id_mar'];
$s_ayesh = $row['s_ayesh'];
$m_vaz_sok = $row['m_vaz_sok'];

$v_no_kesh = ($no_kesh=='1') ? 'آبی' : (($no_kesh=='2') ? 'دیم' : '');

// واکشی گروه محصولات و محصولات (یک بار)
$groups = array();
$products_by_group = array();
$stmt = $dbh->prepare("SELECT DISTINCT group_cod, group_name FROM product_z");
$stmt->execute();
foreach($stmt as $g) {
    $groups[] = $g;
    $products_by_group[$g['group_cod']] = array();
}
$stmt = $dbh->prepare("SELECT product_cod, product_name, group_cod FROM product_z ORDER BY product_cod");
$stmt->execute();
foreach($stmt as $p) {
    $products_by_group[$p['group_cod']][] = $p;
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title><?php echo $title; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <script src="jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .input_text { font-family: Tahoma; }
        .error-msg { color: red; font-size: 13px; display: none; }
        .success-msg { color: green; font-size: 13px; display: none; }
    </style>
</head>
<body>
    <form id="editForm">
    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr><td>
            <p class="style8">ویرایش محصولات زراعی <br />
                <span class="style19">آزمایشی</span><br />
                <?php sar_data2($bah_cod_m,$num_bah); ?>
            </p>
            <table width="95%" bgcolor="#FFFFFF" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069; border-radius:10px">
                <tr><td colspan="5" bgcolor="#CCCCCC" align="right"><div style="margin-right:10px"><strong>موقعیت بهره برداری</strong></div></td></tr>
                <tr>
                    <td width="35%"><div class="input_text" align="right"><?php echo city_name1($id_city,$id_ostan); ?></div></td>
                    <td width="14%"><div align="right">:شهرستان</div></td>
                    <td width="7%">&nbsp;</td>
                    <td width="25%"><div class="input_text" align="right"><?php echo ostan_name($id_ostan); ?></div></td>
                    <td width="19%"><div style="margin-right:30px" align="right">: استان</div></td>
                </tr>
                <tr>
                    <td><div class="input_text" align="right"><?php echo abadi_name($add_abadi); ?></div></td>
                    <td><div align="right">: آبادی / شهر</div></td>
                    <td>&nbsp;</td>
                    <td><div class="input_text" align="right"><?php echo mar_name($id_mar); ?></div></td>
                    <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
                </tr>
                <tr><td colspan="5" bgcolor="#CCCCCC"><div style="margin-right:10px" align="right"><strong>اطلاعات زمین</strong></div></td></tr>
                <tr>
                    <td><div align="right"><span class="style2">هکتار</span>
                        <input name="m_zamin" type="text" class="m_zamin input_text number required" id="m_zamin" style="width:50px; height:30px;" tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin*1; ?>" maxlength="15" readonly align="baseline" xml:lang="fa" />
                    </div></td>
                    <td><div align="right">:مساحت زمین</div></td>
                    <td>&nbsp;</td>
                    <td><div class="input_text" align="right"><?php echo $v_no_kesh; ?></div></td>
                    <td><div style="margin-right:30px" align="right">:نوع کشت</div></td>
                </tr>
                <tr><td colspan="5" bgcolor="#CCCCCC"><div style="margin-right:10px" align="right"><strong>اطلاعات کاشت</strong></div></td></tr>
                <tr>
                    <td><div align="right"><span class="style2">هکتار</span>
                        <input name="s_ayesh" type="text" class="s_ayesh mashat mashat_b input_text required number" id="s_ayesh" style="width:50px; height:30px;" tabindex="32" dir="rtl" lang="fa" value="<?php echo $s_ayesh*1; ?>" maxlength="10" readonly align="baseline" xml:lang="fa" />
                    </div></td>
                    <td><div align="right">:سطح آیش</div></td>
                    <td>&nbsp;</td>
                    <td><div class="input_text" align="right"><?php echo $z_sal; ?></div></td>
                    <td><div style="margin-right:30px" align="right">: سال زراعی</div></td>
                </tr>
                <tr><td colspan="5">
                    <div class="table-responsive">
                        <?php
                        $query = "SELECT * FROM $Agri_prod_table WHERE Agri_id = :id ORDER BY id";
                        $stmt = $dbh->prepare($query);
                        $stmt->execute(array(':id'=>$id));
                        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <table id="crud_table1" class="table table-bordered table-striped" style="margin-top:20px; font-size:12px; border-color:#CCC" align="center" width="98%" border="1" cellpadding="0" cellspacing="0" dir="rtl">
                            <thead>
                                <tr class="style8">
                                    <th colspan="2" bgcolor="#FFFFCC" style="text-align:center">اطلاعات محصول</th>
                                    <th colspan="2" bgcolor="#FFFFCC" style="text-align:center">سطح زیر کشت<br /><span class="style2">هکتار</span></th>
                                    <?php if($sabt_mah==1): ?>
                                    <th colspan="2" bgcolor="#FFFFCC" style="text-align:center">سطح برداشت<br /><span class="style2">هکتار</span></th>
                                    <th colspan="2" bgcolor="#FFFFCC" style="text-align:center">میزان تولید<br /><span class="style2">تن</span></th>
                                    <th rowspan="2" bgcolor="#FFFFCC" style="text-align:center">خسارت دیده</th>
                                    <?php else: ?>
                                    <th colspan="1" bgcolor="#FFFFCC" style="text-align:center">میزان تولید<br /><span class="style2">تن</span></th>
                                    <?php endif; ?>
                                    <th rowspan="2" bgcolor="#FFFFCC" style="text-align:center">بیمه هست</th>
                                    <th colspan="2" rowspan="2" bgcolor="#FFFFCC">عملیات</th>
                                </tr>
                                <tr class="style8">
                                    <th bgcolor="#FFFFCC" style="text-align:center">گروه محصولات</th>
                                    <th bgcolor="#FFFFCC" style="text-align:center">نام محصول</th>
                                    <th bgcolor="#FFFFCC" style="text-align:center">اول</th>
                                    <th bgcolor="#FFFFCC" style="text-align:center">دوم</th>
                                    <?php if($sabt_mah==1): ?>
                                    <th bgcolor="#FFFFCC" style="text-align:center">اول</th>
                                    <th bgcolor="#FFFFCC" style="text-align:center">دوم</th>
                                    <?php endif; ?>
                                    <th bgcolor="#FFFFCC" style="text-align:center">پیش بینی</th>
                                    <?php if($sabt_mah==1): ?>
                                    <th bgcolor="#FFFFCC" style="text-align:center">قطعی</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody id="productRows">
                                <?php $row_index = 1; foreach($products as $row): ?>
                                <tr data-row-index="<?php echo $row_index; ?>" class="delete_mem<?php echo $row['id']; ?>">
                                    <td>
                                        <select name="mah_qroup<?php echo $row_index; ?>" class="cod_q mah_qroup input_text country" data-row="<?php echo $row_index; ?>" style="width:100px; height:40px" dir="rtl">
                                            <option value="">انتخاب گروه</option>
                                            <?php foreach($groups as $g): ?>
                                            <option value="<?php echo $g['group_cod']; ?>" <?php if($g['group_cod']==$row['cod_qroup']) echo 'selected'; ?>><?php echo $g['group_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="mah_name<?php echo $row_index; ?>" class="cod_m target input_text mar" data-row="<?php echo $row_index; ?>" style="width:120px; height:40px" dir="rtl">
                                            <option value="">انتخاب نام محصول</option>
                                            <?php
                                            $group_code = $row['cod_qroup'];
                                            if (isset($products_by_group[$group_code])) {
                                                foreach($products_by_group[$group_code] as $p) {
                                            ?>
                                            <option value="<?php echo $p['product_cod']; ?>" <?php if($p['product_cod']==$row['cod_mah']) echo 'selected'; ?>><?php echo $p['product_name']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input name="zer_kesht_a<?php echo $row_index; ?>" type="text" class="zk_1 mashat input_text" style="width:60px; height:30px" dir="rtl" value="<?php echo $row['zer_kesht_a']*1; ?>" maxlength="11" /></td>
                                    <td><input name="zer_kesht_b<?php echo $row_index; ?>" type="text" class="zk_2 mashat_b input_text" style="width:60px; height:30px" dir="rtl" value="<?php echo $row['zer_kesht_b']*1; ?>" maxlength="11" /></td>
                                    <?php if($sabt_mah==1): ?>
                                    <td><input name="s_bar_a<?php echo $row_index; ?>" type="text" class="sb_1 input_text" style="width:60px; height:30px" dir="rtl" value="<?php echo $row['s_bar_a']*1; ?>" maxlength="11" /></td>
                                    <td><input name="s_bar_b<?php echo $row_index; ?>" type="text" class="sb_2 input_text" style="width:60px; height:30px" dir="rtl" value="<?php echo $row['s_bar_b']*1; ?>" maxlength="11" /></td>
                                    <?php endif; ?>
                                    <td><input name="mah_tolp<?php echo $row_index; ?>" type="text" class="m_tolp input_text" style="width:60px; height:30px" dir="rtl" value="<?php echo round($row['mah_tolp'],3); ?>" maxlength="10" /></td>
                                    <?php if($sabt_mah==1): ?>
                                    <td><input name="mah_tol<?php echo $row_index; ?>" type="text" class="m_tol input_text" style="width:60px; height:30px" dir="rtl" value="<?php echo round($row['mah_tol'],3); ?>" maxlength="10" /></td>
                                    <td>
                                        <select name="mah_kh<?php echo $row_index; ?>" class="mah_kh input_text" style="height:40px; width:60px; direction:rtl">
                                            <option value="">انتخاب</option>
                                            <option value="1" <?php if($row['mah_kh']=='1') echo 'selected'; ?>>بلی</option>
                                            <option value="2" <?php if($row['mah_kh']=='2') echo 'selected'; ?>>خیر</option>
                                        </select>
                                    </td>
                                    <?php endif; ?>
                                    <td>
                                        <select name="mah_bem<?php echo $row_index; ?>" class="mah_bem input_text" style="height:40px; width:60px; direction:rtl">
                                            <option value="">انتخاب</option>
                                            <option value="1" <?php if($row['mah_bem']=='1') echo 'selected'; ?>>بلی</option>
                                            <option value="2" <?php if($row['mah_bem']=='2') echo 'selected'; ?>>خیر</option>
                                        </select>
                                    </td>
                                    <td><button type="button" class="item_edit btn btn-success btn-sm" data-id="<?php echo $row['id']; ?>" data-index="<?php echo $row_index; ?>">ویرایش</button></td>
                                    <td><button type="button" class="item_del btn btn-danger btn-sm" data-id="<?php echo $row['id']; ?>" data-z_sal="<?php echo $row['z_sal']; ?>" data-check="<?php echo check_id($row['id']); ?>">حذف</button></td>
                                </tr>
                                <?php $row_index++; endforeach; ?>
                            </tbody>
                        </table>
                        <div id="add_btn" align="right">
                            <button type="button" id="add1" class="btn btn-primary" style="margin:15px; border-radius:5px; height:25px; background-color:#096; color:#FFF">+</button>
                        </div>
                        <div id="save_btn" style="display:none" align="center">
                            <button type="button" id="save1" class="btn btn-success">ثبت محصول / محصولات جدید</button>
                        </div>
                    </div>
                </td></tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="right"><span class="style2">هکتار</span>
                        <input name="traz1" type="text" disabled class="text1" id="traz1" style="width:60px; height:30px; margin-bottom:10px" tabindex="29" dir="rtl" lang="fa" maxlength="11" align="baseline" xml:lang="fa" />
                    </td>
                    <td><div style="margin-right:25px" align="right">: تراز مساحت کشت اول</div></td>
                </tr>
                <tr>
                    <td colspan="2"><div class="style8" align="right">تراز مساحت : مساحت زمین - ( سطح آیش + مجموع سطح زیر کشت  )</div></td>
                    <td>&nbsp;</td>
                    <td align="right"><span class="style2">هکتار</span>
                        <input name="traz2" type="text" disabled class="text1" id="traz2" style="width:60px; height:30px; margin-bottom:10px" tabindex="29" dir="rtl" lang="fa" maxlength="100" align="baseline" xml:lang="fa" />
                    </td>
                    <td><div style="margin-right:25px" align="right">: تراز مساحت کشت دوم</div></td>
                </tr>
            </table>
            <div align="center">
                <p><input type="button" value="بستن پنجره" onclick="window.close()" style="height:35px; width:100px; font-family:Tahoma; font-size:16px"/></p>
            </div>
        </td></tr>
    </table>
    </form>
<script type="text/javascript">
var groups = <?php echo json_encode($groups); ?>;
var productsByGroup = <?php echo json_encode($products_by_group); ?>;
var z_sal = <?php echo json_encode($z_sal); ?>;
var id_ostan = <?php echo json_encode($id_ostan); ?>;
var sabt_mah = <?php echo json_encode($sabt_mah); ?>;

// افزودن ردیف جدید با کلاس new-row
$('#add1').click(function() {
    var groupOptions = '<option value="">انتخاب گروه</option>';
    for(var i=0; i<groups.length; i++) {
        groupOptions += '<option value="'+groups[i].group_cod+'">'+groups[i].group_name+'</option>';
    }
    var newRow = '<tr class="new-row">' +
        '<td><select class="cod_q mah_qroup input_text country" style="width:100px; height:40px" dir="rtl">'+groupOptions+'</select></td>' +
        '<td><select class="cod_m target input_text mar" style="width:120px; height:40px" dir="rtl"><option value="">انتخاب نام محصول</option></select></td>' +
        '<td><input type="text" class="zk_1 mashat input_text" style="width:60px; height:30px" dir="rtl" maxlength="11" /></td>' +
        '<td><input type="text" class="zk_2 mashat_b input_text" style="width:60px; height:30px" dir="rtl" maxlength="11" /></td>' +
        (sabt_mah==1 ? '<td><input type="text" class="sb_1 input_text" style="width:60px; height:30px" dir="rtl" maxlength="11" /></td>' +
        '<td><input type="text" class="sb_2 input_text" style="width:60px; height:30px" dir="rtl" maxlength="11" /></td>' : '') +
        '<td><input type="text" class="m_tolp input_text" style="width:60px; height:30px" dir="rtl" maxlength="10" /></td>' +
        (sabt_mah==1 ? '<td><input type="text" class="m_tol input_text" style="width:60px; height:30px" dir="rtl" maxlength="10" /></td>' +
        '<td><select class="mah_kh input_text" style="height:40px; width:60px; direction:rtl"><option value="">انتخاب</option><option value="1">بلی</option><option value="2">خیر</option></select></td>' : '') +
        '<td><select class="mah_bem input_text" style="height:40px; width:60px; direction:rtl"><option value="">انتخاب</option><option value="1">بلی</option><option value="2">خیر</option></select></td>' +
        '<td colspan="2"><button type="button" class="remove btn btn-danger btn-sm">-</button></td>' +
    '</tr>';
    $('#productRows').append(newRow);
    $('#save_btn').show();
});

// وقتی کاربر یکی از input/selectهای ردیف‌های ثبت‌شده را تغییر داد
$(document).on('input change', '#productRows tr:not(.new-row) input, #productRows tr:not(.new-row) select', function() {
    $('#productRows .new-row').remove();
    $('#add1').prop('disabled', true);
    $('#save1').prop('disabled', true);
});

// ویرایش محصول
$(document).on('click', '.item_edit', function() {
    var row = $(this).closest('tr');
    var id = $(this).data('id');
    var data = {
        f_cod_qroup: row.find('.cod_q').val(),
        f_cod_mah: row.find('.cod_m').val(),
        f_zer_kesht_a: row.find('.zk_1').val(),
        f_zer_kesht_b: row.find('.zk_2').val(),
        f_s_bar_a: row.find('.sb_1').val() || 0,
        f_s_bar_b: row.find('.sb_2').val() || 0,
        f_mah_tolp: row.find('.m_tolp').val(),
        f_mah_tol: row.find('.m_tol').val() || 0,
        f_mah_bem: row.find('.mah_bem').val(),
        f_mah_kh: row.find('.mah_kh').val() || '-',
        z_sal: z_sal,
        id: id
    };
    $.post('edit_item.php', data, function(resp) {
        alert(resp);
        $('#add1').prop('disabled', false);
        $('#save1').prop('disabled', false);
        location.reload();
    });
});
</script>
</body>
</html>