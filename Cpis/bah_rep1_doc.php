<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=مدرک تحصیلی.doc");
include_once('../lock_cp.php');
include_once('../event.php');
include_once('../login/config.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
</head>
<body>
      </p>
<?php 
$query = "SELECT id_ostan,  count( * ) jam,
sum(jens = '1') as  mard,
sum(jens = '2') as  zan, 
sum(no_bah = '1') as  haghege, 
sum(no_bah = '2') as  hoghge, 
sum(m_tah = '1') as  m_tah1, 
sum(m_tah = '2') as  m_tah2, 
sum(m_tah = '3') as  m_tah3, 
sum(m_tah = '4') as  m_tah4, 
sum(m_tah = '5') as  m_tah5, 
sum(m_tah = '6') as  m_tah6, 
sum(m_tah = '7') as  m_tah7, 
sum(m_tah = '8') as  m_tah8, 
sum(m_tah = '9') as  m_tah9 
FROM bah
where id_ostan <> '' and ok = '1'
GROUP BY id_ostan 
ORDER BY FIELD(id_ostan ,'03','04','24','10','16','30','18','23','31','09','29','28','06','19','11','20','07','21','12','08','05','17','26','25','15','22','13'
,'02','00','01','27','14') "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center" class="style8">گزارش  بهره برداران کشاورزی به تفکیک مدرک تحصیلی </p>
           <table width="98%" height="178" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="text1">
    <td bgcolor="#999999">تحصیلات حوزوی</td>
    <td height="47" bgcolor="#999999">دکتری</td>
    <td height="47" bgcolor="#999999">فوق لیسانس</td>
    <td height="47" bgcolor="#999999">لیسانس</td>
    <td height="47" bgcolor="#999999">فوق دیپلم</td>
    <td bgcolor="#999999">دیپلم</td>
    <td bgcolor="#999999">سیکل</td>
    <td bgcolor="#999999">خواندن و نوشتن</td>
    <td bgcolor="#999999">بیسواد</td>
    <td width="6%" bgcolor="#999999">حقوقی</td>
    <td width="6%" bgcolor="#999999">حقیقی<br /></td>
    <td width="6%" height="47" bgcolor="#999999">زن</td>
    <td width="7%" bgcolor="#999999">مرد</td>
    <td width="8%" bgcolor="#999999">کل بهره برداران</td>
    <td width="13%" bgcolor="#999999">استان </td>
    <td width="4%" bgcolor="#999999">ردیف</td>
    </tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
?>
  <tr>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" class="normalTextSmaller"><?php echo $row['m_tah9'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="5%" height="36" class="normalTextSmaller"><?php echo $row['m_tah8'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller"><?php echo $row['m_tah7'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller"><?php echo $row['m_tah6'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="5%" class="normalTextSmaller"><?php echo $row['m_tah5'];?></td>
  <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah4'];?></td>
  <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah3'];?></td>
    <td width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah2'];?></td>
    <td width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah1'];?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['hoghge'];?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['haghege'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['zan'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row['mard'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['jam'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo ostan_name($row['id_ostan']);?><br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
$query = "SELECT id_ostan, count( * ) jam,
sum(jens = '1') as  mard,
sum(jens = '2') as  zan, 
sum(no_bah = '1') as  haghege, 
sum(no_bah = '2') as  hoghge, 
sum(m_tah = '1') as  m_tah1, 
sum(m_tah = '2') as  m_tah2, 
sum(m_tah = '3') as  m_tah3, 
sum(m_tah = '4') as  m_tah4, 
sum(m_tah = '5') as  m_tah5, 
sum(m_tah = '6') as  m_tah6, 
sum(m_tah = '7') as  m_tah7, 
sum(m_tah = '8') as  m_tah8, 
sum(m_tah = '9') as  m_tah9 
FROM bah
where id_ostan <> ''  and ok = '1' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
  <tr>
    <td align="center" bgcolor="#999999" class="morph">تحصیلات حوزوی</td>
    <td height="47" align="center" bgcolor="#999999" class="morph">دکتری</td>
    <td height="47" align="center" bgcolor="#999999" class="morph">فوق لیسانس</td>
    <td height="47" align="center" bgcolor="#999999" class="morph">لیسانس</td>
    <td height="47" align="center" bgcolor="#999999" class="morph">فوق دیپام</td>
    <td align="center" bgcolor="#999999" class="morph">دیپلم</td>
    <td align="center" bgcolor="#999999" class="morph">سیکل</td>
    <td align="center" bgcolor="#999999" class="morph">خواندن و نوشتن</td>
    <td align="center" bgcolor="#999999" class="morph">بیسواد</td>
    <td align="center" bgcolor="#999999" class="morph">حقوقی</td>
    <td align="center" bgcolor="#999999" class="morph">حقیقی<br />
    </td>
    <td height="47" align="center" bgcolor="#999999" class="morph">زن</td>
    <td align="center" bgcolor="#999999" class="morph">مرد</td>
    <td bgcolor="#999999"  class="morph"  >کل بهره برداران</td>
    <td bgcolor="#CCCCCC"   class="morph">&nbsp;</td>
    <td bgcolor="#CCCCCC"   class="morph">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah9'];?></td>
    <td height="46" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah8'];?></td>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah7'];?></td>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah6'];?></td>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah5'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah4'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah3'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah2'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah1'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['hoghge'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['haghege'];?></td>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mard'];?></td>
    <td bgcolor="#FFFFCC" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['jam'];?></td>
    <td bgcolor="#FFFFCC"   class="morph">جمع کل</td>
    <td bgcolor="#CCCCCC"   class="morph">&nbsp;</td>
    </tr>
</table>
<?php  ?>
</body>
</html>



