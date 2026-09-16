<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_ویژه_زراعی.xls");
include('../../lock_ce.php');
include('../../event.php');
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $no_kesh = $_POST['no_kesh'] ;
 $m_ab      = $_POST['m_ab'] ;
 $no_ab     = $_POST['no_ab'] ;
 $mor_cod_m = $_POST['mor_cod_m'] ;
 $bah_cod_m = $_POST['bah_cod_m'] ;
 $z_sal = $_POST['z_sal'] ;
 $z_sal = $_POST['z_sal'] ;
 $zka1 = $_POST['zka1'] ;
 $zka2 = $_POST['zka2'] ;
 $zkb1 = $_POST['zkb1'] ;
 $zkb2 = $_POST['zkb2'] ;
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
 $Agri_table     = 'Agri'.str_replace('-','_',$z_sal) ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 
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
      <p align="center"  class="style8">گزارش اختصاصی اطلاعات زراعی 
        <?php
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "$Agri_prod_table.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "$Agri_prod_table.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "$Agri_prod_table.id_mar='$id_mar'" ;}
 if ($add_abadi  == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "$Agri_prod_table.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  { $f_add_city  = 1  ; }else{ $f_add_city = "$Agri_prod_table.add_city = '$add_city'" ;}
 if ($no_kesh == '0')  { $f_no_kesh  = 1  ; }else{ $f_no_kesh = "$Agri_prod_table.no_kesh = '$no_kesh'" ;}
 if ($m_ab == '')  { $f_m_ab  = 1  ; }else{ $f_m_ab = "Agri.m_ab = '$m_ab'" ;}
 if ($no_ab == '')  { $f_no_ab  = 1  ; }else{ $f_no_ab = "Agri.no_ab = '$no_ab'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "$Agri_prod_table.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "$Agri_prod_table.bah_cod_m = '$bah_cod_m'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "$Agri_prod_table.cod_mah = '$mah_name'" ;}
 if ($zka1 == '')  { $v_zka1  = 1  ; }else{ $v_zka1 = "$Agri_prod_table.zer_kesht_a >= $zka1" ;}
 if ($zka2 == '')  { $v_zka2  = 1  ; }else{ $v_zka2 = "$Agri_prod_table.zer_kesht_a <= $zka2" ;}
 if ($zkb1 == '')  { $v_zkb1  = 1  ; }else{ $v_zkb1 = "$Agri_prod_table.zer_kesht_b >= $zkb1" ;}
 if ($zkb2 == '')  { $v_zkb2  = 1  ; }else{ $v_zkb2 = "$Agri_prod_table.zer_kesht_b <= $zkb2" ;}
 if ($sba1 == '')  { $v_sba1  = 1  ; }else{ $v_sba1 = "$Agri_prod_table.s_bar_a >= $sba1" ;}
 if ($sba2 == '')  { $v_sba2  = 1  ; }else{ $v_sba2 = "$Agri_prod_table.s_bar_a <= $sba2" ;}
 if ($sbb1 == '')  { $v_sbb1  = 1  ; }else{ $v_sbb1 = "$Agri_prod_table.s_bar_b >= $sbb1" ;}
 if ($sbb2 == '')  { $v_sbb2  = 1  ; }else{ $v_sbb2 = "$Agri_prod_table.s_bar_b <= $sbb2" ;}
 if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "$Agri_prod_table.mah_tol >= $mtol1" ;}
 if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "$Agri_prod_table.mah_tol <= $mtol2" ;}
 if ($mtolp1 == '')  { $v_mtolp1  = 1  ; }else{ $v_mtolp1 = "$Agri_prod_table.mah_tolp >= $mtolp1" ;}
 if ($mtolp2 == '')  { $v_mtolp2  = 1  ; }else{ $v_mtolp2 = "$Agri_prod_table.mah_tolp <= $mtolp2" ;}
 include_once('../../login/config.php');
  $query = "SELECT id_ostan,id_city,id_mar,add_abadi,sum(zer_kesht_a) as zer_kesht_a ,
    sum(zer_kesht_b) as zer_kesht_b ,sum(s_bar_a) as s_bar_a,sum(s_bar_b) as s_bar_b,
	sum(mah_tolp) as mah_tolp , sum(mah_tol) as mah_tol , no_kesh  FROM Agri_prod1396_1397 WHERE id_ostan = '05' and 
	 add_abadi > 0 group by add_abadi , no_kesh ORDER BY add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
             <br />
      </p>
