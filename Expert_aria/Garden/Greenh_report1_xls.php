<?php 
session_start();
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_گلخانه_ها.xls");
?>
<?php 
include('../../lock_expar.php');
include('../../event.php') ;

if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city']))  $id_city   = $_POST['id_city'] ;
if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ; 
if(isset($_POST['add_abadi']))
{
 $no_kesht = $_POST['no_kesht'] ;
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $y_prod = $_POST['y_prod'] ;
 $no_mtol = $_POST['no_mtol'] ;
 $m_fani = $_POST['m_fani'] ;
 $v_unit = $_POST['v_unit'] ;
}

 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "Greenhous_prod.id_ostan='$id_ostan1'" ;}
 if ($no_kesht == '')  { $f_no_kesht  = 1  ; }else{ $f_no_kesht = "no_kesht = '$no_kesht'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "Greenhous_prod.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "Greenhous_prod.id_mar='$id_mar'" ;}
  if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "Greenhous_prod.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "Greenhous_prod.add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "Greenhous_prod.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Greenhous_prod.bah_cod_m = '$bah_cod_m'" ;}
 if ($v_unit == '')  { $f_v_unit  = 1  ; }else{ $f_v_unit = "Greenhous_prod.v_unit = '$v_unit'" ;}
 if ($m_fani == '')  { $f_m_fani  = 1  ; }else{ $f_m_fani = "Greenhous_prod.m_fani = '$m_fani'" ;}
 if ($no_mtol == '')   { $f_no_mtol    = 1  ;}else{ $f_no_mtol   = "Greenhous_prod.no_mtol = '$no_mtol'" ;} 
 if ($no_kesht == '')  { $f_no_kesht  = 1  ; }else{ $f_no_kesht = "Greenhous_prod.no_kesht = '$no_kesht'" ;}
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
  $query = "select Greenhous_prod.*,Greenhous.*
from Greenhous_prod 
inner join Greenhous ON Greenhous_prod.unit_id  = Greenhous.id 
where  $v_id_ostan and $f_no_kesht and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and Greenhous_prod.y_prod = '$y_prod'
 and $f_no_mtol  and $f_v_unit and $f_m_fani and $v_bah_cod_m and $v_mor_cod_m  ORDER BY Greenhous_prod.id_ostan , Greenhous_prod.id_city , Greenhous_prod.bah_cod_m "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
      </p>
         <table width="98%"  border="1" align="center" cellpadding="1" cellspacing="1" >
           <tr align="center" class="text_r">
             <td width="11%" rowspan="2" bgcolor="#999999"> کد ملی کارشناس</td>
             <td width="11%" rowspan="2" bgcolor="#999999">برق شهری </td>
             <td width="11%" rowspan="2" bgcolor="#999999">گاز طبیعی </td>
             <td width="11%" rowspan="2" bgcolor="#999999">نوع سیستم خنک کننده</td>
             <td width="11%" rowspan="2" bgcolor="#999999">نوع سیستم گرمایشی </td>
             <td width="11%" rowspan="2" bgcolor="#999999">نوع سوخت </td>
             <td width="11%" rowspan="2" bgcolor="#999999">سیستم کشت</td>
             <td width="11%" rowspan="2" bgcolor="#999999">نوع گلخانه</td>
             <td width="10%" rowspan="2" bgcolor="#999999">نوع سازه</td>
             <td width="6%" rowspan="2" bgcolor="#999999">نوع محصول</td>
             <td width="11%" rowspan="2" bgcolor="#999999">نوع کشت</td>
             <td width="11%" rowspan="2" bgcolor="#999999">مساحت زمین /مترمربع </td>
             <td width="6%" rowspan="2" bgcolor="#999999">وضعیت واحد</td>
             <td width="10%" rowspan="2" bgcolor="#999999">نوع مجوز</td>
             <td width="10%" colspan="4" bgcolor="#999999">عرض   جغرافیایی</td>
             <td width="10%" colspan="4" bgcolor="#999999">طول  جغرافیایی</td>
    <td width="6%" rowspan="2" bgcolor="#999999"> کد ملی<br /></td>
    <td width="7%" rowspan="2" bgcolor="#999999">نام و نام خانوادگی</td>
    <td width="5%" rowspan="2" bgcolor="#999999">مرکز</td>
    <td width="5%" rowspan="2" bgcolor="#999999">شهرستان </td>
    <td width="5%" rowspan="2" bgcolor="#999999">استان</td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
           <tr align="center" class="text_r">
             <td bgcolor="#999999">دهم ثانیه</td>
             <td bgcolor="#999999">ثانیه</td>
             <td bgcolor="#999999">دقیقه</td>
             <td bgcolor="#999999">درجه</td>
             <td bgcolor="#999999">دهم ثانیه</td>
             <td bgcolor="#999999">ثانیه</td>
             <td bgcolor="#999999">دقیقه</td>
             <td bgcolor="#999999">درجه</td>
           </tr>
  <tr>
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

