<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=لیست_واحدهای_صنعتی_براساس_عملکرد.xls");
include('../../lock_expsh.php');
include('../../event.php');
  $id_ostan1    = $_POST['id_ostan'] ;
  $id_city      = $_POST['id_city5'] ;
  $id_mar       = $_POST['id_mar'] ; 
  $add_abadi    = $_POST['add_abadi'] ;
  $add_city     = $_POST['add_city'] ;
  $NationalCode = $_POST['NationalCode'] ;
  $identCode    = $_POST['identCode'] ;
  $y_prod    = $_POST['y_prod'] ;
  $d_prod    = $_POST['d_prod'] ;
  $v_vaz    = $_POST['v_vaz'] ;

if ($v_vaz =='5') $t_vaz ='همه' ;
if ($v_vaz =='1') $t_vaz ='فعال' ;
if ($v_vaz =='2') $t_vaz ='فاقد عملکرد' ;
if ($v_vaz =='3') $t_vaz ='غیرفعال' ;
if ($v_vaz =='4') $t_vaz ='نیمه فعال' ;
if ($t_vaz !='همه') $commant = $t_vaz .' در دوره '.$d_prod.'  ماهه سال '.$y_prod ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
      <p align="center" class="style8">لیست واحد های صنایع تبدیلی و غذایی <?php echo $commant ?></p>
      </p>
      <?php
   if(1==1)
{
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "ind_unit.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "ind_unit.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "ind_unit.id_mar='$id_mar'" ;}
 if ($add_abadi == '')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "ind_unit.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "ind_unit.add_city = '$add_city'" ;}
 if ($NationalCode == '')  { $v_NationalCode  = 1  ; }else{ $v_NationalCode = "ind_unit.NationalCode = '$NationalCode'" ;}
 if ($identCode == '')  { $v_identCode  = 1  ; }else{ $v_identCode = "ind_unit.identCode = '$identCode'" ;}
$start=0;
include('../../login/config.php') ; 
if ($v_vaz =='1') $query = "SELECT ind_bah.no_bah,ind_bah.c_f_name,ind_bah.c_l_name,ind_bah.name,ind_bah.last_name,ind_bah.tel_m,ind_unit.id,
 ind_unit.id_ostan,ind_unit.id_city,ind_unit.add_abadi,ind_unit.add_city,ind_unit.NationalCode,
 ind_unit.unit_name,ind_unit.no_mal,ind_unit.identCode,ind_unit.ShenaseKasboKar
FROM ind_unit
INNER JOIN ind_bah ON ind_bah.NationalCode=ind_unit.NationalCode 
left join ind_unit_info ON ind_unit_info.ShenaseKasboKar=ind_unit.ShenaseKasboKar
 and ind_unit_info.y_prod='$y_prod' and ind_unit_info.d_prod='$d_prod' 
 where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city
and $v_identCode  and $v_NationalCode and ind_unit_info.y_prod='$y_prod' and ind_unit_info.d_prod='$d_prod' 
and ind_unit_info.v_unit='1'
group by ind_unit.ShenaseKasboKar ORDER BY NationalCode ASC" ; 

if ($v_vaz =='4') $query = "SELECT ind_bah.no_bah,ind_bah.c_f_name,ind_bah.c_l_name,ind_bah.name,ind_bah.last_name,ind_bah.tel_m,ind_unit.id,
 ind_unit.id_ostan,ind_unit.id_city,ind_unit.add_abadi,ind_unit.add_city,ind_unit.NationalCode,
 ind_unit.unit_name,ind_unit.no_mal,ind_unit.identCode,ind_unit.ShenaseKasboKar
FROM ind_unit
INNER JOIN ind_bah ON ind_bah.NationalCode=ind_unit.NationalCode 
left join ind_unit_info ON ind_unit_info.ShenaseKasboKar=ind_unit.ShenaseKasboKar
 and ind_unit_info.y_prod='$y_prod' and ind_unit_info.d_prod='$d_prod' 
 where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city
and $v_identCode  and $v_NationalCode and ind_unit_info.y_prod='$y_prod' and ind_unit_info.d_prod='$d_prod' 
and ind_unit_info.v_unit='2'
group by ind_unit.ShenaseKasboKar ORDER BY NationalCode ASC" ; 


if ($v_vaz =='2') $query = "SELECT ind_bah.no_bah,ind_bah.c_f_name,ind_bah.c_l_name,ind_bah.name,ind_bah.last_name,ind_bah.tel_m,ind_unit.id,
 ind_unit.id_ostan,ind_unit.id_city,ind_unit.add_abadi,ind_unit.add_city,ind_unit.NationalCode,
 ind_unit.unit_name,ind_unit.no_mal,ind_unit.identCode,ind_unit.ShenaseKasboKar
