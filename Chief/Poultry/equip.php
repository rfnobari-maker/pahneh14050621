<?php
/**
 * صفحه آمار نهائی تجهیزات
 * نسخه بهینه شده - کاهش کوئری‌ها از 41 به 2 کوئری
 * سازگار با PHP 5.3.3
 */
require_once("../../lock_ce.php");
require_once("../../event.php");
require_once('../side_menu1.php');

// دریافت و اعتبارسنجی ورودی‌ها
$id_ostan1 = isset($_POST['id_ostan']) ? trim($_POST['id_ostan']) : (isset($id_ostan) ? trim($id_ostan) : '-1');
$bah_cod_m = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m']) : '';
$sal = isset($_POST['sal']) ? trim($_POST['sal']) : '';

// لیست سال‌های مجاز (به صورت رشته)
$allowed_years = array('1404', '1403', '1402', '1401', '1398', '1397');
if (!in_array($sal, $allowed_years)) {
    $sal = '';
}

// تعریف نام تجهیزات
$equip_names = array(
    'کندو کف باز',
    'اکستراکتور برقی',
    'اکستراکتور دستی',
    'دستگاه برداشت ژله رویال اتوماتیک',
    'موم دوز برقی',
    'دستگاه پرکن عسل اتوماتیک',
    'صافی عسل',
    'رس گیر عسل گازی',
    'خرک برداشت عسل مخزن دار',
    'دستگاه تصعید اسید اگزالیک برقی',
    'دستگاه زهرگیر',
    'خرک برداشت عسل پایه دار',
    'دستگاه پرس موم',
    'دستگاه استحصال نان زنبور',
    'دستگاه تمیزکننده گرده گل',
    'دستگاه مه پاش',
    'سیستم کنترل هوشمند دمای کندو',
    'دستگاه رطوبت گیر عسل',
    'دستگاه تغلیظ کننده عسل اتوماتیک'
);

// تابع ساخت شرط استان با استفاده از prepared statements
function buildOstanCondition($id_ostan, &$params) {
    if ($id_ostan == '-1' || $id_ostan == '') {
        return '1 = 1';
    }
    $params[':id_ostan1'] = $id_ostan;
    $params[':id_ostan2'] = $id_ostan;
    $params[':id_ostan3'] = $id_ostan;
    return "(((bee.id_ostan = :id_ostan1) AND (bee.m_ostan = :id_ostan2 OR bee.m_ostan = '-'))
             OR (bee.id_ostan != :id_ostan3 AND bee.m_ostan = :id_ostan1))";
}

// تابع ساخت شرط کد ملی
function buildCodMelliCondition($bah_cod_m, &$params) {
    if (empty($bah_cod_m)) {
        return '1 = 1';
    }
    $params[':bah_cod_m'] = $bah_cod_m;
    return 'bee.bah_cod_m = :bah_cod_m';
}

// تابع ساخت شرط سال
function buildSalCondition($sal, &$params) {
    if (empty($sal)) {
        return '1 = 1';
    }
    $params[':sal'] = $sal;
    return 'bee.sal = :sal';
}

// پردازش فرم
$show_results = false;
$stats_data = null;
$equipment_stats = array();
$total_beekeepers = 0;

