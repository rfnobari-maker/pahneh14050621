<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Garden_list.xls");
?>
<?php 
include('../../lock_p1.php');
include('../../event.php') ;

 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $nah_kesh = $_POST['nah_kesh'] ;
 $no_mal = $_POST['no_mal'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
 $ok = $_POST['ok'] ;

 if ($add_abadi == '') { $v_add_abadi = 1; }else { $v_add_abadi = "Garden.add_abadi = '$add_abadi'" ;}
 if ($add_city == '')  { $v_add_city  = 1 ; }else{ $v_add_city = "Garden.add_city = '$add_city'" ;}
 if ($no_mal == '')  { $f_no_mal  = 1  ; }else{ $f_no_mal = "Garden.no_mal = '$no_mal'" ;}
 if ($no_kesh == '')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "Garden.no_kesh = '$no_kesh'" ;}
 if ($nah_kesh == '')  { $f_nah_kesh  = 1  ; }else{ $f_nah_kesh = "Garden.nah_kesh = '$nah_kesh'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Garden.bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "Garden.z_sal = '$z_sal'" ;}
 if ($ok == '')  { $f_ok  = 1  ; }else{ $f_ok = "bah.ok = '$ok'" ;}

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
 $query = "SELECT Garden.num_bah,Garden.id,Garden.mor_cod_m,Garden.no_mal
,Garden.bah_cod_m,Garden.add_abadi,Garden.add_city,Garden.sh_gat,Garden.z_sal,Garden.no_kesh
,Garden.nah_kesh,Garden.m_zamin,Garden.id_ostan,Garden.id_city,Garden.t_mah 
from Garden
INNER JOIN bah ON Garden.bah_cod_m = bah.bah_cod_m
AND Garden.num_bah = bah.num_bah
 where  Garden.mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_no_kesh and $f_nah_kesh and $f_no_mal and $v_bah_cod_m and $v_z_sal and $f_ok  ORDER BY mor_cod_m ASC"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
      </p>
           <table width="98%" height="70" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text_r">
               <td width="14%" bgcolor="#999999">مساحت زمین (هکتار )</td>
    <td width="14%" height="42" bgcolor="#999999">نوع کشت</td>
    <td width="13%" bgcolor="#999999">نوع مالکیت</td>
    <td width="13%" bgcolor="#999999">نحوه کشت</td>
    <td width="13%" bgcolor="#999999">شماره قطعه</td>
    <td width="13%" bgcolor="#999999">سال</td>
    <td width="13%" bgcolor="#999999">همراه</td>
    <td width="13%" bgcolor="#999999"> کد ملی<br /></td>
    <td width="15%" bgcolor="#999999">نام خانوادگی</td>
    <td width="15%" bgcolor="#999999">نام</td>
    <td width="12%" bgcolor="#999999">شهر / آبادی </td>
    <td width="14%" bgcolor="#999999">شهرستان </td>
    <td width="6%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
    
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];

if ($row['no_mal']=='') $v_no_mal='-' ;	 
if ($row['no_mal']=='1') $v_no_mal='سند ششدانگ' ;	 
if ($row['no_mal']=='2') $v_no_mal='سند مشاعی' ;	 
if ($row['no_mal']=='3') $v_no_mal='اصلاحات اراضی' ;	 
if ($row['no_mal']=='4') $v_no_mal='موقوفه' ;	 
if ($row['no_mal']=='5') $v_no_mal='واگذاری' ;	 
if ($row['no_mal']=='6') $v_no_mal='قولنامه' ;	 
if ($row['no_mal']=='7') $v_no_mal='اجاره' ;	 
if ($row['nah_kesh']=='1') $v_nah_kesh='ساده' ;	 
if ($row['nah_kesh']=='2') $v_nah_kesh='مخلوط' ;	 
if ($row['nah_kesh']=='3') $v_nah_kesh='درختان پراکنده' ;	 
if ($row['no_kesh']=='') $v_no_kesh='-' ;	 
if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 

//echo $row2['User_Name'] ; 
?>
<td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['m_zamin']; ?></span></td>
  <td height="25"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_kesh?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mal ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_nah_kesh ; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['sh_gat']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_sal']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo bah_tel_m($row['bah_cod_m']);?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_last_name($row['bah_cod_m'])?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo bah_first_name($row['bah_cod_m'])?></span></td>
    <td class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></span></td>
    <td style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>