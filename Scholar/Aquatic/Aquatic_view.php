<?php
//session_start();
include('../../lock_Sc.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
include('../../login/config.php');
if  (isset($_POST['bah_cod_m']))
{
 $id = $_POST["id"]; 
 $num_bah = $_POST['num_bah']; 
 $bah_cod_m = $_POST['bah_cod_m'];
 $sal = $_POST['sal'];
 $m_poul = $_POST['m_poul'];
 $query = "SELECT * from Aquatic where bah_cod_m = '$bah_cod_m' and sal = '$sal' and id = '$id' "; 
$stmt = $dbh->prepare($query);
$stmt->execute();
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$no_fa = $row['no_fa'];
$no_mal =$row['no_mal'] ;
$lng = $row['lng'];
$lat = $row['lat'];
$m_zamin = $row['m_zamin'];
$m_cod_m = $row['m_cod_m'] ;
$g_tol = $row['g_tol'] ;
$pt_no = $row['pt_no'] ;
$pt_date = $row['pt_date'] ;
$pb_no = $row['pb_no'] ;
$pb_date = $row['pb_date'] ;
$m_ab = $row['m_ab'] ;
$unit_name = $row['unit_name'] ;
$sal = $row['sal'] ;
$tak1 = $row['tak1'] ; 
$tak2 = $row['tak2'] ; 
$tak3 = $row['tak3'] ; 
$tak4 = $row['tak4'] ; 
$tak5 = $row['tak5'] ; 
$par1 = $row['par1'] ; 
$par2 = $row['par2'] ; 
$par3 = $row['par3'] ; 
$par4 = $row['par4'] ; 
$m_vaz_sok = $row['m_vaz_sok'] ;
$add_abadi = $row["add_abadi"]; 
$id_ostan1 = $row["id_ostan"]; 
$id_city = $row["id_city"]; 
$id_mar = $row["id_mar"]; 
if ($no_mal <> 7)
{
$query = "SELECT no_bah,co_name,fname,name,jens,last_name,tel_m from bah where  bah_cod_m = :bah_cod_m"; 
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
if ($no_fa=='1')  $v_no_fa='تکثیر';
if ($no_fa=='2')  $v_no_fa='پرورش';
if ($no_fa=='3')  $v_no_fa='تکثیر و پرورش' ;	 
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
           <p class="style8">مشاهده اطلاعات مزرعه تکثیر و پرورش آبزیان</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data2($bah_cod_m,$num_bah) ;?>
      </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="liste_Aquatic.php" method="post" id="form1" name="form1">
      <table width="99%" height="570" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <p class="one" >&nbsp;</p>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت بهره برداری</strong></div></td>
        </tr>
        <tr>
          <td width="36%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan1) ?></div></td>
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
          <td height="38"><div align="right"><?php echo $v_no_mal; ?></div></td>
          <td height="38"><div align="right"> : نوع مالکیت</div></td>
          <td height="38">&nbsp;</td>
          <td height="38"><div align="right"> <?php echo $v_no_fa; ; ?></div></td>
          <td height="38"><div style="margin-right:30px" align="right" > : نوع فعالیت</div></td>
        </tr>
        <?php if($nah_kesh<>'3'){?>
        <tr>
          <td height="38" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
        </tr>
        <tr>
          <td height="63"><div align="right">
            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right">:Y عرض جغرافیایی</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
        </tr>
        <tr>
          <td height="49">&nbsp;</td>
          <td><div align="right"></div></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right"><span class="style2">مترمربع</span>
            <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="70" readonly="readonly"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:مساحت مفید</div></td>
        </tr>
        <tr>
          <td height="5" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="4"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="11" xml:lang="fa"/>
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
                <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="6" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="11" readonly="readonly" xml:lang="fa"/>
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
                <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>7) echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php if ($no_bah==2) echo $co_name; else echo $m_fname ; ?>" maxlength="75" readonly="readonly" xml:lang="fa"/>
              </div></td>
              <td><div style="margin-right:30px" align="right">
                <?php if ($no_bah==2) echo ':نام شرکت'; else echo ':نام پدر' ; ?>
              </div></td>
            </tr>
            <tr>
              <td height="50" colspan="4"><div align="right"><span style="text-align: right">
                <textarea name="m_addres" cols="80" rows="4" readonly="readonly" class="required input_text" id="m_addres" tabindex="10"><?php echo $m_addres ;?></textarea>
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
            <?php }?></td>
        </tr>
        <tr>
          <td height="9" colspan="5" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات واحد</strong></div></td>
            </tr>
            <tr>
              <td width="37%" height="53"><div align="right">
                <select name="m_ab" disabled="disabled" class="input_text required " id="m_ab"  style="height:40px ; width:150px ; direction:rtl" tabindex="13">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($m_ab=='1') { echo 'selected="selected"' ; } ?>>رودخانه</option>
                  <option value="2" <?php if ($m_ab=='2') { echo 'selected="selected"' ; } ?>>چاه</option>
                  <option value="3" <?php if ($m_ab=='3') { echo 'selected="selected"' ; } ?>>چشمه و قنات</option>
                  <option value="4" <?php if ($m_ab=='4') { echo 'selected="selected"' ; } ?>>آبن بندان</option>
                  <option value="5" <?php if ($m_ab=='5') { echo 'selected="selected"' ; } ?>>خور و دریا</option>
                  <option value="6" <?php if ($m_ab=='6') { echo 'selected="selected"' ; } ?>>دریاچه</option>
                  <option value="7" <?php if ($m_ab=='7') { echo 'selected="selected"' ; } ?>>سایر منابع</option>
                </select>
              </div></td>
              <td width="17%"><div align="right">: منبع تامین آب</div></td>
              <td width="2%">&nbsp;</td>
              <td width="26%" bgcolor="#FFFFFF"><div align="right">
                <select name="g_tol" disabled="disabled" class="input_text required " id="g_tol"  style="height:40px ; width:150px ; direction:rtl" tabindex="12">
                  <option value="">انتخاب کنید</option>
                  <option value="1" <?php if ($g_tol=='1') { echo 'selected="selected"' ; } ?>>مجتمع</option>
                  <option value="2" <?php if ($g_tol=='2') { echo 'selected="selected"' ; } ?>>منفرد</option>
                  <option value="3" <?php if ($g_tol=='3') { echo 'selected="selected"' ; } ?>>مدار بسته</option>
                  <option value="4" <?php if ($g_tol=='4') { echo 'selected="selected"' ; } ?>>دو منظوره</option>
                  <option value="5" <?php if ($g_tol=='5') { echo 'selected="selected"' ; } ?>>شالیزار</option>
                  <option value="6" <?php if ($g_tol=='6') { echo 'selected="selected"' ; } ?>>قفس</option>
                  <option value="7" <?php if ($g_tol=='7') { echo 'selected="selected"' ; } ?>>پن</option>
                  <option value="8" <?php if ($g_tol=='8') { echo 'selected="selected"' ; } ?>>آب بندان</option>
                  <option value="9" <?php if ($g_tol=='9') { echo 'selected="selected"' ; } ?>>منابع آبی</option>
                  <option value="10" <?php if ($g_tol=='10') { echo 'selected="selected"' ; } ?>>سایر موارد</option>
                </select>
              </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:قالب تولید</div></td>
            </tr>
            <tr>
              <td height="53"><div align="right">
                <input name="pb_no" type="text" class="required  input_text" id="pb_no" style="width:75px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $pb_no ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
                تاریخ
                <input name="pb_date" type="text" class="pdate required input_text" id="pcal2" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $pb_date ; ?>" maxlength="10" readonly="readonly" xml:lang="fa"/>
                شماره <br />
              </div></td>
              <td><div align="right">:پروانه بهره برداری</div></td>
              <td>&nbsp;</td>
              <td bgcolor="#FFFFFF"><div align="right">
                <input name="pt_no" type="text" class="required  input_text" id="pt_no" style="width:75px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $pt_no ; ?>" maxlength="20" readonly="readonly" xml:lang="fa"/>
                تاریخ
                <input name="pt_date" type="text"  class="pdate required input_text" id="pcal1"  style="width:100px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $pt_date ; ?>" maxlength="10" readonly="readonly" xml:lang="fa"/>
                شماره <br />
              </div></td>
              <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: پروانه تاسیس</div></td>
            </tr>
            <tr>
              <td height="53" colspan="4"><div align="right"> <span class="style2">در صورت واقع شدن در مجتمع شیلاتی</span>
                <input name="unit_name" type="text" class="required input_text" id="unit_name" style="width:250px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="75" readonly="readonly" xml:lang="fa"/>
                <br />
              </div></td>
              <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">:نام مجتمع </div></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات تولید </strong></div></td>
        </tr>
        <tr>
          <td height="40">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo $sal ?></div></td>
          <td><div style="margin-right:30px" align="right">: سال </div></td>
        </tr>
        <tr>
          <td height="131" colspan="5"><?PHP if(($no_fa == '1') or ($no_fa == '3')) {?>
            <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
              <tr>
                <td height="43" colspan="5" bgcolor="#FFFFCC">تکثیر<br />
                  <span class="style2">واحد : هزار قطعه</span></td>
              </tr>
              <tr>
                <td width="23%" height="43" bgcolor="#FFFFCC">ماهیان زینتی<br /></td>
                <td width="25%" bgcolor="#FFFFCC">میگوی آب شور و شیرین و<br />
                  شاه میگو<br /></td>
                <td width="19%" bgcolor="#FFFFCC">قزل آلا <br /></td>
                <td width="16%" bgcolor="#FFFFCC">کپور ماهیان<br /></td>
                <td width="17%" bgcolor="#FFFFCC">ماهیان خاویاری<br /></td>
              </tr>
              <tr>
                <td height="51"><div align="center">
                  <input name="tak5" type="text" class="required number input_text" id="md_ab11" style="width:70px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $tak5 ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="tak4" type="text" class="required number input_text" id="md_ab9" style="width:70px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $tak4 ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="tak3" type="text" class="required number input_text" id="md_ab8" style="width:70px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $tak3 ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="tak2" type="text" class="required number input_text" id="md_ab7" style="width:70px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $tak2 ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="tak1" type="text" class="required number input_text" id="md_ab6" style="width:70px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $tak1 ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
              </tr>
            </table>
            <?php }?>
            <br />
            <?PHP if(($no_fa == '2') or ($no_fa == '3')) {?>
            <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#0099CC">
              <tr>
                <td height="37" colspan="4" bgcolor="#FFFFCC">پرورش<br />
                  <span class="style2"> واحد : تن</span></td>
                </tr>
              <tr>
                <td width="25%" height="43" bgcolor="#FFFFCC">میگوی آب شور و شیرین و<br />
                  شاه میگو<br /></td>
                <td width="19%" bgcolor="#FFFFCC"><p>قزل آلا<br />
                </p></td>
                <td width="16%" bgcolor="#FFFFCC">کپور ماهیان<br /></td>
                <td width="17%" bgcolor="#FFFFCC">ماهیان خاویاری</td>
              </tr>
              <tr>
                <td height="41"><div align="center">
                  <input name="par4" type="text" class="required number input_text" id="par4" style="width:70px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $par4 ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="par3" type="text" class="required number input_text" id="md_ab14" style="width:70px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $par3 ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="par2" type="text" class="required number input_text" id="md_ab13" style="width:70px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $par2 ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
                <td><div align="center">
                  <input name="par1" type="text" class="required number input_text" id="md_ab12" style="width:70px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $par1 ; ?>" maxlength="35" readonly="readonly" xml:lang="fa"/>
                  <br />
                </div></td>
              </tr>
            </table>
            <?php }?>
            <br /></td>
        </tr>
      </table>
      <div align="center">
        <p>
    <input type="hidden" name="action" value="1" />
     <input type="submit" name="action" value="بازگشت" id="submit" style="width:150px ; height:45px" tabindex="40" />
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
<form  name="myform" class="myform" method="post" action="liste_Aquatic.php">
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
