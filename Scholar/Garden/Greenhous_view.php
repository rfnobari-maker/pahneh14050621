<?php
include('../../lock_Sc.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if  (isset($_POST['bah_cod_m']))
{
date_default_timezone_set('Asia/Tehran') ;
$date_s = date_con(jdate("Y/m/d"));
$id = $_POST["id"]; 
$add_abadi = $_POST["add_abadi"]; 
$add_city = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$m_poul = $_POST['m_poul'];
$no_mal = $_POST['no_mal'];
$no_mtol = $_POST['no_mtol'];
$id = $_POST['id'];
$sal = $_POST['sal'];
$num_bah = $_POST['num_bah']; 
$m_page = $_POST['m_page']; 
$h_add_abadi = $_POST['h_add_abadi'];
$h_add_city = $_POST['h_add_city'];
$h_no_mtol = $_POST['h_no_mtol'];
$h_no_mal = $_POST['h_no_mal'];
$h_sal = $_POST['h_sal'];

$query = "SELECT * from Greenhous where bah_cod_m = '$bah_cod_m' and sal = '$sal' and id = '$id' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$add_abadi = $row["add_abadi"]; 
$add_city = $row["add_city"]; 
$id_ostan = $row["id_ostan"]; 
$id_city = $row["id_city"]; 
$id_mar = $row["id_mar"]; 
$lng = $row['lng'];
$lat = $row['lat'];
$m_zamin = $row['m_zamin'];
$m_zamin_baz = $row['m_zamin_baz'];
$m_cod_m = $row['m_cod_m'] ;
$no_saz = $row['no_saz'] ;
$no_gol = $row['no_gol'] ;
$pt_no = $row['pt_no'] ;
$pt_date = $row['pt_date'] ;
$pb_no = $row['pb_no'] ;
$pb_date = $row['pb_date'] ;
$m_ab = $row['m_ab'] ;
$unit_name = $row['unit_name'] ;
$sys_kesh = $row['sys_kesh'] ;
$no_sokh = $row['no_sokh'] ;
$sys_hot = $row['sys_hot'] ;
$sys_cool = $row['sys_cool'] ;
$sal = $row['sal'] ;
$no_mtol1_1 = $row['no_mtol1_1'] ; 
$no_mtol1_2 = $row['no_mtol1_2'] ; 
$no_mtol1_3 = $row['no_mtol1_3'] ; 
$no_mtol1_4 = $row['no_mtol1_4'] ; 
$no_mtol1_5 = $row['no_mtol1_5'] ; 
$no_mtol1_6 = $row['no_mtol1_6'] ; 
$no_mtol2_1 = $row['no_mtol2_1'] ; 
$no_mtol2_2 = $row['no_mtol2_2'] ; 
$no_mtol2_3 = $row['no_mtol2_3'] ; 
$no_mtol2_4 = $row['no_mtol2_4'] ; 
$no_mtol4_1 = $row['no_mtol4_1'] ; 
$no_mtol4_2 = $row['no_mtol4_2'] ; 
$no_mtol4_3 = $row['no_mtol4_3'] ; 
$no_mtol4_4 = $row['no_mtol4_4'] ; 
$no_mtol3_1 = $row['no_mtol3_1'] ; 
$no_mtol3_2 = $row['no_mtol3_2'] ; 
$no_mtol3_3 = $row['no_mtol3_3'] ; 
$no_mtol3_4 = $row['no_mtol3_4'] ; 
$m_vaz_sok = $row['m_vaz_sok'] ;
if ($no_mal <> 7)
{
$query = "SELECT * from bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_name = $row['name'] ;
$m_jens = $row['jens'] ;
$m_last_name = $row['last_name'] ;
$m_fname = $row['fname'] ;
$m_tel_m = $row['tel_m'] ;
}
else 
{
$query = "SELECT * from malek where  m_cod_m = :m_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':m_cod_m'=>$m_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_name = $row['m_name'] ;
$m_jens = $row['m_jens'] ;
$m_last_name = $row['m_last_name'] ;
$m_fname = $row['m_fname'] ;
$m_tel_m = $row['m_tel_m'] ;
}
$query = "SELECT * from malek where  m_cod_m = :m_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':m_cod_m'=>$m_cod_m));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$m_addres = $row['m_addres'] ;

if ($no_mtol=='1')  $v_no_mtol='سبزی و صیفی';
if ($no_mtol=='2')  $v_no_mtol='گل و گیاه زینتی در فضای گلخانه';
if ($no_mtol=='4')  $v_no_mtol='گل و گیاه زینتی در فضای باز ';
if ($no_mtol=='5')  $v_no_mtol='گل و گیاه زینتی در فضای توام';
if ($no_mtol=='3')  $v_no_mtol='سایر' ;	 
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
if ($no_mal=='1')  $v_no_mal='سند ششدانگ';
if ($no_mal=='2')  $v_no_mal='سند مشاعی';
if ($no_mal=='3')  $v_no_mal='اصلاحات اراضی';
if ($no_mal=='4')  $v_no_mal='موقوفه';
if ($no_mal=='5')  $v_no_mal='واگذاری';
if ($no_mal=='6')  $v_no_mal='قولنامه';
if ($no_mal=='7')  $v_no_mal='اجاره' ;
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
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
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
<!--دریافت اطلاعات مالک -->
<script type="text/javascript">
$(document).ready(function()
{
$(".Mcod_m").change(function()
{
var id=$(this).val();
var dataString = 'cod_m='+ id;
$.ajax
({
type: "POST",
url: "select_mar.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar").html(html);
} 
});

});
});
</script>
<!-- پایان دریافت اطلاعات مالک -->
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
  </tr>
  <tr>
    <td>
           <p class="style8">مشاهده اطلاعات  گلخانه </p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
              <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="liste_Greenhous.php" method="post" id="form1" name="form1">
      <table width="99%" height="570" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>

          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="36%" height="40"><div align="right"><?php echo city_name1($id_city,$id_ostan) ?></div></td>
          <td width="15%"><div align="right">:شهرستان</div></td>
          <td width="10%">&nbsp;</td>
          <td width="21%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"><span class="normalTextSmall"><?php echo abadi_name($add_abadi) ?><?php echo shahr_name($add_city) ?></span></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"><?php echo $v_no_mal; ?></div></td>
          <td height="38"><div align="right"> : نوع مالکیت</div></td>
          <td height="38">&nbsp;</td>
          <td height="38"><div align="right"> <?php echo $v_no_mtol; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نوع محصول تولیدی</div></td>
        </tr>
  <?php if($nah_kesh<>'3'){?> 
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
        </tr>
        <tr>
          <td height="63"><div align="right">
            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" readonly xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right">:Y عرض جغرافیایی</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" readonly xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
        </tr>
        <tr>
          <td height="49"><?php if ($no_mtol == '4' or $no_mtol =='5') {?>
            <div align="right"><span class="style2">مترمربع</span>
              <input name="m_zamin_baz" type="text" class="input_text required" id="m_zamin_baz" style="width:100px; height:30px ; " tabindex="4" dir="rtl"  lang="fa" value="<?php echo $m_zamin_baz ; ?>" maxlength="70" readonly  align="baseline" xml:lang="fa" />
              <?php }?>
            </div></td>
          <td><?php if ($no_mtol == '4' or $no_mtol =='5') {?>
            <div align="right">:مساحت زمین<span class="style2"> فضای باز</span></div>
            <?php }?></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td><?php if ($no_mtol <> '4' ) {?>
            <div align="right">
            <span class="style2">مترمربع</span>
            <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="70" readonly  align="baseline" xml:lang="fa" />
            <?php }?></td>
          <td><?php if ($no_mtol <> '4') {?>
            <div style="margin-right:30px" align="right">:مساحت مفید<span class="style2"> گلخانه</span></div>
            <?php }?></td>
        </tr>
        <tr>
          <td height="5" colspan="5">  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>7) echo '<p align="center" style="color:#0066CC" > اطلاعات بهره بردار بعنوان مالک ثبت خواهد شد </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
                </tr>
              <tr>
                <td width="31%" height="58"><div align="right">
                  <select name="m_jens" disabled="disabled"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="5">
                    <option value="1" <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
                    <option value="2" <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
                    </select>
                  </div></td>
                <td width="20%"><div align="right">جنسیت</div></td>
                <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
                <td width="30%"  bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="4"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="11" readonly xml:lang="fa"/>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک </div></td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_last_name" type="text"  class="input_text required" id="m_last_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_last_name ; ?>" maxlength="70" readonly  align="baseline" xml:lang="fa" />
                  </div></td>
                <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی<br />
                  </div></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="11" readonly xml:lang="fa"/>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                </tr>
              <tr>
                <td height="51"><div align="right">
                  <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>" maxlength="11" readonly  align="baseline" minlength="11" xml:lang="fa" />
                  </div></td>
                <td><div align="right">:تلفن همراه</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="8" dir="rtl" lang="fa" value="<?php echo $m_fname ; ?>" maxlength="11" readonly xml:lang="fa"/>
                  </div></td>
                <td><div style="margin-right:30px" align="right">:نام پدر</div></td>
                </tr>
              <tr>
                <td height="50" colspan="4"><div align="right"><span style="text-align: right">
                  <textarea name="m_addres" cols="80" rows="4" readonly class="required input_text" id="m_addres" tabindex="10"><?php echo $m_addres ;?></textarea>
                  </span></div></td>
                <td><div style="margin-right:30px" align="right">:آدرس محل سکونت</div></td>
                </tr>
              <tr>
                <td height="60">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="m_vaz_sok" disabled="disabled" class="required input_text  " id="m_vaz_sok"  style="height:40px ; width:120px ; direction:rtl" tabindex="11">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($m_vaz_sok=='1') { echo 'selected="selected"' ; } ?>>ساکن</option>
                    <option value="2" <?php if ($m_vaz_sok=='2') { echo 'selected="selected"' ; } ?> >غیرساکن</option>
                    </select>
                  </div></td>
                <td><div style="margin-right:30px" align="right">
                  <p>:وضعیت سکونت </p>
                  </div></td>
                </tr>
              </table>
            <?php }?>
            </td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF">
