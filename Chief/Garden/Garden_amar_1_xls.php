<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename='گزارش_1_آمارنامه_باغی.xls");
include("../../lock_ce.php");
include_once("../../event.php");
include_once('../../login/config.php') ;
$id_ostan1 = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ; 
$add_abadi = $_POST['add_abadi'] ;
$add_city = $_POST['add_city'] ;
if (isset($_POST['z_sal']))  $z_sal= $_POST['z_sal'] ; 
if (isset($_POST['mah_qroup'])) $mah_qroup = $_POST['mah_qroup'] ;
if (isset($_POST['mah_name']))  $mah_name = $_POST['mah_name'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
<style>
td , tr
{
text-align:center
}

</style>
</head>
<body>

      <?php 
   if (1==1) 
 {  
 if (($mah_qroup < '8') or ($mah_qroup == '99'))  { ?>
<p align="center" dir="rtl">گزارش سطح و ميزان توليد محصولات باغباني <?php if($id_ostan1!='-1') echo 'استان '.ostan_name($id_ostan1);?><?php echo ' در سال  '.$z_sal?></p>                <table width="99%" height="221" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
              <tr align="center" class="text1">
                <td colspan="4" rowspan="2" bgcolor="#999999">میزان تولید<br />
                <span class="style2">تن</span></td>
                <td colspan="2" rowspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
                <td height="40" colspan="6" bgcolor="#999999">سطح زیر کشت<br />
                  <span class="style2">هکتار</span></td>
                <td width="17%" rowspan="3" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
                <td width="4%" rowspan="3" bgcolor="#999999">ردیف</td>
              </tr>
              <tr align="center" class="text1">
               <td height="26" colspan="3" bgcolor="#999999">بارور</td>
               <td colspan="3" bgcolor="#999999">غیربارور</td>
              </tr>
             <tr align="center" class="text1">
               <td height="25" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="25" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="7%" bgcolor="#999999">آبی</td>
              </tr>
             <tr>
               <?php

 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
if ($mah_qroup == '0')  { $v_group  = 1  ; $mah_name = '0' ; }else{ $v_group = "cod_qroup = '$mah_qroup'" ;}
if ($mah_name == '0')   { $v_mah    = 1  ; }else{ $v_mah   = "cod_mah   = '$mah_name'" ;}

if ($id_ostan1 == '-1') 
{
 $query = "SELECT 
Garden_prod.id_ostan ,
SUM(Garden_prod.s_kesht_b) AS zer_k1,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.s_kesht_b ELSE 0 END) AS zer_k1_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.s_kesht_b ELSE 0 END) AS zer_k1_dim,
  SUM(Garden_prod.s_kesht_gb) AS zer_k2,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.s_kesht_gb ELSE 0 END) AS zer_k2_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.s_kesht_gb ELSE 0 END) AS zer_k2_dim,
  SUM(Garden_prod.tree_b) AS s_bar1,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.tree_b ELSE 0 END) AS s_bar1_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.tree_b ELSE 0 END) AS s_bar1_dim,
  SUM(CASE WHEN Garden_prod.nah_kesh = '3' THEN Garden_prod.tree_b ELSE 0 END) AS tree_b_p,
  SUM(Garden_prod.tree_gb) AS s_bar2,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.tree_gb ELSE 0 END) AS s_bar2_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.tree_gb ELSE 0 END) AS s_bar2_dim,
  SUM(Garden_prod.mah_tol) AS m_tol,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_dim,
  SUM(CASE WHEN Garden_prod.nah_kesh = '3' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_p
FROM Garden_prod 
where  Garden_prod.z_sal='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_group   and $v_mah 
GROUP BY id_ostan
ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')
 "  ;
}
if ($id_ostan1 !== '-1') 
{
  $query = "SELECT 
Garden_prod.id_ostan ,Garden_prod.id_city ,
SUM(Garden_prod.s_kesht_b) AS zer_k1,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.s_kesht_b ELSE 0 END) AS zer_k1_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.s_kesht_b ELSE 0 END) AS zer_k1_dim,
  SUM(Garden_prod.s_kesht_gb) AS zer_k2,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.s_kesht_gb ELSE 0 END) AS zer_k2_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.s_kesht_gb ELSE 0 END) AS zer_k2_dim,
  SUM(Garden_prod.tree_b) AS s_bar1,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.tree_b ELSE 0 END) AS s_bar1_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.tree_b ELSE 0 END) AS s_bar1_dim,
  SUM(CASE WHEN Garden_prod.nah_kesh = '3' THEN Garden_prod.tree_b ELSE 0 END) AS tree_b_p,
  SUM(Garden_prod.tree_gb) AS s_bar2,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.tree_gb ELSE 0 END) AS s_bar2_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.tree_gb ELSE 0 END) AS s_bar2_dim,
  SUM(Garden_prod.mah_tol) AS m_tol,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_dim,
  SUM(CASE WHEN Garden_prod.nah_kesh = '3' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_p
FROM Garden_prod 
where  Garden_prod.z_sal='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_group   and $v_mah 
GROUP BY id_city
ORDER BY id_city 
 "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="30" ><?php echo round($row['m_tol'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_p'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['m_tol_dim'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['m_tol_abi'],4)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_gb_p'] ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],2)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],2)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],2)*1 ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
                 <?php if($id_ostan1=='-1') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               </span><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
if ($id_ostan1 == '-1') 
{
 $query = "SELECT 
SUM(Garden_prod.s_kesht_b) AS zer_k1,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.s_kesht_b ELSE 0 END) AS zer_k1_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.s_kesht_b ELSE 0 END) AS zer_k1_dim,
  SUM(Garden_prod.s_kesht_gb) AS zer_k2,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.s_kesht_gb ELSE 0 END) AS zer_k2_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.s_kesht_gb ELSE 0 END) AS zer_k2_dim,
  SUM(Garden_prod.tree_b) AS s_bar1,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.tree_b ELSE 0 END) AS s_bar1_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.tree_b ELSE 0 END) AS s_bar1_dim,
  SUM(CASE WHEN Garden_prod.nah_kesh = '3' THEN Garden_prod.tree_b ELSE 0 END) AS tree_b_p,
  SUM(Garden_prod.tree_gb) AS s_bar2,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.tree_gb ELSE 0 END) AS s_bar2_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.tree_gb ELSE 0 END) AS s_bar2_dim,
  SUM(Garden_prod.mah_tol) AS m_tol,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_dim,
  SUM(CASE WHEN Garden_prod.nah_kesh = '3' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_p
FROM Garden_prod 
where  Garden_prod.z_sal='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_group   and $v_mah 
 "  ;
}
if ($id_ostan1 != '-1') 
{
 $query = "SELECT 
sum(Garden_prod.s_kesht_b) zer_k1, 
SUM(Garden_prod.s_kesht_b) AS zer_k1,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.s_kesht_b ELSE 0 END) AS zer_k1_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.s_kesht_b ELSE 0 END) AS zer_k1_dim,
  SUM(Garden_prod.s_kesht_gb) AS zer_k2,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.s_kesht_gb ELSE 0 END) AS zer_k2_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.s_kesht_gb ELSE 0 END) AS zer_k2_dim,
  SUM(Garden_prod.tree_b) AS s_bar1,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.tree_b ELSE 0 END) AS s_bar1_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.tree_b ELSE 0 END) AS s_bar1_dim,
  SUM(CASE WHEN Garden_prod.nah_kesh = '3' THEN Garden_prod.tree_b ELSE 0 END) AS tree_b_p,
  SUM(Garden_prod.tree_gb) AS s_bar2,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.tree_gb ELSE 0 END) AS s_bar2_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.tree_gb ELSE 0 END) AS s_bar2_dim,
  SUM(Garden_prod.mah_tol) AS m_tol,
  SUM(CASE WHEN Garden_prod.no_kesh = '1' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_abi,
  SUM(CASE WHEN Garden_prod.no_kesh = '2' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_dim,
  SUM(CASE WHEN Garden_prod.nah_kesh = '3' THEN Garden_prod.mah_tol ELSE 0 END) AS m_tol_p
FROM Garden_prod 
where  Garden_prod.z_sal='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_group   and $v_mah 
GROUP BY id_ostan "  ;
}

$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td height="38" colspan="4" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت بارور<br />
                <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت غیربارور<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="2" rowspan="2" bgcolor="#999999">&nbsp;</td>
              </tr>
             <tr align="center" class="text1">
               <td height="26" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="26" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <td height="32" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_p'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_gb_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],2)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],2)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],2)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
   </table>
<?php }?>
            <!-- شروع قارچ -->
           <?php if (($mah_qroup == '0') or ($mah_qroup == '100'))  { ?>
<p align="center" dir="rtl">گزارش سطح و ميزان توليد محصولات واحد های پرورش قارچ خوراکی <?php if($id_ostan1!='-1') echo 'استان '.ostan_name($id_ostan1);?><?php echo ' در سال  '.$z_sal?></p>  
           <table width="99%" height="241" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td colspan="4" rowspan="2" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="2" rowspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
               <td height="48" colspan="6" bgcolor="#999999">سطح زیر کشت<br />
                 <span class="style2">هکتار</span></td>
               <td width="17%" rowspan="3" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
               <td width="4%" rowspan="3" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="29" colspan="3" bgcolor="#999999">بارور</td>
               <td colspan="3" bgcolor="#999999">غیربارور</td>
             </tr>
             <tr align="center" class="text1">
               <td height="28" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="28" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="7%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php

 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($mah_qroup == '0')  { $v_group  = 1  ; $mah_name = '0' ; }else{ $v_group = "cod_qroup = '$mah_qroup'" ;}
 if ($mah_name == '0')  { $v_mah    = 1  ; }else{ $v_mah   = "no_mush   = '$mah_name'" ;}


if ($id_ostan1 == '-1') 
{
 $query = "SELECT id_ostan , SUM( zer_kesh ) zer_k, SUM( mah_tol ) mah_tol
FROM Mushroom_prod
where  Mushroom_prod.y_prod='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city   and $v_mah 
GROUP BY id_ostan
ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21')
 "  ;
}
if ($id_ostan1 !== '-1') 
{
  $query = "SELECT id_ostan , id_city , SUM( zer_kesh ) zer_k, SUM( mah_tol ) mah_tol
FROM Mushroom_prod
where  Mushroom_prod.y_prod='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_mah 
GROUP BY id_city
ORDER BY id_city 
 "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="32" ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k']/10000),2)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k']/10000),2)*1 ; ?></td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
                 <?php if($id_ostan1=='-1') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               </span><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
if ($id_ostan1 == '-1') 
{
 $query = "SELECT id_ostan , SUM( zer_kesh ) zer_k, SUM( mah_tol ) mah_tol
FROM Mushroom_prod
where  Mushroom_prod.y_prod='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_mah 
 "  ;
}
if ($id_ostan1 != '-1') 
{
 $query = "SELECT id_ostan , id_city , SUM( zer_kesh ) zer_k, SUM( mah_tol ) mah_tol
FROM Mushroom_prod
where  Mushroom_prod.y_prod='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city  and $v_mah 
GROUP BY id_ostan "  ;
}

$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td height="38" colspan="4" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت بارور<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت غیربارور<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="2" rowspan="2" bgcolor="#999999">&nbsp;</td>
             </tr>
             <tr align="center" class="text1">
               <td height="26" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="26" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <td height="31" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k']/10000),1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round(($row['zer_k']/10000),2)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
           </table>
           <p><!-- پایان قارچ -->
           <?php }?>
            <!-- شروع گلخانه -->
           <?php if (($mah_qroup == '0') or ($mah_qroup == '8'))  { ?>
<p align="center" dir="rtl">گزارش سطح و ميزان توليد محصولات واحد های گلخانه <?php if($id_ostan1!='-1') echo 'استان '.ostan_name($id_ostan1);?><?php echo ' در سال  '.$z_sal?></p>
<?php 
 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($mah_qroup == '0')  { $v_group  = 1  ; $mah_name = '0' ; }else{ $v_group = "cod_qroup = '$mah_qroup'" ;}
 if ($mah_name == '0')  { $v_mah    = 1  ; }else{ $v_mah   = "no_mush   = '$mah_name'" ;}

 if ($mah_qroup == '0' or $mah_qroup == '8')
 {
$sum_item = "
sum(no_mtol1_1)+
sum(no_mtol1_2)+
sum(no_mtol1_3)+
sum(no_mtol1_4)+
sum(no_mtol1_5)+
sum(no_mtol1_6)+
sum(no_mtol3_1)+
sum(no_mtol3_2)+
sum(no_mtol3_4)" ; 
$unit = 'تن' ; 
 }
 if ($mah_qroup == '8' and $mah_name == '211101'){ $sum_item = "sum(no_mtol1_1)" ; $unit = 'تن' ;  }
 if ($mah_qroup == '8' and $mah_name == '211102'){ $sum_item = "sum(no_mtol1_2)" ; $unit = 'تن' ;  }
 if ($mah_qroup == '8' and $mah_name == '211103'){ $sum_item = "sum(no_mtol1_3)" ; $unit = 'تن' ;  }
 if ($mah_qroup == '8' and $mah_name == '211104'){ $sum_item = "sum(no_mtol1_4)" ; $unit = 'تن' ;  }
 if ($mah_qroup == '8' and $mah_name == '211105'){ $sum_item = "sum(no_mtol1_5)" ; $unit = 'تن' ;  }
 if ($mah_qroup == '8' and $mah_name == '211106'){ $sum_item = "sum(no_mtol1_6)" ; $unit = 'تن' ;  }

 if ($mah_qroup == '8' and $mah_name == '211107'){ $sum_item = "sum(no_mtol2_1)" ; $unit = 'شاخه' ;  }
 if ($mah_qroup == '8' and $mah_name == '211108'){ $sum_item = "sum(no_mtol2_2)" ; $unit = 'گلدان' ;  }
 if ($mah_qroup == '8' and $mah_name == '211109'){ $sum_item = "sum(no_mtol2_3)" ; $unit = 'اصله' ;  }
 if ($mah_qroup == '8' and $mah_name == '211110'){ $sum_item = "sum(no_mtol2_4)" ; $unit = 'بوته' ;  }

 if ($mah_qroup == '8' and $mah_name == '211201'){ $sum_item = "sum(no_mtol3_1)" ; $unit = 'تن' ;  }
 if ($mah_qroup == '8' and $mah_name == '211202'){ $sum_item = "sum(no_mtol3_2)" ; $unit = 'تن' ;  }

 if ($mah_qroup == '8' and $mah_name == '211111'){ $sum_item = "sum(no_mtol4_1)" ; $unit = 'شاخه' ;  }
 if ($mah_qroup == '8' and $mah_name == '211112'){ $sum_item = "sum(no_mtol4_2)" ; $unit = 'گلدان' ;  }
 if ($mah_qroup == '8' and $mah_name == '211113'){ $sum_item = "sum(no_mtol4_3)" ; $unit = 'اصله' ;  }
 if ($mah_qroup == '8' and $mah_name == '211114'){ $sum_item = "sum(no_mtol4_4)" ; $unit = 'بوته' ;  }
 if ($mah_qroup == '8' and $mah_name == '211115'){ $sum_item = "sum(no_mtol3_3)" ; $unit = 'اصله' ;   }
 if ($mah_qroup == '8' and $mah_name == '211116'){ $sum_item = "sum(no_mtol3_4)" ; $unit = 'تن' ; }

?>
           <table width="99%" height="257" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td colspan="4" rowspan="2" bgcolor="#999999">میزان تولید<br />
                 <span class="style2"><?php echo $unit?></span></td>
               <td colspan="2" rowspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
               <td height="48" colspan="6" bgcolor="#999999">سطح زیر کشت<br />
                 <span class="style2">هکتار</span></td>
               <td width="17%" rowspan="3" bgcolor="#999999"><?php if($id_ostan1=='') echo 'استان' ;  else echo 'شهرستان'  ; ?></td>
               <td width="4%" rowspan="3" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td height="34" colspan="3" bgcolor="#999999">بارور</td>
               <td colspan="3" bgcolor="#999999">غیربارور</td>
             </tr>
             <tr align="center" class="text1">
               <td height="31" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="31" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td width="7%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
if ($id_ostan1 == '-1') 
{
 $query = "SELECT id_ostan, $sum_item mah_tol FROM Greenhous_prod WHERE y_prod ='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi and $f_add_city   
GROUP BY id_ostan
ORDER BY FIELD(id_ostan,'03','04','24','10','30','16','18','23','31','14','29','09','28','06','19','20','11','07'
,'26','25','12','08','05','17','27','01','15','02','00','22','13','21') "  ;
}
if ($id_ostan1 !== '-1') 
{
  $query = "SELECT id_ostan,id_city, $sum_item mah_tol FROM Greenhous_prod WHERE y_prod ='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi and $f_add_city   
GROUP BY id_city
ORDER BY id_city  "  ;
}
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="34" ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmall">
                 <?php if($id_ostan1=='-1') echo ostan_name($row['id_ostan']) ;  else echo city_name1($row['id_city'],$id_ostan1)  ; ?>
               </span><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
if ($id_ostan1 == '-1') 
{
 $query = "SELECT id_ostan, $sum_item mah_tol FROM Greenhous_prod WHERE y_prod ='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi and $f_add_city   
 "  ;
}
if ($id_ostan1 !== '-1') 
{
  $query = "SELECT id_ostan,id_city, $sum_item mah_tol FROM Greenhous_prod WHERE y_prod ='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi and $f_add_city   
GROUP BY id_ostan "  ;
}

$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td height="38" colspan="4" bgcolor="#999999">میزان تولید<br />
                 <span class="style2">تن</span></td>
               <td colspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت بارور<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="3" bgcolor="#999999">سطح زیر کشت غیربارور<br />
                 <span class="style2">هکتار</span></td>
               <td colspan="2" rowspan="2" bgcolor="#999999">&nbsp;</td>
             </tr>
             <tr align="center" class="text1">
               <td height="29" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="29" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <td height="34" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
           </table>
<p align="center" dir="rtl">پایان گزارش</p>
           <?php } }?>
</body>
</html>