<?php
include("../../../lock_p2.php");
include('../../../event.php') ;
require_once('../../../Jalali.php');
 ?>
  <?PHP
 if (isset($_POST['action'])) 
 {  
  include('../../../login/config.php');
  date_default_timezone_set('Asia/Tehran') ;
  $date_s = jdate("Y/m/d");
  $id_ostan = $_POST['id_ostan']; 
  $id_city= $_POST['id_city']; 
  $id_mar = $_POST['id_mar']; 
  $cod_m = $_POST['cod_m']; 
  $sal_h= $_POST['sal_h']; 
  $mah_h = $_POST['mah_h']; 
  $no_h = $_POST['no_h']; 
  $commen_h = $_POST['commen_h']; 
  $sql=$dbh->prepare("INSERT INTO Eworker_h (cod_m,date_s,id_ostan,id_city,id_mar,sal_h,mah_h,no_h,commen_h) VALUES (?,?,?,?,?,?,?,?,?);");
$sql->execute(array($cod_m,$date_s,$id_ostan,$id_city,$id_mar,$sal_h,$mah_h,$no_h,$commen_h));
sabt_event($login_session,getUserIP_1(),$date_s,$time,'','ثبت اطلاعات حمایت از مددکار -'.$cod_m,$id_ostan) ; 
//alert('اطلاعات تجهیزات مرکز با موفقیت ثبت شد ');
?>
<?php
 }
  ?>
