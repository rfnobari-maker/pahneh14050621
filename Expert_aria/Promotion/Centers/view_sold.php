<?php include('../../../lock_oce.php');
$cod_m = $_POST['cod_m'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../jspc-gray.css">
	<script type="text/javascript" src="../js-persian-cal.min.js"></script>
    <script type="text/javascript" src="../script.js"></script>
    <style type="text/css">
<!--
.style1 {
	color: #003366;
	font-family: Tahoma;
	font-size: 18px;
}
-->
    </style>
	<script src="../../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
        });
    </script>

    <style type="text/css">
<!--
.tabel { margin-right:45px }
.text_r { margin-right:0px }
-->
</style>
</head>
<body>
                    <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../../files/images/header.jpg" width="949" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td><?php
include('../../../date_con.php');
include('../../../event.php');
require_once('../../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
include('../../../login/config.php');
$query = "SELECT * FROM users WHERE  cod_m='$cod_m'";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $username = $row['username']; 
 $ostan = $row['ostan']; 
 $city = $row['city']; 
 $markaz = $row['markaz']; 
 $date_es = $row['date_es']; 
 $date_kh = $row['date_kh']; 
 $cod_m = $row['cod_m']; 
 $name_m = $row['name']; 
 $last_name = $row['Last_name']; 
 $sh_sh = $row['sh_sh']; 
 $date_t = $row['date_t']; 
 $m_sodor = $row['m_sodor']; 
 $fname = $row['fname']; 
 $m_tah = $row['m_tah']; 
 $r_tah = $row['r_tah']; 
 $univer = $row['univer']; 
 $m_date = $row['m_date']; 
 $avre = $row['avre']; 
 $v_tahol = $row['v_tahol']; 
 $tel_s = $row['tel_s']; 
 $tel_m = $row['tel_m']; 
 $addres = $row['addres']; 
 $pic_p = $row['pic']; 
 $id = $row['id']; 
 $id_ostan = $row['id_ostan'];
 $id_city = $row['id_city'];
 $id_mar= $row['id_mar'];

include('top.php');

// حذف تصویر
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 ?>
      </p>
      <p align="center" ><span class="style1">مشاهده اطلاعات همکار پشتیبانی ، مرکز</span></p>
      <p align="center" ><img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
      <form action="list_sold.php" method="post" id="form1" name="form1">
        <div align="center">
          <p>
    <input type="hidden" name="cod_p" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $cod_p ;?>" />
          <table style="border:3px solid #069;" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
              <td width="159" rowspan="2"><div style="margin-right:15px" align="right"><span style="color: #069">
                <?php if($pic_p <>""){
							 		?>
                <img style="border:1px solid #021a40;" src="<?php echo 'http://pahneh.eaj.ir/files/users/'.$pic_p;?>"  width="87" height="107"/>
                <?php }  else { echo '<img style="border:1px solid #021a40;" src=../../../files/users/no_pic.png  width=87 height=107/>' ;}?>
              </span></div></td>
              <td width="160" height="48"><div align="right">
                <input name="city" type="text" id="city" style="height:26px ; width:150px ; background:#0CF ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $city ?>" readonly="readonly" />
              </div></td>
              <td width="148"><div align="right">:شهرستان </div></td>
              <td width="30">&nbsp;</td>
              <td width="237"><div align="right" >
                <input name="ostan" type="text" class="required" id="ostan" style="width:200px; height:30px ; background:#0CF " dir="rtl" lang="fa" value="<?php echo $ostan ; ?>" maxlength="50" xml:lang="fa" readonly="readonly"/>
              </div></td>
              <td width="158"><div style="margin-right:15px" align="right">: استان</div></td>
            </tr>
            <tr>
              <td height="48">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><div align="right">
                <input name="markaz" type="text" id="markaz" style="height:26px ; font-size:12px ; background:#0CF ; font-family:Tahoma ; font-size:14px; vertical-align:middle" dir="rtl"  value="<?php echo $markaz ?>" readonly="readonly" />
              </div></td>
              <td><div style="margin-right:15px" align="right">: مرکز جهاد کشاورزی </div></td>
            </tr>
            <tr>
              <td height="42" colspan="2"><div align="right" dir="rtl">
                <input name="date_kh" type="text" class="pdate required" id="pcal4" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $date_kh ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
              </div></td>
              <td><div align="right">:تاریخ خاتمه خدمت</div></td>
              <td height="42" align="center">&nbsp;</td>
              <td height="42" dir="rtl"><div align="right">
                <input name="date_es" type="text" class="pdate required" id="pcal3" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $date_es ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" > : تاریخ شروع به کار</div></td>
            </tr>
            <tr>
              <td height="38" colspan="2"><div align="right">
                <input name="last_name" type="text" class="required" style="width:200px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $last_name ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
              </div></td>
              <td><div align="right">:نام خانوادگی</div></td>
              <td rowspan="8">&nbsp;</td>
              <td><div align="right">
                <input name="name" type="text" class="required" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $name_m ; ?>" maxlength="50" readonly="readonly" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right">: نام</div></td>
            </tr>
            <tr>
              <td height="38" colspan="2"><div align="right">
                <input name="sh_sh" type="text" class="required digits" id="sh_sh" style="width:150px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $sh_sh ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:شماره شناسنامه</div></td>
              <td><div align="right">
                <input name="cod_m2" type="text" class="required digits" id="cod_m" style="height:26px ; width:150px  ; font-size:12px ; font-family:Tahoma ; font-size:14px; vertical-align:middle" tabindex="1" dir="rtl"  value="<?php echo $cod_m ?>" readonly="readonly" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >: کد ملی</div></td>
            </tr>
            <tr>
              <td height="42" colspan="2"><div align="right">
                <input name="m_sodor" type="text" class="required" id="m_sodor" style="width:150px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $m_sodor ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:محل صدور</div></td>
              <td height="42" dir="rtl"><div align="right">
                <input name="date_t" type="text" class="pdate required" id="pcal1" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $date_t ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" > : تاریخ تولد</div></td>
            </tr>
            <tr>
              <td height="38" colspan="2"><div align="right">
                <select name="m_tah" disabled="disabled" class="required" id="m_tah2" style="height:40px ; width:150px ; direction:rtl" tabindex="12">
                  <option value="">انتخاب کنید</option>
                  <option value="8"<?php if ($m_tah=='8') { echo 'selected="selected"' ; } ?>>بیسواد</option>
                  <option value="7"<?php if ($m_tah=='7') { echo 'selected="selected"' ; } ?>>خواندن و نوشتن</option>
                  <option value="6"<?php if ($m_tah=='6') { echo 'selected="selected"' ; } ?>>سیکل</option>
                  <option value="4" <?php if ($m_tah=='4') { echo 'selected="selected"' ; } ?>>دیپلم</option>
                  <option value="5" <?php if ($m_tah=='5') { echo 'selected="selected"' ; } ?>>فوق دیپلم</option>
                  <option value="1" <?php if ($m_tah=='1') { echo 'selected="selected"' ; } ?>>لیسانس</option>
                  <option value="2" <?php if ($m_tah=='2') { echo 'selected="selected"' ; } ?>>فوق لیسانس</option>
                  <option value="3" <?php if ($m_tah=='3') { echo 'selected="selected"' ; } ?>>دکتری</option>
                  <option value="9" <?php if ($m_tah=='9') { echo 'selected="selected"' ; } ?>>تحصیلات حوزوی</option>
                </select>
              </div></td>
              <td><div align="right">:مدرک تحصیلی</div></td>
              <td><div align="right">
                <input name="fname" type="text" class="required" id="fname" style="width:150px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $fname ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >: نام پدر</div></td>
            </tr>
            <tr>
              <td height="42" colspan="2"><div align="right">
                <input name="univer" type="text" class="required" id="univer" style="width:200px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $univer ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
              </div></td>
              <td><div align="right">:نام دانشگاه</div></td>
              <td><div align="right">
                <input name="r_tah" type="text" class="required" id="r_tah" style="width:200px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $r_tah ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >:رشته تحصیلی</div></td>
            </tr>
            <tr>
              <td height="42" colspan="2"><div align="right">
                <input name="avre" type="text" class="required" id="avre" style="width:75px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $avre ; ?>" maxlength="5" readonly="readonly" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:معدل </div></td>
              <td height="42" dir="rtl"><div align="right">
                <input name="m_date" type="text" class="pdate required" id="pcal2" style="width:150px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $m_date ; ?>" maxlength="10" readonly="readonly" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >:تاریخ اخذ مدرک</div></td>
            </tr>
            <tr>
              <td height="42" colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
              <td height="42"><div align="right">
                <select name="v_tahol" class="required" id="v_tahol" style="height:40px ; width:150px ; direction:rtl" tabindex="17">
                  <option value="">انتخاب کنید</option>
                  <option value="1"<?php if ($v_tahol=='1') { echo 'selected="selected"' ; } ?>>متاهل</option>
                  <option value="2"<?php if ($v_tahol=='2') { echo 'selected="selected"' ; } ?>>مجرد</option>
                </select>
              </div></td>
              <td><div style="margin-right:15px" align="right" >:وضعیت تاهل</div></td>
            </tr>
            <tr>
              <td height="38" colspan="2"><div align="right"><span class="style2"><img src="../../../files/sms.png" width="28" height="32" /></span>
                <input name="tel_m" type="text" required="required" class="required digits" id="tel_m" style="width:150px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $tel_m ; ?>" maxlength="11" xml:lang="fa"/>
              </div></td>
              <td><div align="right">:شماره همراه</div></td>
              <td><div align="right">
                <input name="tel_s" type="text" required="required" class="required digits" id="tel_s" style="width:150px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $tel_s ; ?>" maxlength="11" xml:lang="fa"/>
              </div></td>
              <td><div style="margin-right:15px" align="right" >:شماره تلفن ثابت</div></td>
            </tr>
            <tr>
              <td height="38" colspan="5"><div align="right">
                <input name="addres" type="text" required="required" class="required" id="addres" style="width:700px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $addres ; ?>" maxlength="300" xml:lang="fa" />
              </div></td>
              <td><div style="margin-right:15px" align="right" >:آدرس محل سکونت</div></td>
            </tr>
            <tr>
              <td width="319" colspan="2"></p></td>
            </tr>
            <tr>
              <td colspan="6" align="center">&nbsp;</td>
            </tr>
          </table>
          <p>
   <input type="hidden" name="id_city"  value="<?php echo $id_city ?>">
   <input type="hidden" name="id_mar"  value="<?php echo $id_mar ?>">
   <input type="hidden" name="id_ostan"  value="<?php echo $id_ostan ?>">
    <input name="action2" type="submit" style="width:150px ; height:45px" tabindex="24"  value="بازگشت" />
     </p>
 </p>
 </div>
    </form>
    </td>
  </tr>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
    </tr>
</table>
</table>
</body>
</html>