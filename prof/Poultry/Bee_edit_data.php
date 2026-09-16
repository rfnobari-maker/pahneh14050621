<?php
include('../../lock_p1.php');
include('../../event.php');
require_once('../../Jalali.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
if  (isset($_POST['bah_cod_m']))
{
include('../../login/config.php');
$bah_cod_m = $_POST['bah_cod_m'];
$id = $_POST['id'];
$add_abadi = $_POST["add_abadi"]; 
$add_city = $_POST["add_city"]; 
$bah_cod_m = $_POST['bah_cod_m'];
$no_zan = $_POST['no_zan'];
$m_zan = $_POST['m_poul'];

$num_bah = $_POST['num_bah'];

if ($m_zan=='abadi') {
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
if  ($m_zan=='shahr') {

 $query = "SELECT add_city,id_ostan,id_mar,id_city from list_city where add_city = :add_city"; 
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

$query = "SELECT * from bee where bah_cod_m =:bah_cod_m and id=:id"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':id'=>$id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $row['User_Name'] ; 
 $bah_cod_m = $row['bah_cod_m']; 
 $id_ostan = $row['id_ostan'] ;
 $id_city = $row['id_city'] ;
 $id_mar = $row['id_mar'] ;
 $lat = $row['lat'] ;
 $lng = $row['lng'] ;
 $bem_zan = $row['bem_zan'] ;
 $bem_kand = $row['bem_kand'] ;
 $sh_zan = $row['sh_zan'] ;
 $oz_tav = $row['oz_tav'] ;
 $m_ostan = $row['m_ostan'] ;
 $m_city = $row['m_city'] ;
 $no_mo = $row['no_mo'] ;
 $t_sha = $row['t_sha'] ;
 $tm_kh = $row['tm_kh'] ;

 $m_nejad1   = $row['m_nejad1'] ;
 $m_nejad2   = $row['m_nejad2'] ;
 $m_nejad3   = $row['m_nejad3'] ;
 $m_nejad4   = $row['m_nejad4'] ;
 $m_nejad5   = $row['m_nejad5'] ;

 $mk_nejad1   = $row['mk_nejad1'] ;
 $mk_nejad2   = $row['mk_nejad2'] ;
 $mk_nejad3   = $row['mk_nejad3'] ;
 $mk_nejad4   = $row['mk_nejad4'] ;
 $mk_nejad5   = $row['mk_nejad5'] ;

 $tmk_nejad1   = $row['tmk_nejad1'] ;
 $tmk_nejad2   = $row['tmk_nejad2'] ;
 $tmk_nejad3   = $row['tmk_nejad3'] ;
 $tmk_nejad4   = $row['tmk_nejad4'] ;
 $tmk_nejad5   = $row['tmk_nejad5'] ;


 $tm_arz = $row['tm_arz'] ;
 $tk_mo = $row['tk_mo'] ;
 $tk_bo = $row['tk_bo'] ;
 $to_mo = $row['to_mo'] ;
 $to_bo = $row['to_bo'] ;
 $t_jel = $row['t_jel'] ;
 $t_nan = $row['t_nan'] ;
 $t_mom = $row['t_mom'] ;
 $t_bar = $row['t_bar'] ;
 $t_gar = $row['t_gar'] ;
 $t_zah = $row['t_zah'] ;
 $num_bah = $row['num_bah'] ;
 $e_ostan    = $row['e_ostan'] ;
 $g_ostan    = $row['g_ostan'] ;
 $vaz_zan    = $row['vaz_zan'] ;
 $m_shaker   = $row['m_shaker'] ;
 $t_k_jel    = $row['t_k_jel'] ;
 $t_k_nan    = $row['t_k_nan'] ;
 $tal_h_sam = $row['tal_h_sam'] ;
 $tal_h_sel = $row['tal_h_sel'] ;
 $tal_h_hv = $row['tal_h_hv'] ;
 $tal_h_kh = $row['tal_h_kh'] ;
 $tal_h_s = $row['tal_h_s'] ;
 
$tal_b_var = $row['tal_b_var'] ;
$tal_b_noz = $row['tal_b_noz'] ;
$tal_b_ccd = $row['tal_b_ccd'] ;
$tal_b_lav =$row['tal_b_lav'] ;
$tal_b_s = $row['tal_b_s'] ;

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
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $(".country").change(function()
                {
                    var id=$(this).val();
                    var dataString = 'group_cod='+ id;
                    $.ajax
                    ({
                        type: "POST",
                        url: "ajax_ostan.php",
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
</head>
<body onLoad="Fun_load()">
     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../files/images/header.jpg" width="100%" height="130" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>

  </tr>
  <tr>
    <td>
      <?php include('top.php'); ?>
           <p class="style8">ویرایش اطلاعات زنبورستان  <br />
           <img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
           <?php sar_data2($bah_cod_m,$num_bah) ;?>
    </p>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
             
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><form action="" method="post" id="form1" name="form1">
    <br />
    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;" >
      <tr>
        <td height="28" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>محل استقرار  زنبورستان</strong></div></td>
      </tr>
      <tr>
        <td width="31%" height="30" bgcolor="#CCCCCC"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?></div></td>
        <td width="20%" bgcolor="#CCCCCC"><div align="right">:شهرستان</div></td>
        <td width="5%" bgcolor="#CCCCCC">&nbsp;</td>
        <td width="23%" bgcolor="#CCCCCC"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
        <td width="21%" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: استان</div></td>
      </tr>
      <tr>
        <td height="36" bgcolor="#CCCCCC"><div align="right"><?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
        <td bgcolor="#CCCCCC"><div align="right">: آبادی / شهر</div></td>
        <td bgcolor="#CCCCCC">&nbsp;</td>
        <td bgcolor="#CCCCCC"><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
        <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
      </tr>
      <tr>
        <td height="55"><div align="right"> <span class="style2">درجه اعشار</span>
          <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php if(isset($lat)) echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
          <br />
          <span class="style8">37.010521: مثال</span></div></td>
        <td><div align="right">:Y عرض جغرافیایی</div></td>
        <td>&nbsp;</td>
        <td><div align="right"><span class="style2">درجه اعشار</span>
          <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php if(isset($lng)) echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
          <br />
          <span class="style8">46.212486: مثال</span></div></td>
        <td><div style="margin-right:30px" align="right" >:X طول جغرافیایی </div></td>
      </tr>
      <tr>
        <td  height="55"><div align="right"  > <span class="style2">نفر</span>
          <input name="t_sha" type="text" class="input_text  required digits" id="t_sha" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $t_sha ; ?>" maxlength="2"  align="baseline" xml:lang="fa" />
          </div></td>
        <td ><div align="right">:تعداد افراد شاغل<br />
          <span class="style2">به غیر از خود بهره بردار</span></div></td>
        <td  bgcolor="#FFFFFF">&nbsp;</td>
        <td  bgcolor="#FFFFFF"><div align="right">
          <select name="vaz_zan" class="input_text  required" id="vaz_zan"  style="height:40px ; width:120px ; direction:rtl" tabindex="1">
            <option value="">انتخاب کنید</option>
            <option value="1" <?php if($vaz_zan=="1") echo "selected='selected'"?>>شغل اصلی</option>
            <option value="2" <?php if($vaz_zan=="2") echo "selected='selected'"?>>شغل فرعی</option>
            </select>
          </div></td>
        <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: زنبورداری بعنوان</div></td>
      </tr>
      <tr>
        <td height="40" bgcolor="#FFFFFF"><div align="right">
          <select name="bem_kand" class="input_text  required" id="bem_kand"  style="height:40px ; width:120px ; direction:rtl" tabindex="4">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($bem_kand=="1") echo "selected='selected'"?>>دارد</option>
              <option value="2"<?php if($bem_kand=="2") echo "selected='selected'"?>>ندارد</option>
          </select>
        </div></td>
        <td bgcolor="#FFFFFF"><div align="right">:وضعیت بیمه کندوها<br />
        </div></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF"><div align="right">
          <select name="bem_zan" class="input_text  required" id="bem_zan"  style="height:40px ; width:120px ; direction:rtl" tabindex="3">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($bem_zan=="1") echo "selected='selected'"?>>بیمه زنبورداری</option>
              <option value="2"<?php if($bem_zan=="2") echo "selected='selected'"?>>سایر بیمه ها</option>
              <option value="3"<?php if($bem_zan=="3") echo "selected='selected'"?>>ندارد</option>
              </select>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نوع بیمه زنبوردار</div></td>
      </tr>
      <tr>
        <td height="47" bgcolor="#FFFFFF"><div align="right"  >
          <input name="sh_zan" type="text" class="input_text digits" id="sh_zan" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $sh_zan ; ?>" maxlength="10"  align="baseline" xml:lang="fa" />
        </div></td>
        <td bgcolor="#FFFFFF"><div align="right">:شماره مجوز شناسنامه زنبورداری<br />
            <span class="style2">در صورت عدم مجوز 0 وارد شود</span> <br />
        </div></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td bgcolor="#FFFFFF"><div align="right">
           <select name="oz_tav" class="input_text  required" id="oz_tav"  style="height:40px ; width:120px ; direction:rtl" tabindex="5">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($oz_tav=="1") echo "selected='selected'"?>>بلی</option>
              <option value="2"<?php if($oz_tav=="2") echo "selected='selected'"?>>خیر</option>
              </select>
        </div></td>
        <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >: عضویت در تعاونی</div></td>
      </tr>
      <?php if ($no_zan=='1'){  ?>
      <tr>
        <td height="28" colspan="5" bgcolor="#FFFFCC" dir="rtl"><div align="right" class="style8" style="margin-right:30px"> استان های محل کوچ :</div></td>
      </tr>
      <tr>
        <td height="49" bgcolor="#FFFFFF" dir="rtl"><div align="right">
          <select  name="g_ostan" class="input_text required country" id="g_ostan" style="width:170px ; height:40px" tabindex="8" dir="rtl" >
            <option value="">انتخاب استان</option>
            <?php
$query = "SELECT id_ostan,ostan FROM `ostanname` ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$g_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
          </select>
        </div></td>
        <td height="49" bgcolor="#FFFFFF" dir="rtl"><div align="right">قشلاق : </div></td>
        <td height="49" bgcolor="#FFFFFF" dir="rtl">&nbsp;</td>
        <td height="49" bgcolor="#FFFFFF" dir="rtl"><div align="right">
          <select  name="e_ostan" class="input_text required country" id="e_ostan" style="width:170px ; height:40px" tabindex="7" dir="rtl" >
            <option value="">انتخاب استان</option>
            <?php
$query = "SELECT id_ostan,ostan FROM `ostanname` ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$e_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
          </select>
        </div></td>
        <td height="49" bgcolor="#FFFFFF" dir="rtl"><div style="margin-right:30px" align="right">ییلاق : </div></td>
      </tr>
      <?php  } if ($no_zan=='2'){  ?>
      <tr>
        <td height="28" colspan="5" bgcolor="#FFFFCC" dir="rtl"><div align="right" class="style8" style="margin-right:30px"> وضعیت کوچ :</div></td>
      </tr>
      <tr>
        <td height="56"><select  name="m_city" class="target required  input_text mar" id="cod_mah" style="width:140px ; height:40px" tabindex="9" dir="rtl">
              <?php
	  $query = "SELECT  id_city,city FROM `cityname` WHERE  `id_ostan` = '$m_ostan' " ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
              <option value="<?php  echo $row['id_city'] ;?>"
   <?php if ($row['id_city']==$m_city) echo 'selected=selected'?>>
                <?php  echo $row['city'] ;?>
                </option>
              <?php
}
?>
            </select></td>
        <td><div align="right">: شهرستان مبداء</div></td>
        <td>&nbsp;</td>
        <td><div align="right">
          <select  name="m_ostan" class="input_text required country" id="m_ostan" style="width:170px ; height:40px" tabindex="7" dir="rtl" >
            <option value="">انتخاب استان</option>
            <?php
$query = "SELECT id_ostan,ostan FROM `ostanname` ORDER BY BINARY ostan "  ;
$stmt = $dbh->prepare($query);
$stmt->execute();
foreach($stmt as $row){
?>
            <option value="<?php echo $row['id_ostan'] ;?>"
   <?php if ($row['id_ostan']==$m_ostan) echo 'selected=selected'?>> <?php echo $row['ostan'] ;?></option>
            <?php 
		   }?>
          </select>
        </div></td>
        <td><div style="margin-right:30px" align="right">: استان مبداء</div></td>
      </tr>
      <tr>
        <td height="44" colspan="3"><div align="right" class="style2"> <span class="style8">شماره مجوز را برای زنبورستان های فاقد مجوز کوچ ،  صفر وارد کنید</span></div></td>
        <td><div align="right">
          <input name="no_mo" type="text" class="input_text  required" style="width:150px; height:30px ; " tabindex="9" dir="rtl"  value="<?php echo $no_mo ; ?>" maxlength="35" xml:lang="fa" />
        </div></td>
        <td><div style="margin-right:30px" align="right">: شماره مجوز</div></td>
      </tr>
      <?php } ?>
      <tr>
        <td height="32" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> : اطلاعات ملکه موجود</div></td>
      </tr>
      <tr>
        <td dir="rtl" height="46" colspan="4"><div style=" margin-left:15px ;  width:85% ; display: flex;  flex-direction: row ; justify-content:space-between ">
<div><input name="m_nejad1" type="checkbox" tabindex="10" <?php if($m_nejad1=='1') echo "checked='checked'";?> value="1"/>
            ایرانی</div>
<div><input name="m_nejad2" type="checkbox" tabindex="11" <?php if($m_nejad2=='1') echo "checked='checked'";?> value="1"/>
            کارنیکا</div>
<div><input name="m_nejad3" type="checkbox" tabindex="12" <?php if($m_nejad3=='1') echo "checked='checked'";?> value="1"/>
            قفقازی</div>
<div><input name="m_nejad4" type="checkbox" tabindex="13" <?php if($m_nejad4=='1') echo "checked='checked'";?> value="1"/>
            ایتالیایی</div>
<div><input name="m_nejad5" type="checkbox" tabindex="14" <?php if($m_nejad5=='1') echo "checked='checked'";?> value="1"/>
            سایر</div>
        </div></td>
        <td><div style="margin-right:30px" align="right" >:نژاد ملکه </div></td>
      </tr>
      <tr>
        <td height="32" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> : اطلاعات ملکه تولیدی</div></td>
      </tr>
      <tr>
        <td height="47"><div align="right">
          <input name="tm_arz" type="text" class="t_kb input_text  required digits" id="tm_arz" style="width:50px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $tm_arz ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td><div align="right">:تعداد  عرضه شده</div></td>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td><div align="right">
          <input name="tm_kh" type="text" class="t_km input_text  required digits" id="tm_kh" style="width:50px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $tm_kh ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td><div style="margin-right:30px" align="right" >:  تعداد  خود مصرفی</div></td>
      </tr>
      <tr>
        <td height="32" colspan="5" bgcolor="#FFFFCC" dir="rtl"><div align="right" class="style8" style="margin-right:30px"> اطلاعات ملکه خریداری شده :</div></td>
      </tr>
      <tr>
        <td height="50" colspan="4" dir="rtl"><div style=" margin-left:65px ;  width:85% ; display: flex;  flex-direction: row ; justify-content:space-between ">
<div><input name="mk_nejad1" type="checkbox" id="mk_nejad1" tabindex="17"<?php if($mk_nejad1=='1') echo "checked='checked'";?> onclick="Fun_nejad1()"  value="1" />
           ایرانی </div>
<div><input name="mk_nejad2" type="checkbox" id="mk_nejad2" tabindex="19"<?php if($mk_nejad2=='1') echo "checked='checked'";?> onclick="Fun_nejad2()"  value="1" />
            کارنیکا</div>
<div><input name="mk_nejad3" type="checkbox" id="mk_nejad3" tabindex="21"<?php if($mk_nejad3=='1') echo "checked='checked'";?> onclick="Fun_nejad3()"  value="1" />
            قفقازی</div>
<div><input name="mk_nejad4" type="checkbox" id="mk_nejad4" tabindex="23"<?php if($mk_nejad4=='1') echo "checked='checked'";?> onclick="Fun_nejad4()"  value="1" />
            ایتالیایی</div>
<div><input name="mk_nejad5" type="checkbox" id="mk_nejad5" tabindex="25"<?php if($mk_nejad5=='1') echo "checked='checked'";?> onclick="Fun_nejad5()"  value="1" />
            سایر</div>
        </div></td>
        <td><div style="margin-right:30px" align="right" >: نژاد و تعداد  </div></td>
      </tr>
      <tr>
        <td dir="rtl" colspan="4"><div style=" margin-left:65px ;  width:85% ; display: flex;  flex-direction: row ; justify-content:space-between ">
          <div>
            <input class="input_text digits" maxlength="4" id="tmk_nejad1" type="text" value="<?php echo $tmk_nejad1 ;?>"name="tmk_nejad1" placeholder="تعداد" style="width:45px ; height:25px ;  display:none" tabindex="18" />
          </div>
          <div>
            <input class="input_text digits" maxlength="4" id="tmk_nejad2" type="text" value="<?php echo $tmk_nejad2 ;?>"name="tmk_nejad2" placeholder="تعداد" style="width:45px ; height:25px ; display:none"  tabindex="20" />
          </div>
          <div>
            <input class="input_text digits" maxlength="4" id="tmk_nejad3" type="text" value="<?php echo $tmk_nejad3 ;?>"name="tmk_nejad3" placeholder="تعداد" style="width:45px ; height:25px ; display:none"  tabindex="22" />
          </div>
          <div>
            <input class="input_text digits" maxlength="4" id="tmk_nejad4" type="text" value="<?php echo $tmk_nejad4 ;?>"name="tmk_nejad4" placeholder="تعداد" style="width:45px ; height:25px ; display:none"  tabindex="24"/>
          </div>
          <div>
            <input class="input_text digits" maxlength="4" id="tmk_nejad5" type="text" value="<?php echo $tmk_nejad5 ;?>"name="tmk_nejad5" placeholder="تعداد" style="width:45px ; height:25px ; display:none"  tabindex="26"/>
          </div>
        </div></td>
        <td height="36"></td>
      </tr>
      <tr>
        <td height="44" bgcolor="#CCCCCC">&nbsp;</td>
        <td height="44" bgcolor="#CCCCCC">&nbsp;</td>
        <td height="44" bgcolor="#CCCCCC">&nbsp;</td>
        <td height="44" bgcolor="#CCCCCC"><div align="right"> <span class="style8">کیلوگرم</span>
          <input name="m_shaker" type="text" class="input_text  required number" id="m_shaker" style="width:70px; height:30px ; " tabindex="27" dir="rtl" lang="fa" value="<?php echo $m_shaker ; ?>" maxlength="7" xml:lang="fa"/>
        </div></td>
        <td height="44" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right" >: میزان مصرف سالانه شکر</div></td>
      </tr>
      <tr>
        <td height="31" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> : کندو</div></td>
      </tr>
      <tr>
        <td height="39"><div align="right">
          <input name="tk_bo" type="text" class="t_kb input_text  required digits" id="tk_bo" style="width:100px; height:30px ; " tabindex="29" dir="rtl" lang="fa" value="<?php echo $tk_bo ; ?>" maxlength="5" xml:lang="fa"/>
        </div></td>
        <td><div align="right">:تعداد سنتی </div></td>
        <td>&nbsp;</td>
        <td><div align="right">
          <input name="tk_mo" type="text" class="t_km input_text  required digits" id="tk_mo" style="width:100px; height:30px ; " tabindex="28" dir="rtl" lang="fa" value="<?php echo $tk_mo ; ?>" maxlength="5" xml:lang="fa"/>
        </div></td>
        <td><div style="margin-right:30px" align="right" >: تعداد  مدرن</div></td>
      </tr>
      <tr>
        <td height="57" colspan="5"><div class="style9" style="margin-right:30px ; direction:rtl"><img src="../../files/attention.gif" width="34" height="38"  alt=""/> منظور از میزان تولید : کل تولید زنبورستان  است نه میانگین تولید  یک کندو </div></td>
      </tr>
      <tr>
        <td height="30" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> : میزان تولید عسل از </div></td>
      </tr>
      <tr>
        <td height="36"><div align="right"> <span class="style2">کیلوگرم</span>
          <input name="to_bo" type="text" class="tokb input_text  required number" id="to_bo" style="width:100px; height:30px ; " tabindex="31" dir="rtl" lang="fa" value="<?php echo $to_bo ; ?>" maxlength="11" xml:lang="fa"/>
        </div></td>
        <td><div align="right">: سنتی</div></td>
        <td>&nbsp;</td>
        <td><div align="right"> <span class="style2">کیلوگرم</span>
          <input name="to_mo" type="text" class="tokm input_text  required number" id="to_mo" style="width:100px; height:30px ; " tabindex="30" dir="rtl" lang="fa" value="<?php echo $to_mo ; ?>" maxlength="11" xml:lang="fa"/>
        </div></td>
        <td><div style="margin-right:30px" align="right" >:مدرن</div></td>
      </tr>
      <tr>
        <td height="32" colspan="2" align="center" bgcolor="#FFFFCC"><span class="style19">واحد ژل رویال و زهر تولیدی ، گرم میباشد </span></td>
        <td height="32" align="center" bgcolor="#FFFFCC">&nbsp;</td>
        <td height="32" align="center" bgcolor="#FFFFCC">&nbsp;</td>
        <td height="32" align="center" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> : میزان تولیدات جانبی</div></td>
      </tr>
      <tr>
        <td height="39"><div align="right"> <span class="style2">کیلوگرم</span>
          <input name="t_bar" type="text" class="tobar input_text  required number" id="t_bar" style="width:100px; height:30px ; " tabindex="33" dir="rtl" lang="fa" value="<?php echo $t_bar ; ?>" maxlength="11" xml:lang="fa"/>
        </div></td>
        <td><div align="right">: بره موم</div></td>
        <td>&nbsp;</td>
        <td><div align="right"> <span class="style2">کیلوگرم</span>
          <input name="t_gar" type="text" class="togar input_text  required number" id="t_gar" style="width:100px; height:30px ; " tabindex="32" dir="rtl" lang="fa" value="<?php echo $t_gar ; ?>" maxlength="11" xml:lang="fa"/>
        </div></td>
        <td><div style="margin-right:30px" align="right" >:گرده</div></td>
      </tr>
      <tr>
        <td height="47"><div align="right"> <span class="style10">گرم</span>
          <input name="t_zah" type="text" class="tozah input_text  required number" id="t_zah" style="width:100px; height:30px ; " tabindex="35" dir="rtl" lang="fa" value="<?php echo $t_zah ; ?>" maxlength="11" xml:lang="fa"/>
        </div></td>
        <td><div align="right">: زهر</div></td>
        <td>&nbsp;</td>
        <td><div align="right"> <span class="style2">کیلوگرم</span>
          <input name="t_mom" type="text" class="tomom input_text  required number" id="t_mom" style="width:100px; height:30px ; " tabindex="34" dir="rtl" lang="fa" value="<?php echo $t_mom ; ?>" maxlength="11" xml:lang="fa"/>
        </div></td>
        <td><div style="margin-right:30px" align="right" >:موم</div></td>
      </tr>
      <tr>
        <td height="47" bgcolor="#FFFFFF"><div align="right"><span class="style10">گرم</span>
          <input name="t_jel" type="text" class="tojel input_text  required number" id="t_jel" style="width:100px; height:30px ; " tabindex="37" dir="rtl" lang="fa" value="<?php echo $t_jel ; ?>" maxlength="11" xml:lang="fa"/>
        </div></td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">: ژل رویال</div></td>
        <td>&nbsp;</td>
        <td><div align="right">
          <input name="t_k_jel" type="text" class="tkjel input_text  required digits" id="t_k_jel" style="width:100px; height:30px ; " tabindex="36" dir="rtl" lang="fa" value="<?php echo $t_k_jel ; ?>" maxlength="11" xml:lang="fa"/>
        </div></td>
        <td><div style="margin-right:30px; font-size:12px" align="right" >:تعداد کلنی تولید کننده ژل رویال</div></td>
      </tr>
      <tr>
        <td height="47" bgcolor="#FFFFFF"><div align="right"><span class="style2">کیلوگرم</span>
          <input name="t_nan" type="text" class="tonan input_text  required number" id="t_nan" style="width:100px; height:30px ; " tabindex="39" dir="rtl" lang="fa" value="<?php echo $t_nan ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">: نان زنبور</div></td>
        <td>&nbsp;</td>
        <td><div align="right">
          <input name="t_k_nan" type="text" class="tknan input_text  required digits" id="t_k_nan" style="width:100px; height:30px ; " tabindex="38" dir="rtl" lang="fa" value="<?php echo $t_k_nan ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
        <td><div style="margin-right:30px; font-size:12px" align="right" >:تعداد کلنی تولید کننده نان زنبور</div></td>
      </tr>
      <tr>
        <td height="32" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> : تعداد کلنی تلف شده ناشی از حوادث</div></td>
      </tr>
      <tr>
        <td height="47" bgcolor="#FFFFFF"><div align="right">
          <input name="tal_h_sel" type="text" class="input_text  required digits" id="tal_h_sel" style="width:100px; height:30px ; " tabindex="39" dir="rtl" lang="fa" value="<?php echo $tal_h_sel ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">: سیل</div></td>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">
          <input name="tal_h_sam" type="text" class="input_text  required digits" id="tal_h_sam" style="width:100px; height:30px ; " tabindex="38" dir="rtl" lang="fa" value="<?php echo $tal_h_sam ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td height="47" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:سمپاشی</div></td>
      </tr>
      <tr>
        <td height="47" bgcolor="#FFFFFF"><div align="right">
          <input name="tal_h_kh" type="text" class="input_text  required digits" id="tal_h_kh" style="width:100px; height:30px ; " tabindex="41" dir="rtl" lang="fa" value="<?php echo $tal_h_kh ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">: خشکسالی</div></td>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">
          <input name="tal_h_hv" type="text" class="input_text  required digits" id="tal_h_hv" style="width:100px; height:30px ; " tabindex="40" dir="rtl" lang="fa" value="<?php echo $tal_h_hv ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td height="47" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:حمله وحوش</div></td>
      </tr>
      <tr>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">
          <input name="tal_h_s" type="text" class="input_text  required digits" id="tal_h_s" style="width:100px; height:30px ; " tabindex="42" dir="rtl" lang="fa" value="<?php echo $tal_h_s ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td height="47" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:سایر</div></td>
      </tr>
      <tr>
        <td height="29" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> : تعداد کلنی تلف شده ناشی از بیماری</div></td>
      </tr>
      <tr>
        <td height="47" bgcolor="#FFFFFF"><div align="right">
          <input name="tal_b_noz" type="text" class="input_text  required digits" id="t_k_jel9" style="width:100px; height:30px ; " tabindex="44" dir="rtl" lang="fa" value="<?php echo $tal_b_noz ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">: نوزما</div></td>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">
          <input name="tal_b_var" type="text" class="input_text  required digits" id="t_k_jel10" style="width:100px; height:30px ; " tabindex="43" dir="rtl" lang="fa" value="<?php echo $tal_b_var ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td height="47" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:کنه واروآ</div></td>
      </tr>
      <tr>
        <td height="47" bgcolor="#FFFFFF"><div align="right">
          <input name="tal_b_lav" type="text" class="input_text  required digits" id="tal_b_lav" style="width:100px; height:30px ; " tabindex="48" dir="rtl" lang="fa" value="<?php echo $tal_b_lav ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">: لارو میری</div></td>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">
          <input name="tal_b_ccd" type="text" class="input_text  required digits" id="t_k_jel8" style="width:100px; height:30px ; " tabindex="45" dir="rtl" lang="fa" value="<?php echo $tal_b_ccd ; ?>" maxlength="4" xml:lang="fa"/>
          </div></td>
        <td height="47" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:CCD</div></td>
      </tr>
      <tr>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
        <td height="47" bgcolor="#FFFFFF"><div align="right">
          <input name="tal_b_s" type="text" class="input_text  required digits" id="tal_b_s" style="width:100px; height:30px ; " tabindex="46" dir="rtl" lang="fa" value="<?php echo $tal_b_s ; ?>" maxlength="4" xml:lang="fa"/>
        </div></td>
        <td height="47" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right" >:سایر</div></td>
      </tr>
      </table>
    <div align="center">
   <p>
     <input type="hidden" name="no_zan" value=<?php echo $no_zan; ?> />
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="hidden" name="id" value=<?php echo $id; ?> />
     <input type="submit" name="action" value="تصحیح اطلاعات" style="width:150px ; height:45px" tabindex="24" />
</div>
</form> 
</form>
<form  name="myform" class="myform" method="post" action="list_bee.php">
     <input type="hidden" name="action" value='true'/>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="submit" name="action" value="انصراف" style="width:150px ; height:45px" tabindex="25" />
</form> 

  </td>
  </tr>
<?
}
else
{
?>
<form  name="myform" class="myform" method="post" action="list_bee.php">
     <input type="hidden" name="action" value='true'/>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
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
</td>
</tr>
</td>
</table></body>
</body>
</html>
<?php
 if (isset($_POST['action'])) 
 {  
include('../../login/config.php');
 $date_s = $date_edit ;
 $mor_cod_m = $login_session ;
 $bah_cod_m = $_POST['bah_cod_m']; 
 $add_city = $_POST['add_city'] ;
 $add_abadi = $_POST['add_abadi'] ;
 $id_ostan = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ;
 $lng       = $_POST['lng'] ;
 $lat       = $_POST['lat'] ;

 
 $e_ostan    = $_POST['e_ostan'] ;
 $g_ostan    = $_POST['g_ostan'] ;
 $vaz_zan    = $_POST['vaz_zan'] ;
 $m_shaker   = $_POST['m_shaker'] ;
 $t_k_jel    = $_POST['t_k_jel'] ;
 $t_k_nan    = $_POST['t_k_nan'] ;

 $no_zan = $_POST['no_zan'] ;
 $bem_zan = $_POST['bem_zan'] ;
 $bem_kand = $_POST['bem_kand'] ;
$sh_zan = $_POST['sh_zan'] ;
$oz_tav = $_POST['oz_tav'] ;
$m_ostan = $_POST['m_ostan'] ;
$m_city = $_POST['m_city'] ;
$no_mo = $_POST['no_mo'] ;
$t_sha = $_POST['t_sha'] ;
$tm_kh = $_POST['tm_kh'] ;

 $m_nejad1     = $_POST['m_nejad1'] ;
 $m_nejad2     = $_POST['m_nejad2'] ;
 $m_nejad3     = $_POST['m_nejad3'] ;
 $m_nejad4     = $_POST['m_nejad4'] ;
 $m_nejad5     = $_POST['m_nejad5'] ;

if( $m_nejad1 =='')  $m_nejad1 = '0' ; 
if( $m_nejad2 =='')  $m_nejad2 = '0' ; 
if( $m_nejad3 =='')  $m_nejad3 = '0' ; 
if( $m_nejad4 =='')  $m_nejad4 = '0' ; 
if( $m_nejad5 =='')  $m_nejad5 = '0' ; 


$mk_nejad1     = $_POST['mk_nejad1'] ;
 $mk_nejad2     = $_POST['mk_nejad2'] ;
 $mk_nejad3     = $_POST['mk_nejad3'] ;
 $mk_nejad4     = $_POST['mk_nejad4'] ;
 $mk_nejad5     = $_POST['mk_nejad5'] ;

 $tmk_nejad1     = $_POST['tmk_nejad1'] ;
 $tmk_nejad2     = $_POST['tmk_nejad2'] ;
 $tmk_nejad3     = $_POST['tmk_nejad3'] ;
 $tmk_nejad4     = $_POST['tmk_nejad4'] ;
 $tmk_nejad5     = $_POST['tmk_nejad5'] ;

if($mk_nejad1 =='') { $mk_nejad1 = '0' ; $tmk_nejad1 = 0 ; }
if($mk_nejad2 =='') { $mk_nejad2 = '0' ; $tmk_nejad2 = 0 ; }
if($mk_nejad3 =='') { $mk_nejad3 = '0' ; $tmk_nejad3 = 0 ; }
if($mk_nejad4 =='') { $mk_nejad4 = '0' ; $tmk_nejad4 = 0 ; }
if($mk_nejad5 =='') { $mk_nejad5 = '0' ; $tmk_nejad5 = 0 ; }


$tm_arz = $_POST['tm_arz'] ;
$tk_mo = $_POST['tk_mo'] ;
$tk_bo = $_POST['tk_bo'] ;
$to_mo = $_POST['to_mo'] ;
$to_bo = $_POST['to_bo'] ;
$t_jel = $_POST['t_jel'] ;
$t_nan = $_POST['t_nan'] ;


$t_mom = $_POST['t_mom'] ;
$t_bar = $_POST['t_bar'] ;
$t_gar = $_POST['t_gar'] ;
$t_zah = $_POST['t_zah'] ;

$tal_h_sam = $_POST['tal_h_sam'] ;
$tal_h_sel = $_POST['tal_h_sel'] ;
$tal_h_hv = $_POST['tal_h_hv'] ;
$tal_h_kh = $_POST['tal_h_kh'] ;
$tal_h_s = $_POST['tal_h_s'] ;
 
$tal_b_var = $_POST['tal_b_var'] ;
$tal_b_noz = $_POST['tal_b_noz'] ;
$tal_b_ccd = $_POST['tal_b_ccd'] ;
$tal_b_lav = $_POST['tal_b_lav'] ;
$tal_b_s = $_POST['tal_b_s'] ;

$id = $_POST['id'] ;
// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
if ($no_zan=='1') {$m_ostan = '-' ; $m_city='-'; $no_mo='-';}
if ($no_zan=='2') {$e_ostan= '-' ; $g_ostan='-' ; }

$query = "UPDATE  bee SET lat=?,lng=?,no_zan=?,add_abadi=?,add_city=?,bem_zan=? ,bem_kand=?,sh_zan=?,t_sha=?
,m_ostan=?,m_city=?,no_mo=?,tm_kh=?,tm_arz=?,tk_mo=?,tk_bo=?,to_mo=?,to_bo=?,t_gar=?,
t_bar=?,t_mom=?,t_jel=?,t_nan=?,oz_tav=?,t_zah=?,e_ostan=?,g_ostan=?,vaz_zan=?,m_shaker=?,t_k_jel=?,t_k_nan=?
,m_nejad1=?,m_nejad2=?,m_nejad3=?,m_nejad4=?,m_nejad5=?
,mk_nejad1=?,mk_nejad2=?,mk_nejad3=?,mk_nejad4=?,mk_nejad5=?
,tmk_nejad1=?,tmk_nejad2=?,tmk_nejad3=?,tmk_nejad4=?,tmk_nejad5=?
,tal_h_sam=?,tal_h_sel=?,tal_h_hv=?,tal_h_kh=?,tal_h_s=?,tal_b_var=?,tal_b_noz=?,tal_b_ccd=?,tal_b_s=?,tal_b_lav=?
 WHERE bah_cod_m=? and id=?" ;
$q = $dbh->prepare($query);
$q->execute(array($lat,$lng,$no_zan,$add_abadi,$add_city,$bem_zan,$bem_kand,$sh_zan,$t_sha,$m_ostan,$m_city,$no_mo,$tm_kh
,$tm_arz,$tk_mo,$tk_bo,$to_mo,$to_bo,$t_gar,$t_bar,$t_mom,$t_jel,$t_nan,$oz_tav,$t_zah
,$e_ostan,$g_ostan,$vaz_zan,$m_shaker,$t_k_jel,$t_k_nan
,$m_nejad1,$m_nejad2,$m_nejad3,$m_nejad4,$m_nejad5
,$mk_nejad1,$mk_nejad2,$mk_nejad3,$mk_nejad4,$mk_nejad5
,$tmk_nejad1,$tmk_nejad2,$tmk_nejad3,$tmk_nejad4,$tmk_nejad5
,$tal_h_sam,$tal_h_sel,$tal_h_hv,$tal_h_kh,$tal_h_s,$tal_b_var,$tal_b_noz,$tal_b_ccd,$tal_b_s,$tal_b_lav
,$bah_cod_m,$id));

 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ویرایش اطلاعات زنبورستان - '.$bah_cod_m) ; 

unset($cod_sh,$bem_zan,$bem_kand,$sh_zan,$t_sha,$m_ostan,$m_city,$no_mo,$tm_kh,$tm_kkh,$tm_arz,$tk_mo,$tk_bo,$to_mo,$to_bo,$t_gar,$t_bar
,$t_mom,$t_jel,$t_zah,$e_ostan,$g_ostan,$vaz_zan,$m_shaker,$t_k_jel,$m_nejad,$m_nejad1,$m_nejad2,$m_nejad3,$m_nejad4,$m_nejad5
,$tal_h_sam,$tal_h_sel,$tal_h_hv,$tal_h_kh,$tal_h_s,$tal_b_var,$tal_b_noz,$tal_b_ccd,$tal_b_s
);
?>
<<form  name="myform4" class="myform" method="post" action="list_bee.php">
     <input type="hidden" name="action" value='true'/>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="com_alert" value="اطلاعات زنبورستان با موفقیت تصحیح شد">

</form><script type="text/javascript">document.myform4.submit();</script>
<?php
} 
?>
    <script>
        $( ".t_km" ).change(function() {
           $('#to_mo').val('');
		   $('#t_gar').val('');
		   $('#t_mom').val('');
		   $('#t_bar').val('');
     	   $('#t_zah').val('');
       	   $('#t_k_jel').val('');
       	   $('#t_jel').val('');

            var tkm = document.getElementById("tk_mo").value;
        });

        $( ".t_kb" ).change(function() {
		   $('#to_bo').val('');
		   $('#t_gar').val('');
		   $('#t_mom').val('');
		   $('#t_bar').val('');
       	   $('#t_zah').val('');
       	   $('#t_k_jel').val('');
       	   $('#t_jel').val('');
           var tkm = document.getElementById("tk_mo").value;
        });

        $( ".tokm" ).keyup(function() {
            var tkm = document.getElementById("tk_mo").value;
			var tokm = document.getElementById("to_mo").value;
            var mojaz = tkm*60 ;
            if(parseFloat(tokm) > parseFloat(mojaz) )
            {
                alert("خطا :  \n \n  میزان تولید کندوی مدرن بیشتر از حد مجاز میباشد ، تعداد و میزان تولید کندوی مدرن را کنترل کنید  ");
                // پاک کردن سطح برداشت 1
                $('#to_mo').val('');
                document.getElementById("to_mo").focus();
            }
        });

        $( ".tokb" ).keyup(function() {
            var tkb = document.getElementById("tk_bo").value;
			var tokb = document.getElementById("to_bo").value;
            var mojaz = tkb*10 ;
            if(parseFloat(tokb) > parseFloat(mojaz) )
            {
                alert("خطا :  \n \n  میزان تولید کندوی بومی بیشتر از حد مجاز میباشد ، تعداد و میزان تولید کندوی بومی را کنترل کنید  ");
                // پاک کردن سطح برداشت 1
                $('#to_bo').val('');
                document.getElementById("to_bo").focus();
            }
        });

        $( ".togar" ).keyup(function() {
            var tkm = document.getElementById("tk_mo").value;
            var tkb = document.getElementById("tk_bo").value;
			var togar = document.getElementById("t_gar").value;
            var mojaz = (parseInt(tkm)+parseInt(tkb))*2 ;
            if(parseFloat(togar) > parseFloat(mojaz) )
            {
                alert("خطا :  \n \n  میزان تولید گرده بیشتر از حد مجاز میباشد ، تعداد کندو و میزان تولید گرده را کنترل کنید  ");
                // پاک کردن سطح برداشت 1
                $('#t_gar').val('');
                document.getElementById("t_gar").focus();
            }
        });

        $( ".tobar" ).keyup(function() {
            var tkm = document.getElementById("tk_mo").value;
            var tkb = document.getElementById("tk_bo").value;
			var tobar = document.getElementById("t_bar").value;
            var mojaz = (parseInt(tkm)+parseInt(tkb))*0.3 ;
            if(parseFloat(tobar) > parseFloat(mojaz) )
            {
                alert("خطا :  \n \n  میزان تولید بره موم بیشتر از حد مجاز میباشد ، تعداد کندو و میزان تولید برموم را کنترل کنید  ");
                // پاک کردن سطح برداشت 1
                $('#t_bar').val('');
                document.getElementById("t_bar").focus();
            }
        });

        $( ".tomom" ).keyup(function() {
            var tkm = document.getElementById("tk_mo").value;
            var tkb = document.getElementById("tk_bo").value;
			var tomom = document.getElementById("t_mom").value;
            var mojaz = (parseInt(tkm)+parseInt(tkb)) ;
            if(parseFloat(tomom) > parseFloat(mojaz) )
            {
                alert("خطا :  \n \n  میزان تولید موم بیشتر از حد مجاز میباشد ، تعداد کندو و میزان تولید موم را کنترل کنید  ");
                // پاک کردن سطح برداشت 1
                $('#t_mom').val('');
                document.getElementById("t_mom").focus();
            }
        });

        $( ".tojel" ).keyup(function() {
            var tkm = document.getElementById("t_k_jel").value;
			var tojel = document.getElementById("t_jel").value;
            var mojaz = (parseInt(tkm))*2000 ;
            if(parseFloat(tojel) > parseFloat(mojaz) )
            {
                alert("خطا :  \n \n  میزان تولید  ژل رویال بیشتر از حد مجاز میباشد !! تعداد کلنی تولید کننده ژل رویال و یا میزان تولید ژل رویال را کنترل کنید  ");
                // پاک کردن سطح برداشت 1
                $('#t_jel').val('');
                document.getElementById("t_jel").focus();
            }
        });
        $( ".tozah" ).keyup(function() {
            var tkm = document.getElementById("tk_mo").value;
            var tkb = document.getElementById("tk_bo").value;
			var tozah = document.getElementById("t_zah").value;
            var mojaz = (parseInt(tkm)+parseInt(tkb))*20 ;
            if(parseFloat(tozah) > parseFloat(mojaz) )
            {
                alert("خطا :  \n \n  میزان تولید زهر بیشتر از حد مجاز میباشد ، تعداد کندو و میزان زهر را کنترل کنید  ");
                // پاک کردن سطح برداشت 1
                $('#t_zah').val('');
                document.getElementById("t_zah").focus();
            }
        });
        $( ".tkjel" ).keyup(function() {
                $('#t_jel').val('');
            var tkm = document.getElementById("tk_mo").value;
            var tkb = document.getElementById("tk_bo").value;
			var tkjel = document.getElementById("t_k_jel").value;
            var mojaz = (parseInt(tkm)+parseInt(tkb)) ;
            if(parseFloat(tkjel) > parseFloat(mojaz) )
            {
                alert("خطا :  \n \n  تعداد کلنی از مجموع کندوی های سنتی و مدرن بیشتر است ");
                // پاک کردن سطح برداشت 1
                $('#t_k_jel').val('');
                document.getElementById("t_k_jel").focus();
            }
        });

  function Fun_nejad1() {
  var checkBox = document.getElementById("mk_nejad1");
  var tmk_nejad1 = document.getElementById("tmk_nejad1");
  if (checkBox.checked == true){
    tmk_nejad1.style.display = "block";
	tmk_nejad1.classList.add("required");
  } else {
     tmk_nejad1.style.display = "none";
     tmk_nejad1.classList.remove("required");	 
  }
}

  function Fun_nejad2() {
  var checkBox2 = document.getElementById("mk_nejad2");
  var tmk_nejad2 = document.getElementById("tmk_nejad2");
  if (checkBox2.checked == true){
    tmk_nejad2.style.display = "block";
	tmk_nejad2.classList.add("required");
  } else {
     tmk_nejad2.style.display = "none";
     tmk_nejad2.classList.remove("required");	 
  }
}

  function Fun_nejad3() {
  var checkBox3 = document.getElementById("mk_nejad3");
  var tmk_nejad3 = document.getElementById("tmk_nejad3");
  if (checkBox3.checked == true){
    tmk_nejad3.style.display = "block";
	tmk_nejad3.classList.add("required");
  } else {
     tmk_nejad3.style.display = "none";
     tmk_nejad3.classList.remove("required");	 
  }
}

  function Fun_nejad4() {
  var checkBox4 = document.getElementById("mk_nejad4");
  var tmk_nejad4 = document.getElementById("tmk_nejad4");
  if (checkBox4.checked == true){
    tmk_nejad4.style.display = "block";
	tmk_nejad4.classList.add("required");
  } else {
     tmk_nejad4.style.display = "none";
     tmk_nejad4.classList.remove("required");	 
  }
}

  function Fun_nejad5() {
  var checkBox5 = document.getElementById("mk_nejad5");
  var tmk_nejad5 = document.getElementById("tmk_nejad5");
  if (checkBox5.checked == true){
    tmk_nejad5.style.display = "block";
	tmk_nejad5.classList.add("required");
  } else {
     tmk_nejad5.style.display = "none";
     tmk_nejad5.classList.remove("required");	 
  }
}

/////////
  function Fun_load() {
  var checkBox = document.getElementById("mk_nejad1");
  var tmk_nejad1 = document.getElementById("tmk_nejad1");
  if (checkBox.checked == true){
    tmk_nejad1.style.display = "block";
	tmk_nejad1.classList.add("required");
  }
  var checkBox2 = document.getElementById("mk_nejad2");
  var tmk_nejad2 = document.getElementById("tmk_nejad2");
  if (checkBox2.checked == true){
    tmk_nejad2.style.display = "block";
	tmk_nejad2.classList.add("required");
  }
  var checkBox3 = document.getElementById("mk_nejad3");
  var tmk_nejad3 = document.getElementById("tmk_nejad3");
  if (checkBox3.checked == true){
    tmk_nejad3.style.display = "block";
	tmk_nejad3.classList.add("required");
  }
  var checkBox4 = document.getElementById("mk_nejad4");
  var tmk_nejad4 = document.getElementById("tmk_nejad4");
  if (checkBox4.checked == true){
    tmk_nejad4.style.display = "block";
	tmk_nejad4.classList.add("required");
  }
  var checkBox5 = document.getElementById("mk_nejad5");
  var tmk_nejad5 = document.getElementById("tmk_nejad5");
  if (checkBox5.checked == true){
    tmk_nejad5.style.display = "block";
	tmk_nejad5.classList.add("required");
  }
}

    </script>