<?php
if (isset($_POST['cod_m']))  $cod_m=$_POST['cod_m'];
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
 include ('../../../login/config.php');
 ?>
 <p align="center" ><span class="style8">حمایت از مددکاران ترویجی / تسهیلگران</span><br />
  <img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
 <form id="form2" name="form2" method="post" action="#result">
   <p>
     <input type="submit" name="action_lise" id="action_lise" value="جستجو " style="width:100px ; height:40px ; color:#900 ; font-size:14px" />
     <input type="text" name="cod_m" id="cod_m" value="<?php echo $cod_m ?>" style="width:200px ; height:40px ; color:#900 ; font-size:14px ; text-align:center"  />
     :کد ملی مددکار ترویجی</p>
 </form>
  <p><span class="style21"><a name="result" id="result"></a></span>
    <?php
 if (isset($_POST['action_lise'])) 
 {  
include('../../../login/config.php');
$query = "SELECT end_bee from users where username = $login_session ";
$stmt = $dbh->prepare($query);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$end_bee =  $row['end_bee'] ; 
$cod_m=$_POST['cod_m'];
$query = "SELECT * from Eworker where cod_m = :cod_m and id_mar = :id_mar"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':cod_m'=>$cod_m,':id_mar'=>$id_mar));
$found = $stmt -> rowCount();
if ($found>0) {
?>
  </p>
  <div style="width: 90%;border: 2px solid #930 ;padding: 2px;margin: auto;border-radius:15px; bgcolor="#CCCCCC"" >
  <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
        <tr class="text1">
          <td width="9%" rowspan="2" bgcolor="#CCCCCC">نوع عضویت</td>
          <td width="14%" rowspan="2" bgcolor="#CCCCCC">گرایش تحصیلی</td>
          <td width="14%" rowspan="2" bgcolor="#CCCCCC">رشته تحصیلی</td>
          <td width="7%" rowspan="2" bgcolor="#CCCCCC">سال جذب</td>
          <td height="35" colspan="2" bgcolor="#CCCCCC">مشخصات مددکار / تسهیلگر</td>
          <td colspan="2" bgcolor="#CCCCCC">موقعیت مددکار</td>
          </tr>
        <tr class="text1">
          <td width="11%" height="31" bgcolor="#CCCCCC">کد ملی </td>
          <td width="15%" bgcolor="#CCCCCC">نام و نام خانوادگی</td>
          <td width="13%" bgcolor="#CCCCCC">آبادی</td>
          <td width="11%" bgcolor="#CCCCCC">شهرستان</td>
        </tr>
        <tr>
          <?php 
$r = 1 ;
foreach($stmt as $row){ 
if ($row['g_tah']=='1') $v_g_tah='امور دام ' ;	 
if ($row['g_tah']=='2') $v_g_tah='دامپزشکی' ;	 
if ($row['g_tah']=='3') $v_g_tah='زراعت و باغبانی' ;	 
if ($row['g_tah']=='4') $v_g_tah='شیلات و آبزیان' ;	 
if ($row['g_tah']=='5') $v_g_tah='منابع طبیعی و آبخیزداری' ;	 
if ($row['g_tah']=='6') $v_g_tah='آب و خاک' ;	 
if ($row['g_tah']=='7') $v_g_tah='مکانیزاسیون کشاورزی' ;	 
if ($row['g_tah']=='8') $v_g_tah='صنایع تبدیلی و تکمیلی' ;	 
if ($row['g_tah']=='9') $v_g_tah='ترویج و آموزش کشاورزی' ;	 
if ($row['g_tah']=='10') $v_g_tah='غیر کشاورزی' ;	 
if ($row['g_tah']=='11') $v_g_tah='اعلام نشده' ;	 
if ($row['g_tah']=='12') $v_g_tah='فاقد مدرک دانشگاهی' ;	 
if ($row['no_oz']=='1') $v_no_oz='فعال' ;	 
if ($row['no_oz']=='2') $v_no_oz='غیرفعال' ;	 
  ?>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_no_oz; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $v_g_tah; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['r_tah']; ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal_z']; ?></td>
          <td height="37" class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['cod_m'] ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo bah_name2($row['cod_m'],'1')?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo abadi_name($row['add_abadi']) ?></td>
          <td class="normalTextSmall" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo city_name1($row['id_city'],$row['id_ostan']); ?></td>
          </tr>
        <?php 
	$r++ ; 
	}
	?>
      </table>
  <br />
  <span class="style8">ثبت حمایت جدید</span><br />
  <img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/> <br />
  <form action="#result" method="post" id="form1" name="form1">
    <table width="90" border="0" align="center" cellpadding="2" cellspacing="2">
      <tr class="RedTitleSmaller">
        <td width="77" height="30" bgcolor="#FFFFFF">&nbsp;</td>
        <td width="306" bgcolor="#CCCCCC" class="normalTextSmall">توضیحات</td>
        <td width="165" bgcolor="#CCCCCC" class="normalTextSmall"> نوع حمایت</td>
        <td width="109" bgcolor="#CCCCCC" class="normalTextSmall">ماه</td>
        <td width="111" bgcolor="#CCCCCC" class="normalTextSmall">سال</td>
      </tr>
      <tr>
        <td height="82"><div align="center">
          <input type="hidden" name="id_ostan" value="<?php echo $id_ostan ?>" />
          <input type="hidden" name="id_city"  value="<?php echo $id_city ?>" />
          <input type="hidden" name="id_mar"  value="<?php echo $id_mar ?>" />
          <input type="hidden" name="cod_m"   value="<?php echo $cod_m ?>" />
          <input type="hidden" name="action_lise" value="1" />
          <input name="action" type="submit" id="action" style="width:75px ; height:40px" tabindex="5" value="ذخیره" />
        </div></td>
        <td><div align="center">
          <input name="commen_h" type="text" class="input_text" id="commen_h"   style="width:300px; height:35px ; " tabindex="4" dir="rtl" lang="fa" xml:lang="fa" />
        </div></td>
        <td><div align="center" class="input_text">
          <select name="no_h" class="required input_text" id="no_h" style="height:40px ; width:160px ; direction:rtl" tabindex="1">
            <option value="" >انتخاب کنید</option>
            <option value="1">معرفی وام / تسهیلات</option>
            <option value="2">سفرهای انگیزشی</option>
            <option value="3">اهداء هدایا</option>
            <option value="4">تجهیزات فنی</option>
            <option value="5">لباس کار</option>
            <option value="6">بیمه </option>
          </select>
        </div></td>
        <td><div align="center" class="input_text">
          <select name="mah_h" class="required input_text" id="mah_h" style="height:40px ; width:100px ; direction:rtl" tabindex="1">
            <option value="" >انتخاب کنید</option>
            <option value="1">فروردین</option>
            <option value="2">اردیبهشت</option>
            <option value="3">خرداد</option>
            <option value="4">تیر</option>
            <option value="5">مرداد</option>
            <option value="6">شهریور</option>
            <option value="7">مهر</option>
            <option value="8">آبان</option>
            <option value="9">آذر</option>
            <option value="10">دی</option>
            <option value="11">بهمن</option>
            <option value="12">اسفند</option>
          </select>
        </div></td>
        <td><div align="center" class="input_text">
          <select name="sal_h" class="required input_text" id="sal_h" style="height:40px ; width:100px ; direction:rtl" tabindex="1">
            <option value="" >انتخاب کنید</option>
            <option value="1404">1404</option>
            <option value="1403">1403</option>
            <option value="1402">1402</option>
            <option value="1401">1401</option>
            <option value="1400">1400</option>
            <option value="1399">1399</option>
            <option value="1398">1398</option>
            <option value="1397">1397</option>
            <option value="1396">1396</option>
            <option value="1395">1395</option>
            <option value="1394">1394</option>
            <option value="1393">1393</option>
            <option value="1392">1392</option>
            <option value="1391">1391</option>
            <option value="1390">1390</option>
          </select>
        </div></td>
      </tr>
    </table>
    <input type="hidden" name="no_action"  value="<?php echo $no_action ?>" />
</form>
  <p align="center" ><span class="style8"> لیست حمایت های انجام شده مددکار / تسهیلگر</span><br />
    <img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></br>
<?php
$query = "SELECT * from Eworker_h where cod_m = :cod_m ORDER BY sal_h,mah_h"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':cod_m'=>$cod_m));
?>
  <table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
    <tr class="text1">
      <td width="8%" height="47" bgcolor="#999999">عملیات</td>
      <td width="49%" bgcolor="#999999">توضیحات</td>
      <td width="22%" bgcolor="#999999">نوع حمایت</td>
      <td width="13%" bgcolor="#999999">ماه</td>
      <td width="8%" bgcolor="#999999">سال</td>
      <td width="6%" bgcolor="#999999">ردیف</td>
    </tr>
    <?php 
