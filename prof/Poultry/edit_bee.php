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
$query = "SELECT * from bee where bah_cod_m =:bah_cod_m and id=:id"; 
$stmt = $dbh->prepare($query);
$stmt->execute(array(':bah_cod_m'=>$bah_cod_m,':id'=>$id));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
 $row['User_Name'] ; 
 $bah_cod_m = $row['bah_cod_m']; 
 $add_city = $row['add_city'] ;
 $add_abadi = $row['add_abadi'] ;
 $id_ostan = $row['id_ostan'] ;
 $id_city = $row['id_city'] ;
 $id_mar = $row['id_mar'] ;
 $no_zan = $row['no_zan'] ;
 $bem_zan = $row['bem_zan'] ;
 $bem_kand = $row['bem_kand'] ;
 $sh_zan = $row['sh_zan'] ;
 $oz_tav = $row['oz_tav'] ;
 $m_ostan = $row['m_ostan'] ;
 $m_city = $row['m_city'] ;
 $no_mo = $row['no_mo'] ;
 $t_sha = $row['t_sha'] ;
 $tm_kh = $row['tm_kh'] ;
 $tm_kkh = $row['tm_kkh'] ;
 $tm_arz = $row['tm_arz'] ;
 $tk_mo = $row['tk_mo'] ;
 $tk_bo = $row['tk_bo'] ;
 $to_mo = $row['to_mo'] ;
 $to_bo = $row['to_bo'] ;
 $t_jel = $row['t_jel'] ;
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
 $m_nejad     = $row['m_nejad'] ;

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
           <p class="style8">ویرایش اطلاعات زنبورستان  جدید</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
	<?php sar_data2($bah_cod_m,$num_bah) ;?>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" ><form action="" method="post" id="form1" name="form1">
    <br />
      <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <td height="28" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>محل استقرار زنبورستان</strong></div></td>
        </tr>
        <tr>
          <td width="37%" height="30" bgcolor="#CCCCCC"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?></div></td>
          <td width="17%" bgcolor="#CCCCCC"><div align="right">:شهرستان</div></td>
          <td width="2%" bgcolor="#CCCCCC">&nbsp;</td>
          <td width="23%" bgcolor="#CCCCCC"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="21%" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="43" bgcolor="#CCCCCC"><div align="right"><?php echo abadi_name($add_abadi),shahr_name($add_city); ?></div></td>
          <td bgcolor="#CCCCCC"><div align="right">: آبادی / شهر</div></td>
          <td bgcolor="#CCCCCC">&nbsp;</td>
          <td bgcolor="#CCCCCC"><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td bgcolor="#CCCCCC"><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td  height="48"><div align="right"  > <span class="style2">نفر</span>
            <input name="t_sha" type="text" class="input_text  required digits" id="t_sha" style="width:50px; height:30px ; " tabindex="2" dir="rtl" lang="fa" value="<?php echo $t_sha ; ?>" maxlength="20"  align="baseline" xml:lang="fa" />
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
          <td height="48" bgcolor="#FFFFFF"><div align="right"  >
            <input name="sh_zan" type="text" class="input_text" id="sh_zan" style="width:150px; height:30px ; " tabindex="6" dir="rtl" lang="fa" value="<?php echo $sh_zan ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
            </div></td>
          <td bgcolor="#FFFFFF"><div align="right">:شماره پروانه زنبورداری<br />
            </div></td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right">
            <select name="oz_tav" class="input_text  required" id="oz_tav"  style="height:40px ; width:120px ; direction:rtl" tabindex="5">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($oz_tav=="1") echo "selected='selected'"?>>بلی</option>
              <option value="2"<?php if($oz_tav=="2") echo "selected='selected'"?>>خیر</option>
              </select>
            </div></td>
          <td><div style="margin-right:30px" align="right" >: عضویت در تعاونی</div></td>
        </tr>
