<?php 
include("../../lock_ce.php");
include("../../event.php");
include_once('../../login/config.php') ;

$allowed_sal = array('1404', '1404', '1403', '1402');
$y_prod = isset($_GET['y_prod']) ? trim($_GET['y_prod']) : (isset($_POST['y_prod']) ? trim($_POST['y_prod']) : '1405');
if (!in_array($y_prod, $allowed_sal, true)) {
	$y_prod = '1404';
}

header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=محصولات گلخانه " . $y_prod . ".xls");
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
<table width="98%" height="181" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td width="5%" bgcolor="#999999">سایر میوه ها / تن</td>
               <td width="5%" height="31" bgcolor="#999999">نهال و قلمه / اصله</td>
               <td bgcolor="#999999">گیاهان دارویی / تن</td>
               <td bgcolor="#999999">توت فرنگی / تن </td>
               <td bgcolor="#999999">گل های فصلی در فضای باز / بوته </td>
               <td bgcolor="#999999">درخت و درختچه زینتی در فضای باز /اصله</td>
               <td bgcolor="#999999">گیاهان آپارتمانی در فضای باز / گلدان</td>
               <td bgcolor="#999999">گل شاخه بریده در فضای باز / شاخه</td>
               <td bgcolor="#999999">گل های فصلی / بوته </td>
               <td bgcolor="#999999">درخت و درختچه زینتی /اصله</td>
               <td bgcolor="#999999">گیاهان آپارتمانی / گلدان</td>
               <td width="3%" bgcolor="#999999">گل شاخه بریده / شاخه</td>
               <td width="4%" bgcolor="#999999">سایر محصولات جالیزی / تن</td>
               <td width="4%" bgcolor="#999999">سبزیجات برگی /تن</td>
               <td width="4%" bgcolor="#999999">بادمجان / تن</td>
               <td width="4%" bgcolor="#999999">فلفل /تن</td>
               <td width="4%" bgcolor="#999999">گوجه فرنگی / تن</td>
               <td width="4%" bgcolor="#999999">خیار / تن</td>
               <td width="4%" bgcolor="#999999">کد شهرستان </td>
               <td width="8%" bgcolor="#999999">شهرستان</td>
               <td width="5%" bgcolor="#999999">کد استان</td>
               <td width="11%" bgcolor="#999999">استان</td>
               <td width="6%" bgcolor="#999999">ردیف</td>
             </tr>
           
               <?php
 $query = "SELECT Greenhous_prod.y_prod , ostanname.ostan, Greenhous_prod.id_ostan , cityname.city, Greenhous_prod.id_city ,

 SUM( Greenhous_prod.no_mtol1_1 ) AS m1 , 
 SUM( Greenhous_prod.no_mtol1_2 ) AS m2 , 
 SUM( Greenhous_prod.no_mtol1_3 ) AS m3 , 
 SUM( Greenhous_prod.no_mtol1_4 ) AS m4 , 
 SUM( Greenhous_prod.no_mtol1_5 ) AS m5 , 
 SUM( Greenhous_prod.no_mtol1_6 ) AS m6 , 
 SUM( Greenhous_prod.no_mtol2_1 ) AS m7 , 
 SUM( Greenhous_prod.no_mtol2_2 ) AS m8 , 
 SUM( Greenhous_prod.no_mtol2_3 ) AS m9 , 
 SUM( Greenhous_prod.no_mtol2_4 ) AS m10 , 
 SUM( Greenhous_prod.no_mtol4_1 ) AS m11 , 
 SUM( Greenhous_prod.no_mtol4_2 ) AS m12 , 
 SUM( Greenhous_prod.no_mtol4_3 ) AS m13 , 
 SUM( Greenhous_prod.no_mtol4_4 ) AS m14 , 
 SUM( Greenhous_prod.no_mtol3_1 ) AS m15 , 
 SUM( Greenhous_prod.no_mtol3_2 ) AS m16 , 
 SUM( Greenhous_prod.no_mtol3_3 ) AS m17 , 
 SUM( Greenhous_prod.no_mtol3_4 ) AS m18 

FROM Greenhous_prod
INNER JOIN ostanname ON ostanname.id_ostan = Greenhous_prod.id_ostan
INNER JOIN cityname ON cityname.id_ostan = Greenhous_prod.id_ostan
AND cityname.id_city = Greenhous_prod.id_city
WHERE Greenhous_prod.y_prod = :y_prod
GROUP BY Greenhous_prod.id_ostan , Greenhous_prod.id_city  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute(array(':y_prod' => $y_prod)); 
$r = 1 ;
 foreach($stmt as $row){

?>
  <tr>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m18'];?></td>
               <td align="center" height="33"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m17'];?></td>
               <td align="center" width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m16'];?></td>
               <td align="center" width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m15'];?></td>
               <td align="center" width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m14'];?></td>
               <td align="center" width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m13'];?></td>
               <td align="center" width="4%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m12'];?></td>
               <td align="center" width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m11'];?></td>
               <td align="center" width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m10'];?></td>
               <td align="center" width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m9'];?></td>
               <td align="center" width="4%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m8'];?></td>
               <td align="center"    <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m7'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['m6'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['m5'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['m4'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['m3'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['m2'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['m1'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['id_city'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['id_ostan'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['ostan'];?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
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




