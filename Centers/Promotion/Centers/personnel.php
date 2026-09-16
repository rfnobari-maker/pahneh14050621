<?php
// تضمین سازگاری با PHP 5.3.3: استفاده از توابع و سینتکس‌های قدیمی‌تر
include("../../../lock_p2.php");
include("../../../event.php");
require_once('../../../Jalali.php');
date_default_timezone_set('Asia/Tehran');

// تعریف تاریخ و زمان
$date_edit = jdate("Y/m/d");
$time = date('H:i:s');

include ('../../../login/config.php');

// فرض بر این است که $dbh یک شیء PDO متصل به پایگاه داده است
// و متغیرهای $id_ostan و $id_mar از فایل lock_p2.php یا محیط اطراف آمده‌اند.

// 🎯 بهینه‌سازی: ادغام تمام شمارش‌ها در یک کوئری واحد برای کاهش بار دیتابیس
$query_optimized = "
    SELECT 
        COUNT(DISTINCT cod_m) AS count_tot,
        SUM(CASE WHEN S_access = '2' THEN 1 ELSE 0 END) AS count_mchif,
        SUM(CASE WHEN S_access = '1' THEN 1 ELSE 0 END) AS count_mor,
        SUM(CASE WHEN S_access = '50' THEN 1 ELSE 0 END) AS count_posh,
        SUM(CASE WHEN S_access = '51' THEN 1 ELSE 0 END) AS count_sarbaz
    FROM 
        users 
    WHERE 
        id_ostan = :id_ostan AND id_city = :id_city AND id_mar = :id_mar
";

$stmt_optimized = $dbh->prepare($query_optimized);

// اجرای کوئری با استفاده از پارامترهای آماده‌سازی شده
$stmt_optimized->execute(array(
    ':id_ostan' => $id_ostan,
    ':id_mar'   => $id_mar ,
	    ':id_city'   => $id_city
));

$counts = $stmt_optimized->fetch(PDO::FETCH_ASSOC);

// استخراج نتایج شمارش
$count_tot    = $counts['count_tot'];    // تعداد کل پرسنل (cod_m غیر تکراری)
$count_mchif  = $counts['count_mchif'];  // رئیس مرکز
$count_mor    = $counts['count_mor'];    // کارشناس پهنه
$count_posh   = $counts['count_posh'];   // پرسنل پشتیبانی
$count_sarbaz = $counts['count_sarbaz']; // سربازان سازندگی

// --- کوئری دوم: اطلاعات عمومی مرکز ---
// استفاده از Prepared Statement برای افزایش امنیت
$query_promo = "SELECT * FROM promo_cent_public WHERE id_mar = :id_mar AND id_ostan = :id_ostan";
$stmt_promo = $dbh->prepare($query_promo);
$stmt_promo->execute(array(
    ':id_mar'   => $id_mar,
    ':id_ostan' => $id_ostan
));
$row = $stmt_promo->fetch(PDO::FETCH_ASSOC);
$found_count = $stmt_promo->rowCount();

if ($found_count > 0)
{
    $no_action  = '1' ; 
    $m_name = $row['m_name']; 
    $rating = $row['rating']; 
    $y_tas = $row['y_tas']; 
    $lat = $row['lat']; 
    $lng = $row['lng']; 
    $address= $row['address']; 
    $cod_pos= $row['cod_pos']; 
    $tel= $row['tel']; 
    $fax= $row['fax']; 
    $f_naz_ab= $row['f_naz_ab']; 
    $f_dor_ab= $row['f_dor_ab']; 
    $zf_g= $row['zf_g']; 
    $to_z1= $row['to_z1']; 
    $to_z2= $row['to_z2']; 
    $to_z3= $row['to_z3']; 
    $to_b1= $row['to_b1']; 
    $to_b2= $row['to_b2']; 
    $to_b3= $row['to_b3']; 
    $to_d1= $row['to_d1']; 
    $to_d2= $row['to_d2']; 
    $to_d3= $row['to_d3']; 
}
else 
{
    $no_action = '2' ; 
}

// --- کوئری سوم (جدید): اطلاعات رئیس مرکز برای نمایش نام و عکس ---
// این کوئری برای نمایش مشخصات رئیس مرکز نیاز است
$query_chief_info = "SELECT name, Last_name, pic FROM users WHERE id_ostan = :id_ostan AND id_mar = :id_mar AND S_access = '2'";
$stmt_chief_info  = $dbh->prepare($query_chief_info);
$stmt_chief_info->execute(array(
    ':id_ostan' => $id_ostan,
    ':id_mar'   => $id_mar
));
$chief_info = $stmt_chief_info->fetch(PDO::FETCH_ASSOC);

// تعریف متغیرهای نمایش رئیس مرکز
if ($chief_info) {
    $chief_name = $chief_info['name'];
    $chief_lastname = $chief_info['Last_name'];
    $pic = $chief_info['pic'];
} else {
    $chief_name = '';
    $chief_lastname = 'رئیس مرکز یافت نشد';
    $pic = 'no_pic.png';
}

