<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Agri_list.xls");
include('../../lock_p1.php');
include('../../event.php') ;
 $add_abadi=$_POST['add_abadi'] ;
 $add_city=$_POST['add_city'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $no_mal = $_POST['no_mal'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
  $m_cod_m = $_POST['m_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
 $t_mah = $_POST['t_mah'] ;
 $Agri_table = 'Agri'.str_replace('-','_',$z_sal) ; 
 if ($add_abadi == '') { $v_add_abadi = 1; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city == '')  { $v_add_city  = 1  ; }else{ $v_add_city = "add_city = '$add_city'" ;}
 if ($no_mal == '')  { $v_no_mal  = 1  ; }else{ $v_no_mal = "no_mal = '$no_mal'" ;}
 if ($no_kesh == '')  { $v_no_kesh  = 1 ; }else{ $v_no_kesh = "no_kesh = '$no_kesh'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
  if ($m_cod_m == '')  { $v_m_cod_m  = 1  ; }else{ $v_m_cod_m = "m_cod_m = '$m_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "z_sal = '$z_sal'" ;}
 if ($t_mah =='') { $v_t_mah = 1;}else{ $v_t_mah = "`Agri`.t_mah = '$t_mah'" ;}
 if ($t_mah =='4')  { $v_t_mah = "`Agri`.t_mah >= '$t_mah'" ;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
<tr>
  <td>      <?php 
include ('../../login/config.php');
$query = "SELECT s_ayesh,num_bah,id,mor_cod_m,no_mal,bah_cod_m,add_abadi,add_city,sh_gat,z_sal,no_kesh,m_zamin,id_ostan,id_city,t_mah,lat,lng from `$Agri_table` where  mor_cod_m = :mor_cod_m and $v_add_abadi and $v_add_city and $v_no_mal and $v_no_kesh and $v_bah_cod_m and $v_m_cod_m and $v_z_sal  and  $v_t_mah ORDER BY mor_cod_m ASC  "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
      </p>
         <table width="98%" height="68" border="0" align="center" cellpadding="1" cellspacing="1" >
           <tr align="center" class="text_r">
             <td width="14%" bgcolor="#999999">تنوع محصول</td>
             <td width="14%" bgcolor="#999999">سطح آیش
             (هکتار )</td>
             <td width="14%" bgcolor="#999999">عرض جغرافیایی</td>
             <td width="14%" bgcolor="#999999">طول جغرافیایی</td>
             <td width="14%" bgcolor="#999999">مساحت زمین (هکتار )</td>
    <td width="14%" height="42" bgcolor="#999999">نوع کشت</td>
    <td width="13%" bgcolor="#999999">نوع مالکیت</td>
    <td width="13%" bgcolor="#999999">شماره قطعه</td>
    <td width="13%" bgcolor="#999999">همراه </td>
    <td width="13%" bgcolor="#999999"> کد ملی<br /></td>
    <td width="15%" bgcolor="#999999">نام خانوادگی</td>
    <td width="15%" bgcolor="#999999">نام</td>
    <td width="12%" bgcolor="#999999"> آبادی </td>
    <td width="14%" bgcolor="#999999">شهر </td>
    <td width="6%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
  foreach($stmt as $row)
  {
$add_abadi = $row['add_abadi'];
if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['no_mal']=='8') $v_no_mal='سایر' ;	 
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 
?>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['t_mah']; ?></span></td>
 <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['s_ayesh']; ?></span></td>
 <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['lat']; ?></span></td>
 <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['lng']; ?></span></td>
<td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['m_zamin']; ?></span></td>
  <td height="23"  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_kesh?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mal ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sh_gat']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_tel_m($row['bah_cod_m']);?></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_last_name($row['bah_cod_m'])?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_first_name($row['bah_cod_m'])?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?></span></td>
    <td style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo shahr_name($row['add_city']) ?></span></td>
    <td style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>