<?php
include('../../lock_ce.php');
include('../../event.php');
date_default_timezone_set('Asia/Tehran') ;
//require_once('../../ersal_p.php');
if  (isset($_POST['bah_cod_m']))
{
include('../../login/config.php');
$bah_cod_m = $_POST['bah_cod_m'];
echo $id = $_POST['id'];
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
$oz_tav = $row['oz_tav'] ;
$no_zan = $row['no_zan'] ;
$cod_sh = $row['cod_sh'] ;
$bem_zan = $row['bem_zan'] ;
$bem_kand = $row['bem_kand'] ;
$sh_zan = $row['sh_zan'] ;
$m_ostan = $row['m_ostan'] ;
$m_city = $row['m_city'] ;
$no_mo = $row['no_mo'] ;
$t_sha = $row['t_sha'] ;
$tm_kh = $row['tm_kh'] ;
$tm_kkh = $row['tm_kkh'] ;
$tm_kdo = $row['tm_kdo'] ;
$tk_mo = $row['tk_mo'] ;
$tk_bo = $row['tk_bo'] ;
$to_mo = $row['to_mo'] ;
$to_bo = $row['to_bo'] ;
$t_jel = $row['t_jel'] ;
$t_mom = $row['t_mom'] ;
$t_bar = $row['t_bar'] ;
$t_gar = $row['t_gar'] ;
$t_zah = $row['t_zah'] ;
$num_bah = $row['num_bah'] ;
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
<title><?php echo $title ;?></title>
<script>
function close_window() {
      close();
 }
</script>
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>
           <p class="style8"> اطلاعات زنبورستان  </p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
	<?php sar_data2($bah_cod_m,$num_bah) ;?>
    <br />
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><form action="" method="post" id="form1" name="form1">
      <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="28" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>اطلاعات زنبورستان</strong></div></td>
        </tr>
        <tr>
          <td width="31%" height="30" bgcolor="#CCCCCC"><div align="right"><?php echo city_name1($id_city_zan,$id_ostan) ?></div></td>
          <td width="19%" bgcolor="#CCCCCC"><div align="right">:شهرستان</div></td>
          <td width="5%" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="24%" bgcolor="#CCCCCC"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="21%" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="30" bgcolor="#CCCCCC"><div align="right"> <?php echo shahr_name($add_city); ?><?php echo abadi_name($add_abadi); ?></div></td>
          <td bgcolor="#CCCCCC"><div align="right">: آبادی / شهر</div></td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC"><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td  height="58"><div align="right"  > <span class="style2">نفر</span>
            <input name="t_sha" type="text" class="input_text  required digits" id="t_sha" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $t_sha ; ?>" maxlength="20" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td ><div align="right">:تعداد افراد شاغل<br />
            <span class="style2">به غیر از خود بهره بردار</span></div></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td  bgcolor="#FFFFFF"><div align="right"  >
            <input name="cod_sh" type="text" class="input_text" id="cod_sh" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $cod_sh ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد شناسه زنبورستان</div></td>
          </tr>
        <tr>
          <td height="48" bgcolor="#FFFFFF"><div align="right">
            <select name="bem_kand" disabled="disabled" class="input_text  required" id="bem_kand"  style="height:40px ; width:120px ; direction:rtl" tabindex="4">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($bem_kand=="1") echo "selected='selected'"?>>دارد</option>
              <option value="2"<?php if($bem_kand=="2") echo "selected='selected'"?>>ندارد</option>
              </select>
            </div></td>
          <td bgcolor="#FFFFFF"><div align="right">:وضعیت بیمه کندوها<br />
            </div></td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF"><div align="right">
            <select name="bem_zan" disabled="disabled" class="input_text  required" id="bem_zan"  style="height:40px ; width:120px ; direction:rtl" tabindex="3">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($bem_zan=="1") echo "selected='selected'"?>>بیمه زنبورداری</option>
              <option value="2"<?php if($bem_zan=="2") echo "selected='selected'"?>>سایر بیمه ها</option>
              <option value="3"<?php if($bem_zan=="3") echo "selected='selected'"?>>ندارد</option>
              </select>
            </div></td>
          <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نوع بیمه زنبوردار</div></td>
        </tr>
        <tr>
          <td height="48" bgcolor="#FFFFFF"><div align="right"  >
            <input name="sh_zan" type="text" class="input_text" id="sh_zan" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $sh_zan ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
            </div></td>
          <td bgcolor="#FFFFFF"><div align="right">:شماره پروانه زنبورداری<br />
            </div></td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right">
            <select name="oz_tav" disabled="disabled" class="input_text  required" id="oz_tav"  style="height:40px ; width:120px ; direction:rtl" tabindex="7">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($oz_tav=="1") echo "selected='selected'"?>>بلی</option>
              <option value="2"<?php if($oz_tav=="2") echo "selected='selected'"?>>خیر</option>
              </select>
            </div></td>
          <td><div style="margin-right:30px" align="right" >: عضویت در تعاونی</div></td>
        </tr>
        <?php if ($no_zan=='2'){  ?>
        <tr>
          <td height="35" colspan="5" bgcolor="#FFFFCC" dir="rtl"><div align="right" class="style8" style="margin-right:30px"> وضعیت کوچ</div></td>
          </tr>
        <tr>
          <td height="51"><div align="right" class="input_text">
            <?php echo city_name1($m_city,$m_ostan)?>
          </div></td>
          <td><div align="right">: شهرستان مبداء</div></td>
          <td>&nbsp;</td>
          <td><div align="right" class="input_text">
            <?php echo ostan_name($m_ostan)?>
          </div></td>
          <td><div style="margin-right:30px" align="right">: استان مبداء</div></td>
        </tr>
        <tr>
          <td height="36">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="no_mo" type="text" class="input_text  required" style="width:150px; height:30px ; " tabindex="6" dir="rtl"  value="<?php echo $no_mo ; ?>" maxlength="35" readonly="readonly" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">: شماره مجوز</div></td>
        </tr>
        <?php } ?>
        <tr>
          <td height="30" colspan="5" bgcolor="#FFFFCC" dir="rtl"><div align="right" class="style8" style="margin-right:30px"> تعداد ملکه</div></td>
          </tr>
        <tr>
          <td height="45"><div align="right">
            <input name="tm_kdo" type="text" class="t_kb input_text  required digits" id="tm_kdo" style="width:50px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $tm_kdo ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div align="right">:خرید از بخش دولتی</div></td>
          <td height="45" bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right">
            <input name="tm_kh" type="text" class="t_km input_text  required digits" id="tm_kh" style="width:50px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $tm_kh ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:20px" align="right" >: از محل خود مصرفی</div></td>
        </tr>
        <tr>
          <td height="41">&nbsp;</td>
          <td>&nbsp;</td>
          <td height="41" bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right">
            <input name="tm_kkh" type="text" class="t_km input_text  required digits" id="tm_kkh" style="width:50px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $tm_kkh ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:20px" align="right" >:خرید از بخش خصوصی</div></td>
        </tr>
         <tr>
           <td height="33" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> کندو</div></td>
         </tr>
         <tr>
          <td height="42"><div align="right">
            <input name="tk_bo" type="text" class="input_text  required digits" id="tel_m2" style="width:100px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $tk_bo ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
          </div></td>
          <td><div align="right">:تعداد کندوی سنتی</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="tk_mo" type="text" class="input_text  required digits" id="tel_m3" style="width:100px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $tk_mo ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >: تعداد کندوی مدرن</div></td>
        </tr>
        <tr>
          <td height="27" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> میزان تولید عسل</div></td>
          </tr>
        <tr>
          <td height="43"><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="to_bo" type="text" class="input_text  required number" id="tel_m" style="width:100px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $to_bo*1 ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
          </div></td>
          <td><div align="right">: سنتی</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="to_mo" type="text" class="input_text  required number" id="tel_m4" style="width:100px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $to_mo*1 ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >:مدرن</div></td>
        </tr>
        <tr class="yekan">
          <td height="32" colspan="5" align="center" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> میزان تولیدات جانبی</div></td>
          </tr>
        <tr>
          <td height="46"><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="t_bar" type="text" class="input_text  required number" id="t_bar" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $t_bar*1 ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
          </div></td>
          <td><div align="right">: برموم</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="t_gar" type="text" class="input_text  required number" id="t_gar" style="width:100px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $t_gar*1 ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >:گرده</div></td>
        </tr>
        <tr>
          <td height="47"><div align="right"><span class="style10">گرم</span>
            <input name="t_jel" type="text" class="input_text  required number" id="t_jel" style="width:100px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $t_jel*1 ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
            </div></td>
          <td><div align="right">: ژله رویال</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="t_mom" type="text" class="input_text  required number" id="t_mom" style="width:100px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $t_mom*1 ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
            </div></td>
          <td><div style="margin-right:30px" align="right" >:موم</div></td>
        </tr>
        <tr>
          <td height="32" align="center">&nbsp;</td>
          <td height="32" align="center">&nbsp;</td>
          <td height="32" align="center">&nbsp;</td>
          <td height="40" align="center"><div align="right"> <span class="style10">گرم</span>
            <input name="t_zah" type="text" class="tomom input_text  required number" id="t_zah" style="width:100px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $t_zah ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td height="40" align="center"><div style="margin-right:30px" align="right" >:زهر</div></td>
          </tr>
        </table>
      
<p align="center" >&nbsp;</p>
       <p> <button  id="send" style="width:150px ; height:45px" onclick="close_window()">بازگشت</button></p></p>  
<?php
}
?>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
</table>
</td>
</tr>
</td>
</table>
</body>
</html>
