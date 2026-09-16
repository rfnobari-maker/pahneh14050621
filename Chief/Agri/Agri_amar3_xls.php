<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename='گزارش_3_آمارنامه.xls");
include('../../lock_ce.php');
include('../../event.php');
include_once('../../login/config.php') ;
 $id_ostan1 = $_POST['id_ostan'] ;
 $z_sal = $_POST['z_sal'] ;
if (isset($_POST['mah_qroup'])) $mah_qroup = $_POST['mah_qroup'] ;
if (isset($_POST['mah_name'])) $mah_name = $_POST['mah_name'] ;
 $Agri_prod_table = 'Agriprod'.str_replace('-','_',$z_sal) ; 
// کد گروه و کد محصول
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
              
<p align="center" dir="rtl">برآورد سطح، میزان تولید و عملکرد در هکتار محصول <?php echo mah_name_amar($mah_name);?> <?php if($id_ostan1!='') echo 'استان '.ostan_name($id_ostan1);?><?php echo ' در سال  '.$z_sal?></p> 
<?php
 if($mah_name!='156' and $mah_name !='158' and $mah_name !='160')
{
if ($id_ostan1 == '') 
{
 $query = "SELECT id_ostan, no_kesh ,
sum(case when no_kesh = 1  then (s_bar_a)+(s_bar_b)  else 0 end) as s_a , 
sum(case when no_kesh = 2  then (s_bar_a)+(s_bar_b)  else 0 end) as s_d, 
sum(case when no_kesh = 1  then mah_tol else 0 end) as mahtol_a , 
sum(case when no_kesh = 2  then mah_tol else 0 end) as mahtol_d , 
sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where cod_mah_amar ='$mah_name' Group by id_ostan
ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') "  ;
}
if ($id_ostan1 != '') 
{
$query = "SELECT id_ostan,id_city, no_kesh ,
sum(case when no_kesh = 1  then (s_bar_a)+(s_bar_b)  else 0 end) as s_a , 
sum(case when no_kesh = 2  then (s_bar_a)+(s_bar_b)  else 0 end) as s_d, 
sum(case when no_kesh = 1  then mah_tol else 0 end) as mahtol_a , 
sum(case when no_kesh = 2  then mah_tol else 0 end) as mahtol_d , 
sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where id_ostan = '$id_ostan1'  and  cod_mah_amar ='$mah_name'
Group by id_city
 "  ;

 }
$stmt = $dbh->prepare($query);
$stmt->execute();
$t_row = $stmt -> rowCount() ; 
if ($t_row>0) { ;
?>
           <table width="95%" height="140" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
              <tr align="center" class="text1">
               <td height="46" colspan="2" bgcolor="#999999">عملکرد<br />
                 <span class="style2">کیلوگرم</span></td>
               <td colspan="3" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح <br />
                <span class="style2">هکتار</span></td>
               <td width="23%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
               <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="24" bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td width="10%" height="24" bgcolor="#999999">جمع</td>
               <td width="8%" bgcolor="#999999">دیم</td>
               <td width="9%" bgcolor="#999999">آبی</td>
               <td height="24" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="9%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
$r = 1 ; 
 foreach($stmt as $row){
 $s_a = round($row['s_a'],2) ;
 $s_d = round($row['s_d'],2) ;
 $mahtol_a = round($row['mahtol_a'],2) ;
 $mahtol_d = round($row['mahtol_d'],2) ;
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="28" ><?php echo round($mahtol_d/$s_d*1000,0) ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000,0) ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a+$mahtol_d ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_d ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a ;?></td>
               <td align="center" width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a+$s_d ;?></td>
               <td align="center" width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_d ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
                 <?php if($id_ostan1=='') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               </span><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
if ($id_ostan1 == '') 
{
$query = "SELECT id_ostan, no_kesh ,
sum(case when no_kesh = 1  then (s_bar_a)+(s_bar_b)  else 0 end) as s_a , 
sum(case when no_kesh = 2  then (s_bar_a)+(s_bar_b)  else 0 end) as s_d, 
sum(case when no_kesh = 1  then mah_tol else 0 end) as mahtol_a , 
sum(case when no_kesh = 2  then mah_tol else 0 end) as mahtol_d , 
sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where cod_mah_amar ='$mah_name' "  ;
}
if ($id_ostan1 != '') 
{
$query = "SELECT id_ostan,id_city, no_kesh ,
sum(case when no_kesh = 1  then (s_bar_a)+(s_bar_b)  else 0 end) as s_a , 
sum(case when no_kesh = 2  then (s_bar_a)+(s_bar_b)  else 0 end) as s_d, 
sum(case when no_kesh = 1  then mah_tol else 0 end) as mahtol_a , 
sum(case when no_kesh = 2  then mah_tol else 0 end) as mahtol_d , 
sum(s_bar_a)   s_bara ,
sum(s_bar_b)   s_barb ,
sum(mah_tol)  mahtol ,
sum(mah_tolp) mahtolp 
FROM $Agri_prod_table
where id_ostan = '$id_ostan1'  and cod_mah_amar ='$mah_name'
 "  ;
}
?>
<?php
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $s_a = round($row['s_a'],2) ;
 $s_d = round($row['s_d'],2) ;
 $mahtol_a = round($row['mahtol_a'],2) ;
 $mahtol_d = round($row['mahtol_d'],2) ;
?>

             <tr>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="40" ><?php echo round($mahtol_d/$s_d*1000,0) ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000,0) ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a+$mahtol_d ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_d ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $mahtol_a ;?></td>
               <td align="center" width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a+$s_d ;?></td>
               <td align="center" width="10%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_d ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ;?></td>
               <td align="center" colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل <br /></td>
              </tr>
       </table>
             <?php
}
}
?>

