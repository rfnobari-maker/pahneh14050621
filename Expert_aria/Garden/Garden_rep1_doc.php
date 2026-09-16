<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Garden_rep1.doc");
include("../../lock_expar.php");
include("../../Jalali.php");
if (isset($_POST['id_ostan'])) $id_ostan= $_POST['id_ostan'] ; 
if (isset($_POST['z_sal']))    $z_sal= $_POST['z_sal'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
	text-align: center;
}
    </style>
</head>
<body>
<p dir="rtl" align="center"> گزارش اطلاعات باغی استان به تفکیک شهرستان  در سال <?php echo $z_sal?></p>
<?php
include('../../login/config.php');

// کوئری اصلی با JOIN
$main_query = "
SELECT 
    c.id_city, 
    c.city,
    -- میزان تولید
    SUM(gp.mah_tol) as kol_mah,
    SUM(CASE WHEN g.no_kesh = '2' THEN gp.mah_tol ELSE 0 END) as mah_dim,
    SUM(CASE WHEN g.no_kesh = '1' THEN gp.mah_tol ELSE 0 END) as mah_abi,
    
    -- نحوه کاشت
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '3' THEN g.id END) as nah_parakande,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '2' THEN g.id END) as nah_makhloot,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '1' THEN g.id END) as nah_sade,
    
    -- تعداد درخت
    SUM(gp.tree_b + gp.tree_gb) / 1000 as kol_darakt,
    SUM(gp.tree_gb) / 1000 as darakt_ghbar,
    SUM(gp.tree_b) / 1000 as darakt_bar,
    
    -- سطح زیر کشت
    SUM(gp.s_kesht_b + gp.s_kesht_gb) as kol_kesht,
    SUM(gp.s_kesht_gb) as kesht_ghbar,
    SUM(gp.s_kesht_b) as kesht_bar,
    
    -- تعداد قطعات باغی
    COUNT(DISTINCT g.id) as kol_garden,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '2' THEN g.id END) as garden_dim,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '1' THEN g.id END) as garden_abi
FROM 
    cityname c
LEFT JOIN 
    Garden g ON c.id_city = g.id_city AND g.id_ostan = :id_ostan AND g.z_sal = :z_sal
LEFT JOIN 
    Garden_prod gp ON g.id = gp.garden_id
WHERE 
    c.id_ostan = :id_ostan
GROUP BY 
    c.id_city, c.city
ORDER BY 
    c.id_city";

// اجرای کوئری اصلی
$stmt = $dbh->prepare($main_query);
$stmt->execute(array(':id_ostan' => $id_ostan, ':z_sal' => $z_sal));
$city_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// کوئری برای جمع کل استان
$total_query = "
SELECT 
    SUM(gp.mah_tol) as kol_mah,
    SUM(CASE WHEN g.no_kesh = '2' THEN gp.mah_tol ELSE 0 END) as mah_dim,
    SUM(CASE WHEN g.no_kesh = '1' THEN gp.mah_tol ELSE 0 END) as mah_abi,
    
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '3' THEN g.id END) as nah_parakande,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '2' THEN g.id END) as nah_makhloot,
    COUNT(DISTINCT CASE WHEN g.nah_kesh = '1' THEN g.id END) as nah_sade,
    
    SUM(gp.tree_b + gp.tree_gb) / 1000 as kol_darakt,
    SUM(gp.tree_gb) / 1000 as darakt_ghbar,
    SUM(gp.tree_b) / 1000 as darakt_bar,
    
    SUM(gp.s_kesht_b + gp.s_kesht_gb) as kol_kesht,
    SUM(gp.s_kesht_gb) as kesht_ghbar,
    SUM(gp.s_kesht_b) as kesht_bar,
    
    COUNT(DISTINCT g.id) as kol_garden,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '2' THEN g.id END) as garden_dim,
    COUNT(DISTINCT CASE WHEN g.no_kesh = '1' THEN g.id END) as garden_abi
FROM 
    Garden g
JOIN 
    Garden_prod gp ON g.id = gp.garden_id
WHERE 
    g.id_ostan = :id_ostan AND g.z_sal = :z_sal";

