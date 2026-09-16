<?php
include('../../../lock_p2.php');
include('../../../event.php');
include('../../../date_con.php');
require_once('../../../Jalali.php');
include ('../../../login/config.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
/////////////////////////////////////////////////// 
 if (isset($_POST['action'])) 
 {  
$date_s = $date_edit ;
 $cod_m = $_POST['cod_m']; 
 $add_abadi = $_POST['add_abadi'] ;
 $add_city = $_POST['add_city'] ;
 $id_ostan = $_POST['id_ostan'] ;
 $id_city = $_POST['id_city'] ;
 $id_mar = $_POST['id_mar'] ;
 $cod_sh_m = $_POST['cod_sh_m'] ;
 $jens = $_POST['jens'] ;
 $sal_z = $_POST['sal_z'] ;
 $v_tah = $_POST['v_tah'] ;
 $no_fam = $_POST['no_fam'] ;
 $f_tm = $_POST['f_tm'] ;
 $r_tah = $_POST['r_tah'] ;
 $g_tah = $_POST['g_tah'] ;
 $addres = $_POST['addres'] ;
 $no_oz = $_POST['no_oz'] ;
 $oz_ta = $_POST['oz_ta'] ;
 $name_co = $_POST['name_co'] ;
 $z_fa1 = $_POST['z_fa1'] ;
 $z_fa2 = $_POST['z_fa2'] ;
 $no_ham = $_POST['no_ham'] ;
include('../../../login/config.php');
$query = "INSERT INTO Eworker (date_s,cod_m,id_ostan,id_city,id_mar,add_abadi,add_city,cod_sh_m,jens,sal_z,v_tah,no_fam,f_tm,r_tah,g_tah,addres,no_oz,oz_ta,name_co,z_fa1,z_fa2,no_ham)
      VALUES(:date_s,:cod_m,:id_ostan,:id_city,:id_mar,:add_abadi,:add_city,:cod_sh_m,:jens,:sal_z,:v_tah,:no_fam,:f_tm,:r_tah,:g_tah,:addres,:no_oz,:oz_ta,:name_co,:z_fa1,:z_fa2,:no_ham)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':cod_m'=>$cod_m,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':add_abadi'=>$add_abadi,':add_city'=>$add_city,':cod_sh_m'=>$cod_sh_m,':jens'=>$jens,':sal_z'=>$sal_z,':v_tah'=>$v_tah,':no_fam'=>$no_fam,':f_tm'=>$f_tm,':r_tah'=>$r_tah,':g_tah'=>$g_tah,':addres'=>$addres,':no_oz'=>$no_oz,':oz_ta'=>$oz_ta,':name_co'=>$name_co,':z_fa1'=>$z_fa1,':z_fa2'=>$z_fa2,':no_ham'=>$no_ham));
 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت مددکار ترویجی - '.$cod_m,$id_ostan) ; 
unset($error,$date_s,$cod_m,$id_ostan,$id_city,$id_mar,$add_abadi,$add_city,$cod_sh_m,$jens,$sal_z,$v_tah,$no_fam,$f_tm,$r_tah,$g_tah,$addres,$no_oz,$oz_ta,$name_co,$z_fa1,$z_fa2,$no_ham);
alert ('اطلاعات مددکار ترویجی با موفقیت ثبت شد ') ;
// clos conntection 
$dbh = null;
?>
<form  name="myform" class="myform" method="post" action="index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
 }
 /////////////////////////////////////////////// 
