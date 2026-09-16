<?php
include("../../lock_expsh.php");
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
//require_once('../../ersal_p.php');
if  (isset($_POST['id']))
{
function renderForm($date_s,$mor_cod_m,$id_ostan,$id_city,$id_mar,$bah_cod_m,$num_bah,$unit_name,$m_zamin
	,$m_zmos,$lng,$lat,$no_mal,$m_cod_m,$no_pta,$date_pta,$no_pb,$date_pb,$v_ab,$g_en,$v_ch,$no_mch,$date_mch
	,$v_bar,$amp,$t_faz,$v_gaz,$v_tas,$no_tas,$v_tah,$v_rd,$add_abadi,$add_city)
{ 
$bah_cod_m = $_POST['bah_cod_m'];
$num_bah   = $_POST['num_bah'];
$add_abadi = $_POST['add_abadi'];
$add_city  = $_POST['add_city'];
$id        = $_POST['id'];
$no_mal    = $_POST['no_mal'];
$m_bah    = $_POST['m_bah'];
include('../../login/config.php');
if ($no_mal<>'5') $m_cod_m = $bah_cod_m ;
if ($no_mal=='1')  $v_no_mal='امور اراضی';
if ($no_mal=='2')  $v_no_mal='منابع طبیعی';
if ($no_mal=='3')  $v_no_mal='شهرک صنعتی';
if ($no_mal=='4')  $v_no_mal='مالکیت شخصی';
if ($no_mal=='5')  $v_no_mal='اجاره ای';
if ($no_mal=='6')  $v_no_mal='سایر' ;
if ($m_bah=='abadi') {
    $query = "SELECT id_city,id_mar,add_abadi from list_abadi where add_abadi = :add_abadi";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':add_abadi'=>$add_abadi));
    $found = $stmt -> rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $add_city = '-';
    $id_city = $row["id_city"];
    $id_mar = $row["id_mar"];
}
if  ($m_bah=='shahr') {
    $query = "SELECT id_city,id_mar,add_city from list_city where add_city = :add_city";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':add_city'=>$add_city));
    $found = $stmt -> rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $add_city = $row["add_city"];
    $add_abadi = '-';
    $id_city = $row["id_city"];
    $id_mar = $row["id_mar"];
}
if ($no_mal<>'5')
{
    $query = "SELECT no_bah,co_name,fname,name,jens,last_name,tel_m from ind_bah where  bah_cod_m = :bah_cod_m and num_bah = :num_bah";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':num_bah'=>$num_bah));
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
    $m_tel_m = $row['tel_m'] ;
}

 $query = "SELECT * from ind_unit where  id = :id"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':id'=>$id));
$found = $stmt -> rowCount();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
    $bah_cod_m = $row['bah_cod_m'];
    $num_bah = $row['num_bah'];
    $unit_name = $row['unit_name'] ;
    $m_zamin = $row['m_zamin'] ;
    $m_zmos = $row['m_zmos'] ;
    $lng = $row['lng'] ;
    $lat = $row['lat'] ;
   $no_pta = $row['no_pta'] ;
   $date_pta = $row['date_pta'] ;
    $y_pta = substr($date_pta,0,4);
    $m_pta = substr($date_pta,5,2) ;
    $d_pta = substr($date_pta,8,2) ;
   $no_pb = $row['no_pb'] ;
   $date_pb = $row['date_pb'] ;
   $y_pb = substr($date_pb,0,4);
   $m_pb = substr($date_pb,5,2) ;
   $d_pb = substr($date_pb,8,2) ;
   $v_ab = $row['v_ab'] ;
   $g_en = $row['g_en'] ;
   $v_ch = $row['v_ch'] ;
   $no_mch = $row['no_mch'] ;
   $date_mch = $row['date_mch'] ;
   $y_mch = substr($date_mch,0,4);
   $m_mch = substr($date_mch,5,2) ;
   $d_mch = substr($date_mch,8,2) ;
   $v_bar = $row['v_bar'] ;
   $amp = $row['amp'] ;
   $t_faz = $row['t_faz'] ;
   $v_gaz = $row['v_gaz'] ;
   $v_tas = $row['v_tas'] ;
   $no_tas = $row['no_tas'] ;
   $v_tah = $row['v_tah'] ;
   $v_rd = $row['v_rd'] ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../FA.css" rel="stylesheet" type="text/css" />
