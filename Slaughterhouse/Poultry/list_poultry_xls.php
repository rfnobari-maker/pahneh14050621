<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=poultry_list.xls");
?>
<?php 
include('../../lock_expar.php');
include('../../event.php') ;
$id_city = $_POST['id_city'] ; 
$id_mar = $_POST['id_mar'] ; 
if ($id_city == 0) { $v_id_city = 'id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
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
    <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td><p>
      <?php 
include ('../../login/config.php');
$query = "SELECT spoultry.date_s,spoultry.id_city, spoultry.add_abadi,spoultry.add_city,spoultry.no_bah,spoultry.bah_cod_m,spoultry.no_moj,spoultry.z_unit,spoultry.mor_cod_m
,spoultry.poul_cod,spoultry.m_zamin,spoultry.no_mal,spoultry.lng,spoultry.lat,spoultry.m_ab
,spoultry.make_y,spoultry.sh_moj,spoultry.no_sokht,spoultry.vaz_unit,spoultry.d_noact
,spoultry.an1_faz,spoultry.an1_dem,spoultry.an1_cont,spoultry.an2_faz,spoultry.an2_dem,spoultry.an2_cont
,spoultry.an3_faz,spoultry.an3_dem,spoultry.an3_cont,spoultry.m_par,spoultry.m_beh 
FROM spoultry
INNER JOIN aria ON spoultry.id_city = aria.id_city
WHERE aria.id_aria='$id_aria' and aria.id_ostan='$id_ostan' and  spoultry.$v_id_city and spoultry.$v_id_mar 
ORDER BY BINARY spoultry.id_city,spoultry.add_city,spoultry.add_abadi ASC ";
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
      <table width="98%" height="202" border="0" align="center" cellpadding="1" cellspacing="1" >
        <tr align="center" class="text_r">
          <td width="5%" bgcolor="#999999">تاریخ ثبت </td>
          <td width="5%" bgcolor="#999999">تلفن همراه کارشناس مسئول پهنه</td>
          <td width="5%" bgcolor="#999999">کد ملی کارشناس مسئول پهنه</td>
          <td width="5%" bgcolor="#999999">نام کارشناس مسئول پهنه</td>
          <td bgcolor="#999999">مسئول فنی بهداشت</td>
          <td bgcolor="#999999">مسئول فنی پرورش</td>
          <td bgcolor="#999999">کنتور</td>
          <td bgcolor="#999999">دایماد قراردادی</td>
          <td bgcolor="#999999">نوع برق3</td>
          <td bgcolor="#999999">کنتور</td>
          <td bgcolor="#999999">دایماد قراردادی</td>
          <td bgcolor="#999999">نوع برق2</td>
          <td width="3%" bgcolor="#999999">کنتور</td>
          <td width="3%" bgcolor="#999999">دایماد قراردادی</td>
          <td width="2%" bgcolor="#999999">نوع برق1</td>
          <td width="2%" bgcolor="#999999">نوع برق مصرفی</td>
          <td width="2%" bgcolor="#999999">علت غیرفعال/ تغییر کاربری به</td>
          <td width="2%" bgcolor="#999999">وضعیت واحد</td>
          <td width="2%" bgcolor="#999999">نوع سوخت</td>
          <td width="3%" height="42" bgcolor="#999999">ظرفیت</td>
          <td width="2%" bgcolor="#999999">شماره مجوز </td>
          <td width="2%" bgcolor="#999999">نوع مجوز</td>
          <td width="3%" bgcolor="#999999">نوع بهره برداری</td>
          <td width="3%" bgcolor="#999999">سال ساخت</td>
          <td width="7%" bgcolor="#999999">نوع منبع آب</td>
          <td width="6%" bgcolor="#999999">عرض جغرافیایی</td>
          <td width="6%" bgcolor="#999999">طول جغرافیایی</td>
          <td width="5%" bgcolor="#999999">نوع مالکیت </td>
          <td width="5%" bgcolor="#999999">مساحت زمین</td>
          <td width="5%" bgcolor="#999999">کد مرغداری</td>
          <td width="4%" bgcolor="#999999"> کد ملی<br /></td>
          <td width="6%" bgcolor="#999999">نام و نام خانوادگی</td>
          <td width="6%" bgcolor="#999999">شهر / آبادی </td>
          <td width="6%" bgcolor="#999999">شهرستان </td>
          <td width="4%" bgcolor="#999999">ردیف</td>
        </tr>
        <tr>
          
          <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($row['no_bah']=='1') $v_no_bah='مرغ گوشتی' ;	 
if ($row['no_bah']=='2') $v_no_bah='مرغ تخمگذار' ;	 
if ($row['no_bah']=='3') $v_no_bah='مادر گوشتی' ;	 
if ($row['no_bah']=='4') $v_no_bah='مادر تخمگذار' ;	 
if ($row['no_bah']=='5') $v_no_bah='اجداد گوشتی' ;	 
if ($row['no_bah']=='6') $v_no_bah='اجداد تخمگذار' ;	 
if ($row['no_bah']=='7') $v_no_bah='پولت تخمگذار' ;	 
if ($row['no_bah']=='8') $v_no_bah='جوجه کشی' ;	 
if ($row['no_bah']=='9') $v_no_bah='شترمرغ مولد' ;	 
if ($row['no_bah']=='10') $v_no_bah='شترمرغ پرواری' ;	 
if ($row['no_bah']=='11') $v_no_bah='بوقلمون مولد' ;	 
if ($row['no_bah']=='12') $v_no_bah='بوقلمون گوشتی' ;	 
if ($row['no_bah']=='13') $v_no_bah='بلدرچین' ;	 
if ($row['no_bah']=='14') $v_no_bah='کبک' ;	 
if ($row['no_bah']=='15') $v_no_bah='پرندگان زینتی' ;	 
if ($row['no_bah']=='16') $v_no_bah='سایر ماکیان' ;	 
if ($row['no_moj']=='1') $v_no_moj='پروانه بهره برداری' ;	 
if ($row['no_moj']=='2') $v_no_moj='کارت شناسائی' ;	 
if ($row['no_moj']=='3') $v_no_moj='فاقد مجوز' ;	 

if ($row['no_mal']=='1') $v_no_mal='سند رسمی تفکیکی' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند رسمی مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='موقوفی' ;	 
if ($row['no_mal']=='4') $v_no_mal='قولنامه ای' ;	 
if ($row['no_mal']=='5') $v_no_mal='متصرف اراضی ملی و دولتی' ;	 
if ($row['no_mal']=='6') $v_no_mal='اجاره ای' ;	 

if ($row['m_ab']=='1') $v_m_ab='آب منطقه ای' ;	 
if ($row['m_ab']=='2') $v_m_ab='آب و فاضلاب روستایی' ;	 
if ($row['m_ab']=='3') $v_m_ab='تانکر آب' ;	 
if ($row['m_ab']=='4') $v_m_ab='چاه عمیق' ;	 
if ($row['m_ab']=='5') $v_m_ab='چاه نیمه عمیق' ;	 
if ($row['m_ab']=='6') $v_m_ab='چاه سطحی' ;	 
if ($row['m_ab']=='7') $v_m_ab='قنات' ;	 
if ($row['m_ab']=='8') $v_m_ab='چشمه' ;	 
if ($row['m_ab']=='9') $v_m_ab='رودخانه' ;	 
if ($row['m_ab']=='10') $v_m_ab='آب بند یا سد انحرافی' ;	 

if ($row['no_sokht']=='1') $v_no_sokht='گاز' ;	 
if ($row['no_sokht']=='2') $v_no_sokht='گازوئیل' ;	 

if ($row['vaz_unit']=='1') $v_vaz_unit='فعال' ;	 
if ($row['vaz_unit']=='2') $v_vaz_unit='غیر فعال' ;	 
if ($row['vaz_unit']=='3') $v_vaz_unit='تغییر کاربری' ;	 

if ($row['no_power']=='1') $v_no_power='منطقه ای' ;	 
if ($row['no_power']=='2') $v_no_power='موتور برق' ;	 

if ($row['an1_faz']=='1') $v_an1_faz='تک فاز' ;	 
if ($row['an1_faz']=='2') $v_an1_faz='سه فاز' ;	 

if ($row['an2_faz']=='1') $v_an2_faz='تک فاز' ;	 
if ($row['an2_faz']=='2') $v_an2_faz='سه فاز' ;	 

if ($row['an3_faz']=='1') $v_an3_faz='تک فاز' ;	 
if ($row['an3_faz']=='2') $v_an3_faz='سه فاز' ;	 

if ($row['m_par']=='1') $v_m_par='دائمی' ;	 
if ($row['m_par']=='2') $v_m_par='پاره وقت' ;	 
if ($row['m_par']=='3') $v_m_par='ندارد' ;	 

if ($row['m_beh']=='1') $v_m_beh='دائمی' ;	 
if ($row['m_beh']=='2') $v_m_beh='پاره وقت' ;	 
if ($row['m_beh']=='3') $v_m_beh='ندارد' ;	 


//echo $row2['User_Name'] ; 
?>
        <td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['date_s']; ?></span></td>
          <td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m'])?></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m']?></td>
          <td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['mor_cod_m'])?></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_m_beh ; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_m_par ; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['an3_cont']; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['an3_dem']; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_an3_faz ; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['an2_cont']; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['an2_dem']; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_an2_faz ; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['an1_cont']; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['an1_dem']; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_an1_faz ; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['an1_faz']; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['d_noact']; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_vaz_unit ;  ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_sokht ;  ?></span></td>
          <td height="51"  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_unit']; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sh_moj']; ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_moj ?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_bah?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['make_y'];?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $v_m_ab ;?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['lat'];?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['lng'];?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $v_no_mal ;?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['m_zamin'];?></span></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['poul_cod'];?></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
          <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></span></td>
          <td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></span></td>
          <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
          <td style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo city_name($row['id_city']); ?></span></td>
          <td style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
        </tr>
        <?php
$r++ ; 
}
?>
      </table>    