<?php if($no_zan=='1') {?>
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
        <?php } if ($no_zan=='2'){  ?>
        <tr>
          <td height="24" colspan="5" bgcolor="#FFFFCC" dir="rtl"><div align="right" class="style8" style="margin-right:30px"> وضعیت کوچ</div></td>
        </tr>
        <tr>
          <td height="42"><div align="right">
            <select  name="m_city" class="target required  input_text mar" id="cod_mah" style="width:140px ; height:40px" tabindex="9" dir="rtl">
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
            </select>
          </div></td>
          <td><div align="right">: شهرستان مبداء</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select  name="m_ostan" class="input_text required country" id="m_ostan" style="width:170px ; height:40px" tabindex="8" dir="rtl" >
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
          <td height="36" colspan="2"><div align="right" class="style2">شماره مجوز را برای زنبورستان های فاقد مجوز 0 وارد کنید </div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="no_mo" type="text" class="input_text  required" style="width:150px; height:30px ; " tabindex="10" dir="rtl"  value="<?php echo $no_mo ; ?>" maxlength="35" xml:lang="fa" />
            </div></td>
          <td><div style="margin-right:30px" align="right">: شماره مجوز</div></td>
        </tr>
        <tr>
          <td height="32" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> : اطلاعات ملکه</div></td>
        </tr>
        <tr>
          <td height="46">&nbsp;</td>
          <td>&nbsp;</td>
          <td height="46" bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right">
            <select name="m_nejad" class="input_text  required" id="m_nejad"  style="height:40px ; width:120px ; direction:rtl" tabindex="10">
              <option value="">انتخاب کنید</option>
              <option value="1"<?php if($m_nejad=="1") echo "selected='selected'"?>>ایرانی</option>
              <option value="2"<?php if($m_nejad=="2") echo "selected='selected'"?>>کارنیکا</option>
              <option value="3"<?php if($m_nejad=="3") echo "selected='selected'"?>>قفقازی</option>
              <option value="4"<?php if($m_nejad=="4") echo "selected='selected'"?>>ایتالیایی</option>
              <option value="5"<?php if($m_nejad=="5") echo "selected='selected'"?>>سایر</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right" >:نژاد ملکه</div></td>
        </tr>
        <tr>
          <td height="39"><div align="right">
            <input name="tm_arz" type="text" class="t_kb input_text  required digits" id="tm_arz" style="width:50px; height:30px ; " tabindex="13" dir="rtl" lang="fa" value="<?php echo $tm_arz ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div align="right">:تعداد ملکه عرضه شده</div></td>
          <td height="37" bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right">
            <input name="tm_kh" type="text" class="t_km input_text  required digits" id="tm_kh3" style="width:50px; height:30px ; " tabindex="11" dir="rtl" lang="fa" value="<?php echo $tm_kh ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >:  تعداد ملکه خود مصرفی</div></td>
        </tr>
        <tr>
          <td height="47">&nbsp;</td>
          <td>&nbsp;</td>
          <td height="47" bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right">
            <input name="tm_kkh" type="text" class="t_km input_text  required digits" id="tm_kkh3" style="width:50px; height:30px ; " tabindex="12" dir="rtl" lang="fa" value="<?php echo $tm_kkh ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >: تعداد ملکه خریداری شده</div></td>
        </tr>
        <tr>
          <td height="44" bgcolor="#CCCCCC">&nbsp;</td>
          <td height="44" bgcolor="#CCCCCC">&nbsp;</td>
          <td height="44" bgcolor="#CCCCCC">&nbsp;</td>
          <td height="44" bgcolor="#CCCCCC"><div align="right"> <span class="style8">کیلوگرم</span>
            <input name="m_shaker" type="text" class="t_km input_text  required number" id="m_shaker" style="width:70px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $m_shaker ; ?>" maxlength="7" xml:lang="fa"/>
          </div></td>
          <td height="44" bgcolor="#CCCCCC"><div style="margin-right:30px" align="right" >: میزان مصرف سالانه شکر</div></td>
        </tr>
        <tr>
          <td height="31" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> : کندو</div></td>
        </tr>
        <?php } ?>
         <tr>
           <td height="42"><div align="right">
             <input name="tk_bo" type="text" class="t_kb input_text  required digits" id="tk_bo" style="width:100px; height:30px ; " tabindex="15" dir="rtl" lang="fa" value="<?php echo $tk_bo ; ?>" maxlength="11" xml:lang="fa"/>
             </div></td>
           <td><div align="right">:تعداد سنتی </div></td>
           <td>&nbsp;</td>
           <td><div align="right">
             <input name="tk_mo" type="text" class="t_km input_text  required digits" id="tk_mo" style="width:100px; height:30px ; " tabindex="14" dir="rtl" lang="fa" value="<?php echo $tk_mo ; ?>" maxlength="11" xml:lang="fa"/>
             </div></td>
           <td><div style="margin-right:30px" align="right" >: تعداد  مدرن</div></td>
         </tr>
         <tr>
           <td height="36" colspan="5"><div class="style9" style="margin-right:30px ; direction:rtl"><img src="../../files/attention.gif" width="44" height="46"  alt=""/> منظور از میزان تولید : کل تولید زنبورستان  است نه میانگین تولید  کندو </div></td>
         </tr>
         <tr>
          <td height="36" colspan="5" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> میزان تولید عسل</div></td>
          </tr>
        <tr>
          <td height="38"><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="to_bo" type="text" class="tokb input_text  required number" id="to_bo" style="width:100px; height:30px ; " tabindex="17" dir="rtl" lang="fa" value="<?php echo $to_bo ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div align="right">: سنتی</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="to_mo" type="text" class="tokm input_text  required number" id="to_mo" style="width:100px; height:30px ; " tabindex="16" dir="rtl" lang="fa" value="<?php echo $to_mo ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >:مدرن</div></td>
        </tr>
        <tr>
          <td height="32" colspan="2" align="center" bgcolor="#FFFFCC"><span class="style19">دقت فرمایید : واحد ژله رویال و زهر تولیدی ، گرم میباشد </span></td>
          <td height="32" align="center" bgcolor="#FFFFCC">&nbsp;</td>
          <td height="32" align="center" bgcolor="#FFFFCC">&nbsp;</td>
          <td height="32" align="center" bgcolor="#FFFFCC"><div align="right" class="style8" style="margin-right:30px"> : میزان تولیدات جانبی</div></td>
        </tr>
        <tr>
          <td height="39"><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="t_bar" type="text" class="tobar input_text  required number" id="t_bar" style="width:100px; height:30px ; " tabindex="19" dir="rtl" lang="fa" value="<?php echo $t_bar ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div align="right">: بره موم</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="t_gar" type="text" class="togar input_text  required number" id="t_gar" style="width:100px; height:30px ; " tabindex="18" dir="rtl" lang="fa" value="<?php echo $t_gar ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >:گرده</div></td>
        </tr>
        <tr>
          <td height="47"><div align="right"> <span class="style10">گرم</span>
            <input name="t_zah" type="text" class="tozah input_text  required number" id="t_zah" style="width:100px; height:30px ; " tabindex="21" dir="rtl" lang="fa" value="<?php echo $t_zah ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div align="right">: زهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <span class="style2">کیلوگرم</span>
            <input name="t_mom" type="text" class="tomom input_text  required number" id="t_mom" style="width:100px; height:30px ; " tabindex="20" dir="rtl" lang="fa" value="<?php echo $t_mom ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >:موم</div></td>
        </tr>
        <tr>
          <td height="47" bgcolor="#FFFFFF"><div align="right"><span class="style10">گرم</span>
            <input name="t_jel" type="text" class="tojel input_text  required number" id="t_jel" style="width:100px; height:30px ; " tabindex="23" dir="rtl" lang="fa" value="<?php echo $t_jel ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td height="47" bgcolor="#FFFFFF"><div align="right">: ژله رویال</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="t_k_jel" type="text" class="tkjel input_text  required digits" id="t_k_jel" style="width:100px; height:30px ; " tabindex="22" dir="rtl" lang="fa" value="<?php echo $t_k_jel ; ?>" maxlength="11" xml:lang="fa"/>
          </div></td>
          <td><div style="margin-right:30px" align="right" >:تعداد کلنی تولید کننده ژل رویال</div></td>
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
<form  name="myform" class="myform" method="post" action="manager_bee.php">
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
<form  name="myform" class="myform" method="post" action="manager_bee.php">
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
 $e_ostan    = $_POST['e_ostan'] ;
 $g_ostan    = $_POST['g_ostan'] ;
 $vaz_zan    = $_POST['vaz_zan'] ;
 $m_shaker   = $_POST['m_shaker'] ;
 $t_k_jel    = $_POST['t_k_jel'] ;
 $m_nejad     = $_POST['m_nejad'] ;
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
$tm_kkh = $_POST['tm_kkh'] ;
$tm_arz = $_POST['tm_arz'] ;
$tk_mo = $_POST['tk_mo'] ;
$tk_bo = $_POST['tk_bo'] ;
$to_mo = $_POST['to_mo'] ;
$to_bo = $_POST['to_bo'] ;
$t_jel = $_POST['t_jel'] ;
$t_mom = $_POST['t_mom'] ;
$t_bar = $_POST['t_bar'] ;
$t_gar = $_POST['t_gar'] ;
$t_zah = $_POST['t_zah'] ;
$id = $_POST['id'] ;
// تعریف متغیرهای که هنگام لود فرم خالی رد میشن
if ($no_zan=='1') {$m_ostan = '-' ; $m_city='-'; $no_mo='-';}