<?php if($no_mtol<>'4') {?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
                </tr>
              <tr>
                <td height="53"><div align="right">
                  <select name="no_gol" disabled="disabled" class="input_text required " id="no_gol"  style="height:40px ; width:150px ; direction:rtl" tabindex="13">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($no_gol=='1') { echo 'selected="selected"' ; } ?>>تونلی تک قلو</option>
                    <option value="2" <?php if ($no_gol=='2') { echo 'selected="selected"' ; } ?>>تونلی بهم پیوسته</option>
                    <option value="3" <?php if ($no_gol=='3') { echo 'selected="selected"' ; } ?>>یک طرفه</option>
                    <option value="4" <?php if ($no_gol=='4') { echo 'selected="selected"' ; } ?>>شیشه ای سقف شیروانی</option>
                  </select>
                </div></td>
                <td><div align="right">:نوع گلخانه</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <select name="no_saz" disabled="disabled" class="input_text required " id="no_saz"  style="height:40px ; width:150px ; direction:rtl" tabindex="12">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($no_saz=='1') { echo 'selected="selected"' ; } ?>>فلزی با پوشش پلاستیکی</option>
                    <option value="2" <?php if ($no_saz=='2') { echo 'selected="selected"' ; } ?>>فلزی با پوشش پلی کربنات</option>
                    <option value="3" <?php if ($no_saz=='3') { echo 'selected="selected"' ; } ?>>فلزی با پوشش شیشه ای</option>
                    <option value="4" <?php if ($no_saz=='4') { echo 'selected="selected"' ; } ?>>چوبی پلاستیکی</option>
                  </select>
                </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نوع سازه</div></td>
              </tr>
              <tr>
                <td height="53"><div align="right">
                  <input name="pb_no" type="text" class="required  input_text" id="pb_no" style="width:75px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $pb_no ; ?>" maxlength="20" readonly xml:lang="fa"/>
                   تاریخ 
                   <input name="pb_date" type="text" class="required  input_text" id="md_ab5" style="width:75px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $pb_date ; ?>" maxlength="10" readonly xml:lang="fa"/>
                   شماره <br />
                </div></td>
                <td><div align="right">:پروانه بهره برداری</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right"> 
<input name="pt_no" type="text" class="required  input_text" id="pt_no" style="width:75px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $pt_no ; ?>" maxlength="20" readonly xml:lang="fa"/>
 تاریخ
<input name="pt_date" type="text" class="required input_text" id="pt_date" style="width:75px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $pt_date ; ?>" maxlength="10" readonly xml:lang="fa"/>
                     شماره 
                  <br />
                </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: پروانه تاسیس</div></td>
              </tr>
              <tr>
                <td width="37%" height="53"><div align="right">
                  <span class="style2">در صورت واقع شدن در مجتمع گلخانه ای</span>
                  <input name="unit_name" type="text" class="required input_text" id="unit_name" style="width:150px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                  </div></td>
                <td width="17%"><div align="right">:نام مجتمع گلخانه ای </div></td>
                <td width="2%">&nbsp;</td>
                <td width="26%" bgcolor="#FFFFFF"><div align="right">
                  <select name="m_ab" disabled="disabled" class="input_text required " id="m_ab"  style="height:40px ; width:150px ; direction:rtl" tabindex="18">
                    <option value="">انتخاب کنید</option>
                    <option value="1"<?php if ($m_ab=='1') { echo 'selected="selected"' ; } ?>>چاه</option>
                    <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"' ; } ?>>حجمی از کانال</option>
                    <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"' ; } ?>>رودخانه،چشمه و قنات</option>
                    <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"' ; } ?>>آب شهری / روستایی</option>
                  </select>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: منبع تامین آب</div></td>
                </tr>
              <tr>
                <td height="47"><div align="right">
                <select name="no_sokh" disabled="disabled" class="input_text required " id="no_sokh"  style="height:40px ; width:120px ; direction:rtl" tabindex="21">
                    <option value="">انتخاب کنید</option>
                    <option value="1"<?php if ($no_sokh=='1') { echo 'selected="selected"' ; } ?>>نفت سفید</option>
                    <option value="2"<?php if ($no_sokh=='2') { echo 'selected="selected"' ; } ?>>گازوئیل</option>
                    <option value="3"<?php if ($no_sokh=='3') { echo 'selected="selected"' ; } ?>>گاز </option>
                 </select>
                </div></td>
                <td><div align="right">:نوع سوخت </div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="sys_kesh" disabled="disabled" class="input_text  required" id="sys_kesh"  style="height:40px ; width:120px ; direction:rtl" tabindex="20">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($sys_kesh=='1') { echo 'selected="selected"' ; } ?>>خاکی</option>
                    <option value="2" <?php if ($sys_kesh=='2') { echo 'selected="selected"' ; } ?>>هیدروپونیک</option>
                  </select>
                </div></td>
                <td><div style="margin-right:30px" align="right">:سیستم کشت</div></td>
              </tr>
              <tr>
                <td height="47"><div align="right">
                  <select name="sys_cool" disabled="disabled" class="input_text  required" id="sys_kol"  style="height:40px ; width:120px ; direction:rtl" tabindex="23">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($sys_cool=='1') { echo 'selected="selected"' ; } ?>>پدوفن</option>
                    <option value="2" <?php if ($sys_cool=='2') { echo 'selected="selected"' ; } ?>>مه پاش</option>
                    <option value="3" <?php if ($sys_cool=='3') { echo 'selected="selected"' ; } ?>>دریچه های تهویه</option>
                    </select>
                  </div></td>
                <td><div align="right">:نوع سیستم خنک کننده</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="sys_hot" disabled="disabled" class="input_text  required" id="sys_hot"  style="height:40px ; width:120px ; direction:rtl" tabindex="22">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($sys_hot=='1') { echo 'selected="selected"' ; } ?>>حرارت مرکزی</option>
                    <option value="2" <?php if ($sys_hot=='2') { echo 'selected="selected"' ; } ?>>هیتر یا بخاری</option>
                    <option value="3" <?php if ($sys_hot=='3') { echo 'selected="selected"' ; } ?>>تشعشعی</option>
                    </select>
                  </div></td>
                <td><div style="margin-right:30px" align="right">: نوع سیستم گرمایشی</div></td>
              </tr>
              </table>
     <?php }?>
            </td>
        </tr>
          <tr>
          <td height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات کاشت</strong></div></td>
          </tr>
        <tr>
          <td height="40">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="sal" disabled="disabled" class="input_text  required" id="sal"  style="height:40px ; width:120px ; direction:rtl" tabindex="24">
   <option value="">انتخاب کنید</option>
   <option value="1394" <?php if ($sal=='1394') { echo 'selected="selected"' ; } ?>>1394</option>
   <option value="1395" <?php if ($sal=='1395') { echo 'selected="selected"' ; } ?>>1395</option>
   <option value="1396" <?php if ($sal=='1396') { echo 'selected="selected"' ; } ?>>1396</option>
   <option value="1397" <?php if ($sal=='1397') { echo 'selected="selected"' ; } ?>>1397</option>
   <option value="1398" <?php if ($sal=='1398') { echo 'selected="selected"' ; } ?>>1398</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">: سال </div></td>
        </tr>
        <tr>
          <td height="131" colspan="5"><?php if($no_mtol=='1') { ?>
            <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
              <tr>
                <td height="43" colspan="6" bgcolor="#FFFFCC">سبزی و صیفی واحد </td>
                </tr>
              <tr>
                <td width="25%" height="43" bgcolor="#FFFFCC">سایر محصولات جالیزی<br />
                  <span class="style2">تن</span></td>
                <td width="20%" bgcolor="#FFFFCC">سبزیجات برگی<br />
                  <span class="style2">تن</span></td>
                <td width="14%" bgcolor="#FFFFCC">بادمجان<br />
                  <span class="style2">تن</span></td>
                <td width="14%" bgcolor="#FFFFCC">فلفل
                  <br />
                  <span class="style2">تن</span></td>
                <td width="16%" bgcolor="#FFFFCC">گوجه فرنگی<br />
                  <span class="style2">تن</span></td>
                <td width="11%" bgcolor="#FFFFCC">خیار<br />
                  <span class="style2">تن</span></td>
              </tr>
              <tr>
                <td height="51"><div align="center">
                  <input name="no_mtol1_6" type="text" class="required number input_text" id="md_ab11" style="width:70px; height:30px ; " tabindex="30" dir="rtl" lang="fa" value="<?php echo $no_mtol1_6 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol1_5" type="text" class="required number input_text" id="md_ab10" style="width:70px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $no_mtol1_5 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol1_4" type="text" class="required number input_text" id="md_ab9" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $no_mtol1_5 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol1_3" type="text" class="required number input_text" id="md_ab8" style="width:70px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $no_mtol1_3 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol1_2" type="text" class="required number input_text" id="md_ab7" style="width:70px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $no_mtol1_2 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol1_1" type="text" class="required number input_text" id="md_ab6" style="width:70px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $no_mtol1_1 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
              </tr>
            </table>
          <?php } if($no_mtol=='2' or $no_mtol=='5') { ?>
            <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
              <tr>
                <td height="37" colspan="4" bgcolor="#FFFFCC">گل و گیاهان زینتی در فضای گلخانه</td>
                </tr>
              <tr>
                <td height="37" bgcolor="#FFFFCC">گل های فصلی <br />
                  <span class="style2">بوته</span></td>
                <td bgcolor="#FFFFCC">درخت و درختچه های زیستی<br />
                  <span class="style2">اصله</span></td>
                <td bgcolor="#FFFFCC">گیاهان آپارتمانی<br />
                  <span class="style2">گلدان</span></td>
                <td bgcolor="#FFFFCC">گل شاخه بریده<br />
                  <span class="style2">شاخه</span></td>
              </tr>
              <tr>
                <td height="41"><div align="center">
                  <input name="no_mtol2_4" type="text" class="required number input_text" id="md_ab15" style="width:70px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $no_mtol2_4 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol2_3" type="text" class="required number input_text" id="md_ab14" style="width:70px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $no_mtol2_3 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol2_2" type="text" class="required number input_text" id="md_ab13" style="width:70px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $no_mtol2_2 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol2_1" type="text" class="required number input_text" id="md_ab12" style="width:70px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $no_mtol2_1 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
              </tr>
          </table><p>
            <?php } if($no_mtol=='4' or $no_mtol =='5') {?>
          </p>
          <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
            <tr>
              <td height="37" colspan="4" bgcolor="#FFFFCC">گل و گیاهان زینتی در فضای باز</td>
            </tr>
            <tr>
              <td height="37" bgcolor="#FFFFCC">گل های فصلی <br />
                <span class="style2">بوته</span></td>
              <td bgcolor="#FFFFCC">درخت و درختچه های زیستی<br />
                <span class="style2">اصله</span></td>
              <td bgcolor="#FFFFCC">گیاهان آپارتمانی<br />
                <span class="style2">گلدان</span></td>
              <td bgcolor="#FFFFCC">گل شاخه بریده<br />
                <span class="style2">شاخه</span></td>
            </tr>
            <tr>
              <td height="41"><div align="center">
                <input name="no_mtol4_4" type="text" class="required number input_text" id="md_ab" style="width:70px; height:30px ; " tabindex="39" dir="rtl" lang="fa" value="<?php echo $no_mtol4_4 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div align="center">
                <input name="no_mtol4_3" type="text" class="required number input_text" id="md_ab2" style="width:70px; height:30px ; " tabindex="38" dir="rtl" lang="fa" value="<?php echo $no_mtol4_3 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div align="center">
                <input name="no_mtol4_2" type="text" class="required number input_text" id="md_ab3" style="width:70px; height:30px ; " tabindex="37" dir="rtl" lang="fa" value="<?php echo $no_mtol4_2 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div align="center">
                <input name="no_mtol4_1" type="text" class="required number input_text" id="md_ab4" style="width:70px; height:30px ; " tabindex="36" dir="rtl" lang="fa" value="<?php echo $no_mtol4_1 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
            </tr>
          </table>
          <p>
            <?php } if($no_mtol=='3') {?>
          </p>
          <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
            <tr>
                <td height="35" colspan="4" bgcolor="#FFFFCC">سایر</td>
                </tr>
              <tr>
                <td height="35" bgcolor="#FFFFCC">سایر میوه ها <br />
                  <span class="style2">تن</span></td>
                <td bgcolor="#FFFFCC">نهال و قلمه<br />
                  <span class="style2">اصله</span></td>
                <td bgcolor="#FFFFCC">گیاهان دارویی<br />
                  <span class="style2">تن</span></td>
                <td bgcolor="#FFFFCC">توت فرنگی<br />
                  <span class="style2">تن</span></td>
              </tr>
              <tr>
                <td height="42"><div align="center">
                  <input name="no_mtol3_4" type="text" class="required number input_text" id="md_ab19" style="width:70px; height:30px ; " tabindex="38" dir="rtl" lang="fa" value="<?php echo $no_mtol3_4 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol3_3" type="text" class="required number input_text" id="md_ab18" style="width:70px; height:30px ; " tabindex="37" dir="rtl" lang="fa" value="<?php echo $no_mtol3_3 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol3_2" type="text" class="required number input_text" id="md_ab17" style="width:70px; height:30px ; " tabindex="36" dir="rtl" lang="fa" value="<?php echo $no_mtol3_2 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="no_mtol3_1" type="text" class="required number input_text" id="md_ab16" style="width:70px; height:30px ; " tabindex="35" dir="rtl" lang="fa" value="<?php echo $no_mtol3_1 ; ?>" maxlength="35" readonly xml:lang="fa"/>
                  <br />
                </div></td>
              </tr>
    </table>
<?php } ?>
</td>
          </tr>
        </table>
                 <p> <br />
              <button  id="send" style="width:150px ; height:45px ; font-family:tahoma ; font-size:16px " onclick="close_window()">بستن پنجره</button></p>
<p align="center" >&nbsp;</p>
</form> 
  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Greenhouse.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
</table>
</body>
</html>
