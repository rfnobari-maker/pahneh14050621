<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=گزارش_واحدهای_صنعتی.doc");
include_once("../../event.php");
include('../../login/config.php') ;
if (isset($_POST['y_prod']))  $y_prod= $_POST['y_prod'] ; 
if(isset($_POST['id_ostan'])) $id_ostan1 = $_POST['id_ostan'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
<p align="center">گزارش واحد های صنایع تبدیلی و غذایی به تفکیک 
  <?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?> در سال <?php echo $y_prod?></p>
           <table width="100%" height="184" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="28" colspan="4" bgcolor="#999999">دوازده ماهه</td>
               <td colspan="4" bgcolor="#999999">شش ماهه<br /></td>
               <td width="17%" rowspan="2" bgcolor="#999999">تعداد واحد ثبت شده </td>
               <td width="19%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
               <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="38" bgcolor="#999999">فاقد عملکرد</td>
               <td bgcolor="#999999">غیرفعال </td>
               <td bgcolor="#999999">نیمه فعال</td>
               <td bgcolor="#999999">فعال</td>
               <td height="38" bgcolor="#999999">فاقد عملکرد</td>
               <td bgcolor="#999999">غیرفعال </td>
               <td bgcolor="#999999">نیمه فعال</td>
               <td bgcolor="#999999">فعال</td>
             </tr>
             <tr>
               <?php
if ($id_ostan1 == '') 
{
 $query = "SELECT
ind_unit.id_ostan ,
count(ind_unit.id) as unit, 
count(ind_unit_info.id) as ind_p, 
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_3 ,
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_3 
FROM ind_unit 
left join
(select * from ind_unit_info where y_prod = $y_prod) 
 ind_unit_info ON ind_unit_info.ShenaseKasboKar = ind_unit.ShenaseKasboKar 
group by ind_unit.id_ostan
ORDER BY FIELD(ind_unit.id_ostan,'03','04','24','10','30','16','18','23','31','14','28','29','09','06','19','20'
,'11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')";
}
else
{
 $query = "SELECT
ind_unit.id_ostan ,ind_unit.id_city ,
count(ind_unit.id) as unit, 
count(ind_unit_info.id) as ind_p, 
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_3 ,
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_3 
FROM ind_unit 
left join
(select * from ind_unit_info where y_prod = $y_prod) 
 ind_unit_info ON ind_unit_info.ShenaseKasboKar = ind_unit.ShenaseKasboKar 
 where ind_unit.id_ostan=$id_ostan1
group by ind_unit.id_city
ORDER BY ind_unit.id_city";
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
 $v_unit_6_4  = $row['unit']-($row['v_unit_6_1']+$row['v_unit_6_2']+$row['v_unit_6_3']) ; 
 $v_unit_12_4 = $row['unit']-($row['v_unit_12_1']+$row['v_unit_12_2']+$row['v_unit_12_3']) ; 
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="28" ><?php echo $v_unit_12_4 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="7%" ><?php echo $row['v_unit_12_3'] ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="7%" ><?php echo $row['v_unit_12_2'] ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo $row['v_unit_12_1'] ; ?></td>
               <td align="center" width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_unit_6_4 ; ?><br /></td>
               <td align="center" width="8%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_3'] ; ?><br /></td>
               <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_2'] ; ?><br /></td>
               <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_1'] ; ?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['unit'] ; ?></td>
               <td align="center" class="style8" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
                  <?php if($id_ostan1=='') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               </span><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
if ($id_ostan1 == '') 
{
 $query = "SELECT
ind_unit.id_ostan ,
count(ind_unit.id) as unit, 
count(ind_unit_info.id) as ind_p, 
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_3 ,
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_3 
FROM ind_unit 
left join
(select * from ind_unit_info where y_prod = $y_prod) 
 ind_unit_info ON ind_unit_info.ShenaseKasboKar = ind_unit.ShenaseKasboKar  "  ;
}
else 
{
 $query = "SELECT
ind_unit.id_ostan ,
count(ind_unit.id) as unit, 
count(ind_unit_info.id) as ind_p, 
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '6'  then 1 else 0 end) as v_unit_6_3 ,
sum(case when ind_unit_info.v_unit = '1' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_1 ,
sum(case when ind_unit_info.v_unit = '2' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_2 ,
sum(case when ind_unit_info.v_unit = '3' and ind_unit_info.d_prod = '12' then 1 else 0 end) as v_unit_12_3 
FROM ind_unit 
left join
(select * from ind_unit_info where y_prod = $y_prod) 
 ind_unit_info ON ind_unit_info.ShenaseKasboKar = ind_unit.ShenaseKasboKar 
 where ind_unit.id_ostan = '$id_ostan1' " 
  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $v_unit_6_4  = $row['unit']-($row['v_unit_6_1']+$row['v_unit_6_2']+$row['v_unit_6_3']) ; 
 $v_unit_12_4 = $row['unit']-($row['v_unit_12_1']+$row['v_unit_12_2']+$row['v_unit_12_3']) ; 

?>
             <tr align="center" class="text1">
               <td height="26" colspan="4" bgcolor="#999999">دوازده ماهه</td>
               <td colspan="4" bgcolor="#999999">شش ماهه</td>
               <td rowspan="2" bgcolor="#999999">تعداد واحد ثبت شده </td>
               <td colspan="2" rowspan="2" bgcolor="#999999">&nbsp;</td>
             </tr>
             <tr align="center" class="text1">
               <td height="31" bgcolor="#999999">فاقد عملکرد</td>
               <td bgcolor="#999999">غیرفعال </td>
               <td bgcolor="#999999">نیمه فعال</td>
               <td bgcolor="#999999">فعال</td>
               <td height="31" bgcolor="#999999">فاقد عملکرد</td>
               <td bgcolor="#999999">غیرفعال </td>
               <td bgcolor="#999999">نیمه فعال</td>
               <td bgcolor="#999999">فعال</td>
             </tr>
             <tr>
               <td align="center" height="31" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $v_unit_12_4 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['v_unit_12_3'] ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['v_unit_12_2'] ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['v_unit_12_1'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_unit_6_4 ; ?><br /></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_3'] ; ?><br /></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_2'] ; ?><br /></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_6_1'] ; ?><br /></td>
               <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['unit'] ; ?></td>
               <td align="center" colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
   </table>
           <?php }?>
</body>
</html>