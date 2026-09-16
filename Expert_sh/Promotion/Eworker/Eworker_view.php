<?php
session_start();
include('../../../lock_expsh.php');
include('../../../event.php');
include ('../../../login/config.php');
 /////////////////////////////////////////////// 
if  (isset($_POST['cod_m']))
{
$h_add_abadi=$_POST['h_add_abadi']  ;
$h_g_tah = $_POST['h_g_tah']  ;
$h_sal_z = $_POST['h_sal_z']  ;
$h_no_oz = $_POST['h_no_oz']  ;

$m_page = $_POST['m_page'];
$bah_cod_m = $_POST['cod_m'];
$query = "SELECT * from Eworker where cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$add_abadi1 = $row["add_abadi"]; 
$add_city1 = $row["add_city"]; 
$id_ostan1 = $row["id_ostan"]; 
$id_city1 = $row["id_city"]; 
$id_mar1 = $row["id_mar"]; 
$num_bah = '1' ;
 $cod_sh_m = $row['cod_sh_m'] ;
 $jens = $row['jens'] ;
 $sal_z = $row['sal_z'] ;
 $v_tah = $row['v_tah'] ;
 $no_fam = $row['no_fam'] ;
 $f_tm = $row['f_tm'] ;
 $r_tah = $row['r_tah'] ;
 $g_tah = $row['g_tah'] ;
 $addres = $row['addres'] ;
 $no_oz = $row['no_oz'] ;
 $oz_ta = $row['oz_ta'] ;
 $name_co = $row['name_co'] ;
 $z_fa1 = $row['z_fa1'] ;
 $z_fa2 = $row['z_fa2'] ;

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<script>
function close_window() {
      close();
 }
</script>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
</head>
<body>
     <table width="949" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
</td>
  </tr>
  <tr>
    <td>
           <p class="style8"> اطلاعات مدد کار ترویجی / تسهیلگر<br />
             <img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data3($bah_cod_m,$num_bah) ;?>
      </br>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="<?php echo $m_page?>" method="post" id="form1" name="form1">
      <table width="90%" height="245" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
         <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت مددکار/ تسهیلگر</strong></div></td>
        </tr>
        <tr>
          <td width="33%" height="40"><div align="right"> <?php echo city_name1($id_city1,$id_ostan1) ?></div></td>
          <td width="17%" class="style8"><div align="right">:شهرستان</div></td>
          <td width="1%">&nbsp;</td>
          <td width="31%"><div align="right"><?php echo ostan_name($id_ostan1) ; ?></div></td>
          <td width="18%" class="style8"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi1) , shahr_name($add_city1); ?></div></td>
          <td class="style8"><div align="right">: آبادی</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar1) ; ?></div></td>
          <td class="style8"><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="5" colspan="5">  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="30" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات تکمیلی </strong></div></td>
                </tr>
              <tr>
                <td width="33%" height="47"><div align="right">
                  <select name="jens" disabled="disabled"  class="input_text mar required" id="jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="2">
                    <option value="1" <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
                    <option value="2" <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
                    </select>
                  </div></td>
                <td width="17%"><div align="right">جنسیت</div></td>
                <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
                <td width="31%"  bgcolor="#FFFFFF"><div align="right"  >
                  <input name="cod_sh_m" type="text"  class="input_text digits" id="cod_sh_m"  style="width:150px; height:30px" tabindex="1"   dir="rtl" lang="fa" value="<?php echo $cod_sh_m ; ?>" maxlength="10" readonly="readonly" minlength="10" xml:lang="fa"/>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد شناسایی مددکار/ تسهیلگر</div></td>
                </tr>
              <tr>
                <td height="40" bgcolor="#FFFFFF"><div align="right">
                  <select name="v_tah" disabled="disabled"  class="input_text mar required" id="v_tah"  style="height:40px ; width:120px ; direction:rtl" tabindex="4">
                    <option value="1" <?php if ($v_tah=='1') echo 'selected=selected'?>>مجرد</option>
                    <option value="2" <?php if ($v_tah=='2') echo 'selected=selected'?>>متاهل</option>
                  </select>
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right">:وضعیت تاهل<br />
                  </div></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="sal_z1" type="text" class="input_text required digits" id="sal_z1" style="width:100px; height:30px" tabindex="3" dir="rtl" lang="fa"  value="<?php echo $sal_z ; ?>" maxlength="4" readonly="readonly" minlength="4" xml:lang="fa"/>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: سال جذب</div></td>
                </tr>
              <tr>
                <td height="43"><div align="right">
                   <span class="style2">کیلومتر</span>
                   <input name="f_tm" type="text" class=" input_text required digits" id="f_tm" style="width:100px; height:30px" tabindex="6" dir="rtl" lang="fa" value="<?php echo $f_tm ; ?>"  maxlength="2" readonly="readonly"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div align="right">: <span class="normalTextSmaller">فاصله محل استقرار تا مرکز جهاد کشاورزی</span></div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <span class="style2">نفر</span>
                  <input name="no_fam" type="text" class="required input_text digits" id="no_fam" style="width:100px; height:30px" tabindex="5" dir="rtl" lang="fa" value="<?php  echo $no_fam ; ?>" maxlength="2" readonly="readonly" xml:lang="fa"/>
                </div></td>
                <td><div style="margin-right:30px" align="right">:تعداد افراد تحت تکفل</div></td>
              </tr>
              <tr>
                <td height="44"><div align="right">
                  <select name="g_tah" disabled="disabled"  class="input_text mar required" id="g_tah"  style="height:40px ; width:200px ; direction:rtl" tabindex="8">
                    <option value="">انتخاب کنید</option>
                    <option value="1"  <?php if ($g_tah=='1') echo 'selected=selected'?>>امور دام </option>
                    <option value="2"  <?php if ($g_tah=='2') echo 'selected=selected'?>>دامپزشکی</option>
                    <option value="3"  <?php if ($g_tah=='3') echo 'selected=selected'?>>زراعت و باغبانی</option>
                    <option value="4"  <?php if ($g_tah=='4') echo 'selected=selected'?>>شیلات و آبزیان</option>
                    <option value="5"  <?php if ($g_tah=='5') echo 'selected=selected'?>>منابع طبیعی و آبخیزداری</option>
                    <option value="6"  <?php if ($g_tah=='6') echo 'selected=selected'?>>آب و خاک</option>
                    <option value="7"  <?php if ($g_tah=='7') echo 'selected=selected'?>>مکانیزاسیون کشاورزی</option>
                    <option value="8"  <?php if ($g_tah=='8') echo 'selected=selected'?>>صنایع تبدیلی و تکمیلی</option>
                    <option value="9"  <?php if ($g_tah=='9') echo 'selected=selected'?>>ترویج و آموزش کشاورزی</option>
                    <option value="10" <?php if ($g_tah=='10') echo 'selected=selected'?>>غیر کشاورزی</option>
                    <option value="11" <?php if ($g_tah=='11') echo 'selected=selected'?>>اعلام نشده</option>
                    <option value="12" <?php if ($g_tah=='12') echo 'selected=selected'?>>فاقد مدرک دانشگاهی</option>
                  </select>
                </div></td>
                <td><div align="right">:گرایش تحصیلی</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <input name="r_tah" type="text" class="required input_text" id="m_fname3" style="width:150px; height:30px" tabindex="7" dir="rtl" lang="fa" value="<?php  echo $r_tah ; ?>" maxlength="75" readonly="readonly" xml:lang="fa"/>
                </div></td>
                <td><div style="margin-right:30px" align="right">:رشته تحصیلی</div></td>
                </tr>
              <tr>
                <td height="51"><div align="right">
                  <select name="z_fa2" disabled="disabled"  class="input_text mar required" id="z_fa2"  style="height:40px ; width:200px ; direction:rtl" tabindex="10">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($z_fa2=='1') echo 'selected=selected'?>>زراعت</option>
                    <option value="2" <?php if ($z_fa2=='2') echo 'selected=selected'?>>باغبانی</option>
                    <option value="3" <?php if ($z_fa2=='3') echo 'selected=selected'?>>پرورش دام سبک و سنگین</option>
                    <option value="4" <?php if ($z_fa2=='4') echo 'selected=selected'?>>پرورش طیور</option>
                    <option value="5" <?php if ($z_fa2=='5') echo 'selected=selected'?>>پرورش زنبورعسل</option>
                    <option value="6" <?php if ($z_fa2=='6') echo 'selected=selected'?>>نوغانداری</option>
                    <option value="7" <?php if ($z_fa2=='7') echo 'selected=selected'?>>شیلات و آبزیان</option>
                    <option value="8" <?php if ($z_fa2=='8') echo 'selected=selected'?>>صید و صیادی</option>
                    <option value="9" <?php if ($z_fa2=='9') echo 'selected=selected'?>>جنگل و مرتع</option>
                    <option value="10" <?php if ($z_fa2=='10') echo 'selected=selected'?>>آبخیزداری</option>
                    <option value="11" <?php if ($z_fa2=='11') echo 'selected=selected'?>>صنایع تبدیلی</option>
                    <option value="12" <?php if ($z_fa2=='12') echo 'selected=selected'?>>صنایع و مشاغل خانگی</option>
                    <option value="13" <?php if ($z_fa2=='13') echo 'selected=selected'?>>خدمات اجتماعی</option>
                  </select>
                </div></td>
                <td><div align="right">:زمینه فعالیت 2</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="z_fa1" disabled="disabled"  class="input_text mar required" id="z_fa1"  style="height:40px ; width:200px ; direction:rtl" tabindex="9">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($z_fa1=='1') echo 'selected=selected'?>>زراعت</option>
                    <option value="2" <?php if ($z_fa1=='2') echo 'selected=selected'?>>باغبانی</option>
                    <option value="3" <?php if ($z_fa1=='3') echo 'selected=selected'?>>پرورش دام سبک و سنگین</option>
                    <option value="4" <?php if ($z_fa1=='4') echo 'selected=selected'?>>پرورش طیور</option>
                    <option value="5" <?php if ($z_fa1=='5') echo 'selected=selected'?>>پرورش زنبورعسل</option>
                    <option value="6" <?php if ($z_fa1=='6') echo 'selected=selected'?>>نوغانداری</option>
                    <option value="7" <?php if ($z_fa1=='7') echo 'selected=selected'?>>شیلات و آبزیان</option>
                    <option value="8" <?php if ($z_fa1=='8') echo 'selected=selected'?>>صید و صیادی</option>
                    <option value="9" <?php if ($z_fa1=='9') echo 'selected=selected'?>>جنگل و مرتع</option>
                    <option value="10" <?php if ($z_fa1=='10') echo 'selected=selected'?>>آبخیزداری</option>
                    <option value="11" <?php if ($z_fa1=='11') echo 'selected=selected'?>>صنایع تبدیلی</option>
                    <option value="12" <?php if ($z_fa1=='12') echo 'selected=selected'?>>صنایع و مشاغل خانگی</option>
                    <option value="13" <?php if ($z_fa1=='13') echo 'selected=selected'?>>خدمات اجتماعی</option>
                  </select>
                </div></td>
                <td><div style="margin-right:30px" align="right">:زمینه فعالیت1</div></td>
              </tr>
              <tr>
                <td height="50" colspan="4"><div align="right"><span style="text-align: right">
                  <textarea name="addres" cols="80" rows="4" readonly="readonly" class="required input_text" id="addres" tabindex="9"><?php echo $addres ;?></textarea>
                  </span></div></td>
                <td><div style="margin-right:30px" align="right">:آدرس محل سکونت</div></td>
              </tr>
              <tr>
                <td height="44"><div align="right">
                  <select name="oz_ta" disabled="disabled" class="required input_text  " id="oz_ta"  style="height:40px ; width:120px ; direction:rtl" tabindex="11">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($oz_ta=='1') echo 'selected=selected'?>>بلی</option>
                    <option value="2" <?php if ($oz_ta=='2') echo 'selected=selected'?>>خیر</option>
                  </select>
                </div></td>
                <td><div align="right">:عضو تعاونی/ تشکل </div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="no_oz" disabled="disabled" class="required input_text" id="no_oz"  style="height:40px ; width:120px ; direction:rtl" tabindex="10">
                    <option value="">انتخاب کنید</option>
                    <option value="1"<?php if ($no_oz=='1') echo 'selected=selected'?>>فعال</option>
                    <option value="2"<?php if ($no_oz=='2') echo 'selected=selected'?>>غیرفعال</option>
                  </select>
                </div></td>
                <td><div style="margin-right:30px" align="right">:نوع عضویت</div></td>
              </tr>
              <tr>
                <td height="60">&nbsp;</td>
                <td colspan="3"><div align="right">
                  <input name="name_co" type="text" class="input_text" id="m_tel_m4" style="width:250px; height:30px"  tabindex="12" dir="rtl" lang="fa" value="<?php echo $name_co ; ?>"  maxlength="255" readonly="readonly"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div style="margin-right:30px" align="right">
                  <p>:نام تشکل / تعاونی</p>
                </div></td>
              </tr>
              </table>
            </td>
        </tr>
              </table>
          <div align="center">
        <p>
     <input type="submit" name="action" value="بستن پنجره"  onclick="close_window()" style="height:35px ; width:100px ; font-family:Tahoma ; font-size:16px"/>
        </p>
      </div>
<p align="center" >&nbsp;</p>
</form> 
  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Eworker.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
</table>
</table>
</body>
</html>
<?php session_regenerate_id(); ?>