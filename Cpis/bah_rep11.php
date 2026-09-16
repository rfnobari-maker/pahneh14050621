<?php 
include_once('../lock_cp.php');
include_once('../event.php');
$id_ostan_t = $_POST['id_ostan_t'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
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
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
      <?php include('top.php');?>
      </p>
<?php 
$query = "SELECT id_ostan,id_city, count( * ) jam,
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
where id_ostan = '$id_ostan_t' and ok = '1'
GROUP BY id_city 
ORDER BY id_city "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
<p class="style8">گزارش  بهره برداران کشاورزی استان <?php echo ostan_name($id_ostan_t);?> به تفکیک مدرک تحصیلی </p>
<p><img src="../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
           <table width="132" height="56" border="0" align="center">
             <tr>
               <td width="61"><form  action="bah_rep11_xls.php" method="post">
                 <input type="hidden" name="id_ostan_t" value="<?php echo $id_ostan_t ;?>" />
                 <button><img src="../files/xls.png" title="دانلود نتایج با فرمت فایل اکسل"  width="39" height="43"  alt=""/></button>
               </form></td>
               <td width="129"><form  action="bah_rep11_doc.php" method="post">
                 <input type="hidden" name="id_ostan_t" value="<?php echo $id_ostan_t ;?>" />
                 <button><img src="../files/word.png" title="دانلود نتایج با فرمت فایل ورد"  width="39" height="43"  alt=""/></button>
               </form></td>
             </tr>
           </table>
           <table width="98%" height="330" border="1" bordercolor="#0099FF" align="center" cellpadding="0" cellspacing="0" >
             <tr align="center" class="text1">
               <td height="9" colspan="9" bgcolor="#999999">مدرک تحصیلی</td>
    <td colspan="2" bgcolor="#999999">نوع بهره بردار</td>
    <td height="56" colspan="2" bgcolor="#999999">جنسیت </td>
    <td width="8%" rowspan="2" bgcolor="#999999">کل بهره برداران</td>
    <td width="13%" rowspan="2" bgcolor="#999999">شهرستان </td>
    <td width="4%" rowspan="2" bgcolor="#999999">ردیف</td>
    </tr>
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
    </tr>
  <?php
$r = 1 ;
 foreach($stmt as $row){
?>
  <tr>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="6%" class="normalTextSmaller"><?php echo $row['m_tah9'];?></td>
  <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> width="5%" height="73" class="normalTextSmaller"><?php echo $row['m_tah8'];?></td>
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
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo city_name1($row['id_city'],$row['id_ostan']);?><br />
      <?php echo $row['id_city'] ; ?> <br /></td>
    <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><?php echo $r;?></td>
  </tr>
<?php
$r++ ; 
}
$query = "SELECT id_city,count( * ) jam,
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
where id_ostan = '$id_ostan_t' and ok = '1' "  ;
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
    <td colspan="2" rowspan="2" bgcolor="#FFFFCC"   class="morph">جمع کل</td>
    </tr>
  <tr>
    <td bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah9'];?></td>
    <td height="73" bgcolor="#FFFFCC" class="normalTextSmaller" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['m_tah8'];?></td>
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
    </tr>

         </table>
           <p>&nbsp;</p><p><a href="bah_rep1.php" title="برگشت به صفحه قبل"><img src="../files/goback.jpg" width="118" height="47"  alt=""/> </a></p>    </p>
           <p>&nbsp;</p>

      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../files/bottom.gif"><?php include('../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>



