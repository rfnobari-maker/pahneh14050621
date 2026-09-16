<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=زنبورستان_مدرک_تحصیلی.doc");
include('../lock_ce.php');
include('bee_counter.php');
$sal = '1396' ; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
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
}
-->
</style>
</head>
<body>
      <?php if(isset($_POST['id_ostan']))
{
	include_once('../login/config.php');
$id_ostan = $_POST['id_ostan'];
$query = "SELECT  DISTINCT id_ostan,id_city,city FROM list_abadi WHERE  id_ostan = '$id_ostan' order by binary city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
      <P align="center">آمار زنبورستان های استان در سال 1396 به تفکیک مدرک تحصیلی</p>  
    <table width="98%" height="88" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
          <tr align="center" class="text1">
            <td width="2%" height="26" bgcolor="#999999">حوزوی</td>
            <td width="2%" bgcolor="#999999">دکتری</td>
            <td width="2%" bgcolor="#999999">فوق لیسانس</td>
            <td width="2%" bgcolor="#999999">لیسانس</td>
            <td width="2%" bgcolor="#999999">فوق دیپلم</td>
            <td width="3%" bgcolor="#999999">دیپلم</td>
            <td width="4%" bgcolor="#999999">سیکل</td>
            <td width="4%" bgcolor="#999999">خواندن و نوشتن</td>
            <td width="5%" bgcolor="#999999">بیسواد</td>
               <td width="6%" bgcolor="#999999">تعداد زنبوردار</td>
            <td width="7%" bgcolor="#999999">شهرستان کد </td>
            <td width="3%" bgcolor="#999999">ردیف</td>
            </tr>
  <tr>
    <?php
$r = 1 ;
 foreach($stmt as $row){
 $id_city = $row['id_city'] ;
?>
    <td align="center" height="28"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'9')?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'8')?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'7')?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'6')?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'5')?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'4')?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'3')?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'2')?></td>
    <td align="center"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_bah_mtah_count($id_ostan,$id_city,$sal,'1')?></td>
    <td align="center"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
      <?php echo city_bee_count($row['id_city'],$id_ostan)?>
    </td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?><br /></td>
    <td align="center" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
?>
    <tr>
   <td align="center" height="33" class="style1"<?php if($r%2 == 0) echo 'bgcolor=#FFFFCC'?>><?php echo ostan_bah_mtah_count($id_ostan,$sal,'9')?></td>
    <td align="center"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_mtah_count($id_ostan,$sal,'8')?></td>
    <td align="center"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_mtah_count($id_ostan,$sal,'7')?></td>
    <td align="center"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_mtah_count($id_ostan,$sal,'6')?></td>
    <td align="center"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_mtah_count($id_ostan,$sal,'5')?></td>
    <td align="center"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_mtah_count($id_ostan,$sal,'4')?></td>
    <td align="center"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_mtah_count($id_ostan,$sal,'3')?></td>
    <td align="center"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_mtah_count($id_ostan,$sal,'2')?></td>
    <td align="center"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bah_mtah_count($id_ostan,$sal,'1')?></td>
    <td align="center"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo ostan_bee_count($id_ostan,$sal)?></td>
    <td align="center" colspan="2" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل</td>
    </tr>
</table>
  <?php }?>
<p align="center">-------------- پایان گزارش -------------</p>
</body>
</html>