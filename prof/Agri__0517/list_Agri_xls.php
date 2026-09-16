<?php 
// تنظیم هدرهای خروجی اکسل
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment; filename=Agri_list.xls");

include('../../lock_p1.php');
include('../../event.php');

// دریافت و اعتبارسنجی ورودی‌ها
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$m_cod_m = isset($_POST['m_cod_m']) ? $_POST['m_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$t_mah = isset($_POST['t_mah']) ? $_POST['t_mah'] : '';

// ساخت نام جدول بر اساس سال زراعی
$Agri_table = 'Agri' . str_replace('-', '_', $z_sal);

// ساخت شرط‌های جستجو - استفاده از array() به جای []
$conditions = array();
$params = array(':mor_cod_m' => $login_session);

if (!empty($add_abadi)) {
    $conditions[] = "add_abadi = :add_abadi";
    $params[':add_abadi'] = $add_abadi;
}
if (!empty($add_city)) {
    $conditions[] = "add_city = :add_city";
    $params[':add_city'] = $add_city;
}
if (!empty($no_mal)) {
    $conditions[] = "no_mal = :no_mal";
    $params[':no_mal'] = $no_mal;
}
if (!empty($no_kesh)) {
    $conditions[] = "no_kesh = :no_kesh";
    $params[':no_kesh'] = $no_kesh;
}
if (!empty($bah_cod_m)) {
    $conditions[] = "bah_cod_m = :bah_cod_m";
    $params[':bah_cod_m'] = $bah_cod_m;
}
if (!empty($m_cod_m)) {
    $conditions[] = "m_cod_m = :m_cod_m";
    $params[':m_cod_m'] = $m_cod_m;
}
if (!empty($z_sal)) {
    $conditions[] = "z_sal = :z_sal";
    $params[':z_sal'] = $z_sal;
}
if (!empty($t_mah)) {
    if ($t_mah == '4') {
        $conditions[] = "t_mah >= :t_mah";
    } else {
        $conditions[] = "t_mah = :t_mah";
    }
    $params[':t_mah'] = $t_mah;
}

// ساخت عبارت WHERE
$where_clause = "";
if (count($conditions) > 0) {
    $where_clause = " AND " . implode(" AND ", $conditions);
}

include('../../login/config.php');

// اجرای کوئری
$query = "SELECT s_ayesh, num_bah, id, mor_cod_m, no_mal, bah_cod_m, add_abadi, add_city, sh_gat, z_sal, no_kesh, m_zamin, id_ostan, id_city, t_mah, lat, lng 
          FROM `$Agri_table` 
          WHERE mor_cod_m = :mor_cod_m $where_clause 
          ORDER BY mor_cod_m ASC";

$stmt = $dbh->prepare($query);
$stmt->execute($params);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa-IR" xml:lang="fa">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <style type="text/css">
        body {
            font-family: Tahoma, Arial, sans-serif;
            font-size: 12px;
        }
        .tabel { margin-right: 45px; }
        .text_r { margin-right: 0px; }
        .style1 {
            color: #003366;
            font-family: Tahoma;
            font-size: 18px;
        }
        .normalTextSmaller {
            font-size: 11px;
        }
        .normalTextSmall {
            font-size: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #999999;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
        <tr>
            <td>
                <table width="98%" border="1" align="center" cellpadding="1" cellspacing="0" style="border-collapse: collapse;">
                    <tr align="center">
                        <th width="8%">تنوع محصول</th>
                        <th width="8%">سطح آیش (هکتار)</th>
                        <th width="10%">عرض جغرافیایی</th>
                        <th width="10%">طول جغرافیایی</th>
                        <th width="8%">مساحت زمین (هکتار)</th>
                        <th width="6%">نوع کشت</th>
                        <th width="8%">نوع مالکیت</th>
                        <th width="6%">شماره قطعه</th>
                        <th width="8%">همراه</th>
                        <th width="8%">کد ملی</th>
                        <th width="10%">نام خانوادگی</th>
                        <th width="8%">نام</th>
                        <th width="10%">آبادی</th>
                        <th width="10%">شهر</th>
                        <th width="4%">ردیف</th>
                    </tr>
                    <?php
                    $r = 1;
                    $row_count = 0;
                    foreach ($stmt as $row) {
                        $row_count++;
                        
                        // تعیین نوع مالکیت
                        $v_no_mal = '';
                        switch ($row['no_mal']) {
                            case '1': $v_no_mal = 'سند ششدانگ'; break;
                            case '2': $v_no_mal = 'سند مشاعی'; break;
                            case '3': $v_no_mal = 'اصلاحات اراضی'; break;
                            case '4': $v_no_mal = 'موقوفه'; break;
                            case '5': $v_no_mal = 'واگذاری'; break;
                            case '6': $v_no_mal = 'قولنامه'; break;
                            case '7': $v_no_mal = 'اجاره'; break;
                            case '8': $v_no_mal = 'سایر'; break;
                            default: $v_no_mal = 'نامشخص';
                        }
                        
                        // تعیین نوع کشت
                        $v_no_kesh_display = '';
                        switch ($row['no_kesh']) {
                            case '1': $v_no_kesh_display = 'آبی'; break;
                            case '2': $v_no_kesh_display = 'دیم'; break;
                            default: $v_no_kesh_display = 'نامشخص';
                        }
                        
                        // تعیین رنگ ردیف‌های زوج و فرد
                        $bg_color = ($r % 2 == 0) ? '#FFFFCC' : '#FFFFFF';
                        
                        // دریافت مقادیر با توابع کمکی
                        $bah_tel = bah_tel_m($row['bah_cod_m']);
                        $bah_last = bah_last_name($row['bah_cod_m']);
                        $bah_first = bah_first_name($row['bah_cod_m']);
                        $abadi = abadi_name($row['add_abadi']);
                        $shahr = shahr_name($row['add_city']);
                    ?>
                    <tr>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($row['t_mah'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($row['s_ayesh'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($row['lat'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($row['lng'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($row['m_zamin'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($v_no_kesh_display, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($v_no_mal, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($row['sh_gat'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($bah_tel, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($row['bah_cod_m'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($bah_last, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($bah_first, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($abadi, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo htmlspecialchars($shahr, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td bgcolor="<?php echo $bg_color; ?>"><?php echo $r; ?></td>
                    </tr>
                    <?php
                        $r++;
                    }
                    
                    // اگر رکوردی وجود نداشت
                    if ($row_count == 0) {
                    ?>
                    <tr>
                        <td colspan="15" style="text-align: center; color: red;">نتیجه‌ای یافت نشد</td>
                    </tr>
                    <?php } ?>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>