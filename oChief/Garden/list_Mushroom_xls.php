<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Mushroom_list.xls");
?>
<?php 
include('../../lock_oce.php');
include('../../event.php') ;

if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city']))  $id_city   = $_POST['id_city'] ;
if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ; 
if(isset($_POST['add_abadi']))
{
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $no_moj = $_POST['no_moj'] ;
 $no_mush = $_POST['no_mush'] ;
 $m_ab      = $_POST['m_ab'] ;
 $gaz = $_POST['gaz'] ;
 $barg = $_POST['barg'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $m_cod_m   = $_POST['m_cod_m'] ;
 $z_es1 = $_POST['z_es1'] ;
 $z_es2 = $_POST['z_es2'] ;
}


 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') { $v_add_abadi = 1; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city == '0')  { $v_add_city  = 1 ; }else{ $v_add_city = "add_city = '$add_city'" ;}
 if ($no_mush == '0')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "no_mush = '$no_mush'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($m_cod_m == '')  { $v_m_cod_m  = 1  ; }else{ $v_m_cod_m = "m_cod_m = '$m_cod_m'" ;}
 if ($no_moj == '')  { $f_no_moj  = 1  ; }else{ $f_no_moj = "no_moj = '$no_moj'" ;}
 if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "m_ab = '$m_ab'" ;}
 if ($gaz == '')  { $f_gaz  = 1  ; }else{ $f_gaz = "gaz = '$gaz'" ;}
 if ($barg == '')  { $f_barg  = 1  ; }else{ $f_barg = "barg = '$barg'" ;}
 if ($z_es1 == '')  { $f_z_es1   = 1  ; }else{ $f_z_es1 = "z_es >= $z_es1" ;}
 if ($z_es2 == '')  { $f_z_es2  = 1  ; }else{  $f_z_es2 = "z_es <= $z_es2" ;}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
  <td>
      <?php 
include ('../../login/config.php');
 $query = "SELECT * from Mushroom
 where  $v_mor_cod_m and $v_id_ostan and $v_id_city and  $v_add_abadi and $v_add_city 
and $f_no_mush and $v_bah_cod_m  and $v_m_cod_m and $f_m_ab and $f_gaz and $f_barg and $f_no_moj and $f_z_es1
and $f_z_es2 
 ORDER BY bah_cod_m ASC"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
