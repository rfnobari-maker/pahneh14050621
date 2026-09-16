<?php 
header("Content-type: application/vnd.ms-word;charset=UTF-8");
header("Content-Disposition: attachment;Filename=زمینه فعالیت.doc");
include_once('../lock_cp.php');
include_once('../event.php');
include_once('../login/config.php') ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    </style>

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
<?php 
$query = "SELECT id_ostan, count( * ) jam,
sum(jens = '1') as  mard,
sum(jens = '2') as  zan, 
sum(no_bah = '1') as  haghege, 
sum(no_bah = '2') as  hoghge, 
sum(fa_1  = '1') as  fa1, 
sum(fa_2  = '1') as  fa2, 
sum(fa_3  = '1') as  fa3, 
sum(fa_45 = '1') as  fa45, 
sum(fa_67 = '1') as  fa67, 
sum(fa_8  = '1') as  fa8, 
sum(fa_9  = '1') as  fa9, 
sum(fa_10 = '1') as  fa10, 
sum(fa_11 = '1') as  fa11, 
sum(fa_12 = '1') as  fa12 ,
sum(fa_13 = '1') as  fa13 
FROM bah
where id_ostan <> '' and ok ='1'
GROUP BY id_ostan 
ORDER BY FIELD(id_ostan ,'03','04','24','10','16','30','18','23','31','09','29','28','06','19','11','20','07','21','12','08','05','17','26','25','15','22','13'
,'02','00','01','27','14') "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p align="center" class="style8">گزارش  بهره برداران کشاورزی به تفکیک زمینه فعالیت </p>
           <table width="98%" height="194" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
  <tr align="center" class="text1">
    <td bgcolor="#999999">صنایع کشاورزی</td>
    <td bgcolor="#999999">پرورش ماهی</td>
    <td bgcolor="#999999">کرم ابریشم</td>
    <td height="47" bgcolor="#999999">زنبور عسل</td>
    <td height="47" bgcolor="#999999">طیور صنعتی</td>
    <td height="47" bgcolor="#999999">طیور سنتی</td>
    <td height="47" bgcolor="#999999">دام سبک</td>
    <td bgcolor="#999999">دام سنگین</td>
    <td bgcolor="#999999" style="text-align: center">گلخانه </td>
    <td bgcolor="#999999" style="text-align: center">باغ و قلمستان</td>
    <td bgcolor="#999999" style="text-align: center">زراعی</td>
    <td width="5%" bgcolor="#999999">حقوقی</td>
    <td width="7%" bgcolor="#999999">حقیقی<br /></td>
    <td width="7%" height="47" bgcolor="#999999">زن</td>
    <td width="6%" bgcolor="#999999">مرد</td>
    <td width="9%" bgcolor="#999999">کل بهره برداران</td>
    <td width="10%" bgcolor="#999999">استان </td>
    <td width="4%" bgcolor="#999999">ردیف</td>
    </tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" class="normalTextSmaller"><?php echo $row['fa13'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" class="normalTextSmaller"><?php echo $row['fa12'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" class="normalTextSmaller"><?php echo $row['fa11'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="5%" height="53" class="normalTextSmaller"><?php echo $row['fa10'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller"><?php echo $row['fa9'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="6%" class="normalTextSmaller"><?php echo $row['fa8'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="5%" class="normalTextSmaller"><?php echo $row['fa67'];?></td>
  <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa45'];?></td>
  <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa3'];?></td>
    <td width="8%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa2'];?></td>
    <td width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa1'];?></td>
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
sum(fa_1   = '1') as  fa1, 
sum(fa_2   = '1') as  fa2, 
sum(fa_3   = '1') as  fa3, 
sum(fa_45  = '1') as  fa45, 
sum(fa_67  = '1') as  fa67, 
sum(fa_8   = '1') as  fa8, 
sum(fa_9   = '1') as  fa9, 
sum(fa_10  = '1') as  fa10, 
sum(fa_11  = '1') as  fa11, 
sum(fa_12  = '1') as  fa12 ,
sum(fa_13  = '1') as  fa13 
FROM bah
where id_ostan <> '' and ok = '1' "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
  <tr>
    <td align="center" bgcolor="#999999" class="morph">صنایع کشاورزی</td>
    <td align="center" bgcolor="#999999" class="morph">پرورش ماهی</td>
    <td align="center" bgcolor="#999999" class="morph">کرم ابریشم</td>
    <td height="47" align="center" bgcolor="#999999" class="morph">زنیورعسل</td>
    <td height="47" align="center" bgcolor="#999999" class="morph">طیور صنعتی</td>
    <td height="47" align="center" bgcolor="#999999" class="morph">طیور سنتی</td>
    <td height="47" align="center" bgcolor="#999999" class="morph">دام سبک</td>
    <td align="center" bgcolor="#999999" class="morph">دام سنگین</td>
    <td align="center" bgcolor="#999999" class="morph">گلخانه</td>
    <td align="center" bgcolor="#999999" class="morph">باغی</td>
    <td align="center" bgcolor="#999999" class="morph">زراعی</td>
    <td align="center" bgcolor="#999999" class="morph">حقوقی</td>
    <td align="center" bgcolor="#999999" class="morph">حقیقی<br />
    </td>
    <td height="47" align="center" bgcolor="#999999" class="morph">زن</td>
    <td align="center" bgcolor="#999999" class="morph">مرد</td>
    <td bgcolor="#999999"  class="morph"  >کل بهره برداران</td>
    <td bgcolor="#FFFFCC"   class="morph">&nbsp;</td>
    <td bgcolor="#FFFFCC"   class="morph">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa13'];?></td>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa12'];?></td>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa11'];?></td>
    <td height="45" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa10'];?></td>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa9'];?></td>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa8'];?></td>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa67'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa45'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa3'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa2'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa1'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['hoghge'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['haghege'];?></td>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['zan'];?></td>
    <td bgcolor="#FFFFCC"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['mard'];?></td>
    <td bgcolor="#FFFFCC" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['jam'];?></td>
    <td bgcolor="#FFFFCC"   class="morph">جمع کل</td>
    <td bgcolor="#FFFFCC"   class="morph">&nbsp;</td>
    </tr>

         </table>
</body>
</html>



