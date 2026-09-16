<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=محصولات زراعی.xls");
include("../../lock_ce.php");
include("../../Jalali.php");
include("../../event.php");
include('counter11.php');
include_once('../../login/config.php') ;
if (isset($_POST['z_sal']))  
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan1= $_POST['id_ostan'] ;  ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

</head>
<body>
<table width="98%" height="142" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="text1">
               <td align="center" height="39" colspan="3" bgcolor="#999999">میزان تولید ، کل / بیمه شده<br />
                 <span class="style2">تن</span></td>
               <td align="center" colspan="3" bgcolor="#999999">سطح برداشت ،   اول / دوم<br />
                 <span class="style2">هکتار</span></td>
               <td align="center" colspan="3" bgcolor="#999999">سطح زیر کشت ،  اول / دوم<br />
                 <span class="style2">هکتار</span></td>
               <td align="center" width="11%" rowspan="2" bgcolor="#999999">نام محصول</td>
               <td align="center" width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
  </tr>
             <tr align="center" class="text1">
               <td align="center" height="40" bgcolor="#999999">کل</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" bgcolor="#999999">آبی</td>
               <td align="center" height="40" bgcolor="#999999">کل</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" bgcolor="#999999">آبی</td>
               <td align="center" height="40" bgcolor="#999999">کل</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" width="6%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
$query = "SELECT  DISTINCT cod_mah FROM Agri_prod where id_ostan='$id_ostan1' and z_sal = '$z_sal' order by cod_qroup "  ;
$stmt = $dbh->prepare($query);
$stmt->execute(); 
$r = 1 ;
 foreach($stmt as $row){
 $cod_mah = $row['cod_mah'] ;
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="57" ><?php echo Num2Fa(round(sum_per_mah_tol($cod_mah,'1',$id_ostan1,$z_sal) + sum_per_mah_tol($cod_mah,'2',$id_ostan1,$z_sal)*1,1)) ?><br />
                 <?php echo Num2Fa(round(sum_per_mah_tol_bem($cod_mah,'1',$id_ostan1,$z_sal) + sum_per_mah_tol_bem($cod_mah,'2',$id_ostan1,$z_sal)*1,1)) ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo Num2Fa(round(sum_per_mah_tol($cod_mah,'2',$id_ostan1,$z_sal)*1,1)) ?><br />
                <?php echo Num2Fa(round(sum_per_mah_tol_bem($cod_mah,'2',$id_ostan1,$z_sal)*1,1)) ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo Num2Fa(round(sum_per_mah_tol($cod_mah,'1',$id_ostan1,$z_sal)*1,1)) ?><br />
                 <?php echo Num2Fa(round(sum_per_mah_tol_bem($cod_mah,'1',$id_ostan1,$z_sal)*1,1)) ?></td>
               <td align="center" width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round((sum_mah_s_bar_a($cod_mah,'1',$id_ostan1,$z_sal) + sum_mah_s_bar_a($cod_mah,'2',$id_ostan1,$z_sal)),1)) ?><br />
                 <?php echo Num2Fa(round((sum_mah_s_bar_b($cod_mah,'1',$id_ostan1,$z_sal) + sum_mah_s_bar_b($cod_mah,'2',$id_ostan1,$z_sal)),1)) ?></td>
               <td align="center" width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_mah_s_bar_a($cod_mah,'2',$id_ostan1,$z_sal),1)) ?><br />
                 <?php echo Num2Fa(round(sum_mah_s_bar_b($cod_mah,'2',$id_ostan1,$z_sal),1)) ?></td>
               <td align="center" width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_mah_s_bar_a($cod_mah,'1',$id_ostan1,$z_sal),1)) ?><br />
                 <?php echo Num2Fa(round(sum_mah_s_bar_b($cod_mah,'1',$id_ostan1,$z_sal),1)) ?></td>
               <td align="center" width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round((sum_mah_zer_kesht_a($cod_mah,'1',$id_ostan1,$z_sal) + sum_mah_zer_kesht_a($cod_mah,'2',$id_ostan1,$z_sal)),1)) ?><br />
                 <?php echo Num2Fa(round((sum_mah_zer_kesht_b($cod_mah,'1',$id_ostan1,$z_sal) + sum_mah_zer_kesht_b($cod_mah,'2',$id_ostan1,$z_sal)),1)) ?></td>
               <td align="center" width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_mah_zer_kesht_a($cod_mah,'2',$id_ostan1,$z_sal),1)) ?><br />
                 <?php echo Num2Fa(round(sum_mah_zer_kesht_b($cod_mah,'2',$id_ostan1,$z_sal),1)) ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_mah_zer_kesht_a($cod_mah,'1',$id_ostan1,$z_sal),1)) ?><br />
                 <?php echo Num2Fa(round(sum_mah_zer_kesht_b($cod_mah,'1',$id_ostan1,$z_sal),1)) ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name($row['cod_mah']);?><br />
                 <?php echo $row['cod_mah'];?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
</table>
</body>
</html>