$r = 1 ;
 foreach($stmt as $row){	 
if ($row['no_h']=='1') $v_no_h ='معرفی وام / تسهیلات' ;
if ($row['no_h']=='2') $v_no_h ='سفرهای انگیزشی';
if ($row['no_h']=='3') $v_no_h ='اهداء هدایا';
if ($row['no_h']=='4') $v_no_h ='تجهیزات فنی';
if ($row['no_h']=='5') $v_no_h ='لباس کار';
if ($row['no_h']=='6') $v_no_h ='بیمه';

if ($row['mah_h']=='1') $v_mah_h ='فروردین';
if ($row['mah_h']=='2') $v_mah_h ='اردیبهشت';
if ($row['mah_h']=='3') $v_mah_h ='خرداد';
if ($row['mah_h']=='4') $v_mah_h ='تیر';
if ($row['mah_h']=='5') $v_mah_h ='مرداد';
if ($row['mah_h']=='6') $v_mah_h ='شهریور';
if ($row['mah_h']=='7') $v_mah_h ='مهر';
if ($row['mah_h']=='8') $v_mah_h ='آبان';
if ($row['mah_h']=='9') $v_mah_h ='آذر';
if ($row['mah_h']=='10') $v_mah_h ='دی';
if ($row['mah_h']=='11') $v_mah_h ='بهمن';
if ($row['mah_h']=='12') $v_mah_h ='اسفند';

?>
    <tr>
      <td width="8%" height="55" <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><form  action="suEworker_del.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id'] ;?>" />
        <input type="hidden" name="cod_m" value="<?php echo $row['cod_m'] ;?>" />
        <button onclick="return confirm('از حذف  این رکورد مطمئن هستید ؟ ')"><img src="../../../files/del.png" border="0"  title=" حذف حمایت " width="33" height="26" /></button>
      </form></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['commen_h']?></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo  $v_no_h ; ?></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $v_mah_h?></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $row['sal_h']?></td>
      <td <?php if($r%2 == 0)  echo 'bgcolor=#FFFFCC' ?>><?php echo $r?></td>
    </tr>
    <?php
$r++ ; 
 }
   ?>
  </table>
  <br />
  </div>
    <?php
 }
 else 
 {
echo '<p class=style8> مددکار ترویجی با مشخصات وارد شده یافت نشد</p>'  ;
 }
 }
?>
  </p>
  <p><a href="index.php" title="برگشت به صفحه قبل"><img src="../../../files/goback.jpg" width="118" height="47"  alt=""/> </a></p> 
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


<?php if(isset($_POST['com_alert'])) alert($_POST['com_alert'])?>
