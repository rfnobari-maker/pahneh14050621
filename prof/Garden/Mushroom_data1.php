<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include_once('../../login/config.php');
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
$no_mal = $_POST['no_mal'] ;
$lng = $_POST['lng'] ;
$lat = $_POST['lat'] ;
if ($lng>99) $lng = 0 ; 
if ($lat>99) $lat = 0 ; 
$m_cod_m = $_POST['m_cod_m'] ;
$num_bah = $_POST['num_bah']; 
if ($no_mal<>'7') $m_cod_m = $bah_cod_m ; 
$m_vaz_sok = $_POST['m_vaz_sok'] ;
$unit_name = $_POST['unit_name'] ;
$no_moj = $_POST['no_moj'] ;
$date_moj = $_POST['date_moj'] ;
$sh_moj = $_POST['sh_moj'] ;
$date_moj = $_POST['date_moj'] ;
$sal_tas = $_POST['sal_tas'] ;
$sar_kol = $_POST['sar_kol'] ;
$z_es = $_POST['z_es'] ;
$z_vag = $_POST['z_vag'] ;
$hava = $_POST['hava'] ;
$cheler = $_POST['cheler'] ;
$deek = $_POST['deek'] ;
$sakhti = $_POST['sakhti'] ;
$sard = $_POST['sard'] ; 
$roto = $_POST['roto'] ; 
$gaz = $_POST['gaz'] ; 
//بانک مالک
$m_addres = $_POST['m_addres'] ;
$m_jens = $_POST['m_jens'] ;
$m_name = $_POST['m_name'] ;
$m_last_name = $_POST['m_last_name'] ;
$m_fname = $_POST['m_fname'] ;
$m_tel_m = $_POST['m_tel_m'] ;
// بانک اطلاعات کشت 

$query = "INSERT INTO Mushroom (date_s,mor_cod_m,bah_cod_m,num_bah,id_ostan,id_city,id_mar,add_abadi,add_city
,m_zamin,no_mal,lng,lat,m_cod_m,m_vaz_sok,no_mush,unit_name,no_moj,
sh_moj,date_moj,sal_tas,sar_kol,z_es,z_vag,hava,cheler,deek,sakhti,sard,roto,gaz)
VALUES(:date_s,:mor_cod_m,:bah_cod_m,:num_bah,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city
,:m_zamin,:no_mal,:lng,:lat,:m_cod_m,:m_vaz_sok,:no_mush,:unit_name,:no_moj,
:sh_moj,:date_moj,:sal_tas,:sar_kol,:z_es,:z_vag,:hava,:cheler,:deek,:sakhti,:sard,:roto,:gaz
)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah
,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city
,':m_zamin'=>$m_zamin,':no_mal'=>$no_mal,':lng'=>$lng,':lat'=>$lat,':m_cod_m'=>$m_cod_m,':m_vaz_sok'=>$m_vaz_sok
,':no_mush'=>$no_mush,':unit_name'=>$unit_name,':no_moj'=>$no_maj
,':sh_moj'=>$sh_moj,':date_moj'=>$date_moj,':sal_tas'=>$sal_tas,':sar_kol'=>$sar_kol,':z_es'=>$z_es
,':m_ab'=>$m_ab,':z_vag'=>$z_vag,':hava'=>$hava,':cheler'=>$cheler,':deek'=>$deek,':sakhti'=>$sakhti
,':sard'=>$sard,':roto'=>$roto,':gaz'=>$gaz
));
$query = "SELECT id FROM `malek` WHERE  `m_cod_m` = '$m_cod_m'"  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
if ($stmt -> rowCount() == 0)
{
$query = "INSERT INTO malek (date_s,mor_cod_m,m_cod_m,m_addres,m_jens,m_name,m_last_name,m_fname,m_tel_m)                        VALUES(:date_s,:mor_cod_m,:m_cod_m,:m_addres,:m_jens,:m_name,:m_last_name,:m_fname,:m_tel_m)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':m_cod_m'=>$m_cod_m,':m_addres'=>$m_addres,':m_jens'=>$m_jens,':m_name'=>$m_name,':m_last_name'=>$m_last_name,':m_fname'=>$m_fname,':m_tel_m'=>$m_tel_m));
}
 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت واحد پرورش قارچ-'.$bah_cod_m,$id_ostan) ; 