<?php 
echo '*********** شرایط اعمال شده : ***************' ;
echo '<br>' ;
echo 'کد استان :'. $id_ostan1  ;
echo '<br>' ;
echo 'کد شهرستان : '. $id_city ;
echo '<br>' ;
echo 'کد مرکز : '. $id_mar  ;
echo '<br>' ; 
echo 'آدرس آماری آبادی : '. $add_abadi  ;
echo '<br>' ;
echo 'آدرس آماری شهر : '. $add_city  ;
echo '<br>' ;
echo 'نوع کشت : '. $no_kesh  ;
echo '<br>' ;
echo 'منبع آبیاری : '. $m_ab ;
echo '<br>' ;
echo 'نوع آبیاری : '. $no_ab;
echo '<br>' ;
echo 'کد ملی مروج : '. $mor_cod_m;
echo '<br>' ;
echo 'کد ملی بهره بردار : '. $bah_cod_m;
echo '<br>' ;
echo 'سال زراعی : '. $z_sal;
echo '<br>' ;
echo 'کد محصول : '. $mah_name ;
echo '<br>' ;
echo 'زیر کشت اول بزرگتر یا مساوی : '. $zka1 ;
echo '<br>' ;
echo 'زیر کشت اول کوچکتر یا مساوی : '. $zka2  ;
echo '<br>' ;
echo 'زیر کشت دوم بزرگتر یا مساوی : '. $zkb1 ;
echo '<br>' ;
echo 'زیر کشت دوم بزرگتر یا مساوی : '. $zkb2;
echo '<br>' ;
echo 'سطح برداشت اول بزرگتر یا مساوی : '. $sba1 ;
echo '<br>' ;
echo 'سطح برداشت اول کوچتر یا مساوی : '. $sba2 ;
echo '<br>' ;
echo 'سطح برداشت دوم بزرگتر یا مساوی : '. $sbb1 ;
echo '<br>' ;
echo 'سطح برداشت دوم کوچکتر یا مساوی : '. $sbb2;
echo '<br>' ;
echo 'میزان تولید قطعی بزرگتر یا مساوی : '. $mtol1;
echo '<br>' ;
echo ' میزان تولید قطعی کوچکتر یا مساوی : '. $mtol2;
echo '<br>' ;
echo ' میزان پیش بینی تولید بزرگتر یا مساوی : '. $mtolp1;
echo '<br>' ;
echo 'میزان پیش بینی تولید کوچکتر یا مساوی : '. $mtolp2;
echo '<br>' ;
?>
      <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
        <tr class="text1">
          <td colspan="2" bgcolor="#006699">میزان محصول / تن</td>
          <td colspan="3" rowspan="2" bgcolor="#006699">سطح برداشت / هکتار</td>
          <td colspan="3" rowspan="2" bgcolor="#006699">سطح زیر کشت/ هکتار</td>
          <td width="11%" rowspan="3" bgcolor="#006699">نوع کشت</td>
          <td width="11%" rowspan="3" bgcolor="#006699">نام آبادی</td>
          <td width="8%" rowspan="3" bgcolor="#006699">مرکز</td>
          <td width="10%" rowspan="3" bgcolor="#006699">شهرستان</td>
          <td width="9%" rowspan="3" bgcolor="#006699">استان</td>
          <td width="7%" rowspan="3" bgcolor="#006699">ردیف</td>
        </tr>
        <tr class="text1">
          <td width="5%" rowspan="2" bgcolor="#006699">قطعی</td>
          <td width="6%" rowspan="2" bgcolor="#006699">پیش بینی</td>
          </tr>
        <tr class="text1">
          <td width="5%" bgcolor="#006699">کل</td>
          <td width="4%" bgcolor="#006699">دوم</td>
          <td width="6%" bgcolor="#006699">اول </td>
          <td width="5%"  bgcolor="#006699">کل</td>
          <td width="5%" bgcolor="#006699">دوم</td>
          <td width="8%" bgcolor="#006699">اول </td>
        </tr>
        <tr>
          <?php 
$r = $start+1 ;
foreach($stmt as $row){ 
if ($row['no_kesh'] == '1') $v_no_kesh = 'آبی' ; 
if ($row['no_kesh'] == '2') $v_no_kesh = 'دیم' ; 
?>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tolp'],3)*1 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+$row['s_bar_b'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_b']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar_a']+0 ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a'] + $row['zer_kesht_b'] ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']+0  ; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a']+0 ; ?></td>
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