$query = "UPDATE  bee SET bem_zan=? ,bem_kand=?,sh_zan=?,t_sha=?,m_ostan=?,m_city=?,no_mo=?,tm_kh=?,tm_kkh=?,tm_arz=?,tk_mo=?
,tk_bo=?,to_mo=?,to_bo=?,t_gar=?,t_bar=?,t_mom=?,t_jel=?,oz_tav=?,t_zah=?,e_ostan=?,g_ostan=?,vaz_zan=?,m_shaker=?,t_k_jel=?,m_nejad=?
 WHERE bah_cod_m=? and id=?" ;
$q = $dbh->prepare($query);
$q->execute(array($bem_zan,$bem_kand,$sh_zan,$t_sha,$m_ostan,$m_city,$no_mo,$tm_kh,$tm_kkh,$tm_arz,$tk_mo,$tk_bo,$to_mo,$to_bo,$t_gar,$t_bar,$t_mom,$t_jel,$oz_tav,$t_zah
,$e_ostan,$g_ostan,$vaz_zan,$m_shaker,$t_k_jel,$m_nejad
,$bah_cod_m,$id));

 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ویرایش اطلاعات زنبورستان - '.$bah_cod_m) ; 

unset($cod_sh,$bem_zan,$bem_kand,$sh_zan,$t_sha,$m_ostan,$m_city,$no_mo,$tm_kh,$tm_kkh,$tm_arz,$tk_mo,$tk_bo,$to_mo,$to_bo,$t_gar,$t_bar,$t_mom,$t_jel,$t_zah);
?>
<form  name="myform4" class="myform" method="post" action="manager_bee.php">
     <input type="hidden" name="action" value='true'/>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="com_alert" value="اطلاعات زنبورستان با موفقیت تصحیح شد">

</form>
<script type="text/javascript">document.myform4.submit();</script>
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
                alert("خطا :  \n \n  میزان تولید  ژله رویال بیشتر از حد مجاز میباشد !! تعداد کلنی تولید کننده ژل رویال و یا میزان تولید ژل رویال را کنترل کنید  ");
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
                alert("خطا :  \n \n  میزان تولید   زهر بیشتر از حد مجاز میباشد ، تعداد کندو و میزان زهر را کنترل کنید  ");
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


    </script>
