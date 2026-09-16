<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_اختصاصی_باغ.xls");
include('../../lock_ce.php');
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
 if ($id_ostan == '-1') { $v_id_ostan = 1 ;} else { $v_id_ostan = "Garden_prod.id_ostan='$id_ostan'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "Garden_prod.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "Garden_prod.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "Garden_prod.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "Garden_prod.add_city = '$add_city'" ;}
 if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "Garden.no_kesh = '$no_kesh'" ;}
 if ($nah_kesh == '0')  { $f_nah_kesh  = 1  ; }else{ $f_nah_kesh = "Garden.nah_kesh = '$nah_kesh'" ;}
 if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "Garden.m_ab = '$m_ab'" ;}
 if ($no_ab == '')  { $f_no_ab  = 1  ; }else{ $f_no_ab = "Garden.no_ab = '$no_ab'" ;}
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
 include_once('../../login/config.php');
 $query = "SELECT id_ostan,id_city,id_mar,add_abadi,no_kesh,sum(s_kesht_b) as s_kesht_b 
  ,sum(s_kesht_gb) as s_kesht_gb ,sum(tree_b) as tree_b ,sum(tree_gb) as tree_gb ,sum(mah_tolp) as mah_tolp
  ,sum(mah_tol) as mah_tol  FROM Garden_prod WHERE z_sal = '1397' and id_ostan = '05' and add_abadi > 0 group by add_abadi , no_kesh ORDER BY add_abadi ASC"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <br />
      </p>
      <table width="99%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="2" bgcolor="#006699">میزان محصول / تن</td>
          <td colspan="3" rowspan="2" bgcolor="#006699">تعداد درخت<br />
            اصله</td>
          <td colspan="3" rowspan="2" bgcolor="#006699">سطح زیر کشت<br />
            هکتار</td>
          <td width="7%" rowspan="3" bgcolor="#006699">نوع کشت</td>
          <td width="8%" rowspan="3" bgcolor="#006699">نام آبادی</td>
          <td width="11%" rowspan="3" bgcolor="#006699">مرکز جهاد کشاورزی</td>
          <td width="11%" rowspan="3" bgcolor="#006699">شهرستان</td>
          <td width="10%" rowspan="3" bgcolor="#006699">استان</td>
          <td width="6%" rowspan="3" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="5%" rowspan="2" bgcolor="#006699">قطعی</td>
          <td width="6%" rowspan="2" bgcolor="#006699">پیش بینی</td>
        </tr>
        <tr class="text1">
          <td width="4%" bgcolor="#006699">کل</td>
          <td width="5%" bgcolor="#006699">غیر بارور</td>
          <td width="6%" bgcolor="#006699">بارور </td>
          <td width="6%"  bgcolor="#006699">کل</td>
          <td width="7%" bgcolor="#006699">غیر بارور</td>
          <td width="8%" bgcolor="#006699">بارور </td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if($row['no_kesh']=="1")  $v_no_kesh = 'آبی';
if($row['no_kesh']=="2")  $v_no_kesh = 'دیم' ;

  ?>
          <td height="53" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],4)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],4)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b']+$row['tree_gb'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_gb']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_b'] + $row['s_kesht_gb'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_gb']+0  ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_kesht_b']+0 ; ?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_kesh ;?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ;?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo mar_name($row['id_mar']) ;?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']) ;?></td>
          <td  class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']) ;?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
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


