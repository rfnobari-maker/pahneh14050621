<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Mush_rep4.doc");
include("../../lock_ce.php");
include_once("../../event.php");
if (isset($_POST['y_prod']))   $y_prod  = $_POST['y_prod'] ; 
if (isset($_POST['no_mush']))  $no_mush = $_POST['no_mush'] ; 
if (isset($_POST['no_moj']))   $no_moj = $_POST['no_moj'] ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
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
<div align="center"> گزارش واحدهای پرورش قارچ به تفکیک استان</div>
           <table width="99%" height="215" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td align="center" height="56" bgcolor="#999999"> كمپوست  مصرفي در سال/تن</td>
               <td align="center" bgcolor="#999999">کل تولید سالانه/تن</td>
               <td align="center" bgcolor="#999999">عملكرد /کیلوگرم بر مترمربع</td>
               <td align="center" bgcolor="#999999">سطح زيركشت مترمربع</td>
               <td align="center" bgcolor="#999999">لیسانس و بالاتر</td>
               <td align="center" bgcolor="#999999">دیپلم و فوق دیپلم</td>
               <td align="center" bgcolor="#999999">زیر دیپلم</td>
               <td align="center" width="6%" bgcolor="#999999">غیر فعال 3</td>
               <td align="center" width="5%" bgcolor="#999999">غیر فعال 2</td>
               <td align="center" width="6%" bgcolor="#999999">غیر فعال 1</td>
               <td align="center" width="7%" bgcolor="#999999">فعال</td>
               <td align="center" bgcolor="#999999">تعداد واحد</td>
               <td align="center" width="8%" bgcolor="#999999">استان </td>
               <td align="center" width="4%" bgcolor="#999999">ردیف</td>
             </tr>
             <tr>
               <?php
 if ($no_mush == '')  { $f_no_mush  = 1  ; }else{ $f_no_mush = "no_mush = '$no_mush'" ;}
 if ($no_moj == '')   { $f_no_moj  = 1  ; }else{ $f_no_moj = "no_moj = '$no_moj'" ;}
include('../../login/config.php') ;
 $query = "select  Mushroom.id_ostan ,
count(Mushroom.id) as unit, 
sum(z_es)  as z_es ,
sum(z_vag) as z_vag ,
count(Mushroom_prod.id) as prod, 
sum(case when Mushroom_prod.v_unit = '1' then 1 else 0 end) as v_unit_1 ,
sum(case when Mushroom_prod.v_unit = '2' then 1 else 0 end) as v_unit_2 ,
sum(case when Mushroom_prod.v_unit = '3' then 1 else 0 end) as v_unit_3 ,
sum(case when Mushroom_prod.v_unit = '4' then 1 else 0 end) as v_unit_4 ,
sum(z_dep) as z_dep ,
sum(dep) as dep ,
sum(lisan) as lisan ,
sum(zer_kesh) as zer_kesh ,
sum(tol_avg) as tol_avg ,
sum(mah_tol) as mah_tol ,
sum(comp) as comp 
FROM (select * from Mushroom where $f_no_mush and $f_no_moj) Mushroom 
left join
(select * from Mushroom_prod where y_prod = '$y_prod') 
 Mushroom_prod ON Mushroom_prod.unit_id = Mushroom.id 
group by Mushroom.id_ostan
ORDER BY FIELD(Mushroom.id_ostan,'03','04','24','10','30','16','18','23','31','14','28','29','09','06','19','20'
,'11','07','26','25','12','08','05','17','27','01','15','02','00','22','13','21')";
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td align="center"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="35" ><?php echo round($row['comp'],1) ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo $row['mah_tol'] ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" ><?php echo  round((($row['mah_tol'] *1000 ) / $row['zer_kesh']),2) ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" ><?php echo $row['zer_kesh'] ; ?></td>
               <td align="center" width="4%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['lisan'] ; ?></td>
               <td align="center" width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['dep'] ; ?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_dep'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_4'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_3'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_2'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_1'] ; ?></td>
               <td align="center" width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit'] ; ?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo ostan_name($row['id_ostan']);?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
 $query = "select 
count(Mushroom.id) as unit, 
sum(z_es)  as z_es ,
sum(z_vag) as z_vag ,
count(Mushroom_prod.id) as prod, 
sum(case when Mushroom_prod.v_unit = '1' then 1 else 0 end) as v_unit_1 ,
sum(case when Mushroom_prod.v_unit = '2' then 1 else 0 end) as v_unit_2 ,
sum(case when Mushroom_prod.v_unit = '3' then 1 else 0 end) as v_unit_3 ,
sum(case when Mushroom_prod.v_unit = '4' then 1 else 0 end) as v_unit_4 ,
sum(z_dep) as z_dep ,
sum(dep) as dep ,
sum(lisan) as lisan ,
sum(zer_kesh) as zer_kesh ,
sum(mah_tol) as mah_tol ,
sum(comp) as comp 
FROM (select * from Mushroom where $f_no_mush and $f_no_moj ) Mushroom 
left join
(select * from Mushroom_prod where y_prod = '$y_prod') 
 Mushroom_prod ON Mushroom_prod.unit_id = Mushroom.id "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td height="56" bgcolor="#999999"> كمپوست  مصرفي در سال/تن</td>
               <td bgcolor="#999999">کل تولید سالانه/تن</td>
               <td bgcolor="#999999">عملكرد /کیلوگرم بر مترمربع</td>
               <td bgcolor="#999999">سطح زيركشت مترمربع</td>
               <td align="center" bgcolor="#999999">لیسانس و بالاتر</td>
               <td align="center" bgcolor="#999999">دیپلم و فوق دیپلم</td>
               <td align="center" bgcolor="#999999">زیر دیپلم</td>
               <td align="center" bgcolor="#999999">غیر فعال 3</td>
               <td align="center" bgcolor="#999999">غیر فعال 2</td>
               <td align="center" bgcolor="#999999">غیر فعال 1</td>
               <td align="center" bgcolor="#999999">فعال</td>
               <td align="center" bgcolor="#999999">تعداد واحد</td>
               <td align="center" colspan="2" bgcolor="#999999">&nbsp;</td>
              </tr>
             <tr>
               <td align="center" height="38" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['comp'],1) ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['mah_tol'] ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round((($row['mah_tol'] *1000 ) / $row['zer_kesh']),2) ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo $row['zer_kesh'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['lisan'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['dep'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['z_dep'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_4'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_3'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_2'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['v_unit_1'] ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['unit'] ; ?><br /></td>
               <td align="center" colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
   </table>
</body>
</html>