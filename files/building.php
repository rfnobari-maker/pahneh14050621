<?php
include("../../../lock_p2.php");
include("../../../event.php");
require_once('../../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
 include ('../../../login/config.php');
$query = "SELECT * from promo_cent_build where id_mar = $id_mar and id_ostan = $id_ostan";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$found_count = $stmt -> rowCount();
if ($found_count>0)
{
  $no_action  = '1' ; 
  $y_make= $row['y_make']; 
  $s_arce = $row['s_arce']; 
  $s_ayan = $row['s_ayan']; 
  $no_mal = $row['no_mal']; 
  $faz_1 = $row['faz_1']; 
  $faz_2 = $row['faz_2']; 
  $faz_3 = $row['faz_3']; 
  $faz_4 = $row['faz_4']; 
  $faz_5 = $row['faz_5']; 
  $faz_6 = $row['faz_6']; 
  $faz_7 = $row['faz_7']; 
  $faz_8 = $row['faz_8']; 
  $faz_9 = $row['faz_9']; 
  $faz_10 = $row['faz_10']; 
  $faz_11 = $row['faz_11']; 
  $faz_12 = $row['faz_12']; 
  $faz_13 = $row['faz_13']; 
  $faz_14 = $row['faz_14']; 
  $faz_15 = $row['faz_15']; 
  $faz_16 = $row['faz_16']; 
}
else 
{
$no_action = '2' ; 
}
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
<p align="center" ><span class="style1">اطلاعات مربوط به ساختمان ، مرکز جهاد کشاورزی </span></p>
 <p align="center" ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>

   <table width="100%" border='0' align="center" cellpadding='0' cellspacing='0'>
     <tr bgcolor='#f1f1f1' >
       <td width="704"  align='center' bgcolor="#FFFFFF" class="style1">&nbsp;</td>
     </tr>
 </table>
 <form action="" method="post" id="form1" name="form1">
 <table width="850" border="0" align="center">
   <tr>
     <td width="263" height="38"><div align="right">
       <input name="y_make" type="text" class="required digits input_text" id="y_make" style="width:75px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $y_make?>" maxlength="11" xml:lang="fa" />
       </div></td>
     <td width="147"><div align="right">:سال ساخت </div></td>
     <td width="33">&nbsp;</td>
     <td width="227" height="38"><div align="right"><span class="input_text">
       <select name="no_mal" class="required input_text" id="no_mal" style="height:40px ; width:100px ; direction:rtl" tabindex="1">
         <option value="" >انتخاب کنید</option>
         <option value="1"<?php if ($no_mal=='1') echo "selected='selected'"?> >ملکی</option>
         <option value="2"<?php if ($no_mal=='2') echo "selected='selected'"?>>استیجاری</option>
       </select>
     </span></div></td>
     <td width="158"><div align="right">:نوع مالکیت</div></td>
   </tr>
   <tr>
     <td height="56" class="input_text"><div align="right"> <span class="style2">مترمربع</span>
       <input name="s_ayan" type="text" class="required number input_text" id="s_ayan" style="width:75px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $s_ayan ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right">:مساحت اعیان</div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <span class="style2">مترمربع</span>
       <input name="s_arce" type="text" class="required number input_text" id="s_arce" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $s_arce ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right">:مساحت عرصه</div></td>
   </tr>
   <tr>
     <td height="46" colspan="5" bgcolor="#CCCCCC"><div  style="margin-right:10px" align="right" class="style8">مشخصات فضای فیزیکی فعلی مرکز جهاد کشاورزی </div></td>
     </tr>
   <tr>
     <td height="40"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_2" type="text" class="required number input_text" id="faz_2" style="width:75px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $faz_2 ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right">:اتاق کارشناسان</div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_1" type="text" class="required number input_text" id="faz_1" style="width:75px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $faz_1 ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right" >:اتاق رئیس مرکز</div></td>
   </tr>
   <tr>
     <td height="41"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_4" type="text" class="required number input_text" id="faz_4" style="width:75px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $faz_4 ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right">:فضای آموزشی </div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_3" type="text" class="required number input_text" id="faz_3" style="width:75px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $faz_3 ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div  align="right" >: اتاق نهادهای مردمی</div></td>
   </tr>
   <tr>
     <td height="39"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_6" type="text" class="required number input_text" id="faz_6" style="width:75px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $faz_6 ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right">:نمازخانه</div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_5" type="text" class="required number input_text" id="faz_5" style="width:75px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $faz_5 ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right">:سالن اجتماعات</div></td>
   </tr>
   <tr>
     <td height="47"><div align="right">
       <span class="style2">مترمربع</span>
       <input name="faz_8" type="text" class="required number input_text" id="faz_8" style="width:75px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $faz_8?>" maxlength="11" xml:lang="fa" />
       </div></td>
     <td><div align="right" >: محوطه</div></td>
     <td>&nbsp;</td>
     <td height="47"><div align="right">
       <span class="style2">مترمربع</span>
       <input name="faz_7" type="text" class="required number input_text" id="faz_7" style="width:75px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $faz_7 ?>" maxlength="11" xml:lang="fa" />
       </div></td>
     <td><div align="right" >: راهرو و مشاعات داخلی </div></td>
   </tr>
   <tr>
     <td height="47"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_10" type="text" class="required number input_text" id="f_dor_ab3" style="width:75px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $faz_10?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right" >: اتاق نگهبانی</div></td>
     <td>&nbsp;</td>
     <td height="47"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_9" type="text" class="required number input_text" id="f_naz_ab3" style="width:75px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $faz_9 ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right" >: سرایداری </div></td>
   </tr>
   <tr>
     <td height="51"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_12" type="text" class="required number input_text" id="f_dor_ab4" style="width:75px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $faz_12?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right" >: سرویس بهداشتی</div></td>
     <td>&nbsp;</td>
     <td height="51"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_11" type="text" class="required number input_text" id="f_naz_ab4" style="width:75px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $faz_11 ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right" >:خوابگاه</div></td>
   </tr>
   <tr>
     <td height="47"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_14" type="text" class="required number input_text" id="f_dor_ab5" style="width:75px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $faz_14?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right" >: فضای الگویی</div></td>
     <td>&nbsp;</td>
     <td height="47"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_13" type="text" class="required number input_text" id="f_naz_ab5" style="width:75px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $faz_13 ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right" >:آبدارخانه </div></td>
   </tr>
   <tr>
     <td height="47"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_16" type="text" class="required number input_text" id="f_dor_ab6" style="width:75px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $faz_16?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right" >: خانه سازمانی</div></td>
     <td>&nbsp;</td>
     <td height="47"><div align="right"> <span class="style2">مترمربع</span>
       <input name="faz_15" type="text" class="required number input_text" id="f_naz_ab6" style="width:75px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $faz_15 ?>" maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="right" >:انبار</div></td>
   </tr>
 </table>
 <div align="center">
   <p>
     <input type="hidden" name="id_city"  value="<?php echo $id_city ?>">
     <input type="hidden" name="no_action"  value="<?php echo $no_action ?>">
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan ?>">
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="21" value="ثبت اطلاعات" />
   </p>
 </div>
      </form>
 <?php
 // در صورتی که اطلاعات ساختمان ثبت شده باشد امکان ثبت و مشاهده تعمییرات باشد
  if($no_action=='1') {?>
 <p align="center" >&nbsp;</p>
 <p align="center" ><span class="style8"><img src="../../../files/repair.png" width="75" height="75"  alt=""/></span><br />
   <span class="style8">ثبت  درخواست تعمیرات مورد نیاز مرکز</span><br />
   <img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form action="" method="post" id="form2" name="form2">
   <table width="800" border="0" align="center" cellpadding="2" cellspacing="2">
   <tr class="RedTitleSmaller">
     <td width="148" height="43" bgcolor="#FFFFCC">&nbsp;</td>
     <td width="144" bgcolor="#FFFFCC">متراژ</td>
     <td width="235" bgcolor="#FFFFCC">نوع تعمیرات مورد نیاز </td>
     <td width="247" bgcolor="#FFFFCC">نام فضا</td>
   </tr>
   <tr>
     <td height="54"><div align="center"><input name="action2" type="submit" id="action2" style="width:100px ; height:45px" tabindex="25" value="ثبت " /></div></td>
     <td><div align="center"><span class="style2">مترمربع</span>
       <input name="meter" type="text" class="required number input_text" id="meter" style="width:75px; height:30px ; " tabindex="24" dir="rtl" lang="fa"  maxlength="11" xml:lang="fa" />
     </div></td>
     <td><div align="center"><span class="input_text">
       <select name="no_repair" class="required input_text" id="no_repair" style="height:40px ; width:200px ; direction:rtl" tabindex="23">
         <option value="" >انتخاب کنید</option>
         <option value="1">نقاشی</option>
         <option value="2">بنایی</option>
         <option value="3">دیوارکشی و ایجاد فضا</option>
         <option value="4">حصارکشی</option>
         <option value="5">جدول بندی و محوطه سازی</option>
         <option value="6">تعمیرات سقف و ایزوگام</option>
         </select>
     </span></div></td>
     <td><div align="center"><span class="input_text">
       <select name="faz_name" class="required input_text" id="faz_name" style="height:40px ; width:200px ; direction:rtl" tabindex="22">
         <option value="" >انتخاب کنید</option>
         <option value="1">اتاق رئیس مرکز</option>
         <option value="2">اتاق کارشناسان</option>
         <option value="3">اتاق نهادهای مرکزی</option>
         <option value="4">فضای آموزشی</option>
         <option value="5">سالن اجتماعات</option>
         <option value="6">نمازخانه</option>
         <option value="7">راهرو و مشاعات داخلی </option>
         <option value="8">محوطه</option>
         <option value="9">سرایداری</option>
         <option value="10">اتاق نگهبان</option>
         <option value="11">خوابگاه</option>
         <option value="12">سرویس بهداشتی</option>
         <option value="13">آبدارخانه</option>
         <option value="14">فضای الگویی</option>
         <option value="15">انبار</option>
         <option value="16">خانه سازمانی</option>
       </select>
     </span></div></td>
   </tr>
 </table>
 </form>
 <p align="center" ></p>
 <p align="center" ><span class="style8"> لیست تعمیرات ثبت شده مرکز</span>
   <?php 
$query = "SELECT * from promo_cent_repair where id_mar = $id_mar order by faz_name ";
$stmt = $dbh->prepare($query);
$stmt->execute();
?>
   <br />
   <img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <table width="700" border="0" align="center" cellpadding="2" cellspacing="2">
   <tr class="text1">
     <td width="10%" height="47" bgcolor="#999999">عملیات</td>
     <td width="13%" bgcolor="#999999">تاریخ ثبت</td>
     <td width="12%" bgcolor="#999999">متراژ</td>
     <td width="31%" bgcolor="#999999">نوع تعمیرات</td>
     <td width="28%" bgcolor="#999999">نام فضا</td>
     <td width="6%" bgcolor="#999999">ردیف</td>
   </tr>
   <?php 
$r = 1 ;
 foreach($stmt as $row){
if ($row['faz_name']=='1') $v_faz_name ='اتاق رئیس مرکز' ;
if ($row['faz_name']=='2') $v_faz_name ='اتاق کارشناسان';
if ($row['faz_name']=='3') $v_faz_name ='اتاق نهادهای مرکزی';
if ($row['faz_name']=='4') $v_faz_name ='فضای آموزشی';
if ($row['faz_name']=='5') $v_faz_name ='سالن اجتماعات';
if ($row['faz_name']=='6') $v_faz_name ='نمازخانه';
if ($row['faz_name']=='7') $v_faz_name ='راهرو و مشاعات داخلی ';
if ($row['faz_name']=='8') $v_faz_name ='محوطه';
if ($row['faz_name']=='9') $v_faz_name ='سرایداری';
if ($row['faz_name']=='10') $v_faz_name ='اتاق نگهبان';
if ($row['faz_name']=='11') $v_faz_name ='خوابگاه';
if ($row['faz_name']=='12') $v_faz_name ='سرویس بهداشتی';
if ($row['faz_name']=='13') $v_faz_name ='آبدارخانه';
if ($row['faz_name']=='14') $v_faz_name ='فضای الگویی';
if ($row['faz_name']=='15') $v_faz_name ='انبار';
if ($row['faz_name']=='16') $v_faz_name ='خانه سازمانی';

if ($row['no_repair']=='1') $v_no_repair ='نقاشی';
if ($row['no_repair']=='2') $v_no_repair ='بنایی';
if ($row['no_repair']=='3') $v_no_repair ='دیوارکشی و ایجاد فضا';
if ($row['no_repair']=='4') $v_no_repair ='حصارکشی';
if ($row['no_repair']=='5') $v_no_repair ='جدول بندی و محوطه سازی';
if ($row['no_repair']=='6') $v_no_repair ='تعمیرات سقف و ایزوگام';
?>
   <tr>
     <td width="10%" height="51" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>>
     <form  action="repair_del.php" method="post">
       <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
       <button onclick="return confirm('از حذف  این رکورد مطمئن هستید ؟ ')"><img src="../../../files/del.png" border="0"  title=" حذف تعمیر " width="33" height="26" /></button>
     </form></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['date_s']?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['meter']?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_repair?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_faz_name?></td>
     <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r;?></td>
   </tr>
   <?php
$r++ ; 
 }
   ?>
 </table>
 <?php }?>
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
</body>
</html>
  <?PHP
 if (isset($_POST['action'])) 
 {  
  include('../../../login/config.php');
  $y_make= $_POST['y_make']; 
  $s_arce = $_POST['s_arce']; 
  $s_ayan = $_POST['s_ayan']; 
  $no_mal = $_POST['no_mal']; 
  $faz_1 = $_POST['faz_1']; 
  $faz_2 = $_POST['faz_2']; 
  $faz_3 = $_POST['faz_3']; 
  $faz_4 = $_POST['faz_4']; 
  $faz_5 = $_POST['faz_5']; 
  $faz_6 = $_POST['faz_6']; 
  $faz_7 = $_POST['faz_7']; 
  $faz_8 = $_POST['faz_8']; 
  $faz_9 = $_POST['faz_9']; 
  $faz_10 = $_POST['faz_10']; 
  $faz_11 = $_POST['faz_11']; 
  $faz_12 = $_POST['faz_12']; 
  $faz_13 = $_POST['faz_13']; 
  $faz_14 = $_POST['faz_14']; 
  $faz_15 = $_POST['faz_15']; 
  $faz_16 = $_POST['faz_16']; 
 $no_action= $_POST['no_action'];
if ($no_action=='1')  
{
$query = "UPDATE `promo_cent_build` SET  date_s=? ,id_ostan=? ,id_city=?,y_make=?,s_arce =?, s_ayan=?,no_mal=?,faz_1=?,faz_2=?,faz_3=?,faz_4=?,faz_5=?,faz_6=?,faz_7=?,faz_8=?,faz_9=?,faz_10=?,faz_11=?,faz_12=?, faz_13=?,faz_14=?,faz_15=?,faz_16=? WHERE id_mar=?";
$q = $dbh->prepare($query);
$q->execute(array($date_edit,$id_ostan,$id_city,$y_make,$s_arce , $s_ayan,$no_mal,$faz_1,$faz_2,$faz_3,$faz_4,$faz_5,$faz_6,$faz_7,$faz_8,$faz_9,$faz_10,$faz_11,$faz_12, $faz_13,$faz_14,$faz_15,$faz_16,$id_mar));
	sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ویرایش اطلاعات ساختمان مرکز ',$id_ostan) ; 
	 alert('اطلاعات ساختمان مرکز با موفقیت ویرایش شد ');
}
if ($no_action=='2')  
{
 $sql=$dbh->prepare("INSERT INTO `promo_cent_build` (`date_s`,`id_ostan`,`id_city`,`id_mar`,`y_make`,`s_arce` , `s_ayan`,`no_mal`,`faz_1`,`faz_2`,`faz_3`,`faz_4`,`faz_5`,`faz_6`,`faz_7`,`faz_8`,`faz_9`,`faz_10`,`faz_11`,`faz_12`,`faz_13`,`faz_14`,`faz_15`,`faz_16`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
$sql->execute(array($date_edit,$id_ostan,$id_city,$id_mar,$y_make,$s_arce , $s_ayan,$no_mal,$faz_1,$faz_2,$faz_3,$faz_4,$faz_5,$faz_6,$faz_7,$faz_8,$faz_9,$faz_10,$faz_11,$faz_12,$faz_13,$faz_14,$faz_15,$faz_16));
    // $mess = "کاربر جدید با موفقیت ثبت شد ";
	sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ثبت اطلاعات ساختمان مرکز ',$id_ostan) ; 
	 alert('اطلاعات ساختمان مرکز با موفقیت ثبت شد ');
} 
?>
	 <form name="myform1" class="myform" method="post" action="building.php">
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
 }
  ?>
  
    <?PHP
 if (isset($_POST['action2'])) 
 {  
  include('../../../login/config.php');
  $faz_name= $_POST['faz_name']; 
  $no_repair = $_POST['no_repair']; 
  $meter = $_POST['meter']; 
 $sql=$dbh->prepare("INSERT INTO `promo_cent_repair` (`date_s`,`id_ostan`,`id_city`,`id_mar`,`faz_name`,`no_repair`,`meter`) VALUES (?,?,?,?,?,?,?);");
$sql->execute(array($date_edit,$id_ostan,$id_city,$id_mar,$faz_name,$no_repair , $meter));
    // $mess = "کاربر جدید با موفقیت ثبت شد ";
	sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,'','ثبت تعمیرات ساختمان مرکز ',$id_ostan) ; 
	 alert('درخواست تعمیرات ساختمان مرکز با موفقیت ثبت شد ');
?>
	 <form name="myform1" class="myform" method="post" action="building.php">
     </form>
    <script type="text/javascript">document.myform1.submit();</script>
<?php
 }
  ?>