<p align="center"> لیست واحدهای پرورش قارچ </p>
         <table width="98%" height="91" border="1" align="center" cellpadding="1" cellspacing="1" >
           <tr align="center" class="text_r">
             <td width="6%" bgcolor="#CCCCCC">کد ملی کارشناس</td>
             <td bgcolor="#CCCCCC">دبی آب</td>
             <td bgcolor="#CCCCCC">منبع آب</td>
             <td bgcolor="#CCCCCC">مقدار آمپر</td>
             <td bgcolor="#CCCCCC">تعداد فاز</td>
             <td bgcolor="#CCCCCC">برق شهری</td>
             <td bgcolor="#CCCCCC">ظرفیت کنتور/
               مترمکعب بر ساعت</td>
             <td bgcolor="#CCCCCC">گاز طبیعی</td>
             <td bgcolor="#CCCCCC">تعداد رطوبت سنج و دماسنج</td>
             <td bgcolor="#CCCCCC">تعداد سردخانه</td>
             <td bgcolor="#CCCCCC">تعداد سختی گیر</td>
             <td bgcolor="#CCCCCC">تعداد دیگ بخار</td>
             <td bgcolor="#CCCCCC">تعداد چیلر</td>
             <td bgcolor="#CCCCCC">تعداد هواساز</td>
             <td width="6%" bgcolor="#CCCCCC">مساحت زیربنا /مترمربع</td>
             <td width="6%" bgcolor="#CCCCCC">مساحت زمین /مترمربع</td>
    <td width="6%" bgcolor="#CCCCCC">نوع قارچ پرورشی</td>
    <td width="5%" bgcolor="#CCCCCC">نوع مالکیت</td>
    <td width="5%" bgcolor="#CCCCCC">ظرفیت اسمی / تن در سال</td>
    <td width="5%" bgcolor="#CCCCCC">نوع مجوز</td>
    <td width="5%" bgcolor="#CCCCCC">سرمایه گذاری کل/ میلیارد ریال</td>
    <td width="5%" bgcolor="#CCCCCC">سال تاسیس واحد</td>
    <td width="5%" bgcolor="#CCCCCC">تاریخ پروانه بهره برداری</td>
    <td width="5%" bgcolor="#CCCCCC">شماره پروانه بهره برداری</td>
    <td width="5%" bgcolor="#CCCCCC">تاریخ پروانه تاسیس</td>
    <td width="5%" bgcolor="#CCCCCC">شماره پروانه تاسیس</td>
    <td width="6%" bgcolor="#CCCCCC">عرض جغرافیایی</td>
    <td width="6%" bgcolor="#CCCCCC">طول جغرافیایی</td>
    <td width="6%" bgcolor="#CCCCCC">کد پستی</td>
    <td width="6%" bgcolor="#CCCCCC">نام واحد</td>
    <td width="7%" bgcolor="#CCCCCC">شماره همراه</td>
    <td width="7%" bgcolor="#CCCCCC"> کد ملی<br /></td>
    <td width="9%" bgcolor="#CCCCCC">نام و نام خانوادگی</td>
    <td width="10%" bgcolor="#CCCCCC">شهر / آبادی </td>
    <td width="12%" bgcolor="#CCCCCC">شهرستان </td>
    <td width="8%" bgcolor="#CCCCCC">استان</td>
    <td width="4%" bgcolor="#CCCCCC">ردیف</td>
    </tr>
    <tr>
 
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];

if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['no_mal']=='8') $v_no_mal='سایر' ;	 
if ($row['no_moj']=='1') $v_no_moj='پروانه بهره برداری/نظام مهندسی' ;	 
if ($row['no_moj']=='2') $v_no_moj='مشاغل خانگی/وزارت جهاد' ;	 
if ($row['no_moj']=='3') $v_no_moj='تسهیلات/بسیج سازندگی' ;	 
if ($row['no_moj']=='4') $v_no_moj='فاقد مجوز' ;	 
if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';
if ($row['no_mush']=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';

if ($row['barg']=='1')  $v_barg='دارد';
if ($row['barg']=='2')  $v_barg='ندارد';

if ($row['gaz']=='1')  $v_gaz='دارد';
if ($row['gaz']=='2')  $v_gaz='ندارد';


//echo $row2['User_Name'] ; 
?>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo $row['mor_cod_m'];?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['num_ab']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['m_ab']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['a_barg']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['f_barg']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_barg ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_gaz']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_gaz ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['rotob']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sard']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sakhti']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['deek']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['cheler']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['hava']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><span class="normalTextSmall"><?php echo $row['m_arseh']; ?></span></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['m_zamin']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mush ; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mal ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_es']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_moj; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sar_kol']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sal_tas']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['date_moj']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo '/'.$row['sh_moj'].'/'; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['date_tas']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo '/'.$row['sh_tas'].'/'; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><span class="normalTextSmall"><span class="normalTextSmaller" style="text-align: center"><span class="normalTextSmaller" style="text-align: center"><?php echo $row['lat_ds']; ?></span></span><span class="normalTextSmaller" style="text-align: center"><span class="normalTextSmaller" style="text-align: center"><?php echo $row['lat_m']; ?></span></span><?php echo $row['lat_d']; ?></span><span class="normalTextSmall"> <?php echo $row['lat_s']; ?></span></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['lng_d']; ?> <?php echo $row['lng_m']; ?></span><span class="normalTextSmall"> <?php echo $row['lng_s']; ?></span><span class="normalTextSmall"><?php echo $row['lng_ds']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['post_code']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['unit_name']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_tel_m($row['bah_cod_m']);?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo ostan_name($row['id_ostan']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>
         <p align="center">پایان گزارش </p>  
  