<?php 
include("../../lock_ce.php");
include("../../event.php");
include_once('../../login/config.php') ;

$allowed_sal = array('1404', '1403', '1402');
$y_prod = isset($_GET['y_prod']) ? trim($_GET['y_prod']) : (isset($_POST['y_prod']) ? trim($_POST['y_prod']) : '1405');
if (!in_array($y_prod, $allowed_sal, true)) {
	$y_prod = '1404';
}

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=محصولات_قارچ " . $y_prod . ".xls");
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
               <td width="7%" bgcolor="#999999">سطح زیر کشت / هکتار</td>
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
 $query = "SELECT Mushroom_prod.y_prod , ostanname.ostan, Mushroom_prod.id_ostan , cityname.city, Mushroom_prod.id_city 
, Mushroom_prod.no_mush ,
SUM( Mushroom_prod.zer_kesh ) AS s_kesht_b,
SUM( Mushroom_prod.mah_tol ) AS mah_tol
FROM Mushroom_prod
INNER JOIN ostanname ON ostanname.id_ostan = Mushroom_prod.id_ostan
INNER JOIN cityname ON cityname.id_ostan = Mushroom_prod.id_ostan
AND cityname.id_city = Mushroom_prod.id_city
WHERE Mushroom_prod.y_prod = :y_prod
GROUP BY Mushroom_prod.id_ostan , Mushroom_prod.id_city , Mushroom_prod.no_mush "  ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':y_prod' => $y_prod)); 
$r = 1 ;
 foreach($stmt as $row){
if ($row['no_mush']=='1')  $v_no_mush='قارچ صدفی';
if ($row['no_mush']=='2')  $v_no_mush='قارچ دکمه ای';
if ($row['no_mush']=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';

?>
               <td align="center" height="39"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['mah_tol'],3)*1;?></td>
               <td align="center"    <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['s_kesht_b']/10000),4)*1;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['no_mush'];?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $v_no_mush ;?></td>
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




