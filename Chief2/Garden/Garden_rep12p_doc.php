<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=محصول_استان.doc");
include("../../lock_ce.php");
include_once("../../event.php");
if (isset($_POST['z_sal']))   $z_sal= $_POST['z_sal'] ; 
if (isset($_POST['mah_qroup'])) $mah_qroup = $_POST['mah_qroup'] ;
if (isset($_POST['mah_name'])) $mah_name = $_POST['mah_name'] ;
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
<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php echo $num_t_mah ;?>").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_garden.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});
});
});
</script>

<script type="text/javascript">
$(document).ready(function()
{
$(".country").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar<?php echo $num_t_mah ;?>").html(html);
} 
});
});
});
</script>

</head>
<body>
      <?php 
   if (isset($_POST['z_sal']))
   {
 $z_sal= $_POST['z_sal'] ; 
?>
           <p align="center" dir="rtl" >گزارش اطلاعات محصول <?php echo mah_name_bagh($mah_name) ?> به تفکیک استان در سال <?php echo $z_sal ?></p>
           <table width="99%" height="277" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td align="center"height="33" colspan="4" bgcolor="#999999">میزان تولید / <span class="style2">تن</span><br /></td>
               <td align="center"rowspan="2" bgcolor="#999999">پیش بینی تولید / <span class="style2">تن</span><br /></td>
               <td align="center"colspan="4" bgcolor="#999999">تعداد درخت / <span class="style2">اصله</span></td>
               <td align="center"colspan="3" bgcolor="#999999">سطح زیر کشت /<span class="style2">هکتار</span></td>
               <td align="center"width="5%" rowspan="2" bgcolor="#999999">عنوان</td>
               <td align="center"width="17%" rowspan="2" bgcolor="#999999">استان </td>
               <td align="center"width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td align="center"height="34" bgcolor="#999999">کل</td>
               <td align="center"bgcolor="#999999">پراکنده</td>
               <td align="center"bgcolor="#999999">دیم</td>
               <td align="center"bgcolor="#999999">آبی</td>
               <td align="center"height="34" bgcolor="#999999">کل</td>
               <td align="center"bgcolor="#999999">پراکنده</td>
               <td align="center"bgcolor="#999999">دیم</td>
               <td align="center"bgcolor="#999999">آبی</td>
               <td align="center"height="34" bgcolor="#999999">کل</td>
               <td align="center"bgcolor="#999999">دیم</td>
               <td align="center"width="7%" bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <?php
include('../../login/config.php') ;
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
where  Garden_prod.z_sal='$z_sal'  and cod_qroup = '$mah_qroup' and cod_mah = '$mah_name'
GROUP BY id_ostan
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="67" ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_p'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="6%" ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td align="center"width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td align="center"width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1'] ; ?><br />
                 <?php echo $row['s_bar2'] ; ?></td>
               <td align="center"width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?><br />
                <?php echo $row['tree_gb_p'] ; ?></td>
               <td align="center"width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1_dim'] ; ?><br />
                 <?php echo $row['s_bar2_dim'] ; ?></td>
               <td align="center"width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1_abi'] ; ?><br />
                 <?php echo $row['s_bar2_abi'] ; ?></td>
               <td align="center"width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td align="center"width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >بارور<br />
                غیربارور</td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo ostan_name($row['id_ostan']);?><br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
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
where  Garden_prod.z_sal='$z_sal' and cod_qroup = '$mah_qroup' and cod_mah = '$mah_name' 
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr align="center" class="text1">
               <td align="center"height="33" colspan="4" bgcolor="#999999">میزان تولید / <span class="style2">تن</span><br /></td>
               <td align="center"rowspan="2" bgcolor="#999999">پیش بینی تولید / <span class="style2">تن</span><br /></td>
               <td align="center"colspan="4" bgcolor="#999999">تعداد درخت / <span class="style2">اصله</span></td>
               <td align="center"colspan="3" bgcolor="#999999">سطح زیر کشت /<span class="style2">هکتار</span></td>
               <td align="center"rowspan="2" bgcolor="#999999">عنوان </td>
               <td align="center"rowspan="2" bgcolor="#999999">&nbsp;</td>
               <td align="center"rowspan="2" bgcolor="#999999">&nbsp;</td>
             </tr>
             <tr align="center" class="text1">
               <td align="center"height="32" bgcolor="#999999">کل</td>
               <td align="center"bgcolor="#999999">پراکنده</td>
               <td align="center"bgcolor="#999999">دیم</td>
               <td align="center"bgcolor="#999999">آبی</td>
               <td align="center"height="32" bgcolor="#999999">کل</td>
               <td align="center"bgcolor="#999999">پراکنده</td>
               <td align="center"bgcolor="#999999">دیم</td>
               <td align="center"bgcolor="#999999">آبی</td>
               <td align="center"height="32" bgcolor="#999999">کل</td>
               <td align="center"bgcolor="#999999">دیم</td>
               <td align="center"bgcolor="#999999">آبی</td>
             </tr>
             <tr>
               <td align="center"height="65" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_p'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1'];?><br/>
                 <?php echo $row['s_bar2'] ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['tree_b_p'] ; ?><br />
                <?php echo $row['tree_gb_p'] ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1_dim'] ; ?><br />
                 <?php echo $row['s_bar2_dim'] ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['s_bar1_abi'] ; ?><br />
                 <?php echo $row['s_bar2_abi'] ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td align="center"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td align="center"  <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td align="center"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >بارور<br />
                غیربارور</td>
               <td align="center"colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل </td>
             </tr>
   </table>
           <?php }?>
</body>
</html>