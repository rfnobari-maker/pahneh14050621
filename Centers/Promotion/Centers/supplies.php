<?php
include("../../../lock_p2.php");
include("../../../event.php");
require_once('../../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
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
      <script type="text/javascript">
        $().ready(function () {
            $("#form2").validate();
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
<p align="center" ><span class="style1">اطلاعات مربوط به تجهیزات  مرکز جهاد کشاورزی </span></p>
 <p align="center" ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form action="" method="post" id="form2" name="form2">
   <table width="800" border="0" align="center" cellpadding="2" cellspacing="2">
   <tr class="RedTitleSmaller">
     <td width="100" height="43" bgcolor="#FFFFCC">&nbsp;</td>
     <td width="96" bgcolor="#FFFFCC">تعداد</td>
     <td width="101" bgcolor="#FFFFCC">سال ساخت / خرید</td>
     <td width="314" bgcolor="#FFFFCC">مدل</td>
     <td width="157" bgcolor="#FFFFCC">نوع تجهیزات</td>
   </tr>
   <tr>
     <td height="49"><div align="center"><input name="action" type="submit" id="action" style="width:100px ; height:45px" tabindex="5" value="ثبت " /></div></td>
     <td><div align="center">
       <input name="num" type="text" class="required number input_text" id="num"   style="width:75px; height:30px ; " tabindex="4" dir="rtl" lang="fa"  maxlength="3" xml:lang="fa" />
     </div></td>
     <td><div align="center">
       <input name="y_make" type="text" class="required number input_text" id="y_make"  style="width:75px; height:30px ; " tabindex="3" dir="rtl" lang="fa"  maxlength="4" xml:lang="fa" />
     </div></td>
     <td><div align="right">
       <input name="model" type="text" class="required  input_text" id="model" style="width:300px; height:30px ; " tabindex="2" dir="rtl" lang="fa"  maxlength="300" xml:lang="fa" />
     </div></td>
     <td><div align="center"><span class="input_text">
       <select name="no_taj" class="required input_text" id="no_taj" style="height:40px ; width:160px ; direction:rtl" tabindex="1">
         <option value="" >انتخاب کنید</option>
         <option value="18">میز</option>
         <option value="19">صندلی</option>
         <option value="1">رایانه</option>
         <option value="2">لب تاپ</option>
         <option value="20">تبلت</option>
         <option value="3">GPS</option>
         <option value="4">دوربین دیجیتالی</option>
         <option value="5">دستگاه فاکس</option>
         <option value="6">دستگاه کپی</option>
         <option value="7">ویدئو پروژکتور</option>
         <option value="8">اینترنت</option>
         <option value="9">اسکنر</option>
         <option value="10">چاپگر</option>
         <option value="11">پرده نمایش</option>
         <option value="12">تلویزیون</option>
         <option value="13">تابلو اعلانات ترویجی</option>
         <option value="14">آرشیو رسانه های ترویجی</option>
         <option value="15">خودرو</option>
         <option value="16">تراکتور</option>
         <option value="17">سمپاش</option>
         </select>
     </span></div></td>
   </tr>
 </table>
      <input type="hidden" name="no_action"  value="<?php echo $no_action ?>">
 </form>
 <p align="center" ></p>
 <p align="center" ><span class="style8"> لیست  تجهیزات ثبت شده مرکز</span>
   <?php 
include ('../../../login/config.php');
$query = "SELECT * from promo_cent_supplies where  id_ostan = '$id_ostan' and id_mar = '$id_mar' order by no_taj ";
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
   <br />
   <img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <table width="800" border="0" align="center" cellpadding="2" cellspacing="2">
   <tr class="text1">
     <td width="8%" height="47" bgcolor="#999999">عملیات</td>
     <td width="15%" bgcolor="#999999">تاریخ ثبت</td>
     <td width="12%" bgcolor="#999999">تعداد</td>
     <td width="12%" bgcolor="#999999">سال ساخت / خرید</td>
     <td width="38%" bgcolor="#999999">مدل</td>
     <td width="21%" bgcolor="#999999">نوع تجهیزات</td>
     <td width="6%" bgcolor="#999999">ردیف</td>
   </tr>
   <?php 
$r = 1 ;
 foreach($stmt as $row){
if ($row['no_taj']=='18') $v_no_taj ='میز' ;
if ($row['no_taj']=='19') $v_no_taj ='صندلی';
if ($row['no_taj']=='1') $v_no_taj ='رایانه' ;
if ($row['no_taj']=='2') $v_no_taj ='لب تاپ';
if ($row['no_taj']=='20') $v_no_taj ='تبلت';
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
     <td width="8%" height="55" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
     <form  action="supplies_del.php" method="post">
       <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
       <button onclick="return confirm('از حذف  این رکورد مطمئن هستید ؟ ')"><img src="../../../files/del.png" border="0"  title=" حذف تعمیر " width="33" height="26" /></button>
     </form></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s']?></td>
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
 <p align="center" ></p>
 <p align="center" ><a href="index.php"><img src="../../../files/goback.jpg" width="128" height="57"  alt=""/></a></p>
 <p align="center" ></p></td>
  </tr>
  <tr>
    <td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>				</td>
                  </tr>
</table></body>
</html>
  <?PHP
 if (isset($_POST['action'])) 
 {  
  include('../../../login/config.php');
   $y_make= $_POST['y_make']; 
   $no_taj = $_POST['no_taj']; 
   $model = $_POST['model']; 
   $num = $_POST['num']; 
   $no_action= $_POST['no_action'];
  $sql=$dbh->prepare("INSERT INTO promo_cent_supplies (date_s,id_ostan,id_city,id_mar,y_make,no_taj , model,num) VALUES (?,?,?,?,?,?,?,?);");
  $sql->execute(array($date_edit,$id_ostan,$id_city,$id_mar,$y_make,$no_taj,$model,$num));
    // $mess = "کاربر جدید با موفقیت ثبت شد ";
sabt_event($login_session,getUserIP_1(),$date_edit,$time,'','ثبت اطلاعات تجهیزات مرکز ',$id_ostan) ; 
alert('اطلاعات تجهیزات مرکز با موفقیت ثبت شد ');
?>
	 <form name="myform1" class="myform" method="post" action="supplies.php">
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
 }
  ?>
  
