<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Mush_rep3.xls");
include("../../lock_expar.php");
include_once("../../event.php");
if (isset($_POST['y_prod']))   $y_prod= $_POST['y_prod'] ; 
if (isset($_POST['id_ostan']))   $id_ostan = $_POST['id_ostan'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    	<script src="../../15_files/jquery.js" type="text/javascript"></script>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
<style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
	text-align: center;
}
    </style>
</head>
<body>
<?php 
   if (isset($_POST['y_prod']))
   {
?>
<div align="center"> اطلاعات واحدهای پرورش قارچ به تفکیک شهرستان</div>
         <table width="95%" height="199" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
           <tr align="center" class="text1">
             <td align="center" height="35" colspan="4" bgcolor="#999999">تعداد واحد دارای عملکرد سالیانه</td>
             <td align="center" colspan="4" bgcolor="#999999">تعداد واحد پرورش قارچ<br /></td>
             <td align="center" width="17%" rowspan="2" bgcolor="#999999">شهرستان </td>
             <td align="center" width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
           </tr>
           <tr align="center" class="text1">
             <td align="center" height="30" bgcolor="#999999">کل</td>
             <td align="center" bgcolor="#999999">سایر </td>
             <td align="center" bgcolor="#999999">دکمه ای</td>
             <td align="center" bgcolor="#999999">صدفی</td>
             <td align="center" height="30" bgcolor="#999999">کل</td>
             <td align="center" bgcolor="#999999">سایر </td>
             <td align="center" bgcolor="#999999">دکمه ای</td>
             <td align="center" bgcolor="#999999">صدفی</td>
           </tr>
           <tr>
             <?php
include('../../login/config.php') ;
 $query = "SELECT
Mushroom.id_city ,
count(Mushroom.id) as mush, 
sum(case when Mushroom.no_mush = '1' then 1 else 0 end) as mush_1 ,
sum(case when Mushroom.no_mush = '2' then 1 else 0 end) as mush_2 ,
sum(case when Mushroom.no_mush = '3' then 1 else 0 end) as mush_3 ,
count(Mushroom_prod.id) as mush_p, 
sum(case when Mushroom_prod.no_mush = '1' then 1 else 0 end) as mush_p_1 ,
sum(case when Mushroom_prod.no_mush = '2' then 1 else 0 end) as mush_p_2 ,
sum(case when Mushroom_prod.no_mush = '3' then 1 else 0 end) as mush_p_3
FROM (select * from Mushroom where id_ostan = $id_ostan) Mushroom 
left join
(select * from Mushroom_prod where y_prod = $y_prod) 
 Mushroom_prod ON Mushroom_prod.unit_id = Mushroom.id 
group by Mushroom.id_city"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
             <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="38" ><?php echo $row['mush_p'] ; ?></td>
             <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo $row['mush_p_3'] ; ?></td>
             <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo $row['mush_p_2'] ; ?></td>
             <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo $row['mush_p_1'] ; ?></td>
             <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mush'] ; ?><br /></td>
             <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mush_3'] ; ?><br /></td>
             <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mush_2'] ; ?><br /></td>
             <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mush_1'] ; ?><br /></td>
             <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo  city_name1($row['id_city'],$id_ostan) ; ?><br /></td>
             <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
           </tr>
           <?php
$r++ ; 
}
?>
           <?php 
 $query = "SELECT
count(Mushroom.id) as kol_mush, 
sum(case when Mushroom.no_mush = '1' then 1 else 0 end) as kol_mush_1 ,
sum(case when Mushroom.no_mush = '2' then 1 else 0 end) as kol_mush_2 ,
sum(case when Mushroom.no_mush = '3' then 1 else 0 end) as kol_mush_3 ,
count(Mushroom_prod.id) as kol_mush_p, 
sum(case when Mushroom_prod.no_mush = '1' then 1 else 0 end) as kol_mush_p_1 ,
sum(case when Mushroom_prod.no_mush = '2' then 1 else 0 end) as kol_mush_p_2 ,
sum(case when Mushroom_prod.no_mush = '3' then 1 else 0 end) as kol_mush_p_3
FROM (select * from Mushroom where id_ostan = $id_ostan) Mushroom 
left join
(select * from Mushroom_prod where y_prod = $y_prod) 
 Mushroom_prod ON Mushroom_prod.unit_id = Mushroom.id "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
           <tr align="center" class="text1">
             <td align="center" height="31" colspan="4" bgcolor="#999999">تعداد واحد دارای عملکرد سالیانه</td>
             <td align="center" colspan="4" bgcolor="#999999">تعداد واحد پرورش قارچ</td>
             <td align="center" colspan="2" rowspan="2" bgcolor="#999999">&nbsp;</td>
           </tr>
           <tr align="center" class="text1">
             <td align="center" height="25" bgcolor="#999999">کل</td>
             <td align="center" bgcolor="#999999">سایر </td>
             <td align="center" bgcolor="#999999">دکمه ای</td>
             <td align="center" bgcolor="#999999">صدفی</td>
             <td align="center" height="25" bgcolor="#999999">کل</td>
             <td align="center" bgcolor="#999999">سایر </td>
             <td align="center" bgcolor="#999999">دکمه ای</td>
             <td align="center" bgcolor="#999999">صدفی</td>
           </tr>
           <tr>
             <td align="center" height="33" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['kol_mush_p'] ; ?></td>
             <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['kol_mush_p_3'] ; ?></td>
             <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['kol_mush_p_2'] ; ?></td>
             <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['kol_mush_p_1'] ; ?></td>
             <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_mush'] ; ?><br /></td>
             <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_mush_3'] ; ?><br /></td>
             <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_mush_2'] ; ?><br /></td>
             <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['kol_mush_1'] ; ?><br /></td>
             <td align="center" colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
           </tr>
   </table>
         <?php }?>
</body>
</html>