unset($date_s,$mor_cod_m,$bah_cod_m,$num_bah,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city,$m_zamin,$no_mal,$lng,$lat,$m_cod_m,$m_vaz_sok,$no_mush,$unit_name,$no_moj,$sh_moj,$date_moj,$sal_tas,$sar_kol,$z_es,$z_vag,$hava,$cheler,$deek,$sakhti,$sard,$roto,$gaz);
alert ('اطلاعات واحد پرورش قارچ با موفقیت ثبت شد ') ;
?>
<form  name="myform" class="myform" method="post" action="index.php">
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
$date_s = date_con(jdate("Y/m/d"));
$add_abadi = $_POST["add_abadi"]; 
$add_city = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$m_poul = $_POST['m_poul'];
$no_mal = $_POST['no_mal'];
$no_mush = $_POST['no_mush'];
if ($no_mal <> 7)
{
$query = "SELECT bah_cod_m,no_bah,co_name,name,jens,last_name,fname,tel_m from bah where  bah_cod_m = :bah_cod_m"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_bah = $row['no_bah'] ;
$co_name = $row['co_name'] ;
$m_name = $row['name'] ;
$m_jens = $row['jens'] ;
$m_last_name = $row['last_name'] ;
$m_fname = $row['fname'] ;
if(isset($_POST['num_bah'])) $num_bah = $_POST['num_bah']; else  $num_bah = '1' ;
$m_tel_m = $row['tel_m'] ;
}
$lng = $_POST['lng'];
$lat = $_POST['lat'];
$m_zamin = $_POST['m_zamin'];
$m_ab = $_POST['m_ab'] ;
$no_ab = $_POST['no_ab'] ;
$es = $_POST['es'] ;
if ($no_mush=='1')  $v_no_mush='صدفی';
if ($no_mush=='2')  $v_no_mush='دکمه ای';
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
           <p class="style8">ثبت اطلاعات واحد پرورش قارچ</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
    <form action="" method="post" id="form1" name="form1">
    <br />
      <table width="90%" height="626" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
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
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
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
  <?php if($nah_kesh<>'3'){?> 
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
        </tr>
        <tr>
          <td height="154" colspan="5"><table width="85%" border="1" cellspacing="0" cellpadding="1">
            <tr>
              <td width="19%" height="45" bgcolor="#FFFFCC">دهم ثانیه</td>
              <td width="21%" bgcolor="#FFFFCC">ثانیه</td>
              <td width="17%" bgcolor="#FFFFCC">دقیقه</td>
              <td width="17%" bgcolor="#FFFFCC">درجه</td>
              <td width="26%" bgcolor="#FFFFCC">مختصات جغرافیایی</td>
            </tr>
            <tr>
              <td height="42"><input name="lng_d4" type="text" class="input_text required" id="lng_ds" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lang_d ; ?>" maxlength="1"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_d3" type="text" class="input_text required" id="lng_s" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lang_d ; ?>" maxlength="2"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_d2" type="text" class="input_text required" id="lng_m" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lang_d ; ?>" maxlength="2"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_d" type="text" class="input_text required" id="lng_d" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lang_d ; ?>" maxlength="2"  align="baseline" xml:lang="fa" /></td>
              <td>طول </td>
            </tr>
            <tr>
              <td height="50"><input name="lng_d8" type="text" class="input_text required" id="lat_ds" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lang_d ; ?>" maxlength="1"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_d7" type="text" class="input_text required" id="lat_s" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lang_d ; ?>" maxlength="2"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_d6" type="text" class="input_text required" id="lat_m" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lang_d ; ?>" maxlength="2"  align="baseline" xml:lang="fa" /></td>
              <td><input name="lng_d5" type="text" class="input_text required" id="lat_d" style="width:50px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lang_d ; ?>" maxlength="2"  align="baseline" xml:lang="fa" /></td>
              <td>عرض </td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="49">&nbsp;</td>
          <td>&nbsp;</td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td><span class="style2">مترمربع</span>
            <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="70"  align="baseline" xml:lang="fa" /></td>
          <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
        </tr>
        <tr>
          <td height="5" colspan="5">   
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>7) echo '<p align="center" style="color:#0066CC" > اطلاعات بهره بردار بعنوان مالک ثبت خواهد شد </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
                </tr>
              <tr>
                <td width="31%" height="58"><div align="right">
                  <select name="m_jens"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="5">
                    <option value="1" <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
                    <option value="2" <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
                    </select>
                  </div></td>
                <td width="20%"><div align="right">جنسیت</div></td>
                <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
                <td width="30%"  bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="4"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="10" xml:lang="fa"/>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک </div></td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right"  >
                  <input name="m_last_name" type="text"  class="input_text required" id="m_last_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="7" dir="rtl" lang="fa" value="<?php echo $m_last_name ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی<br />
                  </div></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="70" xml:lang="fa"/>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
                </tr>
              <tr>
                <td height="51"><div align="right">
                  <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>"  maxlength="11"  align="baseline" xml:lang="fa" />
                  </div></td>
                <td><div align="right">:تلفن همراه</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="8" dir="rtl" lang="fa" value="<?php if ($no_bah==2) echo $co_name; else echo $m_fname ; ?>" maxlength="75" xml:lang="fa"/>
                  </div></td>
                <td><div style="margin-right:30px" align="right">
                  <?php if ($no_bah==2) echo ':نام شرکت'; else echo ':نام پدر' ; ?>
                  </div></td>
                </tr>
              <tr>
                <td height="50" colspan="4"><div align="right"><span style="text-align: right">
                  <textarea name="m_addres" cols="80" rows="4" class="required input_text" id="m_addres" tabindex="10"><?php echo $m_addres ;?></textarea>
                  </span></div></td>
                <td><div style="margin-right:30px" align="right">:آدرس محل سکونت</div></td>
                </tr>
              <tr>
                <td height="60">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="m_vaz_sok" class="required input_text  " id="m_vaz_sok"  style="height:40px ; width:120px ; direction:rtl" tabindex="11">
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
          <td height="9" colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
                </tr>
              <tr>
                <td height="53"><div align="right">
                  <select name="no_moj" class="input_text required " id="no_moj"  style="height:40px ; width:200px ; direction:rtl" tabindex="13">
                    <option value="">انتخاب کنید</option>
                    <option value="1">پروانه بهره برداری/نظام مهندسی</option>
                    <option value="1">مشاغل خانگی/وزارت جهاد</option>
                    <option value="3">تسهیلات/بسیج سازندگی</option>
                  </select>
                </div></td>
                <td><div align="right">:نوع مجوز</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="unit_name" type="text" class="required input_text" id="unit_name" style="width:150px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نام واحد </div></td>
              </tr>
              <tr>
                <td height="53"><div align="right">
                  <input name="date_moj" type="text"  class="pdate required input_text" id="pcal1"  style="width:100px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $pt_date ; ?>" maxlength="10" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="right">:تاریخ مجوز </div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="sh_moj" type="text" class="required  input_text" id="sh_moj" style="width:75px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $pb_no ; ?>" maxlength="20" xml:lang="fa"/>
                  <br />
                </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:شماره مجوز</div></td>
              </tr>
              <tr>
                <td height="53"><div align="right"> <span class="style8">میلیارد ریال </span>
                    <input name="sar_kol" type="text" class="required number input_text" id="sar_kol" style="width:75px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td><div align="right">:سرمایه گذاری کل</div></td>
                <td>&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="sal_tas" type="text" class="required number input_text" id="sal_tas" style="width:75px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $pb_no ; ?>" maxlength="20" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:سال تاسیس</div></td>
              </tr>
              <tr>
                <td width="37%" height="53"><div align="right">
                  <span class="style8">تن در سال</span>
                  <input name="z_vag" type="text" class="required number input_text" id="z_vag" style="width:75px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td width="17%"><div align="right">:ظرفیت واقعی</div></td>
                <td width="2%">&nbsp;</td>
                <td width="26%" bgcolor="#FFFFFF"><div align="right">
                   <span class="style8">تن در سال</span>
                  <input name="z_es" type="text" class="required number input_text" id="z_es" style="width:75px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $pb_no ; ?>" maxlength="20" xml:lang="fa"/>
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
                  <input name="roto" type="text" class="required digits input_text" id="md_ab10" style="width:70px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $no_mush2_4 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="sard" type="text" class="required digits input_text" id="md_ab5" style="width:70px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $no_mush2_4 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                </div></td>
                <td height="41"><div align="center">
                  <input name="sakhti" type="text" class="required digits input_text" id="md_ab15" style="width:70px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $no_mush2_4 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td><div align="center">
                  <input name="deek" type="text" class="required digits input_text" id="md_ab14" style="width:70px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $no_mush2_3 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td><div align="center">
                  <input name="cheler" type="text" class="required digits input_text" id="md_ab13" style="width:70px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $no_mush2_2 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                  </div></td>
                <td><div align="center">
                  <input name="hava" type="text" class="required digits input_text" id="md_ab12" style="width:70px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $no_mush2_1 ; ?>" maxlength="35" xml:lang="fa"/>
                  <br />
                  </div></td>
                </tr>
          </table></td>
        </tr>
        <tr>
          <td height="37" colspan="3" class="style2">&nbsp;</td>
          <td height="37" class="style2"><div align="right">
            <select name="gaz" class="input_text required " id="gaz"  style="height:40px ; width:150px ; direction:rtl" tabindex="26">
              <option value="">انتخاب کنید</option>
              <option value="1">بلی</option>
              <option value="2">خیر</option>
              </select>
          </div></td>
          <td height="37" ><div style="margin-right:30px" align="right"> واحد گاز سوز هست ؟</div></td>
          </tr>
        </table>
          <div align="center">
        <p>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="num_bah" value=<?php echo $num_bah; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="hidden" name="no_mush" value=<?php echo $no_mush; ?> />
     <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
     <input type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="27" id="btn1" onClick="setTimeout(disableFunction, 1);"/>
     <a href="index.php">
            <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="28" /></a>
        </p>
      </div>
<p align="center" >&nbsp;</p>
</form> 
<script>
function disableFunction() {
    document.getElementById("btn1").disabled = 'true';
	$("#btn1").attr("disabled","");
}
</script>
    <script type="text/javascript">
		var objCal1 = new AMIB.persianCalendar( 'pcal1' );
		  </script>
                <script type="text/javascript">
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
</body>
</html>
