<?php 
session_start();
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Greenhous_prod.xls");
?>
<?php 
include('../../lock_ce.php');
include('../../event.php') ;

if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city']))  $id_city   = $_POST['id_city'] ;
if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ; 
if(isset($_POST['add_abadi']))
{
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $y_prod = $_POST['y_prod'] ;
 $no_kesht = $_POST['no_kesht'] ;
 $no_mtol = $_POST['no_mtol'] ;
 $m_fani = $_POST['m_fani'] ;
 $v_unit = $_POST['v_unit'] ;
}

 if ($id_ostan1 == '-1') { $v_id_ostan = 1  ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      { $v_id_city = 1   ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      { $v_id_mar = 1    ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') { $f_add_abadi= 1  ;} else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city= 1   ;} else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($mor_cod_m == '')   { $v_mor_cod_m=1   ;}else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')   { $v_bah_cod_m=1   ;}else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($v_unit == '')      { $f_v_unit  = 1   ;}else{ $f_v_unit = "v_unit = '$v_unit'" ;}
 if ($m_fani == '')      { $f_m_fani  = 1   ;}else{ $f_m_fani = "m_fani = '$m_fani'" ;}
 if ($no_mtol == '')     { $f_no_mtol = 1   ;}else{ $f_no_mtol   = "no_mtol = '$no_mtol'" ;} 
 if ($no_kesht == '')    { $f_no_kesht= 1   ;}else{ $f_no_kesht = "no_kesht = '$no_kesht'" ;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    </style>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

-->
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
<tr>
  <td>
      <?php 
include ('../../login/config.php');
  $query = "select * from Greenhous_prod
where  $v_id_ostan and $f_no_kesht and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and y_prod = '$y_prod'
 and $f_no_mtol  and $f_v_unit and $f_m_fani and $v_bah_cod_m and $v_mor_cod_m  ORDER BY bah_cod_m "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
      </p>
         <table width="98%"  border="1" align="center" cellpadding="1" cellspacing="1" >
           <tr align="center" class="text_r">
             <td rowspan="2" valign="middle" bgcolor="#999999">همراه مروج</td>
             <td rowspan="2" valign="middle" bgcolor="#999999"> کد ملی مروج</td>
             <td rowspan="2" valign="middle" bgcolor="#999999">کد ملی کارشناس مروج </td>
             <td colspan="5" bgcolor="#999999"> میزان بستر استفاده شده در کشت هیدروپونیک / <span class="style2">تن یا مترمکعب</span><br /></td>
             <td colspan="2" bgcolor="#FFCCCC"> استفاده از شکارگرها و گرده افشان ها</td>
             <td colspan="2" bgcolor="#CCCCFF">نشاء مصرفی</td>
             <td colspan="2" bgcolor="#CCCCFF">بذر مصرفی</td>
             <td colspan="2" bgcolor="#FFCC99">گازوئیل مصرفی</td>
             <td colspan="2" bgcolor="#FFCC99">بنزین مصرفی</td>
             <td colspan="2" bgcolor="#FFCC99">آب مصرفی</td>
             <td colspan="2" bgcolor="#99FFCC">سایر کود های بیولوژیکی</td>
             <td colspan="2" bgcolor="#99FFCC">مایکوروت</td>
             <td colspan="2" bgcolor="#99FFCC">فسفات بارو</td>
             <td colspan="2" bgcolor="#CCCCCC">سایر کود های شیمیایی</td>
             <td colspan="2" bgcolor="#CCCCCC">کود پتاس </td>
             <td colspan="2" bgcolor="#CCCCCC">کود فسفات</td>
             <td colspan="2" bgcolor="#9999CC">سایر کود های حیوانی</td>
             <td colspan="2" bgcolor="#9999CC">کود مرغی </td>
             <td colspan="2" bgcolor="#9999CC">کود گوسفندی</td>
             <td colspan="2" bgcolor="#FF9933">ضد عفونی مایع </td>
             <td colspan="2" bgcolor="#FF9933">ضد عفونی جامد</td>
             <td colspan="2" bgcolor="#FF9933">حشره کش مایع </td>
             <td colspan="2" bgcolor="#FF9933">حشره کش جامد</td>
             <td colspan="2" bgcolor="#FF9933">قارچ کش مایع </td>
             <td colspan="2" bgcolor="#FF9933">قارچ کش جامد</td>
             <td colspan="6" bgcolor="#33CCCC">وضعیت شاغلین واحد</td>
             <td width="6%" rowspan="2" bgcolor="#999999">نوع کشت</td>
             <td width="6%" rowspan="2" bgcolor="#999999"> نوع محصول تولیدی</td>
             <td width="6%" rowspan="2" bgcolor="#999999">وضعیت واحد</td>
    <td width="6%" rowspan="2" bgcolor="#999999">سال</td>
    <td width="6%" rowspan="2" bgcolor="#999999">شماره همراه</td>
    <td width="6%" rowspan="2" bgcolor="#999999"> کد ملی<br /></td>
    <td width="7%" rowspan="2" bgcolor="#999999">نام خانوادگی</td>
    <td width="7%" rowspan="2" bgcolor="#999999">نام</td>
    <td width="2%" rowspan="2" bgcolor="#999999">نام آبادی</td>
    <td width="3%" rowspan="2" bgcolor="#999999">آدرس آماری آبادی </td>
    <td width="5%" rowspan="2" bgcolor="#999999">نام شهر</td>
    <td width="5%" rowspan="2" bgcolor="#999999">آدرس آماری شهر</td>
    <td width="5%" rowspan="2" bgcolor="#999999">شهرستان </td>
    <td width="5%" rowspan="2" bgcolor="#999999">استان</td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
           <tr align="center" class="text_r">
             <td  bordercolor="#0099CC" bgcolor="#999999">سایر</td>
             <td  bordercolor="#0099CC" bgcolor="#999999">پالم پیت</td>
             <td  bordercolor="#0099CC" bgcolor="#999999">پرلیت</td>
             <td  bordercolor="#0099CC" bgcolor="#999999">پیت ماس</td>
             <td  bordercolor="#0099CC" bgcolor="#999999">کوکوپیت</td>
             <td  bordercolor="#0099CC" bgcolor="#FFCCCC">زنبور  /<span class="style2">عدد</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FFCCCC">حشرات/<span class="style2">عدد</span></td>
             <td  bordercolor="#0099CC" bgcolor="#CCCCFF">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#CCCCFF">تعداد/<span class="style2">عدد</span></td>
             <td  bordercolor="#0099CC" bgcolor="#CCCCFF">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#CCCCFF">مقدار/<span class="style2">کیلوگرم/عدد</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FFCC99">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FFCC99">مقدار/<span class="style2">لیتر</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FFCC99">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FFCC99">مقدار/<span class="style2">لیتر</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FFCC99">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FFCC99">مقدار/<span class="style2">مترمکعب</span></td>
             <td  bordercolor="#0099CC" bgcolor="#99FFCC">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#99FFCC">مقدار/<span class="style2">کیلوگرم</span></td>
             <td  bordercolor="#0099CC" bgcolor="#99FFCC">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#99FFCC">مقدار/<span class="style2">کیلوگرم</span></td>
             <td  bordercolor="#0099CC" bgcolor="#99FFCC">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#99FFCC">مقدار/<span class="style2">کیلوگرم</span></td>
             <td  bordercolor="#0099CC" bgcolor="#CCCCCC">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#CCCCCC">مقدار/<span class="style2">کیلوگرم</span></td>
             <td  bordercolor="#0099CC" bgcolor="#CCCCCC">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#CCCCCC">مقدار/<span class="style2">کیلوگرم</span></td>
             <td  bordercolor="#0099CC" bgcolor="#CCCCCC">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#CCCCCC">مقدار/<span class="style2">کیلوگرم</span></td>
             <td  bordercolor="#0099CC" bgcolor="#9999CC">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#9999CC">مقدار/<span class="style2">تن</span></td>
             <td  bordercolor="#0099CC" bgcolor="#9999CC">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#9999CC">مقدار/<span class="style2">تن</span></td>
             <td  bordercolor="#0099CC" bgcolor="#9999CC">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#9999CC">مقدار/<span class="style2">تن</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">مقدار/<span class="style2">لیتر</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">مقدار/<span class="style2">کیلوگرم</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">مقدار/<span class="style2">لیتر</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">مقدار/<span class="style2">کیلوگرم</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">مقدار/<span class="style2">لیتر</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">ارزش /<span class="style2">ریال</span></td>
             <td  bordercolor="#0099CC" bgcolor="#FF9933">مقدار/<span class="style2">کیلوگرم</span></td>
             <td  bordercolor="#0099CC" bgcolor="#33CCCC">مسئول فنی<span class="style2"></span></td>
             <td bordercolor="#0099CC" bgcolor="#33CCCC">تعداد شاغل زن/ <span class="style2">نفر</span></td>
             <td bordercolor="#0099CC" bgcolor="#33CCCC">تعداد شاغل مرد/ <span class="style2">نفر</span></td>
             <td bordercolor="#0099CC" bgcolor="#33CCCC">لیسانس یا بالاتر/ <span class="style2">نفر</span></td>
             <td bordercolor="#0099CC" bgcolor="#33CCCC">دیپلم و بالاتر / <span class="style2">نفر</span></td>
             <td bordercolor="#0099CC" bgcolor="#33CCCC">زیردیپلم/ <span class="style2">نفر</span></td>
           </tr>
    <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($row['v_unit']=='1') $v_v_unit = 'فعال' ;
if ($row['v_unit']=='2') $v_v_unit = 'در حال اخذ پروانه تاسیس';
if ($row['v_unit']=='3') $v_v_unit = 'دارای پیشرفت فیزیکی';
if ($row['v_unit']=='4') $v_v_unit = 'غیرفعال';

if ($row['m_fani']=='1')  $v_m_fani='دارد';
if ($row['m_fani']=='2')  $v_m_fani='ندارد';

if($row['no_kesht']=="1")  $v_no_kesht = 'گلخانه'  ;
if($row['no_kesht']=="2")  $v_no_kesht = 'فضای باز' ;

if ($row['no_mtol']=='211100')  $v_no_mtol='سبزی و صیفی';
if ($row['no_mtol']=='211300')  $v_no_mtol='گل و گیاه زینتی';
if ($row['no_mtol']=='211200')  $v_no_mtol='سایر' ;	 
 

//echo $row2['User_Name'] ; 
?>
  <tr>
    <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m']) ?></td>
    <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
    <td height="37"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['mor_cod_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['b_say']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['b_pet']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['b_per']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['b_mas']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['b_coco']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['t_zgard']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['t_hshekar']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['nesha_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['nesha_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['bazr_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['bazr_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['gazoil_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['gazoil_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['benz_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['benz_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['ab_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['ab_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_bio3_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_bio3_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_bio2_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_bio2_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_bio1_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_bio1_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_sh3_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_sh3_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_sh2_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_sh2_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_sh1_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_sh1_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_h3_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_h3_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_h2_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_h2_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_h1_a']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['kod_h1_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['zof_ma']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['zof_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['zof_ja']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['zof_j']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['hash_ma']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['hash_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['hash_ja']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['hash_j']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['gar_ma']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['gar_m']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['gar_ja']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['gar_j']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_m_fani ; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['t_zan']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['t_mar']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['lisan']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['dep']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_dep']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_kesht ; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mtol ; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_v_unit?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['y_prod']; ?></span></td>
 <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo bah_tel_m($row['bah_cod_m']);?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_last_name($row['bah_cod_m'])?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_first_name($row['bah_cod_m'])?></span></td>
    <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?></td>
    <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo '"'.$row['add_abadi'].'"' ?></td>
    <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city']) ?></td>
    <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_city'] ?></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo ostan_name($row['id_ostan']);  ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>