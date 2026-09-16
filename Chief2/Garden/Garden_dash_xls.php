<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=محصولات باغی.xls");
include("../../lock_ce.php");
include("../../event.php");
include('../../login/config.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="840" >
<br />
<table width="98%" height="72" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td width="10%" height="31" bgcolor="#999999">میزان تولید قطعی / تن </td>
               <td bgcolor="#999999">سطح زیر کشت غیربارور / هکتار</td>
               <td width="7%" bgcolor="#999999">سطح زیر کشت بارور / هکتار</td>
               <td width="8%" bgcolor="#999999">نوع کشت</td>
               <td width="8%" bgcolor="#999999">کد گروه</td>
               <td width="8%" bgcolor="#999999">گروه</td>
               <td width="8%" bgcolor="#999999">کد محصول </td>
               <td width="8%" bgcolor="#999999">محصول</td>
               <td width="8%" bgcolor="#999999">کد شهرستان </td>
               <td width="8%" bgcolor="#999999">شهرستان</td>
               <td width="11%" bgcolor="#999999">کد استان</td>
               <td width="12%" bgcolor="#999999">استان</td>
               <td width="5%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
 $query = "SELECT Garden_prod.z_sal , ostanname.ostan, Garden_prod.id_ostan , cityname.city, Garden_prod.id_city , product_b.product_name, Garden_prod.cod_mah , product_b.group_name, Garden_prod.cod_qroup , Garden_prod.no_kesh, SUM( Garden_prod.s_kesht_b ) AS s_kesht_b, SUM( Garden_prod.s_kesht_gb ) AS s_kesht_gb, SUM( Garden_prod.mah_tol ) AS mah_tol
FROM Garden_prod
INNER JOIN ostanname ON ostanname.id_ostan = Garden_prod.id_ostan
INNER JOIN cityname ON cityname.id_ostan = Garden_prod.id_ostan
AND cityname.id_city = Garden_prod.id_city
INNER JOIN product_b ON product_b.group_cod = Garden_prod.cod_qroup
AND product_b.product_cod = Garden_prod.cod_mah
WHERE Garden_prod.z_sal = '1400'
GROUP BY Garden_prod.id_ostan , Garden_prod.id_city , Garden_prod.cod_mah , Garden_prod.no_kesh "  ;
$stmt = $dbh->prepare($query);
$stmt->execute(); 
$r = 1 ;
 foreach($stmt as $row){
	 if($row['no_kesh'] == '') $v_no_kesh = 'کشت پراکنده' ;
	 if($row['no_kesh'] == '1') $v_no_kesh = 'آبی' ;
 	 if($row['no_kesh'] == '2') $v_no_kesh = 'دیم' ;

?>
               <td align="center" height="39"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1;?></td>
               <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_kesht_gb'],4)*1;?></td>
               <td align="center"    <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_kesht_b'],4)*1;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $v_no_kesh;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['cod_qroup'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['group_name'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['cod_mah'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['product_name'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['id_city'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['id_ostan'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['ostan'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
     </table>
</body>           </div>
          <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
    </tr>
</table>
</table>
</body>




