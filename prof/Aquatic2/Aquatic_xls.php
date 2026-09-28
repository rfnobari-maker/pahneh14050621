<?php
header('Content-type: application/vnd.ms-excel;charset=UTF-8');
header('Content-Disposition: attachment;Filename=آبزیان.xls');

include('../../lock_p1.php');
include('../../event.php');
require_once('../../login/config.php');

$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city  = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_fa     = isset($_POST['no_fa']) ? $_POST['no_fa'] : '';
$no_mal    = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
$sal       = isset($_POST['sal']) ? $_POST['sal'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
if (isset($login_session) && $login_session !== '') {
    $mor_cod_m = $login_session;
}

if (!function_exists('agri2_h')) {
    function agri2_h($v)
    {
        if (!isset($v)) {
            return '';
        }
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

function aquatic_xls_filled($v)
{
    return $v !== '' && $v !== '0' && $v !== 0;
}

function aquatic_xls_label($map, $v)
{
    $k = (string) $v;
    return isset($map[$k]) ? $map[$k] : '';
}

$no_fa_map = array('1' => 'تکثیر', '2' => 'پرورش', '3' => 'تکثیر و پرورش');
$g_tol_map = array(
    '1' => 'مجتمع', '2' => 'منفرد', '3' => 'مداربسته', '4' => 'دو منظوره', '5' => 'شالیزار',
    '6' => 'قفش', '7' => 'پن', '8' => 'آب بندان', '9' => 'منابع آبی', '10' => 'سایر موارد'
);
$m_ab_map = array(
    '1' => 'رودخانه', '2' => 'چاه', '3' => 'قنات و چشمه', '4' => 'آب بندان',
    '5' => 'خور و دریا', '6' => 'دریاچه', '7' => 'سایرمنابع'
);

$rows = array();
if ($mor_cod_m !== '') {
    $where = array('Aq.mor_cod_m = :mor_cod_m');
    $params = array(':mor_cod_m' => $mor_cod_m);
    if (aquatic_xls_filled($add_abadi)) {
        $where[] = 'Aq.add_abadi = :add_abadi';
        $params[':add_abadi'] = $add_abadi;
    }
    if (aquatic_xls_filled($add_city)) {
        $where[] = 'Aq.add_city = :add_city';
        $params[':add_city'] = $add_city;
    }
    if (aquatic_xls_filled($no_mal)) {
        $where[] = 'Aq.no_mal = :no_mal';
        $params[':no_mal'] = $no_mal;
    }
    if (aquatic_xls_filled($no_fa)) {
        $where[] = 'Aq.no_fa = :no_fa';
        $params[':no_fa'] = $no_fa;
    }
    if (preg_match('/^\d{4}$/', $sal)) {
        $where[] = 'Aq.sal = :sal';
        $params[':sal'] = $sal;
    }
    $sqlWhere = implode(' AND ', $where);
    $sql = "SELECT Aq.mor_cod_m, Aq.bah_cod_m, Aq.num_bah, Aq.add_abadi, Aq.add_city,
                   Aq.id_city, Aq.id_ostan, Aq.no_fa, Aq.g_tol, Aq.m_ab, Aq.m_zamin, Aq.sal,
                   Aq.tak1, Aq.tak2, Aq.tak3, Aq.tak4, Aq.tak5,
                   Aq.par1, Aq.par2, Aq.par3, Aq.par4,
                   bah.name AS bah_name, bah.Last_name AS bah_last,
                   users.name AS user_name, users.Last_name AS user_last,
                   list_abadi.abadi, list_city.shahr, cityname.city, ostanname.ostan
            FROM Aquatic Aq
            LEFT JOIN bah ON Aq.bah_cod_m = bah.bah_cod_m AND Aq.num_bah = bah.num_bah
            LEFT JOIN users ON users.username = Aq.mor_cod_m
            LEFT JOIN list_abadi ON list_abadi.add_abadi = Aq.add_abadi AND list_abadi.mor_cod_m = Aq.mor_cod_m
            LEFT JOIN list_city ON list_city.add_city = Aq.add_city AND list_city.mor_cod_m = Aq.mor_cod_m
            LEFT JOIN cityname ON cityname.id_city = Aq.id_city AND cityname.id_ostan = Aq.id_ostan
            LEFT JOIN ostanname ON ostanname.id_ostan = Aq.id_ostan
            WHERE $sqlWhere
            ORDER BY Aq.mor_cod_m ASC, Aq.bah_cod_m ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute($params);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <title>آبزیان</title>
</head>
<body>
<table border="1" cellpadding="4" cellspacing="0">
    <tr>
        <th>کد ملی کارشناس مروج</th>
        <th>کارشناس مروج</th>
        <th>پرورش میگوی آب شور و شیرین و شاه میگو/تن</th>
        <th>پرورش قزل آلا/تن</th>
        <th>پرورش کپور ماهیان/تن</th>
        <th>پرورش ماهیان خاویاری/تن</th>
        <th>تکثیر ماهیان زینتی/هزار قطعه</th>
        <th>تکثیر میگوی آب شور و شیرین و شاه میگو/هزار قطعه</th>
        <th>تکثیر قزل آلا /هزار قطعه</th>
        <th>تکثیر کپور ماهیان/هزار قطعه</th>
        <th>تکثیر ماهیان خاویاری/هزار قطعه</th>
        <th>مساحت زمین (مترمربع )</th>
        <th>منبع تامین آب</th>
        <th>قالب تولیدی</th>
        <th>نوع فعالیت</th>
        <th>سال</th>
        <th>کد ملی</th>
        <th>نام و نام خانوادگی</th>
        <th>شهر / آبادی</th>
        <th>شهرستان</th>
        <th>استان</th>
        <th>ردیف</th>
    </tr>
<?php
$r = 1;
foreach ($rows as $row) {
    $v_no_fa = aquatic_xls_label($no_fa_map, isset($row['no_fa']) ? $row['no_fa'] : '');
    $v_g_tol = aquatic_xls_label($g_tol_map, isset($row['g_tol']) ? $row['g_tol'] : '');
    $v_m_ab = aquatic_xls_label($m_ab_map, isset($row['m_ab']) ? $row['m_ab'] : '');
    $bah_full = trim((isset($row['bah_last']) ? $row['bah_last'] : '') . ' ' . (isset($row['bah_name']) ? $row['bah_name'] : ''));
    $bah_full = str_replace('&nbsp;', ' ', $bah_full);
    $user_full = trim((isset($row['user_last']) ? $row['user_last'] : '') . '-' . (isset($row['user_name']) ? $row['user_name'] : ''), '- ');
    $place = (isset($row['abadi']) ? $row['abadi'] : '') . (isset($row['shahr']) ? $row['shahr'] : '');
    $bg = ($r % 2 === 0) ? ' bgcolor="#FFFFCC"' : '';
?>
    <tr>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h($row['mor_cod_m']); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h($user_full); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['par4']) ? $row['par4'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['par3']) ? $row['par3'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['par2']) ? $row['par2'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['par1']) ? $row['par1'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['tak5']) ? $row['tak5'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['tak4']) ? $row['tak4'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['tak3']) ? $row['tak3'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['tak2']) ? $row['tak2'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['tak1']) ? $row['tak1'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['m_zamin']) ? $row['m_zamin'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h($v_m_ab); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h($v_g_tol); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h($v_no_fa); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['sal']) ? $row['sal'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h($row['bah_cod_m']); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h($bah_full); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h($place); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['city']) ? $row['city'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo agri2_h(isset($row['ostan']) ? $row['ostan'] : ''); ?></td>
        <td align="center"<?php echo $bg; ?>><?php echo (int) $r; ?></td>
    </tr>
<?php
    $r++;
}
?>
</table>
</body>
</html>
