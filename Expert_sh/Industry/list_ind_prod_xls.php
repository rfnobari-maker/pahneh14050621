<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=عملکرد_سالانه_واحدهای_صنعتی.xls");
include('../../lock_expsh.php');
include('../../event.php');
  $id_ostan1 = $_POST['id_ostan'] ;
  $id_city = $_POST['id_city5'] ;
  $id_mar = $_POST['id_mar'] ; 
  $add_abadi = $_POST['add_abadi'] ;
  $add_city = $_POST['add_city'] ;
  $mor_cod_m = $_POST['mor_cod_m'] ;
  $bah_cod_m = $_POST['bah_cod_m'] ;
  $y_prod = $_POST['y_prod'] ;
  $v_unit = $_POST['v_unit'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
             <p>
               <?php
   if(isset($_POST['id_ostan']))
{
 if ($id_ostan1 == '-1')    { $v_id_ostan = 1 ;} else { $v_id_ostan = "ind_unit.id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)    { $v_id_city = 1 ;} else { $v_id_city = "ind_unit.id_city='$id_city'" ;}
 if ($id_mar  == 0)    { $v_id_mar = 1 ;} else { $v_id_mar = "ind_unit.id_mar='$id_mar'" ;}
 if ($add_abadi == '0')  { $f_add_abadi  = 1  ; }else{ $f_add_abadi = "ind_unit.add_abadi = '$add_abadi'" ;}
 if ($add_city  == '')  { $f_add_city  = 1  ; }else{ $f_add_city = "ind_unit.add_city = '$add_city'" ;}
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "ind_unit.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "ind_unit.bah_cod_m = '$bah_cod_m'" ;}
 if ($y_prod == '0')  { $f_y_prod  = 1  ; }else{ $f_y_prod = "ind_unit_info.y_prod = '$y_prod'" ;}
 if ($v_unit == '0')  { $f_v_unit  = 1  ; }else{ $f_v_unit = "ind_unit_info.v_unit = '$v_unit'" ;}

$start=0;
include('../../login/config.php') ; 
$query = "SELECT ind_bah.no_bah,ind_bah.name,ind_bah.last_name,ind_bah.tel_m,ind_unit.id,ind_unit.id_ostan,ind_unit.id_city,ind_unit.add_abadi,ind_unit.add_city,ind_unit.bah_cod_m,ind_unit.unit_name,
ind_unit.no_mal,ind_unit.num_bah,ind_unit_info.y_prod,ind_unit_info.v_unit
FROM ind_unit
INNER JOIN ind_bah ON ind_bah.bah_cod_m=ind_unit.bah_cod_m and ind_bah.num_bah =ind_unit.num_bah 
INNER JOIN ind_unit_info ON ind_unit.id = ind_unit_info.unit_id 
 where $v_id_ostan  and $v_id_city and  $v_id_mar and $f_add_abadi and $f_add_city and $v_mor_cod_m and $v_bah_cod_m and $f_y_prod and $f_v_unit ORDER BY BINARY last_name ASC "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
?></p>
<p align="center">لیست واحد های صنعتی </p>
           <table width="98%" height="73" border="1" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td bgcolor="#999999">وضعیت واحد</td>
               <td bgcolor="#999999">عملکرد سال</td>
      <td height="40" bgcolor="#999999">نام واحد</td>
      <td width="9%" bgcolor="#999999"> کد ملی<br /></td>
      <td width="9%" bgcolor="#999999">نام خانوادگی</td>
      <td width="9%" bgcolor="#999999"> نام </td>
      <td width="6%" bgcolor="#999999">نام شرکت</td>
      <td width="6%" bgcolor="#999999">نوع بهره بردار</td>
      <td width="9%" bgcolor="#999999">کد آبادی / شهر </td>
      <td width="9%" bgcolor="#999999">شهر / آبادی </td>
      <td width="12%" bgcolor="#999999">شهرستان </td>
      <td width="8%" bgcolor="#999999">استان</td>
      <td width="4%" bgcolor="#999999">ردیف</td>
    </tr>
  <tr>
      <?php
$r = $start+1 ;
 foreach($stmt as $row)
  {
$mor_cod_m1=$row['mor_cod_m'];
$add_abadi1 = $row['add_abadi'];
$add_city = $row['add_city'];
 if($row['v_unit'] == '1') $v_v_unit = 'فعال'   ;
 if($row['v_unit'] == '2') $v_v_unit = 'نیمه فعال';
 if($row['v_unit'] == '3') $v_v_unit = 'غیر فعال' ;
 if($row['no_bah'] == '1') $v_no_bah = 'حقیقی' ; else $v_no_bah='حقوقی' ;
?>
      <td align="center"  width="10%" class="normalTextSmaller" ><?php echo $v_v_unit;?></td>
      <td align="center"  width="10%" class="normalTextSmaller" ><?php echo $row['y_prod'];?></td>
      <td align="center"  width="10%" height="31" class="normalTextSmaller" ><?php echo $row['unit_name'];?></td>
      <td align="center"class="normalTextSmaller" ><p><?php echo $row['bah_cod_m'];?></p></td>
      <td align="center"class="normalTextSmaller" ><?php echo $row['last_name'];?><br /></td>
      <td align="center"class="normalTextSmaller" ><?php echo $row['name'];?></td>
      <td align="center"class="normalTextSmaller" ><?php echo $row['co_name'];?></td>
      <td align="center"class="normalTextSmaller" ><?php echo $v_no_bah ;?><br /></td>
      <td align="center"class="normalTextSmaller" ><?php echo $row['add_abadi'];?><?php echo $row['add_city'];?></td>
      <td align="center"class="normalTextSmaller" ><?php echo abadi_name($row['add_abadi']);?><?php echo shahr_name($row['add_city']);?><br /></td>
      <td align="center"class="normalTextSmaller" ><?php echo city_name1($row['id_city'],$id_ostan);?></td>
      <td align="center"class="normalTextSmaller" ><?php echo ostan_name($id_ostan);?></td>
      <td align="center"class="normalTextSmaller"><?php echo $r;?></td>
    </tr>
    <?php
$r++ ; 
}
}
?>
</table>
<p align="center">---------------------- پایان گزارش ---------------------------<p>
</body>
</html>