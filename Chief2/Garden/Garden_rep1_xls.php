<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=Garden_rep1.xls");
include("../../lock_ce.php");
include("../../Jalali.php");
include('counter.php');
if (isset($_POST['id_ostan'])) $id_ostan= $_POST['id_ostan'] ; 
if (isset($_POST['z_sal']))    $z_sal= $_POST['z_sal'] ; 
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
<p align="center"> گزارش اطلاعات باغی استان به تفکیک شهرستان  </p>         
<table width="100%"  border="1" bordercolor="#0099CC" align="center" cellpadding="0" cellspacing="0"  >
  <thead class="fixedHeader">
    <tr align="center" class="alternateRow">
    <td height="38" colspan="3" bgcolor="#999999">میزان تولید<br />
      <span class="style2">  تن</span></td>
    <td colspan="3" bgcolor="#999999">نحوه کاشت<br /></td>
    <td colspan="3" bgcolor="#999999">تعداد درخت<br />
      <span class="style2"> هزار اصله</span></td>
    <td colspan="3" bgcolor="#999999">سطح زیر کشت<br />
      <span class="style2">هکتار</span></td>
    <td height="38" colspan="3" bgcolor="#999999">تعداد قطعات باغی<br />
      <span class="style2">قطعه</span></td>
    <td width="7%" rowspan="2" bgcolor="#999999">شهرستان </td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
  <tr align="center" class="text1">
    <td height="22" bgcolor="#999999">کل</td>
    <td bgcolor="#999999">دیم</td>
    <td bgcolor="#999999">آبی</td>
    <td width="5%" height="22" bgcolor="#999999">پراکنده</td>
    <td width="6%" bgcolor="#999999">مخلوط</td>
    <td width="5%" bgcolor="#999999">ساده</td>
    <td height="22" bgcolor="#999999">کل</td>
    <td bgcolor="#999999">غیربارور</td>
    <td bgcolor="#999999">بارور</td>
    <td height="22" bgcolor="#999999">کل</td>
    <td bgcolor="#999999">غیربارور</td>
    <td width="6%" bgcolor="#999999">بارور</td>
    <td width="6%" height="22" bgcolor="#999999">کل</td>
    <td width="5%" bgcolor="#999999">دیم</td>
    <td width="5%" bgcolor="#999999">آبی</td>
  </tr>
  <tr >
  <?php
  include('../../login/config.php');
$query = "SELECT  id_city,city FROM cityname WHERE  id_ostan = '$id_ostan' order by id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$r = 1 ;
 foreach($stmt as $row){
 $id_city = $row['id_city'] ;
?>
<td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?> width="5%" height="26"><?php echo Num2Fa(round(city_kol_mah($id_ostan,$id_city,$z_sal)*1,1))?></td>
<td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo Num2Fa(round(city_sum_mah_tol($id_ostan,$id_city,$z_sal,'2')*1,1))?></td>
<td align="center" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo Num2Fa(round(city_sum_mah_tol($id_ostan,$id_city,$z_sal,'1')*1,1))?></td>
    
  <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(city_nah_kesh($id_ostan,$id_city,$z_sal,'3'))?></td>
  <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(city_nah_kesh($id_ostan,$id_city,$z_sal,'2'))?></td>
  <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(city_nah_kesh($id_ostan,$id_city,$z_sal,'1'))?></td>
  <td align="center" width="6%" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(city_sum_tree($id_ostan,$id_city,$z_sal)/1000,1)) ?><br /></td>
  <td align="center" width="6%"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(city_sum_tree_gb($id_ostan,$id_city,$z_sal)/1000,1))?><br /></td>
  <td align="center" width="7%"<?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(city_sum_tree_b($id_ostan,$id_city,$z_sal)/1000,1))?><br /></td>
 <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_s_kesht($id_ostan,$id_city,$z_sal),1)) ?><br /></td>
 <td align="center" width="6%" <?php if($r%2 == 0) echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_s_kesht_gb($id_ostan,$id_city,$z_sal),1))?><br /></td>
    <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(sum_s_kesht_b($id_ostan,$id_city,$z_sal),1))?><br /></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo Num2Fa(Garden_count($id_ostan,$id_city,$z_sal))?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo Num2Fa(no_Garden_gat($id_ostan,$id_city,$z_sal,'2'))?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo Num2Fa(no_Garden_gat($id_ostan,$id_city,$z_sal,'1'))?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?><br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
<tr>
<td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?> width="5%" height="27" ><?php echo Num2Fa(round(ostan_kol_mah($id_ostan,$z_sal)*1,1))?></td>
  <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo Num2Fa(round(ostan_sum_mah_tol($id_ostan,$z_sal,'2')*1,1))?></td>
  <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC'?>  width="5%" ><?php echo Num2Fa(round(ostan_sum_mah_tol($id_ostan,$z_sal,'1')*1,1))?></td>
  <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(ostan_nah_kesh($id_ostan,$z_sal,'3'))?></td>
  <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(ostan_nah_kesh($id_ostan,$z_sal,'2'))?></td>
  <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(ostan_nah_kesh($id_ostan,$z_sal,'1'))?></td>
    <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(kol_sum_tree($id_ostan,$z_sal)/1000,1))?><br /></td>
    <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(kol_sum_tree_gb($id_ostan,$z_sal)/1000,1))?><br /></td>
  <td align="center" width="7%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(kol_sum_tree_b($id_ostan,$z_sal)/1000,1))?><br /></td>
    <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(kol_sum_s_kesht($id_ostan,$z_sal),1))?><br /></td>
    <td align="center" width="6%"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(kol_sum_s_kesht_gb($id_ostan,$z_sal),1))?><br /></td>
    <td align="center"   <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo Num2Fa(round(kol_sum_s_kesht_b($id_ostan,$z_sal),1))?><br /></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo Num2Fa(kol_Garnd_count($id_ostan,$z_sal))?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo Num2Fa(kol_no_Garden_gat('2',$id_ostan,$z_sal))?></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  ><?php echo Num2Fa(kol_no_Garden_gat('1',$id_ostan,$z_sal))?></td>
    <td colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >کل استان </td>
    </tr>
</table>
</div>
<p align="center"> -------------- پایان گزارش --------------</p>         
</body>
</html>



