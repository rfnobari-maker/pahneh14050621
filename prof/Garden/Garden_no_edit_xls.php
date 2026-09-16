<?php
include('../../lock_p1.php');
include('../../event.php');
include_once('../../login/config.php');

$id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city = isset($_POST['id_city5']) ? $_POST['id_city5'] : '';
$id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$mah_name = isset($_POST['mah_name']) ? $_POST['mah_name'] : '';

if ($id_ostan1 == '-1' || $id_ostan1 === '') {
    $v_id_ostan = 1;
} else {
    $v_id_ostan = "Garden.id_ostan='$id_ostan1'";
}
if ($id_city == 0 || $id_city === '') {
    $v_id_city = 1;
} else {
    $v_id_city = "Garden.id_city='$id_city'";
}
if ($id_mar == 0 || $id_mar === '') {
    $v_id_mar = 1;
} else {
    $v_id_mar = "Garden.id_mar='$id_mar'";
}
if ($add_abadi == '0' || $add_abadi === '') {
    $f_add_abadi = 1;
} else {
    $f_add_abadi = "Garden.add_abadi = '$add_abadi'";
}
if ($add_city == '0' || $add_city === '') {
    $f_add_city = 1;
} else {
    $f_add_city = "Garden.add_city = '$add_city'";
}
if ($no_kesh == '0' || $no_kesh === '') {
    $f_no_kesh = 1;
} else {
    $f_no_kesh = "Garden.no_kesh = '$no_kesh'";
}
if ($mor_cod_m == '') {
    $v_mor_cod_m = 1;
} else {
    $v_mor_cod_m = "Garden.mor_cod_m = '$mor_cod_m'";
}
if ($bah_cod_m == '') {
    $v_bah_cod_m = 1;
} else {
    $v_bah_cod_m = "Garden.bah_cod_m = '$bah_cod_m'";
}
if ($z_sal == '') {
    $v_z_sal = 1;
} else {
    $v_z_sal = "Garden.z_sal = '$z_sal'";
}
if ($mah_name == '') {
    $v_cod_mah = 1;
} else {
    $v_cod_mah = "EXISTS (SELECT 1 FROM Garden_prod WHERE Garden_prod.Garden_id = Garden.id AND Garden_prod.cod_mah = '$mah_name')";
}

$query = "SELECT Garden.id, Garden.num_bah, Garden.id_ostan, Garden.id_city, Garden.id_mar, Garden.mor_cod_m, Garden.z_sal, Garden.bah_cod_m, Garden.sh_gat, Garden.no_kesh, Garden.no_mal, Garden.m_zamin, Garden.add_abadi, Garden.add_city from Garden
 where  Garden.date_s not like '%/%' and  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah
 ORDER BY Garden.bah_cod_m, Garden.sh_gat ASC ";
