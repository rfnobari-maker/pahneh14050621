<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=مددکاران_تسهیلگران.xls");
include('../../../lock_oce.php');
include('../../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city5'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $sal_z = $_POST['sal_z'] ;
 $cod_m = $_POST['cod_m'] ;
 $jens = $_POST['jens'] ;
 $v_tah = $_POST['v_tah'] ;
 $g_tah = $_POST['g_tah'] ;
 $z_fa1 = $_POST['z_fa1'] ;
 $z_fa2 = $_POST['z_fa2'] ;
 $no_oz = $_POST['no_oz'] ;
 $oz_ta = $_POST['oz_ta'] ;
 $no_ham = $_POST['no_ham'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
<style type="text/css">
#content
{
	width: 900px;
	margin: 0 auto;
	font-family:Arial, Helvetica, sans-serif;
}
.page
{
float: right;
margin: 0;
padding: 0;
}
.page li
{
	list-style: none;
	display:inline-block;
}
.page li a, .current
{
display: block;
padding: 5px;
text-decoration: none;
color: #8A8A8A;
}
.current
{
	font-weight:bold;
	color: #000;
}
.button
{
padding: 5px 15px;
text-decoration: none;
background: #333;
color: #F3F3F3;
font-size: 13PX;
border-radius: 2PX;
margin: 0 4PX;
display: block;
float: left;
}
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
<tr>
  <td width="840" >
    <p align="center"  class="style8">گزارش اطلاعات مددکاران ترویجی / تسهیلگران 
      <?php
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($cod_m == '')  { $v_cod_m  = 1 ; }else{ $v_cod_m = "cod_m = '$cod_m'" ;}
 if ($sal_z == '')  { $v_sal_z  = 1  ; }else{ $v_sal_z = "sal_z = '$sal_z'" ;}
 if ($jens == '0')  { $v_jens  = 1  ; }else{ $v_jens = "jens = '$jens'" ;}
 if ($v_tah == '0')  { $v_v_tah  = 1  ; }else{ $v_tah = "v_tah = '$v_tah'" ;}
 if ($g_tah == '0')  { $v_g_tah  = 1  ; }else{ $v_g_tah = "g_tah = '$g_tah'" ;}
 if ($z_fa1 == '0')  { $v_z_fa1  = 1  ; }else{ $v_z_fa1 = "z_fa1 = '$z_fa1'" ;}
 if ($z_fa2 == '0')  { $v_z_fa2  = 1  ; }else{ $v_z_fa2 = "z_fa2 = '$z_fa2'" ;}
 if ($no_oz == '0')  { $v_no_oz  = 1  ; }else{ $v_no_oz = "no_oz = '$no_oz'" ;}
 if ($oz_ta == '0')  { $v_oz_ta  = 1  ; }else{ $v_oz_ta = "oz_ta = '$oz_ta'" ;}
 if ($no_ham == '0') { $v_no_ham  = 1 ; }else{ $v_no_ham = "no_ham = '$no_ham'" ;}
 include('../../../login/config.php');
 $query = "SELECT * from Eworker where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $v_cod_m and  $v_sal_z  and $v_jens and $v_v_tah and $v_g_tah and $v_z_fa1 and $v_z_fa2 and $v_no_oz and $v_oz_ta   and $v_no_ham ORDER BY cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
    <br />
</p>
    <table width="95%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
              <tr class="text1">
                <td width="16%" bordercolor="#0099CC" bgcolor="#CCCCCC">آدرس محل سکونت</td>
                <td width="4%" bordercolor="#0099CC" bgcolor="#CCCCCC">نام تشکل / تعاونی</td>
                <td width="4%" bordercolor="#0099CC" bgcolor="#CCCCCC">عضو تعاونی</td>
                <td width="4%" height="28" bordercolor="#0099CC" bgcolor="#CCCCCC">نوع عضویت</td>
                <td width="4%" bordercolor="#0099CC" bgcolor="#CCCCCC">نوع همکاری</td>
                <td width="4%" bordercolor="#0099CC" bgcolor="#CCCCCC">زمینه فعالیت دو</td>
                <td width="4%" bordercolor="#0099CC" bgcolor="#CCCCCC">زمینه فعالیت یک</td>
                <td width="5%" bordercolor="#0099CC" bgcolor="#CCCCCC">گرایش تحصیلی</td>
          <td width="5%" bordercolor="#0099CC" bgcolor="#CCCCCC">رشته تحصیلی</td>
          <td width="3%" bordercolor="#0099CC" bgcolor="#CCCCCC">سال جذب</td>
          <td width="5%" bgcolor="#CCCCCC">فاصله محل استقرار تا مرکز/Km</td>
          <td width="3%" bgcolor="#CCCCCC">تعداد افراد تحت تکفل</td>
          <td width="3%" bgcolor="#CCCCCC">تلفن همراه</td>
          <td width="5%" bgcolor="#CCCCCC">کد شناسایی</td>
          <td width="4%" bgcolor="#CCCCCC">تاریخ تولد</td>
          <td width="4%" bgcolor="#CCCCCC">جنسیت</td>
          <td width="3%" bgcolor="#CCCCCC"><span class="text1"> کد ملی</span></td>
          <td width="5%" bgcolor="#CCCCCC">نام و نام خانوادگی</td>
          <td width="3%" bordercolor="#0099CC" bgcolor="#CCCCCC">شهر / آبادی</td>
          <td width="5%" bordercolor="#0099CC" bgcolor="#CCCCCC">مرکز جهاد کشاورزی</td>
          <td width="5%" bordercolor="#0099CC" bgcolor="#CCCCCC">شهرستان</td>
          <td width="6%" bordercolor="#0099CC" bgcolor="#CCCCCC">استان</td>
          <td width="4%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['g_tah']=='1') $f_g_tah='امور دام ' ;	 
if ($row['g_tah']=='2') $f_g_tah='دامپزشکی' ;	 
if ($row['g_tah']=='3') $f_g_tah='زراعت و باغبانی' ;	 
if ($row['g_tah']=='4') $f_g_tah='شیلات و آبزیان' ;	 
if ($row['g_tah']=='5') $f_g_tah='منابع طبیعی و آبخیزداری' ;	 
if ($row['g_tah']=='6') $f_g_tah='آب و خاک' ;	 
if ($row['g_tah']=='7') $f_g_tah='مکانیزاسیون کشاورزی' ;	 
if ($row['g_tah']=='8') $f_g_tah='صنایع تبدیلی و تکمیلی' ;	 
if ($row['g_tah']=='9') $f_g_tah='ترویج و آموزش کشاورزی' ;	 
if ($row['g_tah']=='10') $f_g_tah='غیر کشاورزی' ;	 
if ($row['g_tah']=='11') $f_g_tah='اعلام نشده' ;	 
if ($row['g_tah']=='12') $f_g_tah='فاقد مدرک دانشگاهی' ;	 

if ($row['no_ham']=='1') $f_no_ham='مددکار' ;	 
if ($row['no_ham']=='2') $f_no_ham='تسهیلگر' ;	 

if ($row['no_oz']=='1') $f_no_oz='فعال' ;	 
if ($row['no_oz']=='2') $f_no_oz='غیرفعال' ;	 
if ($row['jens']=='1') $f_jens='مرد' ;	 
if ($row['jens']=='2') $f_jens='زن' ;	 
if ($row['oz_ta']=='1') $f_oz_ta='بلی' ;	 
if ($row['oz_ta']=='2') $f_oz_ta='خیر' ;	 

if ($row['z_fa1']=='1') $f_z_fa1='زراعت' ;	 
if ($row['z_fa1']=='2') $f_z_fa1='باغبانی' ;	 
if ($row['z_fa1']=='3') $f_z_fa1='پرورش دام سبک و سنگین' ;	 
if ($row['z_fa1']=='4') $f_z_fa1='پرورش طیور' ;	 
if ($row['z_fa1']=='5') $f_z_fa1='پرورش زنبورعسل' ;	 
if ($row['z_fa1']=='6') $f_z_fa1='نوغانداری' ;	 
if ($row['z_fa1']=='7') $f_z_fa1='شیلات و آبزیان' ;	 
if ($row['z_fa1']=='8') $f_z_fa1='صید و صیادی' ;	 
if ($row['z_fa1']=='9') $f_z_fa1='جنگل و مرتع' ;	 
if ($row['z_fa1']=='10') $f_z_fa1='آبخیزداری' ;	 
if ($row['z_fa1']=='11') $f_z_fa1='صنایع تبدیلی' ;	 
if ($row['z_fa1']=='12') $f_z_fa1='صنایع و مشاغل خانگی' ;	 
if ($row['z_fa1']=='13') $f_z_fa1='خدمات اجتماعی' ;	 

if ($row['z_fa2']=='1') $f_z_fa2='زراعت' ;	 
if ($row['z_fa2']=='2') $f_z_fa2='باغبانی' ;	 
if ($row['z_fa2']=='3') $f_z_fa2='پرورش دام سبک و سنگین' ;	 
if ($row['z_fa2']=='4') $f_z_fa2='پرورش طیور' ;	 
if ($row['z_fa2']=='5') $f_z_fa2='پرورش زنبورعسل' ;	 
if ($row['z_fa2']=='6') $f_z_fa2='نوغانداری' ;	 
if ($row['z_fa2']=='7') $f_z_fa2='شیلات و آبزیان' ;	 
if ($row['z_fa2']=='8') $f_z_fa2='صید و صیادی' ;	 
if ($row['z_fa2']=='9') $f_z_fa2='جنگل و مرتع' ;	 
if ($row['z_fa2']=='10') $f_z_fa2='آبخیزداری' ;	 
if ($row['z_fa2']=='11') $f_z_fa2='صنایع تبدیلی' ;	 
if ($row['z_fa2']=='12') $f_z_fa2='صنایع و مشاغل خانگی' ;	 
if ($row['z_fa2']=='13') $f_z_fa2='خدمات اجتماعی' ;	 



  ?>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['addres']; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name_co']; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_oz_ta; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_no_oz; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_no_ham; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_z_fa2; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_z_fa1; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $f_g_tah; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['r_tah']; ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal_z']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['f_tm'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_fam'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  bah_tel_m($row['cod_m']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_sh_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_date_t($row['cod_m']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $f_jens; ?></td>
          <td height="32" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_m'] ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['cod_m'])?></div></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ,shahr_name($row['add_city']) ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar'])?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          <td bordercolor="#0099CC" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']); ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
}
	?>
  </table>
</body>
</html>


