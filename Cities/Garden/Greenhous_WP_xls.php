<?php 
session_start();
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Greenhous_WP.xls");
?>
<?php 
include('../../lock_p3.php');
include('../../event.php') ;

if (isset($_POST['y_prod']))   $y_prod  = $_POST['y_prod'] ; 
if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'] ;
if(isset($_POST['id_city']))  $id_city   = $_POST['id_city'] ;
if(isset($_POST['id_mar'])) $id_mar = $_POST['id_mar'] ; 
if(isset($_POST['no_kesht']))  { $no_kesht = $_POST['no_kesht']     ; };
if(isset($_POST['no_saz']))   { $no_saz = $_POST['no_saz']       ; };
if(isset($_POST['no_gol']))   { $no_gol = $_POST['no_gol']       ; };
if(isset($_POST['sys_kesh'])) { $sys_kesh = $_POST['sys_kesh']   ; };
if(isset($_POST['sys_hot']))  { $sys_hot = $_POST['sys_hot']     ; };
if(isset($_POST['add_abadi']))
{
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $no_moj = $_POST['no_moj'] ;
 $no_mush = $_POST['no_mush'] ;
 $m_ab      = $_POST['m_ab'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $m_cod_m   = $_POST['m_cod_m'] ;
}

 if ($id_ostan1 == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "Greenhous.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "Greenhous.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "Greenhous.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') { $v_add_abadi = 1; }else { $v_add_abadi = "Greenhous.add_abadi = '$add_abadi'" ;}
 if ($add_city == '0')  { $v_add_city  = 1 ; }else{ $v_add_city = "Greenhous.add_city = '$add_city'" ;}
 if ($no_mush == '0')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "Greenhous.no_mush = '$no_mush'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Greenhous.bah_cod_m = '$bah_cod_m'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "Greenhous.mor_cod_m = '$mor_cod_m'" ;}
 if ($m_cod_m == '')  { $v_m_cod_m  = 1  ; }else{ $v_m_cod_m = "Greenhous.m_cod_m = '$m_cod_m'" ;}
 if ($no_moj == '')  { $f_no_moj  = 1  ; }else{ $f_no_moj = "Greenhous.no_moj = '$no_moj'" ;}
 if ($no_kesht == '')   { $f_no_kesht    = 1  ;}else{ $f_no_kesht   = "Greenhous.no_kesht = '$no_kesht'" ;}
 if ($no_saz == '')    { $f_no_saz     = 1  ;}else{ $f_no_saz    = "Greenhous.no_saz = '$no_saz'" ;}
 if ($no_gol == '')    { $f_no_gol     = 1  ;}else{ $f_no_gol    = "Greenhous.no_gol = '$no_gol'" ;}
 if ($sys_kesh == '')  { $f_sys_kesh   = 1  ;}else{ $f_sys_kesh  = "Greenhous.sys_kesh = '$sys_kesh'" ;}
 if ($sys_hot == '')   { $f_sys_hot    = 1  ;}else{ $f_sys_hot   = "Greenhous.sys_hot = '$sys_hot'" ;}
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
$query = "SELECT Greenhous.* from Greenhous
left join Greenhous_prod On Greenhous_prod.unit_id = Greenhous.id and Greenhous_prod.y_prod='$y_prod'
 where  $v_mor_cod_m and 
 $v_id_ostan and 
 $v_id_city and  
 $v_add_abadi and 
 $v_add_city and 
  $v_bah_cod_m  and 
  $v_m_cod_m and 
  $f_no_moj and 
  $f_no_kesht and 
  $f_no_saz and 
  $f_no_gol and 
  $f_sys_kesh  and
   $f_sys_hot  and 
    Greenhous_prod.unit_id is not null 
 ORDER BY Greenhous.bah_cod_m ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
      </p>
           <table width="98%" height="113" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text_r">
               <td width="11%" rowspan="2" bgcolor="#999999">کد ملی کارشناس مروج </td>
               <td width="11%" rowspan="2" bgcolor="#999999">آب شیرین کن</td>
               <td width="11%" rowspan="2" bgcolor="#999999">NFT</td>
               <td width="11%" rowspan="2" bgcolor="#999999">بازچرخان</td>
               <td width="11%" rowspan="2" bgcolor="#999999">ظرفیت سورت و بسته بندی</td>
               <td width="11%" rowspan="2" bgcolor="#999999">سورت و بسته بندی</td>
               <td width="11%" rowspan="2" bgcolor="#999999">ماشین سردخانه دار</td>
               <td width="11%" rowspan="2" bgcolor="#999999">حجم سردخانه</td>
               <td width="11%" rowspan="2" bgcolor="#999999">سردخانه</td>
               <td width="11%" rowspan="2" bgcolor="#999999">دبی آب(لیتر/ثانیه)</td>
               <td width="11%" rowspan="2" bgcolor="#999999">منبع تامین آب</td>
               <td width="11%" rowspan="2" bgcolor="#999999">آمپر برق</td>
               <td width="11%" rowspan="2" bgcolor="#999999">تعداد فاز برق</td>
               <td width="11%" rowspan="2" bgcolor="#999999">برقی شهری</td>
               <td width="11%" rowspan="2" bgcolor="#999999">ظرفیت کنتور گاز (مترمکعب / ساعت)</td>
               <td width="11%" rowspan="2" bgcolor="#999999">گاز طبیعی </td>
               <td width="11%" rowspan="2" bgcolor="#999999">نوع سیستم خنک کننده</td>
               <td width="11%" rowspan="2" bgcolor="#999999">نوع سیستم گرمایشی </td>
               <td width="11%" rowspan="2" bgcolor="#999999">نوع سوخت </td>
               <td width="11%" rowspan="2" bgcolor="#999999">سیستم کشت</td>
    <td width="11%" height="42" rowspan="2" bgcolor="#999999">نوع گلخانه</td>
    <td width="10%" rowspan="2" bgcolor="#999999">نوع سازه</td>
    <td width="10%" rowspan="2" bgcolor="#999999">سرمایه گذاری کل / میلیارد ریال</td>
    <td width="10%" rowspan="2" bgcolor="#999999">سال تاسیس</td>
    <td width="10%" rowspan="2" bgcolor="#999999">تاریخ پروانه بهره برداری</td>
    <td width="10%" rowspan="2" bgcolor="#999999">شماره پروانه بهره برداری </td>
    <td width="10%" rowspan="2" bgcolor="#999999">تاریخ پروانه تاسیس </td>
    <td width="10%" rowspan="2" bgcolor="#999999">شماره پروانه تاسیس </td>
    <td width="10%" rowspan="2" bgcolor="#999999">نام واحد </td>
    <td width="11%" rowspan="2" bgcolor="#999999">نوع کشت</td>
    <td width="11%" rowspan="2" bgcolor="#999999">مساحت زمین /مترمربع </td>
    <td width="10%" rowspan="2" bgcolor="#999999">کد ملی مالک </td>
    <td width="10%" rowspan="2" bgcolor="#999999">نوع مالکیت</td>
    <td width="10%" rowspan="2" bgcolor="#999999">نوع مجوز</td>
    <td width="10%" colspan="4" bgcolor="#999999">عرض   جغرافیایی</td>
    <td width="10%" colspan="4" bgcolor="#999999">طول  جغرافیایی</td>
    <td width="10%" rowspan="2" bgcolor="#999999">شماره همراه</td>
    <td width="10%" rowspan="2" bgcolor="#999999"> کد ملی<br /></td>
    <td width="11%" rowspan="2" bgcolor="#999999">نام و نام خانوادگی</td>
    <td width="4%" rowspan="2" bgcolor="#999999">نام آبادی</td>
    <td width="5%" rowspan="2" bgcolor="#999999">آدرس آماری آبادی </td>
    <td width="9%" rowspan="2" bgcolor="#999999">نام شهر</td>
    <td width="9%" rowspan="2" bgcolor="#999999">آدرس آماری شهر</td>
    <td width="7%" rowspan="2" bgcolor="#999999">شهرستان </td>
    <td width="7%" rowspan="2" bgcolor="#999999">استان</td>
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

$no_mal = $row['no_mal'];
if ($no_mal=='1')  $v_no_mal='سند ششدانگ';
if ($no_mal=='2')  $v_no_mal='سند مشاعی';
if ($no_mal=='3')  $v_no_mal='اصلاحات اراضی';
if ($no_mal=='4')  $v_no_mal='موقوفه';
if ($no_mal=='5')  $v_no_mal='واگذاری';
if ($no_mal=='6')  $v_no_mal='قولنامه';
if ($no_mal=='7')  $v_no_mal='اجاره' ;


if ($row['no_moj']=='1')  $v_no_moj='پروانه بهره برداری/نظام مهندسی';
if ($row['no_moj']=='5')  $v_no_moj='پروانه بهره برداری/سازمان جهاد کشاورزی';
if ($row['no_moj']=='2')  $v_no_moj='مشاغل خانگی/سازمان جهاد';
if ($row['no_moj']=='3')  $v_no_moj='تسهیلات/بسیج سازندگی';
if ($row['no_moj']=='4')  $v_no_moj='فاقد مجوز';
//alert($v_no_moj) ; 

if ($row['no_kesht']=='1')  $v_no_kesht='گلخانه';
if ($row['no_kesht']=='2')  $v_no_kesht='فضای باز';
	 
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

if ($row['gaz']=='1') $v_gaz='دارد' ;	 
if ($row['gaz']=='2') $v_gaz='ندارد' ;	 

if ($row['barg']=='1') $v_barg='دارد' ;	 
if ($row['barg']=='2') $v_barg='ندارد' ;	 

if ($row['m_ab']=='1') $v_m_ab='چشمه' ;	 
if ($row['m_ab']=='2') $v_m_ab='قنات' ;	 
if ($row['m_ab']=='3') $v_m_ab='رودخانه' ;	 
if ($row['m_ab']=='4') $v_m_ab='سد' ;	 
if ($row['m_ab']=='5') $v_m_ab='چاه سطحی' ;	 
if ($row['m_ab']=='6') $v_m_ab='چاه عمیق' ;	 
if ($row['m_ab']=='7') $v_m_ab='چاه نیمه عمیق' ;	 
if ($row['m_ab']=='8') $v_m_ab='زهکش' ;	 
if ($row['m_ab']=='9') $v_m_ab='پساب' ;	 
if ($row['m_ab']=='10') $v_m_ab='آب بندان' ;	 
if ($row['m_ab']=='11') $v_m_ab='سایر' ;	 

if ($row['sort']=='1') $v_sort='دارد' ;	 
if ($row['sort']=='2') $v_sort='ندارد' ;	 

if ($row['sard']=='1') $v_sard='دارد' ;	 
if ($row['sard']=='2') $v_sard='ندارد' ;	 

if ($row['m_sard']=='1') $v_m_sard='دارد' ;	 
if ($row['m_sard']=='2') $v_m_sard='ندارد' ;	 

if ($row['ab_sh']=='1') $v_ab_sh='دارد' ;	 
if ($row['ab_sh']=='2') $v_ab_sh='ندارد' ;	 

if ($row['nft']=='1') $v_nft='دارد' ;	 
if ($row['nft']=='2') $v_nft='ندارد' ;	 

if ($row['baz_chr']=='1') $v_baz_chr='دارد' ;	 
if ($row['baz_chr']=='2') $v_baz_chr='ندارد' ;	 

//echo $row2['User_Name'] ; 
?>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['mor_cod_m']; ?></span></td>
    <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_ab_sh?></td>
    <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_nft?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_baz_chr?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_sort']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_sort?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_m_sard?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_sard']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_sard?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['num_ab']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_m_ab?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['a_barg']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['f_barg']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_barg?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_gaz']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_gaz?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_sys_cool?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_sys_hot?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_sokh?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_sys_kesh?></span></td>
    <td height="22"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_gol?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_saz ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['sar_kol']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['sal_tas']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['pb_date']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['pb_no']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['pt_date']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['pt_no']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['unit_name']; ?></span></td>
    <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesht ; ?></td>
    <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_zamin']; ?></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $row['m_cod_m']; ?></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmaller" style="text-align: center"><?php echo $v_no_mal; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo $v_no_moj ; ?></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lat_ds']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lat_s']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lat_m']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lat_d']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lng_ds']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lng_s']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lng_m']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><span class="normalTextSmall"><?php echo $row['lng_d']; ?></span></td>
    <td class="normalTextSmaller" style="text-align: center"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo bah_tel_m($row['bah_cod_m']);?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_name($row['bah_cod_m'])?></span></td>
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