if (isset($_POST['action'])) {
    $show_results = true;
    
    // ساخت پارامترها و شرایط
    $params = array();
    $v_id_ostan = buildOstanCondition($id_ostan1, $params);
    $v_bah_cod_m = buildCodMelliCondition($bah_cod_m, $params);
    $v_sal = buildSalCondition($sal, $params);
    
    $where_conditions = "$v_id_ostan AND $v_sal AND $v_bah_cod_m";
    
    // کوئری 1: آمار کلی
    $query = "SELECT 
                COUNT(*) AS zan,
                SUM(t_sha) AS t_sh,
                COUNT(CASE WHEN bee.bem_zan != '3' THEN 1 END) AS t_zanB,
                COUNT(CASE WHEN bee.bem_kand = '1' THEN 1 END) AS t_kandB,
                SUM(t_gar) AS kol_t_gar,
                SUM(t_bar) AS kol_t_bar,
                SUM(t_mom) AS kol_t_mom,
                SUM(t_jel) AS kol_t_jel,
                SUM(t_zah) AS kol_t_zah,
                SUM(t_nan) AS kol_t_nan,
                SUM(tk_bo) AS kol_k_bo,
                SUM(tk_mo) AS kol_k_mo,
                SUM(to_bo) AS kol_t_bo,
                SUM(to_mo) AS kol_t_mo
              FROM bee 
              WHERE $where_conditions";
    
    $stmt = $dbh->prepare($query);
    $stmt->execute($params);
    $stats_data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // محاسبات
    if ($stats_data) {
        $kol_k_bo = (float)$stats_data['kol_k_bo'];
        $kol_k_mo = (float)$stats_data['kol_k_mo'];
        $kol_t_bo = (float)$stats_data['kol_t_bo'];
        $kol_t_mo = (float)$stats_data['kol_t_mo'];
        $kol_to = round(($kol_t_mo + $kol_t_bo), 2);
        $kol_tk = round(($kol_k_mo + $kol_k_bo), 2);
        $av_to_mo = ($kol_k_mo != 0) ? round(($kol_t_mo / $kol_k_mo), 2) : 0;
        $av_to_bo = ($kol_k_bo != 0) ? round(($kol_t_bo / $kol_k_bo), 2) : 0;
        
        $stats_data['kol_to'] = $kol_to;
        $stats_data['kol_tk'] = $kol_tk;
        $stats_data['av_to_mo'] = $av_to_mo;
        $stats_data['av_to_bo'] = $av_to_bo;
        $stats_data['kol_k_bo'] = $kol_k_bo;
        $stats_data['kol_k_mo'] = $kol_k_mo;
        $stats_data['kol_t_bo'] = $kol_t_bo;
        $stats_data['kol_t_mo'] = $kol_t_mo;
    }
    
    // کوئری 2: همه آمار تجهیزات در یک کوئری واحد (بهینه‌سازی اصلی)
    // ساخت بخش SELECT برای همه تجهیزات
    $select_parts = array();
    $select_parts[] = "COUNT(DISTINCT bee.unique_id) AS total_beekeepers";
    
    for ($i = 2; $i <= 20; $i++) {
        $equip_exists_field = "taj_" . $i . "_exists";
        $equip_needed_field = "taj_" . $i . "_needed";
        
        // تعداد کسانی که تجهیز را دارند
        $select_parts[] = "COUNT(CASE WHEN t2.`$equip_exists_field` = 1 THEN 1 END) AS exists_$i";
        // تعداد کسانی که نیاز دارند اما ندارند
        $select_parts[] = "COUNT(CASE WHEN t2.`$equip_exists_field` = 0 AND t2.`$equip_needed_field` = 1 THEN 1 END) AS needed_$i";
    }
    
    // بهینه‌سازی: استفاده از LEFT JOIN به جای RIGHT JOIN
    // این باعث می‌شود از جدول bee (که index دارد) شروع شود
    $equipment_query = "SELECT " . implode(", ", $select_parts) . "
                        FROM bee
                        LEFT JOIN bee_equipment AS t2 ON bee.unique_id = t2.unique_id
                        WHERE $where_conditions";
    
    $equipment_stmt = $dbh->prepare($equipment_query);
    $equipment_stmt->execute($params);
    $equipment_data = $equipment_stmt->fetch(PDO::FETCH_ASSOC);
    
    $total_beekeepers = (int)$equipment_data['total_beekeepers'];
    
    // پردازش نتایج تجهیزات
    for ($i = 2; $i <= 20; $i++) {
        $exists_count = (int)$equipment_data["exists_$i"];
        $needed_count = (int)$equipment_data["needed_$i"];
        
        // محاسبه درصدها
        $exists_percent = ($total_beekeepers > 0) ? round(($exists_count / $total_beekeepers) * 100, 2) : 0;
        $needed_percent = ($total_beekeepers > 0 && ($total_beekeepers - $exists_count) > 0) 
                         ? round(($needed_count / ($total_beekeepers - $exists_count)) * 100, 2) : 0;
        
        $equipment_stats[] = array(
            'name' => $equip_names[$i - 2],
            'row' => $i - 1,
            'exists_count' => $exists_count,
            'exists_percent' => $exists_percent,
            'needed_count' => $needed_count,
            'needed_percent' => $needed_percent,
            'not_exists_count' => $total_beekeepers - $exists_count,
            'not_exists_percent' => round(100 - $exists_percent, 2)
        );
    }
}

