<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Agri_list.xls");
?>
<?php 
include('../../lock_p1.php');
include('../../event.php') ;
$id_ostan1   = isset($_POST['id_ostan']) ? $_POST['id_ostan'] : '';
$id_city     = isset($_POST['id_city']) ? $_POST['id_city'] : '';
$id_mar      = isset($_POST['id_mar']) ? $_POST['id_mar'] : '';
$add_abadi   = isset($_POST['add_abadi']) ? $_POST['add_abadi'] : '';
$add_city    = isset($_POST['add_city']) ? $_POST['add_city'] : '';
$no_kesh     = isset($_POST['no_kesh']) ? $_POST['no_kesh'] : '';
$m_ab        = isset($_POST['m_ab']) ? $_POST['m_ab'] : '';
$no_ab       = isset($_POST['no_ab']) ? $_POST['no_ab'] : '';
$mor_cod_m   = isset($_POST['mor_cod_m']) ? $_POST['mor_cod_m'] : '';
$bah_cod_m   = isset($_POST['bah_cod_m']) ? $_POST['bah_cod_m'] : '';
$z_sal       = isset($_POST['z_sal']) ? $_POST['z_sal'] : '';
$m_zamin1    = isset($_POST['m_zamin1']) ? $_POST['m_zamin1'] : '';
$m_zamin2    = isset($_POST['m_zamin2']) ? $_POST['m_zamin2'] : '';
$s_ayesh     = isset($_POST['s_ayesh']) ? $_POST['s_ayesh'] : '';
$t_mah       = isset($_POST['t_mah']) ? $_POST['t_mah'] : '';

 $Agri_table     = 'Agri'.str_replace('-','_',$z_sal) ; 
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == '')    { $v_id_city = 1 ;} else { $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == '')    { $v_id_mar = 1 ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($no_kesh == '')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "m_ab = '$m_ab'" ;}
 if ($no_ab == '')  { $f_no_ab  = 1  ; }else{ $f_no_ab = "no_ab = '$no_ab'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($m_zamin1 == '')  { $v_m_zamin1  = 1  ; }else{ $v_m_zamin1 = "m_zamin >= $m_zamin1" ;}
 if ($m_zamin2 == '')  { $v_m_zamin2  = 1  ; }else{ $v_m_zamin2 = "m_zamin <= $m_zamin2" ;}
 if ($s_ayesh == '')  { $v_s_ayesh  = 1  ; }else{ $v_s_ayesh = "s_ayesh = $s_ayesh" ;}
 if ($t_mah == '')  { $v_t_mah  = 1  ; }else{ $v_t_mah = "t_mah = $t_mah" ;}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
 $query = "SELECT *
  from `$Agri_table` 
  where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh and $f_m_ab and $f_no_ab and $v_mor_cod_m and $v_bah_cod_m  and $v_m_zamin1 and $v_m_zamin2 and $v_s_ayesh and $v_t_mah ORDER BY bah_cod_m ASC ";
 $stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
         <table width="98%" height="82" border="0" align="center" cellpadding="1" cellspacing="1" >
           <tr align="center" class="text_r">
             <td width="6%" bgcolor="#999999">نام و نام خانوادگی کارشناس</td>
             <td width="6%" bgcolor="#999999">کد ملی کارشناس</td>
             <td width="5%" bgcolor="#999999">مساحت زمین (هکتار )</td>
    <td width="4%" height="42" bgcolor="#999999">نوع کشت</td>
    <td width="4%" bgcolor="#999999">نوع مالکیت</td>
    <td width="3%" bgcolor="#999999">کد ملی مالک</td>
    <td width="5%" bgcolor="#999999">شماره قطعه</td>
    <td width="5%" bgcolor="#999999">شماره همراه</td>
    <td width="3%" bgcolor="#999999">تاریخ تولد</td>
    <td width="6%" bgcolor="#999999"> کد ملی بهره بردار<br /></td>
    <td width="8%" bgcolor="#999999">نام خانوادگی</td>
    <td width="9%" bgcolor="#999999">نام</td>
    <td width="8%" bgcolor="#999999">شهر / آبادی </td>
    <td width="6%" bgcolor="#999999">نام مرکز</td>
    <td width="7%" bgcolor="#999999">شهرستان </td>
    <td width="7%" bgcolor="#999999">استان</td>
    <td width="8%" bgcolor="#999999">ردیف</td>
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
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
if ($row['no_mal']=='8') $v_no_mal='سایر' ;	 
//echo $row2['User_Name'] ; 
?>
 <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo user_name($row['mor_cod_m']);?></span></td>
 <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'];?></td>
  <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['m_zamin']; ?></span></td>
  <td height="23"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_kesh?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mal ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_cod_m'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sh_gat']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_tel_m($row['bah_cod_m']);?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_date_t($row['bah_cod_m']);?></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_last_name($row['bah_cod_m'])?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_first_name($row['bah_cod_m'])?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo mar_name($row['id_mar']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo ostan_name($row['id_ostan']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>