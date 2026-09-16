<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=تولید_به_تفکیک_شهرستان.xls");
include('../../lock_expar.php');
if(isset($_POST['id_ostan']))  $id_ostan1 = $_POST['id_ostan'];
if(isset($_POST['sal']))  $sal = $_POST['sal'];
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
<p align="center" class="style1">آمار تولید زنبورستان به تفکیک شهرستان بر اساس سرشماری <?php echo $sal?></p>
          <?php if(isset($_POST['sal']))
		  {
	include('../../login/config.php');
$query = "SELECT cityname.city,bee.`id_city`,
count(*) zan,
sum(bee.`t_sha`) t_sh ,
count(CASE WHEN bee.`bem_zan`!='3' THEN 1  END )  t_zanB ,
sum(`tm_kh`)  tm_kh ,
sum(`tm_kkh`) tm_kkh ,
sum(`tm_kdo`) tm_kdo ,
sum(bee.`tk_bo`) k_bo ,
sum(bee.`tk_mo`) k_mo ,
count(CASE WHEN bee.`bem_kand`='1' THEN 1  END )  t_kandB ,
sum(bee.`to_bo`) t_bo ,
sum(bee.`to_mo`) t_mo ,
sum(bee.`t_gar`) t_gard , 
sum(bee.`t_bar`) t_bar , 
sum(bee.`t_mom`) t_mom , 
sum(bee.`t_jel`) t_jel ,
sum(bee.`t_zah`) t_zah 
FROM `bee` 
left join cityname on cityname.id_ostan = bee.id_ostan and cityname.id_city  = bee.id_city 
WHERE bee.`sal` = '$sal' and bee.`id_ostan` = '$id_ostan1' 
group by `id_city` ORDER BY BINARY city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
        <table width="98%" height="215" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
          <tr align="center" class="text1">
            <td height="56" bgcolor="#999999">تولید زهر/g</td>
            <td bgcolor="#999999">تولید بره موم/Kg</td>
            <td bgcolor="#999999">تولید موم /Kg</td>
            <td bgcolor="#999999">تولید گرده گل /Kg</td>
            <td width="6%" bgcolor="#999999">تولید ژله رویال /Kg</td>
            <td width="6%" bgcolor="#999999">تولید کندوی مدرن /Kg</td>
            <td width="6%" bgcolor="#999999">تولید کندوی سنتی /Kg</td>
            <td width="6%" bgcolor="#999999">تعداد زنبورستان بیمه شده </td>
            <td width="6%" bgcolor="#999999">تعداد کندومی مدرن</td>
            <td width="5%" bgcolor="#999999">تعداد کندوی سنتی</td>
            <td width="4%" bgcolor="#999999">تعداد ملکه از محل خرید از بخش دولتی</td>
            <td width="5%" bgcolor="#999999">تعداد ملکه از محل خرید از بخش خصوصی</td>
            <td width="5%" bgcolor="#999999">تعداد ملکه از محل خود مصرفی</td>
            <td width="6%" bgcolor="#999999">تعداد زنبوردار تحت پوشش بیمه</td>
            <td width="7%" bgcolor="#999999">تعداد افراد شاغل</td>
            <td width="6%" bgcolor="#999999">تعداد زنبورستان</td>
            <td width="10%" bgcolor="#999999">شهرستان<br /></td>
            <td width="4%" bgcolor="#999999">ردیف</td>
          </tr>
          <tr align="center">
               <?php
$r = 1 ;
  foreach($stmt as $row){
 ?>
               <td align="center" width="4%" height="29"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_zah']/1000),3) ; ?></td>
               <td align="center" width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bar'],0) ; ?></td>
                <td align="center" width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mom'],0) ; ?></td>
                <td align="center" width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_gard'],0) ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_jel']/1000),3) ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mo'],0) ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bo'],0) ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB'] ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_mo'] ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_bo'] ; ?></td>
                <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kdo'] ; ?></td>
                <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kkh'] ; ?></td>
                <td class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kh'] ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB'] ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh'] ; ?></td>
                <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
            <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>> <div align="right" style="margin-right:2px"> <?php echo $row['city'] ;?></div></td>
            <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
<?php
$r++ ; 
}
$query = "SELECT `id_city`,
count(*) zan,
sum(`t_sha`) t_sh ,
count(CASE WHEN bee.`bem_zan`!='3' THEN 1  END )  t_zanB ,
sum(`tm_kh`)  tm_kh ,
sum(`tm_kkh`) tm_kkh ,
sum(`tm_kdo`) tm_kdo ,
sum(`tk_bo`) k_bo ,
sum(`tk_mo`) k_mo ,
count(CASE WHEN bee.`bem_kand`='1' THEN 1  END )  t_kandB ,
sum(`to_bo`) t_bo ,
sum(`to_mo`) t_mo ,
sum(`t_gar`) t_gard , 
sum(`t_bar`) t_bar , 
sum(`t_mom`) t_mom , 
sum(`t_jel`) t_jel ,
sum(`t_zah`) t_zah 
FROM `bee` WHERE `sal` = '$sal' and `id_ostan` = '$id_ostan1' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
  <tr>
     <td align="center" height="38"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_zah']/1000),3) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bar'],0) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mom'],0) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_gard'],0) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['t_jel']/1000),3) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_mo'],0) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['t_bo'],0) ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_kandB'] ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_mo'] ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['k_bo'] ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kdo'] ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kkh'] ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tm_kh'] ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_zanB'] ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['t_sh'] ; ?></td>
     <td align="center" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'] ; ?></td>
    <td align="center" colspan="2"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>جمع استان</td>
    </tr>
</table>
<?php }?>
<p align="center">-------------- پایان گزارش -------------</p>
</body>
</html>