<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_واحدهای_دامداری.xls");
include('../../lock_ce.php');
include('../../event.php');
        $sal = isset($_POST['sal']) ? $_POST['sal'] : null;
        $id_ostan1 = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : null;
        $id_city = isset($_POST['id_city']) ? $_POST['id_city'] : null;
        $id_mar = isset($_POST['id_mar']) ? $_POST['id_mar'] : null;
        $add_abadi = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : null;
        $add_city = isset($_POST['add_city']) ? $_POST['add_city'] : null;
        $no_moj = isset($_POST['no_moj']) ? $_POST['no_moj'] : null;
        $vaz_s = isset($_POST['vaz_s']) ? $_POST['vaz_s'] : null;
        $no_fa = isset($_POST['no_fa']) ? $_POST['no_fa'] : null;
        $bah_cod_m = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : null;
        $PartIdCode = isset($_POST['PartIdCode']) ? $_POST['PartIdCode'] : null;
        $mor_cod_m = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
 <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="840" >
<?php
 if ($id_ostan1 == '-1')    { $v_id_ostan   = 1 ;}else{ $v_id_ostan  = "au.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)         { $v_id_city    = 1 ;}else{ $v_id_city   = "au.id_city='$id_city'" ;}
 if ($mor_cod_m == '')      { $v_mor_cod_m  = 1 ;}else{ $v_mor_cod_m = "au.mor_cod_m = '$mor_cod_m'" ;}
 if ($id_mar  == 0)         { $v_id_mar     = 1 ;}else{ $v_id_mar    = "au.id_mar='$id_mar'" ;}
 if ($add_abadi == '') { $v_add_abadi = 1; }else { $v_add_abadi = "au.add_abadi = '$add_abadi'" ;}
 if ($PartIdCode == '') { $v_PartIdCode = 1; }else { $v_PartIdCode = "au.PartIdCode = '$PartIdCode'" ;}
 if ($add_city == '')  { $v_add_city  = 1 ; }else{ $v_add_city = "au.add_city = '$add_city'" ;}
 if ($vaz_s == '')  { $f_vaz_s  = 1  ; }else{ $f_vaz_s = "au.vaz_s = '$vaz_s'" ;}
 if ($no_fa == '')  { $f_no_fa  = 1  ; }else{ $f_no_fa = "au.unit_types = '$no_fa'" ;}
 if ($no_moj == '')  { $f_no_moj  = 1  ; }else{ $f_no_moj = "au.license_status = '$no_moj'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "au.bah_cod_m = '$bah_cod_m'" ;}
 include('../../login/config.php');
$query = "SELECT 
    SUM(CASE WHEN an.species = '1' THEN an.quantity ELSE 0 END) AS kol_1,
    SUM(CASE WHEN an.species = '2' THEN an.quantity ELSE 0 END) AS kol_2,
    SUM(CASE WHEN an.species = '3' THEN an.quantity ELSE 0 END) AS kol_3,
    SUM(CASE WHEN an.species = '4' THEN an.quantity ELSE 0 END) AS kol_4,
    SUM(CASE WHEN an.species = '5' THEN an.quantity ELSE 0 END) AS kol_5,
    SUM(CASE WHEN an.species = '6' THEN an.quantity ELSE 0 END) AS kol_6,
    SUM(CASE WHEN an.species = '7' THEN an.quantity ELSE 0 END) AS kol_7,
    SUM(CASE WHEN an.species = '8' THEN an.quantity ELSE 0 END) AS kol_8,
    SUM(CASE WHEN an.species = '9' THEN an.quantity ELSE 0 END) AS kol_9,
    au.*
FROM 
    animals_unit au
INNER JOIN 
    animals an 
ON 
    au.PartIdCode = an.PartIdCode
WHERE 
    an.sal = '$sal' 
	and  $v_mor_cod_m and $v_id_ostan and $v_id_city and $v_id_mar and $v_add_abadi and $v_add_city and $f_vaz_s and $v_bah_cod_m and $v_PartIdCode and $f_no_fa and $f_no_moj
	GROUP BY an.PartIdCode 
ORDER BY PartIdCode ASC   "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<table width="98%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" >
  <tr class="text1">
    <td align="center" bordercolor="#0099FF" bgcolor="#006699" class="text1">همراه مروج</td>
    <td align="center" bordercolor="#0099FF" bgcolor="#006699" class="text1"> کد ملی مروج</td>
    <td align="center" bordercolor="#0099FF" bgcolor="#006699" class="text1">نام مروج</td>
    <td width="5%" bgcolor="#006699">سگ</td>
    <td width="5%" bgcolor="#006699">قاطر</td>
    <td width="10%" bgcolor="#006699">استر</td>
    <td width="10%" bgcolor="#006699">اسب</td>
    <td width="10%" bgcolor="#006699">بز</td>
    <td width="10%" bgcolor="#006699">گوسفند</td>
    <td width="10%" bgcolor="#006699">شتر</td>
    <td width="10%" bgcolor="#006699">گاومیش</td>
    <td width="10%" bgcolor="#006699">گاو</td>
    <td width="10%" bgcolor="#006699">اطلاعات پلیگون</td>
    <td width="10%" bgcolor="#006699">عرض جغرافیایی</td>
          <td width="10%" bgcolor="#006699">طول جغرافیایی</td>
          <td width="10%" bgcolor="#006699">تاریخ اعتبار مجوز</td>
          <td width="6%" bgcolor="#006699">ظرفیت گله / اسمی</td>
          <td width="10%" bgcolor="#006699">شماره مجوز</td>
          <td width="10%" bgcolor="#006699">وضعیت مجوز</td>
          <td width="7%" bgcolor="#006699">نوع فعالیت</td>
          <td width="9%" bgcolor="#006699">نوع واحد</td>
          <td width="9%" bgcolor="#006699">کد اپیدمیولوژیک</td>
          <td width="9%" bgcolor="#006699">شناسه یکتا</td>
          <td width="8%" bgcolor="#006699">کد ملی بهره بردار</td>
          <td width="13%" bgcolor="#006699">نام و نام خانوادگی بهره بردار</td>
          <td align="center" bordercolor="#0099FF" bgcolor="#006699" class="text1">نام آبادی </td>
          <td align="center" bordercolor="#0099FF" bgcolor="#006699" class="text1">آدرس آماری آبادی </td>
          <td align="center" bordercolor="#0099FF" bgcolor="#006699" class="text1">نام شهر </td>
          <td align="center" bordercolor="#0099FF" bgcolor="#006699" class="text1">آدرس آماری شهر</td>
          <td align="center" bordercolor="#0099FF" bgcolor="#006699" class="text1">تاریخ ثبت / ویرایش</td>
        <td width="13%" bgcolor="#006699">مرکز</td>
          <td width="13%" bgcolor="#006699">شهرستان</td>
          <td width="12%" bgcolor="#006699">استان</td>
          <td width="3%" bgcolor="#006699">ردیف</td>
      </tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
 $v_no_fa= translateUnitType($row['unit_types']) ; 
 $v_no_moj=translateLicenseStatus($row['license_status']);
  ?>
        <tr>
          <td height="47" align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m']) ?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name1($row['mor_cod_m']) ?></td>
          <td height="47" bordercolor="#0066CC"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_9']?></td>
          <td height="47" bordercolor="#0066CC"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_8']?></td>
          <td height="47" bordercolor="#0066CC"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_7']?></td>
          <td height="47" bordercolor="#0066CC"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_6']?></td>
          <td height="47" bordercolor="#0066CC"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_5']?></td>
          <td height="47" bordercolor="#0066CC"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_4']?></td>
          <td height="47" bordercolor="#0066CC"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_3']?></td>
          <td height="47" bordercolor="#0066CC"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_2']?></td>
          <td height="47" bordercolor="#0066CC"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_1']?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['coordinates']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['latitude']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['longitude']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['validityDate']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['capacity']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['docNum']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_moj?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['Product_Name']?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_fa?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo '&nbsp;'.$row['epidemiologic']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo '&nbsp;'.$row['PartIdCode']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['bah_cod_m'],$row['num_bah'])?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo '&nbsp;'.$row['add_abadi'] ?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city']) ?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_city'] ?></td>
          <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
 	?>
    </table>
 
