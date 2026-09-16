<?php
include('../../lock_p1.php');
include('../../event.php');
include('../../date_con.php');
require_once('../../Jalali.php');
//include('sar_data.php');
date_default_timezone_set('Asia/Tehran') ;
$date_edit = jdate("Y/m/d");
$time = date('H:i:s') ;
//require_once('../../ersal_p.php');
if  (isset($_POST['bah_cod_m']))
{
date_default_timezone_set('Asia/Tehran') ;
 $date_s = date_con(jdate("Y/m/d"));
 $add_abadi = $_POST["add_abadi"]; 
 $add_city = $_POST["add_city"]; 
 $bah_cod_m = $_POST['bah_cod_m'];
 $m_poul = $_POST['m_poul'];
if ($m_poul=='abadi') {
 include('../../login/config.php');
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
 include('../../login/config.php');
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
<link href="../radio.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.style10 {color: #FF0000}
.style11 {font-size: 14px}
</style>
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>سامانه شبکه پهنه بندی آبادی های استان آذربایجان شرقی</title>
	<script src="../../15_files/jquery.js" type="text/javascript"></script>
    <script src="../../15_files/jquery.validate.pack.js" type="text/javascript"></script>
    <script src="../../15_files/messages_fa.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            $("#form1").validate();
           });
    </script>
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
           <p class="style8">ثبت اطلاعات زنبورستان  جدید</p>
           <p><img src="../../files/horizontal-line-700x223.png" width="700" height="19"  alt=""/></p>
	<?php sar_data($bah_cod_m) ;?>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF" >
  
  <tr>
    <td width="4"><p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="840" >
    <form action="" method="post" id="form1" name="form1">
      <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:3px solid #069;">
        <tr>
          <p class="one" >&nbsp;</p>
          <td height="40" colspan="5" bgcolor="#CCCCCC"  align="right" ><div style="margin-right:40px" align="right"><strong>موقعیت واحد</strong></div></td>
        </tr>
        <tr>
          <td width="36%" height="37"><div align="right"> <?php echo city_name($id_city) ?></div></td>
          <td width="18%"><div align="right">:شهرستان</div></td>
          <td width="2%">&nbsp;</td>
          <td width="24%"><div align="right"><?php echo ostan_name($id_ostan) ; ?></div></td>
          <td width="20%"><div style="margin-right:30px" align="right">: استان</div></td>
        </tr>
        <tr>
          <td height="38"><div align="right"> <?php echo abadi_name($add_abadi); ?></div></td>
          <td><div align="right">: آبادی / شهر</div></td>
          <td>&nbsp;</td>
          <td><div align="right"> <?php echo mar_name($id_mar) ; ?></div></td>
          <td><div style="margin-right:30px" align="right">: مرکز جهاد کشاورزی</div></td>
        </tr>
        <tr>
          <td  height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات زمین</strong></div></td>
          </tr>
        <tr>
          <td height="51"><div align="right">
            <select name="no_mal" class="input_text  required" id="no_mal"  style="height:40px ; width:170px ; direction:rtl" tabindex="2">
              <option value="">انتخاب کنید</option>
              <option value="1">سند رسمی تفکیکی</option>
              <option value="2">سند رسمی مشاعی</option>
              <option value="3">موقوفی</option>
              <option value="4">قولنامه ای</option>
              <option value="5">متصرف اراضی ملی و دولتی</option>
              <option value="6">اجاره ای</option>
            </select>
          </div></td>
          <td><div align="right">:نوع مالکیت</div></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td><div align="right"><span class="style2">مترمربع</span>
              <input name="m_zamin" type="text" class="input_text required" id="m_zamin" style="width:100px; height:30px ; " tabindex="1" dir="rtl" lang="fa" value="<?php echo $m_zamin ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:مساحت زمین</div></td>
          </tr>
        <tr>
          <td  height="56">&nbsp;</td>
          <td >&nbsp;</td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF"><div align="right">
            <select name="m_ab" class="input_text  required" id="m_ab"  style="height:40px ; width:120px ; direction:rtl" tabindex="3">
              <option value="">انتخاب کنید</option>
              <option value="1">چاه عمیق </option>
              <option value="2">چاه نیمه عمیق </option>
              <option value="3">چاه سطحی</option>
              <option value="4">قنات </option>
              <option value="5">چشمه</option>
              <option value="6">رودخانه</option>
              <option value="7">آب بند یا سد انحرافی</option>
              <option value="8">سایر منابع </option>
            </select>
          </div></td>
          <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: منبع آب</div></td>
          </tr>
        <tr>
          <td height="58"><div align="right">
            <input name="lat" type="text" class="required number input_text" id="lat" style="width:150px; height:30px ; " tabindex="5" dir="rtl" lang="fa" value="<?php echo $lat ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">37.010521: مثال</span></div></td>
          <td><div align="right"><strong>:Y عرض جغرافیایی</strong></div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <input name="lng" type="text" class="required number input_text" id="lng" style="width:150px; height:30px ; " tabindex="4" dir="rtl" lang="fa" value="<?php echo $lng ; ?>" maxlength="11" xml:lang="fa"/>
            <br />
            <span class="style8">46.212486: مثال</span></div></td>
          <td><div style="margin-right:30px" align="right" ><strong>:<strong>X</strong> طول جغرافیایی </strong></div></td>
        </tr>
        <tr>
          <td  height="42" colspan="5" bgcolor="#CCCCCC"><div style="margin-right:40px" align="right"><strong>اطلاعات مرغداری</strong></div></td>
        </tr>
        <tr>
          <td  height="56"><div align="right"  >
            <input name="poul_cod" type="text" class="input_text" id="poul_cod" style="width:150px; height:30px ; " tabindex="7" dir="rtl" lang="fa" value="<?php echo $poul_cod ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
          </div></td>
          <td ><div align="right">:کد مرغداری<br />
          </div></td>
          <td  bgcolor="#FFFFFF">&nbsp;</td>
          <td  bgcolor="#FFFFFF"><div align="right"  >
            <select name="no_bah" class="input_text  required" id="no_bah"  style="height:40px ; width:120px ; direction:rtl" tabindex="6">
              <option value="">انتخاب کنید</option>
              <option value="1">مرغ گوشتی</option>
              <option value="2">مرغ تخمگذار</option>
              <option value="3">مادر گوشتی</option>
              <option value="4">مادر تخمگذار</option>
              <option value="5">اجداد گوشتی</option>
              <option value="6">اجداد تخمگذار</option>
              <option value="7">پولت تخمگذار</option>
              <option value="8">جوجه کشی</option>
              <option value="9">شترمرغ مولد</option>
              <option value="10">شترمرغ پرواری</option>
              <option value="11">بوقبمون مولد</option>
              <option value="12">بوقلمون گوشتی</option>
              <option value="13">بلدرچین</option>
              <option value="14">کبک</option>
              <option value="15">پرندگان زینتی</option>
              <option value="16">سایر ماکیان</option>
            </select>
          </div></td>
          <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نوع بهره برداری</div></td>
        </tr>
        <tr>
          <td height="46" bgcolor="#FFFFFF"><div align="right"  >
            <input name="sh_moj" type="text"  class="input_text  required" id="sh_moj" style="width:150px; height:30px ; " tabindex="9" dir="rtl" lang="fa" value="<?php echo $sh_moj ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
          </div></td>
          <td bgcolor="#FFFFFF"><div align="right">:شماره مجوز<br />
          </div></td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF"><div align="right">
            <select name="no_moj" class="input_text required" id="no_moj"  style="height:40px ; width:120px ; direction:rtl" tabindex="8">
             <option value="">انتخاب کنید</option>
              <option value="1">پروانه بهره برداری</option>
              <option value="2">کارت شناسایی</option>
              <option value="3">فاقد مجوز</option>
            </select>
          </div></td>
          <td bgcolor="#FFFFFF"><div style="margin-right:30px" align="right">: نوع مجوز</div></td>
        </tr>
        <tr>
          <td height="51">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><div align="right"><span class="style2">قطعه</span>