// دریافت لیست استان‌ها
$ostan_query = "SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC";
$ostan_stmt = $dbh->prepare($ostan_query);
$ostan_stmt->execute();
$ostan_list = $ostan_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa" xml:lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'آمار تجهیزات'; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <style>
        button {
            border-color: #FFF;
        }
        .tabel { margin-right: 45px; }
        .text_r { margin-right: 0px; }
        .style1 {
            color: #003366;
            font-family: Tahoma;
            font-size: 18px;
        }
        #content {
            width: 900px;
            margin: 0 auto;
            font-family: Arial, Helvetica, sans-serif;
        }
        .page {
            float: right;
            margin: 0;
            padding: 0;
        }
        .page li {
            list-style: none;
            display: inline-block;
        }
        .page li a, .current {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: #8A8A8A;
        }
        .current {
            font-weight: bold;
            color: #000;
        }
        .button {
            padding: 5px 15px;
            text-decoration: none;
            background: #333;
            color: #F3F3F3;
            font-size: 13px;
            border-radius: 2px;
            margin: 0 4px;
            display: block;
            float: left;
        }
        .new-table th, .new-table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .new-table th {
            background-color: #006699;
            color: #fff;
        }
        .new-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .new-table tr:nth-child(odd) {
            background-color: #fff;
        }
        .form-container {
            width: 400px;
            padding: 5px;
            border: 2px solid #09C;
            margin: auto;
            text-align: left;
            border-radius: 15px;
        }
        .input-field {
            height: 40px;
            width: 170px;
            direction: rtl;
        }
    </style>
    <script>
        function bee_popup(form) {
            window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
            form.target = 'formpopup';
        }
    </script>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td colspan="3">
                <?php require_once("../header.php"); ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" valign="middle">
                <p class="style1"><br /></p>
                <div style="direction:rtl; text-align:center;">
                    <h2 style="color: #003366;">آمار نهائی تجهیزات</h2>
                </div>
                <p class="style1">
                    <span class="style8">غیر مهاجر استان + مهاجر استان - مهاجر سایر استان‌ها</span>
                </p>
                
                <form id="reg-form" method="post" action="#1">
                    <div class="form-container">
                        <table width="100%" height="234" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr bgcolor="#f1f1f1">
                                <td height="49" align="right" bgcolor="#DDDDDD" class="input_text">
                                    <div align="right">
                                        <select name="sal" class="input_text required input-field" id="sal">
                                            <option value="">-- انتخاب کنید --</option>
                                            <?php foreach ($allowed_years as $year): ?>
                                                <option value="<?php echo $year; ?>" 
                                                        <?php echo ($sal == $year) ? 'selected="selected"' : ''; ?>>
                                                    <?php echo $year; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </td>
                                <td align="center" bgcolor="#DDDDDD" class="style8">: سرشماری سال</td>
                            </tr>
                            <tr bgcolor="#f1f1f1">
                                <td height="49" align="right" bgcolor="#FFFFFF" class="input_text">
                                    <select name="id_ostan" class="style8 input-field" id="id_ostan" dir="rtl">
                                       <option value="-1">انتخاب استان</option>
                                        <?php foreach ($ostan_list as $ostan): ?>
                                            <option value="<?php echo htmlspecialchars($ostan['id_ostan']); ?>"
                                                    <?php echo ($ostan['id_ostan'] == $id_ostan1) ? 'selected="selected"' : ''; ?>>
                                                <?php echo htmlspecialchars($ostan['ostan']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td align="center" bgcolor="#FFFFFF" class="style8">: استان<span class="style1"><a name="1" id="12"></a></span></td>
                            </tr>
                            <tr>
                                <td height="54" align="right" bgcolor="#DDDDDD" class="input_text">
                                    <div align="right">
                                        <input name="bah_cod_m" type="text" class="input_text input-field" 
                                               id="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m); ?>" />
                                    </div>
                                </td>
                                <td height="54" align="center" bgcolor="#DDDDDD" class="style1">
                                    <font size="2" class="style8">: کد ملی بهره بردار</font>
                                </td>
                            </tr>
                            <tr>
                                <td height="60" colspan="2" align="left">
                                    <input name="action" type="submit" id="action" 
                                           style="width:150px; height:45px; alignment-adjust:middle" value="جستجو" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
                
                <?php if ($show_results && $stats_data): ?>
                    <br />
                    
                    <!-- جدول آمار کلی -->
                    <table width="90%" align="center" class="my-table">
                        <tr align="center" class="text1">
                            <td colspan="6" bgcolor="#6699CC">تولید سایر فرآورده‌های جانبی<br />Kg<br /></td>
                            <td colspan="3" bgcolor="#6699CC">تولید عسل<br />
                                <span class="style8">میانگین</span><br />Kg</td>
                            <td height="60" colspan="3" bgcolor="#6699CC">تعداد کندو</td>
                            <td colspan="2" bgcolor="#6699CC">تعداد تحت پوشش بیمه</td>
                            <td colspan="2" bgcolor="#6699CC">تعداد</td>
                        </tr>
                        <tr align="center" class="text1">
                            <td bgcolor="#6699CC">نان زنبور</td>
                            <td bgcolor="#6699CC">زهر</td>
                            <td height="35" bgcolor="#6699CC">بره موم</td>
                            <td bgcolor="#6699CC">موم</td>
                            <td bgcolor="#6699CC">گرده گل</td>
                            <td width="8%" bgcolor="#6699CC">ژله رویال</td>
                            <td width="6%" bgcolor="#6699CC">جمع</td>
                            <td width="7%" bgcolor="#6699CC">مدرن</td>
                            <td width="11%" bgcolor="#6699CC">سنتی</td>
                            <td width="6%" bgcolor="#6699CC">جمع</td>
                            <td width="7%" bgcolor="#6699CC">مدرن</td>
                            <td width="7%" bgcolor="#6699CC">سنتی</td>
                            <td width="7%" bgcolor="#6699CC">زنبورستان</td>
                            <td width="6%" bgcolor="#6699CC">زنبوردار</td>
                            <td width="6%" bgcolor="#6699CC">افراد شاغل</td>
                            <td width="7%" bgcolor="#6699CC">زنبورستان</td>
                        </tr>
                        <tr>
                            <td width="7%" class="normalTextSmaller" bgcolor="#FFFFCC">
                                <span class="normalTextSmall"><?php echo round($stats_data['kol_t_bar'], 0); ?></span>
                            </td>
                            <td width="7%" class="normalTextSmaller" bgcolor="#FFFFCC">
                                <span class="normalTextSmall"><?php echo round(($stats_data['kol_t_zah'] / 1000), 3); ?></span>
                            </td>
                            <td width="7%" height="58" class="normalTextSmaller" bgcolor="#FFFFCC">
                                <span class="normalTextSmall"><?php echo round($stats_data['kol_t_bar'], 0); ?></span>
                            </td>
                            <td width="8%" class="normalTextSmaller" bgcolor="#FFFFCC">
                                <span class="normalTextSmall"><?php echo round($stats_data['kol_t_mom'], 0); ?></span>
                            </td>
                            <td width="7%" class="normalTextSmaller" bgcolor="#FFFFCC">
                                <span class="normalTextSmall"><?php echo round($stats_data['kol_t_gar'], 0); ?></span>
                            </td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC">
                                <span class="normalTextSmall"><?php echo round(($stats_data['kol_t_jel'] / 1000), 3); ?></span>
                            </td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC">
                                <span class="normalTextSmall"><?php echo $stats_data['kol_to']; ?></span>
                            </td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC">
                                <?php echo round($stats_data['kol_t_mo'], 0); ?><br />
                                <?php echo $stats_data['av_to_mo']; ?>
                            </td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC">
                                <?php echo round($stats_data['kol_t_bo'], 0); ?><br />
                                <?php echo $stats_data['av_to_bo']; ?>
                            </td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC">
                                <span class="normalTextSmall"><?php echo $stats_data['kol_tk']; ?></span>
                            </td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC"><?php echo $stats_data['kol_k_mo']; ?></td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC"><?php echo $stats_data['kol_k_bo']; ?></td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC"><?php echo $stats_data['t_kandB']; ?></td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC"><?php echo $stats_data['t_zanB']; ?></td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC"><?php echo $stats_data['t_sh']; ?></td>
                            <td class="normalTextSmaller" bgcolor="#FFFFCC"><?php echo $stats_data['zan']; ?></td>
                        </tr>
                    </table>
                    
                    <br /><hr><br />
                    
                    <!-- آمار تجهیزات -->
                    <div style="direction:rtl; text-align:center;">
                        <h2 style="color: #003366;">
                            آمار تجهیزات استان : <?php echo function_exists('ostan_name') ? ostan_name($id_ostan1) : $id_ostan1; ?> 
                            تعداد پرسشنامه تکمیل شده : <?php echo $total_beekeepers; ?>
                        </h2>
                    </div>
                    
                    <br />
                    
                    <table width="90%" align="center" class="my-table new-table">
                        <tr class="text1">
                            <td colspan="2" bgcolor="#006699">لازم هست</td>
                            <td colspan="2" bgcolor="#006699">ناموجود</td>
                            <td colspan="2" bgcolor="#006699">موجود</td>
                            <td width="27%" rowspan="2" bgcolor="#006699">نام تجهیزات</td>
                            <td width="5%" rowspan="2" bgcolor="#006699">ردیف</td>
                        </tr>
                        <tr class="text1">
                            <td width="13%" bgcolor="#006699">درصد</td>
                            <td width="11%" bgcolor="#006699">تعداد</td>
                            <td width="13%" bgcolor="#006699">درصد</td>
                            <td width="11%" bgcolor="#006699">تعداد</td>
                            <td width="10%" bgcolor="#006699">درصد</td>
                            <td width="10%" bgcolor="#006699">تعداد</td>
                        </tr>
                        <?php foreach ($equipment_stats as $equip): ?>
                            <tr>
                                <td>%<?php echo $equip['needed_percent']; ?></td>
                                <td><?php echo $equip['needed_count']; ?></td>
                                <td>%<?php echo $equip['not_exists_percent']; ?></td>
                                <td><?php echo $equip['not_exists_count']; ?></td>
                                <td>%<?php echo $equip['exists_percent']; ?></td>
                                <td><?php echo $equip['exists_count']; ?></td>
                                <td style="text-align: right;"><?php echo htmlspecialchars($equip['name']); ?></td>
                                <td><?php echo $equip['row']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <br />
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td height="100" colspan="3" valign="middle"></td>
        </tr>
        <tr>
            <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
                <?php include('../../footer.php'); ?>
            </td>
        </tr>
    </table>
</body>
</html>