$stmt = $dbh->prepare($total_query);
$stmt->execute(array(':id_ostan' => $id_ostan, ':z_sal' => $z_sal));
$total_data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<table width="100%" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0">
  <thead class="fixedHeader">
    <tr align="center" class="alternateRow">
      <td height="38" colspan="3" bgcolor="#999999">میزان تولید<br />
        <span class="style2">تن</span></td>
      <td colspan="3" bgcolor="#999999">نحوه کاشت<br /></td>
      <td colspan="3" bgcolor="#999999">تعداد درخت<br />
        <span class="style2">هزار اصله</span></td>
      <td colspan="3" bgcolor="#999999">سطح زیر کشت<br />
        <span class="style2">هکتار</span></td>
      <td height="38" colspan="3" bgcolor="#999999">تعداد قطعات باغی<br />
        <span class="style2">قطعه</span></td>
      <td width="7%" rowspan="2" bgcolor="#999999">شهرستان</td>
      <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
    <tr align="center" class="text1">
      <td height="21" bgcolor="#999999">کل</td>
      <td bgcolor="#999999">دیم</td>
      <td bgcolor="#999999">آبی</td>
      <td width="5%" height="21" bgcolor="#999999">پراکنده</td>
      <td width="6%" bgcolor="#999999">مخلوط</td>
      <td width="5%" bgcolor="#999999">ساده</td>
      <td height="21" bgcolor="#999999">کل</td>
      <td bgcolor="#999999">غیربارور</td>
      <td bgcolor="#999999">بارور</td>
      <td height="21" bgcolor="#999999">کل</td>
      <td bgcolor="#999999">غیربارور</td>
      <td width="6%" bgcolor="#999999">بارور</td>
      <td width="6%" height="21" bgcolor="#999999">کل</td>
      <td width="5%" bgcolor="#999999">دیم</td>
      <td width="5%" bgcolor="#999999">آبی</td>
    </tr>
  </thead>
  <tbody>
    <?php
        $r = 1;
        foreach ($city_data as $row) {
            $bgcolor = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : '';
        ?>
    <tr>
      <!-- میزان تولید -->
      <td align="center"<?= $bgcolor ?> width="5%" height="26"><?= round($row['kol_mah']*1, 1) ?></td>
      <td align="center"<?= $bgcolor ?> width="5%"><?= Num2Fa(round($row['mah_dim']*1, 1)) ?></td>
      <td align="center"<?= $bgcolor ?> width="5%"><?= Num2Fa(round($row['mah_abi']*1, 1)) ?></td>
      <!-- نحوه کاشت -->
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($row['nah_parakande']) ?></td>
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($row['nah_makhloot']) ?></td>
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($row['nah_sade']) ?></td>
      <!-- تعداد درخت -->
      <td align="center"width="6%" <?= $bgcolor ?>><?= Num2Fa(round($row['kol_darakt'], 1)) ?></td>
      <td align="center"width="6%" <?= $bgcolor ?>><?= Num2Fa(round($row['darakt_ghbar'], 1)) ?></td>
      <td align="center"width="7%" <?= $bgcolor ?>><?= Num2Fa(round($row['darakt_bar'], 1)) ?></td>
      <!-- سطح زیر کشت -->
      <td align="center"width="6%" <?= $bgcolor ?>><?= Num2Fa(round($row['kol_kesht'], 1)) ?></td>
      <td align="center"width="6%" <?= $bgcolor ?>><?= Num2Fa(round($row['kesht_ghbar'], 1)) ?></td>
      <td align="center"<?= $bgcolor ?>><?= Num2Fa(round($row['kesht_bar'], 1)) ?></td>
      <!-- تعداد قطعات باغی -->
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($row['kol_garden']) ?></td>
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($row['garden_dim']) ?></td>
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($row['garden_abi']) ?></td>
      <td align="center"<?= $bgcolor ?>><?= $row['city'] ?></td>
      <td align="center"<?= $bgcolor ?>><?= $r ?></td>
    </tr>
    <?php
            $r++;
        }
        ?>
    <!-- ردیف جمع کل استان -->
    <tr>
      <?php
            $bgcolor = ($r % 2 == 0) ? 'bgcolor="#FFFFCC"' : '';
            ?>
      <!-- میزان تولید -->
      <td align="center"<?= $bgcolor ?> width="5%" height="27"><?= Num2Fa(round($total_data['kol_mah']*1, 1)) ?></td>
      <td align="center"<?= $bgcolor ?> width="5%"><?= Num2Fa(round($total_data['mah_dim']*1, 1)) ?></td>
      <td align="center"<?= $bgcolor ?> width="5%"><?= Num2Fa(round($total_data['mah_abi']*1, 1)) ?></td>
      <!-- نحوه کاشت -->
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($total_data['nah_parakande']) ?></td>
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($total_data['nah_makhloot']) ?></td>
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($total_data['nah_sade']) ?></td>
      <!-- تعداد درخت -->
      <td align="center"width="6%" <?= $bgcolor ?>><?= Num2Fa(round($total_data['kol_darakt'], 1)) ?></td>
      <td align="center"width="6%" <?= $bgcolor ?>><?= Num2Fa(round($total_data['darakt_ghbar'], 1)) ?></td>
      <td align="center"width="7%" <?= $bgcolor ?>><?= Num2Fa(round($total_data['darakt_bar'], 1)) ?></td>
      <!-- سطح زیر کشت -->
      <td align="center"width="6%" <?= $bgcolor ?>><?= Num2Fa(round($total_data['kol_kesht'], 1)) ?></td>
      <td align="center"width="6%" <?= $bgcolor ?>><?= Num2Fa(round($total_data['kesht_ghbar'], 1)) ?></td>
      <td align="center"<?= $bgcolor ?>><?= Num2Fa(round($total_data['kesht_bar'], 1)) ?></td>
      <!-- تعداد قطعات باغی -->
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($total_data['kol_garden']) ?></td>
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($total_data['garden_dim']) ?></td>
      <td align="center"<?= $bgcolor ?>><?= Num2Fa($total_data['garden_abi']) ?></td>
      <td align="center"colspan="2" class="style1" <?= $bgcolor ?>>کل استان</td>
    </tr>
  </tbody>
</table>
</div>
<p align="center"> -------------- پایان گزارش --------------</p>         
</body>
</html>