<input name="z_unit" type="text" class="input_text  required digits" id="z_unit" style="width:100px; height:30px ; " tabindex="10" dir="rtl" lang="fa" value="<?php echo $z_unit ; ?>" maxlength="70"  align="baseline" xml:lang="fa" />
          </div></td>
          <td><div style="margin-right:30px" align="right">:ظرفیت </div></td>
        </tr>
        <tr>
          <td height="60"><div align="right">
            <select name="no_sokht" class="input_text  required" id="no_sokht"  style="height:40px ; width:120px ; direction:rtl" tabindex="12">
            <option value="">انتخاب کنید</option>
              <option value="1">گاز</option>
              <option value="2">گازوئیل</option>
              <option value="3">ترکیبی</option>
            </select>
          </div></td>
          <td><div align="right">:نوع سوخت</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="vaz_unit" class="input_text  required" id="vaz_unit"  style="height:40px ; width:120px ; direction:rtl" tabindex="11">
             <option value="">انتخاب کنید</option>
              <option value="1">فعال</option>
              <option value="2">غیر فعال</option>
              <option value="3">تغییر کاربری</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right">
            <p>:وضعیت واحد </p>
          </div></td>
        </tr>
        <tr>
          <td height="48"><div align="right">
            <select name="no_oz" class="input_text " id="no_oz"  style="height:40px ; width:120px ; direction:rtl" tabindex="14">
              <option value="">انتخاب کنید</option>
              <option value="1">عدم عضویت</option>
              <option value="2">رسمی</option>
              <option value="3">خدماتی</option>
            </select>
          </div></td>
          <td><div align="right">:نوع عضویت</div></td>
          <td>&nbsp;</td>
          <td><div align="right">
            <select name="tv_name" class="input_text  required" id="tv_name"  style="height:40px ; width:120px ; direction:rtl" tabindex="13">
            <option value="">انتخاب کنید</option>
              <option value="1">عدم عضویت</option>
            </select>
          </div></td>
          <td><div style="margin-right:30px" align="right" >: عضویت در تعاونی</div></td>
        </tr>
        <tr>
          <td height="133" colspan="4"><span style="text-align: right">
            <textarea name="comment" cols="60" rows="8" class="input_text" id="comment" tabindex="15"><?php echo $comment ;?></textarea>
            </span></td>
          <td height="133"><div style="margin-right:30px" align="right" >
            <p>:توضیحات <br />
              </p>
            </div></td>
        </tr>
        </table>
      <div align="center">
   <p>
     <input type="hidden" name="bah_cod_m" value=<?php echo $bah_cod_m; ?> />
     <input type="hidden" name="id_ostan" value=<?php echo $id_ostan; ?> />
     <input type="hidden" name="id_city" value=<?php echo $id_city; ?> />
     <input type="hidden" name="add_abadi" value=<?php echo $add_abadi; ?> />
     <input type="hidden" name="add_city" value=<?php echo $add_city; ?> />
     <input type="hidden" name="id_mar" value=<?php echo $id_mar; ?> />
     <input type="submit" name="action" value="ثبت اطلاعات" style="width:150px ; height:45px" tabindex="16" />
