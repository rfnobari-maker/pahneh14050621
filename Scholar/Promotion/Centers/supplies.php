<?php
include('../../../lock_Sc.php');
include("../../../event.php");
include ('../../../login/config.php');
$id_mar1   = $_POST['id_mar'];
$id_ostan1 = $_POST['id_ostan'];
$id_city1  = $_POST['id_city'];
$id_select_city  = $_POST['id_select_city'];
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
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
             <td><img src="../../../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
               <td><?php include('menu.php'); ?>
</td>
  <tr>
    <td><table width="949" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
 <?php include('top.php');
 ?>
<p align="center" ><span class="style1">لیست ملزومات مرکز جهاد کشاورزی </span><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/>
   <?php
$query = "SELECT * from promo_cent_supplies where id_mar = $id_mar1 and id_ostan = '$id_ostan1' ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$found_count = $stmt -> rowCount();
if ($found_count>0)
{
?></p>
 </p>
 <table width="800" border="0" align="center" cellpadding="2" cellspacing="2">
   <tr class="text1">
     <td width="15%" height="47" bgcolor="#999999">تاریخ ثبت</td>
     <td width="12%" bgcolor="#999999">تعداد</td>
     <td width="12%" bgcolor="#999999">سال<br />
ساخت / خرید</td>
     <td width="38%" bgcolor="#999999">مدل</td>
     <td width="21%" bgcolor="#999999">نوع تجهیزات</td>
     <td width="6%" bgcolor="#999999">ردیف</td>
   </tr>
   <?php 
$r = 1 ;
 foreach($stmt as $row){
if ($row['no_taj']=='1') $v_no_taj ='رایانه' ;
if ($row['no_taj']=='2') $v_no_taj ='لب تاپ';
if ($row['no_taj']=='3') $v_no_taj ='GPS';
if ($row['no_taj']=='4') $v_no_taj ='دوربین دیجیتالی';
if ($row['no_taj']=='5') $v_no_taj ='دستگاه فاکس';
if ($row['no_taj']=='6') $v_no_taj ='دستگاه کپی';
if ($row['no_taj']=='7') $v_no_taj ='ویدئو پروژکتور';
if ($row['no_taj']=='8') $v_no_taj ='اینترنت';
if ($row['no_taj']=='9') $v_no_taj ='اسکنر';
if ($row['no_taj']=='10') $v_no_taj ='چاپگر';
if ($row['no_taj']=='11') $v_no_taj ='پرده نمایش';
if ($row['no_taj']=='12') $v_no_taj ='تلویزیون';
if ($row['no_taj']=='13') $v_no_taj ='تابلو اعلانات ترویجی';
if ($row['no_taj']=='14') $v_no_taj ='آرشیو رسانه های ترویجی';
if ($row['no_taj']=='15') $v_no_taj ='خودرو';
if ($row['no_taj']=='16') $v_no_taj ='تراکتور';
if ($row['no_taj']=='17') $v_no_taj ='سمپاش';

?>
   <tr>
     <td height="48" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s']?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['num']?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['y_make']?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $row['model'] ; ?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_taj?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
   </tr>
   <?php
$r++ ; 
 }
   ?>
 </table>
  </div>
  <form action="../../list_center.php#1" method="post" id="form1" name="form1">
     <input type="hidden" name="id_city"  value='<?php echo  $id_select_city ?>'>
     <input type="hidden" name="action"  value='1'>
     <input type="hidden" name="id_ostan"  value='<?php echo $id_ostan1 ?>'>
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="بازگشت" />
   </p>
  </form>  </td>
  </tr>
<?php
}
else 
{
echo '<p>&nbsp;</p>' ;
echo  "<p dir='rtl' class='style8'> متاسفانه اطلاعات ملزومات مرکز ثبت نشده است. </p> " ; 
echo '<p>&nbsp;</p>' ;
?>
 <form action="../../list_center.php#1" method="post" id="form1" name="form1">
     <input type="hidden" name="id_city"  value='<?php echo  $id_select_city ?>'>
     <input type="hidden" name="action"  value='1'>
     <input type="hidden" name="id_ostan"  value='<?php echo $id_ostan1 ?>'>
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="بازگشت" />
    </form>
    <?php
echo '<p>&nbsp;</p>' ;
}
?>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</body>
</html>