if ($pic == '') $pic = 'no_pic.png';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style1 {	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
</style>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
 <script src="../../../15_files/jquery.js" type="text/javascript"></script>
<script src="../../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
            $.validator.addMethod("IsDate",
                  function (value, element) {
                      var result = /^(?:1[23]\d{2})\/(?:0?[1-9]|1[0-2])\/(?:0?[1-9]|[12][0-9]|3[01])$/.test(value);
                      if (value.length == 0)
                          return true;
                      else
                          return result;
                  },
                   "<br/><span style='color:#FF0066'>مثال<br/><span dir='ltr'>1390/08/14 </span></span>"
             );

            //$("#form1").validate();
        });
    </script>
</head>
<body>
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 ?>
<p align="center" ><span class="style1">اطلاعات پرسنلی مرکز جهاد کشاورزی </span></p>
 <p align="center" ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
  <div  style=" border: 3px solid #930 ; width:600px ; margin:auto" >
 <table width="100%" height="301" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
   <tr class="style8">
     <td height="50" colspan="3" bgcolor="#FFFFCC">مشخصات رئیس مرکز</td>
     <td bgcolor="#FFFFCC">نفر<br /></td>
     <td bgcolor="#FFFFCC">سمت</td>
   </tr>
   <tr>
     <td width="129" height="51" bgcolor="#FFFFFF" class="normalTextSmaller" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $chief_lastname;?></td>
     <td width="75" bgcolor="#FFFFFF"  class="normalTextSmaller" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $chief_name;?></td>
     <td width="67" bgcolor="#FFFFFF" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?> ><span class="normalTextSmaller"><img id="img1" src="../../../files/users/<?php echo $pic?>" width="40" height="49"  alt=""/></span></td>
     <td width="102" bgcolor="#FFFFFF" style="font-size:18px ; color:#039"><form  action="#" method="post">
       <button style=" width:60px; height:40px ;font-size:18px; color:#039 "><?php echo $count_mchif;  ?></button>
     </form></td>
     <td width="227" bgcolor="#FFFFFF">رئیس مرکز</td>
   </tr>
   <tr>
     <td height="48" bordercolor="#FFFFFF" bgcolor="#CCCCCC" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
     <td height="48" bordercolor="#FFFFFF" bgcolor="#CCCCCC" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
     <td height="48" bordercolor="#FFFFFF" bgcolor="#CCCCCC" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
     <td bgcolor="#CCCCCC"><form  action="../../Cpromotes.php" method="post">
       <button style=" width:60px; height:40px ;font-size:18px; color:#039 "><?php echo $count_mor ; ?></button>
     </form></td>
     <td bgcolor="#CCCCCC">کارشناسان مسئول پهنه</td>
   </tr>
   <tr>
     <td height="54" bordercolor="#FFFFFF" bgcolor="#FFFFFF" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
     <td bordercolor="#FFFFFF" bgcolor="#FFFFFF" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
     <td bordercolor="#FFFFFF" bgcolor="#FFFFFF" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><a href="add_posh.php"><img src="../../../files/adduser1.png" width="42" height="42"  alt=""/></a></td>
     <td bgcolor="#FFFFFF"><form  action="sstaff.php" method="post">
       <button style=" width:60px; height:40px ;font-size:18px; color:#039 "><?php echo $count_posh;  ?></button>
     </form></td>
     <td bgcolor="#FFFFFF">نیروهای پشتیبانی</td>
   </tr>
   <tr>
     <td height="56" bordercolor="#FFFFFF" bgcolor="#CCCCCC" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
     <td bordercolor="#FFFFFF" bgcolor="#CCCCCC" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>&nbsp;</td>
     <td bordercolor="#FFFFFF" bgcolor="#CCCCCC" <?php if(isset($r) && $r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><a href="add_sold.php"><img src="../../../files/adduser1.png" width="42" height="42"  alt=""/></a></td>
     <td bgcolor="#CCCCCC"><form  action="list_sold.php" method="post">
       <button style=" width:60px; height:40px ;font-size:18px; color:#039 "><?php echo $count_sarbaz ;  ?></button>
     </form></td>
     <td bgcolor="#CCCCCC">سربازان سازندگی</td>
   </tr>
   <tr>
     <td height="35" colspan="3" bgcolor="#FFFFFF"><p>&nbsp;</p>
       <p>&nbsp;</p></td>
     <td bgcolor="#FFFFFF"><form  action="#" method="post">
       <button style=" width:60px; height:40px ;font-size:18px; color:#900; direction:rtl "> <?php echo $count_tot ;  ?></button>
     </form></td>
     <td bgcolor="#FFFFFF">جمع نیروهای مرکز</td>
   </tr>
 </table>
 </div>
  <p align="center" >&nbsp; </p>
  <p align="center" ><a href="index.php">
    <input name="action2" type="button" style="width:150px ; height:45px" tabindex="24"  value="بازگشت" />
  </a></p>
      </td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>