<?php
 if($mah_name =='156' or $mah_name =='158' or $mah_name =='160')
{
	if($mah_name =='156') $cod_mah ='170' ; 
    if($mah_name =='158') $cod_mah ='172' ; 
	if($mah_name =='160') $cod_mah ='174' ; 	
?>
           <table width="95%" height="125" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="38" colspan="2" bgcolor="#999999">عملکرد<br />
                 <span class="style2">کیلوگرم</span></td>
               <td colspan="3" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="3" bgcolor="#999999">سطح <br />
                <span class="style2">هکتار</span></td>
               <td width="23%" rowspan="2" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
               <td width="6%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="23" bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td width="10%" height="23" bgcolor="#999999">جمع</td>
               <td width="8%" bgcolor="#999999">دیم</td>
               <td width="9%" bgcolor="#999999">آبی</td>
               <td height="23" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="9%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
if ($id_ostan1 == '') 
{
 $query = "SELECT 
id_ostan,id_city,  
sum(zer_kesht) zer_k1, 
sum(mah_tolp) m_tolp, 
sum(s_bar) s_bar1, 
sum(mah_tol) m_tol 
FROM Vege_prod 
where  z_sal = '$z_sal'  and cod_mah = '$cod_mah'
Group by id_ostan
ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') "  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT 
id_ostan,id_city,  
sum(zer_kesht) zer_k1, 
sum(mah_tolp) m_tolp, 
sum(s_bar) s_bar1, 
sum(mah_tol) m_tol 
FROM Vege_prod 
where  z_sal = '$z_sal' and id_ostan = '$id_ostan1' and cod_mah = '$cod_mah'
Group by id_city
 "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
    $s_a = round($row['s_bar1'],2)*1 ; 
	$mahtol_a = round($row['m_tol'],2)*1 ; 
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="25" ><?php echo 0 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000,0) ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="10%" height="25" ><?php echo $mahtol_a ;  ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo 0 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" ><?php echo $mahtol_a ;  ?></td>
               <td align="center" width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],2)*1 ; ?><br /></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo 0 ; ?><br /></td>
               <td align="center" width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ; ?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
                 <?php if($id_ostan1=='') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               </span></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
if ($id_ostan1 == '') 
{
 $query = "SELECT 
id_ostan,id_city,  
sum(zer_kesht) zer_k1, 
sum(mah_tolp) m_tolp, 
sum(s_bar) s_bar1, 
sum(mah_tol) m_tol 
FROM Vege_prod 
where  z_sal = '$z_sal'  and cod_mah = '$cod_mah'
 "  ;
}
if ($id_ostan1 != '') 
{
 $query = "SELECT 
id_ostan,id_city,  
sum(zer_kesht) zer_k1, 
sum(mah_tolp) m_tolp, 
sum(s_bar) s_bar1, 
sum(mah_tol) m_tol 
FROM Vege_prod 
where  z_sal = '$z_sal' and id_ostan = '$id_ostan1' and cod_mah = '$cod_mah' "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
    $s_a = round($row['s_bar1'],2)*1 ; 
	$mahtol_a = round($row['m_tol'],2)*1 ; 
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="8%" height="37" ><?php echo 0 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo round($mahtol_a/$s_a*1000,0) ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="10%" height="37" ><?php echo $mahtol_a ;  ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="8%" ><?php echo 0 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="9%" ><?php echo $mahtol_a ;  ?></td>
               <td align="center" width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],2)*1 ; ?><br /></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo 0 ; ?><br /></td>
               <td align="center" width="9%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $s_a ; ?><br /></td>
               <td align="center" colspan="2" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
               </tr>

<?php
}
 
?>

</table>
</table>
</body>
</html>