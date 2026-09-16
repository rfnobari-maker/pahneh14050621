<?php
require_once("../lock_ce.php");
require_once("../event.php");
require_once('side_menu1.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
    <style>
.tabel { margin-right:45px }
.text_r { margin-right:0px }
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}

</style>
  <script>
function target_popup(form) {
    window.open('null', 'formpopup', 'width=250,height=479,resizeable,scrollbars');
    form.target = 'formpopup';
}
function target_popup2(form) {
    window.open('null', 'formpopup', 'width=950,height=700,resizeable,scrollbars');
    form.target = 'formpopup';
}
</script>

</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td colspan="3">
      <?php require_once("header.php"); ?>
    </td>
  </tr>
  <tr>
    <td  colspan="3" valign="middle" >
<p class="style8">گزارش  بهره برداران کشاورزی به تفکیک زمینه فعالیت </p>
           <p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <table width="132" height="56" border="0" align="center">
             <tr>
               <td width="61"><form  action="bah_rep2_xls.php" method="post">
                 <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="39" height="43"  alt=""/></button>
               </form></td>
               <td width="129"><form  action="bah_rep2_doc.php" method="post">
                 <button><img src="../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="39" height="43"  alt=""/></button>
               </form></td>
             </tr>
           </table>
           <table width="85%" height="250" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="9" colspan="11" bgcolor="#999999">زمینه فعالیت</td>
               <td colspan="2" bgcolor="#999999">نوع بهره بردار</td>
    <td height="56" colspan="2" bgcolor="#999999">جنسیت </td>
    <td width="6%" rowspan="2" bgcolor="#999999">کل بهره برداران</td>
    <td width="14%" rowspan="2" bgcolor="#999999">استان </td>
    <td width="5%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
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
    <td width="5%" bgcolor="#999999">حقیقی<br /></td>
    <td width="4%" height="47" bgcolor="#999999">زن</td>
    <td width="5%" bgcolor="#999999">مرد</td>
    </tr>
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
$r = 1 ;
 foreach($stmt as $row){
?>
  <tr>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" class="normalTextSmaller"><?php echo $row['fa13'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="5%" class="normalTextSmaller"><?php echo $row['fa12'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="5%" class="normalTextSmaller"><?php echo $row['fa11'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" height="53" class="normalTextSmaller"><?php echo $row['fa10'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="5%" class="normalTextSmaller"><?php echo $row['fa9'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="5%" class="normalTextSmaller"><?php echo $row['fa8'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  width="4%" class="normalTextSmaller"><?php echo $row['fa67'];?></td>
  <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa45'];?></td>
  <td width="5%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa3'];?></td>
    <td width="6%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa2'];?></td>
    <td width="4%"  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['fa1'];?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['hoghge'];?></td>
    <td  class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['haghege'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> class="normalTextSmaller"><?php echo $row['zan'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>  class="normalTextSmaller"><?php echo $row['mard'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $row['jam'];?></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><form  action="bah_rep22.php" method="POST" onsubmit="return ray.ajax()">
      <input type="hidden" name="id_ostan_t" value="<?php echo $row['id_ostan'] ;?>" />
      <button style="width:110px ; height:40px ; font-family:tahoma ; font-size:14px "><?php echo ostan_name($row['id_ostan']);?></button>
      </form></td>
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
where id_ostan <> '' and ok ='1'"  ;
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
    <td colspan="2" rowspan="2" bgcolor="#FFFFCC"   class="morph">جمع کل</td>
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
    </tr>
         </table>
    </td>
  </tr>
  <tr>
    <td height="100" colspan="3" valign="middle" >
      <!-- فاصله -->
    </td>
  </tr>
  <tr>
    <td height="109" colspan="3" valign="middle" background="../files/bottom.gif">
      <?php include('../footer.php'); ?>
    </td>
  </tr>
</table>

</body>
</html>