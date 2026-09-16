<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Mushroom_list.xls");
?>
<?php 
include('../../lock_p1.php');
include('../../event.php') ;

 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $no_moj = $_POST['no_moj'] ;
 $no_mush = $_POST['no_mush'] ;
 $gaz = $_POST['gaz'] ;


 if ($add_abadi == '') { $v_add_abadi = 1; }else { $v_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city == '')  { $v_add_city  = 1 ; }else{ $v_add_city = "add_city = '$add_city'" ;}
 if ($no_mush == '')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "no_mush = '$no_mush'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "bah_cod_m = '$bah_cod_m'" ;}
 if ($no_moj == '')  { $f_no_moj  = 1  ; }else{ $f_no_moj = "no_moj = '$no_moj'" ;}
 if ($gaz == '')  { $f_gaz  = 1  ; }else{ $f_gaz = "gaz = '$gaz'" ;}

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
    <td><p>
      <?php 
include ('../../login/config.php');
 $query = "SELECT id,id_ostan,id_city,add_abadi,add_city,no_mush,m_zamin,bah_cod_m,unit_name,no_mal,no_moj,z_vag from Mushroom where  mor_cod_m = '$login_session' and $v_add_abadi and $v_add_city and $f_no_mush and $v_bah_cod_m and $f_gaz and $f_no_moj  ORDER BY mor_cod_m ASC"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':mor_cod_m'=>$login_session));
?>
      </p>
           <table width="98%" height="91" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text_r">
               <td width="14%" bgcolor="#999999">مساحت زمین مترمربع</td>
    <td width="14%" height="42" bgcolor="#999999">نوع قارچ پرورشی</td>
    <td width="13%" bgcolor="#999999">نوع مالکیت</td>
    <td width="13%" bgcolor="#999999">ظرفیت واقعی</td>
    <td width="13%" bgcolor="#999999">نوع مجوز</td>
    <td width="13%" bgcolor="#999999">نام واحد</td>
    <td width="13%" bgcolor="#999999">همراه بهره بردار</td>
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
if ($row['no_mush']=='1')  $v_no_mush='صدفی';
if ($row['no_mush']=='2')  $v_no_mush='دکمه ای';

//echo $row2['User_Name'] ; 
?>
<td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['m_zamin']; ?></span></td>
  <td height="46"  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mush ; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_mal ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['z_vag']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_moj; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $row['unit_name']; ?></span></td>
    <td  class="normalTextSmaller" style="text-align: center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_tel_m($row['bah_cod_m']);?></td>
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