<?php
include('../../lock_ce.php');
include('../../event.php');
include_once('../../login/config.php');
if  (isset($_POST['bah_cod_m']))
{
$bah_cod_m = $_POST['bah_cod_m'];
$id      = $_POST['id'];
$query = "SELECT * from Mushroom where  bah_cod_m = '$bah_cod_m' and id = '$id' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id_ostan = $row['id_ostan'];  
$id_city = $row['id_city'];  
$id_mar = $row['id_mar'];  
$num_bah = $row['num_bah']; 
$add_abadi = $row["add_abadi"]; 
$add_city = $row["add_city"]; 
$no_mal = $row['no_mal'];
$no_mush = $row['no_mush'];
$post_code = $row['post_code'] ;
$address = $row['address'] ;
$lng_d = $row['lng_d'] ;
$lng_m = $row['lng_m'] ;
$lng_s = $row['lng_s'] ;
$lng_ds = $row['lng_ds'] ;
$lat_d = $row['lat_d'] ;
$lat_m = $row['lat_m'] ;
$lat_s = $row['lat_s'] ;
$lat_ds = $row['lat_ds'] ;
$m_zamin = $row['m_zamin'];
$m_arseh = $row['m_arseh'];
$m_salon = $row['m_salon'];
$m_vaz_sok = $row['m_vaz_sok'] ;
$unit_name = $row['unit_name'] ;
$no_moj    = $row['no_moj'] ;
$sh_tas    = $row['sh_tas'] ;
$date_tas = $row['date_tas'] ;
$sh_moj    = $row['sh_moj'] ;
$date_moj = $row['date_moj'] ;
$sal_tas = $row['sal_tas'] ;
$sar_kol = $row['sar_kol'] ;
$z_es = $row['z_es'] ;
$hava = $row['hava'] ;
$cheler = $row['cheler'] ;
$deek = $row['deek'] ;
$sakhti = $row['sakhti'] ;
$sard = $row['sard'] ; 
$rotob = $row['rotob'] ; 
$gaz = $row['gaz'] ; 
$z_gaz = $row['z_gaz'] ; 
$barg = $row['barg'] ; 
$f_barg = $row['f_barg'] ; 
$a_barg = $row['a_barg'] ; 
$m_ab = $row['m_ab'] ; 
 if ($m_ab=='1') $v_m_ab = 'چشمه' ; 
 if ($m_ab=='2') $v_m_ab = 'قنات' ; 
 if ($m_ab=='3') $v_m_ab = 'رودخانه' ; 
 if ($m_ab=='4') $v_m_ab = 'سد' ; 
 if ($m_ab=='5') $v_m_ab = 'چاه سطحی' ; 
 if ($m_ab=='6') $v_m_ab = 'چاه عمیق' ; 
 if ($m_ab=='7') $v_m_ab = 'چاه نیمه عمیق' ; 
 if ($m_ab=='8') $v_m_ab = 'زهکش' ; 
 if ($m_ab=='9') $v_m_ab = 'پساب' ; 
 if ($m_ab=='10') $v_m_ab = 'آب بندان' ; 
 if ($m_ab=='11') $v_m_ab = 'سایر' ; 
$num_ab = $row['num_ab'] ; 
if ($no_mal <> 7)
{
$query = "SELECT bah_cod_m,no_bah,co_name,name,jens,last_name,fname,tel_m from bah where  bah_cod_m = :bah_cod_m and num_bah = :num_bah"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_bah = $row['no_bah'] ;
$co_name = $row['co_name'] ;
$m_name = $row['name'] ;
$m_jens = $row['jens'] ;
$m_last_name = $row['last_name'] ;
$m_fname = $row['fname'] ;
$m_tel_m = $row['tel_m'] ; }

if ($no_mush=='1')  $v_no_mush='صدفی';
if ($no_mush=='2')  $v_no_mush='دکمه ای';
if ($no_mush=='3')  $v_no_mush='سایر قارچ های پرورشی خاص';
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
if ($no_mal=='1')  $v_no_mal='سند ششدانگ';
if ($no_mal=='2')  $v_no_mal='سند مشاعی';
if ($no_mal=='3')  $v_no_mal='اصلاحات اراضی';
if ($no_mal=='4')  $v_no_mal='موقوفه';
if ($no_mal=='5')  $v_no_mal='واگذاری';
if ($no_mal=='6')  $v_no_mal='قولنامه';
if ($no_mal=='7')  $v_no_mal='اجاره' ;
if ($no_mal=='8')  $v_no_mal='سایر' ;
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../jspc-gray.css">
	<script type="text/javascript" src="../js-persian-cal.min.js"></script>
	<script src="../../assets/js/jquery-3.6.0.min.js" type="text/javascript"></script>
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
function close_window() {
      close();
 }
</script>
<!-- پایان دریافت اطلاعات مالک -->
</head>
<body>
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
</td>
  </tr>
  <tr>
    <td>
     
           <p class="style8">نمایش اطلاعات واحد پرورش قارچ</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
             <?php echo ($bah_cod_m.'-'.$num_bah) ;?>
    <form action="" method="post" id="form1" name="form1">
    <br />
      <table width="90%" height="1211" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="36%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan)  ?></div></td>
          <td width="15%"><div align="right">:شهرستان</div></td>
          <td width="10%">&nbsp;</td>
          <td width="21%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo shahr_name($add_city);  ?><?php echo abadi_name($add_abadi); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"><?php echo $v_no_mal; ?></div></td>
          <td height="38"><div align="right"> : نوع مالکیت</div></td>
          <td height="38">&nbsp;</td>
          <td height="38"><div align="right"> <?php echo $v_no_mush; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نوع قارچ پرورشی</div></td>
        </tr>
        <tr>
          <td height="38">&nbsp;</td>
          <td height="38">&nbsp;</td>
          <td height="38">&nbsp;</td>
          <td height="38"><div align="right"><?php echo $post_code; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : کد پستی واحد </div></td>
        </tr>
        <tr>
          <td height="38" colspan="4"><div align="right"><?php echo $address; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : آدرس واحد </div></td>
        </tr>
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
        </tr>
        <tr>
          <td height="158" colspan="5"><table width="85%" border="1" bordercolor="#00CCFF" align="center" cellpadding="1" cellspacing="0">
            <tr>
              <td width="19%" height="45" bgcolor="#FFFFCC">دهم ثانیه</td>
              <td width="21%" bgcolor="#FFFFCC">ثانیه</td>
              <td width="17%" bgcolor="#FFFFCC">دقیقه</td>
              <td width="17%" bgcolor="#FFFFCC">درجه</td>
              <td width="26%" bgcolor="#FFFFCC">مختصات جغرافیایی</td>
            </tr>
            <tr>
              <td height="42"><input name="lng_ds" type="text" class="input_text required digits" id="lng_ds" style="width:50px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $lng_ds ; ?>" maxlength="1" readonly="readonly" align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_s" type="text" class="input_text required digits" id="lng_s" style="width:50px; height:30px ; " max="60" min="0" tabindex="5" dir="rtl" lang="fa" value="<?php echo $lng_s ; ?>" maxlength="2" readonly="readonly"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_m" type="text" class="input_text required digits" id="lng_m" style="width:50px; height:30px ; " max="60" min="0" tabindex="4" dir="rtl" lang="fa" value="<?php echo $lng_m ; ?>" maxlength="2" readonly="readonly"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_d" type="text" class="input_text required digits" id="lng_d" style="width:50px; height:30px ; "  max="46" min="24" tabindex="3" dir="rtl" lang="fa" value="<?php echo $lng_d ; ?>" maxlength="2" readonly="readonly" align="baseline" xml:lang="fa" /></td>
              <td>طول </td>
            </tr>
            <tr>
              <td height="50"><input name="lat_ds" type="text" class="input_text required digits" id="lat_ds" style="width:50px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $lat_ds ; ?>" maxlength="1" readonly="readonly"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lat_s" type="text" class="input_text required digits" id="lat_s" style="width:50px; height:30px ; " max="60" min="0" tabindex="9" dir="rtl" lang="fa" value="<?php echo $lat_s ; ?>" maxlength="2" readonly="readonly"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lat_m" type="text" class="input_text required digits"  id="lat_m" style="width:50px; height:30px ; " max="60" min="0" tabindex="8" dir="rtl" lang="fa" value="<?php echo $lat_m ; ?>" maxlength="2" readonly="readonly"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lat_d" type="text" class="input_text required digits" id="lat_d" style="width:50px; height:30px ; " max="46" min="24" tabindex="7" dir="rtl" lang="fa" value="<?php echo $lat_d ; ?>" maxlength="2" readonly="readonly"  align="baseline" xml:lang="fa" /></td>
              <td>عرض </td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="49"><div align="right"><span class="style2">مترمربع</span>
            <input name="m_arseh" type="text" class="digits input_text required" id="m_arseh" style="width:100px; height:30px;   " tabindex="12" dir="rtl" lang="fa" value="<?php echo $m_arseh ; ?>"  maxlength="11" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div align="right"> : مساحت زیربنا</div></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right"> <span class="style2">مترمربع</span>
            <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:15px" align="right">:مساحت زمین</div></td>
        </tr>
        <tr>
          <td height="49">&nbsp;</td>
          <td>&nbsp;</td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right"><span class="style2">مترمربع</span>
            <input name="m_salon" type="text" class="digits input_text required" id="m_salon" style="width:100px; height:30px " tabindex="13" dir="rtl" lang="fa" value="<?php echo $m_salon ; ?>"  maxlength="11" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:15px" align="right">:مساحت کل سالن ها</div></td>
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
                  <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="4"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="10" readonly="readonly" xml:lang="fa"/>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک </div></td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_last_name" type="text"  class="input_text required" id="m_last_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_last_name ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی<br />
                  </div></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="70" readonly="readonly" xml:lang="fa"/>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                </tr>
              <tr>
                <td height="51"><div align="right">
                  <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>"  maxlength="11" readonly="readonly"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div align="right">:تلفن همراه</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="8" dir="rtl" lang="fa" value="<?php if ($num_bah==2) echo $co_name; else echo $m_fname ; ?>" maxlength="75" readonly="readonly" xml:lang="fa"/>
                </div></td>
                <td><div style="margin-right:30px" align="right">
                  <?php if ($num_bah==2) echo ':نام شرکت'; else echo ':نام پدر' ; ?>
                </div></td>
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
            </td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
                </tr>
              <tr>
                <td height="53"><div align="right">
                  <select name="no_moj" disabled="disabled" class="input_text required " id="no_moj"  style="height:40px ; width:200px ; direction:rtl" tabindex="13">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?> >پروانه بهره برداری/نظام مهندسی</option>
                    <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>مشاغل خانگی/وزارت جهاد</option>
                    <option value="3" <?php if ($no_moj=='3') { echo 'selected="selected"' ; } ?>>تسهیلات/بسیج سازندگی</option>
                    <option value="4" <?php if ($no_moj=='4') { echo 'selected="selected"' ; } ?>>فاقد مجوز</option>
                  </select>
                </div></td>
                <td><div align="right">:نوع مجوز</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="unit_name" type="text" class="required input_text" id="unit_name" style="width:150px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نام واحد </div></td>
              </tr>
<?php if($no_moj !='4' and $no_moj !='1' ) {?>
              <tr>
                <td height="53"><div align="right">
                  <input name="date_tas" type="text"  class="pdate required input_text" id="pcal2"  style="width:100px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $date_tas ; ?>" maxlength="10" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td><div align="right">:تاریخ پروانه تاسیس</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="sh_tas" type="text" class="required  input_text" id="sh_tas" style="width:75px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $sh_tas ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:شماره پروانه تاسیس</div></td>
              </tr>
<?php } if($no_moj !='4' ) {?>
              <tr>
                <td height="53"><div align="right">
                  <input name="date_moj" type="text"  class="required input_text" id="pcal1"  style="width:100px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $date_moj ; ?>" maxlength="10" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td><div align="right">:تاریخ پروانه بهره برداری </div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="sh_moj" type="text" class="required  input_text" id="sh_moj" style="width:75px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $sh_moj ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:شماره پروانه بهره برداری</div></td>
              </tr>
  <?php  }?>
              <tr>
                <td height="53"><div align="right"> <span class="style8">میلیارد ریال </span>
                    <input name="sar_kol" type="text" class="required number input_text" id="sar_kol" style="width:75px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $sar_kol ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td><div align="right">:سرمایه گذاری کل</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="sal_tas" type="text" class="required number input_text" id="sal_tas" style="width:75px; height:30px ; " max='1400'min='1200' tabindex="16" dir="rtl" lang="fa" value="<?php echo $sal_tas ; ?>" maxlength="4" readonly="readonly" minlength="4" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:سال تاسیس</div></td>
              </tr>
              <tr>
                <td width="37%" height="53">&nbsp;</td>
                <td width="17%">&nbsp;</td>
                <td width="2%">&nbsp;</td>
                <td width="26%" bgcolor="#FFFFFF"><div align="right">
                   <span class="style8">تن در سال</span>
                  <input name="z_es" type="text" class="required number input_text" id="z_es" style="width:75px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $z_es ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:ظرفیت اسمی </div></td>
              </tr>
            </table></td>
        </tr>
          <tr>
          <td height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong> تجهیزات واحد </strong></div></td>
          </tr>
        <tr>
          <td height="136" colspan="5">
            <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
              <tr>
                <td height="37" colspan="6" bgcolor="#FFFFCC">وضعیت تجهیزات / تعداد</td>
                </tr>
              <tr>
                <td width="19%" bgcolor="#FFFFCC">رطوبت سنج و دماسنج</td>
                <td width="16%" bgcolor="#FFFFCC">سردخانه</td>
                <td width="17%" height="37" bgcolor="#FFFFCC">سختی گیر</td>
                <td width="15%" bgcolor="#FFFFCC">دیگ بخار</td>
                <td width="16%" bgcolor="#FFFFCC">چیلر</td>
                <td width="17%" bgcolor="#FFFFCC">هواساز</td>
                </tr>
              <tr>
                <td><div align="center">
                  <input name="rotob" type="text" class="required digits input_text" id="rotob" style="width:70px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $rotob ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="sard" type="text" class="required digits input_text" id="sard" style="width:70px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $sard ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="sakhti" type="text" class="required digits input_text" id="sakhti" style="width:70px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $sakhti ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td><div align="center">
                  <input name="deek" type="text" class="required digits input_text" id="deek" style="width:70px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $deek ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td><div align="center">
                  <input name="cheler" type="text" class="required digits input_text" id="cheler" style="width:70px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $cheler ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td><div align="center">
                  <input name="hava" type="text" class="required digits input_text" id="hava" style="width:70px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $hava ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                  </div></td>
                </tr>
          </table></td>
        </tr>
        <tr>
          <td height="37" colspan="5" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="51" colspan="3" class="style2"><div align="right" id="otherFieldDiv2"> مترمکعب / ساعت
                <select name="z_gaz" disabled="disabled" class="input_text " id="gaz4"  style="height:40px ; width:75px ; direction:rtl" tabindex="39">
                  <option value="0"  <?php if ($z_gaz=='')   { echo 'selected="selected"' ; } ?>>0</option>
                  <option value="4"  <?php if ($z_gaz=='4')   { echo 'selected="selected"' ; } ?>>4</option>
                  <option value="6"  <?php if ($z_gaz=='6')   { echo 'selected="selected"' ; } ?>>6</option>
                  <option value="10" <?php if ($z_gaz=='10')  { echo 'selected="selected"' ; } ?>>10</option>
                  <option value="16" <?php if ($z_gaz=='16')  { echo 'selected="selected"' ; } ?>>16</option>
                  <option value="25" <?php if ($z_gaz=='25')  { echo 'selected="selected"' ; } ?>>25</option>
                  <option value="40" <?php if ($z_gaz=='40')  { echo 'selected="selected"' ; } ?>>40</option>
                  <option value="65" <?php if ($z_gaz=='65')  { echo 'selected="selected"' ; } ?>>65</option>
                  <option value="100"<?php if ($z_gaz=='100') { echo 'selected="selected"' ; } ?>>100</option>
                  <option value="160"<?php if ($z_gaz=='160') { echo 'selected="selected"' ; } ?>>160</option>
                </select>
                <br />
              </div></td>
              <td width="15%" height="51" ><div style="margin-right:30px" align="right" id="otherFieldDiv1"> :ظرفیت کنتور</div></td>
              <td width="14%" height="51" class="style2"><div align="right">
                <select name="gaz" disabled="disabled" class="input_text required " id="seeAnotherField"  style="height:40px ; width:100px ; direction:rtl" tabindex="37">
                  <option value="">انتخاب کنید</option>
                  <option value="2" <?php if ($gaz=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
                  <option value="1" <?php if ($gaz=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
                </select>
              </div></td>
              <td width="16%" height="51" ><div style="margin-right:30px" align="right"> :گاز طبیعی </div></td>
            </tr>
            <tr>
              <td width="21%" height="53" class="style2"><div align="right" id="otherFieldDiv6" > آمپر
                <select name="a_barg" disabled="disabled" class="input_text" id="a_barg"  style="height:40px ; width:72px ; direction:rtl" tabindex="39">
                  <option value="25"  <?php if ($a_barg=='25')  { echo 'selected="selected"' ; } ?>>25</option>
                  <option value="30"  <?php if ($a_barg=='30')  { echo 'selected="selected"' ; } ?>>30</option>
                  <option value="50"  <?php if ($a_barg=='50')  { echo 'selected="selected"' ; } ?>>50</option>
                  <option value="100" <?php if ($a_barg=='100') { echo 'selected="selected"' ; } ?>>100</option>
                </select>
                <br />
              </div></td>
              <td width="14%" ><div style="margin-right:30px" align="right" id="otherFieldDiv5"> :مقدار آمپر</div></td>
              <td width="20%" height="53" class="style2"><div align="right" id="otherFieldDiv4">
                <select name="f_barg" disabled="disabled" class="input_text required " id="f_barg"  style="height:40px ; width:75px ; direction:rtl" tabindex="39">
                  <option value="1" <?php if ($f_barg=='1') { echo 'selected="selected"' ; } ?>>تک فاز</option>
                  <option value="3" <?php if ($f_barg=='3') { echo 'selected="selected"' ; } ?>>سه فاز</option>
                </select>
                <br />
              </div></td>
              <td height="53" ><div style="margin-right:30px" align="right" id="otherFieldDiv3"> :تعداد فاز</div></td>
              <td height="53" class="style2"><div align="right">
                <select name="barg" disabled="disabled" class="input_text required " id="seeAnotherField2"  style="height:40px ; width:100px ; direction:rtl" tabindex="39">
                  <option value="">انتخاب کنید</option>
                  <option value="2" <?php if ($barg=='2') { echo 'selected="selected"' ; } ?>>ندارد</option>
                  <option value="1" <?php if ($barg=='1') { echo 'selected="selected"' ; } ?>>دارد</option>
                </select>
              </div></td>
              <td height="53" ><div style="margin-right:30px" align="right"> :برق شهری </div></td>
            </tr>
            <tr>
              <td height="48">&nbsp;</td>
              <td>&nbsp;</td>
              <td><div align="right"> <span class="style2">لیتر / ثانیه</span>
                <input name="num_ab" type="text" class="required number input_text" id="num_ab" style="width:75px; height:30px ; " tabindex="43" dir="rtl" lang="fa" value="<?php echo $num_ab ; ?>" maxlength="6" readonly="readonly" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div style="margin-right:30px" align="right"> :دبی آب</div></td>
              <td><div align="right" class="input_text" ><?php echo $v_m_ab ;?></div></td>
              <td><div style="margin-right:30px" align="right"> :منبع تامین آب </div></td>
            </tr>
            <tr>
              <td colspan="6"><p>&nbsp;</p></td>
            </tr>
          </table></td>
          </tr>
        </table>
          <div align="center">
        <p>
     <input type="button" name="btn1" value="بستن پنجره" onclick="close_window()" style="width:150px ; height:45px" tabindex="28" /></a>
</form> 
  </td>
  </tr>
<?php 
}
else
{
?>
<form  name="myform" class="myform" method="post" action="Mushroom.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
   </tr>
</table>
</body>
</html>
