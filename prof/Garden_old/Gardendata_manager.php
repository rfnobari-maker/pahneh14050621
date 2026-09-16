<?php
include('../../lock_p1.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
 /////////////////////////////////////////////// 
if  (isset($_POST['id']))
{
date_default_timezone_set('Asia/Tehran') ;
$date_s = date_con(jdate("Y/m/d"));
$id = $_POST["id"]; 
include_once('../../login/config.php');
$query = "SELECT * from Garden where id = :id "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$id));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$add_abadi = $row["add_abadi"]; 
$add_city = $row["add_city"]; 
$bah_cod_m = $row['bah_cod_m'];
$num_bah = $row['num_bah'];
if ($num_bah=='') $num_bah='1' ;
$m_poul = $row['m_poul'];
$sh_gat = $row['sh_gat'];
$z_sal = $row['z_sal'];
$t_mah = $row['t_mah'];
$no_mal = $row['no_mal'];
$no_kesh = $row['no_kesh'];
$nah_kesh = $row['nah_kesh'];
$id_ostan1 = $row["id_ostan"];
$id_mar = $row["id_mar"];
$id_city = $row["id_city"];
$id = $row['id'];
$lng = $row['lng'];
$lat = $row['lat'];
$m_zamin = $row['m_zamin'];
$m_cod_m = $row['m_cod_m'] ;
$m_ab = $row['m_ab'] ;
$md_ab = $row['md_ab'] ;
$h_ab = $row['h_ab'] ;
$no_sab = $row['no_sab'] ;
$no_ab = $row['no_ab'] ;
$es = $row['es'] ;
$m_vaz_sok = $row['m_vaz_sok'] ;
if ($no_mal <> 7)
{
include_once('../../login/config.php');
$query = "SELECT * from bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_bah = $row['no_bah'] ;
$co_name = $row['co_name'] ;
if ($no_bah=='2') 
{
$m_fname = '-' ;
$v_co_name= '/ شرکت '.$row['co_name'].' /'; 
}
else 
{
$m_fname = $row['fname'] ;
}
$m_jens = $row['jens'] ;
$m_name = $row['name'] ;
$m_last_name = $row['last_name'] ;
$m_fname = $row['fname'] ;
$m_tel_m = $row['tel_m'] ;
}
else 
{
include_once('../../login/config.php');
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

if ($no_kesh=='1')  $v_no_kesh='آبی';
if ($no_kesh=='2')  $v_no_kesh='دیم';
if ($nah_kesh=='1') $v_nah_kesh='ساده' ;	 
if ($nah_kesh=='2') $v_nah_kesh='مخلوط' ;	 
if ($nah_kesh=='3') $v_nah_kesh='درختان پراکنده' ;	 
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
if ($no_mal=='1')  $v_no_mal='سند ششدانگ';
if ($no_mal=='2')  $v_no_mal='سند مشاعی';
if ($no_mal=='3')  $v_no_mal='اصلاحات اراضی';
if ($no_mal=='4')  $v_no_mal='موقوفه';
if ($no_mal=='5')  $v_no_mal='واگذاری';
if ($no_mal=='6')  $v_no_mal='قولنامه';
if ($no_mal=='7')  $v_no_mal='اجاره' ;
$num_t_mah = $t_mah ; 
if ($m_poul=='abadi') {
include_once('../../login/config.php');
$query = "SELECT * from list_abadi where add_abadi = :add_abadi"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_abadi'=>$add_abadi));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$add_abadi = $row["add_abadi"]; 
$add_city = '-'; 
$id_ostan = $row["id_ostan"]; 
$id_city = $row["id_city"]; 
$id_mar = $row["id_mar"]; 
}
if  ($m_poul=='shahr') {
include_once('../../login/config.php');
$query = "SELECT * from list_city where add_city = :add_city"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':add_city'=>$add_city));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$add_city = $row["add_city"]; 
$add_abadi = '-'; 
$id_ostan = $row["id_ostan"]; 
$id_city = $row["id_city"]; 
$id_mar = $row["id_mar"]; 
}
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
function close_window() {
      close();
 }