</p>
</div>
<p align="center" >&nbsp;</p>
</form> 
  </td>
  </tr>
<?
}
else
{
?>
<form  name="myform" class="myform" method="post" action="bee.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
}
?>
  <tr>
  <td height="109"colspan="3" valign="middle" background="../../files/bottom.gif"><p class="MenuItemRight">Copyright © 2014, سازمان نظام مهندسی کشاورزی و منابع طبیعی استان آذربایجان شرقی All Rights Reserved.</p>
  <p><span class="Row-Footer">Web Designer  : R.NOBARI </span></p></td>
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
 $m_zamin = $_POST['m_city'] ;
 $no_mal = $_POST['no_mo'] ;
 $m_ab = $_POST['t_sha'] ;
 $lng = $_POST['e_ostan'] ;
 $lat = $_POST['g_ostan'] ;
 $poul_cod = $_POST['poul_cod'] ;
 $no_bah = $_POST['no_bah'] ;
 $mt_mom = $_POST['mt_mom'] ;
 $z_unit = $_POST['z_unit'] ;
 $mo_moj = $_POST['mo_moj'] ;
 $sh_moj = $_POST['sh_moj'] ;
 $vaz_unit = $_POST['vaz_unit'] ;
 $tav_name = $_POST['tav_name'] ;
 $no_oz = $_POST['no_oz'] ;
 $no_sokht = $_POST['no_sokht'] ;
 $comment = $_POST['comment'] ;

