<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=محصولات_حذف_شده_زراعی.xls");
include("../../lock_cp.php");
include_once("../../event.php");
if (isset($_GET['id_ostan1'])) {
    $z_sal= '1402-1403' ; 
    $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  
    $id_ostan1 = $_GET['id_ostan1']; }
if (isset($_POST['mah_qroup'])) $mah_qroup = $_POST['mah_qroup'] ;
if (isset($_POST['mah_name'])) $mah_name = $_POST['mah_name'] ;
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
 <div align="center"  class="style8">لیست محصولات زراعی حذف شده استان  در سال زراعی 1403-1402</div>
      <?php 
   if (1==1)
   {
?>
           <table width="98%" height="103" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td align="center" height="33" colspan="3" bgcolor="#999999">کارشناس<br /></td>
               <td align="center" colspan="3" bgcolor="#999999">بهره بردار<span class="style2"></span></td>
               <td align="center" rowspan="2" bgcolor="#999999">نام محصول</td>
               <td align="center" width="7%" rowspan="2" bgcolor="#999999">تاریخ حذف</td>
               <td align="center" width="7%" rowspan="2" bgcolor="#999999">مرکز</td>
               <td align="center" width="7%" rowspan="2" bgcolor="#999999">شهرستان</td>
               <td align="center" width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td align="center" height="26" bgcolor="#999999">کد ملی </td>
               <td align="center" bgcolor="#999999">نام خانوادگی</td>
               <td align="center" width="12%" bgcolor="#999999">نام </td>
               <td align="center" height="26" bgcolor="#999999">کد ملی </td>
               <td align="center" bgcolor="#999999">نام خانوادگی</td>
               <td align="center" bgcolor="#999999">نام </td>
              </tr>
               <?php
include_once('../../login/config.php') ;
  $query = "SELECT del_rec.cod_mah,del_rec.Date,del_rec.sal,del_rec.mor_cod_m,del_rec.bah_cod_m,users.city,users.markaz,users.name,users.last_name 
FROM del_rec
inner join users On del_rec.mor_cod_m = users.username
 WHERE del_rec.Table_name = '$Agri_prod_table' and users.id_ostan = '$id_ostan1' order by users.city " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
             <tr>
               <td align="center" width="13%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mor_cod_m']?></td>
               <td align="center" width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['last_name']?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['name']?></td>
               <td align="center" width="14%" height="42"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['bah_cod_m']?></td>
               <td align="center" width="11%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_last_name($row['bah_cod_m'])?></td>
               <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_first_name($row['bah_cod_m'])?></td>
               <td align="center" width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  mah_name($row['cod_mah'])?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['Date']?></td>
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
  