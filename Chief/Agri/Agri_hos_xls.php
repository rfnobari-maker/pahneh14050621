<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=محصولات زراعی.xls");
include('../../lock_ce.php');
include('../../event.php');
include_once('../../login/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
        <?php

 $query = "SELECT id_ostan, id_city ,no_kesh, cod_mah ,
sum(zer_kesht_a)  zer_keshta ,
sum(zer_kesht_b)  zer_keshtb 
FROM Agri_prod1399_1400
where cod_mah >1 Group by id_ostan , id_city , no_kesh, cod_mah  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
<p align="center" dir="rtl">گزارش محصولات زراعی - سال زراعی </p>
      <table width="85%" height="89" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
        <tr align="center" class="text1">
               <td height="31" bgcolor="#999999">سطح کشت کل</td>
               <td bgcolor="#999999">کشت دوم</td>
               <td width="9%" bgcolor="#999999">کشت اول</td>
               <td valign="middle" width="12%" bgcolor="#999999">نوع کشت </td>
               <td valign="middle" width="12%" bgcolor="#999999">نام محصول</td>
               <td width="5%" bgcolor="#999999">شهرستان </td>
               <td width="5%" bgcolor="#999999">استان</td>
               <td width="5%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
$r = 1 ; 
 foreach($stmt as $row){
 $cod_mah = $row['cod_mah'] ;
round($row['zer_keshta'],3) ;
 $zer_keshta = round($row['zer_keshta'],3) ;
 $zer_keshtb = round($row['zer_keshtb'],3) ;
 $zer_keshtkol =  $zer_keshta + $zer_keshtb ; 
if ($row['no_kesh']=='1' ) $v_no_kesh= 'آبی' ; 
if ($row['no_kesh']=='2' ) $v_no_kesh= 'دیم' ; 

?>
               <td width="9%" height="40" align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshtkol ;?></td>
               <td align="center" width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshtb ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $zer_keshta ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall"><?php echo $v_no_kesh ?></span></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name($row['cod_mah']);?><br /></td>
               <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']) ?></td>
               <td align="center" bordercolor="#0099FF" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_name($row['id_ostan']) ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
         </table>
             <?php
}
?>
         </table>
</body>
</html>