$query = "INSERT INTO bee (date_s,mor_cod_m,no_zan,bah_cod_m,id_ostan,id_city,id_mar,m_zamin,no_mal,m_ab,lng,lat,poul_cod,no_bah,z_unit,no_moj,sh_moj,vaz_unit,tav_name,no_oz,no_sokht,comment,add_abadi,add_city) VALUES(:date_s,:mor_cod_m,:no_zan,:bah_cod_m,:id_ostan,:id_city,:id_mar,:m_zamin ,:no_mal ,:m_ab,:lng,:lat,:poul_cod,:no_bah,:z_unit,:no_moj,:sh_moj,:vaz_unit,:tav_name,:no_oz,:no_sokht,:comment:add_abadi,:add_city)";
$q = $dbh->prepare($query);
$q->execute(array(':date_s'=>$date_s,':mor_cod_m'=>$mor_cod_m,':no_zan'=>$no_zan,':bah_cod_m'=>$bah_cod_m,':id_ostan'=>$id_ostan,':id_city'=>$id_city,':id_mar'=>$id_mar,':m_zamin'=>$m_zamin,':no_mal'=>$no_mal,':m_ab'=>$m_ab,':lng'=>$lng,':lat'=>$lat,':poul_cod'=>$poul_cod,':no_bah'=>$no_bah,':z_unit'=>$z_unit,':no_moj'=>$no_moj,':sh_moj'=>$sh_moj,':vaz_unit'=>$vaz_unit,':tav_name'=>$tav_name,':no_oz'=>$no_oz,':no_sokht'=>$no_sokht,':comment'=>$comment
,':add_abadi'=>$add_abadi,':add_city'=>$add_city));

// ارسال اس ام اس 
//$text= " با سلام اطلاعات شمادر سامانه ثبت مجوز فعالیت های کشاورزی سازمان نظام مهندسی استان ثبت شد کد رهگیری ".$cod_p." اطلاعات بیشتر در سایت سامانه  به آدرس www.aeo-azsh.ir" ; 
//sms($tel_m,$text) ;
 // ثبت در بانک پیگیری
sabt_event($login_session,getUserIP_1(),$date_edit,$time,$add_abadi,'ثبت اطلاعات مرغداری صنعتی -'.$bah_cod_m,$id_ostan) ; 
 // once saved, redirect back to the view page 
 //header("Location: user_view.php");
unset($error,$date_s,$mor_cod_m,$bah_cod_m,$id_ostan,$id_city,$id_mar,$no_zan,$sh_zan,$t_sha,$mt_mom,$m_ostan,$m_city,$no_mo,$e_ostan,$g_ostan,$tk_mo,$tk_bo,$to_mo,$to_bo,$add_abadi,$add_city);
alert ('اطلاعات مرغداری صنعتی با موفقیت ثبت شد ') ;
?>
<form  name="myform" class="myform" method="post" action="../index.php">
</form>
<script type="text/javascript">document.myform.submit();</script>
<?php
} 
?>