<link href="radio.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<link rel="stylesheet" href="../../jspc-gray.css">
	<script type="text/javascript" src="../../js-persian-cal.min.js"></script>
    <script type="text/javascript" src="../../script.js"></script>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
         //$("#form1").validate();
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
$(document).ready(function() {
<?php if ($v_tas == '2') {
	 $no_tas = '1' ; 
	 ?>
      $(".vtas_comment").hide();
     
	  <?php }?>

<?php if ($v_bar == '2') { ?>
      $(".vbar_comment").hide();
	  <?php }?>

<?php if ($v_ab == '2') { ?>
      $(".vab_comment").hide();
	  <?php }?>

<?php if ($v_ch == '2') { 
 $y_mch = '0000';$m_mch = '00' ; $d_mch = '00' ; 
?>
      $(".vch_comment").hide();
	  <?php }?>
  $("#v_ab").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vab_comment").show();
    } else if (value == "2") {
      $(".vab_comment").hide();
	  <?php //$g_en = '0'?>
    } 
  });

  $("#v_ch").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vch_comment").show();
    } else if (value == "2") {
      $(".vch_comment").hide();
	  <?php //$y_mch = '0000' ; $m_mch = '00' ; $d_mch = '00' ; $no_mch = '0' ;?>
    } 
  });

  $("#v_bar").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vbar_comment").show();
    } else if (value == "2") {
      $(".vbar_comment").hide();
	  <?php //$t_faz = 0 ; $amp = 0 ;?>

    } 
  });

  $("#v_tas").change(function() {
    var value = $(this).val();
    if (value == "1") {
      $(".vtas_comment").show();
    } else if (value == "2") {
      $(".vtas_comment").hide();
    } 
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
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
	    <form action="" method="post" id="form1" name="form1">
 <p align="center" >&nbsp;</p>
 <p align="center" > <span class="style8">ویرایش اطلاعات واحد صنعتی</span><span class="style1"><br />
   <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/> </span> <br />
 </p>
 <p align="center" >
   <?php sar_ind_data($bah_cod_m,$num_bah) ;?>
 </p>
 <table width="95%" height="1231" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
   <tr>
     <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت واحد</strong></div></td>
   </tr>
   <tr>
     <td width="31%" height="22"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?></div></td>
     <td width="20%"><div align="right">:شهرستان</div></td>
     <td width="1%">&nbsp;</td>
     <td width="30%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
     <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
   </tr>
   <tr>
     <td height="63"><div align="right"> <?php echo abadi_name($add_abadi); echo shahr_name($add_city); ?></div></td>
     <td><div align="right">: آبادی / شهر</div></td>
     <td>&nbsp;</td>
     <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
     <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
   </tr>
   <tr>
     <td height="40" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
   </tr>
   <tr>
     <td height="43"><div align="right"> <?php echo $v_no_mal; ?></div></td>
     <td><div align="right">:نوع مالکیت</div></td>
     <td>&nbsp;</td>
     <td><div align="right">
       <input name="unit_name" type="text" class="input_text required" id="unit_name" style="width:250px; height:30px;  " tabindex="1" dir="rtl" lang="fa" value="<?php echo $unit_name ; ?>" maxlength="100" xml:lang="fa"/>
     </div></td>
     <td><div style="margin-right:30px" align="right" >:نام واحد</div></td>
   </tr>
   <tr>
     <td height="47"><div align="right"> <span class="style2">درجه اعشار</span>
       <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="3" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
       <br />
     </div></td>
     <td><div align="right">:Y عرض جغرافیایی</div></td>
     <td>&nbsp;</td>
     <td><div align="right"><span class="style2">درجه اعشار</span>
       <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
       <br />
     </div></td>
     <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
   </tr>
   <tr>
     <td height="46"><div align="right"><span class="style2">مترمربع </span>
       <input name="m_zmos" type="text" class="input_text number required" id="m_zmos" style="width:100px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $m_zmos ; ?>" maxlength="11"  align="baseline" xml:lang="fa" />
     </div></td>
     <td height="46"><div align="right">:مساحت مسقف</div></td>
     <td height="46">&nbsp;</td>
     <td height="46"><div align="right"><span class="style2">مترمربع </span>
       <input name="m_zamin" type="text" class="m_zamin input_text number required" id="m_zamin" style="width:100px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="11"  align="baseline" xml:lang="fa" />
     </div></td>
     <td><div style="margin-right:30px" align="right">:مساحت کل زمین</div></td>
   </tr>
   <tr>
     <td height="5" colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td  height="42" colspan="5" bgcolor="#CCCCCC"><?php if($no_mal<>'5') echo '<p align="center" style="color:#0066CC" > اطلاعات  مالک - بهره بردار '.$v_co_name.' بعنوان مالک ثبت خواهد شد </p>' ;  else echo '<div style="margin-right:40px" align="right"><strong>اطلاعات مالک</strong></div>' ?></td>
       </tr>
       <tr>
         <td width="31%" height="58"><div align="right">
           <select name="m_jens"  class="input_text mar required" id="m_jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="7">
             <option value="1" <?php if (isset($jens) && $row['jens']=='1') echo 'selected=selected'?>>مرد</option>
             <option value="2" <?php if (isset($jens) && $row['jens']=='2') echo 'selected=selected'?>>زن</option>
           </select>
         </div></td>
         <td width="20%"><div align="right">:جنسیت</div></td>
         <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
         <td width="30%"  bgcolor="#FFFFFF"><div align="right"  >
           <input name="m_cod_m" type="text"  class="input_text required Mcod_m" id="m_cod_m"  style="width:150px; height:30px;  <?php if($no_mal<>'5') echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="6"   dir="rtl" lang="fa" value="<?php echo $m_cod_m ; ?>" maxlength="11" xml:lang="fa"/>
         </div></td>
         <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد ملی مالک </div></td>
       </tr>
       <tr>
         <td height="46" bgcolor="#FFFFFF"><div align="right"  >
           <input name="m_last_name" type="text"  class="input_text required" id="m_last_name" style="width:150px; height:30px;  <?php if($no_mal<>'5') echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="9" dir="rtl" lang="fa" value="<?php echo $m_last_name ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
         </div></td>
         <td bgcolor="#FFFFFF"><div align="right">:نام خانوادگی<br />
         </div></td>
         <td bgcolor="#FFFFFF">&nbsp;</td>
         <td bgcolor="#FFFFFF"><div align="right">
           <input name="m_name" type="text" class="input_text required" id="m_name" style="width:150px; height:30px;  <?php if($no_mal<>'5') echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="8" dir="rtl" lang="fa" value="<?php echo $m_name ; ?>" maxlength="75" xml:lang="fa"/>
         </div></td>
         <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نام</div></td>
       </tr>
       <tr>
         <td height="51"><div align="right">
           <input name="m_tel_m" type="text" class="digits input_text required" id="m_tel_m" style="width:100px; height:30px;  <?php if($no_mal<>'5') echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="11" dir="rtl" lang="fa" value="<?php echo $m_tel_m ; ?>"  maxlength="11"  align="baseline" xml:lang="fa" />
         </div></td>
         <td><div align="right">:تلفن همراه</div></td>
         <td>&nbsp;</td>
         <td><div align="right">
           <input name="m_fname" type="text" class="required input_text" id="m_fname" style="width:150px; height:30px;  <?php if($no_mal<>'5') echo 'background-color:#FFFFCC " readonly="readonly" ' ?> " tabindex="10" dir="rtl" lang="fa" value="<?php if ($no_bah==2) echo $co_name; else echo $m_fname ; ?>" maxlength="75" xml:lang="fa"/>
         </div></td>
         <td><div style="margin-right:30px" align="right">
           <?php if ($no_bah==2) echo ':نام شرکت'; else echo ':نام پدر' ; ?>
         </div></td>
       </tr>
     </table></td>
   </tr>
   <tr>
     <td height="41" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>مشخصات مجوز</strong></div></td>
   </tr>
   <tr>
     <td height="150" colspan="5" bgcolor="#FFFFFF"><table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
       <tr>
         <td height="40" bgcolor="#FFFFCC">تاریخ مجوز</td>
         <td height="40" bgcolor="#FFFFCC">شماره مجوز</td>
         <td height="40" bgcolor="#FFFFCC">نوع مجوز</td>
       </tr>
       <tr>
         <td width="44%" height="47" bgcolor="#FFFFFF"><div align="center">
           <input name="y_pta" type="text" class="input_text number required" id="y_pta" style="width:50px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $y_pta ; ?>" maxlength="4" minlength="4" align="baseline" xml:lang="fa" />
           /
           <input name="m_pta" type="text" class="input_text number required" id="m_pta" style="width:30px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $m_pta ; ?>" maxlength="2" minlength="2"  align="baseline" xml:lang="fa" />
           /
           <input name="d_pta" type="text" class="input_text number required" id="d_pta" style="width:30px; height:30px ;
   " tabindex="13" dir="rtl" lang="fa" value="<?php echo $d_pta ; ?>" maxlength="2" minlength="2"  align="baseline" xml:lang="fa" />
         </div></td>
         <td width="31%"><div align="center">
           <input name="no_pta" type="text" class="input_text number required" id="no_pta" style="width:100px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $no_pta ; ?>" maxlength="15"  align="baseline" xml:lang="fa" />
         </div></td>
         <td width="25%">مجوز تاسیس </td>
       </tr>
       <tr>
         <td height="47"><div align="center">
           <input name="y_pb" type="text" class="input_text number required" id="y_pb" style="width:50px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $y_pb ; ?>" maxlength="4" minlength="4" align="baseline" xml:lang="fa" />
           /
           <input name="m_pb" type="text" class="input_text number required" id="m_pb" style="width:30px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $m_pb ; ?>" maxlength="2" minlength="2"  align="baseline" xml:lang="fa" />
           /
           <input name="d_pb" type="text" class="input_text number required" id="d_pb" style="width:30px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $d_pb ; ?>" maxlength="2" minlength="2"  align="baseline" xml:lang="fa" />
         </div></td>
         <td><div align="center">
           <input name="no_pb" type="text" class="input_text number required" id="no_pb" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $no_pb ; ?>" maxlength="15"  align="baseline" xml:lang="fa" />
         </div></td>
         <td>پروانه بهره برداری</td>
       </tr>
     </table></td>
   </tr>
   <tr>
     <td height="39" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>منابع پایه</strong></div></td>
   </tr>
   <tr>
     <td height="256" colspan="5"><table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
       <tr>
         <td height="40" colspan="5" bgcolor="#FFFFCC">توضیحات</td>
         <td width="19%" bgcolor="#FFFFCC">آخرین وضعیت</td>
         <td width="16%" bgcolor="#FFFFCC">نوع منبع</td>
       </tr>
       <tr>
         <td height="47" colspan="3" bgcolor="#CCCCCC">&nbsp;</td>
         <td width="14%" ><div align="center" class="vab_comment" >
           <input name="g_en" type="text" class="input_text number required" id="g_en" style="width:50px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $g_en ; ?>" maxlength="5"  align="baseline" xml:lang="fa" />
         </div></td>
         <td width="14%" ><div class="vab_comment">قطر انشعاب</div></td>
         <td><div align="center">
           <select name="v_ab" class="required input_text " id="v_ab" style="height:40px ; width:120px ; direction:rtl" tabindex="20">
             <option value="">انتخاب کنید</option>
             <option    value="1"<?php if ($v_ab == '1') echo "selected='selected'"?>>دارد</option>
             <option    value="2"<?php if ($v_ab == '2') echo "selected='selected'"?>>ندارد</option>
           </select>
         </div></td>
         <td> آب لوله کشی</td>
       </tr>
       <tr>
         <td width="25%" height="47"><div align="center" class="vch_comment">
           <input name="y_mch" type="text" class="input_text number required" id="y_mch" style="width:50px; height:30px ; " tabindex="26" dir="rtl" lang="fa" value="<?php echo $y_mch ; ?>" maxlength="4" minlength="4" align="baseline" xml:lang="fa" />
           /
           <input name="m_mch" type="text" class="input_text number required" id="m_mch" style="width:30px; height:30px ; " tabindex="25" dir="rtl" lang="fa" value="<?php echo $m_mch ; ?>" maxlength="2" minlength="2"  align="baseline" xml:lang="fa" />
           /
           <input name="d_mch" type="text" class="input_text number required" id="d_mch" style="width:30px; height:30px ; " tabindex="24" dir="rtl" lang="fa" value="<?php echo $d_mch ; ?>" maxlength="2" minlength="2"  align="baseline" xml:lang="fa" />
         </div></td>
         <td colspan="2"><div class="vch_comment">تاریخ مجوز</div></td>
         <td><div align="center" class="vch_comment">
           <input name="no_mch" type="text" class="input_text number required" id="no_mch" style="width:75px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $no_mch ; ?>" maxlength="15"  align="baseline" xml:lang="fa" />
         </div></td>
         <td><div class="vch_comment">شماره مجوز </div></td>
         <td><div align="center">
           <select name="v_ch" class="required input_text  " id="v_ch"  style="height:40px ; width:120px ; direction:rtl" tabindex="22">
             <option value="">انتخاب کنید</option>
             <option value="1"<?php if ($v_ch == '1') echo "selected='selected'"?>>دارد</option>
             <option value="2"<?php if ($v_ch == '2') echo "selected='selected'"?>>ندارد</option>
           </select>
         </div></td>
         <td>چاه آب</td>
       </tr>
       <tr>
         <td height="50"><div align="center" class="vbar_comment">
           <input name="amp" type="text" class="input_text number required" id="amp" style="width:50px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $amp ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
         </div></td>
         <td colspan="2"><div class="vbar_comment">آمپر</div></td>
         <td><div align="center" class="vbar_comment">
           <input name="t_faz" type="text" class="input_text number required" id="t_faz" style="width:50px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $t_faz ; ?>" maxlength="3"  align="baseline" xml:lang="fa" />
         </div></td>
         <td><div class="vbar_comment">تعداد فاز</div></td>
         <td><div align="center">
           <select name="v_bar" class="required input_text  " id="v_bar"  style="height:40px ; width:120px ; direction:rtl" tabindex="27">
             <option value="">انتخاب کنید</option>
             <option value="1"<?php if ($v_bar == '1') echo "selected='selected'"?>>دارد</option>
             <option value="2"<?php if ($v_bar == '2') echo "selected='selected'"?>>ندارد</option>
           </select>
         </div></td>
         <td>برق</td>
       </tr>
       <tr>
         <td height="50" colspan="5" bgcolor="#CCCCCC">&nbsp;</td>
         <td><div align="center">
           <select name="v_gaz" class="required input_text  " id="v_gaz"  style="height:40px ; width:120px ; direction:rtl" tabindex="30">
             <option value="">انتخاب کنید</option>
             <option value="1"<?php if ($v_gaz == '1') echo "selected='selected'"?>>دارد</option>
             <option value="2"<?php if ($v_gaz == '2') echo "selected='selected'"?>>ندارد</option>
           </select>
         </div></td>
         <td>گاز</td>
       </tr>
     </table></td>
   </tr>
   <tr>
     <td height="39" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>سایر</strong></div></td>
   </tr>
   <tr>
     <td height="200" colspan="5"><table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
       <tr>
         <td height="40" colspan="2" bgcolor="#FFFFCC">توضیحات</td>
         <td width="21%" bgcolor="#FFFFCC">آخرین وضعیت</td>
         <td width="29%" bgcolor="#FFFFCC">شرح</td>
       </tr>
       <tr>
         <td width="26%" height="50"><div align="center" class="vtas_comment">
           <select name="no_tas" class="required input_text  " id="no_tas"  style="height:40px ; width:120px ; direction:rtl" tabindex="32">
             <option value="">انتخاب کنید</option>
             <option value="1"<?php if ($no_tas == '1') echo "selected='selected'"?>>سپتیک</option>
             <option value="2"<?php if ($no_tas == '2') echo "selected='selected'"?>>صنعتی</option>
           </select>
         </div></td>
         <td width="24%"><div class="vtas_comment">نوع تصفیه</div></td>
         <td><div align="center">
           <select name="v_tas" class="required input_text" id="v_tas"  style="height:40px ; width:120px ; direction:rtl" tabindex="31">
             <option value="">انتخاب کنید</option>
             <option value="1"<?php if ($v_tas == '1') echo "selected='selected'"?>>دارد</option>
             <option value="2"<?php if ($v_tas == '2') echo "selected='selected'"?>>ندارد</option>
           </select>
         </div></td>
         <td> تصفیه خانه</td>
       </tr>
       <tr>
         <td colspan="2" rowspan="2" bgcolor="#CCCCCC">&nbsp;</td>
         <td height="50"><div align="center">
           <select name="v_tah" class="required input_text  " id="m_vaz_sok6"  style="height:40px ; width:120px ; direction:rtl" tabindex="33">
             <option value="">انتخاب کنید</option>
             <option value="1"<?php if ($v_tah == '1') echo "selected='selected'"?>>دارد</option>
             <option value="2"<?php if ($v_tah == '2') echo "selected='selected'"?>>ندارد</option>
           </select>
         </div></td>
         <td>تهویه هوا</td>
       </tr>
       <tr>
         <td><div align="center">
           <select name="v_rd" class="required input_text  " id="m_vaz_sok7"  style="height:40px ; width:120px ; direction:rtl" tabindex="34">
             <option value="">انتخاب کنید</option>
             <option value="1"<?php if ($v_rd == '1') echo "selected='selected'"?>>دارد</option>
             <option value="2"<?php if ($v_rd == '2') echo "selected='selected'"?>>ندارد</option>
           </select>
         </div></td>
         <td>واحد تحقیق و توسعه<br />
           R&amp;D</td>
       </tr>
     </table></td>
   </tr>
 </table>
 <p>&nbsp;</p>
 <div align="center">
   <p>
     <input type="hidden" name="id" value=<?php echo $id; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="no_mal" value=<?php echo $no_mal; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
    <input  type="submit" name="action" value="تصحیح اطلاعات" style="width:150px ; height:45px" tabindex="35" id="submit" />
                  <a href="list_ind_unit.php">
             <input type="button" name="btn1" value="انصراف" style="width:150px ; height:45px" tabindex="36" /></a>

   </p>
</div>
 <p align="center" >&nbsp;</p>
      </form> 
        </td>
</tr>
<tr>
<td  height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><?php include('../../footer.php')?></td>
</tr>
</table>
</table>
 <?php  
} 

  if (isset($_POST['action'])) 
 {  
    $id = $_POST['id'];
    $date_s = $date_edit ;
    $mor_cod_m = $login_session ;
    $bah_cod_m = $_POST['bah_cod_m'];
    $add_city = $_POST['add_city'] ;
    $add_abadi = $_POST['add_abadi'] ;
    $id_ostan = $_POST['id_ostan'] ;
    $id_city = $_POST['id_city'] ;
    $id_mar = $_POST['id_mar'] ;
    $unit_name = $_POST['unit_name'] ;
    $m_zamin = $_POST['m_zamin'] ;
    $m_zmos = $_POST['m_zmos'] ;
    $no_mal = $_POST['no_mal'] ;
    $lng = $_POST['lng'] ;
    $lat = $_POST['lat'] ;
    if ($lng>99) $lng = 0 ;
    if ($lat>99) $lat = 0 ;
    $m_cod_m = $_POST['m_cod_m'] ;
    if(isset($_POST['num_bah'])) $num_bah = $_POST['num_bah']; else  $num_bah = '1' ;
    if ($no_mal<>'5') $m_cod_m = $bah_cod_m ;
   $no_pta = $_POST['no_pta'] ;
   $y_pta = $_POST['y_pta'] ;
   $m_pta = $_POST['m_pta'] ;
   $d_pta = $_POST['d_pta'] ;
   $date_pta = $y_pta.'/'.$m_pta.'/'.$d_pta ; 
   $no_pb = $_POST['no_pb'] ;
   $y_pb = $_POST['y_pb'] ;
   $m_pb = $_POST['m_pb'] ;
   $d_pb = $_POST['d_pb'] ;
   $date_pb = $y_pb.'/'.$m_pb.'/'.$d_pb ; 
   $v_ab = $_POST['v_ab'] ;
   $g_en = $_POST['g_en'] ;
   if($v_ab == '2') $g_en = 0 ; 
   $v_ch = $_POST['v_ch'] ;
   $no_mch = $_POST['no_mch'] ;
   $y_mch = $_POST['y_mch'] ;
   $m_mch = $_POST['m_mch'] ;
   $d_mch = $_POST['d_mch'] ;
   $date_mch = $y_mch.'/'.$m_mch.'/'.$d_mch ; 
   if($v_ch == '2')  { $date_mch = '' ; $no_mch = 0 ; }
   $v_bar = $_POST['v_bar'] ;
   $amp = $_POST['amp'] ;
   $t_faz = $_POST['t_faz'] ;
   if($v_bar == '2') { $amp = 0 ; $t_faz = 0; }  
   $v_gaz = $_POST['v_gaz'] ;
   $v_tas = $_POST['v_tas'] ;
   $no_tas = $_POST['no_tas'] ;
   if($v_tas == '2') $no_tas = '' ;
   $v_tah = $_POST['v_tah'] ;
   $v_rd = $_POST['v_rd'] ;
//بانک مالک
    $m_jens = $_POST['m_jens'] ;
    $m_name = $_POST['m_name'] ;
    $m_last_name = $_POST['m_last_name'] ;
    $m_fname = $_POST['m_fname'] ;
    $m_tel_m = $_POST['m_tel_m'] ;
// بانک اطلاعات کشت
if ($mess =='123456') 
{
alert($mess) ; 
renderForm($date_s,$mor_cod_m,$id_ostan,$id_city,$id_mar,$bah_cod_m,$num_bah,$unit_name,$m_zamin
	,$m_zmos,$lng,$lat,$no_mal,$m_cod_m,$no_pta,$date_pta,$no_pb,$date_pb,$v_ab,$g_en,$v_ch,$no_mch,$date_mch
	,$v_bar,$amp,$t_faz,$v_gaz,$v_tas,$no_tas,$v_tah,$v_rd,$add_abadi,$add_city);
}
else 
{
include('../../login/config.php');
$query = "UPDATE ind_unit SET date_s=?,id_mar=?,unit_name=?,m_zamin=?,m_zmos=?,lng=?,lat=?,no_mal=?
,m_cod_m=?,no_pta=?,date_pta=?,no_pb=?,date_pb=?,v_ab=?,g_en=?,v_ch=?,no_mch=?,date_mch=?,v_bar=?,amp=?,t_faz=?
,v_gaz=?,v_tas=?,no_tas=?,v_tah=?,v_rd=?,add_abadi=?,add_city=? WHERE id=? ";
$q = $dbh->prepare($query);
$q->execute(array($date_s,$id_mar,$unit_name,$m_zamin,$m_zmos,$lng,$lat,$no_mal,$m_cod_m,$no_pta,
$date_pta,$no_pb,$date_pb,$v_ab,$g_en,$v_ch,$no_mch,$date_mch,$v_bar,$amp,$t_faz,$v_gaz,$v_tas,$no_tas,$v_tah,
$v_rd,$add_abadi,$add_city,$id));
// ارسال اس ام اس 
//$text= " با سلام اطلاعات شمادر سامانه ثبت مجوز فعالیت های کشاورزی سازمان نظام مهندسی استان ثبت شد کد رهگیری ".$cod_p." اطلاعات بیشتر در سایت سامانه  به آدرس www.aeo-azsh.ir" ; 
//sms($tel_m,$text) ;
 // ثبت در بانک پیگیری
sabt_event($login_session,$_SERVER['REMOTE_ADDR'],$date_edit,$time,$add_abadi,'تصحیح اطلاعات واحد صنعتی- '.$bah_cod_m,$id_ostan) ; 
 // once saved, redirect back to the view page 
 //header("Location: user_view.php");
unset($date_s,$mor_cod_m,$id_ostan,$id_city,$id_mar,$bah_cod_m,$num_bah,$unit_name,$m_zamin
	,$m_zmos,$lng,$lat,$no_mal,$m_cod_m,$no_pta,$date_pta,$no_pb,$date_pb,$v_ab,$g_en,$v_ch,$no_mch,$date_mch
	,$v_bar,$amp,$t_faz,$v_gaz,$v_tas,$no_tas,$v_tah,$v_rd,$add_abadi,$add_city);
alert ('اطلاعات واحد صنعتی با موفقیت تصحیح شد ') ;

?>
<form name="myform" class="myform" method="post" action="list_ind_unit.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
}
 else 
 // if the form hasn't been submitted, display the form 
{ 
renderForm($date_s,$mor_cod_m,$id_ostan,$id_city,$id_mar,$bah_cod_m,$num_bah,$unit_name,$m_zamin
	,$m_zmos,$lng,$lat,$no_mal,$m_cod_m,$no_pta,$date_pta,$no_pb,$date_pb,$v_ab,$g_en,$v_ch,$no_mch,$date_mch
	,$v_bar,$amp,$t_faz,$v_gaz,$v_tas,$no_tas,$v_tah,$v_rd,$add_abadi,$add_city);
}
}
else 
{
?>
<script>
window.location.href='list_ind_unit.php';
</script>
<?php
}
?>
</p></td>
</tr>
</table></body>
</html>