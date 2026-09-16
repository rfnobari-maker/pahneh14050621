<?php 
/**
 * صفحه آمار نهائی تجهیزات
 * نسخه بهبود یافته با رعایت اصول امنیتی و ساختار بهتر
 */

include('../../lock_oce.php');
include('../../event.php');

// دریافت و اعتبارسنجی ورودی‌ها
$id_ostan1 = isset($_POST['id_ostan']) ? (int)$_POST['id_ostan'] : (isset($id_ostan) ? (int)$id_ostan : -1);
$bah_cod_m = isset($_POST['bah_cod_m']) ? trim($_POST['bah_cod_m']) : '';
$sal = isset($_POST['sal']) ? (int)$_POST['sal'] : '';

// لیست سال‌های مجاز
$allowed_years = [1404, 1403, 1402, 1401, 1398, 1397];
if (!in_array($sal, $allowed_years)) {
    $sal = '';
}

// تعریف نام تجهیزات
$equip_names = [
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
];

// تابع ساخت شرط استان
function buildOstanCondition($id_ostan, &$params) {
    if ($id_ostan == -1) {
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
$equipment_stats = [];
$total_beekeepers = 0;

if (isset($_POST['action'])) {
    $show_results = true;
    
    // ساخت پارامترها و شرایط
    $params = [];
    $v_id_ostan = buildOstanCondition($id_ostan1, $params);
    $v_bah_cod_m = buildCodMelliCondition($bah_cod_m, $params);
    $v_sal = buildSalCondition($sal, $params);
    
    $where_conditions = "$v_id_ostan AND $v_sal AND $v_bah_cod_m";
    
    // کوئری آمار کلی
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
    
    // شمارش کل بهره‌برداران
    $total_count_query = "SELECT COUNT(DISTINCT bee.unique_id) AS total
                          FROM bee
                          RIGHT JOIN bee_equipment AS t2 ON bee.unique_id = t2.unique_id
                          WHERE $where_conditions";
    
    $total_stmt = $dbh->prepare($total_count_query);
    $total_stmt->execute($params);
    $total_row = $total_stmt->fetch(PDO::FETCH_ASSOC);
    $total_beekeepers = (int)$total_row['total'];
    
    // آمار تجهیزات
    for ($i = 2; $i <= 20; $i++) {
        $equip_exists_field = "taj_" . $i . "_exists";
        $equip_needed_field = "taj_" . $i . "_needed";
        
        // تعداد کسانی که تجهیز را دارند
        $exists_query = "SELECT COUNT(DISTINCT bee.unique_id) AS exists_count
                         FROM bee
                         LEFT JOIN bee_equipment AS t2 ON bee.unique_id = t2.unique_id
                         WHERE $where_conditions AND t2.`$equip_exists_field` = 1";
        
        $exists_stmt = $dbh->prepare($exists_query);
        $exists_stmt->execute($params);
        $exists_data = $exists_stmt->fetch(PDO::FETCH_ASSOC);
        $exists_count = (int)$exists_data['exists_count'];
        
        // تعداد کسانی که نیاز دارند اما ندارند
        $needed_query = "SELECT COUNT(DISTINCT bee.unique_id) AS needed_count
                         FROM bee
                         LEFT JOIN bee_equipment AS t2 ON bee.unique_id = t2.unique_id
                         WHERE $where_conditions AND t2.`$equip_exists_field` = 0 AND t2.`$equip_needed_field` = 1";
        
        $needed_stmt = $dbh->prepare($needed_query);
        $needed_stmt->execute($params);
        $needed_data = $needed_stmt->fetch(PDO::FETCH_ASSOC);
        $needed_count = (int)$needed_data['needed_count'];
        
        // محاسبه درصدها
        $exists_percent = ($total_beekeepers > 0) ? round(($exists_count / $total_beekeepers) * 100, 2) : 0;
        $needed_percent = ($total_beekeepers > 0 && ($total_beekeepers - $exists_count) > 0) 
                         ? round(($needed_count / ($total_beekeepers - $exists_count)) * 100, 2) : 0;
        
        $equipment_stats[] = [
            'name' => $equip_names[$i - 2],
            'row' => $i - 1,
            'exists_count' => $exists_count,
            'exists_percent' => $exists_percent,
            'needed_count' => $needed_count,
            'needed_percent' => $needed_percent,
            'not_exists_count' => $total_beekeepers - $exists_count,
            'not_exists_percent' => round(100 - $exists_percent, 2)
        ];
    }
}

// دریافت لیست استان‌ها
$ostan_query = "SELECT id_ostan, ostan FROM ostanname ORDER BY BINARY ostan ASC";
$ostan_stmt = $dbh->prepare($ostan_query);
$ostan_stmt->execute();
$ostan_list = $ostan_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa" xml:lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'آمار تجهیزات'; ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .tabel { margin-right: 45px; }
        .text_r { margin-right: 0px; }
        .style1 {
            color: #003366;
            font-family: Tahoma;
            font-size: 18px;
        }
        .form-container {
            width: 400px;
            padding: 5px;
            border: 2px solid #09C;
            margin: auto;
            text-align: left;
            border-radius: 15px;
        }
        .form-table {
            width: 100%;
            border: 0;
        }
        .form-table td {
            padding: 5px;
        }
        .bg-gray { background-color: #DDDDDD; }
        .bg-white { background-color: #FFFFFF; }
        .input-field {
            height: 40px;
            width: 170px;
            direction: rtl;
        }
        .submit-btn {
            width: 150px;
            height: 45px;
        }
        .stats-table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        .stats-table td {
            padding: 8px;
            text-align: center;
        }
        .header-bg { background-color: #6699CC; }
        .equipment-header-bg { background-color: #006699; }
        .row-even { background-color: #FFFFCC; }
    </style>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="188" alt="Header" /></td>
        </tr>
        <tr>
            <td><?php include('menu.php'); ?></td>
        </tr>
        <tr>
            <td>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                    <tr>
                        <td width="4"><p>&nbsp;</p><p>&nbsp;</p></td>
                        <td width="840">
                            <?php include('top.php'); ?>
                            
                            <h2 style="color: #003366;">آمار نهائی تجهیزات</h2>
                            <p class="style1">
                                <span class="style8">غیر مهاجر استان + مهاجر استان - مهاجر سایر استان‌ها</span>
                            </p>
                            
                            <form id="reg-form" method="post" action="#1">
                                <div class="form-container">
                                    <table class="form-table" height="234">
                                        <tr>
                                            <td height="49" align="right" class="bg-gray">
                                                <select name="sal" class="input_text required input-field" id="sal">
                                                    <option value="">-- انتخاب کنید --</option>
                                                    <?php foreach ($allowed_years as $year): ?>
                                                        <option value="<?php echo $year; ?>" 
                                                                <?php echo ($sal == $year) ? 'selected="selected"' : ''; ?>>
                                                            <?php echo $year; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td align="center" class="bg-gray style8">: سرشماری سال</td>
                                        </tr>
                                        <tr>
                                            <td height="49" align="right" class="bg-white">
                                                <select name="id_ostan" disabled="disabled" class="style8 input-field" id="id_ostan">
                                                    <?php foreach ($ostan_list as $ostan): ?>
                                                        <option value="<?php echo (int)$ostan['id_ostan']; ?>"
                                                                <?php echo ($ostan['id_ostan'] == $id_ostan1) ? 'selected="selected"' : ''; ?>>
                                                            <?php echo htmlspecialchars($ostan['ostan']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" name="id_ostan" value="<?php echo $id_ostan1; ?>" />
                                            </td>
                                            <td align="center" class="bg-white style8">: استان<span class="style1"><a name="1" id="12"></a></span></td>
                                        </tr>
                                        <tr>
                                            <td height="54" align="right" class="bg-gray">
                                                <input name="bah_cod_m" type="text" class="input_text input-field" 
                                                       id="bah_cod_m" value="<?php echo htmlspecialchars($bah_cod_m); ?>" />
                                            </td>
                                            <td height="54" align="center" class="bg-gray style1">
                                                <font size="2" class="style8">: کد ملی بهره بردار</font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="60" colspan="2" align="left">
                                                <input name="action" type="submit" id="action" class="submit-btn" value="جستجو" />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                            
                            <?php if ($show_results && $stats_data): ?>
                                <br />
                                
                                <!-- جدول آمار کلی -->
                                <table width="90%" align="center" class="my-table stats-table">
                                    <tr align="center" class="text1">
                                        <td colspan="6" class="header-bg">تولید سایر فرآورده‌های جانبی<br />Kg<br /></td>
                                        <td colspan="3" class="header-bg">تولید عسل<br />
                                            <span class="style8">میانگین</span><br />Kg</td>
                                        <td height="60" colspan="3" class="header-bg">تعداد کندو</td>
                                        <td colspan="2" class="header-bg">تعداد تحت پوشش بیمه</td>
                                        <td colspan="2" class="header-bg">تعداد</td>
                                    </tr>
                                    <tr align="center" class="text1">
                                        <td class="header-bg">نان زنبور</td>
                                        <td class="header-bg">زهر</td>
                                        <td height="35" class="header-bg">بره موم</td>
                                        <td class="header-bg">موم</td>
                                        <td class="header-bg">گرده گل</td>
                                        <td width="8%" class="header-bg">ژله رویال</td>
                                        <td width="6%" class="header-bg">جمع</td>
                                        <td width="7%" class="header-bg">مدرن</td>
                                        <td width="11%" class="header-bg">سنتی</td>
                                        <td width="6%" class="header-bg">جمع</td>
                                        <td width="7%" class="header-bg">مدرن</td>
                                        <td width="7%" class="header-bg">سنتی</td>
                                        <td width="7%" class="header-bg">زنبورستان</td>
                                        <td width="6%" class="header-bg">زنبوردار</td>
                                        <td width="6%" class="header-bg">افراد شاغل</td>
                                        <td width="7%" class="header-bg">زنبورستان</td>
                                    </tr>
                                    <tr>
                                        <td width="7%" class="normalTextSmaller row-even">
                                            <span class="normalTextSmall"><?php echo round($stats_data['kol_t_bar'], 0); ?></span>
                                        </td>
                                        <td width="7%" class="normalTextSmaller row-even">
                                            <span class="normalTextSmall"><?php echo round(($stats_data['kol_t_zah'] / 1000), 3); ?></span>
                                        </td>
                                        <td width="7%" height="58" class="normalTextSmaller row-even">
                                            <span class="normalTextSmall"><?php echo round($stats_data['kol_t_bar'], 0); ?></span>
                                        </td>
                                        <td width="8%" class="normalTextSmaller row-even">
                                            <span class="normalTextSmall"><?php echo round($stats_data['kol_t_mom'], 0); ?></span>
                                        </td>
                                        <td width="7%" class="normalTextSmaller row-even">
                                            <span class="normalTextSmall"><?php echo round($stats_data['kol_t_gar'], 0); ?></span>
                                        </td>
                                        <td class="normalTextSmaller row-even">
                                            <span class="normalTextSmall"><?php echo round(($stats_data['kol_t_jel'] / 1000), 3); ?></span>
                                        </td>
                                        <td class="normalTextSmaller row-even">
                                            <span class="normalTextSmall"><?php echo $stats_data['kol_to']; ?></span>
                                        </td>
                                        <td class="normalTextSmaller row-even">
                                            <?php echo round($stats_data['kol_t_mo'], 0); ?><br />
                                            <?php echo $stats_data['av_to_mo']; ?>
                                        </td>
                                        <td class="normalTextSmaller row-even">
                                            <?php echo round($stats_data['kol_t_bo'], 0); ?><br />
                                            <?php echo $stats_data['av_to_bo']; ?>
                                        </td>
                                        <td class="normalTextSmaller row-even">
                                            <span class="normalTextSmall"><?php echo $stats_data['kol_tk']; ?></span>
                                        </td>
                                        <td class="normalTextSmaller row-even"><?php echo $stats_data['kol_k_mo']; ?></td>
                                        <td class="normalTextSmaller row-even"><?php echo $stats_data['kol_k_bo']; ?></td>
                                        <td class="normalTextSmaller row-even"><?php echo $stats_data['t_kandB']; ?></td>
                                        <td class="normalTextSmaller row-even"><?php echo $stats_data['t_zanB']; ?></td>
                                        <td class="normalTextSmaller row-even"><?php echo $stats_data['t_sh']; ?></td>
                                        <td class="normalTextSmaller row-even"><?php echo $stats_data['zan']; ?></td>
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
                                
                                <table width="90%" align="center" class="my-table new-table stats-table">
                                    <tr class="text1">
                                        <td colspan="2" class="equipment-header-bg">لازم هست</td>
                                        <td colspan="2" class="equipment-header-bg">ناموجود</td>
                                        <td colspan="2" class="equipment-header-bg">موجود</td>
                                        <td width="27%" rowspan="2" class="equipment-header-bg">نام تجهیزات</td>
                                        <td width="5%" rowspan="2" class="equipment-header-bg">ردیف</td>
                                    </tr>
                                    <tr class="text1">
                                        <td width="13%" class="equipment-header-bg">درصد</td>
                                        <td width="11%" class="equipment-header-bg">تعداد</td>
                                        <td width="13%" class="equipment-header-bg">درصد</td>
                                        <td width="11%" class="equipment-header-bg">تعداد</td>
                                        <td width="10%" class="equipment-header-bg">درصد</td>
                                        <td width="10%" class="equipment-header-bg">تعداد</td>
                                    </tr>
                                    <?php foreach ($equipment_stats as $index => $equip): ?>
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
                            
                            <p>
                                <a href="index.php" title="برگشت به صفحه قبل">
                                    <img src="../../files/goback.jpg" width="118" height="47" alt="برگشت" />
                                </a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td height="109" colspan="3" valign="middle" background="../../files/bottom.gif">
                            <?php include('../../footer.php'); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

