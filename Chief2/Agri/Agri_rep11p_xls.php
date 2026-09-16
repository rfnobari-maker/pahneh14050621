<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=محصول_شهرستان.xls");
include("../../lock_ce.php");
include_once("../../event.php");
if (isset($_POST['z_sal'])) 
{
  $z_sal= $_POST['z_sal'] ; 
  $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  
}
if (isset($_POST['id_ostan']))   $id_ostan1= $_POST['id_ostan'] ; 
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
url: "ajax_city.php",
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
 $id_ostan= $_POST['id_ostan'] ;  ; 
 $Agri_prod_table = 'Agri_prod'.str_replace('-','_',$z_sal) ; 	  
?>
<p dir="rtl" align="center" class="style8">گزارش اطلاعات محصول <?php echo mah_name($mah_name) ?> استان <?php echo ostan_name($id_ostan1)?> به تفکیک شهرستان در سال <?php echo $z_sal ?></p>           <table width="98%" height="157" border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td align="center" height="38" colspan="3" bgcolor="#999999">میزان تولید / <span class="style2">تن</span><br /></td>
               <td align="center" colspan="3" bgcolor="#999999">سطح برداشت / <span class="style2">هکتار</span><br /></td>
               <td align="center" rowspan="2" bgcolor="#999999">پیش بینی تولید / <span class="style2">تن</span><br />                 
               <br /></td>
               <td align="center" colspan="3" bgcolor="#999999">سطح زیر کشت / <span class="style2">هکتار</span><br /></td>
               <td align="center" width="7%" rowspan="2" bgcolor="#999999">شهرستان </td>
               <td align="center" width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
             </tr>
             <tr align="center" class="text1">
               <td align="center" height="30" bgcolor="#999999">کل</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" bgcolor="#999999">آبی</td>
               <td align="center" height="30" bgcolor="#999999">کل</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" bgcolor="#999999">آبی</td>
               <td align="center" height="30" bgcolor="#999999">کل</td>
               <td align="center" bgcolor="#999999">دیم</td>
               <td align="center" width="6%" bgcolor="#999999">آبی</td>
              </tr>
             <tr>
               <?php
include('../../login/config.php') ;
 $query = "SELECT 
$Agri_prod_table.id_city ,
    sum(zer_kesht_a) zer_k1,
    sum(CASE WHEN no_kesh = '1' THEN zer_kesht_a ELSE 0 END) as zer_k1_abi,
    sum(CASE WHEN no_kesh = '2' THEN zer_kesht_a ELSE 0 END) as zer_k1_dim,

    sum(zer_kesht_b) zer_k2,
    sum(CASE WHEN no_kesh = '1' THEN zer_kesht_b ELSE 0 END) as zer_k2_abi,
    sum(CASE WHEN no_kesh = '2' THEN zer_kesht_b ELSE 0 END) as zer_k2_dim,

    sum(s_bar_a) s_bar1,
    sum(CASE WHEN no_kesh = '1' THEN s_bar_a ELSE 0 END) as s_bar1_abi,
    sum(CASE WHEN no_kesh = '2' THEN s_bar_a ELSE 0 END) as s_bar1_dim,

    sum(s_bar_b) s_bar2,
    sum(CASE WHEN no_kesh = '1' THEN s_bar_b ELSE 0 END) as s_bar2_abi,
    sum(CASE WHEN no_kesh = '2' THEN s_bar_b ELSE 0 END) as s_bar2_dim,

    sum(mah_tolp) m_tolp, 
    sum(mah_tol) m_tol,
    sum(CASE WHEN no_kesh = '1' THEN mah_tol ELSE 0 END) as m_tol_abi,
    sum(CASE WHEN no_kesh = '2' THEN mah_tol ELSE 0 END) as m_tol_dim
FROM $Agri_prod_table 
where id_ostan = '$id_ostan1'  and cod_qroup = '$mah_qroup' and cod_mah = '$mah_name'
GROUP BY id_city
 "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
?>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="48" ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2'],1)*1 ; ?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_dim'],1)*1 ; ?></td>
               <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_abi'],1)*1 ; ?></td>
               <td align="center" width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td align="center" width="3%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo city_name1($row['id_city'],$id_ostan1);?><br />                 <br /></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
             </tr>
             <?php
$r++ ; 
}
?>
             <?php 
 $query = "SELECT 
$Agri_prod_table.id_ostan ,
    sum(zer_kesht_a) zer_k1,
    sum(CASE WHEN no_kesh = '1' THEN zer_kesht_a ELSE 0 END) as zer_k1_abi,
    sum(CASE WHEN no_kesh = '2' THEN zer_kesht_a ELSE 0 END) as zer_k1_dim,

    sum(zer_kesht_b) zer_k2,
    sum(CASE WHEN no_kesh = '1' THEN zer_kesht_b ELSE 0 END) as zer_k2_abi,
    sum(CASE WHEN no_kesh = '2' THEN zer_kesht_b ELSE 0 END) as zer_k2_dim,

    sum(s_bar_a) s_bar1,
    sum(CASE WHEN no_kesh = '1' THEN s_bar_a ELSE 0 END) as s_bar1_abi,
    sum(CASE WHEN no_kesh = '2' THEN s_bar_a ELSE 0 END) as s_bar1_dim,

    sum(s_bar_b) s_bar2,
    sum(CASE WHEN no_kesh = '1' THEN s_bar_b ELSE 0 END) as s_bar2_abi,
    sum(CASE WHEN no_kesh = '2' THEN s_bar_b ELSE 0 END) as s_bar2_dim,

    sum(mah_tolp) m_tolp, 
    sum(mah_tol) m_tol,
    sum(CASE WHEN no_kesh = '1' THEN mah_tol ELSE 0 END) as m_tol_abi,
    sum(CASE WHEN no_kesh = '2' THEN mah_tol ELSE 0 END) as m_tol_dim
FROM $Agri_prod_table 
where id_ostan = '$id_ostan1' and cod_qroup = '$mah_qroup' and cod_mah = '$mah_name' 
GROUP BY id_ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
             <tr>
               <td align="center" height="39" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_dim'],1)*1 ; ?></td>
               <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> ><?php echo round($row['m_tol_abi'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_dim'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['s_bar1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['s_bar2_abi'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['m_tolp'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1'],1)*1 ; ?><br />
                <?php echo round($row['zer_k2'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_dim'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_dim'],1)*1 ; ?></td>
               <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo round($row['zer_k1_abi'],1)*1 ; ?><br />
                 <?php echo round($row['zer_k2_abi'],1)*1 ; ?></td>
               <td align="center" colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل استان </td>
             </tr>
   </table>
           <?php }?>
</body>
</html>