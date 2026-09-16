<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_اختصاصی_باغ.xls");
include('../../lock_p3.php');
include('../../event.php');
 $id_ostan = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $nah_kesh = $_POST['nah_kesh'] ;
 $no_kesh = $_POST['no_kesh'] ;
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
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
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
 if ($id_ostan == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "Garden_prod.id_ostan='$id_ostan'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "Garden_prod.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "Garden_prod.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "Garden_prod.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "Garden_prod.add_city = '$add_city'" ;}
 if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "Garden.no_kesh = '$no_kesh'" ;}
 if ($nah_kesh == '0')  { $f_nah_kesh  = 1  ; }else{ $f_nah_kesh = "Garden.nah_kesh = '$nah_kesh'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "Garden_prod.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "Garden_prod.bah_cod_m = '$bah_cod_m'" ;}
 if ($z_sal == '')  { $v_z_sal  = 1  ; }else{ $v_z_sal = "Garden_prod.z_sal = '$z_sal'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "Garden_prod.cod_mah = '$mah_name'" ;}
 if ($skb1 == '')  { $v_skb1  = 1  ; }else{ $v_skb1 = "Garden_prod.s_kesht_b >= $skb1" ;}
 if ($skb2 == '')  { $v_skb2  = 1  ; }else{ $v_skb2 = "Garden_prod.s_kesht_b <= $skb2" ;}
 if ($skgb1 == '')  { $v_skgb1  = 1  ; }else{ $v_skgb1 = "Garden_prod.s_kesht_gb >= $skgb1" ;}
 if ($skgb2 == '')  { $v_skgb2  = 1  ; }else{ $v_skgb2 = "Garden_prod.s_kesht_gb <= $skgb2" ;}
 if ($treeb1 == '')  { $v_treeb1  = 1  ; }else{ $v_treeb1 = "Garden_prod.tree_b >= $treeb1" ;}
 if ($treeb2 == '')  { $v_treeb2  = 1  ; }else{ $v_treeb2 = "Garden_prod.tree_b <= $treeb2" ;}
 if ($treegb1 == '')  { $v_treegb1  = 1  ; }else{ $v_treegb1 = "Garden_prod.tree_gb >= $treegb1" ;}
 if ($treegb2 == '')  { $v_treegb2  = 1  ; }else{ $v_treegb2 = "Garden_prod.tree_gb <= $treegb2" ;}
 if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "Garden_prod.mah_tol >= $mtol1" ;}
 if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "Garden_prod.mah_tol <= $mtol2" ;}
 if ($mtolp1 == '')  { $v_mtolp1  = 1  ; }else{ $v_mtolp1 = "Garden_prod.mah_tolp >= $mtolp1" ;}
 if ($mtolp2 == '')  { $v_mtolp2  = 1  ; }else{ $v_mtolp2 = "Garden_prod.mah_tolp <= $mtolp2" ;}
 include('../../login/config.php');
 $query = " SELECT Garden_prod.*,Garden.nah_kesh
FROM Garden_prod
INNER JOIN Garden ON Garden_prod.Garden_id = Garden.id
where  $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $f_no_kesh  and $f_nah_kesh and $v_mor_cod_m and $v_bah_cod_m and  $v_z_sal and  $v_cod_mah and $v_treeb1 and $v_treeb2 and $v_treegb1 and $v_treegb2 and $v_skb1 and $v_skb2 and $v_skgb1 and $v_skgb2 and $v_mtolp1 and $v_mtolp2 and $v_mtol1 and $v_mtol2 ORDER BY Garden_prod.bah_cod_m ASC"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <br />
      </p>
      <table width="85%" border="1" align="center" cellpadding="1" cellspacing="1" bordercolor="#0099FF">
        <tr class="style8">
          <td width="5%" align="center" bgcolor="#CCCCCC">همراه مروج</td>
          <td width="4%" align="center" bgcolor="#CCCCCC"> کد ملی مروج</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">نام مروج</td>
          <td align="center" width="4%" bgcolor="#CCCCCC">میزان تولید / تن</td>
          <td align="center" width="5%" bgcolor="#CCCCCC"> پیش بینی تولید /
          تن</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">نام محصول</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">تعداد کل درخت / اصله</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">تعداد درخت عیر بارور / اصله</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">تعداد درخت بارور / اصله</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">کل سطح زیر کشت /هکتار</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">سطح زیر کشت غیر بارور/ هکتار</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">سطح زیر کشت بارور / هکتار</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">نحوه کشت</td>
          <td align="center" width="5%" bgcolor="#CCCCCC"><span class="style8"> کد ملی بهره بردار</span></td>
          <td align="center" width="7%" bgcolor="#CCCCCC">نام و نام خانوادگی بهره بردار</td>
          <td align="center" width="7%" bgcolor="#CCCCCC">شهرستان</td>
          <td align="center" width="14%" bgcolor="#CCCCCC">استان</td>
          <td align="center" width="5%" bgcolor="#CCCCCC">ردیف</td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if($nah_kesh=="1")  $f_nah_kesh = 'ساده'  ;
if($nah_kesh=="2")  $f_nah_kesh = 'مخلوط' ;
if($nah_kesh=="3")  $f_nah_kesh = 'پراکنده' ;
  ?>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_tel($row['mor_cod_m']) ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m'] ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo user_name1($row['mor_cod_m']) ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tol'] ; ?></td>
          <td bordercolor="#FFFFFF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mah_name_bagh($row['cod_mah']) ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b']+$row['tree_gb'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_gb']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_b'] + $row['s_kesht_gb'] ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_gb']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_b']+0 ; ?></td>
          <td align="center" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $f_nah_kesh ?></td>
          <td align="center" height="33" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m'] ?></td>
          <td align="center"  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><div align="right"><?php echo bah_name($row['bah_cod_m'])?></div></td>
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


