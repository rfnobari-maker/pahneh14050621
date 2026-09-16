<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=benef_list.xls");
include('../lock_expar.php');
include('../event.php') ;
 $id_city = $_POST['id_city'] ; 
  $id_mar = $_POST['id_mar'] ; 
  $no_fa = $_POST['no_fa'] ; 
if ($id_city == 0) { $v_id_city = 'id_city' ;} else { $v_id_city = "id_city='$id_city'" ;}
if ($id_mar == 0) { $v_id_mar = 'id_mar' ;} else { $v_id_mar = "id_mar='$id_mar'" ;}
if ($no_fa == '0')  { $v_no_fa  = 'id'  ; }else{ $v_no_fa = "$no_fa = '1'" ;}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
include ('../login/config.php');
$query = "SELECT bah.id_city, bah.add_abadi,bah.add_city,bah.no_bah,bah.bah_cod_m,bah.tel_m,bah.last_name,bah.name,bah.mor_cod_m,bah.id_mar,bah.jens,bah.m_tah,bah.sh_sh,bah.cod_p,bah.fname,bah.date_t
FROM bah
INNER JOIN aria ON bah.id_city = aria.id_city
WHERE aria.id_aria='$id_aria' and aria.id_ostan='$id_ostan' and  bah.$v_id_city and  bah.$v_id_mar and  bah.$v_no_fa 
ORDER BY BINARY bah.id_city,bah.add_city,bah.add_abadi,bah.last_name ASC ";
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      </p>
    <p align="center">لیست بهره برداران کشاورزی منطقه <?php echo $id_aria ?> استان </p>
           <table width="98%" height="96" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text_r">
               <td width="6%" bgcolor="#999999">تلفن همراه کارشناس مسئول پهنه</td>
               <td width="6%" bgcolor="#999999">کد ملی کارشناس مسئول پهنه</td>
               <td width="6%" bgcolor="#999999">نام کارشناس مسئول پهنه</td>
    <td height="42" bgcolor="#999999">شماره همراه</td>
    <td bgcolor="#999999">مدرک تحصیلی</td>
    <td width="7%" bgcolor="#999999"> نام پدر<br /></td>
    <td width="7%" bgcolor="#999999">تاریخ تولد</td>
    <td width="6%" bgcolor="#999999">جنسیت</td>
    <td width="6%" bgcolor="#999999">شماره شناسنامه</td>
    <td width="6%" bgcolor="#999999">کد پستی</td>
    <td width="6%" bgcolor="#999999"> کد ملی<br /></td>
    <td width="8%" bgcolor="#999999">نام خانوادگی</td>
    <td width="7%" bgcolor="#999999"> نام </td>
    <td width="7%" bgcolor="#999999">شهر / آبادی </td>
    <td width="8%" bgcolor="#999999">شهرستان </td>
    <td width="4%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
  <?php
$r = 1 ;
 foreach($stmt as $row)
  {
$add_abadi = $row['add_abadi'];
$add_city = $row['add_city'];
if ($add_abadi<>'') {
$query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$abadi= $row2['abadi'] ; 
$mar = $row2['mar'];
}
if ($add_city<>'') {
$query = "SELECT * from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
$ostan= $row2['ostan'] ; 
$city= $row2['city'] ; 
$shahr= $row2['shahr'] ; 
$mar = $row2['mar'];
}
if ( $row['jens']=='1') $v_jens= 'مرد' ;
if ( $row['jens']=='2') $v_jens= 'زن' ;
if ( $row['m_tah']=='1') $v_m_tah= 'بیسواد' ;
if ( $row['m_tah']=='2') $v_m_tah= 'خواندن و نوشتن' ;
if ( $row['m_tah']=='3') $v_m_tah= 'سیکل' ;
if ( $row['m_tah']=='4') $v_m_tah= 'دیپلم' ;
if ( $row['m_tah']=='5') $v_m_tah= 'فوق دیپلم' ;
if ( $row['m_tah']=='6') $v_m_tah= 'لیسانس' ;
if ( $row['m_tah']=='7') $v_m_tah= 'فوق لیسانس' ;
if ( $row['m_tah']=='8') $v_m_tah= 'دکتری' ;
if ( $row['m_tah']=='9') $v_m_tah= 'تحصیلات حوزوی' ;
?>
    <td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m'])?></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m']?></td>
    <td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo user_name($row['mor_cod_m'])?></td>

  <td  width="5%" height="51" class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tel_m'];?></td>
  <td  width="5%" height="51" class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_m_tah;?></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <p><?php echo $row['fname'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_t'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_jens;?></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sh_sh'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_p'];?></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['bah_cod_m'];?></p></td>
    <td  class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'];?></td>
    <td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'];?></td>
    <td class="normalTextSmaller" style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row2['abadi'];?><?php echo $row2['shahr'];?></td>
    <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
    <td style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row2['city'];?></td>
    <td style="text-align: center" <? if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
</table>