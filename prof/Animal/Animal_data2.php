<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
/////////////////////////////////////////////////// 
 if (isset($_POST['action'])) 
 {  
$date_s = $date_edit ;
$mor_cod_m = $login_session ;
$bah_cod_m = $_POST['bah_cod_m']; 
$add_city = $_POST['add_city'] ;
$add_abadi = $_POST['add_abadi'] ;
$id_ostan = $_POST['id_ostan'] ;
$id_city = $_POST['id_city'] ;
$id_mar = $_POST['id_mar'] ;
$no_mush = $_POST['no_mush'] ;
$m_zamin = $_POST['m_zamin'] ;
$m_arseh = $_POST['m_arseh'] ;
$m_salon = $_POST['m_salon'] ;
$no_mal = $_POST['no_mal'] ;
$post_code = $_POST['post_code'] ;
$address = $_POST['address'] ;
$lng_d = $_POST['lng_d'] ;
$lng_m = $_POST['lng_m'] ;
$lng_s = $_POST['lng_s'] ;
$lng_ds = $_POST['lng_ds'] ;
$lat_d = $_POST['lat_d'] ;
$lat_m = $_POST['lat_m'] ;
$lat_s = $_POST['lat_s'] ;
$lat_ds = $_POST['lat_ds'] ;
$m_cod_m = $_POST['m_cod_m'] ;
$num_bah = $_POST['num_bah']; 
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
$m_vaz_sok = $_POST['m_vaz_sok'] ;
$unit_name = $_POST['unit_name'] ;
$no_moj    = $_POST['no_moj'] ;
$sh_tas    = $_POST['sh_tas'] ;
$date_tas = $_POST['date_tas'] ;
$sh_moj    = $_POST['sh_moj'] ;
$date_moj = $_POST['date_moj'] ;
if ($no_moj =='1')
{
	 $sh_tas    = '' ; 
     $date_tas  = '' ; 
}
if ($no_moj =='4')
{
	 $sh_tas    = '' ; 
     $date_tas  = '' ; 
	 $sh_moj    = '' ; 
     $date_moj  = '' ; 
}
$sal_tas = $_POST['sal_tas'] ;
$sar_kol = $_POST['sar_kol'] ;
$z_es = $_POST['z_es'] ;
$hava = $_POST['hava'] ;
$cheler = $_POST['cheler'] ;
$deek = $_POST['deek'] ;
$sakhti = $_POST['sakhti'] ;
$sard = $_POST['sard'] ; 
$rotob = $_POST['rotob'] ; 
$gaz = $_POST['gaz'] ; 
$z_gaz = $_POST['z_gaz'] ; 
if ($gaz =='2') $z_gaz = 0 ; 
$barg = $_POST['barg'] ; 
$f_barg = $_POST['f_barg'] ; 
$a_barg = $_POST['a_barg'] ; 
if ($barg =='2')
{
	 $f_barg = 0 ; 
     $a_barg  = 0 ; 
}
$m_ab = $_POST['m_ab'] ; 
$num_ab = $_POST['num_ab'] ; 

//بانک مالک
$m_jens = $_POST['m_jens'] ;
$m_name = $_POST['m_name'] ;
$m_last_name = $_POST['m_last_name'] ;
$m_fname = $_POST['m_fname'] ;
$m_tel_m = $_POST['m_tel_m'] ;
// بانک اطلاعات کشت 

$query = "INSERT INTO Mushroom (date_s,mor_cod_m,bah_cod_m,num_bah,id_ostan,id_city,id_mar,add_abadi,add_city
,m_zamin,m_arseh,m_salon,no_mal,post_code,address,lng_d,lng_m,lng_s,lng_ds,lat_d,lat_m,lat_s,lat_ds,m_cod_m,m_vaz_sok,no_mush,unit_name,no_moj,
sh_tas,date_tas,sh_moj,date_moj,sal_tas,sar_kol
,z_es,hava,cheler,deek
,sakhti,sard,rotob,gaz,z_gaz,barg,f_barg,a_barg,m_ab,num_ab
)
VALUES(:date_s,:mor_cod_m,:bah_cod_m,:num_bah,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city
,:m_zamin,:m_arseh,:m_salon,:no_mal,:post_code,:address,:lng_d,:lng_m,:lng_s,:lng_ds,:lat_d,:lat_m,:lat_s,:lat_ds,
:m_cod_m,:m_vaz_sok,:no_mush,:unit_name,:no_moj,:sh_tas,:date_tas,:sh_moj,:date_moj,:sal_tas,:sar_kol
,:z_es,:hava,:cheler,:deek,:sakhti,:sard,:rotob,:gaz,:z_gaz,:barg,:f_barg,:a_barg,:m_ab,:num_ab)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah
,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city
,':m_zamin'=>$m_zamin,':m_arseh'=>$m_arseh,':m_salon'=>$m_salon,':no_mal'=>$no_mal,':post_code'=>$post_code,':address'=>$address
,':lng_d'=>$lng_d,':lng_m'=>$lng_m,':lng_s'=>$lng_s,':lng_ds'=>$lng_ds
,':lat_d'=>$lat_d,':lat_m'=>$lat_m,':lat_s'=>$lat_s,':lat_ds'=>$lat_ds
,':m_cod_m'=>$m_cod_m,':m_vaz_sok'=>$m_vaz_sok,':no_mush'=>$no_mush,':unit_name'=>$unit_name,':no_moj'=>$no_moj
,':sh_tas'=>$sh_tas,':date_tas'=>$date_tas,':sh_moj'=>$sh_moj,':date_moj'=>$date_moj,':sal_tas'=>$sal_tas,':sar_kol'=>$sar_kol,':z_es'=>$z_es,':hava'=>$hava,':cheler'=>$cheler,':deek'=>$deek
,':sakhti'=>$sakhti,':sard'=>$sard,':rotob'=>$rotob,':gaz'=>$gaz,':z_gaz'=>$z_gaz,':barg'=>$barg,':f_barg'=>$f_barg
,':a_barg'=>$a_barg,':m_ab'=>$m_ab,':num_ab'=>$num_ab));
$query = "SELECT id FROM `malek` WHERE  `m_cod_m` = $m_cod_m"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
if ($stmt -> rowCount() == 0)
{
$query = "INSERT INTO malek (date_s,mor_cod_m,m_cod_m,m_jens,m_name,m_last_name,m_fname,m_tel_m)
                   VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':m_cod_m'=>$m_cod_m,':m_jens'=>$m_jens,':m_name'=>$m_name,':m_last_name'=>$m_last_name,':m_fname'=>$m_fname,':m_tel_m'=>$m_tel_m));
}
 // ثبت در بانک پیگیری
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'ثبت واحد پرورش قارچ-'.$bah_cod_m,$id_ostan) ; 
unset($date_s,$mor_cod_m,$num_bah,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city,$m_zamin,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_mush,$unit_name,$no_moj,$sh_moj,$date_moj,$sal_tas,$sar_kol,$z_es,$hava,$cheler,$deek,$sakhti,$sard,$rotob,$gaz);
alert ('اطلاعات واحد پرورش قارچ با موفقیت ثبت شد ') ;
?>
<form  name="myform" class="myform" method="post" action="Mushroom_prod.php">
      <input type="hidden" name="bah_cod_m" value="<?php echo $bah_cod_m ;?>" />
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
<?php
/////////////////////////////////////////////// 
if  (isset($_POST['bah_cod_m']))
{
date_default_timezone_set('Asia/Tehran') ;
$date_s    = date_con(jdate("Y/m/d"));
$add_abadi = $_POST["add_abadi"]; 
$add_city  = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$m_poul    = $_POST['m_poul'];
$no_mal    = $_POST['no_mal'];
$no_mush   = $_POST['no_mush'];
$no_moj   = $_POST['no_moj'];
$num_bah   = $_POST['num_bah'];
if ($no_mal <> 7)
{
if(isset($_POST['num_bah'])) $num_bah = $_POST['num_bah']; else  $num_bah = '1' ;
$query = "SELECT bah_cod_m,no_bah,co_name,name,jens,last_name,fname,tel_m from bah where bah_cod_m=:bah_cod_m and num_bah=:num_bah"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$co_name = $row['co_name'] ;
$m_name = $row['name'] ;
$m_jens = $row['jens'] ;
$m_last_name = $row['last_name'] ;
$m_fname = $row['fname'] ;
$m_tel_m = $row['tel_m'] ;
$no_bah  = $row['no_bah'] ;
}
$lng = $_POST['lng'];
$lat = $_POST['lat'];
$m_zamin = $_POST['m_zamin'];

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
if ($m_poul=='abadi') {
$query = "SELECT add_abadi,id_ostan,id_city,id_mar from list_abadi where add_abadi = :add_abadi"; 
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
$query = "SELECT add_city,id_ostan,id_city,id_mar from list_city where add_city = :add_city"; 
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
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../jspc-gray.css">
	<script type="text/javascript" src="../js-persian-cal.min.js"></script>
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
<!-- دریافت آدرس -->
<script type="text/javascript">
$(document).ready(function()
{
$(".Post_cod").change(function()
{
var id=$(this).val();
var dataString = 'cod_m='+ id;
$.ajax
({
type: "POST",
url: "post_cod.php",
data: dataString,
cache: false,
success: function(html)
{
$(".mar1").html(html);
} 
});
});
});
</script>
<!-- پایان دریافت اطلاعات مالک -->
</head>
<body>
     <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
           <p class="style8">ثبت اطلاعات واحد پرورش قارچ</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
    <form action="" method="post" id="form1" name="form1"><br />
      <table width="95%" height="1223" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan)  ?></div></td>
          <td width="17%"><div align="right">:شهرستان</div></td>
          <td width="12%">&nbsp;</td>
          <td width="20%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:10px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:10px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="45" class="style2"><div align="right"  >
            <input name="post_code2" type="text"  class="input_text required Post_cod" id="post_code2"  style="width:150px; height:30px;  " tabindex="1"   dir="rtl" lang="fa" value="<?php echo $postalcode ; ?>" maxlength="10" xml:lang="fa"/>
          </div></td>
          <td height="45"><div align="right"> : شناسه یکتا</div></td>
          <td height="45" class="style2">&nbsp;</td>
          <td height="45"><div align="right"  >
            <input name="post_code" type="text"  class="input_text required Post_cod" id="post_code"  style="width:150px; height:30px;  " tabindex="1"   dir="rtl" lang="fa" value="<?php echo $postalcode ; ?>" maxlength="10" xml:lang="fa"/>
          </div></td>
          <td height="45"><div style="margin-right:10px" align="right" > : کد پستی واحد </div></td>
        </tr>
        <tr>
          <td height="46"><div align="right">
            <select name="gaz" class="input_text required " id="seeAnotherField"  style="height:40px ; width:100px ; direction:rtl" tabindex="37">
              <option value="">انتخاب کنید</option>
              <option value="2">ندارد</option>
              <option value="1">دارد</option>
            </select>
          </div></td>
          <td height="46"><div align="right"> : وضعیت عضویت در تعاونی </div></td>
          <td height="46">&nbsp;</td>
          <td height="46"><div align="right"  >
            <input name="post_code3" type="text"  class="input_text required Post_cod" id="post_code3"  style="width:150px; height:30px;  " tabindex="1"   dir="rtl" lang="fa" value="<?php echo $postalcode ; ?>" maxlength="10" xml:lang="fa"/>
          </div></td>
          <td height="46"><div style="margin-right:10px" align="right" > : کد اپیدیمیولوژیک </div></td>
        </tr>
        <tr>
          <td height="46">&nbsp;</td>
          <td height="46">&nbsp;</td>
          <td height="46">&nbsp;</td>
          <td height="46"><div align="right" id="otherFieldDiv2"> مترمکعب / ساعت
            <select name="z_gaz" class="input_text " id="gaz4"  style="height:40px ; width:75px ; direction:rtl" tabindex="38">
              <option value="4">4</option>
              <option value="6">6</option>
              <option value="10">10</option>
              <option value="16">16</option>
              <option value="25">25</option>
              <option value="40">40</option>
              <option value="65">65</option>
              <option value="100">100</option>
              <option value="160">160</option>
            </select>
            <br />
          </div></td>
          <td height="46"><div style="margin-right:30px" align="right" id="otherFieldDiv1"> :ظرفیت کنتور</div></td>
        </tr>
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین و ساختمان</strong></div></td>
        </tr>
        <tr>
          <td height="155" colspan="5"><table width="85%" border="1" bordercolor="#00CCFF" align="center" cellpadding="1" cellspacing="0">
            <tr>
              <td width="19%" height="45" bgcolor="#FFFFCC">دهم ثانیه</td>
              <td width="21%" bgcolor="#FFFFCC">ثانیه</td>
              <td width="17%" bgcolor="#FFFFCC">دقیقه</td>
              <td width="17%" bgcolor="#FFFFCC">درجه</td>
              <td width="26%" bgcolor="#FFFFCC">مختصات جغرافیایی</td>
              </tr>
            <tr>
              <td height="42"><input name="lng_ds" type="text" class="input_text required digits" id="lng_ds" style="width:50px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $lng_ds ; ?>" maxlength="1" align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_s" type="text" class="input_text required digits" id="lng_s" style="width:50px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $lng_s ; ?>" maxlength="2" max="60" min="0"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_m" type="text" class="input_text required digits" id="lng_m" style="width:50px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $lng_m ; ?>" maxlength="2" max="60" min="0"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_d" type="text" class="input_text required digits" id="lng_d" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lng_d ; ?>" maxlength="2"  max="63" min="44" align="baseline" xml:lang="fa" /></td>
              <td>طول </td>
              </tr>
            <tr>
              <td height="50"><input name="lat_ds" type="text" class="input_text required digits" id="lat_ds" style="width:50px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $lat_ds ; ?>" maxlength="1"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lat_s" type="text" class="input_text required digits" id="lat_s" style="width:50px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $lat_s ; ?>" maxlength="2" max="60" min="0"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lat_m" type="text" class="input_text required digits"  id="lat_m" style="width:50px; height:30px ; " tabindex="8" dir="rtl" lang="fa" value="<?php echo $lat_m ; ?>" maxlength="2" max="60" min="0"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lat_d" type="text" class="input_text required digits" id="lat_d" style="width:50px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $lat_d ; ?>" maxlength="2" max="39" min="25"  align="baseline" xml:lang="fa" /></td>
              <td>عرض </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
            </tr>
            <tr>
              <td width="31%" height="57" ><div align="right">
                <select name="no_fa" class="input_text  required" id="no_fa" style="height:40px ; width:200px ; direction:rtl" tabindex="4">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($no_fa=='1') { echo 'selected="selected"' ; } ?>>گاو شیری </option>
                  <option value="2" <?php if ($no_fa=='2') { echo 'selected="selected"' ; } ?>>گوساله پرواری</option>
                  <option value="3" <?php if ($no_fa=='3') { echo 'selected="selected"' ; } ?>>گاومیش شیری</option>
                  <option value="4" <?php if ($no_fa=='4') { echo 'selected="selected"' ; } ?>>گاومیش پرواری</option>
                  <option value="5" <?php if ($no_fa=='5') { echo 'selected="selected"' ; } ?>>گوسفند داشتی</option>
                  <option value="6" <?php if ($no_fa=='6') { echo 'selected="selected"' ; } ?>>بره پرواری</option>
                  <option value="7" <?php if ($no_fa=='7') { echo 'selected="selected"' ; } ?>>بز داشتی</option>
                  <option value="8" <?php if ($no_fa=='8') { echo 'selected="selected"' ; } ?>>بز پرواری</option>
                  <option value="9" <?php if ($no_fa=='9') { echo 'selected="selected"' ; } ?>>شتر داشتی</option>
                  <option value="10" <?php if ($no_fa=='10') { echo 'selected="selected"' ; } ?>>شتر پرواری</option>
                  <option value="11" <?php if ($no_fa=='11') { echo 'selected="selected"' ; } ?>>پرورش و نگهداری اسب</option>
                </select>
              </div></td>
              <td width="20%"><div align="right">:نوع فعالیت</div></td>
              <td width="1%">&nbsp;</td>
              <td width="28%" bgcolor="#FFFFFF"><div align="right">
                <select name="no_moj2" class="input_text required" id="no_moj" style="height:40px ; width:200px ; direction:rtl" tabindex="4">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($no_moj=='1') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری واحد صنعتی</option>
                  <option value="2" <?php if ($no_moj=='2') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری واحد  نیمه صنعتی</option>
                  <option value="3" <?php if ($no_moj=='3') { echo 'selected="selected"' ; } ?>>پروانه بهره برداری کوچک روستایی </option>
                  <option value="4" <?php if ($no_moj=='4') { echo 'selected="selected"' ; } ?>>کارت شناسایی</option>
                  <option value="5" <?php if ($no_moj=='5') { echo 'selected="selected"' ; } ?>>فاقد مجوز</option>
                </select>
              </div></td>
              <td width="20%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نوع مجوز</div></td>
            </tr>
            <?php } if($no_moj !='4' ) {?>
            <tr>
              <td height="34"><div  align="right">
                <input name="date_moj" type="text"  class="pdate required input_text" id="pcal1"  style="width:100px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $pt_date ; ?>" maxlength="10" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div id="otherFieldDiv13" align="right">:تاریخ صدور مجوز</div></td>
              <td>&nbsp;</td>
              <td bgcolor="#FFFFFF"><div  align="right">
                <input name="sh_moj" type="text" class="required  input_text" id="sh_moj" style="width:75px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $pb_no ; ?>" maxlength="20" xml:lang="fa"/>
                <br />
              </div></td>
              <td bgcolor="#FFFFFF"><div  style="margin-right:30px" align="right">:شماره مجوز</div></td>
            </tr>
            <?php  }?>
            <tr>
              <td height="53">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="sal_tas" type="text" class="required number input_text" id="sal_tas" style="width:75px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $pb_no ; ?>"min='1200' max='1400' minlength="4" maxlength="4" xml:lang="fa"/>
                <br />
              </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:مدت اعتبار یا تاریخ انقضاء </div></td>
            </tr>
          </table></td>
        </tr>
          <tr>
          <td height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong> منابع انرژی و تجهیزات واحد </strong></div></td>
          </tr>
        <tr>
          <td height="136" colspan="5"><table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
            <tr>
              <td width="15%" bgcolor="#FFFFCC">کل گله </td>
              <td width="16%" bgcolor="#FFFFCC">دام مولد </td>
              <td width="17%" bgcolor="#FFFFCC">عنوان</td>
            </tr>
            <tr>
              <td height="41"><div align="center">
                <input name="deek" type="text" class="required digits input_text" id="deek" style="width:70px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $no_mush2_3 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div align="center">
                <input name="cheler" type="text" class="required digits input_text" id="cheler" style="width:70px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $no_mush2_2 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td>ظرفیت مندرج در مجوز</td>
            </tr>
            <tr>
              <td height="41"><div align="center">
                <input name="cheler3" type="text" class="required digits input_text" id="cheler3" style="width:70px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $no_mush2_2 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td><div align="center">
                <input name="cheler2" type="text" class="required digits input_text" id="cheler2" style="width:70px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $no_mush2_2 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td>ظرفیت موجود </td>
            </tr>
            <tr>
              <td height="41"><div align="center">
                <input name="cheler4" type="text" class="required digits input_text" id="cheler4" style="width:70px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $no_mush2_2 ; ?>" maxlength="35" xml:lang="fa"/>
                <br />
              </div></td>
              <td colspan="2">تعداد دام هویت گذاری شده</td>
            </tr>
          </table>
            <p>&nbsp;</p>
            <p>&nbsp;</p></td>
        </tr>
        <tr>
          <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="55%" height="51" class="style2">&nbsp;</td>
              <td width="15%" height="51" >&nbsp;</td>
              <td width="14%" height="51" class="style2">&nbsp;</td>
              <td width="16%" height="51" ><div style="margin-right:30px" align="right"> :گاز طبیعی </div></td>
            </tr>
            <tr>
              <td colspan="4"><p>&nbsp;</p>
                <p>&nbsp;</p>
                
  </td>
            </tr>
          </table></td>
        </tr>
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah"   value=<?php echo $num_bah; ?> />
     <input type="hidden" name="id_ostan"  value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city"   value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city"  value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar"    value=<?php echo $id_mar; ?> />
     <input type="hidden" name="no_mush"   value=<?php echo $no_mush; ?> />
     <input type="hidden" name="no_moj" value="<?php echo $no_moj ;?>" />
     <input type="hidden" name="no_mal"    value=<?php echo $no_mal; ?> />
     <input type="submit" name="action"    value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="44" id="btn1" onClick="setTimeout(disableFunction, 1);"/>
     <a href="Mushroom.php">
          <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="45" /></a>
</form> 
<script>
function disableFunction() {
    document.getElementById("btn1").disabled = 'true';
	$("#btn1").attr("disabled","");
}
</script>
    <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal1' );
		var objCal1 = new AMIB.persianCalendar( 'pcal2' );

		  </script>
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
<script src="hide-show-fields-form2.js"></script>
</body>
</html>
