<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_عملکرد_تولید.xls");
include('../../lock_oce.php');
include('../../event.php');
  $id_ostan1    = $_POST['id_ostan'] ;
  $id_city      = $_POST['id_city5'] ;
  $id_mar       = $_POST['id_mar'] ; 
  $add_abadi    = $_POST['add_abadi'] ;
  $add_city     = $_POST['add_city'] ;
  $mor_cod_m    = $_POST['mor_cod_m'] ;
  $NationalCode = $_POST['NationalCode'] ;
  $identCode    = $_POST['identCode'] ;
  $y_prod    = $_POST['y_prod'] ;
  $d_prod    = $_POST['d_prod'] ;
 $mtol1 = $_POST['mtol1'] ;
 $mtol2 = $_POST['mtol2'] ;
 $isic_cod1 = $_POST['isic_cod1'] ;
 $isic_cod2 = $_POST['isic_cod2'] ;
 $isic_cod3 = $_POST['isic_cod3'] ;
 $isic_cod4 = $_POST['isic_cod4'] ;
 $isic_cod5 = $_POST['isic_cod5'] ;
 $isic_cod6 = $_POST['isic_cod6'] ;
 $isic_cod7 = $_POST['isic_cod7'] ;
 $isic_cod8 = $_POST['isic_cod8'] ;
 $isic_cod9 = $_POST['isic_cod9'] ;
 $isic_cod10 = $_POST['isic_cod10'] ;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>

</head>
<body>
             <?php
   if(1==1)
{

 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "ind_unit.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "ind_unit.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "ind_unit.id_mar='$id_mar'" ;}
 if ($add_abadi == '')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "ind_unit.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "ind_unit.add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "ind_unit.mor_cod_m = '$mor_cod_m'" ;}
 if ($NationalCode == '')  { $v_NationalCode  = 1  ; }else{ $v_NationalCode = "ind_unit.NationalCode = '$NationalCode'" ;}
 if ($identCode == '')  { $v_identCode  = 1  ; }else{ $v_identCode = "ind_unit.identCode = '$identCode'" ;}
 if ($mtol1 == '')  { $v_mtol1  = 1  ; }else{ $v_mtol1 = "ind_unit_prod.m_tol >= $mtol1" ;}
 if ($mtol2 == '')  { $v_mtol2  = 1  ; }else{ $v_mtol2 = "ind_unit_prod.m_tol <= $mtol2" ;}
 if ($isic_cod1 == '')  { $v_isic_cod1  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod1 = "ind_unit_prod.isic_cod = $isic_cod1" ;}
 if ($isic_cod2 == '')  { $v_isic_cod2  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod2 = "ind_unit_prod.isic_cod = $isic_cod2" ;}
 if ($isic_cod3 == '')  { $v_isic_cod3  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod3 = "ind_unit_prod.isic_cod = $isic_cod3" ;}
 if ($isic_cod4 == '')  { $v_isic_cod4  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod4 = "ind_unit_prod.isic_cod = $isic_cod4" ;}
 if ($isic_cod5 == '')  { $v_isic_cod5  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod5 = "ind_unit_prod.isic_cod = $isic_cod5" ;}
 if ($isic_cod6 == '')  { $v_isic_cod6  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod6 = "ind_unit_prod.isic_cod = $isic_cod6" ;}
 if ($isic_cod7 == '')  { $v_isic_cod7  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod7 = "ind_unit_prod.isic_cod = $isic_cod7" ;}
 if ($isic_cod8 == '')  { $v_isic_cod8  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod8 = "ind_unit_prod.isic_cod = $isic_cod8" ;}
 if ($isic_cod9 == '')  { $v_isic_cod9  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod9 = "ind_unit_prod.isic_cod = $isic_cod9" ;}
 if ($isic_cod10 == '')  { $v_isic_cod10  = "ind_unit_prod.isic_cod =0"  ; }else{ $v_isic_cod10= "ind_unit_prod.isic_cod = $isic_cod10" ;}
 if ($isic_cod1 == '' and $isic_cod2 == '' and $isic_cod3 == '' and $isic_cod4 == '' and 
 $isic_cod5 == '' and $isic_cod6 == '' and $isic_cod7 == '' and $isic_cod8 == '' and 
 $isic_cod9 == '' and $isic_cod10 == '' ) $v_isic_cod1 = 1 ; 
