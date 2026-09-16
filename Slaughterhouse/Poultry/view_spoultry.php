<?php
include('../../lock_expar.php');
include('../../event.php');
if  (isset($_POST['bah_cod_m']))
{
include('../../login/config.php');
$bah_cod_m = $_POST['bah_cod_m'];
$id = $_POST['id'];
$query = "SELECT * from spoultry where bah_cod_m =:bah_cod_m and id=:id"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':id'=>$id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$bah_cod_m = $row['bah_cod_m']; 
$add_city = $row['add_city'] ;
$add_abadi = $row['add_abadi'] ;
$id_ostan = $row['id_ostan'] ;
$id_city = $row['id_city'] ;
$id_mar = $row['id_mar'] ;
$m_zamin = $row['m_zamin'] ;
$no_mal = $row['no_mal'] ;
$m_ab = $row['m_ab'] ;
$lng = $row['lng'] ;
$lat = $row['lat'] ;
$no_bah = $row['no_bah'] ;
$poul_cod = $row['poul_cod'] ;
$no_moj = $row['no_moj'] ;
$sh_moj = $row['sh_moj'] ;
$z_unit = $row['z_unit'] ;
$make_y = $row['make_y'] ;
$no_sokht = $row['no_sokht'] ;
$vaz_unit = $row['vaz_unit'] ;
$d_noact = $row['d_noact'] ;
$no_power = $row['no_power'] ;
$m_power = $row['m_power'] ;
$m_par = $row['m_par'] ;
$m_beh = $row['m_beh'] ;
$tav_cod = $row['tav_cod'] ;
$no_oz = $row['no_oz'] ;
$an1_faz = $row['an1_faz'] ;
$an1_dem = $row['an1_dem'] ;
$an1_cont = $row['an1_cont'] ;
$an2_faz = $row['an2_faz'] ;
$an2_dem = $row['an2_dem'] ;
$an2_cont = $row['an2_cont'] ;
$an3_faz = $row['an3_faz'] ;
$an3_dem = $row['an3_dem'] ;
$an3_cont = $row['an3_cont'] ;
$comment = $row['comment'] ;
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
<title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
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
           <p class="style8"> مشاهده  اطلاعات مرغداری </p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
	<?php sar_data($bah_cod_m) ;?>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1">
      <table width="80%" height="1103" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <p class="one" >&nbsp;</p>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت واحد</strong></div></td>
        </tr>
        <tr>
          <td width="36%" height="37"><div align="right"> <?php echo city_name($id_city) ?></div></td>
          <td width="18%"><div align="right">:شهرستان</div></td>
          <td width="2%">&nbsp;</td>
          <td width="24%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="20%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td  height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
          </tr>
        <tr>
          <td height="51"><div align="right">
            <select name="no_mal" disabled="disabled" class="input_text  required" id="no_mal"  style="height:40px ; width:170px ; direction:rtl" tabindex="2">
              <option value="">انتخاب کنید</option>
              <option value="1" <?php if($no_mal=="1") echo "selected='selected'"?>>سند رسمی تفکیکی</option>
              <option value="2" <?php if($no_mal=="2") echo "selected='selected'"?>>سند رسمی مشاعی</option>
              <option value="3" <?php if($no_mal=="3") echo "selected='selected'"?>>موقوفی</option>
              <option value="4" <?php if($no_mal=="4") echo "selected='selected'"?>>قولنامه ای</option>
              <option value="5" <?php if($no_mal=="5") echo "selected='selected'"?>>متصرف اراضی ملی و دولتی</option>
              <option value="6" <?php if($no_mal=="6") echo "selected='selected'"?>>اجاره ای</option>
            </select>
          </div></td>
          <td><div align="right">:نوع مالکیت</div></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right"><span class="style2">مترمربع</span>
              <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
          </tr>
        <tr>
          <td  height="56">&nbsp;</td>
          <td >&nbsp;</td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF"><div align="right">
            <select name="m_ab" disabled="disabled" class="input_text  required" id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="3">
              <option value="">انتخاب کنید</option>
              <option value="1" <?php if($m_ab=="1") echo "selected='selected'"?>>آب منطقه ای</option>
              <option value="2" <?php if($m_ab=="2") echo "selected='selected'"?>>آب و فاضلاب روستایی</option>
              <option value="3" <?php if($m_ab=="3") echo "selected='selected'"?>>تانکر آب </option>
              <option value="4" <?php if($m_ab=="4") echo "selected='selected'"?>>چاه عمیق </option>
              <option value="5" <?php if($m_ab=="5") echo "selected='selected'"?>>چاه نیمه عمیق </option>
              <option value="6" <?php if($m_ab=="6") echo "selected='selected'"?>>چاه سطحی</option>
              <option value="7" <?php if($m_ab=="7") echo "selected='selected'"?>>قنات </option>
              <option value="8" <?php if($m_ab=="8") echo "selected='selected'"?>>چشمه</option>
              <option value="9" <?php if($m_ab=="9") echo "selected='selected'"?>>رودخانه</option>
              <option value="10"<?php if($m_ab=="10") echo "selected='selected'"?>>آب بند یا سد انحرافی</option>
            </select>
          </div></td>
          <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: منبع آب</div></td>
          </tr>
        <tr>
          <td height="58"><div align="right">
            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right"><strong>:Y عرض جغرافیایی</strong></div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" ><strong>:<strong>X</strong> طول جغرافیایی </strong></div></td>
        </tr>
        <tr>
          <td  height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات مرغداری</strong></div></td>
        </tr>
        <tr>
          <td  height="56"><div align="right"  >
            <input name="poul_cod" type="text" class="input_text" id="poul_cod" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $poul_cod ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td ><div align="right">:کد مرغداری<br />
          </div></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td  bgcolor="#FFFFFF"><div align="right"  >
            <select name="no_bah" disabled="disabled" class="input_text  required" id="no_bah"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
              <option value="">انتخاب کنید</option>
              <option value="1" <?php if($no_bah=="1") echo "selected='selected'"?>>مرغ گوشتی</option>
              <option value="2" <?php if($no_bah=="2") echo "selected='selected'"?>>مرغ تخمگذار</option>
              <option value="3" <?php if($no_bah=="3") echo "selected='selected'"?>>مادر گوشتی</option>
              <option value="4" <?php if($no_bah=="4") echo "selected='selected'"?>>مادر تخمگذار</option>
              <option value="5" <?php if($no_bah=="5") echo "selected='selected'"?>>اجداد گوشتی</option>
              <option value="6" <?php if($no_bah=="6") echo "selected='selected'"?>>اجداد تخمگذار</option>
              <option value="7" <?php if($no_bah=="7") echo "selected='selected'"?>>پولت تخمگذار</option>
              <option value="8" <?php if($no_bah=="8") echo "selected='selected'"?>>جوجه کشی</option>
              <option value="9" <?php if($no_bah=="9") echo "selected='selected'"?>>شترمرغ مولد</option>
              <option value="10" <?php if($no_bah=="10") echo "selected='selected'"?>>شترمرغ پرواری</option>
              <option value="11" <?php if($no_bah=="11") echo "selected='selected'"?>>بوقلمون مولد</option>
              <option value="12" <?php if($no_bah=="12") echo "selected='selected'"?>>بوقلمون گوشتی</option>
              <option value="13" <?php if($no_bah=="13") echo "selected='selected'"?>>بلدرچین</option>
              <option value="14" <?php if($no_bah=="14") echo "selected='selected'"?>>کبک</option>
              <option value="15" <?php if($no_bah=="15") echo "selected='selected'"?>>پرندگان زینتی</option>
              <option value="16" <?php if($no_bah=="16") echo "selected='selected'"?>>سایر ماکیان</option>
            </select>
          </div></td>
          <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نوع بهره برداری</div></td>
        </tr>
        <tr>
          <td height="46" bgcolor="#FFFFFF"><div align="right"  >
            <input name="sh_moj" type="text"  class="input_text  required" id="sh_moj" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $sh_moj ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td bgcolor="#FFFFFF"><div align="right">:شماره مجوز<br />
          </div></td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF"><div align="right">
            <select name="no_moj" disabled="disabled" class="input_text required" id="no_moj"  style="height:40px ; width:120px ; direction:rtl" tabindex="8">
             <option value="">انتخاب کنید</option>
              <option value="1" <?php if($no_moj=="1") echo "selected='selected'"?>>پروانه بهره برداری</option>
              <option value="2" <?php if($no_moj=="2") echo "selected='selected'"?>>کارت شناسایی</option>
              <option value="3" <?php if($no_moj=="3") echo "selected='selected'"?>>فاقد مجوز</option>
            </select>
          </div></td>
          <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نوع مجوز</div></td>
        </tr>
        <tr>
          <td height="51"><div align="right">
 <input name="make_y" type="text" class="required  digits input_text" id="field" style="width:100px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $make_y ; ?>" maxlength="4" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right">:سال ساخت</div></td>
          <td>&nbsp;</td>
          <td><div align="right"><span class="style2">قطعه</span>
<input name="z_unit" type="text" class="input_text  required digits" id="z_unit" style="width:100px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $z_unit ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:ظرفیت </div></td>
        </tr>
        <tr>
          <td height="50">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="no_sokht" disabled="disabled" class="input_text  required" id="no_sokht"  style="height:40px ; width:120px ; direction:rtl" tabindex="12">
              <option value="">انتخاب کنید</option>
              <option value="1" <?php if($no_sokht=="1") echo "selected='selected'"?> >گاز</option>
              <option value="2" <?php if($no_sokht=="2") echo "selected='selected'"?>>گازوئیل</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">:سوخت مصرفی</div></td>
        </tr>
        <tr>
          <td height="60"><div align="right"  >
            <input name="d_noact" type="text" class="input_text" id="d_noact" style="width:200px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $d_noact ; ?>" maxlength="250" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right">:علت غیرفعال بودن<br />
تغییر کاربری به </div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="vaz_unit" disabled="disabled" class="input_text  required" id="vaz_unit"  style="height:40px ; width:120px ; direction:rtl" tabindex="13">
             <option value="">انتخاب کنید</option>
              <option value="1" <?php if($vaz_unit=="1") echo "selected='selected'"?> >فعال</option>
              <option value="2" <?php if($vaz_unit=="2") echo "selected='selected'"?>>غیر فعال</option>
              <option value="3" <?php if($vaz_unit=="3") echo "selected='selected'"?>>تغییر کاربری</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">
            <p>:وضعیت واحد </p>
          </div></td>
        </tr>
        <tr>
          <td height="60">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="no_power" disabled="disabled" class="input_text  required" id="no_power"  style="height:40px ; width:120px ; direction:rtl" tabindex="15">
              <option value="">انتخاب کنید</option>
              <option value="1" <?php if($no_power=="1") echo "selected='selected'"?> >منطقه ای</option>
              <option value="2" <?php if($no_power=="2") echo "selected='selected'"?> >موتور برق</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">
            <p>:برق مصرفی</p>
          </div></td>
          </tr>
        <tr>
          <td height="38">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2"><div style="margin-right:30px" align="right">
            <p class="style8">:تعداد و مشخصات انشعاب برق </p>
          </div></td>
          </tr>
        <tr>
          <td colspan="5"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="18%" height="40" bgcolor="#CCCCCC" class="style2"><div align="right"> آمپر
                <input name="an1_cont" type="text" class="digits input_text" id="field5" style="width:70px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $an1_cont ; ?>" maxlength="4" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td width="10%" bgcolor="#CCCCCC"> : کنتور</td>
              <td width="20%" bgcolor="#CCCCCC"><div align="right"> <span class="style2">کیلووات</span>
                <input name="an1_dem" type="text" class="digits input_text" id="field2" style="width:70px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $an1_dem ; ?>" maxlength="4" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td width="17%" bgcolor="#CCCCCC"> :دیماند قراردادی </td>
              <td width="6%" bgcolor="#CCCCCC"><div align="right"><span class="required">
                <input name="an1_faz" type="radio" disabled="disabled"   class="green" id="m_par5" tabindex="16"   value="2" <?php if($an1_faz=="2") echo "checked='checked'"?> />
              </span></div></td>
              <td width="10%" bgcolor="#CCCCCC">سه فاز</td>
              <td width="4%" bgcolor="#CCCCCC"><div align="right"><span class="required">
                <input name="an1_faz" type="radio" disabled="disabled"   class="green" id="m_par2" tabindex="16"   value="1" <?php if($an1_faz=="1") echo "checked='checked'"?> />
              </span></div></td>
              <td width="10%" bgcolor="#CCCCCC">تک فاز</td>
              <td width="5%" bgcolor="#CCCCCC">1</td>
            </tr>
            <tr>
              <td height="39" class="style2"><div align="right"> آمپر
                <input name="an2_cont" type="text" class="digits input_text" id="field5" style="width:70px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $an2_cont ; ?>" maxlength="4" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td> : کنتور</td>
              <td><div align="right"> <span class="style2">کیلووات</span>
                <input name="an2_dem" type="text" class="digits input_text" id="field2" style="width:70px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $an2_dem ; ?>" maxlength="4" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td> :دیماند قراردادی </td>
              <td><div align="right"><span class="required">
                <input name="an2_faz" type="radio" disabled="disabled"   class="green" id="m_par5" tabindex="19"   value="2" <?php if($an2_faz=="2") echo "checked='checked'"?> />
              </span></div></td>
              <td>سه فاز</td>
              <td><div align="right"><span class="required">
                <input name="an2_faz" type="radio" disabled="disabled"   class="green" id="m_par2" tabindex="19"   value="1" <?php if($an2_faz=="1") echo "checked='checked'"?> />
              </span></div></td>
              <td>تک فاز</td>
              <td>2</td>
            </tr>
            <tr>
              <td bgcolor="#CCCCCC" class="style2"><div align="right"> آمپر
                <input name="an3_cont" type="text" class="digits input_text" id="field5" style="width:70px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $an3_cont ; ?>" maxlength="4" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#CCCCCC"> : کنتور</td>
              <td bgcolor="#CCCCCC"><div align="right"> <span class="style2">کیلووات</span>
                <input name="an3_dem" type="text" class="digits input_text" id="field2" style="width:70px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $an3_dem ; ?>" maxlength="4" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#CCCCCC"> :دیماند قراردادی </td>
              <td bgcolor="#CCCCCC"><div align="right"><span class="required">
                <input name="an3_faz" type="radio" disabled="disabled"   class="green" id="m_par5" tabindex="21"   value="2"  <?php if($an3_faz=="2") echo "checked='checked'"?>/>
              </span></div></td>
              <td bgcolor="#CCCCCC">سه فاز</td>
              <td bgcolor="#CCCCCC"><div align="right"><span class="required">
                <input name="an3_faz" type="radio" disabled="disabled"   class="green" id="m_par2" tabindex="21"   value="1" <?php if($an3_faz=="1") echo "checked='checked'"?> />
              </span></div></td>
              <td bgcolor="#CCCCCC">تک فاز</td>
              <td bgcolor="#CCCCCC">3</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="26"><div align="right">دائمی<span class="required">
            <input name="m_beh" type="radio" disabled="disabled"   class="required green" id="m_bah" tabindex="18"   value="1" <?php if($m_beh=="2") echo "checked='checked'"?>  />
            </span></div></td>
          <td rowspan="3"><div align="right">: مسئول فنی بهداشت<br />
  <span class="style2">دامپزشک</span></div></td>
          <td rowspan="3">&nbsp;</td>
          <td><div align="right">دائمی<span class="required">
            <input name="m_par" type="radio" disabled="disabled"   class="required green" id="m_par" tabindex="17"   value="1" <?php if($m_par=="1") echo "checked='checked'"?> />
            </span></div></td>
          <td rowspan="3"><div style="margin-right:30px" align="right" > : مسئول فنی پرورش<br />
  <span class="style2">کارشناس دامپروری</span></div></td>
        </tr>
        <tr>
          <td height="26"><div align="right">پاره وقت<span class="required">
            <input name="m_beh" type="radio" disabled="disabled"   class="required green" id="m_bah" tabindex="18"   value="2" <?php if($m_beh=="2") echo "checked='checked'"?> />
          </span></div></td>
          <td><div align="right">پاره وقت<span class="required">
            <input name="m_par" type="radio" disabled="disabled"   class="required green" id="m_par" tabindex="17"   value="2"  <?php if($m_par=="2") echo "checked='checked'"?> />
          </span></div></td>
        </tr>
        <tr>
          <td height="22"><div align="right">ندارد<span class="required">
            <input name="m_beh" type="radio" disabled="disabled"   class="required green" id="m_beh" tabindex="18"   value="3" <?php if($m_beh=="3") echo "checked='checked'"?> />
          </span></div></td>
          <td><div align="right">ندارد<span class="required">
            <input name="m_par" type="radio" disabled="disabled"   class="required green" id="m_par" tabindex="17"   value="3" <?php if($m_par=="3") echo "checked='checked'"?> />
          </span></div></td>
        </tr>
        <tr>
          <td height="63"><div align="right">
            <select name="no_oz" disabled="disabled" class="required input_text " id="no_oz"  style="height:40px ; width:150px ; direction:rtl" tabindex="20">
              <option value="1" <?php if ($no_oz=='1') echo 'selected=selected'?>>عدم عضویت در تعاونی</option>
              <option value="2" <?php if ($no_oz=='2') echo 'selected=selected'?>>رسمی</option>
              <option value="3" <?php if ($no_oz=='3') echo 'selected=selected'?>>خدماتی</option>
            </select>
            </div></td>
          <td><div align="right">:نوع عضویت</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="tav_cod" disabled="disabled" class="required input_text" id="tav_cod"  style="height:40px ; width:230px ; direction:rtl" tabindex="19">
              <option value="1">عدم عضویت در تعاونی</option>
              <?php
echo $query = "SELECT DISTINCT tav_name,tav_cod FROM `tavn_poultry` WHERE  `id_ostan` = $id_ostan"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
              <option value="<?php echo $row['tav_cod'] ;?>"
   <?php if ($row['tav_cod']==$tav_cod) echo 'selected=selected'?>> <?php echo $row['tav_name'] ;?></option>
              <?php 
		   }?>
            </select>
            </div></td>
          <td><div style="margin-right:30px" align="right" >: عضویت در تعاونی</div></td>
        </tr>
        <tr>
          <td height="133" colspan="4"><span style="text-align: right">
            </span>
            <div align="right"><span style="text-align: right">
              <textarea name="comment" cols="60" rows="8" readonly="readonly" class="input_text" id="comment" tabindex="21"><?php echo $comment ;?></textarea>
            </span></div></td>
          <td height="133"><div style="margin-right:30px" align="right" >
            <p>:توضیحات <br />
              </p>
            </div></td>
        </tr>
        </table>
   
      <div align="center">
        <p>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
    <a href="manager_spoultry.php"> <input type="button" name="action2" value="بازگشت" style="width:150px ; height:45px" tabindex="22" /></a>
</p>
</div>
<p align="center" >&nbsp;</p>
</form> 
  </td>
  </tr>
<?
}
else
{
?>
<form  name="myform" class="myform" method="post" action="spoultry.php">
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
