<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename='گزارش_2_آمارنامه_باغی.xls");
include("../../lock_oce.php");
include_once("../../event.php");
include('../../login/config.php') ;
 $id_ostan1 = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;

if (isset($_POST['z_sal']))   $z_sal= $_POST['z_sal'] ; 
if (isset($_POST['mah_qroup'])) $mah_qroup = $_POST['mah_qroup'] ;
if (isset($_POST['mah_name'])) $mah_name = $_POST['mah_name'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
 $z_sal= $_POST['z_sal'] ; 
 $id_ostan= $_POST['id_ostan'] ;  ; 
?>
           <p>
             <?php if (($mah_qroup < '8') or ($mah_qroup == '99'))  { ?>
<p align="center" dir="rtl">گزارش سطح ، میزان تولید و عملکرد محصولات باغی به تفکیک نوع محصول <?php if($id_ostan1!='-1') echo 'استان '.ostan_name($id_ostan1);?><?php echo ' در سال  '.$z_sal?></p>  
           <table width="99%" height="306" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >       
              <tr align="center" class="text1">
                <td colspan="2" rowspan="2" bgcolor="#999999">عملکرد<br />
                <span class="style2">کیلوگرم</span> <br /></td>
                <td colspan="4" rowspan="2" bgcolor="#999999">میزان تولید<br />
                <span class="style2">تن</span></td>
                <td colspan="2" rowspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
                <td height="48" colspan="6" bgcolor="#999999">سطح زیر کشت<br />
                  <span class="style2">هکتار</span></td>
                <td  rowspan="3" bgcolor="#999999">نام محصول</td>
                <td  rowspan="3" bgcolor="#999999">ردیف</td>
             </tr>
              <tr align="center" class="text1">
               <td height="37" colspan="3" bgcolor="#999999">بارور</td>
               <td colspan="3" bgcolor="#999999">غیربارور</td>
              </tr>
             <tr align="center" class="text1">
               <td height="20" bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="32" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="32" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
             </tr>
               <?php

 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
if ($mah_qroup == '0')  { $v_group  = 1  ; $mah_name = '0' ; }else{ $v_group = "cod_qroup = '$mah_qroup'" ;}
if ($mah_name == '0')   { $v_mah    = 1  ; }else{ $v_mah   = "cod_mah   = '$mah_name'" ;}

 $query = "SELECT 
Garden_prod.id_ostan ,cod_mah ,
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
GROUP BY cod_mah "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
             <tr>
               <td height="23" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim']/$row['zer_k1_dim']*1000) ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi']/$row['zer_k1_abi']*1000) ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  height="42" ><?php echo round($row['m_tol'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  ><?php echo round($row['m_tol_p'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  ><?php echo round($row['m_tol_abi'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_gb_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name_bagh_amar($row['cod_mah']);?><br /></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
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

$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td height="38" colspan="2" bgcolor="#999999">عملکرد<br />
               <span class="style2">کیلوگرم</span> <br /></td>
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
               <td height="20" bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="37" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="37" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <td height="23" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim']/$row['zer_k1_dim']*1000,1)*1 ;?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi']/$row['zer_k1_abi']*1000,1)*1 ;?></td>
               <td height="38" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_p'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi'],4)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_gb_p'] ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
</table>
<?php }?>
            <!-- شروع قارچ -->
           <?php if (($mah_qroup == '0') or ($mah_qroup == '100'))  { ?>

<p align="center" dir="rtl">گزارش سطح ، میزان تولید و عملکرد محصولات پرورش قارچ به تفکیک نوع محصول <?php if($id_ostan1!='-1') echo 'استان '.ostan_name($id_ostan1);?><?php echo ' در سال  '.$z_sal?></p>  
<table width="99%" height="306" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >       
              <tr align="center" class="text1">
                <td colspan="2" rowspan="2" bgcolor="#999999">عملکرد<br />
                <span class="style2">کیلوگرم</span> <br /></td>
                <td colspan="4" rowspan="2" bgcolor="#999999">میزان تولید<br />
                <span class="style2">تن</span></td>
                <td colspan="2" rowspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
                <td height="48" colspan="6" bgcolor="#999999">سطح زیر کشت<br />
                  <span class="style2">هکتار</span></td>
                <td width="17%" rowspan="3" bgcolor="#999999">نام محصول</td>
                <td width="4%" rowspan="3" bgcolor="#999999">ردیف</td>
             </tr>
              <tr align="center" class="text1">
               <td height="37" colspan="3" bgcolor="#999999">بارور</td>
               <td colspan="3" bgcolor="#999999">غیربارور</td>
              </tr>
             <tr align="center" class="text1">
               <td height="20" bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="32" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">پراکنده</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td bgcolor="#999999">بارور</td>
               <td bgcolor="#999999">غیر بارور</td>
               <td bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
               <td height="32" bgcolor="#999999">جمع</td>
               <td bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
             </tr>
               <?php

 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($mah_qroup == '0')  { $v_group  = 1  ; $mah_name = '0' ; }else{ $v_group = "cod_qroup = '$mah_qroup'" ;}
 if ($mah_name == '0')  { $v_mah    = 1  ; }else{ $v_mah   = "no_mush   = '$mah_name'" ;}


 $query = "SELECT no_mush , SUM( zer_kesh ) zer_k, SUM( mah_tol ) mah_tol
FROM Mushroom_prod
where  Mushroom_prod.y_prod='$z_sal'  and $v_id_ostan and $v_id_city and $v_id_mar and  $f_add_abadi
and $f_add_city   and $v_mah 
GROUP BY no_mush
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
             <tr>
               <td height="23" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($mahtol_d/$s_d*1000) ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah_tol']/($row['zer_k']/10000)) ;?></td>
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="42" ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
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
               <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo mah_name_bagh_amar($row['no_mush']);?><br /></td>
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
               <td height="38" colspan="2" bgcolor="#999999">عملکرد<br />
               <span class="style2">کیلوگرم</span> <br /></td>
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
               <td height="20" bgcolor="#999999">دیم</td>
               <td bgcolor="#999999">آبی</td>
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
               <td bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <td height="23" align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($mahtol_d/$s_d*1000) ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah_tol']/($row['zer_k']/10000)) ;?></td>
               <td height="34" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah_tol'],1)*1 ; ?></td>
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
<p align="center" dir="rtl">گزارش سطح ، میزان تولید و عملکرد محصولات گلخانه به تفکیک نوع محصول <?php if($id_ostan1!='-1') echo 'استان '.ostan_name($id_ostan1);?><?php echo ' در سال  '.$z_sal?></p>  
<?php 

 if ($id_ostan1 == '-1') {$v_id_ostan  =1;}else{ $v_id_ostan = "id_ostan='$id_ostan1'" ;}
 if ($id_city == 0)      {$v_id_city   =1;}else{ $v_id_city = "id_city='$id_city'" ;}
 if ($id_mar  == 0)      {$v_id_mar    =1;}else{ $v_id_mar = "id_mar='$id_mar'" ;}
 if ($add_abadi  == '0') {$f_add_abadi =1;}else{ $f_add_abadi = "add_abadi = '$add_abadi'" ;}
 if ($add_city  == '0')  {$f_add_city  =1;}else{ $f_add_city = "add_city = '$add_city'" ;}
 if ($mah_qroup == '0')  { $v_group  = 1  ; $mah_name = '0' ; }else{ $v_group = "cod_qroup = '$mah_qroup'" ;}

?>
<table width="99%" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="text1">
    <td colspan="4" rowspan="2" bgcolor="#999999">میزان تولید<br /></td>
    <td colspan="2" rowspan="2" bgcolor="#999999">تعداد درختان پراکنده</td>
    <td height="40" colspan="6" bgcolor="#999999">سطح زیر کشت<br />
      <span class="style2">هکتار</span></td>
    <td width="17%" rowspan="3" bgcolor="#999999">نام محصول</td>
    <td width="4%" rowspan="3" bgcolor="#999999">ردیف</td>
  </tr>
  <tr align="center" class="text1">
    <td height="26" colspan="3" bgcolor="#999999">بارور</td>
    <td colspan="3" bgcolor="#999999">غیربارور</td>
  </tr>
  <tr align="center" class="text1">
    <td height="32" bgcolor="#999999">جمع</td>
    <td bgcolor="#999999">پراکنده</td>
    <td bgcolor="#999999">دیم</td>
    <td bgcolor="#999999">آبی</td>
    <td bgcolor="#999999">بارور</td>
    <td bgcolor="#999999">غیر بارور</td>
    <td bgcolor="#999999">جمع</td>
    <td bgcolor="#999999">دیم</td>
    <td bgcolor="#999999">آبی</td>
    <td height="32" bgcolor="#999999">جمع</td>
    <td bgcolor="#999999">دیم</td>
    <td width="7%" bgcolor="#999999">آبی</td>
  </tr>
    <?php

 if ($mah_qroup == '8' and $mah_name == '211101'){ $sum_item = "sum(no_mtol1_1) mah1 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211102'){ $sum_item = "sum(no_mtol1_2) mah2 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211103'){ $sum_item = "sum(no_mtol1_3) mah3 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211104'){ $sum_item = "sum(no_mtol1_4) mah4" ;   }
 if ($mah_qroup == '8' and $mah_name == '211105'){ $sum_item = "sum(no_mtol1_5) mah5" ;   }
 if ($mah_qroup == '8' and $mah_name == '211106'){ $sum_item = "sum(no_mtol1_6) mah6 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211107'){ $sum_item = "sum(no_mtol2_1) mah7 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211108'){ $sum_item = "sum(no_mtol2_2) mah8 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211109'){ $sum_item = "sum(no_mtol2_3) mah9 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211110'){ $sum_item = "sum(no_mtol2_4) mah10 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211201'){ $sum_item = "sum(no_mtol3_1) mah11 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211202'){ $sum_item = "sum(no_mtol3_2) mah12 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211111'){ $sum_item = "sum(no_mtol4_1) mah13 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211112'){ $sum_item = "sum(no_mtol4_2) mah14 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211113'){ $sum_item = "sum(no_mtol4_3) mah15 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211114'){ $sum_item = "sum(no_mtol4_4) mah16 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211115'){ $sum_item = "sum(no_mtol3_3) mah17 " ;   }
 if ($mah_qroup == '8' and $mah_name == '211116'){ $sum_item = "sum(no_mtol3_4) mah18 " ;   }
 if (($mah_qroup == '8'  or $mah_qroup == '0') and $mah_name == '0'){ 
 $sum_item = "sum(no_mtol1_1) mah1 ,
sum(no_mtol1_2) mah2 , sum(no_mtol1_3) mah3   , sum(no_mtol1_4) mah4 , sum(no_mtol1_5) mah5 ,sum(no_mtol1_6) mah6 ,
sum(no_mtol2_1) mah7 , sum(no_mtol2_2) mah8   , sum(no_mtol2_3) mah9 , sum(no_mtol2_4) mah10 , sum(no_mtol3_1) mah11 ,
sum(no_mtol3_2) mah12 , sum(no_mtol4_1) mah13 , sum(no_mtol4_2) mah14 , sum(no_mtol4_3) mah15 ,
sum(no_mtol4_4) mah16 , sum(no_mtol3_3) mah17 , sum(no_mtol3_4) mah18 " ;  }

 $query = "SELECT $sum_item  FROM Greenhous_prod WHERE y_prod ='$z_sal'  and $v_id_ostan 
 and $v_id_city and $v_id_mar and  $f_add_abadi and $f_add_city  "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
 <?php  if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211101' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah1'],1)*1 ; ?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah1'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >خیار / تن <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >1</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211102' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah2'],1)*1 ; ?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah2'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >گوجه فرنگی / تن <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >2</td>
  </tr>
    <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211103' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah3'],1)*1 ; ?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah3'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >فلفل / تن</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >3</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211104' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah4'],1)*1 ; ?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah4'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >بادمجان / تن <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >4</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211105' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah5'],1)*1 ; ?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah5'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >سبزیجات برگی / تن <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >5</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211106' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah6'],1)*1 ; ?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah6'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >سایر محصولات جالیزی / تن <br /></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >6</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211107' or $mah_name == '0')) { ?>
  <tr>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah7'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah7'],1)*1 ; ?></td>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >گل شاخه بریده / شاخه <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >7</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211108' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah8'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah8'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >گیاهان آپارتمانی / گلدان <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >8</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211109' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah9'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah9'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >درخت و درختچه های زیستی / اصله <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >9</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211110' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah10'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah10'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >گل های فصلی/ بوته <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >10</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '21111' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah13'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah13'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >گل شاخه بریده در فضای باز/ شاخه <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >11</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211112' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah14'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah14'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >گیاهان آپارتمانی در فضای باز / گلدان <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >12</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211113' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah15'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah15'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >درخت و درختچه های زیستی در فضای باز / اصله <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >13</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211114' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah16'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah16'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >گل های فصلی در فضای باز / یوته <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >14</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211201' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah11'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah11'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >توت فرنگی / تن <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >15</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211202' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah12'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah12'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >گیاهان دارویی / تن <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >16</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211115' or $mah_name == '0')) { ?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah17'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah17'],1)*1 ; ?></td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >نهال و قلمه / اصله <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >17</td>
  </tr>
  <?php  } if (($mah_qroup == '0' or $mah_qroup == '8' ) and ($mah_name == '211116' or $mah_name == '0')) { ?>
  <tr>
    <td  width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['mah18'],1)*1 ; ?></td><td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" >-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['mah18'],1)*1 ; ?></td>
    <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>-</td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >سایر میوه ها / تن <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >18</td>
  </tr>
  <?php
  }
?>
</table>
<p align="center" dir="rtl">پایان گزارش</p>
  <?php } }?>
</body>
</html>