$stmt = $dbh->prepare($query);
$rows = array();
if ($stmt && $stmt->execute()) {
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header('Content-Disposition: attachment; filename="ویرایش_نشده.xls"');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="fa">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo isset($title) ? $title : ''; ?></title>
</head>
<body>
<div align="center">قطعات ویرایش نشده</div>
<?php if (count($rows) > 0) { ?>
<table width="95%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#00CCFF">
  <tr class="text1">
    <td bordercolor="#FFFFFF">کد ملی مروج</td>
    <td bordercolor="#FFFFFF">نام مروج</td>
    <td bordercolor="#FFFFFF">وضعیت بهره بردار</td>
    <td width="6%">مساحت زمین <span class="style2">هکتار</span></td>
    <td width="4%">نوع کشت</td>
    <td width="7%">نوع مالکیت</td>
    <td width="5%">شماره قطعه</td>
    <td width="5%">سال</td>
    <td width="8%">کد ملی</td>
    <td width="12%">نام و نام خانوادگی</td>
    <td width="9%">شهر/آبادی</td>
    <td width="3%">مرکز</td>
    <td width="7%">شهرستان</td>
    <td width="11%">استان</td>
    <td width="5%">ردیف</td>
  </tr>
<?php
$r = 1;
foreach ($rows as $row) {
    $v_no_mal = '-';
    if ($row['no_mal'] == '1') $v_no_mal = 'سند ششدانگ';
    if ($row['no_mal'] == '2') $v_no_mal = 'سند مشاعی';
    if ($row['no_mal'] == '3') $v_no_mal = 'اصلاحات اراضی';
    if ($row['no_mal'] == '4') $v_no_mal = 'موقوفه';
    if ($row['no_mal'] == '5') $v_no_mal = 'واگذاری';
    if ($row['no_mal'] == '6') $v_no_mal = 'قولنامه';
    if ($row['no_mal'] == '7') $v_no_mal = 'اجاره';
    if ($row['no_mal'] == '8') $v_no_mal = 'سایر';
    $v_no_kesh = '-';
    if ($row['no_kesh'] == '1') $v_no_kesh = 'آبی';
    if ($row['no_kesh'] == '2') $v_no_kesh = 'دیم';
    $bah_vaz = bah_vaz($row['bah_cod_m']);
    $v_bah_vaz = '';
    if ($bah_vaz == '1') $v_bah_vaz = 'زنده';
    if ($bah_vaz == '2') $v_bah_vaz = 'فوتی';
    if ($bah_vaz == '3' || $bah_vaz == '4') $v_bah_vaz = 'تایید نشده';
    $odd = ($r % 2 == 0) ? ' bgcolor="#FFFFCC"' : '';
?>
  <tr>
    <td height="23" bordercolor="#FFFFFF" class="normalTextSmall"<?php echo $odd; ?>><?php echo $row['mor_cod_m']; ?></td>
    <td bordercolor="#FFFFFF" class="normalTextSmall"<?php echo $odd; ?>><?php echo user_name1($row['mor_cod_m']); ?></td>
    <td bordercolor="#FFFFFF" class="normalTextSmall"<?php echo $odd; ?>><?php echo $v_bah_vaz; ?></td>
    <td class="normalTextSmall"<?php echo $odd; ?>><?php echo $row['m_zamin'] * 1; ?></td>
    <td class="normalTextSmall"<?php echo $odd; ?>><?php echo $v_no_kesh; ?></td>
    <td class="normalTextSmall"<?php echo $odd; ?>><?php echo $v_no_mal; ?></td>
    <td class="normalTextSmall"<?php echo $odd; ?>><?php echo $row['sh_gat']; ?></td>
    <td class="normalTextSmall"<?php echo $odd; ?>><?php echo $row['z_sal']; ?></td>
    <td height="24" class="normalTextSmall"<?php echo $odd; ?>><?php echo $row['bah_cod_m']; ?></td>
    <td class="normalTextSmall"<?php echo $odd; ?>><div align="right"><?php echo bah_name2($row['bah_cod_m'], $row['num_bah']); ?></div></td>
    <td class="normalTextSmall"<?php echo $odd; ?>><?php echo abadi_name($row['add_abadi']); echo shahr_name($row['add_city']); ?></td>
    <td align="center" bordercolor="#0099FF" class="normalTextSmall"<?php echo $odd; ?>><?php echo mar_name($row['id_mar']); ?></td>
    <td align="center" bordercolor="#0099FF" class="normalTextSmall"<?php echo $odd; ?>><?php echo city_name1($row['id_city'], $row['id_ostan']); ?></td>
    <td align="center" bordercolor="#0099FF" class="normalTextSmall"<?php echo $odd; ?>><?php echo ostan_name($row['id_ostan']); ?></td>
    <td class="normalTextSmall"<?php echo $odd; ?>><?php echo $r; ?></td>
  </tr>
<?php
    $r++;
}
?>
</table>
<?php } else { ?>
<p class="style8" align="center">اطلاعاتی یافت نشد</p>
<?php } ?>
</body>
</html>