if  (isset($_POST['cod_m']))
{
date_default_timezone_set('Asia/Tehran') ;
$date_s = date_con(jdate("Y/m/d"));
if ($_POST['add_city']!='') {  $add_city = $_POST['add_city'] ; } else  { $add_city = '-'  ; }
if ($_POST['add_abadi']!='') {  $add_abadi = $_POST['add_abadi'] ; } else  { $add_abadi = '-'  ; }
$cod_m = $_POST['cod_m'];
$num_bah = '1' ;
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<link href="../../../FA.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $title ;?></title>
	<script src="../../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
</head>
<body>
     <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
            <td><img src="../../../files/images/header.jpg" width="100%" height="149" /></td>
          </tr>
          <tr>
            <td><?php include('menu.php'); ?>
</td>
  </tr>
  <tr>
    <td>
      <?php include('top.php'); ?>
           <p class="style8">ثبت اطلاعات مدد کار ترویجی / تسهیلگر روستایی<br />
             <img src="../../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/><br />
             <?php sar_data3($cod_m,$num_bah) ;?>
      </br>
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
        <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1">
      <table width="90%" height="245" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
         <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت </strong></div></td>
        </tr>
        <tr>
          <td width="31%" height="40"><div align="right"> <?php echo city_name1($id_city,$id_ostan) ?></div></td>
          <td width="19%"><div align="right">:شهرستان</div></td>
          <td width="1%">&nbsp;</td>
          <td width="31%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="18%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi) , shahr_name($add_city) ; ?></div></td>
          <td><div align="right">:شهر / آبادی</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td height="5" colspan="5">  
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات تکمیلی </strong></div></td>
                </tr>
              <tr>
                <td width="31%" height="58"><div align="right">
                  <select name="jens"  class="input_text mar required" id="jens"  style="height:40px ; width:120px ; direction:rtl" tabindex="2">
                    <option value="1" <?php if ($row['jens']=='1') echo 'selected=selected'?>>مرد</option>
                    <option value="2" <?php if ($row['jens']=='2') echo 'selected=selected'?>>زن</option>
                    </select>
                  </div></td>
                <td width="19%"><div align="right">جنسیت</div></td>
                <td width="1%"  bgcolor="#FFFFFF">&nbsp;</td>
                <td width="31%"  bgcolor="#FFFFFF"><div align="right"  >
                  <input name="cod_sh_m" type="text"  class="input_text digits" id="cod_sh_m"  style="width:150px; height:30px" tabindex="1"   dir="rtl" lang="fa" value="<?php echo $cod_sh_m ; ?>" minlength="10" maxlength="10" xml:lang="fa"/>
                  </div></td>
                <td width="18%" bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: کد شناسایی </div></td>
                </tr>
              <tr>
                <td height="46" bgcolor="#FFFFFF"><div align="right">
                  <select name="v_tah"  class="input_text mar required" id="v_tah"  style="height:40px ; width:120px ; direction:rtl" tabindex="4">
                    <option value="1" <?php if ($row['v_tah']=='1') echo 'selected=selected'?>>مجرد</option>
                    <option value="2" <?php if ($row['v_tah']=='2') echo 'selected=selected'?>>متاهل</option>
                  </select>
                </div></td>
                <td bgcolor="#FFFFFF"><div align="right">:وضعیت تاهل<br />
                  </div></td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
                <td bgcolor="#FFFFFF"><div align="right">
                  <input name="sal_z" type="text" class="input_text required digits" id="sal_z" style="width:100px; height:30px" tabindex="3" dir="rtl" lang="fa"  value="<?php echo $sal_z ; ?>" minlength="4" maxlength="4" xml:lang="fa"/>
                  </div></td>
                <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: سال جذب</div></td>
                </tr>
              <tr>
                <td height="51"><div align="right">
                   <span class="style2">کیلومتر</span>
                   <input name="f_tm" type="text" class=" input_text required digits" id="f_tm" style="width:100px; height:30px" tabindex="6" dir="rtl" lang="fa" value="<?php echo $f_tm ; ?>"  maxlength="2"  align="baseline" xml:lang="fa" />
                </div></td>
                <td><div align="right">: <span class="normalTextSmaller">فاصله محل استقرار تا مرکز جهاد کشاورزی</span></div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <span class="style2">نفر</span>
                  <input name="no_fam" type="text" class="required input_text digits" id="no_fam" style="width:100px; height:30px" tabindex="5" dir="rtl" lang="fa" value="<?php  echo $no_fam ; ?>" maxlength="2" xml:lang="fa"/>
                </div></td>
                <td><div style="margin-right:30px" align="right">:تعداد افراد تحت تکفل</div></td>
              </tr>
              <tr>
                <td height="51"><div align="right">
                  <select name="g_tah"  class="input_text mar required" id="g_tah"  style="height:40px ; width:200px ; direction:rtl" tabindex="8">
                    <option value="">انتخاب کنید</option>
                    <option value="1"  <?php if ($row['g_tah']=='1') echo 'selected=selected'?>>امور دام </option>
                    <option value="2"  <?php if ($row['g_tah']=='2') echo 'selected=selected'?>>دامپزشکی</option>
                    <option value="3"  <?php if ($row['g_tah']=='3') echo 'selected=selected'?>>زراعت و باغبانی</option>
                    <option value="4"  <?php if ($row['g_tah']=='4') echo 'selected=selected'?>>شیلات و آبزیان</option>
                    <option value="5"  <?php if ($row['g_tah']=='5') echo 'selected=selected'?>>منابع طبیعی و آبخیزداری</option>
                    <option value="6"  <?php if ($row['g_tah']=='6') echo 'selected=selected'?>>آب و خاک</option>
                    <option value="7"  <?php if ($row['g_tah']=='7') echo 'selected=selected'?>>مکانیزاسیون کشاورزی</option>
                    <option value="8"  <?php if ($row['g_tah']=='8') echo 'selected=selected'?>>صنایع تبدیلی و تکمیلی</option>
                    <option value="9"  <?php if ($row['g_tah']=='9') echo 'selected=selected'?>>ترویج و آموزش کشاورزی</option>
                    <option value="10" <?php if ($row['g_tah']=='10') echo 'selected=selected'?>>غیر کشاورزی</option>
                    <option value="11" <?php if ($row['g_tah']=='11') echo 'selected=selected'?>>اعلام نشده</option>
                    <option value="12" <?php if ($row['g_tah']=='12') echo 'selected=selected'?>>فاقد مدرک دانشگاهی</option>
                  </select>
                </div></td>
                <td><div align="right">:گرایش تحصیلی</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <input name="r_tah" type="text" class="required input_text" id="m_fname3" style="width:150px; height:30px" tabindex="7" dir="rtl" lang="fa" value="<?php  echo $r_tah ; ?>" maxlength="75" xml:lang="fa"/>
                </div></td>
                <td><div style="margin-right:30px" align="right">:رشته تحصیلی</div></td>
              </tr>
              <tr>
                <td height="51"><div align="right">
                  <select name="z_fa2"  class="input_text mar required" id="z_fa2"  style="height:40px ; width:200px ; direction:rtl" tabindex="10">
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
                  <select name="z_fa1"  class="input_text mar required" id="z_fa1"  style="height:40px ; width:200px ; direction:rtl" tabindex="9">
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
                <td height="51" colspan="2">&nbsp;</td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="no_ham"  class="input_text mar required" id="no_ham"  style="height:40px ; width:200px ; direction:rtl" tabindex="11">
                    <option value="1">مددکار ترویجی</option>
                    <option value="2">تسهیلگر روستایی</option>
                  </select>
                </div></td>
                <td><div style="margin-right:30px" align="right">:نوع همکاری</div></td>
              </tr>
              <tr>
                <td height="50" colspan="4"><div align="right"><span style="text-align: right">
                  <textarea name="addres" cols="80" rows="4" class="required input_text" id="addres" tabindex="12"><?php echo $m_addres ;?></textarea>
                  </span></div></td>
                <td><div style="margin-right:30px" align="right">:آدرس محل سکونت</div></td>
              </tr>
              <tr>
                <td height="51"><div align="right">
                  <select name="oz_ta" class="required input_text  " id="oz_ta"  style="height:40px ; width:120px ; direction:rtl" tabindex="14">
                    <option value="">انتخاب کنید</option>
                    <option value="1" <?php if ($row['oz_ta']=='1') echo 'selected=selected'?>>بلی</option>
                    <option value="2" <?php if ($row['oz_ta']=='2') echo 'selected=selected'?>>خیر</option>
                  </select>
                </div></td>
                <td><div align="right">:عضو تعاونی ها / تشکل ها</div></td>
                <td>&nbsp;</td>
                <td><div align="right">
                  <select name="no_oz" class="required input_text  " id="no_oz"  style="height:40px ; width:120px ; direction:rtl" tabindex="13">
                    <option value="">انتخاب کنید</option>
                    <option value="1"<?php if ($row['no_oz']=='1') echo 'selected=selected'?>>فعال</option>
                    <option value="2"<?php if ($row['no_oz']=='1') echo 'selected=selected'?>>غیرفعال</option>
                  </select>
                </div></td>
                <td><div style="margin-right:30px" align="right">:نوع عضویت</div></td>
              </tr>
              <tr>
                <td height="60">&nbsp;</td>
                <td colspan="3"><div align="right">
                  <input name="name_co" type="text" class="input_text" id="m_tel_m4" style="width:250px; height:30px"  tabindex="15" dir="rtl" lang="fa" value="<?php echo $name_co ; ?>"  maxlength="255"  align="baseline" xml:lang="fa" />
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
     <input type="hidden" name="cod_m" value=<?php echo $cod_m; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="submit" name="action" value="ثبت اطلاعات" id="submit" style="width:150px ; height:45px" tabindex="16" />
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
  <tr>
<td  height="109"colspan="3" valign="middle" background="../../../files/bottom.gif"><?php include('../../../footer.php')?></td>
   </tr>
</table>
</table>
</body>
</html>
