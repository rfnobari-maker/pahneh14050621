<?php
header('Content-type: application/vnd.ms-excel;charset=UTF-8');
header('Content-Disposition: attachment;Filename=Garden_list.xls');

include('../../lock_p1.php');
include('../../event.php');

if (!function_exists('agri2_h')) {
    function agri2_h($v)
    {
        if (!isset($v)) {
            return '';
        }
        return htmlspecialchars($v . '', ENT_QUOTES, 'UTF-8');
    }
}

$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$nah_kesh = isset($_POST['nah_kesh']) ? $_POST['nah_kesh'] : '';
$no_mal = isset($_POST['no_mal']) ? $_POST['no_mal'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$ok = isset($_POST['ok']) ? $_POST['ok'] : '';

$where = array('Garden.mor_cod_m = :mor_cod_m');
$params = array(':mor_cod_m' => $login_session);
if ($add_abadi !== '') {
    $where[] = 'Garden.add_abadi = :add_abadi';
    $params[':add_abadi'] = $add_abadi;
}
if ($add_city !== '') {
    $where[] = 'Garden.add_city = :add_city';
    $params[':add_city'] = $add_city;
}
if ($no_mal !== '') {
    $where[] = 'Garden.no_mal = :no_mal';
    $params[':no_mal'] = $no_mal;
}
if ($no_kesh !== '') {
    $where[] = 'Garden.no_kesh = :no_kesh';
    $params[':no_kesh'] = $no_kesh;
}
if ($nah_kesh !== '') {
    $where[] = 'Garden.nah_kesh = :nah_kesh';
    $params[':nah_kesh'] = $nah_kesh;
}
if ($bah_cod_m !== '') {
    $where[] = 'Garden.bah_cod_m = :bah_cod_m';
    $params[':bah_cod_m'] = $bah_cod_m;
}
if ($z_sal !== '' && preg_match('/^\d{4}$/', $z_sal)) {
    $where[] = 'Garden.z_sal = :z_sal';
    $params[':z_sal'] = $z_sal;
}
if ($ok !== '') {
    $where[] = 'bah.ok = :ok';
    $params[':ok'] = $ok;
}
$sqlWhere = implode(' AND ', $where);

$query = "SELECT Garden.num_bah, Garden.id, Garden.mor_cod_m, Garden.no_mal,
                 Garden.bah_cod_m, Garden.add_abadi, Garden.add_city, Garden.sh_gat, Garden.z_sal, Garden.no_kesh,
                 Garden.nah_kesh, Garden.m_zamin, Garden.id_ostan, Garden.id_city, Garden.t_mah,
                 bah.name, bah.Last_name AS last_name, bah.tel_m,
                 list_abadi.abadi, list_city.shahr, cityname.city AS city_name
          FROM Garden
          INNER JOIN bah ON Garden.bah_cod_m = bah.bah_cod_m AND Garden.num_bah = bah.num_bah
          LEFT JOIN list_abadi ON Garden.add_abadi <> '' AND Garden.add_abadi = list_abadi.add_abadi AND list_abadi.mor_cod_m = Garden.mor_cod_m
          LEFT JOIN list_city ON Garden.add_city <> '' AND Garden.add_city = list_city.add_city AND list_city.mor_cod_m = Garden.mor_cod_m
          LEFT JOIN cityname ON cityname.id_city = Garden.id_city AND cityname.id_ostan = Garden.id_ostan
          WHERE $sqlWhere
          ORDER BY Garden.bah_cod_m ASC, Garden.sh_gat ASC, Garden.id ASC";
$stmt = $dbh->prepare($query);
$stmt->execute($params);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo agri2_h($title); ?></title>
    <link href="../../FA.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="98%" height="70" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr align="center" class="text_r">
        <td width="14%" bgcolor="#999999">مساحت زمین (هکتار )</td>
        <td width="14%" height="42" bgcolor="#999999">نوع کشت</td>
        <td width="13%" bgcolor="#999999">نوع مالکیت</td>
        <td width="13%" bgcolor="#999999">نحوه کشت</td>
        <td width="13%" bgcolor="#999999">شماره قطعه</td>
        <td width="13%" bgcolor="#999999">سال</td>
        <td width="13%" bgcolor="#999999">همراه</td>
        <td width="13%" bgcolor="#999999"> کد ملی<br /></td>
        <td width="15%" bgcolor="#999999">نام خانوادگی</td>
        <td width="15%" bgcolor="#999999">نام</td>
        <td width="12%" bgcolor="#999999">شهر / آبادی </td>
        <td width="14%" bgcolor="#999999">شهرستان </td>
        <td width="6%" bgcolor="#999999">ردیف</td>
    </tr>
<?php
$r = 1;
foreach ($stmt as $row) {
    $v_no_mal = '-';
    if ($row['no_mal'] == '1') {
        $v_no_mal = 'سند ششدانگ';
    } elseif ($row['no_mal'] == '2') {
        $v_no_mal = 'سند مشاعی';
    } elseif ($row['no_mal'] == '3') {
        $v_no_mal = 'اصلاحات اراضی';
    } elseif ($row['no_mal'] == '4') {
        $v_no_mal = 'موقوفه';
    } elseif ($row['no_mal'] == '5') {
        $v_no_mal = 'واگذاری';
    } elseif ($row['no_mal'] == '6') {
        $v_no_mal = 'قولنامه';
    } elseif ($row['no_mal'] == '7') {
        $v_no_mal = 'اجاره';
    } elseif ($row['no_mal'] == '8') {
        $v_no_mal = 'سایر';
    }

    $v_nah_kesh = '-';
    if ($row['nah_kesh'] == '1') {
        $v_nah_kesh = 'ساده';
    } elseif ($row['nah_kesh'] == '2') {
        $v_nah_kesh = 'مخلوط';
    } elseif ($row['nah_kesh'] == '3') {
        $v_nah_kesh = 'درختان پراکنده';
    }

    $v_no_kesh = '-';
    if ($row['no_kesh'] == '1') {
        $v_no_kesh = 'آبی';
    } elseif ($row['no_kesh'] == '2') {
        $v_no_kesh = 'دیم';
    }

    $place = (isset($row['abadi']) ? $row['abadi'] : '') . (isset($row['shahr']) ? $row['shahr'] : '');
    $bg = ($r % 2 == 0) ? ' bgcolor="#FFFFCC"' : '';
?>
    <tr>
        <td class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmall"><?php echo agri2_h($row['m_zamin']); ?></span></td>
        <td height="25" class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmall"><?php echo agri2_h($v_no_kesh); ?></span></td>
        <td class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmall"><?php echo agri2_h($v_no_mal); ?></span></td>
        <td class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmall"><?php echo agri2_h($v_nah_kesh); ?></span></td>
        <td class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmall"><?php echo agri2_h($row['sh_gat']); ?></span></td>
        <td class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmall"><?php echo agri2_h($row['z_sal']); ?></span></td>
        <td class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmaller"><?php echo agri2_h(isset($row['tel_m']) ? $row['tel_m'] : ''); ?></span></td>
        <td class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><p><?php echo agri2_h($row['bah_cod_m']); ?></p></td>
        <td class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmall"><?php echo agri2_h(isset($row['last_name']) ? $row['last_name'] : ''); ?></span></td>
        <td class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmall"><?php echo agri2_h(isset($row['name']) ? $row['name'] : ''); ?></span></td>
        <td class="normalTextSmaller" style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmall"><?php echo agri2_h($place); ?></span></td>
        <td style="text-align: center"<?php echo $bg; ?>><span class="normalTextSmall"><?php echo agri2_h(isset($row['city_name']) ? $row['city_name'] : ''); ?></span></td>
        <td style="text-align: center"<?php echo $bg; ?>><?php echo (int) $r; ?></td>
    </tr>
<?php
    $r++;
}
?>
</table>
</body>
</html>