</body>
</html><?php
function translateUnitType($unitType) {
    $unitTypes = array(
        1  => 'واحد پرواربندی گاو',
        2  => 'واحد پرورش گاو شيري',
        3  => 'واحد پرورش گاوميش داشتی',
        4  => 'واحد پرواربندی گوسفند',
        5  => 'واحد پرورش گوسفند داشتي',
        6  => 'واحد پرورش بز',
        7  => 'واحد پرورش اسب',
        8  => 'واحد پرورش گوزن',
        9  => 'واحد پرورش شتر داشتی',
        10 => 'واحد پرورش لاما',
        11 => 'واحد پرورش سگ(گله، پليس، نگهبان و...)',
        13 => 'واحد پرورش حيوانات آزمايشگاهي(موش، خوكچه هندي، هامستر و...)',
        15 => 'واحد پرورش دام چند منظوره',
        16 => 'واحد پروش دام روستايی',
        19 => 'واحد پرورش دام مستقر در مجتمع دامپروري',
        20 => 'واحد پرواربندی گاوميش',
        21 => 'واحد پرواربندی شتر',
        22 => 'واحد پرورش آهو و جبير',
        23 => 'واحد پرورش مارال',
        24 => 'واحد پرورش كل و بز',
        25 => 'واحد پرورش قوچ و ميش',
        26 => 'واحد پرورش الاغ شيري',
        27 => 'واحد پرورش روباه (توليد پوست)',
        28 => 'واحد پرورش خرگوش',
        29 => 'واحد پروش دام غیر صنعتی',
        30 => 'واحد پرورش دام مستقر در مجموعه دامپروري',
    	101=> 'دام صنعتی و نیمه صنعتی' ,
		110=> 'دامداری عشایری' ,
		111=> 'دامداری روستایی و غیرصنعتی'

    );
    // بازگشت ترجمه کد واحد
    return isset($unitTypes[$unitType]) ? $unitTypes[$unitType] : 'نوع واحد نامشخص';
}

// تابع برای ترجمه وضعیت پروانه
function translateLicenseStatus($licenseStatus) {
    $status = array(
        1 => 'دارای پروانه/ مجوز',
        2 => 'فاقد پروانه/ مجوز'
    );

    // بازگشت ترجمه کد وضعیت پروانه
    return isset($status[$licenseStatus]) ? $status[$licenseStatus] : 'وضعیت نامشخص';
}

?>
 <?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>