FROM ind_unit
INNER JOIN ind_bah ON ind_bah.NationalCode=ind_unit.NationalCode 
left join ind_unit_prod ON ind_unit_prod.ShenaseKasboKar=ind_unit.ShenaseKasboKar
 and ind_unit_prod.y_prod='$y_prod' and ind_unit_prod.d_prod='$d_prod'
left join ind_unit_info ON ind_unit_info.ShenaseKasboKar=ind_unit.ShenaseKasboKar
 and ind_unit_info.y_prod='$y_prod' and ind_unit_info.d_prod='$d_prod'
 where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city
and $v_identCode  and $v_NationalCode  and  ind_unit_prod.ShenaseKasboKar is null
and ind_unit_info.ShenaseKasboKar is null
group by ind_unit.ShenaseKasboKar ORDER BY NationalCode ASC" ; 

if ($v_vaz =='3') $query = "SELECT ind_bah.no_bah,ind_bah.c_f_name,ind_bah.c_l_name,ind_bah.name,ind_bah.last_name,ind_bah.tel_m,ind_unit.id,
 ind_unit.id_ostan,ind_unit.id_city,ind_unit.add_abadi,ind_unit.add_city,ind_unit.NationalCode,
 ind_unit.unit_name,ind_unit.no_mal,ind_unit.identCode,ind_unit.ShenaseKasboKar
FROM ind_unit
INNER JOIN ind_bah ON ind_bah.NationalCode=ind_unit.NationalCode 
left join  ind_unit_info ON ind_unit_info.ShenaseKasboKar=ind_unit.ShenaseKasboKar
 and ind_unit_info.y_prod='$y_prod' and ind_unit_info.d_prod='$d_prod'
 where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city
and $v_identCode  and $v_NationalCode and ind_unit_info.y_prod='$y_prod' and ind_unit_info.d_prod='$d_prod'
and ind_unit_info.v_unit='3'
group by ind_unit.ShenaseKasboKar ORDER BY NationalCode ASC" ; 
if ($v_vaz =='5') $query = "SELECT ind_bah.no_bah,ind_bah.c_f_name,ind_bah.c_l_name,ind_bah.name,ind_bah.last_name,ind_bah.tel_m,ind_unit.id,
 ind_unit.id_ostan,ind_unit.id_city,ind_unit.add_abadi,ind_unit.add_city,ind_unit.NationalCode,
 ind_unit.unit_name,ind_unit.no_mal,ind_unit.identCode,ind_unit.ShenaseKasboKar
FROM ind_unit
INNER JOIN ind_bah ON ind_bah.NationalCode=ind_unit.NationalCode 
INNER JOIN ind_list_product ON ind_list_product.ShenaseKasboKar=ind_unit.ShenaseKasboKar 
 where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city
and $v_identCode  and $v_NationalCode  
group by ind_unit.ShenaseKasboKar ORDER BY NationalCode ASC" ; 

 $stmt = $dbh->prepare($query);
$stmt->execute();
?>
<div align="center"></div></br>
           <table width="98%" height="68" border="1" align="center" cellpadding="1" cellspacing="1" >
             <tr align="center" class="text1">
      <td bgcolor="#999999">شماره مجوز</td>
      <td bgcolor="#999999">نام واحد</td>
      <td height="38" bgcolor="#999999">شماره همراه</td>
      <td width="8%" bgcolor="#999999"> کد/شناسه ملی<br /></td>
      <td width="8%" bgcolor="#999999">نام خانوادگی</td>
      <td width="8%" bgcolor="#999999"> نام </td>
      <td width="5%" bgcolor="#999999">نوع بهره بردار</td>
      <td width="11%" bgcolor="#999999">کد آبادی / شهر</td>
      <td width="10%" bgcolor="#999999">شهر / آبادی </td>
      <td width="9%" bgcolor="#999999">شهرستان </td>
      <td width="12%" bgcolor="#999999">استان</td>
      <td width="4%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
      <?php
$r = $start+1 ;
 foreach($stmt as $row)
  {
?>
        <td  width="8%" height="27" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['identCode'];?></td>
      <td  width="8%" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit_name'];?></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="9%" class="normalTextSmaller"><?php echo $row['tel_m'];?></td>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><p><?php echo $row['NationalCode'];?></p></td>
      <?php if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;?>
      <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name'], $row['c_l_name'];?><br /></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name'], $row['c_f_name'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_bah ;?><br /></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo '"'.$row['add_abadi'].'"';?><?php echo $row['add_city'];?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']);?><?php echo shahr_name($row['add_city']);?><br /></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']);?></td>
      <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']);?></td>
      <td class="normalTextSmaller"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
}
?>
</table>
<p align="center">---------------------- پایان گزارش ---------------------------<p>
<p>
</body>
</html>