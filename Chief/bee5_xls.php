<?php 
header("Content-type: application/vnd.ms-excel;charset=UTF-8");
header("Content-Disposition: attachment;Filename=زنبورستان_به_تفکیک_شهرستان.xls");
include('../lock_ce.php');
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
$sal = $_POST['sal'];
 $query = "SELECT bee.id_ostan,cityname.city,count(*) as jam,
sum(CASE WHEN bah.no_bah = '1' THEN 1 ELSE 0 END ) no_bah1,
sum(CASE WHEN bah.no_bah = '2' THEN 1 ELSE 0 END ) no_bah2,
sum(CASE WHEN bah.m_tah  = '1'  THEN 1 ELSE 0 END ) m_tah1,
sum(CASE WHEN bah.m_tah  = '2'  THEN 1 ELSE 0 END ) m_tah2,
sum(CASE WHEN bah.m_tah  = '3'  THEN 1 ELSE 0 END ) m_tah3,
sum(CASE WHEN bah.m_tah  = '4'  THEN 1 ELSE 0 END ) m_tah4,
sum(CASE WHEN bah.m_tah  = '5'  THEN 1 ELSE 0 END ) m_tah5,
sum(CASE WHEN bah.m_tah  = '6'  THEN 1 ELSE 0 END ) m_tah6,
sum(CASE WHEN bah.m_tah  = '7'  THEN 1 ELSE 0 END ) m_tah7,
sum(CASE WHEN bah.m_tah  = '8'  THEN 1 ELSE 0 END ) m_tah8,
sum(CASE WHEN bah.m_tah  = '9'  THEN 1 ELSE 0 END ) m_tah9
FROM bee 
left join bah ON bah.bah_cod_m = bee.bah_cod_m 
left join cityname ON bee.id_ostan = cityname.id_ostan  and bee.id_city = cityname.id_city 
WHERE bee.sal='$sal'  and bee.id_ostan = '$id_ostan'
group by bee.id_city
order by binary cityname.city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<P  class="style1" align="center">گزارش زنبورستان به تفکیک شهرستان بر اساس سرشماری سال : <?php echo $sal?></p>  
    <table width="98%" height="150" border="1" bordercolor="#CCCCCC" align="center" cellpadding="0" cellspacing="0" >
          <tr align="center" class="style1">
            <td width="2%" height="53" bgcolor="#999999">حوزوی</td>
            <td width="2%" bgcolor="#999999">دکتری</td>
            <td width="2%" bgcolor="#999999">فوق لیسانس</td>
            <td width="2%" bgcolor="#999999">لیسانس</td>
            <td width="2%" bgcolor="#999999">فوق دیپلم</td>
            <td width="3%" bgcolor="#999999">دیپلم</td>
            <td width="4%" bgcolor="#999999">سیکل</td>
            <td width="4%" bgcolor="#999999">خواندن و نوشتن</td>
            <td width="5%" bgcolor="#999999">بیسواد</td>
               <td width="6%" bgcolor="#999999">کل</td>
               <td width="7%" bgcolor="#999999">حقوقی</td>
               <td width="7%" bgcolor="#999999">حقیقی</td>
            <td width="7%" bgcolor="#999999">شهرستان </td>
            <td width="3%" bgcolor="#999999">ردیف</td>
            </tr>
  <tr>
    <?php
$r = 1 ;
 foreach($stmt as $row){
?>
    <td align="center" height="32"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah9'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah8'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah7'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah6'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah5'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah4'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah3'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah2'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah1'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['jam'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah2'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1'];?></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['city'];?><br /></td>
    <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
$query = "SELECT count(*) as jam,
sum(CASE WHEN bah.no_bah = '1' THEN 1 ELSE 0 END ) no_bah1,
sum(CASE WHEN bah.no_bah = '2' THEN 1 ELSE 0 END ) no_bah2,
sum(CASE WHEN bah.m_tah  = '1'  THEN 1 ELSE 0 END ) m_tah1,
sum(CASE WHEN bah.m_tah  = '2'  THEN 1 ELSE 0 END ) m_tah2,
sum(CASE WHEN bah.m_tah  = '3'  THEN 1 ELSE 0 END ) m_tah3,
sum(CASE WHEN bah.m_tah  = '4'  THEN 1 ELSE 0 END ) m_tah4,
sum(CASE WHEN bah.m_tah  = '5'  THEN 1 ELSE 0 END ) m_tah5,
sum(CASE WHEN bah.m_tah  = '6'  THEN 1 ELSE 0 END ) m_tah6,
sum(CASE WHEN bah.m_tah  = '7'  THEN 1 ELSE 0 END ) m_tah7,
sum(CASE WHEN bah.m_tah  = '8'  THEN 1 ELSE 0 END ) m_tah8,
sum(CASE WHEN bah.m_tah  = '9'  THEN 1 ELSE 0 END ) m_tah9
FROM bee 
left join bah ON bah.bah_cod_m = bee.bah_cod_m 
WHERE bee.sal='$sal' and bee.id_ostan = '$id_ostan' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <tr>
      <td align="center" height="57"  class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah9'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah8'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah7'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah6'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah5'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah4'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah3'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah2'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah1'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['jam'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah2'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['no_bah1'];?></td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >جمع کل</td>
      <td align="center" class="style1" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> >&nbsp;</td>
    </tr>
</table>
  <?php }?>
<p align="center">-------------- پایان گزارش -------------</p>
</body>
</html>