</script>
<?php
while ($num_t_mah > 0){
?>
<script type="text/javascript">
$(document).ready(function()
{
$(".country<?php echo $num_t_mah ;?>").change(function()
{
var id=$(this).val();
var dataString = 'group_cod='+ id;
$.ajax
({
type: "POST",
url: "ajax_garden.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar<?php echo $num_t_mah ;?>").html(html);
} 
});
});
});
</script>
<?php
 $num_t_mah--;
}
?>
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
           <p class="style8">مشاهده  اطلاعات باغی و قلمستان</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="manager_Garden.php" method="post" id="form1" name="form1">
      <table width="99%" height="564" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="36%" height="40"><div align="right"><?php echo city_name1($id_city,$id_ostan1) ?></div></td>
          <td width="15%"><div align="right">:شهرستان</div></td>
          <td width="10%">&nbsp;</td>
          <td width="21%"><div align="right"><?php echo ostan_name($id_ostan1) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right">نوع مالکیت:<?php echo $v_no_mal; ?></div></td>
          <td height="38" colspan="2"><div align="right">نوع کاشت :<?php echo $v_no_kesh; ?></div></td>
          <td height="38"><div align="right"> <?php echo $v_nah_kesh; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نحوه کشت </div></td>
        </tr>
  <?php if($nah_kesh<>'3'){?> 
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
        </tr>
        <tr>
          <td height="63"><div align="right">
            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" xml:lang="fa" readonly="readonly"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right">:Y عرض جغرافیایی</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" xml:lang="fa" readonly="readonly" />
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
        </tr>
        <tr>
          <td height="49">&nbsp;</td>
          <td><div align="right"></div></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right"><span class="style2">هکتار</span>
            <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="70"  align="baseline" xml:lang="fa" readonly="readonly" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
        </tr>
        <tr>
          <td height="5" colspan="5">  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>7) echo '<p align="center" style="color:#0066CC" > اطلاعات بهره بردار بعنوان مالک ثبت گردیده </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
                </tr>
              <tr>
                <td width="31%" height="58"><div align="right">
                  <select name="m_jens" disabled="disabled"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
                    <option value="1" <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
                    <option value="2" <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
                    </select>
                  </div></td>
                <td width="20%"><div align="right">جنسیت</div></td>
                <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
                <td width="30%"  bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="5"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="11" xml:lang="fa" readonly="readonly"/>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک </div></td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_last_name" type="text"  class="input_text required" id="m_last_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="8" dir="rtl" lang="fa" value="<?php echo $m_last_name ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی<br />
                  </div></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                </tr>
              <tr>
                <td height="51"><div align="right">
                  <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="10" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>" maxlength="11" readonly="readonly"  align="baseline"  xml:lang="fa" />
                  </div></td>
                <td><div align="right">:تلفن همراه</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php if ($no_bah==2) echo $co_name; else echo $m_fname ; ?>" maxlength="75" xml:lang="fa"/>
                </div></td>
                <td><div style="margin-right:30px" align="right">
                  <?php if ($no_bah==2) echo ':نام شرکت'; else echo ':نام پدر' ; ?>
                </div></td>
                </tr>
              <tr>
                <td height="60">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="m_vaz_sok" disabled="disabled" class="required input_text  " id="m_vaz_sok"  style="height:40px ; width:120px ; direction:rtl" tabindex="12">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($m_vaz_sok=='1') { echo 'selected="selected"' ; } ?>>ساکن</option>
                    <option value="2" <?php if ($m_vaz_sok=='2') { echo 'selected="selected"' ; } ?> >غیرساکن</option>
                    </select>
                  </div></td>
                <td><div style="margin-right:30px" align="right">
                  <p>:وضعیت سکونت مالک</p>
                  </div></td>
              </tr>
              </table>
              <?php }?>
            </td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF">
  <?php if($no_kesh=='1'){?> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات آب</strong></div></td>
                </tr>
              <tr>
                <td width="31%" height="53"><div align="right">
                  <span class="style2">شبانه روز</span>
                  <input name="md_ab" type="text" class="required number input_text" id="md_ab" style="width:50px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $md_ab ; ?>" maxlength="2" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td width="20%"><div align="right">:مدار آبیاری</div></td>
                <td width="1%">&nbsp;</td>
                <td width="30%" bgcolor="#FFFFFF"><div align="right">
                  <select name="m_ab" disabled="disabled" class="input_text required " id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="14">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($m_ab=='1') { echo 'selected="selected"' ; } ?> >چشمه</option>
                    <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"' ; } ?>>قنات</option>
                    <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"' ; } ?>>رودخانه</option>
                    <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"' ; } ?>>سد</option>
                    <option value="5" <?php if ($m_ab=='5') { echo 'selected="selected"' ; } ?>>چاه سطحی</option>
                    <option value="6"  <?php if ($m_ab=='6') { echo 'selected="selected"' ; } ?>>چاه عمیق</option>
                    <option value="7"  <?php if ($m_ab=='7') { echo 'selected="selected"' ; } ?>>چاه نیمه عمیق</option>
                    <option value="8"  <?php if ($m_ab=='8') { echo 'selected="selected"' ; } ?>>زهکش</option>
                    <option value="9"  <?php if ($m_ab=='9') { echo 'selected="selected"' ; } ?>>پساب</option>
                    <option value="10" <?php if ($m_ab=='10') { echo 'selected="selected"' ; } ?>>آب بندان</option>
                    <option value="11" <?php if ($m_ab=='11') { echo 'selected="selected"' ; } ?>>سایر</option>
                    </select>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: منبع آب</div></td>
                </tr>
              <tr>
                <td height="47"><div align="right">
                  <select name="no_sab" disabled="disabled" class="input_text required " id="no_sab"  style="height:40px ; width:170px ; direction:rtl" tabindex="17">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($no_sab=='1') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری</option>
                    <option value="2" <?php if ($no_sab=='2') { echo 'selected="selected"' ; } ?>>مجوز آب</option>
                    <option value="3" <?php if ($no_sab=='3') { echo 'selected="selected"' ; } ?>>عرفی</option>
                    <option value="4" <?php if ($no_sab=='4') { echo 'selected="selected"' ; } ?>>سایر</option>
                    </select>
                  </div></td>
                <td><div align="right">:نوع سند حقابه</div></td>
                <td>&nbsp;</td>
                <td><div align="right"><span class="style2">ساعت</span>
                  <input name="h_ab" type="text" class="input_text  required  number" id="h_ab" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $h_ab ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div style="margin-right:30px" align="right">:حقابه</div></td>
                </tr>
              <tr>
                <td height="52"><div align="right">
                  <select name="es" disabled="disabled" class="input_text required" id="es"  style="height:40px ; width:170px ; direction:rtl" tabindex="19">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($es=='1') { echo 'selected="selected"' ; } ?> >ندارد</option>
                    <option value="2" <?php if ($es=='2') { echo 'selected="selected"' ; } ?>>دارد / جهت ذخیره آب</option>
                    <option value="3" <?php if ($es=='3') { echo 'selected="selected"' ; } ?>>دارد - دو منظوره </option>
                    </select>
                  </div></td>
                <td><div align="right"> :وضعیت استخر</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <select name="no_ab" disabled="disabled" class="input_text  required" id="no_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="18">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($no_ab=='1') { echo 'selected="selected"' ; }?>>جوی و پشته</option>
                    <option value="2" <?php if ($no_ab=='2') { echo 'selected="selected"' ; }?>>نواری</option>
                    <option value="3" <?php if ($no_ab=='3') { echo 'selected="selected"' ; }?>>غرقابی</option>
                    <option value="4" <?php if ($no_ab=='4') { echo 'selected="selected"' ; }?>>تشتکی</option>
                    <option value="5" <?php if ($no_ab=='5') { echo 'selected="selected"' ; }?>>تحت فشار قطره ای</option>
                    <option value="6" <?php if ($no_ab=='6') { echo 'selected="selected"' ; }?>>تحت فشار بارانی</option>
                    <option value="7" <?php if ($no_ab=='7') { echo 'selected="selected"' ; }?>>سایر</option>
                    </select>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نحوه آبیاری</div></td>
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
            <select name="z_sal" disabled="disabled" class="input_text  required" id="z_sal"  style="height:40px ; width:120px ; direction:rtl" tabindex="20">
   <option value="">انتخاب کنید</option>
   <option value="1403" <?php if ($z_sal=='1403') echo 'selected=selected'?>>1403</option>
   <option value="1402" <?php if ($z_sal=='1402') echo 'selected=selected'?>>1402</option>
   <option value="1401" <?php if ($z_sal=='1401') echo 'selected=selected'?>>1400</option>
   <option value="1400" <?php if ($z_sal=='1400') echo 'selected=selected'?>>1401</option>
   <option value="1399" <?php if ($z_sal=='1399') echo 'selected=selected'?>>1399</option>
   <option value="1398" <?php if ($z_sal=='1398') echo 'selected=selected'?>>1398</option>

   </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">: سال زراعی</div></td>
        </tr>
        <tr>
          <td height="131" colspan="5"><table width="100%" height="112" border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td width="5%" rowspan="2" bgcolor="#FFFFCC"> بیمه </td>
              <td width="6%" rowspan="2" bgcolor="#FFFFCC">خسارت</td>
              <td width="18%" colspan="2" bgcolor="#FFFFCC">میزان تولید<br />
                <span class="style2">تن </span></td>
              <td height="32" colspan="2" bgcolor="#FFFFCC">تعداد درخت<br /></td>
              <?php if($nah_kesh<>'3'){?>
              <td colspan="2" bgcolor="#FFFFCC">سطح کاشت<br />
                <span class="style2">هکتار</span></td>
              <?php }?>
              <td colspan="2" bgcolor="#FFFFCC">اطلاعات محصول</td>
              <td width="4%" rowspan="2" bgcolor="#FFFFCC">ردیف</td>
            </tr>
            <tr>
              <td bgcolor="#FFFFCC">قطعی</td>
              <td bgcolor="#FFFFCC">پیش بینی</td>
              <td width="7%" bgcolor="#FFFFCC">غیربارور</td>
              <td width="7%" bgcolor="#FFFFCC">بارور</td>
              <?php if($nah_kesh<>'3'){?>
              <td width="8%" bgcolor="#FFFFCC">غیربارور</td>
              <td width="8%" bgcolor="#FFFFCC">بارور</td>
              <?php }?>
              <td width="16%" bgcolor="#FFFFCC">نام</td>
              <td width="21%" bgcolor="#FFFFCC">گروه</td>
            </tr>
            <?php 
$n = 1 ;
$num2_t_mah = $t_mah ;
include_once('../../login/config.php');
$query = "SELECT cod_qroup,cod_mah,s_kesht_b,s_kesht_gb,tree_b,tree_gb,mah_tol,mah_tolp,mah_bem,mah_kh,check_cod from Garden_prod  where Garden_id = :Garden_id  "; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':Garden_id'=>$id));
$row_count = $stmt -> rowCount();
while ($num2_t_mah > 0){
foreach($stmt as $row)
{
$group_cod = $row['cod_qroup'] ;
$cod_mah = $row['cod_mah'] ; 
$s_kesht_b = $row['s_kesht_b'] ;
$s_kesht_gb = $row['s_kesht_gb'] ;
$tree_b  = $row['tree_b'] ;
$tree_gb  = $row['tree_gb'] ;
$mah_tol  = $row['mah_tol'] ;
$mah_tolp  = $row['mah_tolp'] ;
$mah_bem  = $row['mah_bem'] ;
$mah_kh  = $row['mah_kh'] ;
?>
            <tr>
              <td height="36" bgcolor="#FFFFFF"><div align="center">
                <select name="mah_bem<?php echo $num2_t_mah ;?>" disabled="disabled" class="required input_text  required" id="mah_bem<?php echo $num2_t_mah ;?>"  style="height:40px ; direction:rtl" tabindex="29">
                  <option value="">انتخاب</option>
                  <option value="1" <?php if ($mah_bem=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
                  <option value="2" <?php if ($mah_bem=='2') { echo 'selected="selected"' ; } ?>>خیر</option>
                </select>
              </div></td>
              <td height="36" bgcolor="#FFFFFF"><div align="center">
                <select name="mah_kh<?php echo $num2_t_mah ;?>" disabled="disabled" class="required input_text  required" id="mah_kh<?php echo $num2_t_mah ;?>"  style="height:40px ; direction:rtl" tabindex="29">
                  <option value="">انتخاب</option>
                  <option value="1" <?php if ($mah_kh=='1') { echo 'selected="selected"' ; } ?>>بلی</option>
                  <option value="2" <?php if ($mah_kh=='2') { echo 'selected="selected"' ; } ?>>خیر</option>
                </select>
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="mah_tol<?php echo $num2_t_mah ;?>" type="text" class="required number input_text" id="mah_tol<?php echo $num2_t_mah ;?>" style="width:100px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php  echo $mah_tol ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="mah_tolp<?php echo $num2_t_mah ;?>" type="text" class="required number input_text" id="mah_tolp<?php echo $num2_t_mah ;?>" style="width:100px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php  echo $mah_tolp ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="tree_gb<?php echo $num2_t_mah ;?>" type="text" class="tree_gb required number input_text" id="tree_gb<?php echo $num2_t_mah ;?>" style="width:50px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $tree_gb ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="tree_b<?php echo $num2_t_mah ;?>" type="text" class="tree_b required number input_text" id="tree_b<?php echo $num2_t_mah ;?>" style="width:50px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $tree_b ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <?php if($nah_kesh<>'3'){?>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="s_kesht_gb<?php echo $num2_t_mah ;?>" type="text" class="mashat required number input_text" id="z_kesht_b<?php echo $num2_t_mah ;?>" style="width:50px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php  echo $s_kesht_gb ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <td bgcolor="#FFFFFF"><div align="center">
                <input name="s_kesht_b<?php echo $num2_t_mah ;?>" type="text" class="mashat required number input_text" id="z_kesht_a<?php echo $num2_t_mah ;?>" style="width:50px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php  echo $s_kesht_b ; ?>" maxlength="10" readonly="readonly"  align="baseline" xml:lang="fa" />
              </div></td>
              <?php }?>
              <td bgcolor="#FFFFFF"><span style="margin:10px">
                <div align="right">
                  <select  name="mah_name<?php echo $num2_t_mah ;?>" disabled="disabled" class="required input_text mar<?php echo $mah_name.$num2_t_mah ;?>" style="width:150px ; height:40px" tabindex="23" dir="rtl">
                    <option value="" selected="selected">انتخاب نام محصول</option>
                    <?php
$query = "SELECT DISTINCT product_cod,product_name FROM `product_b` WHERE  `group_cod` = $group_cod" ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                    <option value="<?php echo $row['product_cod'] ;?>"
   <?php if ($row['product_cod']==$cod_mah) echo 'selected=selected'?>> <?php echo $row['product_name'] ;?></option>
                    <?php
}
?>
                  </select>
                </div></td>
              <td bgcolor="#FFFFFF"><div align="right"><span style="margin:10px">
                <select  name="mah_qroup<?php echo $num2_t_mah ;?>" disabled="disabled" class="required input_text country<?php echo $num2_t_mah ;?>" id="mah_qroup<?php echo $num2_t_mah ;?>" style="width:200px ; height:40px" tabindex="22" dir="rtl"  >
                  <option value="" > انتخاب گروه</option>
                  <?php
include ('../../login/config.php');
$query = "SELECT DISTINCT group_cod,group_name FROM `product_b` "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
                  <option value="<?php echo $row['group_cod'] ;?>"
   <?php if ($row['group_cod']==$group_cod) echo 'selected=selected'?>> <?php echo $row['group_name'] ;?></option>
                  <?php }?>
                </select>
              </span></div></td>
              <td bgcolor="#FFFFFF"><?php echo $n ;?></td>
            </tr>
            <?php
 $num2_t_mah--;
 $n++ ;
}
}
?>
          </table></td>
          </tr>
        <tr>
          <td height="37" colspan="5" class="style2"><strong dir="rtl">تعداد درخت برای محصولات توت  فرنگی، چای، زرشک، گل محمدی، گیاهان دارویی و گیاهان دایمی تزئینی تکمیل نمیگردد.</strong></td>
          </tr>
        </table>
      <div align="center">
        <p>
   <input type="submit" name="action" value="بازگشت" id="submit" style="width:150px ; height:45px" tabindex="31" />
    <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m  ;?>" />
        </p>
      </div>
</form> 
  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Garden.php">
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