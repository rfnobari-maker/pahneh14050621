<?php
include('../../lock_ce.php');
include('../../event.php');
//include('sar_data.php');
date_default_timezone_set('Asia/Tehran') ;
//require_once('../../ersal_p.php');
if  (isset($_POST['bah_cod_m']))
{
include('../../login/config.php');
$bah_cod_m = $_POST['bah_cod_m'];
$id = $_POST['id'];
$query = "SELECT * from bee where bah_cod_m =:bah_cod_m and id=:id"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':id'=>$id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $row['User_Name'] ; 
 $bah_cod_m = $row['bah_cod_m']; 
 $add_city = $row['add_city'] ;
 $add_abadi = $row['add_abadi'] ;
 $id_ostan = $row['id_ostan'] ;
 $id_city_zan = $row['id_city'] ;
 $id_mar = $row['id_mar'] ;
 $no_zan = $row['no_zan'] ;
$sh_zan = $row['sh_zan'] ;
$mt_mom = $row['mt_mom'] ;
$m_ostan = $row['m_ostan'] ;
$m_city = $row['m_city'] ;
$no_mo = $row['no_mo'] ;
$t_sha = $row['t_sha'] ;
$e_ostan = $row['e_ostan'] ;
$g_ostan = $row['g_ostan'] ;
$tk_mo = $row['tk_mo'] ;
$tk_bo = $row['tk_bo'] ;
$to_mo = $row['to_mo'] ;
$to_bo = $row['to_bo'] ;
// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
if ($no_zan=='1') {$m_ostan = '-' ; $m_city='-'; $no_mo='-';}
if ($no_zan=='2') {$e_ostan= '-' ; $g_ostan='-' ; }
 ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<link href="../radio.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه پهنه بندی آبادی های آذربایجان شرقی</title>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
</head>
<body>
     <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>

  </tr>
  <tr>
    <td>
      <?php include('top.php'); ?>
           <p class="style8">ثبت اطلاعات زنبورستان  جدید</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
	<?php sar_data($bah_cod_m) ;?>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><form action="" method="post" id="form1" name="form1">
      <table width="80%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <p class="one" >&nbsp;</p>
          <td height="28" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>اطلاعات زنبورستان</strong></div></td>
        </tr>
        <tr>
          <td width="40%" height="30" bgcolor="#CCCCCC"><div align="right"> <?php echo city_name($id_city_zan) ?></div></td>
          <td width="14%" bgcolor="#CCCCCC"><div align="right">:شهرستان</div></td>
          <td width="2%" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="24%" bgcolor="#CCCCCC"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="20%" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="30" bgcolor="#CCCCCC"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
          <td bgcolor="#CCCCCC"><div align="right">: آبادی / شهر</div></td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC"><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td  height="79"><div align="right"  > <span class="style2">نفر</span>
            <input name="t_sha" type="text" class="input_text  required digits" id="t_sha" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $t_sha ; ?>" maxlength="20"  align="baseline" xml:lang="fa" />
          </div></td>
          <td ><div align="right">:تعداد افراد شاغل<br />
            <span class="style2">به غیر از خود بهره بردار</span></div></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td  bgcolor="#FFFFFF"><div align="right"  >
            <input name="sh_zan" type="text" class="input_text" id="sh_zan" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $sh_zan ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
          </div></td>
          <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: شماره شناسنامه<br />
            زنبور داری</div></td>
        </tr>
        <tr>
          <td height="40" bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF"><div align="right">
            <select name="mt_mom" class="input_text  required"  style="height:40px ; width:120px ; direction:rtl" tabindex="3">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($mt_mom=="1") echo "selected='selected'"?>>خود زنبورستان</option>
              <option value="2"<?php if($mt_mom=="2") echo "selected='selected'"?>>سایر زنبورستان ها</option>
              <option value="3"<?php if($mt_mom=="3") echo "selected='selected'"?>>ترکیبی</option>
            </select>
          </div></td>
          <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: محل تامین ملکه</div></td>
        </tr>
<?php if ($no_zan=='2'){  ?>
        <tr>
          <td height="24" dir="rtl">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right" class="style8" style="margin-right:30px"> وضعیت کوچ</div></td>
        </tr>
        <tr>
          <td height="41"><div align="right">
            <input name="m_city" type="text" class="pdate input_text  required" id="pcal" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $m_city ; ?>" maxlength="10" xml:lang="fa" />
          </div></td>
          <td><div align="right">: شهرستان مبداء</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="m_ostan" disabled="disabled" class="input_text required" id="m_ostan" style="height:40px ; width:150px ; direction:rtl" tabindex="4">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($m_ostan=="1") echo "selected='selected'"?>>آذربایجان شرقی</option>
              <option value="2"<?php if($m_ostan=="2") echo "selected='selected'"?>>آذربایجان غربی</option>
              <option value="31"<?php if($m_ostan=="31") echo "selected='selected'"?>>اردبیل</option>
              <option value="3"<?php if($m_ostan=="3") echo "selected='selected'"?>>اصفهان</option>
              <option value="4"<?php if($m_ostan=="4") echo "selected='selected'"?>>البرز</option>
              <option value="5"<?php if($m_ostan=="5") echo "selected='selected'"?>>ایلام</option>
              <option value="6"<?php if($m_ostan=="6") echo "selected='selected'"?>>بوشهر</option>
              <option value="7"<?php if($m_ostan=="7") echo "selected='selected'"?>>تهران</option>
              <option value="8"<?php if($m_ostan=="8") echo "selected='selected'"?>>چهار محال و بختیاری</option>
              <option value="9"<?php if($m_ostan=="9") echo "selected='selected'"?>>خراسان جنوبی</option>
              <option value="10"<?php if($m_ostan=="10") echo "selected='selected'"?>>خراسان رضوی</option>
              <option value="11"<?php if($m_ostan=="11") echo "selected='selected'"?>>خراسان شمالی</option>
              <option value="12"<?php if($m_ostan=="12") echo "selected='selected'"?>>خوزستان</option>
              <option value="13"<?php if($m_ostan=="13") echo "selected='selected'"?>>زنجان</option>
              <option value="14"<?php if($m_ostan=="14") echo "selected='selected'"?>>سمنان</option>
              <option value="15"<?php if($m_ostan=="15") echo "selected='selected'"?>>سیستان و بلوچستان </option>
              <option value="16"<?php if($m_ostan=="16") echo "selected='selected'"?>>فارس</option>
              <option value="17"<?php if($m_ostan=="17") echo "selected='selected'"?>>قزوین</option>
              <option value="18"<?php if($m_ostan=="18") echo "selected='selected'"?>>قم</option>
              <option value="19"<?php if($m_ostan=="19") echo "selected='selected'"?>>کردستان</option>
              <option value="20"<?php if($m_ostan=="20") echo "selected='selected'"?>>کرمان</option>
              <option value="21"<?php if($m_ostan=="21") echo "selected='selected'"?>>کرمانشاه</option>
              <option value="22"<?php if($m_ostan=="22") echo "selected='selected'"?>>کهگیلویه و بویر احمد</option>
              <option value="23"<?php if($m_ostan=="23") echo "selected='selected'"?>>گلستان</option>
              <option value="24"<?php if($m_ostan=="24") echo "selected='selected'"?>>گیلان</option>
              <option value="25"<?php if($m_ostan=="25") echo "selected='selected'"?>>لرستان</option>
              <option value="26"<?php if($m_ostan=="26") echo "selected='selected'"?>>مازندران</option>
              <option value="27"<?php if($m_ostan=="27") echo "selected='selected'"?>>مرکزی</option>
              <option value="28"<?php if($m_ostan=="28") echo "selected='selected'"?>>هرمزگان</option>
              <option value="29"<?php if($m_ostan=="29") echo "selected='selected'"?>>همدان</option>
              <option value="30"<?php if($m_ostan=="30") echo "selected='selected'"?>>یزد</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">: استان مبداء</div></td>
        </tr>
        <tr>
          <td height="36">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="no_mo" type="text" class="input_text  required" style="width:150px; height:30px ; " tabindex="6" dir="rtl"  value="<?php echo $no_mo ; ?>" maxlength="35" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">: شماره مجوز</div></td>
        </tr>
        <?php }  if ($no_zan=='1'){  ?>
        <tr>
          <td height="24" dir="rtl">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right" class="style8" style="margin-right:30px"> استان های محل کوچ</div></td>
        </tr>
        <tr>
          <td height="64"><div align="right">
            <select name="g_ostan" disabled="disabled" class="input_text required" id="g_ostan" style="height:40px ; width:150px ; direction:rtl" tabindex="8">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($g_ostan=="1") echo "selected='selected'"?>>آذربایجان شرقی</option>
              <option value="2"<?php if($g_ostan=="2") echo "selected='selected'"?>>آذربایجان غربی</option>
              <option value="31"<?php if($g_ostan=="31") echo "selected='selected'"?>>اردبیل</option>
              <option value="3"<?php if($g_ostan=="3") echo "selected='selected'"?>>اصفهان</option>
              <option value="4"<?php if($g_ostan=="4") echo "selected='selected'"?>>البرز</option>
              <option value="5"<?php if($g_ostan=="5") echo "selected='selected'"?>>ایلام</option>
              <option value="6"<?php if($g_ostan=="6") echo "selected='selected'"?>>بوشهر</option>
              <option value="7"<?php if($g_ostan=="7") echo "selected='selected'"?>>تهران</option>
              <option value="8"<?php if($g_ostan=="8") echo "selected='selected'"?>>چهار محال و بختیاری</option>
              <option value="9"<?php if($g_ostan=="9") echo "selected='selected'"?>>خراسان جنوبی</option>
              <option value="10"<?php if($g_ostan=="10") echo "selected='selected'"?>>خراسان رضوی</option>
              <option value="11"<?php if($g_ostan=="11") echo "selected='selected'"?>>خراسان شمالی</option>
              <option value="12"<?php if($g_ostan=="12") echo "selected='selected'"?>>خوزستان</option>
              <option value="13"<?php if($g_ostan=="13") echo "selected='selected'"?>>زنجان</option>
              <option value="14"<?php if($g_ostan=="14") echo "selected='selected'"?>>سمنان</option>
              <option value="15"<?php if($g_ostan=="15") echo "selected='selected'"?>>سیستان و بلوچستان </option>
              <option value="16"<?php if($g_ostan=="16") echo "selected='selected'"?>>فارس</option>
              <option value="17"<?php if($g_ostan=="17") echo "selected='selected'"?>>قزوین</option>
              <option value="18"<?php if($g_ostan=="18") echo "selected='selected'"?>>قم</option>
              <option value="19"<?php if($g_ostan=="19") echo "selected='selected'"?>>کردستان</option>
              <option value="20"<?php if($g_ostan=="20") echo "selected='selected'"?>>کرمان</option>
              <option value="21"<?php if($g_ostan=="21") echo "selected='selected'"?>>کرمانشاه</option>
              <option value="22"<?php if($g_ostan=="22") echo "selected='selected'"?>>کهگیلویه و بویر احمد</option>
              <option value="23"<?php if($g_ostan=="23") echo "selected='selected'"?>>گلستان</option>
              <option value="24"<?php if($g_ostan=="24") echo "selected='selected'"?>>گیلان</option>
              <option value="25"<?php if($g_ostan=="25") echo "selected='selected'"?>>لرستان</option>
              <option value="26"<?php if($g_ostan=="26") echo "selected='selected'"?>>مازندران</option>
              <option value="27"<?php if($g_ostan=="27") echo "selected='selected'"?>>مرکزی</option>
              <option value="28"<?php if($g_ostan=="28") echo "selected='selected'"?>>هرمزگان</option>
              <option value="29"<?php if($g_ostan=="29") echo "selected='selected'"?>>همدان</option>
              <option value="30"<?php if($g_ostan=="30") echo "selected='selected'"?>>یزد</option>
            </select>
          </div></td>
          <td><div align="right">: قشلاق</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="e_ostan" disabled="disabled" class="input_text required" id="e_ostan" style="height:40px ; width:150px ; direction:rtl" tabindex="7">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($e_ostan=="1") echo "selected='selected'"?>>آذربایجان شرقی</option>
              <option value="2"<?php if($e_ostan=="2") echo "selected='selected'"?>>آذربایجان غربی</option>
              <option value="31"<?php if($e_ostan=="31") echo "selected='selected'"?>>اردبیل</option>
              <option value="3"<?php if($e_ostan=="3") echo "selected='selected'"?>>اصفهان</option>
              <option value="4"<?php if($e_ostan=="4") echo "selected='selected'"?>>البرز</option>
              <option value="5"<?php if($e_ostan=="5") echo "selected='selected'"?>>ایلام</option>
              <option value="6"<?php if($e_ostan=="6") echo "selected='selected'"?>>بوشهر</option>
              <option value="7"<?php if($e_ostan=="7") echo "selected='selected'"?>>تهران</option>
              <option value="8"<?php if($e_ostan=="8") echo "selected='selected'"?>>چهار محال و بختیاری</option>
              <option value="9"<?php if($e_ostan=="9") echo "selected='selected'"?>>خراسان جنوبی</option>
              <option value="10"<?php if($e_ostan=="10") echo "selected='selected'"?>>خراسان رضوی</option>
              <option value="11"<?php if($e_ostan=="11") echo "selected='selected'"?>>خراسان شمالی</option>
              <option value="12"<?php if($e_ostan=="12") echo "selected='selected'"?>>خوزستان</option>
              <option value="13"<?php if($e_ostan=="13") echo "selected='selected'"?>>زنجان</option>
              <option value="14"<?php if($e_ostan=="14") echo "selected='selected'"?>>سمنان</option>
              <option value="15"<?php if($e_ostan=="15") echo "selected='selected'"?>>سیستان و بلوچستان </option>
              <option value="16"<?php if($e_ostan=="16") echo "selected='selected'"?>>فارس</option>
              <option value="17"<?php if($e_ostan=="17") echo "selected='selected'"?>>قزوین</option>
              <option value="18"<?php if($e_ostan=="18") echo "selected='selected'"?>>قم</option>
              <option value="19"<?php if($e_ostan=="19") echo "selected='selected'"?>>کردستان</option>
              <option value="20"<?php if($e_ostan=="20") echo "selected='selected'"?>>کرمان</option>
              <option value="21"<?php if($e_ostan=="21") echo "selected='selected'"?>>کرمانشاه</option>
              <option value="22"<?php if($e_ostan=="22") echo "selected='selected'"?>>کهگیلویه و بویر احمد</option>
              <option value="23"<?php if($e_ostan=="23") echo "selected='selected'"?>>گلستان</option>
              <option value="24"<?php if($e_ostan=="24") echo "selected='selected'"?>>گیلان</option>
              <option value="25"<?php if($e_ostan=="25") echo "selected='selected'"?>>لرستان</option>
              <option value="26"<?php if($e_ostan=="26") echo "selected='selected'"?>>مازندران</option>
              <option value="27"<?php if($e_ostan=="27") echo "selected='selected'"?>>مرکزی</option>
              <option value="28"<?php if($e_ostan=="28") echo "selected='selected'"?>>هرمزگان</option>
              <option value="29"<?php if($e_ostan=="29") echo "selected='selected'"?>>همدان</option>
              <option value="30"<?php if($e_ostan=="30") echo "selected='selected'"?>>یزد</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">: ییلاق</div></td>
        </tr>
         <?php } ?>
        <tr>
          <td height="42"><div align="right">
            <input name="tk_bo" type="text" class="input_text  required digits" id="tel_m2" style="width:100px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $tk_bo ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div align="right">:تعداد کندوی بومی</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="tk_mo" type="text" class="input_text  required digits" id="tel_m3" style="width:100px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $tk_mo ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >: تعداد کندوی مدرن</div></td>
        </tr>
        <tr>
          <td height="36">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right" class="style8" style="margin-right:30px"> میزان تولید عسل</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="to_bo" type="text" class="input_text  required number" id="tel_m" style="width:100px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $to_bo ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div align="right">: بومی</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="to_mo" type="text" class="input_text  required number" id="tel_m4" style="width:100px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $to_mo ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >:مدرن</div></td>
        </tr>
        <tr>
          <td height="18" colspan="5" align="center">&nbsp;</td>
        </tr>
      </table>
      
<p align="center" >&nbsp;</p>
</form>
<form  name="myform" class="myform" method="post" action="manager_bee.php">
     <input type="hidden" name="action" value='true'/>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="submit" name="action" value="بازگشت" style="width:150px ; height:45px" tabindex="28" />
</form> 
  </td>
  </tr>
<?
}
else
{
?>
<form  name="myform" class="myform" method="post" action="../index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  <tr>
  <td height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><p class="MenuItemRight">Copyright © 2014, سازمان نظام مهندسی کشاورزی و منابع طبیعی استان آذربایجان شرقی All Rights Reserved.</p>
  <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
   </tr>
</table>
</table>
</td>
</tr>
</td>
</table></body>
</body>
</html>
