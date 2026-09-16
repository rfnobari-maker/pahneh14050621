<?php
include("../../../lock_expar.php");
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
<p align="center" ><span class="style1">اطلاعات ساختمان مرکز جهاد کشاورزی </span></p>
 <p align="center" ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
<?php
$query = "SELECT * from promo_cent_build where id_mar = '$id_mar1' and id_ostan = '$id_ostan1'";
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
?>
 <form action="../../list_center.php#1" method="post" id="form1" name="form1">
  <div  style=" border: 3px solid #930 ; width:90% ; margin:auto" >
    <table width="850" border="0" align="center">
      <tr>
        <td width="263" height="38"><div align="right">
          <input name="y_make" type="text" class="required digits input_text" id="y_make" style="width:75px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $y_make?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td width="147"><div align="right">:سال ساخت </div></td>
        <td width="33">&nbsp;</td>
        <td width="227" height="38"><div align="right"><span class="input_text">
          <select name="no_mal" disabled="disabled" class="required input_text" id="no_mal" style="height:40px ; width:100px ; direction:rtl" tabindex="1">
            <option value="" >انتخاب کنید</option>
            <option value="1"<?php if ($no_mal=='1') echo "selected='selected'"?> >ملکی</option>
            <option value="2"<?php if ($no_mal=='2') echo "selected='selected'"?>>استیجاری</option>
          </select>
        </span></div></td>
        <td width="158"><div align="right">:نوع مالکیت</div></td>
      </tr>
      <tr>
        <td height="56" class="input_text"><div align="right"> <span class="style2">مترمربع</span>
          <input name="s_ayan" type="text" class="required number input_text" id="s_ayan" style="width:75px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $s_ayan ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right">:مساحت اعیان</div></td>
        <td>&nbsp;</td>
        <td><div align="right"> <span class="style2">مترمربع</span>
          <input name="s_arce" type="text" class="required number input_text" id="s_arce" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $s_arce ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right">:مساحت عرصه</div></td>
      </tr>
      <tr>
        <td height="46" colspan="5" bgcolor="#CCCCCC"><div  style="margin-right:10px" align="right" class="style8">مشخصات فضای فیزیکی فعلی مرکز جهاد کشاورزی </div></td>
      </tr>
      <tr>
        <td height="40"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_2" type="text" class="required number input_text" id="faz_2" style="width:75px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $faz_2 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right">:اتاق کارشناسان</div></td>
        <td>&nbsp;</td>
        <td><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_1" type="text" class="required number input_text" id="faz_1" style="width:75px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $faz_1 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >:اتاق رئیس مرکز</div></td>
      </tr>
      <tr>
        <td height="41"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_4" type="text" class="required number input_text" id="faz_4" style="width:75px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $faz_4 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right">:فضای آموزشی </div></td>
        <td>&nbsp;</td>
        <td><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_3" type="text" class="required number input_text" id="faz_3" style="width:75px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $faz_3 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div  align="right" >: اتاق نهادهای مردمی</div></td>
      </tr>
      <tr>
        <td height="39"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_6" type="text" class="required number input_text" id="faz_6" style="width:75px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $faz_6 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right">:نمازخانه</div></td>
        <td>&nbsp;</td>
        <td><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_5" type="text" class="required number input_text" id="faz_5" style="width:75px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $faz_5 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right">:سالن اجتماعات</div></td>
      </tr>
      <tr>
        <td height="47"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_8" type="text" class="required number input_text" id="faz_8" style="width:75px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $faz_8?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >: محوطه</div></td>
        <td>&nbsp;</td>
        <td height="47"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_7" type="text" class="required number input_text" id="faz_7" style="width:75px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $faz_7 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >: راهرو و مشاعات داخلی </div></td>
      </tr>
      <tr>
        <td height="47"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_10" type="text" class="required number input_text" id="f_dor_ab3" style="width:75px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $faz_10?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >: اتاق نگهبانی</div></td>
        <td>&nbsp;</td>
        <td height="47"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_9" type="text" class="required number input_text" id="f_naz_ab3" style="width:75px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $faz_9 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >: سرایداری </div></td>
      </tr>
      <tr>
        <td height="51"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_12" type="text" class="required number input_text" id="f_dor_ab4" style="width:75px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $faz_12?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >: سرویس بهداشتی</div></td>
        <td>&nbsp;</td>
        <td height="51"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_11" type="text" class="required number input_text" id="f_naz_ab4" style="width:75px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $faz_11 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >:خوابگاه</div></td>
      </tr>
      <tr>
        <td height="47"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_14" type="text" class="required number input_text" id="f_dor_ab5" style="width:75px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $faz_14?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >: فضای الگویی</div></td>
        <td>&nbsp;</td>
        <td height="47"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_13" type="text" class="required number input_text" id="f_naz_ab5" style="width:75px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $faz_13 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >:آبدارخانه </div></td>
      </tr>
      <tr>
        <td height="47"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_16" type="text" class="required number input_text" id="f_dor_ab6" style="width:75px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $faz_16?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >: خانه سازمانی</div></td>
        <td>&nbsp;</td>
        <td height="47"><div align="right"> <span class="style2">مترمربع</span>
          <input name="faz_15" type="text" class="required number input_text" id="f_naz_ab6" style="width:75px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $faz_15 ?>" maxlength="11" readonly="readonly" xml:lang="fa" />
        </div></td>
        <td><div align="right" >:انبار</div></td>
      </tr>
    </table>
  </div>
 <div align="center">
   <p>
     <input type="hidden" name="id_city"  value='<?php echo $id_select_city ?>'>
     <input type="hidden" name="action"  value="1">
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan1 ?>">
     <input name="action" type="submit" style="width:150px ; height:45px" tabindex="23" value="بازگشت" />
   </p>
 </div>
 <p align="center" >&nbsp;</p>
      </form>  </td>
  </tr>
<?php
}
else 
{
echo '<p>&nbsp;</p>' ;
echo  "<p dir='rtl' class='style8'> متاسفانه اطلاعات ساختمان مرکز ثبت نشده است. </p> " ; 
echo '<p>&nbsp;</p>' ;
?>
 <form action="../../list_center.php#1" method="post" id="form1" name="form1">
     <input type="hidden" name="id_city"  value="<?php echo  $id_select_city ?> ">
     <input type="hidden" name="action"  value="1">
     <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan1 ?>">
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
