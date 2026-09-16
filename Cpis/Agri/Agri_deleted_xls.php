<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=محصولات_حذف_شده_زراعی.xls");
include("../../lock_cp.php");
include_once("../../event.php");
if (isset($_POST['z_sal'])) 
{
  $z_sal= $_POST['z_sal'] ; 
  $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  
}
if (isset($_POST['id_ostan']))   $id_ostan1= $_POST['id_ostan'] ; 
if (isset($_POST['mah_qroup'])) $mah_qroup = $_POST['mah_qroup'] ;
if (isset($_POST['mah_name'])) $mah_name = $_POST['mah_name'] ;
if (isset($_POST['mor_cod_m'])) $mor_cod_m = $_POST['mor_cod_m'];
if (isset($_POST['bah_cod_m'])) $bah_cod_m = $_POST['bah_cod_m'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
   

</head>
<body>
 <div align="center"  class="style8">لیست محصولات زراعی حذف شده </div>
      <?php 
   if (isset($_POST['z_sal']))
   {
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan= $_POST['id_ostan'] ;  ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  
 if ($mor_cod_m == '')  { $v_mor_cod_m  = 1  ; }else{ $v_mor_cod_m = "del_rec.mor_cod_m = '$mor_cod_m'" ;}
 if ($bah_cod_m == '')  { $v_bah_cod_m  = 1  ; }else{ $v_bah_cod_m = "del_rec.bah_cod_m = '$bah_cod_m'" ;}
 if ($mah_name == '')  { $v_cod_mah  = 1  ; }else{ $v_cod_mah = "del_rec.cod_mah = '$mah_name'" ;}

?>
<table width="98%" height="100" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td align="center" height="35" colspan="3" bgcolor="#999999">کارشناس<br /></td>
               <td align="center" colspan="3" bgcolor="#999999">بهره بردار<span class="style2"></span></td>
               <td align="center" rowspan="2" bgcolor="#999999">پیش بینی تولید</td>
               <td align="center" rowspan="2" bgcolor="#999999">سطح زیر کشت دوم هکتار</td>
               <td align="center" rowspan="2" bgcolor="#999999">سطح زیر کشت اول هکتار</td>
               <td rowspan="2" bgcolor="#999999">نام محصول</td>
               <td width="5%" rowspan="2" bgcolor="#999999">نوع کشت </td>
               <td width="5%" rowspan="2" bgcolor="#999999">تاریخ ثبت</td>
               <td align="center" width="6%" rowspan="2" bgcolor="#999999">تاریخ حذف</td>
               <td align="center" width="5%" rowspan="2" bgcolor="#999999">شهر/آبادی</td>
               <td align="center" width="5%" rowspan="2" bgcolor="#999999">مرکز</td>
               <td align="center" width="6%" rowspan="2" bgcolor="#999999">شهرستان</td>
               <td align="center" width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td align="center" height="32" bgcolor="#999999">کد ملی </td>
               <td align="center" bgcolor="#999999">نام خانوادگی</td>
               <td align="center" width="7%" bgcolor="#999999">نام </td>
               <td align="center" height="32" bgcolor="#999999">کد ملی </td>
               <td align="center" bgcolor="#999999">نام خانوادگی</td>
               <td align="center" bgcolor="#999999">نام </td>
              </tr>
               <?php
include_once('../../login/config.php') ;
 $query = "SELECT del_rec.cod_mah,del_rec.date_s,del_rec.add_abadi,del_rec.add_city,del_rec.no_kesh,del_rec.zer_kesht_a,del_rec.zer_kesht_b,del_rec.mah_tolp,del_rec.Date,del_rec.sal,del_rec.mor_cod_m,del_rec.bah_cod_m,users.city,users.markaz,users.name,users.last_name 
FROM del_rec
inner join users On del_rec.mor_cod_m = users.username
 WHERE del_rec.Table_name = '$Agri_prod_table' and $v_cod_mah and users.id_ostan = '$id_ostan1' and $v_mor_cod_m and $v_bah_cod_m ORDER BY del_rec.Date DESC  " ;
 $stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
 if ($row['no_kesh']=='1') $v_no_kesh='آبی' ;	 
 if ($row['no_kesh']=='2') $v_no_kesh='دیم' ;	 

?>
             <tr>
               <td align="center" width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m']?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name']?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name']?></td>
               <td align="center" width="7%" height="31"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m']?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_last_name($row['bah_cod_m'])?></td>
               <td align="center" width="5%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_first_name($row['bah_cod_m'])?></td>
               <td align="center" width="5%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mah_tolp']*1?></td>
               <td align="center" width="5%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_b']*1?></td>
               <td align="center" width="5%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zer_kesht_a']*1?></td>
               <td align="center" width="5%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  mah_name($row['cod_mah'])?></td>
               <td align="center" width="5%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><span class="normalTextSmall"><?php echo $v_no_kesh?></span></td>
               <td align="center" width="5%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s']?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['Date']?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo abadi_name($row['add_abadi']) ?><?php echo shahr_name($row['add_city']) ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['markaz']?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city']?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
        <?php 
	$r++ ; 
	}
	?>
</table>
   <?php }  
 
?>
  