$start=0;
 $v_query = "SELECT ind_bah.no_bah,ind_bah.c_f_name,ind_bah.c_l_name,ind_bah.name,ind_bah.last_name,ind_bah.tel_m,ind_unit.id,
 ind_unit.id_ostan,ind_unit.id_city,ind_unit.add_abadi,ind_unit.add_city,ind_unit.NationalCode,
 ind_unit.unit_name,ind_unit.no_mal,ind_unit.identCode,ind_unit.ShenaseKasboKar,ind_unit_prod.isic_cod,ind_unit_prod.m_tol,
ind_list_product.zarfiyat,ind_list_product.m_jazb,ind_list_product.product_name,ind_unit.mor_cod_m
FROM ind_unit
INNER JOIN ind_bah ON ind_bah.NationalCode=ind_unit.NationalCode 
INNER join ind_unit_prod ON ind_unit_prod.ShenaseKasboKar=ind_unit.ShenaseKasboKar
 and ind_unit_prod.y_prod='$y_prod' and ind_unit_prod.d_prod='$d_prod' 

INNER join ind_list_product ON ind_unit_prod.ShenaseKasboKar=ind_list_product.ShenaseKasboKar
 and ind_unit_prod.isic_cod = ind_list_product.isic_code
 
 where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city
and $v_identCode and $v_mor_cod_m and $v_NationalCode and ind_unit_prod.y_prod='$y_prod' and 
ind_unit_prod.d_prod='$d_prod' and $v_mtol1 and $v_mtol2 and
 ($v_isic_cod1 or $v_isic_cod2 or $v_isic_cod3 or $v_isic_cod4 or $v_isic_cod5 or $v_isic_cod6 or
 $v_isic_cod7 or $v_isic_cod8 or $v_isic_cod9 or $v_isic_cod10  )
 ORDER BY NationalCode ASC" ; 

include('../../login/config.php') ;
 $query = "$v_query "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<div align="center">گزارش تولید محصولات صنایع تبدیلی و غذایی در <?php echo $d_prod?> ماهه سال <?php echo $y_prod?></div>
           </br>
           <table width="98%" height="93" border="0" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text1">
      <td height="44" bgcolor="#999999">میزان تولید</td>
      <td bgcolor="#999999">ظرفیت جذب</td>
      <td bgcolor="#999999">ظرفیت سالن</td>
      <td bgcolor="#999999">نام محصول</td>
      <td bgcolor="#999999">کد آیسیک</td>
      <td bgcolor="#999999">شماره مجوز</td>
      <td width="12%" bgcolor="#999999"> شناسه /کد ملی<br /></td>
      <td width="11%" bgcolor="#999999">نام خانوادگی</td>
      <td width="9%" bgcolor="#999999"> نام </td>
      <td width="6%" bgcolor="#999999">نوع بهره بردار</td>
      <td width="4%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
      <?php
$r = $start+1 ;
 foreach($stmt as $row)
  {
?>
    <td  width="9%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tol']*1;?></td>
      <td  width="6%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_jazb']*1;?></td>
      <td  width="9%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zarfiyat']*1;?></td>
      <td  width="8%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['product_name'];?></td>
      <td  width="8%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['isic_cod'];?></td>
      <td  width="11%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['identCode'];?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['NationalCode'];?></p></td>
      <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;?>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'], $row['c_l_name'];?><br /></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'], $row['c_f_name'];?></td>
    <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?><br /></td>
      <?php 
$pic =   $row2['pic'] ;
if ($pic == '') $pic = 'no_pic.png'

 ?>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
}
?>
</table>
</body>
</html>