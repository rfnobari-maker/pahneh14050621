<?php 
header("Content-type: application/vnd.ms-world;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_اختصاصی_باغ.doc");
include('../../lock_cp.php');
include('../../event.php');
 $id_ostan = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $nah_kesh = $_POST['nah_kesh'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $m_ab      = $_POST['m_ab'] ;
 $no_ab     = $_POST['no_ab'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $skb1 = $_POST['skb1'] ;
 $skb2 = $_POST['skb2'] ;
 $skgb1 = $_POST['skgb1'] ;
 $skgb2 = $_POST['skgb2'] ;
 $treeb1 = $_POST['treeb1'] ;
 $treeb2 = $_POST['treeb2'] ;
 $treegb1 = $_POST['treegb1'] ;
 $treegb2 = $_POST['treegb2'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;
 $sba1 = $_POST['sba1'] ;
 $sba2 = $_POST['sba2'] ;
 $sbb1 = $_POST['sbb1'] ;
 $sbb2 = $_POST['sbb2'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;
 $mtolp1 = $_POST['mtolp1'] ;
 $mtolp2 = $_POST['mtolp2'] ;
 $z_sal =  $_POST['z_sal'] ; 
  $mah_kh = $_POST['mah_kh'] ;

// کد گروه و کد محصول
// $mah_qroup = $_POST['mah_qroup'] ;
 $mah_name = $_POST['mah_name'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
      <p align="center"  class="style8">گزارش اختصاصی اطلاعات باغی 
        <?php
$conditions = array();
if ($id_ostan1 = '-1')     $conditions[] = "Garden_prod.id_ostan = '$id_ostan'";
if ($id_city != 0)          $conditions[] = "Garden_prod.id_city = '$id_city'";
if ($id_mar != 0)           $conditions[] = "Garden_prod.id_mar = '$id_mar'";
if ($add_abadi != '0')      $conditions[] = "Garden_prod.add_abadi = '$add_abadi'";
if ($add_city != '0')       $conditions[] = "Garden_prod.add_city = '$add_city'";
if ($no_kesh != '0')        $conditions[] = "Garden.no_kesh = '$no_kesh'";
if ($nah_kesh != '0')       $conditions[] = "Garden.nah_kesh = '$nah_kesh'";
if ($m_ab !== '')           $conditions[] = "Garden.m_ab = '$m_ab'";
if ($no_ab !== '')          $conditions[] = "Garden.no_ab = '$no_ab'";
if ($mor_cod_m !== '')      $conditions[] = "Garden_prod.mor_cod_m = '$mor_cod_m'";
if ($bah_cod_m !== '')      $conditions[] = "Garden_prod.bah_cod_m = '$bah_cod_m'";
if ($z_sal !== '')          $conditions[] = "Garden_prod.z_sal = '$z_sal'";
if ($mah_name !== '')       $conditions[] = "Garden_prod.cod_mah = '$mah_name'";
if ($skb1 !== '')           $conditions[] = "Garden_prod.s_kesht_b >= $skb1";
if ($skb2 !== '')           $conditions[] = "Garden_prod.s_kesht_b <= $skb2";
if ($skgb1 !== '')          $conditions[] = "Garden_prod.s_kesht_gb >= $skgb1";
if ($skgb2 !== '')          $conditions[] = "Garden_prod.s_kesht_gb <= $skgb2";
if ($treeb1 !== '')         $conditions[] = "Garden_prod.tree_b >= $treeb1";
if ($treeb2 !== '')         $conditions[] = "Garden_prod.tree_b <= $treeb2";
if ($treegb1 !== '')        $conditions[] = "Garden_prod.tree_gb >= $treegb1";
if ($treegb2 !== '')        $conditions[] = "Garden_prod.tree_gb <= $treegb2";
if ($mtol1 !== '')          $conditions[] = "Garden_prod.mah_tol >= $mtol1";
if ($mtol2 !== '')          $conditions[] = "Garden_prod.mah_tol <= $mtol2";
if ($mtolp1 !== '')         $conditions[] = "Garden_prod.mah_tolp >= $mtolp1";
if ($mtolp2 !== '')         $conditions[] = "Garden_prod.mah_tolp <= $mtolp2";
if ($mah_kh != '0')         $conditions[] = "Garden_prod.mah_kh = '$mah_kh'";
// ساختن شرط نهایی
$whereClause = '';
if (count($conditions) > 0) {
    $whereClause = 'WHERE ' . implode(' AND ', $conditions);
}
 include_once('../../login/config.php');
 $query = " SELECT Garden_prod.*,Garden.nah_kesh
FROM Garden_prod
INNER JOIN Garden ON Garden_prod.Garden_id = Garden.id
$whereClause
  ORDER  BY Garden_prod.bah_cod_m ASC"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <br />
      </p>
      <table width="85%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0099FF">
        <tr class="style8">
          <td width="4%" align="center" bgcolor="#CCCCCC">همراه مروج</td>
          <td width="3%" align="center" bgcolor="#CCCCCC"> کد ملی مروج</td>
          <td align="center" width="3%" bgcolor="#CCCCCC">نام مروج</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">میزان تولید / تن</td>
          <td align="center" width="4%" bgcolor="#CCCCCC"> پیش بینی تولید /
          تن</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">بیمه</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">خسارت</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">نام محصول</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">تعداد کل درخت / اصله</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">تعداد درخت عیر بارور / اصله</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">تعداد درخت بارور / اصله</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">کل سطح زیر کشت /هکتار</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">سطح زیر کشت غیر بارور/ هکتار</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">سطح زیر کشت بارور / هکتار</td>
          <td align="center" width="6%" bgcolor="#CCCCCC">نحوه کشت</td>
          <td align="center" width="7%" bgcolor="#CCCCCC">نوع کشت</td>
          <td align="center" width="7%" bgcolor="#CCCCCC">همراه بهره بردار</td>
          <td align="center" width="7%" bgcolor="#CCCCCC"><span class="style8"> کد ملی بهره بردار</span></td>
          <td align="center" width="11%" bgcolor="#CCCCCC">نام و نام خانوادگی بهره بردار</td>
          <td width="4%" align="center" bgcolor="#CCCCCC">نام آبادی </td>
          <td width="4%" align="center" bgcolor="#CCCCCC">آدرس آماری آبادی </td>
          <td width="3%" align="center" bgcolor="#CCCCCC">نام شهر </td>
          <td width="6%" align="center" bgcolor="#CCCCCC">آدرس آماری شهر</td>
          <td align="center" width="8%" bgcolor="#CCCCCC">تاریخ ثبت / ویرایش</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">مرکز</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">شهرستان</td>
          <td align="center" width="9%" bgcolor="#CCCCCC">استان</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if($row['no_kesh']=="1")  $v_no_kesh = 'آبی'  ;
if($row['no_kesh']=="2")  $v_no_kesh = 'دیم' ;

if($row['nah_kesh']=="1")  $v_nah_kesh = 'ساده'  ;
if($row['nah_kesh']=="2")  $v_nah_kesh = 'مخلوط' ;
if($row['nah_kesh']=="3")  $v_nah_kesh = 'پراکنده' ;

if($row['mah_bem']=="1")  $v_mah_bem = 'هست' ;
if($row['mah_bem']=="2")  $v_mah_bem = 'نیست' ;

if($row['mah_kh']=="1")  $v_mah_kh = 'بلی' ;
if($row['mah_kh']=="2")  $v_mah_kh = 'خیر' ;

  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name1($row['mor_cod_m']) ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],4)*1 ; ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],4)*1 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_mah_bem?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_mah_kh?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name_bagh($row['cod_mah']) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b']+$row['tree_gb'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_gb']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_b'] + $row['s_kesht_gb'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_gb']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_b']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_nah_kesh ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmaller" style="text-align: center"><?php echo bah_tel_m($row['bah_cod_m']);?></span></td>
          <td align="center" height="33" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo '"'.$row['add_abadi'].'"' ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo shahr_name($row['add_city']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['add_city'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
        </tr>
        <?php 
	$r++ ; 
	}
	?>
    </table>
   <?php }  
  else { echo '<p class="style8">اطلاعاتی یافت نشد</p>'; }
?>   
</body>
</html>