if ($row['no_moj']=='1')  $v_no_moj='پروانه بهره برداری/نظام مهندسی';
if ($row['no_moj']=='5')  $v_no_moj='پروانه بهره برداری/سازمان جهاد کشاورزی';
if ($row['no_moj']=='2')  $v_no_moj='مشاغل خانگی/سازمان جهاد';
if ($row['no_moj']=='3')  $v_no_moj='تسهیلات/بسیج سازندگی';
if ($row['no_moj']=='4')  $v_no_moj='فاقد مجوز';


if ($row['gaz']=='1') $v_gaz='دارد' ;	 
if ($row['gaz']=='2') $v_gaz='ندارد' ;	 

if ($row['barg']=='1') $v_barg='دارد' ;	 
if ($row['barg']=='2') $v_barg='ندارد' ;	 

if($row['no_kesht']=="1")  $v_no_kesht = 'گلخانه'  ;
if($row['no_kesht']=="2")  $v_no_kesht = 'فضای باز' ;

if ($row['no_mtol']=='211100')  $v_no_mtol='سبزی و صیفی';
if ($row['no_mtol']=='211300')  $v_no_mtol='گل و گیاه زینتی';
if ($row['no_mtol']=='211200')  $v_no_mtol='سایر' ;	 
 
if ($row['no_saz']=='') $v_no_saz='' ;	 
if ($row['no_saz']=='1') $v_no_saz='فلزی با پوشش پلاستیکی' ;	 
if ($row['no_saz']=='2') $v_no_saz='فلزی با پوشش پلی کربنات' ;	
if ($row['no_saz']=='3') $v_no_saz='فلزی با پوشش شیشه ای' ;	
if ($row['no_saz']=='4') $v_no_saz='چوبی پلاستیکی' ;	 

if ($row['no_gol']=='') $v_no_gol='' ;	 
if ($row['no_gol']=='1') $v_no_gol='تونلی تک قلو' ;	 
if ($row['no_gol']=='2') $v_no_gol='تونلی به هم پیوسته' ;	
if ($row['no_gol']=='3') $v_no_gol='یک طرفه' ;	
if ($row['no_gol']=='4') $v_no_gol='شیشه ای سقف شیروانی' ;	 

if ($row['sys_kesh']=='') $v_sys_kesh='' ;	 
if ($row['sys_kesh']=='1') $v_sys_kesh='خاکی' ;	 
if ($row['sys_kesh']=='2') $v_sys_kesh='هیدروپونیک' ;	 
if ($row['sys_kesh']=='3') $v_sys_kesh='اکوآپونیک' ;	 

if ($row['no_sokh']=='1') $v_no_sokh='نفت سفید' ;	 
if ($row['no_sokh']=='2') $v_no_sokh='گازوئیل' ;	 
if ($row['no_sokh']=='3') $v_no_sokh='گاز' ;	 


if ($row['sys_hot']=='1') $v_sys_hot='حرارت مرکزی' ;	 
if ($row['sys_hot']=='2') $v_sys_hot='هیتر یا بخاری' ;	 
if ($row['sys_hot']=='3') $v_sys_hot='تشعشعی' ;	 

if ($row['sys_cool']=='1') $v_sys_cool='پدوفن' ;	 
if ($row['sys_cool']=='2') $v_sys_cool='مه پاش' ;	 
if ($row['sys_cool']=='3') $v_sys_cool='دریچه های تهویه' ;	 


//echo $row2['User_Name'] ; 
?>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo '"'.$row['mor_cod_m'].'"';?></td>
    <td height="22"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_barg?></span></td>
    <td height="22"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_gaz?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_sys_cool?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_sys_hot?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_sokh?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_sys_kesh?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_gol?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_saz ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mtol ; ?></span></td>
    <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesht ; ?></td>
    <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_v_unit?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $v_no_moj ; ?></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lat_ds']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lat_s']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lat_m']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lat_d']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lng_ds']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lng_s']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lng_m']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lng_d']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo '"'.$row['bah_cod_m'].'"';?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mar_name($row['id_mar']);?></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo ostan_name($row['id_ostan']);  ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>